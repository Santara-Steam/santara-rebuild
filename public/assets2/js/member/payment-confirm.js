const submitConfirmWallet = document.getElementById('submitConfirmWallet');
if (submitConfirmWallet) {
    const total = document.getElementById('total');
    const wallet = document.getElementById('wallet');
    submitConfirmWallet.disabled = true;

    if ((wallet) && (total) && (parseInt(wallet.value) >= parseInt(total.value))) {
        submitConfirmWallet.disabled = false;
    }
}

function validateForm() {
    $(".submit-form-confirmation").prop('disabled', true);
    var requiredAllCompleted = true;

    $('.required-form-confirmation').each(function() {
        if (!$(".bank_to").is(':checked')) {
            requiredAllCompleted = false;
        }

        if ($(this).val() == "") {
            requiredAllCompleted = false;
        }
    });

    if (requiredAllCompleted) $(".submit-form-confirmation").prop("disabled", false);
}

$('.required-form-confirmation').on('keyup change blur input', function() {
    validateForm();
});

$(document).ready(function() {
    $("#verification_photo").fileinput({
        'allowedFileExtensions': ["jpg", "jpeg", "gif", "png"],
        'showUpload': false,
        'showRemove': false,
        'maxFileCount': 1,
        'maxFileSize': 10000,
        'showPreview': false,
        'elErrorContainer': "#errorBlock"
    });
    validateForm();
});

$("#formSubmitConfirm").on('submit', function(e) {
    e.preventDefault();

    var data = new FormData(this);
    $.ajax({
        url: '/transaction/uploadkonfirmasi',
        type: 'POST',
        dataType: "json",
        data: data,
        cache: false,
        async: true,
        processData: false,
        contentType: false,
        beforeSend: function() {
            $("#loader").show();
            $("#submitConfirm").attr("disabled", true);
            $("input[name='verification_photo']").attr("disabled", true);
        },
        success: function(data) {

            if (data.msg == 401) {
                window.location = '/login/logout';
            }

            if (data.msg == 200) {
                window.location = '/user/success/' + $("input[name='transaction_uuid']").val() + '/upload';
            } else {
                Swal.fire("Error!", 'Gagal melakukan konfirmasi pembayaran !', "error")
                    .then((result) => {
                        location.reload();
                    });
            }
        },
        error: function(data) {
            Swal.fire("Error!", 'Gagal melakukan konfirmasi pembayaran !', "error");
        },
        complete: function() {
            $("#submitConfirm").attr("disabled", false);
            $("input[name='verification_photo']").attr("disabled", false);
            $("#loader").hide();
        }
    });
});

