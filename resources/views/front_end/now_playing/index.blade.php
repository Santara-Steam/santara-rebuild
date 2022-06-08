@extends('front_end/template_front_end/app')

@section('content')
<div class="header-section" style="margin-top: 96px;">
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
          <fieldset >
            <form role="form" method="get" action="{{ route('now-playing.index') }}" id="form_id">
              @csrf
            <div class="form-row">
              <div class="form-group col-md-3">
                <div class="label inter-medium-quill-gray-14px">
                  <span class="inter-medium-quill-gray-14px">Cari Bisnis</span>
                </div>
                <input type="search" value="{{Request::get('cari')}}" name="cari" class="form-control empty input-1 border-1px-cape-cod inter-normal-delta-16px"
                  style="background: #1b1a1a; color: var(--quill-gray);" id="iconified" placeholder="&#xF002;" />
              </div>
              <div class="form-group col-md-2 kati">
              </div>
              <div class="form-group col-md-3">
                <div class="label-1 inter-medium-quill-gray-14px">
                  <span class="inter-medium-quill-gray-14px">Nilai Pendanaan</span>
                </div>
                <select name="range" id="inputState" class="form-control dropdown-1"
                onChange=" document.getElementById('form_id').submit();">
                  <option value="0" <?PHP echo (Request::get('range')==0)? 'selected': ''; ?>>Semua Nilai Pendanaan</option>
                  <option value="1" <?PHP echo (Request::get('range')==1)? 'selected': ''; ?>>Rp500.000.000 - Rp1.000.000.000</option>
                  <option value="2" <?PHP echo (Request::get('range')==2)? 'selected': ''; ?> title="Sort by Lowest Price First">Rp1.000.000.000 - Rp3.000.000.000</option>
                  <option value="3" <?PHP echo (Request::get('range')==3)? 'selected': ''; ?> title="Sort by Newest First">Rp3.000.000.000 - Rp5.000.000.000</option>
                  <option value="4" <?PHP echo (Request::get('range')==4)? 'selected': ''; ?> title="Sort by Lowest Price First">Rp5.000.000.000 - Rp10.000.000.000</option>
                  <option value="5" <?PHP echo (Request::get('range')==5)? 'selected': ''; ?> title="Sort by Newest First">< Rp10.000.000.000</option>
                </select>
              </div>
              <div class="form-group col-md-2">
                <div class="label-1 inter-medium-quill-gray-14px">
                  <span class="inter-medium-quill-gray-14px">Kategori</span>
                </div>
                <select name="categor" id="inputState" class="form-control dropdown-1"
                onChange=" document.getElementById('form_id').submit();">
                <option value="">Semua Kategori</option>
                @foreach ($cat as $cate)
                <option type="submit" <?PHP echo (Request::get('categor')==$cate->category)? 'selected': ''; ?>
                  value="{{$cate->category}}" >{{$cate->category}}</option>
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
                <option value="true" <?PHP echo (Request::get('sort')=='true' )? 'selected' : '' ; ?>>Terbaru</option>
                <option value="false" <?PHP echo (Request::get('sort')=='false' )? 'selected' : '' ; ?>>Terlama</option>
                        <option value="terpenuhi" <?PHP echo (Request::get('sort')=='terpenuhi' )? 'selected' : '' ; ?>>Terpenuhi</option>
                        <option value="belum terpenuhi" <?PHP echo (Request::get('sort')=='belum terpenuhi' )? 'selected' : '' ; ?>>Belum Terpenuhi</option>
              </select>
              </div>
            </form>
          </fieldset>
          <div class="fashion_section_2">
            <div class="row" style="padding-left: 10px; padding-right: 10px;">
              {{-- @foreach ($now_playing as $np) --}}
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
                $terjual_percentage = ($terjual > 0 ? $terjual / $np['supply'] : 0) * 100;
                $terjual_percentage = ($terjual_percentage >= 0) ? ($terjual_percentage > 100 ? 100 : $terjual_percentage) : 0;

                $tersisa_percentage = number_format($tersisa > 0 ? $tersisa / $np['supply'] * 100 : 0, 2, ',', '.');
                $tersisa_total = number_format($tersisa, 0, ',', '.');
                $tersisa_total_rp = number_format($tersisa * $np['price'], 0, ',', '.');
                $terjual_percentage_f = number_format($terjual_percentage, 3, '.', ',');
                $terjual_percentage = number_format($terjual_percentage, 3, ',', '.');
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
                ?>
              <div class="col-lg-3 col-sm-6 col-6" style="padding: 5px;">
                <?php
                                      // $picture = explode(',',$np->pictures);
                                      ?>

                <?php
                                // $mul=number_format(round($np->minimum_invest * $np['price'],0),0,',','.');
                                // $prog=round((round($np->terjual,0)/round($np->supply))*100,2);
                                // $pend=number_format(round($np->supply*$np['price'],0),0,',','.');
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
                            style="background: var(--falu-red); border-radius: 10px; box-shadow: 10px 0 0 var(--falu-red), 0px 0 0 var(--falu-red); line-height : 20px; padding-left:10px;">
                            <?php echo \Illuminate\Support\Str::limit(strip_tags( $np['category'] ), 20, $end='...') ?>
                          </span>
                          <div class="header">
                            <div class="saka-logistics inter-medium-alabaster-20px">
                              <span class="tx-pt inter-medium-alabaster">
                                <?php echo \Illuminate\Support\Str::limit(strip_tags( $np['trademark'] ), 20, $end='...') ?>
                              </span>
                              <i class="fa fa-check-circle" style="color: #2a8ede"></i>
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
                                  {{number_format(round(100 * $np['price'],0),0,',','.')}}</span> </span>
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
                                  style="width:{{$terjual_percentage_f}}%; background-color:#bf2d30; border-radius: 8px; height: 16px;"
                                  role="progressbar" aria-valuenow="{{$terjual_percentage_f}}" aria-valuemin="0"
                                  aria-valuemax="100">

                                  {{-- {{ round((round($np->terjual,0)/round($np->avg_capital_needs,0))*100,2) }} --}}
                                  {{$terjual_percentage}}
                                  %
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="footer-card">
                          <img class="divider" src="{{ asset('assets/images/divider-108@2x.png') }}" />
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
{{-- </div> --}}

