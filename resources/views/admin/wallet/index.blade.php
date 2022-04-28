@extends('admin.layout.master')
@section('content')
<style>
    .card-saldo {
        height: 180px;
    }
    .card-saldo2 {
        height: 190px;
    }
    .mt-minus {
        margin-top: -20px;
    }
</style>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-saldo2">
                            <div class="card-body">
                                <h4 class="text-center"><strong>Investasi</strong></h4>
                                <span class="text-center">Total semua investasi yang dilakukan oleh user.</span>
                            </div>
                            <div class="card-footer">
                                <h2 class="text-primary text-center">
                                    <b class="label-font"><?= rupiah($transaksi) ?></b>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-saldo2">
                            <div class="card-body">
                                <h4 class="text-center"><strong>Saldo Rupiah</strong></h4>
                                <span class="text-center">Saldo rupiah diambil dari dana deposit anda.</span>
                            </div>
                            <div class="card-footer">
                                <h2 class="text-primary text-center">
                                    <b class="label-font"><?= rupiah($saldo) ?></b>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-saldo">
                            <div class="card-body">
                                <h4 class="text-center"><strong>Asset Balance</strong></h4>
                                <span class="text-center">Asset balance adalah gabungan dari saldo rupiah dan total saham yang anda milki.</span>
                            </div>
                            <div class="card-footer">
                                <h2 class="text-primary text-center">
                                    <b class="label-font"><?= rupiah(($saldo + $transaksi)) ?></b>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection