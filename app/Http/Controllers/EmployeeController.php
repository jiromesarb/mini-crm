<?php

namespace App\Http\Controllers;

use App\Traits\EmployeeTrait;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use EmployeeTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->getEmployees();
        return view('pages.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = $this->getCompanyList();

        return view('pages.employee.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Request
        $v = $this->validateEmployee($request->all());
		if ($v->fails()) return back()->withInput()->withErrors($v->errors());

        // Store Employee
        if ($this->storeEmployee($request)) {
            return back()->with([
                'notif.style' => 'success',
                'notif.icon' => 'plus-circle',
                'notif.message' => 'Insert successfully!',
            ]);
        }
        else {
            return back()->withInput()->with([
                'notif.style' => 'danger',
                'notif.icon' => 'times-circle',
                'notif.message' => 'Failed to Insert',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = $this->showEmployee($id);

        return view('pages.employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = $this->editEmployee($id);
        $companies = $this->getCompanyList();

        return view('pages.employee.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate Request
        $v = $this->validateEmployee($request->all(), 'update', $id);
		if ($v->fails()) return back()->withInput()->withErrors($v->errors());

        // Update Company
        if ($this->updateEmployee($id, $request)) {
            return back()->with([
                'notif.style' => 'success',
                'notif.icon' => 'plus-circle',
                'notif.message' => 'Updated successfully!',
            ]);
        }
        else {
            return back()->withInput()->with([
                'notif.style' => 'danger',
                'notif.icon' => 'times-circle',
                'notif.message' => 'Failed to Insert',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->deleteEmployee($id)) {
            return back()->with([
                'notif.style' => 'success',
                'notif.icon' => 'plus-circle',
                'notif.message' => 'Deleted successful!',
            ]);
        }
        else {
            return back()->with([
                'notif.style' => 'danger',
                'notif.icon' => 'times-circle',
                'notif.message' => 'Failed to Delete',
            ]);
        }
    }
}
