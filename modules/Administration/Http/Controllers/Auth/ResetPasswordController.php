<?php

namespace Modules\Administration\Http\Controllers\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Modules\Administration\Http\Requests\Auth\ResetPasswordRequest;
use Modules\Core\Http\Controllers\CoreController;

class ResetPasswordController extends CoreController
{
    public function getResetPassword(Request $request)
    {
        return view('administration::auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @param ResetPasswordRequest $request
     * @return RedirectResponse
     *
     */
    public function postResetPassword(ResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => $request->password,
                    'remember_token' => Str::random(60),
                ])->save();
                event(new PasswordReset($user));
            }
        );
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('get.login')->with('success', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }

}
