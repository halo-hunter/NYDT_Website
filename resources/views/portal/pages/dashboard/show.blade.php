<x-crm.includes.header/>
<body>
<!--wrapper-->
<div class="wrapper">
    <!--start header wrapper-->
    <div class="header-wrapper">
        <!--start header -->
        <header>
            <x-portal.includes.dashboard-nav1/>
        </header>
        <!--end header -->
        <!--navigation-->
        <x-portal.includes.dashboard-nav2/>
        <!--end navigation-->
    </div>
    <!--end header wrapper-->
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card bg-transparent shadow-none">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <h5 class="mb-0 mb-md-0">Dashboard</h5>
                        </div>
                        <div class="col-md-9">

                        </div>
                    </div>
                    <hr>
                    <div class="chart-js-container3">
                        <canvas id="chart5"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-crm.includes.dashboard-footer1/>
</div>
<!--end wrapper-->
<x-crm.includes.footer/>
