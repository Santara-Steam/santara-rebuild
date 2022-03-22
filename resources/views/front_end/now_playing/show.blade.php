@extends('front_end/template_front_end/app')

@section('content')
    <link rel="stylesheet" href="{{ asset('public/assets/css/tabs.css') }}">

<div class="bg" style="background-image: url({{ asset('public/assets/images/background-now-playing@1x.png') }}">
        <div class="banner_section layout_padding">
            <div class="container" style="margin-top: 0px;">>
               <div class="section">
                  <div class="heading-and-tag">
                <div class="hheader-dan-supporting-text">
                  <div class="fruters-indonesia inter-bold-alabaster-48px">
                    <span class="text-urun inter-bold-alabaster">Fruters Indonesia</span>
                  </div>
                  <div class="pt-fruters-indonesia-perkasa inter-medium-alabaster-18px">
                    <span class="tx-pt inter-medium-alabaster">PT Fruters Indonesia Perkasa</span>
                  </div>
                </div>
                <div class="tags-d">
                  <div class="food-and-beverage inter-medium-sweet-pink-14px">
                    <span class="tx-rg inter-medium-sweet-pink-14px">Food and Beverage</span>
                  </div>
                </div>
              </div>
              <div class="profil">
                <img class="image-69" src="{{ asset('public/assets/images/image-69-8@2x.png') }}" />
                <div class="pemilik-bisnis">
                  <div class="m-khemal-nugroho inter-medium-alabaster-18px">
                    <span class="text-mulai inter-medium-alabaster">M Khemal Nugroho</span>
                  </div>
                  <div class="pemilik-bisnis-1 inter-normal-mercury-14px">
                    <span class="inter-normal-mercury-14px">Pemilik Bisnis</span>
                  </div>
                </div>
              </div>
                </div>
              </div>
          </div>
      </div>
      <!-- fashion section start -->
      <div class="fashion_section">
         <div class="container">
          <div class="row">
            <div class="col-lg-6 col-sm-6">
               <!-- nav options -->
               <ul class="nav nav-pills mb-3 shadow-sm" id="pills-tab" role="tablist">
                   <li class="nav-item sp-tab"> <a class="nav-link active inter-medium-delta" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Informasi Saham</a> </li>
                   <li class="nav-item sp-tab"> <a class="nav-link inter-medium-delta" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Detail Saham</a> </li>
                   <li class="nav-item sp-tab"> <a class="nav-link inter-medium-delta" id="pills-contact-tab" data-toggle="pill" href="#pills-des" role="tab" aria-controls="pills-des" aria-selected="false">Deskripsi Bisnis</a> </li>
                   <li class="nav-item sp-tab"> <a class="nav-link inter-medium-delta" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Kontak</a> </li>
               </ul> <!-- content -->
               <div class="tab-content" id="pills-tabContent p-3">
                   <!-- 1st card -->
                   <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                       <div class="table-row-1">
                        <span class="inter-medium-delta-16px">Deskripsi Bisnis</span>
                      </div>
                      <div class="table-row">
                        <span class="inter-medium-delta-16px">Deskripsi Bisnis</span>
                      </div>
                      <div class="table-row">
                        <span class="inter-medium-delta-16px">Deskripsi Bisnis</span>
                      </div>
                   </div> <!-- 2nd card -->
                   <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                       <div class="table-row-1">
                          <span class="inter-medium-delta-16px">Deskripsi Bisnis</span>
                        </div>
                        <div class="table-row">
                          <span class="inter-medium-delta-16px">Deskripsi Bisnis</span>
                        </div>
                        <div class="table-row">
                          <span class="inter-medium-delta-16px">Deskripsi Bisnis</span>
                        </div>
                   </div> <!-- 3nd card --> <!-- 2nd card -->
                   <div class="tab-pane fade" id="pills-des" role="tabpanel" aria-labelledby="pills-des-tab">
                       <div class="table-row-1">
                          <span class="inter-medium-delta-16px">Deskripsi Bisnis</span>
                        </div>
                        <div class="table-row">
                          <span class="inter-medium-delta-16px">Deskripsi Bisnis</span>
                        </div>
                        <div class="table-row">
                          <span class="inter-medium-delta-16px">Deskripsi Bisnis</span>
                        </div>
                   </div> <!-- 3nd card -->
                    <!-- 2nd card -->
                   <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                       <div class="table-row-1">
                          <span class="inter-medium-delta-16px">Deskripsi Bisnis</span>
                        </div>
                        <div class="table-row">
                          <span class="inter-medium-delta-16px">Deskripsi Bisnis</span>
                        </div>
                        <div class="table-row">
                          <span class="inter-medium-delta-16px">Deskripsi Bisnis</span>
                        </div>
                   </div> <!-- 3nd card -->
      </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="info-deviden border-1px-cape-cod" style="width: 300px; height: 420px;">
            <div class="pembagian-deviden-1 inter-normal-delta-12px">
              <span class="inter-normal-delta-12px" >Mulai dari</span>
            </div>
            <div class="table-7">
                  <p class="pembagian-deviden-ta inter-bold-alabaster-24px">
                    <span class="inter-bold-alabaster-24px" style="color: #fff">Rp100.000</span
                    ><span class="inter-normal-delta-14px" style="white-space: nowrap;">/100 lembar</span><br>
                    <span class="inter-normal-delta-12px" style="white-space: nowrap; margin-top: -5px;">Dari target</span
                    >&nbsp;<span class="inter-normal-delta-12px" style="font-weight: bold; color: #fff">Rp3.000.000.000</span>
                  </p>
                  <div class="overlap-group" style=" min-width: 270px;">
                    <div class="percent inter-medium-white-12px">
                      <span class="tx-np percen inter-medium-white">0%</span>
                    </div>
                  </div>
                    <p class="pembagian-deviden-ta inter-normal-delta-12px">
                      <span class="inter-normal-delta-12px" style="white-space: nowrap;">Sisa waktu:</span
                      >&nbsp;<span class="inter-normal-delta-12px">30 Hari</span
                      >
                      <img class="divider" style="min-width: 270px; margin-top: 30px;" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />

                      <br><br><span class="inter-medium-delta-12px">Bagikan: &nbsp;&nbsp;</span><i style="font-size: 20px; margin-top: " class="fab fa-facebook"></i>&nbsp;&nbsp;&nbsp;<i style="font-size: 20px;" class="fa fa-clone"></i><br><br>
                      <img class="divider" style="min-width: 270px;" src="{{ asset('public/assets/images/divider-108@2x.png') }}" /> 
                      <div style="min-width: 270px; margin-top: -10px;">
                        <a class="b-daf btn btn-danger btn-lg btn-block" href=""><i class="fas fa-shopping-cart"></i>&nbsp; Beli Saham</a><br>
                        <a style="margin-left: -1px; margin-top: -10px;"class="b-mul btn btn-light btn-lg btn-block" href="{{ route('daftar-bisnis.index') }}"><i class="fas fa-list"></i>&nbsp; Prospektus</a>
                      </div>
                    </p>
                </div>
              </div>
            </div>
          </div>
            
           
              <div class="videoWrapper" style="margin-top:100px;">
            <!-- Copy & Pasted from YouTube -->
                <iframe width="560" height="349"  src="https://www.youtube.com/embed/tgbNymZ7vqY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
              <div class="gallery">
              <div class="gallery-1 inter-bold-alabaster-24px"><span class="inter-bold-alabaster-24px">Gallery</span></div>
            </div>
             </div>
          </div>
      <!-- fashion section end -->
      <!-- electronic section end -->
      <!-- jewellery  section start -->
      <div class="fashion_section">
         <div class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
               <div class="title-dan-link-button-1">
                    </div>
                    <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="container">
                     <div class="fashion_section_2">
                        <div class="fashion_section_2">
                          <div id="owl-demo4" class="owl-carousel owl-theme">
                            <div class="item">
                                <img class="rectangle-2" src="{{ asset('public/assets/images/rectangle-2@1x.png') }}" />
                              </div>
                              <div class="item">
                                <img class="rectangle-2" src="{{ asset('public/assets/images/rectangle-2@1x.png') }}" />
                              </div>
                              <div class="item">
                                <img class="rectangle-2" src="{{ asset('public/assets/images/rectangle-2@1x.png') }}" />
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