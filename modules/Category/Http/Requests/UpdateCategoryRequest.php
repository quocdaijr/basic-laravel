<?php

namespace Modules\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        $id = $this->route()->parameter('id');
        return [
            'name' => 'required|max:255|unique:categories,name,' . $id,
            'status' => 'required',
            'slug' => 'required',
        ];
    }
}
