<?php

namespace Modules\Post\Indexes;

use Modules\Core\Indexes\CoreIndex;

class Post extends CoreIndex
{
    public function __construct()
    {
        return parent::__construct('id');
    }

    public function index(): string
    {
        return 'posts';
    }

    public function mapping(): array
    {
        return [
            'id' => [
                'type' => 'long',
            ],
            'name' => [
                'type' => 'text',
                'fielddata' => true,
                "fields" => [
                    'keyword' => [
                        'type' => 'keyword',
                        "ignore_above" => 256
                    ]
                ],
                'analyzer' => 'vietnamese_standard'
            ],
            'title' => [
                'type' => 'text',
                'fielddata' => true,
                "fields" => [
                    'keyword' => [
                        'type' => 'keyword',
                        "ignore_above" => 256
                    ]
                ],
                'analyzer' => 'vietnamese_standard'
            ],
            'slug' => [
                'type' => 'keyword'
            ],
            'description' => [
                'type' => 'text',
                'fielddata' => true,
                "fields" => [
                    'keyword' => [
                        'type' => 'keyword',
                        "ignore_above" => 256
                    ]
                ],
                'analyzer' => 'vietnamese_standard'
            ],
            'content' => [
                'type' => 'text',
                'fielddata' => true,
                "fields" => [
                    'keyword' => [
                        'type' => 'keyword',
                        "ignore_above" => 256
                    ]
                ],
                'analyzer' => 'vietnamese_standard'
            ],
            'status' => [
                'type' => 'integer'
            ],
            'source' => [
                'type' => 'text',
                'fielddata' => true,
                "fields" => [
                    'keyword' => [
                        'type' => 'keyword',
                        "ignore_above" => 256
                    ]
                ],
                'analyzer' => 'vietnamese_standard'
            ],
            'author' => [
                'type' => 'text',
                'fielddata' => true,
                "fields" => [
                    'keyword' => [
                        'type' => 'keyword',
                        "ignore_above" => 256
                    ]
                ],
                'analyzer' => 'vietnamese_standard'
            ],
            'location' => [
                'type' => 'text',
                'fielddata' => true,
                "fields" => [
                    'keyword' => [
                        'type' => 'keyword',
                        "ignore_above" => 256
                    ]
                ],
                'analyzer' => 'vietnamese_standard'
            ],
            'published_at' => [
                'type' => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss'
            ],
            'created_at' => [
                'type' => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss'
            ],
            'updated_at' => [
                'type' => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss'
            ],
            'thumbnail' => [
                'type' => 'keyword'
            ],
            'cover' => [
                'type' => 'keyword'
            ],
            'categories' => [
                'type' => 'nested',
                'properties' => [
                    'id' => [
                        'type' => 'integer'
                    ],
                    'name' => [
                        'type' => 'text',
                        'fielddata' => true,
                        "fields" => [
                            'keyword' => [
                                'type' => 'keyword',
                                "ignore_above" => 256
                            ]
                        ],
                        'analyzer' => 'vietnamese_standard'
                    ],
                    'slug' => [
                        'type' => 'keyword',
                    ],
                    'thumbnail' => [
                        'type' => 'keyword',
                    ],
                    'cover' => [
                        'type' => 'keyword',
                    ],
                ]
            ],
            'tags' => [
                'type' => 'nested',
                'properties' => [
                    'id' => [
                        'type' => 'integer'
                    ],
                    'name' => [
                        'type' => 'text',
                        'fielddata' => true,
                        "fields" => [
                            'keyword' => [
                                'type' => 'keyword',
                                "ignore_above" => 256
                            ]
                        ],
                        'analyzer' => 'vietnamese_standard'
                    ],
                    'slug' => [
                        'type' => 'keyword',
                    ],
                    'thumbnail' => [
                        'type' => 'keyword',
                    ],
                    'cover' => [
                        'type' => 'keyword',
                    ],
                ]
            ],
            'files' => [
                'type' => 'nested',
                'properties' => [
                    'id' => [
                        'type' => 'integer'
                    ],
                    'name' => [
                        'type' => 'text',
                        'fielddata' => true,
                        "fields" => [
                            'keyword' => [
                                'type' => 'keyword',
                                "ignore_above" => 256
                            ]
                        ],
                        'analyzer' => 'vietnamese_standard'
                    ],
                    'title' => [
                        'type' => 'text',
                        'fielddata' => true,
                        "fields" => [
                            'keyword' => [
                                'type' => 'keyword',
                                "ignore_above" => 256
                            ]
                        ],
                        'analyzer' => 'vietnamese_standard'
                    ],
                    'path' => [
                        'type' => 'keyword',
                    ],
                    'type' => [
                        'type' => 'keyword',
                    ],
                    'mimetype' => [
                        'type' => 'keyword',
                    ],
                    'where' => [
                        'type' => 'keyword',
                    ],
                    'size' => [
                        'type' => 'double',
                    ],
                    'options' => [
                        'type' => 'text',
                        'index' => 'false'
                    ],
                ]
            ]
        ];
    }

    public function settings(): array
    {
        return [
            'number_of_shards' => 5,
            'number_of_replicas' => 3,
            'analysis' => [
                'analyzer' => [
                    'vietnamese_standard' => [
                        'tokenizer' => 'icu_tokenizer',
                        'filter' => [
                            'icu_folding',
                            'icu_normalizer',
                            'icu_collation'
                        ]
                    ]
                ]
            ]
        ];
    }
}
