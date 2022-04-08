@extends('admin.layout.master')
@section('content')
<style>
    .card-saldo {
        height: 150px;
    }
</style>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-body card-saldo">
                            <h4 class="text-center">Asset Balance</h4>
                            <span class="text-center">Asset balance adalah gabungan dari saldo rupiah dan total saham yang anda milki.</span>
                            <h2 class="text-primary text-center mt-2">
                                <b class="label-font">Rp. 0</b>
                            </h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-body card-saldo">
                            <h4 class="text-center">Saldo Rupiah</h4>
                            <span class="text-center">Saldo rupiah diambil dari dana deposit anda.</span>
                            <h2 class="text-primary text-center mt-2">
                                <b class="label-font">Rp. 0</b>
                            </h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card card-body">
                            <h4 class="text-center">Anda belum mempunyai saham</h4>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection