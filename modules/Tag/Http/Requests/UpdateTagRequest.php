<?php

namespace Modules\Tag\Http\Requests;

use Modules\Core\Http\Requests\CoreRequest;

class UpdateTagRequest extends CoreRequest
{
    public function rules() {
        return [
            'name' => 'required|max:255|unique:tags,name,' . $this->id,
            'status' => 'required',
            'slug' => 'required|max:255|unique:tags,slug,' . $this->id,
        ];
    }
}
