<?php

namespace Modules\Category\Http\Requests;

use Modules\Core\Http\Requests\CoreRequest;

class CreateCategoryRequest extends CoreRequest
{
    public function rules()
    {
        return [
            'name' => 'required|unique:categories|max:255',
            'status' => 'required',
            'slug' => 'required',
        ];
    }
}
