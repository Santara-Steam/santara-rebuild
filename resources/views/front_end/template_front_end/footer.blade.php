<!-- footer section start -->
      <div class="footer_section layout_padding">
         <p class="tx-f inter-normal-mercury-14px">
            <span class="text-f inter-normal-mercury-14px"
              >Santara Website Ver 5.8.0 - Business Ver 3.6.1 | Copyright © 2020 Santara, All rights reserved.</span
            >
          </p>
      </div>
      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
          <div class="santara-app2">
            <div class="logo-ojk">
              <div class="santara-app-1 inter-medium-mercury-14px">
                <span class="inter-medium-mercury-14px">Berizin dan Diawasi oleh:</span>
              </div>
                <img class="ojk" src="{{ asset('public/assets/images/ojk.png') }}" />
            </div>
            <div class="logo-aludi">
              <div class="santara-app-1 inter-medium-mercury-14px">
                <span class="inter-medium-mercury-14px">Anggota Resmi:</span>
              </div>
                <img class="aludi" src="{{ asset('public/assets/images/aludi.png') }}" />
            </div>
          </div>
         <div class="santara-app">
              <div class="santara-app-1 inter-medium-mercury-14px">
                <span class="inter-medium-mercury-14px">Santara App</span>
              </div>
                <div class="action-app">
                  <a href="https://play.google.com/store/apps/details?id=id.co.santara.app">
                    <div class="mobile-app-store-badge border-1px-quick-silver">
                      <img class="google-play-logo" src="{{ asset('public/assets/images/google-play-logo-24@2x.png') }}" />
                      <div class="flex-col">
                        <img class="get-it-on" src="{{ asset('public/assets/images/get-it-on-24@2x.png') }}" />
                        <img class="google-play" src="{{ asset('public/assets/images/google-play-24@2x.png') }}" />
                      </div>
                    </div>
                  </a>
                  <a href="https://apps.apple.com/id/app/santara-app/id1473570177">
                    <img class="mobile-app-store-badge-1" src="{{ asset('public/assets/images/mobile-app-store-badge-24@2x.png') }}" />
                  </a>
            </div>
            </div>
          </div>
      </div>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="{{ asset('public/assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
      <script src="{{ asset('public/assets/js/popper.min.js') }}"></script>
      <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('public/assets/js/jquery-3.0.0.min.js') }}"></script>
      <script src="{{ asset('public/assets/js/plugin.js') }}"></script>
      <!-- sidebar -->
      <script src="{{ asset('public/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
      <script src="{{ asset('public/assets/js/custom.js') }}"></script>
      <script src="{{ asset('public/assets/js/jquery.prettydropdowns.js') }}"></script>
      <script src="js/jquery.min.js"></script>
      <script src="{{ asset('public/assets/OwlCarousel2/dist/assets/owl.carousel.js') }}"></script>
      <script>

        $(document).ready(function() {
          var owl = $('.owl-carousel');
          owl.owlCarousel({
            margin: 10,
            nav: true,
            loop: true,
            responsive: {
              0: {
                items: 2
              },
              600: {
                items: 2
              },
              1000: {
                items: 4
              }
            }
          })

          // Custom Button
        $('.customNextBtn').click(function() {
          owl.trigger('next.owl.carousel');
        });
        $('.customPreviousBtn').click(function() {
          owl.trigger('prev.owl.carousel');
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
   </body>
</html>