function submitVideo(uuid) {

    var data = {
        uuid: $("input[name='uuid']").val(),
        title: $("input[name='title']").val(),
        category: $("select[name='category']").val(),
        description: $("textarea[name='description']").val(),
        link: $("input[name='link']").val()
    };

    $.ajax({
        url: '/video/save',
        type: 'POST',
        dataType: "json",
        data: data,
        timeout: 20000, // sets timeout to 20 seconds
        beforeSend: function() {
            $("#loader").show();
            $("#submitSaveVideo").attr("disabled", true);
            $("input[name='title']").attr("disabled", true);
            $("select[name='category']").attr("disabled", true);
            $("textarea[name='description']").attr("disabled", true);
            $("input[name='link']").attr("disabled", true);
        },
        success: function(data) {
            $("#loader").hide();

            if (data.msg == 401) {
                window.location = '/login/logout';
            }

            if ($.isEmptyObject(data.error) && data.msg == 200) {
                Swal.fire('Berhasil', 'Data video berhasil disimpan', 'success').then((result) => {
                    window.location = '/user/video';
                });
            } else {
                if (data.error.title_error != '') {
                    $('#title_error').html(data.error.title_error);
                    $('#title_error').addClass('invalid');
                } else {
                    $('#title_error').html('');
                    $('#title_error').removeClass('invalid');
                }

                if (data.error.description_error != '') {
                    $('#description_error').html(data.error.description_error);
                    $('#description_error').addClass('invalid');
                } else {
                    $('#description_error').html('');
                    $('#description_error').removeClass('invalid');
                }

                if (data.error.link_error != '') {
                    $('#link_error').html(data.error.link_error);
                    $('#link_error').addClass('invalid');
                } else {
                    $('#link_error').html('');
                    $('#link_error').removeClass('invalid');
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
            $("#submitSaveVideo").attr("disabled", false);
            $("input[name='title']").attr("disabled", false);
            $("select[name='category']").attr("disabled", false);
            $("textarea[name='description']").attr("disabled", false);
            $("input[name='link']").attr("disabled", false);
            $("#loader").hide();
        }
    });
};

function deleteVideo(uuid, video) {
    Swal.fire({
        title: 'Konfirmasi hapus video ?',
        html: 'Apakah anda yakin akan menghapus video <br/><b>"' + video + '"</b> ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $("#loader").show();
            $.ajax({
                url: '/video/delete/' + uuid,
                type: 'GET',
                timeout: 20000, // sets timeout to 20 seconds
                cache: false,
                success: function(data) {

                    $("#loader").hide();
                    if (data) {
                        Swal.fire("Success!", 'Data video berhasil dihapus.', "success").then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Error!", "Data video gagal dihapus!", "error");
                    }
                },
                error: function(msg) {
                    $("#loader").hide();
                    Swal.fire("Error!", "Data video gagal dihapus!", "error");
                }
            });
        }
    });
};


function submitVideoCategory(uuid) {

    var data = {
        uuid: $("input[name='uuid']").val(),
        category: $("input[name='category']").val()
    };

    $.ajax({
        url: '/video_category/save',
        type: 'POST',
        dataType: "json",
        data: data,
        timeout: 20000, // sets timeout to 20 seconds
        beforeSend: function() {
            $("#loader").show();
            $("#submitSaveVideoCategory").attr("disabled", true);
            $("input[name='category']").attr("disabled", true);
        },
        success: function(data) {
            console.log(data);
            $("#loader").hide();

            if (data.msg == 401) {
                window.location = '/login/logout';
            }

            if ($.isEmptyObject(data.error) && data.msg == 200) {
                Swal.fire('Berhasil', 'Kategori video berhasil disimpan', 'success').then((result) => {
                    window.location = '/user/video_category';
                });
            } else if (data.msg == 400) {
                Swal.fire('Info', 'Pastikan melakukan perubahan sebelum menyimpan kategori video.', 'info').then((result) => {
                    location.reload();
                });
            } else {
                Swal.fire('Gagal', 'Gagal menyimpan kategori video', 'error').then((result) => {
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
            $("#submitSaveVideoCategory").attr("disabled", false);
            $("input[name='category']").attr("disabled", false);
            $("#loader").hide();
        }
    });
};

function deleteVideoCategory(uuid, category) {
    Swal.fire({
        title: 'Konfirmasi hapus kategori video ?',
        html: 'Apakah anda yakin akan menghapus kategori video <br/><b>"' + category + '"</b> ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $("#loader").show();
            $.ajax({
                url: '/video_category/delete/' + uuid,
                type: 'GET',
                timeout: 20000, // sets timeout to 20 seconds
                cache: false,
                success: function(data) {

                    $("#loader").hide();
                    if (data) {
                        Swal.fire("Success!", 'Kategori video berhasil dihapus.', "success").then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Error!", "Kategori video gagal dihapus!", "error");
                    }
                },
                error: function(msg) {
                    $("#loader").hide();
                    Swal.fire("Error!", "Kategori video gagal dihapus!", "error");
                }
            });
        }
    });
};

function setVideo(uuid, title, status) {

    var video_status = (status == 1) ? 'nonaktifkan' : 'aktifkan';

    Swal.fire({
        title: "<strong> Konfirmasi " + video_status + " video </strong>",
        html: 'Video <b>' + title + '</b> akan di' + video_status + ' ? ',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $("#loader").show();
            $.ajax({
                type: 'GET',
                url: "/video/setstatus/" + uuid + "/" + status,
                cache: false,
                success: function(data) {
                    $("#loader").hide();
                    if (data) {
                        Swal.fire(
                            'Berhasil',
                            'Video berhasil di' + video_status,
                            'success'
                        ).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Error!", 'Video gagal di' + video_status, "error").then((result) => {
                            location.reload();
                        });
                    }

                },
                error: function(data) {
                    $("#loader").hide();
                    Swal.fire("Error!", 'Gagal melakukan verifikasi', "error").then((result) => {
                        location.reload();
                    });
                }
            });

        }
    });
};