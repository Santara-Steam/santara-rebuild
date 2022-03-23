@extends('admin.layout.master')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="basic-examples">
                <div class="row">
                    <div class="col-12 mb-1">
                        <h4>Welcome {{Auth::user()->trader->name}}!</h4>
                        <p>Platform Equity Crowdfunding pertama yang berizin dan diawasi Otoritas Jasa Keuangan berdasarkan Surat Keputusan Nomor: KEP-59/D.04/2019.</p>

                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-md-12">
                        <div class="card overflow-hidden">
                            <div class="card-content">
                                <div class="card-body cleartfix">
                                    <div class="media align-items-stretch">
                                        <div class="align-self-center">
                                            <i class="icon-pencil info font-large-2 mr-2"></i>
                                        </div>
                                        <div class="media-body">
                                            <h4>Pesan Saham</h4>
                                            <span>Pesan Saham Perlu Verifikasi</span>
                                        </div>
                                        <div class="align-self-center">
                                            <h1>{{$psb}}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body cleartfix">
                                    <div class="media align-items-stretch">
                                        <div class="align-self-center">
                                            <i class="icon-speech warning font-large-2 mr-2"></i>
                                        </div>
                                        <div class="media-body">
                                            <h4>Total Comments</h4>
                                            <span>Monthly blog comments</span>
                                        </div>
                                        <div class="align-self-center">
                                            <h1>84,695</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-md-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body cleartfix">
                                    <div class="media align-items-stretch">
                                        <div class="align-self-center">
                                            <h1 class="mr-2">$76,456.00</h1>
                                        </div>
                                        <div class="media-body">
                                            <h4>Total Sales</h4>
                                            <span>Monthly Sales Amount</span>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="icon-heart danger font-large-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body cleartfix">
                                    <div class="media align-items-stretch">
                                        <div class="align-self-center">
                                            <h1 class="mr-2">$36,000.00</h1>
                                        </div>
                                        <div class="media-body">
                                            <h4>Total Cost</h4>
                                            <span>Monthly Cost</span>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="icon-wallet success font-large-2"></i>
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