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
                                    <h1 class="card-title-member">Summary KYC</h1>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements"></div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="col-xl-12 col-md-12 my-3">
                                            <div class="count-status-container">
                                                <div>
                                                    <div class="count" style="color: #000000">
                                                        <?= $status->countBelumKyc ?></div>
                                                    <div class="status">Belum KYC</div>
                                                </div>
                                                <div>
                                                    <div class="count" style="color: #666EE8">
                                                        <?= $status->countPembaruanData ?></div>
                                                    <div class="status">Pembaruan Data</div>
                                                </div>
                                                <div>
                                                    <div class="count" style="color: #EEAA5B">
                                                        <?= $status->countMenungguVerifikasi ?></div>
                                                    <div class="status">Menunggu Verifikasi</div>
                                                </div>
                                                <div>
                                                    <div class="count" style="color: #BF2D30">
                                                        <?= $status->countDitolak ?></div>
                                                    <div class="status">Ditolak</div>
                                                </div>
                                                {{-- <div>
                                                    <div class="count" style="color: #EEAA5B">
                                                        <?= $status->countMenungguVerifikasiKustodian ?></div>
                                                    <div class="status">Menunggu Verifikasi Kustodian</div>
                                                </div>
                                                <div>
                                                    <div class="count" style="color: #BF2D30">
                                                        <?= $status->countDitolakKustodian ?></div>
                                                    <div class="status">Ditolak Kustodian</div>
                                                </div> --}}
                                                <div>
                                                    <div class="count" style="color: #0E7E4A">
                                                        <?= $status->countTerverifikasi ?></div>
                                                    <div class="status">Terverifikasi</div>
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
