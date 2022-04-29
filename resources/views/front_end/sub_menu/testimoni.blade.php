@extends('front_end/template_front_end/app')

@section('content')
<link rel="canonical" href="https://santara.co.id/testimoni">
    <link rel="apple-touch-icon" href="https://storage.googleapis.com/asset-santara/santara.co.id/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="https://storage.googleapis.com/asset-santara/santara.co.id/images/ico/favicon.ico">
    <link rel="stylesheet" href="https://use.typekit.net/juf5ftz.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://santara.co.id/assets/new-santara/css/carousel-list.css?v=5.8.8">
 <link rel="stylesheet" type="text/css" href="https://santara.co.id/assets/new-santara/css/testimoni.css?v=5.8.8">

 <div class="container d-flex justify-content-evenly mt-5">
     <div class="container text-center d-flex justify-content-center" style="border-top: solid #4A585A; margin-top: 90px;">
         <h1 class="ff-m fs-24 font-header c-gold" style="width: 250px; font-weight: 800;
    text-transform: uppercase;
    margin-top: -15px;
    padding: 0px 50px;
    background-color: #1A1A1A;">testimoni</h1>
     </div>
 </div>
 <div class="container-testimoni">
     <div id="myCarousel" class="carousel slide d-flex justify-content-center" data-ride="carousel">
         <div class="carousel-inner">
         @foreach($successStories as $key => $row)
                <div class="carousel-item <?= ($key == 0) ? 'active' : '' ?>" style="padding-top: 30px;">
                     <div class="d-flex justify-content-center">
                         <div class="row-carousel">
                             <div style=" margin-top: 45px;">
                                 <div class="row body-carousel">
                                     <img class="img-kutip" src="https://santara.co.id/assets/new-santara/img/kutip.svg">
                                     <div style="display: flex; align-items: center; border-radius: 1rem;" class="bg-app">
                                         <div style="padding: 3rem; text-align: center; padding-bottom:30px;">
                                             <img class="rounded-circle" height="130px" width="130px" src="{{ config('global.STORAGE_GOOGLE').'success_story/'.$row->image }}" width="100%" style="margin-bottom: 1rem;position:absolute;top:0px;margin-left:-4rem;border: solid #707070; height:130px;">
                                             <p class="title-md" style="margin: 0px;margin-top:0px; color: #fff;">{{ $row->title }}</p>
                                             <p class="text-light-bg" style="color: #96DAF0;">{{ $row->subtitle }}</p>
                                             <p class="text-light-bg" style="line-height: 1.8; color: #fff;">{{ $row->description }}</p>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
            @endforeach
                      </div>
         <a class="carousel-control-prev bt-carousel" href="#myCarousel" data-slide="prev">
             <i class="fas fa-chevron-circle-left" style="color:red"></i>
         </a>
         <a class="carousel-control-next  bt-carousel" href="#myCarousel" data-slide="next">
             <i class="fas fa-chevron-circle-right" style="color:red;width:40px"></i>
         </a>
     </div>
 </div>        </div>
    </main>


    <footer class="footer-static footer-light navbar-shadow">
        <!-- <div class="container-fluid p-5 ff-m">
    <div class="row kontak-align">
        <div class="col-md-2 d-flex justify-content-center">
            <img src="https://santara.co.id/assets/new-santara/img/logo/santara-white.svg" alt="logo santara" />
        </div>
        <div class="col-md-2 ff-m mt-kontak">
            <p class="fs-16 c-red">Cara Kerja</p>
            <p><a href="https://santara.co.id/cara-investasi" class="fs-12 c-white" style="text-decoration:none">Cara Investasi</a></p>
        </div>
        <div class="col-md-2 ff-m ">
            <p class="fs-16 c-red">Tentang Kami</p>
            <p><a href="http://berita.santara.co.id" target="_blank" class="fs-12 c-white" style="text-decoration:none">Berita</a></p>
            <p><a href="https://santara.co.id/career" target="_blank" class="fs-12 c-white" style="text-decoration:none">Karir</a></p>
        </div>
        <div class="col-md-2 ff-m ">
            <p class="fs-16 c-red">Support</p>
            <p><a href="https://santara.co.id/syarat-ketentuan-pemodal" class="fs-12 c-white" style="text-decoration:none">Syarat dan Ketentuan Pemodal</a></p>
            <p><a href="https://santara.co.id/syarat-ketentuan-penerbit" class="fs-12 c-white" style="text-decoration:none">Syarat dan Ketentuan Penerbit</a></p>
        </div>
        <div class="col-md-2 ff-m ">
            <div class="col-12">
                <p class="fs-16 c-red">Tentang Kami</p>
                <p class="fs-12">PT. Santara Daya Inspiratama</p>
                <p class="fs-12">Jl. Pasir No 35, Patukan, Gamping, Sleman Yogyakarta 55293</p>
            </div>
            <div class="row fs-12">
                <div class="col-12">
                    <p>Telepon:
                        <span class="c-red">(0274)2822744</span>
                    </p>
                </div>
                <div class="col-12">
                    <p>Email: <span class="c-red"><a href="mailto:customer.support@santara.co.id" style="text-decoration: none;" class="c-red">customer.support@santara.co.id</a></span></p>
                </div>
                <div class="col-12">
                    <p>WhatsApp: <span class="c-red"><a href="https://api.whatsapp.com/send?phone=6281212227765&text=Halo%2C%20apakah%20ada%20informasi%20terbaru%20tentang%20Santara%3F" class="c-red" style="text-decoration: none;">+6281212227765</a></span></p>
                </div>
            </div>
        </div>
        <div class="col-md-2 ff-m">
            <div class="col-12 fs-16 c-red mt-kontak">Download</div>
            <div class="col-12 mt-3">
                <a href="https://santara.co.id/android"><img src="https://santara.co.id/assets/new-santara/img/android-ios/play-store.svg" alt="playstore" /></a>
            </div>
            <div class="col-12 mt-3">
                <a href="https://santara.co.id/ios"><img src="https://santara.co.id/assets/new-santara/img/android-ios/app-store.svg" alt="appstore" /></a>
            </div>
        </div>

    </div>
