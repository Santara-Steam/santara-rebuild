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
    <link rel="apple-touch-icon" href="https://storage.googleapis.com/asset-santara/santara.co.id/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="https://storage.googleapis.com/asset-santara/santara.co.id/images/ico/favicon.ico">
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
    <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/assets/css/admin/style.css?v=5.8.8">
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
                            <img class="logo-brand" style="width:65%" alt="modern admin logo" src="https://storage.googleapis.com/asset-santara/santara.co.id/images/logo/santara-tidur-dark.png'">
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
                    {{-- <?php $this->load->view('member/navbar_menu'); ?> --}}
                </div>
            </div>
        </div>
    </nav>

    @yield('content')
    @yield('js')
    <!-- LEFT MENU -->
    {{-- <?php $this->load->view('member/left_menu'); ?>

    <div class="app-content content">
        <div class="content-wrapper">
            <?php $this->load->view('member/notification_kyc'); ?>
            <?php $this->load->view('member/notification_new_kyc'); ?>
            <?php $this->load->view('guest/_main_page/notification_alert');  ?>
            <div class="content-body">
                <div id="login_session" style="display:none"><?= (isset($this->session->user)) ? 1 : 0; ?></div>
                <div id="loader" class="loader" style="display:none"></div>
                <?php $this->load->view($page); ?>
            </div>
        </div>
    </div> --}}

    <div style="margin-top: 100px">&nbsp;</div>
    <footer class="footer footer-on-sidemenu footer-static footer-light navbar-border navbar-shadow">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2 pb-2">
            <span class="float-md-left d-block d-md-inline-block">Santara Website Ver 5.8.8 - Business Ver 3.6.2 | Copyright &copy; 2020
                <img src="https://storage.googleapis.com/asset-santara/santara.co.id/images/ico/favicon-16x16.png"> Santara, All rights reserved. </span>
            <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">
                Hand-crafted & Made with
                <i class="ft-heart pink"></i>
            </span>
        </p>
    </footer>
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
    <script src="https://old.santara.co.id/assets/js/global.js?v=5.8.8"></script>
    <?php if (ENVIRONMENT == 'production') : ?>
        <script src="https://old.santara.co.id/assets/js/prod.js?v=5.8.8"></script>
    <?php endif; ?>
</body>

</html>