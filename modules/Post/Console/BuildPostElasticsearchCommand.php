<?php

namespace Modules\Post\Console;

use Illuminate\Console\Command;
use Modules\Post\Jobs\IndexPostElasticsearch;
use Modules\Post\Repositories\Interfaces\PostElasticsearchRepositoryInterface;
use Modules\Post\Repositories\Interfaces\PostRepositoryInterface;

class BuildPostElasticsearchCommand extends Command
{
    protected $signature = 'module:post:build-post-elasticsearch';

    protected $description = 'Command build elasticsearch for Post';

    public function __construct(
        protected PostRepositoryInterface $postRepository,
        protected PostElasticsearchRepositoryInterface $postElasticsearchRepository
    )
    {
        parent::__construct();
    }

    public function handle()
    {
        $posts = $this->postRepository->all();
        foreach ($posts as $post) {
            dispatch(new IndexPostElasticsearch($post->id));
            $this->info("[S] Send queue build ES success for post with id: $post->id");
        }
    }
}
