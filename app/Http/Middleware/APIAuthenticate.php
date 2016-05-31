<?php

/*
 * This file is part of jwt-auth.
 *
 * (c) Sean Tymon <tymon148@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Middleware;

use Tymon\JWTAuth\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Log;

class APIAuthenticate extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $jwtAuth = $this->auth->setRequest($request);
        if (! $token = $jwtAuth->getToken()) {
            return $this->respond('tymon.jwt.absent', 'token_not_provided', 400);
        }

        try {
            $user = $this->auth->authenticate($token);
        } catch (TokenExpiredException $e) {
            try {
                $newToken = $jwtAuth->parseToken()->refresh();
                $user = $this->auth->authenticate($newToken);
                if (! $user) {
                    return $this->respond('tymon.jwt.user_not_found', 'user_not_found', 404);
                }

                $this->events->fire('tymon.jwt.valid', $user);

                $response = $next($request);
                $response->headers->set('Authorization', $newToken);
                
                return $response;
            } catch (TokenExpiredException $e) {
                Log::debug('expire token' . $e->getStatusCode());
                return $this->respond('tymon.jwt.expired', 'token_expired', 401, [$e]);
            } catch (JWTException $e) {
                Log::debug('exception token');
                return $this->respond('tymon.jwt.invalid', 'token_invalid', $e->getStatusCode(), [$e]);
            }
        } catch (JWTException $e) {
            Log::debug('exception 1 token');
            return $this->respond('tymon.jwt.invalid', 'token_invalid', $e->getStatusCode(), [$e]);
        }

        if (! $user) {
            return $this->respond('tymon.jwt.user_not_found', 'user_not_found', 404);
        }

        $this->events->fire('tymon.jwt.valid', $user);

        return $next($request);
    }
}
