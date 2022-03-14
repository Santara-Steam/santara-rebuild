@extends('front_end/template_front_end/app')

@section('content')
<div class="bg" style="background-image: url({{ asset('assets/images/background-now-playing@1x.png') }}">
        <div class="banner_section layout_padding">
            <div class="container">
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
                <img class="image-69" src="{{ asset('assets/images/image-69-8@2x.png') }}" />
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
                <div class="tabs-and-conten">
            <div class="tabs">
              <div class="tab-header">
                <div class="title-header inter-medium-alabaster-16px">
                  <span class="inter-medium-alabaster-16px">Informasi Saham</span>
                </div>
              </div>
              <div class="tab-header-1">
                <div class="title-header-1 inter-medium-delta-16px">
                  <span class="inter-medium-delta-16px">Detail Saham</span>
                </div>
              </div>
              <div class="tab-header-2">
                <div class="title-header-2 inter-medium-delta-16px">
                  <span class="inter-medium-delta-16px">Deskripsi Bisnis</span>
                </div>
              </div>
              <div class="tab-header-3">
                <div class="title-header-3 inter-medium-delta-16px">
                  <span class="inter-medium-delta-16px">Kontak</span>
                </div>
              </div>
            </div>
            <div class="conten-tab">
              <div class="table-row-1">
                <span class="inter-medium-delta-16px">Deskripsi Bisnis</span>
              </div>
              <div class="table-row">
                <span class="inter-medium-delta-16px">Deskripsi Bisnis</span>
              </div>
              <div class="table-row">
                <span class="inter-medium-delta-16px">Deskripsi Bisnis</span>
              </div>
            </div>
                                
              </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <img class="cta" src="{{ asset('assets/images/cta-3@2x.png') }}" />
                         
            </div>
        </div>
            
           
            <img class="youtube" src="{{ asset('assets/images/yt.png') }}">
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
                        <div class="row">
                           <div class="col-lg-4 col-sm-4">
                              <div class="card">
                                <img class="rectangle-2" src="{{ asset('assets/images/rectangle-2@1x.png') }}" />
                                
                              </div>
                           </div>
                           <div class="col-lg-4 col-sm-4">
                              <div class="card">
                                <img class="rectangle-2" src="{{ asset('assets/images/rectangle-2@1x.png') }}" />
                                
                              </div>
                           </div>
                           <div class="col-lg-4 col-sm-4">
                              <div class="card">
                                <img class="rectangle-2" src="{{ asset('assets/images/rectangle-2@1x.png') }}" />
                                
                              </div>
                           </div>
                        </div>
                     </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="container">
                     <div class="fashion_section_2">
                        <div class="fashion_section_2">
                        <div class="row">
                           <div class="col-lg-4 col-sm-4">
                              <div class="card">
                                <img class="rectangle-2" src="{{ asset('assets/images/rectangle-2@1x.png') }}" />
                                
                              </div>
                           </div>
                           <div class="col-lg-4 col-sm-4">
                              <div class="card">
                                <img class="rectangle-2" src="{{ asset('assets/images/rectangle-2@1x.png') }}" />
                                
                              </div>
                           </div>
                           <div class="col-lg-4 col-sm-4">
                              <div class="card">
                                <img class="rectangle-2" src="{{ asset('assets/images/rectangle-2@1x.png') }}" />
                                
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
@endsection