<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepartmentRequest;
use App\Models\City;
use App\Models\Department;
use App\Tables\Departments;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.departments.index', [
            'departments' => Departments::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = SpladeForm::make()
                    ->action(route('admin.departments.store'))
                    ->method('POST')
                    ->class('p-4 space-y-3 bg-white border rounded shadow')
                    ->fields([
                        Input::make('name')
                                ->label('Name'),
                        Select::make('city_id')
                                ->options(City::pluck('name', 'id')->toArray())
                                ->label('Choose a City'),
                        Submit::make()
                                ->label('Submit')
                    ]);

        return view('admin.departments.create', [
            'form' => $form
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateDepartmentRequest $request)
    {
        Department::create($request->validated());
        Splade::toast('Department created')->autoDismiss(3);

        return to_route('admin.departments.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $form = SpladeForm::make()
                    ->action(route('admin.departments.update', $department))
                    ->method('PATCH')
                    ->class('p-4 space-y-3 bg-white border rounded shadow')
                    ->fields([
                        Input::make('name')
                                ->label('Name'),
                        Select::make('city_id')
                                ->options(City::pluck('name', 'id')->toArray())
                                ->label('Choose a City'),
                        Submit::make()
                                ->label('Submit')
                    ])->fill($department);

        return view('admin.departments.edit', [
            'form' => $form
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());
        Splade::toast('Department updated')->autoDismiss(3);

        return to_route('admin.departments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        Splade::toast('Department deleted')->autoDismiss(3);

        return to_route('admin.departments.index');
    }
}
