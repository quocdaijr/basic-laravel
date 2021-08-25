<?php

namespace Modules\Administration\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Modules\Administration\Http\Requests\CreateRoleRequest;
use Modules\Administration\Http\Requests\UpdateRoleRequest;
use Modules\Administration\Repositories\Interfaces\PermissionRepositoryInterface;
use Modules\Administration\Repositories\Interfaces\RoleRepositoryInterface;
use Modules\Core\Http\Controllers\CoreController;

class RoleController extends CoreController
{
    /**
     * @param RoleRepositoryInterface $roleRepository
     * @param PermissionRepositoryInterface $permissionRepository
     */
    public function __construct(
        protected RoleRepositoryInterface       $roleRepository,
        protected PermissionRepositoryInterface $permissionRepository
    )
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $roles = $this->roleRepository->pagination();
        return view('administration::role.index', compact('roles'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $permissions = $this->permissionRepository->all();

        return view('administration::role.create', compact('permissions'));
    }

    /**
     * @param CreateRoleRequest $request
     * @return mixed
     */
    public function store(CreateRoleRequest $request)
    {
        $role = $this->roleRepository->create([
            'name' => $request->name,
            'title' => $request->title
        ]);

        if (!empty($request->permissions))
            $this->permissionRepository->assignPermissionsToRole($role, $request->permissions);

        return redirect()->route('administration.role.index')->withToastSuccess('Create success');
    }

    /**
     * @param int $id
     * @return Application|Factory|View|void
     */
    public function edit($id)
    {
        if ($role = $this->roleRepository->one($id)) {
            $permissions = $this->permissionRepository->all();
            $roleHasPermissions = array_column(json_decode($role->permissions, true), 'id');

            return view('administration::role.edit', compact('role', 'permissions', 'roleHasPermissions'));
        }
        abort(404);
    }

    /**
     * @param int $id
     * @param UpdateRoleRequest $request
     * @return void
     */
    public function update(int $id, UpdateRoleRequest $request)
    {
        if ($role = $this->roleRepository->one($id)) {
            $this->roleRepository->update($id, [
                'name' => $request->name,
                'title' => $request->title
            ]);

            $this->permissionRepository->syncPermissionsToRole($role, $request->permissions ?? []);

            return redirect()->route('administration.role.index')->withToastSuccess('Update success');
        }
        abort(404);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id)
    {
        if ($this->roleRepository->one($id)) {
            $this->roleRepository->delete($id);
            return redirect()->route('administration.role.index')->withToastSuccess('Delete success');
        }
        abort(404);
    }
}
