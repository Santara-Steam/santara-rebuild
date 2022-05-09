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
                <h1 class="card-title-member">Penarikan</h1>
              </div>
              <div class="card-content">
                <div class="card-body px-1 pb-3">
                  <ul class="nav nav-justified mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item member-nav">
                      <a class="nav-link member-nav-link active" id="pills-tambah-tab" data-toggle="tab"
                        href="#pills-tambah" role="tab" aria-controls="pills-tambah" aria-selected="true">
                        <span>Penarikan</span>
                      </a>
                    </li>
                    <li class="nav-item member-nav">
                      <a class="nav-link member-nav-link" id="pills-data-tab" data-toggle="tab" href="#pills-data"
                        role="tab" aria-controls="pills-data" aria-selected="false">
                        <span>Riwayat</span>
                      </a>
                    </li>
                  </ul>

                  <div class="tab-content" id="pills-tabContent">

                    @if ($trader_bank)

                    <div class="tab-pane fade show active" id="pills-tambah" role="tabpanel"
                      aria-labelledby="pills-tambah-tab">
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
                                <h5 class="font-weight-bold small" style="color: #BF2D30;">
                                </h5>
                              </div>
                            </div>
                          </div>
                          <input type="hidden" class="form-control" name="saldo" id="saldo"
                            value="{{round(Auth::user()->trader->saldo->balance,0)}}">
                          <input type="hidden" class="form-control" name="refund" id="refund" value="">


                          <form class="form" action="{{url('/user/penarikan/create')}}" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                              <label for="lastName1">Jumlah Penarikan</label>
                              <input type="text" class="form-control required-form-withdraw number-only" placeholder=""
                                name="amount" id="amount">
                              <input type="hidden" name="amount_limit" id="amount_limit"
                                value="{{round(Auth::user()->trader->saldo->balance,0)}}">
                              <span id="amount_error" class="text-danger"></span>
                              <span id="amount_limit_alert" class="text-danger" style="display: none">
                                Saldo tidak cukup. Saldo Anda Rp.
                                {{number_format(Auth::user()->trader->saldo->balance, 0,
                                ',', '.')}} </span>
                              <span id="amount_minimum_alert" class="text-danger" style="display: none">
                                Minimal penarikan adalah Rp 100.000,00
                              </span>
                            </div>

                            <div class="hidden" id="terimaBersih">
                              <div class="form-group">
                                <label for="lastName1">Biaya Penarikan</label>
                                <input type="text" class="form-control" placeholder="" name="fee" id="fee"
                                  readonly="readonly">
                                <span id="fee_error" class="text-danger"></span>
                              </div>

                              <div class="form-group">
                                <label for="lastName1">Terima Bersih</label>
                                <input type="text" class="form-control" placeholder="" name="total" id="total"
                                  readonly="readonly">
                                <span id="total_error" class="text-danger"></span>
                              </div>
                            </div>

                            {{-- <button type="submit" class="btn btn-santara-red btn-block submit-form-withdraw"
                              id="submitWithdraw" type="button" disabled="">
                              Tarik Dana </button> --}}
                          </form>
                          <button id="withdraw" class="btn btn-santara-red btn-block sippp" disabled="">
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
                    <div class="tab-pane fade active show" id="pills-tambah" role="tabpanel"
                      aria-labelledby="pills-tambah-tab" data-select2-id="pills-tambah">
                      <div class="alert alert-success" style="display:none"></div>
                      <div class="row m-0" data-select2-id="6">
                        <div class="col-md-12" data-select2-id="5">
                          <div class="disclamer-member">
                            {{-- {{Session::get('token')}} --}}
                            <strong>Note:</strong>
                            Bank yang Anda daftarkan seterusnya akan digunakan untuk
                            melakukan penarikan dana dan dividen
                          </div>
                          {{-- <form action="#" class="mt-2" id="submitBank" method="post" data-select2-id="submitBank">
                            --}}
                            <form class="form" action="{{url('/user/add_bank')}}" method="POST"
                              enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <div class="form-group">
                                <label for="lastName1">Bank<small class="text-danger">*</small></label>
                                <select class="form-control" name="bank" id="bank">
                                  @foreach ($bwd as $item)
                                  <option value="{{$item->id}}">{{$item->bank}}
                                  </option>
                                  @endforeach
                                </select>
                                <small id="bank_error" class="text-danger"></small>
                              </div>

                              <div class="form-group">
                                <label for="lastName1">Nama<small class="text-danger">*</small></label>
                                <input type="text" class="form-control" placeholder="" name="nama"
                                  value="{{Auth::user()->trader->name}}" id="nama" readonly="">
                                <small id="nama_error" class="text-danger"></small>
                              </div>

                              <div class="form-group">
                                <label for="lastName1">No. Rekening<small class="text-danger">*</small></label>
                                <input type="text" class="form-control number-only" placeholder="" maxlength="20"
                                  name="norek" id="norek">
                                <small id="norek_error" class="text-danger"></small>
                              </div>

                              <button class="btn btn-santara-red btn-block" type="submit" id="bsubmitBank">
                                Daftar Bank </button>
                            </form>
                        </div>
                      </div>
                      {{--
                    </div> --}}
                    @endif

                    {{-- <div class="tab-pane fade" id="pills-data" role="tabpanel" aria-labelledby="pills-data-tab">
                      --}}
                      <div class="table-responsive">
                        <table class="table table-hover dataTable-table" id="datatable" style="width: 100%">
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
                                  <img class="mr-1" src="https://santara.co.id/assets/images/icon/wallet.png">
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
                                <div class="font-menunggu-verifikasi"><b>Menunggu Verifikasi</b></div>
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

