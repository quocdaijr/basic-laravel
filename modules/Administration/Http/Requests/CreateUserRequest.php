<?php

namespace Modules\Administration\Http\Requests;

use Modules\Core\Http\Requests\CoreRequest;

class CreateUserRequest extends CoreRequest
{
    public function rules()
    {
        $tableNames = config('permission.table_names');

        return [
            'username' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'phone' => 'required|unique:users|max:255',
            'status' => 'required',
            'roles' => 'nullable|array',
            'roles.*' => 'nullable|exists:' . $tableNames['roles'] . ',id',
            'permissions' => 'nullable|array',
            'permissions.*' => 'nullable|exists:' . $tableNames['permissions'] . ',id',
        ];
    }
}
