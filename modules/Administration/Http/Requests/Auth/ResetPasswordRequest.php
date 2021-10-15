<?php

namespace Modules\Administration\Http\Requests\Auth;

use Illuminate\Validation\Rules\Password;
use Modules\Core\Http\Requests\CoreRequest;

class ResetPasswordRequest extends CoreRequest
{
    public function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}
