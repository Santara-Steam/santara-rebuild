@extends('front_end/template_front_end/app')

@section('content')
<!-- banner bg main start -->
      <div class="banner_bg_main">
        <div class="banner_section layout_padding">
            <div class="container">
               <div class="section">
                  <div class="header-dan-supporting-text">
                    <div class="tx-bn inter-bold-alabaster-56px">
                      <span class="text-urun inter-bold-alabaster">Urun Dana Investasi Bisnis UKM</span>
                    </div>
                    <div class="tx-sb inter-normal-alabaster-18px">
                      <span class="text-sb inter-normal-alabaster"
                        >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tincidunt auctor mauris, at laoreet
                        arcu tincidunt.</span
                      >
                    </div>
                  </div>
                  <div class="actions">
                      <div class="mulai-investasi button-cta-3 inter-medium-white-18px">
                        <a class="button-2 text-mulai btn btn-danger btn-hm inter-medium-white" href="{{ route('mulai-investasi.index') }}">Mulai Investasi</a>
                      </div>
                      <div class="jadi-penerbit button-cta-4 inter-medium-eerie-black-18px">
                        <a class="button-3 text-daftar btn btn-light btn-hm inter-medium-eerie-black" href="{{ route('daftar-bisnis.index') }}">Daftarkan Bisnis</a>
                      </div>
                  </div>
                </div>
              </div>
          </div>
      </div>
      <!-- banner bg main end -->
      <!-- fashion section start -->
      <div class="fashion_section">
         <div id="main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="title-dan-link-button-1 w3-red">
                      <div class="now-playing inter-bold-alabaster-24px">
                        <span class="tx-lf inter-bold-alabaster">Now Playing (4)</span>
                      </div>
                      <div class="investasi-sekarang inter-bold-thunderbird-16px button-4 seemore">
                        <a href="{{ route('now-playing.index') }}" class="tx-rg inter-bold-white" >Investasi Sekarang
                         &nbsp&nbsp<i class="fas fa-arrow-right"></i></a>
                      </div>
                    </div>
                    <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="w3-container w3-red">
                     <div class="fashion_section_2">
                        <div class="row">
                           <div class="col-lg-3 col-sm-6 col-6">
                            <a href="{{ route('now-playing.detail') }}">
                              <div class="card">
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
                                        <div class="hr-lg inter-normal-mercury-14px">
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
                              <div class="card">
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
                                        <div class="hr-lg inter-normal-mercury-14px">
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
                              <div class="card">
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
                                        <div class="hr-lg inter-normal-mercury-14px">
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
                              <div class="card">
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
                                        <div class="hr-lg inter-normal-mercury-14px">
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
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="w3-container w3-red">
                     <div class="fashion_section_2">
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
                                        <div class="hr-lg inter-normal-mercury-14px">
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
                              <div class="card">
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
                                        <div class="hr-lg inter-normal-mercury-14px">
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
                              <div class="card">
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
                                        <div class="hr-lg inter-normal-mercury-14px">
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
                              <div class="card">
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
                                        <div class="hr-lg inter-normal-mercury-14px">
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
                     </div>
                     </div>
                  </div>
               </div>
            </div>
            </div>
            <div class="but-pag">
            <a class="carousel-control-prev border-1px-cape-cod inter-medium-alabaster-14px" href="#main_slider" role="button" data-slide="prev"><i class="fas fa-arrow-left"></i>&nbsp&nbsp Prev
            </a>
            <a class="carousel-control-next border-1px-cape-cod inter-medium-alabaster-14px" href="#main_slider" role="button" data-slide="next">Next &nbsp&nbsp<i class="fas fa-arrow-right"></i>
            </a>
          </div>
         </div>
      </div>
      <!-- fashion section end -->
      <!-- electronic section start -->
      <div class="fashion_section">
         <div id="electronic_main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
               <div class="title-dan-link-button-1 w3-red">
                      <div class="now-playing inter-bold-alabaster-24px">
                        <span class="tx-lf inter-bold-alabaster">Coming Soon (45)</span>
                      </div>
                      <div class="investasi-sekarang inter-bold-thunderbird-16px button-4 seemore">
                        <a href="{{ route('coming-soon.index') }}" class="tx-rg inter-bold-white" >Dukung Bisnis
                         &nbsp&nbsp<i class="fas fa-arrow-right"></i></a>
                      </div>
                    </div>
                    <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="w3-container w3-red">
                     <div class="fashion_section_2">
                        <div class="fashion_section_2">
                        <div class="row">
                           <div class="col-lg-3 col-sm-6 col-6">
                            <a href="{{ route('coming-soon.detail') }}">
                              <div class="card">
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
                                    <div class="icon-card">
                                      <div class="icon-and-supporting-text">
                                        <img class="icon-com iconheart" src="{{ asset('public/assets/images/icon-heart-18@2x.png') }}" />
                                        <div class="address-2 inter-normal-alabaster-10px" style="margin-left: 25px">
                                          <span class="tx-icon inter-normal-alabaster">91 Suka</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-1">
                                        <img class="icon-com iconuser" src="{{ asset('public/assets/images/icon-user-17@2x.png') }}" />
                                        <div class="address-5 inter-normal-alabaster-10px" style="margin-left: 20px">
                                          <span class="tx-icon inter-normal-alabaster">100 Minat</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-2">
                                        <img class="icon-com iconmessage-circle" src="{{ asset('public/assets/images/icon-message-circle-46@2x.png') }}" />
                                        <div class="address-6 inter-normal-alabaster-10px">
                                          <span class="tx-icon inter-normal-alabaster">46 Komentar</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-3">
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
                            </a>
                           </div>
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="card">
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
                                    <div class="icon-card">
                                      <div class="icon-and-supporting-text">
                                        <img class="icon-com iconheart" src="{{ asset('public/assets/images/icon-heart-18@2x.png') }}" />
                                        <div class="address-2 inter-normal-alabaster-10px" style="margin-left: 25px">
                                          <span class="tx-icon inter-normal-alabaster">91 Suka</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-1">
                                        <img class="icon-com iconuser" src="{{ asset('public/assets/images/icon-user-17@2x.png') }}" />
                                        <div class="address-5 inter-normal-alabaster-10px" style="margin-left: 20px">
                                          <span class="tx-icon inter-normal-alabaster">100 Minat</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-2">
                                        <img class="icon-com iconmessage-circle" src="{{ asset('public/assets/images/icon-message-circle-46@2x.png') }}" />
                                        <div class="address-6 inter-normal-alabaster-10px">
                                          <span class="tx-icon inter-normal-alabaster">46 Komentar</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-3">
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
                                    <div class="icon-card">
                                      <div class="icon-and-supporting-text">
                                        <img class="icon-com iconheart" src="{{ asset('public/assets/images/icon-heart-18@2x.png') }}" />
                                        <div class="address-2 inter-normal-alabaster-10px" style="margin-left: 25px">
                                          <span class="tx-icon inter-normal-alabaster">91 Suka</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-1">
                                        <img class="icon-com iconuser" src="{{ asset('public/assets/images/icon-user-17@2x.png') }}" />
                                        <div class="address-5 inter-normal-alabaster-10px" style="margin-left: 20px">
                                          <span class="tx-icon inter-normal-alabaster">100 Minat</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-2">
                                        <img class="icon-com iconmessage-circle" src="{{ asset('public/assets/images/icon-message-circle-46@2x.png') }}" />
                                        <div class="address-6 inter-normal-alabaster-10px">
                                          <span class="tx-icon inter-normal-alabaster">46 Komentar</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-3">
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
                                    <div class="icon-card">
                                      <div class="icon-and-supporting-text">
                                        <img class="icon-com iconheart" src="{{ asset('public/assets/images/icon-heart-18@2x.png') }}" />
                                        <div class="address-2 inter-normal-alabaster-10px" style="margin-left: 25px">
                                          <span class="tx-icon inter-normal-alabaster">91 Suka</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-1">
                                        <img class="icon-com iconuser" src="{{ asset('public/assets/images/icon-user-17@2x.png') }}" />
                                        <div class="address-5 inter-normal-alabaster-10px" style="margin-left: 20px">
                                          <span class="tx-icon inter-normal-alabaster">100 Minat</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-2">
                                        <img class="icon-com iconmessage-circle" src="{{ asset('public/assets/images/icon-message-circle-46@2x.png') }}" />
                                        <div class="address-6 inter-normal-alabaster-10px">
                                          <span class="tx-icon inter-normal-alabaster">46 Komentar</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-3">
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
                     </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="w3-container w3-red">
                     <div class="fashion_section_2">
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
                                    <div class="icon-card">
                                      <div class="icon-and-supporting-text">
                                        <img class="icon-com iconheart" src="{{ asset('public/assets/images/icon-heart-18@2x.png') }}" />
                                        <div class="address-2 inter-normal-alabaster-10px" style="margin-left: 25px">
                                          <span class="tx-icon inter-normal-alabaster">91 Suka</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-1">
                                        <img class="icon-com iconuser" src="{{ asset('public/assets/images/icon-user-17@2x.png') }}" />
                                        <div class="address-5 inter-normal-alabaster-10px" style="margin-left: 20px">
                                          <span class="tx-icon inter-normal-alabaster">100 Minat</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-2">
                                        <img class="icon-com iconmessage-circle" src="{{ asset('public/assets/images/icon-message-circle-46@2x.png') }}" />
                                        <div class="address-6 inter-normal-alabaster-10px">
                                          <span class="tx-icon inter-normal-alabaster">46 Komentar</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-3">
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
                                    <div class="icon-card">
                                      <div class="icon-and-supporting-text">
                                        <img class="icon-com iconheart" src="{{ asset('public/assets/images/icon-heart-18@2x.png') }}" />
                                        <div class="address-2 inter-normal-alabaster-10px" style="margin-left: 25px">
                                          <span class="tx-icon inter-normal-alabaster">91 Suka</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-1">
                                        <img class="icon-com iconuser" src="{{ asset('public/assets/images/icon-user-17@2x.png') }}" />
                                        <div class="address-5 inter-normal-alabaster-10px" style="margin-left: 20px">
                                          <span class="tx-icon inter-normal-alabaster">100 Minat</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-2">
                                        <img class="icon-com iconmessage-circle" src="{{ asset('public/assets/images/icon-message-circle-46@2x.png') }}" />
                                        <div class="address-6 inter-normal-alabaster-10px">
                                          <span class="tx-icon inter-normal-alabaster">46 Komentar</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-3">
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
                                    <div class="icon-card">
                                      <div class="icon-and-supporting-text">
                                        <img class="icon-com iconheart" src="{{ asset('public/assets/images/icon-heart-18@2x.png') }}" />
                                        <div class="address-2 inter-normal-alabaster-10px" style="margin-left: 25px">
                                          <span class="tx-icon inter-normal-alabaster">91 Suka</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-1">
                                        <img class="icon-com iconuser" src="{{ asset('public/assets/images/icon-user-17@2x.png') }}" />
                                        <div class="address-5 inter-normal-alabaster-10px" style="margin-left: 20px">
                                          <span class="tx-icon inter-normal-alabaster">100 Minat</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-2">
                                        <img class="icon-com iconmessage-circle" src="{{ asset('public/assets/images/icon-message-circle-46@2x.png') }}" />
                                        <div class="address-6 inter-normal-alabaster-10px">
                                          <span class="tx-icon inter-normal-alabaster">46 Komentar</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-3">
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
                                    <div class="icon-card">
                                      <div class="icon-and-supporting-text">
                                        <img class="icon-com iconheart" src="{{ asset('public/assets/images/icon-heart-18@2x.png') }}" />
                                        <div class="address-2 inter-normal-alabaster-10px" style="margin-left: 25px">
                                          <span class="tx-icon inter-normal-alabaster">91 Suka</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-1">
                                        <img class="icon-com iconuser" src="{{ asset('public/assets/images/icon-user-17@2x.png') }}" />
                                        <div class="address-5 inter-normal-alabaster-10px" style="margin-left: 20px">
                                          <span class="tx-icon inter-normal-alabaster">100 Minat</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-2">
                                        <img class="icon-com iconmessage-circle" src="{{ asset('public/assets/images/icon-message-circle-46@2x.png') }}" />
                                        <div class="address-6 inter-normal-alabaster-10px">
                                          <span class="tx-icon inter-normal-alabaster">46 Komentar</span>
                                        </div>
                                      </div>
                                      <div class="icon-and-supporting-text-3">
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
                     </div>
                     </div>
                  </div>
               </div>
            </div>
          </div>
            <div class="but-pag">
            <a class="carousel-control-prev border-1px-cape-cod inter-medium-alabaster-14px" href="#electronic_main_slider" role="button" data-slide="prev"><i class="fas fa-arrow-left"></i>&nbsp&nbsp Prev
            </a>
            <a class="carousel-control-next border-1px-cape-cod inter-medium-alabaster-14px" href="#electronic_main_slider" role="button" data-slide="next">Next &nbsp&nbsp<i class="fas fa-arrow-right"></i>
            </a>
          </div>
         </div>
      </div>
      <!-- electronic section end -->
      <!-- jewellery  section start -->
      <div class="fashion_section">
         <div id="jewellery_main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
               <div class="title-dan-link-button-1 w3-red">
                      <div class="now-playing inter-bold-alabaster-24px">
                        <span class="tx-lf inter-bold-alabaster">Sold Out (90)</span>
                      </div>
                      <div class="investasi-sekarang inter-bold-thunderbird-16px button-4 seemore">
                        <a href="{{ route('sold-out.index') }}" class="tx-rg inter-bold-white" >Lihat Semua
                         &nbsp&nbsp<i class="fas fa-arrow-right"></i></a>
                      </div>
                    </div>
                    <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="w3-container w3-red">
                     <div class="fashion_section_2">
                        <div class="fashion_section_2">
                        <div class="row">
                           <div class="col-lg-3 col-sm-6 col-6">
                            <a href="{{ route('sold-out.detail') }}">
                              <div class="card">
                                <img class="rectangle-2" src="{{ asset('public/assets/images/rectangle-2@1x.png') }}" />
                                <div class="content">
                                  <div class="header-card-dan-progress-2">
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
                                    <div class="info-pendanaan">
                                        <div class="mul inter-normal-mercury-14px">
                                          <span class="tx-sold span-1 inter-normal-quill-gray">Total Pendanaan</span>
                                        </div>
                                      </div>
                                        <div class="addr inter-bold-white-14px">
                                          <span class="tx-sold inter-bold-white" style="font-weight: bold">Rp3.000.000.000</span>
                                        </div>
                                    <div>
                                    </div>
                                  </div>
                                  <div class="footer-card">
                                    <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                                    <div class="footer-card-2">
                                      <div class="deviden-dibagikan-rp inter-normal-mercury-12px">
                                        <span class="inter-normal-quill-gray-12px">Deviden Dibagikan<br /></span
                                        ><span class="inter-medium-alabaster-12px">Rp250.000.000</span>
                                      </div>
                                      <div class="pembagian-dividen-1-kali inter-normal-mercury-10px">
                                        <span class="inter-normal-quill-gray-12px">Pembagian Dividen<br /></span
                                        ><span class="inter-medium-alabaster-12px">1 Kali</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </a>
                           </div>
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="card">
                                <img class="rectangle-2" src="{{ asset('public/assets/images/rectangle-2@1x.png') }}" />
                                <div class="content">
                                  <div class="header-card-dan-progress-2">
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
                                    <div class="info-pendanaan">
                                        <div class="mul inter-normal-mercury-14px">
                                          <span class="tx-sold span-1 inter-normal-quill-gray">Total Pendanaan</span>
                                        </div>
                                      </div>
                                        <div class="addr inter-bold-white-14px">
                                          <span class="tx-sold inter-bold-white" style="font-weight: bold">Rp3.000.000.000</span>
                                        </div>
                                    <div>
                                    </div>
                                  </div>
                                  <div class="footer-card">
                                    <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                                    <div class="footer-card-2">
                                      <div class="deviden-dibagikan-rp inter-normal-mercury-12px">
                                        <span class="inter-normal-quill-gray-12px">Deviden Dibagikan<br /></span
                                        ><span class="inter-medium-alabaster-12px">Rp250.000.000</span>
                                      </div>
                                      <div class="pembagian-dividen-1-kali inter-normal-mercury-10px">
                                        <span class="inter-normal-quill-gray-12px">Pembagian Dividen<br /></span
                                        ><span class="inter-medium-alabaster-12px">1 Kali</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                           </div>
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="card">
                                <img class="rectangle-2" src="{{ asset('public/assets/images/rectangle-2@1x.png') }}" />
                                <div class="content">
                                  <div class="header-card-dan-progress-2">
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
                                    <div class="info-pendanaan">
                                        <div class="mul inter-normal-mercury-14px">
                                          <span class="tx-sold span-1 inter-normal-quill-gray">Total Pendanaan</span>
                                        </div>
                                      </div>
                                        <div class="addr inter-bold-white-14px">
                                          <span class="tx-sold inter-bold-white" style="font-weight: bold">Rp3.000.000.000</span>
                                        </div>
                                    <div>
                                    </div>
                                  </div>
                                  <div class="footer-card">
                                    <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                                    <div class="footer-card-2">
                                      <div class="deviden-dibagikan-rp inter-normal-mercury-12px">
                                        <span class="inter-normal-quill-gray-12px">Deviden Dibagikan<br /></span
                                        ><span class="inter-medium-alabaster-12px">Rp250.000.000</span>
                                      </div>
                                      <div class="pembagian-dividen-1-kali inter-normal-mercury-10px">
                                        <span class="inter-normal-quill-gray-12px">Pembagian Dividen<br /></span
                                        ><span class="inter-medium-alabaster-12px">1 Kali</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                           </div>
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="card">
                                <img class="rectangle-2" src="{{ asset('public/assets/images/rectangle-2@1x.png') }}" />
                                <div class="content">
                                  <div class="header-card-dan-progress-2">
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
                                    <div class="info-pendanaan">
                                        <div class="mul inter-normal-mercury-14px">
                                          <span class="tx-sold span-1 inter-normal-quill-gray">Total Pendanaan</span>
                                        </div>
                                      </div>
                                        <div class="addr inter-bold-white-14px">
                                          <span class="tx-sold inter-bold-white" style="font-weight: bold">Rp3.000.000.000</span>
                                        </div>
                                    <div>
                                    </div>
                                  </div>
                                  <div class="footer-card">
                                    <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                                    <div class="footer-card-2">
                                      <div class="deviden-dibagikan-rp inter-normal-mercury-12px">
                                        <span class="inter-normal-quill-gray-12px">Deviden Dibagikan<br /></span
                                        ><span class="inter-medium-alabaster-12px">Rp250.000.000</span>
                                      </div>
                                      <div class="pembagian-dividen-1-kali inter-normal-mercury-10px">
                                        <span class="inter-normal-quill-gray-12px">Pembagian Dividen<br /></span
                                        ><span class="inter-medium-alabaster-12px">1 Kali</span>
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
               </div>
               <div class="carousel-item">
                  <div class="w3-container w3-red">
                     <div class="fashion_section_2">
                        <div class="fashion_section_2">
                        <div class="row">
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="card">
                                <img class="rectangle-2" src="{{ asset('public/assets/images/rectangle-2@1x.png') }}" />
                                <div class="content">
                                  <div class="header-card-dan-progress-2">
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
                                    <div class="info-pendanaan">
                                        <div class="mul inter-normal-mercury-14px">
                                          <span class="tx-sold span-1 inter-normal-quill-gray">Total Pendanaan</span>
                                        </div>
                                      </div>
                                        <div class="addr inter-bold-white-14px">
                                          <span class="tx-sold inter-bold-white" style="font-weight: bold">Rp3.000.000.000</span>
                                        </div>
                                    <div>
                                    </div>
                                  </div>
                                  <div class="footer-card">
                                    <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                                    <div class="footer-card-2">
                                      <div class="deviden-dibagikan-rp inter-normal-mercury-12px">
                                        <span class="inter-normal-quill-gray-12px">Deviden Dibagikan<br /></span
                                        ><span class="inter-medium-alabaster-12px">Rp250.000.000</span>
                                      </div>
                                      <div class="pembagian-dividen-1-kali inter-normal-mercury-10px">
                                        <span class="inter-normal-quill-gray-12px">Pembagian Dividen<br /></span
                                        ><span class="inter-medium-alabaster-12px">1 Kali</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                           </div>
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="card">
                                <img class="rectangle-2" src="{{ asset('public/assets/images/rectangle-2@1x.png') }}" />
                                <div class="content">
                                  <div class="header-card-dan-progress-2">
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
                                    <div class="info-pendanaan">
                                        <div class="mul inter-normal-mercury-14px">
                                          <span class="tx-sold span-1 inter-normal-quill-gray">Total Pendanaan</span>
                                        </div>
                                      </div>
                                        <div class="addr inter-bold-white-14px">
                                          <span class="tx-sold inter-bold-white" style="font-weight: bold">Rp3.000.000.000</span>
                                        </div>
                                    <div>
                                    </div>
                                  </div>
                                  <div class="footer-card">
                                    <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                                    <div class="footer-card-2">
                                      <div class="deviden-dibagikan-rp inter-normal-mercury-12px">
                                        <span class="inter-normal-quill-gray-12px">Deviden Dibagikan<br /></span
                                        ><span class="inter-medium-alabaster-12px">Rp250.000.000</span>
                                      </div>
                                      <div class="pembagian-dividen-1-kali inter-normal-mercury-10px">
                                        <span class="inter-normal-quill-gray-12px">Pembagian Dividen<br /></span
                                        ><span class="inter-medium-alabaster-12px">1 Kali</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                           </div>
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="card">
                                <img class="rectangle-2" src="{{ asset('public/assets/images/rectangle-2@1x.png') }}" />
                                <div class="content">
                                  <div class="header-card-dan-progress-2">
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
                                    <div class="info-pendanaan">
                                        <div class="mul inter-normal-mercury-14px">
                                          <span class="tx-sold span-1 inter-normal-quill-gray">Total Pendanaan</span>
                                        </div>
                                      </div>
                                        <div class="addr inter-bold-white-14px">
                                          <span class="tx-sold inter-bold-white" style="font-weight: bold">Rp3.000.000.000</span>
                                        </div>
                                    <div>
                                    </div>
                                  </div>
                                  <div class="footer-card">
                                    <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                                    <div class="footer-card-2">
                                      <div class="deviden-dibagikan-rp inter-normal-mercury-12px">
                                        <span class="inter-normal-quill-gray-12px">Deviden Dibagikan<br /></span
                                        ><span class="inter-medium-alabaster-12px">Rp250.000.000</span>
                                      </div>
                                      <div class="pembagian-dividen-1-kali inter-normal-mercury-10px">
                                        <span class="inter-normal-quill-gray-12px">Pembagian Dividen<br /></span
                                        ><span class="inter-medium-alabaster-12px">1 Kali</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                           </div>
                           <div class="col-lg-3 col-sm-6 col-6">
                              <div class="card">
                                <img class="rectangle-2" src="{{ asset('public/assets/images/rectangle-2@1x.png') }}" />
                                <div class="content">
                                  <div class="header-card-dan-progress-2">
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
                                    <div class="info-pendanaan">
                                        <div class="mul inter-normal-mercury-14px">
                                          <span class="tx-sold span-1 inter-normal-quill-gray">Total Pendanaan</span>
                                        </div>
                                      </div>
                                        <div class="addr inter-bold-white-14px">
                                          <span class="tx-sold inter-bold-white" style="font-weight: bold">Rp3.000.000.000</span>
                                        </div>
                                    <div>
                                    </div>
                                  </div>
                                  <div class="footer-card">
                                    <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                                    <div class="footer-card-2">
                                      <div class="deviden-dibagikan-rp inter-normal-mercury-12px">
                                        <span class="inter-normal-quill-gray-12px">Deviden Dibagikan<br /></span
                                        ><span class="inter-medium-alabaster-12px">Rp250.000.000</span>
                                      </div>
                                      <div class="pembagian-dividen-1-kali inter-normal-mercury-10px">
                                        <span class="inter-normal-quill-gray-12px">Pembagian Dividen<br /></span
                                        ><span class="inter-medium-alabaster-12px">1 Kali</span>
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
               </div>
             </div>
            </div>
            <div class="but-pag">
            <a class="carousel-control-prev border-1px-cape-cod inter-medium-alabaster-14px" href="#jewellery_main_slider" role="button" data-slide="prev"><i class="fas fa-arrow-left"></i>&nbsp&nbsp Prev
            </a>
            <a class="carousel-control-next border-1px-cape-cod inter-medium-alabaster-14px" href="#jewellery_main_slider" role="button" data-slide="next">Next &nbsp&nbsp<i class="fas fa-arrow-right"></i>
            </a>
          </div>
         </div>
      </div>
      <!-- jewellery  section end -->

@endsection