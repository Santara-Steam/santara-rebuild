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
                                <h1 class="card-title-member">Edit Penerbit</h1>
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
                                    <form class="form" action="{{url('emiten/update')}}/{{$emiten->id}}" method="POST"
                                        enctype="multipart/form-data">
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
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="companyName">Nama Brand <span style="color: red">*</span></label>
                                                    <input required type="text" id="companyName" value="{{$emiten->trademark}}"
                                                        name="brand" class="form-control" placeholder="Nama Brand">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="companyName">Nama Perusahaan <span style="color: red">*</span></label>
                                                    <input required type="text" id="companyName" name="company_name"
                                                        class="form-control" value="{{$emiten->company_name}}"
                                                        placeholder="Nama Perusahaan">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="projectinput6">Kategori <span style="color: red">*</span></label>
                                                    <div class="hidden" id="rowCategoriBisnis">
                                                        <select id="categoriBisnis" style="width: 100%" name="kategori" class="form-control"></select>
                                                    </div>
                                                    <div class="input-group" id="categoriEdit">
                                                        <input type="text" value="{{ $emiten->category }}" 
                                                            class="form-control" id="categoriBisnis2" readonly />
                                                        <span class="input-group-text cursor-pointer" id="changeCategoriBisnis">Ganti</span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="projectinput6">Trader Email <span style="color: red">*</span></label>
                                                    <div class="hidden" id="rowTraderEmail">
                                                        <select style="width: 100%" id="traderEmail" name="trader" class="form-control">
                                                        </select>
                                                    </div>
                                                    <div class="input-group" id="userEdit">
                                                        <input type="text" value="{{ $emiten->email }}" 
                                                            class="form-control"  readonly />
                                                        <span class="input-group-text cursor-pointer" id="changeUserEdit">Ganti</span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="projectinput8">Deskripsi
                                                        Usaha <span style="color: red">*</span></label>
                                                    <textarea required id="projectinput8" rows="5" class="form-control"
                                                        name="deskripsi"
                                                        placeholder="Deskripsi Usaha">{{$emiten->business_description}}</textarea>
                                                </div>
                                                {{-- <fieldset class="form-group row">
                                                    <div class="col-2 text-center">
                                                        <label for="companyName">Logo Usaha</label>
                                                        <div class="image_area text-center">
                                                            <label for="upload_image">
                                                                <img src="{{asset('public/upload')}}/{{$picture[0]}}"
                                                                    id="uploaded_image" class="img-responsive" />
                                                                <div class="overlay">
                                                                    <div class="text">Logo Perusahaan</div>
                                                                </div>
                                                            </label>
                                                            <input required type="file" name="image" class="image"
                                                                id="upload_image" style="display: none" />
                                                            <input required type="text" value="{{$picture[0]}}" hidden
                                                                name="logo" class="image" id="logo" />
                                                        </div>
                                                    </div>
                                                    <div class="col-7 text-center">
                                                        <label for="companyName">Cover Profile</label>
                                                        <div class="image_area text-center">
                                                            <label for="upload_image2">
                                                                <img src="{{asset('public/upload')}}/{{$picture[1]}}"
                                                                    id="uploaded_image2" class="img-responsive" />
                                                                <div class="overlay">
                                                                    <div class="text">Cover Profile</div>
                                                                </div>
                                                            </label>
                                                            <input required type="file" name="image2" class="image"
                                                                id="upload_image2" style="display: none" />
                                                            <input required type="text" value="{{$picture[1]}}" hidden
                                                                name="cover" class="image" id="cover" />
                                                        </div>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <label for="companyName">Foto Owner</label>
                                                        <div class="image_area text-center">
                                                            <label for="upload_image4">
                                                                <img src="{{asset('public/upload')}}/{{$picture[2]}}"
                                                                    id="uploaded_image4" class="img-responsive" />
                                                                <div class="overlay">
                                                                    <div class="text">Foto Owner</div>
                                                                </div>
                                                            </label>
                                                            <input required type="file" name="image4" class="image"
                                                                id="upload_image4" style="display: none" />
                                                            <input required type="text" hidden value="{{$picture[2]}}"
                                                                name="owner" class="image" id="owner" />
                                                        </div>

                                                    </div>
                                                </fieldset>

                                                <div class="form-group row">

                                                    <div class="col-4">
                                                        <label for="companyName">Galeri Foto/Tempat Usaha</label>
                                                        <div class="image_area text-center">
                                                            <label for="upload_image3">
                                                                <img src="{{asset('public/upload')}}/{{$picture[3]}}"
                                                                    id="uploaded_image3" class="img-responsive" />
                                                                <div class="overlay">
                                                                    <div class="text">Galeri Foto/Tempat Usaha</div>
                                                                </div>
                                                            </label>
                                                            <input required type="file" name="image3" class="image"
                                                                id="upload_image3" style="display: none" />
                                                            <input required type="text" value="{{$picture[3]}}" hidden
                                                                name="galeri" class="image" id="galeri" />
                                                        </div>

                                                    </div>
                                                    <div class="col-4">
                                                        <label for="companyName">Galeri Foto/Tempat Usaha 2</label>
                                                        <div class="image_area text-center">
                                                            <label for="upload_image5">
                                                                <img src="{{asset('public/upload')}}/{{$picture[4]}}"
                                                                    id="uploaded_image5" class="img-responsive" />
                                                                <div class="overlay">
                                                                    <div class="text">Galeri Foto/Tempat Usaha 2</div>
                                                                </div>
                                                            </label>
                                                            <input required type="file" name="image5" class="image"
                                                                id="upload_image5" style="display: none" />
                                                            <input required type="text" value="{{$picture[4]}}" hidden
                                                                name="galeri2" class="image" id="galeri2" />
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <label for="companyName">Galeri Foto/Tempat Usaha 3</label>
                                                        <div class="image_area text-center">
                                                            <label for="upload_image6">
                                                                <img src="{{asset('public/upload')}}/{{$picture[5]}}"
                                                                    id="uploaded_image6" class="img-responsive" />
                                                                <div class="overlay">
                                                                    <div class="text">Galeri Foto/Tempat Usaha 3</div>
                                                                </div>
                                                            </label>
                                                            <input required type="file" name="image6" class="image"
                                                                id="upload_image6" style="display: none" />
                                                            <input required type="text" value="{{$picture[5]}}" hidden
                                                                name="galeri3" class="image" id="galeri3" />
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="form-group col-md-4">
                                                    <label for="companyName">Thumbnail <span style="color: red">*</span></label>
                                                    <br>
                    <small style="font-size: 11px;color:grey">Max. 10 Mb, image size 304 x 380 pixel (recomended) (.jpg / .png only)</small>
                                                    <div class="custom-file">
                                                        <input class="custom-file-input req" accept=".png, .jpg" type="file" 
                                                            id="upload_image">
                                                        <label class="custom-file-label ssa" id="ssa" for="inputGroupFile02"
                                                            aria-describedby="inputGroupFile02">{{$picture[0]}}</label>
                                                    </div>
                                                    <input type="hidden" name="thumbnail" id="thumbnail" value="{{ $picture[0] }}"  />
                                                    @if($picture[0] != 'no-image.png')
                                                        <img class="mt-1" width="200" id="thumbnailUploaded" src="{{ config('global.STORAGE_GOOGLE').'token/'.$picture[0] }}" />
                                                    @else
                                                        <img class="mt-1" width="200" id="thumbnailUploaded" src="{{ config('global.STORAGE_GOOGLE').'images/error/'.$picture[0] }}" />
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="companyName">Banner <span style="color: red">*</span></label>
                                                    <br>
                    <small style="font-size: 11px;color:grey">Max. 10 Mb, image size 1440 x 432 pixel (recomended) (.jpg / .png only)</small>
                                                    <div class="custom-file">
                                                        <input value='{{$picture[1]}}' accept=".png, .jpg" type="file" class="custom-file-input req"
                                                            id="upload_image2" />
                                                        <label class="custom-file-label ssa" for="upload_image2"
                                                            aria-describedby="upload_image2">{{$picture[1]}}</label>
                                                    </div>
                                                    <input type="hidden" name="banner" id="banner" value="{{ $picture[1] }}" />
                                                    @if($picture[1] != 'no-image.png')
                                                        <img class="mt-1" id="bannerUploaded" width="200" src="{{ config('global.STORAGE_GOOGLE').'token/'.$picture[1] }}" />
                                                    @else
                                                        <img class="mt-1" id="bannerUploaded" width="200" src="{{ config('global.STORAGE_GOOGLE').'images/error/'.$picture[1] }}" />
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="companyName">Foto Owner <span style="color: red">*</span></label>
                                                    <br>
                                                    <small style="font-size: 11px;color:grey">Max. 10 Mb, image ratio 4:4 (recomended) (.jpg / .png only)</small>
                                                    <div class="custom-file">
                                                        <input value='{{$picture[2]}}' accept=".png, .jpg" type="file" class="custom-file-input req"
                                                            id="upload_image4">
                                                        <label class="custom-file-label ssa" for="upload_image4"
                                                            aria-describedby="upload_image4">{{$picture[2]}}</label>
                                                    </div>
                                                    <input type="hidden" name="owner" id="owner" value="{{ $picture[2] }}" />
                                                    @if($picture[2] != 'no-image.png')
                                                        <img class="mt-1" id="ownerUploaded"  width="200" src="{{ config('global.STORAGE_GOOGLE').'token/'.$picture[2] }}" />
                                                    @else
                                                        <img class="mt-1" id="ownerUploaded"  width="200" src="{{ config('global.STORAGE_GOOGLE').'images/error/'.$picture[2] }}" />
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="companyName">Galeri <span style="color: red">*</span></label>
                                                    <br>
                                                    <small style="font-size: 11px;color:grey">Max. 10 Mb, image ratio 4:4 (recomended) (.jpg / .png only)</small>
                                                    <div class="custom-file">
                                                        <input value='{{$picture[3]}}' accept=".png, .jpg" type="file" class="custom-file-input req"
                                                            id="upload_image3">
                                                        <label class="custom-file-label ssa" for="upload_image3"
                                                            aria-describedby="upload_image3">{{$picture[3]}}</label>
                                                    </div>
                                                    <input type="hidden" name="galeri1" id="galeri1" value="{{ $picture[3] }}" />
                                                    @if($picture[3] != 'no-image.png')
                                                        <img class="mt-1" width="200" id="galeri1Uploaded" src="{{ config('global.STORAGE_GOOGLE').'token/'.$picture[3] }}" />
                                                    @else
                                                        <img class="mt-1" width="200" id="galeri1Uploaded" src="{{ config('global.STORAGE_GOOGLE').'images/error/'.$picture[3] }}" />
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="companyName">Galeri <span style="color: red">*</span></label>
                                                    <br>
                                                    <small style="font-size: 11px;color:grey">Max. 10 Mb, image ratio 4:4 (recomended) (.jpg / .png only)</small>
                                                    <div class="custom-file">
                                                        <input value='{{$picture[4]}}' accept=".png, .jpg" type="file" class="custom-file-input req"
                                                            id="upload_image5">
                                                        <label class="custom-file-label ssa" for="upload_image5"
                                                            aria-describedby="upload_image5">{{$picture[4]}}</label>
                                                    </div>
                                                    <input type="hidden" name="galeri2" id="galeri2" value="{{ $picture[4] }}" />
                                                    @if($picture[4] != 'no-image.png')
                                                        <img class="mt-1" width="200" id="galeri2Uploaded" src="{{ config('global.STORAGE_GOOGLE').'token/'.$picture[4] }}" />
                                                    @else
                                                        <img class="mt-1" width="200" id="galeri2Uploaded" src="{{ config('global.STORAGE_GOOGLE').'images/error/'.$picture[4] }}" />
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="companyName">Galeri <span style="color: red">*</span></label>
                                                    <br>
                                                    <small style="font-size: 11px;color:grey">Max. 10 Mb, image ratio 4:4 (recomended) (.jpg / .png only)</small>
                                                    <div class="custom-file">
                                                        <input value='{{$picture[5]}}' accept=".png, .jpg" type="file" class="custom-file-input req"
                                                            id="upload_image6">
                                                        <label class="custom-file-label ssa" for="upload_image6"
                                                            aria-describedby="upload_image6">{{$picture[5]}}</label>
                                                    </div>
                                                    <input type="hidden" name="galeri3" id="galeri3" value="{{ $picture[5] }}" />
                                                    @if($picture[5] != 'no-image.png')
                                                        <img class="mt-1" width="200" id="galeri3Uploaded" src="{{ config('global.STORAGE_GOOGLE').'token/'.$picture[5] }}" />
                                                    @else
                                                        <img class="mt-1" width="200" id="galeri3Uploaded" src="{{ config('global.STORAGE_GOOGLE').'images/error/'.$picture[5] }}" />
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="companyName">Nama Owner <span style="color: red">*</span></label>
                                                    <input required type="text" value="{{$emiten->owner_name}}" name="nama_owner"
                                                        id="companyName" class="form-control" >
                                                    <label style="margin-top: 20px" for="companyName">Harga Saham Per Lembar <span style="color: red">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                                        </div>
                                                        <input required type="text" name="harga_saham" value="{{round($emiten->price,0)}}"
                                                            class="form-control ribuan" placeholder="Harga Saham Per Lembar"
                                                            aria-describedby="basic-addon1">
                                                    </div>
                                                    <label style="margin-top: 20px" for="companyName">Perkiraan Dana yang di Butuhkan <span style="color: red">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                                        </div>
                                                        <input required type="text" value="{{round($emiten->avg_capital_needs,0)}}"
                                                            name="perkiraan_dana" class="form-control ribuan"
                                                            placeholder="Perkiraan Dana yang di Butuhkan"
                                                            aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <label for="projectinput8">Biografi Owner  <span style="color: red">*</span></label>
                                                    <textarea required id="projectinput8" rows="11" cols="100" class="form-control"
                                                        name="bio_owner"
                                                        placeholder="Biografi Owner">{{$emiten->admin_desc}}</textarea>
                                                </div>
                                                {{-- <div class="form-group col-md-4">

                                                </div> --}}
                                                {{-- <div class="form-group col-md-4">
                                                   
                                                </div> --}}


                                                {{-- <div class="form-group"> --}}
                                                    {{-- <div class="form-group row"> --}}
                                                        <div class="col-md-4">
                                                            <label for="projectinput5">Omset Tahun 2021 <span style="color: red">*</span></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                        id="basic-addon1">Rp</span>
                                                                </div>
                                                                <input required type="text"
                                                                    value="{{round($emiten->avg_annual_turnover_previous_year,0)}}"
                                                                    name="omset1" class="form-control ribuan"
                                                                    placeholder="Omset 2021"
                                                                    aria-describedby="basic-addon1">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="projectinput5">Omset Tahun 2022 <span style="color: red">*</span></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                        id="basic-addon1">Rp</span>
                                                                </div>
                                                                <input required type="text" 
                                                                    value="{{round($emiten->avg_annual_turnover_current_year,0)}}"
                                                                    name="omset2" class="form-control ribuan"
                                                                    placeholder="Omset 2022"
                                                                    aria-describedby="basic-addon1">
                                                            </div>
                                                        </div>
                                                        {{--
                                                    </div> --}}
                                                    {{--
                                                </div> --}}

                                                <div class="form-group col-md-4">
                                                    <label for="companyName">Perkiraan Saham yang di lepas ke
                                                        Umum</label>
                                                    <div class="input-group">

                                                        <input type="text" value="{{round($emiten->avg_general_share_amount,0)}}"
                                                            name="saham_dilepas" class="form-control ribuan"
                                                            placeholder="Perkiraan Saham yang di lepas ke Umum"
                                                            aria-describedby="basic-addon4">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon4">%</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="companyName">Perkiraan Omzet Setelah Jadi
                                                        Penerbit</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                                        </div>
                                                        <input type="text"
                                                            value="{{round($emiten->avg_turnover_after_becoming_a_publisher,0)}}"
                                                            name="omset_penerbit" class="form-control ribuan"
                                                            placeholder="Perkiraan Omzet Setelah Jadi Penerbit"
                                                            aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="companyName">Perkiraan Deviden Tahunan</label>
                                                    <div class="input-group">

                                                        <input type="text" value="{{round($emiten->avg_annual_dividen,0)}}"
                                                            name="deviden_tahunan" class="form-control ribuan"
                                                            placeholder="Perkiraan Deviden Tahunan"
                                                            aria-describedby="basic-addon4">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon4">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="companyName">Video Profile Perusahaan</label>
                                                    <input pattern="https?://youtu.be.+" title="Include http://youtu.be/..." type="text" 
                                                        @if($emiten->youtube != null) value="{{str_replace("www.youtube.com/embed/", "youtu.be/", $emiten->youtube)}}" @endif
                                                        id="companyName" name="video_profile" class="form-control"
                                                        placeholder="Video Profile Perusahaan">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="companyName">Alamat Website</label>
                                                    <input type="text" value="{{$emiten->website}}" id="companyName"
                                                        name="web" class="form-control" placeholder="Alamat Website">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="companyName">Facebook</label>
                                                    <input type="text" value="{{$emiten->facebook}}" id="companyName"
                                                        name="fb" class="form-control" placeholder="Facebook">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="companyName">Instagram</label>
                                                    <input type="text" value="{{$emiten->instagram}}" id="companyName"
                                                        name="ig" class="form-control" placeholder="Instagram">
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="companyName">Dynamic Link</label>
                                                    <input type="text" id="companyName"
                                                        name="dynamic_link" class="form-control" placeholder="Dynamic Link"
                                                        value="{{ $emiten->dynamic_link }}">
                                                </div>

                                                <hr />
                                                <div class="form-group col-md-12 mb-0">
                                                    <h5><strong>Identitas Calon Penerbit</strong></h5>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Kota Lokasi Usaha</label>
                                                    <div class="hidden" id="rowKota">
                                                        <select name="regency_id" id="input_kota" style="width: 100%"></select>
                                                    </div>
                                                    <div class="input-group" id="kotaEdit">
                                                        <input type="text" value="{{ $emiten->kota }}" 
                                                            class="form-control" id="regency_id2" readonly />
                                                        <span class="input-group-text cursor-pointer" id="changeKota">Ganti</span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Badan Usaha</label>
                                                    <select name="business_entity" class="form-control">
                                                        <option>Pilih Salah Satu</option>
                                                        @foreach($badanUsaha as $row)
                                                            <option @if($emiten->business_entity == $row) selected @endif value="{{ $row }}">{{ $row }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Alamat Lengkap Usaha</label>
                                                    <textarea class="form-control" name="address" rows="5" placeholder="Alamat Lengkap Usaha">
                                                        {{$emiten->address}}
                                                    </textarea>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Lama Usaha (Bulan)</label>
                                                    <input class="form-control" type="text" name="business_lifespan"
                                                        value="{{ $emiten->business_lifespan }}" />
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Jumlah Cabang</label>
                                                    <input class="form-control" type="text" name="branch_company"
                                                        value="{{ $emiten->branch_company }}" />
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Jumlah Karyawan</label>
                                                    <input class="form-control" type="text" name="employee" 
                                                        value="{{ $emiten->employee }}" />
                                                </div>

                                                <hr />
                                                <div class="form-group col-md-12 mb-0">
                                                    <h5><strong>Informasi Finansial</strong></h5>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Besar kebutuhan dana</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                                        </div>
                                                        <input type="text" name="capital_needs"
                                                            value="{{ $emiten->capital_needs }}"
                                                            class="form-control ribuan" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Rata-rata omset per bulan tahun ini</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                                        </div>
                                                        <input  type="text" name="monthly_turnover"
                                                            value="{{ $emiten->monthly_turnover }}"
                                                            class="form-control ribuan" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Rata-rata laba per bulan tahun ini</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                                        </div>
                                                        <input  type="text" name="monthly_profit"
                                                            value="{{ $emiten->monthly_profit }}"
                                                            class="form-control ribuan" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Rata-rata omset per bulan tahun sebelumnya</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                                        </div>
                                                        <input  type="text" name="monthly_turnover_previous_year"
                                                            value="{{ $emiten->monthly_turnover_previous_year }}"
                                                            class="form-control ribuan" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Rata-rata laba per bulan tahun sebelumnya</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                                        </div>
                                                        <input  type="text" name="monthly_profit_previous_year"
                                                            value="{{ $emiten->monthly_profit_previous_year }}"
                                                            class="form-control ribuan" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Total hutang bank / lembaga pembiayaan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                                        </div>
                                                        <input  type="text" name="total_bank_debt"
                                                            value="{{ $emiten->total_bank_debt }}"
                                                            class="form-control ribuan" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Nama bank / lembaga pembiayaan</label>
                                                    <input name="bank_name_financing" class="form-control" 
                                                        value="{{ $emiten->bank_name_financing }}" />
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Total modal disetor</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                                        </div>
                                                        <input  type="text" name="total_paid_capital"
                                                            value="{{ $emiten->total_paid_capital }}"
                                                            class="form-control ribuan" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>

                                                <hr />
                                                <div class="form-group col-md-12 mb-0">
                                                    <h5><strong>Informasi Non Finansial</strong></h5>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Sistem Pencatatan Keuangan</label>
                                                    <select class="form-control" name="financial_recording_system">
                                                        <option>Pilih Salah Satu</option>
                                                        @foreach($sistemPencatatan as $row)
                                                            <option @if($emiten->financial_recording_system == $row) selected @endif value="{{ $row }}">{{ $row }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Reputasi Pinjaman Bank/Lainnya</label>
                                                    <select class="form-control" name="bank_loan_reputation">
                                                        <option>Pilih Salah Satu</option>
                                                        @foreach($posisiPasar as $row)
                                                            <option 
                                                                @if($emiten->bank_loan_reputation == $row) selected @endif
                                                                value="{{ $row }}">{{ $row }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Posisi Pasar atas Produk / Jasa</label>
                                                    <select class="form-control" name="market_position_for_the_product">
                                                        <option>Pilih Salah Satu</option>
                                                        @foreach($marketPositition as $row)
                                                            <option 
                                                            @if($emiten->market_position_for_the_product == $row) selected @endif
                                                                value="{{ $row }}">{{ $row }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Strategi Kedepan</label>
                                                    <select class="form-control" name="strategy_emiten">
                                                        <option>Pilih Salah Satu</option>
                                                        @foreach($strategiEmiten as $row)
                                                            <option 
                                                            @if($emiten->strategy_emiten == $row) selected @endif
                                                                value="{{ $row }}">{{ $row }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Status Lokasi / Kantor / Tempat Usaha</label>
                                                    <select class="form-control" name="office_status">
                                                        <option>Pilih Salah Satu</option>
                                                        @foreach($statusKantor as $row)
                                                            <option value="{{ $row }}" 
                                                            @if($emiten->office_status == $row) selected @endif>{{ $row }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Tingkat Persaingan</label>
                                                    <select class="form-control" name="level_of_business_competition">
                                                        <option>Pilih Salah Satu</option>
                                                        @foreach($levelKompetisi as $row)
                                                            <option value="{{ $row }}" 
                                                            @if($emiten->level_of_business_competition == $row) selected @endif>{{ $row }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Kemampuan Manajerial</label>
                                                    <select class="form-control" name="managerial_ability">
                                                        <option>Pilih Salah Satu</option>
                                                        @foreach($kemapuanManager as $row)
                                                            <option value="{{ $row }}"
                                                            @if($emiten->managerial_ability == $row) selected @endif>{{ $row }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Kemampuan Teknis</label>
                                                    <select class="form-control" name="technical_ability">
                                                        <option>Pilih Salah Satu</option>
                                                        @foreach($kemapuanTeknis as $row)
                                                            <option value="{{ $row }}"
                                                            @if($emiten->technical_ability == $row) selected @endif>{{ $row }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <hr />
                                                <div class="form-group col-md-12 mb-0">
                                                    <h5><strong>Lampiran Dokumen</strong></h5>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Prospektus (PDF)</label>
                                                    <div class="custom-file">
                                                        <input class="custom-file-input req" name="prospektus" id="prospektus"
                                                            accept="application/pdf" type="file" />
                                                        <label class="custom-file-label ssa" id="ssa" for="inputGroupFile02" aria-describedby="inputGroupFile02">Pilih File</label>
                                                    </div>
                                                    <a target="blank" class="mt-1" href="{{ config('global.STORAGE_GOOGLE').'token/'.$emiten->prospektus }}">Lihat File</a>
                                                </div>

                                                <hr />
                                                <div class="form-group col-md-12 mb-0">
                                                    <h5><strong>Media</strong></h5>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Masukan link video tentang usaha Anda ( Youtube )</label>
                                                    <input type="text" class="form-control" name="video_url" value="{{ $emiten->video_url }}" id="video_url" />
                                                </div>


                                            </div>

                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" id="sav" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> Save
                                            </button>
                                            <?php // if( $emiten->is_verified == 1 ) : ?>
                                                {{-- <a class="btn btn-danger font-link-white"
                                                    onclick="acceptPraListing('<?= $emiten->uuid ?>','0', 'Batalkan') ">Batalkan</a>
                                                <a class="btn btn-info font-link-white"
                                                    onclick="acceptOfficial('<?= $emiten->uuid ?>','1') ">Jadikan
                                                    Penerbit Official</a> --}}
                                            <?php // else: ?>
                                                {{-- <a class="btn btn-danger-ghost <?= $emiten->is_verified == 2 || $emiten->is_verified == 1 ? 'disabled' : '' ?>"
                                                    onclick="rejectPralisting('<?= $emiten->uuid ?>','2') ">Tolak</a>
                                                <a class="btn btn-info font-link-white"
                                                    onclick="acceptPraListing('<?= $emiten->uuid ?>','1', 'Verifikasi') ">Konfirmasi
                                                    Pengajuan</a> --}}
                                            <?php // endif; ?>
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
                                {{--
                            </div>
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
                    <h5 class="modal-title">Crop Foto Owner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container" style="padding: 30px">
                        <div class="row">
                            {{-- <div class="col-md-8"> --}}
                                <img src="" id="sample_image4" />
                                {{--
                            </div>
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
                                {{--
                            </div>
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
    <div class="modal fade" id="modal5" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">


        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crop Galeri Foto/Tempat Usaha 2</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container" style="padding: 30px">
                        <div class="row">
                            {{-- <div class="col-md-8"> --}}
                                <img src="" id="sample_image5" />
                                {{--
                            </div>
                            <div class="col-md-4">
                                <div class="preview3"></div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="crop5" class="btn btn-primary">Crop</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="modal6" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">


        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crop Galeri Foto/Tempat Usaha 3</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container" style="padding: 30px">
                        <div class="row">
                            {{-- <div class="col-md-8"> --}}
                                <img src="" id="sample_image6" />
                                {{--
                            </div>
                            <div class="col-md-4">
                                <div class="preview3"></div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="crop6" class="btn btn-primary">Crop</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('public') }}/assets/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    function acceptPraListing(uuid, status, status_title) {
            Swal.fire({
                text: status_title + ' bisnis ini ? ',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    var data = {
                        uuid,
                        status
                    };
                    $.ajax({
                        url: '{{ url('admin/pralisting/accept-pralisting') }}',
                        type: 'POST',
                        dataType: "json",
                        data: data,
                        timeout: 20000,
                        beforeSend: function() {
                            $("#loader").show();
                        },
                        success: function(data) {
                            $("#loader").hide();

                            if (data.msg == 200) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Berhasil ' + status_title + ' bisnis',
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    window.location = '{{ url('admin/emiten') }}';
                                })
                            } else {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: 'Gagal ' + status_title + ' bisnis',
                                    type: 'warning',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    window.location = '{{ url('admin/emiten') }}';
                                })
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if (textStatus === "timeout" || textStatus === "error") {
                                $("#loader").hide();
                                Swal.fire({
                                    title: 'Ooops...',
                                    text: "Mohon periksa koneksi internet anda",
                                    type: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Muat ulang',
                                    cancelButtonText: 'Tutup'
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
                                })
                            }
                        },
                        complete: function() {
                            $("#loader").hide();
                        }
                    });
                }
            })
        }

        function acceptOfficial(uuid, status) {
            Swal.fire({
                text: 'Jadikan Penerbit Official ? ',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    var data = {
                        uuid,
                        status
                    };
                    $.ajax({
                        url: '{{ url('admin/pralisting/accept-official') }}',
                        type: 'POST',
                        dataType: "json",
                        data: data,
                        timeout: 20000,
                        beforeSend: function() {
                            $("#loader").show();
                        },
                        success: function(data) {
                            $("#loader").hide();

                            if (data.msg == 200) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Berhasil verifikasi bisnis',
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    window.location = '{{ url('admin/emiten') }}';
                                })
                            } else {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: 'Gagal verifikasi bisnis',
                                    type: 'warning',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    window.location = '{{ url('admin/emiten') }}';
                                })
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if (textStatus === "timeout" || textStatus === "error") {
                                $("#loader").hide();
                                Swal.fire({
                                    title: 'Ooops...',
                                    text: "Mohon periksa koneksi internet anda",
                                    type: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Muat ulang',
                                    cancelButtonText: 'Tutup'
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
                                })
                            }
                        },
                        complete: function() {
                            $("#loader").hide();
                        }
                    });
                }
            })
        }

        function rejectPralisting(uuid, status) {
            Swal.fire({
                title: "Tolak Bisnis",
                text: 'Masukan alasan penolakan bisnis',
                input: 'text',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Tolak',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                preConfirm: (input) => {
                    if (input === '') {
                        Swal.showValidationMessage('alasan penolakan tidak boleh kosong')
                    } else {
                        var data = {
                            uuid,
                            status,
                            input
                        };

                        $.ajax({
                            url: '{{ url('admin/pralisting/accept-pralisting') }}',
                            type: 'POST',
                            dataType: "json",
                            data: data,
                            timeout: 20000,
                            success: function(data) {
                                $("#loader").hide();

                                if (data.msg == 200) {
                                    Swal.fire({
                                        title: 'Berhasil',
                                        text: 'Penolakan bisnis berhasil dilakukan',
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Ok'
                                    }).then((result) => {
                                        window.location = '{{ url('admin/emiten') }}';
                                    })
                                } else {
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: 'Penolakan bisnis gagal dilakukan',
                                        type: 'warning',
                                        showCancelButton: false,
                                        confirmButtonText: 'Ok'
                                    })
                                }
                            },
                            error: function(data) {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: 'Penolakan bisnis gagal dilakukan',
                                    type: 'warning',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok'
                                })
                            }
                        });
                    }
                }

            });
        }

     $(document).ready(function() {

            $("#changeKota").on('click', function(){
                $("#kotaEdit").addClass("hidden");
                $("#rowKota").removeClass("hidden");
            });

            $("#changeCategoriBisnis").on('click', function(){
                $("#categoriEdit").addClass("hidden");
                $("#rowCategoriBisnis").removeClass("hidden");
            });

            $("#changeUserEdit").on('click', function(){
                $("#userEdit").addClass("hidden");
                $("#rowTraderEmail").removeClass("hidden");
            });

            $("#input_kota").select2({
                placeholder: "Contoh: Sleman",
                closeOnSelect: false,
                allowClear: true,
                delay: 250, // wait 250 milliseconds before triggering the request
                ajax: {
                    url: "{{ url('admin/get-regency') }}",
                    dataType: "json",
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(data) {
                        var results = [];
                        $.each(data, function(index, item) {
                            results.push({
                                id: item.id,
                                text: item.name,
                                value: item.name
                            })
                        })
                        return {
                            results: results
                        };
                    }
                }
            });
       
            $("#categoriBisnis").select2({
                placeholder: "Contoh: Transportasi, Pergudangan dan Komunikasi",
                closeOnSelect: false,
                allowClear: true,
                delay: 250, // wait 250 milliseconds before triggering the request
                ajax: {
                    url: "{{ url('admin/get-categories') }}",
                    dataType: "json",
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(data) {
                        var results = [];
                        $.each(data, function(index, item) {
                            results.push({
                                id: item.id,
                                text: item.category,
                                value: item.id
                            })
                        })
                        return {
                            results: results
                        };
                    }
                }
            });

            $("#traderEmail").select2({
                placeholder: "Contoh: user@gmail.com",
                closeOnSelect: false,
                allowClear: true,
                delay: 250, // wait 250 milliseconds before triggering the request
                ajax: {
                    url: "{{ url('admin/get-users') }}",
                    dataType: "json",
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(data) {
                        var results = [];
                        $.each(data, function(index, item) {
                            results.push({
                                id: item.id,
                                text: item.email,
                                value: item.id
                            })
                        })
                        return {
                            results: results
                        };
                    }
                }
            });
    });

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

            $('#loader').show();
    
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
                            $("#loader").hide();
                            // let text = text.replace("public/upload/", "");
                            $modal.modal('hide');
                            $('#thumbnailUploaded').attr('src', '{{config("global.STORAGE_GOOGLE")."token"}}'+'/'+data);
                            // $('#upload_image').val(data);
                            $('#thumbnail').val(data);
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
                aspectRatio: 1360/497,
                viewMode: 3,
                preview:'.preview2'
            });
        }).on('hidden.bs.modal', function(){
            cropper.destroy();
               cropper = null;
        });
    
        $('#crop2').click(function(){
            canvas = cropper.getCroppedCanvas({
                width: 1360,
                height: 497
            });

            $("#loader").show();
    
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
                            $("#loader").hide();
                            $modal2.modal('hide');
                            // let text = text.replace("public/upload/", "");
                            $('#bannerUploaded').attr('src', '{{config("global.STORAGE_GOOGLE")."token"}}'+'/'+data);
                            // $('#upload_image').val(data);
                            $('#banner').val(data);
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

            $("#loader").show();
    
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
                            $("#loader").hide();
                            $('#galeri1Uploaded').attr('src', '{{config("global.STORAGE_GOOGLE")."token"}}'+'/'+data);
                            // $('#upload_image').val(data);
                            $('#galeri1').val(data);
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

            $("#loader").show();
    
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
                            $("#loader").hide();
                            $('#ownerUploaded').attr('src', '{{config("global.STORAGE_GOOGLE")."token"}}'+'/'+data);
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
        
    
    
        var $modal5 = $('#modal5');

var image5 = document.getElementById('sample_image5');

$('#upload_image5').change(function(event){
    var files = event.target.files;

    var done = function(url){
        image5.src = url;
        $modal5.modal('show');
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

$modal5.on('shown.bs.modal', function() {
    cropper = new Cropper(image5, {
        aspectRatio: 4/3,
        viewMode: 3,
        preview:'.preview3'
    });
}).on('hidden.bs.modal', function(){
    cropper.destroy();
       cropper = null;
});

$('#crop5').click(function(){
    canvas = cropper.getCroppedCanvas({
        width:400,
        height:300
    });

    $("#loader").show();

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
                    $modal5.modal('hide');
                    $("#loader").hide();
                    $('#galeri2Uploaded').attr('src', '{{config("global.STORAGE_GOOGLE")."token"}}'+'/'+data);
                    $('#galeri2').val(data);
                    // $('#upload_image').attr('src', data);
                    // console.log(base64data);
                    // console.log(base64data);
                    // console.log(data);
                }
            });
        };
    });
});




