<?php

namespace Modules\Category\Console;

use Illuminate\Console\Command;
use Modules\Category\Jobs\IndexCategoryElasticsearch;
use Modules\Category\Repositories\Interfaces\CategoryRepositoryInterface;

class BuildCategoryElasticsearchCommand extends Command
{
    protected $signature = 'module:category:build-category-elasticsearch';

    protected $description = 'Command build elasticsearch for Category';

    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository
    )
    {
        parent::__construct();
    }

    public function handle()
    {
        $categories = $this->categoryRepository->all();
        foreach ($categories as $category) {
            dispatch(new IndexCategoryElasticsearch($category->id));
            $this->info("[S] Send queue build ES success for tag with id: $category->id");
        }
    }
}
