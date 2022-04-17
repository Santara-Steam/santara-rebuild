$("#submitDividendWallet").click(function () {

    Swal.fire({
        html: ` <div><img src="/assets/images/content/account/password.png" width="35%" alt="security token"></div>
                <div class="mt-1"><b class="swal-popup-title">Masukan PIN Anda</b></div> 
                <div><p style="font-size: .9rem;">Masukan kode 6 angka security pin akun anda</p></div>
                 <p><span id="pin_error" class="text-danger" style="font-size:12px"></span></p>
                 <input type="password" class="form-control form-control-no-radius swal-popup-input" id="pin" onkeypress="return isNumberKey(event)" maxlength="6">`,
        inputAttributes: {
            autocapitalize: 'off'
        },
        customClass: 'swal-popup',
        showCancelButton: false,
        showConfirmButton: true,
        showLoaderOnConfirm: true,
        confirmButtonText: 'Verifikasi',
        footer: '<p class="swal-popup-footer">Lupa PIN ? <a href="/user/security/email">Reset PIN</a></p>',
        onBeforeOpen: function (element) {
            $(element).find('button.swal2-confirm.swal2-styled').toggleClass('swal2-confirm swal2-styled swal2-confirm btn btn-account btn-santara-red d-block')
        },
        preConfirm: function () {
            return new Promise((resolve, reject) => {


                let pin = $('#pin').val()
                if (pin.length < 6) {
                    $("#pin_error").html("silahkan lengkapi PIN anda");
                    $("#pin").addClass("invalid");
                    Swal.enableConfirmButton();
                    Swal.hideLoading();
                } else {
                    $.ajax({
                        url: `/user/dividend/saveWallet`,
                        type: 'POST',
                        data: {
                            pin: pin
                        },
                        dataType: "json",
                        beforeSend: function () {
                            $("#loader").show();
                            $("#submitDividendWallet").attr("disabled", true);
                        },
                        success: function (data) {

                            if (data.msg == 200) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Pengajuan penarikan dividen ke dompet Santara berhasil dilakukan. Pencairan dividen maks. 3x24 jam (hari kerja)',
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    location.reload();
                                })
                            } else {
                                if (!$.isEmptyObject(data.error)) {
                                    if (data.error.pin_error != "") {
                                        $("#pin_error").html(data.error.pin_error);
                                        $("#pin").addClass("invalid");
                                        $("#pin").val("");
                                    } else {
                                        $("#bank_cabangpin_error_error").html("");
                                        $("#pin").removeClass("invalid");
                                    }
                                    Swal.enableConfirmButton();
                                    Swal.hideLoading();
                                } else {

                                    if (data.msg == 'NoVerified') {
                                        $("#loader").hide();
                                        Swal.fire({
                                            title: 'Gagal',
                                            text: 'Data kyc belum lengkap, anda tidak bisa melakukan deposit.',
                                            type: 'error',
                                            showCancelButton: false,
                                            confirmButtonText: 'Ok'
                                        })

                                    } else {
                                        Swal.fire({
                                            title: 'Gagal',
                                            text: data.msg,
                                            type: 'error',
                                            showCancelButton: false,
                                            confirmButtonText: 'Ok'
                                        })
                                    }
                                }
                            }
                        },
                        complete: function () {
                            $("#submitDividendWallet").attr("disabled", false);
                            $("#loader").hide();
                        }
                    });
                }


                // maybe also reject() on some condition
            });
        }
    })
});