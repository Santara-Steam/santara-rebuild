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
                                    <h1 class="card-title-member">Dividen</h1>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="row justify-content-between ml-1 mr-1 mb-2 mt-0">
                                            <ul class="list-inline mb-0">
                                                <li><a href="{{ url('admin/add_dividen') }}"
                                                        class="btn btn-primary">Tambah Dividend</a>
                                                </li>
                                            </ul>
                                            <div class="heading-elements">
                                                <div class="form-inline mb-2">
                                                    <input type="text" class="form-control" name="daterange" />
                                                    <button id="btn-filter" class="btn btn-primary ml-2"
                                                        type="button">Filter</button>
                                                    <button id="btn-export" class="btn btn-info ml-1" type="button">Export
                                                        Data</button>
                                                </div>
                                                <select class="custom-select" onchange="filterTr()" id="filter">
                                                    <option disabled selected>Filter Status</option>
                                                    @foreach ([
            '' => 'Semua',
            '0' => 'Tersedia',
            '1' => 'Verifikasi',
            '2' => 'Terverifikasi',
            '3' => 'Ditolak',
            'wallet' => 'Wallet',
            'rekening' => 'Rekening',
        ]
        as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table" id="tableDeviden" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th width="20">No</th>
                                                        <th>Member</th>
                                                        <th width="200">Date Dividen</th>
                                                        <th>Total</th>
                                                        <th>Availability</th>
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
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div class="modal fade" id="emitenDetailModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-sm btn-block btn-primary-ghost" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('public/admin') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('public/admin') }}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var tglAwal = "";
        var tglAkhir = "";

        $('input[name="daterange"]').daterangepicker({
            opens: 'right',
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                    'month')]
            }
        }, function(start, end, label) {
            tglAwal = start.format('YYYY-MM-DD');
            tglAkhir = end.format('YYYY-MM-DD');
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                .format('YYYY-MM-DD'));
        });

        loadData("", tglAwal, tglAkhir);

        function loadData(filter, startDate, endDate) {
            var tableDeviden = $("#tableDeviden").DataTable({
                ajax: '{{ url('/admin/get_dividen?filter=') }}' + filter + '&startDate=' + startDate +
                    '&endDate=' + endDate,
                responsive: true,
                processing: true,
                serverSide: true,
                oLanguage: {
                    sProcessing: '<div id="tableloading" class="tableloading"></div>',
                    sZeroRecords: 'Data tidak tersedia'
                },
                order: [
                    [0, "asc"]
                ],
                columns: [{
                        data: "id",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: "member"
                    },
                    {
                        data: "updated_at"
                    },
                    {
                        data: "devidend"
                    },
                    {
                        data: "status",
                        className: "text-center"
                    },
                    {
                        data: "pencarian",
                        className: "text-center"
                    },
                    {
                        data: "detail",
                        className: "text-center"
                    },
                ]
            });
        }

        $("#btn-filter").on("click", function() {
            $("#tableDeviden").DataTable().clear().destroy();
            loadData("", tglAwal, tglAkhir);
        });

        $("#btn-export").on("click", function() {
            if (tglAwal != "" && tglAkhir != "") {
                var url = "{{ url('admin/dividen/export-excel') }}" + '?start_date=' + tglAwal + '&end_date=' +
                    tglAkhir;
                window.open(url, "_blank");
            } else {
                alert("Rentang tanggal belum dipilih")
            }
        });


        function filterTr() {
            const filter = $("#filter").val();
            $("#tableDeviden").DataTable().clear().destroy();
            loadData(filter, tglAwal, tglAkhir);
        }

        function getEmitenDetailConfirm(trader_id, status, updated_at) {
            var data = {
                trader_id,
                status,
                updated_at
            };
            var emitenDetailModal = $("#emitenDetailModal");

            $.ajax({
                type: "GET",
                url: "{{ url('admin/detail_dividen') }}",
                cache: false,
                data: data,
                success: function(data) {
                    emitenDetailModal.find(".modal-body").html(data);
                    emitenDetailModal.modal("show");
                },
            });
        }

        function confirmDividend(
            id,
            name,
            trader_id,
            company_name,
            dividend_idr,
            fee,
            total,
            bank,
            account_number,
            account_name,
            bank_kota,
            bank_cabang,
            uuid,
            dividend,
            updated_at
        ) {
            Swal.fire({
                title: "<strong>" + total + "</strong>",
                html: `<table class="table table-borderless dividend-detail" style="text-align: left;font-size: 12px;font-weight: 500;">
            <tbody>
              <tr>
                <td>Nama </td>
                <td>:</td>
                <td>` +
                    name +
                    `</td>
              </tr>
              <tr>
                <td>Bank</td>
                <td>:</td>
                <td>` +
                    bank +
                    `</td>
              </tr>
              <tr>
                <td>No. Rekening</td>
                <td>:</td>
                <td>` +
                    account_number +
                    `</td>
              </tr>
              <tr>
                <td>Nama Rekening</td>
                <td>:</td>
                <td>` +
                    account_name +
                    `</td>
              </tr>
            </tbody>
          </table>`,
                type: "info",
                showCancelButton: true,
                confirmButtonText: "Ya, Verifikasi",
                cancelButtonText: "Tidak",
                reverseButtons: true,
            }).then((result) => {
                if (result.value) {
                    var data = {
                        id: id,
                        uuid: uuid,
                        information1: company_name,
                        information2: company_name,
                        information4: dividend,
                        trader_id: trader_id,
                        updated_at: updated_at,
                    };
                    $.ajax({
                        url: '{{ url("admin/dividen/verifikasi") }}',
                        type: "POST",
                        dataType: "json",
                        data: data,
                        beforeSend: function() {
                            $("#loader").show();
                        },
                        success: function(data) {
                            $("#loader").hide();
                            if (!data.error) {
                                Swal.fire(
                                    "Berhasil",
                                    "Verifikasi bagi hasil sebesar Rp. " +
                                    formatRupiah(dividend).slice(3).slice(0, -3) +
                                    " berhasil dilakukan",
                                    "success"
                                ).then((result) => {
                                    location.reload();
                                });
                            } else {
                                if (data.msg) {
                                    Swal.fire(
                                        "Error!",
                                        "Gagal melakukan verifikasi, " + data.msg,
                                        "error"
                                    ).then((result) => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire("Error!", "Gagal melakukan verifikasi", "error").then(
                                        (result) => {
                                            location.reload();
                                        }
                                    );
                                }
                            }
                        },
                        error: function(msg) {
                            $("#loader").hide();
                            Swal.fire("Error!", "Gagal melakukan verifikasi", "error").then(
                                (result) => {
                                    location.reload();
                                }
                            );
                        },
                    });
                }
            });
        }

        function rejectDividend(
            id,
            uuid,
            company_name,
            dividend,
            trader_id,
            updated_at
        ) {
            Swal.fire({
                title: "<strong> Tolak pengajuan bagi hasil </strong>",
                text: "Masukan alasan penolakan bagi hasil",
                input: "text",
                showCancelButton: true,
                confirmButtonText: "Ya, Tolak",
                cancelButtonText: "Tidak",
                reverseButtons: true,
                preConfirm: (input) => {
                    if (input === "") {
                        Swal.showValidationMessage("alasan penolakan tidak boleh kosong");
                    } else {
                        $("#loader").show();
                        var data = {
                            id: id,
                            uuid: uuid,
                            keterangan: input,
                            information1: company_name,
                            information2: company_name,
                            information4: dividend,
                            trader_id: trader_id,
                            updated_at: updated_at,
                        };

                        $.ajax({
                            type: "POST",
                            url: "{{ url('admin/dividen/reject') }}",
                            dataType: "json",
                            data: data,
                            success: function(data) {
                                $("#loader").hide();
                                if (data.msg) {
                                    Swal.fire(
                                        "Berhasil",
                                        "Penolakan pengajuan bagi hasil berhasil dilakukan",
                                        "success"
                                    ).then((result) => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire("Error!", "Permintaan gagal dilakukan", "error").then(
                                        (result) => {
                                            location.reload();
                                        }
                                    );
                                }
                            },
                            error: function(data) {
                                $("#loader").hide();
                                Swal.fire("Error!", "Permintaan gagal dilakukan", "error").then(
                                    (result) => {
                                        location.reload();
                                    }
                                );
                            },
                        });
                    }
                },
            });
        }

        function getEmitenDetailConfirm(trader_id, status, updated_at) {
            var data = {
                trader_id,
                status,
                updated_at
            };
            var emitenDetailModal = $("#emitenDetailModal");

            $.ajax({
                type: "POST",
                url: "/user/dividend/get_emiten_detail_confirm/",
                cache: false,
                data: data,
                success: function(data) {
                    emitenDetailModal.find(".modal-body").html(data);
                    emitenDetailModal.modal("show");
                },
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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
