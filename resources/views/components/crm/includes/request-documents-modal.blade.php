@if(request()->route()->getName() == 'cases->edit')

    <!-- Modal -->
    <div class="modal fade" id="cases_request_documents_button_id" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Request Documents</h1>
                    <button type="button" class="btn-close requested_documents_modal_close_button_class" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        @if($client->email != '')
                            <input type="text" id="case_id" value="{{ last(request()->segments()) }}" class="d-none">
                            @forelse(\App\Models\Crm\AdditionalDocumentTypesListForCase::all() as $document_type)
                                <div class="form-check">
                                    <input class="form-check-input customer_document_checkbox_class" type="checkbox" name="customer_document[]" value="{{ $document_type->document_name }}" id="flexCheckDefault_{{ $document_type->id }}">
                                    <label class="form-check-label text-capitalize" for="flexCheckDefault_{{ $document_type->id }}">
                                        {{ $document_type->document_name }}
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
                        <button type="button" class="btn btn-primary request_documents_form_class" @if($client->email == '') hidden="yes" @endif id="request_documents_form_id">Send Email</button>
                        <button type="button" class="btn btn-secondary requested_documents_modal_close_button_class" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endif
