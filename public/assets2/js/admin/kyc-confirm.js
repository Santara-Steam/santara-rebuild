// Wizard tabs with numbers setup
$(document).ready(function() {
    validateComfirm();
});

$(document).on("keyup", ".required-form-kyc", function() {
    validateComfirm();
});

$(".number-tab-steps").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "slideLeft",
    enableAllSteps: true,
    enablePagination: false,
    titleTemplate: '<span class="step">#index#</span> #title#'
});

$('input:radio').change(function() {
    let value = $(this).attr('value');
    let name = $(this).attr('name');
    document.getElementById("error_" + name).disabled = false;
    document.getElementById("error_" + name).classList.add("required-form-kyc");
    if (value == 1) {
        document.getElementById("error_" + name).value = '';
        document.getElementById("error_" + name).disabled = true;
        document.getElementById("error_" + name).classList.remove("required-form-kyc");
    }
    validateComfirm();
});

$(document).on("click", ".open-imageDialog", function() {
    var image = $(this).data('image');
    $('#popup_image').attr('src', image);
})

function btnVerify(title, text, url, uuid, phase) {
    Swal.fire({
        title: title,
        text: text,
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $("#loader").show();
            var data = { uuid: uuid, phase: phase };

            $.ajax({
                url: url,
                type: 'POST',
                dataType: "json",
                data: data,
                success: function(data) {
                    $("#loader").hide();
                    if (data.msg == 200) {
                        Swal.fire('Berhasil', title + ' berhasil dilakukan.', 'success').then((result) => {
                            location.reload();
                        });
                    } else {
                        $("#loader").hide();
                        Swal.fire("Error!", title + ' gagal melakukan', "error");
                    }
                },
                error: function(msg) {
                    $("#loader").hide();
                    Swal.fire("Error!", title + ' gagal melakukan', "error");
                }
            });
        }
    })
}

function btnUnverify(title, text, url, uuid) {
    Swal.fire({
        title: "Batalkan KYC Bisnis",
        text: 'Masukan alasan pembatalan KYC',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Ok',
        showLoaderOnConfirm: true,
        preConfirm: (input) => {
            if (input === '') {
                Swal.showValidationMessage('alasan penolakan tidak boleh kosong')
            } else {
                $("#loader").show();
                var data = { uuid: uuid, reason: input };

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: "json",
                    data: data,
                    success: function(data) {
                        $("#loader").hide();
                        if (data.msg == 200) {
                            Swal.fire("Success!", 'Penolakan data KYC berhasil dilakukan.', "success").then((result) => {
                                location.reload();
                            });
                        } else {
                            Swal.fire("Error!", title + ' gagal melakukan', "error");
                        }
                    },
                    error: function(msg) {
                        $("#loader").hide();
                        Swal.fire("Error!", title + ' gagal melakukan', "error");
                    }
                });
            }
        }
    })
}

function btnReject(url, uuid, phase) {
    Swal.fire({
        title: "Tolak KYC",
        text: 'Masukan alasan penolakan KYC',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Ok',
        showLoaderOnConfirm: true,
        preConfirm: (input) => {
            if (input === '') {
                Swal.showValidationMessage('alasan penolakan tidak boleh kosong')
            } else {
                $("#loader").show();
                var data = { uuid: uuid, phase: phase, reason: input };

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: "json",
                    data: data,
                    success: function(data) {
                        $("#loader").hide();
                        if (data.msg == 200) {
                            Swal.fire("Success!", 'Penolakan data KYC berhasil dilakukan.', "success").then((result) => {
                                location.reload();
                            });
                        } else {
                            Swal.fire("Error!", title + ' gagal melakukan', "error");
                        }
                    },
                    error: function(msg) {
                        $("#loader").hide();
                        Swal.fire("Error!", title + ' gagal melakukan', "error");
                    }
                });
            }
        }
    })
}

function detailPhoto(title, photo) {
    Swal.fire({
        title: "<strong> " + title + " </strong>",
        html: "<img onClick='rotateMe()' class='swal2-image rotateimg' src=" + photo + "><br /><p>* Klik pada gambar untuk memutar posisi gambar</p>",
        customClass: 'swal-wide'
    });
};

var degrees = 0;

function rotateMe() {
    degrees += 90;

    $('.rotateimg').css({
        'transform': 'rotate(' + degrees + 'deg)',
        '-ms-transform': 'rotate(' + degrees + 'deg)',
        '-moz-transform': 'rotate(' + degrees + 'deg)',
        '-webkit-transform': 'rotate(' + degrees + 'deg)',
        '-o-transform': 'rotate(' + degrees + 'deg)'
    });
};

function btnConfirm(key) {
    $("#loader").show();
    var actionurl = document.getElementById('kyc_url').value;
    var form = '#formKycConfirm' + key;
    var kyc = $(form).serializeArray();
    var user = {
        trader_uuid: document.getElementById('trader_uuid').value,
        step_id: key,
        last_kyc_submission_id: document.getElementById('last_kyc_submission_id').value
    };

    var dataKyc = { kyc, user };

    $.ajax({
        url: actionurl,
        type: 'POST',
        cache: false,
        data: dataKyc,
        success: function(data) {
            $("#loader").hide();
            data = JSON.parse(data);
            if (data.msg == 200) {
                Swal.fire(
                    'Berhasil',
                    'Konfirmasi KYC berhasil dilakukan',
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
};

function validateComfirm() {
    $(".submit-form-kyc").prop('disabled', true);
    var requiredAllCompleted = true;
    $('.required-form-kyc').each(function() {
        if ($(this).val() == "") requiredAllCompleted = false;
    });
    if (requiredAllCompleted) $(".submit-form-kyc").prop("disabled", false);
}