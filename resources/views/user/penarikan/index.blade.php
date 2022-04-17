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
                                <h1 class="card-title-member">Penarikan</h1>
                            </div>
                            <div class="card-content">
                                <div class="card-body px-1 pb-3">
                                    <ul class="nav nav-justified mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item member-nav">
                                            <a class="nav-link member-nav-link active" id="pills-tambah-tab"
                                                data-toggle="tab" href="#pills-tambah" role="tab"
                                                aria-controls="pills-tambah" aria-selected="true">
                                                <span>Penarikan</span>
                                            </a>
                                        </li>
                                        <li class="nav-item member-nav">
                                            <a class="nav-link member-nav-link" id="pills-data-tab" data-toggle="tab"
                                                href="#pills-data" role="tab" aria-controls="pills-data"
                                                aria-selected="false">
                                                <span>Riwayat</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-tambah" role="tabpanel" aria-labelledby="pills-tambah-tab">
                                            <div class="alert alert-success" style="display:none"></div>
                                                                                                <div class="row m-0">
                                                                                            <div class="col-md-7">
                                                                <div class="total-amount-member">
                                                                    <div>
                                                                        <h3>Dana Tersedia <i class="la la-info-circle" onclick="infoWithdraw('Dana tersedia adalah dana yang bisa kamu tarik.')" style="cursor: pointer;padding: 5px 10px"></i></h3>
                                                                        <span class="withdraw-saldo">Rp. {{number_format(Auth::user()->trader->saldo->balance, 0, ',', '.')}}</span>
                                                                    </div>
                                                                    <div class="mt-2">
                                                                        <h3>Dana Tertahan <i class="la la-info-circle" onclick="infoWithdraw('Dana tertahan adalah jumlah dana Anda yang telah ditransaksikan di pasar sekunder. Dana dapat ditarik setelah 2 hari dari masa transaksi')" style="cursor: pointer;padding: 5px 10px"></i></h3>
                                                                        <span class="withdraw-pending">Rp. 0</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="col-12 bank-user">
                                                                            <h3>Dana Akan di Transfer ke Rekening: </h3>
                                                                            <hr>
                                                                            <h4 class="font-weight-bold">Bank Central Asia (BCA) - 123456789</h4>
                                                                            <h5 class="text-uppercase">Bank Account Name </h5>
                                                                            <h5 class="font-weight-bold small" style="color: #BF2D30;">
                                                                                                                                    </h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" class="form-control" name="saldo" id="saldo" value="0">
                                                                <input type="hidden" class="form-control" name="refund" id="refund" value="">
                        
                                                                <form action="#" method="post">
                                                                    <div class="form-group">
                                                                        <label for="lastName1">Jumlah Penarikan</label>
                                                                        <input type="text" class="form-control required-form-withdraw number-only" placeholder="" name="amount" id="amount">
                                                                        <input type="hidden" name="amount_limit" id="amount_limit" value="0">
                                                                        <span id="amount_error" class="text-danger"></span>
                                                                        <span id="amount_limit_alert" class="text-danger" style="display: none">
                                                                            Saldo tidak cukup. Saldo Anda Rp. 0                                                </span>
                                                                        <span id="amount_minimum_alert" class="text-danger" style="display: none">
                                                                            Minimal penarikan adalah Rp 100.000,00
                                                                        </span>
                                                                    </div>
                        
                                                                    <div class="hidden" id="terimaBersih">
                                                                        <div class="form-group">
                                                                            <label for="lastName1">Biaya Penarikan</label>
                                                                            <input type="text" class="form-control" placeholder="" name="fee" id="fee" readonly="readonly">
                                                                            <span id="fee_error" class="text-danger"></span>
                                                                        </div>
                        
                                                                        <div class="form-group">
                                                                            <label for="lastName1">Terima Bersih</label>
                                                                            <input type="text" class="form-control" placeholder="" name="total" id="total" readonly="readonly">
                                                                            <span id="total_error" class="text-danger"></span>
                                                                        </div>
                                                                    </div>
                        
                                                                    <button class="btn btn-santara-red btn-block submit-form-withdraw" id="submitWithdraw" type="button" disabled="">
                                                                        Tarik Dana                                            </button>
                                                                </form>
                        
                                                            </div>
                                                            <div class="col-md-5 disclamer-member">
                                                                <strong>Ketentuan:</strong>
                                                                <ul>
                                                                    <li>Minimal penarikan dana adalah Rp 100.000.</li>
                                                                    <li>Maksimal penarikan dana adalah Rp200.000.000/hari.</li>
                                                                    <li>Lama waktu pencairan ke rekening pengguna maksimal 3x24 jam hari kerja bank.</li>
                                                                    <li>Setiap transaksi penarikan dikenakan biaya sebesar Rp7.500.</li>
                                                                </ul>
                                                            </div>
                        
                                                        
                                                    </div>
                                                                                    </div>
                                        <div class="tab-pane fade" id="pills-data" role="tabpanel"
                                            aria-labelledby="pills-data-tab">
                                            <div class="table-responsive">
                                                <table class="table table-hover dataTable-table" id="datatable"
                                                    style="width: 100%">
                                                    <thead style="display: none;">
                                                        <tr>
                                                            <th class="border-top-0">Nama</th>
                                                            <th class="border-top-0">Amount</th>
                                                            <th class="border-top-0">Bank</th>
                                                            <th class="border-top-0">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($wd as $item)
                                                        <tr role="row" class="odd">
                                                            <td class="sorting_1">
                                                                <div class="media" style="align-items: flex-end;">
                                                                    <img class="mr-1"
                                                                        src="https://santara.co.id/assets/images/icon/wallet.png">
                                                                    <div class="media-body">
                                                                        <div><b>Penarikan</b></div>
                                                                        <div><small>{{Auth::user()->trader->name}}</small></div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="font-berhasil"><b>Berhasil</b></div>
                                                                <div><small>{{tgl_indo(date('Y-m-d', strtotime($item->created_at))).' '.formatJam($item->created_at),}}</small></div>
                                                            </td>
                                                            <td>
                                                                <div><small>Bank</small></div>
                                                                <div><b>{{$item->bank_to}}</b></div>
                                                            </td>
                                                            <td>
                                                                <div><small>Nilai Penarikan</small></div>
                                                                <div><b>Rp. {{number_format($item->amount,0,',','.')}}</b></div>
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
    .bank-user {
    padding: 10px;
    border-radius: 5px;
    border-color: #bf2d30 !important;
    background-color: #d9e4f5;
    background-image: linear-gradient(315deg, #edf4ff 0%, #f4dfe2 74%);
    margin-bottom: 10px;
}
</style>
@endsection