<?php

namespace Modules\Administration\Http\Controllers;

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
//        toast(title: 'Login success',type: 'success')->animation('animate__backInRight', 'animate__backInRight')->timerProgressBar();
        return redirect()->route('dashboard.index')->with('toast_success', 'Login success!');
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
