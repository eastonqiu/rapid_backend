<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Socialite;
use Session;

class SNSController extends Controller {

    public function getWeixin(Request $request) {
        $this->_saveRedirectUrl($request);
        return Socialite::with('weixin')->stateless()->redirect();
    }

    public function getRedirect(Request $request) {
        $user = Socialite::driver('weixin')->stateless()->user();
        var_dump($user);
        return 'hello';
        // return redirect($this->_getRedirectUrl());
    }

    private function _saveRedirectUrl($request) {
        Session::put('sns_redirect', $request->input('redirect', '/'));
    }

    private function _getRedirectUrl() {
        return Session::get('sns_redirect');
    }
}
