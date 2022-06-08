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
                                    <h1 class="card-title-member">Penarikan</h1>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <select class="custom-select" onchange="filterTr()" id="filter">
                                            <option disabled selected>Filter Status</option>
                                            @foreach ([
            '' => 'Semua',
            '0' => 'Verifikasi',
            '1' => 'Sudah Verifikasi',
            '2' => 'Ditolak',
        ]
        as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="form-inline mb-2">
                                            <input type="text" class="form-control" name="daterange" />
                                            <button id="btn-filter" class="btn btn-primary ml-2"
                                                type="button">Filter</button>
                                            <button id="btn-export" class="btn btn-info ml-1" type="button">Export
                                                Data</button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table" id="tableWithDraw">
                                                <thead>
                                                    <tr>
                                                        <th width="20">No</th>
                                                        <th>Member</th>
                                                        <th>Created</th>
                                                        <th>Amount</th>
                                                        <th>Split Fee</th>
                                                        <th>Status</th>
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
@endsection
@section('js')
    <script src="{{ asset('admin') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('admin') }}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
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
            var tableWithDraw = $("#tableWithDraw").DataTable({
                ajax: '{{ url('/admin/get_withdraw?filter=') }}' + filter + '&startDate=' + startDate +
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
                        data: "date"
                    },
                    {
                        data: "amount"
                    },
                    {
                        data: "split_fee"
                    },
                    {
                        data: "status",
                        className: "text-center"
                    },
                ]
            });
        }

        $("#btn-filter").on("click", function() {
            $("#tableWithDraw").DataTable().clear().destroy();
            loadData("", tglAwal, tglAkhir);
        });

        $("#btn-export").on("click", function() {
            if (tglAwal != "" && tglAkhir != "") {
                var url = "{{ url('admin/withdraw/export-excel') }}" + '?start_date=' + tglAwal + '&end_date=' +
                    tglAkhir;
                window.open(url, "_blank");
            } else {
                alert("Rentang tanggal belum dipilih")
            }
        });

        function filterTr() {
            const filter = $("#filter").val();
            $("#tableWithDraw").DataTable().clear().destroy();
            loadData("", tglAwal, tglAkhir);
        }

        function confirmWithdraw(uuid, name, number, bank, total, saldo) {
            Swal.fire({
                title: "<strong>" + total + "</strong>",
                html: `<table class="table table-borderless dividend-detail" style="text-align: left;font-size: 12px;font-weight: 500;">
        <tbody>
          <tr>
            <td>Nama </td>
            <td>:</td>
            <td>` + name + `</td>
          </tr>
          <tr>
            <td>Bank</td>
            <td>:</td>
            <td>` + bank + `</td>
          </tr>
          <tr>
            <td>Nomor Rekening</td>
            <td>:</td>
            <td>` + number + `</td>
          </tr>
          <tr>
            <td><strong>Saldo Tersedia</strong></td>
            <td>:</td>
            <td><strong>` + saldo + `</strong></td>
          </tr>
        </tbody>
      </table>`,
                type: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya, Verifikasi',
                cancelButtonText: 'Tidak',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $("#loader").show();
                    $.ajax({
                        type: 'GET',
                        url: '{{ url("admin/withdraw/update") }}' + '/' + uuid + "/" + 1,
                        cache: false,
                        success: function(data) {
                            $("#loader").hide();
                            data = JSON.parse(data);
                            if (data.msg == 200) {
                                Swal.fire(
                                    'Berhasil',
                                    'Verifikasi withdraw sebesar ' + total + ' berhasil dilakukan',
                                    'success'
                                ).then((result) => {
                                    location.reload();
                                });
                            } else {
                                if (data.msg) {
                                    Swal.fire("Error!", 'Gagal melakukan verifikasi, \n' + data.msg,
                                        "error").then((result) => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire("Error!", 'Gagal melakukan verifikasi', "error").then((
                                        result) => {
                                        location.reload();
                                    });
                                }

                            }

                        },
                        error: function(data) {
                            $("#loader").hide();
                            console.log(data);
                            Swal.fire("Error!", 'Gagal melakukan verifikasi', "error").then((
                            result) => {
                                location.reload();
                            });
                        }
                    });
                }
            });
        };

        function rejectWithdraw(uuid, name, number, total) {

            Swal.fire({
                title: "<strong> Tolak Withdraw </strong>",
                text: 'Masukan alasan penolakan Withdraw',
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
                        $.ajax({
                            type: 'GET',
                            url: '{{ url("admin/withdraw/reject") }}' + "/" + uuid + "/" + 2 + "/" + input,
                            cache: false,
                            success: function(data) {
                                $("#loader").hide();
                                data = JSON.parse(data);
                                if (data.msg == 200) {
                                    Swal.fire(
                                        'Berhasil',
                                        'Pengajuan withdraw berhasil ditolak',
                                        'success'
                                    ).then((result) => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire("Error!", 'Gagal melakukan tolak withdraw', "error")
                                        .then((result) => {
                                            location.reload();
                                        });
                                }

                            },
                            error: function(data) {
                                $("#loader").hide();
                                Swal.fire("Error!", 'Gagal melakukan tolak withdraw', "error").then(
                                    (result) => {
                                        location.reload();
                                    });
                            }
                        });
                    }
                }

            });
        };
    </script>
@endsection
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
