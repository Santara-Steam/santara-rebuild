@extends('user.layout.master')
@section('content')

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="configuration">

                <div class="match-height">
                    
                    <link rel="stylesheet" type="text/css"
                        href="https://old.santara.co.id/assets/css/member/penerbit.css?v=5.8.8">

                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="card-content row m-0">
                                    
                                    <div class="col-md-2 p-0">
                                        <img class="penerbit-detail-item-img lazyload img-fluid"
                                            src="<?= $emiten->pictures[0]->picture; ?>"
                                            onerror="this.onerror=null;this.src='{{env('STORAGE_GOOGLE')}}images/error/no-image.png';"
                                            alt="nama bisnis">
                                    </div>
                                    <div class="col-md-4 content-center pl-2">
                                        <div>
                                            <h2><b>
                                                    <?= $emiten->trademark; ?>
                                                </b></h2>
                                            <div>
                                                <?= $emiten->company_name; ?>
                                                <span class="ml-2"><i class="la la-tag"></i>
                                                    <?= $emiten->category; ?>
                                                </span>
                                            </div>
                                            <div class="penerbit-info mt-2">
                                                <p>
                                                    <?=  month(date('Y-m-d',strtotime($emiten->begin_period))); ?>
                                                </p>
                                            </div>
                                            <div>
                                                <a href="{{url('/edit_bisnis')}}/<?= $emiten->id; ?>" class="btn btn-warning btn-block">Edit Bisnis</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 content-center text-center">
                                        <div>
                                            <p>Periode Dividen</p>
                                            <h3><b>
                                                    <?= $emiten->period; ?>
                                                </b></h3>
                                        </div>
                                    </div>
                                    <div class="col-md-3 content-center text-center">
                                        <div>
                                            <p>Total Investor</p>
                                            <h3><b>
                                                    <?= $emiten->investors; ?>
                                                </b></h3>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> --}}

                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="card-content">
                                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link penerbit-nav-link active" id="profil-tab"
                                                data-toggle="tab" href="#profil" role="tab" aria-controls="profil"
                                                aria-selected="true">Profil</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link penerbit-nav-link" id="laporan-tab" data-toggle="tab"
                                                href="#laporan" role="tab" aria-controls="laporan"
                                                aria-selected="false">Laporan Keuangan</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link penerbit-nav-link" id="rencana-tab" data-toggle="tab"
                                                href="#rencana" role="tab" aria-controls="rencana"
                                                aria-selected="false">Rencana Penggunaan Dana</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="profil" role="tabpanel"
                                            aria-labelledby="profil-tab">
                                            {{--
                                            <?php $this->load->view( 'member/penerbit/_detail/profil' ); ?> --}}

                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="card-content m-0">
                                                        <div class="col-md-12 row">
                                                            <div class="col-4 p-0 text-center">
                                                                <img class="penerbit-detail-item-img lazyload"
                                                                    src="<?= $emiten->pictures[0]->picture; ?>"
                                                                    onerror="this.onerror=null;this.src='{{env('STORAGE_GOOGLE')}}images/error/no-image.png';"
                                                                    alt="nama bisnis">
                                                            </div>
                                                            <div class="col-8">
                                                                <div class="row px-2 py-1 content-center">
                                                                    <div class="col-2">
                                                                        <img class="rounded-circle lazyload"
                                                                            style="width: 5rem;height: 5rem;object-fit: cover;"
                                                                            src="{{config('global.STORAGE_BUCKET2')."kyc/".str_replace('/uploads/trader/', "",Auth::user()->trader->photo)}}"
                                                                        onerror="this.onerror=null;this.src='{{env('STORAGE_GOOGLE')}}images/error/no-image.png';"
                                                                        alt="nama bisnis">
                                                                    </div>
                                                                    <div class="col-10">
                                                                        <h5>Bisnis Milik</h5>
                                                                        <h2><b>
                                                                                <?= $emiten->name; ?>
                                                                            </b></h2>
                                                                    </div>
                                                                </div>
                                                                <hr style="width: 90%" />
                                                                <div class="py-1 px-2">
                                                                    <div class="progress-bar bg-gradient-x-warning <?= ( $progress < 100) ? 'progress-bar-animated' : ''; ?>"
                                                                        role="progressbar"
                                                                        style="width: <?= $progress; ?>%;"
                                                                        aria-valuenow="80" aria-valuemin="0"
                                                                        aria-valuemax="100">
                                                                        <b style="color: blue;">
                                                                            <?= ( $progress < 100) ? $progress : 100; ?>
                                                                            %
                                                                        </b>
                                                                    </div>
                                                                    <div class="row p-1">
                                                                        <div class="col-md-6 p-0">
                                                                            <h6 class="penerbit-diff">Sisa waktu
                                                                                <span class="red-santara" ?>
                                                                                    <?= $sisa_waktu ?> -
                                                                                    <?= $emiten->investors; ?> Investor
                                                                                </span>
                                                                            </h6>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <h5><b>Dana Terkumpul</b></h5>
                                                                        <h2><b>Rp
                                                                                <?= number_format( $emiten->price * $emiten->terjual, 0, ',', '.' ); ?>
                                                                            </b> <small>dari target</small> <b>Rp
                                                                                <?= number_format( $emiten->price * $emiten->supply, 0, ',', '.' ); ?>
                                                                            </b></h2>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3 col-md-12">
                                                            <div class="nav-tabs-responsive penerbit-nav">
                                                                <ul class="nav nav-tabs nav-justified">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link penerbit-nav-link active"
                                                                            data-toggle="tab" href="#info">Informasi
                                                                            Saham</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link penerbit-nav-link"
                                                                            data-toggle="tab" href="#detail">Detail
                                                                            Saham</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link penerbit-nav-link"
                                                                            data-toggle="tab" href="#about">Tentang
                                                                            Penerbit</a>
                                                                    </li>
                                                                    <?php if(false): ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link penerbit-nav-link"
                                                                            data-toggle="tab"
                                                                            href="#finance">Finansial</a>
                                                                    </li>
                                                                    <?php endif; ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link penerbit-nav-link"
                                                                            data-toggle="tab" href="#address">Lokasi</a>
                                                                    </li>
                                                                </ul>

                                                                <div class="tab-content">
                                                                    <div class="tab-pane fade show active" id="info">
                                                                        <div class="row py-3 px-0">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail"
                                                                                        class="col-sm-4 col-form-label">Saham
                                                                                        Tersisa</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" readonly
                                                                                            class="form-control-plaintext"
                                                                                            id="staticEmail"
                                                                                            value="<?= $info->tersisa_percentage ?>%">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail"
                                                                                        class="col-sm-4 col-form-label">Dalam
                                                                                        Lembar</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" readonly
                                                                                            class="form-control-plaintext"
                                                                                            id="staticEmail"
                                                                                            value="<?= $info->tersisa_total ?> Lembar">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail"
                                                                                        class="col-sm-4 col-form-label">Dalam
                                                                                        Rupiah</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" readonly
                                                                                            class="form-control-plaintext"
                                                                                            id="staticEmail"
                                                                                            value="Rp <?= $info->tersisa_total_rp ?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail"
                                                                                        class="col-sm-4 col-form-label">Saham
                                                                                        Terjual</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" readonly
                                                                                            class="form-control-plaintext"
                                                                                            id="staticEmail"
                                                                                            value="<?= $info->terjual_percentage ?>%">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail"
                                                                                        class="col-sm-4 col-form-label">Dalam
                                                                                        Lembar</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" readonly
                                                                                            class="form-control-plaintext"
                                                                                            id="staticEmail"
                                                                                            value="<?= $info->terjual_total ?> Lembar">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail"
                                                                                        class="col-sm-4 col-form-label">Dalam
                                                                                        Rupiah</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" readonly
                                                                                            class="form-control-plaintext"
                                                                                            id="staticEmail"
                                                                                            value="Rp <?= $info->terjual_total_rp ?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="detail">
                                                                        <div class="row py-3 px-0">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail"
                                                                                        class="col-sm-4 col-form-label">Kode
                                                                                        Saham</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" readonly
                                                                                            class="form-control-plaintext"
                                                                                            id="staticEmail"
                                                                                            value="<?= $emiten->code_emiten; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail"
                                                                                        class="col-sm-4 col-form-label">Harga
                                                                                        Saham</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" readonly
                                                                                            class="form-control-plaintext"
                                                                                            id="staticEmail"
                                                                                            value="Rp <?= number_format( $emiten->price, 0, ',', '.' ); ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail"
                                                                                        class="col-sm-4 col-form-label">Total
                                                                                        Saham</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" readonly
                                                                                            class="form-control-plaintext"
                                                                                            id="staticEmail"
                                                                                            value="<?= number_format( $emiten->supply, 0, ',', '.' ); ?> Lembar">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail"
                                                                                        class="col-sm-4 col-form-label">Total
                                                                                        Saham (Rp)</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" readonly
                                                                                            class="form-control-plaintext"
                                                                                            id="staticEmail"
                                                                                            value="Rp <?= number_format( $emiten->supply * $emiten->price, 0, ',', '.' ); ?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="about">
                                                                        <div class="col-md-12 row px-2 py-3">
                                                                            <div class="col-2 p-0 text-center">
                                                                                <img class="penerbit-detail-item-img rounded-circle lazyload"
                                                                                    style="width: 10rem;height: 10rem;object-fit: cover;"
                                                                                    src="{{config('global.STORAGE_BUCKET2')."kyc/".str_replace('/uploads/trader/', ""
                                                                                    ,Auth::user()->trader->photo)}}"
                                                                                onerror="this.onerror=null;this.src='{{env('STORAGE_GOOGLE')}}images/error/no-image.png';"
                                                                                alt="nama bisnis">
                                                                            </div>
                                                                            <div class="col-10">
                                                                                <h3><b>Profil
                                                                                        <?= $emiten->name; ?>
                                                                                    </b></h3>
                                                                                <div class="penerbit-info my-3">
                                                                                    <p>
                                                                                        <?= $emiten->bio; ?>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php if(false): ?>
                                                                    <div class="tab-pane fade" id="finance">
                                                                        <div class="row">
                                                                            <canvas id="myChart" width="400"
                                                                                height="200"></canvas>
                                                                        </div>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                    <div class="tab-pane fade" id="address">
                                                                        <div class="row p-1">
                                                                            <iframe class="detail-bisnis-map"
                                                                                style="margin: 0 auto;border:0;"
                                                                                width="100%" height="450"
                                                                                frameborder="0"
                                                                                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAH8huBYsYFY4YrsqB3HtW-2y57IWjydG0&q=<?= $emiten->latitude; ?>,<?= $emiten->longitude; ?>"
                                                                                allowfullscreen>
                                                                            </iframe>
                                                                        </div>
                                                                        <div>
                                                                            <p>
                                                                                <?= $emiten->address; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="laporan" role="tabpanel"
                                            aria-labelledby="laporan-tab">
                                            {{--
                                            <?php $this->load->view( 'member/penerbit/_detail/laporan' ); ?> --}}

                                            <div class="card-content">
                                                <input type="hidden" id="uuid" value="<?= $uuid ?>" />
                                                <input type="hidden" id="trademark"
                                                    value="<?= $emiten->trademark; ?>" />

                                                <div class="card-body">
                                                    <?php if(!$last_report) : ?>
                                                    <div class="card-content m-0">
                                                        <div
                                                            class="alert alert-info-dashboard penerbit-info-report col-md-12">
                                                            <h4><b>Anda belum membuat laporan keuangan</b></h4>
                                                            <p>Segera buat laporan keuangan Anda. </p>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                    <div class="card-content py-2">
                                                        <div class="content-center">
                                                            <span class="title-left"><b>Laporan Keuangan
                                                                    Terakhir</b></span>
                                                            <a type="button" class="btn btn-sm btn-info title-right"
                                                                target="_blank" href="<?= $tutorial; ?>">
                                                                <span class="menu-title" data-i18n="">Tutorial Pembuatan
                                                                    Laporan</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php if($last_report) : ?>
                                                    <div class="card-content mt-1 mx-1 border border-light p-1 row">
                                                        <div class="col-md-3 content-center text-center">
                                                            <div>
                                                                <p>Tanggal Upload</p>
                                                                <h3><b>
                                                                        <?= ($last_report['updated_at']) ? month(date('Y-m-d',strtotime($last_report['updated_at']))) : '-'; ?>
                                                                    </b></h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 content-center text-center">
                                                            <div>
                                                                <p>Sales Revenue</p>
                                                                <h3><b>Rp.
                                                                        <?= number_format( $last_report['sales_revenue'], 0, ',', '.' ); ?>
                                                                    </b></h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 content-center text-center">
                                                            <div>
                                                                <p>Net Income</p>
                                                                <h3><b>Rp.
                                                                        <?= number_format( $last_report['net_income'], 0, ',', '.' ); ?>
                                                                    </b></h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 content-center text-center">
                                                            <div>
                                                                <p>
                                                                    <?php if($last_report['finance_report']): ?>
                                                                    <a href="<?= $last_report['finance_report']; ?>"
                                                                        title="unduh" target="_blank">Lihat Laporan
                                                                        Keuangan</a>
                                                                    <?php else: ?>
                                                                    Belum ada laporan keuangan
                                                                    <?php endif; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="card-content m-0 row">
                                                        <div class="col-md-3">
                                                            {{-- <form method="post"
                                                                action="{{url('user/laporan-keuangan/detail')}}/<?= $uuid ?>">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="report" value="created" />
                                                                <button type="submit"
                                                                    class="btn btn-santara-red btn-block">
                                                                    <span class="menu-title" data-i18n="">Buat Laporan
                                                                        Keuangan</span>
                                                                </button>
                                                            </form> --}}
                                                            <a href="{{url('user/laporan-keuangan/detail')}}/<?= $uuid ?>" type="submit"
                                                                    class="btn btn-santara-red btn-block">
                                                                    <span class="menu-title" data-i18n="">Buat Laporan
                                                                        Keuangan</span>
                                                                </a>

                                                        </div>

                                                        <div class="col-md-9">
                                                            <button type="submit"
                                                                onclick="getlastReport('<?= $uuid ?>')"
                                                                class="btn btn-santara-white btn-block"
                                                                <?=($last_report==null) ? 'disabled' : '' ; ?>>
                                                                <span class="menu-title" data-i18n="">Buat Laporan
                                                                    Keuangan berdasar laporan terakhir</span>
                                                            </button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <?php if($data) : ?>
                                                    <div class="card-content m-0 p-1 row">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover dataTable-table"
                                                                id="datatable" style="width: 100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="border-top-0">No</th>
                                                                        <th class="border-top-0">ID Laporan</th>
                                                                        <th class="border-top-0">Versi</th>
                                                                        <th class="border-top-0">Periode</th>
                                                                        <th class="border-top-0">Status</th>
                                                                        <th class="border-top-0">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <?php else: ?>
                                                    <div class="card-content text-center p-3">
                                                        <img src="{{env('STORAGE_GOOGLE')}}assets/images/content/finance-empty.png"
                                                            class="mb-2">
                                                        <h3><b>Belum Ada Laporan Keuangan</b></h3>
                                                        <p>Anda belum memiliki laporan keuangan</p>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div id="modalDesc" class="modal fade" role='dialog'>
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body" id="modal-body">
                                                            <p id="status_desc"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Modal ends here--->




                                        </div>
                                        <div class="tab-pane fade" id="rencana" role="tabpanel"
                                            aria-labelledby="rencana-tab">
                                            {{--
                                            <?php $this->load->view( 'member/penerbit/_detail/rencana' ); ?> --}}
                                            <input type="hidden" id="trademark" value="<?= $emiten->trademark; ?>"/>

