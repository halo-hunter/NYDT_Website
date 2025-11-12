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
                                    <h3 class="text-uppercase">Sign in</h3>
                                    <p class="mb-0 text-uppercase">Login to your <b class="text-primary"><u>crm</u></b> account</p>
                                </div>
                                <div class="form-body">
                                    @error('credentials_is_incorrect')
                                        <small>
                                            <div class="alert alert-outline-danger shadow-sm alert-dismissible fade show">
                                                <div class="text-danger text-capitalize">{{ $message }}</div>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </small>
                                    @enderror
                                    @if(session('password_change_success_message'))
                                        <small>
                                            <div class="alert alert-outline-success shadow-sm alert-dismissible fade show">
                                                <div class="text-success text-capitalize">{{ session('password_change_success_message') }}</div>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </small>
                                    @endif
                                    <form class="row g-4" method="post">
                                        @csrf
                                        <div class="col-12">
                                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                                            <input type="text" class="form-control @error('email') border-danger @enderror" id="inputEmailAddress" placeholder="Email Address" autocomplete="off" name="email" value="{{ old('email') }}" autofocus>
                                            @if($errors->has('email'))
                                                <div class="text-danger">{{ $errors->first('email') }}</div>
                                            @else
                                                <div class="text-muted">Required</div>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" class="form-control border-end-0 @error('password') border-danger @enderror" id="inputChoosePassword" placeholder="Enter Password" name="password" value="{{ old('password') }}">
                                                <a href="javascript:;" class="input-group-text bg-transparent @error('password') border-danger @enderror"><i class='bx bx-hide'></i></a>
                                            </div>
                                            @if($errors->has('password'))
                                                <div class="text-danger">{{ $errors->first('password') }}</div>
                                            @else
                                                <div class="text-muted">Required</div>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-switch">

                                            </div>
                                        </div>
                                        <div class="col-md-6 text-end">	<a href="{{ route('pages->forgot_password->show') }}">Forgot Password ?</a>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary button_loading_animation_class"><i class="bx bxs-lock-open"></i>Sign in</button>
                                            </div>
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
