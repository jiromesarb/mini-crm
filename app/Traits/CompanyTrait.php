<?php
namespace App\Traits;

use Auth;
use Session;
use Validator;
use DateTime;
use Image;
use Storage;

use App\Company;

use Illuminate\Http\Request;
use Carbon\Carbon;

trait CompanyTrait
{
	public function getCompanies ()
	{
        return Company::with(['employees'])->orderBy('id', 'desc')->paginate(10);
	}

	public function validateCompany($request, $from = 'store', $id = ""){
		if($from == 'store'){
			return Validator::make($request, [
				'name' => 'required|unique:companies,name',
				'email' => 'email|nullable|unique:companies,email',
				'logo' => 'mimes:jpeg,jpg,png,gif|min:100|dimensions:min_width=250,min_height=500',
			]);
		} else {
			return Validator::make($request, [
				'name' => 'required|unique:companies,name,' . $id,
				'email' => 'email|nullable|unique:companies,email,' . $id,
				'logo' => 'mimes:jpeg,jpg,png,gif|min:100|dimensions:min_width=250,min_height=500',
			]);
		}
	}

	public function storeCompany($request){

		$company = $request->except(['_token', 'logo']);

		// Save the logo
		if($request->hasFile('logo')) {
            $image = $request->file('logo');
			$orig_name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME); // Get original name without file extension
            $fileName = $orig_name . '_' . time() . '.' . $image->getClientOriginalExtension(); // add unique string to file name
            $img = Image::make($image->getRealPath());
            $img->stream(); // <-- Key point

            Storage::disk('local')->put('public/' . $fileName, $img, 'public'); // Store the logo here
			$company['logo'] = $fileName;
		}

		return Company::create($company);
	}

	public function showCompany($id){
		return Company::where('id', $id)->first();
	}

	public function editCompany($id){
		return Company::where('id', $id)->first();
	}

	public function updateCompany($id, $request){

		$company = $request->except(['_token', '_method', 'logo']);
		$getCompany = Company::where('id', $id)->first();

		// Update the logo
		if($request->hasFile('logo')) {
            $image = $request->file('logo');
			$orig_name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME); // Get original name without file extension
            $fileName = $orig_name . '_' . time() . '.' . $image->getClientOriginalExtension(); // add unique string to file name
            $img = Image::make($image->getRealPath());
            $img->stream(); // <-- Key point

			Storage::disk('local')->put('public/' . $fileName, $img, 'public'); // Store logo here
			$company['logo'] = $fileName;

			// Remove old logo
            if(!empty($getCompany->logo)) {
				$unlink_resume = Storage::disk('public')->exists($getCompany->logo);
                if($unlink_resume){
                    Storage::disk('public')->delete($getCompany->logo);
                }
            }
		}

		return $getCompany->update($company);
	}

    public function deleteCompany($id){
		$company = Company::where('id', $id)->first();

		// Delete Company Logo
		if(!empty($company->logo)) {
			$unlink_resume = Storage::disk('public')->exists($company->logo);
			if($unlink_resume){
				Storage::disk('public')->delete($company->logo);
			}
		}

        return $company->delete();
    }

}
