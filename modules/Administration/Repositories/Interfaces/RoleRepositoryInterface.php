<?php

namespace Modules\Administration\Repositories\Interfaces;

use Modules\Administration\Entities\User;
use Modules\Core\Repositories\Interfaces\RepositoryInterface;

interface RoleRepositoryInterface extends RepositoryInterface
{
    /**
     * @param User $user
     * @param array $roles
     * @return mixed
     */
    public function assignRolesToUser(User $user, array $roles);

    /**
     * @param User $user
     * @param array $roles
     * @return mixed
     */
    public function syncRolesToUser(User $user, array $roles);
}
