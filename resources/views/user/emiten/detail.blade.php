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
                    {{-- <link rel="stylesheet" type="text/css"
                        href="<?php echo base_url(); ?>assets/css/member/penerbit.css?v=<?= WEB_VERSION; ?>"> --}}

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
                                            {{-- <?php $this->load->view( 'member/penerbit/_detail/profil' ); ?> --}}

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
                                                                        <img class="rounded-circle lazyload" style="width: 5rem;height: 5rem;object-fit: cover;"
                                                                            src="{{config('global.STORAGE_BUCKET2')."kyc/".str_replace('/uploads/trader/', "",Auth::user()->trader->photo)}}"
                                                                            onerror="this.onerror=null;this.src='{{env('STORAGE_GOOGLE')}}images/error/no-image.png';"
                                                                            alt="nama bisnis">
                                                                    </div>
                                                                    <div class="col-10">
                                                                        <h5>Bisnis Milik</h5>
                                                                        <h2><b><?= $emiten->name; ?></b></h2>
                                                                    </div>
                                                                </div>
                                                                <hr style="width: 90%"/>
                                                                <div class="py-1 px-2">
                                                                    <div class="progress-bar bg-gradient-x-warning <?= ( $progress < 100) ? 'progress-bar-animated' : ''; ?>"
                                                                            role="progressbar"
                                                                            style="width: <?= $progress; ?>%;"
                                                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                                                            <b style="color: blue;"><?= ( $progress < 100) ? $progress : 100; ?> %</b>
                                                                    </div>
                                                                    <div class="row p-1">
                                                                        <div class="col-md-6 p-0">
                                                                            <h6 class="penerbit-diff">Sisa waktu 
                                                                                <span class="red-santara"?>
                                                                                <?= $sisa_waktu ?> - <?= $emiten->investors; ?> Investor
                                                                                </span>
                                                                            </h6>                 
                                                                        </div>                                                                                                 
                                                                    </div>
                                                                    <div>
                                                                        <h5><b>Dana Terkumpul</b></h5>
                                                                        <h2><b>Rp <?= number_format( $emiten->price * $emiten->terjual, 0, ',', '.' ); ?></b> <small>dari target</small> <b>Rp <?= number_format( $emiten->price * $emiten->supply, 0, ',', '.' ); ?></b></h2>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3 col-md-12">
                                                            <div class="nav-tabs-responsive penerbit-nav">
                                                                <ul class="nav nav-tabs nav-justified">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link penerbit-nav-link active" data-toggle="tab" href="#info">Informasi Saham</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link penerbit-nav-link" data-toggle="tab" href="#detail">Detail Saham</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link penerbit-nav-link" data-toggle="tab" href="#about">Tentang Penerbit</a>
                                                                    </li>
                                                                    <?php if(false): ?>  
                                                                    <li class="nav-item">
                                                                        <a class="nav-link penerbit-nav-link" data-toggle="tab" href="#finance">Finansial</a>
                                                                    </li>
                                                                    <?php endif; ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link penerbit-nav-link" data-toggle="tab" href="#address">Lokasi</a>
                                                                    </li>
                                                                </ul>
                                            
                                                                <div class="tab-content">
                                                                    <div class="tab-pane fade show active" id="info">
                                                                        <div class="row py-3 px-0">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail" class="col-sm-4 col-form-label">Saham Tersisa</label>
                                                                                    <div class="col-sm-8">
                                                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $info->tersisa_percentage ?>%">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail" class="col-sm-4 col-form-label">Dalam Lembar</label>
                                                                                    <div class="col-sm-8">
                                                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $info->tersisa_total ?> Lembar">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail" class="col-sm-4 col-form-label">Dalam Rupiah</label>
                                                                                    <div class="col-sm-8">
                                                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="Rp <?= $info->tersisa_total_rp ?>">
                                                                                    </div>
                                                                                </div>                                                                                                        
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                    <label for="staticEmail" class="col-sm-4 col-form-label">Saham Terjual</label>
                                                                                    <div class="col-sm-8">
                                                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $info->terjual_percentage ?>%">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail" class="col-sm-4 col-form-label">Dalam Lembar</label>
                                                                                    <div class="col-sm-8">
                                                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $info->terjual_total ?> Lembar">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail" class="col-sm-4 col-form-label">Dalam Rupiah</label>
                                                                                    <div class="col-sm-8">
                                                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="Rp <?= $info->terjual_total_rp ?>">
                                                                                    </div>
                                                                                </div>  
                                                                            </div>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="tab-pane fade" id="detail">
                                                                    <div class="row py-3 px-0">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail" class="col-sm-4 col-form-label">Kode Saham</label>
                                                                                    <div class="col-sm-8">
                                                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $emiten->code_emiten; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail" class="col-sm-4 col-form-label">Harga Saham</label>
                                                                                    <div class="col-sm-8">
                                                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="Rp <?= number_format( $emiten->price, 0, ',', '.' ); ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail" class="col-sm-4 col-form-label">Total Saham</label>
                                                                                    <div class="col-sm-8">
                                                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= number_format( $emiten->supply, 0, ',', '.' ); ?> Lembar">
                                                                                    </div>
                                                                                </div>                                                                                                        
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail" class="col-sm-4 col-form-label">Total Saham (Rp)</label>
                                                                                    <div class="col-sm-8">
                                                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="Rp <?= number_format( $emiten->supply * $emiten->price, 0, ',', '.' ); ?>">
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
                                                                                src="{{config('global.STORAGE_BUCKET2')."kyc/".str_replace('/uploads/trader/', "",Auth::user()->trader->photo)}}"
                                                                                onerror="this.onerror=null;this.src='{{env('STORAGE_GOOGLE')}}images/error/no-image.png';"
                                                                                alt="nama bisnis">
                                                                        </div>
                                                                        <div class="col-10">
                                                                            <h3><b>Profil <?= $emiten->name; ?></b></h3>
                                                                            <div class="penerbit-info my-3">
                                                                                <p><?= $emiten->bio; ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                    <?php if(false): ?>  
                                                                    <div class="tab-pane fade" id="finance">
                                                                        <div class="row">
                                                                            <canvas id="myChart" width="400" height="200"></canvas>
                                                                        </div>
                                                                    </div>  
                                                                    <?php endif; ?>
                                                                    <div class="tab-pane fade" id="address">
                                                                        <div class="row p-1">
                                                                            <iframe 
                                                                                    class="detail-bisnis-map"
                                                                                    style="margin: 0 auto;border:0;" 
                                                                                    width="100%" 
                                                                                    height="450" 
                                                                                    frameborder="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAH8huBYsYFY4YrsqB3HtW-2y57IWjydG0&q=<?= $emiten->latitude; ?>,<?= $emiten->longitude; ?>"
                                                                                    allowfullscreen>
                                                                            </iframe>
                                                                        </div>
                                                                        <div>
                                                                            <p><?= $emiten->address; ?></p>
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
                                            {{-- <?php $this->load->view( 'member/penerbit/_detail/laporan' ); ?> --}}

                                            <div class="card-content">
                                                <input type="hidden" id="uuid" value="<?= $uuid ?>" />
                                                <input type="hidden" id="trademark" value="<?= $emiten->trademark; ?>" />
                                                
                                                <div class="card-body">
                                                    <?php if(!$last_report) : ?>
                                                    <div class="card-content m-0">   
                                                        <div class="alert alert-info-dashboard penerbit-info-report col-md-12">
                                                            <h4><b>Anda belum membuat laporan keuangan</b></h4>
                                                            <p>Segera buat laporan keuangan Anda. </p>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                    <div class="card-content py-2">
                                                        <div class="content-center">
                                                            <span class="title-left"><b>Laporan Keuangan Terakhir</b></span>
                                                            <a type="button" class="btn btn-sm btn-info title-right" target="_blank" href="<?= $tutorial; ?>">
                                                                <span class="menu-title" data-i18n="">Tutorial Pembuatan Laporan</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php if($last_report) : ?>
                                                    <div class="card-content mt-1 mx-1 border border-light p-1 row">  
                                                        <div class="col-md-3 content-center text-center">
                                                            <div>
                                                                <p>Tanggal Upload</p>
                                                                <h3><b><?= ($last_report['updated_at']) ? month(date('Y-m-d',strtotime($last_report['updated_at']))) : '-'; ?></b></h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 content-center text-center">
                                                            <div>
                                                                <p>Sales Revenue</p>
                                                                <h3><b>Rp. <?= number_format( $last_report['sales_revenue'], 0, ',', '.' ); ?></b></h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 content-center text-center">
                                                            <div>
                                                                <p>Net Income</p>
                                                                <h3><b>Rp. <?= number_format( $last_report['net_income'], 0, ',', '.' ); ?></b></h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 content-center text-center">
                                                            <div>
                                                                <p>
                                                                    <?php if($last_report['finance_report']): ?>
                                                                        <a href="<?= $last_report['finance_report']; ?>" title="unduh" target="_blank">Lihat Laporan Keuangan</a>
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
                                                        <form method="post" action="/user/laporan-keuangan/detail/<?= $uuid ?>">
                                                            <input type="hidden" name="report" value="created"/>
                                                            <button type="submit" class="btn btn-santara-red btn-block">
                                                                <span class="menu-title" data-i18n="">Buat Laporan Keuangan</span>
                                                            </button>
                                                        </form>
                                                        
                                                        </div>
                                            
                                                        <div class="col-md-9">
                                                        <button type="submit" onclick="getlastReport('<?= $uuid ?>')"class="btn btn-santara-white btn-block" <?= ($last_report == null) ? 'disabled' : ''; ?>>
                                                            <span class="menu-title" data-i18n="">Buat Laporan Keuangan berdasar laporan terakhir</span>
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
                                                            <table class="table table-hover dataTable-table" id="datatable" style="width: 100%">
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
                                                        <img src="<?= base_url() ?>assets/images/content/finance-empty.png" class="mb-2">
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
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body" id= "modal-body">
                                                            <p id="status_desc"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Modal ends here--->
                                            
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
                                                        "url": "/user/penerbit/get_riwayat_laporan_keuangan/" + uuid ,
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
                                                    url: '/user/laporan-keuangan/getLastReport/'+uuid,
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
                                                                    window.location.href = '/user/laporan-keuangan/detail/' + uuid + '/' + data.id;
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
                                                            url: '/user/laporan-keuangan/delete/',
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

                                        </div>
                                        <div class="tab-pane fade" id="rencana" role="tabpanel"
                                            aria-labelledby="rencana-tab">
                                            {{-- <?php $this->load->view( 'member/penerbit/_detail/rencana' ); ?> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
                    {{-- <script src="<?= base_url() ?>assets/js/member/penerbit.js?v=<?= WEB_VERSION; ?>"></script> --}}
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
<script>
    $(document).ready(function() {
        $('#tabel').DataTable({
            responsive: true,
            
        });
    });
</script>
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