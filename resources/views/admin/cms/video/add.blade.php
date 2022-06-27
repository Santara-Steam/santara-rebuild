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
                                <h1 class="card-title-member">Tambah Video</h1>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <form action="{{ url('admin/cms/video/store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label><strong>Judul Video</strong></label>
                                            <input class="form-control" name="title" maxlength="255" required />
                                            <small><i>* Maksimal 255 karakter</i></small>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Kategori Video</strong></label>
                                            <select name="category" id="category" required class="form-control">
                                                <option value="">Pilih...</option>
                                                <?php foreach ( $categories as $category ) : ?>
                                                <option value="<?= $category['uuid'] ?>" <?=isset($video) && $video->
                                                    category == $category['id'] ? 'selected' : '' ?>>
                                                    <?= $category['category'] ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Diskripsi</strong></label>
                                            <textarea class="form-control" rows="4" cols="50" maxlength="1000"
                                                name="description" id="description"></textarea>
                                            <small><i>* Maksimal 1000 karakter</i></small>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>URL Youtube</strong></label>
                                            <input class="form-control" name="link" maxlength="255" required />
                                            <small><i>* Maksimal 255 karakter</i></small>
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
<script src="{{ asset('public') }}/assets/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
            $('select').select2({
                maximumSelectionLength: 2,
                allowClear: true
            });
        });
</script>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{ asset('public') }}/assets/css/select2.min.css" rel="stylesheet" />
@endsection