<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Santara</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="shortcut icon" type="image/x-icon" href="https://storage.googleapis.com/asset-santara/santara.co.id/images/ico/favicon.ico">
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"><link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

      <!-- fevicon -->
      <link rel="icon" href="{{ asset('public/assets/images/fevicon.png') }}" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="{{ asset('public/assets/css/jquery.mCustomScrollbar.min.css') }}">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- fonts -->
      <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
      <!-- font awesome -->
      <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <!--  -->
      <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/styleguide.css') }}" />
      <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/globals.css') }}" />
      <!-- owl stylesheets -->
      <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('public/assets/OwlCarousel2/dist/assets/owl.carousel.min.css') }}">
      <link rel="stylesoeet" href="{{ asset('public/assets/OwlCarousel2/dist/assets/owl.theme.default.min.css') }}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/fontawesome/css/all.css') }}">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style.css') }}">
      <!-- Responsive-->
      <link rel="stylesheet" href="{{ asset('public/assets/css/responsive.css') }}">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
      @yield('header')
   </head>
   <body>
    <nav class="navbar navbar-expand-lg" style="min-height: 96px;">
      <a class="navbar-brand" href="{{ url('/') }}">
        <div class="containt_main">
             <div id="mySidenav" class="sidenav">
                     <div class="men">
                      <a href="{{ url('/') }}" style="margin-left: -30px;">
                       <div class="menu-header">
                         <img class="logo-header" src="{{ asset('public/assets/images/logo-newsantara-ai-putih-merah-l-1-27@2x.png') }}" />
                         <div class="santara-header ubuntu-medium-white-28px"><span class="ubuntu-medium-white-28px">santara</span></div>
                       </div>
                      </a>
                     <div class="menu-view-body ff-n">
                        <ul class="ml-auto ">
                           <li class="nav-item">
                             <a class=" navbar-nav d-inline-block" style="margin-top: -50px;" id="menu-dropdown" data-bs-toggle="collapse" href="#penerbit" role="button" aria-expanded="false" aria-controls="penerbit">
                               List Penerbit &ensp;<i class="fas fa-chevron-down" style="margin-top: 5px;" id="arrow-dropdown"></i>
                             </a>
                           </li>
                           <div class="collapse" id="penerbit" style="padding-left: 20px;">
                             <li class="nav-item">
                               <a class=" navbar-nav" href="{{ route('now-playing.index') }}">Now Playing</a>
                             </li>
                             <li class="nav-item">
                               <a class=" navbar-nav" href="{{ route('coming-soon.index') }}">Coming Soon</a>
                             </li>
                             <li class="nav-item">
                               <a class=" navbar-nav" href="{{ route('sold-out.index') }}">Sold Out</a>
                             </li>
                           </div>

                           <li class="nav-item">
                             <a class=" navbar-nav" href="#>tentang-santara">Tentang Santara</a>
                           </li>

                           <li class="nav-item">
                             <a class=" navbar-nav" href="#">Testimoni</a>
                           </li>

                           <li class="nav-item">
                             <a class=" navbar-nav" href="#">Panduan</a>
                           </li>

                           <li class="nav-item">
                             <a class=" navbar-nav d-inline-block" id="menu-dropdown2" data-bs-toggle="collapse" href="#syarat" role="button" aria-expanded="false" aria-controls="syarat">
                               Syarat & Ketentuan &ensp;<i class="fas fa-chevron-down" style="margin-top: 5px;" id="arrow-dropdown2"></i>
                             </a>
                           </li>
                           <div class="collapse" id="syarat" style="padding-left: 20px;">
                             <li class="nav-item">
                               <a class=" navbar-nav" href="#">Pemodal</a>
                             </li>
                             <li class="nav-item">
                               <a class=" navbar-nav" href="#">Penerbit</a>
                             </li>
                           </div>


                           <li class="nav-item">
                             <a class=" navbar-nav" href="#">Pertanyaan</a>
                           </li>


                           <li class="nav-item">
                             <a class=" navbar-nav" href="#">SUPPORTED BY</a>
                           </li>
                           <li class="nav-item">
                             <a class=" navbar-nav d-inline-block" id="menu-dropdown3" data-bs-toggle="collapse" href="#tentangKami" role="button" aria-expanded="false" aria-controls="tentangKami">
                               Tentang Kami &ensp;<i class="fas fa-chevron-down" style="margin-top: 5px;" id="arrow-dropdown3"></i>
                             </a>
                           </li>
                           <div class="collapse" id="tentangKami" style="padding-left: 20px;">
                             <li class="nav-item">
                               <a class=" navbar-nav" href="#">Kontak Kami</a>
                             </li>
                             <li class="nav-item">
                               <a class=" navbar-nav" target="_blank" href="#">Berita</a>
                             </li>
                             <li class="nav-item">
                               <a class=" navbar-nav" target="_blank" href="#">Karir</a>
                             </li>
                          </div>
                          <li class="nav-item li-auth">
                            <div class="d-inline-block inter-medium-white-14px navbar-nav" style="font-size: 12px;">
                              <a class="button-cta-1 btn btn-dark btn-au inter-medium-white-14px" href="{{ route('login') }}">Masuk</a>
                              <a class="button-cta-2 btn btn-danger btn-au inter-medium-white-14px" href="{{ route('register') }}">Daftar</a>
                            </div>
                          </li>
                       </ul>
               </div>
             </div>
               <div href="javascript:void(0)" class="close" onclick="closeNav()"><img class="x" src="{{ asset('public/assets/images/x@2x.png') }}" /></div>
               </div>
             <div class="main">
                  <span class="toggle_icon" onclick="openNav()"><img src="{{ asset('public/assets/images/toggle-icon.png') }}"></span>
             </div>
           </div>
        <div class="menu">
      <a class="navbar-brand" href="{{ url('/') }}">
                   <img class="logo" src="{{ asset('public/assets/images/logo-newsantara-ai-putih-merah-l-1-27@2x.png') }}" />
                   <div class="santara ubuntu-medium-white-28px"><span class="ubuntu-medium-white-28px">santara</span></div>
             </div>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <div class="inter-medium-white-14px">
            <a class="button-cta-1 btn btn-dark btn-au inter-medium-white-14px" href="{{ route('login') }}">Masuk</a>
            <a class="button-cta-2 btn btn-danger btn-au inter-medium-white-14px" href="{{ route('register') }}">Daftar</a>
          </div>
        </form>
      </div>
    </nav>