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
                                <h1 class="card-title-member">Transaksi</h1>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                   <select class="custom-select" onchange="filterTr()" id="filter">
                                       <option disabled selected>Filter Status</option>
                                       @foreach([
                                            '' => 'Semua',
                                            'VERIFIED' => 'Lunas',
                                            // 'WAITING FOR VERIFICATION' => 'Menunggu Konfirmasi',
                                            'CREATED' => 'Belum Konfirmasi',
                                            'EXPIRED' => 'Kadaluarsa'
                                        ] as $key => $value)
                                             <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table" id="tableTransaction"> 
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th width="250">Transaksi</th>
                                                    <th>Member</th>
                                                    <th>Created at</th>
                                                    <th>Total (Rp)</th>
                                                    <th>Split Fee</th>
                                                    <th>Status</th>
                                                    {{-- <th>Action</th> --}}
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
        var tableTransaction = $("#tableTransaction").DataTable({
            ajax: '{{ url("/admin/get_transactions?filter=") }}'+filter,
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
                    data: "transaksi"
                },
                {
                    data: "member"
                },
                {
                    data: "created_at"
                },
                {
                    data: "amount"
                },
                {
                    data: "split_fee"
                },
                {
                    data: "status", 
                },
                // {
                //     data: "link",
                // },
            ]
        });
    }


    function filterTr(){
        const filter = $("#filter").val();
        $("#tableTransaction").DataTable().clear().destroy();
        loadData(filter);
    }
</script>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="{{asset('public/admin')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
@endsection