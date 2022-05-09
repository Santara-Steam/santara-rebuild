@extends('user.layout.master')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-6 text-center card">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="card-body-account">
                                        <div class="match-height">
                                            <div class="card-account">
                                                <img class="img-fluid logo-password" src="https://storage.googleapis.com/asset-santara/santara.co.id/images/content/account/password.png"
                                                        alt=" Security Token Info" width="40%">
                        
                                                
                        
                                                <div style="text-align:center">
                                                    <h3 class="form-account-title"><b>Buat security token <br />untuk keamanan akun Anda</b></h3>
                                                </div>
                                                <p>Masukan kode 6 angka sebagai security token akun anda.</p>
                        
                                                <form class="form" action="{{url('pin_post')}}" method="POST"
                                                    enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <input type="text" hidden value="{{Auth::user()->id}}" name="userid">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text form-icon"><i class="la la-unlock"></i></span>
                                                            </div>
                                                            <input type="password" class="form-control required-form" name="pin" placeholder="Secuity Pin" maxlength="6" id="pin"  required>
                                                        </div>
                                                        <span id="pin_error" class="font-danger text-left"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text form-icon"><i class="la la-unlock"></i></span>
                                                            </div>
                                                            <input type="password" class="form-control required-form" name="cpin" placeholder="Konfirmasi Secuity Pin" maxlength="6" id="confirm_pin" required>
                                                        </div>
                                                        <span id="confirm_pin_error" class="font-danger text-left"></span>
                                                    </div>
                        
                                                    {{-- <button class="btn btn-santara-red btn-account submit-form" id="btnSubmitSecurity" type="submit" style="width:100%">
                                                        <span id="submit_text">Buat Security Pin</span>
                                                    </button> --}}
                                                    <button class="btn btn-primary" type="submit">Simpan</button>
                        
                                                </form>
                                            </div>
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

@endsection
@section('style')

@endsection