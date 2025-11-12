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
                                            @error('client_updated_successfully')
                                            <small>
                                                <div class="alert alert-outline-success shadow-sm alert-dismissible fade show">
                                                    <div class="text-success text-capitalize">{{ $message }}</div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            </small>
                                            @enderror

                                            @error('family_member_edited_successfully')
                                            <small>
                                                <div class="alert alert-outline-success shadow-sm alert-dismissible fade show">
                                                    <div class="text-success text-capitalize">{{ $message }}</div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            </small>
                                            @enderror

                                            @error('family_member_deleted_successfully')
                                            <small>
                                                <div class="alert alert-outline-success shadow-sm alert-dismissible fade show">
                                                    <div class="text-success text-capitalize">{{ $message }}</div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            </small>
                                            @enderror

                                            @error('rider_updated_successfully')
                                            <small>
                                                <div class="alert alert-outline-success shadow-sm alert-dismissible fade show">
                                                    <div class="text-success text-capitalize">{{ $message }}</div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            </small>
                                            @enderror

                                            @error('rider_deleted_successfully')
                                            <small>
                                                <div class="alert alert-outline-success shadow-sm alert-dismissible fade show">
                                                    <div class="text-success text-capitalize">{{ $message }}</div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            </small>
                                            @enderror

                                            @error('employment_within_last_five_years_updated_successfully')
                                            <small>
                                                <div class="alert alert-outline-success shadow-sm alert-dismissible fade show">
                                                    <div class="text-success text-capitalize">{{ $message }}</div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            </small>
                                            @enderror

                                            @error('employment_within_last_five_years_deleted_successfully')
                                            <small>
                                                <div class="alert alert-outline-success shadow-sm alert-dismissible fade show">
                                                    <div class="text-success text-capitalize">{{ $message }}</div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            </small>
                                            @enderror

                                            @error('residency_within_five_years_deleted_successfully')
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
                                                        <h6 class="mb-0">Profile Photo</h6>
                                                    </div>
                                                    @if(\App\Models\Crm\Client::where('id', $id)->first()->profile_photo != '')
                                                        <div class="col-sm-4">
                                                            <img class="img-thumbnail w-25" src="{{ asset('files/profile_photos/' . \App\Models\Crm\Client::where('id', $id)->first()->profile_photo) }}" alt="">
                                                            <br>
                                                            <h7 class="mb-0"><a href="{{ asset('files/profile_photos/' . \App\Models\Crm\Client::where('id', $id)->first()->profile_photo) }}" download>Download</a></h7>
                                                        </div>
                                                        <div class="col-sm-5 text-secondary">
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
                                                    @else
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
                                                    @endif
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">First name</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ \App\Models\Crm\Client::where('id', $id)->first()->firstname }}" name="firstname" />
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
                                                        <input type="text" class="form-control" value="{{ \App\Models\Crm\Client::where('id', $id)->first()->lastname }}" name="lastname" />
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
                                                        <input type="date" class="form-control" value="{{ \App\Models\Crm\Client::where('id', $id)->first()->dob }}" name="dob" />
                                                        <div class="text-muted">Click the calendar icon</div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">A-number</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ \App\Models\Crm\Client::where('id', $id)->first()->a_number }}" name="a_number" />
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
                                                        <input type="text" class="form-control" value="{{ \App\Models\Crm\Client::where('id', $id)->first()->email }}" name="email" />
                                                        @error('email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Phone (Primary)</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" id="attorney_phone_number_input_id" value="{{ \App\Models\Crm\Client::where('id', $id)->first()->phone }}" name="phone" autocomplete="off" />
                                                        @if($errors->has('phone'))
                                                            <div class="text-danger">{{ $errors->first('phone') }}</div>
                                                        @else
                                                            <div class="text-muted">Required</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Phone (Secondary)</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" id="attorney_secondary_phone_number_input_id" value="{{ \App\Models\Crm\Client::where('id', $id)->first()->phone_secondary }}" name="phone_secondary" autocomplete="off" />
                                                        @error('phone_secondary')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Social Security</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" id="customer_social_security_input_id" value="{{ \App\Models\Crm\Client::where('id', $id)->first()->social_security }}" name="social_security" />
                                                        @error('social_security')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Address</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ \App\Models\Crm\Client::where('id', $id)->first()->address_address }}" name="address_address" />
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
                                                        <input type="text" class="form-control" value="{{ \App\Models\Crm\Client::where('id', $id)->first()->address_unit }}" name="address_unit" />
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
                                                        <input type="text" class="form-control" value="{{ \App\Models\Crm\Client::where('id', $id)->first()->address_city }}" name="address_city" />
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
                                                                <option value="{{ $state->state_code }}" @if(\App\Models\Crm\Client::where('id', $id)->first()->address_state_code == $state->state_code) selected @endif>{{ $state->state_name }}</option>
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
                                                        <input type="number" class="form-control" value="{{ \App\Models\Crm\Client::where('id', $id)->first()->address_zip_code }}" name="address_zip_code" autocomplete="off"/>
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
                                                        <h6 class="mb-0">Country of citizenship</h6>
                                                    </div>

                                                    <div class="col-sm-9 text-secondary">
                                                        <select class="form-select text-capitalize single-select" multiple="multiple" aria-label="Default select example" name="country_of_citizenship[]">
                                                            @foreach(\App\Models\Crm\Country::all() as $country)
                                                                <option value="{{ $country->id }}" @if(in_array($country->id, $client_citizenship_country_ids)) selected @endif>{{ $country->name }}</option>
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
                                                        <h6 class="mb-0">Country of lawful status</h6>
                                                    </div>

                                                    <div class="col-sm-9 text-secondary">
                                                        <select class="form-select text-capitalize single-select" multiple="multiple" aria-label="Default select example" name="country_of_lawful_status[]">
                                                            @foreach(\App\Models\Crm\Country::all() as $country)
                                                                <option value="{{ $country->id }}" @if(in_array($country->id, $client_countries_of_lawful_status_ids)) selected @endif>{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('country_of_lawful_status'))
                                                            <div class="text-danger">{{ $errors->first('country_of_lawful_status') }}</div>
                                                        @else
                                                            <div class="text-muted">Click input to select</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <x-crm.includes.residency-within-five-years :clientId="$id"/>

                                                <x-crm.includes.last-address-of-the-country-of-your-origin :clientId="$id"/>

                                                <x-crm.includes.education :clientId="$id"/>

                                                <x-crm.includes.employment-within-last-five-years :clientId="$id"/>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Marital Status</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <select class="form-select text-capitalize" name="marital_status">
                                                            <option selected disabled>Select</option>
                                                            @foreach(\App\Models\Crm\MaritalStatus::all() as $marital_status)
                                                                <option value="{{ $marital_status->id }}" @if(\App\Models\Crm\Client::where('id', $id)->first()->marital_status == $marital_status->id) selected @endif>{{ $marital_status->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('marital_status')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <x-crm.includes.rider :clientid="$id"/>

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


{{--                                                @if($family_members->exists())--}}

{{--                                                    <div class="row mb-3">--}}
{{--                                                        <div class="col-sm-3">--}}
{{--                                                            <h6 class="mb-0">Family Members</h6>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-sm-9 text-secondary">--}}
{{--                                                            <table class="table table-striped table-bordered">--}}
{{--                                                                <thead>--}}
{{--                                                                <tr>--}}
{{--                                                                    <th scope="col">ID</th>--}}
{{--                                                                    <th scope="col">Relation</th>--}}
{{--                                                                    <th scope="col">First Name</th>--}}
{{--                                                                    <th scope="col">Last Name</th>--}}
{{--                                                                    <th scope="col">Actions</th>--}}
{{--                                                                </tr>--}}
{{--                                                                </thead>--}}
{{--                                                                <tbody>--}}

{{--                                                                @foreach($family_members->orderBy('id', 'DESC')->get() as $family_member)--}}
{{--                                                                    <tr>--}}
{{--                                                                        <th>{{ $family_member->id }}</th>--}}
{{--                                                                        <td>{{ $family_member->relation }}</td>--}}
{{--                                                                        <td>{{ $family_member->first_name }}</td>--}}
{{--                                                                        <td class="w-25">{{ $family_member->last_name }}</td>--}}
{{--                                                                        <td class="d-flex order-actions">--}}
{{--                                                                            <a href="{{ route('family_members->edit', ['client_id' => $id, 'family_member_id' => $family_member]) }}" class="bg-warning text-white"><i class="bx bxs-edit"></i></a>--}}
{{--                                                                            <a href="{{ route('family_members->delete', ['client_id' => $id, 'family_member_id' => $family_member]) }}" class="ms-2 bg-danger text-white"><i class="bx bx bxs-trash"></i></a>--}}
{{--                                                                        </td>--}}
{{--                                                                    </tr>--}}
{{--                                                                @endforeach--}}

{{--                                                                </tbody>--}}
{{--                                                            </table>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                @endif--}}

















                                                <div class="row">
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <button type="submit" class="btn btn-primary btn button_loading_animation_update_profile_data_class" id="client_update_form_button_id">Update</button>
                                                    </div>
                                                </div>

                                            </form>

                                            <div class="row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-9 text-secondary mt-3">
                                                    <a href="{{ route('cases->insert', ['client_id' => $id]) }}"
                                                       class="btn btn-secondary btn button_loading_animation_update_profile_data_class"
                                                       id="client_update_form_button_id">Create a new case</a>
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
                                            value="{{ \App\Models\Crm\Client::where('id', $id)->first()->firstname }}"
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
                                            value="{{ \App\Models\Crm\Client::where('id', $id)->first()->lastname }}"
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
                                            value="{{ \App\Models\Crm\Client::where('id', $id)->first()->id }}"
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
                                            value="{{ \App\Models\Crm\Client::where('id', $id)->first()->firstname }}"
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
                                            value="{{ \App\Models\Crm\Client::where('id', $id)->first()->lastname }}"
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
                                            value="{{ \App\Models\Crm\Client::where('id', $id)->first()->id }}"
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
