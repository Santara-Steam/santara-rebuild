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
                                <h4 class="card-title">Daftar Order Saham</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table zero-configuration">
                                            <thead>
                                                <tr>
                                                    {{-- <th>Owner</th> --}}
                                                    <th>Trader</th>
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
                                                    <td>{{$item->trd->name}}</td>
                                                    <td>{{$item->emtn->company_name}}</td>
                                                    <td>{{$item->lembar_saham}}</td>
                                                    <td>{{$item->total_amount}}</td>
                                                    <td>
                                                        @if ($item->bukti_tranfer == '-' || $item->bukti_tranfer == null)
                                                        <div class="badge badge-warning">Bukti Transfer Belum Di Upload</div>
                                                        @elseif($item->bukti_tranfer != '-' && $item->isValid == 0)
                                                        <div class="badge badge-success">Bukti Transfer Sudah Di Upload</div>
                                                        @elseif($item->bukti_tranfer != '-' && $item->isValid == 3)
                                                        <div class="badge badge-success">Bukti Transfer Sudah Di Upload Ulang</div>
                                                        @elseif($item->bukti_tranfer != '-' && $item->isValid == 1)
                                                        <div class="badge badge-primary">Bukti Transfer Valid</div>
                                                        @elseif($item->bukti_tranfer != '-' && $item->isValid == 2)
                                                        <div class="badge badge-danger">Bukti Transfer Tidak Valid</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                                <a href="{{url('admin/pesan_saham/detail')}}/{{$item->id}}"
                                                                    class="btn btn-sm btn-primary">Lihat Bukti Transfer</a>
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