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
        <div class="row r-top">
            <div class="col-lg-3 col-sm-3">
              <div class="filter">
              <div class="input">
                <div class="label inter-medium-quill-gray-14px">
                  <span class="inter-medium-quill-gray-14px">Cari Bisnis</span>
                </div>
                <div class="input-1 border-1px-cape-cod">
                  <img class="search" src="{{ asset('public/assets/images/search-9@2x.png') }}" />
                  <div class="text inter-normal-delta-16px"><span class="inter-normal-delta-16px">Nama Bisnis</span></div> </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-3">
              <div class="dropdown-2">
                <div class="label-1 inter-medium-quill-gray-14px">
                  <span class="inter-medium-quill-gray-14px">Nilai Pendanaan</span>
                </div>
                <select id="sort" name="sort" class="pretty border-1px-cape-cod">
                  <option value="position">Rp500.000.000 - Rp1.000.000.000</option>
                  <option value="price" title="Sort by Lowest Price First">Rp1.000.000.000 - Rp3.000.000.000</option>
                  <option value="date" title="Sort by Newest First">Rp3.000.000.000 - Rp5.000.000.000</option>
                  <option value="price" title="Sort by Lowest Price First">Rp5.000.000.000 - Rp10.000.000.000</option>
                  <option value="date" title="Sort by Newest First">Rp10.000.000.000</option>
                </select>
                <script>
                $(document).ready(function() {
                  // Initiate Pretty Dropdowns
                  $('.pretty').prettyDropdown();
                });
                </script>
              </div>
            </div>
            <div class="col-lg-3 col-sm-3">
                <div class="dropdown-4">
                  <div class="label-1 inter-medium-quill-gray-14px">
                    <span class="inter-medium-quill-gray-14px">Kategori</span>
                  </div>
                  <select id="sort" name="sort" class="pretty dd border-1px-cape-cod">
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
                  <script>
                  $(document).ready(function() {
                    // Initiate Pretty Dropdowns
                    $('.pretty').prettyDropdown();
                  });
                  </script>
                </div>
              </div>
              <div class="col-lg-3 col-sm-3">
                <div class="dropdown-6">
                  <div class="label-1 inter-medium-quill-gray-14px">
                    <span class="inter-medium-quill-gray-14px">Urutkan</span>
                  </div>
                  <select id="sort" name="sort" class="pretty border-1px-cape-cod">
                    <option value="position">Terlama</option>
                    <option value="price" >Terpenuhi</option>
                    <option value="position">Belum Terpenuhi</option>
                  </select>
                  <script>
                  $(document).ready(function() {
                    // Initiate Pretty Dropdowns
                    $('.pretty').prettyDropdown();
                  });
                  </script>
                </div>
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
                      <div class="row">
                        @foreach ($now_playing as $np)
                        <?php 
                        $picture = explode(',',$np->pictures);
                        ?>
                         <div class="col-lg-3 col-sm-6 col-6">
                          <a href="{{ route('now-playing.detail') }}">
                            <div class="card">
                              <img class="rectangle-2" src="https://storage.googleapis.com/asset-santara/santara.co.id/token/{{$picture[0]}}" />
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
                                        <span class="tx-pt inter-medium-alabaster">{{$np->trademark}}</span>
                                      </div>
                                      <div class="pt-saka-multitrans-nusantara inter-normal-quill-gray-12px">
                                        <span class="tx-np inter-normal-quill-gray">{{$np->company_name}}</span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="info-dan-progress">
                                    <div class="info-pendanaan">
                                      <div class="mulai-rp1000000 inter-normal-mercury-14px">
                                        <span class="tx-sold span-1 inter-normal-mercury">Mulai</span
                                        ><span class="inter-normal-mercury-12px">&nbsp;</span
                                        >
                                        <div class="mulai-rp inter-bold-white-14px"
                                        ><span class="tx-sold span-1 inter-bold-white" style="font-weight: bold">Rp {{number_format(round($np->minimum_invest * $np->price,0),0,',','.')}}</span>
                                      </div>
                                      </div>
                                    </div>
                                    <div class="address">
                                      <div  class="hr inter-bold-white-14px">
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
                                      <div class="progress-bar " style="width: {{ round((round($np->terjual,0)/round($np->supply))*100,2) }}%; background-color:#bf2d30; border-radius: 8px; height: 16px;" role="progressbar" aria-valuenow="{{ round((round($np->terjual,0)/round($np->supply))*100,2) }}" aria-valuemin="0" aria-valuemax="100">
                                      
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
                                      <span class="inter-normal-quill-gray-12px">Total Pendanaan<br /></span
                                      ><span class="inter-medium-alabaster-12px">Rp{{number_format(round($np->supply*$np->price,0),0,',','.')}}</span>
                                    </div>
                                    <div class="periode-dividen-6-bulan inter-normal-mercury-10px">
                                      <span class="inter-normal-quill-gray-12px">Periode Dividen<br /></span
                                      ><span class="inter-medium-alabaster-12px">{{$np->period}}</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </a>
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

@endsection