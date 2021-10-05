<?php

namespace Modules\Core\Views\Components\Forms\Fields;

use Modules\Core\Views\Components\Forms\FieldAbstract;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;

class Datetimepicker extends FieldAbstract
{

    public function render()
    {
        if (!isset($this->options['id']))
            throw new MissingMandatoryParametersException('$this->options[\'id\'] is required');
        return view($this->folderView . 'datetimepicker');
    }
}
