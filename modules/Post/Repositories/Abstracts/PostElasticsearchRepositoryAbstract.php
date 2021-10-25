<?php

namespace Modules\Post\Repositories\Abstracts;

use Modules\Core\Repositories\Abstracts\ElasticsearchRepositoryAbstract;
use Modules\Post\Repositories\Interfaces\PostElasticsearchRepositoryInterface;

abstract class PostElasticsearchRepositoryAbstract extends ElasticsearchRepositoryAbstract implements PostElasticsearchRepositoryInterface
{

}
