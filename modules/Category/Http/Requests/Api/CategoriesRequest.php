<?php

namespace Modules\Category\Http\Requests\Api;

use Modules\Core\Http\Requests\ApiRequest;

class CategoriesRequest extends ApiRequest
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
