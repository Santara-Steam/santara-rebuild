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

      <div class="fashion_section">
                <div id="jewellery_main_slider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                          <div class="container">
                            
                          <fieldset disabled>
                          <div class="form-row">
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
                            <div class="fashion_section_2">
                                <div class="row" style="padding-left: 10px; padding-right: 10px;">
                            @foreach ($sold_out as $item)
                            <?php 
                                      $picture = explode(',',$item->pictures);
                                      $tot=number_format(round($item->supply * $item->price),0,',','.');
                                      ?>
                            <div class="col-lg-3 col-sm-3 col-3" style="padding: 5px;">


                              <a data-toggle="modal" id="detail_sold" style="width: 100%;"
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
            <div class="button-1 cut">
                            <div class="inter-medium-white-14px">
                              <span class="inter-medium-white-14px">See More</span>
                            </div>
                          </div>
            </div>
@endsection