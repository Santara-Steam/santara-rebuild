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
                                    <h1 class="card-title-member">Setting Tutorial (Redirect Tutorial Laporan Keuangan)</h1>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link @if($tutor != null) @if($tutor->group == 'video') active @endif @else active @endif" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                                                    Video
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link @if($tutor != null) @if($tutor->group == 'document') active @endif @endif" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                                                    Document
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link @if($tutor != null) @if($tutor->group == 'redirect') active @endif @endif" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">
                                                    Redirect
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade @if($tutor != null) @if($tutor->group == 'video') show active @endif @else show active @endif" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                <form action="{{ url('admin/penerbit/store_setting_tutor') }}">
                                                    @csrf
                                                    <input type="hidden" name="id"  @if($tutor != null) value="{{ $tutor->id }}" @endif />
                                                    <div class="form-group">
                                                        <label><strong>Link Video</strong></label>
                                                        <input type="hidden" class="form-control" name="group" value="video" />
                                                        <input type="text" class="form-control" name="value"
                                                            placeholder="Masukkan url video youtube"  @if($tutor != null) @if($tutor->group == "video") value="{{ $tutor->value }}" @endif @endif  />
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade @if($tutor != null) @if($tutor->group == 'document') show active @endif @endif" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                <form method="POST" action="{{ url('admin/penerbit/store_setting_tutor') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id"  @if($tutor != null) value="{{ $tutor->id }}" @endif />
                                                    <div class="form-group">
                                                        <label><strong>Dokumen</strong></label>
                                                        <input type="hidden" class="form-control" name="group" value="document" />
                                                        <div class="custom-file">
                                                            <input class="custom-file-input req" name="document" id="document"
                                                                accept="application/pdf" type="file" onChange="OnFileValidation()" />
                                                            <label class="custom-file-label ssa" id="ssa" for="inputGroupFile02" aria-describedby="inputGroupFile02">Pilih File</label>
                                                        </div>
                                                        <div class="row p-1">
                                                            <div class="col-12">
                                                                <i class="la la-info-circle"></i>
                                                                Pastikan file dalam bentuk PDF
                                                            </div>
                                                            <div class="col-12">
                                                                <i class="la la-info-circle"></i>
                                                                Ukuran file maksimal 20 Mb
                                                            </div>
                                                            <div class="col-12">
                                                                <i class="la la-info-circle"></i>
                                                                Pastikan sudah terlampir nomor dokumen resmi
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if($tutor != null)
                                                        @if($tutor->group == 'document')
                                                            <a class="btn btn-success" href="{{ config('global.STORAGE_GOOGLE').'images/content/'.$tutor->value }}">Lihat file</a>
                                                        @endif
                                                    @endif
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade @if($tutor != null) @if($tutor->group == 'redirect') show active @endif @endif" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                <form method="POST" action="{{ url('admin/penerbit/store_setting_tutor') }}">
                                                    @csrf
                                                    <input type="hidden" name="id"  @if($tutor != null) value="{{ $tutor->id }}" @endif />
                                                    <div class="form-group">
                                                        <label><strong>Link Halaman</strong></label>
                                                        <input type="hidden" class="form-control" name="group" value="redirect" />
                                                        <input type="text" class="form-control" name="value"
                                                            placeholder="Masukkan link halaman" @if($tutor != null) @if($tutor->group == "redirect") value="{{ $tutor->value }}" @endif @endif  />
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </form>
                                            </div>
                                        </div>
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
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init()
    });

    function OnFileValidation() {
        var dokumen = document.getElementById("dokumen");
        if (typeof (dokumen.files) != "undefined") {
            var size = parseFloat(dokumen.files[0].size / (1024 * 1024)).toFixed(2); 
            if(size > 20) {
                alert('Harap pilih dokumen kurang dari 20 MB');
            }
        } else {
            alert("This browser does not support HTML5.");
        }
    }
</script>
@endsection