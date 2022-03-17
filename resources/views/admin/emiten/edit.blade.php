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
                                <h4 class="card-title" id="basic-layout-form">Edit Penerbit</h4>
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
                                    <form class="form" action="{{url('/emiten/update')}}/{{$emiten->id}}" method="POST" enctype="multipart/form-data">
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
                                                <input type="text" id="companyName" name="company_name" class="form-control" value="{{$emiten->company_name}}"
                                                    placeholder="Nama Perusahaan">
                                            </div>
                                            <div class="form-group">
                                                <label for="projectinput6">Owner</label>
                                                <select id="projectinput6" name="pemilik" class="form-control">
                                                    <option value="0" selected="" disabled="" hidden>-- Pilih Owner
                                                        --</option>
                                                    @foreach ($user as $item)
                                                    <option <?php if ($emiten->trader_id == $item->trader->id) {
                                                        echo 'selected'; } ?> value="{{$item->trader->id}}">{{$item->trader->name}} - {{$item->email}}</option>
                                                        
                                                    @endforeach
                                                </select>
                                            </div>

                                            <fieldset class="form-group row">
                                                <div class="col-2 text-center">
                                                    <label for="companyName">Logo Usaha</label>
                                                    <div class="image_area text-center">
                                                        <label for="upload_image">
                                                            <img src="{{asset('public/upload')}}/{{$picture[0]}}" id="uploaded_image"
                                                                class="img-responsive" />
                                                            <div class="overlay">
                                                                <div class="text">Logo Perusahaan</div>
                                                            </div>
                                                        </label>
                                                        <input type="file" name="image" class="image" id="upload_image"
                                                            style="display: none" />
                                                        <input type="text" value="{{$picture[0]}}" hidden name="logo" class="image"
                                                            id="logo" />
                                                    </div>
                                                </div>
                                                <div class="col-7 text-center">
                                                    <label for="companyName">Cover Profile</label>
                                                    <div class="image_area text-center">
                                                        <label for="upload_image2">
                                                            <img src="{{asset('public/upload')}}/{{$picture[1]}}" id="uploaded_image2"
                                                                class="img-responsive" />
                                                            <div class="overlay">
                                                                <div class="text">Cover Profile</div>
                                                            </div>
                                                        </label>
                                                        <input type="file" name="image2" class="image" id="upload_image2"
                                                            style="display: none" />
                                                        <input type="text" value="{{$picture[1]}}" hidden name="cover" class="image"
                                                            id="cover" />
                                                    </div>
                                                </div>
                                                <div class="col-3 text-center">
                                                    <label for="companyName">Galeri Foto/Tempat Usaha</label>
                                                    <div class="image_area text-center">
                                                        <label for="upload_image3">
                                                            <img src="{{asset('public/upload')}}/{{$picture[2]}}" id="uploaded_image3"
                                                                class="img-responsive" />
                                                            <div class="overlay">
                                                                <div class="text">Galeri Foto/Tempat Usaha</div>
                                                            </div>
                                                        </label>
                                                        <input type="file" name="image3" class="image" id="upload_image3"
                                                            style="display: none" />
                                                        <input type="text" value="{{$picture[2]}}" hidden name="galeri" class="image"
                                                            id="galeri" />
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <div class="form-group row">

                                                <div class="col-3">
                                                    <label for="companyName">Foto Owner</label>
                                                    <div class="image_area text-center">
                                                        <label for="upload_image4">
                                                            <img src="{{asset('public/upload')}}/{{$picture[3]}}" id="uploaded_image4"
                                                                class="img-responsive" />
                                                            <div class="overlay">
                                                                <div class="text">Foto Owner</div>
                                                            </div>
                                                        </label>
                                                        <input type="file" name="image4" class="image" id="upload_image4"
                                                            style="display: none" />
                                                        <input type="text" hidden value="{{$picture[3]}}" name="owner" class="image"
                                                            id="owner" />
                                                    </div>

                                                </div>
                                                <div class="col-9">
                                                    <div class="form-group">
                                                        <label for="companyName">Nama Owner</label>
                                                        <input type="text" value="{{$emiten->owner_name}}" name="nama_owner" id="companyName"
                                                        class="form-control" placeholder="Nama Owner">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="projectinput6">Kategori</label>
                                                        <select id="projectinput6" name="kategori" class="form-control">
                                                            <option value="0" selected="" disabled="" hidden>-- Pilih Kategori
                                                                --</option>
                                                            @foreach ($kategori as $item)
                                                            <option <?php if ($emiten->category_id == $item->id) {
                                                                echo 'selected'; } ?> value="{{$item->id}}">{{$item->category}}</option>
                                                                
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="companyName">Perkiraan Dana yang di Butuhkan</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                                            </div>
                                                            <input type="text" value="{{$emiten->avg_capital_needs}}" name="perkiraan_dana" class="form-control"
                                                                placeholder="Perkiraan Dana yang di Butuhkan"
                                                                aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                            {{-- <div class="form-group"> --}}
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="projectinput5">Omset Tahun 2021</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                    id="basic-addon1">Rp</span>
                                                            </div>
                                                            <input type="text" value="{{$emiten->avg_annual_turnover_previous_year}}"  name="omset1" class="form-control"
                                                                placeholder="Omset 2021"
                                                                aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="projectinput5">Omset Tahun 2022</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                    id="basic-addon1">Rp</span>
                                                            </div>
                                                            <input type="text" value="{{$emiten->avg_annual_turnover_current_year}}"  name="omset2" class="form-control"
                                                                placeholder="Omset 2022"
                                                                aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                </div>
                                            {{-- </div> --}}
                                            
                                            <div class="form-group">
                                                <label for="companyName">Perkiraan Saham yang di lepas ke Umum</label>
                                                <div class="input-group">

                                                    <input type="text" value="{{$emiten->avg_general_share_amount}}" name="saham_dilepas" class="form-control"
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
                                                    <input type="text" value="{{$emiten->avg_turnover_after_becoming_a_publisher}}" name="omset_penerbit" class="form-control"
                                                        placeholder="Perkiraan Omzet Setelah Jadi Penerbit"
                                                        aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="companyName">Perkiraan Deviden Tahunan</label>
                                                <div class="input-group">

                                                    <input type="text" value="{{$emiten->avg_annual_dividen}}" name="deviden_tahunan" class="form-control"
                                                        placeholder="Perkiraan Deviden Tahunan"
                                                        aria-describedby="basic-addon4">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon4">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="companyName">Video Profile Perusahaan</label>
                                                <input type="text" value="{{$emiten->youtube}}" id="companyName" name="video_profile" class="form-control"
                                                    placeholder="Video Profile Perusahaan">
                                            </div>
                                            <div class="form-group">
                                                <label for="companyName">Alamat Website</label>
                                                <input type="text" value="{{$emiten->website}}" id="companyName" name="web" class="form-control"
                                                    placeholder="Alamat Website">
                                            </div>
                                            <div class="form-group">
                                                <label for="companyName">Facebook</label>
                                                <input type="text" value="{{$emiten->facebook}}" id="companyName" name="fb" class="form-control"
                                                    placeholder="Facebook">
                                            </div>
                                            <div class="form-group">
                                                <label for="companyName">Instagram</label>
                                                <input type="text" value="{{$emiten->instagram}}" id="companyName" name="ig" class="form-control"
                                                    placeholder="Instagram">
                                            </div>

                                            <div class="form-group">
                                                <label for="projectinput8">Isi Caption Biografi Owner atau Deskripsi
                                                    Usaha</label>
                                                <textarea id="projectinput8" rows="5" class="form-control"
                                                    name="deskripsi"
                                                    placeholder="Isi Caption Biografi Owner atau Deskripsi Usaha">{{$emiten->business_description}}</textarea>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label for="companyName">Kode Emiten</label>
                                                <input type="text" id="companyName" value="{{$emiten->code_emiten}}"  name="code_emiten" class="form-control"
                                                    placeholder="Kode Emiten">
                                            </div>
                                            <div class="form-group">
                                                <label for="companyName">Nama Brand</label>
                                                <input type="text" id="companyName" value="{{$emiten->trademark}}"  name="brand" class="form-control"
                                                    placeholder="Nama Brand">
                                            </div>
                                            <div class="form-group">
                                                <label for="companyName">Harga Saham Per Lembar</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                                    </div>
                                                    <input type="text" name="harga_saham" value="{{$emiten->price}}" class="form-control"
                                                        placeholder="Harga Saham Per Lembar"
                                                        aria-describedby="basic-addon1">
                                                </div>
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
                    <h5 class="modal-title">Crop Galeri Foto/Tempat Usaha</h5>
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
    </div>
    @endsection
    @section('js')
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
        
    
    
    
    
    
    
    
    
        
        
    });
    </script>
    @endsection
    @section('style')
    {{--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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