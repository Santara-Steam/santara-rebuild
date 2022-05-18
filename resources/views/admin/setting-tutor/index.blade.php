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
                                        <form id="formSubmitSetting" enctype="multipart/form-data">
                                            {{-- <input type="hidden" name="id" value="<?= ($data) ? $data->id : '' ?>" /> --}}
                                            <div>
                                                <label><input type="radio" name="setting" value="video" checked> Video</label>
                                                <label><input type="radio" name="setting" value="document"> Document</label>
                                                <label><input type="radio" name="setting" value="redirect"> Redirect</label>
                                            </div>
                                            <div id="show_video" class="setting">
                                                <div class="form-row py-2">
                                                    <div class="form-group col-md-12">
                                                        <label class="col-md-3 control-label mb-1">Link Video</label>
                                                        <input type="text" class="form-control" name="video" id="video" placeholder="Masukan Link Video Youtube" />
                                                        <span id="video_error" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <a class="btn btn-santara-white btn-block" href="javascript:window.history.go(-1);">Kembali</a>
                                                    </div>
                            
                                                    <div class="form-group col-md-6">
                                                        <button type="submit" class="btn btn-block btn-santara-red" value="video">Simpan</button>
                                                    </div>
                                                </div>                    
                                            </div>
                                            <div id="show_document" class="setting" style="display:none;">
                                                <div class="form-row py-2">
                                                    <div class="form-group col-md-12">
                                                        <label class="col-md-3 control-label mb-1">Dokumen</label>
                                                       
                                                        <input type="file" class="form-control-file" name="document" id="document" accept="application/pdf" />
                                                        <div id="errorBlockPictures" class="help-block" style="padding:10px; margin: 10px 0"></div>   
                                                        <br />                                             
                                                        <p style="font-size: 11px;"><i class="la la-info-circle"></i> Pastikan file dalam bentuk PDF</p>                            
                                                        <p style="font-size: 11px;"><i class="la la-info-circle"></i> Ukuran file maksimal 20 Mb</p>
                                                        <p style="font-size: 11px;"><i class="la la-info-circle"></i> Pastikan sudah terlampir nomor dokumen resmi</p>                                                                                
                                                        <span id="document_error" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <a class="btn btn-santara-white btn-block" href="javascript:window.history.go(-1);">Kembali</a>
                                                    </div>
                            
                                                    <div class="form-group col-md-6">
                                                        <button type="submit" class="btn btn-block btn-santara-red" value="document">Simpan</button>
                                                    </div>
                                                </div>                    
                                            </div>
                                            <div id="show_redirect" class="setting" style="display:none;">
                                                <div class="form-row py-2">
                                                    <div class="form-group col-md-12">
                                                        <label class="col-md-3 control-label mb-1">Link Halaman</label>
                                                        <input type="text" class="form-control" name="redirect" id="redirect" placeholder="Masukan Link Halaman"/>
                                                        <span id="redirect_error" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <a class="btn btn-santara-white btn-block" href="javascript:window.history.go(-1);">Kembali</a>
                                                    </div>
                            
                                                    <div class="form-group col-md-6">
                                                        <button type="submit" class="btn btn-block btn-santara-red" value="redirect" >Simpan</button>
                                                    </div>
                                                </div>                      
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function(){
        $('input[type="radio"]').click(function(){
            var inputValue = $(this).attr("value");
            $("div.setting").hide();
            $("#show_"+inputValue).show();
        });                          
    });
</script>
@endsection