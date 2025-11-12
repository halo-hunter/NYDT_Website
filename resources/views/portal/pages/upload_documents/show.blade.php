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
                            <li class="breadcrumb-item active" aria-current="page">Upload Documents</li>
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

                                    @if(count($uploaded_documents) != 0)

                                        @foreach($uploaded_documents as $uploaded_document)
                                            <div class="row mb-5 border">
                                                <div class="col-sm-3 border p-3">
                                                    <h6 class="mb-0 text-capitalize">{{ $uploaded_document->document_name }}</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary border p-3">
                                                    <a href="{{ asset('files/requested_documents/' . \App\Models\Crm\UploadDocumentVersionTwo::where('requested_document_id', $uploaded_document->id)->first()->name) }}" download>download file</a>
                                                </div>
                                            </div>
                                        @endforeach

                                    @endif

                                    @if(count($requested_documents) != 0)
                                        <form method="post" enctype="multipart/form-data">
                                            @csrf
                                            @foreach($requested_documents as $requested_document)
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0 text-capitalize">{{ $requested_document->document_name }}</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input class="form-control requested_documents_form_file_inputs_class" type="file" name="files[{{ str_replace(' ', '_', $requested_document->document_name) }}]" required>
                                                        @if($errors->has('files.' . str_replace(' ', '_', $requested_document->document_name)))
                                                            <div class="text-danger">{{ $errors->first('files.' . str_replace(' ', '_', $requested_document->document_name)) }}</div>
                                                        @else
                                                            <div class="text-muted">Allowed file type: pdf, Maximum file size must be: 10 mb</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-9 text-secondary">
                                                    <button type="submit" class="btn btn-primary" id="requested_documents_submit_button_id">Send</button>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        <div class="row">
                                            <div class="row-12 text-center">
                                                Requested document not found
                                            </div>
                                        </div>
                                    @endif
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
