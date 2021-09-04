<?php

namespace Modules\Core\Views\Forms\Fields;

use Modules\Core\Exceptions\MissingParamException;
use Modules\Core\Views\Forms\FieldAbstract;

class Select extends FieldAbstract
{
    public function render()
    {
        if (!isset($this->options['selectOptions']))
            throw new MissingParamException('$this->options[\'selectOptions\'] is required');

        return view($this->folderView . 'select');
    }
}
