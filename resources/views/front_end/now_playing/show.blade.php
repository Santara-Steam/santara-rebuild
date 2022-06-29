@extends('front_end/template_front_end/app')

@section('content')
<?php
    $picture = explode(',', $emt->pictures);
    if (empty($picture[0])) {
        $picture[0] = 'default1.png';
    } else {
        $picture[0];
    }
    if (empty($picture[1])) {
        $picture[1] = 'default2.png';
    } else {
        $picture[1];
    }
    if (empty($picture[2])) {
        if (empty($emt->owner_picture)) {
            $picture[2] = 'default2.png';
            # code...
        } else {
            $picture[2] = str_replace('pralisting/emitens_pictures/', '', $emt->owner_picture);
        }
    } else {
        $picture[2];
    }
    if (empty($picture[3])) {
        $picture[3] = 'default.png';
    } else {
        $picture[3];
    }
    if (empty($picture[4])) {
        $picture[4] = 'default.png';
    } else {
        $picture[4];
    }
    if (empty($picture[5])) {
        $picture[5] = 'default.png';
    } else {
        $picture[5];
    }
    if (empty($picture[6])) {
        $picture[6] = 'default1.png';
    } else {
        $picture[6];
    }
    // if ($emt->avg_capital_needs == null) {
    $emt->avg_capital_needs = $emt->supply * $emt->price;
    // }

    if (empty($emt->trademark)) {
        $emt->trademark = $emt->company_name;
    } else {
        $emt->trademark;
    }

    ?>
<link rel="stylesheet" href="{{ asset('public/assets/css/tabs.css') }}">

