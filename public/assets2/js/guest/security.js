const inputTokenName = $("input[name='tknName']").val();
const inputCookieName = $("input[name='ckName']").val();

$("#formSubmitSecurity").on('submit', function(e) {
    e.preventDefault();
    const cookieToken = getCookie(inputCookieName);
    $(`input[name=${inputTokenName}]`).val(cookieToken);
    var data = new FormData(this);

    $.ajax({
        url: '/user/security/register',
        type: 'POST',
        dataType: "json",
        data: data,
        cache: false,
        async: true,
        processData: false,
        contentType: false,
        timeout: 20000, // sets timeout to 20 seconds
        beforeSend: function() {
            $('.alert-message').hide();
            $('#alert-message-text').html("");
            $('#submit_text').html("");
            $('#submit_text').addClass('submit-loader');
            $("input[name='pin']").attr("disabled", true);
            $("input[name='confirm_pin']").attr("disabled", true);
            $("#btnSubmitSecurity").attr("disabled", true);
        },
        success: function(data) {

            $('#pin_error').html('');
            $('#pin').removeClass('invalid');
            $('#confirm_pin_error').html('');
            $('#confirm_pin').removeClass('invalid');

            if (data.msg == 200) {
                Swal.fire({
                    title: 'Success',
                    text: "Security PIN Anda berhasil dibuat",
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'Lanjutkan',
                }).then((result) => {
                    if (result.value) {
                        window.location = data.redirect;
                    }
                });
            } else {
                if (!$.isEmptyObject(data.error) && data.msg != 200) {
                    if (data.error.pin_error != '') {
                        $('#pin_error').html(data.error.pin_error);
                        $('#pin').addClass('invalid');
                    } else {
                        $('#pin_error').html('');
                        $('#pin').removeClass('invalid');
                    }

                    if (data.error.confirm_pin_error != '') {
                        $('#confirm_pin_error').html(data.error.confirm_pin_error);
                        $('#confirm_pin').addClass('invalid');
                    } else {
                        $('#confirm_pin_error').html('');
                        $('#confirm_pin').removeClass('invalid');
                    }
                } else {
                    Swal.fire('Gagal', data.msg, 'warning');
                }
            }

        },
        error: function(jqXHR, textStatus, errorThrown) {
            if (textStatus === "timeout" || textStatus === "error") {
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
            $("#btnSubmitSecurity").attr("disabled", false);
            $("input[name='pin']").attr("disabled", false);
            $("input[name='confirm_pin']").attr("disabled", false);
            $('#submit_text').removeClass('submit-loader');
            $('#submit_text').html("Masuk");
        }
    })
    return false;
});

$("#formSubmitSecurityEmail").on('submit', function(e) {
    e.preventDefault();
    var data = new FormData(this);

    $.ajax({
        url: '/user/security/verifyEmail',
        type: 'POST',
        dataType: "json",
        data: data,
        cache: false,
        async: true,
        processData: false,
        contentType: false,
        timeout: 20000, // sets timeout to 20 seconds
        beforeSend: function() {
            $('#submit_text').html("");
            $('#submit_text').addClass('submit-loader');
            $("input[name='password']").attr("disabled", true);
            $("#submitSecurityEmail").attr("disabled", true);
        },
        success: function(data) {
            if (data.msg == 200) {
                window.location = data.redirect;
            } else {
                if (!$.isEmptyObject(data.error) && data.msg != 200) {
                    if (data.error.password_error != '') {
                        $('#password_error').html(data.error.password_error);
                        $('#password').addClass('invalid');
                    } else {
                        $('#password_error').html('');
                        $('#password').removeClass('invalid');
                    }
                } else {
                    Swal.fire('Gagal', data.msg, 'warning');
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            if (textStatus === "timeout" || textStatus === "error") {
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
            $("input[name='password']").attr("disabled", false);
            $("#submitSecurityEmail").attr("disabled", false);
            $('#submit_text').removeClass('submit-loader');
            $('#submit_text').html("Konfirmasi");
        }
    });
});

$("#formSubmitSecurityPhone").on('submit', function(e) {
    e.preventDefault();
    var data = new FormData(this);

    $.ajax({
        url: '/user/security/verifyPhone',
        type: 'POST',
        dataType: "json",
        data: data,
        cache: false,
        async: true,
        processData: false,
        contentType: false,
        timeout: 20000, // sets timeout to 20 seconds
        beforeSend: function() {
            $("input[name='code']").attr("disabled", true);
            $("#submitSecurityPhone").attr("disabled", true);
        },
        success: function(data) {
            if (data.msg == 200) {
                window.location = data.redirect;
            } else {
                if (!$.isEmptyObject(data.error) && data.msg != 200) {
                    if (data.error.code_error != '') {
                        $('#code_error').html(data.error.code_error);
                        $('#code').addClass('invalid');
                    } else {
                        $('#code_error').html('');
                        $('#code').removeClass('invalid');
                    }
                } else {
                    Swal.fire('Gagal', data.msg, 'warning');
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            if (textStatus === "timeout" || textStatus === "error") {
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
            $("input[name='code']").attr("disabled", false);
            $("#submitSecurityPhone").attr("disabled", false);
        }
    });
});

$("#btnResendOtp").click(function() {
    $.ajax({
        url: '/user/security/resendOtp',
        type: 'get',
        dataType: "json",
        beforeSend: function() {
            $("#btnResendOtp").attr("disabled", true);
        },
        success: function(data) {
            if ((data.msg == 200)) {
                location.reload();
            } else {
                Swal.fire({
                    type: 'error',
                    text: data.msg,
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        },
        complete: function() {
            $("#btnResendOtp").attr("disabled", false);
        }
    });
});