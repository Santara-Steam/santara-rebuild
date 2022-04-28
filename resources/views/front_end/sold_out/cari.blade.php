@extends('front_end/template_front_end/app')

@section('content')
 <div class="header-section" style="margin-top: 96px;">
          <div class="heading-and-subheading">
            <div class="now-playing-bisnis inter-bold-alizarin-crimson-16px">
              <span class="inter-bold-alizarin-crimson-16px">Sold Out Bisnis</span>
            </div>
            <div class="text-urun pilih-bisnis-favoritmu inter-bold-alabaster-48px">
              <span class="text-sb inter-bold-alabaster">Bisnis yang Sukses Bersama Kami</span>
            </div>
          </div>
          <div class="text-mulai inter-normal-alabaster-20px">
            <span class="text-mulai inter-normal-alabaster">Mereka sudah merasakan urun dana bersama kami, saatnya Bisnis Anda</span>
          </div>
        </div>

      <div class="fashion_section">
                <div id="jewellery_main_slider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                          <div class="container">
                          <form role="form" method="get" action="{{ route('sold-out.filter') }}" id="form_id">
                            @csrf
                          <div class="form-row">
                          <div class="form-group col-md-4">
                            <div class="label inter-medium-quill-gray-14px">
                              <span class="inter-medium-quill-gray-14px">Cari Bisnis</span>
                            </div>
                            <input type="search" value="{{ $car }}" name="cari" class="form-control input-1 border-1px-cape-cod inter-normal-delta-16px" style="background: #1b1a1a; color: var(--quill-gray);" id="iconified" placeholder="Cari"/>
                          </div>
                          <div class="form-group col-md-3 kati">
                          </div>
                          <div class="form-group col-md-3">
                            <div class="label-1 inter-medium-quill-gray-14px">
                                      <span class="inter-medium-quill-gray-14px">Kategori</span>
                                    </div>
                                <select name="categor" id="inputState" class="form-control dropdown-1" onChange=" document.getElementById('form_id').submit();">
                                        <option value="0">Semua Kategori</option>
                                        @foreach ($cat as $cate)
                                          <option <?php if ($cate->id == $fil_cat) {
                                                            echo 'selected'; } ?>
                                                            value="{{$cate->id}}">{{$cate->category}}</option>
                                        @endforeach
                                </select>
                              </div>
                              <div class="form-group col-md-2">
                                <div class="label-1 inter-medium-quill-gray-14px">
                                          <span class="inter-medium-quill-gray-14px">Urutkan</span>
                                        </div>
                                <select name="sort" id="inputState" class="form-control dropdown-1" onChange=" document.getElementById('form_id').submit();">
                                <option <?php if ($fil_sort == 'desc') {
                                                            echo 'selected'; } ?>
                                                            value="desc">Terbaru</option>
                                  <option <?php if ($fil_sort == 'asc') {
                                                            echo 'selected'; } ?>
                                                            value="asc">Terlama</option>
                                          <option value="terpenuhi" >Terpenuhi</option>
                                          <option value="position">Belum Terpenuhi</option>
                                </select>
                              </div>
                            </div>
                          </form>
                          
                          @if(count($sold_out)> 0)
                            <div class="fashion_section_2">
                                <div class="row" style="padding-left: 10px; padding-right: 10px;">
                                @foreach ($sold_out as $item)
                                <?php 
                                                      $picture = explode(',',$item->pictures);
                                                      $tot=number_format(round($item->supply * $item->price),0,',','.');
                                                      ?>
                                <div class="col-lg-3 col-sm-6 col-6" style="padding: 5px;">


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
                  <div class="ayo-daftarkan-bisnis-anda inter-medium-white-14px">
                        
                    </div>
                    <div class="actions3 "> 
                                    <a class="btn btn-danger btn-sm btn-block" href="{{ route('sold-out.index') }}">Tampilkan Semua</a>
                            </div>
                    </div>

                  @else
                    <div class="ayo-daftarkan-bisnis-anda inter-medium-white-14px">
                        <span class="text-urun inter-normal-alabaster">Data tidak ditemukan!</span>
                    </div>
                    <div class="actions3 "> 
                                    <a class="btn btn-danger btn-sm btn-block" href="{{ route('sold-out.index') }}">Tampilkan Semua</a>
                            </div>
                    </div>
                @endif
            </div>
               </div>
            </div>
         </div>
      </div>
            

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
@endsection