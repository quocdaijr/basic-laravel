<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Category\Entities\Category;
use Modules\Core\Entities\CoreEloquent;
use Modules\File\Entities\File;
use Modules\Tag\Entities\Tag;

class Post extends CoreEloquent
{
    public $thumbnail;
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

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_has_categories');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_has_tags');
    }

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class, 'post_has_files')->withPivot('type');
    }
}
