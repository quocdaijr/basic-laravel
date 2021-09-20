<?php

namespace Modules\Post\Traits\Relations;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Core\Traits\CoreRelationTrait;
use Modules\File\Entities\File;

trait FileRelationTrait
{
    use CoreRelationTrait;

    public function files(): BelongsToMany
    {
        return $this->registerBelongsToMany(File::class, 'post_has_files')->withPivot('type');
    }
}
