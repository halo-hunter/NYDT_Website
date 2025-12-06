<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Mail\Crm\CreateNoteEmailNotification;
use App\Mail\Crm\SendRequestedDocumentListToCustomer;
use App\Mail\Crm\SendSetPasswordUrlToCustomer;
use App\Models\Crm\CaseModel;
use App\Models\Crm\CaseNote;
use App\Models\Crm\CaseSubType;
use App\Models\Crm\Client;
use App\Models\Crm\CustomerNotes;
use App\Models\Crm\Customers;
use App\Models\Crm\DefenceAsylum;
use App\Models\Crm\DefenceAsylumVersionTwo;
use App\Models\Crm\EmailSettings;
use App\Models\Crm\EntryDate;
use App\Models\Crm\InternalComments;
use App\Models\Crm\InternalCommentVersionTwo;
use App\Models\Crm\TodoTask;
use App\Models\Crm\UploadDocument;
use App\Models\Crm\UploadDocumentVersionTwo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Psy\Util\Str;

class CaseController extends Controller
{
    public function show(Request $request) {
        return view('crm.pages.cases.show');
    }

    public function insert(Request $request) {

        if ($request->isMethod('get')) {



            $data = [
                'clients' => Client::orderby('lastname', 'asc')->get(),
                'case_sub_types' => CaseSubType::all(),
                'client_id' => is_null($request->query('client_id')) ? null : intval($request->query('client_id')),
            ];

            return view('crm.pages.cases.insert', $data);

        } elseif ($request->isMethod('post')) {

            $request->flash();

            $validator = Validator::make($request->all(), [
                'client' => 'required',
                'contract_number' => 'nullable|unique:cases,contract_number',
                'retainer_cost' => 'required',
                'upload_retainer' => 'nullable|mimes:jpeg,png,jpg,pdf,doc,docx|max:25000',
                'scheduled_biometric_appointment_datetime' => 'nullable|required_with:scheduled_biometric_appointment_address',
                'scheduled_biometric_appointment_address' => 'nullable|required_with:scheduled_biometric_appointment_datetime',
                'interview_datetime' => 'nullable|required_with:interview_address',
                'interview_address' => 'nullable|required_with:interview_datetime',
                'case_subtype' => 'required_if:case_type,Immigration'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();
            }

            if ($request->upload_retainer != null) {
                $fileName = \Illuminate\Support\Str::uuid()->toString() . '.' . $request->upload_retainer->extension();
                Storage::disk('local')->putFileAs('protected/retainer', $request->upload_retainer, $fileName);
            } else {
                $fileName = NULL;
            }

            $due_date = is_array($request->due_date) ? $request->due_date : [];
            $due_date_additional_info = is_array($request->due_date_additional_info) ? $request->due_date_additional_info : [];

            $due_date_count = max(count($due_date), count($due_date_additional_info));
            $due_date = array_pad($due_date, $due_date_count, null);
            $due_date_additional_info = array_pad($due_date_additional_info, $due_date_count, null);

            $mergeddue_date_and_due_date_additional_info = array_filter(
                array_map(function ($due_date, $due_date_additional_info) {
                    return [$due_date, $due_date_additional_info];
                }, $due_date, $due_date_additional_info),
                function ($item) {
                    return !is_null($item[0]) || !is_null($item[1]);
                }
            );

            $insert_and_get_id = DB::table('cases')->insertGetId([
                'contract_number' => $request->contract_number,
                'hearing_date' => $request->hearing_date,
                'docket_date' => $request->docket_date,
                'scheduled_biometric_appointment_datetime' => $request->scheduled_biometric_appointment_datetime,
                'scheduled_biometric_appointment_address' => $request->scheduled_biometric_appointment_address,
                'interview_datetime' => $request->interview_datetime,
                'interview_address' => $request->interview_address,
                'filling_date' => $request->filling_date,
                'entry_in_the_usa_date' => $request->entry_in_the_usa_date,
                'judge' => $request->judge,
                'attorney_id' => $request->attorney_id,
                'type_of_hearing_id' => $request->type_of_hearing_id,
                'retainer_cost' => $request->retainer_cost,
                'retainer_date' => $request->retainer_date,
                'upload_retainer' => $fileName,
                'total_balance' => $request->total_balance,
                'attorney_cost' => $request->attorney_cost,
                'dt_paralegal_services' => $request->dt_paralegal_services,
                'total_paid' => $request->total_paid,
                'class_of_admissions' => $request->class_of_admissions,
                'case_type' => $request->case_type,
                'case_subtype' => $request->case_type == 'Immigration' ? $request->case_subtype : null,
                'due_date' => json_encode($mergeddue_date_and_due_date_additional_info),  // TODO: https://github.com/Zrabo/NYDT/issues/9
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $client = Client::find($request->client);
            $client->cases()->attach($insert_and_get_id);

            if ($request->entry_date[0] != null && $request->entry_place[0] != null) {

                $entry_date = $request->entry_date;
                $entry_place = $request->entry_place;
                $entry_date_and_place = array_combine($entry_date, $entry_place);

                foreach ($entry_date_and_place as $key => $value) {

                    $date = $key;
                    $place = $value;

                    $insert_and_get_id_entry = EntryDate::insertGetId([
                        'date' => $date,
                        'place' => $place,
                        'created_at' => Carbon::now()
                    ]);

                    $case = CaseModel::find($insert_and_get_id);

                    $case->entry_dates()->attach($insert_and_get_id_entry);

                }

            }

            return redirect()->route('cases->show')->withErrors([
                "case_added_successfully" => "case added successfully"
            ]);

        }
    }

    public function update(Request $request, $id = false) {

        if ($request->get('record_id') != null) {

            TodoTask::where('id', $request->get('record_id'))->update([
                'seen' => true
            ]);

        }

        if (CaseModel::where('id', $id)->exists()) {

            $case = CaseModel::find($id);
            $client = $case->client()->first();


            if ($request->isMethod('get')) {

                $case = CaseModel::find($id);

                $client_id = $case->client()->first()->id;

                $client = Client::find($client_id);

                $relation_ids = $client->relations()->get()->pluck('id');

                $data = [
                    'id' => $id,
                    'client' => $client,
                    'users' => User::all(),
                    'relation_ids' => $relation_ids,
                    'case_sub_types' => CaseSubType::all()
                ];
                return view('crm.pages.cases.update', $data);

            } elseif ($request->isMethod('post')) {

                $request->flash();
                $validator = Validator::make($request->all(), [
                    'attorney_id' => 'required',
                    'retainer_cost' => 'required',
                    'upload_retainer' => 'nullable|mimes:jpeg,png,jpg,pdf,doc,docx|max:25000',
                    'scheduled_biometric_appointment_datetime' => 'nullable|required_with:scheduled_biometric_appointment_address',
                    'scheduled_biometric_appointment_address' => 'nullable|required_with:scheduled_biometric_appointment_datetime',
                    'interview_datetime' => 'nullable|required_with:interview_address',
                    'interview_address' => 'nullable|required_with:interview_datetime',
                    'case_subtype' => 'required_if:case_type,Immigration'
                ]);
                if ($validator->fails()) {
                    return back()->withErrors($validator)
                        ->withInput();
                }

//                if (Customers::where('id', $id)->first()->email == '' && $request->email != '' && Customers::where('id', $id)->first()->password == '') {
//                    Customers::where('id', $id)->update([
//                        'password' => 1
//                    ]);
//                    $mail_data = [
//                        'customer_id' => $id,
//                    ];
//                    Mail::to($request->email)
//                        ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
//                        ->send(new SendSetPasswordUrlToCustomer($mail_data));
//                }


                if ($request->upload_retainer != null) {
                    if (CaseModel::find($id)->upload_retainer != '') {
                        Storage::disk('local')->delete('protected/retainer/' . CaseModel::find($id)->upload_retainer);
                    }
                    $fileName = \Illuminate\Support\Str::uuid()->toString() . '.' . $request->upload_retainer->extension();
                    Storage::disk('local')->putFileAs('protected/retainer', $request->upload_retainer, $fileName);
                } else {
                    if (CaseModel::find($id)->upload_retainer != '') {
                        $fileName = CaseModel::find($id)->upload_retainer;
                    } else {
                        $fileName = '';
                    }
                }

                $scheduled_biometric_appointment_datetime_from_request = $request->scheduled_biometric_appointment_datetime;
                $scheduled_biometric_appointment_datetime_from_db = CaseModel::where('id', $id)->first()->scheduled_biometric_appointment_datetime;

                if ($scheduled_biometric_appointment_datetime_from_request && $scheduled_biometric_appointment_datetime_from_db
                    && Carbon::parse($scheduled_biometric_appointment_datetime_from_request) != Carbon::parse($scheduled_biometric_appointment_datetime_from_db)) {

                    CaseModel::where('id', $id)->update([
                        'scheduled_biometric_appointment_is_reminded_by_email' => false,
                        'scheduled_biometric_appointment_is_reminded_by_sms' => false
                    ]);

                }

                $interview_datetime_from_request = $request->interview_datetime;
                $interview_datetime_from_db = CaseModel::where('id', $id)->first()->interview_datetime;

                if ($interview_datetime_from_request && $interview_datetime_from_db
                    && Carbon::parse($interview_datetime_from_request) != Carbon::parse($interview_datetime_from_db)) {

                    CaseModel::where('id', $id)->update([
                        'interview_is_reminded_by_email' => false,
                        'interview_is_reminded_by_sms' => false
                    ]);

                }

                $due_date = is_array($request->due_date) ? $request->due_date : [];
                $due_date_additional_info = is_array($request->due_date_additional_info) ? $request->due_date_additional_info : [];

                $due_date_count = max(count($due_date), count($due_date_additional_info));
                $due_date = array_pad($due_date, $due_date_count, null);
                $due_date_additional_info = array_pad($due_date_additional_info, $due_date_count, null);

                $mergeddue_date_and_due_date_additional_info = array_filter(
                    array_map(function ($due_date, $due_date_additional_info) {
                        return [$due_date, $due_date_additional_info];
                    }, $due_date, $due_date_additional_info),
                    function ($item) {
                        return !is_null($item[0]) || !is_null($item[1]);
                    }
                );

                CaseModel::where('id', $id)->update([
                    'contract_number' => $request->contract_number,
                    'hearing_date' => $request->hearing_date,
                    'docket_date' => $request->docket_date,
                    'scheduled_biometric_appointment_datetime' => $request->scheduled_biometric_appointment_datetime,
                    'scheduled_biometric_appointment_address' => $request->scheduled_biometric_appointment_address,
                    'interview_datetime' => $request->interview_datetime,
                    'interview_address' => $request->interview_address,
                    'filling_date' => $request->filling_date,
                    'entry_in_the_usa_date' => $request->entry_in_the_usa_date,
                    'judge' => $request->judge,
                    'retainer_cost' => $request->retainer_cost,
                    'retainer_date' => $request->retainer_date,
                    'upload_retainer' => $fileName,
                    'total_balance' => $request->total_balance,
                    'attorney_cost' => $request->attorney_cost,
                    'dt_paralegal_services' => $request->dt_paralegal_services,
                    'total_paid' => $request->total_paid,
                    'class_of_admissions' => $request->class_of_admissions,
                    'case_type' => $request->case_type,
                    'case_subtype' => $request->case_type == 'Immigration' ? $request->case_subtype : null,
                    'due_date' => json_encode($mergeddue_date_and_due_date_additional_info), // TODO: https://github.com/Zrabo/NYDT/issues/9
                    'attorney_id' => $request->attorney_id,
                    'type_of_hearing_id' => $request->type_of_hearing_id,
                    'updated_at' => Carbon::now()
                ]);

                $entry_date = $request->entry_date;
                $entry_place = $request->entry_place;
                $entry_date_and_place = array_combine($entry_date, $entry_place);

                if (!array_key_exists("", $entry_date_and_place)) {

                    foreach ($entry_date_and_place as $key => $value) {

                        $date = $key;
                        $place = $value;

                        $insert_and_get_id_entry = EntryDate::insertGetId([
                            'date' => $date,
                            'place' => $place,
                            'created_at' => Carbon::now()
                        ]);

                        $case = CaseModel::find($id);

                        $case->entry_dates()->attach($insert_and_get_id_entry);

                    }

                }

                return back()->withErrors([
                    "todo_task_added_successfully" => "cases updated successfully"
                ]);
            }
        } else {
            return abort(404);
        }
    }

    public function delete(Request $request, $id = false) {
        if (CaseModel::where('id', $id)->exists()) {

            $case = CaseModel::find($id);
            $client = $case->client()->first();

            if ($request->isMethod('get')) {
                $data = [
                    'id' => $id,
                    'client' => $client
                ];
                return view('crm.pages.cases.delete', $data);
            } elseif ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'case_id' => 'required',
                ]);
                if ($validator->fails()) {
                    return back()->withErrors($validator)
                        ->withInput();
                }
                CaseModel::where('id', $id)->delete();
                return redirect()->route('cases->show')->withErrors([
                    "case_deleted_successfully" => "case deleted successfully"
                ]);
            }
        } else {
            return abort(404);
        }
    }