<div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form" action="" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel1">Update Status</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript" src="{{asset('public')}}/app-assets/js/core/alert/sweetalert.min.js"></script>
<script src="{{asset('public')}}/assets2/js/global.js?v=5.8.8"></script>
<script src="app-assets/css/select2.min.css"></script>
<script type="text/javascript" src="{{asset('public')}}/app-assets/js/core/libraries/select2/select2.min.js" defer>
</script>
<script>
  const fee_bank = "7500";
    const maksimalPenarikan = "500000000";
    const amount = document.getElementById("amount");
const fee = document.getElementById("fee");
const total = document.getElementById("total");
const saldo = document.getElementById("saldo");
const refund = document.getElementById("refund");
const amount_limit = document.getElementById("amount_limit");

$(document).ready(function () {
  var amount_val = 0;
  var fee_val = refund.value ? 0 : fee_bank;
  fee.value = formatNumber(parseInt(fee_val));
  amount.value = formatNumber(parseInt(amount_val));
  total.value = formatNumber(
    parseInt(amount.value.replace(/\./g, "")) -
    parseInt(fee.value.replace(/\./g, ""))
  );

  validateForm();

  $("select").select2({
    maximumSelectionLength: 2,
    allowClear: true,
  });

  $(".required-form-withdraw").on("keyup change blur input", function () {
    validateForm();
    let amount_val = parseInt(amount.value.replace(/\./g, ""));
    if (maksimalPenarikan > 200000000) {
      if (amount_val > 200000000) {
        amount.value = 200000000;
      }
    } else if (amount_val > maksimalPenarikan) {
      amount.value = maksimalPenarikan;
    }
  });

});

function validateForm() {
  $(".submit-form-withdraw").prop("disabled", true);
  var requiredAllCompleted = true;
  var amount_val = parseInt(amount.value.replace(/\./g, ""));

  $(".required-form-withdraw").each(function () {
    if (
      $(this).val() == "" ||
      amount_val < 100000 ||
      isNaN(amount_val) ||
      amount_val > amount_limit.value
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



amount.addEventListener("keyup", function (e) {
  this.value = this.value.replace(/^0+/, "");
  this.value = this.value.replace(/[^\d]/, "");
  this.value = this.value.replace(/\./, "");
  $("#amount_limit_alert").hide();
  $("#amount_minimum_alert").show();
//   $("#amou").val(this.value);

  if (this.value != "" && !isNaN(this.value)) {

    if (parseInt(this.value.replace(/\./g, "")) >= 100000) {
      $("#amount_minimum_alert").hide();
      if (
        parseInt(this.value.replace(/\./g, "")) >
        parseInt(saldo.value.replace(/\./g, ""))
      ) {
        $("#amount_limit_alert").show();
      } else {
        $("#amount_limit_alert").hide();
        amount.value = amount.value.replace(/\./, "");
        fee.value = fee.value.replace(/\./, "");
        total.value = formatNumber(
          parseInt(amount.value) - parseInt(fee.value)
        );
        total.value = total.value < 0 ? 0 : total.value;
      }
    } else {
      $("#amount_minimum_alert").show();
    }
  } else {
    this.value = 0;
    total.value = 0;
  }
  this.value = formatNumber(parseInt(this.value.replace(/\./g, "")));
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
    footer: '<p class="swal-popup-footer">Lupa PIN ? <a href="{{url('pin_reset')}}">Reset PIN</a></p>',
    focusConfirm: false,
    preConfirm: () => {
        $("#amou").val(amount.value.replace(/\./, ""));
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
    footer: '<p class="swal-popup-footer">Lupa PIN ? <a href="{{url('pin_reset')}}">Reset PIN</a></p>',
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
@endsection
@section('style')
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