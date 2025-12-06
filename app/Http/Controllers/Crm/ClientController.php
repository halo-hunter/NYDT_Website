<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Crm\Client;
use App\Models\Crm\Customers;
use App\Models\Crm\EmailSettings;
use App\Models\Crm\EmploymentWithinLastFiveYears;
use App\Models\Crm\FamilyMember;
use App\Models\Crm\Relation;
use App\Models\Crm\ResidencyWithinFiveYears;
use App\Models\Crm\Rider;
use App\Services\ClientInvitationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function show() {
        return view('crm.pages.clients.show');
    }

    public function insert(Request $request) {

        if ($request->isMethod('get')) {

            return view('crm.pages.clients.insert');

        } elseif ($request->isMethod('post')) {

            $request->flash();

            $validator = Validator::make($request->all(), [
                'profile_photo' => 'nullable|mimes:jpeg,jpg,png|max:25000',
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'nullable|email|unique:clients,email',
                'phone' => 'required|min:10',
                'phone_secondary' => 'nullable|min:10',
                'address_zip_code' => 'nullable|numeric',
            ], [
                'phone.min' => 'Enter correct phone number',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();
            }

            if ($request->profile_photo != null) {
                $fileName = Str::uuid()->toString().'.'.$request->profile_photo->extension();
                Storage::disk('local')->putFileAs('protected/profile_photos', $request->profile_photo, $fileName);
            } else {
                $fileName = NULL;
            }

            $client_id = Client::insertGetId([
                'firstname' => Str::lower($request->firstname),
                'lastname' => Str::lower($request->lastname),
                'dob' => $request->dob,
                'a_number' => Str::lower($request->a_number),
                'email' => Str::lower($request->email),
                'phone' => preg_replace("/[^0-9]/", "", $request->phone),
                'phone_secondary' => preg_replace("/[^0-9]/", "", $request->phone_secondary),
                'social_security' => Str::lower($request->social_security),
                'address_country' => Str::upper($request->address_country),
                'address_state_code' => Str::upper($request->address_state_code),
                'address_city' => Str::lower($request->address_city),
                'address_zip_code' => $request->address_zip_code,
                'address_unit' => Str::lower($request->address_unit),
                'address_address' => Str::lower($request->address_address),
                'profile_photo' => $fileName,
                'marital_status' => $request->marital_status,
                'password_status' => $request->email ? 'pending' : 'missing_email',

                'education__name_of_school' => $request->education__name_of_school,
                'education__type_of_school' => $request->education__type_of_school,
                'education__location' => $request->education__location,
                'education__major' => $request->education__major,
                'education__from' => $request->education__from,
                'education__to' => $request->education__to,

                'last_address_o_t_c_o_y_o__number_and_street' => $request->last_address_of_the_country_of_your_origin__number_and_street,
                'last_address_o_t_c_o_y_o__city_town' => $request->last_address_of_the_country_of_your_origin__city_town,
                'last_address_o_t_c_o_y_o__department_province_or_state' => $request->last_address_of_the_country_of_your_origin__department_province_or_state,
                'last_address_o_t_c_o_y_o__country_id' => $request->last_address_of_the_country_of_your_origin__country_id,
                'last_address_o_t_c_o_y_o__from' => $request->last_address_of_the_country_of_your_origin__from,
                'last_address_o_t_c_o_y_o__to' => $request->last_address_of_the_country_of_your_origin__to,

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            if ($request->country_of_citizenship != null && count($request->country_of_citizenship) > 0) {

                $client = Client::find($client_id);

                foreach ($request->country_of_citizenship as $country_id) {

                    $client->country_of_citizenship()->attach($country_id);

                }

            }

            if ($request->country_of_lawful_status != null && count($request->country_of_lawful_status) > 0) {

                $client = Client::find($client_id);

                foreach ($request->country_of_lawful_status as $country_id) {

                    $client->country_of_lawful_status()->attach($country_id);

                }

            }

            if ($request->email != '') {
                $client = Client::find($client_id);
                $client->update([
                    'password' => null,
                    'password_status' => 'pending',
                ]);
                ClientInvitationService::send($client);
            }

//            if ($client_id != '') {
//                $client = Client::find($client_id);
//
//                if ($request->family_member[0]['relation'] != null && $request->family_member[1]['first_name'] != null && $request->family_member[2]['last_name'] != null) {
//                    foreach (array_chunk($request->family_member, 3) as $item) {
//
//                        $relation = $item[0]['relation'];
//                        $first_name = $item[1]['first_name'];
//                        $last_name = $item[2]['last_name'];
//
//                        if ($relation != null && $first_name != null && $last_name != null) {
//
//                            $insert_family_member_and_get_id = FamilyMember::insertGetId([
//                                'relation' => $relation,
//                                'first_name' => $first_name,
//                                'last_name' => $last_name,
//                                'created_at' => Carbon::now(),
//                                'updated_at' => Carbon::now(),
//                            ]);
//
//                            $client->family_members()->attach($insert_family_member_and_get_id);
//
//                        }
//
//                    }
//                }
//            }

            $employment_within_last_five_years__name = $request->employment_within_last_five_years__name;
            $employment_within_last_five_years__address_of_employer = $request->employment_within_last_five_years__address_of_employer;
            $employment_within_last_five_years__your_occupation = $request->employment_within_last_five_years__your_occupation;
            $employment_within_last_five_years__from = $request->employment_within_last_five_years__from;
            $employment_within_last_five_years__to = $request->employment_within_last_five_years__to;

            if (!is_null($request->employment_within_last_five_years__name[0]) && !is_null($request->employment_within_last_five_years__address_of_employer[0]) && !is_null($request->employment_within_last_five_years__your_occupation[0]) && !is_null($request->employment_within_last_five_years__from[0]) && !is_null($request->employment_within_last_five_years__to[0])) {

                $merge_employment_within_last_five_years_arrays = array_merge($employment_within_last_five_years__name, $employment_within_last_five_years__address_of_employer, $employment_within_last_five_years__your_occupation, $employment_within_last_five_years__from, $employment_within_last_five_years__to);

                $map_employment_within_last_five_years_arrays = array_map(null, ...array_chunk($merge_employment_within_last_five_years_arrays, count($employment_within_last_five_years__name)));

                foreach ($map_employment_within_last_five_years_arrays as $map_employment_within_last_five_years_array) {


                    $employment_within_last_five_year_id = EmploymentWithinLastFiveYears::insertGetId([

                        'employment_w_l_f_y__name' => $map_employment_within_last_five_years_array[0],
                        'employment_w_l_f_y__address_of_employer' => $map_employment_within_last_five_years_array[1],
                        'employment_w_l_f_y__your_occupation' => $map_employment_within_last_five_years_array[2],
                        'employment_w_l_f_y__from' => $map_employment_within_last_five_years_array[3],
                        'employment_w_l_f_y__to' => $map_employment_within_last_five_years_array[4],
                        'created_at' => now(),

                    ]);

                    $employment_within_last_five_year = EmploymentWithinLastFiveYears::find($employment_within_last_five_year_id);

                    $employment_within_last_five_year->client()->attach($client_id);

                }

            }

            $residency_within_five_year__number_and_street = $request->residency_within_five_year__number_and_street;
            $residency_within_five_year__city_town = $request->residency_within_five_year__city_town;
            $residency_within_five_year__department_province_or_state = $request->residency_within_five_year__department_province_or_state;
            $residency_within_five_year__country = $request->residency_within_five_year__country;
            $residency_within_five_year__from = $request->residency_within_five_year__from;
            $residency_within_five_year__to = $request->residency_within_five_year__to;

            if (!is_null($request->residency_within_five_year__number_and_street[0]) && !is_null($request->residency_within_five_year__city_town[0]) && !is_null($request->residency_within_five_year__department_province_or_state[0]) && !is_null($request->residency_within_five_year__from[0]) && !is_null($request->residency_within_five_year__to[0]) && !is_null($request->residency_within_five_year__country[0])) {

                $merge_residency_within_five_years_arrays = array_merge($residency_within_five_year__number_and_street, $residency_within_five_year__city_town, $residency_within_five_year__department_province_or_state, $residency_within_five_year__country, $residency_within_five_year__from, $residency_within_five_year__to);

                $map_residency_within_five_years_arrays = array_map(null, ...array_chunk($merge_residency_within_five_years_arrays, count($residency_within_five_year__number_and_street)));

                foreach ($map_residency_within_five_years_arrays as $map_residency_within_five_years_array) {


                    $residency_within_five_year_id = ResidencyWithinFiveYears::insertGetId([

                        'number_and_street' => $map_residency_within_five_years_array[0],
                        'city_town' => $map_residency_within_five_years_array[1],
                        'department_province_or_state' => $map_residency_within_five_years_array[2],
                        'country_id' => $map_residency_within_five_years_array[3],
                        'from' => $map_residency_within_five_years_array[4],
                        'to' => $map_residency_within_five_years_array[5],
                        'created_at' => now(),

                    ]);

                    $residency_within_five_year = ResidencyWithinFiveYears::find($residency_within_five_year_id);

                    $residency_within_five_year->client()->attach($client_id);

                }

            }

            return redirect()->route('clients->show')->withErrors([
                "client_added_successfully" => "client added successfully"
            ]);

        }
    }

    public function update(Request $request, $id = false) {

        if ($request->isMethod('get')) {

            // $family_members = Client::find($id)->family_members();

            $client = Client::find($id);
            $client_citizenship_countries = $client->country_of_citizenship()->get();
            $client_citizenship_country_ids = $client_citizenship_countries->pluck('id');
            $client_countries_of_lawful_statuses = $client->country_of_lawful_status()->get();
            $client_countries_of_lawful_status_ids = $client_countries_of_lawful_statuses->pluck('id');

            $data = [
                'id' => $id,
                // 'family_members' => $family_members,
                'client_citizenship_country_ids' => $client_citizenship_country_ids->toArray(),
                'client_countries_of_lawful_status_ids' => $client_countries_of_lawful_status_ids->toArray()
            ];
            return view('crm.pages.clients.update', $data);

        } elseif ($request->isMethod('post')) {

            $request->flash();

            $validator = Validator::make($request->all(), [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => "nullable|unique:clients,email,$id,id,deleted_at,NULL",
                'phone' => 'required|min:10',
                'phone_secondary' => 'nullable|min:10',
                'address_zip_code' => 'nullable|numeric',
                'profile_photo' => 'nullable|mimes:jpeg,jpg,png|max:25000',
            ], [
                'phone.min' => 'Enter correct phone number',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();
            }

            $client = Client::find($id);
            $shouldResendInvitation = $request->email != '' && $client && $client->password_status !== 'set';
            if ($shouldResendInvitation) {
                $client->update([
                    'password' => null,
                    'password_status' => 'pending',
                ]);
                ClientInvitationService::send($client);
            }

            if ($request->profile_photo != null) {
                if (Client::find($id)->profile_photo != '') {
                    Storage::disk('local')->delete('protected/profile_photos/' . Client::find($id)->profile_photo);
                }
                $fileName = Str::uuid()->toString().'.'.$request->profile_photo->extension();
                Storage::disk('local')->putFileAs('protected/profile_photos', $request->profile_photo, $fileName);
            } else {
                if (Client::find($id)->profile_photo != '') {
                    $fileName = Client::find($id)->profile_photo;
                } else {
                    $fileName = '';
                }
            }

            Client::where('id', $id)->update([
                'firstname' => Str::lower($request->firstname),
                'lastname' => Str::lower($request->lastname),
                'dob' => $request->dob,
                'a_number' => Str::lower($request->a_number),
                'email' => Str::lower($request->email),
                'phone' => preg_replace("/[^0-9]/", "", $request->phone),
                'phone_secondary' => preg_replace("/[^0-9]/", "", $request->phone_secondary),
                'social_security' => Str::lower($request->social_security),
                'address_country' => Str::upper($request->address_country),
                'address_state_code' => Str::upper($request->address_state_code),
                'address_city' => Str::lower($request->address_city),
                'address_zip_code' => $request->address_zip_code,
                'address_unit' => Str::lower($request->address_unit),
                'address_address' => Str::lower($request->address_address),

                'education__name_of_school' => $request->education__name_of_school,
                'education__type_of_school' => $request->education__type_of_school,
                'education__location' => $request->education__location,
                'education__major' => $request->education__major,
                'education__from' => $request->education__from,
                'education__to' => $request->education__to,

                'last_address_o_t_c_o_y_o__number_and_street' => $request->last_address_of_the_country_of_your_origin__number_and_street,
                'last_address_o_t_c_o_y_o__city_town' => $request->last_address_of_the_country_of_your_origin__city_town,
                'last_address_o_t_c_o_y_o__department_province_or_state' => $request->last_address_of_the_country_of_your_origin__department_province_or_state,
                'last_address_o_t_c_o_y_o__country_id' => $request->last_address_of_the_country_of_your_origin__country_id,
                'last_address_o_t_c_o_y_o__from' => $request->last_address_of_the_country_of_your_origin__from,
                'last_address_o_t_c_o_y_o__to' => $request->last_address_of_the_country_of_your_origin__to,

                'profile_photo' => $fileName,
                'marital_status' => $request->marital_status,
                'updated_at' => Carbon::now()
            ]);

//            if ($id != '') {
//
//                if ($request->family_member[0]['relation'] != null && $request->family_member[1]['first_name'] != null && $request->family_member[2]['last_name'] != null) {
//                    foreach (array_chunk($request->family_member, 3) as $item) {
//
//                        $relation = $item[0]['relation'];
//                        $first_name = $item[1]['first_name'];
//                        $last_name = $item[2]['last_name'];
//
//                        if ($relation != null && $first_name != null && $last_name != null) {
//
//                            $insert_family_member_and_get_id = FamilyMember::insertGetId([
//                                'relation' => $relation,
//                                'first_name' => $first_name,
//                                'last_name' => $last_name,
//                                'created_at' => Carbon::now(),
//                                'updated_at' => Carbon::now(),
//                            ]);
//
//                            $client = Client::find($id);
//                            $client->family_members()->attach($insert_family_member_and_get_id);
//
//                        }
//
//                    }
//                }
//            }


            $client = Client::find($id);

            if ($request->country_of_citizenship != null && count($request->country_of_citizenship) > 0) {

                $client->country_of_citizenship()->detach();

                foreach ($request->country_of_citizenship as $country_id) {

                    $client->country_of_citizenship()->attach($country_id);

                }

            } else {

                $client->country_of_citizenship()->detach();

            }

            if ($request->country_of_lawful_status != null && count($request->country_of_lawful_status) > 0) {

                $client->country_of_lawful_status()->detach();

                foreach ($request->country_of_lawful_status as $country_id) {

                    $client->country_of_lawful_status()->attach($country_id);

                }

            } else {

                $client->country_of_lawful_status()->detach();

            }

            $riders = $request->rider;

            $client_id = $id;

            $client = Client::find($client_id);

            if ($riders[0]['relation'] != null && $riders[1]['riders'][0] != null) {

                foreach (array_chunk($riders, 2) as $rider) {

                    $rider_id = (int) $rider[1]['riders'];

//                    // TODO: S https://github.com/Zrabo/NYDT/issues/8
//
//                    /*
//                     * SMS Generic: case_id -> changed to null
//                     * Mailable: SendMailToRider
//                     */
//
//                    $rider = Rider::find($rider_id);
//
//                    if ($rider) {
//
//                        if ($rider->phone) {
//                            GenericController::twilio_send_sms($client_id, null, null, $rider->phone, "You are now a rider of $client->firstname $client->lastname");
//                        }
//
//                        if ($rider->email) {
//                            Mail::to($rider->email)
//                                ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
//                                ->send(new SendMailToRider());
//                        }
//
//
//                    }
//
//                    // TODO: S https://github.com/Zrabo/NYDT/issues/8

                    $client_rider_ids = array_unique(DB::table('relation_rider')->whereIn('relation_id', $client->relations()->get()->pluck('id'))->pluck('rider_id')->toArray());



                    if (!in_array($rider_id, $client_rider_ids)) {

                    $insert_get_id_relation = Relation::insertGetId([
                        'name' => $rider[0]['relation']
                    ]);

                    $rider = Rider::find($rider[1]['riders']);

                    $rider->relations()->attach($insert_get_id_relation);

                    $client->relations()->attach($insert_get_id_relation);

                    }

                }

            }

            $employment_within_last_five_years__name = $request->employment_within_last_five_years__name;
            $employment_within_last_five_years__address_of_employer = $request->employment_within_last_five_years__address_of_employer;
            $employment_within_last_five_years__your_occupation = $request->employment_within_last_five_years__your_occupation;
            $employment_within_last_five_years__from = $request->employment_within_last_five_years__from;
            $employment_within_last_five_years__to = $request->employment_within_last_five_years__to;

            if (!is_null($request->employment_within_last_five_years__name[0]) && !is_null($request->employment_within_last_five_years__address_of_employer[0]) && !is_null($request->employment_within_last_five_years__your_occupation[0]) && !is_null($request->employment_within_last_five_years__from[0]) && !is_null($request->employment_within_last_five_years__to[0])) {

                $merge_employment_within_last_five_years_arrays = array_merge($employment_within_last_five_years__name, $employment_within_last_five_years__address_of_employer, $employment_within_last_five_years__your_occupation, $employment_within_last_five_years__from, $employment_within_last_five_years__to);

                $map_employment_within_last_five_years_arrays = array_map(null, ...array_chunk($merge_employment_within_last_five_years_arrays, count($employment_within_last_five_years__name)));

                foreach ($map_employment_within_last_five_years_arrays as $map_employment_within_last_five_years_array) {

                    $employment_within_last_five_year_id = EmploymentWithinLastFiveYears::insertGetId([

                        'employment_w_l_f_y__name' => $map_employment_within_last_five_years_array[0],
                        'employment_w_l_f_y__address_of_employer' => $map_employment_within_last_five_years_array[1],
                        'employment_w_l_f_y__your_occupation' => $map_employment_within_last_five_years_array[2],
                        'employment_w_l_f_y__from' => $map_employment_within_last_five_years_array[3],
                        'employment_w_l_f_y__to' => $map_employment_within_last_five_years_array[4],
                        'created_at' => now(),

                    ]);

                    $employment_within_last_five_year = EmploymentWithinLastFiveYears::find($employment_within_last_five_year_id);

                    $employment_within_last_five_year->client()->attach($client_id);

                }

            }





            $residency_within_five_year__number_and_street = $request->residency_within_five_year__number_and_street;
            $residency_within_five_year__city_town = $request->residency_within_five_year__city_town;
            $residency_within_five_year__department_province_or_state = $request->residency_within_five_year__department_province_or_state;
            $residency_within_five_year__country = $request->residency_within_five_year__country;
            $residency_within_five_year__from = $request->residency_within_five_year__from;
            $residency_within_five_year__to = $request->residency_within_five_year__to;

            if (!is_null($request->residency_within_five_year__number_and_street[0]) && !is_null($request->residency_within_five_year__city_town[0]) && !is_null($request->residency_within_five_year__department_province_or_state[0]) && !is_null($request->residency_within_five_year__from[0]) && !is_null($request->residency_within_five_year__to[0]) && !is_null($request->residency_within_five_year__country[0])) {

                $merge_residency_within_five_years_arrays = array_merge($residency_within_five_year__number_and_street, $residency_within_five_year__city_town, $residency_within_five_year__department_province_or_state, $residency_within_five_year__country, $residency_within_five_year__from, $residency_within_five_year__to);

                $map_residency_within_five_years_arrays = array_map(null, ...array_chunk($merge_residency_within_five_years_arrays, count($residency_within_five_year__number_and_street)));

                foreach ($map_residency_within_five_years_arrays as $map_residency_within_five_years_array) {


                    $residency_within_five_year_id = ResidencyWithinFiveYears::insertGetId([

                        'number_and_street' => $map_residency_within_five_years_array[0],
                        'city_town' => $map_residency_within_five_years_array[1],
                        'department_province_or_state' => $map_residency_within_five_years_array[2],
                        'country_id' => $map_residency_within_five_years_array[3],
                        'from' => $map_residency_within_five_years_array[4],
                        'to' => $map_residency_within_five_years_array[5],
                        'created_at' => now(),

                    ]);

                    $residency_within_five_year = ResidencyWithinFiveYears::find($residency_within_five_year_id);

                    $residency_within_five_year->client()->attach($client_id);

                }

            }




            return back()->withErrors([
                "client_updated_successfully" => "client updated successfully"
            ]);

        }

    }

    public function delete(Request $request, $id = false) {

        $client = Client::find($id);
        $count_cases = $client->cases()->count();

        if (Customers::where('id', $id)->exists() || $count_cases == 0) {
            if ($request->isMethod('get')) {
                $data = [
                    'id' => $id
                ];
                return view('crm.pages.clients.delete', $data);
            } elseif ($request->isMethod('post')) {

                $validator = Validator::make($request->all(), [
                    'client_id' => 'required',
                ]);
                if ($validator->fails()) {
                    return back()->withErrors($validator)
                        ->withInput();
                }
                Client::where('id', $id)->delete();
                return redirect()->route('clients->show')->withErrors([
                    "client_deleted_successfully" => "client deleted successfully"
                ]);

            }
        } else {
            return abort(404);
        }

    }

}
