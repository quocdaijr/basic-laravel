<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Category\Entities\Category;
use Modules\Core\Entities\CoreEloquent;
use Modules\File\Entities\File;
use Modules\Post\Traits\Relations\CategoryRelationTrait;
use Modules\Post\Traits\Relations\FileRelationTrait;
use Modules\Post\Traits\Relations\TagRelationTrait;
use Modules\Tag\Entities\Tag;

class Post extends CoreEloquent
{
    use FileRelationTrait, CategoryRelationTrait, TagRelationTrait;

    public $thumbnail;

    public $cover;
    /**
     * @var string
     */
    protected $table = 'posts';

    /**
     * @var string[]
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'published_at',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'title',
        'slug',
        'description',
        'status',
        'content',
        'source',
        'author',
        'location',
        'published_at',
        'created_by',
        'updated_by',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'status' => 'integer'
    ];
}
