@extends('front_end/template_front_end/app')

@section('content')
<!-- banner bg main start -->
<div class="banner_bg_main" style="margin-top: 96px;">
  <div class="banner_section layout_padding">
    <div class="container" style="margin-top: 0px">
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


<!-- banner bg main end -->
<div class="fashion_section">
  <div id="jewellery_main_slider" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="container">
          <div class="col-12 d-flex justify-content-between" style="padding-bottom:10px">
            <div class="now-playing inter-bold-alabaster-24px">
              <span class="tx-lf inter-bold-alabaster">Now Playing ({{count($now_playing)}})</span>
            </div>


            <div class="investasi-sekarang inter-bold-thunderbird-16px button-4 seemore">
              <a href="{{route('now-playing.index')}}" class="tx-rg inter-bold-white">Lihat Semua
                &nbsp&nbsp<i class="fas fa-arrow-right"></i></a>
            </div>
            </a>
          </div>
          <div class="fashion_section_2">
            <div class="row">
              <div id="owl-demo2" class="owl-carousel owl-theme" style="padding-left: 15px; padding-right: 15px;">
                <?php 
                use Illuminate\Support\Facades\DB;
                  
                  ?>

                @foreach($now_playing as $k => $np)
                <?php
                $now      = new DateTime(); // or your date as well
                $start    = new DateTime($np['begin_period']);
                $finish   = new DateTime($np['end_period']);
                $period   = $finish->format('d M Y');
                $offer   = $start->format('d M Y');
                $supply   = $np['supply'] * $np['price'];
                $start_offer = $start->format("Y-m-d");
                $str_time    = strtotime($start_offer);

                $diff_now              = $finish->diff($now);
                $diff                    = "0 Hari";
                // var_dump($np->created_at);
                $tersisa = ($np['supply'] - $np['terjual'] > 0) ? ($np['supply'] - $np['terjual']) : 0;
                $terjual = ($np['terjual'] > $np['supply']) ? $np['supply'] : $np['terjual'];
                // terjual dalam persen 0 -100
                $terjual_percentage = $terjual > 0 ? ($terjual / $np['supply']) * 100 : 0;
                $terjual_percentage = ($terjual_percentage >= 0) ? ($terjual_percentage > 100 ? 100 : $terjual_percentage) : 0;

                $tersisa_percentage = number_format($tersisa > 0 ? ($tersisa / $np['supply'] * 100) : 0, 2, ',', '.');
                $tersisa_total = number_format($tersisa, 0, ',', '.');
                $tersisa_total_rp = number_format($tersisa * $np['price'], 0, ',', '.');
                $terjual_percentage_f = number_format($terjual_percentage, 2, '.', ',');
                $terjual_percentage = number_format($terjual_percentage, 2, ',', '.');
                $terjual_total = number_format($terjual, 0, ',', '.');
                $terjual_total_rp = number_format($terjual * $np['price'], 0, ',', '.');
                if (($now > $start) && ($now < $finish)) {
                    if ($np['terjual'] < $np['supply']) {
                        $format = ($diff_now->days > 0) ? "%a Hari Lagi" : "%h Jam %i Menit Lagi";
                        $diff = $diff_now->format($format);
                    }
                };
                // use App\Models\emiten_journey;
                $emj = db::table('emiten_journeys')->select('*')->where('emiten_id',$np['id'])
                ->whereRaw('created_at = (SELECT max(created_at) from emiten_journeys
                where emiten_id = '.$np['id'].')')
                ->first();
                if($emj){

                }else{
                  $emj = new \stdClass();
                  $emj->date = '2019-10-01 14:20:35';
                  $emj->end_date = '2019-10-01 14:20:35';
                  // $emj->date = $emj["date"];
                  // $emj->end_date = $emj["end_date"];
                }
                ?>
                <div class="item">
                  
                  
                  {{-- @foreach ($now_playing as $np) --}}
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
                  <a data-toggle="modal" id="detail_now" class="mod_now detail_now moldla" style="width: 100%;"
                    data-target="#modal_now{{$np['id']}}" data-id="{{$np['id']}}">
                    <div class="card moldla">
                      <img class="rectangle-2 moldla" src="{{$np['pictures'][0]['picture']}}" />
                    </div>
                  </a>
                  <a class="molpli" href="{{url('detail-now-playing')}}/{{$np['id']}}">
                    <div class="card molpli">
                      <img class="rectangle-2" src="{{$np['pictures'][0]['picture']}}" />
                      <div class="content">
                        <div class="header-card-dan-progress">
                          <div class="header-and-tags">
                            <span class="tx-t inter-medium-sweet-pink-12px"
                              style="background: var(--falu-red);
            border-radius: 10px; box-shadow: 10px 0 0 var(--falu-red), 0px 0 0 var(--falu-red); line-height : 20px; padding-left:10px;">
                              <?php echo \Illuminate\Support\Str::limit(strip_tags( $np['category'] ), 20, $end='...') ?>
                            </span>
                            <div class="header">
                              <div class="saka-logistics inter-medium-alabaster-20px">
                                <span class="tx-pt inter-medium-alabaster">
                                  <?php echo \Illuminate\Support\Str::limit(strip_tags( $np['trademark'] ), 20, $end='...') ?>
                                </span>
                              </div>
                              <div class="pt-saka-multitrans-nusantara inter-normal-quill-gray-12px">
                                <span class="tx-np inter-normal-quill-gray">
                                  <?php echo \Illuminate\Support\Str::limit(strip_tags( $np['company_name'] ), 30, $end='...') ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="info-dan-progress">
                            <div class="info-pendanaan">
                              <div class="mulai-rp1000000 inter-normal-mercury-14px">
                                <span class="tx-sold span-1 inter-normal-mercury">Mulai &nbsp;<span
                                    class="tx-sold span-1 inter-bold-white-14px" style="font-weight: bold">Rp
                                    {{number_format(round( $np['price'] * 100,0),0,',','.')}}</span> </span>
                              </div>
                            </div>
                            <div class="address">
                              <div class="hr inter-bold-white-14px">
                                <span class="tx-sold inter-medium-white"><b style="font-weight: bold">

                                    <?php 
                                                      $now = time();
                                                      $start = strtotime($emj->date);
                                                      $end = strtotime($emj->end_date);
                                                      $datediff = $end - $now ;
                                                      ?>
                                    {{round($datediff / (60 * 60 * 24))}}
                                    {{-- {{abs(strtotime($np->begin_period) - strtotime($np->end_period))}} --}}
                                    {{-- 45 --}}
                                    {{-- <?= $diff ?> --}}
                                  </b></span>
                              </div>
                              {{-- {{abs(strtotime($np->begin_period) - strtotime($np->end_period))}} --}}
                              <span class="inter-normal-mercury-12px">&nbsp;</span>
                              <div class="hr-lg inter-normal-mercury-14px">
                                <span class="tx-sold inter-normal-mercury">Hari Lagi</span>
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
                                    style="width: {{$terjual_percentage_f}}%; background-color:#bf2d30; border-radius: 8px; height: 16px;"
                                    role="progressbar" aria-valuenow="{{$terjual_percentage_f}}"
                                    aria-valuemin="0" aria-valuemax="100">

                                    {{-- {{ round((round($np->terjual,0)/round($np->avg_capital_needs,0))*100,2) }} --}}
                                    {{-- @if (($np->per*100) == 0.0)
                                    0
                                    @else
                                    {{round($np->per,4)*100}}
                                    @endif --}}
                                    {{-- 0 --}}
                                    {{$terjual_percentage}}
                                    %

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
                                  class="inter-medium-alabaster-12px">Rp{{number_format($np['supply'] * $np['price'], 0,
                                  ',', '.')}}</span>
                              </div>
                              <div class="periode-dividen-6-bulan inter-normal-mercury-10px">
                                <span class="inter-normal-quill-gray-12px">Periode Dividen<br /></span><span
                                  class="inter-medium-alabaster-12px">{{$np['period']}} </span>
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

