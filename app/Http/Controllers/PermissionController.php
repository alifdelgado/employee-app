<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Tables\Permissions;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Splade;

class PermissionController extends Controller
{
    public function index()
    {
        return view('admin.permissions.index', [
            'permissions' => Permissions::class
        ]);
    }

    public function create()
    {
        return view('admin.permissions.create', [
            'roles' => Role::pluck('name', 'id')->toArray()
        ]);
    }

    public function store(CreatePermissionRequest $request)
    {
        $permission = Permission::create($request->validated());
        $permission->syncRoles($request->roles);
        Splade::toast('Permission created')->autoDismiss(3);

        return to_route('admin.permissions.index');
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', [
            'permission' => $permission,
            'roles' => Role::pluck('name', 'id')->toArray(),
        ]);
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->validated());
        $permission->syncRoles($request->roles);
        Splade::toast('Permission updated')->autoDismiss(3);

        return to_route('admin.permissions.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        Splade::toast('Permission deleted')->autoDismiss(3);

        return to_route('admin.permissions.index');
    }
}
