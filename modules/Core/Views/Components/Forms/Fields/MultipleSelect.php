<?php

namespace Modules\Core\Views\Components\Forms\Fields;

use Modules\Core\Exceptions\MissingParamException;
use Modules\Core\Views\Components\Forms\FieldAbstract;

class MultipleSelect extends FieldAbstract
{

    public function render()
    {
        if (!isset($this->options['selectOptions']))
            throw new MissingParamException('$this->options[\'selectOptions\'] is required');

        return view($this->folderView . 'multiple-select');
    }
}