$("#submitConfirmOvo").click(function() {
    var amount_ovo = $("input[name='amount_ovo']").val();
    var data = {
        uuid: $("input[name='uuid']").val(),
        phone_ovo: $("input[name='phone_ovo']").val(),
        amount_ovo: parseInt(amount_ovo.replace(/\./g, ''))
    };

    $.ajax({
        url: '/transaction/confirmationewalletpayment',
        type: 'POST',
        dataType: "json",
        data: data,
        timeout: 20000, // sets timeout to 20 seconds
        beforeSend: function() {
            $("#loader").show();
            $("#submitConfirmOvo").attr("disabled", true);
            $("input[name='phone_ovo']").attr("disabled", true);
            $("input[name='amount_ovo']").attr("disabled", true);
        },
        success: function(data) {
            $("#loader").hide();
            if (data.msg == 401) {
                window.location = '/login/logout';
            }

            if ($.isEmptyObject(data.error)) {
                if (data.msg == 200) {
                    Swal.fire('OVO Payment', 'Berhasil melakukan pembayaran', 'success').then((result) => {
                        window.location = '/user/success/' + $("input[name='uuid']").val();
                    });
                } else {
                    Swal.fire('OVO Payment', 'Gagal melakukan pembayaran', 'error').then((result) => {
                        location.reload();
                    });
                }
            } else {
                if (data.error.phone_ovo_error != '') {
                    $('#phone_ovo_error').html(data.error.phone_ovo_error);
                    $('#phone_ovo').addClass('invalid');
                } else {
                    $('#phone_ovo_error').html('');
                    $('#phone_ovo').removeClass('invalid');
                }

                if (data.error.amount_ovo_error != '') {
                    $('#amount_ovo_error').html(data.error.amount_ovo_error);
                    $('#amount_ovo').addClass('invalid');
                } else {
                    $('#amount_ovo_error').html('');
                    $('#amount_ovo').removeClass('invalid');
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
            $("#submitConfirmOvo").attr("disabled", false);
            $("input[name='phone_ovo']").attr("disabled", false);
            $("input[name='amount_ovo']").attr("disabled", false);
            $("#loader").hide();
        }
    });
});

$("#cancelTransaction").click(function() {
    Swal.fire({
        title: 'Hapus Transaksi ?',
        text: 'Apakah Anda yakin ingin menghapus dan membatalkan proses transaksi ini ?',
        showCancelButton: true,
        confirmButtonText: 'Yakin',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            var data = {
                uuid: $("input[name='uuid']").val()
            }
            $.ajax({
                url: '/transaction/cancelPayment',
                type: 'POST',
                dataType: "json",
                data: data,
                timeout: 20000, // sets timeout to 20 seconds
                beforeSend: function() {
                    $("#loader").show();
                },
                success: function(data) {
                    $("#loader").hide();
                    if (data.msg == 200) {
                        Swal.fire('Success', 'Pembatalan transaksi berhasil', 'success').then((result) => {
                            window.location = '/list-bisnis';
                        });
                    } else {
                        Swal.fire('Gagal', data.msg, 'error').then((result) => {
                            location.reload();
                        });
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
                    $("#loader").hide();
                }
            });
        }
    });
});

$("#submitConfirmWallet").click(function() {
    var data = {
        uuid: $("input[name='uuid']").val(),
        wallet: $("input[name='wallet']").val()
    };

    $.ajax({
        url: '/transaction/confirmationwalletpayment',
        type: 'POST',
        dataType: "json",
        data: data,
        timeout: 20000, // sets timeout to 20 seconds
        beforeSend: function() {
            $("#loader").show();
            $("#submitConfirmWallet").attr("disabled", true);
        },
        success: function(data) {
            $("#loader").hide();
            if (data.msg == 401) {
                window.location = '/login/logout';
            }

            if (data.msg == 200) {
                window.location = '/user/success/' + $("input[name='uuid']").val();
            } else {
                Swal.fire('Wallet Payment', 'Gagal melakukan pembayaran', 'error').then((result) => {
                    location.reload();
                });
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
            $("#submitConfirmWallet").attr("disabled", false);
            $("#loader").hide();
        }
    });
});

const btn_va_copy = document.getElementById('btn_va_copy');
const btn_amount_copy = document.getElementById('btn_amount_copy');

if (btn_va_copy != null) { btn_va_copy.addEventListener("click", copy_virtual_account) }
if (btn_amount_copy != null) { btn_amount_copy.addEventListener("click", copy_amount) }

function copy_virtual_account() {
    var copyText = document.getElementById("text_virtual_account");
    var textArea = document.createElement("textarea");
    textArea.value = copyText.textContent;
    document.body.appendChild(textArea);
    textArea.select();
    document.execCommand("Copy");
    textArea.remove();
    var tooltip_copy = document.getElementById("myTooltipVa");
    tooltip_copy.innerHTML = "Virtual Account berhasil disalin ";
}

function copy_amount() {
    var copyTextPrice = document.getElementById("text_amount");
    var textArea = document.createElement("textarea");
    textArea.value = copyTextPrice.textContent;
    textArea.value = textArea.value.replace(/\./g, '');
    document.body.appendChild(textArea);
    textArea.select();
    document.execCommand("Copy");
    textArea.remove();
    var tooltip_copy_price = document.getElementById("myTooltipAmount");
    tooltip_copy_price.innerHTML = "Jumlah Pembayaran berhasil disalin ";
}

function outFuncVa() {
    var tooltip_copy_va = document.getElementById("myTooltipVa");
    tooltip_copy_va.innerHTML = "Salin Virtual Account";
}

function outFuncPrice() {
    var tooltip_copy_price = document.getElementById("myTooltipAmount");
    tooltip_copy_price.innerHTML = "Salin Nominal Pembayaran";
}

const payment_expired = document.getElementById('payment_expired').value;

function getTimeRemaining(endtime) {
    var t = Date.parse(endtime) - Date.parse(new Date());
    var seconds = Math.floor((t / 1000) % 60);
    var minutes = Math.floor((t / 1000 / 60) % 60);
    var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
    return {
        'total': t,
        'days': days,
        'hours': hours,
        'minutes': minutes,
        'seconds': seconds
    };
}

function initializeClock(id, endtime) {

    var clock = document.getElementById(id);
    //   var daysSpan = clock.querySelector('.days');
    var hoursSpan = clock.querySelector('.hours');
    var minutesSpan = clock.querySelector('.minutes');
    var secondsSpan = clock.querySelector('.seconds');

    function updateClock() {
        endtime = endtime.replace(/-/g, '/');
        var t = getTimeRemaining(endtime);

        // daysSpan.innerHTML = t.days;
        hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
        minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
        secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

        if (t.total <= 0) {
            clearInterval(timeinterval);
            $("#btn-otp").removeAttr("disabled");
            $("#count-payment-expired").remove();
        }
    }

    updateClock();
    var timeinterval = setInterval(updateClock, 1000);
}
initializeClock('clockdiv', payment_expired);

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
}

const submitConfirmOvo = document.getElementById('submitConfirmOvo');
const phone_ovo = document.getElementById('phone_ovo');
const amount_ovo = document.getElementById('amount_ovo');

if (amount_ovo != null) {
    amount_ovo.addEventListener('keyup', function(e) {
        if (amount_ovo.value != '') {
            amount_ovo.value = formatNumber(parseInt(amount_ovo.value.replace(/\./g, '')));
        }
    })
}