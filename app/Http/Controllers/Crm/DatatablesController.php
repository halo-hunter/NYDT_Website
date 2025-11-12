<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Crm\Attorneys;
use App\Models\Crm\CaseModel;
use App\Models\Crm\Client;
use App\Models\Crm\Customers;
use App\Models\Crm\SmsLog;
use App\Models\Crm\States;
use App\Models\Crm\UserLevel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DatatablesController extends Controller
{
    public function users_show() {
        $query = User::all();

        return datatables($query)
            ->editColumn('created_at', function($query) {
                return Carbon::parse($query->created_at)->format('m/d/Y H:i');
            })
            ->editColumn('updated_at', function($query) {
                return Carbon::parse($query->updated_at)->format('m/d/Y H:i');
            })
            ->editColumn('user_level', function($query) {
                return "<span class='text-capitalize'>" . UserLevel::where('user_level_id', $query['user_level_id'])->first()->user_level_name . "</span>";
            })
            ->addColumn('actions', function ($query) {
                if ($query['id'] == Auth::id()) {
                    return '<div class="d-flex order-actions" id="table_delete_edit_buttons_div_id">
                        <a href="users/edit/' . $query['id'] . '" class="bg-warning text-white"><i class="bx bxs-edit"></i></a>
                    </div>';
                } else {
                    return '<div class="d-flex order-actions" id="table_delete_edit_buttons_div_id">
                        <a href="users/edit/' . $query['id'] . '" class="bg-warning text-white"><i class="bx bxs-edit"></i></a>
                        <a href="users/delete/' . $query['id'] . '" class="ms-2 bg-danger text-white"><i class="bx bx bxs-trash"></i></a>
                    </div>';
                }
            })
            ->rawColumns(['user_level', 'actions'])->toJson();
    }

    public function attorneys_show() {
        $query = Attorneys::all();
        return datatables($query)
            ->editColumn('created_at', function($query) {
                return Carbon::parse($query->created_at)->format('m/d/Y H:i');
            })
            ->editColumn('updated_at', function($query) {
                return Carbon::parse($query->updated_at)->format('m/d/Y H:i');
            })
            ->editColumn('company_address_state_code', function($query) {
                return States::where('state_code', $query['company_address_state_code'])->first()->state_name;
            })
            ->editColumn('phone', function($query) {
                return GenericController::format_phone_number_to_us_format($query->phone);
            })
            ->editColumn('email', function($query) {
                return "<span class='text-lowercase'>$query->email</span>";
            })
            ->addColumn('actions', function ($query) {
                return '<div class="d-flex order-actions" id="table_delete_edit_buttons_div_id">
                        <a href="attorneys/edit/' . $query['id'] . '" class="bg-warning text-white"><i class="bx bxs-edit"></i></a>
                        <a href="attorneys/delete/' . $query['id'] . '" class="ms-2 bg-danger text-white"><i class="bx bx bxs-trash"></i></a>
                    </div>';
            })
            ->rawColumns(['company_address_state_code', 'actions', 'email'])->toJson();
    }

    public function customers_show() {
        $query = Customers::all();
        return datatables($query)
            ->editColumn('firstname', function($query) {
                return '<a href="customers/edit/' . $query['id'] . '">' . $query['firstname'] . '</a>';
            })
            ->editColumn('lastname', function($query) {
                return '<a href="customers/edit/' . $query['id'] . '">' . $query['lastname'] . '</a>';
            })
            ->editColumn('created_at', function($query) {
                return Carbon::parse($query->created_at)->format('m/d/Y H:i');
            })
            ->editColumn('updated_at', function($query) {
                return Carbon::parse($query->updated_at)->format('m/d/Y H:i');
            })
            ->editColumn('attorney_id', function($query) {
                if ($query['attorney_id'] != 0) {
                    return Attorneys::where('id', $query['attorney_id'])->first()->company_name . " (" . Attorneys::where('id', $query['attorney_id'])->first()->firstname . " " . Attorneys::where('id', $query['attorney_id'])->first()->lastname . ")";
                }
            })
            ->addColumn('actions', function ($query) {
                $get_auth_user_level_id = DB::table('users')->where('id', Auth::id())->first()->user_level_id;
                if ($get_auth_user_level_id == 1) {
                    return '<div class="d-flex order-actions" id="table_delete_edit_buttons_div_id">
                        <a href="customers/edit/' . $query['id'] . '" class="bg-warning text-white"><i class="bx bxs-edit"></i></a>
                        <a href="customers/delete/' . $query['id'] . '" class="ms-2 bg-danger text-white"><i class="bx bx bxs-trash"></i></a>
                    </div>';
                } else {
                    return '<div class="d-flex order-actions" id="table_delete_edit_buttons_div_id">
                        <a href="customers/edit/' . $query['id'] . '" class="bg-warning text-white"><i class="bx bxs-edit"></i></a>
                    </div>';
                }
            })
            ->rawColumns(['lastname', 'firstname', 'attorney_id', 'actions'])->toJson();
    }
    public function clients_show() {
        $query = Client::orderby('lastname', 'asc')->get();
        return datatables($query)
            ->editColumn('firstname', function($query) {
                return '<a href="clients/edit/' . $query['id'] . '" class="text-capitalize">' . $query['firstname'] . '</a>';
            })
            ->editColumn('lastname', function($query) {
                return '<a href="clients/edit/' . $query['id'] . '" class="text-capitalize">' . $query['lastname'] . '</a>';
            })
            ->editColumn('created_at', function($query) {
                return Carbon::parse($query->created_at)->format('m/d/Y H:i');
            })
            ->editColumn('updated_at', function($query) {
                return Carbon::parse($query->updated_at)->format('m/d/Y H:i');
            })
            ->editColumn('phone', function($query) {
                return GenericController::format_phone_number_to_us_format($query['phone']);
            })
            ->editColumn('cases', function($query) {
                $client = Client::find($query['id']);
                $count_cases = $client->cases()->count();
                // return "<a href='" . route('cases->show') . "' target='_blank'>$count_cases</a>";
                return $count_cases;
            })
            ->addColumn('actions', function ($query) {
                $get_auth_user_level_id = DB::table('users')->where('id', Auth::id())->first()->user_level_id;

                $client = Client::find($query['id']);
                $count_cases = $client->cases()->count();

                if ($get_auth_user_level_id == 1 && $count_cases == 0) {
                    return '<div class="d-flex order-actions" id="table_delete_edit_buttons_div_id">
                        <a href="clients/edit/' . $query['id'] . '" class="bg-warning text-white"><i class="bx bxs-edit"></i></a>
                        <a href="clients/delete/' . $query['id'] . '" class="ms-2 bg-danger text-white"><i class="bx bx bxs-trash"></i></a>
                    </div>';
                } else {
                    return '<div class="d-flex order-actions" id="table_delete_edit_buttons_div_id">
                        <a href="clients/edit/' . $query['id'] . '" class="bg-warning text-white"><i class="bx bxs-edit"></i></a>
                    </div>';
                }
            })
            ->rawColumns(['lastname', 'firstname', 'phone', 'cases', 'actions'])->toJson();
    }

    public function cases_show() {
        $query = CaseModel::all();



        return datatables($query)




            ->editColumn('firstname', function($query) {
                $case = CaseModel::find($query['id']);
                $client = $case->client()->first();
                return '<a href="cases/edit/' . $query['id'] . '" class="text-capitalize">' . $client->firstname . '</a>';
            })
            ->editColumn('lastname', function($query) {
                $case = CaseModel::find($query['id']);
                $client = $case->client()->first();
                return '<a href="cases/edit/' . $query['id'] . '" class="text-capitalize">' . $client->lastname . '</a>';
            })
            ->editColumn('email', function($query) {
                $case = CaseModel::find($query['id']);
                $client = $case->client()->first();
                return $client->email;
            })
            ->editColumn('phone', function($query) {
                $case = CaseModel::find($query['id']);
                $client = $case->client()->first();
                return GenericController::format_phone_number_to_us_format($client->phone);
            })
            ->editColumn('created_at', function($query) {
                return Carbon::parse($query->created_at)->format('m/d/Y H:i');
            })
            ->editColumn('updated_at', function($query) {
                return Carbon::parse($query->updated_at)->format('m/d/Y H:i');
            })
            ->editColumn('attorney_id', function($query) {
                if ($query['attorney_id'] != 0) {
                    return Attorneys::where('id', $query['attorney_id'])->first()->company_name . " (" . Attorneys::where('id', $query['attorney_id'])->first()->firstname . " " . Attorneys::where('id', $query['attorney_id'])->first()->lastname . ")";
                }
            })
            ->addColumn('actions', function ($query) {
                $get_auth_user_level_id = DB::table('users')->where('id', Auth::id())->first()->user_level_id;
                if ($get_auth_user_level_id == 1) {
                    return '<div class="d-flex order-actions" id="table_delete_edit_buttons_div_id">
                        <a href="cases/edit/' . $query['id'] . '" class="bg-warning text-white"><i class="bx bxs-edit"></i></a>
                        <a href="cases/delete/' . $query['id'] . '" class="ms-2 bg-danger text-white"><i class="bx bx bxs-trash"></i></a>
                    </div>';
                } else {
                    return '<div class="d-flex order-actions" id="table_delete_edit_buttons_div_id">
                        <a href="cases/edit/' . $query['id'] . '" class="bg-warning text-white"><i class="bx bxs-edit"></i></a>
                    </div>';
                }
            })
            ->rawColumns(['lastname', 'firstname', 'attorney_id', 'actions'])->toJson();
    }

    public function system_status_twilio_messaging_show() {
        $query = SmsLog::all();



        return datatables($query)
            ->editColumn('client_id', function($query) {
                $client_firstname = Client::where('id', $query->client_id)->first()->firstname;
                $client_lastname = Client::where('id', $query->client_id)->first()->lastname;
                $client_profile_url = route('clients->edit', ['id' => $query->client_id]);
                return "<a href='$client_profile_url' target='_blank' class='text-capitalize'>$client_lastname $client_firstname</a>";
            })
            ->editColumn('case_id', function($query) {
                $case_id = $query->case_id;
                $case_url = route('cases->edit', ['id' => $query->case_id]);
                return "<a href='$case_url' target='_blank' class='text-capitalize'>$case_id</a>";
            })
            ->editColumn('phone_number', function($query) {
                return "+" . $query->phone_number;
            })
            ->editColumn('status', function($query) {
                if ($query->status == 1) {
                    return "<span class='text-success'>Success</span>";
                } elseif ($query->status == 0) {
                    return "<span class='text-danger'>Fail</span>";
                }
            })
            ->editColumn('created_at', function($query) {
                return Carbon::parse($query->updated_at)->format('m/d/Y H:i');
            })
            ->rawColumns(['status', 'client_id', 'case_id'])
            ->toJson();
    }



}
