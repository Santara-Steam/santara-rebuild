@extends('front_end/template_front_end/app')

@section('content')
<!-- banner bg main start -->
      <div class="banner_bg_main">
        <div class="banner_section layout_padding">
            <div class="container" style="margin-top: 60px">
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
                        <a class="b-daf btn btn-danger btn-lg btn-block" href="{{ route('mulai-investasi.index') }}">Mulai Investasi</a>
                        <a class="b-mul btn btn-light btn-lg btn-block" href="{{ route('daftar-bisnis.index') }}">Daftarkan Bisnis</a>
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
                        <span class="tx-lf inter-bold-alabaster">Now Playing ({{count($now_playing)}})</span>
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
                            <div class="fashion_section_2">
                            <div class="row">
                              @foreach ($now_playing as $np)
                              <?php 
                              $picture = explode(',',$np->pictures);
                              ?>
                              <div id="owl-demo2" class="owl-carousel owl-theme"  style="padding-left: 15px; padding-right: 15px;">
                              <div class="item">
                                <a href="{{ route('now-playing.detail') }}">
                              <div class="card">
                                <img class="rectangle-2" src="https://storage.googleapis.com/asset-santara/santara.co.id/token/{{$picture[0]}}" />
                                <div class="content">
                                  <div class="header-card-dan-progress">
                                    <div class="header-and-tags">
                                      <div class="tags">
                                        <div class="retail-distribusi-logistik inter-medium-sweet-pink-12px">
                                          <span class="tx-t inter-medium-sweet-pink">{{$np->ktg}}</span>
                                        </div>
                                      </div>
                                      <div class="header">
                                        <div class="saka-logistics inter-medium-alabaster-20px">
                                          <span class="tx-pt inter-medium-alabaster"><?php echo \Illuminate\Support\Str::limit(strip_tags( $np->trademark ), 20, $end='...') ?></span>
                                        </div>
                                        <div class="pt-saka-multitrans-nusantara inter-normal-quill-gray-12px">
                                          <span class="tx-np inter-normal-quill-gray"><?php echo \Illuminate\Support\Str::limit(strip_tags( $np->company_name ), 30, $end='...') ?></span>
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
                                          ><span class="tx-sold span-1 inter-bold-white" style="font-weight: bold">Rp {{number_format(round($np->minimum_invest * $np->price,0),0,',','.')}}</span>
                                        </div>
                                        </div>
                                      </div>
                                      <div class="address">
                                        <div  class="hr inter-bold-white-14px">
                                          <span class="tx-sold inter-medium-white"><b style="font-weight: bold">
                                            <?php 
                                              $now = time();
                                              $start = strtotime($np->begin_period);
                                              $end = strtotime($np->end_period);
                                              $datediff = $end - $now;
                                              ?>
                                            {{-- {{abs(strtotime($np->begin_period) - strtotime($np->end_period))}} --}}
                                            {{round($datediff / (60 * 60 * 24))}}
                                          </b></span>
                                        </div>
                                        {{-- {{abs(strtotime($np->begin_period) - strtotime($np->end_period))}} --}}
                                        <span class="inter-normal-mercury-12px">&nbsp;</span>
                                        <div class="hr-lg inter-normal-mercury-14px">
                                          <span class="tx-sold inter-normal-mercury">hari lagi</span>
                                        </div>
                                      </div>
                                      <div class="overlap-group">
                                        <div class="percent inter-medium-white-12px">
                                        <div class="progress-bar " style="width: {{ round((round($np->terjual,0)/round($np->supply))*100,2) }}%; background-color:#bf2d30; border-radius: 8px; height: 16px;" role="progressbar" aria-valuenow="{{ round((round($np->terjual,0)/round($np->supply))*100,2) }}" aria-valuemin="0" aria-valuemax="100">
                                        
                                          <span class="tx-np percen inter-medium-white">
                                            
                                            {{ round((round($np->terjual,0)/round($np->supply))*100,2) }}
                                            
                                            %</span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="footer-card">
                                    <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                                    <div class="footer-card-1">
                                      <div class="total-pendanaan-rp3000000000 inter-normal-mercury-12px">
                                        <span class="inter-normal-quill-gray-12px">Total Pendanaan<br /></span
                                        ><span class="inter-medium-alabaster-12px">Rp{{number_format(round($np->supply*$np->price,0),0,',','.')}}</span>
                                      </div>
                                      <div class="periode-dividen-6-bulan inter-normal-mercury-10px">
                                        <span class="inter-normal-quill-gray-12px">Periode Dividen<br /></span
                                        ><span class="inter-medium-alabaster-12px">{{$np->period}}</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </a>
                              </div>
                        </div>
                          @endforeach
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
                           <div class="col-lg-3 col-sm-3 col-3">
                            <a href="{{ route('coming-soon.detail') }}">
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
                            </a>
                           </div>
                           <div class="col-lg-3 col-sm-3 col-3">
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
                           <div class="col-lg-3 col-sm-3 col-3">
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
                           <div class="col-lg-3 col-sm-3 col-3">
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
                     </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="w3-container w3-red">
                     <div class="fashion_section_2">
                        <div class="fashion_section_2">
                        <div class="row">
                           <div class="col-lg-3 col-sm-3 col-3">
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
                           <div class="col-lg-3 col-sm-3 col-3">
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
                           <div class="col-lg-3 col-sm-3 col-3">
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
                           <div class="col-lg-3 col-sm-3 col-3">
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
                        <span class="tx-lf inter-bold-alabaster">Sold Out ({{count($sold_out)}})</span>
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
                              <div id="owl-demo" class="owl-carousel owl-theme div_main"  style="padding-left: 15px; padding-right: 15px;">
                              @foreach ($sold_out as $item)
                              <?php 
                              $picture = explode(',',$item->pictures);
                              ?>
                              <div class="item">
                                <a href="{{ route('sold-out.detail') }}">
                              <div class="card">
                                <img class="rectangle-2" src="https://storage.googleapis.com/asset-santara/santara.co.id/token/{{$picture[0]}}" />
                                <div class="content">
                                  <div class="header-card-dan-progress-2">
                                    <div class="header-and-tags">
                                      <div class="tags">
                                        <div class="retail-distribusi-logistik inter-medium-sweet-pink-12px">
                                          <span class="tx-t inter-medium-sweet-pink-12px">{{$item->ktg}}</span>
                                        </div>
                                      </div>
                                      <div class="header">
                                        <div class="saka-logistics inter-medium-alabaster-20px">
                                          <span class="tx-pt inter-medium-alabaster"><?php echo \Illuminate\Support\Str::limit(strip_tags( $item->trademark ), 20, $end='...') ?></span>
                                        </div>
                                        <div class="pt-saka-multitrans-nusantara inter-normal-quill-gray-12px">
                                          <span class="tx-np inter-normal-quill-gray"><?php echo \Illuminate\Support\Str::limit(strip_tags( $item->company_name ), 30, $end='...') ?></span>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="info-pendanaan">
                                        <div class="mul inter-normal-mercury-14px">
                                          <span class="tx-sold span-1 inter-normal-quill-gray">Total Pendanaan</span>
                                        </div>
                                      </div>
                                        <div class="addr inter-bold-white-14px">
                                          <span class="tx-sold inter-bold-white" style="font-weight: bold">Rp {{number_format(round($item->supply * $item->price),0,',','.')}}</span>
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
                          @endforeach
                        </div>
                        </div>
                     </div>
                     </div>
                  </div>
               </div>
               
             </div>
            </div>
            <div class="but-pag">
            <a class="carousel-control-prev border-1px-cape-cod inter-medium-alabaster-14px customPreviousBtn" href="#jewellery_main_slider" role="button" data-slide="prev"><i class="fas fa-arrow-left"></i>&nbsp&nbsp Prev
            </a>
            <a class="carousel-control-next border-1px-cape-cod inter-medium-alabaster-14px customNextBtn" href="#jewellery_main_slider" role="button" data-slide="next" >Next &nbsp&nbsp<i class="fas fa-arrow-right"></i>
            </a>
          </div>
         </div>
      </div>
      <!-- jewellery  section end -->



 <div class="footer_section ">
         <div class="container-fluid disclaimer-outer-bg bg-disclaimer ">

          <div class="container disclaimer-inner-bg" style="font-size: 11px;">

            <h4 class="text-danger ff-a fs-16" style="font-size: 16px; font-family: 'acumin-pro'; margin-left: 5px; margin-bottom: -2px">Disclaimer:</h4>
            <div class="row ff-n" style="font-weight: normal;     text-align: justify; margin-right: -15px; font-family: 'Nunito'; font-size: 11px;">
              <p class="mt-2" style="margin-bottom: -10px; color: #fff; font-size: 11px;line-height:1.5;">Pembelian saham bisnis merupakan aktivitas beresiko tinggi. Anda berinvestasi pada bisnis yang mungkin saja mengalami kenaikan dan penurunan kinerja bahkan mengalami kegagalan. Harap menggunakan pertimbangan ekstra dalam membuat keputusan untuk membeli saham. Ada kemungkinan Anda tidak bisa menjual kembali saham bisnis dengan cepat. Lakukan diversifikasi investasi, hanya gunakan dana yang siap Anda lepaskan (affors to loose) dan atau disimpan dalam jangka panjang. Santara tidak memaksa pengguna untuk membeli saham bisnis sebagai investasi. Semua keputusan pembelian merupakan keputusan independen oleh pengguna.
              </p>
              <p style="margin-bottom: -10px; color: #fff; font-size: 11px;line-height:1.5; "; >
                Santara bertindak sebagai penyelenggara urun dana yang mempertemukan pemodal dan penerbit, bukan sebagai pihak yang menjalankan bisnis (Penerbit). Otoritas Jasa Keuangan bertindak sebagai regulator dan pemberi izin, bukan sebagai penjamin investasi. Keputusan pembelian saham, sepenuhnya merupakan hak dan tanggung jawab Pemodal (investor). Dengan membeli saham di Santara berarti Anda sudah menyetujui seluruh syarat dan ketentuan serta memahami semua risiko investasi termasuk resiko kehilangan sebagian atau seluruh modal.
              </p>
              <p style="margin-bottom: -10px;color: #fff; font-size: 11px; line-height:1.5; ">
                “OTORITAS JASA KEUANGAN TIDAK MEMBERIKAN PERNYATAAN MENYETUJUI ATAU TIDAK MENYETUJUI EFEK INI, TIDAK JUGA MENYATAKAN KEBENARAN ATAU KECUKUPAN INFORMASI DALAM LAYANAN URUN DANA INI. SETIAP PERNYATAAN YANG BERTENTANGAN DENGAN HAL TERSEBUT ADALAH PERBUATAN MELANGGAR HUKUM.”
              </p>
              <p style="margin-bottom: -10px;color: #fff; font-size: 11px;  line-height:1.5;">
                “INFORMASI DALAM LAYANAN URUN DANA INI PENTING DAN PERLU MENDAPAT PERHATIAN SEGERA. APABILA TERDAPAT KERAGUAN PADA TINDAKAN YANG AKAN DIAMBIL, SEBAIKNYA BERKONSULTASI DENGAN PENYELENGGARA.”
              </p>
              <p style="margin-bottom: -10px;color: #fff; font-size: 11px; line-height:1.5; ">
                “PENERBIT DAN PENYELENGGARA, BAIK SENDIRI-SENDIRI MAUPUN BERSAMA-SAMA, BERTANGGUNG JAWAB SEPENUHNYA ATAS KEBENARAN SEMUA INFORMASI YANG TERCANTUM DALAM LAYANAN URUN DANA INI.”
              </p>
            </div>
          </div>

        </div>
      </div>
@endsection