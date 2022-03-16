@extends('front_end/template_front_end/app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/new-santara/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/new-santara/css/style.css?v=5.8.8') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/new-santara/css/login.css?v=5.8.8') }}" />

    <div class="container">
        <div class="row d-flex align-content-center justify-content-center flex-wrap row-login">
            <div class="col-md-10">
                <div class="row card-body-login">
                    <div class="row card col-md-5 d-flex align-content-center justify-content-center flex-wrap text-center p-4 img-login">
                        <div class="row d-flex align-content-center justify-content-center flex-wrap text-center">
                            <img src="{{ asset('public/new-santara/img/logo/santara-black.svg') }}" alt="logo santara" style="max-width: 140px;" />
                            <p class="ff-m fs-12 c-abu mt-2">Equity Crowdfunding Indonesia</p>
                        </div>
                        <div class="row">
                            <img src="{{ asset('public/new-santara/img/login-dulu.svg') }}" alt="login" />
                        </div>
                    </div>
                    <div class="row col-md-7 d-flex align-content-center justify-content-center flex-wrap  bg-login row-form-login p-3">
                        <p class="fs-24 ff-m text-center"><b>Daftar</b></p>
                        <div class="row mt-3">

                            <div class="col-md-12">
                                <form class="form-login" id="form_login"method="POST" action="{{ route('register') }}">
                                @csrf
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nama" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        </div>

                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password Confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="row m-0 mt-4">
                                        <button class="btn btn-danger" type="submit">
                                            <span class="btnLabel">Daftar</span>
                                        </button>

                                    </div>
                                    <div class="row fs-11 ff-m mt-2">
                                        <div class="col-6 d-flex align-content-start float-start">
                                            
                                        </div>
                                        <div class="row col-lg-6 d-flex align-content-end text-end">
                                            <p style="font-size: 12px;">Sudah punya akun? <a class="link" href="{{ route('login') }}">&ensp; Login</a></p>
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

    <div class="container-fluid disclaimer-outer-bg bg-disclaimer ">

  <div class="container disclaimer-inner-bg fs-11">

    <h4 class="text-danger ff-a fs-16">Disclaimer:</h4>
    <div class="row ff-n" style="font-weight: normal;     text-align: justify; margin-right: 25px;">
      <p class="mt-2" style="margin-bottom: 8px;">Pembelian saham bisnis merupakan aktivitas beresiko tinggi. Anda berinvestasi pada bisnis yang mungkin saja mengalami kenaikan dan penurunan kinerja bahkan mengalami kegagalan. Harap menggunakan pertimbangan ekstra dalam membuat keputusan untuk membeli saham. Ada kemungkinan Anda tidak bisa menjual kembali saham bisnis dengan cepat. Lakukan diversifikasi investasi, hanya gunakan dana yang siap Anda lepaskan (affors to loose) dan atau disimpan dalam jangka panjang. Santara tidak memaksa pengguna untuk membeli saham bisnis sebagai investasi. Semua keputusan pembelian merupakan keputusan independen oleh pengguna.
      </p>
      <p style="margin-bottom: 8px;">
        Santara bertindak sebagai penyelenggara urun dana yang mempertemukan pemodal dan penerbit, bukan sebagai pihak yang menjalankan bisnis (Penerbit). Otoritas Jasa Keuangan bertindak sebagai regulator dan pemberi izin, bukan sebagai penjamin investasi. Keputusan pembelian saham, sepenuhnya merupakan hak dan tanggung jawab Pemodal (investor). Dengan membeli saham di Santara berarti Anda sudah menyetujui seluruh syarat dan ketentuan serta memahami semua risiko investasi termasuk resiko kehilangan sebagian atau seluruh modal.
      </p>
      <p style="margin-bottom: 8px;">
        “OTORITAS JASA KEUANGAN TIDAK MEMBERIKAN PERNYATAAN MENYETUJUI ATAU TIDAK MENYETUJUI EFEK INI, TIDAK JUGA MENYATAKAN KEBENARAN ATAU KECUKUPAN INFORMASI DALAM LAYANAN URUN DANA INI. SETIAP PERNYATAAN YANG BERTENTANGAN DENGAN HAL TERSEBUT ADALAH PERBUATAN MELANGGAR HUKUM.”
      </p>
      <p style="margin-bottom: 8px;">
        “INFORMASI DALAM LAYANAN URUN DANA INI PENTING DAN PERLU MENDAPAT PERHATIAN SEGERA. APABILA TERDAPAT KERAGUAN PADA TINDAKAN YANG AKAN DIAMBIL, SEBAIKNYA BERKONSULTASI DENGAN PENYELENGGARA.”
      </p>
      <p style="margin-bottom: 8px;">
        “PENERBIT DAN PENYELENGGARA, BAIK SENDIRI-SENDIRI MAUPUN BERSAMA-SAMA, BERTANGGUNG JAWAB SEPENUHNYA ATAS KEBENARAN SEMUA INFORMASI YANG TERCANTUM DALAM LAYANAN URUN DANA INI.”
      </p>
    </div>
  </div>

</div>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/new-santara/css/style.css?v=5.8.8') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/new-santara/css/login.css?v=5.8.8') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/new-santara/bootstrap/css/bootstrap.css') }}">
@endsection