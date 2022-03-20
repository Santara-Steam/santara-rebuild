@extends('front_end/template_front_end/app')

@section('content')

<!-- fashion section start -->
<div class="fashion_section" style="margin-top: 50px;margin-bottom: -200px">
    <div class="container">
        <div class="section-langkah-mudah">
            <div class="langkah-mudah-daftarkan-bisnis-anda inter-normal-alabaster-36px">
                <span class="text-urun inter-normal-alabaster">Silahkan Transfer Ke Rekening Di Bawah</span>
                <p>Order ID : #{{$trx->order_id}}</p>
            </div>
            {{-- <div class="content-1"> --}}
                <div class="row" style="margin-top: 40px">
                    <div class="col-md-3">
                        <div class="card text-white bg-danger mb-3 " style="padding: 20px;">
                            <div class="card-header" style="background-color: #af2a37;border-radius: 5px;">BCA</div>
                            <div class="card-body " style="padding: 20px 0px 10px 0px;">
                                <h2 class="c-margin-b-20" style="color: white;font-family: Arial, Helvetica, sans-serif;"> 12313-123123-12313123</h2>
                                <p class="card-text" style="margin: 0;">A.n. Santara Santara Santara</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-danger mb-3 " style="padding: 20px;">
                            <div class="card-header" style="background-color: #af2a37;border-radius: 5px;">BCA</div>
                            <div class="card-body " style="padding: 20px 0px 10px 0px;">
                                <h2 class="c-margin-b-20" style="color: white;font-family: Arial, Helvetica, sans-serif;"> 12313-123123-12313123</h2>
                                <p class="card-text" style="margin: 0;">A.n. Santara Santara Santara</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-danger mb-3 " style="padding: 20px;">
                            <div class="card-header" style="background-color: #af2a37;border-radius: 5px;">BCA</div>
                            <div class="card-body " style="padding: 20px 0px 10px 0px;">
                                <h2 class="c-margin-b-20" style="color: white;font-family: Arial, Helvetica, sans-serif;"> 12313-123123-12313123</h2>
                                <p class="card-text" style="margin: 0;">A.n. Santara Santara Santara</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-danger mb-3 " style="padding: 20px;">
                            <div class="card-header" style="background-color: #af2a37;border-radius: 5px;">BCA</div>
                            <div class="card-body " style="padding: 20px 0px 10px 0px;">
                                <h2 class="c-margin-b-20" style="color: white;font-family: Arial, Helvetica, sans-serif;"> 121234232-4324234234</h2>
                                <p class="card-text" style="margin: 0;" >A.n. Santara Santara Santara</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row  mb-4">

                    <div class="col-md-12 text-center" style="color: white">
                        Transfer Sebesar <strong>Rp{{ number_format($trx->total_amount,0,',','.') }}</strong> Ke Nomor Rekening Di Atas.
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <form  action="{{url('/upload_bukti_user')}}/{{$trx->id}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group"    style="margin-top: -50px;">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <label for="">Upload Bukti Transfer</label>
                                    </div>
                                    {{-- <div class="col-lg-4"></div> --}}
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">

                                        <input type="file" name="bukti_transfer" id="" class="form-control" required>
                                    </div>
                                    <div class="col-lg-4 text-center">
                                            <button type="submit" class="btn btn-danger btn-block">Send</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            {{-- </div> --}}
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

            <h4 class="text-danger ff-a fs-16"
                style="font-size: 16px; font-family: 'acumin-pro'; margin-left: 5px; margin-bottom: -2px">Disclaimer:
            </h4>
            <div class="row ff-n"
                style="font-weight: normal;     text-align: justify; margin-right: -15px; font-family: 'Nunito'; font-size: 11px;">
                <p class="mt-2" style="margin-bottom: -10px; color: #fff; font-size: 11px;line-height:1.5;">Pembelian
                    saham bisnis merupakan aktivitas beresiko tinggi. Anda berinvestasi pada bisnis yang mungkin saja
                    mengalami kenaikan dan penurunan kinerja bahkan mengalami kegagalan. Harap menggunakan pertimbangan
                    ekstra dalam membuat keputusan untuk membeli saham. Ada kemungkinan Anda tidak bisa menjual kembali
                    saham bisnis dengan cepat. Lakukan diversifikasi investasi, hanya gunakan dana yang siap Anda
                    lepaskan (affors to loose) dan atau disimpan dalam jangka panjang. Santara tidak memaksa pengguna
                    untuk membeli saham bisnis sebagai investasi. Semua keputusan pembelian merupakan keputusan
                    independen oleh pengguna.
                </p>
                <p style="margin-bottom: -10px; color: #fff; font-size: 11px;line-height:1.5; " ;>
                    Santara bertindak sebagai penyelenggara urun dana yang mempertemukan pemodal dan penerbit, bukan
                    sebagai pihak yang menjalankan bisnis (Penerbit). Otoritas Jasa Keuangan bertindak sebagai regulator
                    dan pemberi izin, bukan sebagai penjamin investasi. Keputusan pembelian saham, sepenuhnya merupakan
                    hak dan tanggung jawab Pemodal (investor). Dengan membeli saham di Santara berarti Anda sudah
                    menyetujui seluruh syarat dan ketentuan serta memahami semua risiko investasi termasuk resiko
                    kehilangan sebagian atau seluruh modal.
                </p>
                <p style="margin-bottom: -10px;color: #fff; font-size: 11px; line-height:1.5; ">
                    “OTORITAS JASA KEUANGAN TIDAK MEMBERIKAN PERNYATAAN MENYETUJUI ATAU TIDAK MENYETUJUI EFEK INI, TIDAK
                    JUGA MENYATAKAN KEBENARAN ATAU KECUKUPAN INFORMASI DALAM LAYANAN URUN DANA INI. SETIAP PERNYATAAN
                    YANG BERTENTANGAN DENGAN HAL TERSEBUT ADALAH PERBUATAN MELANGGAR HUKUM.”
                </p>
                <p style="margin-bottom: -10px;color: #fff; font-size: 11px;  line-height:1.5;">
                    “INFORMASI DALAM LAYANAN URUN DANA INI PENTING DAN PERLU MENDAPAT PERHATIAN SEGERA. APABILA TERDAPAT
                    KERAGUAN PADA TINDAKAN YANG AKAN DIAMBIL, SEBAIKNYA BERKONSULTASI DENGAN PENYELENGGARA.”
                </p>
                <p style="margin-bottom: -10px;color: #fff; font-size: 11px; line-height:1.5; ">
                    “PENERBIT DAN PENYELENGGARA, BAIK SENDIRI-SENDIRI MAUPUN BERSAMA-SAMA, BERTANGGUNG JAWAB SEPENUHNYA
                    ATAS KEBENARAN SEMUA INFORMASI YANG TERCANTUM DALAM LAYANAN URUN DANA INI.”
                </p>
            </div>
        </div>

    </div>
</div>
@endsection