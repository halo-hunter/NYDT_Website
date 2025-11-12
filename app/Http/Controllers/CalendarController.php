<?php

namespace App\Http\Controllers;

use App\Models\Crm\CaseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function index()
    {
        return view('crm.pages.calendar.index');
    }

    public function get_records()
    {
        $cases__scheduled_biometric_appointment_datetime = CaseModel::select(
            'cases.id AS url',
            'scheduled_biometric_appointment_datetime AS start',
            DB::raw("CONCAT(clients.firstname, ' ', clients.lastname, ' | ', cases.id, ' | Scheduled Biometric Appointment Datetime') AS title")
        )
            ->join('client_case', 'cases.id', '=', 'client_case.case_id')
            ->join('clients', 'client_case.client_id', '=', 'clients.id')
            ->whereNotNull('scheduled_biometric_appointment_datetime')
            ->get()
            ->toArray();

        $cases__scheduled_biometric_appointment_datetime = array_map(function ($item) {
            $item = (array) $item;
            $item['url'] = route('cases->edit', $item['url']);
            return $item;
        }, $cases__scheduled_biometric_appointment_datetime);

        $cases__due_dates = DB::table('cases')
            ->select(
                'cases.id AS url',
                DB::raw("jt.due_date AS start"),
                DB::raw("CONCAT('Due time | ', clients.firstname, ' ', clients.lastname, ' | ', cases.id) AS title")
            )
            ->join(DB::raw("JSON_TABLE(cases.due_date, '$[*]' COLUMNS (due_date VARCHAR(255) PATH '$')) AS jt"), function ($join) {
                $join->whereNotNull('jt.due_date');
            })
            ->join('client_case', 'cases.id', '=', 'client_case.case_id')
            ->join('clients', 'client_case.client_id', '=', 'clients.id')
            ->get()
            ->toArray();

        $cases__due_dates = array_map(function ($item) {
            $item = (array) $item;
            $item['url'] = route('cases->edit', $item['url']);
            return $item;
        }, $cases__due_dates);

        $cases__interview_datetime = CaseModel::select(
            'cases.id AS url',
            'interview_datetime AS start',
            DB::raw("CONCAT(clients.firstname, ' ', clients.lastname, ' | ', cases.id, ' | Interview Datetime') AS title")
        )
            ->join('client_case', 'cases.id', '=', 'client_case.case_id')
            ->join('clients', 'client_case.client_id', '=', 'clients.id')
            ->whereNotNull('interview_datetime')
            ->get()
            ->toArray();

        $cases__interview_datetime = array_map(function ($item) {
            $item = (array) $item;
            $item['url'] = route('cases->edit', $item['url']);
            return $item;
        }, $cases__interview_datetime);

        $data = array_merge(
            $cases__scheduled_biometric_appointment_datetime,
            $cases__interview_datetime,
            $cases__due_dates
        );

        return json_encode($data);

    }
}
