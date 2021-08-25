<?php

namespace Modules\Administration\Repositories\Eloquent;

use Modules\Administration\Entities\Role;
use Modules\Administration\Entities\User;
use Modules\Administration\Repositories\Abstracts\PermissionRepositoryAbstract;

class PermissionRepository extends PermissionRepositoryAbstract
{
    /**
     * @param Role $role
     * @param array $permissions
     * @return Role
     */
    public function assignPermissionsToRole(Role $role, array $permissions)
    {
        return $role->givePermissionTo($permissions);
    }

    /**
     * @param Role $role
     * @param array $permissions
     * @return Role
     */
    public function syncPermissionsToRole(Role $role, array $permissions)
    {
        return $role->syncPermissions($permissions);
    }

    /**
     * @param User $user
     * @param array $permissions
     * @return User
     */
    public function assignPermissionsToUser(User $user, array $permissions)
    {
        return $user->givePermissionTo($permissions);
    }

    /**
     * @param User $user
     * @param array $permissions
     * @return User
     */
    public function syncPermissionsToUser(User $user, array $permissions)
    {
        return $user->syncPermissions($permissions);
    }
}
