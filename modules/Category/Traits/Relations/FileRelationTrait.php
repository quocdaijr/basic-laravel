<?php

namespace Modules\Category\Traits\Relations;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Core\Exceptions\TraitMissingModelException;
use Modules\Core\Traits\CoreRelationTrait;
use Modules\File\Entities\File;

trait FileRelationTrait
{
    use CoreRelationTrait;

    public function coverDetail(): BelongsTo
    {
       return $this->registerBelongsTo(File::class, 'cover');

    }

    public function thumbnailDetail(): BelongsTo
    {
        return $this->registerBelongsTo(File::class, 'thumbnail');
    }
}
