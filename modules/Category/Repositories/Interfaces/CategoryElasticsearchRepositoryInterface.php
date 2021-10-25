<?php

namespace Modules\Category\Repositories\Interfaces;

use Modules\Core\Repositories\Interfaces\ElasticsearchRepositoryInterface;

interface CategoryElasticsearchRepositoryInterface extends ElasticsearchRepositoryInterface
{
    public function getFeCategories(array $params): array;
}
