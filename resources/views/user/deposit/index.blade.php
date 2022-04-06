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
                                <h1 class="card-title-member">Deposit</h1>
                            </div>
                            <div class="card-content">
                                <div class="card-body px-1 pb-3">
                                    <ul class="nav nav-justified mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item member-nav">
                                            <a class="nav-link member-nav-link active" id="pills-tambah-tab"
                                                data-toggle="tab" href="#pills-tambah" role="tab"
                                                aria-controls="pills-tambah" aria-selected="true">
                                                <span>Tambah</span>
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
                                        <div class="tab-pane fade show active" id="pills-tambah" role="tabpanel"
                                            aria-labelledby="pills-tambah-tab">
                                            <div class="row m-0">
                                                <div class="col-md-7">
                                                    <div class="total-amount-member">
                                                        <div>
                                                            <h3>Saldo Anda</h3>
                                                            <span class="withdraw-saldo">Rp. {{number_format(Auth::user()->trader->saldo->balance, 0, ',', '.')}}</span>
                                                        </div>
                                                    </div>
                                                    <form action="">
                                                        <div class="form-group">
                                                            <label for="lastName1">Jumlah Deposit</label>
                                                            <input type="text"
                                                                class="form-control required-form-deposit number-only"
                                                                name="amount" id="amount" maxlength="20">
                                                            <span id="amount_error" class="text-danger"></span>
                                                            <span id="amount_limit" class="text-danger"
                                                                style="display: none">
                                                                Minimal Jumlah Deposit Rp.100.000<br>
                                                            </span>
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
                                                        <button
                                                            class="btn btn-santara-red btn-block 
                                                            <?= (Auth::user()->is_verified == 1) ? 'submit-form-deposit' : 'disabled' ?>"
                                                            <?=(Auth::user()->is_verified == 1) ?
                                                            'id="submitDeposit"' : '' ?> type="button">
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
                                                                {{-- <?= number_format($fee, 0, ',', '.') ?> --}}
                                                            </b> (
                                                            {{-- <?= $terbilang ?>  --}}
                                                            Rupiah)
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-data" role="tabpanel"
                                            aria-labelledby="pills-data-tab">
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

@endsection