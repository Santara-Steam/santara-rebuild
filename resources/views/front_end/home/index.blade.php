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
          <a href="{{ route('now-playing.index') }}" class="tx-rg inter-bold-white">Investasi Sekarang
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
                  <div id="owl-demo2" class="owl-carousel owl-theme" style="padding-left: 15px; padding-right: 15px;">
                    <div class="item">
                      <a href="{{ route('now-playing.detail') }}">
                        <div class="card">
                          <img class="rectangle-2"
                            src="https://storage.googleapis.com/asset-santara/santara.co.id/token/{{$picture[0]}}" />
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
                                    <span class="tx-sold span-1 inter-normal-mercury">Mulai</span><span
                                      class="inter-normal-mercury-12px">&nbsp;</span>
                                    <div class="mulai-rp inter-bold-white-14px"><span
                                        class="tx-sold span-1 inter-bold-white" style="font-weight: bold">Rp
                                        {{number_format(round($np->minimum_invest * $np->price,0),0,',','.')}}</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="address">
                                  <div class="hr inter-bold-white-14px">
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
                                    <div class="progress-bar "
                                      style="width: {{ round((round($np->terjual,0)/round($np->supply))*100,2) }}%; background-color:#bf2d30; border-radius: 8px; height: 16px;"
                                      role="progressbar"
                                      aria-valuenow="{{ round((round($np->terjual,0)/round($np->supply))*100,2) }}"
                                      aria-valuemin="0" aria-valuemax="100">

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
                                  <span class="inter-normal-quill-gray-12px">Total Pendanaan<br /></span><span
                                    class="inter-medium-alabaster-12px">Rp{{number_format(round($np->supply*$np->price,0),0,',','.')}}</span>
                                </div>
                                <div class="periode-dividen-6-bulan inter-normal-mercury-10px">
                                  <span class="inter-normal-quill-gray-12px">Periode Dividen<br /></span><span
                                    class="inter-medium-alabaster-12px">{{$np->period}}</span>
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
          <span class="tx-lf inter-bold-alabaster">Coming Soon (45)</span>
        </div>
        <div class="investasi-sekarang inter-bold-thunderbird-16px button-4 seemore">
          <a href="{{ route('coming-soon.index') }}" class="tx-rg inter-bold-white">Dukung Bisnis
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
                      <!-- <a href="{{ url('detail-coming-soon') }}/{{$cs->id}}"> -->
                      <div class="card">
                        <a type="button" data-toggle="modal" id="detail{{$cs->id}}" class="mod detail"
                          data-target="#exampleModalCenter" data-category="<?=$cs->ctg->category?>"
                          data-image="{{$picture[3]}}" data-trademark="<?=$cs->trademark?>"
                          data-company_name="<?=$cs->company_name?>" data-like="<?=$cs->likes?>"
                          data-minat="<?=$cs->vot?>" data-comment="<?=$cs->cmt?>" data-id="<?=$cs->id?>"
                          data-trdlike="<?=$cs->trdlike?>" data-trdvot="<?=$cs->trdvot?>">
                          <img class="rectangle-2" src="{{ asset('public/upload') }}/{{$picture[3]}}" />
                        </a>
                        <div class="content">
                          <div class="header-card-dan-progress">
                            <div class="header-and-tags">
                              <div class="tags">
                                <div class="retail-distribusi-logistik inter-medium-sweet-pink-12px">
                                  <span class="tx-t inter-medium-sweet-pink">{{$cs->ctg->category}}</span>
                                </div>
                              </div>
                              <div class="header">
                                <div class="saka-logistics inter-medium-alabaster-20px">
                                  <span class="tx-pt inter-medium-alabaster">{{$cs->trademark}}</span>
                                </div>
                                <div class="pt-saka-multitrans-nusantara inter-normal-quill-gray-12px">
                                  <span class="tx-np inter-normal-quill-gray">{{$cs->company_name}}</span>
                                </div>
                              </div>
                            </div>
                            <div class="icon-card">
                              @guest
                              <a href="{{route('login')}}" style="cursor: pointer">
                                <div class="icon-and-supporting-text">
                                  <i class="icon-com iconheart fas fa-heart" style="color: #fff; font-size: 18px;"></i>
                                  &ensp;
                                  <div class="lk inter-normal-alabaster-10px">
                                    <span class="tx-icon inter-normal-alabaster">
                                      <p class="ic-sz tx-icon lkk" style="margin-top: -25px;">
                                        {{$cs->likes}}
                                      </p>
                                      <p class="ic-sz com-u tx-tp">&ensp;Likes</p>
                                    </span>
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
                                      &ensp;
                                      <div class="lk inter-normal-alabaster-10px">
                                        <span class="tx-icon inter-normal-alabaster">
                                          <p class="ic-sz tx-icon lkk" style="margin-top: -25px;">
                                            {{$cs->likes}}
                                          </p>
                                          <p class="ic-sz com-u tx-tp">&ensp;Likes</p>
                                        </span>
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
                                      <div class="lk inter-normal-alabaster-10px">
                                        <span class="tx-icon inter-normal-alabaster">
                                          <p class="ic-sz tx-icon lkk" style="margin-top: -0px;">{{$cs->vot}} </p>
                                          <p class="ic-sz com-u mnt">&ensp;Minat</p>
                                        </span>
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
                                        <div class="lk inter-normal-alabaster-10px">
                                          <span class="tx-icon inter-normal-alabaster">
                                            <p class="ic-sz tx-icon lkk" style="margin-top: -0px;">{{$cs->vot}} </p>
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
                                    <a style="cursor: pointer" data-id="{{$cs->id}}" data-toggle="modal"
                                      data-target="#modal{{$cs->id}}" class="cmt">
                                      <div class="icon-and-supporting-text-1">
                                        <i class="icon-com iconheart fas fa-comments"
                                          style="color: #fff; font-size: 18px; margin-left: -15px;"></i>
                                        <div class=" inter-normal-alabaster-10px">
                                          <span class="tx-icon inter-normal-alabaster">
                                            <p class="ic-sz tx-icon" style="margin-top: -0px;">{{$cs->cmt}} </p>
                                            <p class="ic-sz com-u mnt">&ensp;Komentar</p>
                                          </span>
                                        </div>
                                      </div>
                                    </a>
                                    <a style="cursor: pointer" data-id="{{$cs->id}}" data-toggle="modal"
                                      data-target="#modalShareButton{{$cs->id}}">
                                      <div class="icon-and-supporting-text-1">
                                        <i class="icon-com iconheart fas fa-share"
                                          style="color: #fff; font-size: 18px;"></i>
                                        <div class="share inter-normal-alabaster-10px">
                                          <span class="tx-icon inter-normal-alabaster">Share</span>
                                        </div>
                                      </div>
                                    </a>
                            </div>
                          </div>
                          <div class="footer-card-3">
                            <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                            <span class="button btn btn-outline-light btn-au inter-medium-white-14px">Dukung Bisnis
                              Ini</span>
                          </div>
                        </div>
                      </div>
                      <!-- 
                      </a> -->
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
                              ?>
                    <div class="item">
                      <a href="{{ route('sold-out.detail') }}">
                        <div class="card">
                          <img class="rectangle-2"
                            src="https://storage.googleapis.com/asset-santara/santara.co.id/token/{{$picture[0]}}" />
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
                                  <span class="tx-sold span-1 inter-normal-quill-gray">Total Pendanaan</span>
                                </div>
                              </div>
                              <div class="addr inter-bold-white-14px">
                                <span class="tx-sold inter-bold-white" style="font-weight: bold">Rp
                                  {{number_format(round($item->supply * $item->price),0,',','.')}}</span>
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
                  <div class="tags2">
                    <div class="retail-distribusi-logistik inter-medium-sweet-pink-12px">
                      <span class="tx-t inter-medium-sweet-pink" id="category"></span>
                    </div>
                  </div>
                  <div class="header">
                    <div class="saka-logistics inter-medium-alabaster-20px">
                      <span class="tx-pt inter-medium-alabaster" id="trademark"></span>
                    </div>
                    <div class="pt-saka-multitrans-nusantara inter-normal-quill-gray-12px">
                      <span class="tx-np inter-normal-quill-gray" id="company_name"></span>
                    </div>
                  </div>
                </div>
                <div class="icon-card">
                  @guest
                  <a href="{{route('login')}}" style="cursor: pointer">
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
                  @if (in_array(Auth::user()->trader->id,[$item->trdlike]))

                  <a onclick="document.getElementById('sublike{{$item->id}}').submit();" style="cursor: pointer">
                    @else
                    <a onclick="document.getElementById('like{{$item->id}}').submit();" style="cursor: pointer">
                      @endif

                      {{-- <a onclick="document.getElementById('like{{$item->id}}').submit();" style="cursor: pointer">
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
                      <form id="like{{$item->id}}" action="{{url('addLike')}}/{{$item->id}}" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                      </form>

                      <form id="sublike{{$item->id}}" action="{{url('subLike')}}/{{$item->id}}" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                      </form>
                      @endguest



                      @guest
                      <a href="{{route('login')}}" style="cursor: pointer">
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
                      @if (in_array(Auth::user()->trader->id,[$item->trdvote]))

                      <a onclick="document.getElementById('subvote{{$item->id}}').submit();" style="cursor: pointer">
                        @else
                        <a onclick="document.getElementById('vote{{$item->id}}').submit();" style="cursor: pointer">
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
                        <form id="vote{{$item->id}}" action="{{url('addVote')}}/{{$item->id}}" method="POST"
                          enctype="multipart/form-data">
                          {{ csrf_field() }}
                        </form>
                        <form id="subvote{{$item->id}}" action="{{url('subVote')}}/{{$item->id}}" method="POST"
                          enctype="multipart/form-data">
                          {{ csrf_field() }}
                        </form>

                        @endguest
                        <a style="cursor: pointer" data-id="{{$item->id}}" data-toggle="modal"
                          data-target="#modal{{$item->id}}" class="cmt" data-dismiss="modal">
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
                        <a style="cursor: pointer" data-id="{{$item->id}}" data-toggle="modal"
                          data-target="#modalShareButton{{$item->id}}" data-dismiss="modal">
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
                <span class="button btn btn-outline-light btn-au inter-medium-white-14px">Dukung Bisnis Ini</span>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="background-color: var(--shark);">
            <a class="b-daf btn btn-danger btn-lg btn-block" id="sel"
              href="{{url('detail-coming-soon')}}/">Selengkapnya</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach

    <script>
      $(document).ready(function() {
    $(document).on('click', '.detail', function() {
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
      $('#image').prop('src', 'public/upload/'+image);
      $('#like').text(like);
      $('#minat').text(minat);
      $('#comments').text(comment);
      $('#id').text(id);
      $('#trdlike').text(trdlike);
      $('#trdvote').text(trdvote);
      $("#sel").attr("href", "{{url('detail_coming_soon')}}/"+id)
    })
  })
    </script>
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