function verifiedLaporan(id){
    Swal.fire({
        title: 'Konfirmasi Verifikasi',
        text: 'Apakah anda yakin ingin memverifikasi laporan keuangan ini ?',
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {

        if (result.value) {
            $("#loader").show();
            var data = {
                id: id,
                status: 'verified',
                editable: ($('#editable_'+id).is(':checked')) ? 1 : 0
            };

            $.ajax({
                type: 'POST',
                url: "/user/laporan-keuangan/confirmLaporan/",
                data: data,
                success: function(data) {
                    data = JSON.parse(data);
                    $("#loader").hide();
                    if (data.msg == 200) {
                        Swal.fire(
                            'Berhasil',
                            'Konfirmasi laporan keuangan berhasil dilakukan',
                            'success'
                        ).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Error!", data.msg, "error");
                    }
                },
                error: function(data) {
                    $("#loader").hide();
                    Swal.fire("Error!", "Data gagal diverifikasi!", "error");
                }
            });
        }
    })
}

function rejectedLaporan(id){
    Swal.fire({
        title: "<strong> Konfirmasi Penolakan </strong>",
        text: 'Masukan alasan penolakan',
        input: 'text',
        showCancelButton: true,
        confirmButtonText: 'Ya, Tolak',
        cancelButtonText: 'Tidak',
        reverseButtons: true,
        preConfirm: (input) => {
            if (input === '') {
                Swal.showValidationMessage('alasan penolakan tidak boleh kosong')
            } else {
                $("#loader").show();
                var data = {
                    id: id,
                    reason: input,
                    status: 'rejected',
                    editable: ($('#editable_'+id).is(':checked')) ? 1 : 0
                };

                $.ajax({
                    type: 'POST',
                    url: "/user/laporan-keuangan/confirmLaporan/",
                    dataType: "json",
                    data: data,
                    success: function(data) {
                        $("#loader").hide();
                        if (data.msg == 200) {
                            Swal.fire(
                                'Berhasil',
                                'Penolakan laporan keuangan berhasil dilakukan',
                                'success'
                            ).then((result) => {
                                location.reload();
                            });
                        } else {
                            Swal.fire("Error!", data.msg, "error").then((result) => {
                                location.reload();
                            });
                        }
                    },
                    error: function(data) {
                        $("#loader").hide();
                        Swal.fire("Error!", 'Permintaan gagal dilakukan', "error").then((result) => {
                            location.reload();
                        });
                    }
                });
            }
        }

    });
}