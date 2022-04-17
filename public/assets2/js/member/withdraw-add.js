const amount = document.getElementById("amount");
const fee = document.getElementById("fee");
const total = document.getElementById("total");
const saldo = document.getElementById("saldo");
const refund = document.getElementById("refund");
const amount_limit = document.getElementById("amount_limit");

$(document).ready(function () {
  var amount_val = 0;
  var fee_val = refund.value ? 0 : fee_bank;
  amount.value = formatNumber(parseInt(amount_val));
  fee.value = formatNumber(parseInt(fee_val));
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
}



amount.addEventListener("keyup", function (e) {
  this.value = this.value.replace(/^0+/, "");
  this.value = this.value.replace(/[^\d]/, "");
  this.value = this.value.replace(/\./, "");
  $("#amount_limit_alert").hide();
  $("#amount_minimum_alert").show();

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