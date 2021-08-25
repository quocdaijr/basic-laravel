<?php

namespace Modules\Core\Supports;

use Illuminate\Contracts\Container\Container;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\ShouldCache;
use Maatwebsite\Sidebar\Sidebar;
use Maatwebsite\Sidebar\Traits\CacheableTrait;
use Modules\Core\Events\BuildSidebarEvent;
use Nwidart\Modules\Contracts\RepositoryInterface;

class AdminSidebar implements Sidebar, ShouldCache
{
    use CacheableTrait;

    /**
     * @param Menu $menu
     * @param RepositoryInterface $modules
     * @param Container $container
     */
    public function __construct(
        protected Menu                $menu,
        protected RepositoryInterface $modules,
        protected Container           $container
    )
    {
    }

    /**
     * Build your sidebar implementation here
     */
    public function build()
    {
        event(new BuildSidebarEvent($this->menu));
    }

    /**
     * @return Menu
     */
    public function getMenu()
    {
        $this->build();

        return $this->menu;
    }
}

