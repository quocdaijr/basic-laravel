<?php

namespace Modules\Category\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Category\Entities\Category;
use Modules\Category\Indexes\Category as CategoryIndex;
use Modules\Category\Listeners\BuildCategorySidebarListener;
use Modules\Category\Repositories\Elasticsearch\CategoryElasticsearchRepository;
use Modules\Category\Repositories\Eloquent\CategoryRepository;
use Modules\Category\Repositories\Interfaces\CategoryElasticsearchRepositoryInterface;
use Modules\Category\Repositories\Interfaces\CategoryRepositoryInterface;
use Modules\Core\Events\BuildSidebarEvent;
use Modules\Core\Traits\RegisterDataTrait;

class CategoryServiceProvider extends ServiceProvider
{
    use RegisterDataTrait;
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Category';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'category';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
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
        $this->app->register(RouteServiceProvider::class);
        $this->app->bind(CategoryRepositoryInterface::class, function () {
            return new CategoryRepository(new Category());
        });

        $this->app->bind(CategoryElasticsearchRepositoryInterface::class, function () {
            return new CategoryElasticsearchRepository(new CategoryIndex());
        });

        $this->app['events']->listen(
            BuildSidebarEvent::class,
            BuildCategorySidebarListener::class
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
