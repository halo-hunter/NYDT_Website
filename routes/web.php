<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Crm;

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\Portal\PortalAuthController;
use App\Http\Controllers\Portal\PortalCaseController;
use App\Http\Controllers\Portal\PortalCustomerCaseHistoryController;
use App\Http\Controllers\Portal\PortalCustomerProfileController;
use App\Http\Controllers\Portal\PortalCustomerUploadDocuments;
use App\Http\Controllers\Portal\PortalDashboardController;
use App\Http\Controllers\TestController;
use App\Models\Crm\EntryDate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test', [TestController::class, 'test'])->name('test');

Route::get('/', function () {
    if (request()->getHost() == 'crm.nydt.law') {
        return redirect()->route('pages->login->show');
    } elseif (request()->getHost() == 'portal.nydt.law') {
        return redirect()->route('portal->login->show');
    }

    if (request()->getHost() == 'crm-staging.nydt.law') {
        return redirect()->route('pages->login->show');
    } elseif (request()->getHost() == 'portal-staging.nydt.law') {
        return redirect()->route('portal->login->show');
    }
});

Route::match(['get', 'post'],'/login', [LoginController::class, 'show'])->middleware(['redirect_to_portal', 'guest'])->name('pages->login->show');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::match(['get', 'post'], '/forgot-password', [LoginController::class, 'forgot_password'])->middleware('guest')->name('pages->forgot_password->show');
Route::match(['get', 'post'],'/change-password/{token}', [LoginController::class, 'change_password'])->middleware('guest')->name('pages->change_password->show');

Route::group(['prefix' => 'dashboard',  'middleware' => 'auth'], function() {
    Route::get('/', [DashboardController::class, 'show'])->name('dashboard');
    Route::get('/profile-settings', [DashboardController::class, 'profile_settings'])->name('dashboard->profile_settings');
});

Route::group(['prefix' => 'profile',  'middleware' => 'auth'], function() {
    Route::match(['get', 'post'],'/settings', [ProfileController::class, 'settings'])->name('profile->settings');
});

Route::group(['prefix' => 'settings',  'middleware' => ['auth', 'is_admin']], function() {
    Route::match(['get', 'post'],'/email', [SettingsController::class, 'email_settings'])->name('settings->email_settings');
    Route::match(['get', 'post'],'/payment', [SettingsController::class, 'payment_settings'])->name('settings->payment_settings');
    Route::match(['get', 'post'],'/reminder', [SettingsController::class, 'reminder_settings'])->name('settings->reminder_settings');
});

Route::group(['prefix' => 'users',  'middleware' => ['auth', 'is_admin']], function() {
    Route::get('/', [UsersController::class, 'show'])->name('users->show');
    Route::match(['get', 'post'],'/add', [UsersController::class, 'insert'])->name('users->insert');
    Route::match(['get', 'post'],'/edit/{id}', [UsersController::class, 'update'])->name('users->edit');
    Route::match(['get', 'post'],'/delete/{id}', [UsersController::class, 'delete'])->name('users->delete');
});

Route::group(['prefix' => 'attorneys',  'middleware' => 'auth'], function() {
    Route::get('/', [AttorneysController::class, 'show'])->name('attorneys->show');
    Route::match(['get', 'post'],'/add', [AttorneysController::class, 'insert'])->name('attorneys->insert');
    Route::match(['get', 'post'],'/edit/{id}', [AttorneysController::class, 'update'])->name('attorneys->edit');
    Route::match(['get', 'post'],'/delete/{id}', [AttorneysController::class, 'delete'])->name('attorneys->delete');
});

Route::group(['prefix' => 'company-info',  'middleware' => ['auth', 'is_admin']], function() {
    Route::match(['get', 'post'],'/', [CompanyInfoController::class, 'show'])->name('company_info->show');
});

//Route::group(['prefix' => 'customers',  'middleware' => 'auth'], function() {
//    Route::get('/', [CustomersController::class, 'show'])->name('customers->show');
//    Route::match(['get', 'post'],'/add', [CustomersController::class, 'insert'])->name('customers->insert');
//    Route::match(['get', 'post'],'/edit/{id}', [CustomersController::class, 'update'])->name('customers->edit');
//    Route::match(['get', 'post'],'/delete/{id}', [CustomersController::class, 'delete'])->middleware('check_user_level_for_rights_to_delete_customers')->name('customers->delete');
//    Route::match(['get', 'post'],'/notes/{id}', [CustomersController::class, 'insert_note'])->name('customers->insert_note');
//    Route::match(['get', 'post'],'/comments/{id}', [CustomersController::class, 'insert_internal_comment'])->name('customers->insert_internal_comment');
//    Route::match(['get', 'post'],'/upload-document/{id}', [CustomersController::class, 'upload_document'])->name('customers->upload_document');
//    Route::match(['get', 'post'],'/delete-uploaded-document', [CustomersController::class, 'delete_uploaded_document'])->name('customers->delete_uploaded_document');
//    Route::match(['get', 'post'],'/defence-asylum/{id}', [CustomersController::class, 'defence_asylum'])->name('customers->defence_asylum');
//    Route::match(['get', 'post'],'/make-a-payment', [CustomersController::class, 'make_a_payment'])->name('customers->make_a_payment');
//    Route::match(['get', 'post'],'/send-required-documents', [CustomersController::class, 'send_required_documents'])->name('customers->send_required_documents');
//});

