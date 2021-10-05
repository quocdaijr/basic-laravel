<?php

namespace Modules\Administration\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Administration\Http\Requests\CreateUserRequest;
use Modules\Administration\Http\Requests\UpdateUserRequest;
use Modules\Core\Constants\CoreConstant;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Administration\Repositories\Interfaces\UserRepositoryInterface;
use Modules\Administration\Repositories\Interfaces\PermissionRepositoryInterface;
use Modules\Administration\Repositories\Interfaces\RoleRepositoryInterface;

class UserController extends CoreController
{

    public function __construct(
        protected UserRepositoryInterface       $userRepository,
        protected RoleRepositoryInterface       $roleRepository,
        protected PermissionRepositoryInterface $permissionRepository
    )
    {
        return parent::__construct();
    }

    /**
     * Display a listing of the resource.
     * @return Application|Factory|View
     */
    public function index()
    {
        $users = $this->userRepository->pagination(CoreConstant::PER_PAGE_DEFAULT);
        return view('administration::user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|View
     */
    public function create()
    {
        $roles = $this->roleRepository->all();
        $permissions = $this->permissionRepository->all();
        return view('administration::user.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateUserRequest $request
     * @return RedirectResponse
     */
    public function store(CreateUserRequest $request)
    {
        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'status' => $request->status,
            'profile_full_name' => $request->profile_full_name ?? null,
            'profile_gender' => $request->profile_gender ?? null,
            'profile_birthday' => $request->profile_birthday ?? null,
            'profile_address' => $request->profile_address ?? null,
            'profile_photo_path' => $request->profile_photo_path ?? null,
        ];

        $user = $this->userRepository->create($data);

        if (!empty($request->roles))
            $this->roleRepository->assignRolesToUser($user, (array)$request->roles);

        if (!empty($request->permissions))
            $this->permissionRepository->assignPermissionsToUser($user, (array)$request->permissions);

        return redirect()->route('administration.user.index')->with('success', 'Create success');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Application|Factory|View|void
     */
    public function show(int $id)
    {
        if (!empty($user = $this->userRepository->find($id))) {
            return view('administration::user.show', compact('user'));
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
        if (!empty($user = $this->userRepository->find($id))) {
            $roles = $this->roleRepository->all();
            $permissions = $this->permissionRepository->all();

            $userHasRoles = array_column(json_decode($user->roles, true), 'id');
            $userHasPermission = array_column(json_decode($user->permissions, true), 'id');

            return view('administration::user.edit', compact('user', 'roles', 'permissions', 'userHasRoles', 'userHasPermission'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateUserRequest $request
     * @param int $id
     * @return RedirectResponse|void
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        if (!empty($user = $this->userRepository->find($id))) {
            $data = [
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => $request->status,
                'profile_full_name' => $request->profile_full_name ?? null,
                'profile_gender' => $request->profile_gender ?? null,
                'profile_birthday' => $request->profile_birthday ?? null,
                'profile_address' => $request->profile_address ?? null,
                'profile_photo_path' => $request->profile_photo_path ?? null,
            ];

            if (!empty($request->password))
                $data['password'] = $request->password;

            $this->userRepository->update($id, $data);

            $this->roleRepository->syncRolesToUser($user, $request->roles ?? []);
            $this->permissionRepository->syncPermissionsToUser($user, $request->permissions ?? []);

            return redirect()->route('administration.user.index')->with('success', 'Update success');
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse|void
     */
    public function destroy(int $id)
    {
        if ($this->userRepository->find($id)) {
            $this->userRepository->update($id, [
                'status' => CoreConstant::STATUS_DELETED
            ]);
            return redirect()->route('administration.user.index')->with('success', 'Delete success');
        }
        abort(404);
    }
}
