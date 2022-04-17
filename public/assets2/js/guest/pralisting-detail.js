var swiper = new Swiper('.swiper-container', {
    // Enable lazy loading
    lazy: true,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        dynamicBullets: true
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

});

const btnSendComment = document.getElementById('btnSendComment');
const comment = document.getElementById('comment');

btnSendComment.disabled = true;
comment.addEventListener('keyup', function(e) {
    if ((!is_empty(comment.value) && comment.value.length > 3)) {
        btnSendComment.disabled = false;
    } else {
        btnSendComment.disabled = true;
    }
})

$("#btnSendComment").click(function() {
    var data = {
        uuid: $("input[name='uuid']").val(),
        comment: $("textarea[name='comment']").val()
    };

    $.ajax({
        url: '/pra-listing/comment',
        type: 'POST',
        dataType: "json",
        data: data,
        beforeSend: function() {
            $("#btnSendComment").attr("disabled", true);
            $("input[name='comment']").attr("disabled", true);
        },
        success: function(data) {
            if ((data.msg == 200)) {
                location.reload();
            } else {
                if (!$.isEmptyObject(data.error)) {
                    if (data.error.comment_error != '') {
                        $('#comment_error').html(data.error.comment_error);
                        $('#comment').addClass('invalid');
                    } else {
                        $('#comment_error').html('');
                        $('#comment').removeClass('invalid');
                    }
                } else {
                    Swal.fire({
                        type: 'error',
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        },
        complete: function() {
            $("#btnSendComment").attr("disabled", false);
            $("input[name='comment']").attr("disabled", false);
            comment = '';
        }
    });
});

function sendReplayComment(uuid) {
    var uuid = document.getElementById('replayuuid').value;
    var comment = document.getElementById('replaycomment').value;
    var data = { uuid, comment };

    $.ajax({
        url: '/pra-listing/replaycomment',
        type: 'POST',
        dataType: "json",
        data: data,
        beforeSend: function() {
            $("#btnSendComment").attr("disabled", true);
            $("input[name='replaycomment']").attr("disabled", true);
        },
        success: function(data) {
            if ((data.msg == 200)) {
                $('#replayCommentModal').modal('hide');
                location.reload();
            } else {
                if (!$.isEmptyObject(data.error)) {
                    if (data.error.comment_error != '') {
                        $('#comment_error').html(data.error.comment_error);
                        $('#comment').addClass('invalid');
                    } else {
                        $('#comment_error').html('');
                        $('#comment').removeClass('invalid');
                    }
                } else {
                    Swal.fire({
                        type: 'error',
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        },
        complete: function() {
            $("#btnSendComment").attr("disabled", false);
            $("input[name='replaycomment']").attr("disabled", false);
            comment = '';
        }
    });
};

function sendReportComment() {
    var uuid = document.getElementById('reportuuid').value;
    var description = null;
    var description = document.getElementById('reportdescription').value;

    var data = { uuid, description };

    $.ajax({
        url: '/pra-listing/reportcomment',
        type: 'POST',
        dataType: "json",
        data: data,
        beforeSend: function() {
            $("#btnReportComment").attr("disabled", true);
            $("input[name='reportdescription']").attr("disabled", true);
        },
        success: function(data) {
            if ((data.msg == 200)) {
                $('#reportCommentModal').modal('hide');
                Swal.fire({
                    type: 'success',
                    title: 'Komentar berhasil dilaporkan',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    location.reload();
                });
            } else {
                if (!$.isEmptyObject(data.error)) {
                    if (data.error.description_error != '') {
                        $('#description_error').html(data.error.description_error);
                        $('#description').addClass('invalid');
                    } else {
                        $('#description_error').html('');
                        $('#description').removeClass('invalid');
                    }
                } else {
                    Swal.fire({
                        type: 'error',
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        },
        complete: function() {
            $("#btnReportComment").attr("disabled", false);
            $("input[name='reportdescription']").attr("disabled", false);
            description = '';
        }
    });
};

function deleteComment(uuid) {
    Swal.fire({
        text: 'Apakah anda yakin akan menghapus komentar anda ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '/pra-listing/deletecomment/' + uuid,
                type: 'GET',
                timeout: 20000, // sets timeout to 20 seconds
                cache: false,
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.msg == 200) {
                        Swal.fire({
                            type: 'success',
                            title: 'Komentar berhasil dihapus',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: data.msg,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        type: 'error',
                        title: 'Komentar gagal dihapus',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }
    });
};

function sendInvestmentPlan(emiten_uuid) {
    var amount = document.getElementById('investmentplan').value.replace(/\./g, '');
    var data = { emiten_uuid, amount };

    $.ajax({
        url: '/pra-listing/investmentplan',
        type: 'POST',
        dataType: "json",
        data: data,
        beforeSend: function() {
            $("#btnInvestmentPlan").attr("disabled", true);
            $("input[name='investmentplan']").attr("disabled", true);
        },
        success: function(data) {
            if ((data.msg == 200)) {
                location.reload();
            } else {
                if (!$.isEmptyObject(data.error)) {
                    if (data.error.investmentplan_error != '') {
                        $('#investmentplan_error').html(data.error.investmentplan_error);
                        $('#investmentplan').addClass('invalid');
                    } else {
                        $('#investmentplan_error').html('');
                        $('#cinvestmentplan').removeClass('invalid');
                    }
                } else {
                    Swal.fire({
                        type: 'error',
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        },
        complete: function() {
            $("#btnInvestmentPlan").attr("disabled", false);
            $("input[name='investmentplan']").attr("disabled", false);
            investmentplan = '';
        }
    });
};

function sendLike(uuid) {
    $.ajax({
        url: '/pra-listing/like/' + uuid,
        type: 'GET',
        timeout: 20000, // sets timeout to 20 seconds
        cache: false,
        success: function(data) {
            data = JSON.parse(data);
            if (data.msg == 200) {
                location.reload();
            } else {
                Swal.fire({
                    type: 'error',
                    title: "Gagal",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        },
        error: function() {
            Swal.fire({
                type: 'error',
                title: "Gagal",
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
};

function sendVote(uuid, is_vote, investment_plan) {
    var data = { uuid, is_vote, investment_plan };
    $.ajax({
        url: '/pra-listing/vote/',
        type: 'POST',
        dataType: "json",
        data: data,
        success: function(data) {
            if (data.msg == 200) {
                location.reload();
            } else {
                Swal.fire({
                    type: 'error',
                    title: "Gagal",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        },
        error: function() {
            Swal.fire({
                type: 'error',
                title: "Gagal",
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
};

function reportComment(uuid, text) {
    $('#reportCommentModal').modal('show');
    $('#reportCommentModal').find('.modal-body #commenttext').text(text);
    $('#reportCommentModal').find('.modal-body #reportuuid').val(uuid);
    $("#btnReportComment").prop('disabled', true);
}

function replayComment(uuid, text) {
    $('#replayCommentModal').modal('show');
    $('#replayCommentModal').find('.modal-body #commenttext').text(text);
    $('#replayCommentModal').find('.modal-body #replayuuid').val(uuid);
    $("#btnReplayComment").prop('disabled', true);
}

$('#reportdescription').on('keyup change blur input', function() {
    document.querySelector('input[name="reportdescription"]').checked = false;

    if ($(this).val().length > 3) {
        $("#btnReportComment").prop('disabled', false);
    } else {
        $("#btnReportComment").prop('disabled', true);
    }
})

$('#replaycomment').on('keyup change blur input', function() {
    if ($(this).val().length > 3) {
        $("#btnReplayComment").prop('disabled', false);
    } else {
        $("#btnReplayComment").prop('disabled', true);
    }
})

function checkReportDesc() {
    var report = document.querySelector('input[name="reportdescription"]:checked').value;
    $('#reportdescription').val(report);
    if ($('#reportdescription').val().length > 3) {
        $("#btnReportComment").prop('disabled', false);
    }
}

$('#investmentplan').on('keyup change blur input', function() {
    var max = document.getElementById('capitalneeds').value;
    var invest = $(this).val().replace(/\./g, '')

    if ((Number(invest) > 0) && (Number(invest) <= max)) {
        $("#btnInvestmentPlan").prop('disabled', false);
    } else {
        $("#btnInvestmentPlan").prop('disabled', true);
    }
})

function loadMoreComments(uuid, comment_count) {
    $("#button-read-more").hide();
    $("#spinner-item").show();

    $.post("/pra-listing/getDetailComment", { uuid })
        .done(function(data) {
            data = JSON.parse(data);
            let html = data.html;
            $('#list-pralisting-comments').append(html);
            $("#list-pralisting-comments").show();
            $("#spinner-item").hide();
            $('#comment_count').html(comment_count);
        });
}