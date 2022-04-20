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
                        <div class="card" style="width: 100%;">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-xl-12">


                                        <h1 class="card-title-member">Daftar Transaksi</h1>
                                        {{-- {{Session::get('pws')}} --}}
                                    </div>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body px-1 pb-3">
                                    <ul class="nav nav-justified mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item member-nav">
                                            <a class="nav-link member-nav-link active" id="pills-tambah-tab"
                                                data-toggle="tab" href="#pills-tambah" role="tab"
                                                aria-controls="pills-tambah" aria-selected="true">
                                                <span class="d-none d-lg-block">Transaksi</span>
                                                <span class="d-lg-none">Transaksi</span>
                                            </a>
                                        </li>
                                        <li class="nav-item member-nav">
                                            <a class="nav-link member-nav-link" id="pills-data-tab" data-toggle="tab"
                                                href="#pills-data" role="tab" aria-controls="pills-data"
                                                aria-selected="false">
                                                <span class="d-none d-lg-block">Riwayat Transaksi</span>
                                                <span class="d-lg-none">Riwayat</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-tambah" role="tabpanel"
                                            aria-labelledby="pills-tambah-tab">
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="datatable-checkout"
                                                    style="width:auto; border-spacing: .25rem 1em;">
                                                    <thead style="display: none;">
                                                        <tr>
                                                            <th class="border-top-0">Nama Saham</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-data" role="tabpanel"
                                            aria-labelledby="pills-data-tab">
                                            <div class="table-responsive">
                                                <div id="datatable-invest_wrapper"
                                                    class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-6"></div>
                                                        <div class="col-sm-12 col-md-6"></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="dataTables_scroll">
                                                                <div class="dataTables_scrollHead"
                                                                    style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                                                                    <div class="dataTables_scrollHeadInner"
                                                                        style="box-sizing: content-box; width: 982.406px; padding-right: 17px;">
                                                                        <table
                                                                            class="table table-hover dataTable no-footer"
                                                                            style="width: 982.406px; border-spacing: 0.25rem 1em; margin-left: 0px;"
                                                                            role="grid">
                                                                            <thead style="display: none;">
                                                                                <tr role="row">
                                                                                    <th class="border-top-0 sorting_asc"
                                                                                        tabindex="0"
                                                                                        aria-controls="datatable-invest"
                                                                                        rowspan="1" colspan="1"
                                                                                        style="width: 0px;"
                                                                                        aria-sort="ascending"
                                                                                        aria-label="Nama Saham: activate to sort column descending">
                                                                                        Nama Saham</th>
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="dataTables_scrollBody"
                                                                    style="position: relative; overflow: auto; max-height: 200vh; width: 100%;">
                                                                    <table class="table table-hover dataTable no-footer"
                                                                        id="datatable-invest"
                                                                        style="width: 100%; border-spacing: 0.25rem 1em;"
                                                                        role="grid">
                                                                        <thead style="display: none;">
                                                                            <tr role="row" style="height: 0px;">
                                                                                <th class="border-top-0 sorting_asc"
                                                                                    aria-controls="datatable-invest"
                                                                                    rowspan="1" colspan="1"
                                                                                    style="width: 0px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;"
                                                                                    aria-sort="ascending"
                                                                                    aria-label="Nama Saham: activate to sort column descending">
                                                                                    <div class="dataTables_sizing"
                                                                                        style="height: 0px; overflow: hidden;">
                                                                                        Nama Saham</div>
                                                                                </th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                            @foreach ($transactions as $item)
                                                                            <?php 
                                                                            $picture = explode(',',$item->pictures);
                                                                            ?>
                                                                            <tr role="row" class="odd">
                                                                                <td class="sorting_1">
                                                                                    <div
                                                                                        style="display: flex;align-content: center;justify-content: flex-start;">
                                                                                        <div class="d-flex col-10">
                                                                                            <div><img
                                                                                                    src="{{env("STORAGE_GOOGLE")}}token/{{$picture[0]}}"
                                                                                                    width="150px"></div>
                                                                                            <div class="px-2"
                                                                                                style="width: 70%;">
                                                                                                <div
                                                                                                    style="font-size:18px">
                                                                                                    <b>{{$item->trademark}}</b></div>
                                                                                                <div
                                                                                                    style="font-size:15px">
                                                                                                    {{$item->company_name}} ({{$item->code_emiten}})</div>
                                                                                                <div
                                                                                                    style="display: flex; align-content: center;justify-content: space-between; margin: .5rem 0;">
                                                                                                    <span
                                                                                                        style="font-size:13px">{{tgl_indo(date('Y-m-d', strtotime($item->created_at))).' '.formatJam($item->created_at),}}</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div style="width: 30%">
                                                                                                @if ($item->status == 'EXPIRED')
                                                                                                <div
                                                                                                    class="p-1 font-gagal">
                                                                                                    <small><b>Pembelian Gagal</b></small>
                                                                                                </div>
                                                                                                @elseif ($item->status == 'VERIFIED')
                                                                                                <div
                                                                                                    class="p-1 font-berhasil">
                                                                                                    <small><b>Pembelian Berhasil</b></small>
                                                                                                </div>
                                                                                                @endif
                                                                                                

                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-2">
                                                                                            <div class="col-12"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 pt-1 pb-0">
                                                                                        <div><b>Total</b></div>
                                                                                        <p class="mb-0">
                                                                                            <span
                                                                                                style="font-size: 2rem;font-weight: bold;">
                                                                                                Rp. {{number_format($item->amount,0,',','.')}}
                                                                                            </span>
                                                                                            <small class="ml-1">
                                                                                                <a data-toggle="collapse"
                                                                                                    href="#detail_{{$item->transaction_serial}}"
                                                                                                    aria-expanded="false"
                                                                                                    aria-controls="detail_{{$item->transaction_serial}}">
                                                                                                    Detail
                                                                                                    <i
                                                                                                        class="la la-angle-right"></i>
                                                                                                    <i
                                                                                                        class="la la-angle-down"></i>
                                                                                                </a>
                                                                                            </small>
                                                                                        </p>
                                                                                        <div class="row col-12 py-1 collapse"
                                                                                            id="detail_{{$item->transaction_serial}}">
                                                                                            <span class="w-50">
                                                                                                <div>No. Transaksi :
                                                                                                    <b>{{$item->transaction_serial}}</b>
                                                                                                </div>
                                                                                                <div>Harga Saham :
                                                                                                    <b>Rp. {{number_format($item->price,0,',','.')}}</b>
                                                                                                </div>
                                                                                                <div>Jumlah Saham :
                                                                                                    <b>{{number_format($item->qty,0,',','.')}} Lembar</b></div>
                                                                                                <div>Biaya Admin :
                                                                                                    <b>Rp. {{number_format($item->fee,0,',','.')}} ( {{$item->channel}} )</b>
                                                                                                </div>
                                                                                            </span>
                                                                                            <span class="w-50">

                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            @endforeach
                                                                            
                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div id="datatable-invest_processing"
                                                                class="dataTables_processing card"
                                                                style="display: none;">Loading...</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-5"></div>
                                                        <div class="col-sm-12 col-md-7"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

@endsection
@section('style')
<style>
    .emiten-serial {
        font-size: 12px;
        background-color: rgba(229, 160, 55, 0.33);
        color: #4f5056;
        padding: 5px;
        margin-top: 5px;
        text-align: center;
        width: 50%;
        font-weight: bold;
        border-radius: .5rem;
    }

    .status-transaction {
        display: flex;
        align-content: center;
        justify-content: space-between;
        padding: .5rem;
        display: block;
        color: white;
        font-weight: bold;
        text-align: center;
    }

    .sorting_1 {
        width: 60%;
    }

    .table th,
    .table td {
        border-right: 1px solid #e3ebf3 !important;
        border-left: 1px solid #e3ebf3 !important;
        border-top: 1px solid #e3ebf3 !important;
        margin-bottom: 1rem;
    }

    [aria-expanded="true"] .la-angle-right,
    [aria-expanded="false"] .la-angle-down {
        display: none;
    }

    .type-trx {
        width: 150px;
        padding: .3em 0;
        text-align: center;
        color: #fff;
        border-radius: 4px;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: .3em;
    }

    .card-type-label-sukuk {
        background: #C7971E;
    }

    .card-type-label-saham {
        background: #BF2D30;
    }
</style>
@endsection