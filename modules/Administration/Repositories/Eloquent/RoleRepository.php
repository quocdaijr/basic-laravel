<?php

namespace Modules\Administration\Repositories\Eloquent;

use Modules\Administration\Entities\User;
use Modules\Administration\Repositories\Abstracts\RoleRepositoryAbstract;

/**
 *
 */
class RoleRepository extends RoleRepositoryAbstract
{
    /**
     * @param User $user
     * @param array $roles
     * @return User
     */
    public function assignRolesToUser(User $user, array $roles)
    {
        return $user->assignRole($roles);
    }

    /**
     * @param User $user
     * @param array $roles
     * @return User
     */
    public function syncRolesToUser(User $user, array $roles)
    {
        return $user->syncRoles($roles);
    }
}
