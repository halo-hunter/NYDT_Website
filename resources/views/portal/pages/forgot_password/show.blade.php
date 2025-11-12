<x-crm.includes.header/>

<body>


<!-- wrapper -->
<div class="wrapper">
    <div class="authentication-forgot d-flex align-items-center justify-content-center">
        <div class="card forgot-box shadow-none">
            <div class="card-body">
                <div class="p-4 rounded  border">
                    <div class="text-center">
                        <img src="{{ asset('custom-sources/rukada') }}/assets/images/icons/forgot-2.png" width="100" alt="" />
                    </div>
                    <h5 class="mt-5 font-weight-bold">Forgot Password?</h5>
                    <p class="text-muted">Enter your email address to reset the password</p>
                    @if(session()->has('password_change_url_send_success_message'))
                        <small>
                            <div class="alert alert-outline-success shadow-sm alert-dismissible fade show">
                                <div class="text-success text-capitalize">{{ session()->get('password_change_url_send_success_message') }}</div>
                                <div class="text-capitalize text-muted mt-1"><b>notes:</b></div>
                                <div class="text-capitalize text-muted">&bull; password link is active for 5 minutes</div>
                                <div class="text-capitalize text-muted">&bull; if you do not receive the email, please also check <br> your JUNK or SPAM folder</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </small>
                    @endif
                    <form method="post">
                        @csrf
                        <div class="my-4">
                            <label class="form-label">Email Address</label>
                            <input type="text" class="form-control form-control" name="email" autofocus placeholder="Email Address"/>
                            @if($errors->has('email'))
                                <div class="text-danger">{{ $errors->first('email') }}</div>
                            @else
                                <div class="text-muted">Required</div>
                            @endif
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn button_loading_animation_class">Send</button>
                            <a href="{{ route('portal->login->show') }}" class="btn btn-light"><i class='bx bx-arrow-back me-1'></i>Back to Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end wrapper -->

<x-crm.includes.footer/>
