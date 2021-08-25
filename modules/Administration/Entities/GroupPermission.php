<?php

namespace Modules\Administration\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GroupPermission extends Model
{
    protected $fillable = ['title', 'name', 'guard_name'];

    public function __construct(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? config('auth.defaults.guard');

        parent::__construct($attributes);
    }

    public function getTable()
    {
        return config('permission.table_names.permission_groups', parent::getTable());
    }

    public function permissions(): HasMany
    {
        return $this->hasMany(config('permission.models.permission'));
    }
}