<div class="fashion_section">
  <div id="jewellery_main_slider" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="container">
          <div class="col-12 d-flex justify-content-between" style="padding-bottom:10px">
            <div class="now-playing inter-bold-alabaster-24px">
              <span class="tx-lf inter-bold-alabaster">Coming Soon ({{count($soonc)}})</span>
            </div>


            <div class="investasi-sekarang inter-bold-thunderbird-16px button-4 seemore">
              <a href="{{ route('coming-soon.index') }}" class="tx-rg inter-bold-white">Lihat Semua
                &nbsp&nbsp<i class="fas fa-arrow-right"></i></a>
            </div>
            </a>
          </div>
          <div class="fashion_section_2">
            <div class="row">
              <div id="owl-demo3" class="owl-carousel owl-theme" style="padding-left: 15px; padding-right: 15px;">
                @foreach ($soon as $cs)
                <?php 
                                            $picture = explode(',',$cs->pictures);
                                            if(empty($picture[0])){
                                            $picture[0] = 'default1.png';
                                            }else{
                                                $picture[0] = str_replace("pralisting/emitens_pictures/", "", $picture[0]);
                                                
                                            }
                                            if(empty($picture[1])){
                                                $picture[1] = 'default2.png';
                                            }else{
                                              $picture[1] = str_replace("pralisting/emitens_pictures/", "", $picture[1]);
                                            }
                                            if(empty($picture[2])){
                                                $picture[2] = 'default.png';
                                            }else{
                                              $picture[2] = str_replace("pralisting/emitens_pictures/", "", $picture[2]);
                                            }
                                            if(empty($picture[3])){
                                                $picture[3] = 'default.png';
                                            }else{
                                              $picture[3] = str_replace("pralisting/emitens_pictures/", "", $picture[3]);
                                            }
                                            if(empty($picture[4])){
                                                $picture[4] = 'default.png';
                                            }else{
                                                // $picture[4];
                                                $picture[4] = str_replace("pralisting/emitens_pictures/", "", $picture[4]);
                                            }
                                            if(empty($picture[5])){
                                                $picture[5] = 'default.png';
                                            }else{
                                                // $picture[5]
                                                $picture[5] = str_replace("pralisting/emitens_pictures/", "", $picture[5]);
                                            }
                                            if(empty($picture[6])){
                                                $picture[6] = 'default1.png';
                                            }else{
                                                // $picture[6];
                                                $picture[6] = str_replace("pralisting/emitens_pictures/", "", $picture[6]);
                                            }

                                            if(empty($cs->trademark)){
                                                $cs->trademark = $cs->company_name;
                                            }else{
                                                $cs->trademark;
                                            }

                                            
                                            ?>

                <div class="item">
                  <a data-toggle="modal" id="detail" class="mod moldla" style="width: 100%;"
                    data-target="#exampleModalCenter" data-category="<?=$cs->ctg->category?>"
                    data-trademark="<?=$cs->trademark?>" data-company_name="<?=$cs->company_name?>"
                    data-like="<?=$cs->likes?>" data-minat="<?=$cs->vot?>" data-comment="<?=$cs->cmt?>"
                    data-id="<?=$cs->id?>" data-trdlike="<?=$cs->trdlike?>" data-trdvot="<?=$cs->trdvot?>"
                    data-image="<?=$picture[0]?>">
                    <div class="card moldla">
                      <img class="rectangle-2 moldla" src="{{env("PATH_WEB")}}{{$picture[0]}}" onerror="this.onerror=null;this.src='{{env('PATH_WEB_PROD')}}{{$picture[0]}}'"/>
                    </div>
                  </a>
                  <a href="{{ url('detail-coming-soon') }}/{{$cs->id}}" class="molpli">
                    <div class="card molpli">
                      <img class="rectangle-2" src="{{env("PATH_WEB")}}{{$picture[0]}}" onerror="this.onerror=null;this.src='{{env('PATH_WEB_PROD')}}{{$picture[0]}}'"/>
                      <div class="content">
                        <div class="header-card-dan-progress">
                          <div class="header-and-tags">
                            <span class="tx-t inter-medium-sweet-pink-12px"
                              style="background: var(--falu-red);
                  border-radius: 10px; box-shadow: 10px 0 0 var(--falu-red), 0px 0 0 var(--falu-red); line-height : 20px; padding-left:10px;">
                              <?php echo \Illuminate\Support\Str::limit(strip_tags( $cs->ctg->category ), 20, $end='...') ?>
                            </span>
                            <div class="header">
                              <div class="saka-logistics inter-medium-alabaster-20px">
                                <span class="tx-pt inter-medium-alabaster">
                                  <?php echo \Illuminate\Support\Str::limit(strip_tags( $cs->trademark ), 20, $end='...') ?>
                                </span>
                              </div>
                              <div class="pt-saka-multitrans-nusantara inter-normal-quill-gray-12px">
                                <span class="tx-np inter-normal-quill-gray">
                                  <?php echo \Illuminate\Support\Str::limit(strip_tags( $cs->company_name ), 30, $end='...') ?>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="icon-card row" style="display: flex;
                justify-content: center;
                align-items: center;    width: auto;">
                            @guest
                            <a href="{{route('login')}}" style="cursor: pointer">
                              <div class="icon-and-supporting-text">
                                <i class="icon-com iconheart fas fa-heart" style="color: #fff; font-size: 18px;"></i>
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
                              <a onclick="document.getElementById('like{{$cs->id}}').submit();" style="cursor: pointer">
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
                                    <i class="icon-com iconheart fas fa-user" style="color: #fff; font-size: 18px;"></i>
                                    <div class="address-2 inter-normal-alabaster-10px">
                                      <span class="tx-icon inter-normal-alabaster">{{$cs->vot}} Minat</span>
                                    </div>
                                  </div>
                                </a>
                                @else
                                {{-- @if (in_array(Auth::user()->trader->id,[$cs->trdvote])) --}}

                                {{-- <a onclick="document.getElementById('subvote{{$cs->id}}').submit();"
                                  style="cursor: pointer">
                                  @else
                                  <a onclick="document.getElementById('vote{{$cs->id}}').submit();"
                                    style="cursor: pointer">
                                    @endif --}}
                                  <a style="cursor: pointer" data-id="{{$cs->id}}" data-toggle="modal"
                                    data-target="#mdlvot{{$cs->id}}">
                                    <div class="icon-and-supporting-text-1">
                                      <i class="icon-com iconheart fas fa-user"
                                        style="color: #fff; font-size: 18px;"></i>
                                      <div class="address-2 inter-normal-alabaster-10px">
                                        <span class="tx-icon inter-normal-alabaster">{{$cs->vot}} Minat</span>
                                      </div>
                                    </div>
                                  </a>
                                  {{-- <form id="vote{{$cs->id}}" action="{{url('addVote')}}/{{$cs->id}}" method="POST"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                  </form>
                                  <form id="subvote{{$cs->id}}" action="{{url('subVote')}}/{{$cs->id}}" method="POST"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                  </form> --}}

                                  @endguest
                                  @guest
                                  <a href="{{route('login')}}" style="cursor: pointer">
                                    <div class="icon-and-supporting-text-2">
                                      <i class="icon-com iconheart fas fa-comments"
                                      style="color: #fff; font-size: 18px;"></i>
                                      <div class="address-2 inter-normal-alabaster-10px">
                                        <span class="tx-icon inter-normal-alabaster">{{$cs->cmt}} Komentar</span>
                                      </div>
                                    </div>
                                  </a>
                                  @else
                                  <a style="cursor: pointer" data-id="{{$cs->id}}" data-toggle="modal"
                                    data-target="#modal{{$cs->id}}" class="cmt">
                                    <div class="icon-and-supporting-text-2">
                                      <i class="icon-com iconheart fas fa-comments"
                                      style="color: #fff; font-size: 18px;"></i>
                                      <div class="address-2 inter-normal-alabaster-10px">
                                        <span class="tx-icon inter-normal-alabaster">{{$cs->cmt}} Komentar</span>
                                      </div>
                                    </div>
                                  </a>
                                  @endguest
                                  <a style="cursor: pointer" data-id="{{$cs->id}}" data-toggle="modal"
                                    data-target="#modalShareButton{{$cs->id}}">
                                    <div class="icon-and-supporting-text-2">
                                      <i class="icon-com iconheart fas fa-share"
                                        style="color: #fff; font-size: 18px;"></i>
                                      <div class="address-2  inter-normal-alabaster-10px">
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
</div>

