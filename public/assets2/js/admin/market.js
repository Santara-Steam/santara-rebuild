$(document).ready(function() {
    $("#begin_period").flatpickr({
        enableTime: true,
        altFormat: "Y-m-d H:i",
        dateFormat: "Y-m-d H:i",
        minDate: "today"
    });

    $("#end_period").flatpickr({
        enableTime: true,
        altFormat: "Y-m-d H:i",
        dateFormat: "Y-m-d H:i"
    });

    $('#code_emiten').select2({
        maximumSelectionLength: 2,
        allowClear: true
    });
});

function btnSaveEmitenFundamental() {
    var form = '#formEmitenFundamental';
    var data = $(form).serializeArray();
    $('#fundamentalPerusahaanModal').modal('hide');
    $("#loader").show();
    $.ajax({
        url: '/market/save_emiten_fundamental',
        type: 'POST',
        cache: false,
        data: data,
        timeout: 40000,
        success: function(data) {
            $("#loader").hide();
            data = JSON.parse(data);
            if (data.msg == 200) {
                Swal.fire(
                    'Berhasil',
                    'Data emiten fundamental berhasil disimpan',
                    'success'
                ).then((result) => {
                    window.location = '/user/market/rasioFundamental#pills-fundamentalperusahaan';
                });
            } else {
                Swal.fire("Error!", data.msg, "error");
            }
        },
        error: function(data) {
            $("#loader").hide();
            Swal.fire("Error!", data.msg, "error");
        }
    });
};

$(document).on('click', '.delete-emiten-fundamental', function(){
    var id = $(this).val();

    $.ajax({
        url: '/market/delete_emiten_fundamental/' + id,
        type: 'GET',
        timeout: 20000, // sets timeout to 20 seconds
        cache: false,
        success: function(data) {
            $("#loader").hide();
            data = JSON.parse(data);
            if (data.msg == 200) {
                Swal.fire(
                    'Berhasil',
                    'Data emiten fundamental berhasil dihapus',
                    'success'
                ).then((result) => {
                    location.reload();
                });
            } else {
                Swal.fire("Error!", data.msg, "error");
            }

        },
        error: function(msg) {
            $("#loader").hide();
            Swal.fire("Error!", "Data gagal diambil", "error").then((result) => {
                location.reload();
            });
        }
    });
});
