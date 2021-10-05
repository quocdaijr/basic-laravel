<?php

namespace Modules\File\Http\Requests;

use Modules\Core\Constants\CoreConstant;
use Modules\Core\Http\Requests\CoreRequest;

class UpdateFileRequest extends CoreRequest
{
    public function rules()
    {
        return [
            'name' => 'string|max:255',
            'title' => 'string|max:255',
            'description' => 'nullable|string|max:255',
            'status' => 'integer|in:' . CoreConstant::STATUS_ACTIVE . ',' . CoreConstant::STATUS_DISABLE . ',' . CoreConstant::STATUS_DELETED,
        ];
    }
}
