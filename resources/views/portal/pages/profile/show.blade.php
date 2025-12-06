<x-crm.includes.header/>
<body>
<!--wrapper-->
<div class="wrapper">
    <!--start header wrapper-->
    <div class="header-wrapper">
        <!--start header -->
        <header>
            <x-portal.includes.dashboard-nav1/>
        </header>
        <!--end header -->
        <!--navigation-->
        <x-portal.includes.dashboard-nav2/>
        <!--end navigation-->
    </div>
    <!--end header wrapper-->
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="container-fluid page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">PORTAL</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="container-fluid">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    @if(!empty($profile_photo))
                                        <img class="img-thumbnail mb-3" src="{{ URL::temporarySignedRoute('portal->download->profile_photo_inline', now()->addMinutes(15), ['clientId' => $client_id]) }}" alt="Profile photo" width="150">
                                        <div>
                                            <a href="{{ URL::temporarySignedRoute('portal->download->profile_photo', now()->addMinutes(15), ['clientId' => $client_id]) }}" download>Download</a>
                                        </div>
                                    @else
                                        <img class="img-thumbnail mb-3" src="{{ asset('images/avatar.png') }}" alt="Profile photo" width="150">
                                    @endif
                                    <div class="mt-3">
                                        <h4 class="text-capitalize">{{ $firstname }} {{ $lastname }}</h4>
                                        <p class="text-secondary mb-1">{{ $email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card p-3">
                                <div class="card-body">
                                    @error('user_profile_updated_successfully')
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
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{ $email }}" name="email" />
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
                                                <input type="text" class="form-control" value="{{ $phone }}" name="phone" id="portal_customer_phone_number_input_id" />
                                                @error('phone')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone (Secondary)</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{ $phone_secondary }}" name="phone_secondary" id="portal_secondarycustomer_phone_number_input_id" />
                                                @error('phone_secondary')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">New Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <div class="input-group" id="show_hide_password_1">
                                                    <input type="password" class="form-control border-end-0" placeholder="Enter New Password" name="new_password">
                                                    <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                                @if($errors->has('new_password'))
                                                    <div class="text-danger">{{ $errors->first('new_password') }}</div>
                                                @else
                                                    <div class="text-muted">Field must be at least 8 characters.</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Confirm Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <div class="input-group" id="show_hide_password_2">
                                                    <input type="password" class="form-control border-end-0" placeholder="Repeat New Password" name="confirm_password">
                                                    <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                                @error('confirm_password')
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
