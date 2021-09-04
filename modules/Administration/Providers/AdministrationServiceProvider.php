<?php

namespace Modules\Administration\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Modules\Administration\Entities\GroupPermission;
use Modules\Administration\Entities\Permission;
use Modules\Administration\Entities\Role;
use Modules\Administration\Entities\User;
use Modules\Administration\Http\Middleware\Authenticate;
use Modules\Administration\Http\Middleware\RedirectIfAuthenticated;
use Modules\Administration\Listeners\BuildAdministrationSidebarListener;
use Modules\Administration\Repositories\Eloquent\GroupPermissionRepository;
use Modules\Administration\Repositories\Eloquent\PermissionRepository;
use Modules\Administration\Repositories\Eloquent\RoleRepository;
use Modules\Administration\Repositories\Eloquent\UserRepository;
use Modules\Administration\Repositories\Interfaces\GroupPermissionRepositoryInterface;
use Modules\Administration\Repositories\Interfaces\PermissionRepositoryInterface;
use Modules\Administration\Repositories\Interfaces\RoleRepositoryInterface;
use Modules\Administration\Repositories\Interfaces\UserRepositoryInterface;
use Modules\Core\Events\BuildSidebarEvent;
use Modules\Core\Traits\RegisterDataTrait;

class AdministrationServiceProvider extends ServiceProvider
{
    use RegisterDataTrait;

    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Administration';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'administration';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        config()->set(['auth.providers.users.model' => User::class]);
        $this->registerTranslations();
        $this->registerMultiConfig(['config', 'permissions']);
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        /**
         * @var Router $router
         */
        $router = $this->app['router'];
        $router->aliasMiddleware('auth', Authenticate::class);
        $router->aliasMiddleware('guest', RedirectIfAuthenticated::class);

        $this->app->register(RouteServiceProvider::class);
        $this->app->bind(UserRepositoryInterface::class, function () {
            return new UserRepository(new User());
        });
        $this->app->bind(RoleRepositoryInterface::class, function () {
            return new RoleRepository(new Role());
        });
        $this->app->bind(PermissionRepositoryInterface::class, function () {
            return new PermissionRepository(new Permission());
        });
        $this->app->bind(GroupPermissionRepositoryInterface::class, function () {
            return new GroupPermissionRepository(new GroupPermission());
        });
        $this->app['events']->listen(
            BuildSidebarEvent::class,
            BuildAdministrationSidebarListener::class
        );

    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
