<?php

namespace Modules\Core\Views\Forms\Fields;

use Modules\Core\Views\Forms\FieldAbstract;

class Upload extends FieldAbstract
{
    public function render()
    {
        return view($this->folderView . 'upload');
    }
}
