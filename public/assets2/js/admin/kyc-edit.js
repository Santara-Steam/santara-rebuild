$(document).ready(function() {
    $("#province, #idcard_province").change(function() {
        var province_id = $(this).find(':selected').data('id');
        var name_attr = $(this).attr("name");

        if (province_id != '') {
            $.ajax({
                url: "/user/address/regencybyprovinceid",
                method: "POST",
                data: { province_id: province_id },
                timeout: 20000, // sets timeout to 20 seconds
                beforeSend: function() {
                    $("#loader").show();
                },
                success: function(data) {
                    if (name_attr == 'province') {
                        $('#regency').html(data);
                    }

                    if (name_attr == 'idcard_province') {
                        $('#idcard_regency').html(data);
                    }

                    $("#loader").hide();
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
                }
            });
        } else {
            if (name_attr == 'province') {
                $('#regency').html('<option value="">Pilih Kabupaten</option>');
            }
            if (name_attr == 'idcard_province') {
                $('#idcard_regency').html('<option value="">Pilih Kabupaten</option>');
            }
        }
    });

    $("#photo").fileinput({
        'allowedFileExtensions': ["jpg", "jpeg", "gif", "png"],
        'showUpload': false,
        'maxFileCount': 1,
        'maxFileSize': 10000,
        'showPreview': false,
        'elErrorContainer': "#errorBlockPhoto"
    });

    $("#idcard_photo").fileinput({
        'allowedFileExtensions': ["jpg", "jpeg", "gif", "png"],
        'showUpload': false,
        'maxFileCount': 1,
        'maxFileSize': 10000,
        'showPreview': false,
        'elErrorContainer': "#errorBlockIdcardPhoto"
    });

    $("#verification_photo").fileinput({
        'allowedFileExtensions': ["jpg", "jpeg", "gif", "png"],
        'showUpload': false,
        'maxFileCount': 1,
        'maxFileSize': 10000,
        'showPreview': false,
        'elErrorContainer': "#errorBlockVerificationPhoto"
    });

    $("#securities_account").fileinput({
        'allowedFileExtensions': ["jpg", "jpeg", "gif", "png"],
        'showUpload': false,
        'maxFileCount': 1,
        'maxFileSize': 10000,
        'showPreview': false,
        'elErrorContainer': "#errorBlockSecuritiesAccount"
    });

    $("#company_document").fileinput({
        'allowedFileExtensions': ["pdf"],
        'showUpload': false,
        'maxFileCount': 1,
        'maxFileSize': 5000,
        'showPreview': false,
        'elErrorContainer': "#errorBlockCompanyDocument"
    });

    $("#birth_date, #securities_account_date_registration, #company_date_establishment").flatpickr({
        altFormat: "j F Y",
        dateFormat: "Y-m-d",
        maxDate: 'today'
    });

    $('select').select2({
        maximumSelectionLength: 2,
        allowClear: true
    });
});