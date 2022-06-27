@extends('admin.layout.master')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2><strong>Target User Tersedia</strong></h2>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table dataTable-table" id="tableTagetUser" style="width: 100%">
                                        <thead style="display: none;">
                                            <tr>
                                                <th class="border-top-0">Target User</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('public/admin') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{ asset('public/admin') }}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
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

            var table = $("#tableTagetUser").DataTable({
                buttons: [
                    'print', 'csv'
                ],
                initComplete: function() {
                    var api = this.api();
                    $('#mytable_filter input')
                        .off('.DT')
                        .on('keyup.DT', function(e) {
                            if (e.keyCode == 13) {
                                api.search(this.value).draw();
                            }
                        });
                },
                search: {
                    "caseInsensitive": false
                },
                scrollX: true,
                processing: true,
                serverSide: true,
                bLengthChange: false,
                bFilter: false,
                bInfo: false,
                ajax: {
                    "url": "{{ url('admin/crm/get-target-user-tersedia') }}",
                    "type": "POST",
                    "data": function(data) {
                        data.filter = $('#filter').val();
                    }
                },
                order: [
                    [0, 'desc']
                ],
                rowCallback: function(row, data, iDisplayIndex) {
                    var info = this.fnPagingInfo();
                }
            });

            $('#filter').change(function() {
                table.draw();
            });
        });

        function sendTarget(target) {
            console.log(target);
        }

        $(document).on('click', '.delete-target', function() {
            var id = $(this).val();

            Swal.fire({
                title: 'Hapus data target',
                html: 'Yakin akan menghapus data target ?',
                type: 'info',
                showCancelButton: true,
            }).then((result) => {
                if (result.value) {
                    $("#loader").show();
                    $.ajax({
                        url: "{{ url('admin/crm/delete-target') }}" + '/' + id,
                        type: 'POST',
                        timeout: 20000, // sets timeout to 20 seconds
                        cache: false,
                        success: function(data) {
                            $("#loader").hide();
                            data = JSON.parse(data);
                            if (data.msg == 200) {
                                Swal.fire(
                                    'Berhasil',
                                    'Data target berhasil dihapus',
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
                            Swal.fire("Error!", "Data gagal dihapus", "error").then((
                            result) => {
                                location.reload();
                            });
                        }
                    });
                }
            })
        });
</script>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css"
    href="{{ asset('public/admin') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
    integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection