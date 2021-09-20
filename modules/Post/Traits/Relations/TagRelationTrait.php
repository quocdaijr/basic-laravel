<?php

namespace Modules\Post\Traits\Relations;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Core\Traits\CoreRelationTrait;
use Modules\Tag\Entities\Tag;

trait TagRelationTrait
{
    use CoreRelationTrait;

    public function tags(): BelongsToMany
    {
        return $this->registerBelongsToMany(Tag::class, 'post_has_tags');
    }
}
