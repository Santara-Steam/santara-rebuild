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
                                <h1 class="card-title-member">Penerbit</h1>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a href="{{url('admin/emiten/add')}}" class="btn btn-primary">Tambah
                                                Penerbit</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table" id="tabel"> 
                                            <thead>
                                                <tr>
                                                    {{-- <th>Owner</th> --}}
                                                    <th>#</th>
                                                    <th>Nama Perusahaan</th>
                                                    <th>Nama Brand</th>
                                                    <th>Kode</th>
                                                    <th>Kategori</th>
                                                    {{-- <th>Status KYC</th> --}}
                                                    <th width="200">Status</th>
                                                    <th width="150">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 0;?>
                                                @for ($i = 0; $i < count($emiten); $i++)
                                                <?php $no++; ?>
                                                <tr>
                                                    {{-- <td>{{$item->trader_id}}</td> --}}
                                                    <td>{{$no}}</td>
                                                    <td>{{$emiten[$i]['company_name']}}</td>
                                                    <td>{{$emiten[$i]['trademark']}}</td>
                                                    <td>{{$emiten[$i]['code_emiten']}}</td>
                                                    <td>{{$emiten[$i]['ktg']}}</td>
                                                    {{-- <td>
                                                        {{$emiten[$i]['last_emiten_journey}}
                                                    </td> --}}
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                {{$emiten[$i]['last_emiten_journey']}}
                                                            </div>
                                                            @if ($emiten[$i]['last_emiten_journey'] == 'Pembagian Dividen')
                                                            <div class="col-2">
                                                                
                                                            </div>
                                                            @else
                                                            <div class="col-3">
                                                                <button type="button" class="btn btn-sm btn-success"
                                                                    data-toggle="modal"
                                                                    data-target="#default{{$emiten[$i]['id']}}">
                                                                    Update Status
                                                                </button>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <a href="{{url('admin/emiten/edit')}}/{{$emiten[$i]['id']}}"
                                                                    class="btn btn-block btn-sm btn-warning">Edit</a>
                                                            </div>
                                                            <div class="col-3 mr-0">
                                                            <form id="del{{$emiten[$i]['id']}}" method="post"
                                                                action="{{url('/emiten/delete')}}/{{$emiten[$i]['id']}}"
                                                                enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                            </form>
                                                                <a data-id="{{$emiten[$i]['id']}}" style="color: white" type="submit"
                                                                    class="btn btn-sm btn-danger  deletebtn">Delete</a>
                                                            </div>
                                                        </div>
                                                    </td>
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

@for ($i = 0; $i < count($emiten); $i++)
<div class="modal fade text-left" id="default{{$emiten[$i]['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{url('/emiten/update_status')}}/{{$emiten[$i]['id']}}" method="POST"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Update Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="projectinput6">Status</label>
                        <select id="projectinput6" name="title" class="form-control">
                            <option value="{{$emiten[$i]['last_emiten_journey']}}" selected hidden>{{$emiten[$i]['last_emiten_journey']}}</option>

                            @if ($emiten[$i]['last_emiten_journey'] == 'Pra Penawaran Saham' || 
                                $emiten[$i]['last_emiten_journey'] == null)
                            <option value="Penawaran Saham">Penawaran Saham</option>
                            <option value="Pendanaan Terpenuhi">Pendanaan Terpenuhi</option>
                            <option value="Penyerahan Dana">Penyerahan Dana</option>
                            <option value="Pembagian Deviden">Pembagian Deviden</option>
                            @elseif($emiten[$i]['last_emiten_journey'] == 'Penawaran Saham')
                            <option value="Pendanaan Terpenuhi">Pendanaan Terpenuhi</option>
                            <option value="Penyerahan Dana">Penyerahan Dana</option>
                            <option value="Pembagian Deviden">Pembagian Deviden</option>
                            @elseif($emiten[$i]['last_emiten_journey'] == 'Pendanaan Terpenuhi')
                            <option value="Penyerahan Dana">Penyerahan Dana</option>
                            <option value="Pembagian Deviden">Pembagian Deviden</option>
                            @elseif($emiten[$i]['last_emiten_journey'] == 'Penyerahan Dana')
                            <option value="Pembagian Dividen">Pembagian Dividen</option>
                            @endif

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Tanggal Mulai</label>
                        <input type="datetime-local" value="{{strftime('%Y-%m-%dT%H:%M:%S', strtotime($emiten[$i]['sd']))}}"
                            class="form-control" name="start_date" id="start_date">
                        {{-- {{$emiten[$i]['sd}} --}}
                    </div>
                    <div class="form-group">
                        <label for="start_date">Tanggal Selesai</label>
                        <input type="datetime-local" value="{{strftime('%Y-%m-%dT%H:%M:%S', strtotime($emiten[$i]['ed']))}}"
                            class="form-control" name="end_date" id="end_date">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endfor
@endsection
@section('js')
<script src="{{asset('public/admin')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{asset('public/admin')}}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('#tabel').DataTable({
            responsive: true,
        });
    });
</script>
<script>
     $(".deletebtn").click(function(e) {

    id = e.target.dataset.id;
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Data yang sudah anda hapus tidak akan bisa kembali!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus"
    }).then(function(result) {
        if (result.value) {

            Swal.fire(
                "Terhapus!",
                "Data telah terhapus.",
                "success"
            );
            $(`#del${id}`).submit();

        } else {

        }
    });
});
</script>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="{{asset('public/admin')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
@endsection