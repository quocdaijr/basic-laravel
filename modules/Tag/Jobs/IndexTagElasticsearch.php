<?php

namespace Modules\Tag\Jobs;

use Exception;
use Modules\Core\Constants\QueueConstant;
use Modules\Core\Jobs\CoreJob;
use Modules\Tag\Repositories\Interfaces\TagElasticsearchRepositoryInterface;
use Modules\Tag\Repositories\Interfaces\TagRepositoryInterface;

class IndexTagElasticsearch extends CoreJob
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
    public function handle(TagRepositoryInterface $tagRepository, TagElasticsearchRepositoryInterface $tagElasticsearchRepository)
    {
        try {
            $this->writeMessage("Begin delete es of old TAG with id $this->id");
            $deleted = $tagElasticsearchRepository->delete(['id' => $this->id]);
            $this->writeMessage($deleted ? "End delete es of old TAG with id $this->id" : "Can't delete or not found old es TAG with id $this->id");

            $this->writeMessage("Begin build es for TAG with id $this->id");
            $tag = $tagRepository->find($this->id);
            if (!empty($tag)) {
                $tagElasticsearchRepository->updateOrCreate([
                    'id' => $tag->id,
                    'name' => $tag->name,
                    'slug' => $tag->slug,
                    'description' => $tag->description,
                    'status' => $tag->status,
                    'thumbnail' => $tag->thumbnailDetail->path ?? null,
                    'cover' => $tag->coverDetail->path ?? null,
                    'created_at' => date('Y-m-d H:i:s', strtotime($tag->created_at)),
                    'updated_at' => date('Y-m-d H:i:s', strtotime($tag->updated_at))
                ], [
                    'id' => $tag->id
                ]);
                $this->writeMessage("End build es for TAG with id $this->id");
            } else {
                $this->writeMessage("No TAG with id $this->id");
            }
        } catch (Exception $e) {
            $this->writeException($e);
            throw $e;
        }
    }
}
