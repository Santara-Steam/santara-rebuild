@extends('front_end/template_front_end/app')

@section('content')
@section('content')
    <link rel="stylesheet" href="https://use.typekit.net/juf5ftz.css">
    <link rel="stylesheet" type="text/css" href="https://santara.co.id/assets/new-santara/css/form-daftarkan-bisnis.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">

   <div class="container-fluid d-flex align-content-center justify-content-center bg-header-daftarkan-bisnis text-center">
        <div class="row col-12 col-md-9">
            <div class="col-12 align-self-end">
                <img src="https://santara.co.id/assets/new-santara/img/logo/logo_header.png" class="img-fluid" width="270px" alt="logo santara" />
            </div>
            <div class="col-12 mt-4 desc-header-daftarkan-bisnis">
                <p class="ff-p">
                    “Santara saat ini memiliki 300.000 investor terdaftar bernilai kurang lebih Rp 2 triliun
                </p>
                <p class="ff-p">
                    yang setiap saat siap menanti usaha Anda yang akan jadi penerbit mencari dana di Santara”
                </p>
            </div>
        </div>
    </div>
        <div class="container mt-5">
        <div class="row d-flex align-content-center justify-content-center ">
            <div class="col-8 col-md-6 col-lg-4 text-center">
                <h1 class="ff-p c-gold judul-register-coming-soon">Registrasi Coming Soon</h1>
            </div>
        </div>
        <form class="ff-m" action="{{route('daftar-bisnis.store')}}" method="POST" enctype="multipart/form-data">
        	{{ csrf_field() }}
            <div class="row d-flex justify-content-center" style="border-top: #4A585A solid;">
            	{{-- <div class="form-group">
                    <label for="projectinput6">Owner</label>
                    <select id="projectinput6" name="budget" class="form-control">
                        <option value="0" selected="" disabled="" hidden>-- Pilih Owner --
                                                    </option>
                        <option value="1">Bagas</option>

                    </select>
                </div> --}}
                <div class="col-12 col-xl-6 mt-5">
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Nama Perusahaan</label>
                        <input type="text" id="companyName" name="company_name" class="form-control" placeholder="Isi Nama Perusahaan">
                    </div>

                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Logo Perusahaan</label>
                        <div class="custom-file">
                                                    <input type="file" name="logo" class="custom-file-input" id="inputGroupFile02">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFile02">Choose file</label>
                                                </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Foto Cover Profile Perusahaan</label>
                        <div class="custom-file">
                                                    <input type="file" name="cover" class="custom-file-input" id="inputGroupFile02">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFile02">Choose file</label>
                                                </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Galeri Foto Produk/Tempat Usaha</label>
                        <div class="custom-file">
                                                    <input type="file" name="galeri" class="custom-file-input" id="inputGroupFile02">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFile02">Choose file</label>
                                                </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Nama Owner</label>
                        <input type="text" class="form-control" name="nama_owner" placeholder="Isi Nama Owner">
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Foto Owner</label>
                        <div class="custom-file">
                                                    <input type="file" name="owner" class="custom-file-input" id="inputGroupFile02">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFile02">Choose file</label>
                                                </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Kategori Bisnis</label>
                        <select id="projectinput6" name="kategori" class="form-control">
                                                    <option value="0" selected="" disabled="" hidden>-- Pilih Kategori
                                                        --</option>
                                                    @foreach ($kategori as $item)
                                                    <option value="{{$item->id}}">{{$item->category}}</option>
                                                        
                                                    @endforeach
                                                </select>
                    </div>
                    <p class="mt-3">*Omzet 2 Tahun Sebelumnya 2021 dan 2022</p>
                    <div class="form-group mt-2">
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label" style="font-weight: 700;">*Tahun 2021</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1" style="background-color:#D5E1E6">Rp</span>
                                    <input type="text" class="form-control format-number format-number number-only" id="amount" name="omset1" placeholder="0" style="background-color:#fff" aria-label="" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label" style="font-weight: 700;">*Tahun 2022 (Berjalan)</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1" style="background-color:#D5E1E6">Rp</span>
                                    <input type="text" class="form-control format-number number-only" name="omset2" placeholder="0" style="background-color:#fff" aria-label="" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Perkiraan Dana Yang di Butuhkan </label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="text" class="form-control format-number number-only" name="perkiraan_dana" placeholder="0" aria-label="dana_dibutuhkan" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Perkiraan Saham yang di Lepas ke Umum</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control format-number number-only" placeholder="0" name="saham_dilepas" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Perkiraan Omzet Setelah Jadi Penerbit</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="text" class="form-control format-number number-only " placeholder="0" name="omset_penerbit" aria-label="omzet_jadi_penerbit" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Perkiraan Deviden Tahunan</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control format-number number-only " placeholder="0" name="deviden_tahunan" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text " id="basic-addon2">%</span>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">Video Profile Perusahaan</label>
                        <input type="text" class="form-control username" name="video_profile" placeholder="https://www.youtube.com/watch?v=DSO7qWAbqjg">
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">Alamat Website</label>
                        <input type="text" class="form-control username" name="web" placeholder="https://santara.co.id/">
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">Facebook</label>
                        <input type="text" class="form-control username" name="fb" placeholder="Isi Username Facebook">
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">Instagram</label>
                        <input type="text" class="form-control username" name="ig" placeholder="Isi Username Instagram">
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Isi Caption Biografi Owner atau Deskripsi Usaha</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="deskripsi" placeholder="Isi Caption dan Biografi" rows="3"></textarea>
                    </div>

                    <div class="col-12 fs-10 ff-m mt-3">
                        <p>Syarat dan Ketentuan :</p>
                        <ul>
                            <li>
                                Usaha sudah harus berbentuk PT/Perseroan terbatas (Sesuai peraturan OJK No.57 Tahun 2020)
                            </li>
                            <li>
                                Memiliki Track Record Perusahaan yang baik dan Omset yang relatif stabil
                            </li>
                            <li>
                                Siap menjalankan Tata Kelola Perusahaan yang baik (Good Corporate Governance)
                            </li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12  d-flex justify-content-center align-item-center">
                        <a href="/daftar-bisnis" class="btn btn-danger m-3" style="width: 300px; background-color:white; color:#BF2D30;font-weight:700">cancel</a>
                        <button class="btn btn-danger m-3" type="submit" id="asd" style="width: 300px;font-weight:700">daftar</button>
                    </div>
                </div>
            </div>
        </form>
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
<script src="{{asset('public/admin')}}/app-assets/js/scripts/forms/custom-file-input.js"></script>

@endsection