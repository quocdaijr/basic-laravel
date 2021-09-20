<?php

namespace Modules\Tag\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Core\Entities\CoreEloquent;
use Modules\Post\Entities\Post;
use Modules\Tag\Traits\Relations\PostRelationTrait;

class Tag extends CoreEloquent
{
    use PostRelationTrait;

    /**
     * @var string
     */
    protected $table = 'tags';

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
