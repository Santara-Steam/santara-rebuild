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
                                <h1 class="card-title-member">Broadcast Notification</h1>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a href="{{ url('admin/crm/broadcasting/add') }}"
                                                class="btn btn-primary">Tambah</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table dataTable-table" id="tableBroadcasting" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Tipe</th>
                                                <th>Tanggal</th>
                                                <th>Jam</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
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

            var table = $("#tableBroadcasting").DataTable({
                initComplete: function() {
                    var api = this.api();
                    var textBox = $('#datatable_filter label input');
                    textBox.unbind();
                    textBox.bind('keyup input', function(e) {
                        if (e.keyCode == 8 && !textBox.val() || e.keyCode == 46 && !textBox
                            .val()) {} else if (e.keyCode == 13 || !textBox.val()) {
                            api.search(this.value).draw();
                        }
                    });
                },
                search: {
                    "caseInsensitive": false
                },
                ordering: false,
                scrollX: true,
                oLanguage: {
                    sProcessing: '<div id="tableloading" class="tableloading"></div>',
                    sZeroRecords: 'Data tidak tersedia'
                },
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ url('admin/crm/get-broadcasting') }}",
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

        $(document).on('click', '.delete-broadcast', function() {
            var id = $(this).val();
            Swal.fire({
                title: 'Yakin Ingin Menghapus Broadcast ?',
                html: 'Catatan : Broadcast yang di hapus tidak dapat dikembalikan. Pastikan Anda yakin ingin menghapus broadcast.',
                type: 'info',
                showCancelButton: true,
            }).then((result) => {
                if (result.value) {
                    $("#loader").show();
                    $.ajax({
                        url: "{{ url('admin/crm/broadcasting/delete') }}" + '/' + id,
                        type: 'GET',
                        timeout: 20000, // sets timeout to 20 seconds
                        cache: false,
                        success: function(data) {
                            $("#loader").hide();
                            data = JSON.parse(data);
                            if (data.msg == 200) {
                                Swal.fire(
                                    'Berhasil',
                                    'Data broadcast berhasil dihapus',
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