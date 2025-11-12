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
                                    @error('attorney_profile_deleted_successfully')
                                    <small>
                                        <div class="alert alert-outline-success shadow-sm alert-dismissible fade show">
                                            <div class="text-success text-capitalize">{{ $message }}</div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </small>
                                    @enderror
                                    @error('attorney_profile_created_successfully')
                                    <small>
                                        <div class="alert alert-outline-success shadow-sm alert-dismissible fade show">
                                            <div class="text-success text-capitalize">{{ $message }}</div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </small>
                                    @enderror
                                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                                        <div class="position-relative">
                                            <a href="{{ route('attorneys->insert') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i> Add New Attorney</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="attorneys" class="table mb-0">
                                            <thead class="table-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>First name</th>
                                                <th>Last name</th>
                                                <th>Company Name</th>
                                                <th>State</th>
                                                <th>City</th>
                                                <th>Zip Code</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Created</th>
                                                <th>Updated</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-capitalize">

                                            </tbody>
                                        </table>
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
</div>
<!--end wrapper-->
<x-crm.includes.footer/>
