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
        <div class="row r-top">
            <div class="col-lg-4 col-sm-4">
              <div class="filter">
              <div class="input">
                <div class="label inter-medium-quill-gray-14px">
                  <span class="inter-medium-quill-gray-14px">Cari Bisnis</span>
                </div>
                <div class="input-1 border-1px-cape-cod">
                  <img class="search" src="{{ asset('public/assets/images/search-9@2x.png') }}" />
                  <div class="text inter-normal-delta-16px"><span class="inter-normal-delta-16px">Nama Bisnis</span></div> </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-4">
                <div class="dropdown-4 kat">
                  <div class="label-1 inter-medium-quill-gray-14px">
                    <span class="inter-medium-quill-gray-14px">Kategori</span>
                  </div>
                  <select id="sort" name="sort" class="pretty dd border-1px-cape-cod">
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
                  <script>
                  $(document).ready(function() {
                    // Initiate Pretty Dropdowns
                    $('.pretty').prettyDropdown();
                  });
                  </script>
                </div>
              </div>
              <div class="col-lg-4 col-sm-4">
                <div class="dropdown-6 ur">
                  <div class="label-1 inter-medium-quill-gray-14px">
                    <span class="inter-medium-quill-gray-14px">Urutkan</span>
                  </div>
                  <select id="sort" name="sort" class="pretty border-1px-cape-cod">
                    <option value="position">Terlama</option>
                    <option value="price" >Terpenuhi</option>
                    <option value="position">Belum Terpenuhi</option>
                  </select>
                  <script>
                  $(document).ready(function() {
                    // Initiate Pretty Dropdowns
                    $('.pretty').prettyDropdown();
                  });
                  </script>
                </div>
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
                        <div class="row">
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="card">
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
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="card">
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
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="card">
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
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="card">
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
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="card">
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
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="card">
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
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="card">
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
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="card">
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
@endsection