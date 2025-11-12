<x-crm.includes.header/>
<body>
<!--wrapper-->
<div class="wrapper">
    <!--start header wrapper-->
    <div class="header-wrapper">
        <!--start header -->
        <header>
            <x-crm.includes.dashboard-nav1/>
        </header>
        <!--end header -->
        <!--navigation-->
        <x-crm.includes.dashboard-nav2/>
        <!--end navigation-->
    </div>
    <!--end header wrapper-->
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <x-crm.includes.breadcrumb/>
            <!--end breadcrumb-->
            <div class="container-fluid">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card p-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            @error('attorney_profile_created_successfully')
                                            <small>
                                                <div class="alert alert-outline-success shadow-sm alert-dismissible fade show">
                                                    <div class="text-success text-capitalize">{{ $message }}</div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            </small>
                                            @enderror
                                            <form method="post" enctype="multipart/form-data" autocomplete="off">
                                                @csrf
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Client</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <select class="form-select text-capitalize single-select" aria-label="Default select example" name="client">
                                                            <option selected disabled>Select</option>
                                                            @foreach($clients as $client)
                                                                <option value="{{ $client->id }}" @if(old('client') == $client->id) selected @endif>{{ $client->lastname }} {{ $client->firstname }} | +{{ \Illuminate\Support\Str::replace('+', '', $client->phone) }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('client'))
                                                            <div class="text-danger">{{ $errors->first('client') }}</div>
                                                        @else
                                                            <div class="text-muted">Required</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row mb-3 d-none">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">Contract number</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="number" class="form-control" value="{{ old('contract_number') }}" name="contract_number" />
                                                        @error('contract_number')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">Class Of Admissions</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" id="customer_class_of_admissions_input_id" value="{{ old('class_of_admissions') }}" name="class_of_admissions" />
                                                        @error('class_of_admissions')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">Case Type</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <select class="form-select text-capitalize" aria-label="Default select example" name="case_type" id="case_type_select_id">
                                                            <option selected disabled>Select</option>
                                                            <option value="Immigration" @if(old('case_type') == 'Immigration') selected @endif>Immigration</option>
                                                            <option value="Criminal" @if(old('case_type') == 'Criminal') selected @endif>Criminal</option>
                                                            <option value="Traffic Violations" @if(old('case_type') == 'Traffic Violations') selected @endif>Traffic Violations</option>
                                                            <option value="Family Matter" @if(old('case_type') == 'Family Matter') selected @endif>Family Matter</option>
                                                        </select>
                                                        @error('case_type')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>



                                                <div class="row mb-3 d-none" id="case_type_block_id">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">Case subtype</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <select class="form-select text-capitalize" aria-label="Default select example" name="case_subtype" id="case_type_select_id">
                                                            <option selected disabled>Select</option>
                                                            @foreach($case_sub_types as $case_sub_type)
                                                                <option value="{{ $case_sub_type->id }}"  @if(old('case_subtype') == $case_sub_type->id) selected @endif>{{ $case_sub_type->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('case_subtype')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>



                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">Hearing date</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="datetime-local" class="form-control" value="{{ old('hearing_date') }}" name="hearing_date" />
                                                        @if($errors->has('hearing_date'))
                                                            <div class="text-danger">{{ $errors->first('hearing_date') }}</div>
                                                        @else
                                                            <div class="text-muted">Click the calendar icon</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0"></h6>
                                                    </div>
                                                    <div class="col-sm-4 text-secondary">
                                                        <h6 class="mb-3 text-capitalize">Docket date</h6>
                                                        <input type="date" class="form-control" value="{{ old('docket_date') }}" name="docket_date" />
                                                        @if($errors->has('docket_date'))
                                                            <div class="text-danger">{{ $errors->first('docket_date') }}</div>
                                                        @else
                                                            <div class="text-muted">Click the calendar icon</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-4 text-secondary">
                                                        <h6 class="mb-3">Due Date</h6>
                                                        <input type="date" class="form-control" value="{{ old('due_date') }}" name="due_date" />
                                                        @if($errors->has('due_date'))
                                                            <div class="text-danger">{{ $errors->first('due_date') }}</div>
                                                        @else
                                                            <div class="text-muted">Click the calendar icon</div>
                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">Scheduled biometric appointment</h6>
                                                    </div>
                                                    <div class="col-sm-4 text-secondary">
                                                        <h6 class="mb-3">Datetime</h6>
                                                        <input type="datetime-local" class="form-control" value="{{ old('scheduled_biometric_appointment_datetime') }}" name="scheduled_biometric_appointment_datetime" />
                                                        @if($errors->has('scheduled_biometric_appointment_datetime'))
                                                            <div class="text-danger">{{ $errors->first('scheduled_biometric_appointment_datetime') }}</div>
                                                        @else
                                                            <div class="text-muted">Click the calendar icon</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-4 text-secondary">
                                                        <h6 class="mb-3 text-capitalize">Address</h6>
                                                        <textarea class="form-control" rows="2" name="scheduled_biometric_appointment_address">{{ old('scheduled_biometric_appointment_address') }}</textarea>
                                                        @if($errors->has('scheduled_biometric_appointment_address'))
                                                            <div class="text-danger">{{ $errors->first('scheduled_biometric_appointment_address') }}</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">Interview</h6>
                                                    </div>
                                                    <div class="col-sm-4 text-secondary">
                                                        <h6 class="mb-3">Datetime</h6>
                                                        <input type="datetime-local" class="form-control" value="{{ old('interview_datetime') }}" name="interview_datetime" />
                                                        @if($errors->has('interview_datetime'))
                                                            <div class="text-danger">{{ $errors->first('interview_datetime') }}</div>
                                                        @else
                                                            <div class="text-muted">Click the calendar icon</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-4 text-secondary">
                                                        <h6 class="mb-3">Address</h6>
                                                        <textarea class="form-control" rows="2" name="interview_address">{{ old('interview_address') }}</textarea>
                                                        @if($errors->has('interview_address'))
                                                            <div class="text-danger">{{ $errors->first('interview_address') }}</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">Filing date</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="date" class="form-control" value="{{ old('filling_date') }}" name="filling_date" />
                                                        @if($errors->has('filling_date'))
                                                            <div class="text-danger">{{ $errors->first('filling_date') }}</div>
                                                        @else
                                                            <div class="text-muted">Click the calendar icon</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <x-crm.includes.entry-date/>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Judge</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ old('judge') }}" name="judge" />
                                                        @error('judge')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Attorney</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <select class="form-select text-capitalize single-select" aria-label="Default select example" name="attorney_id">
                                                            <option selected disabled>Select</option>
                                                            @foreach(\App\Models\Crm\Attorneys::all() as $attorney)
                                                                <option value="{{ $attorney->id }}" @if(old('attorney_id') == $attorney->id) selected @endif>{{ $attorney->company_name }} ({{ $attorney->firstname }} {{ $attorney->lastname }})</option>
                                                            @endforeach
                                                        </select>
                                                        @error('attorney_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">Type of hearing</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <select class="form-select text-capitalize" name="type_of_hearing_id">
                                                            <option selected disabled>Select</option>
                                                            @foreach(\App\Models\Crm\TypeOfHearing::all() as $type)
                                                                <option value="{{ $type->id }}" @if(old('type_of_hearing_id') == $type->id) selected @endif>{{ $type->hearing_type }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('type_of_hearing_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">Retainer Cost</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="number" step=0.01 class="form-control" value="{{ old('retainer_cost') }}" name="retainer_cost" />
                                                        @if($errors->has('retainer_cost'))
                                                            <div class="text-danger">{{ $errors->first('retainer_cost') }}</div>
                                                        @else
                                                            <div class="text-muted">Required</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">Retainer Date</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="date" class="form-control" value="{{ old('retainer_date') }}" name="retainer_date" />
                                                        @if($errors->has('retainer_date'))
                                                            <div class="text-danger">{{ $errors->first('retainer_date') }}</div>
                                                        @else
                                                            <div class="text-muted">Click the calendar icon</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">Upload Retainer</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="file"
                                                               class="form-control upload_retainer"
                                                               value="{{ old('upload_retainer') }}"
                                                               name="upload_retainer"
                                                               accept=".pdf,.png,.jpg,.jpeg,.doc,.docx"
                                                        />
                                                        @if($errors->has('upload_retainer'))
                                                            <div class="text-danger">{{ $errors->first('upload_retainer') }}</div>
                                                        @else
                                                            <div class="text-muted">Allowed file type: .pdf, .png, .jpg, .jpeg, .doc, .docx <span class="upload_retainer_reference_text_file_size">Maximum file size must be: 25 mb</span></div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Total balance</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="number" step=0.01 class="form-control" value="{{ old('total_balance') }}" name="total_balance" />
                                                        @error('total_balance')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">Attorney cost</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="number" step=0.01 class="form-control" value="{{ old('attorney_cost') }}" name="attorney_cost" />
                                                        @error('attorney_cost')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">DT paralegal services</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="number" step=0.01 class="form-control" value="{{ old('dt_paralegal_services') }}" name="dt_paralegal_services" />
                                                        @error('dt_paralegal_services')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">Total paid</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="number" step=0.01 class="form-control" value="{{ old('total_paid') }}" name="total_paid" />
                                                        @error('total_paid')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <button type="submit" class="btn btn-primary btn button_loading_animation_update_profile_data_class">Add</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-crm.includes.dashboard-footer1/>
</div>
<!--end wrapper-->
<x-crm.includes.footer/>
