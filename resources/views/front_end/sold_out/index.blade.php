@extends('front_end/template_front_end/app')

@section('content')
 <div class="header-section">
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
        <fieldset disabled>
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
      </div></fieldset>
      <!-- fashion section start -->
      <div class="fashion_section">
         <div id="main_slider" class="carousel" data-ride="carousel">
            <div class="carousel-inner">
                    <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="w3-container w3-red">
                     <div class="fashion_section_2">
                        <div class="row" style="padding-left: 10px; padding-right: 10px;">
                          @foreach ($sold_out as $item)
                          <?php 
                          $picture = explode(',',$item->pictures);
                          $tot=number_format(round($item->supply * $item->price),0,',','.');
                          
                          ?>
                    <div class="col-lg-3 col-sm-3 col-3 moldla" style="padding: 5px;">
                      <a type="button" data-toggle="modal" id="detail_sold" style="width: 100%;"
                            class="mod_sold detail_sold moldla" data-target="#modal_sold" data-ktg_sold="<?=$item->ktg?>"
                            data-trademark_sold="<?=$item->trademark?>" data-company_name_sold="<?=$item->company_name?>"
                            data-tot_pendanaan_sold="<?=$tot?>" data-image_sold="<?=$picture[0]?>">
                          <div class="card moldla">
                            <img class="rectangle-2 moldla"
                              src="https://storage.googleapis.com/asset-santara/santara.co.id/token/{{$picture[0]}}" />
                          </div>
                      </a>
                    </div>
                          <a type="button" class="molpli" data-toggle="modal" data-target="#exampleModal">
                           <div class="col-lg-3 col-sm-3 col-3 molpli" style="padding: 5px;">
                              <div class="card molpli" style="margin-top: 10px;">
                                <img class="rectangle-2"  src="https://storage.googleapis.com/asset-santara/santara.co.id/token/{{$picture[0]}}" />
                                <div class="content">
                                  <div class="header-card-dan-progress-2">
                                    <div class="header-and-tags">
                                      <div class="tags">
                                        <div class="retail-distribusi-logistik inter-medium-sweet-pink-12px">
                                          <span class="tx-t inter-medium-sweet-pink-12px">Retail/Distribusi/Logistik</span>
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
                                    <div class="info-pendanaan">
                                        <div class="mul inter-normal-mercury-14px">
                                          <span class="tx-sold span-1 inter-normal-quill-gray">Total Pendanaan</span>
                                        </div>
                                      </div>
                                        <div class="addr inter-bold-white-14px">
                                          <span class="tx-sold inter-bold-white" style="font-weight: bold">Rp3.000.000.000</span>
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
                           </div>
                          </a>
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
                              <span class="tx-t inter-medium-sweet-pink-12px" style="background: var(--falu-red);
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