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
            <span class="text-sb inter-normal-alabaster">Platform Equity Crowdfunding pertama yang berizin dan diawasi
              Otoritas Jasa Keuangan berdasarkan Surat Keputusan Nomor:
              KEP-59/D.04/2019.</span>
          </div>
        </div>
        <div class="actions">
          <a class="b-daf btn btn-danger btn-lg btn-block" href="{{ route('mulai-investasi.index') }}">Mulai
            Investasi</a>
          <a class="b-mul btn btn-light btn-lg btn-block" href="{{ route('daftar-bisnis.index') }}">Daftarkan Bisnis</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- banner bg main end -->
<!-- fashion section start -->
<div class="fashion_section" style="margin-top: -70px;">
  <div id="jewellery_main_slider" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="title-dan-link-button-1 w3-red">
        <div class="now-playing inter-bold-alabaster-24px">
          <span class="tx-lf inter-bold-alabaster">Now Playing ({{count($now_playing)}})</span>
        </div>
        <div class="investasi-sekarang inter-bold-thunderbird-16px button-4 seemore">
          <a data-toggle="modal" data-target="#exampleModal" class="tx-rg inter-bold-white">Lihat Semua
            &nbsp&nbsp<i class="fas fa-arrow-right"></i></a>
        </div>
      </div>

      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="w3-container w3-red">
            <div class="fashion_section_2">
              <div class="fashion_section_2">
                <div class="row">
                  <div id="owl-demo2" class="owl-carousel owl-theme" style="padding-left: 15px; padding-right: 15px;">
                    @foreach ($now_playing as $np)
                    <?php 
                              $picture = explode(',',$np->pictures);
                              ?>
                    <div class="item">

                      <?php 
                        // $mul=number_format(round($np->minimum_invest * $np->price,0),0,',','.');
                        // $prog=round((round($np->terjual,0)/round($np->supply))*100,2);
                        // $pend=number_format(round($np->supply*$np->price,0),0,',','.');
                        // $now = time();
                        // $start = strtotime($np->begin_period);
                        // $end = strtotime($np->end_period);
                        // $datediff = $end - $now;
                        // $har=round($datediff / (60 * 60 * 24));
                        ?>
                      {{-- {{abs(strtotime($np->begin_period) - strtotime($np->end_period))}} --}}

                      {{-- {{abs(strtotime($np->begin_period) - strtotime($np->end_period))}} --}}

                      <a type="button" data-toggle="modal" id="detail_now" class="mod_now detail_now moldla"
                        style="width: 100%;" data-target="#modal_now" {{-- data-ktg="<?=$np->ktg?>"
                        data-trademark_now="<?=$np->trademark?>" data-company_name_now="<?=$np->company_name?>"
                        data-mulai="<?=$mul?>" data-image_now="<?=$picture[0]?>" data-hari="<?=$har?>"
                        data-progres_now="<?=$prog?>" data-tot_pendanaan="<?=$pend?>"
                        data-periode_dividen="<?=$np->period?>" --}}>
                        <div class="card moldla">
                          <img class="rectangle-2 moldla"
                            src="{{ asset('public/storage/pictures') }}/{{$picture[0]}}" />
                        </div>
                      </a>
                      <a class="molpli" data-toggle="modal" data-target="#exampleModal">
                      <div class="card molpli">
                          <img class="rectangle-2"
                            src="{{ asset('public/storage/pictures') }}/{{$picture[0]}}" />
                          <div class="content">
                            <div class="header-card-dan-progress">
                              <div class="header-and-tags">
                                <span class="tx-t inter-medium-sweet-pink-12px"
                                  style="background: var(--falu-red);
    border-radius: 10px; box-shadow: 10px 0 0 var(--falu-red), 0px 0 0 var(--falu-red); line-height : 20px; padding-left:10px;">{{$np->ktg}}</span>
                                <div class="header">
                                  <div class="saka-logistics inter-medium-alabaster-20px">
                                    <span class="tx-pt inter-medium-alabaster">
                                      <?php echo \Illuminate\Support\Str::limit(strip_tags( $np->trademark ), 20, $end='...') ?>
                                    </span>
                                  </div>
                                  <div class="pt-saka-multitrans-nusantara inter-normal-quill-gray-12px">
                                    <span class="tx-np inter-normal-quill-gray">
                                      <?php echo \Illuminate\Support\Str::limit(strip_tags( $np->company_name ), 30, $end='...') ?>
                                    </span>
                                  </div>
                                </div>
                              </div>
                              <div class="info-dan-progress">
                                <div class="info-pendanaan">
                                  <div class="mulai-rp1000000 inter-normal-mercury-14px">
                                    <span class="tx-sold span-1 inter-normal-mercury">Mulai &nbsp;<span
                                        class="tx-sold span-1 inter-bold-white-14px" style="font-weight: bold">Rp
                                        {{number_format(round(1000 * $np->price,0),0,',','.')}}</span> </span>
                                  </div>
                                </div>
                                <div class="address">
                                  <div class="hr inter-bold-white-14px">
                                    <span class="tx-sold inter-medium-white"><b style="font-weight: bold">
                                        {{--
                                        <?php 
                                              $now = time();
                                              $start = strtotime($np->begin_period);
                                              $end = strtotime($np->end_period);
                                              $datediff = $end - $now;
                                              ?>
                                        {{round($datediff / (60 * 60 * 24))}} --}}
                                        {{-- {{abs(strtotime($np->begin_period) - strtotime($np->end_period))}} --}}

                                      </b></span>
                                  </div>
                                  {{-- {{abs(strtotime($np->begin_period) - strtotime($np->end_period))}} --}}
                                  <span class="inter-normal-mercury-12px">&nbsp;</span>
                                  <div class="hr-lg inter-normal-mercury-14px">
                                    <span class="tx-sold inter-normal-mercury">40 hari lagi</span>
                                  </div>
                                </div>
                                <div class="overlap-group">
                                  <div class="percent inter-medium-white-12px">
                                    {{-- <div class="progress-bar "
                                      style="width: {{ round((round($np->terjual,0)/round($np->supply))*100,2) }}%; background-color:#bf2d30; border-radius: 8px; height: 16px;"
                                      role="progressbar"
                                      aria-valuenow="{{ round((round($np->terjual,0)/round($np->supply))*100,2) }}"
                                      aria-valuemin="0" aria-valuemax="100"> --}}
                                      <div class="progress-bar "
                                        style="width: 0%; background-color:#bf2d30; border-radius: 8px; height: 16px;"
                                        role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">

                                        <span class="tx-np percen inter-medium-white">

                                          {{-- {{ round((round($np->terjual,0)/round($np->supply))*100,2) }} --}}
                                          0
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
                                    <span class="inter-normal-quill-gray-12px">Total Pendanaan<br /></span><span
                                      class="inter-medium-alabaster-12px">Rp{{number_format(round($np->supply*$np->price,0),0,',','.')}}</span>
                                  </div>
                                  <div class="periode-dividen-6-bulan inter-normal-mercury-10px">
                                    <span class="inter-normal-quill-gray-12px">Periode Dividen<br /></span><span
                                      class="inter-medium-alabaster-12px">6</span>
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
      <a class="carousel-control-prev border-1px-cape-cod inter-medium-alabaster-14px customPreviousBtn2"
        href="#jewellery_main_slider" role="button" data-slide="prev"><i class="fas fa-arrow-left"></i>&nbsp&nbsp Prev
      </a>
      <a class="carousel-control-next border-1px-cape-cod inter-medium-alabaster-14px customNextBtn2"
        href="#jewellery_main_slider" role="button" data-slide="next">Next &nbsp&nbsp<i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </div>
