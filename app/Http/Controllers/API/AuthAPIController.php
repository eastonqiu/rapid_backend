<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Validator;
use InfyOm\Generator\Controller\AppBaseController;
use InfyOm\Generator\Utils\ResponseUtil;
use Illuminate\Http\Request;
use Response;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\PayloadException;
use Log;

class AuthAPIController extends AppBaseController
{

    use ThrottlesLogins;

    private $messages = [
            'required' => ":attribute':1",
            'max' => ":attribute':2",
            'email' => ":attribute':3",
            'unique' => ":attribute':4",
        ];

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * @param AuthAPIController $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/login",
     *      summary="Login and verify account to get access token",
     *      tags={"Auth"},
     *      description="Login",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Account Info",
     *          required=false,
     *          @SWG\Schema(
     *          	type="object",
     *          	@SWG\Property(
     *          		property="email",
     *          		type="string"
     *          	),
     *          	@SWG\Property(
     *          		property="password",
     *          		type="string"
     *          	)
     *          )
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="object",
     *                  @SWG\Property(
     *                  	property="token",
     *                  	type="string"
     *                  ),
     *                  @SWG\Property(
     *                  	property="user",
     *                  	type="string"
     *                  )
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function login(Request $request)
    {
//         $this->validate($request, [
//             $this->loginUsername() => 'required', 'password' => 'required',
//         ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
        	return Response::json(ResponseUtil::makeError('too many login attempts, please try again after some time'), 400);
        }
        
        $user = $this->auth($request);
        if(! empty($user)) {
        	if ($throttles) {
        		$this->clearLoginAttempts($request);
        	}
        	
        	$token = JWTAuth::fromUser($user);
        	return $this->sendResponse(['token'=>$token, 'user'=>$user], 'Auth successfully');
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return Response::json(ResponseUtil::makeError('Auth fail'), 401);
    }

    public function refreshToken(Request $request) {
        try {
            $current_token = JWTAuth::getToken();
            if(!$current_token) return response()->json(null);
        
            $token = JWTAuth::refresh($current_token);
            return response()->json(compact('token'));
        
        } catch (JWTException $e) {
            if ($e instanceof TokenExpiredException) {
                return response()->json(['token_expired'], $e->getStatusCode());
            } else if ($e instanceof TokenBlacklistedException) {
                return response()->json(['token_blacklisted'], $e->getStatusCode());
            } else if ($e instanceof TokenInvalidException) {
                return response()->json(['token_invalid'], $e->getStatusCode());
            } else if ($e instanceof PayloadException) {
                return response()->json(['token_expired'], $e->getStatusCode());
            } else if ($e instanceof JWTException) {
                return response()->json(['token_invalid'], $e->getStatusCode());
            }
        }
    }

    public function getUserInfo() {
        $user = JWTAuth::authenticate(JWTAuth::getToken());
        return $this->sendResponse(['user'=>$user], 'success');
    }

    public function logout() {
        Log::debug('logout now');
        JWTAuth::invalidate(JWTAuth::getToken());
        Log::debug('logout finish');
        return $this->sendResponse(null, 'success');
    } 

    public function getVerificationcode(Request $request) {

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorPhone(array $data)
    {
        return Validator::make($data, [
            'phone' => 'required|max:255|unique:users,phone',
            'password' => 'required|min:6',
        ], $this->messages);
    }

    protected function validatorEmail(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6',
        ], $this->messages);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function auth(Request $request)
    {
        $account = $request->only('email', 'password');
        if(! isset($account['email']) || ! isset($account['password'])) {
        	return null;
        }
        
        $emailRegex = "/^[_a-z 0-9]+@([_a-z 0-9]+\.)+[a-z 0-9]{2,3}$/";
        $phoneRegex = "/^[1][3578]\\d{9}$/";
        
        if(preg_match($emailRegex, $account['email'])) {
        	// email
        	$user = User::where('email', $account['email'])->first();
        } else if(preg_match($phoneRegex, $account['email'])) {
        	// phone
        	$user = User::where('phone', $account['email'])->first();
        } else {
        	return null;
        }
        
        if(!empty($user) && password_verify($account['password'], $user['password']))
        	return $user;
        
        return null;
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
                ? Lang::get('auth.failed')
                : 'These credentials do not match our records.';
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        // do nothing.
    }

    public function loginUsername()
    {
        return 'email';
    }

    /**
     * Determine if the class is using the ThrottlesLogins trait.
     *
     * @return bool
     */
    protected function isUsingThrottlesLoginsTrait()
    {
        return in_array(
            ThrottlesLogins::class, class_uses_recursive(get_class($this))
        );
    }
    
}
