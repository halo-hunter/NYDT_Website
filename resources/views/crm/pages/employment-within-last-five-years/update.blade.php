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
                                            <form method="post" action="{{ route('employment_within_last_five_years->update', $item_id) }}" enctype="multipart/form-data" autocomplete="off">
                                                @method('put')
                                                @csrf

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Name</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ $item->employment_w_l_f_y__name }}" name="name"/>
                                                        @if($errors->has('name'))
                                                            <div class="text-danger">{{ $errors->first('name') }}</div>
                                                        @else
                                                            <div class="text-muted">Required</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Address of Employer</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ $item->employment_w_l_f_y__address_of_employer }}" name="address_of_employer"/>
                                                        @if($errors->has('address_of_employer'))
                                                            <div class="text-danger">{{ $errors->first('address_of_employer') }}</div>
                                                        @else
                                                            <div class="text-muted">Required</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Your Occupation</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" value="{{ $item->employment_w_l_f_y__your_occupation }}" name="your_occupation"/>
                                                        @if($errors->has('your_occupation'))
                                                            <div class="text-danger">{{ $errors->first('your_occupation') }}</div>
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
                                                        <input type="date" class="form-control" value="{{ $item->employment_w_l_f_y__from }}" name="from"/>
                                                        @if($errors->has('from'))
                                                            <div class="text-danger">{{ $errors->first('from') }}</div>
                                                        @else
                                                            <div class="text-muted">Required</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">To</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="date" class="form-control" value="{{ $item->employment_w_l_f_y__to }}" name="to"/>
                                                        @if($errors->has('to'))
                                                            <div class="text-danger">{{ $errors->first('to') }}</div>
                                                        @else
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
