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
                        <div class="col-md-6 text-center card">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="card-body-account">
                                            <div class="match-height">
                                                <div class="card-account">
                                                    <a href="{{route('sso')}}" class="btn btn-lg btn-success">Izinkan akses ke Santara Chat</a>
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
