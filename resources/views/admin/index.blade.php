@extends('admin.layout.master')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="basic-examples">
                <div class="row">
                    <div class="col-12 mb-1">
                        <h4>Welcome {{Auth::user()->trader->name}}!</h4>
                        <p>Platform Equity Crowdfunding pertama yang berizin dan diawasi Otoritas Jasa Keuangan berdasarkan Surat Keputusan Nomor: KEP-59/D.04/2019.</p>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-md-12">
                        <div class="card overflow-hidden">
                            <div class="card-content">
                                <div class="card-body cleartfix">
                                    
                                    <div class="media align-items-stretch">
                                        <div class="align-self-center">
                                            <i class="icon-briefcase info font-large-2 mr-2"></i>
                                        </div>
                                        <div class="media-body">
                                            <h4>Total Penerbit</h4>
                                            <span>Total Penerbit Terdaftar</span>
                                        </div>
                                        <div class="align-self-center">
                                            <h1>{{$total_penerbit}}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body cleartfix">
                                    <div class="media align-items-stretch">
                                        <div class="align-self-center">
                                            <i class="icon-user-following info font-large-2 mr-2"></i>
                                        </div>
                                        <div class="media-body">
                                            <h4>Total User</h4>
                                            <span>Total User Terdaftar</span>
                                        </div>
                                        <div class="align-self-center">
                                            <h1>{{$total_user}}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-md-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body cleartfix">
                                    <div class="media align-items-stretch">
                                        <div class="align-self-center">
                                            <h1 class="mr-2">{{$book_verif}}</h1>
                                        </div>
                                        <div class="media-body">
                                            <h4>Transaksi Pesan Saham</h4>
                                            <span>Transaksi Pesan Saham Perlu Verifikasi</span>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="icon-basket warning font-large-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body cleartfix">
                                    <div class="media align-items-stretch">
                                        <div class="align-self-center">
                                            <h1 class="mr-2">{{$book_valid}}</h1>
                                        </div>
                                        <div class="media-body">
                                            <h4>Transaksi Pesan Saham</h4>
                                            <span>Transaksi Pesan Saham Tervalidasi</span>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="icon-handbag info font-large-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-md-12">
                        <div class="card overflow-hidden">
                            <div class="card-content">
                                <div class="card-body cleartfix">
                                    
                                    <div class="media align-items-stretch">
                                        <div class="align-self-center">
                                            <i class="icon-docs info font-large-2 mr-2"></i>
                                        </div>
                                        <div class="media-body">
                                            <h4>Total Lembar Saham </h4>
                                            <span>Total Akumulasi Lembar Saham Di Pesan</span>
                                        </div>
                                        <div class="align-self-center">
                                            <h1>{{number_format($book_lbr->lbr,0,',','.')}}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body cleartfix">
                                    <div class="media align-items-stretch">
                                        <div class="align-self-center">
                                            <i class=" icon-wallet info font-large-2 mr-2"></i>
                                        </div>
                                        <div class="media-body">
                                            <h4>Total Saham</h4>
                                            <span>Total Akumulasi Saham Di Pesan</span>
                                        </div>
                                        <div class="align-self-center">
                                            <h1>Rp{{number_format($book_rp->rp,0,',','.')}}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @if ($book_verif == 0)
            
            @else
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Transaksi Pesan Saham Perlu Verifikasi</h4>
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
                                                    <th>#</th>
                                                    <th>Order ID</th>
                                                    <th>Emiten</th>
                                                    <th>Lembar Saham</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                    <th width="18%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 0;?>
                                                {{-- @foreach ($emiten as $item) --}}
                                                @foreach ($book_vverif as $item)
                                                <?php $no++; ?>
                                                <tr>
                                                    <td>{{$no}}</td>
                                                    {{-- <td>{{$item->trd->name}}</td> --}}
                                                    <td>{{$item->order_id}}</td>
                                                    <td>{{$item->emtn->company_name}}</td>
                                                    <td>{{ number_format(round($item->lembar_saham,0),0,',','.')}}</td>
                                                    <td>Rp{{ number_format(round($item->total_amount,0),0,',','.')}}
                                                    </td>
                                                    <td>
                                                        @if ($item->bukti_tranfer == '-' || $item->bukti_tranfer == null)
                                                        <div class="badge badge-warning">Bukti Transfer Belum Di Upload</div>
                                                        @elseif($item->bukti_tranfer != '-' && $item->isValid == 0)
                                                        <div class="badge badge-primary">Bukti Transfer Sudah Di Upload</div>
                                                        @elseif($item->bukti_tranfer != '-' && $item->isValid == 3)
                                                        <div class="badge badge-primary">Bukti Transfer Sudah Di Upload Ulang</div>
                                                        @elseif($item->bukti_tranfer != '-' && $item->isValid == 1)
                                                        <div class="badge badge-success">Bukti Transfer Valid</div>
                                                        @elseif($item->bukti_tranfer != '-' && $item->isValid == 2)
                                                        <div class="badge badge-danger">Bukti Transfer Tidak Valid</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                                <a href="{{url('admin/pesan_saham/detail')}}/{{$item->id}}"
                                                                    class="btn btn-sm btn-primary">Lihat Detail</a>
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
            @endif
                
            </section>
        </div>
    </div>
</div>
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