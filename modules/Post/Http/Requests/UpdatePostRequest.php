<?php

namespace Modules\Post\Http\Requests;

use Modules\Core\Http\Requests\CoreRequest;

class UpdatePostRequest extends CoreRequest
{
    public function rules() {
        return [
            'name' => 'required|max:255',
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:posts,id,' . $this->id,
            'action' => 'required',
            'categories' => 'required',
            'thumbnail' => 'required'
        ];
    }
}