var $modal6 = $('#modal6');

var image6 = document.getElementById('sample_image6');

$('#upload_image6').change(function(event){
    var files = event.target.files;

    var done = function(url){
        image6.src = url;
        $modal6.modal('show');
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

$modal6.on('shown.bs.modal', function() {
    cropper = new Cropper(image6, {
        aspectRatio: 4/3,
        viewMode: 3,
        preview:'.preview3'
    });
}).on('hidden.bs.modal', function(){
    cropper.destroy();
       cropper = null;
});

$('#crop6').click(function(){
    canvas = cropper.getCroppedCanvas({
        width:400,
        height:300
    });

    $("#loader").show();

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
                    $modal6.modal('hide');
                    $("#loader").hide();
                    $('#galeri3Uploaded').attr('src', '{{config("global.STORAGE_GOOGLE")."token"}}'+'/'+data);
                    $('#galeri3').val(data);
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
<script src="{{asset('public/admin')}}/app-assets/js/scripts/forms/custom-file-input.js"></script>
<script>
    $("#sav").on("click", function () {

        if ($('.ssa').html() == '-') {
            $('.req').prop('required',true);
            // console.log('sip')
            return;
        };

    });
</script>
<script src="https://cdn.jsdelivr.net/npm/cleave.js@1.5.3/dist/cleave.min.js"></script>
<script>
    document.querySelectorAll('.ribuan').forEach(inp => new Cleave(inp, {
    numeral: true,
    numeralDecimalMark: ',',
    delimiter: '.'
    }));
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://unpkg.com/dropzone"></script>
<script src="https://unpkg.com/cropperjs"></script>
{{--
<link rel="stylesheet" href="style.css" /> --}}
<link href="{{ asset('public') }}/assets/css/select2.min.css" rel="stylesheet" />

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

    .hidden {
        display: none;
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