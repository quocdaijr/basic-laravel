<?php

namespace Modules\Core\Indexes;

use Elasticsearch\Common\Exceptions\RuntimeException;
use Quocdaijr\Elasticsearch\Indexes\IndexAbstract;

abstract class CoreIndexAbstract extends IndexAbstract implements CoreIndexInterface
{
    public function __construct($_id = '_id', $_scroll = '1m', $_timeout = '1s')
    {
        if (!config('laravel-elasticsearch.allowed_elasticsearch', false)) {
            return;
        }
        parent::__construct($_id, $_scroll, $_timeout);
    }
}
