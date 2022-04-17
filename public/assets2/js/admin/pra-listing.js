$(document).ready(function() {
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
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
        initComplete: function() {
            var api = this.api();
            $('#mytable_filter input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                    if (e.keyCode === 13) {
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
        ajax: {
            "url": "/user/pralisting/get_bisnis_admin",
            "type": "POST",
            "data": function(data) {
                data.filter = $('#filter').val();
            }
        },
        order: [
            [5, 'desc']
        ],
        columnDefs: [
            { "targets": [0], "orderable": false },
            { "targets": [4], "orderable": false },
            { "targets": [11], "orderable": false },
            { "targets": [12], "orderable": false }
        ],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        }
    });

    $('#filter').change(function() {
        table.draw();
    });
});

function deleteBisnis(uuid, name) {
    Swal.fire({
        html: '<strong>Yakin menghapus bisnis <b>' + name + '</b> ? </strong>',
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
                success: function(data) {
                    $("#loader").hide();
                    Swal.fire("Success!", 'Data berhasil dihapus.', "success").then((result) => {
                        window.location = '/user/pralisting/list';
                    });
                },
                error: function(msg) {
                    $("#loader").hide();
                    Swal.fire("Error!", "Data gagal dihapus!", "error");
                }
            });
        }
    })
}