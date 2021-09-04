<?php

namespace Modules\Administration\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Administration\Http\Requests\LoginRequest;
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

    public function guard()
    {
        return Auth::guard();
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('get.login')->with('success', __('Logout success'));
    }
}