Route::group(['prefix' => 'clients',  'middleware' => 'auth'], function() {
    Route::get('/', [ClientController::class, 'show'])->name('clients->show');
    Route::match(['get', 'post'],'/add', [ClientController::class, 'insert'])->name('clients->insert');
    Route::match(['get', 'post'],'/edit/{id}', [ClientController::class, 'update'])->name('clients->edit');
    Route::match(['get', 'post'],'/delete/{id}', [ClientController::class, 'delete'])->middleware('check_user_level_for_rights_to_delete_customers')->name('clients->delete');
});

Route::group(['prefix' => 'family-members',  'middleware' => 'auth'], function() {
    Route::match(['get', 'post'],'/client/{client_id}/family-member/edit/{family_member_id}', [FamilyMemberController::class, 'edit'])->name('family_members->edit');
    Route::match(['get', 'post'],'/client/{client_id}/family-member/delete/{family_member_id}', [FamilyMemberController::class, 'delete'])->name('family_members->delete');
});

Route::group(['prefix' => 'cases',  'middleware' => 'auth'], function() {
    Route::get('/', [CaseController::class, 'show'])->name('cases->show');
    Route::match(['get', 'post'],'/add', [CaseController::class, 'insert'])->name('cases->insert');
    Route::match(['get', 'post'],'/edit/{id}', [CaseController::class, 'update'])->name('cases->edit');
    Route::match(['get', 'post'],'/delete/{id}', [CaseController::class, 'delete'])->middleware('check_user_level_for_rights_to_delete_customers')->name('cases->delete');
    Route::match(['get', 'post'],'/defence-asylum/{id}', [CaseController::class, 'defence_asylum'])->name('cases->defence_asylum');
    Route::match(['get', 'post'],'/notes/{id}', [CaseController::class, 'insert_note'])->name('cases->insert_note');
    Route::match(['get', 'post'],'/comments/{id}', [CaseController::class, 'insert_internal_comment'])->name('cases->insert_internal_comment');
    Route::match(['get', 'post'],'/upload-document/{id}', [CaseController::class, 'upload_document'])->name('cases->upload_document');
    Route::match(['get', 'post'],'/delete-uploaded-document', [CaseController::class, 'delete_uploaded_document'])->name('cases->delete_uploaded_document');
    Route::match(['get', 'post'],'/send-required-documents', [CaseController::class, 'send_required_documents'])->name('cases->send_required_documents');
    Route::match(['get', 'post'],'/add-todo-task', [TodoTaskController::class, 'store'])->name('cases->add_todo_task');
    Route::match(['get', 'post'],'/mark-as-complete-todo-task', [TodoTaskController::class, 'update'])->name('cases->mark_as_complete_todo_task');

    Route::match(['get'],'/entry-date/{entry_date_id}/edit', [EntryDateController::class, 'edit'])->name('entry_date->edit');
    Route::match(['put'],'/entry-date/{entry_date_id}/update', [EntryDateController::class, 'update'])->name('entry_date->update');
    Route::match(['get'],'/entry-date/{entry_date_id}/delete', [EntryDateController::class, 'delete'])->name('entry_date->delete');
    Route::match(['delete'],'/entry-date/{entry_date_id}/destroy', [EntryDateController::class, 'destroy'])->name('entry_date->destroy');


    Route::match(['get'],'/employment-within-last-five-years/{entry_date_id}/edit', [EmploymentWithinLastFiveYearsController::class, 'edit'])->name('employment_within_last_five_years->edit');
    Route::match(['put'],'/employment-within-last-five-years/{entry_date_id}/update', [EmploymentWithinLastFiveYearsController::class, 'update'])->name('employment_within_last_five_years->update');
    Route::match(['get'],'/employment-within-last-five-years/{entry_date_id}/delete', [EmploymentWithinLastFiveYearsController::class, 'delete'])->name('employment_within_last_five_years->delete');
    Route::match(['delete'],'/employment-within-last-five-years/{entry_date_id}/destroy', [EmploymentWithinLastFiveYearsController::class, 'destroy'])->name('employment_within_last_five_years->destroy');

    Route::match(['get'],'/residency-within-five-years/{entry_date_id}/edit', [ResidencyWithinFiveYearsController::class, 'edit'])->name('residency_within_five_years->edit');
    Route::match(['put'],'/residency-within-five-years/{entry_date_id}/update', [ResidencyWithinFiveYearsController::class, 'update'])->name('residency_within_five_years->update');
    Route::match(['get'],'/residency-within-five-years/{entry_date_id}/delete', [ResidencyWithinFiveYearsController::class, 'delete'])->name('residency_within_five_years->delete');
    Route::match(['delete'],'/residency-within-five-years/{entry_date_id}/destroy', [ResidencyWithinFiveYearsController::class, 'destroy'])->name('residency_within_five_years->destroy');

});

