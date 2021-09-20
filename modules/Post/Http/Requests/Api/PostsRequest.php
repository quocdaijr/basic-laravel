<?php

namespace Modules\Post\Http\Requests\Api;

use Modules\Core\Http\Requests\ApiRequest;

class PostsRequest extends ApiRequest
{

    public function rules() {
        return [
            'txt' => 'nullable|string|max:255',
            'page' => 'nullable|integer',
            'perPage' => 'nullable|integer',
            'tag' => 'nullable|integer',
            'category' => 'nullable|integer',
            'sortAttr' => 'nullable|string',
            'sortVal' => 'nullable|string|in:asc,desc',
        ];
    }
}
