<?php

namespace Modules\File\Http\Requests;

use Illuminate\Http\UploadedFile;
use Modules\Core\Constants\CoreConstant;
use Modules\Core\Http\Requests\CoreRequest;

class CreateFileRequest extends CoreRequest
{
    public function rules()
    {
        $extensions = config(CoreConstant::MODULE_NAME . '.file.config.allowed_extensions');
        $mine_types = config(CoreConstant::MODULE_NAME . '.file.config.mine_types');
        $type = $this->type ?? 'all';
        return [
            'upload' => [
                'required',
                'mimes:' . $extensions,
                function ($attribute, $value, $fail) use ($type, $mine_types) {
                    /**
                     * @var UploadedFile $value
                     */
                    if (!$value instanceof UploadedFile) {
                        $fail('The ' . $attribute . ' not invalid.');
                    }
                    $currentMineType = strtolower($value->getClientMimeType());
                    $validateMineTypes = [];
                    if ($type != 'all') {
                        $validateMineTypes = $mine_types[$type] ?? [];
                    } else {
                        foreach ($mine_types as $v) {
                            if (!empty($v))
                                $validateMineTypes = array_merge($validateMineTypes, $v);
                        }
                    }
                    if (empty($validateMineTypes) || !in_array($currentMineType, $validateMineTypes))
                        $fail('The ' . $attribute . ' not invalid with type ' . $type);
                },
            ],
        ];
    }
}
