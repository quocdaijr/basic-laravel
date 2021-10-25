<?php

namespace Modules\Tag\Repositories\Elasticsearch;

use Modules\Core\Constants\CoreConstant;
use Modules\Tag\Repositories\Abstracts\TagElasticsearchRepositoryAbstract;

class TagElasticsearchRepository extends TagElasticsearchRepositoryAbstract
{
    public function getFeTags(array $params): array
    {
        $page = $params['page'] ?? 1;
        $perPage = $params['perPage'] ?? CoreConstant::PER_PAGE_DEFAULT;
        $sortAttribute = $params['sortAttr'] ?? 'id';
        $sortValue = $params['sortVal'] ?? 'desc';

        $baseQuery = [
            'body' => [
                'from' => ($page - 1) * $perPage,
                'size' => $perPage,
                'sort' => [$sortAttribute => $sortValue],
                'query' => [
                    'bool' => [
                        'must' => [
                            [
                                'term' => [
                                    'status' => CoreConstant::STATUS_ACTIVE
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        if (!empty($sortAttributes)) {
            foreach ($sortAttributes as $attribute => $value) {
                $baseQuery['body']['sort'] += [$attribute => $value];
            }
        }

        return $this->search($baseQuery);
    }
}
