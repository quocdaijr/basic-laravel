<?php

namespace Modules\Administration\Http\Requests\Auth;

use Modules\Core\Http\Requests\CoreRequest;

class ForgotPasswordRequest extends CoreRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
        ];
    }
}
