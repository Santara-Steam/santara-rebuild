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
            <span class="text-sb inter-normal-alabaster">Platform Equity Crowdfunding pertama yang berizin dan diawasi Otoritas Jasa Keuangan berdasarkan Surat Keputusan Nomor:
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
                      <a href="{{ route('coming-soon.detail') }}">
                        <div class="card">
                          <img class="rectangle-2" src="{{ asset('public/upload') }}/{{$picture[3]}}" />
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
                                      <form id="subvote{{$cs->id}}" action="{{url('subVote')}}/{{$cs->id}}"
                                        method="POST" enctype="multipart/form-data">
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
                                      <div class="icon-and-supporting-text-1">
                                        <i class="icon-com iconheart fas fa-share"
                                          style="color: #fff; font-size: 18px;"></i>
                                        <div class="share inter-normal-alabaster-10px">
                                          <span class="tx-icon inter-normal-alabaster">Share</span>
                                        </div>
                                      </div>
                              </div>
                            </div>
                            <div class="footer-card-3">
                              <img class="divider" src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                              <span class="button btn btn-outline-light btn-au inter-medium-white-14px">Dukung Bisnis
                                Ini</span>
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
        <h5 class="modal-title">Comment {{$item->id}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <textarea name="comment" class="form-control" id="" cols="30" rows="10"></textarea><br>
        <button type="button" id="crop" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

</div>
@endforeach

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
                  $('.modal-body').html(cmt); 

                  // Display Modal
                  // $('#empModal').modal('show'); 
                  // console.log(cmt);
              }
          });
      });
  });
</script>
@endsection