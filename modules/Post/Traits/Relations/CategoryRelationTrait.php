<?php

namespace Modules\Post\Traits\Relations;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Category\Entities\Category;
use Modules\Core\Traits\CoreRelationTrait;

trait CategoryRelationTrait
{
    use CoreRelationTrait;

    public function categories(): BelongsToMany
    {
        return $this->registerBelongsToMany(Category::class, 'post_has_categories');
    }
}
