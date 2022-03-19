@extends('front_end/template_front_end/app')

@section('content')
<div class="header-section">
          <div class="heading-and-subheading">
            <div class="now-playing-bisnis inter-bold-alizarin-crimson-16px">
              <span class="inter-bold-alizarin-crimson-16px">Coming Soon Bisnis</span>
            </div>
            <div class="text-urun pilih-bisnis-favoritmu inter-bold-alabaster-48px">
              <span class="text-sb inter-bold-alabaster">Pilih Bisnis Favoritmu</span>
            </div>
          </div>
          <div class="text-mulai inter-normal-alabaster-20px">
            <span class="text-mulai inter-normal-alabaster">Ayo dukung bisnis favoritmu agar naik menjadi Penerbit!</span>
          </div>
        </div>
        <div class="form-row" style="padding-right: 25px; padding-left: 25px;">
        <div class="form-group col-md-4">
          <div class="label inter-medium-quill-gray-14px">
            <span class="inter-medium-quill-gray-14px">Cari Bisnis</span>
          </div>
          <input type="text" class="form-control empty input-1 border-1px-cape-cod inter-normal-delta-16px" style="background: #1b1a1a; color: var(--quill-gray);" id="iconified" placeholder="&#xF002;"/>
        </div>
        <div class="form-group col-md-3 kati">
        </div>
        <div class="form-group col-md-3">
          <div class="label-1 inter-medium-quill-gray-14px">
                    <span class="inter-medium-quill-gray-14px">Kategori</span>
                  </div>
          <select id="inputState" class="form-control dropdown-1">
            <option value="position">Semua Kategori</option>
                    <option value="price" >Property</option>
                    <option value="position">Food and Beverage</option>
                    <option value="price" >Peternakan</option>
                    <option value="position">Perkebunan/Argo</option>
                    <option value="price" >Teknologi</option>
                    <option value="position">Start Up</option>
                    <option value="price" >Project Financing</option>
                    <option value="price" >Service/Layanan</option>
                    <option value="position">Manufaktur/Produksi</option>
                    <option value="price" >Retail/Distribusi/Logistik</option>
          </select>
        </div>
        <div class="form-group col-md-2">
          <div class="label-1 inter-medium-quill-gray-14px">
                    <span class="inter-medium-quill-gray-14px">Urutkan</span>
                  </div>
          <select id="inputState" class="form-control dropdown-1">
            <option value="position">Terlama</option>
                    <option value="price" >Terpenuhi</option>
                    <option value="position">Belum Terpenuhi</option>
          </select>
        </div>
      </div>
      </div>
      <!-- fashion section start -->
      <div class="fashion_section">
         <div id="main_slider" class="carousel" data-ride="carousel">
            <div class="carousel-inner">
                    <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="w3-container w3-red">
                     <div class="fashion_section_2">
                        <div class="row" style="padding-left: 10px; padding-right: 10px;">
                           <div class="col-lg-3 col-sm-3 col-3" style="padding: 5px;">
                              <div class="card" style="margin-top: 10px;">
                                <img class="rectangle-2" src="{{ asset('public/assets/images/rectangle-2@1x.png') }}" />
                                <div class="content">
                                  <div class="header-card-dan-progress">
                                    <div class="header-and-tags">
                                      <div class="tags">
                                        <div class="retail-distribusi-logistik inter-medium-sweet-pink-12px">
                                          <span class="tx-t inter-medium-sweet-pink">Retail/Distribusi/Logistik</span>
                                        </div>
                                      </div>
                                      <div class="header">
                                        <div class="saka-logistics inter-medium-alabaster-20px">
                                          <span class="tx-pt inter-medium-alabaster">Saka Logistics</span>
                                        </div>
                                        <div class="pt-saka-multitrans-nusantara inter-normal-quill-gray-12px">
                                          <span class="tx-np inter-normal-quill-gray">PT. Saka Multitrans Nusantara</span>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="icon-card">
                                      <div class="icon-and-supporting-text">
                                        <img class="icon-com iconheart" src="{{ asset('public/assets/images/icon-heart-18@2x.png') }}" />&ensp;
                                        <div class="lk inter-normal-alabaster-10px">
                                          <span class="tx-icon inter-normal-alabaster"><p class="ic-sz tx-icon lkk" style="margin-top: -25px;">82 </p><p class="ic-sz com-u tx-tp">&ensp;Likes</p></span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-1">
                                        <img class="icon-com iconuser" src="{{ asset('public/assets/images/icon-user-17@2x.png') }}" />
                                        <div class="lk inter-normal-alabaster-10px">
                                          <span class="tx-icon inter-normal-alabaster"><p class="ic-sz tx-icon lkk" style="margin-top: -0px;">100 </p><p class="ic-sz com-u mnt">&ensp;Minat</p></span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-1">
                                        <img class="icon-com iconmessage-circle" src="{{ asset('public/assets/images/icon-message-circle-46@2x.png') }}" />
                                        <div class=" inter-normal-alabaster-10px">
                                          <span class="tx-icon inter-normal-alabaster"><p class="ic-sz tx-icon" style="margin-top: -0px;">46 </p><p class="ic-sz com-u mnt">&ensp;Komentar</p></span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-1">
                                        <img class="icon-com iconshare-2" src="{{ asset('public/assets/images/icon-share-2-46@2x.png') }}" />
                                        <div class="share inter-normal-alabaster-10px">
                                          <span class="tx-icon inter-normal-alabaster">Share</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="footer-card-3">
                                    <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                                        <span class="button btn btn-outline-light btn-au inter-medium-white-14px">Dukung Bisnis Ini</span>
                                  </div>
                                </div>
                              </div>
                           </div>
                        </div>
                        <div>
                           <div class="button-1 cut">
                            <div class="inter-medium-white-14px">
                              <span class="inter-medium-white-14px">See More</span>
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
      <script>
        $('#iconified').on('keyup', function() {
          var input = $(this);
          if(input.val().length === 0) {
              input.addClass('empty');
          } else {
              input.removeClass('empty');
          }
      });
      </script>
@endsection