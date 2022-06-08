@extends('user.layout.master')
@section('content')

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="configuration">

                <div class="row match-height">

                    {{-- <div class="col-xl-6 col-md-6 col-sm-12"> --}}
                        {{--
                        <link rel="stylesheet" type="text/css"
                            href="<?php echo base_url(); ?>assets/css/member/penerbit.css?v=<?= WEB_VERSION; ?>"> --}}

                        <?php if (isset($data['list']) && ($data['list'])) :
    foreach ($data['list'] as $key => $value) : ?>
    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="card">

                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="card-content row m-0">
                                            <div class="col-3 p-0 text-center">
                                                <?php $picture = explode(',', $value['pictures']); ?>
                                                <img class="penerbit-item-img lazyload img-fluid"
                                                    src="{{env('STORAGE_GOOGLE')}}token/<?= $picture[0]; ?>" onerror="this.onerror=null;this.src='{{env('STORAGE_GOOGLE')}}images/error/no-image.png';"
                                                    >
                                            </div>
                                            <div class="col-9">
                                                <h3>
                                                    <?= $value['trademark']; ?>
                                                    {{-- <?= $value['sts']; ?> --}}
                                                </h3>
                                                <div style="color: #6b6f82;">
                                                    <?= $value['company_name']; ?>
                                                    <span><i class="la la-tag ml-2"></i>
                                                        <?= $value['category']; ?>
                                                    </span>
                                                </div>
                                                <?php if ($value['sts'] == "Penawaran Saham") : ?>
                                                <div class="my-2">
                                                    <div class="progress mb-0" style="height: 12px;">
                                                        <div class="progress-bar bg-gradient-x-success <?= (($value['percent'] * 100) < 100) ? 'progress-bar-animated' : ''; ?>"
                                                            role="progressbar"
                                                            style="width: <?= $value['percent'] * 100; ?>%;"
                                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                                            <b style="color: blue;">
                                                                <?= $value['percent'] * 100; ?> %
                                                            </b>
                                                        </div>
                                                    </div>
                                                    <h6 class="penerbit-diff">Sisa waktu
                                                        <span class="red-santara" ?>
                                                            <?= $value['day_remaining']; ?> Hari -
                                                            <?= $value['total_investor']; ?> Investor
                                                        </span>
                                                    </h6>
                                                </div>
                                                <?php if ($value['last_report']) : ?>
                                                <div
                                                    class="alert alert-info-dashboard penerbit-info-report col-md-12 created">
                                                    <h3><b>Laporan Keuangan Terakhir</b></h3>
                                                    <div class="d-flex justify-content-between mt-1"
                                                        style="color: #6b6f82;">
                                                        <div>Tanggal :
                                                            <?= month(date('Y-m-d', strtotime($value['last_report']['updated_at']))); ?>
                                                        </div>
                                                        <div>Omset Terakhir :
                                                            <?= 'Rp. ' . number_format($value['last_report']['sales_revenue'], 0, ',', '.') ?>
                                                        </div>
                                                        <div>Profit Terakhir :
                                                            <?= 'Rp. ' . number_format($value['last_report']['net_income'], 0, ',', '.') ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php else : ?>
                                                <div class="alert alert-info-dashboard penerbit-info-report col-md-12">
                                                    <h4><b>Anda belum membuat laporan keuangan</b></h4>
                                                    <p>Segera buat laporan keuangan Anda </p>
                                                </div>
                                                <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if ($value['sts'] == "Pra Penawaran Saham") : ?>
                                                <div class="alert alert-info-dashboard penerbit-info-report col-md-12">
                                                    <h4><b>Bisnis Anda Masuk Ke Coming Soon</b></h4>
                                                    <p>Segera lengkapi data untuk dapat listing di Santara.co.id </p>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <a href="{{url('/edit_bisnis')}}/<?= $value['id']; ?>" class="btn btn-warning btn-block btn-sm">Edit</a href="{{url('/edit_bisnis')}}/<?= $value['id']; ?>">
                                                    </div>
                                                </div>
                                                <?php else : ?>

                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <a href="{{url('penerbit/bisnisdetail')}}/<?= $value['uuid']; ?>" class="btn btn-primary btn-block btn-sm">Laporan Keuangan</a>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a href="{{url('/edit_bisnis')}}/<?= $value['id']; ?>" class="btn btn-warning btn-block btn-sm">Edit</a href="{{url('/edit_bisnis')}}/<?= $value['id']; ?>">
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>
                        </div>
                        <?php endforeach;
else : ?>
<div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="card-content text-center p-3">
                                        {{-- <img src="<?= base_url() ?>assets/images/content/finance-empty.png"
                                            class="mb-2"> --}}
                                        <h3><b>Belum Ada Bisnis Terdaftar</b></h3>
                                        <p>Anda belum memiliki bisnis untuk didanai</p>
                                        <a href="{{url('daftar-bisnis/create')}}" type="button" class="btn btn-santara-red btn-block>
                    <span class=" menu-title" data-i18n="">Daftarkan Bisnis Anda</span>
                                        </a>
                                        <!-- <div class="center-pralisting">

                    <h3><b>Daftarkan Bisnis Anda Melalui :</b></h3>
                    <div class="apps-download">
                        <a href="https://santara.co.id/android">
                            <img src="https://storage.googleapis.com/asset-santara/santara.co.id/images/mobile/playstore.png" alt="santara google play">
                        </a>
                        <a href="https://santara.co.id/ios">
                            <img src="https://storage.googleapis.com/asset-santara/santara.co.id/images/mobile/appstore.png" alt="santara app store">
                        </a>
                    </div>
                </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php endif; ?>
                </div>


            </section>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="{{asset('admin')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{asset('admin')}}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
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
    href="{{asset('admin')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
@endsection
