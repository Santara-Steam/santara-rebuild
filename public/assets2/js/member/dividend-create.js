const amount = document.getElementById("amount");
const account_number = document.getElementById("account_number");
$(document).ready(function () {
  $("select").select2({
    maximumSelectionLength: 2,
    allowClear: true,
  });
});

window.onload = function () {
  account_number.onpaste = function (e) {
    e.preventDefault();
  };
};

$("#submitDividend").click(function () {
  console.log(maksimalPenarikan);

  if (parseInt(totalDividen) > parseInt(maksimalPenarikan)) {
    Swal.fire(
      'Gagal',
      `Total Dividend anda melebihi maksimal penarikan ${formatRupiah(maksimalPenarikan,'Rp ')} pertransaksi, silahkan cairkan dividend anda ke dompet Santara`,
      'info'
    ).then(() => {
      window.location.replace(window.location.origin + "/user/dividend")
    });
  } else {
    Swal.fire({
      title: "Konfirmasi dividend",
      html: "Ajukan dividend anda sekarang ?",
      type: "info",
      showCancelButton: true,
      confirmButtonText: "Ya",
      cancelButtonText: "Tidak",
    }).then((result) => {
      if (result.value) {
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
              var dataDividend = {
                pin: $("#pin").val(),
              };
              $.ajax({
                url: `/user/dividend/save`,
                type: "POST",
                dataType: "json",
                data: dataDividend,
                beforeSend: function () {
                  $("#loader").show();
                  $("#submitDividend").attr("disabled", true);
                },
                success: function (data) {
                  $("#loader").hide();
                  if (data.msg == 200) {
                    Swal.fire(
                      "Success!",
                      "Pengajuan penarikan dividend berhasil dilakukan.",
                      "success"
                    ).then((result) => {
                      location.reload();
                    });
                  } else {
                    if (!$.isEmptyObject(data.error)) {
                      if (data.error.pin_error != "") {
                        $("#pin_error").html(data.error.pin_error);
                        $("#pin").addClass("invalid");
                        $("#pin").val("");
                      } else {
                        $("#bank_cabangpin_error_error").html("");
                        $("#pin").removeClass("invalid");
                      }
                      Swal.enableConfirmButton();
                      Swal.hideLoading();
                    } else {
                      Swal.fire("Error!", data.msg, "error").then((result) => {
                        location.reload();
                      });
                    }
                  }
                },
                complete: function () {
                  $("#submitDividend").attr("disabled", false);
                  $("select[name='bank']").attr("disabled", false);
                  $("input[name='account_name']").attr("disabled", false);
                  $("input[name='account_number']").attr("disabled", false);
                  $("input[name='bank_kota']").attr("disabled", false);
                  $("input[name='bank_cabang']").attr("disabled", false);
                  $("#loader").hide();

                  bank = "";
                  account_name = "";
                  account_number = "";
                  bank_kota = "";
                  bank_cabang = "";
                },
              });
            });
          },
        });
      }
    });
  }

});