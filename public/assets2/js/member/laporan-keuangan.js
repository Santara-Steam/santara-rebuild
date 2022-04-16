$(document).ready(function() {
    var x = document.getElementById("row_count").value;;
    $("#realisasi_add_row").click(function() {
        $('#realisasi_addr_' + x).html(
            "<td width='85%'><input name='list_fund_realization[" + x + "][desc]' type='text' class='form-control' /></td>" +
            "<td width='15%'><input name='list_fund_realization[" + x + "][amount]' type='text' class='form-control realisasi_amount' onkeyup='total()'/></td>" +
            "<td width='5%'><a class='pull-right btn btn-santara-white' onclick='removeRow("+x+")'><i class='las la-times'></i></a></td>");

        $('#tab_realisasi').append('<tr id="realisasi_addr_' + (Number(x) + Number(1) ) + '"></tr>');
        x++;
    });

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