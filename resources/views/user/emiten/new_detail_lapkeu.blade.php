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
                                                    @include('user.emiten.laporan_laba_rugi')
                                                </div>

                                                <div class="tab-pane fade" id="perkembangan" role="tabpanel">
                                                    {{-- <?php $this->load->view("member/laporan_keuangan/_detail/perkembangan_perusahaan"); ?> --}}
                                                    @include('user.emiten.perkembangan_perusahaan')
                                                </div>

                                                <div class="tab-pane fade" id="informasi" role="tabpanel">
                                                    {{-- <?php $this->load->view("member/laporan_keuangan/_detail/informasi_lain"); ?> --}}
                                                    @include('user.emiten.informasi_lain')
                                                </div>

                                                <div class="tab-pane fade" id="bukti" role="tabpanel">
                                                    {{-- <?php $this->load->view("member/laporan_keuangan/_detail/laporan_bukti"); ?> --}}
                                                    @include('user.emiten.laporan_bukti')
                                                </div>

                                                <div class="tab-pane fade" id="publikasi" role="tabpanel">
                                                    {{-- <?php $this->load->view("member/laporan_keuangan/_detail/publikasi"); ?> --}}
                                                    @include('user.emiten.publikasi')
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

<script src="https://old.santara.co.id/app-assets/vendors/js/extensions/jquery.steps.min.js"></script>
                    <script src="https://old.santara.co.id/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>

                    {{-- <script src="https://old.santara.co.id/assets/js/member/laporan-keuangan.js?v=5.8.8"></script> --}}
                    <script>
                        $(document).ready(function() {
    var x = document.getElementById("row_count").value;;
    $("#realisasi_add_row").click(function() {
        $('#realisasi_addr_' + x).html(
            "<td width='85%'><input name='list_fund_realization[" + x + "][desc]' type='text' class='form-control' /></td>" +
            "<td width='15%'><input name='list_fund_realization[" + x + "][amount]' type='text' class='form-control realisasi_amount' onkeyup='total()'/></td>" +
            "<td width='5%'><a class='pull-right btn btn-santara-white' onclick='removeRow("+x+")'><i class='la la-times'></i></a></td>");

        $('#tab_realisasi').append('<tr id="realisasi_addr_' + (Number(x) + Number(1) ) + '"></tr>');
        x++;
    });
    $(".show_fund_plan_content").hide();
    $(".show_fund_realization_content").hide();
    $(".show_profit_loss_content").hide();
    $(".show_strategy_content").hide();
    $(".show_growth_content").hide();
    $(".show_deed_content").hide();
    $(".show_ksei_content").hide();


    $(".file-image").fileinput({
        'allowedFileExtensions': ["jpg", "jpeg", "gif", "png"],
        'showUpload': false,
        'showPreview': false,
        'maxFileCount': 1,
        'maxFileSize': 10000,
        'elErrorContainer': "#errorBlockPictures"
    });

    $(".file-document").fileinput({
        'allowedFileExtensions': ["pdf"],
        'showUpload': false,
        'showPreview': false,
        'maxFileCount': 1,
        'maxFileSize': 25000,
        'elErrorContainer': "#errorBlockProspektus"
    });

    if($("#show_fund_plan_yes").is(":checked")) {
        $(".show_fund_plan_content").show();
    } else {
        $(".show_fund_plan_content").hide();
    }

    if($("#show_fund_realization_yes").is(":checked")) {
        $(".show_fund_realization_content").show();
    } else {
        $(".show_fund_realization_content").hide();
    }

    if($("#show_profit_loss_yes").is(":checked")) {
        $(".show_profit_loss_content").show();
    } else {
        $(".show_profit_loss_content").hide();
    }

    if($("#show_strategy_yes").is(":checked")) {
        $(".show_strategy_content").show();
    } else {
        $(".show_strategy_content").hide();
    }

    if($("#show_growth_yes").is(":checked")) {
        $(".show_growth_content").show();
    } else {
        $(".show_growth_content").hide();
    }

    if($("#show_deed_yes").is(":checked")) {
        $(".show_deed_content").show();
    } else {
        $(".show_deed_content").hide();
    }

    if($("#show_ksei_yes").is(":checked")) {
        $(".show_ksei_content").show();
    } else {
        $(".show_ksei_content").hide();
    }
});


$(".show_fund_plan").click(function() {
    if($(this).val() == 1) {
        $(".show_fund_plan_content").show();
    } else {
        $(".show_fund_plan_content").hide();
    }
});

$(".show_fund_realization").click(function() {
    if($(this).val() == 1) {
        $(".show_fund_realization_content").show();
    } else {
        $(".show_fund_realization_content").hide();
    }
});

$(".show_profit_loss").click(function() {
    if($(this).val() == 1) {
        $(".show_profit_loss_content").show();
    } else {
        $(".show_profit_loss_content").hide();
    }
});

