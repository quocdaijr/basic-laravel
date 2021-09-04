<?php

namespace Modules\Category\Traits\Relations;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Post\Entities\Post;

trait PostRelationTrait
{
    public function posts(): BelongsToMany
    {
        return $this->registerBelongsToMany(Post::class, 'post_has_categories');
    }
}
