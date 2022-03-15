@extends('front_end/template_front_end/app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/new-santara/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/new-santara/css/style.css?v=5.8.8') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/new-santara/css/login.css?v=5.8.8') }}" />

    <div class="container">
        <div class="row d-flex align-content-center justify-content-center flex-wrap row-login">
            <div class="col-md-10">
                <div class="row card-body-login">
                    <div class="row card col-md-5 d-flex align-content-center justify-content-center flex-wrap text-center p-4 img-login">
                        <div class="row d-flex align-content-center justify-content-center flex-wrap text-center">
                            <img src="{{ asset('public/new-santara/img/logo/santara-black.svg') }}" alt="logo santara" style="max-width: 140px;" />
                            <p class="ff-m fs-12 c-abu mt-2">Equity Crowdfunding Indonesia</p>
                        </div>
                        <div class="row">
                            <img src="{{ asset('public/new-santara/img/login-dulu.svg') }}" alt="login" />
                        </div>
                    </div>
                    <div class="row col-md-7 d-flex align-content-center justify-content-center flex-wrap  bg-login row-form-login p-3">
                        <p class="fs-24 ff-m text-center"><b>Login</b></p>
                        <div class="row mt-3">

                            <div class="col-md-12">
                                <form class="form-login" id="form_login" method="POST" action="{{ route('login') }}">
                                @csrf
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        </div>

                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
                                        </div>
                                    </div>
                                    <div class="row m-0 mt-4">
                                        <button class="btn btn-danger" type="submit">
                                            <span class="btnLabel">Masuk</span>
                                        </button>

                                    </div>
                                    <div class="row fs-11 ff-m mt-2">
                                        <div class="col-6 d-flex align-content-start float-start">
                                            
                                        </div>
                                        <div class="row col-lg-6 d-flex align-content-end text-end">
                                            <p style="font-size: 12px;">Belum punya akun? <a class="link" href="{{ route('register') }}">&ensp; Daftar</a></p>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection