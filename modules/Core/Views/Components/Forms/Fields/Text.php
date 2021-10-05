<?php

namespace Modules\Core\Views\Components\Forms\Fields;

use Modules\Core\Views\Components\Forms\FieldAbstract;

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
