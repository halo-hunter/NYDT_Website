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
                return $query->created_at ? e(Carbon::parse($query->created_at)->format('m/d/Y H:i')) : '';
            })
            ->editColumn('updated_at', function($query) {
                return $query->updated_at ? e(Carbon::parse($query->updated_at)->format('m/d/Y H:i')) : '';
            })
            ->editColumn('user_level', function($query) {
                $level = UserLevel::where('user_level_id', $query['user_level_id'])->first();
                $label = $level ? e($level->user_level_name) : 'n/a';
                return "<span class='text-capitalize'>{$label}</span>";
            })
            ->addColumn('actions', function ($query) {
                $id = e($query['id']);
                if ($query['id'] == Auth::id()) {
                    return '<div class="d-flex order-actions" id="table_delete_edit_buttons_div_id">
                        <a href="users/edit/' . $id . '" class="bg-warning text-white"><i class="bx bxs-edit"></i></a>
                    </div>';
                } else {
                    return '<div class="d-flex order-actions" id="table_delete_edit_buttons_div_id">
                        <a href="users/edit/' . $id . '" class="bg-warning text-white"><i class="bx bxs-edit"></i></a>
                        <a href="users/delete/' . $id . '" class="ms-2 bg-danger text-white"><i class="bx bx bxs-trash"></i></a>
                    </div>';
                }
            })
            ->rawColumns(['user_level', 'actions'])->toJson();
    }

    public function attorneys_show() {
        $query = Attorneys::all();
        return datatables($query)
            ->editColumn('created_at', function($query) {
                return $query->created_at ? Carbon::parse($query->created_at)->format('m/d/Y H:i') : '';
            })
            ->editColumn('updated_at', function($query) {
                return $query->updated_at ? Carbon::parse($query->updated_at)->format('m/d/Y H:i') : '';
            })
            ->editColumn('company_address_state_code', function($query) {
                $state = States::where('state_code', $query['company_address_state_code'])->first();
                return $state ? e($state->state_name) : '';
            })
            ->editColumn('phone', function($query) {
                return e(GenericController::format_phone_number_to_us_format($query->phone));
            })
            ->editColumn('email', function($query) {
                return "<span class='text-lowercase'>" . e($query->email) . "</span>";
            })
            ->addColumn('actions', function ($query) {
                $id = e($query['id']);
                return '<div class="d-flex order-actions" id="table_delete_edit_buttons_div_id">
                        <a href="attorneys/edit/' . $id . '" class="bg-warning text-white"><i class="bx bxs-edit"></i></a>
                        <a href="attorneys/delete/' . $id . '" class="ms-2 bg-danger text-white"><i class="bx bx bxs-trash"></i></a>
                    </div>';
            })
            ->rawColumns(['company_address_state_code', 'actions', 'email'])->toJson();
    }

    public function customers_show() {
        $query = Customers::all();
        return datatables($query)
            ->editColumn('firstname', function($query) {
                $id = e($query['id']);
                $name = e($query['firstname']);
                return '<a href="customers/edit/' . $id . '">' . $name . '</a>';
            })
            ->editColumn('lastname', function($query) {
                $id = e($query['id']);
                $name = e($query['lastname']);
                return '<a href="customers/edit/' . $id . '">' . $name . '</a>';
            })
            ->editColumn('created_at', function($query) {
                return $query->created_at ? Carbon::parse($query->created_at)->format('m/d/Y H:i') : '';
            })
            ->editColumn('updated_at', function($query) {
                return $query->updated_at ? Carbon::parse($query->updated_at)->format('m/d/Y H:i') : '';
            })
            ->editColumn('attorney_id', function($query) {
                if ($query['attorney_id'] != 0) {
                    $attorney = Attorneys::where('id', $query['attorney_id'])->first();
                    if (! $attorney) {
                        return '';
                    }
                    return e($attorney->company_name . " (" . $attorney->firstname . " " . $attorney->lastname . ")");
                }
            })
            ->addColumn('actions', function ($query) {
                $get_auth_user_level_id = DB::table('users')->where('id', Auth::id())->first()->user_level_id;
                if ($get_auth_user_level_id == 1) {
                    $id = e($query['id']);
                    return '<div class="d-flex order-actions" id="table_delete_edit_buttons_div_id">
                        <a href="customers/edit/' . $id . '" class="bg-warning text-white"><i class="bx bxs-edit"></i></a>
                        <a href="customers/delete/' . $id . '" class="ms-2 bg-danger text-white"><i class="bx bx bxs-trash"></i></a>
                    </div>';
                } else {
                    $id = e($query['id']);
                    return '<div class="d-flex order-actions" id="table_delete_edit_buttons_div_id">
                        <a href="customers/edit/' . $id . '" class="bg-warning text-white"><i class="bx bxs-edit"></i></a>
                    </div>';
                }
            })
            ->rawColumns(['lastname', 'firstname', 'attorney_id', 'actions'])->toJson();
    }
    public function clients_show() {
        $query = Client::orderby('lastname', 'asc')->get();
        return datatables($query)
            ->editColumn('firstname', function($query) {
                $id = e($query['id']);
                $name = e($query['firstname']);
                return '<a href="clients/edit/' . $id . '" class="text-capitalize">' . $name . '</a>';
            })
            ->editColumn('lastname', function($query) {
                $id = e($query['id']);
                $name = e($query['lastname']);
                return '<a href="clients/edit/' . $id . '" class="text-capitalize">' . $name . '</a>';
            })
            ->editColumn('created_at', function($query) {
                return $query->created_at ? Carbon::parse($query->created_at)->format('m/d/Y H:i') : '';
            })
            ->editColumn('updated_at', function($query) {
                return $query->updated_at ? Carbon::parse($query->updated_at)->format('m/d/Y H:i') : '';
            })
            ->editColumn('phone', function($query) {
                return e(GenericController::format_phone_number_to_us_format($query['phone']));
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
                    $id = e($query['id']);
                    return '<div class="d-flex order-actions" id="table_delete_edit_buttons_div_id">
                        <a href="clients/edit/' . $id . '" class="bg-warning text-white"><i class="bx bxs-edit"></i></a>
                        <a href="clients/delete/' . $id . '" class="ms-2 bg-danger text-white"><i class="bx bx bxs-trash"></i></a>
                    </div>';
                } else {
                    $id = e($query['id']);
                    return '<div class="d-flex order-actions" id="table_delete_edit_buttons_div_id">
                        <a href="clients/edit/' . $id . '" class="bg-warning text-white"><i class="bx bxs-edit"></i></a>
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
                $id = e($query['id']);
                return '<a href="cases/edit/' . $id . '" class="text-capitalize">' . e($client->firstname) . '</a>';
            })
            ->editColumn('lastname', function($query) {
                $case = CaseModel::find($query['id']);
                $client = $case->client()->first();
                $id = e($query['id']);
                return '<a href="cases/edit/' . $id . '" class="text-capitalize">' . e($client->lastname) . '</a>';
            })
            ->editColumn('email', function($query) {
                $case = CaseModel::find($query['id']);
                $client = $case->client()->first();
                return e($client->email);
            })
            ->editColumn('phone', function($query) {
                $case = CaseModel::find($query['id']);
                $client = $case->client()->first();
                return e(GenericController::format_phone_number_to_us_format($client->phone));
            })
            ->editColumn('created_at', function($query) {
                return Carbon::parse($query->created_at)->format('m/d/Y H:i');
            })
            ->editColumn('updated_at', function($query) {
                return $query->updated_at ? Carbon::parse($query->updated_at)->format('m/d/Y H:i') : '';
            })
            ->editColumn('attorney_id', function($query) {
                if ($query['attorney_id'] != 0) {
                    return Attorneys::where('id', $query['attorney_id'])->first()->company_name . " (" . Attorneys::where('id', $query['attorney_id'])->first()->firstname . " " . Attorneys::where('id', $query['attorney_id'])->first()->lastname . ")";
                }
            })
            ->addColumn('actions', function ($query) {
                $get_auth_user_level_id = DB::table('users')->where('id', Auth::id())->first()->user_level_id;
                $id = e($query['id']);
                if ($get_auth_user_level_id == 1) {
                    return '<div class="d-flex order-actions" id="table_delete_edit_buttons_div_id">
                        <a href="cases/edit/' . $id . '" class="bg-warning text-white"><i class="bx bxs-edit"></i></a>
                        <a href="cases/delete/' . $id . '" class="ms-2 bg-danger text-white"><i class="bx bx bxs-trash"></i></a>
                    </div>';
                } else {
                    return '<div class="d-flex order-actions" id="table_delete_edit_buttons_div_id">
                        <a href="cases/edit/' . $id . '" class="bg-warning text-white"><i class="bx bxs-edit"></i></a>
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
                return $query->updated_at ? Carbon::parse($query->updated_at)->format('m/d/Y H:i') : '';
            })
            ->rawColumns(['status', 'client_id', 'case_id'])
            ->toJson();
    }



}
