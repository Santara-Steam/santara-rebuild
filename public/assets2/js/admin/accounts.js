function remove(link, id) {
    Swal.fire({
        title: 'Apakan anda yakin ?',
        text: 'Data yang sudah dihapus tidak dapat dikembalikan!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {

        if (result.value) {
            $("#loader").show();
            $.ajax({
                type: 'POST',
                url: link,
                data: 'id=' + id,
                cache: false,
                success: function(data) {
                    data = JSON.parse(data);
                    $("#loader").hide();
                    if (data.msg == 200) {
                        Swal.fire("Success!", 'Data berhasil dihapus.', "success").then((result) => {
                            window.location = '/user/accounts';
                        });
                    } else {
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
}

function resetAttempt(link, id) {
    Swal.fire({
        title: 'Reset permintaan ulang password ?',
        text: 'Permintaan password dari user akan direset',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {

        if (result.value) {
            $("#loader").show();
            $.ajax({
                type: 'POST',
                url: link,
                data: 'id=' + id,
                cache: false,
                success: function(data) {
                    data = JSON.parse(data);
                    $("#loader").hide();
                    if (data.msg == 200) {
                        Swal.fire("Success!", 'Data berhasil direset.', "success").then((result) => {
                            window.location = '/user/accounts';
                        });
                    } else {
                        Swal.fire("Error!", "Data gagal direset!", "error");
                    }
                },
                error: function(msg) {
                    $("#loader").hide();
                    Swal.fire("Error!", "Data gagal direset!", "error");
                }
            });
        }
    })
}

function submitAccount(url) {

    var data = {
        uuid: $("input[name='uuid']").val(),
        email: $("input[name='email']").val(),
        phone: $("input[name='phone']").val(),
        is_verified: $("select[name='is_verified']").val(),
        trader_is_verified: $("select[name='trader_is_verified']").val(),
        is_otp: $("select[name='is_otp']").val(),
        is_logged_in: $("select[name='is_logged_in']").val(),
        attempt: $("select[name='attempt']").val()
    };

    $.ajax({
        url: url,
        type: 'POST',
        dataType: "json",
        data: data,
        timeout: 20000, // sets timeout to 20 seconds
        beforeSend: function() {
            $("#loader").show();
            $("#submitAccountButton").attr("disabled", true);
            $("input[name='email']").attr("disabled", true);
            $("input[name='phone']").attr("disabled", true);
            $("select[name='is_verified']").attr("disabled", true);
            $("select[name='trader_is_verified']").attr("disabled", true);
            $("select[name='is_otp']").attr("disabled", true);
            $("select[name='is_logged_in']").attr("disabled", true);
            $("select[name='attempt']").attr("disabled", true);
        },
        success: function(data) {
            $("#loader").hide();

            if (data.msg == 401) {
                window.location = '/login/logout';
            }

            if ($.isEmptyObject(data.error) && data.msg == 200) {
                Swal.fire('Berhasil', 'Data account berhasil disimpan', 'success').then((result) => {
                    location.reload();
                });
            } else {
                if (data.error.email_error != '') {
                    $('#email_error').html(data.error.email_error);
                    $('#email_error').addClass('invalid');
                } else {
                    $('#email_error').html('');
                    $('#email_error').removeClass('invalid');
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
            $("#submitAccountButton").attr("disabled", false);
            $("input[name='email']").attr("disabled", false);
            $("input[name='phone']").attr("disabled", false);
            $("select[name='is_verified']").attr("disabled", false);
            $("select[name='trader_is_verified']").attr("disabled", false);
            $("select[name='is_otp']").attr("disabled", false);
            $("select[name='is_logged_in']").attr("disabled", false);
            $("select[name='attempt']").attr("disabled", false);
            $("#loader").hide();
        }
    });
};