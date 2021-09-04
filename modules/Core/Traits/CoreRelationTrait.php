<?php

namespace Modules\Core\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Core\Exceptions\TraitMissingModelException;

trait CoreRelationTrait
{
    public function registerBelongsTo($relationClass, $foreignKey = null, $ownerKey = null, $relation = null): BelongsTo
    {
        if (method_exists($this, 'belongsTo')) {
            return $this->belongsTo($relationClass, $foreignKey, $ownerKey, $relation);
        } else {
            throw new TraitMissingModelException();
        }
    }

    public function registerBelongsToMany($relationClass, $table = null, $foreignPivotKey = null, $relatedPivotKey = null,
                                          $parentKey = null, $relatedKey = null, $relation = null): BelongsToMany
    {
        if (method_exists($this, 'belongsToMany')) {
            return $this->belongsToMany($relationClass, $table, $foreignPivotKey, $relatedPivotKey, $parentKey, $relatedKey, $relation);
        } else {
            throw new TraitMissingModelException();
        }
    }
}
