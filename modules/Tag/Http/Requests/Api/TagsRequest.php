<?php

namespace Modules\Tag\Http\Requests\Api;

use Modules\Core\Http\Requests\ApiRequest;

class TagsRequest extends ApiRequest
{
    public function rules() {
        return [
            'page' => 'nullable|integer',
            'perPage' => 'nullable|integer',
            'sortAttr' => 'nullable|string',
            'sortVal' => 'nullable|string|in:asc,desc',
        ];
    }
}
