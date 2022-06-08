<div class="footer_section">
         <div class="container">
      <!-- Footer -->
          <footer class="page-footer font-small pt-4" style="background-color: #7f1d1d">

            <!-- Footer Elements -->
            <div class="container">

              <!--Grid row-->
              <div class="row">

                <!--Grid column-->
                <div class="col-md-8 mb-4">

                  <p class="tx-f inter-normal-mercury-14px">
                      <span class="text-f inter-normal-mercury-14px"
                        >Santara Website Ver 5.8.0 - Business Ver 3.6.1 | Copyright © 2022 Santara, All rights reserved.</span
                      >
                    </p>

                    <div class="santara-app2">
                    <div class="logo-ojk">
                      <div class="santara-app-1 inter-medium-mercury-14px">
                        <span class="inter-medium-mercury-14px">Berizin dan Diawasi oleh:</span>
                      </div>
                        <img class="ojk" src="{{ asset('assets/images/ojk.png') }}" />
                    </div>
                    <div class="logo-aludi">
                      <div class="santara-app-1 inter-medium-mercury-14px">
                        <span class="inter-medium-mercury-14px">Anggota Resmi:</span>
                      </div>
                        <img class="aludi" src="{{ asset('assets/images/aludi.png') }}" />
                    </div>
                  </div>

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-4 mb-4">

                  <div class="santara-app">
                      <div class="santara-app-1 inter-medium-mercury-14px">
                        <span class="inter-medium-mercury-14px">Santara App</span>
                      </div>
                      <div class="action-app">
                          <a href="https://play.google.com/store/apps/details?id=id.co.santara.app">
                            <div class="mobile-app-store-badge border-1px-quick-silver">
                              <img class="google-play-logo" src="{{ asset('assets/images/google-play-logo-24@2x.png') }}" />
                              <div class="flex-col">
                                <img class="get-it-on" src="{{ asset('assets/images/get-it-on-24@2x.png') }}" />
                                <img class="google-play" src="{{ asset('assets/images/google-play-24@2x.png') }}" />
                              </div>
                            </div>
                          </a>
                          <a href="https://apps.apple.com/id/app/santara-app/id1473570177">
                            <img class="mobile-app-store-badge-1" src="{{ asset('assets/images/mobile-app-store-badge-24@2x.png') }}" />
                          </a>
                    </div>
                    </div>

                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->

            </div>
            <!-- Footer Elements -->

          </footer>
          <!-- Footer -->
        </div>
      </div>
<!-- Footer -->
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
      <script src="{{ asset('assets/js/popper.min.js') }}"></script>
      <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('assets/js/jquery-3.0.0.min.js') }}"></script>
      <script src="{{ asset('assets/js/plugin.js') }}"></script>
      <!-- sidebar -->
      <script src="{{ asset('assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
      <script src="{{ asset('assets/js/custom.js') }}"></script>
      <script src="{{ asset('assets/js/jquery.prettydropdowns.js') }}"></script>
      <script src="js/jquery.min.js"></script>
      <script src="{{ asset('assets/OwlCarousel2/dist/assets/owl.carousel.js') }}"></script>
      <script>

        $(document).ready(function () {

             $("#owl-demo").owlCarousel({
                 loop  : true,
                 margin : 10,
                 nav    : true,
                 smartSpeed :900,
                 navText : [$('.customPreviousBtn'),$('.customNextBtn')],
                 responsiveClass:true,
                  responsive:{
                      0:{
                          items:2,
                          nav:true,
                          loop:false
                      },
                      600:{
                          items:2,
                          nav:true,
                          loop:false
                      },
                      1000:{
                          items:4,
                          nav:true,
                          loop:false
                      }
                  }
              });
             $("#owl-demo2").owlCarousel({
                loop  : true,
                 margin : 10,
                 nav    : true,
                 smartSpeed :900,
                 navText : [$('.customPreviousBtn2'),$('.customNextBtn2')],
                  responsiveClass:true,
                  responsive:{
                      0:{
                          items:2,
                          nav:true,
                          loop:false
                      },
                      600:{
                          items:2,
                          nav:true,
                          loop:false
                      },
                      1000:{
                          items:4,
                          nav:true,
                          loop:false
                      }
                  }
              });
               $("#owl-demo3").owlCarousel({
                loop  : true,
                 margin : 10,
                 nav    : true,
                 smartSpeed :900,
                 navText : [$('.customPreviousBtn3'),$('.customNextBtn3')],
                 responsiveClass:true,
                  responsive:{
                      0:{
                          items:2,
                          nav:true,
                          loop:false
                      },
                      600:{
                          items:2,
                          nav:true,
                          loop:false
                      },
                      1000:{
                          items:4,
                          nav:true,
                          loop:false
                      }
                  }
             });
               $("#owl-demo4").owlCarousel({
                loop:true,
                  margin:20,
                  responsiveClass:true,
                  responsive:{
                      0:{
                          items:1,
                          nav:true,
                          loop:false
                      },
                      600:{
                          items:3,
                          nav:true,
                          loop:false
                      },
                      1000:{
                          items:3,
                          nav:true,
                          loop:false
                      }
                  }
              });
               $("#owl-demo5").owlCarousel({
                loop:true,
                  margin:20,
                  responsiveClass:true,
                  responsive:{
                      0:{
                          items:1,
                          nav:true,
                          loop:false
                      },
                      600:{
                          items:3,
                          nav:true,
                          loop:false
                      },
                      1000:{
                          items:3,
                          nav:true,
                          loop:false
                      }
                  }
              });
               $("#owl-demo6").owlCarousel({
                loop:true,
                  margin:20,
                  responsiveClass:true,
                  responsive:{
                      0:{
                          items:1,
                          nav:true,
                          loop:false
                      },
                      600:{
                          items:3,
                          nav:true,
                          loop:false
                      },
                      1000:{
                          items:3,
                          nav:true,
                          loop:false
                      }
                  }
              });
        })
      </script>
      <script>
         function openNav() {
           document.getElementById("mySidenav").style.width = "300px";
         }

         function closeNav() {
           document.getElementById("mySidenav").style.width = "0";
         }
      </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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
          case 'warn':
          toastr.warning("{{Session::get('message')}}");
          // Swal.fire("Berhasil","{{Session::get('message')}}","success");
          // Swal.fire("Good job!", "You clicked the button!", "success");
          break;
      }
      </script>
      @endif
      @if(Session::has('status'))
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
          toastr.success("{{Session::get('status')}}");
          // Swal.fire("Berhasil","{{Session::get('status')}}","success");
          // Swal.fire("Good job!", "You clicked the button!", "success");
          break;
          case 'fail':
          toastr.error("{{Session::get('status')}}");
          // Swal.fire("Berhasil","{{Session::get('status')}}","success");
          // Swal.fire("Good job!", "You clicked the button!", "success");
          break;
          case 'warn':
          toastr.warning("{{Session::get('status')}}");
          // Swal.fire("Berhasil","{{Session::get('message')}}","success");
          // Swal.fire("Good job!", "You clicked the button!", "success");
          break;
      }
      </script>
      @endif
      @yield('js')
   </body>
</html>
