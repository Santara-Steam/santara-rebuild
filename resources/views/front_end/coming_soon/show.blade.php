@extends('front_end/template_front_end/app')

@section('content')
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
          <img class="image-69"
            src="https://storage.googleapis.com/asset-santara/santara.co.id/images/error/no-image-user-small.png" />
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
      <div class="col-lg-6 col-sm-6 container">
        <div class="info-deviden border-1px-cape-cod">
          <div class="pembagian-deviden-1 inter-medium-alabaster-18px">
            <span class="inter-medium-alabaster-18px">Informasi Bisnis:</span>
          </div>
          <div class="table-2">
            <div class="table-cell-row-1">
              <div class="table-cell">
                <p class="pembagian-deviden-ta inter-normal-delta-12px">
                  <span class="inter-normal-delta-12px">Saham yang dilepas</span><br><span
                    class="inter-normal-delta-12px"
                    style="font-weight: bold; color: #fff">{{round($emt->avg_general_share_amount,0)}}%</span>
                </p>
              </div>
              <div class="table-cell">
                <p class="pembagian-deviden-ta inter-normal-delta-12px">
                  <span class="inter-normal-delta-12px">Perkiraan omzet penerbit</span><br><span
                    class="inter-normal-delta-12px"
                    style="font-weight: bold; color: #fff">{{number_format(round($emt->avg_turnover_after_becoming_a_publisher,0),0,',','.')}}</span>
                </p>
              </div>
            </div>
            <div class="overlap-group-3">
              <div class="table-cell-row">
                <div class="table-cell">
                  <p class="pembagian-deviden-ta inter-normal-delta-12px">
                    <span class="inter-normal-delta-12px">Perkiraan Dividen</span><br><span
                      class="inter-normal-delta-12px"
                      style="font-weight: bold; color: #fff">{{round($emt->avg_annual_dividen,0)}}%</span>
                  </p>
                </div>
                <div class="table-cell">
                  <p class="pembagian-deviden-ta inter-normal-delta-12px">
                    <span class="inter-normal-delta-12px">Dana yang dibutuhkan</span><br><span
                      class="inter-normal-delta-12px"
                      style="font-weight: bold; color: #fff">{{number_format(round($emt->avg_capital_needs,0),0,',','.')}}</span>
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
                      class="inter-medium-delta-12px"
                      style="font-weight: bold; color: #fff">{{number_format(round($emt->avg_annual_turnover_previous_year,0),0,',','.')}}</span>
                  </p>
                </div>
                <div class="table-cell" style="margin-top: 10px;">
                  <p class="pembagian-deviden-ta inter-normal-delta-12px">
                    <span class="inter-normal-delta-12px">2021:</span><br><span class="inter-normal-delta-12px"
                      style="font-weight: bold; color: #fff">{{number_format(round($emt->avg_annual_turnover_current_year,0),0,',','.')}}</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="container" style="margin-bottom: -20px;">
            <button class="btn btn-danger btn-block">Pesan Saham</button>
          </div>
        </div>
      </div>

    </div>

    

    <div class="actions-com">
      <a class="button-5 clike" data-id={{$emt->id}} id="clike" style="cursor: pointer;">
        <img class="icon-com" src="{{ asset('public/assets/images/icon-heart-47@2x.png') }}" />&ensp;
        <div class="address-1 inter-medium-eerie-black-14px">
          <span class="tx-icon inter-medium-eerie-black ">
            <p id="addcountLike" class="tx-icon">{{$clike->l}} </p>
            <p class="com-u">&ensp;Likes</p>
          </span>
        </div>
      </a>
      <a class="button-5 slike" data-id={{$emt->id}} id="slike" style="cursor: pointer;display:none;">
        <img class="icon-com" src="{{ asset('public/assets/images/icon-heart-47@2x.png') }}" />&ensp;
        <div class="address-1 inter-medium-eerie-black-14px">
          <span class="tx-icon inter-medium-eerie-black ">
            <p id="subcountLike" class="tx-icon">{{$clike->l}} </p>
            <p class="com-u">&ensp;Likes</p>
          </span>
        </div>
      </a>
      <a class="button-5" data-id={{$emt->id}} id="cvote" style="cursor: pointer;">
        <img class="ico-comn" src="{{ asset('public/assets/images/icon-user-47@2x.png') }}" />&ensp;
        <div class="address-1 inter-medium-eerie-black-14px">
          <span class="tx-icon inter-medium-eerie-black">
            <p id="addcountVote" class="tx-icon">{{$cvote->v}} </p>
            <p class="com-u">&ensp;Minat</p>
          </span>
        </div>
      </a>
      <a class="button-5" data-id={{$emt->id}} id="svote" style="cursor: pointer;display:none;">
        <img class="ico-comn" src="{{ asset('public/assets/images/icon-user-47@2x.png') }}" />&ensp;
        <div class="address-1 inter-medium-eerie-black-14px">
          <span class="tx-icon inter-medium-eerie-black">
            <p id="subcountVote" class="tx-icon">{{$cvote->v}} </p>
            <p class="com-u">&ensp;Minat</p>
          </span>
        </div>
      </a>


      <a class="button-5" style="cursor: pointer;">
        <img class="icon-com" src="{{ asset('public/assets/images/icon-message-circle-47@2x.png') }}" />&ensp;
        <div class="address-1 inter-medium-eerie-black-14px">
          <span class="tx-icon inter-medium-eerie-black">
            <p class="tx-icon">18 </p>
            <p class="com-u">&ensp;Komen</p>
          </span>
        </div>
      </a>
      <a class="button-5" style="cursor: pointer;" data-id="{{$emt->id}}" data-toggle="modal" data-target="#modalShareButton{{$emt->id}}">
        <img class="icon-com" src="{{ asset('public/assets/images/icon-share-2-47@2x.png') }}" />&ensp;
        <div class="address-1 inter-medium-eerie-black-14px">
          <span class="tx-icon inter-medium-eerie-black">
            <p class="com-u">&ensp;Share</p>
          </span>
        </div>
      </a>
    </div>
    @if ($emt->youtube == null)

    @else
    <div class="videoWrapper" style="margin-top: 100px;">
      <!-- Copy & Pasted from YouTube -->
      <iframe width="560" height="349" src="{{$emt->youtube}}" frameborder="0"
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
                    <img class="rectangle-2" src="{{ asset('public/upload') }}/{{$picture[3]}}" />
                  </div>
                  @endif
                  @if ($picture[4] == 'default.png')
                      
                  @else
                  <div class="item">
                    <img class="rectangle-2" src="{{ asset('public/upload') }}/{{$picture[4]}}" />
                  </div>
                  @endif
                  @if ($picture[5] == 'default.png')
                      
                  @else
                  <div class="item">
                    <img class="rectangle-2" src="{{ asset('public/upload') }}/{{$picture[5]}}" />
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


