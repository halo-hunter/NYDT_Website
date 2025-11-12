<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Crm\Attorneys;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttorneysController extends Controller
{
    public function show(Request $request) {
        return view('crm.pages.attorneys.show');
    }

    public function insert(Request $request) {
        if ($request->isMethod('get')) {
            return view('crm.pages.attorneys.insert');
        } elseif ($request->isMethod('post')) {
            $request->flash();
            $validator = Validator::make($request->all(), [
                'firstname' => 'required',
                'lastname' => 'required',
                'company_name' => 'required',
                'company_address_country' => 'required',
                'company_address_state_code' => 'required',
                'company_address_city' => 'required',
                'company_address_zip_code' => 'required',
                'company_address_unit' => 'required',
                'company_address_address' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();
            }
            Attorneys::insert([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'company_name' => $request->company_name,
                'company_address_country' => $request->company_address_country,
                'company_address_state_code' => $request->company_address_state_code,
                'company_address_city' => $request->company_address_city,
                'company_address_zip_code' => $request->company_address_zip_code,
                'company_address_unit' => $request->company_address_unit,
                'company_address_address' => $request->company_address_address,
                'email' => $request->email,
                'phone' => str_replace([' ', '-'], '', $request->phone),
                'fax' => $request->fax,
                'updated_at' => Carbon::now()
            ]);
            return redirect()->route('attorneys->show')->withErrors([
                "attorney_profile_created_successfully" => "attorney profile created successfully"
            ]);
        }
    }

    public function update(Request $request, $id = false) {
        if (Attorneys::where('id', $id)->exists()) {
            if ($request->isMethod('get')) {
                $data = [
                    'id' => $id
                ];
                return view('crm.pages.attorneys.update', $data);
            } elseif ($request->isMethod('post')) {
                $request->flash();
                $validator = Validator::make($request->all(), [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'company_name' => 'required',
                    'company_address_country' => 'required',
                    'company_address_state_code' => 'required',
                    'company_address_city' => 'required',
                    'company_address_zip_code' => 'required',
                    'company_address_unit' => 'required',
                    'company_address_address' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required',
                ]);
                if ($validator->fails()) {
                    return back()->withErrors($validator)
                        ->withInput();
                }
                Attorneys::where('id', $id)->update([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'company_name' => $request->company_name,
                    'company_address_country' => $request->company_address_country,
                    'company_address_state_code' => $request->company_address_state_code,
                    'company_address_city' => $request->company_address_city,
                    'company_address_zip_code' => $request->company_address_zip_code,
                    'company_address_unit' => $request->company_address_unit,
                    'company_address_address' => $request->company_address_address,
                    'email' => $request->email,
                    'phone' => str_replace([' ', '-'], '', $request->phone),
                    'fax' => $request->fax,
                    'updated_at' => Carbon::now()
                ]);
                return back()->withErrors([
                    "attorney_profile_updated_successfully" => "attorney profile updated successfully"
                ]);
            }
        } else {
            return abort(404);
        }
    }

    public function delete(Request $request, $id = false) {
        if (Attorneys::where('id', $id)->exists()) {
            if ($request->isMethod('get')) {
                $data = [
                    'id' => $id
                ];
                return view('crm.pages.attorneys.delete', $data);
            } elseif ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'attorney_id' => 'required',
                ]);
                if ($validator->fails()) {
                    return back()->withErrors($validator)
                        ->withInput();
                }
                Attorneys::where('id', $id)->delete();
                return redirect()->route('attorneys->show')->withErrors([
                    "attorney_profile_deleted_successfully" => "attorney deleted successfully"
                ]);
            }
        } else {
            return abort(404);
        }
    }

}
