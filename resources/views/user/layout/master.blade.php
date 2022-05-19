<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords"
        content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Santara | Dashboard</title>
    {{--
    <link rel="apple-touch-icon" href="{{asset('public/admin')}}/app-assets/images/ico/apple-icon-120.png"> --}}
    {{--
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/admin')}}/app-assets/images/ico/favicon.ico">
    --}}
    <link rel="shortcut icon" type="image/x-icon"
        href="https://storage.googleapis.com/asset-santara/santara.co.id/images/ico/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin')}}/app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin')}}/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin')}}/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin')}}/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin')}}/app-assets/css/components.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{asset('public/admin')}}/app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('public/admin')}}/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('public/admin')}}/app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin')}}/app-assets/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('public/admin')}}/app-assets/fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('public/admin')}}/app-assets/css/core/colors/palette-gradient.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin')}}/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {{-- <script src="{{asset('public')}}/app-assets/js/core/jquery/jquery.min.js"></script> --}}
    <!-- END: Custom CSS-->
    @yield('style')
    <script src="{{ asset('public/admin') }}/app-assets/vendors/js/vendors.min.js"></script>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('user.layout.navbar')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->

    @include('user.layout.sidebar')

    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    
            
                            

                    
    @yield('content')
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer
        class="footer footer-on-sidemenu footer-static footer-dark navbar-border navbar-shadow">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2 pb-2">
            <span class="float-md-left d-block d-md-inline-block">Santara Website Ver 5.8.8 - Business Ver 3.6.2 |
                Copyright © 2022
                {{-- <img src="https://storage.googleapis.com/asset-santara/santara.co.id/images/ico/favicon-16x16.png">
                --}}
                Santara, All rights reserved. </span>

        </p>
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    
    {{-- <script src="{{asset('public/admin')}}/app-assets/vendors/js/vendors.min.js"></script> --}}
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('public/admin')}}/app-assets/vendors/js/charts/chart.min.js"></script>
    <script src="{{asset('public/admin')}}/app-assets/vendors/js/charts/raphael-min.js"></script>
    <script src="{{asset('public/admin')}}/app-assets/vendors/js/charts/morris.min.js"></script>
    <script src="{{asset('public/admin')}}/app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js">
    </script>
    <script src="{{asset('public/admin')}}/app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js">
    </script>
    <script src="{{asset('public/admin')}}/app-assets/data/jvector/visitor-data.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('public/admin')}}/app-assets/js/core/app-menu.js"></script>
    <script src="{{asset('public/admin')}}/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->
    <!-- BEGIN: Page JS-->
    {{-- <script src="{{asset('public/admin')}}/app-assets/js/scripts/pages/dashboard-sales.js"></script> --}}
    <!-- END: Page JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- END: Theme JS-->
    <!-- BEGIN: Page JS-->
    {{-- <script src="{{asset('public/admin')}}/app-assets/js/scripts/pages/dashboard-sales.js"></script> --}}
    <!-- END: Page JS-->
    @if(Session::has('message'))
    <script>
        toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    var type = "{{Session::get('alert-type','success')}}"
    switch (type) {
        case 'success':
        toastr.success("{{Session::get('message')}}");
        // Swal.fire("Berhasil","{{Session::get('message')}}","success");
        // Swal.fire("Good job!", "You clicked the button!", "success");
        break;
        case 'fail':
        toastr.error("{{Session::get('message')}}");
        // Swal.fire("Berhasil","{{Session::get('message')}}","success");
        // Swal.fire("Good job!", "You clicked the button!", "success");
        break;
        case 'warning':
        toastr.warning("{{Session::get('message')}}");
        // Swal.fire("Berhasil","{{Session::get('message')}}","success");
        // Swal.fire("Good job!", "You clicked the button!", "success");
        break;
    }
    </script>
    @endif
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('js')

</body>
<!-- END: Body-->

</html>