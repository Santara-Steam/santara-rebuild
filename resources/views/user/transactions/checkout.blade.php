@extends('front_end/template_front_end/app')

@section('content')
<?php 
                              $picture = explode(',',$emiten->pictures);
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
<!-- fashion section start -->
<div class="fashion_section" style="margin-top: 146px;">

                <link rel="stylesheet" type="text/css"
                    href="https://dev.santara.id/assets/new-santara/css/checkout.css?v=5.8.8">

                <div class="container justify-content-center">
                    <div class="row" style="color: black;">
                        <div class="col-md-12">
                            <h2 class="fs-27 ff-p c-gold" style="text-transform:uppercase; text-align: center">
                                <b style="font-family: 'Poppins';">Pembayaran</b></h2>
                        </div>
                        <div class="col-md-12">
                            <div class="card-content">
                                <div class="card-body card-body-payment">
                                    <div class="col-md-6 offset-md-3 p-0">



                                        <!-- ITEM -->
                                        <div class="">
                                            <div class="alert container-checkout-item alert-dismissible fade show"
                                                role="alert">
                                                <div class="row">
                                                    <div class="col-12 col-md-4 d-flex justify-content-center">
                                                        <img src="https://storage.googleapis.com/asset-santara-staging/santara.co.id/token/{{$picture[0]}}"
                                                            onerror="this.onerror=null;this.src='https://storage.googleapis.com/asset-santara-staging/santara.co.id/images/error/no-image.png';"
                                                            class="payment-box-img" width="80" height="80">
                                                    </div>
                                                    <div class="col-12 col-md-8 text-left ff-m" style="padding: 10px;">
                                                        <strong style="font-size: 0.9rem;">{{$emiten->company_name}}</strong><br />
                                                        <span class="fs-12">Harga Saham
                                                            <span class="payment-detail-font" style="color :black;">
                                                                Rp {{number_format($emiten->price,0,',','.')}} </span><br />
                                                        </span>

                                                        <span class="fs-12">Jumlah Investasi
                                                            <span class="payment-detail-font" style="color :black;">
                                                                {{number_format($lembar_saham,0,',','.')}} Lembar
                                                            </span><br />
                                                        </span>

                                                        <hr style="margin-bottom: 0.25rem;margin-top: 0.25rem" />
                                                        <span class="fs-12"><b>Total</b>
                                                            <strong id="total" class="payment-detail-font"
                                                                style="color :black;">
                                                                Rp {{number_format($lembar_saham*$emiten->price,0,',','.')}} </strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <button type="button" style="color: #fff;" class="btn-close"
                                                    onClick="deleteTransaction('6ac584a7-69a6-41bd-b2b7-4046614638f3')"></button>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-8 offset-md-2 p-0 mt-5">
                                        <div class="mb-0">
                                            <div class="text-center">
                                                <strong style="color: #fff;">Pilih Metode Pembayaran</strong>
                                            </div>
                                            <hr class="mb-0" />
                                            <div class="accordion" id="accordionPayment">

                                                <!-- WALLET -->
                                                <div class="mt-1">
                                                    {{-- <button class="btn btn-primary" disabled>tes</button> --}}
                                                        <a class="link-checkout-pembayaran"
                                                            id="cowallet"
                                                            
                                                            @if ($lembar_saham*$emiten->price > Auth::user()->trader->saldo->balance)
                                                            style="pointer-events: none;
                                                            cursor: default;
                                                            text-decoration: none;
                                                            color: black;"
                                                            @endif
                                                            >
                                                            <div class="card-body payment-method-box">
                                                                <h2 class="mb-0 row">
                                                                    <div class="col-md-3 col-2">
                                                                        <i class="fas fa-wallet"
                                                                            style="font-size: 3.5rem;padding-right:10px"></i>

                                                                    </div>
                                                                    <div class="col-md-8 col-9 bank-title my-auto">
                                                                        <div>
                                                                            <span>Rp 8.293.304 </span>
                                                                        </div>
                                                                        <div><b>DOMPET</b></b></div>
                                                                        <input type="hidden" name="wallet" id="wallet"
                                                                            value="8293304" />
                                                                    </div>
                                                                    <div
                                                                        class="col-1 payment-icon-right my-auto text-center">
                                                                        <i class="la la-angle-right"></i>
                                                                    </div>
                                                                </h2>
                                                            </div>
                                                        </a>
                                                </div>
                                                <!-- ONEPAY -->
                                                <div class="mt-1">
                                                    <a id="copayment" class="link-checkout-pembayaran"
                                                        >
                                                        <div class="card-body payment-method-box">
                                                            <h2 class="mb-0 row">
                                                                <div class="col-md-3 col-2">
                                                                    <!-- <img src="/assets/images/onepay/onepay.png" onerror="this.onerror=null;this.src='https://storage.googleapis.com/asset-santara-staging/santara.co.id/images/error/no-image.png';" class="payment-logo"> -->
                                                                    <i class="fas fa-wallet"
                                                                        style="font-size: 3.5rem;padding-right:10px"></i>
                                                                    <!-- <div><b>ONEPAY</b></div> -->
                                                                </div>
                                                                <div class="col-md-8 col-9 bank-title">
                                                                    <div><span>Biaya admin Rp 4.000,-</span></div>
                                                                    <div><b>OTHER PAYMENT</b></div>
                                                                </div>
                                                                <div class="col-1 payment-icon-right">
                                                                    <i class="la la-angle-right"
                                                                        style="vertical-align: bottom;"></i>
                                                                </div>
                                                            </h2>
                                                        </div>
                                                    </a>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <span id="emitten_id" style="display:none">3381</span>
                <input type="hidden" class="form-control" name="invest" id="invest" value="100000" readonly>

                <hr>
                <script src="https://dev.santara.id/assets/new-santara/js/guest/checkout.js?v=5.8.8"></script>
