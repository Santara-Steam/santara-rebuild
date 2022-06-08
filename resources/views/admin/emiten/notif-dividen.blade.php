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
                                    <h1 class="card-title-member">Pemberitahuan Dividen</h1>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table" id="tabel">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nama Perusahaan</th>
                                                        <th>Nama Brand</th>
                                                        <th>Kode</th>
                                                        <th>Status</th>
                                                        <th width="150">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0; ?>
                                                    @foreach ($sold_out as $row)
                                                        <?php $no++; ?>
                                                        <tr>
                                                            <td>{{ $no }}</td>
                                                            <td>{{ $row->company_name }}</td>
                                                            <td>{{ $row->trademark }}</td>
                                                            <td>{{ $row->code_emiten }}</td>
                                                            <td>{{ $row->last_emiten_journey }}</td>
                                                            <td>
                                                                <button type="button" data-id="{{ $row->id }}"
                                                                    class="btn btn-block btn-sm btn-primary sendNotifManual">Kirim
                                                                    <span class="fa fa-bell"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
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
    <script src="{{ asset('admin') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('admin') }}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"
        integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#tabel').DataTable({
                responsive: true,
            });
        });
    </script>
    <script>
        $(".sendNotifManual").on("click", function() {
            var data_id = $(this).data('id');
            Swal.fire({
                title: "Konfirmasi",
                text: "Apakah anda yakin untuk mengirim email ke emiten ini ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya Kirim"
            }).then(function(result) {
                if (result.value) {
                    sendNotif(data_id);
                }
            });
        });

        function sendNotif(id) {
            $.ajax({
                url: '{{ url('admin/emiten/pemberitahuan-dividen') }}' + '/' + id,
                type: 'GET',
                success: function(result) {
                    Swal.fire(
                        "Berhasil!",
                        "Pemberitahuan berhasil dikirim.",
                        "success"
                    );
                }
            });
        }
    </script>
@endsection
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
        integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
@endsection
