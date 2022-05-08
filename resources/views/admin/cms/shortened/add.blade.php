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
                                    <h1 class="card-title-member">Tambah Shortened</h1>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <form action="{{ url('admin/cms/shortened/store') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label><strong>Title</strong></label>
                                                <input class="form-control" name="title" required />
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Url</strong></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">{{ config('global.BASE_FILE_URL') }}</div>
                                                    </div>
                                                    <input type="text" class="form-control alpha-numeric" name="url" placeholder="BeritaSantara" required/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Link</strong></label>
                                                <input class="form-control" name="link" placeholder="http://berita.santara.co.id" required />
                                                <small class="text-danger">Harus di awali http:// atau https://</small>
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
@endsection
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
