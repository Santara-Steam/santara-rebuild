const amount = document.getElementById("amount");
const channel = document.getElementById("channel");
const bank_from = document.getElementById("bank_from");
const bank = document.getElementById("bank");
const bank_from_text = document.getElementById("bank_from_text");
const account_number = document.getElementById("account_number");

$(document).ready(function () {
  $("#amount_limit").hide();
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
      requiredAllCompleted = false;
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