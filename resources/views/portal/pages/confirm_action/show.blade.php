<x-crm.includes.header/>
<body>
<div class="wrapper">
    <div class="page-wrapper">
        <div class="page-content">
            <div class="container">
                <div class="row justify-content-center mt-5">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Confirm your password</h5>
                                <p class="text-muted">For security, please confirm your password to continue.</p>
                                <form method="post" action="{{ route('portal->confirm_action->confirm') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                        @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-crm.includes.footer/>