<div class="banner_bg_main"
    style="background-image: url('{{ env('PATH_WEB_PROD') }}{{ $picture[1] }}'),url('{{ env('PATH_WEB_PROD') }}{{ $picture[1] }}');"
    style="margin-top: 96px;">
    <div class="banner_section layout_padding">
        <div class="container" style="margin-top: 15px;">
            <div class="section">
                <div class="heading-and-tag">
                    <div class="hheader-dan-supporting-text">
                        <div class="fruters-indonesia inter-bold-alabaster-48px">
                            <span class="text-urun inter-bold-alabaster">{{ $emt->trademark }}</span>
                            <i class="fa fa-check-circle" style="color: #2a8ede"></i>
                        </div>
                        <div class="pt-fruters-indonesia-perkasa inter-medium-alabaster-18px">
                            <span class="tx-pt inter-medium-alabaster">{{ $emt->company_name }}</span>
                        </div>
                    </div>
                    {{-- <div class="tags-d"> --}}
                        <span class="tx-t inter-medium-sweet-pink-14px"
                            style="font-size:16px;background: var(--falu-red);
            border-radius: 10px; box-shadow: 10px 0 0 var(--falu-red), 0px 0 0 var(--falu-red); line-height : 20px; padding-left:10px;">{{ $emt->ctg->category
                            }}</span>
                        {{--
                    </div> --}}
                </div>
                <div class="profil">
                    <img style="border-radius: 50%;" class="image-69" src="{{ env('PATH_WEB') }}{{ $picture[2] }}"
                        onerror="this.onerror=null;this.src='{{ env('PATH_WEB_PROD') }}{{ $picture[2] }}'" />
                    <div class="pemilik-bisnis">
                        <div class="m-khemal-nugroho inter-medium-alabaster-18px">
                            <span class="text-mulai inter-medium-alabaster">{{ $emt->owner_name }}</span>
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
                    <li class="nav-item sp-tab"> <a class="nav-link inter-medium-delta active show" id="pills-home-tab"
                            data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home"
                            aria-selected="true">Informasi
                            Saham</a> </li>
                    <li class="nav-item sp-tab"> <a class="nav-link inter-medium-delta" id="pills-profile-tab"
                            data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile"
                            aria-selected="false">Detail Saham</a>
                    </li>
                    <li class="nav-item sp-tab"> <a class="nav-link inter-medium-delta" id="pills-contact-tab"
                            data-toggle="pill" href="#pills-des" role="tab" aria-controls="pills-des"
                            aria-selected="false">Deskripsi Bisnis</a> </li>
                    <li class="nav-item sp-tab"> <a class="nav-link inter-medium-delta" id="pills-contact-tab"
                            data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact"
                            aria-selected="false">Kontak</a> </li>
                </ul> <!-- content -->
                <div class="tab-content" id="pills-tabContent p-3">
                    <!-- 1st card -->
                    <div class="tab-pane fade active show" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab">
                        {{-- <div class="table-row-1">
                            <span class="inter-medium-delta-16px">Saham Tersisa : 100</span>
                        </div>
                        <div class="table-row">
                            <span class="inter-medium-delta-16px">Dalam Lembar : 100</span>
                        </div>
                        <div class="table-row">
                            <span class="inter-medium-delta-16px">Total Rupiah : 100</span>
                        </div> --}}
                        <div class="row">
                            <div class="col-6">
                                <table style="color: var(--delta);
                        font-family: var(--font-family-inter);
                        font-size: var(--font-size-l);
                        font-style: normal;
                        font-weight: 500;">
                                    <tr>
                                        <td>Saham Tersisa <br>
                                            {{ number_format($emt->avg_capital_needs > 0 ?
                                            round((($emt->avg_capital_needs - $bok->tot) / $emt->avg_capital_needs) *
                                            100, 2) : 0, 2, ',', '.') }}%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dalam Lembar <br>
                                            {{ number_format($emt->avg_capital_needs > 0 ?
                                            round(($emt->avg_capital_needs - $bok->tot) / $emt->price, 0) : 0, 0, ',',
                                            '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Rupiah <br>
                                            Rp{{ number_format($emt->avg_capital_needs > 0 ?
                                            round($emt->avg_capital_needs - $bok->tot, 0) : 0, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-6">
                                <table style="color: var(--delta);
                        font-family: var(--font-family-inter);
                        font-size: var(--font-size-l);
                        font-style: normal;
                        font-weight: 500;">
                                    <tr>
                                        <td>Saham Terjual <br>
                                            {{ number_format($bok->tot > 0 ? round(($bok->tot / $emt->avg_capital_needs)
                                            * 100, 2) : 0, 2, ',', '.') }}%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dalam Lembar <br>
                                            {{ number_format($bok->tot > 0 ? round($bok->tot / $emt->price, 0) : 0, 0,
                                            ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Dalam Rupiah<br> Rp{{ number_format(round($bok->tot, 0), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div> <!-- 2nd card -->
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="row">
                            <div class="col-6">
                                <table style="color: var(--delta);
                        font-family: var(--font-family-inter);
                        font-size: var(--font-size-l);
                        font-style: normal;
                        font-weight: 500;">
                                    <tr>
                                        <td>Harga Saham <br>
                                            Rp{{ number_format(round($emt->price, 0), 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Saham <br>
                                            {{ number_format(round($emt->avg_capital_needs / $emt->price, 0), 0, ',',
                                            '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Saham (Rp) <br>
                                            Rp{{ number_format(round($emt->avg_capital_needs, 0), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-6">
                                <table style="color: var(--delta);
                        font-family: var(--font-family-inter);
                        font-size: var(--font-size-l);
                        font-style: normal;
                        font-weight: 500;">
                                    <tr>
                                        <td>Kode Saham <br> {{ $emt->code_emiten }}</td>
                                    </tr>
                                    <tr>
                                        <td>Sisa Waktu <br>
                                            <?php
$now = time();
$start = strtotime($status->date);
$end = strtotime($status->end_date);
$datediff = $end - $now;
?>
                                            {{ round($datediff / (60 * 60 * 24)) }} Hari
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Periode Deviden<br> 6 Bulan</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div> <!-- 3nd card -->
                    <!-- 2nd card -->
                    <div class="tab-pane fade" id="pills-des" role="tabpanel" aria-labelledby="pills-des-tab">
                        <div class="table-row-1">
                            <span class="inter-medium-delta-16px" style="text-align: justify;">{{
                                $emt->business_description }}</span>
                        </div>
                    </div> <!-- 3nd card -->
                    <!-- 2nd card -->
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="table-row-1">
                            <span class="inter-medium-delta-16px">Instagram : {{ $emt->instagram }}</span>
                        </div>
                        <div class="table-row">
                            <span class="inter-medium-delta-16px">Facebook : {{ $emt->facebook }}</span>
                        </div>
                        <div class="table-row">
                            <span class="inter-medium-delta-16px">Website : {{ $emt->website }}</span>
                        </div>
                    </div> <!-- 3nd card -->
                </div>
            </div>


            {{-- <div class="col-lg-6 col-sm-6 container">
                <div class="info-deviden border-1px-cape-cod boxi">
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
                                            sebelumnya</span><br><span
                                            class="inter-normal-delta-12px">2020:</span><br><span
                                            class="inter-medium-delta-12px"
                                            style="font-weight: bold; color: #fff">{{number_format(round($emt->avg_annual_turnover_previous_year,0),0,',','.')}}</span>
                                    </p>
                                </div>
                                <div class="table-cell" style="margin-top: 10px;">
                                    <p class="pembagian-deviden-ta inter-normal-delta-12px">
                                        <span class="inter-normal-delta-12px">2021:</span><br><span
                                            class="inter-normal-delta-12px"
                                            style="font-weight: bold; color: #fff">{{number_format(round($emt->avg_annual_turnover_current_year,0),0,',','.')}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container" style="margin-bottom: -20px;margin-top: 10px;">
                        @guest
                        @if ($status->title == 'Pra Penawaran Saham')
                        @elseif ($status->title == 'Penawaran Saham')
                        <a href="{{route('login')}}" class="btn btn-danger btn-block">Pesan Saham</a>
                        @endif
                        @else
                        @if ($status->title == 'Pra Penawaran Saham')

                        @elseif ($status->title == 'Penawaran Saham')
                        <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#beliSahamModal">Pesan
                            Saham</button>
                        @endif
                        @endguest

                    </div>
                </div>
            </div> --}}
            <div class="col-lg-6 col-sm-6 container">
                <div class="info-deviden border-1px-cape-cod" style="width: 300px; height: 430px;">
                    <div class="pembagian-deviden-1 inter-normal-delta-12px">
                        <span class="inter-normal-delta-12px">Mulai dari</span>
                    </div>
                    <div class="table-7">
                        <p class="pembagian-deviden-ta inter-bold-alabaster-24px">
                            <span class="inter-bold-alabaster-24px" style="color: #fff">Rp{{
                                number_format(round($emt->price * 100, 0), 0, ',', '.') }}</span><span
                                class="inter-normal-delta-14px" style="white-space: nowrap;">/100 lembar</span><br>
                            <span class="inter-normal-delta-12px" style="white-space: nowrap; margin-top: -5px;">Dari
                                target</span>&nbsp;<span class="inter-normal-delta-12px"
                                style="font-weight: bold; color: #fff">Rp{{ number_format(round($emt->avg_capital_needs,
                                0), 0, ',', '.') }}</span>
                        </p>
                        <div class="overlap-group" style=" min-width: 270px;">
                            <div class="percent inter-medium-white-12px">
                                <div class="progress-bar "
                                    style="width:  {{ number_format($bok->tot > 0 ? round(($bok->tot / $emt->avg_capital_needs) * 100, 2) : 0, 2, '.', ',') }}%; background-color:#bf2d30; border-radius: 8px; height: 16px;"
                                    role="progressbar"
                                    aria-valuenow=" {{ number_format($bok->tot > 0 ? round(($bok->tot / $emt->avg_capital_needs) * 100, 2) : 0, 2, ',', '.') }}"
                                    aria-valuemin="0" aria-valuemax="100">

                                    <span class="tx-np percen inter-medium-white">

                                        {{-- {{ round((round($np->terjual,0)/round($np->avg_capital_needs,0))*100,2) }}
                                        --}}
                                        {{-- @if ($bok->tot > 0 ? ($bok->tot / $emt->avg_capital_needs) : 0 * 100 ==
                                        0.0)
                                        0 --}}
                                        {{-- @else --}}
                                        {{ number_format($bok->tot > 0 ? round(($bok->tot / $emt->avg_capital_needs) *
                                        100, 2) : 0, 2, ',', '.') }}
                                        {{-- @endif --}}
                                        %
                                    </span>
                                </div>
                            </div>
                        </div>
                        <p class="pembagian-deviden-ta inter-normal-delta-12px">
                            <span class="inter-normal-delta-12px" style="white-space: nowrap;">Sisa
                                waktu:</span>&nbsp;<span class="inter-normal-delta-12px">
                                <?php
                                    $now = time();
                                    $start = strtotime($status->date);
                                    $end = strtotime($status->end_date);
                                    $datediff = $end - $now;
                                    ?>
                                {{ round($datediff / (60 * 60 * 24)) }}
                                Hari
                            </span>
                            <img class="divider" style="min-width: 270px; margin-top: 30px;"
                                src="{{ asset('public/assets/images/divider-108@2x.png') }}" />

                            <br><br><span class="inter-medium-delta-12px">Bagikan: &nbsp;&nbsp;</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('detail-now-playing') }}/{{ $emt->id }}"
                                id="shareFacebook" target="_blank" style="text-decoration: none;">
                                <i style="font-size: 20px; margin-top; color: #a3a3a3; "
                                    class="fab fa-facebook"></i>&nbsp;&nbsp;&nbsp;
                            </a>
                            <a>
                                <i style="font-size: 20px; cursor:pointer;" class="fa fa-clone"
                                    onclick="shareButton('{{ url('detail-now-playing') }}/{{ $emt->id }}')"></i>
                            </a>
                            <br><br>
                            <img class="divider" style="min-width: 270px;"
                                src="{{ asset('public/assets/images/divider-108@2x.png') }}" />
                        <div style="min-width: 270px; margin-top: 10px;">
                            {{-- <a class="b-daf btn btn-danger btn-lg btn-block" href=""><i
                                    class="fas fa-shopping-cart"></i>&nbsp; Beli
                                Saham</a><br>
                            <a style="margin-left: -1px; margin-top: -10px;"
                                class="b-mul btn btn-light btn-lg btn-block"
                                href="{{ route('daftar-bisnis.index') }}"><i class="fas fa-list"></i>&nbsp;
                                Prospektus</a> --}}
                            @guest
                            <a href="{{ route('login') }}" class="btn btn-danger btn-block"><i
                                    style="font-size: 20px; margin-top; color: #a3a3a3; "
                                    class="fa fa-shopping-cart"></i>Beli Saham</a>
                            <a target="blank" class="btn btn-light btn-block"
                                href="{{ config('global.STORAGE_GOOGLE') . 'token/' . $emt->prospektus }}"><i
                                    class="fa fa-file-text" aria-hidden="true"></i> Prospektus</a>
                            <a target="blank" class="btn btn-success btn-block"
                                href="{{ config('global.STORAGE_GOOGLE') . 'token/' . $emt->prospektus }}"><i
                                    class="fa fa-comments" aria-hidden="true"></i> Gabung Grup Chat</a>
                            @else
                            <button class="btn btn-danger btn-block" data-toggle="modal"
                                data-target="#beliSahamModal"><i class="fa fa-shopping-cart"></i> Beli
                                Saham</button>
                            <a target="blank" class="btn btn-light btn-block"
                                href="{{ config('global.STORAGE_GOOGLE') . 'token/' . $emt->prospektus }}"><i
                                    class="fa fa-file-text" aria-hidden="true"></i> Prospektus</a>
                            <a target="blank" class="btn btn-success btn-block"
                                href="{{ config('global.STORAGE_GOOGLE') . 'token/' . $emt->prospektus }}"><i
                                    class="fa fa-comments" aria-hidden="true"></i> Gabung Grup Chat</a>

                            {{-- {{$group->id}} --}}
                            @endguest
                        </div>
                        </p>
                    </div>
                </div>
            </div>
            {{--
        </div> --}}

    </div>



    <!-- <div class="actions-com">
            @guest
                    <a class="button-5" href="{{ route('login') }}" style="cursor: pointer;">
                      <img class="icon-com" src="{{ asset('public/assets/images/icon-heart-47@2x.png') }}" />&ensp;
                      <div class="address-1 inter-medium-eerie-black-14px">
                        <span class="tx-icon inter-medium-eerie-black">
                          <span id="addcountLike" class="tx-icon">{{ $clike->l }} <span class="com-u">Likes</span></span>
                        </span>
                      </div>
                    </a>
                    <a class="button-5" href="{{ route('login') }}" style="cursor: pointer;">
                      <img class="ico-comn" src="{{ asset('public/assets/images/icon-user-47@2x.png') }}" />&ensp;
                      <div class="address-1 inter-medium-eerie-black-14px">
                        <span class="tx-icon inter-medium-eerie-black">
                          <span id="addcountVote" class="tx-icon">{{ $cvote->v }} <span class="com-u">Minat</span></span>
                        </span>
                      </div>
                    </a>
    @else
        <a class="button-5 clike" data-id={{ $emt->id }} id="clike" style="cursor: pointer;">
                      <img class="icon-com" src="{{ asset('public/assets/images/icon-heart-47@2x.png') }}" />&ensp;
                      <div class="address-1 inter-medium-eerie-black-14px">
                        <span class="tx-icon inter-medium-eerie-black ">
                          <span id="addcountLike" class="tx-icon">{{ $clike->l }} <span class="com-u">Likes</span></span>
                        </span>
                      </div>
                    </a>
                    <a class="button-5 slike" data-id={{ $emt->id }} id="slike" style="cursor: pointer;display:none;">
                      <img class="icon-com" src="{{ asset('public/assets/images/icon-heart-47@2x.png') }}" />&ensp;
                      <div class="address-1 inter-medium-eerie-black-14px">
                        <span class="tx-icon inter-medium-eerie-black ">
                          <span id="subcountLike" class="tx-icon">{{ $clike->l }} <span class="com-u">Likes</span></span>
                        </span>
                      </div>
                    </a>
                    <a class="button-5" data-id={{ $emt->id }} id="cvote" style="cursor: pointer;">
                      <img class="ico-comn" src="{{ asset('public/assets/images/icon-user-47@2x.png') }}" />&ensp;
                      <div class="address-1 inter-medium-eerie-black-14px">
                        <span class="tx-icon inter-medium-eerie-black">
                          <span id="addcountVote" class="tx-icon">{{ $cvote->v }} <span class="com-u">Minat</span></span>
                        </span>
                      </div>
                    </a>
                    <a class="button-5" data-id={{ $emt->id }} id="svote" style="cursor: pointer;display:none;">
                      <img class="ico-comn" src="{{ asset('public/assets/images/icon-user-47@2x.png') }}" />&ensp;
                      <div class="address-1 inter-medium-eerie-black-14px">
                        <span class="tx-icon inter-medium-eerie-black">
                          <span id="subcountVote" class="tx-icon">{{ $cvote->v }} <span class="com-u">Minat</span></span>
                        </span>
                      </div>
                    </a>
            @endguest
            <a class="button-5" class="cmt" id="cmt" style="cursor: pointer;" data-id="{{ $emt->id }}" data-toggle="modal"
              data-target="#modal{{ $emt->id }}">
              <img class="icon-com" src="{{ asset('public/assets/images/icon-message-circle-47@2x.png') }}" />&ensp;
              <div class="address-1 inter-medium-eerie-black-14px">
                <span class="tx-icon inter-medium-eerie-black">
                  <span class="tx-icon"> {{ $ccmt }} <span class="com-u">Komentar</span></span>
                </span>
              </div>
            </a>
            <a class="button-5" style="cursor: pointer;" data-id="{{ $emt->id }}" data-toggle="modal"
              data-target="#modalShareButton{{ $emt->id }}">
              <img class="icon-com" src="{{ asset('public/assets/images/icon-share-2-47@2x.png') }}" />&ensp;
              <div class="address-1 inter-medium-eerie-black-14px">
                <span class="tx-icon inter-medium-eerie-black">
                  <p class="com-u">&ensp;Share</p>
                </span>
              </div>
            </a>
          </div> -->
    @if ($emt->youtube == null)
    @else
    <div class="videoWrapper" style="margin-top: 100px;">
        <!-- Copy & Pasted from YouTube -->
        <iframe width="560" height="349" src="{{ $emt->youtube }}" frameborder="0"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    @endif
    <div class="gallery">
        <div class="gallery-1 inter-bold-alabaster-24px"><span class="inter-bold-alabaster-24px">Gallery</span>
        </div>
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
                                        <img class="rectangle-2" src="{{ env('PATH_WEB_PROD') }}{{ $picture[3] }}" />
                                    </div>
                                    @endif
                                    @if ($picture[4] == 'default.png')
                                    @else
                                    <div class="item">
                                        <img class="rectangle-2" src="{{ env('PATH_WEB_PROD') }}{{ $picture[4] }}" />
                                    </div>
                                    @endif
                                    @if ($picture[5] == 'default.png')
                                    @else
                                    <div class="item">
                                        <img class="rectangle-2" src="{{ env('PATH_WEB_PROD') }}{{ $picture[5] }}" />
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


</div>
<input type="hidden" name="detail-price" id="detail-price" value="{{ $emt->price }}">

<div class="modal fade" id="beliSahamModal" tabindex="-1" aria-labelledby="beliSahamModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <img src="{{ env('PATH_WEB_PROD') }}{{ $picture[0] }}"
                onerror="this.onerror=null;this.src='https://santara.co.id//assets/images/error/no-image-user.png';"
                height="200px">
            <div class="p-4 modal-body beli-saham-modal">
                <h3 class="text-danger font-poppins" style="font-weight: 800;">{{ $emt->trademark }}</h3>
                <h6>{{ $emt->company_name }}</h6>
                <p><span class=" font-weight-lighter">Minimum Pembelian</span> &nbsp;: &nbsp; Rp
                    {{ number_format(round($emt->price * 100, 0), 0, ',', '.') }} - 100
                    Lembar</p>
                <hr>
                {{-- <form action="{{url('pesan_saham/store_user')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }} --}}
                    <form action="{{ url('transaksi/pembayaran') }}" method="GET" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type="hidden" name="emiten_id" value="{{ $emt->id }}">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group row d-flex justify-content-center text-center">
                                    <label for="jumlah_saham" class="mb-2 text-bold col-12">Jumlah Saham yang akan
                                        dibeli
                                        dalam kelipatan
                                        100 lembar </label>
                                    <div class="input-group mb-3 text-center" style="width:80%">
                                        <span style="cursor: pointer" class="input-group-text jumlah-range"
                                            onclick="minusx()">--</span>
                                        <span style="cursor: pointer" class="input-group-text jumlah-range"
                                            onclick="minus()">-</span>
                                        <input type="text" class="form-control text-center number-only-phone"
                                            style="background-color: #fff;" id="jumlah_saham" value="0" disabled
                                            aria-label="Lembar saham">
                                        <input type="hidden" name="emid" value="{{ $emt->id }}">
                                        <input type="hidden" name="uuid" value="{{ $emt->uuid }}">
                                        <input type="hidden" id="lembar_saham" name="lembar_saham">
                                        <span class="input-group-text jumlah-range" style="cursor: pointer"
                                            onclick="plus()">+</span>
                                        <span class="input-group-text jumlah-range" style="cursor: pointer"
                                            onclick="plusx()">++</span>
                                    </div>
                                    <span class="error invalid-feedback text-center" style="display:none"
                                        id="alertmaks"></span>
                                </div>
                                <div class="mt-4 text-center row d-flex justify-content-center form-group">
                                    <label for="total_harga_saham" class="mb-2 text-bold">Total Harga Saham (Rp)</label>
                                    <input class="form-control text-center" type="text" id="total_harga_saham"
                                        style="width: 80%;" placeholder="Rp 0" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 row">
                            <div class="col-lg-12">
                                <div class="gap-2 d-grid">
                                    <button type="submit" id="btnbeli" class="btn btn-danger btn-block"><i
                                            class="fa fa-book"></i>
                                        Beli Saham</button>
                                </div>
                            </div>
                        </div>

                    </form>


            </div>

        </div>
    </div>

</div>


<div class="modal fade" id="modal{{ $emt->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-size: 20px;">{{ $emt->trademark }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="padding-right: 12px;">×</span>
                </button>
            </div>
            <div class="modal-body comm">

            </div>
            @guest
            @else
            <div class="modal-footer container">
                {{-- <form action="{{url('sendData')}}/{{$emt->id}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea name="comment" class="form-control" id="" cols="10" rows="10"></textarea>
                    </div>
                    <button type="button" id="send" class="btn btn-primary send">Send</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form> --}}
                {{-- <form action="{{url('sendData')}}/{{$emt->id}}" method="POST" enctype="multipart/form-data"> --}}

                    {{-- <input name="comment{{$emt->id}}"> --}}
                    {{-- <textarea name="comment{{$emt->id}}" id="" cols="30" rows="10"></textarea> --}}
                    {{-- <textarea class="form-control without-border" id="comment" name="comment{{$emt->id}}"
                        placeholder="Write a comment" style="font-size:12px; padding: 6px; resize:none;"></textarea>
                    <button type="button" class="btn btn-primary" id="send{{$emt->id}}">send</button> --}}
                    {{-- <div class="modal-footer "> --}}
                        <table>
                            <tbody>
                                <tr>
                                    <form id="ajaxform{{ $emt->id }}">
                                        {{-- {{ csrf_field() }} --}}
                                        <input type="hidden" name="idem{{ $emt->id }}" value="{{ $emt->id }}">
                                        <input type="hidden" name="trd{{ $emt->id }}">
                                        <td width="100%" valign="top" style="margin-right: 5px;">

                                            <textarea class="form-control without-border" id="comment"
                                                name="comment{{ $emt->id }}" placeholder="Write a comment" cols="70"
                                                style="font-size:12px; padding: 6px; resize:none;"></textarea>
                                            <span class="error" style="font-size: 10px; color:red" id="comment_error">
                                            </span>
                                        </td>
                                        <td rowspan="2"
                                            style="text-align: right; vertical-align: top;margin-left: 5px;padding-left: 15px;"
                                            width="25%">
                                            <button type="button" class="btn-pill btn btn-sm btn-outline-danger"
                                                id="send{{ $emt->id }}">Send
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

    <div class="modal fade" id="modalShareButton{{ $emt->id }}" tabindex="-1" role="dialog"
        aria-labelledby="modalLabel{{ $emt->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="p-2 modal-content">
                <div class="modal-header" style="border-bottom: none;">
                </div>
                <div class="text-center modal-body ">
                    <div class="d-flex justify-content-evenly mb-5">
                        <div class="container  text-center d-flex justify-content-center"
                            style="border-top: solid #D9D9D9;">
                            <h1 class="ff-a fs-24"
                                style="font-weight:800;text-transform:uppercase; padding:0 15px 0 15px; margin-top:-20px; width:150px; background-color:#fff;color:black;font-family: inherit;">
                                Share</h1>
                        </div>
                    </div>
                    <div class="row mt-3 mb-3 d-flex justify-content-center ">
                        <!-- <div class="col-4 col-md-2">
                            <img width="50px" src="https://santara.co.id/assets/new-santara/img/sosmed/instagram.png" />
                            <p class="ff-n fs-12 mt-2" style="color: #708088;">Instagram</p>
                        </div> -->
                        <div class="col-4 col-md-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=https://dev.santara.co.id/detail-coming-soon/{{ $emt->id }}"
                                id="shareFacebook" target="_blank" style="text-decoration: none;">
                                <img width="50px" src="https://santara.co.id/assets/new-santara/img/sosmed/facebook.png"
                                    class="lazyload">
                                <p class="ff-n fs-12 mt-2" style="color: #708088;">Facebook</p>
                            </a>
                        </div>
                        <div class="col-4 col-md-2">
                            <a href="https://twitter.com/intent/tweet?url=https://dev.santara.co.id/detail-coming-soon/{{ $emt->id }}&amp;text=Temukan%20peluang%20investasi%20berikut%20di%20Santara!%0A PT. Lembu Sora Lampung"
                                id="shareTwitter" style="text-decoration: none;" target="_blank">
                                <img width="50px" src="https://santara.co.id/assets/new-santara/img/sosmed/twitter.png"
                                    class="lazyload">
                                <p class="ff-n fs-12 mt-2" style="color: #708088;">Twitter</p>
                            </a>
                        </div>
                        <div class="col-4 col-md-2">
                            <a href="https://telegram.me/share/url?url=https://dev.santara.co.id/detail-coming-soon/{{ $emt->id }}&amp;text=Temukan%20peluang%20investasi%20berikut%20di%20Santara!%0A PT. Lembu Sora Lampung"
                                id="shareTelegram" target="_blank" style="text-decoration: none;">
                                <img width="50px" src="https://santara.co.id/assets/new-santara/img/sosmed/telegram.png"
                                    class="lazyload">
                                <p class="ff-n fs-12 mt-2" style="color: #708088;">Telegram</p>
                            </a>
                        </div>
                        <!-- <div class="col-4 col-md-2">
                            <img width="50px" src="https://santara.co.id/assets/new-santara/img/sosmed/tiktok.png" />
                            <p class="ff-n fs-12 mt-2" style="color: #708088;">TikTok</p>
                        </div> -->
                        <div class="col-4 col-md-2">
                            <a href="https://web.whatsapp.com/send?text=Temukan%20peluang%20investasi%20berikut%20di%20Santara!%0A https://dev.santara.co.id/detail-coming-soon/{{ $emt->id }}"
                                id="shareWhatsapp" target="_blank" style="text-decoration: none;">
                                <img width="50px" src="https://santara.co.id/assets/new-santara/img/sosmed/whatsapp.png"
                                    class="lazyload">
                                <p class="ff-n fs-12 mt-2" style="color: #708088;">WhatsApp</p>
                            </a>
                        </div>
                    </div>
                    <div class="input-group input-group-lg mb-3">
                        <input type="text" id="inputShareLink" class="form-control fs-16 bold ff-n" disabled=""
                            style="border-radius: 25px;padding-right:150px" aria-label="Recipient's username"
                            aria-describedby="basic-addon2"
                            placeholder="https://dev.santara.co.id/detail-coming-soon/{{ $emt->id }}">
                        <span id="copy-link" class="input-group-text"
                            style="position: inherit;height: 33px;justify-content: center;align-items: center;margin: 10px 17px 10px -134px;border-radius: 20px;color: #BF2D30;border-color: #BF2D30; cursor:pointer"
                            onclick="shareButton('https://dev.santara.co.id/detail-coming-soon/{{ $emt->id }}')">Copy
                            Link</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endsection
    @section('js')
    <script>
        $(document).ready(function() {
            $('#clike').click(function() {

                var id = $(this).data('id');
                let _token = $('meta[name="csrf-token"]').attr('content');
                console.log(id);
                // AJAX request
                $.ajax({
                    url: '{{ url('addLikeajx') }}/' + id,
                    type: 'post',
                    data: {
                        id: id,
                        _token: _token
                    },
                    success: function(count) {
                        // Add response in Modal body
                        toastr.info("Suka");
                        $.ajax({
                            url: '{{ url('getlike') }}/' + id,
                            type: 'get',
                            data: {
                                id: id
                            },
                            success: function(count) {
                                console.log(count);
                                var li = document.getElementById('subcountLike');
                                li.innerHTML = count;
                                document.getElementById("slike").style.display =
                                    "inherit";
                                document.getElementById("clike").style.display =
                                    "none";
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
        $(document).ready(function() {
            $('#slike').click(function() {
                var id = $(this).data('id');
                let _token = $('meta[name="csrf-token"]').attr('content');
                console.log(id);
                // AJAX request
                $.ajax({
                    url: '{{ url('subLikeajx') }}/' + id,
                    type: 'post',
                    data: {
                        id: id,
                        _token: _token
                    },
                    success: function(count) {
                        // Add response in Modal body
                        toastr.error("Batal Suka");
                        $.ajax({
                            url: '{{ url('getlike') }}/' + id,
                            type: 'get',
                            data: {
                                id: id
                            },
                            success: function(count) {
                                console.log(count);
                                var li = document.getElementById('addcountLike');
                                li.innerHTML = count;
                                document.getElementById("slike").style.display =
                                    "none";
                                document.getElementById("clike").style.display =
                                    "inherit";
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
        $(document).ready(function() {
            $('#cvote').click(function() {

                var id = $(this).data('id');
                let _token = $('meta[name="csrf-token"]').attr('content');
                console.log(id);
                // AJAX request
                $.ajax({
                    url: '{{ url('addVoteajx') }}/' + id,
                    type: 'post',
                    data: {
                        id: id,
                        _token: _token
                    },
                    success: function(count) {
                        // Add response in Modal body
                        toastr.info("Minat");
                        $.ajax({
                            url: '{{ url('getvote') }}/' + id,
                            type: 'get',
                            data: {
                                id: id
                            },
                            success: function(count) {
                                console.log(count);
                                var lis = document.getElementById('subcountVote');
                                lis.innerHTML = count;
                                document.getElementById("svote").style.display =
                                    "inherit";
                                document.getElementById("cvote").style.display =
                                    "none";
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
        $(document).ready(function() {
            $('#svote').click(function() {

                var id = $(this).data('id');
                let _token = $('meta[name="csrf-token"]').attr('content');
                console.log(id);
                // AJAX request
                $.ajax({
                    url: '{{ url('subVoteajx') }}/' + id,
                    type: 'post',
                    data: {
                        id: id,
                        _token: _token
                    },
                    success: function(count) {
                        // Add response in Modal body
                        toastr.error("Batal Minat");
                        $.ajax({
                            url: '{{ url('getvote') }}/' + id,
                            type: 'get',
                            data: {
                                id: id
                            },
                            success: function(count) {
                                console.log(count);
                                var lit = document.getElementById('addcountVote');
                                lit.innerHTML = count;
                                document.getElementById("cvote").style.display =
                                    "inherit";
                                document.getElementById("svote").style.display =
                                    "none";
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

                $('#shareWhatsapp').attr('href',
                    "https://web.whatsapp.com/send?text=Temukan%20peluang%20investasi%20berikut%20di%20Santara!%0A " +
                    url);
                $('#shareTelegram').attr('href', "https://telegram.me/share/url?url=" + url +
                    "&text=Temukan%20peluang%20investasi%20berikut%20di%20Santara!%0A " + message);
                $('#shareFacebook').attr('href', "https://www.facebook.com/sharer/sharer.php?u=" + url);
                $('#shareTwitter').attr('href', "https://twitter.com/intent/tweet?url=" + url +
                    "&text=Temukan%20peluang%20investasi%20berikut%20di%20Santara!%0A " + message);
                $('#copy-link').attr('onclick', "shareButton('" + url + "')");
                $('#inputShareLink').attr('placeholder', url);
                $('#modalShareButton').modal('show');
            }

        }
    </script>
    <script type='text/javascript'>
        $(document).ready(function() {

            $('#cmt').click(function() {

                var id = $(this).data('id');

                // AJAX request
                $.ajax({
                    url: '{{ url('getmodaldata') }}/' + id,
                    type: 'get',
                    data: {
                        id: id
                    },
                    success: function(cmt) {
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

    <script type='text/javascript'>
        $(document).ready(function() {
            $("#send{{ $emt->id }}").click(function() {
                // event.preventDefault();

                let comment = $("textarea[name=comment{{ $emt->id }}]").val();
                let idem = $("input[name=idem{{ $emt->id }}]").val();
                let trd = $("input[name=trd{{ $emt->id }}]").val();
                let _token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ url('sendData') }}" + "/" + idem,
                    type: "POST",
                    data: {
                        comment: comment,
                        idem: idem,
                        trd: trd,
                        _token: _token
                    },
                    success: function(response) {
                        // console.log(response);
                        if (response) {
                            $('.success').text(response.success);
                            $("#ajaxform{{ $emt->id }}")[0].reset();
                            $.ajax({
                                url: '{{ url('getmodaldata') }}/' +
                                    {{ $emt->id }},
                                type: 'get',
                                data: {
                                    id: "{{ $emt->id }}"
                                },
                                success: function(cmt) {
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
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            breakpoints: {
                "@0.00": {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                "@0.75": {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                "@1.00": {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
                "@1.50": {
                    slidesPerView: 3,
                    spaceBetween: 50,
                },
            },
        });

        function checkValidasi(total) {
            const total_price = document.getElementById("total_harga_saham");
            const detail_price = document.getElementById("detail-price");
            const alertmaks = document.getElementById("alertmaks");

            total_price.value = parseInt(total) * parseInt(detail_price.value);
            if (!isNaN(total_price.value) && total_price.value > 0) {
                btnbeli.disabled = false;
                var invest_value = parseInt(total);
                var maksimal_token_value = parseInt(
                    maksimal_token.innerHTML.replace(/\./g, "")
                );
                var minimum_invest_value = parseInt(
                    minimum_invest.innerHTML.replace(/\./g, "")
                );

                if (invest_value > maksimal_token_value) {
                    alertmaks.innerHTML =
                        `<i class="la la-exclamation-triangle"></i> Maksimal <strong>${maksimal_token.innerHTML} Lembar</strong>`;
                    alertmaks.style.display = "block";
                    $('#jumlah_saham').addClass('is-invalid')
                    total_price.value = 0;
                    btnbeli.disabled = true;
                } else if (maksimal_token_value > minimum_invest_value) {
                    if (invest_value >= minimum_invest_value) {
                        alertmaks.style.display = "none";
                        btnbeli.disabled = false;
                        $('#jumlah_saham').addClass('is-valid')
                        $('#jumlah_saham').removeClass('is-invalid')

                    } else {
                        alertmaks.innerHTML =
                            `<i class="la la-exclamation-triangle"></i> Minimal <strong>${minimum_invest.innerHTML} Lembar</strong>`;
                        alertmaks.style.display = "block";
                        $('#jumlah_saham').addClass('is-invalid')
                        btnbeli.disabled = true;
                        total_price.value = 0;
                    }
                } else {
                    alertmaks.style.display = "none";
                    $('#jumlah_saham').addClass('is-valid')
                    $('#jumlah_saham').removeClass('is-invalid')
                }

                total = formatNumber(total);
                total_price.value = formatNumber(
                    parseInt(total_price.value)
                );
            } else {
                total_price.value = 0;
            }
        };

        const kelipatan = 100;
        const kelipatanx = 1000;

        function minus() {
            let jumlah = $('#jumlah_saham').val();
            if (jumlah == '') {

            }
            jumlah.replace(/^0+/, "");
            jumlah.replace(/\./g, "");
            total = parseInt(jumlah) - parseInt(kelipatan)
            if (parseInt(jumlah) == 100) {
                $('#jumlah_saham').val(100)
                $('#lembar_saham').val(100);
            } else {
                $('#jumlah_saham').val(total)
                $('#lembar_saham').val(total);
            }
            checkValidasi(total)
        }

        function minusx() {
            let jumlah = $('#jumlah_saham').val();
            if (jumlah == '') {

            }
            jumlah.replace(/^0+/, "");
            jumlah.replace(/\./g, "");
            total = parseInt(jumlah) - parseInt(kelipatanx)
            if (parseInt(jumlah) == 100) {
                $('#jumlah_saham').val(100)
                $('#lembar_saham').val(100);
            } else {
                $('#jumlah_saham').val(total)
                $('#lembar_saham').val(total);
            }
            checkValidasi(total)
        }

        function plus() {
            let jumlah = $('#jumlah_saham').val();
            total = parseInt(jumlah) + parseInt(kelipatan);
            $('#jumlah_saham').val(total)
            $('#lembar_saham').val(total);
            checkValidasi(total)
        }

        function plusx() {
            let jumlah = $('#jumlah_saham').val();
            total = parseInt(jumlah) + parseInt(kelipatanx);
            $('#jumlah_saham').val(total)
            $('#lembar_saham').val(total);
            checkValidasi(total)
        }
    </script>
    @endsection

    @section('style')
    <style>

    </style>
    @endsection