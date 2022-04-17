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
                                    <h2><strong>Laporan Keuangan</strong></h2>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="row mb-2">
                                            <div class="col-8"></div>
                                            <div class="col-2">
                                                <select id="periode" class="custom-select">
                                                    <option disabled selected>Periode</option>
                                                    @foreach ([
            null => 'Semua',
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ]
        as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <select class="custom-select" id="filter">
                                                    <option disabled selected>Filter Status</option>
                                                    @foreach ([
            null => 'Semua',
            'verified' => 'Terferifikasi',
            'verifying' => 'Menunggu Verifikasi',
            'rejected' => 'Ditolak',
        ]
        as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table" id="tableLaporanKeuangan" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>ID Laporan</th>
                                                        <th>Penerbit</th>
                                                        <th>Versi</th>
                                                        <th>Manual Files</th>
                                                        <th>Periode</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div id="modalDesc" class="modal fade" role='dialog'>
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" id="modal-body">
                    <p id="status_desc"></p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('public/admin') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('public/admin') }}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showDesc(val) {
            document.getElementById("status_desc").innerHTML = val;
            $("#modalDesc").modal("show");
        };


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


            var table = $("#tableLaporanKeuangan").DataTable({
                search: {
                    "caseInsensitive": false
                },
                scrollX: true,
                processing: true,
                serverSide: true,
                bInfo: false,
                oLanguage: {
                    sProcessing: '<div id="tableloading" class="tableloading"></div>',
                    sZeroRecords: 'Data tidak tersedia'
                },
                pagingType: "simple_numbers",
                ajax: {
                    "url": "{{ url('admin/get-laporan-keuangan') }}",
                    "type": "POST",
                    "data": function(data) {
                        data.filter = $('#filter').val();
                        data.periode = $('#periode').val();
                    }
                },
                columnDefs: [{
                    "targets": [0, 1, 2, 3, 4, 5, 6, 7],
                    "orderable": false
                }, ],
                ordering: false,
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
            $('#periode').change(function() {
                table.draw();
            });
        });

        function verifiedLaporan(id) {
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
                        editable: ($('#editable_' + id).is(':checked')) ? 1 : 0
                    };

                    $.ajax({
                        type: 'POST',
                        url: "{{ url('admin/konfirmasi-laporan-keuangan') }}",
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

        function rejectedLaporan(id) {
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
                            editable: ($('#editable_' + id).is(':checked')) ? 1 : 0
                        };

                        $.ajax({
                            type: 'POST',
                            url: "{{ url('admin/konfirmasi-laporan-keuangan') }}",
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
                                Swal.fire("Error!", 'Permintaan gagal dilakukan', "error").then((
                                    result) => {
                                    location.reload();
                                });
                            }
                        });
                    }
                }

            });
        }
    </script>
@endsection
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/admin') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
@endsection
