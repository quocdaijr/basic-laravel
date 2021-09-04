<?php

namespace Modules\Post\Http\Requests;

use Modules\Core\Http\Requests\CoreRequest;

class CreatePostRequest extends CoreRequest
{
    public function rules() {
        return [
            'name' => 'required|max:255',
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts|max:255',
            'action' => 'required',
            'categories' => 'required',
            'thumbnail' => 'required'
        ];
    }
}
