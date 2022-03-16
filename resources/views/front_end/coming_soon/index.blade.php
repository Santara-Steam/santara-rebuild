@extends('front_end/template_front_end/app')

@section('content')
<div class="header-section">
          <div class="heading-and-subheading">
            <div class="now-playing-bisnis inter-bold-alizarin-crimson-16px">
              <span class="inter-bold-alizarin-crimson-16px">Coming Soon Bisnis</span>
            </div>
            <div class="text-urun pilih-bisnis-favoritmu inter-bold-alabaster-48px">
              <span class="inter-bold-alabaster">Pilih Bisnis Favoritmu</span>
            </div>
          </div>
          <div class="text-mulai inter-normal-alabaster-20px">
            <span class="inter-normal-alabaster">Ayo dukung bisnis favoritmu agar naik menjadi Penerbit!</span>
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
                            <a href="detail-now-playing.html">
                              <div class="top-i card">
                                <img class="rectangle-2" src="{{ asset('public/assets/images/rectangle-2@1x.png') }}" />
                                <div class="content">
                                  <div class="header-card-dan-progress">
                                    <div class="header-and-tags">
                                      <div class="tags">
                                        <div class="retail-distribusi-logistik inter-medium-sweet-pink-12px">
                                          <span class="inter-medium-sweet-pink-12px">Retail/Distribusi/Logistik</span>
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
                                    <div class="info-dan-progress">
                                      <div class="info-pendanaan">
                                        <div class="mulai-rp1000000 inter-normal-mercury-14px">
                                          <span class="tx-sold span-1 inter-normal-mercury">Mulai</span
                                          ><span class="inter-normal-mercury-12px">&nbsp;</span
                                          >
                                          <div class="mulai-rp inter-bold-white-14px"
                                          ><span class="tx-sold span-1 inter-bold-white" style="font-weight: bold">Rp1.000.000</span>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="address">
                                        <div  class="hr inter-bold-white-14px">
                                          <span class="tx-sold inter-medium-white"><b style="font-weight: bold">40</b></span>
                                        </div>
                                        <span class="inter-normal-mercury-12px">&nbsp;</span>
                                        <div class="tiku hr-lg inter-normal-mercury-14px">
                                          <span class="tx-sold inter-normal-mercury">hari lagi</span>
                                        </div>
                                      </div>
                                      <div class="overlap-group">
                                        <div class="percent inter-medium-white-12px">
                                          <span class="tx-np percen inter-medium-white">0%</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="footer-card">
                                    <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                                    <div class="footer-card-1">
                                      <div class="total-pendanaan-rp3000000000 inter-normal-mercury-12px">
                                        <span class="inter-normal-quill-gray-12px">Total Pendanaan<br /></span
                                        ><span class="inter-medium-alabaster-12px">Rp3.000.000.000</span>
                                      </div>
                                      <div class="periode-dividen-6-bulan inter-normal-mercury-10px">
                                        <span class="inter-normal-quill-gray-12px">Periode Dividen<br /></span
                                        ><span class="inter-medium-alabaster-12px">6 Bulan</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </a>
                           </div>
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="top-i card">
                                <img class="rectangle-2" src="{{ asset('public/assets/images/rectangle-2@1x.png') }}" />
                                <div class="content">
                                  <div class="header-card-dan-progress">
                                    <div class="header-and-tags">
                                      <div class="tags">
                                        <div class="retail-distribusi-logistik inter-medium-sweet-pink-12px">
                                          <span class="inter-medium-sweet-pink-12px">Retail/Distribusi/Logistik</span>
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
                                    <div class="info-dan-progress">
                                      <div class="info-pendanaan">
                                        <div class="mulai-rp1000000 inter-normal-mercury-14px">
                                          <span class="tx-sold span-1 inter-normal-mercury">Mulai</span
                                          ><span class="inter-normal-mercury-12px">&nbsp;</span
                                          >
                                          <div class="mulai-rp inter-bold-white-14px"
                                          ><span class="tx-sold span-1 inter-bold-white" style="font-weight: bold">Rp1.000.000</span>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="address">
                                        <div  class="hr inter-bold-white-14px">
                                          <span class="tx-sold inter-medium-white"><b style="font-weight: bold">40</b></span>
                                        </div>
                                        <span class="inter-normal-mercury-12px">&nbsp;</span>
                                        <div class="tiku hr-lg inter-normal-mercury-14px">
                                          <span class="tx-sold inter-normal-mercury">hari lagi</span>
                                        </div>
                                      </div>
                                      <div class="overlap-group">
                                        <div class="percent inter-medium-white-12px">
                                          <span class="tx-np percen inter-medium-white">0%</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="footer-card">
                                    <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                                    <div class="footer-card-1">
                                      <div class="total-pendanaan-rp3000000000 inter-normal-mercury-12px">
                                        <span class="inter-normal-quill-gray-12px">Total Pendanaan<br /></span
                                        ><span class="inter-medium-alabaster-12px">Rp3.000.000.000</span>
                                      </div>
                                      <div class="periode-dividen-6-bulan inter-normal-mercury-10px">
                                        <span class="inter-normal-quill-gray-12px">Periode Dividen<br /></span
                                        ><span class="inter-medium-alabaster-12px">6 Bulan</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                           </div>
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="top-i card">
                                <img class="rectangle-2" src="{{ asset('public/assets/images/rectangle-2@1x.png') }}" />
                                <div class="content">
                                  <div class="header-card-dan-progress">
                                    <div class="header-and-tags">
                                      <div class="tags">
                                        <div class="retail-distribusi-logistik inter-medium-sweet-pink-12px">
                                          <span class="inter-medium-sweet-pink-12px">Retail/Distribusi/Logistik</span>
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
                                    <div class="info-dan-progress">
                                      <div class="info-pendanaan">
                                        <div class="mulai-rp1000000 inter-normal-mercury-14px">
                                          <span class="tx-sold span-1 inter-normal-mercury">Mulai</span
                                          ><span class="inter-normal-mercury-12px">&nbsp;</span
                                          >
                                          <div class="mulai-rp inter-bold-white-14px"
                                          ><span class="tx-sold span-1 inter-bold-white" style="font-weight: bold">Rp1.000.000</span>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="address">
                                        <div  class="hr inter-bold-white-14px">
                                          <span class="tx-sold inter-medium-white"><b style="font-weight: bold">40</b></span>
                                        </div>
                                        <span class="inter-normal-mercury-12px">&nbsp;</span>
                                        <div class="tiku hr-lg inter-normal-mercury-14px">
                                          <span class="tx-sold inter-normal-mercury">hari lagi</span>
                                        </div>
                                      </div>
                                      <div class="overlap-group">
                                        <div class="percent inter-medium-white-12px">
                                          <span class="tx-np percen inter-medium-white">0%</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="footer-card">
                                    <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                                    <div class="footer-card-1">
                                      <div class="total-pendanaan-rp3000000000 inter-normal-mercury-12px">
                                        <span class="inter-normal-quill-gray-12px">Total Pendanaan<br /></span
                                        ><span class="inter-medium-alabaster-12px">Rp3.000.000.000</span>
                                      </div>
                                      <div class="periode-dividen-6-bulan inter-normal-mercury-10px">
                                        <span class="inter-normal-quill-gray-12px">Periode Dividen<br /></span
                                        ><span class="inter-medium-alabaster-12px">6 Bulan</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                           </div>
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="top-i card">
                                <img class="rectangle-2" src="{{ asset('public/assets/images/rectangle-2@1x.png') }}" />
                                <div class="content">
                                  <div class="header-card-dan-progress">
                                    <div class="header-and-tags">
                                      <div class="tags">
                                        <div class="retail-distribusi-logistik inter-medium-sweet-pink-12px">
                                          <span class="inter-medium-sweet-pink-12px">Retail/Distribusi/Logistik</span>
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
                                    <div class="info-dan-progress">
                                      <div class="info-pendanaan">
                                        <div class="mulai-rp1000000 inter-normal-mercury-14px">
                                          <span class="tx-sold span-1 inter-normal-mercury">Mulai</span
                                          ><span class="inter-normal-mercury-12px">&nbsp;</span
                                          >
                                          <div class="mulai-rp inter-bold-white-14px"
                                          ><span class="tx-sold span-1 inter-bold-white" style="font-weight: bold">Rp1.000.000</span>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="address">
                                        <div  class="hr inter-bold-white-14px">
                                          <span class="tx-sold inter-medium-white"><b style="font-weight: bold">40</b></span>
                                        </div>
                                        <span class="inter-normal-mercury-12px">&nbsp;</span>
                                        <div class="tiku hr-lg inter-normal-mercury-14px">
                                          <span class="tx-sold inter-normal-mercury">hari lagi</span>
                                        </div>
                                      </div>
                                      <div class="overlap-group">
                                        <div class="percent inter-medium-white-12px">
                                          <span class="tx-np percen inter-medium-white">0%</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="footer-card">
                                    <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                                    <div class="footer-card-1">
                                      <div class="total-pendanaan-rp3000000000 inter-normal-mercury-12px">
                                        <span class="inter-normal-quill-gray-12px">Total Pendanaan<br /></span
                                        ><span class="inter-medium-alabaster-12px">Rp3.000.000.000</span>
                                      </div>
                                      <div class="periode-dividen-6-bulan inter-normal-mercury-10px">
                                        <span class="inter-normal-quill-gray-12px">Periode Dividen<br /></span
                                        ><span class="inter-medium-alabaster-12px">6 Bulan</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                           </div>
                           <div class="col-lg-3 col-sm-6 col-6">
                            <a href="detail-now-playing.html">
                              <div class="top-i card">
                                <img class="rectangle-2" src="{{ asset('public/assets/images/rectangle-2@1x.png') }}" />
                                <div class="content">
                                  <div class="header-card-dan-progress">
                                    <div class="header-and-tags">
                                      <div class="tags">
                                        <div class="retail-distribusi-logistik inter-medium-sweet-pink-12px">
                                          <span class="inter-medium-sweet-pink-12px">Retail/Distribusi/Logistik</span>
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
                                    <div class="info-dan-progress">
                                      <div class="info-pendanaan">
                                        <div class="mulai-rp1000000 inter-normal-mercury-14px">
                                          <span class="tx-sold span-1 inter-normal-mercury">Mulai</span
                                          ><span class="inter-normal-mercury-12px">&nbsp;</span
                                          >
                                          <div class="mulai-rp inter-bold-white-14px"
                                          ><span class="tx-sold span-1 inter-bold-white" style="font-weight: bold">Rp1.000.000</span>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="address">
                                        <div  class="hr inter-bold-white-14px">
                                          <span class="tx-sold inter-medium-white"><b style="font-weight: bold">40</b></span>
                                        </div>
                                        <span class="inter-normal-mercury-12px">&nbsp;</span>
                                        <div class="tiku hr-lg inter-normal-mercury-14px">
                                          <span class="tx-sold inter-normal-mercury">hari lagi</span>
                                        </div>
                                      </div>
                                      <div class="overlap-group">
                                        <div class="percent inter-medium-white-12px">
                                          <span class="tx-np percen inter-medium-white">0%</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="footer-card">
                                    <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                                    <div class="footer-card-1">
                                      <div class="total-pendanaan-rp3000000000 inter-normal-mercury-12px">
                                        <span class="inter-normal-quill-gray-12px">Total Pendanaan<br /></span
                                        ><span class="inter-medium-alabaster-12px">Rp3.000.000.000</span>
                                      </div>
                                      <div class="periode-dividen-6-bulan inter-normal-mercury-10px">
                                        <span class="inter-normal-quill-gray-12px">Periode Dividen<br /></span
                                        ><span class="inter-medium-alabaster-12px">6 Bulan</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </a>
                           </div>
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="top-i card">
                                <img class="rectangle-2" src="{{ asset('public/assets/images/rectangle-2@1x.png') }}" />
                                <div class="content">
                                  <div class="header-card-dan-progress">
                                    <div class="header-and-tags">
                                      <div class="tags">
                                        <div class="retail-distribusi-logistik inter-medium-sweet-pink-12px">
                                          <span class="inter-medium-sweet-pink-12px">Retail/Distribusi/Logistik</span>
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
                                    <div class="info-dan-progress">
                                      <div class="info-pendanaan">
                                        <div class="mulai-rp1000000 inter-normal-mercury-14px">
                                          <span class="tx-sold span-1 inter-normal-mercury">Mulai</span
                                          ><span class="inter-normal-mercury-12px">&nbsp;</span
                                          >
                                          <div class="mulai-rp inter-bold-white-14px"
                                          ><span class="tx-sold span-1 inter-bold-white" style="font-weight: bold">Rp1.000.000</span>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="address">
                                        <div  class="hr inter-bold-white-14px">
                                          <span class="tx-sold inter-medium-white"><b style="font-weight: bold">40</b></span>
                                        </div>
                                        <span class="inter-normal-mercury-12px">&nbsp;</span>
                                        <div class="tiku hr-lg inter-normal-mercury-14px">
                                          <span class="tx-sold inter-normal-mercury">hari lagi</span>
                                        </div>
                                      </div>
                                      <div class="overlap-group">
                                        <div class="percent inter-medium-white-12px">
                                          <span class="tx-np percen inter-medium-white">0%</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="footer-card">
                                    <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                                    <div class="footer-card-1">
                                      <div class="total-pendanaan-rp3000000000 inter-normal-mercury-12px">
                                        <span class="inter-normal-quill-gray-12px">Total Pendanaan<br /></span
                                        ><span class="inter-medium-alabaster-12px">Rp3.000.000.000</span>
                                      </div>
                                      <div class="periode-dividen-6-bulan inter-normal-mercury-10px">
                                        <span class="inter-normal-quill-gray-12px">Periode Dividen<br /></span
                                        ><span class="inter-medium-alabaster-12px">6 Bulan</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                           </div>
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="top-i card">
                                <img class="rectangle-2" src="{{ asset('public/assets/images/rectangle-2@1x.png') }}" />
                                <div class="content">
                                  <div class="header-card-dan-progress">
                                    <div class="header-and-tags">
                                      <div class="tags">
                                        <div class="retail-distribusi-logistik inter-medium-sweet-pink-12px">
                                          <span class="inter-medium-sweet-pink-12px">Retail/Distribusi/Logistik</span>
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
                                    <div class="info-dan-progress">
                                      <div class="info-pendanaan">
                                        <div class="mulai-rp1000000 inter-normal-mercury-14px">
                                          <span class="tx-sold span-1 inter-normal-mercury">Mulai</span
                                          ><span class="inter-normal-mercury-12px">&nbsp;</span
                                          >
                                          <div class="mulai-rp inter-bold-white-14px"
                                          ><span class="tx-sold span-1 inter-bold-white" style="font-weight: bold">Rp1.000.000</span>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="address">
                                        <div  class="hr inter-bold-white-14px">
                                          <span class="tx-sold inter-medium-white"><b style="font-weight: bold">40</b></span>
                                        </div>
                                        <span class="inter-normal-mercury-12px">&nbsp;</span>
                                        <div class="tiku hr-lg inter-normal-mercury-14px">
                                          <span class="tx-sold inter-normal-mercury">hari lagi</span>
                                        </div>
                                      </div>
                                      <div class="overlap-group">
                                        <div class="percent inter-medium-white-12px">
                                          <span class="tx-np percen inter-medium-white">0%</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="footer-card">
                                    <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                                    <div class="footer-card-1">
                                      <div class="total-pendanaan-rp3000000000 inter-normal-mercury-12px">
                                        <span class="inter-normal-quill-gray-12px">Total Pendanaan<br /></span
                                        ><span class="inter-medium-alabaster-12px">Rp3.000.000.000</span>
                                      </div>
                                      <div class="periode-dividen-6-bulan inter-normal-mercury-10px">
                                        <span class="inter-normal-quill-gray-12px">Periode Dividen<br /></span
                                        ><span class="inter-medium-alabaster-12px">6 Bulan</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                           </div>
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="top-i card">
                                <img class="rectangle-2" src="{{ asset('public/assets/images/rectangle-2@1x.png') }}" />
                                <div class="content">
                                  <div class="header-card-dan-progress">
                                    <div class="header-and-tags">
                                      <div class="tags">
                                        <div class="retail-distribusi-logistik inter-medium-sweet-pink-12px">
                                          <span class="inter-medium-sweet-pink-12px">Retail/Distribusi/Logistik</span>
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
                                    <div class="info-dan-progress">
                                      <div class="info-pendanaan">
                                        <div class="mulai-rp1000000 inter-normal-mercury-14px">
                                          <span class="tx-sold span-1 inter-normal-mercury">Mulai</span
                                          ><span class="inter-normal-mercury-12px">&nbsp;</span
                                          >
                                          <div class="mulai-rp inter-bold-white-14px"
                                          ><span class="tx-sold span-1 inter-bold-white" style="font-weight: bold">Rp1.000.000</span>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="address">
                                        <div  class="hr inter-bold-white-14px">
                                          <span class="tx-sold inter-medium-white"><b style="font-weight: bold">40</b></span>
                                        </div>
                                        <span class="inter-normal-mercury-12px">&nbsp;</span>
                                        <div class="tiku hr-lg inter-normal-mercury-14px">
                                          <span class="tx-sold inter-normal-mercury">hari lagi</span>
                                        </div>
                                      </div>
                                      <div class="overlap-group">
                                        <div class="percent inter-medium-white-12px">
                                          <span class="tx-np percen inter-medium-white">0%</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="footer-card">
                                    <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                                    <div class="footer-card-1">
                                      <div class="total-pendanaan-rp3000000000 inter-normal-mercury-12px">
                                        <span class="inter-normal-quill-gray-12px">Total Pendanaan<br /></span
                                        ><span class="inter-medium-alabaster-12px">Rp3.000.000.000</span>
                                      </div>
                                      <div class="periode-dividen-6-bulan inter-normal-mercury-10px">
                                        <span class="inter-normal-quill-gray-12px">Periode Dividen<br /></span
                                        ><span class="inter-medium-alabaster-12px">6 Bulan</span>
                                      </div>
                                    </div>
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