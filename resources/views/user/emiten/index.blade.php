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
                        @include('user.is_kyc')
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
                                                    <th>#</th>
                                                    <th>Penerbit</th>
                                                    <th style="width: 10%">Dana Dibutuhkan</th>
                                                    <th>Saham Dilepas</th>
                                                    <th>Deviden Tahunan</th>
                                                    {{-- <th>Omset 2021</th> --}}
                                                    {{-- <th>Omset 2022</th> --}}
                                                    {{-- <th>Status</th> --}}
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 0;?>
                                                {{-- @foreach ($emiten as $item) --}}
                                                @foreach ($emiten as $item)
                                                <?php $no++; ?>
                                                <tr>
                                                    <td>{{$no}}</td>
                                                    <td>{{$item->company_name}}</td>
                                                    <td>Rp{{number_format(round($item->avg_capital_needs,0),0,',','.')}}
                                                    </td>
                                                    <td>{{round($item->avg_general_share_amount,0)}}%</td>
                                                    <td>{{round($item->avg_annual_dividen,0)}}%</td>
                                                    {{-- <td>Rp{{number_format(round($item->avg_annual_turnover_previous_year,0),0,',','.')}}
                                                    </td>
                                                    <td>Rp{{number_format(round($item->avg_annual_turnover_current_year,0),0,',','.')}}
                                                    </td> --}}
                                                    {{-- <td>{{$item->sts}}</td> --}}
                                                    <td>
                                                                <a href="{{url('detail-coming-soon')}}/{{$item->id}}" class="btn btn-sm btn-primary">
                                                                    Lihat Detail
                                                                </a>
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
<script src="{{asset('public/admin')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{asset('public/admin')}}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
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