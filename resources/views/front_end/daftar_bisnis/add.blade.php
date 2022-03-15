    <link rel="stylesheet" type="text/css" href="{{ ('public/new-santara/css/form-daftarkan-bisnis.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
    <script src="https://unpkg.com/dropzone"></script>
    <script src="https://unpkg.com/cropperjs"></script>

    <style>
        .error {
            color: red;
        }

        .image_area {
            position: relative;
        }

        .img-daftar-bisnis {
            display: block;
            border: solid #FFFFFF;
            /* max-width: 100%; */
        }

        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
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
            background-color: rgba(255, 255, 255, 0.5);
            overflow: hidden;
            height: 0;
            transition: .5s ease;
            width: 100%;
        }

        .image_area:hover .overlay {
            height: 50%;
            cursor: pointer;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            /* top: 52%;
            left: 45%; */
            transform: translate(190%, -250%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .container-foto:hover img {
            opacity: 0.3;
        }

        .container-foto:hover .middle {
            opacity: 1;
        }

        .hapus-foto {
            text-align: center;
            background: #BF2D30;
            padding: 5px;
            border-radius: 30px;
            width: 30px;
            box-shadow: 0px 0px 0 2px #6b6f82;
            color: white;
            cursor: pointer;
        }

        .hapus-foto:active {
            box-shadow: 0px 0px 0 2px #fff;
        }
    </style>

    <div class="container-fluid d-flex align-content-center justify-content-center bg-header-daftarkan-bisnis text-center">
        <div class="row col-12 col-md-9">
            <div class="col-12 align-self-end">
                <img src="{{ ('public/new-santara/img/logo/logo_header.png') }}" class="img-fluid" width="270px" alt="logo santara" />
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
    <?php
    $now = date('Y');
    $th1 = $now - 1;
    ?>
    <div class="container mt-5">
        <div class="row d-flex align-content-center justify-content-center ">
            <div class="col-8 col-md-6 col-lg-4 text-center">
                <h1 class="ff-p c-gold judul-register-coming-soon">Registrasi Coming Soon</h1>
            </div>
        </div>
        <form class="ff-m" id="formDatas">
            <div class="row d-flex justify-content-center" style="border-top: #4A585A solid;">
                <div class="col-12 col-xl-6 mt-5">
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Nama Perusahaan</label>
                        <input type="text" class="form-control" name="nama_perusahaan" placeholder="Isi Nama Perusahaan">
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Logo Perusahaan</label>
                        <div class="row">
                            <div class="col-3">
                                <img src="{{ ('public/images/error/no-image.png') }}" width="100%" class="rounded logo_perusahaan img-daftar-bisnis" />
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <input type="file" class="form-control d-none" id="input_logo_perusahaan">
                                <button type="button" class="btn btn-danger btn-sm" onclick="document.getElementById('input_logo_perusahaan').click()">Browse File</button>
                            </div>
                            <input type="hidden" class="form-control" name="logo_perusahaan" id="input_logo_perusahaan">
                        </div>
                        <div class="error invalid-feedback" id="img-perusahaan"></div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Foto Cover Profile Perusahaan</label>
                        <div class="row">
                            <span style="color: #708088;" class="ff-n">Max. 10 Mb, image size 1366 x 497 pixel (recomended)</span>
                            <div class="col-8 col-md-5">
                                <img src="{{ ('public/images/error/no-image.png') }}" width="100%" height="130px" class="rounded cover_perusahaan img-daftar-bisnis" />
                            </div>
                            <div class="col-4 col-md-7 d-flex align-items-center">
                                <input type="file" class="form-control d-none" id="input_cover_perusahaan">
                                <button type="button" class="btn btn-danger btn-sm" onclick="document.getElementById('input_cover_perusahaan').click()">Browse File</button>
                            </div>

                            <input type="hidden" class="form-control" name="cover_perusahaan" id="input_cover_perusahaan">
                        </div>
                        <div class="error invalid-feedback" id="img-cover-perusahaan"></div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Galeri Foto Produk/Tempat Usaha</label>
                        <div class="row">
                            <span style="color: #708088;" class="ff-n">Max. 10 Mb, image ratio 4:3 (recomended)</span>
                            <div class="row col-12 col-md-7" id="list_produk">
                                <div class="col-6 produk_perusahaan">
                                    <img src="{{ ('public/images/error/no-image.png') }}" width="150px" height="125px" class="rounded" />
                                </div>
                            </div>
                            <div class="col-12 mt-1 col-md-5 d-flex align-items-center">
                                <input type="file" class="form-control d-none" id="input_produk_perusahaan">
                                <button type="button" class="btn btn-danger btn-sm" onclick="document.getElementById('input_produk_perusahaan').click()">Browse File</button>
                            </div>

                            <input type="hidden" class="form-control" name="produk_perusahaan" id="input_produk_perusahaan">
                        </div>
                        <div class="error invalid-feedback" id="img-produk-perusahaan"></div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Nama Owner</label>
                        <input type="text" class="form-control" name="nama_owner" placeholder="Isi Nama Owner">
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Foto Owner</label>
                        <div class="row">
                            <div class="col-3">
                                <img src="{{ ('public/images/error/no-image.png') }}" width="100%" class="rounded owner_perusahaan img-daftar-bisnis" />
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <input type="file" class="form-control d-none" id="input_owner_perusahaan">
                                <button type="button" class="btn btn-danger btn-sm" onclick="document.getElementById('input_owner_perusahaan').click()">Browse File</button>
                            </div>
                        </div>
                        <div class="error invalid-feedback" id="img-owner"></div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Kategori Bisnis</label>
                        <select class="form-select" name="kategori" aria-label="Default select example">
                            <option value="" selected>Pilih Kategori Bisnis</option>
                            
                        </select>
                    </div>
                    <p class="mt-3">*Omzet 2 Tahun Sebelumnya <?= $th1 ?> dan <?= $now ?></p>
                    <div class="form-group mt-2">
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label" style="font-weight: 700;">*Tahun <?= $th1 ?></label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1" style="background-color:#D5E1E6">Rp</span>
                                    <input type="text" class="form-control format-number format-number number-only" id="amount" name="omzet1" placeholder="0" style="background-color:#fff" aria-label="" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label" style="font-weight: 700;">*Tahun <?= $now ?> (Berjalan)</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1" style="background-color:#D5E1E6">Rp</span>
                                    <input type="text" class="form-control format-number number-only" name="omzet2" placeholder="0" style="background-color:#fff" aria-label="" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Perkiraan Dana Yang di Butuhkan </label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="text" class="form-control format-number number-only" name="dana_dibutuhkan" placeholder="0" aria-label="dana_dibutuhkan" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Perkiraan Saham yang di Lepas ke Umum</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control format-number number-only" placeholder="0" name="lembar_saham" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Perkiraan Omzet Setelah Jadi Penerbit</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="text" class="form-control format-number number-only " placeholder="0" name="omzet_penerbit" aria-label="omzet_jadi_penerbit" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Perkiraan Deviden Tahunan</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control format-number number-only " placeholder="0" name="dividen_tahunan" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text " id="basic-addon2">%</span>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">Video Profile Perusahaan</label>
                        <input type="text" class="form-control username" name="youtube" placeholder="https://www.youtube.com/watch?v=DSO7qWAbqjg">
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">Alamat Website</label>
                        <input type="text" class="form-control username" name="website" placeholder="https://santara.co.id/">
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">Facebook</label>
                        <input type="text" class="form-control username" name="facebook" placeholder="Isi Username Facebook">
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">Instagram</label>
                        <input type="text" class="form-control username" name="instagram" placeholder="Isi Username Instagram">
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1" class="form-label">*Isi Caption Biografi Owner atau Deskripsi Usaha</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="biografi" placeholder="Isi Caption dan Biografi" rows="3"></textarea>
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
                
        </form>
    </div>

    <script src="{{ ('public/new-santara/js/guest/form-daftarkan-bisnis.js') }}" defer></script>