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
                                    <h1 class="card-title-member">Calon Penerbit</h1>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table" id="tablePralisting">
                                                <thead>
                                                    <tr>
                                                        <th width="20">No</th>
                                                        <th>Nama</th>
                                                        <th>Perusahaan</th>
                                                        <th>Brand</th>
                                                        <th>Phone</th>
                                                        <th>Tanggal</th>
                                                        <th>Vote</th>
                                                        <th>Like</th>
                                                        <th>Comment</th>
                                                        <th>Kebutuhan Data</th>
                                                        <th>Rencana Invest</th>
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
@endsection
@section('js')
    <script src="{{ asset('admin') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('admin') }}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var tablePralisting = $("#tablePralisting").DataTable({
            ajax: '{{ url('/admin/pralisting/get-pralisting') }}',
            responsive: true,
            processing: true,
            serverSide: true,
            order: [
                [0, "asc"]
            ],
            oLanguage: {
                sProcessing: '<div id="tableloading" class="tableloading"></div>',
                sZeroRecords: 'Data tidak tersedia'
            },
            columns: [{
                    data: "id",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "trader_name"
                },
                {
                    data: "company_name"
                },
                {
                    data: "trademark"
                },
                {
                    data: "phone"
                },
                {
                    data: "created_at"
                },
                {
                    data: "total_votes"
                },
                {
                    data: "total_likes"
                },
                {
                    data: "total_coments"
                },
                {
                    data: "capital_needs"
                },
                {
                    data: "investment"
                },
                {
                    data: "status",
                    className: "text-center"
                },
                {
                    data: "aksi",
                },
            ]
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
                        url: '{{ url("admin/pralisting/delete") }}'+ '/' + uuid,
                        cache: false,
                        success: function(data) {
                            $("#loader").hide();
                            Swal.fire("Success!", 'Data berhasil dihapus.', "success").then((
                            result) => {
                                window.location = '{{ url("admin/pralisting/pralisting") }}';
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
    </script>
@endsection
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
        integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