<div class="fashion_section">
  <div id="jewellery_main_slider" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="container">
          <div class="col-12 d-flex justify-content-between">
            <div class="now-playing inter-bold-alabaster-24px">
              <span class="tx-lf inter-bold-alabaster">Sold Out ({{count($sold_out)}})</span>
            </div>


            <div class="investasi-sekarang inter-bold-thunderbird-16px button-4 seemore">
              <a href="{{ route('sold-out.index') }}" class="tx-rg inter-bold-white">Lihat Semua
                &nbsp&nbsp<i class="fas fa-arrow-right"></i></a>
            </div>
            </a>
          </div>
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


                <a data-toggle="modal" id="detail_sold" style="width: 100%;" class="mod_sold detail_sold moldla"
                    data-target="#modal_sold{{$item->id}}">
                    <div class="card moldla">
                      <img class="rectangle-2 moldla"
                        src="https://storage.googleapis.com/asset-santara/santara.co.id/token/{{$picture[0]}}" />
                    </div>
                  </a>

                  <a type="button" class="molpli" href="{{ url('detail-sold-out') }}/{{$item->id}}">
                    <div class="card molpli">
                      <img class="rectangle-2"
                        src="https://storage.googleapis.com/asset-santara/santara.co.id/token/{{$picture[0]}}" />
                      <div class="content">
                        <div class="header-card-dan-progress-2">
                          <div class="header-and-tags">
                            <span class="tx-t inter-medium-sweet-pink-12px"
                              style="background: var(--falu-red);
            border-radius: 10px; box-shadow: 10px 0 0 var(--falu-red), 0px 0 0 var(--falu-red); line-height : 20px; padding-left:10px;">
                              <?php echo \Illuminate\Support\Str::limit(strip_tags( $item->ktg ), 20, $end='...') ?>
                            </span>
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
                            <div class="mul inter-normal-mercury-12px">
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
                                class="inter-medium-alabaster-12px">Rp{{number_format(round($item->dvd),0,',','.')}}</span>
                            </div>
                            <div class="pembagian-dividen-1-kali inter-normal-mercury-10px">
                              <span class="inter-normal-quill-gray-12px">Pembagian Dividen<br /></span><span
                                class="inter-medium-alabaster-12px">{{$item->dvc}} Kali</span>
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
    <div class="but-pag">
      <a class="carousel-control-next border-1px-cape-cod inter-medium-alabaster-14px customNextBtn"
        href="#jewellery_main_slider" role="button" data-slide="next">Next &nbsp&nbsp<i class="fas fa-arrow-right"></i>
      </a>
      <a class="carousel-control-prev border-1px-cape-cod inter-medium-alabaster-14px customPreviousBtn"
        href="#jewellery_main_slider" role="button" data-slide="prev"><i class="fas fa-arrow-left"></i>&nbsp&nbsp Prev
      </a>
    </div>
  </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Maaf</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Tidak tersedia pada event ini.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@foreach ($soon as $item)

