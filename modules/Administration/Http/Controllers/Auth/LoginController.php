<?php

namespace Modules\Administration\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Administration\Http\Requests\Auth\LoginRequest;
use Modules\Core\Http\Controllers\CoreController;

class LoginController extends CoreController
{
    public function getLogin()
    {
        return view('administration::auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        return redirect(\Redirect::intended()->getTargetUrl())->with('toast_success', 'Login success!');
    }

    public function logout(Request $request)
    {
        $isLogin = false;
        if (!Auth::guard()->guest()) {
            $isLogin = true;
            Auth::guard()->logout();
        }

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($isLogin)
            return redirect()->route('get.login')->with('success', __('Logout success'));
        else
            return redirect()->route('get.login')->with('warning', __('You not login'));
    }
}
