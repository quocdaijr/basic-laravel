<?php

namespace Modules\Post\Repositories\Elasticsearch;

use Modules\Core\Constants\CoreConstant;
use Modules\Post\Constants\PostConstant;
use Modules\Post\Repositories\Abstracts\PostElasticsearchRepositoryAbstract;

class PostElasticsearchRepository extends PostElasticsearchRepositoryAbstract
{
    public function getFePosts(array $params): array
    {
        $page = $params['page'] ?? 1;
        $perPage = $params['perPage'] ?? CoreConstant::PER_PAGE_DEFAULT;
        $sortAttribute = $params['sortAttr'] ?? 'published_at';
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
                                'range' => [
                                    'published_at' => [
                                        'lte' => date('Y-m-d H:i:s')
                                    ]
                                ]
                            ],
                            [
                                'term' => [
                                    'status' => PostConstant::STATUS_PUBLISHED
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

        if (!empty($params['txt'])) {
            $keyword = trim($params['txt']);
            $baseQuery['body']['query']['bool']['must'][] = [
                'bool' => [
                    'should' => [
                        [
                            'match_phrase' => [
                                'title' => $keyword
                            ]
                        ],
                        [
                            'match_phrase' => [
                                'description' => $keyword
                            ]
                        ],
                        [
                            'match_phrase' => [
                                'content' => $keyword
                            ]
                        ],
                        [
                            'match_phrase' => [
                                'author' => $keyword
                            ]
                        ],
                        [
                            'nested' => [
                                "path" => "tags",
                                'query' => [
                                    'bool' => [
                                        'must' => [
                                            [
                                                'match_phrase' => [
                                                    'tags.name' => $keyword,
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'minimum_should_match' => 1,
                ]
            ];
        }

        if (!empty($params['tag']))
            $baseQuery['body']['query']['bool']['must'][] = [
                'nested' => [
                    'path' => 'tags',
                    'query' => [
                        'bool' => [
                            'must' => [
                                [
                                    'term' => [
                                        'tags.id' => (int)$params['tag'],
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ];

        if (!empty($params['category']))
            $baseQuery['body']['query']['bool']['must'][] = [
                'nested' => [
                    'path' => 'categories',
                    'query' => [
                        'bool' => [
                            'must' => [
                                [
                                    'term' => [
                                        'categories.id' => (int)$params['category'],
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ];

        return $this->search($baseQuery);
    }
}
