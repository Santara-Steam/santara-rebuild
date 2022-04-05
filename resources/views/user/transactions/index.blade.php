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
                    <div class="col-12">
                        <div class="card" style="width: 100%;">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-xl-12">
                                        
                        
                                        <h1 class="card-title-member">Daftar Transaksi</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body px-1 pb-3">
                                    <ul class="nav nav-justified mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item member-nav">
                                            <a class="nav-link member-nav-link active" id="pills-tambah-tab" data-toggle="tab" href="#pills-tambah" role="tab" aria-controls="pills-tambah" aria-selected="true">
                                                <span class="d-none d-lg-block">Transaksi</span>
                                                <span class="d-lg-none">Transaksi</span>
                                            </a>
                                        </li>
                                        <li class="nav-item member-nav">
                                            <a class="nav-link member-nav-link" id="pills-data-tab" data-toggle="tab" href="#pills-data" role="tab" aria-controls="pills-data" aria-selected="false">
                                                <span class="d-none d-lg-block">Riwayat Transaksi</span>
                                                <span class="d-lg-none">Riwayat</span>
                                            </a>
                                        </li>
                                    </ul>
                        
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-tambah" role="tabpanel" aria-labelledby="pills-tambah-tab">
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="datatable-checkout" style="width:auto; border-spacing: .25rem 1em;">
                                                    <thead style="display: none;">
                                                        <tr>
                                                            <th class="border-top-0">Nama Saham</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-data" role="tabpanel" aria-labelledby="pills-data-tab">
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="datatable-invest" style="width:auto; border-spacing: .25rem 1em;">
                                                    <thead style="display: none;">
                                                        <tr>
                                                            <th class="border-top-0">Nama Saham</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
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