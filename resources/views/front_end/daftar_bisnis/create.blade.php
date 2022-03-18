@extends('front_end/template_front_end/app')

@section('content')
<link rel="stylesheet" href="https://use.typekit.net/juf5ftz.css">
<link rel="stylesheet" type="text/css" href="https://santara.co.id/assets/new-santara/css/form-daftarkan-bisnis.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    crossorigin="anonymous">

<div class="container-fluid d-flex align-content-center justify-content-center bg-header-daftarkan-bisnis text-center">
    <div class="row col-12 col-md-9">
        <div class="col-12 align-self-end">
            <img src="https://santara.co.id/assets/new-santara/img/logo/logo_header.png" class="img-fluid" width="270px"
                alt="logo santara" />
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
            <div class="col-12 col-xl-10 mt-5">
                <div class="form-group mt-2">
                    <label for="exampleFormControlInput1" class="form-label">*Nama Perusahaan</label>
                    <input type="text" id="companyName" name="company_name" class="form-control"
                        placeholder="Isi Nama Perusahaan">
                </div>
                <fieldset class="form-group row">
                    <div class="col-2 text-center">
                        <label for="companyName">Logo Usaha</label>
                        <div class="image_area text-center">
                            <label for="upload_image">
                                <img src="{{asset('public')}}/default1.png" id="uploaded_image"
                                    class="img-responsive" />
                                <div class="overlay">
                                    <div class="text">Logo <br> Perusahaan</div>
                                </div>
                            </label>
                            <input type="file" name="image" class="image" id="upload_image"
                                style="display: none" />
                            <input type="text" hidden name="logo" class="image"
                                id="logo" />
                        </div>
                    </div>
                    <div class="col-7 text-center">
                        <label for="companyName">Cover Profile</label>
                        <div class="image_area text-center">
                            <label for="upload_image2">
                                <img src="{{asset('public')}}/default2.png" id="uploaded_image2"
                                    class="img-responsive" />
                                <div class="overlay">
                                    <div class="text">Cover Profile</div>
                                </div>
                            </label>
                            <input type="file" name="image2" class="image" id="upload_image2"
                                style="display: none" />
                            <input type="text" hidden name="cover" class="image"
                                id="cover" />
                        </div>
                    </div>
                    <div class="col-3 text-center">
                        <label for="companyName">Foto Owner</label>
                        <div class="image_area text-center">
                            <label for="upload_image4">
                                <img src="{{asset('public')}}/default1.png" id="uploaded_image4"
                                    class="img-responsive" />
                                <div class="overlay">
                                    <div class="text">Foto Owner</div>
                                </div>
                            </label>
                            <input type="file" name="image4" class="image" id="upload_image4"
                                style="display: none" />
                            <input type="text" hidden name="owner" class="image"
                                id="owner" />
                        </div>
                    </div>
                </fieldset>
                <div class="form-group row">

                    <div class="col-4">
                        <label for="companyName">Galeri Foto/Tempat Usaha</label>
                        <div class="image_area text-center">
                            <label for="upload_image3">
                                <img src="{{asset('public')}}/default.png" id="uploaded_image3"
                                    class="img-responsive" />
                                <div class="overlay">
                                    <div class="text">Galeri Foto/Tempat Usaha</div>
                                </div>
                            </label>
                            <input type="file" name="image3" class="image" id="upload_image3"
                                style="display: none" />
                            <input type="text" hidden name="galeri" class="image"
                                id="galeri" />
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="companyName">Galeri Foto/Tempat Usaha 2</label>
                        <div class="image_area text-center">
                            <label for="upload_image5">
                                <img src="{{asset('public')}}/default.png" id="uploaded_image5"
                                    class="img-responsive" />
                                <div class="overlay">
                                    <div class="text">Galeri Foto/Tempat Usaha 2</div>
                                </div>
                            </label>
                            <input type="file" name="image5" class="image" id="upload_image5"
                                style="display: none" />
                            <input type="text" hidden name="galeri2" class="image"
                                id="galeri2" />
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="companyName">Galeri Foto/Tempat Usaha 3</label>
                        <div class="image_area text-center">
                            <label for="upload_image6">
                                <img src="{{asset('public')}}/default.png" id="uploaded_image6"
                                    class="img-responsive" />
                                <div class="overlay">
                                    <div class="text">Galeri Foto/Tempat Usaha 3</div>
                                </div>
                            </label>
                            <input type="file" name="image6" class="image" id="upload_image6"
                                style="display: none" />
                            <input type="text" hidden name="galeri3" class="image"
                                id="galeri3" />
                        </div>
                    </div>
                </div>
                

                
                
                <div class="form-group mt-2">
                    <label for="exampleFormControlInput1" class="form-label">*Nama Owner</label>
                    <input type="text" class="form-control" name="nama_owner" placeholder="Isi Nama Owner">
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
                        <label for="inputPassword" class="col-sm-3 col-form-label" style="font-weight: 700;">*Tahun
                            2021</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"
                                    style="background-color:#D5E1E6">Rp</span>
                                <input type="text" class="form-control format-number format-number number-only"
                                    id="amount" name="omset1" placeholder="0" style="background-color:#fff"
                                    aria-label="" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label" style="font-weight: 700;">*Tahun 2022 (Berjalan)</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"
                                    style="background-color:#D5E1E6">Rp</span>
                                <input type="text" class="form-control format-number number-only" name="omset2"
                                    placeholder="0" style="background-color:#fff" aria-label=""
                                    aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label for="exampleFormControlInput1" class="form-label">*Perkiraan Dana Yang di Butuhkan </label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Rp</span>
                        <input type="text" class="form-control format-number number-only" name="perkiraan_dana"
                            placeholder="0" aria-label="dana_dibutuhkan" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label for="exampleFormControlInput1" class="form-label">*Perkiraan Saham yang di Lepas ke
                        Umum</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control format-number number-only" placeholder="0"
                            name="saham_dilepas" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <span class="input-group-text" id="basic-addon2">%</span>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label for="exampleFormControlInput1" class="form-label">*Perkiraan Omzet Setelah Jadi
                        Penerbit</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Rp</span>
                        <input type="text" class="form-control format-number number-only " placeholder="0"
                            name="omset_penerbit" aria-label="omzet_jadi_penerbit" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label for="exampleFormControlInput1" class="form-label">*Perkiraan Deviden Tahunan</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control format-number number-only " placeholder="0"
                            name="deviden_tahunan" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <span class="input-group-text " id="basic-addon2">%</span>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label for="exampleFormControlInput1" class="form-label">Video Profile Perusahaan</label>
                    <input type="text" class="form-control username" name="video_profile"
                        placeholder="https://www.youtube.com/watch?v=DSO7qWAbqjg">
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
                    <label for="exampleFormControlInput1" class="form-label">*Isi Caption Biografi Owner atau Deskripsi
                        Usaha</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="deskripsi"
                        placeholder="Isi Caption dan Biografi" rows="3"></textarea>
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
                    <a href="/daftar-bisnis" class="btn btn-danger m-3"
                        style="width: 300px; background-color:white; color:#BF2D30;font-weight:700">cancel</a>
                    <button class="btn btn-danger m-3" type="submit" id="asd"
                        style="width: 300px;font-weight:700">daftar</button>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="container-fluid disclaimer-outer-bg bg-disclaimer ">

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
{{--
<link rel="stylesheet" href="style.css" /> --}}
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">


    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Logo Perusahaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container" style="padding: 30px" >
                    <div class="row" >
                        {{-- <div class="col-md-8"> --}}
                            <img src="" id="sample_image" />
                        {{-- </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="crop" class="btn btn-primary">Crop</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">


    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Cover Profile Perusahaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container" style="padding: 30px">
                    <div class="row">
                        {{-- <div class="col-md-8"> --}}
                            <img src="" id="sample_image2" />
                        {{-- </div>
                        <div class="col-md-4">
                            <div class="preview2"></div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="crop2" class="btn btn-primary">Crop</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">


    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Foto Owner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container" style="padding: 30px">
                    <div class="row">
                        {{-- <div class="col-md-8"> --}}
                            <img src="" id="sample_image4" />
                        {{-- </div>
                        <div class="col-md-4">
                            <div class="preview3"></div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="crop4" class="btn btn-primary">Crop</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">


    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Galeri Foto/Tempat Usaha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container" style="padding: 30px">
                    <div class="row">
                        {{-- <div class="col-md-8"> --}}
                            <img src="" id="sample_image3" />
                        {{-- </div>
                        <div class="col-md-4">
                            <div class="preview3"></div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="crop3" class="btn btn-primary">Crop</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="modal5" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">


    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Galeri Foto/Tempat Usaha 2</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container" style="padding: 30px">
                    <div class="row">
                        {{-- <div class="col-md-8"> --}}
                            <img src="" id="sample_image5" />
                        {{-- </div>
                        <div class="col-md-4">
                            <div class="preview3"></div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="crop5" class="btn btn-primary">Crop</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="modal6" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">


    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Galeri Foto/Tempat Usaha 3</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container" style="padding: 30px">
                    <div class="row">
                        {{-- <div class="col-md-8"> --}}
                            <img src="" id="sample_image6" />
                        {{-- </div>
                        <div class="col-md-4">
                            <div class="preview3"></div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="crop6" class="btn btn-primary">Crop</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>

</div>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> --}}
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('public/new-santara/css/style.css?v=5.8.8') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/new-santara/css/login.css?v=5.8.8') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/new-santara/bootstrap/css/bootstrap.css') }}">

@endsection
@section('js')
{{-- <script src="{{asset('public')}}/cropImage.js"></script> --}}
<script>
    
    $(document).ready(function(){

var $modal = $('#modal');

var image = document.getElementById('sample_image');

var cropper;

$('#upload_image').change(function(event){
    var files = event.target.files;

    var done = function(url){
        image.src = url;
        $modal.modal('show');
    };

    if(files && files.length > 0)
    {
        reader = new FileReader();
        reader.onload = function(event)
        {
            done(reader.result);
        };
        reader.readAsDataURL(files[0]);
    }
});

$modal.on('shown.bs.modal', function() {
    cropper = new Cropper(image, {
        aspectRatio: 4/4,
        viewMode: 3,
        preview:'.preview'
    });
}).on('hidden.bs.modal', function(){
    cropper.destroy();
       cropper = null;
});

$('#crop').click(function(){
    canvas = cropper.getCroppedCanvas({
        width:250,
        height:250
    });

    canvas.toBlob(function(blob){
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function(){
          
            var base64data = reader.result;
            // var fileSelect = $(this).val();
            $.ajax({
                url:'{{route("logocropImg")}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method:'POST',
                data:{image:base64data},
                success:function(data)
                {
                    // let text = text.replace("public/upload/", "");
                    $modal.modal('hide');
                    $('#uploaded_image').attr('src', '{{env("PATH_WEB")}}'+data);
                    // $('#upload_image').val(data);
                    $('#logo').val(data);
                    // $('#upload_image').attr('src', data);
                    // console.log(base64data);
                    // console.log(base64data);
                    // console.log(data);
                }
            });
        };
    });
});








var $modal2 = $('#modal2');

var image2 = document.getElementById('sample_image2');

$('#upload_image2').change(function(event){
    var files = event.target.files;

    var done = function(url){
        image2.src = url;
        $modal2.modal('show');
    };

    if(files && files.length > 0)
    {
        reader = new FileReader();
        reader.onload = function(event)
        {
            done(reader.result);
        };
        reader.readAsDataURL(files[0]);
    }
});

$modal2.on('shown.bs.modal', function() {
    cropper = new Cropper(image2, {
        aspectRatio: 2,
        viewMode: 3,
        preview:'.preview2'
    });
}).on('hidden.bs.modal', function(){
    cropper.destroy();
       cropper = null;
});

$('#crop2').click(function(){
    canvas = cropper.getCroppedCanvas({
        width: 1366,
        height: 497
    });

    canvas.toBlob(function(blob){
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function(){
          
            var base64data = reader.result;
            // var fileSelect = $(this).val();
            $.ajax({
                url:'{{route("covercropImg")}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method:'POST',
                data:{image:base64data},
                success:function(data)
                {
                    // let text = text.replace("public/upload/", "");
                    $modal2.modal('hide');
                    $('#uploaded_image2').attr('src', '{{env("PATH_WEB")}}'+data);
                    // $('#upload_image').val(data);
                    $('#cover').val(data);
                    // $('#upload_image').attr('src', data);
                    // console.log(base64data);
                    // console.log(base64data);
                    // console.log(data);
                }
            });
        };
    });
});



var $modal3 = $('#modal3');

var image3 = document.getElementById('sample_image3');

$('#upload_image3').change(function(event){
    var files = event.target.files;

    var done = function(url){
        image3.src = url;
        $modal3.modal('show');
    };

    if(files && files.length > 0)
    {
        reader = new FileReader();
        reader.onload = function(event)
        {
            done(reader.result);
        };
        reader.readAsDataURL(files[0]);
    }
});

$modal3.on('shown.bs.modal', function() {
    cropper = new Cropper(image3, {
        aspectRatio: 4/3,
        viewMode: 3,
        preview:'.preview3'
    });
}).on('hidden.bs.modal', function(){
    cropper.destroy();
       cropper = null;
});

$('#crop3').click(function(){
    canvas = cropper.getCroppedCanvas({
        width:400,
        height:300
    });

    canvas.toBlob(function(blob){
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function(){
          
            var base64data = reader.result;
            // var fileSelect = $(this).val();
            $.ajax({
                url:'{{route("galericropImg")}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method:'POST',
                data:{image:base64data},
                success:function(data)
                {
                    // let text = text.replace("public/upload/", "");
                    $modal3.modal('hide');
                    $('#uploaded_image3').attr('src', '{{env("PATH_WEB")}}'+data);
                    // $('#upload_image').val(data);
                    $('#galeri').val(data);
                    // $('#upload_image').attr('src', data);
                    // console.log(base64data);
                    // console.log(base64data);
                    // console.log(data);
                }
            });
        };
    });
});





var $modal4 = $('#modal4');

var image4 = document.getElementById('sample_image4');

$('#upload_image4').change(function(event){
    var files = event.target.files;

    var done = function(url){
        image4.src = url;
        $modal4.modal('show');
    };

    if(files && files.length > 0)
    {
        reader = new FileReader();
        reader.onload = function(event)
        {
            done(reader.result);
        };
        reader.readAsDataURL(files[0]);
    }
});

$modal4.on('shown.bs.modal', function() {
    cropper = new Cropper(image4, {
        aspectRatio: 4/4,
        viewMode: 3,
        preview:'.preview4'
    });
}).on('hidden.bs.modal', function(){
    cropper.destroy();
       cropper = null;
});

$('#crop4').click(function(){
    canvas = cropper.getCroppedCanvas({
        width:400,
        height:400
    });

    canvas.toBlob(function(blob){
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function(){
          
            var base64data = reader.result;
            // var fileSelect = $(this).val();
            $.ajax({
                url:'{{route("ownercropImg")}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method:'POST',
                data:{image:base64data},
                success:function(data)
                {
                    // let text = text.replace("public/upload/", "");
                    $modal4.modal('hide');
                    $('#uploaded_image4').attr('src', '{{env("PATH_WEB")}}'+data);
                    // $('#upload_image').val(data);
                    $('#owner').val(data);
                    // $('#upload_image').attr('src', data);
                    // console.log(base64data);
                    // console.log(base64data);
                    // console.log(data);
                }
            });
        };
    });
});




var $modal5 = $('#modal5');

var image5 = document.getElementById('sample_image5');

$('#upload_image5').change(function(event){
    var files = event.target.files;

    var done = function(url){
        image5.src = url;
        $modal5.modal('show');
    };

    if(files && files.length > 0)
    {
        reader = new FileReader();
        reader.onload = function(event)
        {
            done(reader.result);
        };
        reader.readAsDataURL(files[0]);
    }
});

$modal5.on('shown.bs.modal', function() {
    cropper = new Cropper(image5, {
        aspectRatio: 4/3,
        viewMode: 3,
        preview:'.preview3'
    });
}).on('hidden.bs.modal', function(){
    cropper.destroy();
       cropper = null;
});

$('#crop5').click(function(){
    canvas = cropper.getCroppedCanvas({
        width:400,
        height:300
    });

    canvas.toBlob(function(blob){
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function(){
          
            var base64data = reader.result;
            // var fileSelect = $(this).val();
            $.ajax({
                url:'{{route("galericropImg")}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method:'POST',
                data:{image:base64data},
                success:function(data)
                {
                    // let text = text.replace("public/upload/", "");
                    $modal5.modal('hide');
                    $('#uploaded_image5').attr('src', '{{env("PATH_WEB")}}'+data);
                    // $('#upload_image').val(data);
                    $('#galeri2').val(data);
                    // $('#upload_image').attr('src', data);
                    // console.log(base64data);
                    // console.log(base64data);
                    // console.log(data);
                }
            });
        };
    });
});




var $modal6 = $('#modal6');

var image6 = document.getElementById('sample_image6');

$('#upload_image6').change(function(event){
    var files = event.target.files;

    var done = function(url){
        image6.src = url;
        $modal6.modal('show');
    };

    if(files && files.length > 0)
    {
        reader = new FileReader();
        reader.onload = function(event)
        {
            done(reader.result);
        };
        reader.readAsDataURL(files[0]);
    }
});

$modal6.on('shown.bs.modal', function() {
    cropper = new Cropper(image6, {
        aspectRatio: 4/3,
        viewMode: 3,
        preview:'.preview3'
    });
}).on('hidden.bs.modal', function(){
    cropper.destroy();
       cropper = null;
});

$('#crop6').click(function(){
    canvas = cropper.getCroppedCanvas({
        width:400,
        height:300
    });

    canvas.toBlob(function(blob){
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function(){
          
            var base64data = reader.result;
            // var fileSelect = $(this).val();
            $.ajax({
                url:'{{route("galericropImg")}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method:'POST',
                data:{image:base64data},
                success:function(data)
                {
                    // let text = text.replace("public/upload/", "");
                    $modal6.modal('hide');
                    $('#uploaded_image6').attr('src', '{{env("PATH_WEB")}}'+data);
                    // $('#upload_image').val(data);
                    $('#galeri3').val(data);
                    // $('#upload_image').attr('src', data);
                    // console.log(base64data);
                    // console.log(base64data);
                    // console.log(data);
                }
            });
        };
    });
});








});

</script>
@endsection
@section('style')
{{--
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
<link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
<script src="https://unpkg.com/dropzone"></script>
<script src="https://unpkg.com/cropperjs"></script>
{{--
<link rel="stylesheet" href="style.css" /> --}}

<style>
    .image_area {
        position: relative;
    }

    .image_area2 {
        position: relative;
    }

    img {
        display: block;
        max-width: 100%;
    }

    .preview {
        overflow: hidden;
        width: 80px;
        height: 80px;
        margin: 10px;
        border: 1px solid red;
    }

    .preview2 {
        overflow: hidden;
        width: 150px;
        height: 80px;
        margin: 10px;
        border: 1px solid red;
    }

    .preview3 {
        overflow: hidden;
        width: 150px;
        height: 80px;
        margin: 10px;
        border: 1px solid red;
    }

    .modal-lg {
        max-width: 1000px !important;
    }

    .overlay {
        position: absolute;
        bottom: 10px;
        left: 0;
        right: 0;
        background-color: rgba(26, 25, 25, 0.527);
        overflow: hidden;
        height: 0;
        color: white;
        transition: .5s ease;
        width: 100%;
    }

    .overlay2 {
        position: absolute;
        bottom: 10px;
        left: 0;
        right: 0;
        background-color: rgba(255, 255, 255, 0.5);
        overflow: hidden;
        height: 0;
        transition: .5s ease;
        width: 100%;
    }

    .image_area:hover .overlay {
        height: 50%;
        color: white;
        cursor: pointer;
    }

    .image_area2:hover .overlay2 {
        height: 50%;
        cursor: pointer;
    }

    .text {
        color: rgb(255, 255, 255);
        font-size: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
    }
</style>
@endsection