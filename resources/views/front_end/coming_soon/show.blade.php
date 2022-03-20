@extends('front_end/template_front_end/app')

@section('content')
<?php 
                              $picture = explode(',',$emt->pictures);
                              ?>
<link rel="stylesheet" href="{{ asset('public/assets/css/tabs.css') }}">

<div class="bg" style="background-image: url({{ asset('public/upload') }}/{{$picture[1]}})">
  <div class="banner_section layout_padding">
    <div class="container" style="margin-top: 15px;">
      <div class="section">
        <div class="heading-and-tag">
          <div class="hheader-dan-supporting-text">
            <div class="fruters-indonesia inter-bold-alabaster-48px">
              <span class="text-urun inter-bold-alabaster">{{$emt->trademark}}</span>
            </div>
            <div class="pt-fruters-indonesia-perkasa inter-medium-alabaster-18px">
              <span class="tx-pt inter-medium-alabaster">{{$emt->company_name}}</span>
            </div>
          </div>
          <div class="tags-d">
            <div class="food-and-beverage inter-medium-sweet-pink-14px">
              <span class="tx-rg inter-medium-sweet-pink-14px">{{$emt->ctg->category}}</span>
            </div>
          </div>
        </div>
        <div class="profil">
          <img class="image-69" src="https://storage.googleapis.com/asset-santara/santara.co.id/images/error/no-image-user-small.png" />
          <div class="pemilik-bisnis">
            <div class="m-khemal-nugroho inter-medium-alabaster-18px">
              <span class="text-mulai inter-medium-alabaster">{{$emt->tr->name}}</span>
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
          <li class="nav-item sp-tab"> <a class="nav-link active inter-medium-delta" id="pills-home-tab"
              data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Informasi
              Saham</a> </li>
          <li class="nav-item sp-tab"> <a class="nav-link inter-medium-delta" id="pills-profile-tab" data-toggle="pill"
              href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Detail Saham</a>
          </li>
          <li class="nav-item sp-tab"> <a class="nav-link inter-medium-delta" id="pills-contact-tab" data-toggle="pill"
              href="#pills-des" role="tab" aria-controls="pills-des" aria-selected="false">Deskripsi Bisnis</a> </li>
          <li class="nav-item sp-tab"> <a class="nav-link inter-medium-delta" id="pills-contact-tab" data-toggle="pill"
              href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Kontak</a> </li>
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
          </div> <!-- 3nd card -->
          <!-- 2nd card -->
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
            <span class="inter-medium-alabaster-18px">Informasi Bisnis:</span>
          </div>
          <div class="table-2">
            <div class="table-cell-row-1">
              <div class="table-cell">
                <p class="pembagian-deviden-ta inter-normal-delta-12px">
                  <span class="inter-normal-delta-12px">Saham yang dilepas</span><br><span
                    class="inter-normal-delta-12px" style="font-weight: bold; color: #fff">{{$emt->}}%</span>
                </p>
              </div>
              <div class="table-cell">
                <p class="pembagian-deviden-ta inter-normal-delta-12px">
                  <span class="inter-normal-delta-12px">Perkiraan omzet penerbit</span><br><span
                    class="inter-normal-delta-12px" style="font-weight: bold; color: #fff">10.000.000.000</span>
                </p>
              </div>
            </div>
            <div class="overlap-group-3">
              <div class="table-cell-row">
                <div class="table-cell">
                  <p class="pembagian-deviden-ta inter-normal-delta-12px">
                    <span class="inter-normal-delta-12px">Perkiraan Dividen</span><br><span
                      class="inter-normal-delta-12px" style="font-weight: bold; color: #fff">30%</span>
                  </p>
                </div>
                <div class="table-cell">
                  <p class="pembagian-deviden-ta inter-normal-delta-12px">
                    <span class="inter-normal-delta-12px">Dana yang dibutuhkan</span><br><span
                      class="inter-normal-delta-12px" style="font-weight: bold; color: #fff">5.000.000.000</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="overlap-group-3">
              <img class="divider" src="img/divider-114@2x.png" />
              <div class="table-cell-row">
                <div class="table-cell">
                  <p class="pembagian-deviden-ta inter-normal-delta-12px">
                    <span class="inter-normal-delta-12px" style="white-space: nowrap;">Omzet 2 tahun
                      sebelumnya</span><br><span class="inter-normal-delta-12px">2020:</span><br><span
                      class="inter-medium-delta-12px" style="font-weight: bold; color: #fff">9.800.000.000</span>
                  </p>
                </div>
                <div class="table-cell" style="margin-top: 10px;">
                  <p class="pembagian-deviden-ta inter-normal-delta-12px">
                    <span class="inter-normal-delta-12px">2021:</span><br><span class="inter-normal-delta-12px"
                      style="font-weight: bold; color: #fff">5.000.000.000</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="actions-com">
      <div class="button-5">
        <img class="icon-com" src="{{ asset('public/assets/images/icon-heart-47@2x.png') }}" />&ensp;
        <div class="address-1 inter-medium-eerie-black-14px">
          <span class="tx-icon inter-medium-eerie-black ">
            <p class="tx-icon">82 </p>
            <p class="com-u">&ensp;Likes</p>
          </span>
        </div>
      </div>
      <div class="button-5">
        <img class="ico-comn" src="{{ asset('public/assets/images/icon-user-47@2x.png') }}" />&ensp;
        <div class="address-1 inter-medium-eerie-black-14px">
          <span class="tx-icon inter-medium-eerie-black">
            <p class="tx-icon">197 </p>
            <p class="com-u">&ensp;Minat</p>
          </span>
        </div>
      </div>
      <div class="button-5">
        <img class="icon-com" src="{{ asset('public/assets/images/icon-message-circle-47@2x.png') }}" />&ensp;
        <div class="address-1 inter-medium-eerie-black-14px">
          <span class="tx-icon inter-medium-eerie-black">
            <p class="tx-icon">18 </p>
            <p class="com-u">&ensp;Komen</p>
          </span>
        </div>
      </div>
      <div class="button-5">
        <img class="icon-com" src="{{ asset('public/assets/images/icon-share-2-47@2x.png') }}" />&ensp;
        <div class="address-1 inter-medium-eerie-black-14px">
          <span class="tx-icon inter-medium-eerie-black">
            <p class="com-u">&ensp;Share</p>
          </span>
        </div>
      </div>
    </div>
    <div class="videoWrapper" style="margin-top: 100px;">
      <!-- Copy & Pasted from YouTube -->
      <iframe width="560" height="349" src="https://www.youtube.com/embed/tgbNymZ7vqY" frameborder="0"
        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
                <div id="owl-demo6" class="owl-carousel owl-theme">
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