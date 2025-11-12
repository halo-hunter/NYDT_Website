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
            <div class="container-fluid page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">CRM</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="container-fluid">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card p-4">
                                <div class="card-body">
                                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                                        <div class="position-relative">

                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="card radius-10 bg-gradient-deepblue">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <h5 class="mb-0 text-white">{{ number_format($summary['total_cases']) }}</h5>
                                                            <div class="ms-auto">
                                                                <i class="bx bx-list-ul fs-3 text-white"></i>
                                                            </div>
                                                        </div>
                                                        <div class="progress my-2 bg-white-transparent" style="height:4px;">
                                                            <div class="progress-bar bg-white" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <div class="d-flex align-items-center text-white">
                                                            <p class="mb-0">Total cases charged</p>
                                                            <p class="mb-0 ms-auto">+0%<span><i class="bx bx-up-arrow-alt"></i></span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="card radius-10 bg-gradient-ohhappiness">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <h5 class="mb-0 text-white">${{ number_format($summary['total_paid'], 2) }}</h5>
                                                            <div class="ms-auto">
                                                                <i class="bx bx-dollar fs-3 text-white"></i>
                                                            </div>
                                                        </div>
                                                        <div class="progress my-2 bg-white-transparent" style="height:4px;">
                                                            <div class="progress-bar bg-white" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <div class="d-flex align-items-center text-white">
                                                            <p class="mb-0">Total paid</p>
                                                            <p class="mb-0 ms-auto">+0%<span><i class="bx bx-up-arrow-alt"></i></span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="card radius-10 overflow-hidden">
                                                    <div class="card-body">
                                                        <p class="mb-2">Cases Updated</p>
                                                        <h4 class="mb-0">{{ number_format($summary['cases_updated']) }} <small class="font-13 text-success">0% <i class="bx bx-up-arrow-alt"></i></small></h4>
                                                    </div>
                                                    <div class="chart-container-2">
                                                        <canvas id="chart3" width="404" height="210" style="display: block; box-sizing: border-box; height: 210px; width: 404px;"></canvas>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="card radius-10 overflow-hidden">
                                                    <div class="card-body">
                                                        <p class="mb-2">Cases Closed</p>
                                                        <h4 class="mb-0">{{ number_format($summary['cases_closed']) }} <small class="font-13 text-success">0% <i class="bx bx-up-arrow-alt"></i></small></h4>

                                                    </div>
                                                    <div class="chart-container-2">
                                                        <canvas id="chart4" width="404" height="210" style="display: block; box-sizing: border-box; height: 210px; width: 404px;"></canvas>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="card radius-10 overflow-hidden">
                                                    <div class="card-body">
                                                        <p class="mb-2">Cases On Hold</p>
                                                        <h4 class="mb-0">{{ number_format($summary['cases_on_hold']) }} <small class="font-13 text-success">0% <i class="bx bx-up-arrow-alt"></i></small></h4>

                                                    </div>
                                                    <div class="chart-container-2">
                                                        <canvas id="chart5" width="404" height="210" style="display: block; box-sizing: border-box; height: 210px; width: 404px;"></canvas>
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
            </div>
        </div>
    </div>
    <x-crm.includes.dashboard-footer1/>
</div>
<!--end wrapper-->
<script>
    const buildChart = (ctx, labels, data, color, label) => {
        return new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    backgroundColor: [
                        color
                    ],
                    tension: 0.4,
                    borderColor: [
                        color
                    ],
                    borderWidth: 3,
                    pointRadius :"0",
                }]
            },
            options: {
                maintainAspectRatio: false,
                barPercentage: 0.7,
                categoryPercentage: 0.45,
                plugins: {
                    legend: {
                        maxWidth: 20,
                        boxHeight: 20,
                        position:'bottom',
                        display: false,
                    }
                },
                scales: {
                    x: {
                        stacked: false,
                        beginAtZero: true,
                        display: false,
                    },
                    y: {
                        stacked: false,
                        beginAtZero: true,
                        display: false,
                    }
                }
            }
        });
    };

    buildChart(
        document.getElementById('chart3').getContext('2d'),
        @json($charts['cases_updated']['labels']),
        @json($charts['cases_updated']['values']),
        '#009688',
        'Cases Updated'
    );

    buildChart(
        document.getElementById('chart4').getContext('2d'),
        @json($charts['cases_closed']['labels']),
        @json($charts['cases_closed']['values']),
        '#fb6340',
        'Cases Closed'
    );

    buildChart(
        document.getElementById('chart5').getContext('2d'),
        @json($charts['cases_on_hold']['labels']),
        @json($charts['cases_on_hold']['values']),
        '#00b6ff',
        'Cases On Hold'
    );

</script>
<x-crm.includes.footer/>
