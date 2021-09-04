<?php

namespace Modules\Core\Views\Forms\Fields;

use Modules\Core\Views\Forms\FieldAbstract;

class Text extends FieldAbstract
{

    public function render()
    {
        return view($this->folderView . 'text');
    }
}