</div>

</div>


</div>
</div>
</div>

<form action="{{url('transaksi/buy')}}" id="chout" method="POST" enctype="multipart/form-data" >
    {{ csrf_field() }}
    <input hidden  name="uuid" value="{{$emiten->uuid}}">
    <input hidden  name="amount" value="{{$lembar_saham*$emiten->price}}">
    <input hidden  name="pinx" id="pinx">
    <input hidden  name="channelx" id="channelx">

</form>

<!-- footer section start -->
<div class="footer_section ">
    <div class="container-fluid disclaimer-outer-bg bg-disclaimer ">

        <div class="container disclaimer-inner-bg" style="font-size: 11px;">

            <h4 class="text-danger ff-a fs-16"
                style="font-size: 16px; font-family: 'acumin-pro'; margin-left: 5px; margin-bottom: -2px">Disclaimer:
            </h4>
            <div class="row ff-n"
                style="font-weight: normal;     text-align: justify; margin-right: -15px; font-family: 'Nunito'; font-size: 11px;">
                <p class="mt-2" style="margin-bottom: 8px; color: #fff; font-size: 11px;line-height:1.5;">Pembelian
                    saham bisnis merupakan aktivitas beresiko tinggi. Anda berinvestasi pada bisnis yang mungkin saja
                    mengalami kenaikan dan penurunan kinerja bahkan mengalami kegagalan. Harap menggunakan pertimbangan
                    ekstra dalam membuat keputusan untuk membeli saham. Ada kemungkinan Anda tidak bisa menjual kembali
                    saham bisnis dengan cepat. Lakukan diversifikasi investasi, hanya gunakan dana yang siap Anda
                    lepaskan (affors to loose) dan atau disimpan dalam jangka panjang. Santara tidak memaksa pengguna
                    untuk membeli saham bisnis sebagai investasi. Semua keputusan pembelian merupakan keputusan
                    independen oleh pengguna.
                </p>
                <p style="margin-bottom: 8px; color: #fff; font-size: 11px;line-height:1.5; " ;>
                    Santara bertindak sebagai penyelenggara urun dana yang mempertemukan pemodal dan penerbit, bukan
                    sebagai pihak yang menjalankan bisnis (Penerbit). Otoritas Jasa Keuangan bertindak sebagai regulator
                    dan pemberi izin, bukan sebagai penjamin investasi. Keputusan pembelian saham, sepenuhnya merupakan
                    hak dan tanggung jawab Pemodal (investor). Dengan membeli saham di Santara berarti Anda sudah
                    menyetujui seluruh syarat dan ketentuan serta memahami semua risiko investasi termasuk resiko
                    kehilangan sebagian atau seluruh modal.
                </p>
                <p style="margin-bottom: 8px;color: #fff; font-size: 11px; line-height:1.5; ">
                    “OTORITAS JASA KEUANGAN TIDAK MEMBERIKAN PERNYATAAN MENYETUJUI ATAU TIDAK MENYETUJUI EFEK INI, TIDAK
                    JUGA MENYATAKAN KEBENARAN ATAU KECUKUPAN INFORMASI DALAM LAYANAN URUN DANA INI. SETIAP PERNYATAAN
                    YANG BERTENTANGAN DENGAN HAL TERSEBUT ADALAH PERBUATAN MELANGGAR HUKUM.”
                </p>
                <p style="margin-bottom: 8px;color: #fff; font-size: 11px;  line-height:1.5;">
                    “INFORMASI DALAM LAYANAN URUN DANA INI PENTING DAN PERLU MENDAPAT PERHATIAN SEGERA. APABILA TERDAPAT
                    KERAGUAN PADA TINDAKAN YANG AKAN DIAMBIL, SEBAIKNYA BERKONSULTASI DENGAN PENYELENGGARA.”
                </p>
                <p style="margin-bottom: 8px;color: #fff; font-size: 11px; line-height:1.5; ">
                    “PENERBIT DAN PENYELENGGARA, BAIK SENDIRI-SENDIRI MAUPUN BERSAMA-SAMA, BERTANGGUNG JAWAB SEPENUHNYA
                    ATAS KEBENARAN SEMUA INFORMASI YANG TERCANTUM DALAM LAYANAN URUN DANA INI.”
                </p>
            </div>
        </div>

    </div>
