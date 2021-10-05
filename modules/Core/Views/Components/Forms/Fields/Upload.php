<?php

namespace Modules\Core\Views\Components\Forms\Fields;

use Modules\Core\Views\Components\Forms\FieldAbstract;
use Str;

class Upload extends FieldAbstract
{
    public function render()
    {
        if (empty($this->uniqueId))
            $this->uniqueId = ucfirst(strtolower(Str::random(6)));
        return view($this->folderView . 'upload');
    }
}
