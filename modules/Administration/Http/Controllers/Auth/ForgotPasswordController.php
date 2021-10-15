<?php

namespace Modules\Administration\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Modules\Administration\Http\Requests\Auth\ForgotPasswordRequest;
use Modules\Core\Http\Controllers\CoreController;

class ForgotPasswordController extends CoreController
{
    public function getForgotPassword()
    {
        return view('administration::auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param ForgotPasswordRequest $request
     * @return RedirectResponse
     *
     */
    public function postForgotPassword(ForgotPasswordRequest $request)
    {
        $status = Password::sendResetLink($request->only('email'));

        return $status == Password::RESET_LINK_SENT
            ? redirect()->route('get.login')->with('success', __('Please check email to Reset Password'))
            : back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }
}
