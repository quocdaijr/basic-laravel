<?php

namespace Modules\Administration\Traits;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Modules\Administration\Repositories\Interfaces\GroupPermissionRepositoryInterface;
use Modules\Administration\Repositories\Interfaces\PermissionRepositoryInterface;
use Modules\Core\Constants\CoreConstant;
use Nwidart\Modules\Contracts\RepositoryInterface;
use Route;

trait PermissionTrait
{
    /**
     * @return RedirectResponse
     */
    public function syncPermissionFromConfigFiles()
    {
        $group_permissions = $this->getAllAvailPermission();
        foreach ($group_permissions as $group_permission) {
            $data_group_permission = $this->groupPermissionRepository()->updateOrCreate(
                [
                    'name' => $group_permission['group_name']
                ],
                [
                    'title' => $group_permission['group_title'],
                    'name' => $group_permission['group_name'],
                ]);
            foreach ($group_permission['permissions'] as $permission) {
                $this->permissionRepository()->updateOrCreate(
                    [
                        'name' => $permission['name']
                    ],
                    [
                        'name' => $permission['name'],
                        'title' => $permission['title'],
                        'group_id' => $data_group_permission->id
                    ],
                );
            }
        }

        return $this->redirectAfterSync();
    }

    /**
     * @return RedirectResponse
     */
    public function redirectAfterSync()
    {
        return back();
    }

    /**
     * @return Application|mixed|PermissionRepositoryInterface
     */
    public function permissionRepository()
    {
        return app(PermissionRepositoryInterface::class);
    }

    /**
     * @return Application|mixed|PermissionRepositoryInterface
     */
    public function groupPermissionRepository()
    {
        return app(GroupPermissionRepositoryInterface::class);
    }

    /**
     * @return array|Repository|Application
     */
    public function getAllAvailPermission()
    {
        $group_permissions = [];
        foreach ($this->modules()->allEnabled() as $enabledModule) {
            $configuration = config(CoreConstant::MODULE_NAME . '.' . strtolower($enabledModule->getName()) . '.permissions');
            if ($configuration) {
                $group_permissions = array_merge($group_permissions, $configuration);
            }
        }

        return $group_permissions;
    }

    /**
     * @return RepositoryInterface
     */
    public function modules()
    {
        return app('modules');
    }
}
