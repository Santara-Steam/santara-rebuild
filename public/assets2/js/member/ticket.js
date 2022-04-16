const btnSend = document.getElementById('btnSend');
const comment = document.getElementById('ticket_comment');

btnSend.disabled = true;
comment.addEventListener('keyup', function(e) {
    if ((!is_empty(comment.value) && comment.value.length > 3)) {
        btnSend.disabled = false;
    } else {
        btnSend.disabled = true;
    }
})

$("#btnSend").click(function() {
    var data = {
        ticket_uuid: $("input[name='ticket_uuid']").val(),
        ticket_comment: $("textarea[name='ticket_comment']").val()
    };

    $.ajax({
        url: '/user/ticket/reply',
        type: 'POST',
        dataType: "json",
        data: data,
        beforeSend: function() {
            $("#loader").show();
            $("#btnSend").attr("disabled", true);
            $("input[name='ticket_comment']").attr("disabled", true);
        },
        success: function(data) {

            $("#loader").hide();
            if (data.msg == 401) {
                window.location = '/login/logout';
            }

            if (data.msg == 404 || data.msg == 500 || data.msg == 'failed') {
                Swal.fire("Error!", 'Gagal mengirim pesan', "error");
                location.reload();
            }

            if ($.isEmptyObject(data.error) && (data.msg == 200)) {
                location.reload();
            } else {
                if (data.error.ticket_comment_error != '') {
                    $('#ticket_comment_error').html(data.error.ticket_comment_error);
                    $('#ticket_comment').addClass('invalid');
                } else {
                    $('#ticket_comment_error').html('');
                    $('#ticket_comment').removeClass('invalid');
                }
            }
        },
        complete: function() {
            $("#btnSend").attr("disabled", false);
            $("input[name='ticket_comment']").attr("disabled", false);
            $("#loader").hide();
            ticket_comment = '';
        }
    });
});

function confirmStatus(title, text, link) {
    Swal.fire({
        title: title,
        text: text,
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {

        if (result.value) {
            $.ajax({
                type: 'GET',
                url: link,
                cache: false,
                beforeSend: function() {
                    $("#loader").show();
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.msg == 200) {
                        Swal.fire("Success!", title + ' berhasil dilakukan.', "success").then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Error!", 'Gagal melakukan ' + title + '!', "error");
                    }

                },
                complete: function() {
                    $("#loader").hide();
                },
                error: function(data) {
                    $("#loader").hide();
                    Swal.fire("Error!", 'Gagal melakukan ' + title + '!', "error");
                }
            });

        }
    })
}