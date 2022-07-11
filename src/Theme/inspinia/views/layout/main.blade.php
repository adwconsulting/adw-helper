<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link href="{{ asset('inspinia/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/assets/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/assets/css/plugins/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/assets/css/plugins/select2/select2-bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/assets/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/assets/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/assets/css/plugins/clockpicker/clockpicker.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/assets/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/assets/css/plugins/ladda/ladda-themeless.min.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
    @yield('css')
    <link href="{{ asset('inspinia/assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/assets/css/style.css') }}" rel="stylesheet">
    @yield('cssPage')
</head>

@if(View::hasSection('sidebarRight'))
    <body class="scrollspy">
        <main>
@else
    <body>
@endif
    <div id="wrapper">
        @include('layout.sidebar')
        <div id="page-wrapper" class="white-bg">
            @include('layout.header')
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>@yield('title')</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ URL::to('/') }}">Home</a>
                        </li>
                       @yield('breadcrumb')
                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                        @yield('action')
                    </div>
                </div>
            </div>

            <div class="wrapper wrapper-content">
                <div class="animated fadeInRightBig">
                    @yield('content')
                </div>
            </div>
            @include('layout.footer')
        </div>
    </div>
    @yield('sidebarRight')
    @if(View::hasSection('sidebarRight'))
        </main>
    @endif
    <!-- Mainly scripts -->
    <script src="{{ asset('inspinia/assets/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('inspinia/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('inspinia/assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('inspinia/assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('inspinia/assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('inspinia/assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('inspinia/assets/js/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('inspinia/assets/js/plugins/autonumeric/autonumeric.js') }}"></script>
    <script src="{{ asset('inspinia/assets/js/bootbox/bootbox.min.js') }}"></script>
    <script src="{{ asset('inspinia/assets/js/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('inspinia/assets/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('inspinia/assets/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('inspinia/assets/js/plugins/clockpicker/clockpicker.js') }}"></script>
    <script src="{{ asset('inspinia/assets/js/plugins/ladda/spin.min.js') }}"></script>
    <script src="{{ asset('inspinia/assets/js/plugins/ladda/ladda.min.js') }}"></script>
    <script src="{{ asset('inspinia/assets/js/plugins/ladda/ladda.jquery.min.js') }}"></script>
    <script src="{{ asset('inspinia/assets/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    @yield('js')
    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia/assets/js/inspinia.js') }}"></script>
    <script src="{{ asset('inspinia/assets/js/plugins/pace/pace.min.js') }}"></script>
    <script>
        {!! Adw\Formatter\Config::jsConfig() !!}
    </script>
    <script src="{{ asset('inspinia/assets/js/jquery.number.min.js') }}"></script>
    <script src="{{ asset('inspinia/assets/js/lang/id.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/juho0q3krcfm1xpwgjekwl4eazb2yf6i16wh82ba3rc3qkvd/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ asset('inspinia/assets/js/app.js') }}"></script>
    @yield('jsPage')
</body>
</html>