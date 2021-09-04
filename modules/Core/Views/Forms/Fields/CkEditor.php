<?php

namespace Modules\Core\Views\Forms\Fields;

use Modules\Core\Views\Forms\FieldAbstract;

class CkEditor extends FieldAbstract
{

    public function render()
    {
        return view($this->folderView . 'ck-editor');
    }
}
