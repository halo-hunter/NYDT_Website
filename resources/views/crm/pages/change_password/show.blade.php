<x-crm.includes.header/>

<body>

<!-- wrapper -->
<div class="wrapper">
    <div class="authentication-reset-password d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col-12 col-lg-10 mx-auto">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-lg-5 border-end">
                            <div class="card-body">
                                <div class="p-5">
                                    <h4 class="mt-2 font-weight-bold">Create New Password</h4>
                                    <p class="text-muted">We received your reset password request. Please enter your new password!</p>
                                    @if(!empty($token_not_found))
                                        <small>
                                            <div class="alert alert-outline-danger shadow-sm alert-dismissible fade show">
                                                <div class="text-danger text-capitalize">{{ $token_not_found }}</div>
                                            </div>
                                        </small>
                                        <div class="d-grid gap-2">
                                            <a href="{{ route('pages->forgot_password->show') }}" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Back to Change Password</a>
                                            <a href="{{ route('pages->login->show') }}" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Back to Login</a>
                                        </div>
                                    @else
                                        <form method="post">
                                            @csrf
                                            <div class="mb-3 mt-5">
                                                <label class="form-label">New Password</label>
                                                <div class="input-group" id="show_hide_new_password">
                                                    <input type="password" class="form-control border-end-0" id="inputNewPassword" placeholder="Enter New Password" name="new_password">
                                                    <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                                @if($errors->has('new_password'))
                                                    <div class="text-danger">{{ $errors->first('new_password') }}</div>
                                                @else
                                                    <div class="text-muted text-capitalize">Required And Password must contain at least 8 characters</div>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Confirm Password</label>
                                                <div class="input-group" id="show_hide_repeat_password">
                                                    <input type="password" class="form-control border-end-0" id="inputRepeatPassword" placeholder="Enter New Password" name="confirm_password">
                                                    <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                                @if($errors->has('confirm_password'))
                                                    <div class="text-danger">{{ $errors->first('confirm_password') }}</div>
                                                @else
                                                    <div class="text-muted">Required</div>
                                                @endif
                                            </div>
                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-primary button_loading_animation_class">Change Password</button>
                                                <a href="{{ route('pages->login->show') }}" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Back to Login</a>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <img src="{{ asset('custom-sources/rukada') }}/assets/images/login-images/forgot-password-frent-img.jpg" class="card-img login-img h-100" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end wrapper -->




<x-crm.includes.footer/>
