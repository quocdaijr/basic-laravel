<?php

namespace Modules\Tag\Repositories\Interfaces;


use Modules\Core\Repositories\Interfaces\ElasticsearchRepositoryInterface;

interface TagElasticsearchRepositoryInterface extends ElasticsearchRepositoryInterface
{
    public function getFeTags(array $params): array;
}
