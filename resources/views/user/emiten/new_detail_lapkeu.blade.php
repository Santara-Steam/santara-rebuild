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

                   
                    <script>
                        const uuid_emitenLP = '<?= $uuid; ?>';
                    </script>
                    <section id="number-tabs">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-content collapse show">
                                        <div class="card-body">
                                            <ul class="nav nav-justified mb-3" id="pills-tab" role="tablist">
                                                <li class="nav-item member-nav">
                                                    <a class="nav-link member-nav-link active" id="pills-tab" data-toggle="tab" href="#realisasi" role="tab" aria-controls="pills-" aria-selected="true">
                                                        <span>Realisasi Pengguna Dana</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item member-nav">
                                                    <a class="nav-link member-nav-link" id="pills-tab" data-toggle="tab" href="#laporan" role="tab" aria-controls="pills-" aria-selected="true">
                                                        <span>Laporan Laba Rugi</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item member-nav">
                                                    <a class="nav-link member-nav-link" id="pills-tab" data-toggle="tab" href="#perkembangan" role="tab" aria-controls="pills-" aria-selected="true">
                                                        <span>Perkembangan Perusahaan</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item member-nav">
                                                    <a class="nav-link member-nav-link" id="pills-tab" data-toggle="tab" href="#informasi" role="tab" aria-controls="pills-" aria-selected="true">
                                                        <span>Informasi Lain</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item member-nav">
                                                    <a class="nav-link member-nav-link" id="pills-tab" data-toggle="tab" href="#bukti" role="tab" aria-controls="pills-" aria-selected="true">
                                                        <span>Laporan Manual & Bukti Operasional</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item member-nav">
                                                    <a class="nav-link member-nav-link" id="pills-tab" data-toggle="tab" href="#publikasi" role="tab" aria-controls="pills-" aria-selected="true">
                                                        <span>Publikasi</span>
                                                    </a>
                                                </li>
                                            </ul>
                    
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade show active" id="realisasi" role="tabpanel">
                                                    {{-- <?php $this->load->view("member/laporan_keuangan/_detail/realisasi_penggunaan_data"); ?> --}}
                                                    @include('user.emiten.realisasi_penggunaan_data')
                                                </div>
                    
                                                <div class="tab-pane fade" id="laporan" role="tabpanel">
                                                    {{-- <?php $this->load->view("member/laporan_keuangan/_detail/laporan_laba_rugi"); ?> --}}
                                                </div>
                    
                                                <div class="tab-pane fade" id="perkembangan" role="tabpanel">
                                                    {{-- <?php $this->load->view("member/laporan_keuangan/_detail/perkembangan_perusahaan"); ?> --}}
                                                </div>
                    
                                                <div class="tab-pane fade" id="informasi" role="tabpanel">
                                                    {{-- <?php $this->load->view("member/laporan_keuangan/_detail/informasi_lain"); ?> --}}
                                                </div>
                    
                                                <div class="tab-pane fade" id="bukti" role="tabpanel">
                                                    {{-- <?php $this->load->view("member/laporan_keuangan/_detail/laporan_bukti"); ?> --}}
                                                </div>
                    
                                                <div class="tab-pane fade" id="publikasi" role="tabpanel">
                                                    {{-- <?php $this->load->view("member/laporan_keuangan/_detail/publikasi"); ?> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    
                    
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

<script src="https://old.santara.co.id/app-assets/vendors/js/extensions/jquery.steps.min.js"></script>
                    <script src="https://old.santara.co.id/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
                    
                    <script src="https://old.santara.co.id/assets/js/member/laporan-keuangan.js?v=5.8.8"></script>
                    
                    <script>
                        function submitReport(form_report, type = null, uuid) {
                            $("#loader").show();
                            var form = $('#' + form_report)[0];
                            var formdata = new FormData(form);
                            formdata.append('uuid', uuid_emitenLP);
                            console.log(formdata);
                            $.ajax({
                                url: '/user/laporan-keuangan/saveReport/',
                                type: 'POST',
                                dataType: "json",
                                data: formdata,
                                cache: false,
                                async: true,
                                processData: false,
                                contentType: false,
                                success: function(data) {
                                    $("#loader").hide();
                                    var msg = data.msg;
                                    if (msg == 200) {
                                        Swal.fire(
                                            'Berhasil',
                                            'Data laporan berhasil disimpan',
                                            'success'
                                        ).then((result) => {
                                            if (type == 'publication') {
                                                window.location = '/user/penerbit/bisnisdetail/' + uuid;
                                            } else {
                                                const anchor = window.location.hash;
                                                const id = $("input[name='id']").val();
                                                if (id) {
                                                    location.reload();
                                                } else {
                                                    window.location.href = '/user/laporan-keuangan/detail/' + uuid + '/' + data.id + anchor;
                                                }
                                            }
                                        });
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
    <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/assets/css/member/laporan-keuangan.css?v=5.8.8">
    @endsection
