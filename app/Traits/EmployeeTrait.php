<?php
namespace App\Traits;

use Auth;
use Session;
use Validator;
use DateTime;
use Image;
use Storage;

use App\Employee;
use App\Company;

use Illuminate\Http\Request;
use Carbon\Carbon;

trait EmployeeTrait
{
	public function getEmployees ()
	{
        return Employee::with(['company'])->orderBy('id', 'desc')->paginate(10);
	}

	public function validateEmployee($request, $from = 'store', $id = ""){
		if($from == 'store'){
			return Validator::make($request, [
                'first_name' => 'required',
				'last_name' => 'required',
                'email' => 'email|nullable|unique:employees,email',
                'phone' => 'unique:employees,phone',
			]);
		} else {
			return Validator::make($request, [
                'first_name' => 'required',
				'last_name' => 'required',
                'email' => 'email|nullable|unique:employees,email,' . $id,
				'phone' => 'unique:employees,phone,' . $id,
			]);
		}
	}

	public function storeEmployee($request){

		$employee = $request->except(['_token']);

		return Employee::create($employee);
	}

	public function showEmployee($id){
		return Employee::with('company')->where('id', $id)->first();
	}

	public function editEmployee($id){
		return Employee::with('company')->where('id', $id)->first();
	}

	public function updateEmployee($id, $request){

		$employee = $request->except(['_token', '_method']);
		$getEmployee = Employee::where('id', $id)->first();
		return $getEmployee->update($employee);
	}

    public function deleteEmployee($id){
		$employee = Employee::where('id', $id)->first();

        return $employee->delete();
    }

	public function getCompanyList(){
		return Company::orderBy('id', 'desc')->get();
	}

}
