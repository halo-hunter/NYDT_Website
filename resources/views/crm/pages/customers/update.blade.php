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
            <div class="container-fluid page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">CRM</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Clients
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit Client
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="container-fluid">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card p-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            @error('customer_updated_successfully')
                                            <small>
                                                <div class="alert alert-outline-success shadow-sm alert-dismissible fade show">
                                                    <div class="text-success text-capitalize">{{ $message }}</div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            </small>
                                            @enderror
                                            <form method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">First name</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->firstname }}" name="firstname" />
                                                        @if($errors->has('firstname'))
                                                            <div class="text-danger">{{ $errors->first('firstname') }}</div>
                                                        @else
                                                            <div class="text-muted">Required</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Last name</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->lastname }}" name="lastname" />
                                                        @if($errors->has('lastname'))
                                                            <div class="text-danger">{{ $errors->first('lastname') }}</div>
                                                        @else
                                                            <div class="text-muted">Required</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Contract number</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="number" class="form-control" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->contract_number }}" name="contract_number" />
                                                        @error('contract_number')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">A-number</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->a_number }}" name="a_number" />
                                                        @error('a_number')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @if(\App\Models\Crm\Customers::where('id', $id)->first()->case_type == 'Immigration')
                                                    <div class="row mb-4">
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">EAD clock</h6>
                                                        </div>
                                                        <div class="col-sm-9 text-dark">
                                                            @if(\App\Models\Crm\Customers::where('id', $id)->first()->filling_date != null)
                                                                <h6>{{ \Carbon\Carbon::parse(\App\Models\Crm\Customers::where('id', $id)->first()->filling_date)->diffInDays() }} day(s)</h6>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Email</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->email }}" name="email" />
                                                        @error('email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Phone</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" id="attorney_phone_number_input_id" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->phone }}" name="phone" />
                                                        @if($errors->has('phone'))
                                                            <div class="text-danger">{{ $errors->first('phone') }}</div>
                                                        @else
                                                            <div class="text-muted">Required</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Social Security</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" id="customer_social_security_input_id" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->social_security }}" name="social_security" />
                                                        @error('social_security')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Class Of Admissions</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" id="customer_class_of_admissions_input_id" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->class_of_admissions }}" name="class_of_admissions" />
                                                        @error('class_of_admissions')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Case Type</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <select class="form-select text-capitalize" aria-label="Default select example" name="case_type">
                                                            <option selected disabled>Select</option>
                                                            <option value="Immigration" @if(\App\Models\Crm\Customers::where('id', $id)->first()->case_type == 'Immigration') selected @endif>Immigration</option>
                                                            <option value="Criminal" @if(\App\Models\Crm\Customers::where('id', $id)->first()->case_type == 'Criminal') selected @endif>Criminal</option>
                                                            <option value="Traffic Violations" @if(\App\Models\Crm\Customers::where('id', $id)->first()->case_type == 'Traffic Violations') selected @endif>Traffic Violations</option>
                                                            <option value="Family Matter" @if(\App\Models\Crm\Customers::where('id', $id)->first()->case_type == 'Family Matter') selected @endif>Family Matter</option>
                                                        </select>
                                                        @error('case_type')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Address</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->address_address }}" name="address_address" />
                                                        @error('address_address')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Unit</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->address_unit }}" name="address_unit" />
                                                        @error('address_unit')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">City</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->address_city }}" name="address_city" />
                                                        @error('address_city')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">State</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <select class="form-select text-capitalize single-select" aria-label="Default select example" name="address_state_code">
                                                            <option selected disabled>Select</option>
                                                            @foreach(\App\Models\Crm\States::all() as $state)
                                                                <option value="{{ $state->state_code }}" @if(\App\Models\Crm\Customers::where('id', $id)->first()->address_state_code == $state->state_code) selected @endif>{{ $state->state_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('address_state_code')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Zip Code</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->address_zip_code }}" name="address_zip_code" />
                                                        @error('address_zip_code')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Country Name</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="US" name="address_country" hidden="">
                                                        <input type="text" class="form-control" value="United States" disabled />
                                                        @error('address_country')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Hearing date</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="datetime-local" class="form-control" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->hearing_date }}" name="hearing_date" />
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
                                                        <h6 class="mb-3">Docket date</h6>
                                                        <input type="datetime-local" class="form-control" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->docket_date }}" name="docket_date" />
                                                        @if($errors->has('docket_date'))
                                                            <div class="text-danger">{{ $errors->first('docket_date') }}</div>
                                                        @else
                                                            <div class="text-muted">Click the calendar icon</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-4 text-secondary">
                                                        <h6 class="mb-3">Due Date</h6>
                                                        <input type="date" class="form-control" value="{{ \Carbon\Carbon::parse(\App\Models\Crm\Customers::where('id', $id)->first()->due_date)->format('Y-m-d') }}" name="due_date" />
                                                        @if($errors->has('due_date'))
                                                            <div class="text-danger">{{ $errors->first('due_date') }}</div>
                                                        @else
                                                            <div class="text-muted">Click the calendar icon</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Filing date</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="date" class="form-control" value="{{ \Carbon\Carbon::parse(\App\Models\Crm\Customers::where('id', $id)->first()->filling_date)->format('Y-m-d') }}" name="filling_date" />
                                                        @if($errors->has('filling_date'))
                                                            <div class="text-danger">{{ $errors->first('filling_date') }}</div>
                                                        @else
                                                            <div class="text-muted">Click the calendar icon</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Entry in the USA date</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="date" class="form-control" value="{{ \Carbon\Carbon::parse(\App\Models\Crm\Customers::where('id', $id)->first()->entry_in_the_usa_date)->format('Y-m-d') }}" name="entry_in_the_usa_date" />
                                                        @if($errors->has('entry_in_the_usa_date'))
                                                            <div class="text-danger">{{ $errors->first('entry_in_the_usa_date') }}</div>
                                                        @else
                                                            <div class="text-muted">Click the calendar icon</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Judge</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->judge }}" name="judge" />
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
                                                                <option value="{{ $attorney->id }}" @if(\App\Models\Crm\Customers::where('id', $id)->first()->attorney_id == $attorney->id) selected @endif>{{ $attorney->company_name }} ({{ $attorney->firstname }} {{ $attorney->lastname }})</option>
                                                            @endforeach
                                                        </select>
                                                        @error('attorney_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Type of hearing</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <select class="form-select text-capitalize" name="type_of_hearing_id">
                                                            <option selected disabled>Select</option>
                                                            @foreach(\App\Models\Crm\TypeOfHearing::all() as $type)
                                                                <option value="{{ $type->id }}" @if(\App\Models\Crm\Customers::where('id', $id)->first()->type_of_hearing_id == $type->id) selected @endif>{{ $type->hearing_type }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('type_of_hearing_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Retainer Cost</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="number" step=0.01 class="form-control" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->retainer_cost }}" name="retainer_cost" />
                                                        @if($errors->has('retainer_cost'))
                                                            <div class="text-danger">{{ $errors->first('retainer_cost') }}</div>
                                                        @else
                                                            <div class="text-muted">Required</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Retainer Date</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="date" class="form-control" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->retainer_date }}" name="retainer_date" />
                                                        @if($errors->has('retainer_date'))
                                                            <div class="text-danger">{{ $errors->first('retainer_date') }}</div>
                                                        @else
                                                            <div class="text-muted">Click the calendar icon</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Upload Retainer</h6>
                                                    </div>
                                                    @if(\App\Models\Crm\Customers::where('id', $id)->first()->upload_retainer != '')
                                                        <div class="col-sm-4">
                                                        <h6 class="mb-0">
                                                            <a href="{{ URL::temporarySignedRoute('download->retainer', now()->addMinutes(15), ['caseId' => $id]) }}">Download file</a>
                                                        </h6>
                                                        </div>
                                                        <div class="col-sm-5 text-secondary">
                                                            <input type="file"
                                                                   class="form-control upload_retainer"
                                                                   value="{{ old('upload_retainer') }}"
                                                                   name="upload_retainer"
                                                                   accept=".pdf"
                                                            />
                                                            @if($errors->has('upload_retainer'))
                                                                <div class="text-danger">{{ $errors->first('upload_retainer') }}</div>
                                                            @else
                                                                <div class="text-muted">Allowed file type: pdf, <span class="upload_retainer_reference_text_file_size">Maximum file size must be: 10 mb</span></div>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div class="col-sm-9 text-secondary">
                                                            <input type="file"
                                                                   class="form-control upload_retainer"
                                                                   value="{{ old('upload_retainer') }}"
                                                                   name="upload_retainer"
                                                                   accept=".pdf"
                                                            />
                                                            @if($errors->has('upload_retainer'))
                                                                <div class="text-danger">{{ $errors->first('upload_retainer') }}</div>
                                                            @else
                                                                <div class="text-muted">Allowed file type: pdf, <span class="upload_retainer_reference_text_file_size">Maximum file size must be: 10 mb</span></div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Total balance</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="number" step=0.01 class="form-control" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->total_balance }}" name="total_balance" />
                                                        @error('total_balance')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Attorney cost</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="number" step=0.01 class="form-control" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->attorney_cost }}" name="attorney_cost" />
                                                        @error('attorney_cost')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">DT paralegal services</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="number" step=0.01 class="form-control" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->dt_paralegal_services }}" name="dt_paralegal_services" />
                                                        @error('dt_paralegal_services')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Total paid</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="number" step=0.01 class="form-control" value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->total_paid }}" name="total_paid" />
                                                        @error('total_paid')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <button type="submit" class="btn btn-primary btn button_loading_animation_update_profile_data_class">Update</button>
                                                    </div>
                                                </div>
                                            </form>





                                        </div>
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-12 mb-5">
                                                    <button type="button" class="btn-secondary btn float-end" data-bs-toggle="modal" data-bs-target="#customer_request_documents_button_id"><i class="bx bx-file"></i> Request Documents</button>
                                                </div>
                                                <div class="col-12">
                                                    <h6>Notes</h6>
                                                </div>
                                                <div class="col-12">
                                                    <div class="border border-2 rounded notes_content_block_class">
                                                        <div class="notes_content_inside_block_class">
                                                            <div class="row">
                                                                @forelse(\App\Models\Crm\CustomerNotes::where('customer_id', $id)->orderBy('id', 'desc')->get() as $customer_note)
                                                                    <div class="col-12 bg-light border-bottom border-1">
                                                                        <div class="m-2">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    {{ $customer_note->note_text }}
                                                                                </div>
                                                                                <div class="col-6 text-start mt-1">
                                                                                    <small>Author: {{ \App\Models\User::where('id', $customer_note->user_id)->first()->firstname }} {{ \App\Models\User::where('id', $customer_note->user_id)->first()->lastname }}</small>
                                                                                </div>
                                                                                <div class="col-6 text-end mt-1">
                                                                                    <small>{{ \Carbon\Carbon::parse($customer_note->created_at)->format('m/d/Y H:i') }}</small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @empty
                                                                    <div class="col-12">
                                                                        <p class="text-center mt-5">Notes not found</p>
                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <div class="row">
                                                        <form action="{{ route('customers->insert_note', $id) }}" method="post">
                                                            @csrf
                                                            <div class="col-10">
                                                                <textarea class="form-control @error('note_text') border-danger @enderror float-start" placeholder="Note..." rows="1" name="note_text"></textarea>
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="d-grid gap-2">
                                                                    <button type="submit" class="btn-primary btn ms-4 button_loading_animation_notes_class">Send</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-5">
                                                <div class="col-12">
                                                    <h6>Internal comments</h6>
                                                </div>
                                                <div class="col-12">
                                                    <div class="border border-2 rounded notes_content_block_class">
                                                        <div class="notes_content_inside_block_class">
                                                            <div class="row">
                                                                @forelse(\App\Models\Crm\InternalComments::where('customer_id', $id)->orderBy('id', 'desc')->get() as $internal_comment)
                                                                    <div class="col-12 bg-light border-bottom border-1">
                                                                        <div class="m-2">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    {{ $internal_comment->comment_text }}
                                                                                </div>
                                                                                <div class="col-6 text-start mt-1">
                                                                                    <small>Author: {{ \App\Models\User::where('id', $internal_comment->user_id)->first()->firstname }} {{ \App\Models\User::where('id', $internal_comment->user_id)->first()->lastname }}</small>
                                                                                </div>
                                                                                <div class="col-6 text-end mt-1">
                                                                                    <small>{{ \Carbon\Carbon::parse($internal_comment->created_at)->format('m/d/Y H:i') }}</small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @empty
                                                                    <div class="col-12">
                                                                        <p class="text-center mt-5">Comments not found</p>
                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <div class="row">
                                                        <form action="{{ route('customers->insert_internal_comment', $id) }}" method="post">
                                                            @csrf
                                                            <div class="col-10">
                                                                <textarea class="form-control @error('comment_text') border-danger @enderror float-start" placeholder="Comment..." rows="1" name="comment_text"></textarea>
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="d-grid gap-2">
                                                                    <button type="submit" class="btn-primary btn ms-4 button_loading_animation_internal_comments_class">Send</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-5">
                                                <div class="col-12">
                                                    <h6>Upload documents</h6>
                                                </div>
                                                <div class="col-12">
                                                    <div class="border border-2 rounded notes_content_block_class">
                                                        <div class="notes_content_inside_block_class">
                                                            <div class="row">
                                                                @forelse(\App\Models\Crm\UploadDocument::where('customer_id', $id)->orderBy('id', 'desc')->get() as $upload_document)
                                                                    <div class="col-12 bg-light border-bottom border-1">
                                                                        <div class="m-2">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <div class="row">
                                                                                        <div class="col-11">
                                                                                            @if($upload_document->user_id != 0)
                                                                                                Document: <a href="{{ URL::temporarySignedRoute('download->case_upload', now()->addMinutes(15), ['uploadId' => $upload_document->id]) }}">download file</a>
                                                                                            @else
                                                                                                Document: <a href="{{ URL::temporarySignedRoute('download->case_upload', now()->addMinutes(15), ['uploadId' => $upload_document->id]) }}">download file</a>
                                                                                            @endif
                                                                                        </div>
                                                                                        @if($upload_document->user_id != 0)
                                                                                        <div class="col-1 text-end">
                                                                                            <form action="{{ route('customers->delete_uploaded_document', $id) }}" method="post">
                                                                                                @csrf
                                                                                                <input type="text" value="{{ $upload_document->id }}" name="file_id" hidden>
                                                                                                <button title="delete pdf file"
                                                                                                        class="text-danger bg-transparent border-0 uploader_document_delete_button_class"
                                                                                                        type="submit"
                                                                                                >x</button>
                                                                                            </form>
                                                                                        </div>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                                @if($upload_document->description != '')
                                                                                    <div class="col-12">
                                                                                        Description: {{ $upload_document->description }}
                                                                                    </div>
                                                                                @endif
                                                                                <div class="col-6 text-start mt-1">
                                                                                    @if($upload_document->user_id != 0)
                                                                                        <small>Author: {{ \App\Models\User::where('id', $upload_document->user_id)->first()->firstname }} {{ \App\Models\User::where('id', $upload_document->user_id)->first()->lastname }}</small>
                                                                                    @else
                                                                                        <small>Author: {{ \App\Models\Crm\Customers::where('id', $upload_document->customer_id)->first()->firstname }} {{ \App\Models\Crm\Customers::where('id', $upload_document->customer_id)->first()->lastname }}</small>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-6 text-end mt-1">
                                                                                    <small>{{ \Carbon\Carbon::parse($upload_document->created_at)->format('m/d/Y H:i') }}</small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @empty
                                                                    <div class="col-12">
                                                                        <p class="text-center mt-5">Documents not found</p>
                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <div class="row">
                                                        <form action="{{ route('customers->upload_document', $id) }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="col-10">
                                                                <input type="file"
                                                                       class="form-control document"
                                                                       value="{{ old('document') }}"
                                                                       name="document"
                                                                       accept=".pdf"
                                                                />
                                                                @if($errors->has('document'))
                                                                    <div class="text-danger">{{ $errors->first('document') }}</div>
                                                                @else
                                                                    <div class="text-muted">Allowed file type: pdf, <span class="upload_document_reference_text_file_size">Maximum file size must be: 10 mb</span></div>
                                                                @endif
                                                            </div>
                                                            <div class="col-10 mt-2">
                                                                <textarea class="form-control @error('description') border-danger @enderror float-start" placeholder="Description..." rows="1" name="description"></textarea>
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="d-grid gap-2">
                                                                    <button type="submit" class="btn-primary btn ms-2 button_loading_animation_upload_document_class">Upload</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="col-8">
                                            <div class="row ms-1 me-1 mt-3">
                                                <div class="col-12 bg-primary pt-2 pb-2 text-white rounded-top">
                                                    <span class="h6 text-white">Defence asylum</span>
                                                </div>
                                                <div class="col-12 rounded-bottom border-bottom border-start border-end border-primary">
                                                    <form action="{{ route('customers->defence_asylum', $id) }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @if(\App\Models\Crm\DefenceAsylum::where('customer_id', $id)->exists())
                                                            <div class="row mb-3 mt-3">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">Upload a form</h6>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <h6 class="mb-0"><a href="{{ URL::temporarySignedRoute('download->defence_asylum', now()->addMinutes(15), ['caseId' => $id]) }}" download>Download file</a></h6>
                                                                </div>
                                                                <div class="col-sm-5 text-secondary">
                                                                    <input type="file"
                                                                           class="form-control upload_a_form"
                                                                           value="{{ old('upload_a_form') }}"
                                                                           name="upload_a_form"
                                                                           accept=".pdf"
                                                                    />
                                                                    @if($errors->has('upload_a_form'))
                                                                        <div class="text-danger">{{ $errors->first('upload_a_form') }}</div>
                                                                    @else
                                                                        <div class="text-muted">Allowed file type: pdf, <span class="exists_defence_asylum_reference_text_file_size">Maximum file size must be: 10 mb</span></div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">Filing date</h6>
                                                                </div>
                                                                <div class="col-sm-9 text-secondary">
                                                                    <input type="date" class="form-control" value="{{ \Carbon\Carbon::parse(\App\Models\Crm\DefenceAsylum::where('customer_id', $id)->first()->filing_date)->format('Y-m-d') }}" name="da_filing_date" />
                                                                    @if($errors->has('da_filing_date'))
                                                                        <div class="text-danger">{{ $errors->first('da_filing_date') }}</div>
                                                                    @else
                                                                        <div class="text-muted">Required</div>
                                                                        <div class="text-muted">Click the calendar icon</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="row mb-3 mt-3">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">Upload a form</h6>
                                                                </div>
                                                                <div class="col-sm-9 text-secondary">
                                                                    <input type="file"
                                                                           class="form-control upload_a_form"
                                                                           value="{{ old('upload_a_form') }}"
                                                                           name="upload_a_form"
                                                                           accept=".pdf"
                                                                    />
                                                                    @if($errors->has('upload_a_form'))
                                                                        <div class="text-danger">{{ $errors->first('upload_a_form') }}</div>
                                                                    @else
{{--                                                                        <div class="text-muted">Required</div>--}}
                                                                        <div class="text-muted">Allowed file type: pdf, <span class="not_exists_defence_asylum_reference_text_file_size">Maximum file size must be: 10 mb</span></div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">Filing date</h6>
                                                                </div>
                                                                <div class="col-sm-9 text-secondary">
                                                                    <input type="date" class="form-control" value="{{ old('da_filing_date') }}" name="da_filing_date" />
                                                                    @if($errors->has('da_filing_date'))
                                                                        <div class="text-danger">{{ $errors->first('da_filing_date') }}</div>
                                                                    @else
{{--                                                                        <div class="text-muted">Required</div>--}}
                                                                        <div class="text-muted">Click the calendar icon</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="row">
                                                            <div class="col-sm-3"></div>
                                                            <div class="col-sm-9 text-secondary">
                                                                <button type="submit" class="btn btn-primary btn button_loading_animation_defence_asylum_class mb-3">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>











                                        <div class="col-12">
                                            <div class="row ms-1 me-1 mt-3">
                                                <div class="col-12 bg-primary pt-2 pb-2 text-white rounded-top">
                                                    <span class="h6 text-white">Payments</span>
                                                </div>
                                                <div class="col-12 rounded-bottom border-bottom border-start border-end border-primary">

                                                    <div class="row mt-2 mb-2">
                                                        <div class="col-12 mb-2 mt-2">
                                                            <button type="button" class="btn btn-primary text-capitalize" data-bs-toggle="modal" data-bs-target="#customer_make_a_paymant_button_id">
                                                                Make a payment
                                                            </button>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <table id="customer_paymant_history_table_id" class="table table-striped" style="width:100%">
                                                                <thead>
                                                                <tr>
                                                                    <th>User</th>
                                                                    <th>Payment Type</th>
                                                                    <th>Invoice Number</th>
                                                                    <th>Amount</th>
                                                                    <th>Payment Description</th>
                                                                    <th>Customer Type</th>
                                                                    <th>Customer ID</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Payment Transaction ID</th>
                                                                    <th>Created At</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                @forelse(\App\Models\Crm\Payment::where('customer_id', $id)->orderBy('id', 'desc')->get() as $payment)
                                                                    <tr>
                                                                        <td>{{ \App\Models\User::find($payment->user_id)->first()->firstname }} {{ \App\Models\User::find($payment->user_id)->first()->lastname }}</td>
                                                                        <td>
                                                                            @if($payment->payment_type =='bank_card')
                                                                                Debit / Credit Card
                                                                            @elseif($payment->payment_type == 'cash')
                                                                                Cash
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $payment->invoice_number }}</td>
                                                                        <td>{{ $payment->amount }}</td>
                                                                        <td>{{ $payment->payment_description }}</td>
                                                                        <td>{{ $payment->customer_type }}</td>
                                                                        <td>{{ $payment->customer_id }}</td>
                                                                        <td>{{ $payment->payment_status }}</td>
                                                                        <td>{{ $payment->payment_transaction_id }}</td>
                                                                        <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('m/d/Y H:i') }}</td>
                                                                    </tr>
                                                                @empty
                                                                    Payments not found
                                                                @endforelse


                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>User</th>
                                                                    <th>Payment Type</th>
                                                                    <th>Invoice Number</th>
                                                                    <th>Amount</th>
                                                                    <th>Payment Description</th>
                                                                    <th>Customer Type</th>
                                                                    <th>Customer ID</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Payment Transaction ID</th>
                                                                    <th>Created At</th>
                                                                </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12 mt-5">
                                            <button type="button" class="btn-secondary btn float-end" data-bs-toggle="modal" data-bs-target="#customer_request_documents_button_id"><i class="bx bx-file"></i> Request Documents</button>
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


    <div class="modal fade" id="customer_make_a_paymant_button_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal text-capitalize" id="exampleModalLabel">Make a payment</h5>
                    <button type="button" class="btn-close text-dark" id="payment_modal_close_id">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Payment type:</label>
                                    <select
                                        class="form-select form-select-sm"
                                        aria-label="Default select example"
                                        required
                                        id="payment_type_select_id"
                                        name="payment_type_select_name"
                                    >
                                        <option disabled value="">Select</option>
                                        <option selected value="bank_card">Debit / Credit Card</option>
                                        <option value="cash">Cash</option>
                                    </select>
                                    <small class="text-muted">Required</small>
                                </div>
                            </div>
                            <div
                                id="payment_form_body_if_cash"
                                class="row d-none"
                            >
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Invoice Number:</label>
                                        <input
                                            type="number"
                                            class="form-control form-control-sm"
                                            required
                                            disabled
                                            value="{{ round(time() / 2) }}"
                                            id="cash_payment_invoice_number_input_id"
                                            name="cash_payment_invoice_number_input_name"
                                        >
                                        <small class="text-muted">Required</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Amount:</label>
                                        <input
                                            type="number"
                                            class="form-control form-control-sm"
                                            required
                                            id="cash_payment_amount_input_id"
                                            name="cash_payment_amount_input_name"
                                        >
                                        <small class="text-muted">Required</small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Description:</label>
                                        <textarea
                                            class="form-control form-control-sm"
                                            rows="3"
                                            id="cash_payment_description_input_id"
                                            name="cash_payment_description_input_name"
                                        ></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Firstname:</label>
                                        <input
                                            type="text"
                                            class="form-control form-control-sm"
                                            value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->firstname }}"
                                            disabled
                                            id="cash_payment_firstname_input_id"
                                            name="cash_payment_firstname_input_name"
                                        >
                                        <small class="text-muted">Required</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Lastname:</label>
                                        <input
                                            type="text"
                                            class="form-control form-control-sm"
                                            value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->lastname }}"
                                            disabled
                                            id="cash_payment_lastname_input_id"
                                            name="cash_payment_lastname_input_id"
                                        >
                                        <small class="text-muted">Required</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Client type:</label>
                                        <select
                                            class="form-select form-select-sm"
                                            aria-label="Default select example"
                                            required
                                            disabled
                                            id="cash_payment_customer_select_id"
                                            name="cash_payment_customer_select_name"
                                        >
                                            <option disabled>Select</option>
                                            <option value="individual" selected>Individual</option>
                                        </select>
                                        <small class="text-muted">Required</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Client ID:</label>
                                        <input
                                            type="number"
                                            class="form-control form-control-sm"
                                            value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->id }}"
                                            disabled
                                            id="cash_payment_input_customer_id"
                                            name="cash_payment_input_customer_name"
                                        >
                                        <small class="text-muted">Required</small>
                                    </div>
                                </div>
                            </div>
                            <div
                                id="payment_form_body_if_bank_card"
                                class="row d-none"
                            >
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Invoice Number:</label>
                                        <input
                                            type="number"
                                            class="form-control form-control-sm"
                                            required
                                            disabled
                                            value="{{ round(time() / 2) }}"
                                            id="bank_card_payment_invoice_number_input_id"
                                            name="bank_card_payment_invoice_number_input_name"
                                        >
                                        <small class="text-muted">Required</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Amount:</label>
                                        <input
                                            type="number"
                                            class="form-control form-control-sm"
                                            required
                                            id="bank_card_payment_amount_input_id"
                                            name="bank_card_payment_amount_input_name"
                                        >
                                        <small class="text-muted">Required</small>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="mb-3">
                                        <label class="form-label">Card Number:</label>
                                        <input
                                            type="text"
                                            class="form-control form-control-sm"
                                            required
                                            id="bank_card_payment_card_number_input_id"
                                            name="bank_card_payment_card_number_input_name"
                                        >
                                        <small class="text-muted">Required</small>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Exp. Date:</label>
                                        <input
                                            type="text"
                                            class="form-control form-control-sm"
                                            required
                                            id="bank_card_payment_card_exp_date_input_id"
                                            name="bank_card_payment_card_exp_date_input_name"
                                        >
                                        <small class="text-muted">Required</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Card Code (CVV):</label>
                                        <input
                                            type="number"
                                            class="form-control form-control-sm"
                                            required
                                            id="bank_card_payment_card_code_input_id"
                                            name="bank_card_payment_card_code_input_name"
                                        >
                                        <small class="text-muted">Required</small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Description:</label>
                                        <textarea
                                            class="form-control form-control-sm"
                                            rows="3"
                                            id="bank_card_payment_description_input_id"
                                            name="bank_card_payment_description_input_name"
                                        ></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Firstname:</label>
                                        <input
                                            type="text"
                                            class="form-control form-control-sm"
                                            value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->firstname }}"
                                            disabled
                                            id="bank_card_payment_firstname_input_id"
                                            name="bank_card_payment_firstname_input_name"
                                        >
                                        <small class="text-muted">Required</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Lastname:</label>
                                        <input
                                            type="text"
                                            class="form-control form-control-sm"
                                            value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->lastname }}"
                                            disabled
                                            id="bank_card_payment_lastname_input_id"
                                            name="bank_card_payment_lastname_input_name"
                                        >
                                        <small class="text-muted">Required</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Client type:</label>
                                        <select
                                            class="form-select form-select-sm"
                                            aria-label="Default select example"
                                            required
                                            disabled
                                            id="bank_card_payment_customer_select_id"
                                            name="bank_card_payment_customer_select_name"
                                        >
                                            <option disabled>Select</option>
                                            <option value="individual" selected>Individual</option>
                                        </select>
                                        <small class="text-muted">Required</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Client ID:</label>
                                        <input
                                            type="number"
                                            class="form-control form-control-sm"
                                            value="{{ \App\Models\Crm\Customers::where('id', $id)->first()->id }}"
                                            disabled
                                            id="bank_card_payment_input_customer_id"
                                            name="bank_card_payment_input_customer_name"
                                        >
                                        <small class="text-muted">Required</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center mb-4 d-none" id="payment_error_message_message_id">
                        <span class="text-danger" id="payment_error_message_message_text_id">
                            Bank card payment failed
                        </span>
                    </div>
                    <div class="col-12 text-center mb-4 d-none" id="payment_success_message_message_id">
                        <span class="text-success" id="payment_success_message_message_text_id">
                            Payment was made successfully
                        </span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="payment_modal_footer_close_button_id">Close</button>
                        <button type="submit" class="btn btn-primary" id="customer_payment_form_pay_button_id">Pay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-crm.includes.dashboard-footer1/>
    <x-crm.includes.footer-modals/>
</div>
<!--end wrapper-->
<x-crm.includes.footer/>
