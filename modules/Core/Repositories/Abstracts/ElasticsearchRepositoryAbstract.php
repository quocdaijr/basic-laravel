<?php

namespace Modules\Core\Repositories\Abstracts;

use Modules\Core\Indexes\CoreIndexInterface;
use Modules\Core\Repositories\Interfaces\ElasticsearchRepositoryInterface;
use Quocdaijr\Elasticsearch\Repositories\ElasticsearchRepositoryAbstract as QuocdaijrElasticsearchRepositoryAbstract;

abstract class ElasticsearchRepositoryAbstract extends QuocdaijrElasticsearchRepositoryAbstract implements ElasticsearchRepositoryInterface
{
    public function __construct(CoreIndexInterface $index)
    {
        parent::__construct($index);
    }
}
