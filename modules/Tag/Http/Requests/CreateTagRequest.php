<?php

namespace Modules\Tag\Http\Requests;

use Modules\Core\Http\Requests\CoreRequest;

class CreateTagRequest extends CoreRequest
{
    public function rules()
    {
        return [
            'name' => 'required|unique:tags|max:255',
            'status' => 'required',
            'slug' => 'required|unique:tags|max:255',
        ];
    }
}
