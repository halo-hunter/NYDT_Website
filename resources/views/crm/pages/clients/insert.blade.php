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
                                                        <h6 class="mb-0 text-capitalize">Profile Photo</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="file"
                                                               class="form-control profile_photo"
                                                               value="{{ old('profile_photo') }}"
                                                               name="profile_photo"
                                                               accept="image/png, image/jpeg, image/jpg"
                                                        />
                                                        @if($errors->has('profile_photo'))
                                                            <div class="text-danger">{{ $errors->first('profile_photo') }}</div>
                                                        @else
                                                            <div class="text-muted">Allowed file type: png, jpg, <span class="profile_photo_reference_text_file_size">Maximum file size must be: 25 mb</span></div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">First name</h6>
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
                                                        <h6 class="mb-0 text-capitalize">Last name</h6>
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
                                                        <h6 class="mb-0">DOB</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="date" class="form-control" value="{{ old('dob') }}" name="dob" />
                                                        <div class="text-muted">Click the calendar icon</div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">A-number</h6>
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
                                                        <h6 class="mb-0 text-capitalize">Email</h6>
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
                                                        <h6 class="mb-0 text-capitalize">Phone (Primary)</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" id="attorney_phone_number_input_id" value="{{ old('phone') }}" name="phone" autocomplete="off" />
                                                        @if($errors->has('phone'))
                                                            <div class="text-danger">{{ $errors->first('phone') }}</div>
                                                        @else
                                                            <div class="text-muted">Required</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">Phone (Secondary)</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" id="attorney_secondary_phone_number_input_id" value="{{ old('phone_secondary') }}" name="phone_secondary" autocomplete="off" />
                                                        @error('phone_secondary')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">Social Security</h6>
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
                                                        <h6 class="mb-0 text-capitalize">Address</h6>
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
                                                        <h6 class="mb-0 text-capitalize">Unit</h6>
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
                                                        <h6 class="mb-0 text-capitalize">City</h6>
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
                                                        <h6 class="mb-0 text-capitalize">State</h6>
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
                                                        <h6 class="mb-0 text-capitalize">Zip Code</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="number" class="form-control" value="{{ old('address_zip_code') }}" name="address_zip_code" />
                                                        @error('address_zip_code')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">Country Name</h6>
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
                                                        <h6 class="mb-0 text-capitalize">Country of citizenship</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <select class="form-select text-capitalize single-select" multiple="multiple" aria-label="Default select example" name="country_of_citizenship[]">
                                                            @foreach(\App\Models\Crm\Country::all() as $country)
                                                                <option value="{{ $country->id }}" @if(old('country_of_citizenship') == $country->id) selected @endif>{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('country_of_citizenship'))
                                                            <div class="text-danger">{{ $errors->first('country_of_citizenship') }}</div>
                                                        @else
                                                            <div class="text-muted">Click input to select</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">Country of lawful status</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <select class="form-select text-capitalize single-select" multiple="multiple" aria-label="Default select example" name="country_of_lawful_status[]">
                                                            @foreach(\App\Models\Crm\Country::all() as $country)
                                                                <option value="{{ $country->id }}" @if(old('country_of_lawful_status') == $country->id) selected @endif>{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('country_of_lawful_status'))
                                                            <div class="text-danger">{{ $errors->first('country_of_lawful_status') }}</div>
                                                        @else
                                                            <div class="text-muted">Click input to select</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <x-crm.includes.residency-within-five-years/>

                                                <x-crm.includes.last-address-of-the-country-of-your-origin/>

                                                <x-crm.includes.education/>

                                                <x-crm.includes.employment-within-last-five-years/>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">Marital Status</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <select class="form-select text-capitalize" name="marital_status">
                                                            <option selected disabled>Select</option>
                                                            @foreach(\App\Models\Crm\MaritalStatus::all() as $marital_status)
                                                                <option value="{{ $marital_status->id }}" @if(old('marital_status') == $marital_status->id) selected @endif>{{ $marital_status->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('marital_status')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

{{--                                                <div class="row mb-3">--}}
{{--                                                    <div class="col-sm-3">--}}
{{--                                                        <h6 class="mb-0">Family Members</h6>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-sm-9 text-secondary">--}}
{{--                                                        <div class="row family_member_first_block_class" id="family_member_first_block_id">--}}
{{--                                                            <div class="col-3">--}}
{{--                                                                <label for="">Relation</label>--}}
{{--                                                                <input type="text" class="form-control family_member_relation_input_class" name="family_member[][relation]" />--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-3">--}}
{{--                                                                <label for="">First name</label>--}}
{{--                                                                <input type="text" class="form-control family_member_first_name_input_class" name="family_member[][first_name]" />--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-3">--}}
{{--                                                                <label for="">Last name</label>--}}
{{--                                                                <input type="text" class="form-control family_member_last_name_input_class" name="family_member[][last_name]" />--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-3">--}}
{{--                                                                <button class="btn btn-primary btn family_member_add_class" id="family_member_add_button_id">--}}
{{--                                                                    <i class="fadeIn animated bx bx-plus-circle"></i>--}}
{{--                                                                </button>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <span id="family_member_additional_block_id"></span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

                                                <div class="row">
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <button type="submit" class="btn btn-primary btn button_loading_animation_update_profile_data_class" id="client_add_form_button_id">Save</button>
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
