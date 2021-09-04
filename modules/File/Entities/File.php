<?php

namespace Modules\File\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Core\Entities\CoreEloquent;
use Modules\Post\Entities\Post;

class File extends CoreEloquent
{
    /**
     * @var string
     */
    protected $table = 'files';

    /**
     * @var string[]
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
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
        'raw_path',
        'path',
        'url',
        'where',
        'type',
        'mine_type',
        'size',
        'mtime',
        'options',
        'created_by',
        'updated_by',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'status' => 'integer'
    ];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_has_files');
    }

    public function getUrlAttribute() {
        return !empty($this->url) ? $this->url : getUrlFile($this->path, true);
    }
}