</div> -->
        
<div class="container-fluid disclaimer-outer-bg bg-disclaimer ">

  <div class="container disclaimer-inner-bg fs-11">

    <h4 class="text-danger ff-a fs-16">Disclaimer:</h4>
    <div class="row ff-n" style="font-weight: normal;     text-align: justify;">
      <p class="mt-2" style="margin-bottom: 8px; color: #fff;">Pembelian saham bisnis merupakan aktivitas beresiko tinggi. Anda berinvestasi pada bisnis yang mungkin saja mengalami kenaikan dan penurunan kinerja bahkan mengalami kegagalan. Harap menggunakan pertimbangan ekstra dalam membuat keputusan untuk membeli saham. Ada kemungkinan Anda tidak bisa menjual kembali saham bisnis dengan cepat. Lakukan diversifikasi investasi, hanya gunakan dana yang siap Anda lepaskan (affors to loose) dan atau disimpan dalam jangka panjang. Santara tidak memaksa pengguna untuk membeli saham bisnis sebagai investasi. Semua keputusan pembelian merupakan keputusan independen oleh pengguna.
      </p>
      <p style="margin-bottom: 8px; color: #fff;">
        Santara bertindak sebagai penyelenggara urun dana yang mempertemukan pemodal dan penerbit, bukan sebagai pihak yang menjalankan bisnis (Penerbit). Otoritas Jasa Keuangan bertindak sebagai regulator dan pemberi izin, bukan sebagai penjamin investasi. Keputusan pembelian saham, sepenuhnya merupakan hak dan tanggung jawab Pemodal (investor). Dengan membeli saham di Santara berarti Anda sudah menyetujui seluruh syarat dan ketentuan serta memahami semua risiko investasi termasuk resiko kehilangan sebagian atau seluruh modal.
      </p>
      <p style="margin-bottom: 8px; color: #fff;">
        “OTORITAS JASA KEUANGAN TIDAK MEMBERIKAN PERNYATAAN MENYETUJUI ATAU TIDAK MENYETUJUI EFEK INI, TIDAK JUGA MENYATAKAN KEBENARAN ATAU KECUKUPAN INFORMASI DALAM LAYANAN URUN DANA INI. SETIAP PERNYATAAN YANG BERTENTANGAN DENGAN HAL TERSEBUT ADALAH PERBUATAN MELANGGAR HUKUM.”
      </p>
      <p style="margin-bottom: 8px; color: #fff;">
        “INFORMASI DALAM LAYANAN URUN DANA INI PENTING DAN PERLU MENDAPAT PERHATIAN SEGERA. APABILA TERDAPAT KERAGUAN PADA TINDAKAN YANG AKAN DIAMBIL, SEBAIKNYA BERKONSULTASI DENGAN PENYELENGGARA.”
      </p>
      <p style="margin-bottom: 8px; color: #fff;">
        “PENERBIT DAN PENYELENGGARA, BAIK SENDIRI-SENDIRI MAUPUN BERSAMA-SAMA, BERTANGGUNG JAWAB SEPENUHNYA ATAS KEBENARAN SEMUA INFORMASI YANG TERCANTUM DALAM LAYANAN URUN DANA INI.”
      </p>
    </div>
  </div>

</div>
@endsection