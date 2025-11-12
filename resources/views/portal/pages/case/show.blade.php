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
                            <li class="breadcrumb-item active" aria-current="page">Case: {{ $case_id }}</li>
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
                                    <div class="row">
                                        <div class="col-12">
                                            <b>Notes:</b>
                                        </div>
                                        <div class="col-12">
                                            @forelse(\App\Models\Crm\CaseNote::where('case_id', $case_id)->orderBy('id', 'desc')->get() as $case_note)
                                                @if($case_note->email_is_send == 1 || $case_note->sms_is_send == 1)
                                                    <div class="col-12 bg-light border-bottom border-1">
                                                        <div class="m-2">
                                                            <div class="row">
                                                                <div class="col-12 notes_show_block_text_class mt-2">
                                                                    {{ $case_note->note_text }}
                                                                </div>
                                                                <div class="col-12 mt-1">
                                                                    @if($case_note->email_is_send)
                                                                        <svg xmlns="http://www.w3.org/2000/svg" title="mail has sent" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail text-primary"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                                                    @endif
                                                                    @if($case_note->sms_is_send)
                                                                        <svg xmlns="http://www.w3.org/2000/svg" title="sms has sent" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square text-primary"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                                                    @endif
                                                                </div>
                                                                <div class="col-6 text-start mt-1">
                                                                    <small>Author: {{ \App\Models\User::where('id', $case_note->user_id)->first()->firstname }} {{ \App\Models\User::where('id', $case_note->user_id)->first()->lastname }}</small>
                                                                </div>
                                                                <div class="col-6 text-end mt-1">
                                                                    <small>{{ \Carbon\Carbon::parse($case_note->created_at)->format('m/d/Y H:i') }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @empty
                                                <div class="col-12">
                                                    <p class="text-center mt-5">Notes not found</p>
                                                </div>
                                            @endforelse
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
<x-crm.includes.footer/>
