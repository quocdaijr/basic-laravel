<?php

namespace Modules\Core\Views\Components\Forms\Fields;

use Modules\Core\Views\Components\Forms\FieldAbstract;

class TinyEditor extends FieldAbstract
{

    public function render()
    {
        return view($this->folderView . 'tinymce-editor');
    }
}
