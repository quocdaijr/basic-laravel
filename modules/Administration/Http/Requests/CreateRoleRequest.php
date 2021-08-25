<?php

namespace Modules\Administration\Http\Requests;

use Modules\Core\Http\Requests\CoreRequest;

class CreateRoleRequest extends CoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $tableNames = config('permission.table_names');

        return [
            'name'          => "required|unique:".$tableNames['roles'].",id",
            'permissions'   => 'nullable|array',
            'permissions.*' => 'nullable|exists:'. $tableNames['permissions']. ',id',
        ];
    }
}
