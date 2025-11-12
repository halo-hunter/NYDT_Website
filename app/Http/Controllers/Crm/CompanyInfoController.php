<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Crm\Attorneys;
use App\Models\Crm\CompanyInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CompanyInfoController extends Controller
{
    public function show(Request $request) {
        if ($request->isMethod('get')) {
            return view('crm.pages.company_info.show');
        } elseif ($request->isMethod('post')) {
            $request->flash();
            $validator = Validator::make($request->all(), [
                'company_name' => 'required',
                'logo' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();
            }
            if ($request->logo != '') {
                if (CompanyInfo::first()->logo != '') {
                    File::delete('images/logo/' . CompanyInfo::first()->logo);
                }
                $imageName = time().'.'.$request->logo->extension();
                $request->logo->move(public_path('images/logo'), $imageName);
            } else {
                $imageName = CompanyInfo::first()->logo;
            }
            CompanyInfo::truncate();
            CompanyInfo::insert([
                'company_name' => $request->company_name,
                'company_address_country' => $request->company_address_country,
                'company_address_state_code' => $request->company_address_state_code,
                'company_address_city' => $request->company_address_city,
                'company_address_zip_code' => $request->company_address_zip_code,
                'company_address_unit' => $request->company_address_unit,
                'company_address_address_1' => $request->company_address_address_1,
                'company_address_address_2' => $request->company_address_address_2,
                'email' => $request->email,
                'phone' => str_replace([' ', '-'], '', $request->phone),
                'fax' => $request->fax,
                'logo' => $imageName,
                'updated_at' => Carbon::now()
            ]);
            return back()->with("company_info_has_saved_successfully", "company info has saved successfully");
        }
    }
}
