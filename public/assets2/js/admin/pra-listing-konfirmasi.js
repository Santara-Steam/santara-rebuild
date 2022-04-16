var form = $("#formSubmitBisnis").show();
form.steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    enableAllSteps: true,
    enablePagination: false,
    titleTemplate: '<span class="step">#index#</span> #title#'
});

function acceptPraListing(uuid, status, status_title) {

    Swal.fire({
        text: status_title + ' bisnis ini ? ',
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            var data = { uuid, status };
            $.ajax({
                url: '/user/pralisting/acceptpralisting/',
                type: 'POST',
                dataType: "json",
                data: data,
                timeout: 20000,
                beforeSend: function() {
                    $("#loader").show();
                },
                success: function(data) {
                    $("#loader").hide();

                    if (data.msg == 200) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Berhasil ' + status_title + ' bisnis',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            window.location = '/user/pralisting/list';
                        })
                    } else {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Gagal ' + status_title + ' bisnis',
                            type: 'warning',
                            showCancelButton: false,
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            window.location = '/user/pralisting/list';
                        })
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
    })
}


function rejectPralisting(uuid, status) {
    Swal.fire({
        title: "Tolak Bisnis",
        text: 'Masukan alasan penolakan bisnis',
        input: 'text',
        showCancelButton: true,
        confirmButtonText: 'Ya, Tolak',
        cancelButtonText: 'Tidak',
        reverseButtons: true,
        preConfirm: (input) => {
            if (input === '') {
                Swal.showValidationMessage('alasan penolakan tidak boleh kosong')
            } else {
                var data = { uuid, status, input };

                $.ajax({
                    url: '/user/pralisting/acceptpralisting/',
                    type: 'POST',
                    dataType: "json",
                    data: data,
                    timeout: 20000,
                    success: function(data) {
                        $("#loader").hide();

                        if (data.msg == 200) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'Penolakan bisnis berhasil dilakukan',
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                window.location = '/user/pralisting/list';
                            })
                        } else {
                            Swal.fire({
                                title: 'Gagal',
                                text: 'Penolakan bisnis gagal dilakukan',
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'Ok'
                            })
                        }
                    },
                    error: function(data) {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Penolakan bisnis gagal dilakukan',
                            type: 'warning',
                            showCancelButton: false,
                            confirmButtonText: 'Ok'
                        })
                    }
                });
            }
        }

    });
}

function acceptOfficial(uuid, status) {
    Swal.fire({
        text: 'Jadikan Penerbit Official ? ',
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            var data = { uuid, status };
            $.ajax({
                url: '/user/pralisting/acceptoffice/',
                type: 'POST',
                dataType: "json",
                data: data,
                timeout: 20000,
                beforeSend: function() {
                    $("#loader").show();
                },
                success: function(data) {
                    $("#loader").hide();

                    if (data.msg == 200) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Berhasil verifikasi bisnis',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            window.location = '/user/pralisting/list';
                        })
                    } else {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Gagal verifikasi bisnis',
                            type: 'warning',
                            showCancelButton: false,
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            window.location = '/user/pralisting/list';
                        })
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
    })
}