<div class="card-content">
    <div class="card-body">
        <?php if($data == null) : ?>
        <div class="card-content m-0">   
            <div class="alert alert-info-dashboard penerbit-info-report col-md-12">
                <h4><b>Anda belum memasukan rencana penggunaan dana.</b></h4>
                <p>Segera buat rencana penggunaan dana.</p>
            </div>
        </div>
        <?php endif; ?>
        <div class="card-content py-2">
            <div class="content-center">
                <span class="title-left">
                    <b>
                    <div class="card-body total-rencana">
                        <div><span>Total (Total seluruh rencana)</span></div>
                        <div class="total-rencana-text"><?= 'Rp. ' . number_format( isset($data['total']) ? $data['total'] : 0 , 0, ',', '.' ) ?></div>
                    </div>
                    </b>
                </span>
                <a type="button" class="btn btn-sm btn-info title-right" target="_blank" href="<?= $tutorial; ?>">
                    <span class="menu-title" data-i18n="">Tutorial Pembuatan Laporan</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card-content">
    <div class="card-body">
        <form id="formSubmitPlan" enctype="multipart/form-data">
        <input type="hidden" id="emiten_uuid" name="emiten_uuid" value="<?= $uuid; ?>"/>

        <div class="card-content m-0">  
            <div class="col-md-12">

                <?php if ($data == null) : ?>
                <input type="hidden" id="tabID" value="1" />

                <!-- Nav tabs -->
                <div class="row">
                <ul id="tab-list" class="nav nav-tabs" role="tablist" style="border-radius: unset;">
                    <li class="nav-item active">
                        <a class="nav-link tab-penerbit-detail active" 
                            id="profil-tab" data-toggle="tab" href="#tab1" 
                            role="tab" aria-controls="tab" aria-selected="true" > 
                            <div><b>nama rencana <button class="close" type="button" title="Remove this page">×</button> </b></div>
                            <div style="line-height:1;">
                                <div><small>Subtotal</small></div>
                                <div>Rp. 0</div>
                            </div>
                        </a>
                    </li>                
                </ul>
                <button id="btn-add-tab" type="button" class="btn btn-santara-white pull-right ml-1" style="font-size: 3rem;padding: 0;border: none;" onClick="addTabPlan()"><i class="la la-plus-square"></i></button>
                </div>

                <!-- Tab panes -->
                <div id="tab-content" class="tab-content">
                    <div class="tab-pane row fade show active" id="tab1">
                        <div class="row my-2">
                            <div class="form-group col-md-4">
                                <label>Nama Rencana</label>
                                <input type="text" class="form-control" name="list_fund_plans[1][name]" maxlength="40" 
                                    placeholder="Masukan nama rencana"/>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tab_rencana_1">
                                <thead>
                                    <tr>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Nilai</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id='rencana_addr_1_1'></tr>                          
                                </tbody>
                                </table>
                                <div class="justify-content-between row col-12">
                                    <a class="btn btn-santara-white col-2" onclick="addReportPlan(1,1)">Tambah Baris</a>
                                    <input type="text" class="form-control col-4" name="list_fund_plans[1][subtotal]" id="subtotal_1" />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="form-group col-md-12">
                            <label>Deskripsi</label>
                            <textarea class="form-control required-form" rows="7" cols="50" name="list_fund_plans[1][desc]" id="deskripsi" placeholder="Tuliskan biografi singkat pemilik usaha"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                    <input type="hidden" id="tabID" value="<?= count($data['list_fund_plans']); ?>" />

                    <!-- Nav tabs -->
                    <div class="row">
                    <ul id="tab-list" class="nav nav-tabs" role="tablist" style="border-radius: unset;">
                    <?php if( $data['list_fund_plans'] ) : ?>
                    <?php foreach($data['list_fund_plans'] as $key => $value): ?>
                        <li class="nav-item <?= ($key == 0 ) ? 'active' : ''?> ">
                        <a class="nav-link tab-penerbit-detail <?= ($key == 0 ) ? 'active' : ''?>" 
                            id="profil-tab" data-toggle="tab" href="#tab<?= $key ?>" 
                            role="tab" aria-controls="tab" aria-selected="true" > 
                            <div><b><?= $value['name'] ?> <button class="close" type="button" title="Remove this page">×</button> </b></div>
                            <div style="line-height:1;">
                                <div><small>Subtotal</small></div>
                                <div><?= 'Rp. ' . number_format(  $value['total'], 0, ',', '.' ) ?></div>
                            </div>
                        </a>
                        </li>
                    <?php endforeach; ?>
                    <?php endif; ?>

                    </ul>
                    <button id="btn-add-tab" type="button" class="btn btn-santara-white pull-right ml-1" style="font-size: 3rem;padding: 0;border: none;" onClick="addTabPlan()"><i class="la la-plus-square"></i></button>
                    </div>

                    <!-- Tab panes -->
                    <div id="tab-content" class="tab-content">
                        <?php if( $data['list_fund_plans'] ) : ?>

                        <?php foreach($data['list_fund_plans'] as $key => $value): ?>
                        <div class="tab-pane row fade <?= ($key == 0 ) ? 'show active' : ''?>" id="tab<?= $key ?>">
                            <div class="row my-2">
                                <div class="form-group col-md-4">
                                    <label>Nama Rencana</label>
                                    <input type="text" class="form-control" name="list_fund_plans[<?= $key; ?>][name]" maxlength="40" value="<?= $value['name']; ?>"/>
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tab_rencana_<?= $key; ?>">
                                    <thead>
                                        <tr>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Nilai</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php 
                                        $no = 0;
                                        foreach($value['sublist'] as $k => $v) : ?>
                                        <tr id='rencana_addr_<?= $key; ?>_<?= $k; ?>'>
                                            <td width="65%">
                                                <input type="text" name='list_fund_plans[<?= $key; ?>][sublist][<?= $k; ?>][desc]' value="<?= $v['desc']; ?>" class="form-control"/>
                                            </td>
                                            <td width="30%">
                                                <input type="text" name='list_fund_plans[<?= $key; ?>][sublist][<?= $k; ?>][amount]' value="<?= number_format( $v['amount'], 0, ',', '.' ); ?>" class="form-control amount_<?= $key; ?>" onkeyup="subTotal(<?= $key; ?>)"/>
                                            </td>
                                            <td width='5%'><a class='pull-right btn btn-santara-white' onclick='removeReportPlan("<?= $key ?>","<?= $k ?>")'><i class='la la-times'></i></a></td>
                                        </tr>
                                        
                                        <?php 
                                        $no = $k + 1;
                                        endforeach; ?>
                                        <tr id='rencana_addr_<?= $key; ?>_<?= $no; ?>'></tr>                          
                                    </tbody>
                                    </table>
                                    <div class="justify-content-between row col-12">
                                        <a class="btn btn-santara-white col-2" onclick="addReportPlan(<?= $key; ?>,<?= $no; ?>)">Tambah Baris</a>
                                        <input type="text" class="form-control col-4" value="<?= number_format( $value['total'] , 0, ',', '.' ); ?>" id="subtotal_<?= $key; ?>" name="list_fund_plans[<?= $key; ?>][subtotal]"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="form-group col-md-12">
                                <label>Deskripsi</label>
                                    <textarea class="form-control required-form" rows="7" cols="50" name="list_fund_plans[<?= $key; ?>][desc]" id="deskripsi"><?= isset($value['desc']) ? $value['desc'] : ''; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>               
                    </div>     
                <?php endif; ?>

            </div>            
        </div>
        <div class="card-content mt-2">  
            <div class="row">
                <div class="text-left col-md-6 mb-1">
                    <a class="btn btn-santara-white btn-block" href="javascript:window.history.go(-1);">Kembali</a>
                </div>
                <div class="text-right col-md-6 mb-1">
                    <button type="button" class="btn btn-santara-red btn-block"  onClick="submitPlan('<?= $type ?>')">Simpan</button>
                </div>
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
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
                    <script src="https://old.santara.co.id/assets/js/member/penerbit.js?v=5.8.8"></script>
                   
                </div>
            </section>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="{{asset('public/admin')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{asset('public/admin')}}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"
    integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function showDesc(val){
            document.getElementById("status_desc").innerHTML = val;
            $("#modalDesc").modal("show");
        };
        
        $(document).ready(function(){
            var uuid = document.getElementById('uuid').value;
        
        
            $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
                return {
                    "iStart": oSettings._iDisplayStart,
                    "iEnd": oSettings.fnDisplayEnd(),
                    "iLength": oSettings._iDisplayLength,
                    "iTotal": oSettings.fnRecordsTotal(),
                    "iFilteredTotal": oSettings.fnRecordsDisplay(),
                    "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                    "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                };
            };
        
            var table = $("#datatable").DataTable({
                buttons: [
                    'print', 'csv'
                ],
                initComplete: function () {
                    var api = this.api();
                    $('#mytable_filter input')
                        .off('.DT')
                        .on('keyup.DT', function (e) {
                            if (e.keyCode == 13) {
                                api.search(this.value).draw();
                            }
                        });
                },
                search: {
                    "caseInsensitive": false
                },                            
                scrollX: true,
                oLanguage: {
                    sProcessing: '<div id="tableloading" class="tableloading"></div>',
                    sZeroRecords: 'Data tidak tersedia'
                },
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{url('user/penerbit/get_riwayat_laporan_keuangan')}}/{{$uuid}}",
                    "type": "POST",
                    "data": function(data){
                        data.filter = $('#filter').val();
                        data.trademark = $('#trademark').val();
                    }
                },
                order: [[0, 'desc']],
                columnDefs: [
                    {"targets": [1,2,3,4,5], "orderable": false},
                ],
                rowCallback: function (row, data, iDisplayIndex) {
                    var info = this.fnPagingInfo();
                    var page = info.iPage;
                    var length = info.iLength;
                    var index = page * length + (iDisplayIndex + 1);
                    $('td:eq(0)', row).html(index);
                }
            });    
            
            $('#filter').change(function(){
                table.draw();
            });        
        
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                table.columns.adjust().oScroller.fnMeasure();
            });                   
        });
        
        function getlastReport(uuid) {
    $.ajax({
        url: "{{url('user/laporan-keuangan/getLastReport/')}}/"+uuid,
        type: 'GET',
        dataType: "json",
        cache: false,
        async: true,
        processData: false,
        contentType: false,
        success: function(data) {
            var msg = data.msg;
            if (msg == 200) {
                $("#loader").show();
                let timerInterval;
                Swal.fire({
                    title: "Laporan terakhir",
                    html: 'mohon tunggu <b></b> ',
                    timer: 20000,
                    timerProgressBar: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading()
                        timerInterval = setInterval(() => {
                        const content = Swal.getContent()
                        if (content) {
                            const b = content.querySelector('b')
                            if (b) {
                            b.textContent = Swal.getTimerLeft()
                            }
                        }
                        }, 100)
                    },
                    onClose: () => {
                        clearInterval(timerInterval)
                    }
                    }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        $("#loader").hide();
                        window.location.href = "{{url('user/laporan-keuangan/detail')}}/" + uuid + '/' + data.id;
                    }
                })

            } else {
                Swal.fire("Error!", msg, "error");
            }
        },
        error: function(data) {
            var msg = data.msg;
            $("#loader").hide();
            Swal.fire("Error!", msg, "error");
        }
    });
};