Route::group(['prefix' => 'api-connections',  'middleware' => 'auth'], function() {
    Route::match(['get', 'post'],'/twilio', [TwilioApiDetailsController::class, 'show'])->name('api_connections->twilio');
    Route::match(['get', 'post'],'/twilio-status-callback', [TwilioApiDetailsController::class, 'status_callback'])->name('api_connections->twilio_status_callback');
});

Route::group(['prefix' => 'system-status',  'middleware' => 'auth'], function() {
    Route::match(['get', 'post'],'/twilio', [SystemStatusController::class, 'twilio_messaging'])->name('system_status->twilio');
});

Route::group(['prefix' => 'riders'], function() {
    Route::match(['post'],'/', [RiderController::class, 'index'])->name('riders');
    Route::match(['post'],'/add', [RiderController::class, 'store'])->name('riders->add');
    Route::match(['get'],'/{rider_id}/edit', [RiderController::class, 'edit'])->name('riders->edit');
    Route::match(['put'],'/{rider_id}/update', [RiderController::class, 'update'])->name('riders->update');
    Route::match(['get'],'/{rider_id}/delete', [RiderController::class, 'delete'])->name('riders->delete');
    Route::match(['delete'],'/{rider_id}/destroy', [RiderController::class, 'destroy'])->name('riders->destroy');
});

Route::group(['prefix' => 'calendar'], function() {
    Route::match(['get'],'/', [CalendarController::class, 'index'])->name('calendar->index');
    Route::match(['post'],'/get-records', [CalendarController::class, 'get_records'])->name('calendar->get_records');
});

Route::group(['prefix' => 'notifications', 'middleware' => 'auth'], function () {
    Route::match(['get'], '/listen', [NotificationController::class, 'index'])->name('notification->index');
});

Route::group(['domain' => 'portal.nydt.law'], function() { // TODO: Prod: portal.nydt.law Staging: portal-staging.nydt.law
    Route::group(['prefix' => 'portal'], function(){
        Route::match(['get', 'post'],'/login', [PortalAuthController::class, 'login'])->middleware('portal_auth_check')->name('portal->login->show');
        Route::match(['get', 'post'],'/forgot-password', [PortalAuthController::class, 'forgot_password'])->middleware('portal_auth_check')->name('portal->forgot_password->show');
        Route::match(['get', 'post'],'/change-password/{token}', [PortalAuthController::class, 'change_password'])->middleware('portal_auth_check')->name('portal->change_password->show');
        Route::match(['get', 'post'],'/logout', [PortalAuthController::class, 'logout'])->name('portal->logout');
        Route::match(['get', 'post'],'/set-password/{token}', [PortalAuthController::class, 'set_password'])->middleware('portal_auth_check')->name('portal->set-password->show');
        Route::match(['get', 'post'],'/dashboard', [PortalDashboardController::class, 'show'])->middleware('portal_auth')->name('portal->dashboard->show');
        Route::match(['get', 'post'],'/profile', [PortalCustomerProfileController::class, 'show'])->middleware('portal_auth')->name('portal->profile->show');
        Route::match(['get', 'post'],'/case-history', [PortalCustomerCaseHistoryController::class, 'show'])->middleware('portal_auth')->name('portal->case_history->show');
        Route::match(['get', 'post'],'/upload-documents/{case_id}', [PortalCustomerUploadDocuments::class, 'show'])->middleware('portal_auth')->name('portal->upload_documents->show');
        Route::match(['get', 'post'],'/case/{case_id}', [PortalCaseController::class, 'show'])->middleware('portal_auth')->name('portal->case->show');
    });
});


Route::group(['prefix' => 'datatables', 'middleware' => ['auth']], function(){
    Route::get('/users/show', [DatatablesController::class, 'users_show'])->middleware('is_admin')->name('datatables-users_show');
    Route::get('/attorneys/show', [DatatablesController::class, 'attorneys_show'])->middleware('is_admin')->name('datatables-attorneys_show');
    Route::get('/customers/show', [DatatablesController::class, 'customers_show'])->name('datatables-customers_show');
    Route::get('/clients/show', [DatatablesController::class, 'clients_show'])->name('datatables->clients_show');
    Route::get('/cases/show', [DatatablesController::class, 'cases_show'])->name('datatables-cases_show');
    Route::get('/system-status/twilio-messaging', [DatatablesController::class, 'system_status_twilio_messaging_show'])->name('datatables-system_status_twilio_messaging_show');
});




