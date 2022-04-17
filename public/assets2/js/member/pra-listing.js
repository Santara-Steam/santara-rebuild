$(document).ready(function () {
    $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

    var table = $("#datatable").DataTable({
        buttons: [
            'print', 'csv'
        ],
        initComplete: function () {
            var api = this.api();
            var textBox = $('#datatable_filter label input');
            textBox.unbind();
            textBox.bind('keyup input', function (e) {
                if (e.keyCode == 8 && !textBox.val() || e.keyCode == 46 && !textBox.val()) {
                    // do nothing ¯\_(ツ)_/¯
                } else if (e.keyCode == 13 || !textBox.val()) {
                    api.search(this.value).draw();
                }
            });
        },
        search: {
            "caseInsensitive": false
        },
        scrollX: true,
        oLanguage: {
            sProcessing: '<div id="tableloading" class="tableloading"></div>'
        },
        processing: true,
        serverSide: true,
        searching: false,
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        bInfo: false,
        ajax: {
            "url": "/user/pralisting/get_bisnis_list",
            "type": "POST"
        },
        order: [
            [0, 'desc']
        ],
        columnDefs: [{
            "targets": [1, 2, 3, 5, 6, 7, 8],
            "orderable": false
        }],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        }

    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        table.columns.adjust().oScroller.fnMeasure();
    });


    $(".business_entity").change(function (e) {
        if ($('#no_business_entity').is(':checked')) {
            $("#document_business_entity_row").css("display", "none");
        } else {
            $("#document_business_entity_row").css("display", "");
        };
    }).change();

    $('select').select2({
        maximumSelectionLength: 2,
        allowClear: true
    });

    $('#category').change(function () {
        var id = $(this).val();
        $.ajax({
            url: "/user/pralisting/getSubCategory",
            method: "POST",
            data: {
                id: id
            },
            success: function (data) {
                $('#subcategory').html("");
                $('#subcategory').html(data);
            }
        });
        return false;
    });

    $("#document_business_entity").fileinput({
        'allowedFileExtensions': ["pdf"],
        'showUpload': false,
        'maxFileCount': 1,
        'maxFileSize': 5000,
        'showPreview': false,
        'elErrorContainer': "#errorBlockDocumentBusinessEntity"
    });

    $("#prospektus").fileinput({
        'allowedFileExtensions': ["pdf"],
        'showUpload': false,
        'maxFileCount': 1,
        'maxFileSize': 25000,
        'showPreview': false,
        'elErrorContainer': "#errorBlockProspektus"
    });

    $("#pictures").fileinput({
        'allowedFileExtensions': ["jpg", "jpeg", "gif", "png"],
        'showUpload': false,
        'showPreview': false,
        'maxFileCount': 10,
        'maxFileSize': 20000,
        'elErrorContainer': "#errorBlockPictures"
    });

    var counter = 1;
    $("#addTeam").click(function () {

        var newProfileTeam = $(document.createElement('div')).attr("id", 'profile_team_' + counter);
        newProfileTeam.after().html('<div class="row" id="profile_team_1">' +
            '<div class="form-group col-md-6">' +
            '<label>Nama</label>' +
            '<input type="text" class="form-control" name="nama_team" id="nama_team_' + counter + '" minlength="5" placeholder="Contoh: Nama Satu"/>' +
            '<span id="nama_team_error" class="text-danger"></span>' +
            '</div>' +
            '<div class="form-group col-md-6">' +
            '<label>Jabatan</label>' +
            '<input type="text" class="form-control" name="jabatan_team" id="jabatan_team_' + counter + '" minlength="5" placeholder="Contoh: Jabatan Satu"/>' +
            '<span id="jabatan_team_error" class="text-danger"></span>' +
            '</div>' +
            '</div>');

        newProfileTeam.appendTo("#profile_team_box");
        counter++;
    });

    $("#removeTeam").click(function () {
        if (counter > 1) {
            counter--;
            $("#profile_team_" + counter).remove();
        }
    });
});

setTimeout(() => {
    window.location.pathname = '/user';
}, 500);

function deleteBisnis(uuid) {
    Swal.fire({
        html: '<strong>Yakin menghapus bisnis ? </strong>',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $("#loader").show();
            $.ajax({
                type: 'GET',
                url: '/user/pralisting/delete/' + uuid,
                cache: false,
                success: function (data) {
                    $("#loader").hide();
                    data = JSON.parse(data);
                    if (data.msg == 200) {
                        Swal.fire("Success!", 'Data berhasil dihapus.', "success").then((result) => {
                            window.location = '/user/pralisting/list';
                        });
                    } else {
                        Swal.fire("Error!", "Data gagal dihapus!", "error");
                    }
                },
                error: function (msg) {
                    $("#loader").hide();
                    Swal.fire("Error!", "Data gagal dihapus!", "error");
                }
            });
        }
    })
}

function submitBisnis(uuid) {
    Swal.fire({
        html: '<strong>Ajukan bisnis kembali ? </strong>',
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $("#loader").show();
            $.ajax({
                type: 'GET',
                url: '/user/pralisting/submitpralisting/' + uuid,
                cache: false,
                success: function (data) {
                    $("#loader").hide();
                    data = JSON.parse(data);
                    if (data.msg == 200) {
                        Swal.fire("Success!", 'Data berhasil ajukan.', "success").then((result) => {
                            window.location = '/user/pralisting/list';
                        });
                    } else {
                        Swal.fire("Error!", "Data gagal diajukan!", "error");
                    }
                },
                error: function (msg) {
                    $("#loader").hide();
                    Swal.fire("Error!", "Data gagal diajukan!", "error");
                }
            });
        }
    })
}