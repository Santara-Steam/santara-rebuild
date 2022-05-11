<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>Santara - Dashboard</title>
    {{-- <link rel="apple-touch-icon" href="<?= STORAGE_GOOGLE ?>images/ico/apple-icon-120.png"> --}}
    {{-- <link rel="shortcut icon" type="image/x-icon" href="<?= STORAGE_GOOGLE ?>images/ico/favicon.ico"> --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/app-assets/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/app-assets/css/form.css">
    <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/app-assets/css/app.css">

    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/app-assets/vendors/css/cryptocoins/cryptocoins.css">
    <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/app-assets/css/plugins/forms/wizard.css">
    <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/app-assets/css/plugins/pickers/daterange/daterange.css">

    <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/app-assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/assets/fonts/line-awesome/css/line-awesome.css">
    <!-- END Page Level CSS-->

    <!-- BEGIN Custom CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/assets/css/admin/style.css?v=<?= WEB_VERSION; ?>"> --}}
    <!-- END Custom CSS-->
    <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/app-assets/css/plugins/pickers/datepicker.css">
    <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/app-assets/css/fileinput.min.css">
    <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/app-assets/vendors/css/forms/inputs/fileinput.css">
    <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/app-assets/css/plugins/flatpickr/flatpickr.min.css">

    <script src="https://old.santara.co.id/app-assets/js/core/jquery/jquery.min.js"></script>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-1Q1LJHYT5Q');
    </script>
</head>

<body class="vertical-layout vertical-menu-modern 2-columns m nu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- TOP MENU-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row position-relative">
                    <li class="nav-item mobile-menu d-md-none mr-auto">
                        <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                            <i class="ft-menu font-large-1"></i>
                        </a>
                    </li>
                    <li class="nav-item mr-auto">
                        <a class="navbar-brand" href="/">
                            <img class="logo-brand" style="width:65%" alt="modern admin logo" >
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block nav-toggle">
                        <a class="nav-link modern-nav-toggle pr-0 pt-2" data-toggle="collapse">
                            <i class="toggle-icon ft-toggle-right font-medium-3 brown" data-ticon="ft-toggle-right"></i>
                        </a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile">
                            <i class="la la-ellipsis-v"> </i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    
                </div>
            </div>
        </div>
    </nav>

    <!-- LEFT MENU -->
    @yield('content')

    <div style="margin-top: 100px">&nbsp;</div>
    
    <script type="text/javascript" src="https://old.santara.co.id/assets/js/scripts/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://old.santara.co.id/app-assets/vendors/js/vendors.min.js"></script>
    <script type="text/javascript" src="https://old.santara.co.id/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script type="text/javascript" src="https://old.santara.co.id/app-assets/js/core/app-menu.min.js"></script>
    <script type="text/javascript" src="https://old.santara.co.id/app-assets/js/core/app.min.js"></script>

    <script type="text/javascript" src="https://old.santara.co.id/app-assets/js/scripts/pickers/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="https://old.santara.co.id/app-assets/js/core/datatable/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://old.santara.co.id/app-assets/js/core/datatable/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://old.santara.co.id/app-assets/js/core/datatable/buttons.print.min.js"></script>

    <script src="https://old.santara.co.id/app-assets/new-santara/vendors/jquery-validation/dist/jquery.validate.js"></script>
    <script src="https://old.santara.co.id/app-assets/new-santara/vendors/jquery-validation/dist/additional-methods.js"></script>
    <script src="https://old.santara.co.id/app-assets/new-santara/vendors/jquery-validation/dist/localization/messages_id.js"></script>

    <script type="text/javascript" src="https://old.santara.co.id/app-assets/js/core/alert/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://old.santara.co.id/app-assets/vendors/js/forms/inputs/bootstrap.file-input.js"></script>
    <script type="text/javascript" src="https://old.santara.co.id/app-assets/js/core/libraries/select2/select2.min.js" defer></script>
    <script type="text/javascript" src="https://old.santara.co.id/app-assets/js/core/libraries/flatpickr/flatpickr.min.js"></script>
    <script>
        $(document).ready(function() {
            $("input[type='file']").fileinput({
                'showUpload': false,
                'previewFileType': 'image'
            });
        });
    </script>
    {{-- <script src="https://old.santara.co.id/assets/js/global.js?v=<?= WEB_VERSION; ?>"></script>
    <?php if (ENVIRONMENT == 'production') : ?>
        <script src="https://old.santara.co.id/assets/js/prod.js?v=<?= WEB_VERSION; ?>"></script>
    <?php endif; ?> --}}
    @yield('js')
</body>

</html>