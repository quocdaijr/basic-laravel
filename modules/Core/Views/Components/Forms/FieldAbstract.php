<?php

namespace Modules\Core\Views\Components\Forms;

use Illuminate\View\Component;

abstract class FieldAbstract extends Component
{
    public function __construct(
        public $name,
        public $errorMessage = null,
        public $oldValue = null,
        public $folderView = 'core::components.forms.fields.',
        public $uniqueId = '',
        public $options = []
    )
    {
    }
}
