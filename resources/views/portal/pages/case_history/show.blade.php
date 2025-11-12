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
            <!--breadcrumb-->
            <div class="container-fluid page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">PORTAL</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('portal->dashboard->show') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Case History</li>
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
                                    @error('documents_sent_successfully')
                                    <small>
                                        <div class="alert alert-outline-success shadow-sm alert-dismissible fade show">
                                            <div class="text-success text-capitalize">{{ $message }}</div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </small>
                                    @enderror
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="table-light">
                                            <tr>
                                                <th scope="col">Case ID</th>
                                                <th scope="col" class="w-25 text-end">Upload Documents</th>
                                                <th scope="col" class="w-25 text-end">View</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($customer_cases as $customer_case)
                                                    <tr>
                                                        <td class="case_history_table_case_id_row_class">{{ $customer_case->id }}</td>
                                                        <td>
                                                            <a href="{{ route('portal->upload_documents->show', $customer_case->id) }}" type="button" class="btn btn-sm btn-outline-primary float-end">Upload documents</a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('portal->case->show', $customer_case->id) }}" type="button" class="btn btn-sm btn-outline-primary float-end">View</a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center p-4 text-muted">Case not found</td>
                                                    </tr>
                                                @endforelse

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
