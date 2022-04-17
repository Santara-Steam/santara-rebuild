function detailVerificationPhoto(photo) {

    Swal.fire({
        title: "<strong> Bukti Transaksi</strong>",
        imageUrl: photo,
        imageAlt: 'screenshot'
    });
};

$(document).ready(function() {
    $("#verification_photo").fileinput({
        'allowedFileExtensions': ["jpg", "jpeg", "gif", "png"],
        'showUpload': false,
        'maxFileCount': 1,
        'maxFileSize': 10000,
        'showPreview': true,
        'elErrorContainer': "#errorBlockVerificationPhoto"
    });
})

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
                success: function(data) {
                    $("#loader").hide();
                    data = JSON.parse(data);
                    if (data.msg == 200) {
                        Swal.fire("Success!", capitalizeFirstLetter(title) + ' berhasil dilakukan.', "success").then((result) => {
                            window.location = '/user/transactions';
                        });
                    } else {
                        Swal.fire("Error!", capitalizeFirstLetter(title) + ' gagal dilakukan.', "error").then((result) => {
                            location.reload();
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
                    data = JSON.parse(data);
                    if (data.msg == 200) {
                        Swal.fire("Success!", 'Data berhasil dihapus.', "success").then((result) => {
                            window.location = '/user/transactions';
                        });
                    } else {
                        Swal.fire("Error!", "Data gagal dihapus!", "error");
                    }
                },
                error: function() {
                    $("#loader").hide();
                    Swal.fire("Error!", "Data gagal dihapus!", "error");
                }
            });
        }
    })
}

$("#formSubmitPhoto").on('submit', function(e) {
    e.preventDefault();
    var data = new FormData(this);
    $("#loader").show();
    $.ajax({
        url: '/user/uploadadminkonfirmasi',
        type: 'POST',
        dataType: 'json',
        data: data,
        contentType: false,
        processData: false,
        success: function(data) {
            $("#loader").hide();
            if (data.msg == 401) {
                window.location = '/login/logout';
            }

            if (data.msg == 200) {
                Swal.fire("Success!", 'Upload bukti pembayaran berhasil dilakukan.', "success")
                    .then((result) => {
                        location.reload();
                    });
            } else {
                Swal.fire("Error!", 'Permintaan gagal diproses !', "error").then((result) => {
                    location.reload();
                });
            }
        },
        error: function(data) {
            $("#loader").hide();
            Swal.fire("Error!", 'Permintaan gagal diproses !', "error");
        }
    });
})