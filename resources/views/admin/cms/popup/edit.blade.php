@extends('admin.layout.master')
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h1 class="card-title-member">Edit Popup</h1>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <form enctype="multipart/form-data" action="{{ url('admin/cms/popup/update/'.$popup->uuid) }}"
                                            method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label><strong>Judul Popup</strong></label>
                                                <input class="form-control" name="title" value="{{ $popup->title }}" required />
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Jenis Popup</strong></label>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="type" id="customRadio1"
                                                        class="custom-control-input" value="ONETIME"
                                                        @if($popup->type == 'ONETIME') checked @endif />
                                                    <label class="custom-control-label" for="customRadio1">One Time Popup (
                                                        Hanya muncul 1 kali selama masa periode )</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="type" id="customRadio2"
                                                        class="custom-control-input" value="FREQUENTLY"
                                                        @if($popup->type == 'FREQUENTLY') checked @endif />
                                                    <label class="custom-control-label" for="customRadio2">Frequently Popup
                                                        ( Selalu muncul saat masuk
                                                        platform selama masih dalam masa periode )</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label><strong>Tanggal awal Popup ditampilkan</strong></label>
                                                            <input type="date" class="form-control" name="start_date"
                                                                value="{{ removeTgl000($popup->start_date) }}" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label><strong>Tanggal akhir Popup ditampilkan {{ removeTgl000($popup->finish_date) }}</strong></label>
                                                            <input type="date" class="form-control" name="finish_date"
                                                                value="{{ removeTgl000($popup->finish_date) }}" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Action Button</strong></label>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="action_button" id="customRadio3"
                                                        class="custom-control-input" value="0"
                                                        @if($popup->action_text == "") checked @endif>
                                                    <label class="custom-control-label" for="customRadio3">Tanpa Action
                                                        button</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="action_button" id="customRadio4" value="1"
                                                        class="custom-control-input"  @if($popup->action_text != "") checked @endif>
                                                    <label class="custom-control-label" for="customRadio4">Menggunakan
                                                        Action Button</label>
                                                </div>
                                                <small><i>Masukan text yang akan ditampilkan di action button</i></small>
                                                <input type="text" class="form-control" name="action_text"
                                                    placeholder="Contoh Beli Sekarang" value="{{ $popup->action_text }}" />
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Gambar Website</strong></label>
                                                        <div class="custom-file">
                                                            <input accept="image/*" name="website_pict" type="file"
                                                                class="custom-file-input" id="customFile"
                                                                onchange="showPreview(event);">
                                                            <label class="custom-file-label" for="customFile">Pilih
                                                                Gambar</label>
                                                        </div>
                                                        <div class="form-group pt-2">
                                                            <p style="font-size: 12px;"><i class="la la-info-circle"></i> Pastikan file dalam bentuk JPG/JPEG</p>
                                                            <p style="font-size: 12px;"><i class="la la-info-circle"></i> Resolusi yang disarankan 1280 X 720 ( atau berlaku kelipatanya )</p>
                                                            <p style="font-size: 12px;"><i class="la la-info-circle"></i> Ukuran file maksimal 5 MB</p>
                                                        </div>
                                                        <div class="preview">
                                                            <img id="file-ip-1-preview" src="{{ config('global.BASE_API_FILE').'/uploads/popup/'.$popup->website_pict }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Gambar Aplikasi</strong></label>
                                                        <div class="custom-file">
                                                            <input accept="image/*" name="mobile_pict" type="file"
                                                                class="custom-file-input" id="customFile2"
                                                                onchange="showPreview2(event);">
                                                            <label class="custom-file-label" for="customFile2">Pilih
                                                                Gambar</label>
                                                        </div>
                                                        <div class="form-group pt-2">
                                                            <p style="font-size: 12px;"><i class="la la-info-circle"></i> Pastikan file dalam bentuk JPG/JPEG</p>
                                                            <p style="font-size: 12px;"><i class="la la-info-circle"></i> Resolusi yang disarankan 300 x 400 ( atau berlaku kelipatanya )</p>
                                                            <p style="font-size: 12px;"><i class="la la-info-circle"></i> Ukuran file maksimal 5 MB</p>
                                                        </div>
                                                        <div class="preview">
                                                            <img id="file-ip-2-preview" src="{{ config('global.BASE_API_FILE').'/uploads/popup/'.$popup->mobile_pict }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Link redirect action button ( Webstite
                                                                )</strong></label>
                                                        <input class="form-control" name="website_url"
                                                            placeholder="Contoh: https://santara.co.id/detail/deck/219"
                                                            value="{{ $popup->website_url }}"
                                                            required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><strong>Link redirect action button ( Aplikasi
                                                                )</strong></label>
                                                        <input class="form-control" name="mobile_url"
                                                            value="{{ $popup->mobile_url }}"
                                                            placeholder="Contoh: https://santara.co.id/detail/deck/219"
                                                            required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Status</strong></label>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="is_active" value="1"
                                                        id="customRadio5" class="custom-control-input"
                                                        @if($popup->is_active == 1) checked @endif>
                                                    <label class="custom-control-label" for="customRadio5">Aktif (Popup akan
                                                        muncul jika berada dalam masa periode yang sudah ditentukan)</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="is_active" value="0" id="customRadio6"
                                                        class="custom-control-input"
                                                        @if($popup->is_active == 0) checked @endif />
                                                    <label class="custom-control-label" for="customRadio6">Tidak Aktif
                                                        (Popup tidak akan muncul meskipun dalam masa periode yang sudah
                                                        ditentukan )</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit">Simpan</button>
                                                <a class="btn btn-danger" href="{{ url()->previous() }}">Kembali</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"
        integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <script>
        $(document).ready(function() {
            bsCustomFileInput.init()
        });

        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function showPreview2(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-2-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
@endsection
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
        integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        img#file-ip-1-preview {
            width: 200px;
            margin-top: 8px;
            margin-bottom: 8px;
        }

        img#file-ip-2-preview {
            width: 200px;
            margin-top: 8px;
            margin-bottom: 8px;
        }

    </style>
@endsection
