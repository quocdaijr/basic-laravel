<?php

namespace Modules\Administration\Http\Requests;

use Modules\Core\Http\Requests\CoreRequest;

class UpdatePermissionRequest extends CoreRequest
{
    public function rules()
    {
        $tableNames = config('permission.table_names');

        return [
            'name' => "required|unique:" . $tableNames['permissions'] . ",name," . $this->id,
            'title' => 'required|string|max:255',
            'group_id' => 'required|integer'
        ];
    }
}
