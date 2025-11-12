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
                                Add Client
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
                                        <div class="col-12">
                                            @error('attorney_profile_created_successfully')
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
                                                        <input type="text" class="form-control" value="{{ old('firstname') }}" name="firstname" />
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
                                                        <input type="text" class="form-control" value="{{ old('lastname') }}" name="lastname" />
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
                                                        <input type="number" class="form-control" value="{{ old('contract_number') }}" name="contract_number" />
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
                                                        <input type="text" class="form-control" value="{{ old('a_number') }}" name="a_number" />
                                                        @error('a_number')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Email</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ old('email') }}" name="email" />
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
                                                        <input type="text" class="form-control" id="attorney_phone_number_input_id" value="{{ old('phone') }}" name="phone" />
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
                                                        <input type="text" class="form-control" id="customer_social_security_input_id" value="{{ old('social_security') }}" name="social_security" />
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
                                                        <input type="text" class="form-control" id="customer_class_of_admissions_input_id" value="{{ old('class_of_admissions') }}" name="class_of_admissions" />
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




                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Address</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ old('address_address') }}" name="address_address" />
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
                                                        <input type="text" class="form-control" value="{{ old('address_unit') }}" name="address_unit" />
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
                                                        <input type="text" class="form-control" value="{{ old('address_city') }}" name="address_city" />
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
                                                                <option value="{{ $state->state_code }}" @if(old('address_state_code') == $state->state_code) selected @endif>{{ $state->state_name }}</option>
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
                                                        <input type="text" class="form-control" value="{{ old('address_zip_code') }}" name="address_zip_code" />
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
                                                        <h6 class="mb-3">Docket date</h6>
                                                        <input type="datetime-local" class="form-control" value="{{ old('docket_date') }}" name="docket_date" />
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
                                                        <h6 class="mb-0">Filing date</h6>
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
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Entry in the USA date</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="date" class="form-control" value="{{ old('entry_in_the_usa_date') }}" name="entry_in_the_usa_date" />
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
                                                        <h6 class="mb-0">Type of hearing</h6>
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
                                                        <h6 class="mb-0">Retainer Cost</h6>
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
                                                        <h6 class="mb-0">Retainer Date</h6>
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
                                                        <h6 class="mb-0">Upload Retainer</h6>
                                                    </div>
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
                                                        <h6 class="mb-0">Attorney cost</h6>
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
                                                        <h6 class="mb-0">DT paralegal services</h6>
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
                                                        <h6 class="mb-0">Total paid</h6>
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
