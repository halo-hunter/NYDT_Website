<?php

namespace App\View\Components\Crm\Includes;

use App\Models\Crm\TodoTask;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class TodoTasks extends Component
{
    public $id;

    /**
     * Create a new component instance.
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data = [
            'test' => 'test 2 te',
            'todo_tasks' => TodoTask::where('case', $this->id)->where('author', Auth::id())->get(),
        ];

        return view('components.crm.includes.todo-tasks', $data);
    }
}
