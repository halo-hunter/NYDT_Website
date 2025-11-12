<x-crm.includes.header/>

<body>


<!--wrapper-->
<div class="wrapper">
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="card shadow-none">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center mb-4">
                                    <h3 class="text-uppercase">Set account password</h3>
                                    <p class="mb-0 text-uppercase">at NYDT.Law <b class="text-primary"><u>PORTAL</u></b></p>
                                </div>
                                <div class="form-body">
                                    @if(session('password_change_success_message'))
                                        <small>
                                            <div class="alert alert-outline-success shadow-sm alert-dismissible fade show">
                                                <div class="text-success text-capitalize">{{ session('password_change_success_message') }}</div>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </small>
                                    @endif
                                    <form method="post">
                                        @csrf
                                        <div class="mb-3 mt-5">
                                            <label class="form-label">Password</label>
                                            <div class="input-group" id="show_hide_new_password">
                                                <input type="password" class="form-control border-end-0" id="inputNewPassword" placeholder="Enter Password" name="password">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                            @if($errors->has('password'))
                                                <div class="text-danger">{{ $errors->first('password') }}</div>
                                            @else
                                                <div class="text-muted text-capitalize">Required And Password must contain at least 8 characters</div>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Confirm Password</label>
                                            <div class="input-group" id="show_hide_repeat_password">
                                                <input type="password" class="form-control border-end-0" id="inputRepeatPassword" placeholder="Enter Password" name="confirm_password">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                            @if($errors->has('confirm_password'))
                                                <div class="text-danger">{{ $errors->first('confirm_password') }}</div>
                                            @else
                                                <div class="text-muted">Required</div>
                                            @endif
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary button_loading_animation_class">Set Password</button>
                                            <a href="{{ route('portal->login->show') }}" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Back to Login</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div>
<!--end wrapper-->




<x-crm.includes.footer/>
