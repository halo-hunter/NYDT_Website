<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Crm\CaseModel;
use App\Models\Crm\TodoTask;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoTaskController extends Controller
{
    public function store(Request $request)
    {

        $case_id = last(explode('/', $request->header('referer')));

        if ($case_id != '' && CaseModel::find($case_id)) {

            $insert = TodoTask::insert([
                'case' => $case_id,
                'author' => Auth::id(),
                'assigned_to' => $request->assign_a_task,
                'description' => $request->task_definition,
                'created_at' => Carbon::now()
            ]);

            if ($insert) {

                return back()->withErrors([
                    "todo_task_added_successfully" => "Todo task added successfully"
                ]);

            }

        } else {

            return abort(404);

        }

    }

    public function update(Request $request) {

        $case_id = last(explode('/', $request->header('referer')));

        if ($case_id != '' && CaseModel::find($case_id)) {

            $update = TodoTask::where('id', $request->todo_task_id)->update([
                'status' => true,
                'complete_time' => $request->completion_date,
                'spent_hours' => $request->mark_as_complete_hours . ':' . $request->mark_as_complete_minutes,
                'created_at' => Carbon::now()
            ]);

            if ($update) {

                return back()->withErrors([
                    "todo_task_completed_successfully" => "Todo task completed successfully"
                ]);

            }

        } else {

            return abort(404);

        }

    }
}
