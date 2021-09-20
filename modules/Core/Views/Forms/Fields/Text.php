<?php

namespace Modules\Core\Views\Forms\Fields;

use Modules\Core\Views\Forms\FieldAbstract;

class Text extends FieldAbstract
{

    public function render()
    {
        if (($this->options['type'] ?? '') === 'textarea')
            return view($this->folderView . 'textarea');
        else
            return view($this->folderView . 'text');
    }
}
