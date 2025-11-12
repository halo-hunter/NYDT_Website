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
                                    <div class="table-responsive">
                                        <table id="system_status_twilio_messaging" class="table mb-0">
                                            <thead class="table-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Client ID</th>
                                                <th>Case ID</th>
                                                <th>Phone Number</th>
                                                <th>Message Text</th>
                                                <th>Status</th>
                                                <th>Created</th>
                                            </tr>
                                            </thead>
                                            <tbody>

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
