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
                                            <form method="post" action="{{ route('entry_date->update', $entry_date_id) }}" enctype="multipart/form-data" autocomplete="off">
                                                @method('put')
                                                @csrf

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Date</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="date" class="form-control" value="{{ $entry_date->date }}" name="date"/>
                                                        @if($errors->has('date'))
                                                            <div class="text-danger">{{ $errors->first('date') }}</div>
                                                        @else
                                                            <div class="text-muted">Required</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Place</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <textarea class="form-control" rows="2" name="place">{{ $entry_date->place }}</textarea>
                                                        @if($errors->has('place'))
                                                            <div class="text-danger">{{ $errors->first('place') }}</div>
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
