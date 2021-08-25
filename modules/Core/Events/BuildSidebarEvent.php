<?php

namespace Modules\Core\Events;

use Maatwebsite\Sidebar\Menu;

class BuildSidebarEvent
{

    public function __construct(
        private Menu $menu
    )
    {
    }

    /**
     * Add a menu group to the menu
     * @param Menu $menu
     */
    public function add(Menu $menu)
    {
        $this->menu->add($menu);
    }

    /**
     * Get the current Laravel-Sidebar menu
     * @return Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }
}