@if (count($now_playing) == 0)
<div class="ayo-daftarkan-bisnis-anda inter-medium-white-14px">
  <span class="text-urun inter-normal-alabaster">Data tidak ditemukan!</span>
</div>
<div class="actions3 ">
  <a class="btn btn-danger btn-sm btn-block" href="{{ route('now-playing.index') }}">Tampilkan Semua</a>
</div>
</div>
@else
  @if (count($now_playing) != $c)

  <div class="actions3 ">
    <a class="btn btn-danger btn-sm btn-block" href="{{ route('now-playing.index') }}">Tampilkan Semua</a>
  </div>
  </div>
  @endif
@endif
</div>
{{-- @foreach ($now_playing as $np) --}}

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
                $terjual_percentage = ($terjual > 0 ? $terjual / $np['supply'] : 0) * 100;
                $terjual_percentage = ($terjual_percentage >= 0) ? ($terjual_percentage > 100 ? 100 : $terjual_percentage) : 0;

                $tersisa_percentage = number_format($tersisa > 0 ? $tersisa / $np['supply'] * 100 : 0, 2, ',', '.');
                $tersisa_total = number_format($tersisa, 0, ',', '.');
                $tersisa_total_rp = number_format($tersisa * $np['price'], 0, ',', '.');
                $terjual_percentage_f = number_format($terjual_percentage, 3, '.', ',');
                $terjual_percentage = number_format($terjual_percentage, 3, ',', '.');
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
                ?>
<?php
                                      // $picture = explode(',',$np->pictures);
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
    border-radius: 10px; box-shadow: 10px 0 0 var(--falu-red), 0px 0 0 var(--falu-red); line-height : 20px; padding-left:10px;">{{ $np['category'] }}</span>
              <div class="header">
                <div class="saka-logistics inter-medium-alabaster-20px">
                  <span class="tx-pt inter-medium-alabaster">
                    {{$np['trademark'] }}
                  </span>
                </div>
                <div class="pt-saka-multitrans-nusantara inter-normal-quill-gray-12px">
                  <span class="tx-np inter-normal-quill-gray">
                    {{$np['company_name'] }}
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
                        $datediff = $end - $now ;
                        ?>
                      {{round($datediff / (60 * 60 * 24))}}
                      {{-- {{abs(strtotime($np->begin_period) - strtotime($np->end_period))}} --}}
                      {{-- 45 --}}
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
                    role="progressbar" aria-valuenow="{{$terjual_percentage_f}}" aria-valuemin="0" aria-valuemax="100">

                    {{-- {{ round((round($np->terjual,0)/round($np->avg_capital_needs,0))*100,2) }} --}}
                    {{$terjual_percentage}}
                    {{-- 0 --}}
                    %
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="footer-card">
            <img class="divider" src="{{ asset('assets/images/divider-108@2x.png') }}" />
            <div class="footer-card-1">
              <div class="total-pendanaan-rp3000000000 inter-normal-mercury-12px">
                <span class="inter-normal-quill-gray-12px">Total Pendanaan<br /></span><span
                  class="inter-medium-alabaster-12px">Rp{{number_format($np['supply'] * $np['price'], 0,
                  ',', '.')}}</span>
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
{{-- </div> --}}
@endforeach
<script>
  $(document).ready(function() {
    $(document).on('click', '.detail_now', function() {
    })
  })
</script>
@endsection

@section('js')
    <script></script>
@endsection
