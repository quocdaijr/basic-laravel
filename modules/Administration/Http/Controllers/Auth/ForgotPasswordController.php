<?php

namespace Modules\Administration\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
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
     * @param  Request  $request
     * @return RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? redirect()->route('get.login')->with('status', __($status))->with('success', __('Please check email to Reset Password'))
            : back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }
}
