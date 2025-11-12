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
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <div class="alert alert-outline-warning shadow-sm alert-dismissible fade show py-2">
                                            <div class="d-flex align-items-center">
                                                <div class="font-35 text-warning">
                                                    <i class="bx bx-info-circle"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="mb-0 text-warning">Warning</h6>
                                                    <div>
                                                        If a user is deleted, any todo tasks created by them for others or their personal tasks will also be deleted.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <h4>{{ \App\Models\User::where('id', $id)->first()->firstname }} {{ \App\Models\User::where('id', $id)->first()->lastname }}</h4>
                                            <p class="text-secondary mb-1">{{ \App\Models\User::where('id', $id)->first()->email }}</p>
                                            <p class="text-secondary mb-1 text-capitalize">{{ \App\Models\Crm\UserLevel::where('user_level_id', \App\Models\User::where('id', $id)->first()->user_level_id)->first()->user_level_name }}</p>
                                        </div>
                                        <form method="post">
                                            @csrf
                                            <input type="text" value="{{ $id }}" name="user_id" hidden="">
                                            <div class="text-secondary">
                                                <button type="submit" class="btn btn-danger btn button_loading_animation_update_profile_data_class">Delete</button>
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
    <x-crm.includes.dashboard-footer1/>
</div>
<!--end wrapper-->
<x-crm.includes.footer/>
