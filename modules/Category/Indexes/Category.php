<?php

namespace Modules\Category\Indexes;

use Modules\Core\Indexes\CoreIndex;

class Category extends CoreIndex
{
    /**
     *
     */
    public function __construct()
    {
        return parent::__construct('id');
    }

    /**
     * @return string
     */
    public function index(): string
    {
        return 'categories';
    }

    /**
     * @return array
     */
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
            'status' => [
                'type' => 'integer'
            ],
            'thumbnail' => [
                'type' => 'keyword'
            ],
            'cover' => [
                'type' => 'keyword'
            ],
            'created_at' => [
                'type' => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss'
            ],
            'updated_at' => [
                'type' => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss'
            ]
        ];
    }

    /**
     * @return array
     */
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
