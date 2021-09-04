<?php

namespace Modules\Category\Entities;

use Modules\Category\Traits\Relations\FileRelationTrait;
use Modules\Category\Traits\Relations\PostRelationTrait;
use Modules\Core\Entities\CoreEloquent;

class Category extends CoreEloquent
{
    use PostRelationTrait;
    use FileRelationTrait;

    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var string[]
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'parent_id',
        'thumbnail',
        'cover',
        'created_by',
        'updated_by'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'status' => 'integer'
    ];
}
