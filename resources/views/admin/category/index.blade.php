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
                                    <h1 class="card-title-member">Category</h1>
                                    <div class="heading-elements">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                                            Tambah
                                          </button>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table" id="tableCategory">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
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

    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Tambah Kategori</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ url('admin/category/store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" name="category" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
          </div>
        </div>
      </div>
@endsection
@section('js')
    <script src="{{ asset('public/admin') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('public/admin') }}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
    <script>
        var tableCategory = $("#tableCategory").DataTable({
            ajax: '{{ url("/admin/fetch_category") }}',
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
                    data: "category"
                },
                {
                    data: "id",
                    render: function(data, type, row, meta) {
                        return type === "display" ?
                            '<button id="btnEdit" class="btn btn-sm btn-warning"><span class="la la-pencil"></span></button> ' +
                            '<button id="btnDelete" class="btn btn-sm btn-danger"><span class="la la-trash"></span></button>' :
                            data;
                    }

                },
            ]
        });
    </script>
@endsection
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/admin') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
@endsection
