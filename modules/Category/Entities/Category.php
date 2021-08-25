<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Core\Entities\CoreModel;
use Modules\Core\Enums\CoreStatusEnum;

class Category extends CoreModel
{
    use HasFactory;

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
        'parent_id'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'status' => 'integer'
    ];

//    protected static function newFactory()
//    {
//        return \Modules\Category\Database\Factories\CategoryFactory::new();
//    }
}
