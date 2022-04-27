@extends('front_end/template_front_end/app')

@section('content')
 <link rel="stylesheet" href="{{ asset('public/assets/css/tabs.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset('public/new-santara/css/now-playing-detail.css') }}" />
 <?php 
                              $picture = explode(',',$emt->pictures);
                              if(empty($picture[0])){
                              $picture[0] = 'default1.png';
                              }else{
                                  $picture[0];
                              }
                              if(empty($picture[1])){
                                  $picture[1] = 'default2.png';
                              }else{
                                  $picture[1];
                              }
                              if(empty($picture[2])){
                                  $picture[2] = 'default.png';
                              }else{
                                  $picture[2];
                              }
                              if(empty($picture[3])){
                                  $picture[3] = 'default.png';
                              }else{
                                  $picture[3];
                              }
                              if(empty($picture[4])){
                                  $picture[4] = 'default.png';
                              }else{
                                  $picture[4];
                              }
                              if(empty($picture[5])){
                                  $picture[5] = 'default.png';
                              }else{
                                  $picture[5];
                              }
                              if(empty($picture[6])){
                                  $picture[6] = 'default1.png';
                              }else{
                                  $picture[6];
                              }
                              ?>
<div class="banner_bg_main" style="background-image: url(https://storage.googleapis.com/asset-santara/santara.co.id/token/{{$picture[1]}}); margin-top: 96px;">
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
          {{-- <div class="tags-d"> --}}
            <span class="tx-t inter-medium-sweet-pink-14px"
                                  style="font-size:16px;background: var(--falu-red);
    border-radius: 10px; box-shadow: 10px 0 0 var(--falu-red), 0px 0 0 var(--falu-red); line-height : 20px; padding-left:10px;">{{$emt->ctg->category}}</span>
          {{-- </div> --}}
        </div>
        <div class="profil">
          <img style="border-radius: 50%;" class="image-69"
            src="https://storage.googleapis.com/asset-santara/santara.co.id/token/{{$picture[2]}}" />
          <div class="pemilik-bisnis">
            <div class="m-khemal-nugroho inter-medium-alabaster-18px">
              <span class="text-mulai inter-medium-alabaster">{{$emt->owner_name}}</span>
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

        <div class="container mt-5">

            <div class="row">
                <div class="col-lg-12">
                    <div class="np-timeline" style="box-shadow: 0 3px 2px -2px #404040; min-height: 150px;">
                        <ul class="timeline d-flex justify-content-evenly">
                          @if(is_null($tmpra))
                              <li class="" data-bs-toggle="tooltip" data-bs-placement="top" title="">
                              <div class="timeline-caption">
                                <p class="timeline-text">Pra Penawaran Saham
                              </div>
                              <div class="timeline-caption"> <p class="timeline-text"></div>
                              </li>
                              @else
                              <li class="active-tl" data-bs-toggle="tooltip" data-bs-placement="top" title="{{date('d M Y', strtotime($tmpra->date))}}">
                              <div class="timeline-caption">
                                <p class="timeline-text">Pra Penawaran Saham
                              </div>
                              <div class="timeline-caption"><p class="timeline-text">{{date('d-m-Y', strtotime($tmpra->date))}}</div>
                              </li>
                            @endif
                            @if(is_null($tmpen))
                              <li class="" data-bs-toggle="tooltip" data-bs-placement="top" title="">
                              <div class="timeline-caption">
                                <p class="timeline-text">Penawaran Saham
                              </div>
                              <div class="timeline-caption"> <p class="timeline-text"></div>
                              </li>
                              @else
                              <li class="active-tl" data-bs-toggle="tooltip" data-bs-placement="top" title="{{date('d M Y', strtotime($tmpen->date))}}">
                              <div class="timeline-caption">
                                <p class="timeline-text">Penawaran Saham
                              </div>
                              <div class="timeline-caption"><p class="timeline-text">{{date('d-m-Y', strtotime($tmpen->date))}}</div>
                              </li>
                            @endif
                            @if(is_null($tmpd))
                              <li class="" data-bs-toggle="tooltip" data-bs-placement="top" title="">
                              <div class="timeline-caption">
                                <p class="timeline-text">Pendanaan Terpenuhi
                              </div>
                              <div class="timeline-caption"> <p class="timeline-text"></div>
                              </li>
                              @else
                              <li class="active-tl" data-bs-toggle="tooltip" data-bs-placement="top" title="{{date('d M Y', strtotime($tmpd->date))}}">
                              <div class="timeline-caption">
                                <p class="timeline-text">Pendanaan Terpenuhi
                              </div>
                              <div class="timeline-caption"><p class="timeline-text">{{date('d-m-Y', strtotime($tmpd->date))}}</div>
                              </li>
                            @endif
                            @if(is_null($tmpyd))
                              <li class="" data-bs-toggle="tooltip" data-bs-placement="top" title="">
                              <div class="timeline-caption">
                                <p class="timeline-text">Penyerahan Dana
                              </div>
                              <div class="timeline-caption"> <p class="timeline-text"></div>
                              </li>
                              @else
                              <li class="active-tl" data-bs-toggle="tooltip" data-bs-placement="top" title="{{date('d M Y', strtotime($tmpyd->date))}}">
                              <div class="timeline-caption">
                                <p class="timeline-text">Penyerahan Dana
                              </div>
                              <div class="timeline-caption"><p class="timeline-text">{{date('d-m-Y', strtotime($tmpyd->date))}}</div>
                              </li>
                            @endif
                            @if(is_null($tm))
                              <li class="" data-bs-toggle="tooltip" data-bs-placement="top" title="">
                              <div class="timeline-caption">
                                <p class="timeline-text">Pembagian Dividen
                              </div>
                              <div class="timeline-caption"> <p class="timeline-text"></div>
                              </li>
                              @else
                              <li class="active-tl" data-bs-toggle="tooltip" data-bs-placement="top" title="{{date('d M Y', strtotime($tm->date))}}">
                              <div class="timeline-caption">
                                <p class="timeline-text">Pembagian Dividen
                              </div>
                              <div class="timeline-caption"><p class="timeline-text">{{date('d-m-Y', strtotime($tm->date))}}</div>
                              </li>
                            @endif
                       </ul>
                    </div>
                </div>
            </div>
          </div>
            <hr>
      <!-- fashion section start -->
      <div class="fashion_section">
         <div class="container">
          <div class="row">
          <div class="col-lg-6 col-sm-6">
        <!-- nav options -->
        <ul class="nav nav-pills mb-3 shadow-sm" id="pills-tab" role="tablist">
          <li class="nav-item sp-tab"> <a class="nav-link inter-medium-delta active show" id="pills-home-tab"
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
          <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            {{-- <div class="table-row-1">
              <span class="inter-medium-delta-16px">Saham Tersisa : 100</span>
            </div>
            <div class="table-row">
              <span class="inter-medium-delta-16px">Dalam Lembar : 100</span>
            </div>
            <div class="table-row">
              <span class="inter-medium-delta-16px">Total Rupiah : 100</span>
            </div> --}}
            <div class="row">
              <div class="col-6">
                <table style="color: var(--delta);
                font-family: var(--font-family-inter);
                font-size: var(--font-size-l);
                font-style: normal;
                font-weight: 500;">
                  <tr style="font-size:14px; ">
                    <td>Saham Tersisa  
                    <br>
                      <span style="font-weight:bold; line-height:3;">
                      @if ($emt->avg_capital_needs < 0)
                      {{number_format(round((($emt->avg_capital_needs-$bok->tot)/$emt->avg_capital_needs)*100,0),0,',','.')}}%
                      @else
                        0,00%
                      @endif
                      </span>
                    </td> 
                  </tr>
                  <tr style="font-size:14px;">
                    <td>Dalam Lembar <br>
                    <span style="font-weight:bold; line-height:3;"> 
                    @if ($emt->price < 0)
                    {{number_format(round(($emt->avg_capital_needs-$bok->tot)/$emt->price,0),0,',','.')}} Lembar
                    @else
                       0 Lembar
                    @endif
                    </span>
                    </td>
                  </tr>
                  <tr style="font-size:14px;">
                    <td>Total Rupiah <br>
                    <span style="font-weight:bold; line-height:3;"> 
                    @if ($emt->avg_capital_needs-$bok->tot > 0)
                    Rp{{number_format(round(($emt->avg_capital_needs-$bok->tot),0),0,',','.')}}
                    @else
                       Rp 0
                    @endif
                  </span>
                  </td>
                  </tr>
                </table>
              </div>
              <div class="col-6">
                <table style="color: var(--delta);
                font-family: var(--font-family-inter);
                font-size: var(--font-size-l);
                font-style: normal;
                font-weight: 500;">
                  <tr style="font-size:14px;">
                    <td>Saham Terjual <br>
                    <span style="font-weight:bold; line-height:3;">
                    @if ($emt->avg_capital_needs < 0)
                    {{number_format(round(($bok->tot/$emt->avg_capital_needs)*100,0),0,',','.')}}%
                    @else
                       100%
                    @endif 
                  </span>
                  </td>
                  </tr>
                  <tr style="font-size:14px;">
                    <td>Dalam Lembar <br> 
                    <span style="font-weight:bold; line-height:3;">
                    {{number_format(round($bok->tot/$emt->price,0),0,',','.')}} Lembar
                    </span>
                    </td>
                  </tr>
                  <tr style="font-size:14px;">
                    <td>Dalam Rupiah<br> 
                    <span style="font-weight:bold; line-height:3;">
                    Rp{{number_format(round($bok->tot,0),0,',','.')}}
                    </span>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div> <!-- 2nd card -->
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="row">
              <div class="col-6">
                <table style="color: var(--delta);
                font-family: var(--font-family-inter);
                font-size: var(--font-size-l);
                font-style: normal;
                font-weight: 500;">
                  <tr style="font-size:14px;">
                    <td>Harga Saham <br> 
                    <span style="font-weight:bold; line-height:3;">
                    Rp{{number_format(round($emt->price,0),0,',','.')}}
                    </span>
                  </td>
                  </tr>
                  <tr style="font-size:14px;">
                    <td>Total Saham <br> 
                    <span style="font-weight:bold; line-height:3;">
                    {{number_format(round($emt->avg_capital_needs / $emt->price,0),0,',','.')}} Lembar
                    </span>
                  </td>
                  </tr>
                  <tr style="font-size:14px;">
                    <td>Total Saham (Rp) <br> 
                    <span style="font-weight:bold; line-height:3;">
                    Rp{{number_format(round($emt->avg_capital_needs,0),0,',','.')}}
                      </span>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="col-6">
                <table style="color: var(--delta);
                font-family: var(--font-family-inter);
                font-size: var(--font-size-l);
                font-style: normal;
                font-weight: 500;">
                  <tr style="font-size:14px;">
                    <td>Kode Saham <br> 
                    <span style="font-weight:bold; line-height:3;">
                    {{$emt->code_emiten}}
                      </span>
                    </td>
                  </tr>
                  <tr style="font-size:14px;">
                    <td>Sisa Waktu <br> 
                    <span style="font-weight:bold; line-height:3;">
                    <?php 
                      $now = time();
                      $start = strtotime($status->date);
                      $end = strtotime($status->end_date);
                      $datediff = $end - $now;
                      $dt = ($datediff / (60 * 60 * 24));
                    ?>
                    @if ($dt < 0)
                    0 Hari
                    @else
                    {{round($datediff / (60 * 60 * 24))}} Hari
                    @endif 
                    </span>
                    </td>
                  </tr>
                  <tr style="font-size:14px;">
                    <td>Periode Deviden<br> 
                    <span style="font-weight:bold; line-height:3;">
                    6 Bulan
                    </span>
                  </td>
                  </tr>
                </table>
              </div>
            </div>
          </div> <!-- 3nd card -->
          <!-- 2nd card -->
          <div class="tab-pane fade" id="pills-des" role="tabpanel" aria-labelledby="pills-des-tab">
            <div class="table-row-1">
              <span class="inter-medium-delta-14px" style="text-align: justify;">{{$emt->business_description}}</span>
            </div>
          </div> <!-- 3nd card -->
          <!-- 2nd card -->
          <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
            <div class="table-row-1">
              <span class="inter-medium-delta-14px">Instagram <br>
                <span style="font-weight:bold; line-height:3;">
                {{$emt->instagram}}
              </span>
            </span>
            </div>
            <div class="table-row">
            <span class="inter-medium-delta-14px">Facebook <br>
                <span style="font-weight:bold; line-height:3;">
                {{$emt->facebook}}
              </span>
            </span>
            </div>
            <div class="table-row">
            <span class="inter-medium-delta-14px">Website <br>
                <span style="font-weight:bold; line-height:3;">
                {{$emt->website}}
              </span>
            </span>
            </div>
          </div> <!-- 3nd card -->
        </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="info-deviden border-1px-cape-cod">
            <div class="pembagian-deviden-1 inter-medium-alabaster-18px">
              <span class="inter-medium-alabaster-18px">Pembagian Deviden</span>
            </div>
            <div class="table-2 border-1px-cape-cod" style="width: 90%; height: 100%;">
              <div class="table-cell-row-1">
                <div class="table-cell">
                  <p class="pembagian-deviden-ta inter-normal-delta-12px">
                    <span class="inter-normal-delta-12px">Pembagian Deviden Tahap I - </span
                    ><span class="inter-normal-delta-12px">
                      @if(is_null($dv))  
                      
                      @else
                      {{date('d M Y', strtotime($dv->devidend_date))}}
                      @endif</span>
                  </p>
                </div>
                <div class="table-cell">
                  <div class=" inter-medium-white-14px">
                    <span class="inter-medium-white-14px">
                  @if(is_null($dv))  
                  Rp0
                  @else
                  Rp{{number_format(round($dv->devidend),0,',','.')}}
                  @endif</span>
                  </div>
                </div>
              </div>
              <div class="overlap-group-3">
                <img class="divider" src="img/divider-114@2x.png" />
                <div class="table-cell-row">
                  <div class="table-cell">
                    <p class="pembagian-deviden-ta inter-normal-delta-12px">
                      <span class="inter-normal-delta-12px">Pembagian Deviden Tahap II - 
                      @if(is_null($dv2))  
                      
                      @else
                      {{date('d M Y', strtotime($dv2->devidend_date))}}
                      @endif
                      </span>
                    </p>
                  </div>
                  <div class="table-cell">
                    <div class=" inter-medium-white-14px">
                      <span class="inter-medium-white-14px">
                      @if(is_null($dv2))  
                      Rp0
                      @else
                      Rp{{number_format(round($dv2->devidend),0,',','.')}}
                      @endif
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="overlap-group-3">
                <img class="divider" src="img/divider-114@2x.png" />
                <div class="table-cell-row">
                  <div class="table-cell">
                    <p class="pembagian-deviden-ta inter-normal-delta-12px">
                      <span class="inter-normal-delta-12px">Pembagian Deviden Tahap III - 
                      @if(is_null($dv3))  
                      
                      @else
                      {{date('d M Y', strtotime($dv3->devidend_date))}}
                      @endif  
                      </span
                      >
                    </p>
                  </div>
                  <div class="table-cell">
                    <div class=" inter-medium-white-14px">
                      <span class="inter-medium-white-14px">
                      @if(is_null($dv3))  
                      Rp0
                      @else
                      Rp{{number_format(round($dv3->devidend),0,',','.')}}
                      @endif
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                         
            </div>
        </div>
            
           
        @if ($emt->video_url == null)

        @else
        <div class="videoWrapper" style="margin-top: 100px;">
          <!-- Copy & Pasted from YouTube -->
          <iframe width="560" height="349" src="{{$emt->video_url}}" frameborder="0"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        @endif
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
                  @if ($picture[3] == 'default.png')

                  @else
                  <div class="item">
                    <img class="rectangle-2" src="https://storage.googleapis.com/asset-santara/santara.co.id/token/{{$picture[3]}}" />
                  </div>
                  @endif
                  @if ($picture[4] == 'default.png')

                  @else
                  <div class="item">
                    <img class="rectangle-2" src="https://storage.googleapis.com/asset-santara/santara.co.id/token/{{$picture[4]}}" />
                  </div>
                  @endif
                  @if ($picture[5] == 'default.png')

                  @else
                  <div class="item">
                    <img class="rectangle-2" src="https://storage.googleapis.com/asset-santara/santara.co.id/token/{{$picture[5]}}" />
                  </div>
                  @endif

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