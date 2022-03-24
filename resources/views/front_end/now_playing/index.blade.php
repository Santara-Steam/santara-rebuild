@extends('front_end/template_front_end/app')

@section('content')
<div class="header-section" >
          <div class="heading-and-subheading">
            <div class="now-playing-bisnis inter-bold-alizarin-crimson-16px">
              <span class="inter-bold-alizarin-crimson-16px">Now Playing Bisnis</span>
            </div>
            <div class="text-urun pilih-bisnis-favoritmu inter-bold-alabaster-48px">
              <span class="text-sb inter-bold-alabaster">Pilih Bisnis Favoritmu</span>
            </div>
          </div>
          <div class="text-mulai inter-normal-alabaster-20px">
            <span class="text-mulai inter-normal-alabaster">Yuk, mulai investasi bisnis sekarang juga!</span>
          </div>
        </div>
      </div>
      <div class="fashion_section">
         <div id="jewellery_main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="container">
                      <fieldset disabled>
                      <div class="form-row">
                      <div class="form-group col-md-3">
                        <div class="label inter-medium-quill-gray-14px">
                          <span class="inter-medium-quill-gray-14px">Cari Bisnis</span>
                        </div>
                        <input type="text" class="form-control empty input-1 border-1px-cape-cod inter-normal-delta-16px" style="background: #1b1a1a; color: var(--quill-gray);" id="iconified" placeholder="&#xF002;"/>
                      </div>
                      <div class="form-group col-md-2 kati">
                      </div>
                      <div class="form-group col-md-3">
                        <div class="label-1 inter-medium-quill-gray-14px">
                            <span class="inter-medium-quill-gray-14px">Nilai Pendanaan</span>
                          </div>
                        <select id="inputState" class="form-control dropdown-1">
                          <option value="position">Rp500.000.000 - Rp1.000.000.000</option>
                          <option value="price" title="Sort by Lowest Price First">Rp1.000.000.000 - Rp3.000.000.000</option>
                          <option value="date" title="Sort by Newest First">Rp3.000.000.000 - Rp5.000.000.000</option>
                          <option value="price" title="Sort by Lowest Price First">Rp5.000.000.000 - Rp10.000.000.000</option>
                          <option value="date" title="Sort by Newest First">Rp10.000.000.000</option>
                        </select>
                      </div>
                      <div class="form-group col-md-2">
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
                      </fieldset>
                     <div class="fashion_section_2">
                        <div class="row" style="padding-left: 10px; padding-right: 10px;">
                        @foreach ($now_playing as $np)
                        <div class="col-lg-3 col-sm-3 col-3" style="padding: 5px;"> 
                  <?php 
                                      $picture = explode(',',$np->pictures);
                                      ?>

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
                    style="width: 100%;" data-target="#modal_now" data-id="<?=$np->id?>"data-ktg="<?=$np->ktg?>"
                    data-trademark_now="<?=$np->trademark?>" data-mulai="<?= number_format(round(100 * $np->price,0),0,',','.')?>" data-company_name_now="<?=$np->company_name?>" data-image_now="<?=$picture[0]?>" 
                    data-tot_pendanaan="<? number_format(round($np->avg_capital_needs,0),0,',','.')?>">
                    <div class="card moldla">
                      <img class="rectangle-2 moldla" src="{{ asset('public/storage/pictures') }}/{{$picture[0]}}" />
                    </div>
                  </a>
                  <a class="molpli" href="{{url('detail-now-playing')}}/{{$np->id}}">
                    <div class="card molpli">
                      <img class="rectangle-2" src="{{ asset('public/storage/pictures') }}/{{$picture[0]}}" />
                      <div class="content">
                        <div class="header-card-dan-progress">
                          <div class="header-and-tags">
                            <span class="tx-t inter-medium-sweet-pink-12px"
                              style="background: var(--falu-red);
            border-radius: 10px; box-shadow: 10px 0 0 var(--falu-red), 0px 0 0 var(--falu-red); line-height : 20px; padding-left:10px;"><?php echo \Illuminate\Support\Str::limit(strip_tags( $np->ktg ), 20, $end='...') ?></span>
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
                                    {{number_format(round(100 * $np->price,0),0,',','.')}}</span> </span>
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
                                    40
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
                                  class="inter-medium-alabaster-12px">Rp{{number_format(round($np->avg_capital_needs,0),0,',','.')}}</span>
                              </div>
                              <div class="periode-dividen-6-bulan inter-normal-mercury-10px">
                                <span class="inter-normal-quill-gray-12px">Periode Dividen<br /></span><span
                                  class="inter-medium-alabaster-12px">6 Bulan</span>
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
                      40
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
                        role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">

                        <span class="tx-np percen inter-medium-white" id="progres_now"> 0



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
            <a class="b-daf btn btn-danger btn-lg btn-block" id="sel_now" href="">Selengkapnya</a>
          </div>
        </div>
      </div>
    </div>
      <script>
    $(document).ready(function() {
    $(document).on('click', '.detail_now', function() {
      var ktg = $(this).data('ktg');
      var trademark_now = $(this).data('trademark_now');
      var company_name_now = $(this).data('company_name_now');
      var image_now = $(this).data('image_now');
      var mulai = $(this).data('mulai');
      var hari = $(this).data('hari');
      var id = $(this).data('id');
      var progres_now = $(this).data('progres_now');
      var tot_pendanaan = $(this).data('tot_pendanaan');
      var periode_dividen = $(this).data('periode_dividen');
      $('#ktg').text(ktg);
      $('#trademark_now').text(trademark_now);
      $('#company_name_now').text(company_name_now);
      $('#image_now').prop('src', 'public/storage/pictures/' + image_now);
      $('#mulai').text(mulai);
      $('#hari').text(hari);
      $('#progres_now').text(progres_now);
      $('#tot_pendanaan').text(tot_pendanaan);
      $('#periode_dividen').text(periode_dividen);
      $('#sel_now').attr("href", "{{url('detail-now-playing')}}/"+id);
    })
  })
  </script>
@endsection