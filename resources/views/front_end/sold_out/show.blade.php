@extends('front_end/template_front_end/app')

@section('content')
 <link rel="stylesheet" href="{{ asset('public/assets/css/tabs.css') }}">

<div class="bg" style="background-image: url({{ asset('public/assets/images/background-now-playing@1x.png') }}">
        <div class="banner_section layout_padding">
            <div class="container"style="margin-top: 15px;">
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


        <div class="progres-section">
          <div class="progres-penerbit inter-bold-alabaster-24px">
            <span class="inter-bold-alabaster-24px">Progres Penerbit</span>
          </div>
          <div class="overlap-group-1">
            <div class="progres">
              <div class="frame-1 border-6px-falu-red">
                <div class="number inter-bold-alabaster-18px"><span class="inter-bold-alabaster-18px">1</span></div>
              </div>
              <div class="info-progres">
                <div class="pra-penawaran-saham inter-medium-delta-16px">
                  <span class="inter-medium-delta-16px">Pra Penawaran Saham</span>
                </div>
                <div class="date inter-normal-delta-14px"><span class="inter-normal-delta-14px">22-06-2021</span></div>
              </div>
            </div>
            <div class="progres-1">
              <div class="frame-1 border-6px-falu-red">
                <div class="number inter-bold-alabaster-18px"><span class="inter-bold-alabaster-18px">2</span></div>
              </div>
              <div class="info-progres">
                <div class="penawaran-saham inter-medium-delta-16px">
                  <span class="inter-medium-delta-16px">Penawaran Saham</span>
                </div>
                <div class="date inter-normal-delta-14px"><span class="inter-normal-delta-14px">23-06-2021</span></div>
              </div>
            </div>
            <div class="progres-2">
              <div class="frame-1 border-6px-falu-red">
                <div class="number inter-bold-alabaster-18px"><span class="inter-bold-alabaster-18px">3</span></div>
              </div>
              <div class="info-progres">
                <div class="pendanaan-terpenuhi inter-medium-delta-16px">
                  <span class="inter-medium-delta-16px">Pendanaan Terpenuhi</span>
                </div>
                <div class="date-1 inter-normal-delta-14px">
                  <span class="inter-normal-delta-14px">11-07-2021</span>
                </div>
              </div>
            </div>
            <div class="progres-3">
              <div class="frame-1 border-6px-falu-red">
                <div class="number inter-bold-alabaster-18px"><span class="inter-bold-alabaster-18px">4</span></div>
              </div>
              <div class="info-progres">
                <div class="penyerahan-dana inter-medium-delta-16px">
                  <span class="inter-medium-delta-16px">Penyerahan Dana</span>
                </div>
                <div class="date-2 inter-normal-delta-14px">
                  <span class="inter-normal-delta-14px">12-08-2021</span>
                </div>
              </div>
            </div>
            <div class="progres-4">
              <div class="frame-1 border-6px-falu-red">
                <div class="number inter-bold-alabaster-18px"><span class="inter-bold-alabaster-18px">5</span></div>
              </div>
              <div class="pembagian-deviden inter-medium-alabaster-16px">
                <span class="inter-medium-alabaster-16px">Pembagian Deviden</span>
              </div>
            </div>
            <img class="divider" src="img/divider-52@2x.png') }}" />
            <img class="divider-1" src="{{ asset('public/assets/images/divider-112@2x.png') }}" />
            <img class="divider-2" src="{{ asset('public/assets/images/divider-112@2x.png') }}" />
            <img class="divider-3" src="{{ asset('public/assets/images/divider-112@2x.png') }}" />
            <img class="divider-4" src="{{ asset('public/assets/images/divider-112@2x.png') }}" />
          </div>
        </div>
      <!-- fashion section start -->
      <div class="fashion_section">
         <div class="container">
          <div class="row">
            <div class="col-lg-6 col-sm-6">
               <!-- nav options -->
               <ul class="nav nav-pills mb-3 shadow-sm" id="pills-tab" role="tablist">
                   <li class="nav-item sp-tab"> <a class="nav-link active inter-medium-alabaster" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Informasi Saham</a> </li>
                   <li class="nav-item sp-tab"> <a class="nav-link iinter-medium-alabaster" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Detail Saham</a> </li>
                   <li class="nav-item sp-tab"> <a class="nav-link inter-medium-alabaster" id="pills-contact-tab" data-toggle="pill" href="#pills-des" role="tab" aria-controls="pills-des" aria-selected="false">Deskripsi Bisnis</a> </li>
                   <li class="nav-item sp-tab"> <a class="nav-link inter-medium-alabaster" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Kontak</a> </li>
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
                <div class="info-deviden border-1px-cape-cod">
            <div class="pembagian-deviden-1 inter-medium-alabaster-18px">
              <span class="inter-medium-alabaster-18px">Pembagian Deviden</span>
            </div>
            <div class="table-2 border-1px-cape-cod">
              <div class="table-cell-row-1">
                <div class="table-cell">
                  <p class="pembagian-deviden-ta inter-normal-delta-12px">
                    <span class="inter-normal-delta-12px">Pembagian Deviden Tahap I - </span
                    ><span class="inter-normal-delta-12px">08 Jan 2022</span>
                  </p>
                </div>
                <div class="table-cell">
                  <div class="price inter-medium-white-16px">
                    <span class="inter-medium-white-16px">Rp10.000.000</span>
                  </div>
                </div>
              </div>
              <div class="overlap-group-3">
                <img class="divider" src="img/divider-114@2x.png" />
                <div class="table-cell-row">
                  <div class="table-cell">
                    <p class="pembagian-deviden-ta inter-normal-delta-12px">
                      <span class="inter-normal-delta-12px">Pembagian Deviden Tahap II - 08 Aug 2022</span>
                    </p>
                  </div>
                  <div class="table-cell">
                    <div class="price inter-medium-white-16px">
                      <span class="inter-medium-white-16px">Rp10.000.000</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="overlap-group-3">
                <img class="divider" src="img/divider-114@2x.png" />
                <div class="table-cell-row">
                  <div class="table-cell">
                    <p class="pembagian-deviden-ta inter-normal-delta-12px">
                      <span class="inter-normal-delta-12px">Pembagian Deviden Tahap III</span
                      ><span class="inter-normal-delta-12px"> - </span
                      ><span class="inter-medium-delta-12px">08 Jan 2023</span>
                    </p>
                  </div>
                  <div class="table-cell">
                    <div class="price inter-medium-white-16px">
                      <span class="inter-medium-white-16px">Rp10.000.000</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                         
            </div>
        </div>
            
           
            <div class="videoWrapper" style="margin-top: 100px;">
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
                          <div id="owl-demo5" class="owl-carousel owl-theme">
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