</div>
@endsection

@section('style')
    <style>
        h2{
            color:white;
            font-weight: 700;
        }

        h2:hover{
            color:#dfb857;
        }
    </style>
@endsection
@section('js')
<script type="text/javascript" src="{{asset('public')}}/app-assets/js/core/alert/sweetalert.min.js"></script>
<script src="{{asset('public')}}/assets2/js/global.js?v=5.8.8"></script>
    <script>
        $("#cowallet").click(function () {
//   console.log('ok');
    
    Swal.fire({
    html: `<div><img src="{{asset('public')}}/assets2/images/content/account/password.png" width="35%" alt="security token"></div>
                <div class="mt-1"><b class="swal-popup-title">Masukan PIN Anda</b></div> 
                <div><p style="font-size: .9rem;">Masukan kode 6 angka security pin akun anda</p></div>
                <p><span id="pin_error" class="text-danger" style="font-size:12px"></span></p>
                <input type="hidden" name="amou" id="amouw">
                <input type="password" name="pinw" class="form-control form-control-no-radius swal-popup-input" id="pin" onkeypress="return isNumberKey(event)" maxlength="6" required style="border: 2px solid;background-color: #ebe6e6;">
                `,
                inputAttributes: {
      autocapitalize: "off",
    },
    customClass: "swal-popup",
    showCancelButton: false,
    showConfirmButton: true,
    showLoaderOnConfirm: true,
    confirmButtonText: "Verifikasi",
    footer: '<p class="swal-popup-footer">Lupa PIN ? <a href="/user/security/email">Reset PIN</a></p>',
    focusConfirm: false,
    preConfirm: () => {
        // $("#amou").val(amount.value.replace(/\./, ""));
        const login = Swal.getPopup().querySelector('#amouw').value
        const password = Swal.getPopup().querySelector('#pin').value
        $("#pinx").val(password);
        $("#channelx").val('WALLET');
        return { login: login, password: password }
    }
        }).then((result) => {
            if (result.value.password != '') {
            document.getElementById('chout').submit();
            }
            // console.log(result.value.password);
            });
        });
    </script>
    <script>
        $("#copayment").click(function () {
//   console.log('ok');
    
    Swal.fire({
    html: `<div><img src="{{asset('public')}}/assets2/images/content/account/password.png" width="35%" alt="security token"></div>
                <div class="mt-1"><b class="swal-popup-title">Masukan PIN Anda</b></div> 
                <div><p style="font-size: .9rem;">Masukan kode 6 angka security pin akun anda</p></div>
                <p><span id="pin_error" class="text-danger" style="font-size:12px"></span></p>
                <input type="hidden" name="amou" id="amou">
                <div>
                <input type="password" name="pin" class="form-control form-control-no-radius swal-popup-input" id="pin" onkeypress="return isNumberKey(event)" maxlength="6" required style="border: 2px solid;background-color: #ebe6e6;">
</div>`,
                inputAttributes: {
      autocapitalize: "off",
    },
    customClass: "swal-popup",
    showCancelButton: false,
    showConfirmButton: true,
    showLoaderOnConfirm: true,
    confirmButtonText: "Verifikasi",
    footer: '<p class="swal-popup-footer">Lupa PIN ? <a href="/user/security/email">Reset PIN</a></p>',
    focusConfirm: false,
    preConfirm: () => {
        // $("#amou").val(amount.value.replace(/\./, ""));
        const login = Swal.getPopup().querySelector('#amou').value
        const password = Swal.getPopup().querySelector('#pin').value
        $("#pinx").val(password);
        $("#channelx").val('ONEPAY');
        return { login: login, password: password };
        document.getElementById('chout').submit();
    }
    }).then((result) => {
    // console.log(result.value.login);
    if (result.value.password != '') {
            document.getElementById('chout').submit();
            }
    });
});
    </script>
@endsection