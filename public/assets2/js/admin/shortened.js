$("#submitShortened").click(function() {
    var data = {
        title: $("input[name='title']").val(),
        url: $("input[name='url']").val(),
        link: $("input[name='link']").val(),
    };

    $.ajax({
        url: '/user/shortened/insert',
        type: 'POST',
        dataType: "json",
        data: data,
        beforeSend: function() {
            $("#loader").show();
            $("#submitShortened").attr("disabled", true);
            $("input[name='title']").attr("disabled", true);
            $("input[name='url']").attr("disabled", true);
            $("input[name='link']").attr("disabled", true);
        },
        success: function(data) {
            $("#loader").hide();
            if (data.msg == 400) {
                Swal.fire("Error!", 'Gagal menambahkan shortened', "error");
                location.reload();
            }

            if ($.isEmptyObject(data.error) && (data.msg == 200)) {
                window.location = '/user/shortened';
            } else {
                if (data.error.title_error != '') {
                    $('#title_error').html(data.error.title_error);
                    $('#title').addClass('invalid');
                } else {
                    $('#title_error').html('');
                    $('#title').removeClass('invalid');
                }

                if (data.error.url_error != '') {
                    $('#url_error').html(data.error.url_error);
                    $('#url').addClass('invalid');
                } else {
                    $('#url_error').html('');
                    $('#url').removeClass('invalid');
                }

                if (data.error.link_error != '') {
                    $('#link_error').html(data.error.link_error);
                    $('#link').addClass('invalid');
                } else {
                    $('#link_error').html('');
                    $('#link').removeClass('invalid');
                }
            }
        },
        complete: function() {
            $("#submitShortened").attr("disabled", false);
            $("input[name='title']").attr("disabled", false);
            $("input[name='url']").attr("disabled", false);
            $("input[name='link']").attr("disabled", false);
            $("#loader").hide();
            ticket_comment = '';
        }
    });
});

$("#updateShortened").click(function() {
    var data = {
        uuid: $("input[name='uuid']").val(),
        title: $("input[name='title']").val(),
        url: $("input[name='url']").val(),
        link: $("input[name='link']").val(),
    };

    $.ajax({
        url: '/user/shortened/update',
        type: 'POST',
        dataType: "json",
        data: data,
        beforeSend: function() {
            $("#loader").show();
            $("#updateShortened").attr("disabled", true);
            $("input[name='title']").attr("disabled", true);
            $("input[name='url']").attr("disabled", true);
            $("input[name='link']").attr("disabled", true);
        },
        success: function(data) {
            $("#loader").hide();
            if (data.msg == 400) {
                Swal.fire("Error!", 'Gagal menambahkan shortened', "error");
                location.reload();
            }

            if ($.isEmptyObject(data.error) && (data.msg == 200)) {
                window.location = '/user/shortened';
            } else {
                if (data.error.title_error != '') {
                    $('#title_error').html(data.error.title_error);
                    $('#title').addClass('invalid');
                } else {
                    $('#title_error').html('');
                    $('#title').removeClass('invalid');
                }

                if (data.error.url_error != '') {
                    $('#url_error').html(data.error.url_error);
                    $('#url').addClass('invalid');
                } else {
                    $('#url_error').html('');
                    $('#url').removeClass('invalid');
                }

                if (data.error.link_error != '') {
                    $('#link_error').html(data.error.link_error);
                    $('#link').addClass('invalid');
                } else {
                    $('#link_error').html('');
                    $('#link').removeClass('invalid');
                }
            }
        },
        complete: function() {
            $("#updateShortened").attr("disabled", false);
            $("input[name='title']").attr("disabled", false);
            $("input[name='url']").attr("disabled", false);
            $("input[name='link']").attr("disabled", false);
            $("#loader").hide();
            ticket_comment = '';
        }
    });
});

function deleteShortened(uuid, title) {
    Swal.fire({
        html: '<strong>Yakin menghapus link <b>' + title + '</b> ? </strong>',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {

        if (result.value) {
            $("#loader").show();
            $.ajax({
                type: 'GET',
                url: '/user/shortened/delete/' + uuid,
                cache: false,
                success: function(data) {
                    data = JSON.parse(data);
                    $("#loader").hide();

                    if (data.msg == 200) {
                        Swal.fire("Success!", 'Data berhasil dihapus.', "success").then((result) => {
                            location.reload();
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