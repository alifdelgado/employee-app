<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Tables\Roles;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;
use Spatie\Permission\Models\Role;
use Splade;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.roles.index', [
            'roles' => Roles::class
        ]);
    }

    public function create()
    {
        $form = SpladeForm::make()
                    ->action(route('admin.roles.store'))
                    ->method('POST')
                    ->class('p-4 space-y-3 bg-white border rounded shadow')
                    ->fields([
                        Input::make('name')
                                ->label('Name'),
                        Submit::make()
                                ->label('Submit')
                    ]);

        return view('admin.roles.create', [
            'form' => $form
        ]);
    }

    public function store(CreateRoleRequest $request)
    {
        Role::create($request->validated());
        Splade::toast('Role created')->autoDismiss(3);

        return to_route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        $form = SpladeForm::make()
                    ->action(route('admin.roles.update', $role))
                    ->method('PATCH')
                    ->class('p-4 space-y-3 bg-white border rounded shadow')
                    ->fields([
                        Input::make('name')
                                ->label('Name'),
                        Submit::make()
                                ->label('Submit')
                    ])->fill($role);

        return view('admin.roles.edit', [
            'form' => $form
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        Splade::toast('Role updated')->autoDismiss(3);

        return to_route('admin.roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        Splade::toast('Role deleted')->autoDismiss(3);

        return to_route('admin.roles.index');
    }
}
