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
                                        <div class="mt-3">
                                            <h4 class="text-dark mb-1">Case: {{ $id }}</h4>
                                            <h5 class="text-capitalize">{{ $client->firstname }} {{ $client->lastname }}</h5>
                                            <p class="text-secondary mb-1 text-capitalize">{{ $client->email }}</p>
                                        </div>
                                        <form method="post">
                                            @csrf
                                            <input type="text" value="{{ $id }}" name="case_id" hidden="">
                                            <div class="text-secondary mt-2 mb-3">
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
