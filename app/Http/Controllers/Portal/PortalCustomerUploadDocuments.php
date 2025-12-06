<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Mail\Portal\PortalForgotPassword;
use App\Mail\Portal\PortalNotifyAdminAfterUploadRequestedDocumentByCustomer;
use App\Models\Crm\Customers;
use App\Models\Crm\EmailSettings;
use App\Models\Crm\UploadDocument;
use App\Models\Crm\UploadDocumentVersionTwo;
use App\Support\PortalCaseResolver;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PortalCustomerUploadDocuments extends Controller
{
    public function show(Request $request, $case_id) {
        $case = PortalCaseResolver::caseForCurrentClientOrAbort((int) $case_id);

        if ($request->isMethod('get')) {
            $data = [
                'case_id' => $case->id,
                'requested_documents' => DB::table('list_of_requested_documents_sent_to_the_client_version_twos')->where('case_id', $case->id)->where('is_uploaded', 0)->get(),
                'uploaded_documents' => DB::table('list_of_requested_documents_sent_to_the_client_version_twos')->where('case_id', $case->id)->where('is_uploaded', 1)->get()
            ];
            return view('portal.pages.upload_documents.show', $data);
        } elseif ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'files' => 'required',
                'files.*' => 'required|mimes:jpeg,png,jpg,pdf,doc,docx|max:25000'
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();
            }
            foreach ($request->files as $file) {
                foreach ($file as $k => $v) {
                    $fileName = \Illuminate\Support\Str::uuid()->toString() . '.' . $request->file('files.' . $k)->extension();
                    Storage::disk('local')->putFileAs('protected/requested_documents', $request->file('files.' . $k), $fileName);
                    UploadDocumentVersionTwo::insert([
                        'user_id' => 0,
                        'case_id' => $case->id,
                        'name' => $fileName,
                        'description' => str_replace('_', ' ', $k),
                        'requested_document_id' => DB::table('list_of_requested_documents_sent_to_the_client_version_twos')->where('case_id', $case->id)->first()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }
            }
            $mail_data = [
                'case_id' => $case->id,
                'customer_firstname_lastname' => Customers::where('id', $case->id)->first()->firstname . ' ' . Customers::where('id', $case->id)->first()->lastname,
                'requested_documents' => DB::table('list_of_requested_documents_sent_to_the_client')->where('customer_id', $case->id)->get()
            ];
            Mail::to(config('app.requested_documents_upload_and_sent_by_customer_notify_admin_email'))
                ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
                ->send(new PortalNotifyAdminAfterUploadRequestedDocumentByCustomer($mail_data));
            // DB::table('list_of_requested_documents_sent_to_the_client')->where('customer_id', $case_id)->delete();
            DB::table('list_of_requested_documents_sent_to_the_client_version_twos')->where('case_id', $case->id)->update([
                'is_uploaded' => true
            ]);
            return redirect()->route('portal->case_history->show')->withErrors([
                "documents_sent_successfully" => "documents sent successfully"
            ]);
        }
    }
}
