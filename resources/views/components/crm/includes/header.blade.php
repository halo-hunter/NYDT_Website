<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @if(request()->segment(1) != '' && request()->segment(2) != '' && request()->segment(3) != '')
            {{ str()->replace('-', ' ', str()->ucfirst(request()->segment(1))) }} / {{ str()->replace('-', ' ', str()->ucfirst(request()->segment(2))) }} }} / {{ str()->replace('-', ' ', str()->ucfirst(request()->segment(3))) }} - {{ request()->url() }}
        @elseif(request()->segment(1) != '' && request()->segment(2))
            {{ str()->replace('-', ' ', str()->ucfirst(request()->segment(1))) }} / {{ str()->replace('-', ' ', str()->ucfirst(request()->segment(2))) }} - {{ request()->url() }}
        @elseif(request()->segment(1))
            {{ str()->replace('-', ' ', str()->ucfirst(request()->segment(1))) }} - {{ request()->url() }}
        @endif
    </title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('custom-sources/rukada') }}/assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('custom-sources/rukada') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('custom-sources/rukada') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('custom-sources/rukada') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="{{ asset('custom-sources/rukada') }}/assets/plugins/highcharts/css/highcharts.css" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('custom-sources/rukada') }}/assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{ asset('custom-sources/rukada') }}/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('custom-sources/rukada') }}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('custom-sources/rukada') }}/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('custom-sources/rukada') }}/assets/css/app.css" rel="stylesheet">
    <link href="{{ asset('custom-sources/rukada') }}/assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('custom-sources/rukada') }}/assets/css/dark-theme.css" />
    <link rel="stylesheet" href="{{ asset('custom-sources/rukada') }}/assets/css/semi-dark.css" />
    <link rel="stylesheet" href="{{ asset('custom-sources/rukada') }}/assets/css/header-colors.css" />
    <script type="text/javascript" src="{{ asset('assets/js/jquery-3.6.4.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('custom-sources/rukada') }}/assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    {{--<script src="{{ asset('custom-sources/rukada') }}/assets/js/jquery.min.js"></script>--}}
    <script src="{{ asset('custom-sources/rukada') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>

    <script src="{{ asset('custom-sources/rukada') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>

    <script src="{{ asset('custom-sources/rukada') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('custom-sources/rukada') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

    <!-- Datatables -->
    <link id="pagestyle" href="{{ asset('custom-sources/rukada') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

    <link href="{{ asset('custom-sources/rukada') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('custom-sources/rukada') }}/assets/plugins/select2/css/select2-bootstrap4.css?" rel="stylesheet" />
    <script src="{{ asset('custom-sources/rukada') }}/assets/plugins/select2/js/select2.min.js"></script>

    <link href="{{ asset('custom-sources/rukada') }}/assets/plugins/input-tags/css/tagsinput.css" rel="stylesheet" />
    <script src="{{ asset('custom-sources/rukada') }}/assets/plugins/input-tags/js/tagsinput.js"></script>

    <script src="{{ asset('custom-sources/rukada') }}/assets/plugins/chartjs/chart.min.js"></script>

    <script src="{{ asset('custom-sources/rukada') }}/assets/plugins/input-mask/dist/jquery.mask.js"></script>

    <script src="{{ asset('custom-sources/fullcalendar') }}/index.global.js"></script>

    <!--app JS-->
    <script src="{{ asset('custom-sources/rukada') }}/assets/js/app.js"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v=1{{ time() }}" />
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}?v=1{{ time() }}"></script>
</head>
