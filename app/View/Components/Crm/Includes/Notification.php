<?php

namespace App\View\Components\Crm\Includes;

use App\Models\Crm\TodoTask;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Notification extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $unseen_todo_tasks = count(TodoTask::where('assigned_to', Auth::id())->where('seen', 0)->orderBy('id', 'DESC')->get());
        $todo_tasks = TodoTask::where('assigned_to', Auth::id())->orderBy('id', 'DESC')->get();

        $notification_items = [];

        foreach ($todo_tasks as $todo_task) {

            array_push($notification_items, [
                'record_id' => $todo_task->id,
                'object_type' => 'case',
                'object_id' => $todo_task->case,
                'object_time' => $todo_task->created_at->diffForHumans(),
                'object_seen_status' => $todo_task->seen,
            ]);
        }

        $notifications =  collect($notification_items);

        $data = [
            'notifications' => $notifications,
            'unseen_todo_tasks' => $unseen_todo_tasks
        ];

        return view('components.crm.includes.notification', $data);
    }
}
