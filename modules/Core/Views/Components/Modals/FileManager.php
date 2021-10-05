<?php

namespace Modules\Core\Views\Components\Modals;

use Illuminate\View\Component;
use Str;

class FileManager extends Component
{

    public function __construct(
        public $folderView = 'core::components.modals.',
        public $uniqueId = '',
        public $type = null,
        public $multiple = false,
        public $for = '',
        public $btnOpenModalId = 'btn_modal_file_manager',
        public $hiddenBtnOpenModal = true,
        public $options = []
    )
    {
    }

    public function render()
    {
        if (empty($this->uniqueId))
            $this->uniqueId = ucfirst(strtolower(Str::random(6)));

        return view($this->folderView . 'file-manager');
    }
}
