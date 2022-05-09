@extends('front_end/template_front_end/app')

@section('content')
<div class="header-section" style="margin-top: 96px;">
  <div class="heading-and-subheading">
    <div class="now-playing-bisnis inter-bold-alizarin-crimson-16px">
      <span class="inter-bold-alizarin-crimson-16px">Coming Soon Bisnis</span>
    </div>
    <div class="text-urun pilih-bisnis-favoritmu inter-bold-alabaster-48px">
      <span class="text-sb inter-bold-alabaster">Pilih Bisnis Favoritmu</span>
    </div>
  </div>
  <div class="text-mulai inter-normal-alabaster-20px">
    <span class="text-mulai inter-normal-alabaster">Ayo dukung bisnis favoritmu agar naik menjadi Penerbit!</span>
  </div>
</div>
</div>

<div class="fashion_section">
  <div id="jewellery_main_slider" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="container">
          {{-- <a class="btn btn-primary" id="testajax">tes</a> --}}
          <form role="form" method="get" action="{{ route('coming-soon.index') }}" id="form_id">
            @csrf
            <div class="form-row">
              <div class="form-group col-md-4">
                <div class="label inter-medium-quill-gray-14px">
                  <span class="inter-medium-quill-gray-14px">Cari Bisnis</span>
                </div>
                <input type="search" value="{{Request::get('cari')}}" name="cari"
                  class="form-control input-1 border-1px-cape-cod inter-normal-delta-16px"
                  style="background: #1b1a1a; color: var(--quill-gray);" id="iconified" placeholder="Cari" />
              </div>
              <div class="form-group col-md-3 kati">
              </div>
              <div class="form-group col-md-3">
                <div class="label-1 inter-medium-quill-gray-14px">
                  <span class="inter-medium-quill-gray-14px">Kategori</span>
                </div>
                <select name="categor" id="inputState" class="form-control dropdown-1"
                  onChange=" document.getElementById('form_id').submit();">
                  <option value="">Semua Kategori</option>
                  @foreach ($cat as $cate)
                  <option type="submit" <?PHP echo (Request::get('categor')==$cate->id)? 'selected': ''; ?>
                    value="{{$cate->id}}" >{{$cate->category}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-2">
                <div class="label-1 inter-medium-quill-gray-14px">
                  <span class="inter-medium-quill-gray-14px">Urutkan</span>
                </div>
                <select name="sort" id="inputState" class="form-control dropdown-1"
                  onChange=" document.getElementById('form_id').submit();">
                  {{-- <option value="{{old('sort')}}" hidden>{{old('sort')}}</option> --}}
                  <option value="desc" <?PHP echo (Request::get('sort')=='desc' )? 'selected' : '' ; ?>>Terbaru</option>
                  <option value="asc" <?PHP echo (Request::get('sort')=='asc' )? 'selected' : '' ; ?>>Terlama</option>
                  {{-- <option value="terpenuhi">Terpenuhi</option> --}}
                  {{-- <option value="position">Belum Terpenuhi</option> --}}
                </select>
              </div>
            </div>
          </form>

          <div class="fashion_section_2" id="first">
            <div class="row" style="padding-left: 10px; padding-right: 10px;">
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

              <div class="col-lg-3 col-sm-6 col-6" style="padding: 5px;">
                <a data-toggle="modal" id="detail" class="mod moldla" style="width: 100%;"
                  data-target="#exampleModalCenter" data-category="<?=$cs->ctg->category?>"
                  data-trademark="<?=$cs->trademark?>" data-company_name="<?=$cs->company_name?>"
                  data-like="<?=$cs->likes?>" data-minat="<?=$cs->vot?>" data-comment="<?=$cs->cmt?>"
                  data-id="<?=$cs->id?>" data-trdlike="<?=$cs->trdlike?>" data-trdvot="<?=$cs->trdvot?>"
                  data-image="<?=$picture[0]?>">
                  <div class="card moldla">
                    <img class="rectangle-2 moldla"
                      src="{{env("PATH_WEB")}}{{$picture[0]}}" onerror="this.onerror=null;this.src='{{env('PATH_WEB_PROD')}}{{$picture[0]}}'"/>
                  </div>
                </a>
                <a href="{{ url('detail-coming-soon') }}/{{$cs->id}}" class="molpli">
                  <div class="card molpli">
                    <img class="rectangle-2" src="{{env("PATH_WEB")}}{{$picture[0]}}"  onerror="this.onerror=null;this.src='{{env('PATH_WEB_PROD')}}{{$picture[0]}}'"/>
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
                                  align-items: center;width:auto;">
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

                          <a onclick="document.getElementById('sublike{{$cs->id}}').submit();" style="cursor: pointer">
                            @else
                            <a onclick="document.getElementById('like{{$cs->id}}').submit();" style="cursor: pointer">
                              @endif

                              {{-- <a onclick="document.getElementById('like{{$cs->id}}').submit();"
                                style="cursor: pointer"> --}}
                                <div class="icon-and-supporting-text">
                                  <i class="icon-com iconheart fas fa-heart" style="color: #fff; font-size: 18px;"></i>
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
                              @if (in_array(Auth::user()->trader->id,[$cs->trdvote]))

                              <a onclick="document.getElementById('subvote{{$cs->id}}').submit();"
                                style="cursor: pointer">
                                @else
                                <a onclick="document.getElementById('vote{{$cs->id}}').submit();"
                                  style="cursor: pointer">
                                  @endif
                                  <div class="icon-and-supporting-text-1">
                                    <i class="icon-com iconheart fas fa-user" style="color: #fff; font-size: 18px;"></i>
                                    <div class="address-2 inter-normal-alabaster-10px">
                                      <span class="tx-icon inter-normal-alabaster">{{$cs->vot}} Minat</span>
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
          {{-- <div class="fashion_section_2" id="second">

          </div> --}}
        </div>
      </div>
    </div>
  </div>
</div>

@if (count($soon) == 0)
<div class="ayo-daftarkan-bisnis-anda inter-medium-white-14px">
  <span class="text-urun inter-normal-alabaster">Data tidak ditemukan!</span>
</div>
<div class="actions3 ">
  <a class="btn btn-danger btn-sm btn-block" href="{{ route('coming-soon.index') }}">Tampilkan Semua</a>
</div>
</div>
@else
@if (count($soon) != $s)

<div class="actions3 ">
  <a class="btn btn-danger btn-sm btn-block" href="{{ route('coming-soon.index') }}">Tampilkan Semua</a>
</div>
</div>
@endif
@endif
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
    @endforeach

    @foreach ($soon as $cs)

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
                      @if (in_array(Auth::user()->trader->id,[$cs->trdvote]))

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

                        @guest
                        <a class="col-3" href="{{route('login')}}" style="cursor: pointer">
                          <div class="icon-and-supporting-text-2">
                            <i class="icon-com iconheart fas fa-comments" style="color: #fff; font-size: 18px;"></i>
                            <div class="address-2 inter-normal-alabaster-10px">
                              <span class="tx-icon inter-normal-alabaster" id="comments" style="margin-left:5px;">
                                Komentar</span>
                            </div>
                          </div>
                        </a>
                        @else
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
                        @endguest

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
  @section('js')
  <script>
// $("#testajax").click(function (e) {
//  console.log('tes');
// // AJAX request
// $.post("/bisnis/getBisnis")
//         .done(function (data) {
//           console.log('tess');
//         });
// });
  </script>

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
    $('#iconified').on('keyup', function() {
          var input = $(this);
          if(input.val().length === 0) {
              input.addClass('empty');
          } else {
              input.removeClass('empty');
          }
      });
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
  @endsection