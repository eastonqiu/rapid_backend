<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Socialite;
use Session;
use JWTAuth;
use Log;

class SNSController extends Controller {

    public function getWeixin(Request $request) {
        $this->_saveRedirectUrl($request);
        return Socialite::with('weixin')->stateless()->redirect();
    }

    public function getRedirect(Request $request) {
        $platform = $request->input('from');
        $platformUser = Socialite::driver($platform)->stateless()->user();

        $user = User::where('platform', $platform)->where('platform_id', $platformUser->id)->first();
        if(empty($user)) {
            // new user
            $user = [
                'platform' => $platform,
                'platform_id' => $platformUser->id,
                'nickname' => $platformUser->nickname,
                'avatar' => $platformUser->avatar,
                'sex' => $platformUser->offsetGet('sex'),
                'city' => $platformUser->offsetGet('city'),
                'country' => $platformUser->offsetGet('country'),
            ];
            $user = User::create($user);
        }

        $token = JWTAuth::fromUser($user);
        return redirect($this->_getRedirectUrl())->withCookie(cookie('token', $token));
    }

    private function _saveRedirectUrl($request) {
        Session::put('sns_redirect', $request->input('redirect', '/'));
    }

    private function _getRedirectUrl() {
        return Session::get('sns_redirect');
    }
}
