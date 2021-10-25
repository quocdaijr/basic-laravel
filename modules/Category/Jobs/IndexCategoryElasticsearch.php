<?php

namespace Modules\Category\Jobs;

use Exception;
use Modules\Category\Repositories\Interfaces\CategoryElasticsearchRepositoryInterface;
use Modules\Category\Repositories\Interfaces\CategoryRepositoryInterface;
use Modules\Core\Constants\QueueConstant;
use Modules\Core\Jobs\CoreJob;
use Modules\Tag\Repositories\Interfaces\TagElasticsearchRepositoryInterface;
use Modules\Tag\Repositories\Interfaces\TagRepositoryInterface;

class IndexCategoryElasticsearch extends CoreJob
{

    public $queue = QueueConstant::QUEUE_DEFAULT;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected $id
    )
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws Exception
     */
    public function handle(CategoryRepositoryInterface $categoryRepository, CategoryElasticsearchRepositoryInterface $categoryElasticsearchRepository)
    {
        try {
            $this->writeMessage("Begin build ES for Category with id $this->id");
            $category = $categoryRepository->find($this->id);

            $categoryElasticsearchRepository->updateOrCreate([
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'description' => $category->description,
                'status' => $category->status,
                'thumbnail' => $category->thumbnailDetail->path ?? null,
                'cover' => $category->coverDetail->path ?? null,
                'created_at' => date('Y-m-d H:i:s', strtotime($category->created_at)),
                'updated_at' => date('Y-m-d H:i:s', strtotime($category->updated_at))
            ], [
                'id' => $category->id
            ]);
            $this->writeMessage("Begin build ES for Tag with id $this->id");
        } catch (Exception $e) {
            $this->writeException($e);
            throw $e;
        }
    }
}
