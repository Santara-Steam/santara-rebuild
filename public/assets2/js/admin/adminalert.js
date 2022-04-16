function confirm(title, text, link) {
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
            $.ajax({
                type: 'GET',
                url: link,
                cache: false,
                success: function(msg) {
                    $("#loader").hide();
                    Swal.fire("Success!", title + ' berhasil dilakukan.', "success")
                        .then((result) => {
                            window.location = '/user/transactions';
                        });

                },
                error: function(msg) {
                    $("#loader").hide();
                    Swal.fire("Error!", 'Permintaan gagal diproses !', "error");
                }
            });
        }
    })
}

function confirmPost(title, text, url, data) {
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
            $.ajax({
                url: url,
                type: 'POST',
                dataType: "json",
                data: { data },
                success: function(data) {
                    $("#loader").hide();
                    if (data.msg == 401) {
                        window.location = '/login/logout';
                    }

                    if (data.msg == 200) {
                        Swal.fire("Success!", title + ' berhasil dilakukan.', "success")
                            .then((result) => {
                                window.location = '/user/transactions';
                            });
                    } else {
                        Swal.fire("Error!", 'Permintaan gagal diproses !', "error").then((result) => {
                            window.location = '/user/transactions';
                        });
                    }
                },
                error: function(data) {
                    $("#loader").hide();
                    Swal.fire("Error!", 'Permintaan gagal diproses !', "error");
                }
            });
        }
    })
}

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
                    $("#loader").hide();
                    Swal.fire("Success!", 'Data berhasil dihapus.', "success").then((result) => {
                        window.location = '/user/transactions';
                    });
                },
                error: function(msg) {
                    $("#loader").hide();
                    Swal.fire("Error!", "Data gagal dihapus!", "error");
                }
            });
        }
    })
}

function confirmPayment(link) {
    $("#loader").show();
    $.ajax({
        type: 'GET',
        url: link,
        cache: false,
        success: function(data) {
            $("#loader").hide();
            data = JSON.parse(data);

            if (data.msg == 200) {
                Swal.fire("Success!", 'Checkout berhasil dilakukan.', "success")
                    .then((result) => {
                        window.location = '/user/';
                    });
            } else {
                Swal.fire("Error!", data.msg, "error").then((result) => {
                    window.location = '/';
                });
            }
        },
        error: function(data) {
            $("#loader").hide();
            Swal.fire("Error!", 'Permintaan gagal diproses !', "error");
        }
    });
}