<?php

namespace Modules\Tag\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Events\BuildSidebarEvent;
use Modules\Core\Traits\RegisterDataTrait;
use Modules\Tag\Console\BuildTagElasticsearchCommand;
use Modules\Tag\Entities\Tag;
use Modules\Tag\Indexes\Tag as TagIndex;
use Modules\Tag\Listeners\BuildTagSidebarListener;
use Modules\Tag\Repositories\Elasticsearch\TagElasticsearchRepository;
use Modules\Tag\Repositories\Eloquent\TagRepository;
use Modules\Tag\Repositories\Interfaces\TagElasticsearchRepositoryInterface;
use Modules\Tag\Repositories\Interfaces\TagRepositoryInterface;

class TagServiceProvider extends ServiceProvider
{
    use RegisterDataTrait;

    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Tag';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'tag';

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

        $this->app->bind(TagRepositoryInterface::class, function () {
            return new TagRepository(new Tag());
        });

        $this->app->bind(TagElasticsearchRepositoryInterface::class, function () {
            return new TagElasticsearchRepository(new TagIndex());
        });

        $this->app['events']->listen(
            BuildSidebarEvent::class,
            BuildTagSidebarListener::class
        );

        $this->commands([
            BuildTagElasticsearchCommand::class
        ]);
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