function deleteReport(id, uuid){
    Swal.fire({
        html: 'Yakin menghapus data laporan ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {

        if (result.value) {
            $("#loader").show();
            var data = {id,uuid};
            $.ajax({
                type: 'POST',
                url: "{{url('user/laporan-keuangan/delete')}}",
                cache: false,
                data: data,
                success: function(data) {
                    $("#loader").hide();
                    const anchor = window.location.hash;                        

                    data = JSON.parse(data);
                    if (data.msg == 200) {
                        Swal.fire("Success!", 'Data berhasil dihapus.', "success").then((result) => {
                            location.reload();                    
                        });
                    }else{
                        Swal.fire("Error!", "Data gagal dihapus!", "error");    
                    }
                },
                error: function(msg) {
                    $("#loader").hide();
                    Swal.fire("Error!", "Data gagal dihapus!", "error");
                }
            });
        }
    })    

    return true;
}
        
</script>

<script>
    var button='<button class="close" type="button" title="Remove this page">×</button>';
    
    var tab_obj = {};
    $(document).ready(function() {    
        $('#tab-list').on('click', '.close', function() {
            var tabID = $(this).parents('a').attr('href');
            var trademark = $('#trademark').val();
            $(this).parents('li').remove();
            $(tabID).remove();
    
            //display first tab
            var tabFirst = $('#tab-list a:first');
            // resetTab(trademark);
            tabFirst.tab('show');
        });
    
        var list = document.getElementById("tab-list");
    });   
    
    var tabID = document.getElementById("tabID").value;
    function resetTab(name){
        var tabs=$("#tab-list li:not(:first)");
        var len=1
        $(tabs).each(function(k,v){
            len++;
            $(this).find('a').html(`
            <div>nama cabang <button class="close" type="button" title="Remove this page">×</button> </div>
            <div style="line-height:1;">
                <div><small>Total laba bersih</small></div>
                <div>Rp. 0</div>
            </div>`);
        })
        tabID--;
    };
    
    function addTabPlan() {
        tabID++;
        tab_obj[tabID] = 0; 
    
        $('#tab-list').append($(`
        <li class="nav-item">
            <a class="nav-link tab-penerbit-detail" 
                id="profil-tab" data-toggle="tab" href="#tab${tabID}" 
                role="tab" aria-controls="tab" aria-selected="true"> 
                <div>nama rencana <button class="close" type="button" title="Remove this page">×</button> </div>
                <div style="line-height:1;">
                    <div><small>Subtotal</small></div>
                    <div>Rp. 0</div>
                </div>
            </a>
        </li>`));
            
        $('#tab-content').append($(`
        <div class="tab-pane row fade" id="tab${tabID}">
            <div class="row my-2">
                <div class="form-group col-md-4">
                    <label>Nama Rencana</label>
                    <input type="text" class="form-control" name="list_fund_plans[${tabID}][name]" maxlength="40" 
                        placeholder="Masukan nama rencana"/>
                </div>
            </div>
            <div class="row col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tab_rencana_${tabID}">
                    <thead>
                        <tr>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Nilai</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id='rencana_addr_${tabID}_${tab_obj[tabID]}'></tr>                          
                    </tbody>
                    </table>
                    <div class="justify-content-between row col-12">
                        <a class="btn btn-santara-white col-4" onclick="addReportPlan(${tabID},${tab_obj[tabID]})">Tambah Baris</a>
                        <input type="text" class="form-control col-2" style="width:30%" id="subtotal_${tabID}" name="list_fund_plans[${tabID}][subtotal]"/>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="form-group col-md-12">
                <label>Deskripsi</label>
                <textarea class="form-control required-form" rows="7" cols="50" name="list_fund_plans[${tabID}][desc]" id="deskripsi" placeholder="Tuliskan biografi singkat pemilik usaha"></textarea>
                </div>
            </div>   
        </div>`));
    };
    
    function addReportPlan(tab_id,no) {
        if(!tab_obj.hasOwnProperty(tab_id)){
            tab_obj[tab_id] = no;
        }
        var tab_no = tab_obj[tab_id];
        
        $('#rencana_addr_'+ tab_id +'_'+ tab_no).html(
            "<td width='55%'><input name='list_fund_plans["+ tab_id + "][sublist]["+ tab_no + "][desc]' type='text' class='form-control'/></td>" +
            "<td width='30%'><input name='list_fund_plans["+ tab_id + "][sublist]["+ tab_no + "][amount]' type='text' class='form-control amount_"+ tab_id +"' onkeyup='subTotal("+ tab_id + ")'/></td>" +
            "<td width='5%'><a class='pull-right btn btn-santara-white' onclick='removeReportPlan("+ tab_id + "," + tab_no + ")'><i class='la la-times'></i></a></td>");
    
        $('#tab_rencana_'+ tab_id).append('<tr id="rencana_addr_' + tab_id + '_' + (tab_no + 1) + '"></tr>');
        tab_obj[tab_id]++;
    };
    
    
    function removeReportPlan(tab_id,tab_no) {
        if (tab_no > 0) {
            $("#rencana_addr_" + tab_id + "_"  + tab_no).html('');
            subTotal(tab_id);
        }
    };
    
    function submitPlan(type) {
        var form = '#formSubmitPlan';
        var data = $(form).serializeArray();
        $("#loader").show();
        $.ajax({
            url: '{{url("penerbit/savePlan")}}/' + type,
            type: 'POST',
            cache: false,
            data: data,
            success: function(data) {
                $("#loader").hide();
                data = JSON.parse(data);
                if (data.msg == 200) {
                    Swal.fire(
                        'Berhasil',
                        'Data penerbit berhasil disimpan',
                        'success'
                    ).then((result) => {
                        location.reload();
                    });
                } else {
                    Swal.fire("Error!1"+data.msg, data.msg, "error");
                }
            },
            error: function(data) {
                $("#loader").hide();
                Swal.fire("Error!2"+data.msg, data.msg, "error");
            }
        });
    };
    
    function subTotal(tab_id) {
        var subtotal = 0;
        var valueArray = $('.amount_'+tab_id).map(function() {
            this.value = this.value.replace(/\./g, '');
            subtotal += Number(this.value);
            if( !isNaN(this.value )){
                this.value = formatNumber(Number(this.value));
            }
        }).get();
        document.getElementById("subtotal_"+tab_id).value = ( isNaN(subtotal) ) ? 0 : formatNumber(Number(subtotal) );
    };
    </script>

    <script></script>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
    integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css"
    href="{{asset('public/admin')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
@endsection