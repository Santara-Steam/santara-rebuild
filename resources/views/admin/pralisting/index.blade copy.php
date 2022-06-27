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
                                            <table class="table" id="tabel">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
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
                                                <tbody>
                                                    <?php $no = 0;?>
                                                    @for ($i = 0; $i < count($data); $i++)
                                                    <?php $no++; ?>
                                                     <tr>
                                                        <td>{{ $no }}</td>
                                                        <td>{{ $data[$i]['trader_name'] }}</td>
                                                        <td>{{ $data[$i]['company_name'] }}</td>
                                                        <td>{{ $data[$i]['trademark'] }}</td>
                                                        <td>{{ $data[$i]['phone'] }}</td>
                                                        <td>{{ $data[$i]['created_at'] }}</td>
                                                        <td>{{ $data[$i]['total_votes'] }}</td>
                                                        <td>{{ $data[$i]['total_likes'] }}</td>
                                                        <td>{{ $data[$i]['total_coments'] }}</td>
                                                        <td><?= $data[$i]['capital_needs'] ?></td>
                                                        <td><?= $data[$i]['investment'] ?></td>
                                                        <td>{{ $data[$i]['status'] }}</td>
                                                        <td><?= $data[$i]['aksi'] ?></td>
                                                    </tr>
                                                    @endfor
                                                </tbody>
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
    <script src="{{ asset('public/admin') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('public/admin') }}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#tabel').DataTable({
                responsive: true,
            });
        });
    </script>
    <script>
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
        href="{{ asset('public/admin') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
        integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
