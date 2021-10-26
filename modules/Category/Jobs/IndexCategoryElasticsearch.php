<?php

namespace Modules\Category\Jobs;

use Exception;
use Modules\Category\Repositories\Interfaces\CategoryElasticsearchRepositoryInterface;
use Modules\Category\Repositories\Interfaces\CategoryRepositoryInterface;
use Modules\Core\Constants\QueueConstant;
use Modules\Core\Jobs\CoreJob;

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
            $this->writeMessage("Begin delete es of old CATEGORY with id $this->id");
            $deleted = $categoryElasticsearchRepository->delete(['id' => $this->id]);
            $this->writeMessage($deleted ? "End delete es of old CATEGORY with id $this->id" : "Can't delete or not found old es CATEGORY with id $this->id");

            $this->writeMessage("Begin build es for CATEGORY with id $this->id");
            $category = $categoryRepository->find($this->id);

            if (!empty($category)) {
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
                $this->writeMessage("End build es for CATEGORY with id $this->id");
            } else {
                $this->writeMessage("No CATEGORY with id $this->id");
            }
        } catch (Exception $e) {
            $this->writeException($e);
            throw $e;
        }
    }
}