</div>
<!-- fashion section end -->
<!-- electronic section start -->
<div class="fashion_section">
  <div id="jewellery_main_slider" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="title-dan-link-button-1 w3-red">
        <div class="now-playing inter-bold-alabaster-24px">
          <span class="tx-lf inter-bold-alabaster">Coming Soon ({{count($soon)}})</span>
        </div>
        <div class="investasi-sekarang inter-bold-thunderbird-16px button-4 seemore">
          <a href="{{ route('coming-soon.index') }}" class="tx-rg inter-bold-white">Lihat Semua
            &nbsp&nbsp<i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="w3-container w3-red">
            <div class="fashion_section_2">
              <div class="fashion_section_2">
                <div class="row">
                  <div id="owl-demo3" class="owl-carousel owl-theme" style="padding-left: 15px; padding-right: 15px;">
                    @foreach ($soon as $cs)
                    <?php 
                              $picture = explode(',',$cs->pictures);
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

                    <div class="item">
                      <a type="button" data-toggle="modal" id="detail" class="mod moldla" style="width: 100%;"
                        data-target="#exampleModalCenter" data-category="<?=$cs->ctg->category?>"
                        data-trademark="<?=$cs->trademark?>" data-company_name="<?=$cs->company_name?>"
                        data-like="<?=$cs->likes?>" data-minat="<?=$cs->vot?>" data-comment="<?=$cs->cmt?>"
                        data-id="<?=$cs->id?>" data-trdlike="<?=$cs->trdlike?>" data-trdvot="<?=$cs->trdvot?>"
                        data-image="<?=$picture[0]?>">
                        <div class="card moldla">
                          <img class="rectangle-2 moldla" src="{{ asset('public/storage/pictures') }}/{{$picture[0]}}" />
                        </div>
                      </a>
                      <a href="{{ url('detail-coming-soon') }}/{{$cs->id}}" class="molpli">
                        <div class="card molpli">
                          <img class="rectangle-2" src="{{ asset('public/storage/pictures') }}/{{$picture[0]}}" />
                          <div class="content">
                            <div class="header-card-dan-progress">
                              <div class="header-and-tags">
                                <span class="tx-t inter-medium-sweet-pink-12px"
                                  style="background: var(--falu-red);
    border-radius: 10px; box-shadow: 10px 0 0 var(--falu-red), 0px 0 0 var(--falu-red); line-height : 20px; padding-left:10px;">{{$cs->ctg->category}}</span>
                                <div class="header">
                                  <div class="saka-logistics inter-medium-alabaster-20px">
                                    <span class="tx-pt inter-medium-alabaster">{{$cs->trademark}}</span>
                                  </div>
                                  <div class="pt-saka-multitrans-nusantara inter-normal-quill-gray-12px">
                                    <span class="tx-np inter-normal-quill-gray">{{$cs->company_name}}</span>
                                  </div>
                                </div>
                              </div>
                              <div class="icon-card row">
                                @guest
                                <a href="{{route('login')}}" style="cursor: pointer">
                                  <div class="icon-and-supporting-text">
                                    <i class="icon-com iconheart fas fa-heart"
                                      style="color: #fff; font-size: 18px;"></i>
                                    <div class="address-2 inter-normal-alabaster-10px">
                                      <span class="tx-icon inter-normal-alabaster">{{$cs->likes}} Suka</span>
                                    </div>
                                  </div>
                                </a>
                                @else
                                @if (in_array(Auth::user()->trader->id,[$cs->trdlike]))

                                <a onclick="document.getElementById('sublike{{$cs->id}}').submit();"
                                  style="cursor: pointer">
                                  @else
                                  <a onclick="document.getElementById('like{{$cs->id}}').submit();"
                                    style="cursor: pointer">
                                    @endif

                                    {{-- <a onclick="document.getElementById('like{{$cs->id}}').submit();"
                                      style="cursor: pointer"> --}}
                                      <div class="icon-and-supporting-text">
                                        <i class="icon-com iconheart fas fa-heart"
                                          style="color: #fff; font-size: 18px;"></i>
                                        <div class="address-2 inter-normal-alabaster-10px">
                                          <span class="tx-icon inter-normal-alabaster">{{$cs->likes}} Suka</span>
                                        </div>
                                      </div>
                                    </a>
                                    <form id="like{{$cs->id}}" action="{{url('addLike')}}/{{$cs->id}}" method="POST"
                                      enctype="multipart/form-data">
                                      {{ csrf_field() }}
                                    </form>

                                    <form id="sublike{{$cs->id}}" action="{{url('subLike')}}/{{$cs->id}}" method="POST"
                                      enctype="multipart/form-data">
                                      {{ csrf_field() }}
                                    </form>
                                    @endguest



                                    @guest
                                    <a href="{{route('login')}}" style="cursor: pointer">
                                      <div class="icon-and-supporting-text-1">
                                        <i class="icon-com iconheart fas fa-user"
                                          style="color: #fff; font-size: 18px;"></i>
                                        <div class="address-5 inter-normal-alabaster-10px">
                                          <span class="tx-icon inter-normal-alabaster">{{$cs->vot}} Minat</span>
                                        </div>
                                      </div>
                                    </a>
                                    @else
                                    @if (in_array(Auth::user()->trader->id,[$cs->trdvote]))

                                    <a onclick="document.getElementById('subvote{{$cs->id}}').submit();"
                                      style="cursor: pointer">
                                      @else
                                      <a onclick="document.getElementById('vote{{$cs->id}}').submit();"
                                        style="cursor: pointer">
                                        @endif
                                        <div class="icon-and-supporting-text-1">
                                          <i class="icon-com iconheart fas fa-user"
                                            style="color: #fff; font-size: 18px;"></i>
                                          <div class="address-5 inter-normal-alabaster-10px">
                                            <span class="tx-icon inter-normal-alabaster">{{$cs->vot}} Minat</span>
                                          </div>
                                        </div>
                                      </a>
                                      <form id="vote{{$cs->id}}" action="{{url('addVote')}}/{{$cs->id}}" method="POST"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                      </form>
                                      <form id="subvote{{$cs->id}}" action="{{url('subVote')}}/{{$cs->id}}"
                                        method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                      </form>

                                      @endguest
                                      <a style="cursor: pointer" data-id="{{$cs->id}}" data-toggle="modal"
                                        data-target="#modal{{$cs->id}}" class="cmt">
                                        <div class="icon-and-supporting-text-2">
                                          <i class="icon-com iconheart fas fa-comments"
                                            style="color: #fff; font-size: 18px;"></i>
                                          <div class="address-6 inter-normal-alabaster-10px">
                                            <span class="tx-icon inter-normal-alabaster">{{$cs->cmt}} Komentar</span>
                                          </div>
                                        </div>
                                      </a>
                                      <a style="cursor: pointer" data-id="{{$cs->id}}" data-toggle="modal"
                                        data-target="#modalShareButton{{$cs->id}}">
                                        <div class="icon-and-supporting-text-2">
                                          <i class="icon-com iconheart fas fa-share"
                                            style="color: #fff; font-size: 18px;"></i>
                                          <div class="share inter-normal-alabaster-10px">
                                            <span class="tx-icon inter-normal-alabaster">Share</span>
                                          </div>
                                        </div>
                                      </a>
                              </div>
                            </div>
                            <div class="footer-card">
                              <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                              <a href="{{ url('detail-coming-soon') }}/{{$cs->id}}"
                                class="button btn-block btn btn-outline-light inter-medium-white-14px">Dukung Bisnis
                                Ini</a>
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
  </div>
  <div class="but-pag">
    <a class="carousel-control-prev border-1px-cape-cod inter-medium-alabaster-14px customPreviousBtn3"
      href="#jewellery_main_slider" role="button" data-slide="prev"><i class="fas fa-arrow-left"></i>&nbsp&nbsp Prev
    </a>
    <a class="carousel-control-next border-1px-cape-cod inter-medium-alabaster-14px customNextBtn3"
      href="#jewellery_main_slider" role="button" data-slide="next">Next &nbsp&nbsp<i class="fas fa-arrow-right"></i>
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
          <a href="{{ route('sold-out.index') }}" class="tx-rg inter-bold-white">Lihat Semua
            &nbsp&nbsp<i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="w3-container w3-red">
            <div class="fashion_section_2">
              <div class="fashion_section_2">
                <div class="row">
                  <div id="owl-demo" class="owl-carousel owl-theme div_main"
                    style="padding-left: 15px; padding-right: 15px;">
                    @foreach ($sold_out as $item)
                    <?php 
                              $picture = explode(',',$item->pictures);
                              $tot=number_format(round($item->supply * $item->price),0,',','.');
                              ?>
                    <div class="item">


                      <a type="button" data-toggle="modal" id="detail_sold" style="width: 100%;"
                        class="mod_sold detail_sold moldla" data-target="#modal_sold" data-ktg_sold="<?=$item->ktg?>"
                        data-trademark_sold="<?=$item->trademark?>" data-company_name_sold="<?=$item->company_name?>"
                        data-tot_pendanaan_sold="<?=$tot?>" data-image_sold="<?=$picture[0]?>">
                        <div class="card moldla">
                          <img class="rectangle-2 moldla"
                            src="https://storage.googleapis.com/asset-santara/santara.co.id/token/{{$picture[0]}}" />
                        </div>
                      </a>

                    <a type="button" class="molpli" data-toggle="modal" data-target="#exampleModal">
                      <div class="card molpli">
                          <img class="rectangle-2"
                            src="https://storage.googleapis.com/asset-santara/santara.co.id/token/{{$picture[0]}}" />
                          <div class="content">
                            <div class="header-card-dan-progress-2">
                              <div class="header-and-tags">
                                <span class="tx-t inter-medium-sweet-pink-12px"
                                  style="background: var(--falu-red);
    border-radius: 10px; box-shadow: 10px 0 0 var(--falu-red), 0px 0 0 var(--falu-red); line-height : 20px; padding-left:10px;">{{$item->ktg}}</span>
                                <div class="header">
                                  <div class="saka-logistics inter-medium-alabaster-20px">
                                    <span class="tx-pt inter-medium-alabaster">
                                      <?php echo \Illuminate\Support\Str::limit(strip_tags( $item->trademark ), 20, $end='...') ?>
                                    </span>
                                  </div>
                                  <div class="pt-saka-multitrans-nusantara inter-normal-quill-gray-12px">
                                    <span class="tx-np inter-normal-quill-gray">
                                      <?php echo \Illuminate\Support\Str::limit(strip_tags( $item->company_name ), 30, $end='...') ?>
                                    </span>
                                  </div>
                                </div>
                              </div>
                              <div class="info-pendanaan">
                                <div class="mul inter-normal-mercury-14px">
                                  <span class="tx-sold span-1 inter-normal-quill-gray">Total Pendanaan <span
                                      class="tx-sold inter-bold-white" style="font-weight: bold">Rp
                                      {{number_format(round($item->supply * $item->price),0,',','.')}}</span></span>
                                </div>
                              </div>
                              <div>
                              </div>
                            </div>
                            <div class="footer-card">
                              <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                              <div class="footer-card-1">
                                <div class="deviden-dibagikan-rp inter-normal-mercury-12px">
                                  <span class="inter-normal-quill-gray-12px">Deviden Dibagikan<br /></span><span
                                    class="inter-medium-alabaster-12px">Rp250.000.000</span>
                                </div>
                                <div class="pembagian-dividen-1-kali inter-normal-mercury-10px">
                                  <span class="inter-normal-quill-gray-12px">Pembagian Dividen<br /></span><span
                                    class="inter-medium-alabaster-12px">1 Kali</span>
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
  </div>
  <div class="but-pag">
    <a class="carousel-control-prev border-1px-cape-cod inter-medium-alabaster-14px customPreviousBtn"
      href="#jewellery_main_slider" role="button" data-slide="prev"><i class="fas fa-arrow-left"></i>&nbsp&nbsp Prev
    </a>
    <a class="carousel-control-next border-1px-cape-cod inter-medium-alabaster-14px customNextBtn"
      href="#jewellery_main_slider" role="button" data-slide="next">Next &nbsp&nbsp<i class="fas fa-arrow-right"></i>
    </a>
  </div>
