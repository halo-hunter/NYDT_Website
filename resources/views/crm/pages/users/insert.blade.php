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
                                    @error('email_settings_update_success_message')
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
                                                <h6 class="mb-0">First Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{ old('firstname') }}" name="firstname" />
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
                                                <input type="text" class="form-control" value="{{ old('lastname') }}" name="lastname" />
                                                @error('lastname')
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
                                                <h6 class="mb-0">User Level</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <select class="form-select text-capitalize" aria-label="Default select example" name="user_level">
                                                    <option selected disabled>Select</option>
                                                    @foreach(\App\Models\Crm\UserLevel::all() as $user_level)
                                                        <option value="{{ $user_level->user_level_id }}" @if(old('user_level') == $user_level->user_level_id) selected @endif>{{ $user_level->user_level_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('user_level')
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
                                                    <div class="text-muted">Password must contain at least 8 characters</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Confirm Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <div class="input-group" id="show_hide_password_2">
                                                    <input type="password" class="form-control border-end-0" placeholder="Enter New Password" name="confirm_password">
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
    <x-crm.includes.dashboard-footer1/>
</div>
<!--end wrapper-->
<x-crm.includes.footer/>
