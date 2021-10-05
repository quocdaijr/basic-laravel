<?php

namespace Modules\Core\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Sidebar\Middleware\ResolveSidebars;
use Maatwebsite\Sidebar\SidebarManager;
use Modules\Core\Supports\AdminSidebar;
use Modules\Core\Views\Components\SidebarRenderer;
use Modules\Core\Views\Creators\Sidebar;
use View;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot(SidebarManager $manager)
    {
        $router = $this->app[Router::class];
        $router->pushMiddlewareToGroup('web', ResolveSidebars::class);

        $this->app->bind(
            'Maatwebsite\Sidebar\Presentation\SidebarRenderer',
            SidebarRenderer::class
        );

        $manager->register(AdminSidebar::class);

        View::creator(
            'core::partials.sidebar',
            Sidebar::class
        );
    }
}
