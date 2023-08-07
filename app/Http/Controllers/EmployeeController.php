<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Models\City;
use App\Models\Department;
use App\Models\Employee;
use App\Tables\Employees;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Date;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.employees.index', [
            'employees' => Employees::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = SpladeForm::make()
                    ->action(route('admin.employees.store'))
                    ->method('POST')
                    ->class('p-4 space-y-3 bg-white border rounded shadow')
                    ->fields([
                        Input::make('first_name')
                                ->label('First Name'),
                        Input::make('last_name')
                                ->label('Last Name'),
                        Input::make('middle_name')
                                ->label('Middle Name'),
                        Input::make('zip_code')
                                ->label('Zip code'),
                        Date::make('birth_date')
                                ->label('Birth Date'),
                        Date::make('date_hired')
                                ->label('Date Hired'),
                        Select::make('city_id')
                                ->options(City::pluck('name', 'id')->toArray())
                                ->label('Choose a City'),
                        Select::make('department_id')
                                ->options(Department::pluck('name', 'id')->toArray())
                                ->label('Choose a Department'),
                        Submit::make()
                                ->label('Submit')
                    ]);

        return view('admin.employees.create', [
            'form' => $form
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEmployeeRequest $request)
    {
        $city = City::findOrFail($request->city_id);
        $department = Department::findOrFail($request->department_id);
        Employee::create(array_merge($request->validated(), [
            'city_id' => $city->id,
            'department_id' => $department->id
        ]));
        Splade::toast('Employee created')->autoDismiss(3);

        return to_route('admin.employees.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $form = SpladeForm::make()
                    ->action(route('admin.employees.update', $employee))
                    ->method('PATCH')
                    ->class('p-4 space-y-3 bg-white border rounded shadow')
                    ->fields([
                        Input::make('first_name')
                                ->label('First Name'),
                        Input::make('last_name')
                                ->label('Last Name'),
                        Input::make('middle_name')
                                ->label('Middle Name'),
                        Input::make('zip_code')
                                ->label('Zip code'),
                        Date::make('birth_date')
                                ->label('Birth Date'),
                        Date::make('date_hired')
                                ->label('Date Hired'),
                        Select::make('city_id')
                                ->options(City::pluck('name', 'id')->toArray())
                                ->label('Choose a City'),
                        Select::make('department_id')
                                ->options(Department::pluck('name', 'id')->toArray())
                                ->label('Choose a Department'),
                        Submit::make()
                                ->label('Submit')
                    ])->fill($employee);

        return view('admin.employees.edit', [
            'form' => $form
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateEmployeeRequest $request, Employee $employee)
    {
        $city = City::findOrFail($request->city_id);
        $department = Department::findOrFail($request->department_id);
        $employee->update(array_merge($request->validated(), [
            'city_id' => $city->id,
            'department_id' => $department->id
        ]));
        Splade::toast('Employee updated')->autoDismiss(3);

        return to_route('admin.employees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        Splade::toast('Employee deleted')->autoDismiss(3);

        return to_route('admin.employees.index');
    }
}
