<?php

namespace Modules\Tag\Console;

use Illuminate\Console\Command;
use Modules\Tag\Jobs\IndexTagElasticsearch;
use Modules\Tag\Repositories\Interfaces\TagRepositoryInterface;

class BuildTagElasticsearchCommand extends Command
{
    protected $signature = 'module:tag:build-tag-elasticsearch';

    protected $description = 'Command build elasticsearch for Tag';

    public function __construct(
        protected TagRepositoryInterface $tagRepository
    )
    {
        parent::__construct();
    }

    public function handle()
    {
        $tags = $this->tagRepository->all();
        foreach ($tags as $tag) {
            dispatch(new IndexTagElasticsearch($tag->id));
            $this->info("[S] Send queue build ES success for Tag with id: $tag->id");
        }
    }
}
