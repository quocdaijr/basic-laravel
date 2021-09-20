<?php

namespace Modules\Tag\Traits\Relations;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Core\Traits\CoreRelationTrait;
use Modules\Post\Entities\Post;

trait PostRelationTrait
{
    use CoreRelationTrait;

    public function posts(): BelongsToMany
    {
        return $this->registerBelongsToMany(Post::class, 'post_has_tags');
    }

}
