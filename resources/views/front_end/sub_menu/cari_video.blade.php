@extends('front_end/template_front_end/app')

@section('content')
    <link rel="canonical" href="https://old.santara.co.id/supported-by">
    <link rel="apple-touch-icon" href="https://storage.googleapis.com/asset-santara/old.santara.co.id/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="https://storage.googleapis.com/asset-santara/old.santara.co.id/images/ico/favicon.ico">
    <link rel="stylesheet" href="https://use.typekit.net/juf5ftz.css">
    
    <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/app-assets/new-santara/bootstrap/css/bootstrap.css">
    <style>
        .menu-view-body .navbar-nav{
            padding: 0px 0px;
            margin-left: 0px;
        }
    </style>
    <main>
        <div style="padding-top: 140px;">
            <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/assets/new-santara/css/new-cara-investasi.css?v=5.8.8">
<link rel="stylesheet" type="text/css" href="https://old.santara.co.id/assets/new-santara/css/style-2.css?v=5.8.8">

                          <div class="container">
                          <div class="form-row">
                          <div class="form-group col-md-1 kati">
                          </div>
                          <div class="form-group col-md-3" style="margin-bottom: -30px;">
                            <div class="label-1 inter-medium-quill-gray-14px">
                                      <span class="inter-medium-quill-gray-14px">Kategori</span>
                                    </div>
                            <form role="form" method="get" action="{{ route('video.filter') }}" id="form_id">
                            @csrf
                                <select  name="categor" class="form-control dropdown-1" onChange=" document.getElementById('form_id').submit();">
                                  <option value="">Semua Kategori</option>
                                        @foreach ($cat as $cate)
                                        <option <?php if ($cate->id == $fil_cat) {
                                                            echo 'selected'; } ?>
                                                            value="{{$cate->id}}">{{$cate->category}}</option>
                                        @endforeach
                                </select>
                            </form>
                              </div>
                            </div>

<div class="container">
	<div class="row cont-step">
    @foreach ($santaraVideos as $row)
		<div class="row" style="margin-top:50px;">
			<div class="col-md-6" style="margin-top:30px;">
				<div>
					<span class="fs-24 bold">{{ \Illuminate\Support\Str::limit($row->title, $limit =
                                                    150, $end = ' ...') }}</span>
				</div><br>
				<div style="width: 100%;">
					<span class="fs-16">{{ \Illuminate\Support\Str::limit($row->description, $limit
                                                    = 250, $end = ' ...') }}</span>
				</div>
			</div>
			<div class="col-md-6 text-right">
            @if ($row->link == null)

            @else
            <?php
            $kode_yt = str_replace('https://youtu.be/','',$row->link);
            ?> 
            <!-- Copy & Pasted from YouTube -->
            <iframe class="youtube step-inves" src="https://www.youtube.com/embed/{{$kode_yt}}" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            
            @endif
            
			</div>
		</div>
	@endforeach
    
	</div>
</div>
<div class="d-flex" style="margin-top:50px;">
    <div class="mx-auto">
    {{ $santaraVideos->links('pagination::bootstrap-4') }}
    
    </div>
</div>
  
    </main>




    <footer class="footer-static footer-light navbar-shadow" style="margin-top:50px;">
        <!-- <div class="container-fluid p-5 ff-m">
    <div class="row kontak-align">
        <div class="col-md-2 d-flex justify-content-center">
            <img src="https://old.santara.co.id/assets/new-santara/img/logo/santara-white.svg" alt="logo santara" />
        </div>
        <div class="col-md-2 ff-m mt-kontak">
            <p class="fs-16 c-red">Cara Kerja</p>
            <p><a href="https://old.santara.co.id/cara-investasi" class="fs-12 c-white" style="text-decoration:none">Cara Investasi</a></p>
        </div>
        <div class="col-md-2 ff-m ">
            <p class="fs-16 c-red">Tentang Kami</p>
            <p><a href="http://berita.santara.co.id" target="_blank" class="fs-12 c-white" style="text-decoration:none">Berita</a></p>
            <p><a href="https://old.santara.co.id/career" target="_blank" class="fs-12 c-white" style="text-decoration:none">Karir</a></p>
        </div>
        <div class="col-md-2 ff-m ">
            <p class="fs-16 c-red">Support</p>
            <p><a href="https://old.santara.co.id/syarat-ketentuan-pemodal" class="fs-12 c-white" style="text-decoration:none">Syarat dan Ketentuan Pemodal</a></p>
            <p><a href="https://old.santara.co.id/syarat-ketentuan-penerbit" class="fs-12 c-white" style="text-decoration:none">Syarat dan Ketentuan Penerbit</a></p>
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
                <a href="https://old.santara.co.id/android"><img src="https://old.santara.co.id/assets/new-santara/img/android-ios/play-store.svg" alt="playstore" /></a>
            </div>
            <div class="col-12 mt-3">
                <a href="https://old.santara.co.id/ios"><img src="https://old.santara.co.id/assets/new-santara/img/android-ios/app-store.svg" alt="appstore" /></a>
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