$(".show_strategy").click(function() {
    if($(this).val() == 1) {
        $(".show_strategy_content").show();
    } else {
        $(".show_strategy_content").hide();
    }
});

$(".show_growth").click(function() {
    if($(this).val() == 1) {
        $(".show_growth_content").show();
    } else {
        $(".show_growth_content").hide();
    }
});

$(".show_deed").click(function() {
    if($(this).val() == 1) {
        $(".show_deed_content").show();
    } else {
        $(".show_deed_content").hide();
    }
});

$(".show_ksei").click(function() {
    if($(this).val() == 1) {
        $(".show_ksei_content").show();
    } else {
        $(".show_ksei_content").hide();
    }
});

function removeRow(x) {
    $("#realisasi_addr_" + x).html('');
    total();
};


$("#strategy_image_add").click(function () {
    var html = `
    <div id="input-row" class="col-md-12">
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input file-image" name="strategy_image[]" accept="image/*">
                <label class="custom-file-label">Pilih file</label>
            </div>
            <div class="input-group-append">
                <button id="strategy_row_remove" class="btn btn-santara-red" type="button">Hapus</button>
            </div>
        </div>
        <div class="input-group mt-1 mb-3">
            <textarea class="form-control required-form" rows="4" cols="50" name="strategy_desc[]" placeholder="Tuliskan deskripsi"></textarea>
        </div>
    </div>`;

    $('#strategy_row_new').append(html);

    // remove row
    $(document).on('click', '#strategy_row_remove', function () {
        $(this).closest('#input-row').remove();
    });

    $(document).on('change', '.file-image', function (e) {
        var filename = e.target.files[0].name;
        $(this).next('label').text(filename);
    });
});

$("#growth_image_add").click(function () {
    var html = `
    <div id="input-row" class="col-md-12">
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input file-image" name="growth_image[]" accept="image/*">
                <label class="custom-file-label">Pilih file</label>
            </div>
            <div class="input-group-append">
                <button id="growth_row_remove" class="btn btn-santara-red" type="button">Hapus</button>
            </div>
        </div>
        <div class="input-group mt-1 mb-3">
            <textarea class="form-control required-form" rows="4" cols="50" name="growth_desc[]" placeholder="Tuliskan deskripsi"></textarea>
        </div>
    </div>`;

    $('#growth_row_new').append(html);

    // remove row
    $(document).on('click', '#growth_row_remove', function () {
        $(this).closest('#input-row').remove();
    });

    $(document).on('change', '.file-image', function (e) {
        var filename = e.target.files[0].name;
        $(this).next('label').text(filename);
    });
});

$("#deeds_image_add").click(function () {
    var html = `
    <div id="input-row" class="col-md-12">
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input file-image" name="deeds_image[]" accept="image/*">
                <label class="custom-file-label">Pilih file</label>
            </div>
            <div class="input-group-append">
                <button id="deeds_row_remove" class="btn btn-santara-red" type="button">Hapus</button>
            </div>
        </div>
        <div class="input-group mt-1 mb-3">
            <textarea class="form-control required-form" rows="4" cols="50" name="deeds_desc[]" placeholder="Tuliskan deskripsi"></textarea>
        </div>
    </div>`;

    $('#deeds_row_new').append(html);

    // remove row
    $(document).on('click', '#deeds_row_remove', function () {
        $(this).closest('#input-row').remove();
    });

    $(document).on('change', '.file-image', function (e) {
        var filename = e.target.files[0].name;
        $(this).next('label').text(filename);
    });
});

$("#kseis_image_add").click(function () {
    var html = `
    <div id="input-row" class="col-md-12">
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input file-image" name="kseis_image[]" accept="image/*">
                <label class="custom-file-label">Pilih file</label>
            </div>
            <div class="input-group-append">
                <button id="kseis_row_remove" class="btn btn-santara-red" type="button">Hapus</button>
            </div>
        </div>
        <div class="input-group mt-1 mb-3">
            <textarea class="form-control required-form" rows="4" cols="50" name="kseis_desc[]" placeholder="Tuliskan deskripsi"></textarea>
        </div>
    </div>`;

    $('#kseis_row_new').append(html);

    // remove row
    $(document).on('click', '#kseis_row_remove', function () {
        $(this).closest('#input-row').remove();
    });

    $(document).on('change', '.file-image', function (e) {
        var filename = e.target.files[0].name;
        $(this).next('label').text(filename);
    });
});

$("#pos_image_add").click(function () {
    var html = `
    <div id="input-row" class="col-md-12">
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input file-image" name="pos_image[]" accept="image/*">
                <label class="custom-file-label">Pilih file</label>
            </div>
            <div class="input-group-append">
                <button id="pos_row_remove" class="btn btn-santara-red" type="button">Hapus</button>
            </div>
        </div>
        <div class="input-group mt-1 mb-3">
            <textarea class="form-control required-form" rows="4" cols="50" name="pos_desc[]" placeholder="Tuliskan deskripsi"></textarea>
        </div>
    </div>`;

    $('#pos_row_new').append(html);

    // remove row
    $(document).on('click', '#pos_row_remove', function () {
        $(this).closest('#input-row').remove();
    });

    $(document).on('change', '.file-image', function (e) {
        var filename = e.target.files[0].name;
        $(this).next('label').text(filename);
    });
});

