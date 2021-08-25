<?php

namespace Modules\Administration\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    public function groupPermission(): BelongsTo
    {
        return $this->belongsTo(GroupPermission::class, 'group_id');
    }
}
