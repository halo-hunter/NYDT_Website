<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Mail\Crm\ForgorPassword;
use App\Mail\Crm\SendRequestedDocumentListToCustomer;
use App\Mail\Crm\SendSetPasswordUrlToCustomer;
use App\Models\Crm\Attorneys;
use App\Models\Crm\CompanyInfo;
use App\Models\Crm\CustomerNotes;
use App\Models\Crm\Customers;
use App\Models\Crm\DefenceAsylum;
use App\Models\Crm\EmailSettings;
use App\Models\Crm\InternalComments;
use App\Models\Crm\Invoice;
use App\Models\Crm\Payment;
use App\Models\Crm\UploadDocument;
use Carbon\Carbon;
use Cassandra\Custom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class CustomersController extends Controller
{
    public function show(Request $request) {
        return view('crm.pages.customers.show');
    }

    public function insert(Request $request) {
        if ($request->isMethod('get')) {
            return view('crm.pages.customers.insert');
        } elseif ($request->isMethod('post')) {
            $request->flash();
            $validator = Validator::make($request->all(), [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'nullable|email|unique:customers,email',
                'phone' => 'required',
                'contract_number' => 'nullable|unique:customers,contract_number',
                'retainer_cost' => 'required',
                'upload_retainer' => 'nullable|mimes:pdf|max:10240'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();
            }

            if ($request->upload_retainer != null) {
                $fileName = time().'.'.$request->upload_retainer->extension();
                $request->upload_retainer->move(public_path('files/retainer/'), $fileName);
            } else {
                $fileName = NULL;
            }

            Customers::insert([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'contract_number' => $request->contract_number,
                'a_number' => $request->a_number,
                'email' => $request->email,
                'phone' => str_replace([' ', '-'], '', $request->phone),
                'address_state_code' => $request->address_state_code,
                'address_country' => $request->address_country,
                'address_city' => $request->address_city,
                'address_zip_code' => $request->address_zip_code,
                'address_unit' => $request->address_unit,
                'address_address' => $request->address_address,
                'hearing_date' => $request->hearing_date,
                'docket_date' => $request->docket_date,
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
                'social_security' => $request->social_security,
                'class_of_admissions' => $request->class_of_admissions,
                'case_type' => $request->case_type,
                'due_date' => $request->due_date,
                'attorney_id' => $request->attorney_id,
                'type_of_hearing_id' => $request->type_of_hearing_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            return redirect()->route('customers->show')->withErrors([
                "customer_added_successfully" => "customer added successfully"
            ]);
        }
    }

    public function update(Request $request, $id = false) {
        if (Customers::where('id', $id)->exists()) {
            if ($request->isMethod('get')) {
                $data = [
                    'id' => $id
                ];
                return view('crm.pages.customers.update', $data);
            } elseif ($request->isMethod('post')) {
                $request->flash();
                $validator = Validator::make($request->all(), [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email' => 'nullable|email',
                    'phone' => 'required',
                    'attorney_id' => 'required',
                    'retainer_cost' => 'required',
                    'upload_retainer' => 'nullable|mimes:pdf|max:10240'
                ]);
                if ($validator->fails()) {
                    return back()->withErrors($validator)
                        ->withInput();
                }

                if (Customers::where('id', $id)->first()->email == '' && $request->email != '' && Customers::where('id', $id)->first()->password == '') {
                    Customers::where('id', $id)->update([
                        'password' => 1
                    ]);
                    $mail_data = [
                        'customer_id' => $id,
                    ];
                    Mail::to($request->email)
                        ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
                        ->send(new SendSetPasswordUrlToCustomer($mail_data));
                }

                if ($request->upload_retainer != null) {
                    if (Customers::find($id)->upload_retainer != '') {
                        \Illuminate\Support\Facades\File::delete('files/retainer/' . Customers::find($id)->upload_retainer);
                    }
                    $fileName = time().'.'.$request->upload_retainer->extension();
                    $request->upload_retainer->move(public_path('files/retainer/'), $fileName);
                } else {
                    if (Customers::find($id)->upload_retainer != '') {
                        $fileName = Customers::find($id)->upload_retainer;
                    } else {
                        $fileName = '';
                    }
                }
                Customers::where('id', $id)->update([
//                    'firstname' => $request->firstname,
//                    'lastname' => $request->lastname,
//                    'email' => $request->email,
//                    'phone' => str_replace([' ', '-'], '', $request->phone),
//                    'attorney_id' => $request->attorney_id,
//                    'updated_at' => Carbon::now()
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'contract_number' => $request->contract_number,
                    'a_number' => $request->a_number,
                    'email' => $request->email,
                    'phone' => str_replace([' ', '-'], '', $request->phone),
                    'address_state_code' => $request->address_state_code,
                    'address_country' => $request->address_country,
                    'address_city' => $request->address_city,
                    'address_zip_code' => $request->address_zip_code,
                    'address_unit' => $request->address_unit,
                    'address_address' => $request->address_address,
                    'hearing_date' => $request->hearing_date,
                    'docket_date' => $request->docket_date,
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
                    'social_security' => $request->social_security,
                    'class_of_admissions' => $request->class_of_admissions,
                    'case_type' => $request->case_type,
                    'due_date' => $request->due_date,
                    'attorney_id' => $request->attorney_id,
                    'type_of_hearing_id' => $request->type_of_hearing_id,
                    'updated_at' => Carbon::now()
                ]);

                return back()->withErrors([
                    "customer_updated_successfully" => "customer updated successfully"
                ]);
            }
        } else {
            return abort(404);
        }
    }

    public function delete(Request $request, $id = false) {
        if (Customers::where('id', $id)->exists()) {
            if ($request->isMethod('get')) {
                $data = [
                    'id' => $id
                ];
                return view('crm.pages.customers.delete', $data);
            } elseif ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'customer_id' => 'required',
                ]);
                if ($validator->fails()) {
                    return back()->withErrors($validator)
                        ->withInput();
                }
                Customers::where('id', $id)->delete();
                return redirect()->route('customers->show')->withErrors([
                    "customer_deleted_successfully" => "customer deleted successfully"
                ]);
            }
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
            CustomerNotes::insert([
                'user_id' => Auth::id(),
                'customer_id' => $id,
                'note_text' => $request->note_text,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
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
            InternalComments::insert([
                'user_id' => Auth::id(),
                'customer_id' => $id,
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
                'document' => 'required|mimes:pdf|max:10240',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();
            }
            if ($request->document != null) {
                $fileName = time().'.'.$request->document->extension();
                $request->document->move(public_path('files/upload_document/'), $fileName);
            } else {
                $fileName = NULL;
            }
            UploadDocument::insert([
                'user_id' => Auth::id(),
                'customer_id' => $id,
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
                $file_name = UploadDocument::find($request->file_id)->name;
                \Illuminate\Support\Facades\File::delete('files/upload_document/' . $file_name);
                UploadDocument::destroy($request->file_id);
                return back();
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }
    }

    public function defence_asylum(Request $request, $id = false) {
        if ($request->isMethod('post')) {
            if (DefenceAsylum::where('customer_id', $id)->exists()) {
                $validator = Validator::make($request->all(), [
                    'upload_a_form' => 'mimes:pdf|max:2048',
                    'da_filing_date' => 'required',
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'upload_a_form' => 'required|mimes:pdf|max:10240',
                    'da_filing_date' => 'required',
                ]);
            }
            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();
            }
            if ($request->upload_a_form != null) {
                if (DefenceAsylum::where('customer_id', $id)->exists()) {
                    \Illuminate\Support\Facades\File::delete('files/defence_asylum/' . DefenceAsylum::where('customer_id', $id)->first()->name);
                    DefenceAsylum::where('customer_id', $id)->delete();
                }
                $fileName = time().'.'.$request->upload_a_form->extension();
                $request->upload_a_form->move(public_path('files/defence_asylum/'), $fileName);
            } else {
                $fileName = NULL;
            }
            if (DefenceAsylum::where('customer_id', $id)->exists()) {
                DefenceAsylum::where('customer_id', $id)->update([
                    'user_id' => Auth::id(),
                    'name' => $fileName == NULL ? DefenceAsylum::where('customer_id', $id)->first()->name : $fileName,
                    'filing_date' => $request->da_filing_date,
                    'updated_at' => Carbon::now()
                ]);
            } else {
                DefenceAsylum::insert([
                    'user_id' => Auth::id(),
                    'customer_id' => $id,
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

    public function make_a_payment(Request $request) {
        if ($request->isMethod('post')) {
            $payment_invoice_number_input_id = $request->payment_invoice_number_input_id;
            $payment_amount_input_id = $request->payment_amount_input_id;
            $bank_card_payment_card_number_input_id = $request->bank_card_payment_card_number_input_id;
            $bank_card_payment_card_exp_date_input_id = $request->bank_card_payment_card_exp_date_input_id;
            $bank_card_payment_card_code_input_id = $request->bank_card_payment_card_code_input_id;
            $payment_description_input_id = $request->payment_description_input_id;
            $payment_firstname_input_id = $request->payment_firstname_input_id;
            $payment_lastname_input_id = $request->payment_lastname_input_id;
            $payment_customer_select_id = $request->payment_customer_select_id;
            $payment_input_customer_id = $request->payment_input_customer_id;
            if (
                $payment_invoice_number_input_id == '' ||
                $payment_amount_input_id == '' ||
                $payment_firstname_input_id == '' ||
                $payment_lastname_input_id == '' ||
                $payment_customer_select_id == '' ||
                $payment_input_customer_id == ''
            ) {
                echo json_encode([
                   'code' => 1,
                   'message' => 'some parameter (s) is missing!'
                ]);
                exit();
            } else {
                if ($request->payment_type_select_id == 'bank_card') {
                    $data = [
                        'amount' => $payment_amount_input_id,
                        'card_number' => str_replace('-', '', $bank_card_payment_card_number_input_id),
                        'expiration_date' => $bank_card_payment_card_exp_date_input_id,
                        'card_code' => $bank_card_payment_card_code_input_id,
                        'invoice_number' => $payment_invoice_number_input_id,
                        'description' => $payment_description_input_id == null ? 'no description' : $payment_description_input_id,
                        'firstname' => $payment_firstname_input_id,
                        'lastname' => $payment_lastname_input_id,
                        'type' => $payment_customer_select_id,
                        'customer_id' => $payment_input_customer_id,
                    ];
                    if (GenericController::anet_charge_credit_card($data)->code == 1) {
                        Payment::insert([
                            'user_id' => Auth::id(),
                            'payment_type' => $request->payment_type_select_id,
                            'invoice_number' => $payment_invoice_number_input_id,
                            'amount' => $payment_amount_input_id,
                            'payment_description' => $payment_description_input_id,
                            'firstname' => $payment_firstname_input_id,
                            'lastname' => $payment_lastname_input_id,
                            'customer_type' => $payment_customer_select_id,
                            'customer_id' => $payment_input_customer_id,
                            'payment_status' => 'success',
                            'payment_transaction_id' => GenericController::anet_charge_credit_card($data)->transaction_id,
                            'ip' => $request->ip(),
                            'user_agent' => $request->userAgent(),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                        Invoice::insert([
                            'user_id' => Auth::id(),
                            'customer_id' => $payment_input_customer_id,
                            'invoice_number' => $payment_invoice_number_input_id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                        echo json_encode([
                            'code' => 2,
                            'message' => GenericController::anet_charge_credit_card($data)->message
                        ]);
                        exit();
                    } else {
                        echo json_encode([
                            'code' => 0,
                            'message' => GenericController::anet_charge_credit_card($data)->message
                        ]);
                        exit();
                    }
                } elseif ($request->payment_type_select_id == 'cash') {
                    Payment::insert([
                        'user_id' => Auth::id(),
                        'payment_type' => $request->payment_type_select_id,
                        'invoice_number' => $payment_invoice_number_input_id,
                        'amount' => $payment_amount_input_id,
                        'payment_description' => $payment_description_input_id,
                        'firstname' => $payment_firstname_input_id,
                        'lastname' => $payment_lastname_input_id,
                        'customer_type' => $payment_customer_select_id,
                        'customer_id' => $payment_input_customer_id,
                        'payment_status' => 'success',
                        'payment_transaction_id' => time() * 3,
                        'ip' => $request->ip(),
                        'user_agent' => $request->userAgent(),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    Invoice::insert([
                        'user_id' => Auth::id(),
                        'customer_id' => $payment_input_customer_id,
                        'invoice_number' => $payment_invoice_number_input_id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    echo json_encode([
                        'code' => 3,
                        'message' => 'cash'
                    ]);
                    exit();
                }
            }
        } else {
            return abort(404);
        }
    }

    public function send_required_documents(Request $request) {
        $customer_id = $request->customer_id;
        if (Customers::where('id', $customer_id)->exists()) {
            $email = Customers::where('id', $customer_id)->first()->email;
            if (isset($email) && $email != '') {
                $values = array_merge((array) $request->checkbox_values_array, (array) $request->input_value_array);
                DB::table('list_of_requested_documents_sent_to_the_client')->where('customer_id', $customer_id)->delete();
                foreach ($values as $value) {
                    DB::table('list_of_requested_documents_sent_to_the_client')->insert([
                        'author_id' => Auth::id(),
                        'customer_id' => $customer_id,
                        'document_name' => $value,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }
                $mail_data = [
                    'document_types' => $values,
                    'case_id' => $customer_id,
                ];
                Mail::to($email)
                    ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
                    ->send(new SendRequestedDocumentListToCustomer($mail_data));

                InternalComments::insert([
                    'user_id' => Auth::id(),
                    'customer_id' => $customer_id,
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
