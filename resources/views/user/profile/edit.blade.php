@extends('user.layout.master')
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
                        @include('user.is_kyc')
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">Edit Profile</h4>
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
                                    <?php 
$profpic = str_replace('/uploads/trader/', "", Auth::user()->trader->photo)
?>
                                    <form class="form" action="{{url('update_profile')}}/{{Auth::user()->id}}"
                                        method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-body">
                                            <div class="form-group">
                                                <div class="col-2">
                                                    <label for="companyName">Foto Profile</label>
                                                    <div class="image_area text-center">
                                                        <label for="upload_image">
                                                            @if (empty($user->trader->photo))
                                                            <img src="{{asset('public')}}/default1.png"
                                                                id="uploaded_image" class="img-responsive"
                                                                style="border-radius: 50%;" />
                                                            @else
                                                            <img src="{{config('global.STORAGE_BUCKET2')}}kyc/{{$profpic}}"
                                                                id="uploaded_image" class="img-responsive"
                                                                style="border-radius: 50%;"
                                                                onerror="this.onerror=null;this.src='https://storage.googleapis.com/asset-santara/santara.co.id/images/error/no-image-user.png'" />
                                                            @endif

                                                            <div class="overlay">
                                                                <div class="text">Foto Profile</div>
                                                            </div>
                                                        </label>
                                                        <input type="file" name="image" class="image" id="upload_image"
                                                            style="display: none" />
                                                        <input type="text" value="{{$user->trader->photo}}" hidden
                                                            name="profile" class="image" id="profile" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="projectinput6">Nama</label>
                                                <input required type="text" id="companyName"
                                                    value="{{$user->trader->name}}" name="name" class="form-control"
                                                    placeholder="Nama">
                                            </div>
                                            <div class="form-group">
                                                <label for="projectinput6">Email</label>
                                                <input required type="text" id="companyName" value="{{$user->email}}"
                                                    name="email" class="form-control" placeholder="Email" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="projectinput6">Nomor Telepon</label>
                                                <input required type="text" id="companyName"
                                                    value="{{$user->trader->phone}}" name="phone" class="form-control"
                                                    placeholder="Nomor Telepon" readonly>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label for="projectinput6">Password</label>
                                                <input required type="text" id="companyName" value="" name="brand"
                                                    class="form-control" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <label for="projectinput6">Password Konfirmasi</label>
                                                <input required type="text" id="companyName" value="" name="brand"
                                                    class="form-control" placeholder="Password Konfirmasi">
                                            </div> --}}


                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" id="sav" class="btn btn-primary">
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
                    <h5 class="modal-title">Crop Foto Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container" style="padding: 30px">
                        <div class="row">
                            {{-- <div class="col-md-8"> --}}
                                <img src="" id="sample_image" />
                                {{--
                            </div>
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
                    url:'{{route("profilecropImg")}}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method:'POST',
                    data:{image:base64data},
                    success:function(data)
                    {
                        // let text = text.replace("public/upload/", "");
                        $modal.modal('hide');
                        $('#uploaded_image').attr('src', '{{config('global.STORAGE_BUCKET2')}}kyc/'+data);
                        // $('#upload_image').val(data);
                        $('#profile').val(data);
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