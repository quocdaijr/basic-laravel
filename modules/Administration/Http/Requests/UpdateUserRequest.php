<?php

namespace Modules\Administration\Http\Requests;

use Modules\Core\Http\Requests\CoreRequest;

class UpdateUserRequest extends CoreRequest
{
    public function rules()
    {
        $tableNames = config('permission.table_names');

        return [
            'username' => 'required|max:255|unique:users,username,' . $this->id,
            'email' => 'required|email|max:255|unique:users,email,' . $this->id,
            'phone' => 'required|max:15|unique:users,phone,' . $this->id,
            'status' => 'required',
            'roles' => 'nullable|array',
            'roles.*' => 'nullable|exists:' . $tableNames['roles'] . ',id',
            'permissions' => 'nullable|array',
            'permissions.*' => 'nullable|exists:' . $tableNames['permissions'] . ',id',
        ];
    }
}
