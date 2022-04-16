$(document).ready(function() {
    $('select').select2({
        maximumSelectionLength: 2,
        allowClear: true
    });

    $("#start_date").flatpickr({
        altFormat: "j F Y",
        dateFormat: "Y-m-d",
        minDate: "today"
    });

    $("#finish_date").flatpickr({
        altFormat: "j F Y",
        dateFormat: "Y-m-d"
    });

    $("#website_pict").fileinput({
        'allowedFileExtensions': ["jpg", "jpeg", "gif", "png"],
        'showUpload': false,
        'showRemove': false,
        'maxFileCount': 1,
        'maxFileSize': 10000,
        'elErrorContainer': "#errorBlockWebsitePict"
    });

    $("#mobile_pict").fileinput({
        'allowedFileExtensions': ["jpg", "jpeg", "gif", "png"],
        'showUpload': false,
        'showRemove': false,
        'maxFileCount': 1,
        'maxFileSize': 10000,
        'elErrorContainer': "#errorBlockMobilePict"
    });

    const start_date = document.getElementById('start_date');
    start_date.addEventListener('change', function() {
        var startDate = start_date.value;
        var finishDate = new Date();
        finishDate.setDate(new Date(startDate).getDate() + 60);

        flatpickr('#finish_date', {
            minDate: startDate,
            maxDate: finishDate,
            altFormat: "j F Y",
            dateFormat: "Y-m-d"
        });
    })
});


$("#formSubmitPopup").on('submit', function(e) {
    e.preventDefault();
    var data = new FormData(this);
    var url = '/user/popup/save';

    if ((data.get('mobile_pict').size > 0) && (data.get('website_pict').size > 0)) {
        $.ajax({
            contentType: 'application/json; charset=utf-8',
            url: '/user/popup/active',
            dataType: "json",
            success: function(result) {

                if (result.active != 0) {
                    Swal.fire({
                        title: 'Masih ada popup yang aktif',
                        text: 'Kamu memiliki popup yang masih aktif saat ini, sistem hanya mengizinkan 1 popup yang aktif',
                        type: 'info',
                        showCloseButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Simpan dan aktifkan',
                        cancelButtonText: 'Simpan dan nonaktifkan'
                    }).then((result) => {
                        if (result.value) {
                            data.set('is_active', 1);
                            savePopup(data, url);
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            data.set('is_active', 0);
                            savePopup(data, url);
                        }
                    })
                } else {
                    savePopup(data, url);
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr, status, error);
            }
        });
    } else {
        if (data.get('mobile_pict').size == 0) {
            $('#mobile_pict_error').html("Gambar aplikasi wajib diisi");
        } else {
            $('#mobile_pict_error').html("");
        }

        if (data.get('website_pict').size == 0) {
            $('#website_pict_error').html("Gambar website wajib diisi");
        } else {
            $('#website_pict_error').html("");
        }
    }



});

$("#formUpdatePopup").on('submit', function(e) {
    e.preventDefault();
    var data = new FormData(this);
    var url = '/user/popup/update';
    $("#loader").show();
    $.ajax({
        contentType: 'application/json; charset=utf-8',
        url: '/user/popup/active',
        dataType: "json",
        success: function(result) {
            $("#loader").hide();
            if (result.active != 0) {
                Swal.fire({
                    title: 'Masih ada popup yang aktif',
                    text: 'Kamu memiliki popup yang masih aktif saat ini, sistem hanya mengizinkan 1 popup yang aktif',
                    type: 'info',
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Simpan dan aktifkan',
                    cancelButtonText: 'Simpan dan nonaktifkan'
                }).then((result) => {
                    if (result.value) {
                        data.set('is_active', 1);
                        savePopup(data, url);
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        data.set('is_active', 0);
                        savePopup(data, url);
                    }
                })
            } else {
                savePopup(data, url);
            }
        },
        error: function(xhr, status, error) {
            $("#loader").hide();
            console.log(xhr, status, error);
        }
    });

});

function savePopup(data, url) {
    $.ajax({
        url: url,
        type: 'POST',
        dataType: "json",
        data: data,
        cache: false,
        async: true,
        processData: false,
        contentType: false,
        timeout: 60000, // sets timeout to 20 seconds
        beforeSend: function() {
            $("#loader").show();
            $("input[name='title']").attr("disabled", true);
            $("input[name='start_date']").attr("disabled", true);
            $("input[name='finish_date']").attr("disabled", true);
            $("input[name='website_url']").attr("disabled", true);
            $("input[name='mobile_url']").attr("disabled", true);
        },
        success: function(data) {

            if (data.msg == 401) {
                window.location = '/login/logout';
            }

            if (data.msg == 0) {
                $("#loader").hide();
                Swal.fire('Gagal', 'Mohon periksa kembali file foto anda. Sistem hanya dapat menerima file dengan format gambar', 'info').then((result) => {
                    location.reload();
                });
            }

            if (data.msg == 404) {
                $("#loader").hide();
                Swal.fire('Gagal', 'Koneksi bermasalah', 'info').then((result) => {
                    location.reload();
                });
            }

            if ($.isEmptyObject(data.error)) {
                $("#loader").hide();
                if (data.msg == 200) {
                    Swal.fire('Berhasil', 'Data popup berhasil disimpan', 'success').then((result) => {
                        window.location = '/user/popup';
                    });
                } else {
                    Swal.fire('Gagal', 'Gagal menyimpan data popup', 'info').then((result) => {
                        location.reload();
                    });
                }
            } else {
                if (data.error.title_error != '') {
                    $('#title_error').html(data.error.title_error);
                    $('#title').addClass('invalid');
                } else {
                    $('#title_error').html('');
                    $('#title').removeClass('invalid');
                }

                if (data.error.start_date_error != '') {
                    $('#start_date_error').html(data.error.start_date_error);
                    $('#start_date').addClass('invalid');
                } else {
                    $('#start_date_error').html('');
                    $('#start_date').removeClass('invalid');
                }

                if (data.error.finish_date_error != '') {
                    $('#finish_date_error').html(data.error.finish_date_error);
                    $('#finish_date').addClass('invalid');
                } else {
                    $('#finish_date_error').html('');
                    $('#finish_date').removeClass('invalid');
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
            $("input[name='title']").attr("disabled", false);
            $("input[name='start_date']").attr("disabled", false);
            $("input[name='finish_date']").attr("disabled", false);
            $("input[name='website_url']").attr("disabled", false);
            $("input[name='mobile_url']").attr("disabled", false);
            $("#loader").hide();
        }
    });
}

function deletePopup(uuid, title) {
    Swal.fire({
        title: 'Konfirmasi hapus Popup ?',
        html: 'Apakah anda yakin akan menghapus popup <br/><b>"' + title + '"</b> ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $("#loader").show();
            $.ajax({
                url: '/user/popup/delete/' + uuid,
                type: 'GET',
                timeout: 20000, // sets timeout to 20 seconds
                cache: false,
                success: function(data) {

                    $("#loader").hide();
                    if (data) {
                        Swal.fire("Success!", 'Data popup berhasil dihapus.', "success").then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Error!", "Data popup gagal dihapus!", "error").then((result) => {
                            location.reload();
                        });
                    }
                },
                error: function(msg) {
                    $("#loader").hide();
                    Swal.fire("Error!", "Data popup gagal dihapus!", "error").then((result) => {
                        location.reload();
                    });
                }
            });
        }
    });
};