<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\EmployeeCollection
     */
    public function index(): EmployeeCollection
    {
        // $this->authorize('view-employees');

        return new EmployeeCollection(Employee::with('projects', 'teams', 'leadingTeam', 'skills')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Employee\StoreRequest  $request
     * @return App\Http\Resources\EmployeeResource
     */
    public function store(StoreRequest $request): EmployeeResource
    {
        return $this->employeeResponse(Employee::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  Employee  $employee
     * @return App\Http\Resources\EmployeeResource
     */
    public function show(Employee $employee): EmployeeResource
    {
        return $this->employeeResponse($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Employee\UpdateRequest  $request
     * @param  Employee  $employee
     * @return App\Http\Resources\EmployeeResource
     */
    public function update(UpdateRequest $request, Employee $employee): EmployeeResource
    {
        $employee->update($request->validated());

        return $this->employeeResponse($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->noContent();
    }

    public function employeeResponse(Employee $employee): EmployeeResource
    {
        return new EmployeeResource($employee->load('projects', 'teams', 'leadingTeam', 'skills'));
    }
}
