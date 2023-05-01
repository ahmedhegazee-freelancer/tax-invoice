<?php

namespace Modules\Users\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Users\Entities\Role;
use Modules\Users\Http\Requests\Admin\RoleRequest;
use Modules\Users\Services\UserService;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $roles = (new UserService)->getRoles()->paginate(15);
        return Inertia::render('Roles/Index', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $permissions = (new UserService)->getPermissions();
        return Inertia::render('Roles/Create', [
            'permissions' => $permissions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create(['name' => $request->get('name'), 'guard_name' => 'web']);
        $role->syncPermissions($request->get('permissions'));
        return success_add('role.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Role $role)
    {
        $role->load('permissions');
        $role->formatted_permissions = $role->permissions->map(fn ($permission) => ['id' => $permission->id])->keyBy('id');
        unset($role->permissions);
        $permissions = (new UserService)->getPermissions();
        return Inertia::render('Roles/Edit', [
            'permissions' => $permissions,
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->update(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permissions'));
        return success_update('role.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return success_delete('role.index');
    }
}