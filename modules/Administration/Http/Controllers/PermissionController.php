<?php

namespace Modules\Administration\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Modules\Administration\Http\Requests\CreatePermissionRequest;
use Modules\Administration\Http\Requests\UpdatePermissionRequest;
use Modules\Administration\Repositories\Interfaces\GroupPermissionRepositoryInterface;
use Modules\Administration\Repositories\Interfaces\PermissionRepositoryInterface;
use Modules\Administration\Traits\PermissionTrait;
use Modules\Core\Http\Controllers\CoreController;

class PermissionController extends CoreController
{
    use PermissionTrait;

    public function __construct(
        protected PermissionRepositoryInterface      $permissionRepository,
        protected GroupPermissionRepositoryInterface $groupPermissionRepository
    )
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     * @return Application|Factory|View
     */
    public function index()
    {
        $permissions = $this->permissionRepository->all();
        return view('administration::permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|View
     */
    public function create()
    {
        $groupPermission = $this->groupPermissionRepository->all();
        return view('administration::permission.create', compact('groupPermission'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CreatePermissionRequest $request
     * @return mixed
     */
    public function store(CreatePermissionRequest $request)
    {
        $this->permissionRepository->create([
            'name' => $request->name,
            'title' => $request->title,
            'group_id' => $request->group_id
        ]);

        return redirect()->route('administration.permission.index')->withToastSuccess('Create success');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Application|Factory|View|void
     */
    public function show(int $id)
    {
        if (!empty($permission = $this->permissionRepository->find($id))) {
            return view('administration::permission.show', compact('permission'));
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Application|Factory|View|void
     */
    public function edit(int $id)
    {
        $groupPermission = $this->groupPermissionRepository->all();

        if ($permission = $this->permissionRepository->find($id)) {
            return view('administration::permission.edit', compact('permission', 'groupPermission'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdatePermissionRequest $request
     * @param int $id
     * @return void
     */
    public function update(UpdatePermissionRequest $request, int $id)
    {
        if ($this->permissionRepository->find($id)) {
            $this->permissionRepository->update($id, [
                'name' => $request->name,
                'title' => $request->title,
                'group_id' => $request->group_id
            ]);

            return redirect()->route('administration.permission.index')->withToastSuccess('Update success');
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return void
     */
    public function destroy(int $id)
    {
        if ($this->permissionRepository->find($id)) {
            $this->permissionRepository->delete($id);
            return redirect()->route('administration.permission.index')->withToastSuccess('Delete success');
        }
        abort(404);
    }
}