var form = $("#formLaporanKeuangan").show();
form.steps({
    headerTag: "h3",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    enableAllSteps: true,
    enablePagination: true,
    titleTemplate: '<span class="step">#index#</span> ',
    onStepChanging: function(event, currentIndex, newIndex) {


        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex) {
            return true;
        }
        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex) {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function(event, currentIndex) {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function(event, currentIndex) {
        Swal.fire({
            title: 'Laporan Keuangan',
            text: 'Buat laporan keuangan anda sekarang ? ',
            type: 'info',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.value) {

                var data = new FormData(this);

                $.ajax({
                    url: '/user/laporan-keuangan/print',
                    type: 'POST',
                    dataType: "json",
                    data: data,
                    cache: false,
                    async: true,
                    processData: false,
                    contentType: false,
                    timeout: 60000, // sets timeout to 20 seconds
                    beforeSend: function() {
                        $("#loader").show();
                        $("#submitBisnis").attr("disabled", true);
                    },
                    success: function(data) {
                        $("#loader").hide();

                        if (data.msg == 200) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'Berhasil menambahkan bisnis',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                window.location = '/user/pralisting/list';
                            })
                        } else {
                            if (!$.isEmptyObject(data.error)) {

                            } else {
                                Swal.fire('Gagal', data.msg, 'info').then((result) => {
                                    location.reload();
                                });
                            }
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if (textStatus === "timeout" || textStatus === "error") {
                            $("#loader").hide();
                            Swal.fire({
                                title: 'Ooops...',
                                text: "Mohon periksa koneksi internet anda",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Muat ulang',
                                cancelButtonText: 'Tutup'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            })
                        }
                    },
                    complete: function() {
                        $("#submitBisnis").attr("disabled", false);
                        $("#loader").hide();
                    }
                });
            }
        })
    },
    labels: {
        finish: "Selesai",
        next: "Selanjutnya",
        previous: "Sebelumnya",
        loading: "Loading ..."
    }
}).validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {

    },
    messages: {

    },
    errorPlacement: function(error, element) {

    }
});

function total() {
    var total = 0;
    $('.realisasi_amount').map(function() {
        this.value = this.value.replace(/\./g, '');
        total += Number(this.value);
        if(!isNaN(this.value )){
            this.value = formatNumber(Number(this.value));
        }
    }).get();
    document.getElementById("fund_realization_total").value = ( isNaN(total) ) ? 0 : formatNumber(Number(total) );
};

function deleteDocument(id,file_name){
    Swal.fire({
        title: 'Laporan Keuangan Manual',
        text: 'Apakah anda yakin ingin menghapus file ini ?',
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {

        if (result.value) {
            $("#loader").show();
            var data = {
                id: id,
                file_name: file_name
            };

            $.ajax({
                type: 'POST',
                url: "/user/laporan-keuangan/deleteDocument/",
                data: data,
                success: function(data) {
                    data = JSON.parse(data);
                    $("#loader").hide();
                    if (data.msg == 200) {
                        Swal.fire(
                            'Berhasil',
                            'Dokumen Laporan Keuangan Manual berhasil dihapus',
                            'success'
                        ).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Error!", data.msg, "error");
                    }
                },
                error: function(data) {
                    $("#loader").hide();
                    Swal.fire("Error!", data.msg, "error");
                }
            });
        }
    })
}
                    </script>

                    <script>
                        function submitReport(form_report, type = null, uuid) {
                            $("#loader").show();
                            var form = $('#' + form_report)[0];
                            var formdata = new FormData(form);
                            formdata.append('uuid', uuid_emitenLP);
                            console.log(formdata);
                            $.ajax({
                                url: '{{url("/user/laporan-keuangan/saveReport")}}',
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
                                                window.location = '{{url("penerbit/bisnisdetail")}}/' + uuid;
                                            } else {
                                                const anchor = window.location.hash;
                                                const id = $("input[name='id']").val();
                                                if (id) {
                                                    location.reload();
                                                } else {
                                                    window.location.href = '{{url("user/laporan-keuangan/detail")}}/' + uuid + '/' + data.id + anchor;
                                                }
                                            }
                                        });
                                    } else {
                                        Swal.fire("Error!3"+msg, msg, "error");
                                    }
                                },
                                error: function(data) {
                                    var msg = data.msg;
                                    $("#loader").hide();
                                    Swal.fire("Error!4"+msg, msg, "error");
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
    href="{{asset('admin')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="https://old.santara.co.id/assets/css/member/laporan-keuangan.css?v=5.8.8">
    @endsection
