<?php

namespace Modules\Core\Views\Forms\Fields;

use Modules\Core\Views\Forms\FieldAbstract;

class Tag extends FieldAbstract
{

    public function render()
    {
        return view($this->folderView . 'tag');
    }
}
