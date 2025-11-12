<div class="row mt-5">
    <div class="col-12">
        <h6>Todo Tasks</h6>
    </div>
    <div class="col-12">
        <div class="border border-2 rounded notes_content_block_class">
            <div class="notes_content_inside_block_class">
                <div class="row">
                    @forelse(\App\Models\Crm\TodoTask::where('case', $id)->orderBy('id', 'desc')->get() as $todo_task)
                        <div class="col-12 bg-light border-bottom border-1">
                            <div class="m-2">
                                <div class="row">
                                    <div class="col-12 notes_show_block_text_class">
                                        @if($todo_task->status == 1)
                                            <div class="row">
                                                <div class="col-12">
                                                    <del>{{ $todo_task->description }}</del>
                                                </div>
                                                <div class="col-12">
                                                    <label for="">Complete time:</label> {{ \Carbon\Carbon::parse($todo_task->complete_time)->format('m/d/Y H:i') }}
                                                </div>
                                                <div class="col-12 mt-1">
                                                    <label for="">Spent:</label> {{ explode(':', $todo_task->spent_hours)[0] }} Hours and {{ explode(':', $todo_task->spent_hours)[1] }} Minutes
                                                </div>
                                            </div>
                                        @else
                                            {{ $todo_task->description }}
                                        @endif
                                    </div>
                                    <div class="col-12 mt-1">
                                        Assigned to: {{ \App\Models\User::where('id', $todo_task->assigned_to)->first()->firstname }} {{ \App\Models\User::where('id', $todo_task->assigned_to)->first()->lastname }}
                                    </div>
                                    @if($todo_task->status == 0 && $todo_task->assigned_to == \Illuminate\Support\Facades\Auth::id())
                                        <div class="com-12 mt-1">
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#mark_as_complete_todo_task_modal_id" id="mark_as_complete_todo_task_button_id" data-todo_task_id="{{ $todo_task->id }}">Mark as complete</button>
                                        </div>
                                    @endif
                                    <div class="col-6 text-start mt-1">
                                        <small>Author: {{ \App\Models\User::where('id', $todo_task->author)->first()->firstname }} {{ \App\Models\User::where('id', $todo_task->author)->first()->lastname }}</small>
                                    </div>
                                    <div class="col-6 text-end mt-1">
                                        <small>{{ \Carbon\Carbon::parse($todo_task->created_at)->format('m/d/Y H:i') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center mt-5">Todo Tasks not found</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <button class="btn-primary btn mt-2 text-capitalize" data-bs-toggle="modal" data-bs-target="#add_todo_task_modal_id">Add a task</button>
    </div>
</div>
