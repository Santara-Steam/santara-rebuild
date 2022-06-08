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
                                    <h1 class="card-title-member">Reject New KYC</h1>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements"></div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table" id="tableRejectKyc">
                                                <thead>
                                                    <tr>
                                                        <th width="20">No</th>
                                                        <th>Nama</th>
                                                        <th>Email</th>
                                                        <th>HP</th>
                                                        <th>Admin Reject</th>
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

    {{-- Foto --}}
    <div class="modal fade bd-example-modal-lg" id="foto" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="headerFoto"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="row">
                        <div class="col-6">
                            <p><b>Baru</b></p>
                            <img id="newfotoKYC" width="100%" alt="kyc approve">
                        </div>
                        <div class="col-6">
                            <p><b>Lama</b></p>
                            <img id="fotoKYC" width="100%" alt="kyc approve">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Histori --}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="history" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id='headerHistory'></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover datatableHistory" id="tb" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Event</th>
                                    <th>Note</th>
                                    <th>User Agen</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('admin') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('admin') }}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        loadData("");

        function loadData(filter) {
            var tableRejectKyc = $("#tableRejectKyc").DataTable({
                ajax: '{{ url("/admin/kyc/get-reject-kyc") }}',
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
                        data: "name"
                    },
                    {
                        data: "email"
                    },
                    {
                        data: "hp"
                    },
                    {
                        data: "admin"
                    },
                    {
                        data: "action",
                        className: 'text-center'
                    },
                ]
            });
        }

        function tabelHistory(id, name) {
            $("#headerHistory").html("<b>Data History " + name + "</b>");
            $("#history").modal("show");
            //$(".datatableHistory").DataTable().ajax.reload();
            $(".datatableHistory").DataTable({
                ajax: '{{ url("admin/kyc/get-trail-user") }}' + '/' + id,
                dom: 'frtip',
                processing: true,
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
                        data: "event"
                    },
                    {
                        data: "note"
                    },
                    {
                        data: "user_agent"
                    },
                    {
                        data: "created_at"
                    },
                ]
            });
        }

        function foto(param, param1, name) {
            $("#headerFoto").html("<b>" + name + "</b>");
            $("#newfotoKYC").attr("src", param);
            $("#fotoKYC").attr("src", '{{ config('global.BASE_API_FILE') }}' + param1);
            $("#foto").modal("show");
        }

        function approve(id, name) {
            Swal.fire({
                html: `<img src="{{ asset('assets/images/success.png') }}" width="60%" alt="kyc approve">
                            <h3 class="mt-2">Approve Data New KYC ${name}</h3>`,
                showCancelButton: true,
                showCloseButton: true,
                showConfirmButton: true,
                cancelButtonText: "Tidak",
                confirmButtonText: "Approve",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '{{ url("admin/kyc/approve-kyc") }}' + '/' + id,
                        type: "get",
                        dataType: "json",
                        timeout: 20000,
                        beforeSend: function() {
                            $("#loader").show();
                        },
                        success: function(data) {
                            $("#loader").hide();
                            if (data.status == true) {
                                Swal.fire("Success!", data.data.message, "success").then(
                                    function() {
                                        window.location.reload();
                                    }
                                );
                            } else if (data.status == false) {
                                Swal.fire("Error!", data.error[0].message, "error").then(
                                    function() {}
                                );
                            }
                        },
                    });
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
        href="{{ asset('admin') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
        integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