<div class="modal fade" id="modalShareButton{{$emt->id}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{$emt->id}}"
  aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="p-2 modal-content">
        <div class="modal-header" style="border-bottom: none;">
        </div>
        <div class="text-center modal-body ">
            <div class="d-flex justify-content-evenly mb-5">
                <div class="container  text-center d-flex justify-content-center" style="border-top: solid #D9D9D9;">
                    <h1 class="ff-a fs-24" style="font-weight:800;text-transform:uppercase; padding:0 15px 0 15px; margin-top:-20px; width:150px; background-color:#fff;color:black;font-family: inherit;">Share</h1>
                </div>
            </div>
            <div class="row mt-3 mb-3 d-flex justify-content-center ">
                <!-- <div class="col-4 col-md-2">
                    <img width="50px" src="https://santara.co.id/assets/new-santara/img/sosmed/instagram.png" />
                    <p class="ff-n fs-12 mt-2" style="color: #708088;">Instagram</p>
                </div> -->
                <div class="col-4 col-md-2">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://dev.santara.co.id/detail-coming-soon/{{$emt->id}}" id="shareFacebook" target="_blank" style="text-decoration: none;">
                        <img width="50px" src="https://santara.co.id/assets/new-santara/img/sosmed/facebook.png" class="lazyload">
                        <p class="ff-n fs-12 mt-2" style="color: #708088;">Facebook</p>
                    </a>
                </div>
                <div class="col-4 col-md-2">
                    <a href="https://twitter.com/intent/tweet?url=https://dev.santara.co.id/detail-coming-soon/{{$emt->id}}&amp;text=Temukan%20peluang%20investasi%20berikut%20di%20Santara!%0A PT. Lembu Sora Lampung" id="shareTwitter" style="text-decoration: none;" target="_blank">
                        <img width="50px" src="https://santara.co.id/assets/new-santara/img/sosmed/twitter.png" class="lazyload">
                        <p class="ff-n fs-12 mt-2" style="color: #708088;">Twitter</p>
                    </a>
                </div>
                <div class="col-4 col-md-2">
                    <a href="https://telegram.me/share/url?url=https://dev.santara.co.id/detail-coming-soon/{{$emt->id}}&amp;text=Temukan%20peluang%20investasi%20berikut%20di%20Santara!%0A PT. Lembu Sora Lampung" id="shareTelegram" target="_blank" style="text-decoration: none;">
                        <img width="50px" src="https://santara.co.id/assets/new-santara/img/sosmed/telegram.png" class="lazyload">
                        <p class="ff-n fs-12 mt-2" style="color: #708088;">Telegram</p>
                    </a>
                </div>
                <!-- <div class="col-4 col-md-2">
                    <img width="50px" src="https://santara.co.id/assets/new-santara/img/sosmed/tiktok.png" />
                    <p class="ff-n fs-12 mt-2" style="color: #708088;">TikTok</p>
                </div> -->
                <div class="col-4 col-md-2">
                    <a href="https://web.whatsapp.com/send?text=Temukan%20peluang%20investasi%20berikut%20di%20Santara!%0A https://dev.santara.co.id/detail-coming-soon/{{$emt->id}}" id="shareWhatsapp" target="_blank" style="text-decoration: none;">
                        <img width="50px" src="https://santara.co.id/assets/new-santara/img/sosmed/whatsapp.png" class="lazyload">
                        <p class="ff-n fs-12 mt-2" style="color: #708088;">WhatsApp</p>
                    </a>
                </div>
            </div>
            <div class="input-group input-group-lg mb-3">
                <input type="text" id="inputShareLink" class="form-control fs-16 bold ff-n" disabled="" style="border-radius: 25px;padding-right:150px" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="https://dev.santara.co.id/detail-coming-soon/{{$emt->id}}">
                <span id="copy-link" class="input-group-text" style="position: inherit;height: 33px;justify-content: center;align-items: center;margin: 10px 17px 10px -134px;border-radius: 20px;color: #BF2D30;border-color: #BF2D30; cursor:pointer" onclick="shareButton('https://dev.santara.co.id/detail-coming-soon/{{$emt->id}}')">Copy Link</span>
            </div>
        </div>

    </div>
