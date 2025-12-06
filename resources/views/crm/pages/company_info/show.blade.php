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
                                    @if(session()->has('company_info_has_saved_successfully'))
                                        <div class="alert alert-outline-success shadow-sm alert-dismissible fade show">
                                            <div class="text-success text-capitalize">{{ session()->get('company_info_has_saved_successfully') }}</div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <form method="post" enctype='multipart/form-data'>
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Company Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                @php($company = \App\Models\Crm\CompanyInfo::first())
                                                <input type="text" class="form-control" value="{{ optional($company)->company_name }}" name="company_name" />
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
                                                @php($company = \App\Models\Crm\CompanyInfo::first())
                                                <select class="form-select text-capitalize single-select" aria-label="Default select example" name="company_address_state_code">
                                                    <option selected disabled>Select</option>
                                                    @foreach(\App\Models\Crm\States::all() as $state)
                                                        <option value="{{ $state->state_code }}" @if(optional($company)->company_address_state_code && optional($company)->company_address_state_code == $state->state_code) selected @elseif(old('company_address_state_code') == $state->state_code) selected @endif>{{ $state->state_name }}</option>
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
                                                <input type="text" class="form-control" value="{{ optional($company)->company_address_city }}" name="company_address_city" />
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
                                                <input type="text" class="form-control" value="{{ optional($company)->company_address_zip_code }}" name="company_address_zip_code" />
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
                                                <input type="text" class="form-control" value="{{ optional($company)->company_address_unit }}" name="company_address_unit" />
                                                @error('company_address_unit')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Address 1</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{ optional($company)->company_address_address_1 }}" name="company_address_address_1" />
                                                @error('company_address_address_1')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Address 2</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{ optional($company)->company_address_address_2 }}" name="company_address_address_2" />
                                                @error('company_address_address_2')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{ optional($company)->email }}" name="email" />
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
                                                <input type="text" class="form-control" id="attorney_phone_number_input_id" value="{{ optional($company)->phone }}" name="phone" />
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
                                                <input type="text" class="form-control" value="{{ optional($company)->fax }}" name="fax" />
                                                @error('fax')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        @if(optional($company)->logo)
                                        <div class="row mb-3">
                                            <div class="col-sm-3">

                                            </div>
                                            <div class="col-sm-2 text-secondary">
                                                <img class="img-thumbnail" src="{{ asset('images/logo') }}/{{ optional($company)->logo }}" alt="">
                                            </div>
                                        </div>
                                        @endif
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Logo</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="file" accept="image/png, image/jpeg" class="form-control" value="{{ old('logo') }}" name="logo" />
                                                @if($errors->has('logo'))
                                                    <div class="text-danger">{{ $errors->first('logo') }}</div>
                                                @else
                                                    <div class="text-muted">Allowed Image Types: jpeg, png, jpg. File Maximum Size: 2 MB</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <button type="submit" class="btn btn-primary btn button_loading_animation_update_profile_data_class">Save</button>
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
