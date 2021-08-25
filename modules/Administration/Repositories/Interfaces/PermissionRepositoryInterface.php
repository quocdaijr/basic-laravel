<?php

namespace Modules\Administration\Repositories\Interfaces;

use Modules\Administration\Entities\Role;
use Modules\Administration\Entities\User;
use Modules\Core\Repositories\Interfaces\RepositoryInterface;

interface PermissionRepositoryInterface extends RepositoryInterface
{
    /**
     * @param Role $role
     * @param array $permissions
     * @return mixed
     */
    public function assignPermissionsToRole(Role $role, array $permissions);

    /**
     * @param Role $role
     * @param array $permissions
     * @return mixed
     */
    public function syncPermissionsToRole(Role $role, array $permissions);

    /**
     * @param User $user
     * @param array $permissions
     * @return mixed
     */
    public function assignPermissionsToUser(User $user, array $permissions);

    /**
     * @param User $user
     * @param array $permissions
     * @return mixed
     */
    public function syncPermissionsToUser(User $user, array $permissions);
}