</div>
</div>
<!-- jewellery  section end -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Maaf</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Halaman masih dalam pengembangan.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@foreach ($soon as $item)

<div class="modal fade" id="modal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="font-size: 20px;">{{$item->trademark}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="padding-right: 12px;">×</span>
        </button>
      </div>
      <div class="modal-body comm">

      </div>
      @guest

      @else
      <div class="modal-footer container">
        {{-- <form action="{{url('sendData')}}/{{$item->id}}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <textarea name="comment" class="form-control" id="" cols="10" rows="10"></textarea>
          </div>
          <button type="button" id="send" class="btn btn-primary send">Send</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form> --}}
        {{-- <form action="{{url('sendData')}}/{{$item->id}}" method="POST" enctype="multipart/form-data"> --}}

          {{-- <input name="comment{{$item->id}}"> --}}
          {{-- <textarea name="comment{{$item->id}}" id="" cols="30" rows="10"></textarea> --}}
          {{-- <textarea class="form-control without-border" id="comment" name="comment{{$item->id}}"
            placeholder="Write a comment" style="font-size:12px; padding: 6px; resize:none;"></textarea>
          <button type="button" class="btn btn-primary" id="send{{$item->id}}">send</button> --}}
          {{-- <div class="modal-footer "> --}}
            <table>
              <tbody>
                <tr>
                  <form id="ajaxform{{$item->id}}">
                    {{-- {{ csrf_field() }} --}}
                    <input type="hidden" name="idem{{$item->id}}" value="{{$item->id}}">
                    <input type="hidden" name="trd{{$item->id}}">
                    <td width="100%" valign="top" style="margin-right: 5px;">

                      <textarea class="form-control without-border" id="comment" name="comment{{$item->id}}"
                        placeholder="Write a comment" cols="70"
                        style="font-size:12px; padding: 6px; resize:none;"></textarea>
                      <span class="error" style="font-size: 10px; color:red" id="comment_error">
                      </span>
                    </td>
                    <td rowspan="2" style="text-align: right; vertical-align: top;margin-left: 5px;padding-left: 15px;"
                      width="25%">
                      <button type="button" class="btn-pill btn btn-sm btn-outline-danger" id="send{{$item->id}}">Send
                        &nbsp;<i class="fa fa-paper-plane"></i></button>
                      <p></p>
                    </td>
                  </form>
                </tr>
              </tbody>
            </table>
          </div>
          @endguest

      </div>
    </div>

  </div>


  {{-- <div class="modal fade show" id="modalShareButton{{$item->id}}" tabindex="-1" aria-labelledby="modalShare"
    aria-modal="true" role="dialog" style="display: block;"> --}}
    <div class="modal fade" id="modalShareButton{{$item->id}}" tabindex="-1" role="dialog"
      aria-labelledby="modalLabel{{$item->id}}" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="p-2 modal-content">
          <div class="modal-header" style="border-bottom: none;">
          </div>
          <div class="text-center modal-body ">
            <div class="d-flex justify-content-evenly mb-5">
              <div class="container  text-center d-flex justify-content-center" style="border-top: solid #D9D9D9;">
                <h1 class="ff-a fs-24"
                  style="font-weight:800;text-transform:uppercase; padding:0 15px 0 15px; margin-top:-20px; width:150px; background-color:#fff;color:black;font-family: inherit;">
                  Share</h1>
              </div>
            </div>
            <div class="row mt-3 mb-3 d-flex justify-content-center ">
              <!-- <div class="col-4 col-md-2">
                      <img width="50px" src="https://santara.co.id/assets/new-santara/img/sosmed/instagram.png" />
                      <p class="ff-n fs-12 mt-2" style="color: #708088;">Instagram</p>
                  </div> -->
              <div class="col-4 col-md-2">
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://dev.santara.co.id/detail-coming-soon/{{$item->id}}"
                  id="shareFacebook" target="_blank" style="text-decoration: none;">
                  <img width="50px" src="https://santara.co.id/assets/new-santara/img/sosmed/facebook.png"
                    class="lazyload">
                  <p class="ff-n fs-12 mt-2" style="color: #708088;">Facebook</p>
                </a>
              </div>
              <div class="col-4 col-md-2">
                <a href="https://twitter.com/intent/tweet?url=https://dev.santara.co.id/detail-coming-soon/{{$item->id}}&amp;text=Temukan%20peluang%20investasi%20berikut%20di%20Santara!%0A PT. Lembu Sora Lampung"
                  id="shareTwitter" style="text-decoration: none;" target="_blank">
                  <img width="50px" src="https://santara.co.id/assets/new-santara/img/sosmed/twitter.png"
                    class="lazyload">
                  <p class="ff-n fs-12 mt-2" style="color: #708088;">Twitter</p>
                </a>
              </div>
              <div class="col-4 col-md-2">
                <a href="https://telegram.me/share/url?url=https://dev.santara.co.id/detail-coming-soon/{{$item->id}}&amp;text=Temukan%20peluang%20investasi%20berikut%20di%20Santara!%0A PT. Lembu Sora Lampung"
                  id="shareTelegram" target="_blank" style="text-decoration: none;">
                  <img width="50px" src="https://santara.co.id/assets/new-santara/img/sosmed/telegram.png"
                    class="lazyload">
                  <p class="ff-n fs-12 mt-2" style="color: #708088;">Telegram</p>
                </a>
              </div>
              <!-- <div class="col-4 col-md-2">
                      <img width="50px" src="https://santara.co.id/assets/new-santara/img/sosmed/tiktok.png" />
                      <p class="ff-n fs-12 mt-2" style="color: #708088;">TikTok</p>
                  </div> -->
              <div class="col-4 col-md-2">
                <a href="https://web.whatsapp.com/send?text=Temukan%20peluang%20investasi%20berikut%20di%20Santara!%0A https://dev.santara.co.id/detail-coming-soon/{{$item->id}}"
                  id="shareWhatsapp" target="_blank" style="text-decoration: none;">
                  <img width="50px" src="https://santara.co.id/assets/new-santara/img/sosmed/whatsapp.png"
                    class="lazyload">
                  <p class="ff-n fs-12 mt-2" style="color: #708088;">WhatsApp</p>
                </a>
              </div>
            </div>
            <div class="input-group input-group-lg mb-3">
              <input type="text" id="inputShareLink" class="form-control fs-16 bold ff-n" disabled=""
                style="border-radius: 25px;padding-right:150px" aria-label="Recipient's username"
                aria-describedby="basic-addon2"
                placeholder="https://dev.santara.co.id/detail-coming-soon/{{$item->id}}">
              <span id="copy-link" class="input-group-text"
                style="position: inherit;height: 33px;justify-content: center;align-items: center;margin: 10px 17px 10px -134px;border-radius: 20px;color: #BF2D30;border-color: #BF2D30; cursor:pointer"
                onclick="shareButton('https://dev.santara.co.id/detail-coming-soon/{{$item->id}}')">Copy Link</span>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="modal fade" id="modal_sold" tabindex="-1" role="dialog" aria-labelledby="detail_sold"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="card" style="margin-bottom: -1px;">
            <img class="rectangle-2" id="image_sold" />
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
              style="margin-right: 10px; margin-top: 0px; width: 30px;">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="content2">
              <div class="header-card-dan-progress-2">
                <div class="header-and-tags">
                  <span class="tx-t inter-medium-sweet-pink-12px"
                    style="background: var(--falu-red);
    border-radius: 10px; box-shadow: 10px 0 0 var(--falu-red), 0px 0 0 var(--falu-red); line-height : 20px; padding-left:10px;" id="ktg_sold"></span>
                  <div class="header">
                    <div class="saka-logistics inter-medium-alabaster-20px">
                      <span class="tx-pt inter-medium-alabaster" id="trademark_sold">
                      </span>
                    </div>
                    <div class="pt-saka-multitrans-nusantara inter-normal-quill-gray-12px">
                      <span class="tx-np inter-normal-quill-gray" id="company_name_sold">
                      </span>
                    </div>
                  </div>
                </div>
                <div class="info-pendanaan">
                  <div class="mul inter-normal-mercury-14px">
                    <span class="tx-sold span-1 inter-normal-quill-gray">Total Pendanaan</span>
                  </div>
                </div>
                <div class="addr inter-bold-white-14px">
                  <span class="tx-sold inter-bold-white" style="font-weight: bold" id="tot_pendanaan_sold">Rp</span>
                </div>
                <div>
                </div>
              </div>
              <div class="footer-card">
                <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                <div class="footer-card-2">
                  <div class="deviden-dibagikan-rp inter-normal-mercury-12px">
                    <span class="inter-normal-quill-gray-12px">Deviden Dibagikan<br /></span><span
                      class="inter-medium-alabaster-12px">Rp250.000.000</span>
                  </div>
                  <div class="pembagian-dividen-1-kali inter-normal-mercury-10px">
                    <span class="inter-normal-quill-gray-12px">Pembagian Dividen<br /></span><span
                      class="inter-medium-alabaster-12px">1 Kali</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="background-color: var(--shark);">
            <a class="b-daf btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#exampleModal">Selengkapnya</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal_now" tabindex="-1" role="dialog" aria-labelledby="detail_now" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="card" style="margin-bottom: -1px;">
            <img class="rectangle-2" id="image_now" />
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
              style="margin-right: 10px; margin-top: 0px; width: 30px;">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="content2">
              <div class="header-card-dan-progress">
                <div class="header-and-tags">
                  <span class="tx-t inter-medium-sweet-pink-12px"
                    style="background: var(--falu-red);
    border-radius: 10px; box-shadow: 10px 0 0 var(--falu-red), 0px 0 0 var(--falu-red); line-height : 20px; padding-left:10px;" id="ktg"></span>
                  <div class="header">
                    <div class="saka-logistics inter-medium-alabaster-20px">
                      <span class="tx-pt inter-medium-alabaster" id="trademark_now">
                      </span>
                    </div>
                    <div class="pt-saka-multitrans-nusantara inter-normal-quill-gray-12px">
                      <span class="tx-np inter-normal-quill-gray" id="company_name_now">
                      </span>
                    </div>
                  </div>
                </div>
                <div class="info-dan-progress">
                  <div class="info-pendanaan">
                    <div class="mulai-rp1000000 inter-normal-mercury-14px">
                      <span class="tx-sold span-1 inter-normal-mercury">Mulai</span><span
                        class="inter-normal-mercury-12px">&nbsp;</span>
                      <div class="mulai-rp inter-bold-white-14px"><span class="tx-sold span-1 inter-bold-white"
                          style="font-weight: bold" id="mulai">Rp</span>
                      </div>
                    </div>
                  </div>
                  <div class="address">
                    <div class="hr inter-bold-white-14px">
                      <span class="tx-sold inter-medium-white"><b style="font-weight: bold" id="hari">



                        </b></span>
                    </div>

                    <span class="inter-normal-mercury-12px">&nbsp;</span>
                    <div class="hr-lg inter-normal-mercury-14px">
                      <span class="tx-sold inter-normal-mercury">hari lagi</span>
                    </div>
                  </div>
                  <div class="overlap-group">
                    <div class="percent inter-medium-white-12px">
                      <div class="progress-bar "
                        style="width: 0%; background-color:#bf2d30; border-radius: 8px; height: 16px;"
                        role="progressbar" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100">

                        <span class="tx-np percen inter-medium-white" id="progres_now">



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
                    <span class="inter-normal-quill-gray-12px">Total Pendanaan<br /></span><span
                      class="inter-medium-alabaster-12px" id="tot_pendanaan">Rp</span>
                  </div>
                  <div class="periode-dividen-6-bulan inter-normal-mercury-10px">
                    <span class="inter-normal-quill-gray-12px">Periode Dividen<br /></span><span
                      class="inter-medium-alabaster-12px" id="periode_dividen"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="background-color: var(--shark);">
            <a class="b-daf btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#exampleModal">Selengkapnya</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="card" style="margin-bottom: -1px;">
            <img class="rectangle-2" id="image" />
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
              style="margin-right: 10px; margin-top: 0px; width: 30px;">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="content2">
              <div class="header-card-dan-progress">
                <div class="header-and-tags">
                  <span class="tx-t inter-medium-sweet-pink-12px"
                    style="background: var(--falu-red);
    border-radius: 10px; box-shadow: 10px 0 0 var(--falu-red), 0px 0 0 var(--falu-red); line-height : 20px; padding-left:10px;" id="category"></span>
                  <div class="header">
                    <div class="saka-logistics inter-medium-alabaster-20px">
                      <span class="tx-pt inter-medium-alabaster" id="trademark"></span>
                    </div>
                    <div class="pt-saka-multitrans-nusantara inter-normal-quill-gray-12px">
                      <span class="tx-np inter-normal-quill-gray" id="company_name"></span>
                    </div>
                  </div>
                </div>
                <div class="icon-card row">
                  @guest
                  <a class="col-3" href="{{route('login')}}" style="cursor: pointer">
                    <div class="icon-and-supporting-text">
                      <i class="icon-com iconheart fas fa-heart" style="color: #fff; font-size: 18px;"></i>
                      &ensp;
                      <div class="lk inter-normal-alabaster-10px">
                        <span class="tx-icon inter-normal-alabaster">
                          <p class="ic-sz tx-icon lkk" style="margin-top: -25px;" id="like">

                          </p>
                          <p class="ic-sz com-u tx-tp">&ensp;Likes</p>
                        </span>
                      </div>
                    </div>
                  </a>
                  @else
                  @if (in_array(Auth::user()->trader->id,[$cs->trdlike]))

                  <a class="col-3" id="sl" onclick="" style="cursor: pointer">
                    @else
                    <a class="col-3" id="ll" onclick="" style="cursor: pointer">
                      @endif

                      {{-- <a onclick="document.getElementById('like{{$cs->id}}').submit();" style="cursor: pointer">
                        --}}
                        <div class="icon-and-supporting-text">
                          <i class="icon-com iconheart fas fa-heart" style="color: #fff; font-size: 18px;"></i>
                          &ensp;
                          <div class="lk inter-normal-alabaster-10px">
                            <span class="tx-icon inter-normal-alabaster">
                              <p class="ic-sz tx-icon lkk" style="margin-top: -25px;" id="like">

                              </p>
                              <p class="ic-sz com-u tx-tp">&ensp;Likes</p>
                            </span>
                          </div>
                        </div>
                      </a>
                      <form id="like" action="" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                      </form>

                      <form id="sublike" action="" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                      </form>
                      @endguest



                      @guest
                      <a class="col-3" href="{{route('login')}}" style="cursor: pointer">
                        <div class="icon-and-supporting-text-1">
                          <i class="icon-com iconheart fas fa-user" style="color: #fff; font-size: 18px;"></i>
                          <div class="lk inter-normal-alabaster-10px">
                            <span class="tx-icon inter-normal-alabaster">
                              <p class="ic-sz tx-icon lkk" style="margin-top: -0px;" id="minat"> </p>
                              <p class="ic-sz com-u mnt">&ensp;Minat</p>
                            </span>
                          </div>
                        </div>
                      </a>
                      @else
                      @if (in_array(Auth::user()->trader->id,[$cs->trdvote]))

                      <a class="col-3" onclick="document.getElementById('subvote{{$cs->id}}').submit();"
                        style="cursor: pointer">
                        @else
                        <a class="col-3" onclick="document.getElementById('vote{{$cs->id}}').submit();"
                          style="cursor: pointer">
                          @endif
                          <div class="icon-and-supporting-text-1">
                            <i class="icon-com iconheart fas fa-user" style="color: #fff; font-size: 18px;"></i>
                            <div class="lk inter-normal-alabaster-10px">
                              <span class="tx-icon inter-normal-alabaster">
                                <p class="ic-sz tx-icon lkk" style="margin-top: -0px;" id="minat"> </p>
                                <p class="ic-sz com-u mnt">&ensp;Minat</p>
                              </span>
                            </div>
                          </div>
                        </a>
                        <form id="vote{{$cs->id}}" action="{{url('addVote')}}/{{$cs->id}}" method="POST"
                          enctype="multipart/form-data">
                          {{ csrf_field() }}
                        </form>
                        <form id="subvote{{$cs->id}}" action="{{url('subVote')}}/{{$cs->id}}" method="POST"
                          enctype="multipart/form-data">
                          {{ csrf_field() }}
                        </form>

                        @endguest
                        <a class="col-3" style="cursor: pointer" data-id="{{$cs->id}}" id="mct" data-toggle="modal"
                          data-dismiss="modal" data-target="#modal" class="cmt">
                          <div class="icon-and-supporting-text-1">
                            <i class="icon-com iconheart fas fa-comments"
                              style="color: #fff; font-size: 18px; margin-left: -15px;"></i>
                            <div class=" inter-normal-alabaster-10px">
                              <span class="tx-icon inter-normal-alabaster">
                                <p class="ic-sz tx-icon" style="margin-top: -0px;" id="comments"> </p>
                                <p class="ic-sz com-u mnt">&ensp;Komentar</p>
                              </span>
                            </div>
                          </div>
                        </a>
                        <a class="col-3" style="cursor: pointer" id="msb" data-id="{{$cs->id}}" data-toggle="modal"
                          data-target="#modalShareButton" data-dismiss="modal">
                          <div class="icon-and-supporting-text-1">
                            <i class="icon-com iconheart fas fa-share" style="color: #fff; font-size: 18px;"></i>
                            <div class="share inter-normal-alabaster-10px">
                              <span class="tx-icon inter-normal-alabaster">Share</span>
                            </div>
                          </div>
                        </a>
                </div>
              </div>


              <div class="footer-card3">
                <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                <a id="dbi" class="button btn btn-outline-light btn-au inter-medium-white-14px">Dukung Bisnis Ini</a>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="background-color: var(--shark);">
            <a class="b-daf btn btn-danger btn-lg btn-block" id="sel" href="">Selengkapnya</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach

  <script>
    $(document).ready(function() {
    $(document).on('click', '.mod', function() {
      var category = $(this).data('category');
      var trademark = $(this).data('trademark');
      var company_name = $(this).data('company_name');
      var image = $(this).data('image');
      var like = $(this).data('like');
      var minat = $(this).data('minat');
      var comment = $(this).data('comment');
      var id = $(this).data('id');
      var trdlike = $(this).data('trdlike');
      var trdvote = $(this).data('trdvote');
      $('#category').text(category);
      $('#trademark').text(trademark);
      $('#company_name').text(company_name);
      $('#image').prop('src', 'public/upload/' + image);
      $('#like').text(like);
      $('#minat').text(minat);
      $('#comments').text(comment);
      $('#id').text(id);
      $('#sel').attr("href", "{{url('detail-coming-soon')}}/"+id);
      $('#dbi').attr("href", "{{url('detail-coming-soon')}}/"+id);
      $('#trdlike').text(trdlike);
      $('#trdvote').text(trdvote);
      $("form#like").prop('id','like'+id).prop('action', "{{url('addLike')}}/"+id);;
      $("form#sublike").prop('id','sublike'+id).prop('action',"{{url('subLike')}}/"+id);
      $("#msb").attr('data-target', "#modalShareButton"+id);
      $("#mct").attr('data-target', "#modal"+id).attr('data-id', id);
// console.log($("#msb").dataset.target);
      $("#sl").attr('onclick',"document.getElementById('sublike"+id+"').submit()");
      $("#ll").attr('onclick',"document.getElementById('sublike"+id+"').submit()");
      // $("#sl").setAttribute('onclick',"d");
      // $("#ll").setAttribute('onclick',"ds");
      // var s = function() { document.getElementById('sublike'+id).submit() };
      // var l = function() { document.getElementById('like'+id).submit() };
      // $("#sl").onclick = 's';
      // $("#ll").onclick = 'l';
    })
  })
  </script>

  <script>
    $(document).ready(function() {
    $(document).on('click', '.detail_now', function() {
      var ktg = $(this).data('ktg');
      var trademark_now = $(this).data('trademark_now');
      var company_name_now = $(this).data('company_name_now');
      var image_now = $(this).data('image_now');
      var mulai = $(this).data('mulai');
      var hari = $(this).data('hari');
      var progres_now = $(this).data('progres_now');
      var tot_pendanaan = $(this).data('tot_pendanaan');
      var periode_dividen = $(this).data('periode_dividen');
      $('#ktg').text(ktg);
      $('#trademark_now').text(trademark_now);
      $('#company_name_now').text(company_name_now);
      $('#image_now').prop('src', 'https://storage.googleapis.com/asset-santara/santara.co.id/token/' + image_now);
      $('#mulai').text(mulai);
      $('#hari').text(hari);
      $('#progres_now').text(progres_now);
      $('#tot_pendanaan').text(tot_pendanaan);
      $('#periode_dividen').text(periode_dividen);
    })
  })
  </script>
  <script>
    $(document).ready(function() {
    $(document).on('click', '.detail_sold', function() {
      var ktg_sold = $(this).data('ktg_sold');
      var trademark_sold = $(this).data('trademark_sold');
      var company_name_sold = $(this).data('company_name_sold');
      var image_sold = $(this).data('image_sold');
      var tot_pendanaan_sold = $(this).data('tot_pendanaan_sold');
      var periode_dividen_sold = $(this).data('periode_dividen_sold');
      $('#ktg_sold').text(ktg_sold);
      $('#trademark_sold').text(trademark_sold);
      $('#company_name_sold').text(company_name_sold);
      $('#image_sold').prop('src', 'https://storage.googleapis.com/asset-santara/santara.co.id/token/' + image_sold);
      $('#tot_pendanaan_sold').text(tot_pendanaan_sold);
      $('#periode_dividen_sold').text(periode_dividen_sold);
    })
  })
  </script>
  {{-- @endforeach --}}

  @endsection
  @section('js')
  <script type='text/javascript'>
    $(document).ready(function(){

      $('.cmt').click(function(){
         
          var id = $(this).data('id');

          // AJAX request
          $.ajax({
              url: '{{url("getmodaldata")}}/'+id,
              type: 'get',
              data: {id: id},
              success: function(cmt){ 
                  // Add response in Modal body
                  $('.comm').html(cmt); 

                  // Display Modal
                  // $('#empModal').modal('show'); 
                  // console.log(cmt);
              }
          });
      });
});
  </script>
  <script>
    function shareButton(url) {
      navigator.clipboard.writeText(url);
      // alert("Copied the text: " + url);
      toastr.success("Url Berhasil Di Copy!!");
  }

  function share(url, message) {

      if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
          // some code..
          const shareData = {
              title: message,
              text: 'Temukan peluang investasi berikut di Santara! ' + message,
              url: url
          }

          try {
              navigator.share(shareData)
              resultPara.textContent = 'MDN shared successfully'
          } catch (err) {
              resultPara.textContent = 'Error: ' + err
          }
      } else {

          $('#shareWhatsapp').attr('href', "https://web.whatsapp.com/send?text=Temukan%20peluang%20investasi%20berikut%20di%20Santara!%0A " + url);
          $('#shareTelegram').attr('href', "https://telegram.me/share/url?url=" + url + "&text=Temukan%20peluang%20investasi%20berikut%20di%20Santara!%0A " + message);
          $('#shareFacebook').attr('href', "https://www.facebook.com/sharer/sharer.php?u=" + url);
          $('#shareTwitter').attr('href', "https://twitter.com/intent/tweet?url=" + url + "&text=Temukan%20peluang%20investasi%20berikut%20di%20Santara!%0A " + message);
          $('#copy-link').attr('onclick', "shareButton('" + url + "')");
          $('#inputShareLink').attr('placeholder', url);
          $('#modalShareButton').modal('show');
      }

  }
  </script>
  @foreach ($soon as $item)

  <script type='text/javascript'>
    $(document).ready(function(){
  $("#send{{$item->id}}").click(function(){
      // event.preventDefault();

      let comment = $("textarea[name=comment{{$item->id}}]").val();
      let idem = $("input[name=idem{{$item->id}}]").val();
      let trd = $("input[name=trd{{$item->id}}]").val();
      let _token   = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: "{{url('sendData')}}" +"/"+ idem,
        type:"POST",
        data:{
          comment:comment,
          idem:idem,
          trd:trd,
          _token: _token
        },
        success:function(response){
          // console.log(response);
          if(response) {
            $('.success').text(response.success);
            $("#ajaxform{{$item->id}}")[0].reset();
            $.ajax({
              url: '{{url("getmodaldata")}}/'+{{$item->id}},
              type: 'get',
              data: {id: "{{$item->id}}"},
              success: function(cmt){ 
                  // Add response in Modal body
                  $('.comm').html(cmt); 

                  // Display Modal
                  // $('#empModal').modal('show'); 
                  // console.log(cmt);
              }
          });
          }
        },
        error: function(error) {
        console.log(error);
        }
       });
  });
});
  </script>
  @endforeach
  @endsection