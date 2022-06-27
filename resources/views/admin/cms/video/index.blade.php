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
                                <h1 class="card-title-member">Video</h1>
                                <div class="heading-elements">
                                    <a class="btn btn-primary" href="{{ url('admin/cms/video/create') }}">
                                        Tambah
                                    </a>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table" id="tabel" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Judul</th>
                                                    <th>Kategori</th>
                                                    <th>View</th>
                                                    <th>Like</th>
                                                    <th>Dislike</th>
                                                    <th>Tanggal</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $no = 0; @endphp
                                                @foreach ($santaraVideos as $row)
                                                @php $no++; @endphp
                                                <tr>
                                                    <td class="text-center">{{ $no }}</td>
                                                    <td>{{ $row->title }}</td>
                                                    <td>{{ $row->category }}</td>
                                                    <td>{{ $row->views }}</td>
                                                    <td>{{ $row->likes }}</td>
                                                    <td>{{ $row->dislikes }}</td>
                                                    <td>{{ $row->created_at }}</td>
                                                    <td style="text-align: center">
                                                        @if ($row->is_actived == 1)
                                                        <div class="status badge badge-success badge-pill badge-sm"
                                                            style="display: block;">Aktif</div>
                                                        <a href="#" class="btn btn-warning btn-sm"
                                                            onClick="setVideo('<?= $row->uuid ?>', '<?= $row->title ?>', 0)"
                                                            title="Nonaktifkan">Nonaktifkan</a>
                                                        @else
                                                        <div class="status badge badge-warning badge-pill badge-sm"
                                                            style="display: block;">Tidak Aktif</div>
                                                        <a href="#" class="btn btn-success btn-sm"
                                                            onClick="setVideo('<?= $row->uuid ?>','<?= $row->title ?>', 1)"
                                                            title="Aktifkan">Aktifkan</i></a>
                                                        @endif
                                                    </td>
                                                    <td style="text-align: center">
                                                        <a href="{{ url('admin/cms/video/edit/'.$row->uuid) }}"
                                                            class="btn btn-info btn-sm" title="Ubah">Edit</i></a>
                                                        <button class="btn btn-danger btn-sm" id="btnDelete"
                                                            data-id="{{ $row->uuid }}">Delete</button>
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
<script src="{{ asset('public/admin') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{ asset('public/admin') }}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"
    integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
            $('#tabel').DataTable({
                responsive: true,
            });
        });

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
                        url: '{{ url("admin/cms/video/delete") }}' + '/' + data_id,
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

        function setVideo(uuid, title, status) {
            var video_status = (status == 1) ? 'nonaktifkan' : 'aktifkan';
            Swal.fire({
                title: "<strong> Konfirmasi " + video_status + " video </strong>",
                html: 'Video <b>' + title + '</b> akan di' + video_status + ' ? ',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    $("#loader").show();
                    $.ajax({
                        type: 'GET',
                        url: "{{ url('admin/cms/video/set-status') }}" + "/" + uuid + "/" + status,
                        cache: false,
                        success: function(data) {
                            $("#loader").hide();
                            if (data) {
                                Swal.fire(
                                    'Berhasil',
                                    'Video berhasil di' + video_status,
                                    'success'
                                ).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire("Error!", 'Video gagal di' + video_status, "error").then((
                                    result) => {
                                    location.reload();
                                });
                            }

                        },
                        error: function(data) {
                            $("#loader").hide();
                            Swal.fire("Error!", 'Gagal melakukan verifikasi', "error").then((
                            result) => {
                                location.reload();
                            });
                        }
                    });

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
    href="{{ asset('public/admin') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
    integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection