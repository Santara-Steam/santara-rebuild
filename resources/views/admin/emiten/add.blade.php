@extends('admin.layout.master')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">Tambah Penerbit</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">

                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="card-text">
                                    </div>
                                    <form class="form" action="{{url('/emiten/store')}}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-body">
                                            {{-- <div class="form-group">
                                                <label for="projectinput6">Owner</label>
                                                <select id="projectinput6" name="budget" class="form-control">
                                                    <option value="0" selected="" disabled="" hidden>-- Pilih Owner --
                                                    </option>
                                                    <option value="1">Bagas</option>

                                                </select>
                                            </div> --}}

                                            <div class="form-group">
                                                <label for="companyName">Nama Perusahaan</label>
                                                <input type="text" id="companyName" name="company_name" class="form-control"
                                                    placeholder="Nama Perusahaan">
                                            </div>

                                            <fieldset class="form-group">
                                                <label>Logo Perusahaan</label>

                                                <div class="custom-file">
                                                    <input type="file" name="logo" class="custom-file-input" id="inputGroupFile02">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFile02">Choose file</label>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <label>Cover Profile Perusahaan</label>

                                                <div class="custom-file">
                                                    <input type="file" name="cover" class="custom-file-input" id="inputGroupFile02">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFile02">Choose file</label>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <label>Galeri Foto Produk/Tempat Usaha</label>

                                                <div class="custom-file">
                                                    <input type="file" name="galeri" class="custom-file-input" id="inputGroupFile02">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFile02">Choose file</label>
                                                </div>
                                            </fieldset>
                                            <div class="form-group">
                                                <label for="companyName">Nama Owner</label>
                                                <input type="text" name="nama_owner" id="companyName" class="form-control"
                                                    placeholder="Nama Owner">
                                            </div>
                                            <fieldset class="form-group">
                                                <label>Foto Owner</label>

                                                <div class="custom-file">
                                                    <input type="file" name="owner" class="custom-file-input" id="inputGroupFile02">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFile02">Choose file</label>
                                                </div>
                                            </fieldset>
                                            <div class="form-group">
                                                <label for="projectinput6">Kategori</label>
                                                <select id="projectinput6" name="kategori" class="form-control">
                                                    <option value="0" selected="" disabled="" hidden>-- Pilih Kategori
                                                        --</option>
                                                    @foreach ($kategori as $item)
                                                    <option value="{{$item->id}}">{{$item->category}}</option>
                                                        
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">

                                                <label for="projectinput5">Omset 2 Tahun Sebelumnya</label>
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                        <label for="projectinput5">Omset Tahun 2021</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                    id="basic-addon1">Rp</span>
                                                            </div>
                                                            <input type="text" name="omset1" class="form-control"
                                                                placeholder="Omset 2021"
                                                                aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                        <label for="projectinput5">Omset Tahun 2022</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                    id="basic-addon1">Rp</span>
                                                            </div>
                                                            <input type="text" name="omset2" class="form-control"
                                                                placeholder="Omset 2022"
                                                                aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="companyName">Perkiraan Dana yang di Butuhkan</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                                    </div>
                                                    <input type="text" name="perkiraan_dana" class="form-control"
                                                        placeholder="Perkiraan Dana yang di Butuhkan"
                                                        aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="companyName">Perkiraan Saham yang di lepas ke Umum</label>
                                                <div class="input-group">

                                                    <input type="text" name="saham_dilepas" class="form-control"
                                                        placeholder="Perkiraan Saham yang di lepas ke Umum"
                                                        aria-describedby="basic-addon4">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon4">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="companyName">Perkiraan Omzet Setelah Jadi Penerbit</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                                    </div>
                                                    <input type="text" name="omset_penerbit" class="form-control"
                                                        placeholder="Perkiraan Omzet Setelah Jadi Penerbit"
                                                        aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="companyName">Perkiraan Deviden Tahunan</label>
                                                <div class="input-group">

                                                    <input type="text" name="deviden_tahunan" class="form-control"
                                                        placeholder="Perkiraan Deviden Tahunan"
                                                        aria-describedby="basic-addon4">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon4">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="companyName">Video Profile Perusahaan</label>
                                                <input type="text" id="companyName" name="video_profile" class="form-control"
                                                    placeholder="Video Profile Perusahaan">
                                            </div>
                                            <div class="form-group">
                                                <label for="companyName">Alamat Website</label>
                                                <input type="text" id="companyName" name="web" class="form-control"
                                                    placeholder="Alamat Website">
                                            </div>
                                            <div class="form-group">
                                                <label for="companyName">Facebook</label>
                                                <input type="text" id="companyName" name="fb" class="form-control"
                                                    placeholder="Facebook">
                                            </div>
                                            <div class="form-group">
                                                <label for="companyName">Instagram</label>
                                                <input type="text" id="companyName" name="ig" class="form-control"
                                                    placeholder="Instagram">
                                            </div>

                                            <div class="form-group">
                                                <label for="projectinput8">Isi Caption Biografi Owner atau Deskripsi
                                                    Usaha</label>
                                                <textarea id="projectinput8" rows="5" class="form-control"
                                                    name="deskripsi"
                                                    placeholder="Isi Caption Biografi Owner atau Deskripsi Usaha"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> Save
                                            </button>
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
<script src="{{asset('public/admin')}}/app-assets/js/scripts/forms/custom-file-input.js"></script>
@endsection