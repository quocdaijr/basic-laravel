<?php

namespace Modules\Post\Repositories\Interfaces;


use Modules\Core\Repositories\Interfaces\ElasticsearchRepositoryInterface;

interface PostElasticsearchRepositoryInterface extends ElasticsearchRepositoryInterface
{
    public function getFePosts(array $params): array;

}
