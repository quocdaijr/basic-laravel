<?php

namespace Modules\Core\Views;

use Maatwebsite\Sidebar\Presentation\SidebarRenderer;
use Modules\Core\Supports\AdminSidebar;

class SidebarViewCreator
{
    /**
     * @param AdminSidebar $sidebar
     * @param SidebarRenderer $renderer
     */
    public function __construct(
        protected AdminSidebar $sidebar,
        protected SidebarRenderer $renderer
    )
    {
    }

    public function create($view)
    {
        $view->sidebar = $this->renderer->render($this->sidebar);
    }
}
