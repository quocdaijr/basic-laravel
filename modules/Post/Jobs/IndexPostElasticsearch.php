<?php

namespace Modules\Post\Jobs;

use Exception;
use Modules\Core\Constants\QueueConstant;
use Modules\Core\Jobs\CoreJob;
use Modules\Post\Constants\PostConstant;
use Modules\Post\Repositories\Interfaces\PostElasticsearchRepositoryInterface;
use Modules\Post\Repositories\Interfaces\PostRepositoryInterface;

class IndexPostElasticsearch extends CoreJob
{

    public $queue = QueueConstant::QUEUE_ES_POST;

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
    public function handle(PostRepositoryInterface $postRepository, PostElasticsearchRepositoryInterface $postElasticsearchRepository)
    {
        try {
            $this->writeMessage("Begin build ES for Post with id $this->id");
            $post = $postRepository->find($this->id);

            $categories = [];
            foreach ($post->categories as $category) {
                if (!empty($category))
                    $categories[] = [
                        'id' => $category->id,
                        'name' => $category->name,
                        'slug' => $category->slug,
                    ];
            }

            $tags = [];
            foreach ($post->tags as $tag) {
                if (!empty($tag))
                    $tags[] = [
                        'id' => $tag->id,
                        'name' => $tag->name,
                        'slug' => $tag->slug,
                    ];
            }

            foreach ($post->files as $file) {
                switch ($file->pivot->type) {
                    case PostConstant::POST_HAS_FILE_TYPE_THUMBNAIL:
                        $thumbnail = $file->path;
                        break;
                    case PostConstant::POST_HAS_FILE_TYPE_COVER:
                        $cover = $file->path;
                        break;
                    case PostConstant::POST_HAS_FILE_TYPE_RESOURCE:
                    default:
                        $files = [
                            'id' => $file->id,
                            'name' => $file->name,
                            'title' => $file->title,
                            'description' => $file->description,
                            'path' => $file->path,
                            'type' => $file->type,
                            'size' => $file->size,
                            'mimetype' => $file->mimetype,
                            'where' => $file->where,
                        ];
                        break;
                }
            }

            $postElasticsearchRepository->create([
                'id' => $post->id,
                'name' => $post->name,
                'title' => $post->title,
                'slug' => $post->slug,
                'description' => $post->description,
                'content' => $post->content,
                'status' => $post->status,
                'source' => $post->source,
                'author' => $post->author,
                'location' => $post->location,
                'published_at' => date('Y-m-d H:i:s', strtotime($post->published_at)),
                'created_at' => date('Y-m-d H:i:s', strtotime($post->created_at)),
                'updated_at' => date('Y-m-d H:i:s', strtotime($post->updated_at)),
                'thumbnail' => $thumbnail ?? '',
                'cover' => $cover ?? '',
                'categories' => $categories,
                'tags' => $tags,
                'files' => $files ?? [],
            ]);
            $this->writeMessage("Begin build ES for Post with id $this->id");
        } catch (Exception $e) {
            $this->writeException($e);
            throw $e;
        }
    }
}
