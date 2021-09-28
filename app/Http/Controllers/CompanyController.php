<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Validator;
use DateTime;
use Image;
use Storage;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::with(['employees'])->orderBy('id', 'desc')->paginate(10);
        return view('pages.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.company.create');
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
            'name' => 'required|unique:companies,name',
            'email' => 'email|nullable|unique:companies,email',
            'logo' => 'mimes:jpeg,jpg,png,gif|min:100|dimensions:min_width=250,min_height=500',
        ]);
		if ($v->fails()) return back()->withInput()->withErrors($v->errors());

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

        // Store Company
        if (Company::create($company)) {
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
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::where('id', $id)->first();
        return view('pages.company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::where('id', $id)->first();
        return view('pages.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate Request
        $v = Validator::make($request->all(), [
            'name' => 'required|unique:companies,name,' . $id,
            'email' => 'email|nullable|unique:companies,email,' . $id,
            'logo' => 'mimes:jpeg,jpg,png,gif|min:100|dimensions:min_width=250,min_height=500',
        ]);
		if ($v->fails()) return back()->withInput()->withErrors($v->errors());

        $getCompany = Company::where('id', $id)->first();
        $company = $request->except(['_token', '_method', 'logo']);

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

        // Update Company
        if ($getCompany->update($company)) {
            return back()->with([
                'notif.style' => 'success',
                'notif.icon' => 'plus-circle',
                'notif.message' => 'Update successfully!',
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
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::where('id', $id)->first();

		// Delete Company Logo
		if(!empty($company->logo)) {
			$unlink_resume = Storage::disk('public')->exists($company->logo);
			if($unlink_resume){
				Storage::disk('public')->delete($company->logo);
			}
		}

        if ($company->delete()) {
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
