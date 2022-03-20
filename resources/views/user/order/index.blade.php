@extends('user.layout.master')
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
                                <h4 class="card-title">List Penerbit</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">

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
                                                    {{-- <th>Trader</th> --}}
                                                    <th>Order ID</th>
                                                    <th>Emiten</th>
                                                    <th>Lembar Saham</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                    <th width="18%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($book as $item)
                                                <tr>
                                                    {{-- <td>{{$item->trader_id}}</td> --}}
                                                    {{-- <td>{{$item->trd->name}}</td> --}}
                                                    <td>{{$item->order_id}}</td>
                                                    <td>{{$item->emtn->company_name}}</td>
                                                    <td>{{ number_format(round($item->lembar_saham,0),0,',','.')}}</td>
                                                    <td>Rp{{ number_format(round($item->total_amount,0),0,',','.')}}
                                                    </td>
                                                    <td>
                                                        @if ($item->bukti_tranfer == '-' || $item->bukti_tranfer ==
                                                        null)
                                                        <div class="badge badge-warning">Bukti Transfer Belum Di Upload
                                                        </div>
                                                        @elseif($item->bukti_tranfer != '-' && $item->isValid == 0)
                                                        <div class="badge badge-primary">Bukti Transfer Dalam Proses
                                                        </div>
                                                        @elseif($item->bukti_tranfer != '-' && $item->isValid == 1)
                                                        <div class="badge badge-success">Bukti Transfer Valid</div>
                                                        @elseif($item->bukti_tranfer != '-' && $item->isValid == 2)
                                                        <div class="badge badge-danger">Bukti Transfer Tidak Valid</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <a href="{{url('user/pesan_saham/detail/')}}/{{$item->id}}"
                                                                    class="btn btn-sm btn-primary ">Detail</a>
                                                            </div>
                                                            <div class="col-8">
                                                                @if ($item->bukti_tranfer == '-' || $item->bukti_tranfer
                                                                == null)
                                                                <button data-toggle="modal"
                                                                    data-target="#uploadbukti{{$item->id}}"
                                                                    class="btn btn-sm btn-warning">Upload
                                                                    Bukti</button>
                                                                @elseif($item->bukti_tranfer != '-' && $item->isValid ==
                                                                2)
                                                                <button data-toggle="modal"
                                                                    data-target="#uploadbukti{{$item->id}}"
                                                                    class="btn btn-sm  btn-warning">Upload
                                                                    Ulang</button>
                                                                @endif
                                                            </div>
                                                        </div>

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
@foreach ($book as $item)
<div class="modal fade" id="uploadbukti{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="uploadbuktiLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadbuktiLabel">Upload Bukti Transfer Order ID : #{{$item->order_id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('/upload_bukti')}}/{{$item->id}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card text-white bg-danger mb-3 " style="padding: 20px;">
                                <div class="card-header" style="background-color: #af2a37;border-radius: 5px;">BCA</div>
                                <div class="card-body " style="padding: 20px 0px 10px 0px;">
                                    <h2 class="c-margin-b-20"
                                        style="color: white;font-family: Arial, Helvetica, sans-serif;">
                                        12313-123123-12313123</h2>
                                    <p class="card-text" style="margin: 0;">A.n. Santara Santara Santara</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-white bg-danger mb-3 " style="padding: 20px;">
                                <div class="card-header" style="background-color: #af2a37;border-radius: 5px;">BCA</div>
                                <div class="card-body " style="padding: 20px 0px 10px 0px;">
                                    <h2 class="c-margin-b-20"
                                        style="color: white;font-family: Arial, Helvetica, sans-serif;">
                                        12313-123123-12313123</h2>
                                    <p class="card-text" style="margin: 0;">A.n. Santara Santara Santara</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-white bg-danger mb-3 " style="padding: 20px;">
                                <div class="card-header" style="background-color: #af2a37;border-radius: 5px;">BCA</div>
                                <div class="card-body " style="padding: 20px 0px 10px 0px;">
                                    <h2 class="c-margin-b-20"
                                        style="color: white;font-family: Arial, Helvetica, sans-serif;">
                                        12313-123123-12313123</h2>
                                    <p class="card-text" style="margin: 0;">A.n. Santara Santara Santara</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-white bg-danger mb-3 " style="padding: 20px;">
                                <div class="card-header" style="background-color: #af2a37;border-radius: 5px;">BCA</div>
                                <div class="card-body " style="padding: 20px 0px 10px 0px;">
                                    <h2 class="c-margin-b-20"
                                        style="color: white;font-family: Arial, Helvetica, sans-serif;">
                                        12313-123123-12313123</h2>
                                    <p class="card-text" style="margin: 0;">A.n. Santara Santara Santara</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 text-center" style="margin-top: -20px">
                        Transfer Sebesar <strong>Rp{{ number_format($item->total_amount,0,',','.') }}</strong> Ke Nomor Rekening Di Atas.
                    </div>
                    <div class="form-group">
                        <label for="bukti">Bukti Transfer</label>
                        <input type="file" class="form-control" name="bukti_transfer" id="bukti" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
@section('js')
<script src="{{asset('public/admin')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{asset('public/admin')}}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"
    integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('#tabel').DataTable({
            responsive: true,
            "columnDefs": [
    { "width": "23%", "targets": 5 },
    { "width": "5%", "targets": 4 },
  ],
        });
    });
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
    href="{{asset('public/admin')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
@endsection