</div>
@endsection
@section('js')
<script>
  $(document).ready(function(){
      $('#clike').click(function(){
         
          var id = $(this).data('id');
          let _token   = $('meta[name="csrf-token"]').attr('content');
          console.log(id);
          // AJAX request
          $.ajax({
              url: '{{url("addLikeajx")}}/'+id,
              type: 'post',
              data: {id: id,
                _token: _token
              },
              success: function(count){ 
                  // Add response in Modal body
                  toastr.info("Suka");
                  $.ajax({
                  url: '{{url("getlike")}}/'+id,
                  type: 'get',
                  data: {id: id},
                  success: function(count){ 
                      console.log(count);
                      var li = document.getElementById('subcountLike');
                      li.innerHTML = count; 
                      document.getElementById("slike").style.display = "inherit";
                      document.getElementById("clike").style.display = "none";
                    }
                  });

                  // Display Modal
                  // $('#empModal').modal('show'); 
              }
          });
          
          
      })
      
      
      
});
</script>
<script type='text/javascript'>
  $(document).ready(function(){
    $('#slike').click(function(){
      var id = $(this).data('id');
          let _token   = $('meta[name="csrf-token"]').attr('content');
          console.log(id);
          // AJAX request
          $.ajax({
              url: '{{url("subLikeajx")}}/'+id,
              type: 'post',
              data: {id: id,
                _token: _token
              },
              success: function(count){ 
                  // Add response in Modal body
                  toastr.error("Batal Suka");
                  $.ajax({
                  url: '{{url("getlike")}}/'+id,
                  type: 'get',
                  data: {id: id},
                  success: function(count){ 
                      console.log(count);
                      var li = document.getElementById('addcountLike');
                      li.innerHTML = count; 
                      document.getElementById("slike").style.display = "none";
                      document.getElementById("clike").style.display = "inherit";
                    }
                  });

                  // Display Modal
                  // $('#empModal').modal('show'); 
              }
          });
     });
      
      
});
</script>

<script type='text/javascript'>
  $(document).ready(function(){
      $('#cvote').click(function(){
         
          var id = $(this).data('id');
          let _token   = $('meta[name="csrf-token"]').attr('content');
          console.log(id);
          // AJAX request
          $.ajax({
              url: '{{url("addVoteajx")}}/'+id,
              type: 'post',
              data: {id: id,
                _token: _token
              },
              success: function(count){ 
                  // Add response in Modal body
                  toastr.info("Minat");
                  $.ajax({
                  url: '{{url("getvote")}}/'+id,
                  type: 'get',
                  data: {id: id},
                  success: function(count){ 
                      console.log(count);
                      var lis = document.getElementById('subcountVote');
                      lis.innerHTML = count; 
                      document.getElementById("svote").style.display = "inherit";
                      document.getElementById("cvote").style.display = "none";
                    }
                  });

                  // Display Modal
                  // $('#empModal').modal('show'); 
              }
          });
          
          
      })
      
});
</script>
<script type='text/javascript'>
  $(document).ready(function(){
      $('#svote').click(function(){
         
          var id = $(this).data('id');
          let _token   = $('meta[name="csrf-token"]').attr('content');
          console.log(id);
          // AJAX request
          $.ajax({
              url: '{{url("subVoteajx")}}/'+id,
              type: 'post',
              data: {id: id,
                _token: _token
              },
              success: function(count){ 
                  // Add response in Modal body
                  toastr.error("Batal Minat");
                  $.ajax({
                  url: '{{url("getvote")}}/'+id,
                  type: 'get',
                  data: {id: id},
                  success: function(count){ 
                      console.log(count);
                      var lit = document.getElementById('addcountVote');
                      lit.innerHTML = count; 
                      document.getElementById("cvote").style.display = "inherit";
                      document.getElementById("svote").style.display = "none";
                    }
                  });

                  // Display Modal
                  // $('#empModal').modal('show'); 
              }
          });
          
          
      })
      
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
@endsection

@section('style')
@endsection