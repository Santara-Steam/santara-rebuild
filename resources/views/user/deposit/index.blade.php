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
                                                                    <input type="text" class="form-control" placeholder=""
                                                                        name="fee" id="fee" readonly="readonly">
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
                                                            'id=""' : '' ?> type="button">
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
                                                        @foreach ($deposit as $item)

                                                        <tr role="row" class="odd">
                                                            <td class="sorting_1 row">
                                                                <div class="media col-6 col-sm-6 col-md-3" >
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
                                                                        '.formatJam($item->created_at),}}</small></div>
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
                                                                        <a href="{{$item->redirect_url}}" target="_blank"
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
  validateForm();
});

function bankFromText() {
  if (bank_from.value == "other") {
    $(".bank_from_text").css("display", "");
  } else {
    $(".bank_from_text").css("display", "none");
  }
}

function validateForm() {
  $(".submit-form-deposit").prop("disabled", true);
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
}

$(".required-form-deposit").on("keyup change blur input", function () {
  validateForm();
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

<script>

</script>
@if (Session::has('newurl'))
<script>
    window.open('{{session()->get('newurl')}}', "_blank");
    // $('#pills-data').tab('show');
</script>
@endif
@endsection
@section('style')

@endsection