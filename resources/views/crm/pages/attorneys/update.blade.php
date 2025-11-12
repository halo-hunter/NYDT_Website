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
                                    @error('attorney_profile_updated_successfully')
                                    <small>
                                        <div class="alert alert-outline-success shadow-sm alert-dismissible fade show">
                                            <div class="text-success text-capitalize">{{ $message }}</div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </small>
                                    @enderror
                                    <form method="post">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">First name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{ \App\Models\Crm\Attorneys::where('id', $id)->first()->firstname }}" name="firstname" />
                                                @error('firstname')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Last Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{ \App\Models\Crm\Attorneys::where('id', $id)->first()->lastname }}" name="lastname" />
                                                @error('lastname')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Company Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{ \App\Models\Crm\Attorneys::where('id', $id)->first()->company_name }}" name="company_name" />
                                                @error('company_name')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Country Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="US" name="company_address_country" hidden />
                                                <input type="text" class="form-control" value="United States" disabled />
                                                @error('company_address_country')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">State</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <select class="form-select text-capitalize single-select" aria-label="Default select example" name="company_address_state_code">
                                                    <option selected disabled>Select</option>
                                                    @foreach(\App\Models\Crm\States::all() as $state)
                                                        <option value="{{ $state->state_code }}" @if(\App\Models\Crm\Attorneys::where('id', $id)->first()->company_address_state_code == $state->state_code) selected @endif>{{ $state->state_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('company_address_state_code')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">City</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{ \App\Models\Crm\Attorneys::where('id', $id)->first()->company_address_city }}" name="company_address_city" />
                                                @error('company_address_city')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Zip Code</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{ \App\Models\Crm\Attorneys::where('id', $id)->first()->company_address_zip_code }}" name="company_address_zip_code" />
                                                @error('company_address_zip_code')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Unit</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{ \App\Models\Crm\Attorneys::where('id', $id)->first()->company_address_unit }}" name="company_address_unit" />
                                                @error('company_address_unit')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Address</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{ \App\Models\Crm\Attorneys::where('id', $id)->first()->company_address_address }}" name="company_address_address" />
                                                @error('company_address_address')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{ \App\Models\Crm\Attorneys::where('id', $id)->first()->email }}" name="email" />
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
                                                <input type="text" class="form-control" id="attorney_phone_number_input_id" value="{{ \App\Models\Crm\Attorneys::where('id', $id)->first()->phone }}" name="phone" />
                                                @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Fax</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{ \App\Models\Crm\Attorneys::where('id', $id)->first()->fax }}" name="fax" />
                                                @error('fax')
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
