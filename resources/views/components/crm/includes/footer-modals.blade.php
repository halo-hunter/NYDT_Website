@if(request()->route()->getName() == 'customers->edit')

    <!-- Modal -->
    <div class="modal fade" id="customer_request_documents_button_id" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Request Documents</h1>
                    <button type="button" class="btn-close requested_documents_modal_close_button_class" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        @if(\App\Models\Crm\Customers::where('id', last(request()->segments()))->first()->email != '')
                            <input type="text" id="customer_id" value="{{ last(request()->segments()) }}" class="d-none">
                            @forelse(\App\Models\Crm\CustomerDocumentList::all() as $customer_document)
                                <div class="form-check">
                                    <input class="form-check-input customer_document_checkbox_class" type="checkbox" name="customer_document[]" value="{{ $customer_document->document_name }}" id="flexCheckDefault_{{ $customer_document->id }}">
                                    <label class="form-check-label text-capitalize" for="flexCheckDefault_{{ $customer_document->id }}">
                                        {{ $customer_document->document_name }}
                                    </label>
                                </div>
                            @empty
                                Document type not found!
                            @endforelse
                            <div class="row">
                                <div class="col-8">
                                    {{--TODO: S other block Template--}}
                                    <div class="mb-3 mt-3 d-none other_block_class">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control form-control-sm other_block_input_class other_block_input_class_for_required_check" aria-label="Recipient's username" aria-describedby="button-addon2" placeholder="Type Your Own" value="">
                                            <button class="btn btn-sm btn-outline-danger other_block_input_remove_button_class" type="button" id="button-addon2">-</button>
                                        </div>
                                    </div>
                                    {{--TODO: E other block Template--}}
                                    <div class="mb-3 mt-2">
                                        <label for="exampleInputEmail1" class="form-label">Other</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control form-control-sm other_block_input_class_for_required_check" id="other_block_input_id" aria-label="Recipient's username" aria-describedby="button-addon2" placeholder="Type Your Own">
                                            <button class="btn btn-sm btn-outline-primary other_block_input_add_button_class" type="button" id="button-addon2" disabled>+</button>
                                            <small class="d-none max_allowed_document_types_message_class text-muted">Maximum 10 additional document types are allowed</small>
                                        </div>

                                    </div>
                                    <div class="cloned_other_blocks"></div>
                                    <div class="">
                                        <span class="text-danger d-none" id="required_message">
                                            One checkbox or field must be filled
                                        </span>
                                    </div>
                                    <div class="">
                                        <span class="text-success text-capitalize d-none" id="success_message_id"></span>
                                    </div>
                                    <div>
                                        <span class="text-danger text-capitalize d-none" id="error_message_id"></span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <span class="text-danger">Please fill client email address.</span>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary request_documents_form_class" @if(\App\Models\Crm\Customers::where('id', last(request()->segments()))->first()->email == '') hidden="yes" @endif id="request_documents_form_id">Send Email</button>
                        <button type="button" class="btn btn-secondary requested_documents_modal_close_button_class" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endif




@if(request()->route()->getName() == 'cases->edit')
    <!-- Modal -->
    <div class="modal fade" id="add_todo_task_modal_id" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add todo task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('cases->add_todo_task') }}" method="post" id="add_todo_task_form_id">
                    @csrf
                    <div class="modal-body" id="add_todo_task_modal_body_id">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Task definition</label>
                            <textarea class="form-control" rows="5" required name="task_definition" id="todo_add_task_task_definition_option_id"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Assign a task</label>
                            <select class="form-select text-capitalize" required name="assign_a_task" id="todo_add_task_select_a_user_select_id">
                                <option selected disabled value="">Select a user</option>
                                @foreach(\App\Models\User::where('id', '!=', \Illuminate\Support\Facades\Auth::id())->get() as $user)
                                    <option class="text-capitalize" value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }} ({{ \App\Models\Crm\UserLevel::where('user_level_id', $user->user_level_id)->first()->user_level_name }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="todo_add_task_button_id">Add</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="mark_as_complete_todo_task_modal_id" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mark as complete</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('cases->mark_as_complete_todo_task') }}" method="post" id="mark_as_complete_todo_task_form_id">
                    @csrf
                    <input type="text" id="todo_task_id_input_id" hidden name="todo_task_id">
                    <div class="modal-body" id="add_todo_task_modal_body_id">
                        <div class="mb-3">
                            <label class="form-label">Completion Date</label>
                            <input type="datetime-local" class="form-control" value="{{ date('Y-m-d H:i') }}" name="completion_date" required id="completion_date_input_id">
                            <div class="text-muted">Click the calendar icon</div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label">Time spent on task</label>
                                </div>
                                <div class="col-6">
                                    <div>Hours: </div> <input type="number" class="form-control w-100" id="mark_as_complete_hours_input_id" value="" name="mark_as_complete_hours" required>
                                </div>
                                <div class="col-6">
                                    <div>Minutes: </div> <input type="number" class="form-control w-100" id="mark_as_complete_minutes_input_id" value="00" name="mark_as_complete_minutes" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="modal_mark_as_complete_todo_task_button_id">Mark</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

@if(request()->route()->getName() == 'clients->edit')

    <!-- Modal -->
    <div class="modal fade" id="create_a_rider_profile_modal_id" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-capitalize" id="exampleModalLabel">Create a rider</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" id="add_todo_task_modal_body_id">

                    <input type="text" id="create_a_rider_modal_client_id" class="d-none">

                    <div class="alert alert-outline-danger shadow-sm alert-dismissible fade show d-none" id="rider_exists_alert_id">
                        <div>A rider with this firstname and lastname exists in the database.</div>
                        <button type="button" class="btn-close d-none" data-bs-dismiss="alert" aria-label="Close" id="rider_exists_alert_close_button_id"></button>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Firstname</label>
                        <input type="text" class="form-control w-100" id="add_rider_firstname_input_id" value="" name="firstname" required>
                        <small class="text-muted">Required</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lastname</label>
                        <input type="text" class="form-control w-100" id="add_rider_lastname_input_id" value="" name="lastname" required>
                        <small class="text-muted">Required</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">E-mail</label>
                        <input type="text" class="form-control w-100" id="add_rider_email_input_id" value="" name="rider_email>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Mobile</label>
                        <input type="text" class="form-control w-100" id="add_rider_phone_input_id" value="" name="rider_phone">
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="add_rider_button_id" disabled>Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="add_rider_close_button_id">Close</button>
                </div>
            </div>
        </div>
    </div>

@endif

<!-- Container + Toast -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="15000">
        <div class="toast-header">
            <strong class="me-auto">Notification</strong>
            <small>Just now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            You have a new notification.
        </div>
    </div>
</div>

