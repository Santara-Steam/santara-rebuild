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
                                <h4 class="card-title text-center">List Bagi Hasil</h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="row justify-content-between ml-1 mr-1 mb-2 mt-0">
                                        <ul class="list-inline mb-0">
                                            <li><a href="{{ url('admin/add_dividen') }}" class="btn btn-primary">Tambah Dividend</a></li>
                                        </ul>
                                        <div class="heading-elements">
                                            <select class="custom-select" onchange="filterTr()" id="filter">
                                                <option disabled selected>Filter Status</option>
                                                @foreach([
                                                     ''  => 'Semua',
                                                     '0' => 'Tersedia',
                                                     '1' => 'Verifikasi',
                                                     '2' => 'Terverifikasi',
                                                     '3' => 'Ditolak',
                                                     'wallet' => 'Wallet',
                                                     'rekening' => 'Rekening'
                                                 ] as $key => $value)
                                                      <option value="{{ $key }}">{{ $value }}</option>
                                                 @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="tableDeviden"> 
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Bagi Hasil</th>
                                                    <th>Status</th>
                                                    <th>Tanggal Dividen</th>
                                                    <th>Pencarian</th>
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
<script src="{{asset('public/admin')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{asset('public/admin')}}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
<script>

    loadData("");
    function loadData(filter){
        var tableDeviden = $("#tableDeviden").DataTable({
            ajax: '{{ url("/admin/get_dividen?filter=") }}'+filter,
            responsive: true,
            order: [[0, "asc"]],
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
                    data: "devidend"
                },
                {
                    data: "status"
                },
                {
                    data: "updated_at"
                },
                {
                    data: "pencarian"
                },
                {
                    data: "detail"
                },
            ]
        });
    }


    function filterTr(){
        const filter = $("#filter").val();
        $("#tableDeviden").DataTable().clear().destroy();
        loadData(filter);
    }

    function getEmitenDetailConfirm(trader_id, status, updated_at) {
        var data = { trader_id, status, updated_at };
        var emitenDetailModal = $("#emitenDetailModal");

        $.ajax({
            type: "GET",
            url: "{{ url('admin/detail_dividen') }}",
            cache: false,
            data: data,
            success: function (data) {
                emitenDetailModal.find(".modal-body").html(data);
                emitenDetailModal.modal("show");
            },
        });
    }

</script>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="{{asset('public/admin')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
@endsection