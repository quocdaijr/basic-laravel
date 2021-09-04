<?php

namespace Modules\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Modules\Core\Http\Requests\CoreRequest;

class UpdateCategoryRequest extends CoreRequest
{

    public function rules() {
        return [
            'name' => 'required|max:255|unique:categories,name,' . $this->id,
            'status' => 'required',
            'slug' => 'required|max:255|unique:categories,slug,' . $this->id,
        ];
    }
}
