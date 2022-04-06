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
                                <h4 class="card-title">List Withdraw</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                   <select class="custom-select" onchange="filterTr()" id="filter">
                                       <option disabled selected>Filter Status</option>
                                       @foreach([
                                            ''  => 'Semua',
                                            '0' => 'Verifikasi',
                                            '1' => 'Sudah Verifikasi',
                                            '2' => 'Ditolak'
                                        ] as $key => $value)
                                             <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table" id="tableWithDraw"> 
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Amount</th>
                                                    <th>Fee</th>
                                                    <th>Bank to</th>
                                                    <th>Created at</th>
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
<script src="{{asset('public/admin')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{asset('public/admin')}}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
<script>

    loadData("");
    function loadData(filter){
        var tableWithDraw = $("#tableWithDraw").DataTable({
            ajax: '{{ url("/admin/get_withdraw?filter=") }}'+filter,
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
                    data: "trader_name"
                },
                {
                    data: "email"
                },
                {
                    data: "amount"
                },
                {
                    data: "fee"
                },
                {
                    data: "bank_to"
                },
                {
                    data: "created_at"
                },
                {
                    data: "split_fee"
                },
                {
                    data: "status", 
                },
            ]
        });
    }


    function filterTr(){
        const filter = $("#filter").val();
        $("#tableWithDraw").DataTable().clear().destroy();
        loadData(filter);
    }
</script>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="{{asset('public/admin')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
@endsection