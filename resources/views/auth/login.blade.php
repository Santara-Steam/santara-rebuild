@extends('front_end/template_front_end/app')

@section('content')

    <div class="container" style="margin-top: 180px;">
        <div class="row d-flex align-content-center justify-content-center flex-wrap row-login">
            <div class="col-md-10">
                <div class="row card-body-login">
                    <div class="row card col-md-5 d-flex align-content-center justify-content-center flex-wrap text-center p-4 img-login">
                        <div class="row d-flex align-content-center justify-content-center flex-wrap text-center">
                            <img src="{{ asset('new-santara/img/logo/santara-black.svg') }}" alt="logo santara" style="max-width: 140px;" />
                            <p class="ff-m fs-12 c-abu mt-2">Equity Crowdfunding Indonesia</p>
                        </div>
                        <div class="row">
                            <img src="{{ asset('new-santara/img/login-dulu.svg') }}" alt="login" />
                        </div>
                    </div>
                    <div class="row col-md-7 d-flex align-content-center justify-content-center flex-wrap  bg-login row-form-login p-3">
                        <p class="fs-24 ff-m text-center"><b style="font-weight: bold;">Login</b></p>
                        <div class="row mt-3">

                            <div class="col-md-12">
                                <form class="form-login" id="form_login" method="POST" action="{{ route('login') }}">
                                @csrf
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        </div>
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
                                            <span class="input-group-text" style="background-color: #fff;"><i id="eye" class="fas fa-eye-slash" onclick="showHidePwd();"></i></span>
                                        </div>
                                    </div>
                                    @error('password')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group mb-3">
                                        <input type="hidden" name="g-recaptcha-response" id="recaptcha">
                                        @error('g-recaptcha-response')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row m-0 mt-4">
                                        <button class="btn btn-danger" type="submit">
                                            <span class="btnLabel">Masuk</span>
                                        </button>

                                    </div>
                                    <div class="row fs-11 ff-m mt-2">
                                        <div class="col-6 d-flex align-content-start float-start">
                                            <a class="link" href="{{ route('password.request') }}">Lupa password?</a>
                                        </div>
                                        <div class="row col-lg-6 d-flex align-content-end text-end">
                                            <p style="font-size: 12px;">Belum punya akun? <a class="link" href="{{ route('register') }}">&ensp; Daftar</a></p>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

         <!-- footer section start -->
<div class="footer_section ">
         <div class="container-fluid disclaimer-outer-bg bg-disclaimer ">

          <div class="container disclaimer-inner-bg" style="font-size: 11px;">

            <h4 class="text-danger ff-a fs-16" style="font-size: 16px; font-family: 'acumin-pro'; margin-left: 5px; margin-bottom: -2px">Disclaimer:</h4>
            <div class="row ff-n" style="font-weight: normal;     text-align: justify; margin-right: -15px; font-family: 'Nunito'; font-size: 11px;">
              <p class="mt-2" style="margin-bottom: 8px; color: #fff; font-size: 11px;line-height:1.5;">Pembelian saham bisnis merupakan aktivitas beresiko tinggi. Anda berinvestasi pada bisnis yang mungkin saja mengalami kenaikan dan penurunan kinerja bahkan mengalami kegagalan. Harap menggunakan pertimbangan ekstra dalam membuat keputusan untuk membeli saham. Ada kemungkinan Anda tidak bisa menjual kembali saham bisnis dengan cepat. Lakukan diversifikasi investasi, hanya gunakan dana yang siap Anda lepaskan (affors to loose) dan atau disimpan dalam jangka panjang. Santara tidak memaksa pengguna untuk membeli saham bisnis sebagai investasi. Semua keputusan pembelian merupakan keputusan independen oleh pengguna.
              </p>
              <p style="margin-bottom: 8px; color: #fff; font-size: 11px;line-height:1.5; "; >
                Santara bertindak sebagai penyelenggara urun dana yang mempertemukan pemodal dan penerbit, bukan sebagai pihak yang menjalankan bisnis (Penerbit). Otoritas Jasa Keuangan bertindak sebagai regulator dan pemberi izin, bukan sebagai penjamin investasi. Keputusan pembelian saham, sepenuhnya merupakan hak dan tanggung jawab Pemodal (investor). Dengan membeli saham di Santara berarti Anda sudah menyetujui seluruh syarat dan ketentuan serta memahami semua risiko investasi termasuk resiko kehilangan sebagian atau seluruh modal.
              </p>
              <p style="margin-bottom: 8px;color: #fff; font-size: 11px; line-height:1.5; ">
                ???OTORITAS JASA KEUANGAN TIDAK MEMBERIKAN PERNYATAAN MENYETUJUI ATAU TIDAK MENYETUJUI EFEK INI, TIDAK JUGA MENYATAKAN KEBENARAN ATAU KECUKUPAN INFORMASI DALAM LAYANAN URUN DANA INI. SETIAP PERNYATAAN YANG BERTENTANGAN DENGAN HAL TERSEBUT ADALAH PERBUATAN MELANGGAR HUKUM.???
              </p>
              <p style="margin-bottom: 8px;color: #fff; font-size: 11px;  line-height:1.5;">
                ???INFORMASI DALAM LAYANAN URUN DANA INI PENTING DAN PERLU MENDAPAT PERHATIAN SEGERA. APABILA TERDAPAT KERAGUAN PADA TINDAKAN YANG AKAN DIAMBIL, SEBAIKNYA BERKONSULTASI DENGAN PENYELENGGARA.???
              </p>
              <p style="margin-bottom: 8px;color: #fff; font-size: 11px; line-height:1.5; ">
                ???PENERBIT DAN PENYELENGGARA, BAIK SENDIRI-SENDIRI MAUPUN BERSAMA-SAMA, BERTANGGUNG JAWAB SEPENUHNYA ATAS KEBENARAN SEMUA INFORMASI YANG TERCANTUM DALAM LAYANAN URUN DANA INI.???
              </p>
            </div>
          </div>

        </div>
      </div>
    <link rel="stylesheet" type="text/css" href="{{ asset('new-santara/css/style.css?v=5.8.8') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('new-santara/css/login.css?v=5.8.8') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('new-santara/bootstrap/css/bootstrap.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('recaptchav3.sitekey') }}"></script>
    <script>
             grecaptcha.ready(function() {
                 grecaptcha.execute('{{ config('recaptchav3.sitekey') }}', {action: 'login'}).then(function(token) {
                    if (token) {
                      document.getElementById('recaptcha').value = token;
                    }
                 });
             })
        $(document).ready(function () {
            $('#eye').click(function () {
                $('#password').attr('type', $('#password').is(':password') ? 'text' : 'password');
                if ($('#password').attr('type') === 'password') {
                    $('#eye').removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    $('#eye').removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
        </script>
@endsection
