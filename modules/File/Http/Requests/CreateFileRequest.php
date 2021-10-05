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
        $mimetypes = config(CoreConstant::MODULE_NAME . '.file.config.mimetypes');
        $type = $this->type ?? 'all';
        return [
            'file' => [
                'required',
                'mimes:' . $extensions,
                function ($attribute, $value, $fail) use ($type, $mimetypes) {
                    /**
                     * @var UploadedFile $value
                     */
                    if (!$value instanceof UploadedFile) {
                        $fail('The ' . $attribute . ' not invalid.');
                    }

//                    if (empty($value->getClientOriginalExtension()))
//                        $fail("The $attribute has extension is empty.");

                    $currentMimetype = strtolower($value->getClientMimeType());
                    $validateMimetypes = [];
                    if ($type != 'all') {
                        $validateMimetypes = $mimetypes[$type] ?? [];
                    } else {
                        foreach ($mimetypes as $v) {
                            if (!empty($v))
                                $validateMimetypes = array_merge($validateMimetypes, $v);
                        }
                    }
                    if (empty($validateMimetypes) || !in_array($currentMimetype, $validateMimetypes))
                        $fail("The $attribute is invalid with type $type.");
                },
            ],
        ];
    }
}
