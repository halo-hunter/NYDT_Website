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
                                    <div class="d-flex flex-column align-items-center text-center text-capitalize">
                                        <div class="mt-3">
                                            <h4>{{ $item->number_and_street }}</h4>
                                            <p class="text-secondary mb-1">{{ $item->city_town }}</p>
                                        </div>
                                        <form method="post" action="{{ route('residency_within_five_years->destroy', $item->id) }}">
                                            @method('delete')
                                            @csrf
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