    public function defence_asylum(Request $request, $id = false) {
        if ($request->isMethod('post')) {
            if (DefenceAsylumVersionTwo::where('case_id', $id)->exists()) {
                $validator = Validator::make($request->all(), [
                    'upload_a_form' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:25000',
                    'da_filing_date' => 'required',
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'upload_a_form' => 'required|mimes:jpeg,png,jpg,pdf,doc,docx|max:25000',
                    'da_filing_date' => 'required',
                ]);
            }
            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();
            }
            if ($request->upload_a_form != null) {
                if (DefenceAsylumVersionTwo::where('case_id', $id)->exists()) {
                    Storage::disk('local')->delete('protected/defence_asylum/' . DefenceAsylumVersionTwo::where('case_id', $id)->first()->name);
                    DefenceAsylumVersionTwo::where('case_id', $id)->delete();
                }

                $case = CaseModel::find($id);
                $client = $case->client()->first();
                $fileName = \Illuminate\Support\Str::uuid()->toString() . '.' . $request->upload_a_form->extension();
                Storage::disk('local')->putFileAs('protected/defence_asylum', $request->upload_a_form, $fileName);
            } else {
                $fileName = NULL;
            }
            if (DefenceAsylumVersionTwo::where('case_id', $id)->exists()) {
                DefenceAsylumVersionTwo::where('case_id', $id)->update([
                    'user_id' => Auth::id(),
                    'name' => $fileName == NULL ? DefenceAsylumVersionTwo::where('case_id', $id)->first()->name : $fileName,
                    'filing_date' => $request->da_filing_date,
                    'updated_at' => Carbon::now()
                ]);
            } else {
                DefenceAsylumVersionTwo::insert([
                    'user_id' => Auth::id(),
                    'case_id' => $id,
                    'name' => $fileName,
                    'filing_date' => $request->da_filing_date,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
            return back();
        } else {
            return abort(404);
        }
    }

    public function insert_note(Request $request, $id = false) {

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'note_text' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();
            }

            $note_id = CaseNote::insertGetId([
                'user_id' => Auth::id(),
                'case_id' => $id,
                'note_text' => $request->note_text,
                'email_is_send' => $request->note_send_email == 1 ? true : false,
                'sms_is_send' => $request->note_send_sms == 1 ? true : false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            if ($request->note_send_email == 1) {

                $mail_data = [
                    'client_first_name' => $request->client_firstname,
                ];
                Mail::to($request->client_email)
                    ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
                    ->send(new CreateNoteEmailNotification($mail_data));

                $case = CaseModel::find($id);
                $client = $case->client()->first();

                $riders_email = GenericController::get_client_riders_email_addresses($client->id);

                if (count($riders_email) > 1) {

                    foreach ($riders_email as $rider_email) {

                        $mail_data = [
                            'client_first_name' => $request->client_firstname,
                        ];
                        Mail::to($rider_email)
                            ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
                            ->send(new CreateNoteEmailNotification($mail_data));

                    }

                    // Handle case where '$riders_email' length is more than 1
                }

            }

            if ($request->note_send_sms == 1) {
                $case = CaseModel::find($id);
                $client = $case->client()->first();
                // GenericController::twilio_send_sms($client->id, $id, $note_id, $client->phone, 'There is an update on your case. Please login at portal.nydt.law to view updates.');
                GenericController::twilio_send_sms($client->id, $id, $note_id, $client->phone, 'There is an update on your case, please visit our portal and check your case updates.');

                $case = CaseModel::find($id);
                $client = $case->client()->first();

                $riders_phones = GenericController::get_client_riders_phone_numbers($client->id);

                if (count($riders_phones) > 1) {

                    foreach ($riders_phones as $riders_phone) {

                        GenericController::twilio_send_sms($client->id, $id, $note_id, $riders_phones, 'There is an update on your case, please visit our portal and check your case updates.');

                    }

                }

            }

            return back();
        }
    }

    public function insert_internal_comment(Request $request, $id = false) {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'comment_text' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();
            }
            InternalCommentVersionTwo::insert([
                'user_id' => Auth::id(),
                'case_id' => $id,
                'comment_text' => $request->comment_text,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            return back();
        }
    }

    public function upload_document(Request $request, $id = false)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'document' => 'required|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:25000',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();
            }
            if ($request->document != null) {
                $fileName = \Illuminate\Support\Str::uuid()->toString() . '.' . $request->document->extension();
                Storage::disk('local')->putFileAs('protected/upload_document', $request->document, $fileName);
            } else {
                $fileName = NULL;
            }
            UploadDocumentVersionTwo::insert([
                'user_id' => Auth::id(),
                'case_id' => $id,
                'name' => $fileName,
                'description' => $request->description,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            return back();
        }
    }

    public function delete_uploaded_document(Request $request) {
        if ($request->isMethod('post')) {
            if ($request->has('file_id')) {
                $file_name = UploadDocumentVersionTwo::find($request->file_id)->name;
                Storage::disk('local')->delete('protected/upload_document/' . $file_name);
                UploadDocumentVersionTwo::destroy($request->file_id);
                return back();
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }
    }

    public function send_required_documents(Request $request) {

        $case_id = $request->case_id;

        $case = CaseModel::find($case_id);
        $client = $case->client()->first();

        if (CaseModel::where('id', $case_id)->exists()) {
            $email = $client->email;
            if (isset($email) && $email != '') {
                $values = array_merge((array) $request->checkbox_values_array, (array) $request->input_value_array);
                DB::table('list_of_requested_documents_sent_to_the_client_version_twos')->where('case_id', $case_id)->delete();
                foreach ($values as $value) {
                    DB::table('list_of_requested_documents_sent_to_the_client_version_twos')->insert([
                        'author_id' => Auth::id(),
                        'case_id' => $case_id,
                        'document_name' => $value,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }
                $mail_data = [
                    'document_types' => $values,
                    'case_id' => $case_id,
                ];
                Mail::to($email)
                    ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
                    ->send(new SendRequestedDocumentListToCustomer($mail_data));

                $riders_email = GenericController::get_client_riders_email_addresses($client->id);

                if ($riders_email && count($riders_email) > 1) {

                    foreach ($riders_email as $rider_email) {

                        Mail::to($rider_email)
                            ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
                            ->send(new SendRequestedDocumentListToCustomer($mail_data));

                    }

                }

                InternalCommentVersionTwo::insert([
                    'user_id' => Auth::id(),
                    'case_id' => $case_id,
                    'comment_text' => "Following Documents Requested: " . implode(', ', $values),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                echo json_encode([
                    'code' => 1,
                    'message' => 'email send successfully!'
                ]);
            } else {
                echo json_encode([
                    'code' => 2,
                    'message' => 'Client email address is not filled!'
                ]);
            }
        } else {
            echo json_encode([
                'code' => 3,
                'message' => 'No client found!'
            ]);
        }
    }

}
