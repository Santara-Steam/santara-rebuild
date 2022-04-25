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
                                    <h1 class="card-title-member">Edit Testimoni</h1>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <form enctype="multipart/form-data" action="{{ url('admin/cms/testimoni/update/'.$testimoni->id) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input class="form-control" value="{{ $testimoni->title }}" name="title" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Subtitle</label>
                                                <input class="form-control" value="{{ $testimoni->subtitle }}" name="subtitle" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Image</label>
                                                <div class="custom-file">
                                                    <input accept="image/*" name="image" type="file"
                                                        class="custom-file-input" id="customFile" onchange="showPreview(event);">
                                                    <label class="custom-file-label" for="customFile">Pilih Gambar</label>
                                                </div>
                                                <div class="preview">
                                                    <img id="file-ip-1-preview" src="{{ asset('public/testimoni').'/'.$testimoni->image }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" name="description" required>{{ $testimoni->description }}</textarea>
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
        href="{{ asset('public/admin') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
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
