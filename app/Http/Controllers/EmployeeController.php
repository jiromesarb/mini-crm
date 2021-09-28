<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Validator;
use DateTime;
use Image;
use Storage;

use App\Company;
use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with(['company'])->orderBy('id', 'desc')->paginate(10);
        return view('pages.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::orderBy('id', 'desc')->get();

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
        $v = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|nullable|unique:employees,email',
            'phone' => 'unique:employees,phone',
        ]);
		if ($v->fails()) return back()->withInput()->withErrors($v->errors());

        $employee = $request->except(['_token']);

        // Store Employee
        if (Employee::create($employee)) {
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
        $employee = Employee::with('company')->where('id', $id)->first();

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
        $employee = Employee::with('company')->where('id', $id)->first();
        $companies = Company::orderBy('id', 'desc')->get();

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
        $v = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|nullable|unique:employees,email,' . $id,
            'phone' => 'unique:employees,phone,' . $id,
        ]);
		if ($v->fails()) return back()->withInput()->withErrors($v->errors());

        $employee = $request->except(['_token', '_method']);
        $getEmployee = Employee::where('id', $id)->first();

        // Update Company
        if ($getEmployee->update($employee)) {
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
        $employee = Employee::where('id', $id)->first();
        if ($employee->delete()) {
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
