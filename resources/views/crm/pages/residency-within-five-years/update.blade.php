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
                                            <form method="post" action="{{ route('residency_within_five_years->update', $item_id) }}" enctype="multipart/form-data" autocomplete="off">
                                                @method('put')
                                                @csrf

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Number and street</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ $item->number_and_street }}" name="number_and_street"/>
                                                        @if($errors->has('number_and_street'))
                                                            <div class="text-danger">{{ $errors->first('number_and_street') }}</div>
                                                        @else
                                                            <div class="text-muted">Required</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">City / Town</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ $item->city_town }}" name="city_town"/>
                                                        @if($errors->has('city_town'))
                                                            <div class="text-danger">{{ $errors->first('city_town') }}</div>
                                                        @else
                                                            <div class="text-muted">Required</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Department, Province or State</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ $item->department_province_or_state }}" name="department_province_or_state"/>
                                                        @if($errors->has('department_province_or_state'))
                                                            <div class="text-danger">{{ $errors->first('department_province_or_state') }}</div>
                                                        @else
                                                            <div class="text-muted">Required</div>
                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Country</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <select class="form-select single-select" aria-label="Default select example" name="country_id">
                                                            <option value="">Select</option>
                                                            @foreach($countries as $country)
                                                                <option value="{{ $country->id }}" {{ $item->country_id == $country->id ? 'selected' : ''}}>{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('country_id'))
                                                            <div class="text-danger">{{ $errors->first('country_id') }}</div>
                                                        @else
                                                            <div class="text-muted">Required</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">From</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="date" class="form-control" value="{{ $item->from }}" name="from"/>
                                                        @if($errors->has('from'))
                                                            <div class="text-danger">{{ $errors->first('from') }}</div>
                                                        @else
                                                            <div class="text-muted">Click the calendar icon</div>
                                                            <div class="text-muted">Required</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">To</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="date" class="form-control" value="{{ $item->to }}" name="to"/>
                                                        @if($errors->has('to'))
                                                            <div class="text-danger">{{ $errors->first('to') }}</div>
                                                        @else
                                                            <div class="text-muted">Click the calendar icon</div>
                                                            <div class="text-muted">Required</div>
                                                        @endif
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
        </div>
    </div>



    <x-crm.includes.dashboard-footer1/>
    <x-crm.includes.footer-modals/>
</div>
<!--end wrapper-->
<x-crm.includes.footer/>
