@extends('front_end/template_front_end/app')

@section('content')
<div class="header-section">
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
        <div class="form-row" style="padding-right: 25px; padding-left: 25px;">
        <div class="form-group col-md-4">
          <div class="label inter-medium-quill-gray-14px">
            <span class="inter-medium-quill-gray-14px">Cari Bisnis</span>
          </div>
          <input type="text" class="form-control empty input-1 border-1px-cape-cod inter-normal-delta-16px" style="background: #1b1a1a; color: var(--quill-gray);" id="iconified" placeholder="&#xF002;"/>
        </div>
        <div class="form-group col-md-3 kati">
        </div>
        <div class="form-group col-md-3">
          <div class="label-1 inter-medium-quill-gray-14px">
                    <span class="inter-medium-quill-gray-14px">Kategori</span>
                  </div>
          <select id="inputState" class="form-control dropdown-1">
            <option value="position">Semua Kategori</option>
                    <option value="price" >Property</option>
                    <option value="position">Food and Beverage</option>
                    <option value="price" >Peternakan</option>
                    <option value="position">Perkebunan/Argo</option>
                    <option value="price" >Teknologi</option>
                    <option value="position">Start Up</option>
                    <option value="price" >Project Financing</option>
                    <option value="price" >Service/Layanan</option>
                    <option value="position">Manufaktur/Produksi</option>
                    <option value="price" >Retail/Distribusi/Logistik</option>
          </select>
        </div>
        <div class="form-group col-md-2">
          <div class="label-1 inter-medium-quill-gray-14px">
                    <span class="inter-medium-quill-gray-14px">Urutkan</span>
                  </div>
          <select id="inputState" class="form-control dropdown-1">
            <option value="position">Terlama</option>
                    <option value="price" >Terpenuhi</option>
                    <option value="position">Belum Terpenuhi</option>
          </select>
        </div>
      </div>
      </div>
      <!-- fashion section start -->
      <div class="fashion_section">
         <div id="main_slider" class="carousel" data-ride="carousel">
            <div class="carousel-inner">
                    <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="w3-container w3-red">
                     <div class="fashion_section_2">
                        <div class="row" style="padding-left: 10px; padding-right: 10px;">
                        
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

                      <a type="button" data-toggle="modal" id="detail" class="mod moldla " style="width: 100%;"
                          data-target="#exampleModalCenter" data-category="<?=$cs->ctg->category?>"
                          data-trademark="<?=$cs->trademark?>" data-company_name="<?=$cs->company_name?>"
                          data-like="<?=$cs->likes?>" data-minat="<?=$cs->vot?>" data-comment="<?=$cs->cmt?>"
                          data-id="<?=$cs->id?>" data-trdlike="<?=$cs->trdlike?>" data-trdvot="<?=$cs->trdvot?>"
                          data-image="<?=$picture[3]?>">
                     <div class="card moldla col-lg-3 col-sm-3 col-3"> 
                          <img class="rectangle-2 moldla" src="{{ asset('public/upload') }}/{{$picture[3]}}" />
                      </div>
                        </a>
                        <a href="{{ url('detail-coming-soon') }}/{{$cs->id}}" class="molpli">
                           <div class="col-lg-3 col-sm-3 col-3" style="padding: 5px;">
                              <div class="card molpli" style="margin-top: 10px;">
                          <img class="rectangle-2" src="{{ asset('public/upload') }}/{{$picture[3]}}" />
                                <div class="content">
                                  <div class="header-card-dan-progress">
                                    <div class="header-and-tags">
                              <span class="tx-t inter-medium-sweet-pink-12px" style="background: var(--falu-red);
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
                              <a href="{{ url('detail-coming-soon') }}/{{$cs->id}}" class="button btn-block btn btn-outline-light inter-medium-white-14px">Dukung Bisnis
                                Ini</a>
                            </div>
                                </div>
                              </div>
                           </div>
                        @endforeach
                        </div>
                        <div>
                           <div class="button-1 cut">
                            <div class="inter-medium-white-14px">
                              <span class="inter-medium-white-14px">See More</span>
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
                              <span class="tx-t inter-medium-sweet-pink-12px" style="background: var(--falu-red);
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
                      <form id="like" action=""  method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                      </form>

                      <form id="sublike" action=""  method="POST"
                        enctype="multipart/form-data">
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

                      <a class="col-3" onclick="document.getElementById('subvote{{$cs->id}}').submit();" style="cursor: pointer">
                        @else
                        <a class="col-3" onclick="document.getElementById('vote{{$cs->id}}').submit();" style="cursor: pointer">
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
                        <a class="col-3" style="cursor: pointer" data-id="{{$cs->id}}" id="mct" data-toggle="modal" data-dismiss="modal"
                          data-target="#modal" class="cmt">
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
                        <a class="col-3" style="cursor: pointer" id="msb" data-id="{{$cs->id}}"  data-toggle="modal"
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
@endsection