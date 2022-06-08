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
                                <h1 class="card-title-member">Cash Info</h1>
                            </div>
                            <div class="card-content">
                                <div class="card-body px-1 pb-3">
                                    <ul class="nav nav-justified mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item member-nav">
                                            <a class="nav-link member-nav-link active" id="pills-tambah-tab"
                                                data-toggle="tab" href="#pills-tambah" role="tab"
                                                aria-controls="pills-tambah" aria-selected="true">
                                                <span class="card-title-member">Deposit</span>
                                            </a>
                                        </li>
                                        <li class="nav-item member-nav">
                                            <a class="nav-link member-nav-link" id="pills-data-tab" data-toggle="tab"
                                                href="#pills-data" role="tab" aria-controls="pills-data"
                                                aria-selected="false">
                                                <span class="card-title-member">Penarikan</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-tambah" role="tabpanel"
                                            aria-labelledby="pills-tambah-tab">
                                            <div class="row m-0">
                                                <div class="col-md-7">
                                                    {{-- {{Session::get('newurl')}} --}}
                                                    <div class="total-amount-member">
                                                        <div>
                                                            <h3>Saldo Anda</h3>
                                                            <span class="withdraw-saldo">Rp.
                                                                {{number_format(Auth::user()->trader->saldo->balance, 0,
                                                                ',', '.')}}</span>
                                                        </div>
                                                    </div>
                                                    <form class="form" action="{{url('/user/create_deposit')}}"
                                                        method="POST" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <label for="lastName1">Jumlah Deposit</label>
                                                            <input type="text"
                                                                class="form-control required-form-deposit number-only"
                                                                name="amount" id="amount" maxlength="20">
                                                            <input type="text" id="am" name="am" hidden>
                                                            <span id="amount_error" class="text-danger"></span>
                                                            <span id="amount_limit" class="text-danger"
                                                                style="display: none">
                                                                Minimal Jumlah Deposit Rp.100.000<br>
                                                            </span>
                                                            <div class="hidden" id="biaya">
                                                                <div class="form-group">
                                                                    <label for="lastName1">Biaya Deposit</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="" name="fee" id="fee"
                                                                        readonly="readonly">
                                                                    <span id="fee_error" class="text-danger"></span>
                                                                </div>

                                                            </div>
                                                            <span class="withdraw-saldo"
                                                                style="display: none; font-size:16px" id="total">Total:
                                                            </span>
                                                        </div>

                                                        <!-- <div class="form-group">
                                                            <label for="lastName1">Metode Pembayaran</label>
                                                            <select name="channel" id="channel" class="form-control required-form-deposit">
                                                                <option selected disabled value="">Pilih</option>
                                                                <option data-id="ONEPAY" value="ONEPAY">ONEPAY</option>
                                                                <option data-id="VA" value="VA">Virtual Account</option>
                                                            </select>
                                                            <span id="channel_error" class="text-danger"></span>
                                                            <div class="alert alert-info-dashboard mt-1" style="display:none" id="alert_va">
                                                                Transaksi deposit menggunakan metode <b>Virtual Account</b> akan dikenakan <b>biaya admin</b> sebesar Rp. 2.000
                                                            </div>
                                                        </div> -->
                                                        <div class="form-group account_number" style="display:none">
                                                            <label for="lastName1">Nomor Rekening Anda</label>
                                                            <input type="text"
                                                                class="form-control number-only required-form-deposit"
                                                                name="account_number" id="account_number"
                                                                maxlength="16">
                                                            <span id="account_number_error" class="text-danger"></span>
                                                        </div>

                                                        <div class="form-group bank_from" style="display:none">
                                                            <label for="lastName1">Bank Rekening Anda</label>
                                                            <select name="bank_from" id="bank_from"
                                                                class="form-control required-form-deposit">
                                                                <option value="">Pilih...</option>
                                                                <option value="MANDIRI">Bank Mandiri</option>
                                                                <option value="BCA">Bank BCA</option>
                                                                <option value="BRI">Bank BRI</option>
                                                                <option value="BNI">Bank BNI</option>
                                                                <option value="other">Lainnya</option>
                                                            </select>
                                                            <span id="bank_from_error" class="text-danger"></span>
                                                        </div>

                                                        <div class="form-group bank_from_text" style="display:none">
                                                            <input type="text"
                                                                class="form-control alpha-space-only required-form-deposit"
                                                                placeholder="Nama Bank" name="bank_from_text"
                                                                id="bank_from_text" maxlength="15">
                                                            <span id="bank_from_text_error" class="text-danger"></span>
                                                        </div>

                                                        <div class="form-group bank" style="display:none">
                                                            <label for="lastName1">Bank</label>
                                                            <select name="bank" id="bank"
                                                                class="form-control required-form-deposit">
                                                                <option value="">Pilih...</option>
                                                                <option value="MANDIRI">Bank Mandiri</option>
                                                                <option value="PERMATA">Bank Permata</option>
                                                                <option value="BNI">Bank BNI</option>
                                                                <option value="BRI">Bank BRI</option>
                                                                <option value="BCA">Bank BCA</option>
                                                            </select>
                                                            <span id="bank_error" class="text-danger"></span>
                                                        </div>
                                                        <button type="submit"
                                                            class="btn btn-santara-red btn-block
                                                            <?= (Auth::user()->is_verified == 1) ? 'submit-form-deposit' : 'disabled' ?>"
                                                            <?=(Auth::user()->is_verified == 1) ?
                                                            'id="sdp"' : '' ?> type="button">
                                                            <?= (Auth::user()->is_verified == 1) ? 'Deposit' : 'Akun belum verifikasi' ?>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="col-md-5 disclamer-member">
                                                    <strong>Ketentuan:</strong>
                                                    <ul>
                                                        <li>Minimal deposit adalah <b>Rp 100.000 </b> (Seratus Ribu
                                                            Rupiah)</li>
                                                        <li>Transaksi deposit akan dikenakan <b>biaya admin</b> sebesar
                                                            <b>Rp
                                                                {{--
                                                                <?= number_format($fee, 0, ',', '.') ?> --}}
                                                                4.000
                                                            </b> (
                                                            {{--
                                                            <?= $terbilang ?> --}}
                                                            Empat Ribu
                                                            Rupiah)
                                                        </li>
                                                    </ul>
                                                </div>
                                                {{-- @if (Session::has('newurl'))
                                                <a id="link" class="link" href="{{Session::get('newurl')}}"
                                                    target="_blank">Link</a>
                                                @endif --}}

                                            </div>
                                            {{--
                                        </div>
                                        <div class="tab-pane fade" id="pills-data" role="tabpanel"
                                            aria-labelledby="pills-data-tab"> --}}
                                            {{--
                                            <hr>
                                            <h1 class="card-title-member">Riwayat Deposit</h1>


                                            <div class="table-responsive">
                                                <table class="table table-hover dataTable-table" id="datatable"
                                                    style="width: 100%">
                                                    <thead>
                                                        <tr style="display: none;">
                                                            <th class="border-top-0">Nama</th>
                                                            <th class="border-top-0">Status</th>
                                                            <th class="border-top-0">Transaksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($deposit as $item)

                                                        <tr role="row" class="odd">
                                                            <td class="sorting_1 row">
                                                                <div class="media col-6 col-sm-6 col-md-3">
                                                                    <img class="mr-1"
                                                                        src="https://santara.co.id/assets/images/icon/wallet.png">
                                                                    <div class="media-body">
                                                                        <div><b>Deposit</b></div>
                                                                        <div><small>-</small></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 col-sm-6 col-md-3">

                                                                    @if ($item->status == 0)
                                                                    <div class="font-menunggu-verifikasi"><b>Menunggu
                                                                            Verifikasi</b></div>
                                                                    @elseif ($item->status == 1)
                                                                    <div class="font-berhasil"><b>Berhasil</b></div>
                                                                    @elseif ($item->status == 2)
                                                                    <div class="font-gagal"><b>Gagal</b></div>
                                                                    @else
                                                                    <div class="font-menunggu-verifikasi"><b>Menunggu
                                                                            Verifikasi</b></div>
                                                                    @endif
                                                                    <div><small>{{tgl_indo(date('Y-m-d',
                                                                            strtotime($item->created_at))).'
                                                                            '.formatJam($item->created_at),}}</small>
                                                                    </div>
                                                                </div>
                                                                <div class="row col-md-6">
                                                                    <span class="col-6 col-sm-4 col-md-4"><small>Metode
                                                                            Pembayaran</small><br><b>
                                                                            @if ($item->channel == 'ONEPAY')
                                                                            OTHER PAYMENT
                                                                            @else
                                                                            -
                                                                            @endif


                                                                        </b></span>
                                                                    <span class="col-6 col-sm-4 col-md-4"><small>Nilai
                                                                            Deposit</small><br><b
                                                                            style="color: green;">Rp.
                                                                            {{number_format($item->amount,0,',','.')}}</b></span>
                                                                    <span class="col-6 col-sm-4 col-md-4"><small>Biaya
                                                                            Admin</small><br><b
                                                                            style="color: green;">Rp.
                                                                            {{number_format($item->fee,0,',','.')}}</b></span>
                                                                </div>
                                                                <div class="col-md-6"></div>
                                                                <div class="row col-md-6">
                                                                    <div class="col-12">

                                                                        <span><small>Total
                                                                                Pembayaran</small><br><b
                                                                                style="color: green;">Rp.
                                                                                {{number_format($item->amount+$item->fee,0,',','.')}}</b></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6"></div>

                                                                <div class="row col-md-6">
                                                                    <div class="col-12">


                                                                        @if ($item->status == 0)
                                                                        <a href="{{$item->redirect_url}}"
                                                                            target="_blank"
                                                                            class="btn btn-info btn-sm btn-block"
                                                                            title="Ubah">Lanjut Pembayaran</a>
                                                                        @endif
                                                                    </div>
                                                                </div>


                                                            </td>
                                                        </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div> --}}
                                        </div>

                                        @if ($trader_bank)

                                        <div class="tab-pane fade" id="pills-data" role="tabpanel"
                                            aria-labelledby="pills-data-tab">
                                            <div class="alert alert-success" style="display:none"></div>
                                            <div class="row m-0">
                                                <div class="col-md-7">
                                                    <div class="total-amount-member">
                                                        <div>
                                                            <h3>Dana Tersedia <i class="la la-info-circle"
                                                                    onclick="infoWithdraw('Dana tersedia adalah dana yang bisa kamu tarik.')"
                                                                    style="cursor: pointer;padding: 5px 10px"></i></h3>
                                                            <span class="withdraw-saldo">Rp.
                                                                {{number_format(Auth::user()->trader->saldo->balance, 0,
                                                                ',', '.')}}</span>
                                                        </div>
                                                        <div class="mt-2">
                                                            <h3>Dana Tertahan <i class="la la-info-circle"
                                                                    onclick="infoWithdraw('Dana tertahan adalah jumlah dana Anda yang telah ditransaksikan di pasar sekunder. Dana dapat ditarik setelah 2 hari dari masa transaksi')"
                                                                    style="cursor: pointer;padding: 5px 10px"></i></h3>
                                                            <span class="withdraw-pending">Rp. 0</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="col-12 bank-user">
                                                                <h3>Dana Akan di Transfer ke Rekening: </h3>
                                                                <hr>
                                                                <h4 class="font-weight-bold">{{$trader_bank->bank}}
                                                                    ({{$trader_bank->bank_code}}) -
                                                                    {{$trader_bank->account_number_bwd}}</h4>
                                                                <h5 class="text-uppercase">
                                                                    {{$trader_bank->account_name_bwd}} </h5>
                                                                <h5 class="font-weight-bold small"
                                                                    style="color: #BF2D30;">
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" class="form-control" name="saldo" id="saldowd"
                                                        value="{{round(Auth::user()->trader->saldo->balance,0)}}">
                                                    <input type="hidden" class="form-control" name="refund"
                                                        id="refundwd" value="">


                                                    <form class="form" action="{{url('/user/penarikan/create')}}"
                                                        method="POST" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <label for="lastName1">Jumlah Penarikan</label>
                                                            <input type="text"
                                                                class="form-control required-form-withdraw number-only"
                                                                placeholder="" name="amount" id="amountwd">
                                                            <input type="hidden" name="amount_limit" id="amount_limitwd"
                                                                value="{{round(Auth::user()->trader->saldo->balance,0)}}">
                                                            <span id="amount_errorwd" class="text-danger"></span>
                                                            <span id="amount_limit_alertwd" class="text-danger"
                                                                style="display: none">
                                                                Saldo tidak cukup. Saldo Anda Rp.
                                                                {{number_format(Auth::user()->trader->saldo->balance, 0,
                                                                ',', '.')}} </span>
                                                            <span id="amount_minimum_alertwd" class="text-danger"
                                                                style="display: none">
                                                                Minimal penarikan adalah Rp 100.000,00
                                                            </span>
                                                        </div>

                                                        <div class="hidden" id="terimaBersih">
                                                            <div class="form-group">
                                                                <label for="lastName1">Biaya Penarikan</label>
                                                                <input type="text" class="form-control" placeholder=""
                                                                    name="fee" id="feewd" readonly="readonly">
                                                                <span id="fee_errorwd" class="text-danger"></span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="lastName1">Terima Bersih</label>
                                                                <input type="text" class="form-control" placeholder=""
                                                                    name="total" id="totalwd" readonly="readonly">
                                                                <span id="total_errorwd" class="text-danger"></span>
                                                            </div>
                                                        </div>

                                                        {{-- <button type="submit"
                                                            class="btn btn-santara-red btn-block submit-form-withdraw"
                                                            id="submitWithdraw" type="button" disabled="">
                                                            Tarik Dana </button> --}}
                                                    </form>
                                                    <button id="withdraw" class="btn btn-santara-red btn-block sippp"
                                                        disabled="">
                                                        Tarik Dana </button>

                                                    {{-- <form class="form" action="{{url('/pin_check')}}" method="POST"
                                                        enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="password" name="pin">
                                                        <button type="submit">Kirim</button>
                                                    </form> --}}

                                                </div>
                                                <div class="col-md-5 disclamer-member">
                                                    <strong>Ketentuan:</strong>
                                                    <ul>
                                                        <li>Minimal penarikan dana adalah Rp 100.000.</li>
                                                        <li>Maksimal penarikan dana adalah Rp200.000.000/hari.</li>
                                                        <li>Lama waktu pencairan ke rekening pengguna maksimal 3x24 jam
                                                            hari kerja bank.</li>
                                                        <li>Setiap transaksi penarikan dikenakan biaya sebesar Rp7.500.
                                                        </li>
                                                    </ul>
                                                </div>


                                            </div>
                                            {{--
                                        </div> --}}

                                        @else
                                        <div class="tab-pane fade" id="pills-data" role="tabpanel"
                                            aria-labelledby="pills-data-tab">
                                            <div class="alert alert-success" style="display:none"></div>
                                            <div class="row m-0" data-select2-id="6">
                                                <div class="col-md-12" data-select2-id="5">
                                                    <div class="disclamer-member">
                                                        {{-- {{Session::get('token')}} --}}
                                                        <strong>Note:</strong>
                                                        Bank yang Anda daftarkan seterusnya akan digunakan untuk
                                                        melakukan penarikan dana dan dividen
                                                    </div>
                                                    {{-- <form action="#" class="mt-2" id="submitBank" method="post"
                                                        data-select2-id="submitBank">
                                                        --}}
                                                        <form class="form" action="{{url('/user/add_bank')}}"
                                                            method="POST" enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <div class="form-group">
                                                                <label for="lastName1">Bank<small
                                                                        class="text-danger">*</small></label>
                                                                <select class="form-control" name="bank" id="bank">
                                                                    @foreach ($bwd as $item)
                                                                    <option value="{{$item->id}}">{{$item->bank}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                <small id="bank_error" class="text-danger"></small>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="lastName1">Nama<small
                                                                        class="text-danger">*</small></label>
                                                                <input type="text" class="form-control" placeholder=""
                                                                    name="nama" value="{{Auth::user()->trader->name}}"
                                                                    id="nama" readonly="">
                                                                <small id="nama_error" class="text-danger"></small>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="lastName1">No. Rekening<small
                                                                        class="text-danger">*</small></label>
                                                                <input type="text" class="form-control number-only"
                                                                    placeholder="" maxlength="20" name="norek"
                                                                    id="norek">
                                                                <small id="norek_error" class="text-danger"></small>
                                                            </div>

                                                            <button class="btn btn-santara-red btn-block" type="submit"
                                                                id="bsubmitBank">
                                                                Daftar Bank </button>
                                                        </form>
                                                </div>
                                            </div>
                                            {{--
                                        </div> --}}
                                        @endif

                                        {{-- <div class="tab-pane fade" id="pills-data" role="tabpanel"
                                            aria-labelledby="pills-data-tab">
                                            --}}
                                            {{--
                                            <hr>
                                            <h1 class="card-title-member">Riwayat Penarikan</h1>
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
                                                                        <div>
                                                                            <small>{{Auth::user()->trader->name}}</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                @if ($item->is_verified == 0)
                                                                <div class="font-menunggu-verifikasi"><b>Menunggu
                                                                        Verifikasi</b></div>
                                                                @elseif ($item->is_verified == 1)
                                                                <div class="font-berhasil"><b>Berhasil</b></div>
                                                                @elseif ($item->is_verified == 2)
                                                                <div class="font-gagal"><b>Gagal</b></div>
                                                                @endif
                                                                <div><small>{{tgl_indo(date('Y-m-d',
                                                                        strtotime($item->created_at))).'
                                                                        '.formatJam($item->created_at),}}</small></div>
                                                            </td>
                                                            <td>
                                                                <div><small>Bank</small></div>
                                                                <div><b>{{$item->bank_to}}</b></div>
                                                            </td>
                                                            <td>
                                                                <div><small>Nilai Penarikan</small></div>
                                                                <div><b>Rp.
                                                                        {{number_format($item->amount,0,',','.')}}</b>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div> --}}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <form action="{{url('/user/wallet')}}"
                                                        method="GET" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-3">
                                        <h1 class="card-title-member">Riwayat</h1>
                                    </div>
                                    <div class="col-md-9 row" style="    padding-top: 13px;">
                                        <div class="col-md-4">
                                            <input type="date" name="start" class="form-control" placeholder="Start Date">
                                        </div>
                                        <div class="col-md-1" style="    line-height: 40px;
                                        text-align: center;">To</div>
                                        <div class="col-md-4">

                                            <input type="date" name="end" class="form-control" placeholder="End Date">
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-info">Filter</button>
                                            <a href="{{url('/user/wallet')}}" class="btn btn-secondary">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            </div>

                            <div class="card-content">
                                <div class="table-responsive" style="padding-right: 20px;
                                padding-left: 20px;
                            ">
                                    <table class="table table-hover dataTable-table" id="tabel"
                                        style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">#</th>
                                                <th class="border-top-0">Tanggal</th>
                                                <th class="border-top-0">Deskripsi</th>
                                                <th class="border-top-0">Amount</th>
                                                <th class="border-top-0">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0 ;?>
                                            @foreach ($se as $item)
                                            <?php $no++ ?>
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>{{tgl_indo(date('Y-m-d',
                                                    strtotime($item->created_at))).'
                                                    '.formatJam($item->created_at),}}</td>
                                                {{-- <td>{{$item->DEPOSIT}}</td> --}}
                                                <td>@if ($item->DEPOSIT == 'DEPOSIT')
                                                                <div class="font-berhasil"><b>DEPOSIT</b></div>
                                                                @else
                                                                <div class="font-gagal"><b>WITHDRAW</b></div>
                                                @endif
                                                </td>
                                                <td>Rp. {{number_format($item->amount,0,',','.')}}</td>
                                                <td>
                                                    @if ($item->DEPOSIT == 'DEPOSIT')


                                                    @if ($item->status == 0)
                                                                <div class="font-menunggu-verifikasi"><b>Menunggu
                                                                        Verifikasi</b></div>
                                                                        <a href="{{$item->redirect_url}}" target="_blank"
                                                                            class="btn btn-info btn-sm btn-block"
                                                                            title="Ubah">Lanjut Pembayaran</a>
                                                                @elseif ($item->status == 1)
                                                                <div class="font-berhasil"><b>Berhasil</b></div>
                                                                @elseif ($item->status == 2)
                                                                <div class="font-gagal"><b>Gagal</b></div>
                                                                @else
                                                                <div class="font-menunggu-verifikasi"><b>Menunggu
                                                                        Verifikasi</b></div>
                                                                @endif

                                                    @else
                                                    @if ($item->status == 0)
                                                    <div class="font-menunggu-verifikasi"><b>Menunggu Verifikasi</b></div>
                                                    @elseif ($item->status == 1)
                                                    <div class="font-berhasil"><b>Berhasil</b></div>
                                                    @elseif ($item->status == 2)
                                                    <div class="font-gagal"><b>Gagal</b></div>
                                                    @endif
                                                    @endif
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
            </section>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment-with-locales.min.js" integrity="sha512-vFABRuf5oGUaztndx4KoAEUVQnOvAIFs59y4tO0DILGWhQiFnFHiR+ZJfxLDyJlXgeut9Z07Svuvm+1Jv89w5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('admin')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{asset('admin')}}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
<script type="text/javascript" src="{{asset('public')}}/app-assets/js/core/alert/sweetalert.min.js"></script>
<script src="{{asset('public')}}/assets2/js/global.js?v=5.8.8"></script>
<script>
    const feeDeposit = "4000"
    const amount = document.getElementById("amount");
const channel = document.getElementById("channel");
const fee = document.getElementById("fee");
const bank_from = document.getElementById("bank_from");
const bank = document.getElementById("bank");
const bank_from_text = document.getElementById("bank_from_text");
const account_number = document.getElementById("account_number");

$(document).ready(function () {
  $("#amount_limit").hide();
  var fee_val = feeDeposit;
  fee.value = formatNumber(parseInt(fee_val));
  amount.value = 0;
  validateFormdp();
});

function bankFromText() {
  if (bank_from.value == "other") {
    $(".bank_from_text").css("display", "");
  } else {
    $(".bank_from_text").css("display", "none");
  }
}

function validateFormdp() {
  $(".submit-form-deposit").prop("disabled", true);
  $("#sdp").prop("disabled", true);
  var requiredAllCompleted = true;

  $(".required-form-deposit").each(function () {
    if (
      parseInt(amount.value.replace(/\./g, "")) < 100000 ||
      amount.value == 0
    ) {
      $("#biaya").addClass("hidden");
      requiredAllCompleted = false;
    } else {
      $("#biaya").removeClass("hidden");
    }

    // if (channel.value == "" || (channel.value == "VA" && bank.value == "")) {
    //   requiredAllCompleted = false;
    // }

    // if (channel.value == 'BANKTRANSFER' && (account_number.value == "" || bank_from.value == "" || (bank_from.value == 'other' && bank_from_text.value == ""))) {
    //   requiredAllCompleted = false;
    // }
  });

  if (requiredAllCompleted) $(".submit-form-deposit").prop("disabled", false);
  if (requiredAllCompleted) $("#sdp").prop("disabled", false);
}

$(".required-form-deposit").on("keyup change blur input", function () {
  validateFormdp();
});

$("#amount").on("keyup change blur input", function (e) {
  this.value = parseInt(this.value.replace(/\./g, ""));
    $("#am").val(this.value);
    // console.log($("#am").val());
  if (this.value != "" && !isNaN(this.value)) {
    if (this.value < 100000) {
      $("#amount_limit").show();
    } else {
      $("#amount_limit").hide();
    }
    let jml = parseInt(this.value) + parseInt(feeDeposit);
    $("#total").show();
    $("#total").html(`<b>Total: Rp ${formatNumber(jml)}</b>`);
    this.value = formatNumber(this.value);
  } else {
    this.value = 0;
  }
});

// channel.addEventListener("change", function (e) {
//   if (channel.value == "VA") {
//     account_number.value = "";
//     bank_from.value = "";
//     bank_from_text.value = "";

//     $("#alert_va").css("display", "");
//     $(".bank").css("display", "");
//     $(".account_number").css("display", "none");
//     $(".bank_from").css("display", "none");
//     $(".bank_from_text").css("display", "none");
//   } else if (channel.value == "BANKTRANSFER") {
//     bank.value = "";

//     $("#alert_va").css("display", "none");
//     $(".bank").css("display", "none");
//     $(".account_number").css("display", "");
//     $(".bank_from").css("display", "");
//     bankFromText();
//   } else {
//     account_number.value = "";
//     bank_from.value = "";
//     bank_from_text.value = "";
//     bank.value = "";
//     $("#alert_va").css("display", "none");
//     $(".bank").css("display", "none");
//     $(".account_number").css("display", "none");
//     $(".bank_from").css("display", "none");
//     $(".bank_from_text").css("display", "none");
//   }
// });

$("#submitDeposit").click(function () {
  var dataDeposit = {
    amount: $("input[name='amount']").val(),
    bank_from: $("select[name='bank_from']").val(),
    account_number: $("input[name='account_number']").val(),
    bank: $("select[name='bank']").val(),
    channel: $("select[name='channel']").val(),
  };

  dataDeposit.amount = dataDeposit.amount.replace(/\./g, "");
  if (dataDeposit.bank_from == "other")
    dataDeposit.bank_from = $("input[name='bank_from_text']").val();
  if (dataDeposit.channel == "VA" && dataDeposit.bank == "BCA") {
    $.ajax({
      type: "GET",
      url: "/user/virtual_account/check/",
      cache: false,
      success: function (data) {
        data = JSON.parse(data);
        if (data.check == null) {
          depositProcess(dataDeposit);
        } else {
          Swal.fire({
            html: ` <h3 style="font-weight:bold">Anda masih memiliki <br/>pembayaran yang harus diselesaikan</h3><br/>
                                <p style="font-size: 15px">
                                    Anda harus menyelesaikan pembayaran melalui virtual account BCA di transaksi sebelumnya terlebih dahulu atau sistem virtual account BCA akan menghapus pembayaran sebelumnya.
                                </p>`,
            showCancelButton: true,
            cancelButtonText: "Lakukan Pembayaran",
            confirmButtonText: "Lanjutkan",
            showCloseButton: true,
            onBeforeOpen: function (element) {
              $(element)
                .find("button.swal2-cancel.swal2-styled")
                .toggleClass(
                  "swal2-cancel swal2-styled swal2-cancel btn btn-danger-ghost ml-3"
                ),
                $(element)
                .find("button.swal2-confirm.swal2-styled")
                .toggleClass(
                  "swal2-confirm swal2-styled swal2-confirm btn btn-danger"
                );
            },
          }).then(
            (result) => {
              if (result.value) {
                depositProcess(dataDeposit);
              }

              if (result.dismiss == "cancel") {
                window.location = data.check;
              }
            },
            function (dismiss) {
              if (dismiss == "cancel") {
                window.location = data.check;
              }
            }
          );
        }
      },
    });
  } else {
    depositProcess(dataDeposit);
  }
});

function depositProcess(dataDeposit) {
  Swal.fire({
    html: ` <div><img src="/assets/images/content/account/password.png" width="35%" alt="security token"></div>
                <div class="mt-1"><b class="swal-popup-title">Masukan PIN Anda</b></div>
                <div><p style="font-size: .9rem;">Masukan kode 6 angka security pin akun anda</p></div>
                <p><span id="pin_error" class="text-danger" style="font-size:12px"></span></p>
                <input type="password" class="form-control form-control-no-radius swal-popup-input" id="pin" onkeypress="return isNumberKey(event)" maxlength="6">`,
    inputAttributes: {
      autocapitalize: "off",
    },
    customClass: "swal-popup",
    showCancelButton: false,
    showConfirmButton: true,
    showLoaderOnConfirm: true,
    confirmButtonText: "Verifikasi",
    footer: '<p class="swal-popup-footer">Lupa PIN ? <a href="/user/security/email">Reset PIN</a></p>',
    onBeforeOpen: function (element) {
      $(element)
        .find("button.swal2-confirm.swal2-styled")
        .toggleClass(
          "swal2-confirm swal2-styled swal2-confirm btn btn-account btn-santara-red d-block"
        );
    },
    preConfirm: function () {
      return new Promise((resolve, reject) => {
        var pin = $("#pin").val();
        dataDeposit["pin"] = pin;
        $.ajax({
          url: `/user/deposit/create`,
          type: "POST",
          dataType: "json",
          data: dataDeposit,
          beforeSend: function () {
            $("#loader").show();
            $("#submitDeposit").attr("disabled", true);
            $("input[name='amount']").attr("disabled", true);
            $("select[name='bank']").attr("disabled", true);
            $("select[name='bank_from']").attr("disabled", true);
            $("select[name='channel']").attr("disabled", true);
            $("input[name='account_number']").attr("disabled", true);
            $("input[name='bank_from_text']").attr("disabled", true);
          },
          success: function (data) {
            $("#loader").hide();
            if (data.status == false) {
              Swal.fire({
                title: "Error",
                text: data.error[0].message,
                type: "error",
                showCancelButton: false,
                confirmButtonText: "Ok",
              });
            } else if (data.status == true) {
              amount.value = 0;

              if (data.data.deposit.redirectURL != undefined) {
                Swal.fire({
                  title: "Berhasil",
                  text: "Silahkan melakukan pembayaran deposit.",
                  type: "success",
                  showCancelButton: false,
                  confirmButtonText: "Ok",
                }).then(function () {

                  link = data.data.deposit.redirectURL;
                  window.open(link);

                  window.location.href = "#pills-data";
                  location.reload();

                });
              } else {
                Swal.fire({
                  title: "Gagal",
                  text: data.data.deposit.insertMessage,
                  type: "error",
                  showCancelButton: false,
                  confirmButtonText: "Ok",
                }).then(function () {
                  location.reload();
                });
              }

            } else {
              if (data.msg == 200) {

                $("input[name='amount']").val("");

                Swal.fire({
                  title: "Berhasil",
                  text: "Silahkan melakukan pembayaran deposit.",
                  type: "success",
                  showCancelButton: false,
                  confirmButtonText: "Ok",
                }).then(function () {
                  link = data.data.redirectURL;
                  window.open(link);
                });
              } else {
                if (!$.isEmptyObject(data.error)) {
                  if (data.error.pin_error) {
                    if (data.error.pin_error != "") {
                      $("#pin_error").html(data.error.pin_error);
                      $("#pin").addClass("invalid");
                      $("#pin").val("");
                    } else {
                      $("#pin_error").html("");
                      $("#pin").removeClass("invalid");
                    }

                    Swal.enableConfirmButton();
                    Swal.hideLoading();
                  } else {
                    if (data.error.amount_error != "") {
                      $("#amount_error").html(data.error.amount_error);
                      $("#amount").addClass("invalid");
                    } else {
                      $("#amount_error").html("");
                      $("#amount").removeClass("invalid");
                    }

                    if (data.error.channel_error != "") {
                      $("#channel_error").html(data.error.channel_error);
                      $("#channel").addClass("invalid");
                    } else {
                      $("#channel_error").html("");
                      $("#channel").removeClass("invalid");
                    }
                    Swal.closeModal();
                  }
                } else {
                  Swal.fire({
                    title: "Gagal",
                    text: data.msg,
                    type: "error",
                    showCancelButton: false,
                    confirmButtonText: "Ok",
                  });
                }
              }
            }
          },
          complete: function () {
            $("#submitDeposit").attr("disabled", false);
            $("input[name='amount']").attr("disabled", false);
            $("select[name='bank']").attr("disabled", false);
            $("select[name='bank_from']").attr("disabled", false);
            $("select[name='channel']").attr("disabled", false);
            $("input[name='account_number']").attr("disabled", false);
            $("input[name='bank_from_text']").attr("disabled", false);
            $("#total").hide();

            dataDeposit.channel = "";
            // dataDeposit.amount = "";
            dataDeposit.bank = "";
            dataDeposit.bank_from = "";
            dataDeposit.account_number = "";
            dataDeposit.bank_from_text = "";
            $("#loader").hide();
          },
        });
        // maybe also reject() on some condition
      });
    },
  }).then((data) => {});
}
</script>
<script src="app-assets/css/select2.min.css"></script>
<script type="text/javascript" src="{{asset('public')}}/app-assets/js/core/libraries/select2/select2.min.js" defer>
</script>
<script>
    const fee_bankwd = "7500";
    const maksimalPenarikanwd = "500000000";
    const amountwd = document.getElementById("amountwd");
const feewd = document.getElementById("feewd");
const totalwd= document.getElementById("totalwd");
const saldowd = document.getElementById("saldowd");
const refundwd = document.getElementById("refundwd");
const amount_limitwd = document.getElementById("amount_limitwd");

$(document).ready(function () {
  var amount_val = 0;
  var fee_val = refundwd.value ? 0 : fee_bankwd;
  feewd.value = formatNumber(parseInt(fee_val));
  amountwd.value = formatNumber(parseInt(amount_val));
  totalwd.value = formatNumber(
    parseInt(amountwd.value.replace(/\./g, "")) -
    parseInt(feewd.value.replace(/\./g, ""))
  );

  validateForm();

  $("select").select2({
    maximumSelectionLength: 2,
    allowClear: true,
  });

  $(".required-form-withdraw").on("keyup change blur input", function () {
    validateForm();
    let amount_val = parseInt(amountwd.value.replace(/\./g, ""));
    if (maksimalPenarikanwd > 200000000) {
      if (amount_val > 200000000) {
        amountwd.value = 200000000;
      }
    } else if (amount_val > maksimalPenarikanwd){
       amountwd.value = maksimalPenarikanwd;    }
  });

});

function validateForm() {
  $(".submit-form-withdraw").prop("disabled", true);
  var requiredAllCompleted = true;
  var amount_val = parseInt(amountwd.value.replace(/\./g, ""));

  $(".required-form-withdraw").each(function () {
    if (
      $(this).val() == "" ||
      amount_val < 100000 ||
      isNaN(amount_val) ||
      amount_val > amount_limitwd.value
    ) {
      $("#terimaBersih").addClass("hidden");
      requiredAllCompleted = false;
    } else {
      $("#terimaBersih").removeClass("hidden");
    }
  });

  if (requiredAllCompleted) $(".submit-form-withdraw").prop("disabled", false);
  if (requiredAllCompleted) $(".sippp").prop("disabled", false);
}

const amoun = 0;

amountwd.addEventListener("keyup", function (e) {
  this.value = this.value.replace(/^0+/, "");
  this.value = this.value.replace(/[^\d]/, "");
  this.value = this.value.replace(/\./, "");
  $("#amount_limit_alertwd").hide();
  $("#amount_minimum_alertwd").show();
//   $("#amou").val(this.value);
// console.log(this.value);

  if (this.value != "" && !isNaN(this.value)) {

    if (parseInt(this.value.replace(/\./g, "")) >= 100000) {
      $("#amount_minimum_alertwd").hide();
      if (
        parseInt(this.value.replace(/\./g, "")) >
        parseInt(saldowd.value.replace(/\./g, ""))
      ) {
        $("#amount_limit_alertwd").show();
      } else {
        $("#amount_limit_alertwd").hide();
        amountwd.value = amountwd.value.replace(/\./, "");
        feewd.value = feewd.value.replace(/\./, "");
        totalwd.value = formatNumber(
          parseInt(amountwd.value) - parseInt(feewd.value)
        );
        totalwd.value = total.value < 0 ? 0 : totalwd.value;
      }
    } else {
      $("#amount_minimum_alertwd").show();
    }
  } else {
    this.value = 0;
    totalwd.value = 0;
  }
  this.value = formatNumber(parseInt(this.value.replace(/\./g, "")));
  amoun.value = this.value;
});

$("#submitWithdrawKYC").click(function () {
  Swal.fire({
    html: ` <div><img src="/assets/images/progress/forbidden.png" width="35%" alt="security token"></div>
                <div class="mt-1"><b class="swal-popup-title">Maaf akun Anda belum terverifikasi</b></div>`,
    inputAttributes: {
      autocapitalize: "off",
    },
    customClass: "swal-popup",
    showCancelButton: false,
    showConfirmButton: true,
    showLoaderOnConfirm: true,
    confirmButtonText: "Mengerti",
    onBeforeOpen: function (element) {
      $(element)
        .find("button.swal2-confirm.swal2-styled")
        .toggleClass(
          "swal2-confirm swal2-styled swal2-confirm mt-2 btn btn-account btn-santara-red d-block"
        );
    },
  });
});

$("#withdraw").click(function () {
//   console.log('ok');

    Swal.fire({
    html: `<div><img src="{{asset('public')}}/assets2/images/content/account/password.png" width="35%" alt="security token"></div>
                <div class="mt-1"><b class="swal-popup-title">Masukan PIN Anda</b></div>
                <div><p style="font-size: .9rem;">Masukan kode 6 angka security pin akun anda</p></div>
                <p><span id="pin_error" class="text-danger" style="font-size:12px"></span></p>
                <form class="form" id="penarikanc" action="{{url('/user/penarikan/create')}}"
                                                        method="POST" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                <input type="hidden" name="amou" id="amou">
                <input type="password" name="pin" class="form-control form-control-no-radius swal-popup-input" id="pin" onkeypress="return isNumberKey(event)" maxlength="6">
                </form>`,
                inputAttributes: {
      autocapitalize: "off",
    },
    customClass: "swal-popup",
    showCancelButton: false,
    showConfirmButton: true,
    showLoaderOnConfirm: true,
    confirmButtonText: "Verifikasi",
    footer: '<p class="swal-popup-footer">Lupa PIN ? <a href="/user/security/email">Reset PIN</a></p>',
    focusConfirm: false,
    preConfirm: () => {
        $("#amou").val(amountwd.value.replace(/\./g, ""));
        const login = Swal.getPopup().querySelector('#amou').value
        const password = Swal.getPopup().querySelector('#pin').value
        return { login: login, password: password }
    }
    }).then((result) => {
    // console.log(result.value.login);
    // document.getElementById('penarikanc').submit();
    if (result.value.password != '') {
            document.getElementById('penarikanc').submit();
            }
    });
});

$("#submitWithdraw").click(function () {
  var dataWithdraw = {
    amount: $("input[name='amount']").val(),
    fee: $("input[name='fee']").val(),
    total: $("input[name='total']").val(),
  };

  dataWithdraw.amount = dataWithdraw.amount.replace(/\./g, "");
  dataWithdraw.fee = dataWithdraw.fee.replace(/\./g, "");
  dataWithdraw.total = dataWithdraw.total.replace(/\./g, "");

  Swal.fire({
    title: "<h3>Konfirmasi Penarikan</h3>",
    html: `<table class="table table-borderless modal-emiten-detail">
            <tbody>
              <tr>
                <td>Jumlah Penarikan </td>
                <td>:</td>
                <td>${formatNumber(dataWithdraw.amount)}</td>
              </tr>
              <tr>
                <td>Biaya Penarikan</td>
                <td>:</td>
                <td>${formatNumber(dataWithdraw.fee)}</td>
              </tr>
              <tr>
                <td>Terima Bersih</td>
                <td>:</td>
                <td>${formatNumber(dataWithdraw.total)}</td>
              </tr>
            </tbody>
          </table>`,
    showCancelButton: true,
    confirmButtonText: "Ya",
    cancelButtonText: "Tidak",
  }).then((result) => {
    if (result.value) {
      withdrawProcess(dataWithdraw);
    }
  });
});

function withdrawProcess(dataWithdraw) {
  Swal.fire({
    html: ` <div><img src="/assets/images/content/account/password.png" width="35%" alt="security token"></div>
                <div class="mt-1"><b class="swal-popup-title">Masukan PIN Anda</b></div>
                <div><p style="font-size: .9rem;">Masukan kode 6 angka security pin akun anda</p></div>
                 <p><span id="pin_error" class="text-danger" style="font-size:12px"></span></p>
                <input type="password" class="form-control form-control-no-radius swal-popup-input" id="pin" onkeypress="return isNumberKey(event)" maxlength="6">
                `,

    inputAttributes: {
      autocapitalize: "off",
    },
    customClass: "swal-popup",
    showCancelButton: false,
    showConfirmButton: true,
    showLoaderOnConfirm: true,
    confirmButtonText: "Verifikasi",
    footer: '<p class="swal-popup-footer">Lupa PIN ? <a href="/user/security/email">Reset PIN</a></p>',
    onBeforeOpen: function (element) {
      $(element)
        .find("button.swal2-confirm.swal2-styled")
        .toggleClass(
          "swal2-confirm swal2-styled swal2-confirm btn btn-account btn-santara-red d-block"
        );
    },
    preConfirm: function () {
      return new Promise((resolve, reject) => {
        dataWithdraw["pin"] = $("#pin").val();
        $.ajax({
          url: `/user/withdraw/create`,
          type: "POST",
          dataType: "json",
          timeout: 20000, // sets timeout
          data: dataWithdraw,
          beforeSend: function () {
            $("#loader").show();
            $("#submitWithdraw").attr("disabled", true);
            $("input[name='amount']").attr("disabled", true);
            $("input[name='fee']").attr("disabled", true);
            $("input[name='total']").attr("disabled", true);
          },
          success: function (data) {
            $("#loader").hide();

            if (data.msg == 401) {
              window.location = "/login/logout";
            }

            if (data.msg == 200) {
              Swal.fire({
                title: "Berhasil",
                text: "Pengajuan withdraw anda sedang kami proses.",
                type: "success",
                showCancelButton: false,
                confirmButtonText: "Ok",
              }).then((result) => {
                window.location.href = "#pills-data";
                location.reload();
              });
            } else {
              if (!$.isEmptyObject(data.error)) {
                if (data.error.pin_error) {
                  if (data.error.pin_error != "") {
                    $("#pin_error").html(data.error.pin_error);
                    $("#pin").addClass("invalid");
                    $("#pin").val("");
                  } else {
                    $("#pin_error").html("");
                    $("#pin").removeClass("invalid");
                  }
                  Swal.enableConfirmButton();
                  Swal.hideLoading();
                } else {
                  if (data.error.amount_error != "") {
                    $("#amount_error").html(data.error.amount_error);
                    $("#amount").addClass("invalid");
                  } else {
                    $("#amount_error").html("");
                    $("#amount").removeClass("invalid");
                  }

                  if (data.error.fee_error != "") {
                    $("#fee_error").html(data.error.fee_error);
                    $("#fee").addClass("invalid");
                  } else {
                    $("#fee_error").html("");
                    $("#fee").removeClass("invalid");
                  }

                  if (data.error.total_error != "") {
                    $("#total_error").html(data.error.total_error);
                    $("#total").addClass("invalid");
                  } else {
                    $("#total_error").html("");
                    $("#total").removeClass("invalid");
                  }
                  Swal.closeModal();
                }
              } else {
                Swal.fire({
                  title: "Gagal",
                  text: data.msg,
                  type: "error",
                  showCancelButton: false,
                  confirmButtonText: "Ok",
                }).then(() => {
                  location.reload();
                })
              }
            }
          },
          error: function (jqXHR, textStatus, errorThrown) {
            if (textStatus === "timeout" || textStatus === "error") {
              $("#loader").hide();
              Swal.fire({
                  title: "Ooops...",
                  text: "Mohon periksa koneksi internet anda",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Muat ulang",
                  cancelButtonText: "Tutup",
                })
                .then((result) => {
                  if (result.value) {
                    location.reload();
                  }
                });
            }
          },
          complete: function () {
            $("#submitWithdraw").attr("disabled", false);
            $("input[name='amount']").attr("disabled", false);
            $("input[name='fee']").attr("disabled", false);
            $("input[name='total']").attr("disabled", false);
            $("input[select='bank_to']").attr("disabled", false);
            $("input[name='account_name']").attr("disabled", false);
            $("input[name='account_number']").attr("disabled", false);

            // dataWithdraw.amount = "";
            // dataWithdraw.fee = "";
            // dataWithdraw.total = "";
            $("#loader").hide();
          },
        });
      });
    },
  });
}
</script>

<script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js" type="text/javascript"></script>

{{-- <script src="https://cdn.datatables.net/plug-ins/1.10.19/sorting/datetime-moment.js" type="text/javascript"></script> --}}
{{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>  --}}
{{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>  --}}

{{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>  --}}
<script>
    $(document).ready(function() {
        $('#tabel').DataTable({
            responsive: true,
            dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>rtip",
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],

        });
    });
    // $.fn.dataTable.ext.search.push(
    // function( settings, data, dataIndex ) {
    //     var date = new Date( data[1] );
    //     console.log(date);
    // }
</script>
@if (Session::has('newurl'))
<script>
    window.open('{{session()->get('newurl')}}', "_blank");
    // $('#pills-data').tab('show');
</script>

@endif
@endsection
@section('style')
<link rel="stylesheet" type="text/css"
    href="{{asset('admin')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('public')}}/app-assets/css/select2.min.css">
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