<div class="modal fade" id="mdlvot{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{$item->company_name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @guest
      <?php 
      $s['m'] = 0;
      ?>
      @else
      <?php 
      $value = db::table('emiten_votes')->where('emiten_id',$item->id)
      ->where('trader_id',Auth::user()->trader->id)
      ->select(db::raw('COALESCE(minat,0) as m'))
      ->first();
      
      // print_r($value)
      $s = json_decode(json_encode($value), true);
      // print_r($s['m']);
      if ($s['m'] != null) {
        $s['m'];
      }else{
        $s['m'] = 0;
      }
      ?>
      @endguest
      

      <form action="{{url('addVot')}}/{{$item->id}}" method="POST"
        enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-body">
          {{-- Tidak tersedia pada event ini. {{$item->id}} --}}
          <label for="minat">Lembar yang anda minat</label>
          <input type="number" name="minat" class="form-control" value="{{$s['m']}}">
          {{-- <div class="input-group mb-3 text-center" style="width:80%">
            <span style="cursor: pointer" class="input-group-text jumlah-range" onclick="minusx()">--</span>
            <span style="cursor: pointer" class="input-group-text jumlah-range" onclick="minus()">-</span>
            <input type="text" class="form-control text-center number-only-phone" style="background-color: #fff;"
              id="jumlah_saham" value="{{$s['m']}}" disabled aria-label="Lembar saham">
            <input type="hidden" id="lembar_saham" name="minat">
            <span class="input-group-text jumlah-range" style="cursor: pointer" onclick="plus()">+</span>
            <span class="input-group-text jumlah-range" style="cursor: pointer" onclick="plusx()">++</span>
          </div> --}}
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Send</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

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
                      <img width="50px" src="https://old.santara.co.id/assets/new-santara/img/sosmed/instagram.png" />
                      <p class="ff-n fs-12 mt-2" style="color: #708088;">Instagram</p>
                  </div> -->
              <div class="col-4 col-md-2">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{url('detail-coming-soon')}}/{{$item->id}}"
                  id="shareFacebook" target="_blank" style="text-decoration: none;">
                  <img width="50px" src="https://old.santara.co.id/assets/new-santara/img/sosmed/facebook.png"
                    class="lazyload">
                  <p class="ff-n fs-12 mt-2" style="color: #708088;">Facebook</p>
                </a>
              </div>
              <div class="col-4 col-md-2">
                <a href="https://twitter.com/intent/tweet?url={{url('detail-coming-soon')}}/{{$item->id}}&amp;text=Temukan%20peluang%20investasi%20berikut%20di%20Santara!%0A PT. Lembu Sora Lampung"
                  id="shareTwitter" style="text-decoration: none;" target="_blank">
                  <img width="50px" src="https://old.santara.co.id/assets/new-santara/img/sosmed/twitter.png"
                    class="lazyload">
                  <p class="ff-n fs-12 mt-2" style="color: #708088;">Twitter</p>
                </a>
              </div>
              <div class="col-4 col-md-2">
                <a href="https://telegram.me/share/url?url={{url('detail-coming-soon')}}/{{$item->id}}&amp;text=Temukan%20peluang%20investasi%20berikut%20di%20Santara!%0A PT. Lembu Sora Lampung"
                  id="shareTelegram" target="_blank" style="text-decoration: none;">
                  <img width="50px" src="https://old.santara.co.id/assets/new-santara/img/sosmed/telegram.png"
                    class="lazyload">
                  <p class="ff-n fs-12 mt-2" style="color: #708088;">Telegram</p>
                </a>
              </div>
              <!-- <div class="col-4 col-md-2">
                      <img width="50px" src="https://old.santara.co.id/assets/new-santara/img/sosmed/tiktok.png" />
                      <p class="ff-n fs-12 mt-2" style="color: #708088;">TikTok</p>
                  </div> -->
              <div class="col-4 col-md-2">
                <a href="https://web.whatsapp.com/send?text=Temukan%20peluang%20investasi%20berikut%20di%20Santara!%0A {{url('detail-coming-soon')}}/{{$item->id}}"
                  id="shareWhatsapp" target="_blank" style="text-decoration: none;">
                  <img width="50px" src="https://old.santara.co.id/assets/new-santara/img/sosmed/whatsapp.png"
                    class="lazyload">
                  <p class="ff-n fs-12 mt-2" style="color: #708088;">WhatsApp</p>
                </a>
              </div>
            </div>
            <div class="input-group input-group-lg mb-3">
              <input type="text" id="inputShareLink" class="form-control fs-16 bold ff-n" disabled=""
                style="border-radius: 25px;padding-right:150px" aria-label="Recipient's username"
                aria-describedby="basic-addon2" placeholder="{{url('detail-coming-soon')}}/{{$item->id}}">
              <span id="copy-link" class="input-group-text"
                style="position: inherit;height: 33px;justify-content: center;align-items: center;margin: 10px 17px 10px -134px;border-radius: 20px;color: #BF2D30;border-color: #BF2D30; cursor:pointer"
                onclick="shareButton('{{url('detail-coming-soon')}}/{{$item->id}}')">Copy Link</span>
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
                <div class="icon-card row" style="display: flex;
                justify-content: center;
                align-items: center;width:auto;">
                  @guest
                  <a class="col-3" href="{{route('login')}}" style="cursor: pointer">
                    <div class="icon-and-supporting-text">
                      <i class="icon-com iconheart fas fa-heart" style="color: #fff; font-size: 18px;"></i>
                      <div class="address-2 inter-normal-alabaster-10px">
                        <span class="tx-icon inter-normal-alabaster" id="like" style="margin-left:2px;"> Suka</span>
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
                          <div class="address-2 inter-normal-alabaster-10px">
                            <span class="tx-icon inter-normal-alabaster" id="like" style="margin-left:2px;"> Suka</span>
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
                          <div class="address-2 inter-normal-alabaster-10px">
                            <span class="tx-icon inter-normal-alabaster" id="minat"> Minat</span>
                          </div>
                        </div>
                      </a>
                      @else
                      {{-- @if (in_array(Auth::user()->trader->id,[$cs->trdvote]))

                      <a class="col-3" onclick="document.getElementById('subvote{{$cs->id}}').submit();"
                        style="cursor: pointer">
                        @else
                        <a class="col-3" onclick="document.getElementById('vote{{$cs->id}}').submit();"
                          style="cursor: pointer">
                          @endif
                          <div class="icon-and-supporting-text-1">
                            <i class="icon-com iconheart fas fa-user" style="color: #fff; font-size: 18px;"></i>
                            <div class="address-2 inter-normal-alabaster-10px">
                              <span class="tx-icon inter-normal-alabaster" id="minat"> Minat</span>
                            </div>
                          </div>
                        </a> --}}
                        {{-- <form id="vote{{$cs->id}}" action="{{url('addVote')}}/{{$cs->id}}" method="POST"
                          enctype="multipart/form-data">
                          {{ csrf_field() }}
                        </form>
                        <form id="subvote{{$cs->id}}" action="{{url('subVote')}}/{{$cs->id}}" method="POST"
                          enctype="multipart/form-data">
                          {{ csrf_field() }}
                        </form> --}}
                        <a style="cursor: pointer" data-toggle="modal"
                          data-target="#mdlvot" data-dismiss="modal" id="mdlvotbtn">
                          <div class="icon-and-supporting-text-1">
                            <i class="icon-com iconheart fas fa-user"
                              style="color: #fff; font-size: 18px;"></i>
                            <div class="address-2 inter-normal-alabaster-10px">
                              <span class="tx-icon inter-normal-alabaster">{{$cs->vot}} Minat</span>
                            </div>
                          </div>
                        </a>

                        @endguest
                        <a class="col-3" style="cursor: pointer" data-id="{{$cs->id}}" id="mct" data-toggle="modal"
                          data-dismiss="modal" data-target="#modal" class="cmt">
                          <div class="icon-and-supporting-text-2">
                            <i class="icon-com iconheart fas fa-comments" style="color: #fff; font-size: 18px;"></i>
                            <div class="address-2 inter-normal-alabaster-10px">
                              <span class="tx-icon inter-normal-alabaster" id="comments" style="margin-left:5px;">
                                Komentar</span>
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

  @foreach ($now_playing as $np)
    <?php
    $now      = new DateTime(); // or your date as well
        $start    = new DateTime($np['begin_period']);
        $finish   = new DateTime($np['end_period']);
        $period   = $finish->format('d M Y');
        $offer   = $start->format('d M Y');
        $supply   = $np['supply'] * $np['price'];
        $start_offer = $start->format("Y-m-d");
        $str_time    = strtotime($start_offer);

        $diff_now              = $finish->diff($now);
        $diff                    = "0 Hari";
        // var_dump($np->created_at);
        $tersisa = ($np['supply'] - $np['terjual'] > 0) ? ($np['supply'] - $np['terjual']) : 0;
        $terjual = ($np['terjual'] > $np['supply']) ? $np['supply'] : $np['terjual'];
        // terjual dalam persen 0 -100
        $terjual_percentage = ($terjual / $np['supply']) * 100;
        $terjual_percentage = ($terjual_percentage >= 0) ? ($terjual_percentage > 100 ? 100 : $terjual_percentage) : 0;

        $tersisa_percentage = number_format($tersisa / $np['supply'] * 100, 2, ',', '.');
        $tersisa_total = number_format($tersisa, 0, ',', '.');
        $tersisa_total_rp = number_format($tersisa * $np['price'], 0, ',', '.');
        $terjual_percentage_f = number_format($terjual_percentage, 2, '.', ',');
        // $terjual_percentage_f = number_format($terjual_percentage, 3, '.', ',');
        $terjual_percentage = number_format($terjual_percentage, 2, ',', '.');
        $terjual_total = number_format($terjual, 0, ',', '.');
        $terjual_total_rp = number_format($terjual * $np['price'], 0, ',', '.');
        if (($now > $start) && ($now < $finish)) {
            if ($np['terjual'] < $np['supply']) {
                $format = ($diff_now->days > 0) ? "%a Hari" : "%h Jam %i Menit";
                $diff = $diff_now->format($format);
            }
        };
        $emj = db::table('emiten_journeys')->select('*')->where('emiten_id',$np['id'])
                ->whereRaw('created_at = (SELECT max(created_at) from emiten_journeys
                where emiten_id = '.$np['id'].')')
                ->first(); 
                
                if($emj){

        }else{
          $emj = new \stdClass();
          $emj->date = '2019-10-01 14:20:35';
          $emj->end_date = '2019-10-01 14:20:35';
          // $emj->date = $emj["date"];
          // $emj->end_date = $emj["end_date"];
        }
        ?>
    <div class="modal fade" id="modal_now{{$np['id']}}" tabindex="-1" role="dialog" aria-labelledby="detail_now"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="card" style="margin-bottom: -1px;">
            <img class="rectangle-2" src="{{$np['pictures'][0]['picture']}}" />
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
              style="margin-right: 10px; margin-top: 0px; width: 30px;">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="content2">
              <div class="header-card-dan-progress">
                <div class="header-and-tags">
                  <span class="tx-t inter-medium-sweet-pink-12px"
                    style="background: var(--falu-red);
    border-radius: 10px; box-shadow: 10px 0 0 var(--falu-red), 0px 0 0 var(--falu-red); line-height : 20px; padding-left:10px;">{{$np['category']}}</span>
                  <div class="header">
                    <div class="saka-logistics inter-medium-alabaster-20px">
                      <span class="tx-pt inter-medium-alabaster">
                        {{ $np['trademark'] }}
                      </span>
                    </div>
                    <div class="pt-saka-multitrans-nusantara inter-normal-quill-gray-12px">
                      <span class="tx-np inter-normal-quill-gray">
                        {{ $np['company_name']}}
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
                          style="font-weight: bold">Rp
                          {{number_format(round(100 * $np['price'],0),0,',','.')}}</span>
                      </div>
                    </div>
                  </div>
                  <div class="address">
                    <div class="hr inter-bold-white-14px">
                      <span class="tx-sold inter-medium-white"><b style="font-weight: bold">
                          <?php 
                                                      $now = time();
                                                      $start = strtotime($emj->date);
                                                      $end = strtotime($emj->end_date);
                                                      $datediff = $end - $start;
                                                      ?>
                          {{round($datediff / (60 * 60 * 24))}}
                          {{-- {{abs(strtotime($np->begin_period) - strtotime($np->end_period))}} --}}
                          {{-- 45 --}}
                          {{-- {{$diff}} --}}
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
                        style="width: {{$terjual_percentage_f}}%; background-color:#bf2d30; border-radius: 8px; height: 16px;"
                        role="progressbar" aria-valuenow="{{$terjual_percentage_f}}" aria-valuemin="0"
                        aria-valuemax="100">

                        {{-- {{ round((round($np->terjual,0)/round($np->avg_capital_needs,0))*100,2) }} --}}
                        {{-- @if (($np->per*100) == 0.0)
                        0
                        @else
                        {{round($np->per,4)*100}}
                        @endif --}}
                        {{-- 0 --}}
                        {{$terjual_percentage}}
                        %
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
                      class="inter-medium-alabaster-12px">Rp{{number_format($np['supply'] * $np['price'], 0, ',',
                      '.')}}</span>
                  </div>
                  <div class="periode-dividen-6-bulan inter-normal-mercury-10px">
                    <span class="inter-normal-quill-gray-12px">Periode Dividen<br /></span><span
                      class="inter-medium-alabaster-12px">{{$np['period']}}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="background-color: var(--shark);">
            <a class="b-daf btn btn-danger btn-lg btn-block"
              href="{{url('detail-now-playing')}}/{{$np['id']}}">Selengkapnya</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach

  @foreach ($sold_out as $item)
    <?php 
        $picture = explode(',',$item->pictures);
        $tot=number_format(round($item->supply * $item->price),0,',','.');
    ?>

    <div class="modal fade" id="modal_sold{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="detail_sold"
          aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="card" style="margin-bottom: -1px;">
            <img class="rectangle-2" src="https://storage.googleapis.com/asset-santara/santara.co.id/token/{{$picture[0]}}" />
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
              style="margin-right: 10px; margin-top: 0px; width: 30px;">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="content2">
              <div class="header-card-dan-progress-2">
                <div class="header-and-tags">
                  <span class="tx-t inter-medium-sweet-pink-12px"
                    style="background: var(--falu-red);
    border-radius: 10px; box-shadow: 10px 0 0 var(--falu-red), 0px 0 0 var(--falu-red); line-height : 20px; padding-left:10px;">{{$item->ktg}}</span>
                  <div class="header">
                    <div class="saka-logistics inter-medium-alabaster-20px">
                      <span class="tx-pt inter-medium-alabaster"> {{$item->trademark}}
                      </span>
                    </div>
                    <div class="pt-saka-multitrans-nusantara inter-normal-quill-gray-12px">
                      <span class="tx-np inter-normal-quill-gray"> {{$item->company_name}}
                      </span>
                    </div>
                  </div>
                </div>
                <div class="info-pendanaan">
                            <div class="mul inter-normal-mercury-12px">
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
                  <div class="total-pendanaan-rp3000000000 inter-normal-mercury-12px">
                    <span class="inter-normal-quill-gray-12px">Deviden Dibagikan<br /></span><span
                      class="inter-medium-alabaster-12px">Rp{{number_format(round($item->dvd),0,',','.')}}</span>
                  </div>
                  <div class="periode-dividen-6-bulan inter-normal-mercury-10px">
                    <span class="inter-normal-quill-gray-12px">Pembagian Dividen<br /></span><span
                      class="inter-medium-alabaster-12px">{{$item->dvc}} Kali</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="background-color: var(--shark);">
            <a class="b-daf btn btn-danger btn-lg btn-block" href="{{ url('detail-sold-out') }}/{{$item->id}}">Selengkapnya</a>
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
      $('#image').prop('src', '{{env("PATH_WEB")}}' + image);
      $('#image').on("error", function(){
        $(this).prop('src', '{{env("PATH_WEB_PROD")}}'+ image);
      });
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
      $("#mdlvotbtn").attr('data-target', "#mdlvot"+id).attr('data-id', id);
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
  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 3,
      spaceBetween: 30,
      pagination: {
          el: ".swiper-pagination",
          clickable: true,
      },
      autoplay: {
          delay: 2500,
          disableOnInteraction: false,
      },
      breakpoints: {
          "@0.00": {
              slidesPerView: 1,
              spaceBetween: 10,
          },
          "@0.75": {
              slidesPerView: 2,
              spaceBetween: 20,
          },
          "@1.00": {
              slidesPerView: 3,
              spaceBetween: 40,
          },
          "@1.50": {
              slidesPerView: 3,
              spaceBetween: 50,
          },
      },
  });

  function checkValidasi(total) {
      const total_price = document.getElementById("total_harga_saham");
      const detail_price = document.getElementById("detail-price");
      const alertmaks = document.getElementById("alertmaks");

      total_price.value = parseInt(total) * parseInt(detail_price.value);
      if (!isNaN(total_price.value) && total_price.value > 0) {
          btnbeli.disabled = false;
          var invest_value = parseInt(total);
          var maksimal_token_value = parseInt(
              maksimal_token.innerHTML.replace(/\./g, "")
          );
          var minimum_invest_value = parseInt(
              minimum_invest.innerHTML.replace(/\./g, "")
          );

          if (invest_value > maksimal_token_value) {
              alertmaks.innerHTML = `<i class="la la-exclamation-triangle"></i> Maksimal <strong>${maksimal_token.innerHTML} Lembar</strong>`;
              alertmaks.style.display = "block";
              $('#jumlah_saham').addClass('is-invalid')
              total_price.value = 0;
              btnbeli.disabled = true;
          } else if (maksimal_token_value > minimum_invest_value) {
              if (invest_value >= minimum_invest_value) {
                  alertmaks.style.display = "none";
                  btnbeli.disabled = false;
                  $('#jumlah_saham').addClass('is-valid')
                  $('#jumlah_saham').removeClass('is-invalid')

              } else {
                  alertmaks.innerHTML = `<i class="la la-exclamation-triangle"></i> Minimal <strong>${minimum_invest.innerHTML} Lembar</strong>`;
                  alertmaks.style.display = "block";
                  $('#jumlah_saham').addClass('is-invalid')
                  btnbeli.disabled = true;
                  total_price.value = 0;
              }
          } else {
              alertmaks.style.display = "none";
              $('#jumlah_saham').addClass('is-valid')
              $('#jumlah_saham').removeClass('is-invalid')
          }

          total = formatNumber(total);
          total_price.value = formatNumber(
              parseInt(total_price.value)
          );
      } else {
          total_price.value = 0;
      }
  };

  const kelipatan = 100;
  const kelipatanx = 1000;

  function minus() {
      let jumlah = $('#jumlah_saham').val();
      if (jumlah == '') {

      }
      jumlah.replace(/^0+/, "");
      jumlah.replace(/\./g, "");
      total = parseInt(jumlah) - parseInt(kelipatan)
      if (parseInt(jumlah) == 100) {
          $('#jumlah_saham').val(100)
          $('#lembar_saham').val(100);
      } else {
          $('#jumlah_saham').val(total)
          $('#lembar_saham').val(total);
      }
      checkValidasi(total)
  }
  function minusx() {
      let jumlah = $('#jumlah_saham').val();
      if (jumlah == '') {

      }
      jumlah.replace(/^0+/, "");
      jumlah.replace(/\./g, "");
      total = parseInt(jumlah) - parseInt(kelipatanx)
      if (parseInt(jumlah) == 100) {
          $('#jumlah_saham').val(100)
          $('#lembar_saham').val(100);
      } else {
          $('#jumlah_saham').val(total)
          $('#lembar_saham').val(total);
      }
      checkValidasi(total)
  }

  function plus() {
      let jumlah = $('#jumlah_saham').val();
      total = parseInt(jumlah) + parseInt(kelipatan);
      $('#jumlah_saham').val(total)
      $('#lembar_saham').val(total);
      checkValidasi(total)
  }
  function plusx() {
      let jumlah = $('#jumlah_saham').val();
      total = parseInt(jumlah) + parseInt(kelipatanx);
      $('#jumlah_saham').val(total)
      $('#lembar_saham').val(total);
      checkValidasi(total)
  }
  </script>

  @endsection