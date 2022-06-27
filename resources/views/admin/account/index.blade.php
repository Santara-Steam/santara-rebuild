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
                                <h1 class="card-title-member">Daftar Akun</h1>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table" id="tableAccount">
                                            <thead>
                                                <tr>
                                                    <th width="20">No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Attempt</th>
                                                    <th>Role</th>
                                                    <th>Created at</th>
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
@endsection
@section('js')
<script src="{{asset('public/admin')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{asset('public/admin')}}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    loadData();
    function loadData(){
        var tableAccount = $("#tableAccount").DataTable({
            ajax: '{{ url("/admin/setting/account/get-account") }}',
            responsive: true,
            processing: true,
            serverSide: true,
            order: [[0, "asc"]],
            oLanguage: {
                sProcessing: '<div id="tableloading" class="tableloading"></div>',
                sZeroRecords: 'Data tidak tersedia'
            },
            columns: [
                {
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
                    data: "phone"
                },
                {
                    data: "attempt"
                },
                {
                    data: "role",
                },
                {
                    data: "created_at"
                },
                {
                    data: "aksi",
                },
            ]
        });
    }

    $('body').on('click', '#btnDelete', function() {
            var data_id = $(this).data('id');
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Data yang sudah anda hapus tidak akan bisa kembali!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus"
            }).then(function(result) {
                if (result.value) {
                    $("#loader").show();
                    $.ajax({
                        url: '{{ url("admin/setting/account/delete") }}' + '/' + data_id,
                        type: 'POST',
                        success: function() {
                            $("#loader").hide();
                            Swal.fire(
                                "Terhapus!",
                                "Data telah terhapus.",
                                "success"
                            );
                            window.location.reload();
                        }
                    });
                }
            });
        });


</script>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css"
    href="{{asset('public/admin')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
    integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection