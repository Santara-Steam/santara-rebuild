const invest = document.getElementById("invest");
const emiten_id = document.getElementById("emiten_id");
const btnbeli = document.getElementById("btnbeli");
const submitWalletPayment = document.getElementById("submitWalletPayment");

if (submitWalletPayment) {
  const wallet = document.getElementById("wallet");
  const amount = document.getElementById("amount");

  submitWalletPayment.classList.add("disabled");

  if (parseInt(wallet.value) >= parseInt(amount.value)) {
    submitWalletPayment.classList.remove("disabled");
  }
}

function confirmPayment(
  uuid = null,
  jumlah = null,
  channel = null,
  bank = null
) {
  var dataTransaction = {
    uuid,
    jumlah,
    channel,
    bank
  };
  if (channel == "VA" && bank == "BCA") {
    $.ajax({
      type: "GET",
      url: "/user/virtual_account/check/",
      cache: false,
      success: function (data) {
        data = JSON.parse(data);
        if (data.check == null) {
          paymentProcess(dataTransaction);
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
                  "swal2-cancel swal2-styled swal2-cancel btn btn-santara-white ml-3"
                ),
                $(element)
                .find("button.swal2-confirm.swal2-styled")
                .toggleClass(
                  "swal2-confirm swal2-styled swal2-confirm btn btn-santara-red"
                );
            },
          }).then(
            (result) => {
              if (result.value) {
                paymentProcess(dataTransaction);
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
    paymentProcess(dataTransaction);
  }
}

function paymentProcess(dataTransaction) {
  if (
    dataTransaction.channel == "WALLET" &&
    parseInt(wallet.value) < parseInt(amount.value)
  ) {
    Swal.fire("Error!", "Saldo dompet tidak mencukupi", "error");
  } else {
    var pin;
    $.getScript(
      window.location.origin + "/app-assets/js/scripts/pincode/pincode.js",
      function () {
        $("#pincode-input1").pincodeInput({
          inputs: 6,
          complete: function (value, e, errorElement) {
            pin = value;
          },
        });
      }
    );

    var logoPin, akunPin, footerPin;
    setTimeout(() => {
      $(".first").attr("id", "pinFirst");
      document.getElementById("pinFirst").focus();
    }, 500);
    Swal.fire({
      html: "<div>" +
        '<img src="/assets/images/content/account/password.png" width="35%" alt="security token">' +
        "</div>" +
        '<div class="mt-1"><b class="swal-popup-title">Masukan PIN Anda</b></div>' +
        '<div><p style="font-size: .9rem;">Masukan kode 6 angka security pin akun SANTARA' +
        " anda</p></div>" +
        '<input type="text" name="mycode" autofocus id="pincode-input1">' +
        '<p><span id="pin_error" class="text-danger" style="font-size: 12px"></span></p>',
      inputAttributes: {
        autocapitalize: "off",
      },
      customClass: "swal-popup",
      showCancelButton: false,
      showCloseButton: true,
      showConfirmButton: true,
      showLoaderOnConfirm: true,
      confirmButtonText: "Verifikasi",
      footer: '<p class="swal-popup-footer">Lupa PIN ? <a class="c-red" style="text-decoration:none" href="/user/security/email">Reset PIN</a></p>',
      onBeforeOpen: function (element) {
        if (dataTransaction.channel == "BAYARIND") {
          $(element)
            .find("button.swal2-confirm.swal2-styled")
            .toggleClass(
              "swal2-confirm swal2-styled swal2-confirm btn btn-default d-block"
            );
        } else {
          $(element)
            .find("button.swal2-confirm.swal2-styled")
            .toggleClass(
              "swal2-confirm swal2-styled swal2-confirm btn btn-account btn-danger d-block"
            );
        }
      },
      preConfirm: function () {
        return new Promise((resolve, reject) => {
          dataTransaction["pin"] = pin;
          $.ajax({
            url: `/transaction/checktransactionbuy/`,
            type: "POST",
            dataType: "json",
            data: dataTransaction,
            // timeout: 20000,
            beforeSend: function () {
              $("#loader").show();
              $("#pinBayarind_error").html("");
            },
            success: function (data) {
              $("#loader").hide();
              let msgrespone;

              if (data.status == true) {
                if (dataTransaction.channel == "ONEPAY") {
                  msgrespone =
                    "Pembelian Saham Berhasil Silahkan Lanjutkan Pembayaran.";
                } else if (dataTransaction.channel == "WALLET") {
                  msgrespone = data.data.message;
                }
                Swal.fire("Success!", msgrespone, "success").then((result) => {
                  if (dataTransaction.channel == "ONEPAY") {
                    window
                      .open(
                        data.data.transaksi.redirectURL
                        // "_blank",
                        // "location=yes,scrollbars=yes,status=yes"
                      )
                      .focus();
                    setTimeout(() => {
                      window.location = "/user/";
                    }, 500);
                  } else {
                    window.location = "/user/";
                  }
                });
              } else if (data.status == false) {
                if (data.error[0].code == "203") {
                  Swal.fire("Error!", data.error[0].message, "error");
                } else {
                  Swal.fire("Error!", data.error[0].message, "error");
                }
              } else {
                if (data.stt) {
                  $("#pin_error").html(data.msg);
                  swal.enableConfirmButton();
                  swal.hideLoading();
                } else {
                  Swal.fire(
                    "Error!",
                    data.msg != undefined ? data.msg : data.message,
                    "error"
                  );
                }
              }
            },
            error: function (data) {
              $("#loader").hide();
              Swal.fire("Error!", "Permintaan gagal diproses !", "error");
            },
          });
        });
      },
    });
  }
}

function deleteTransaction(uuid) {
  Swal.fire({
    title: "Hapus data transaksi ?",
    type: "warning",
    showCancelButton: true,
    confirmButtonText: "Ya, hapus",
    cancelButtonText: "Tidak",
  }).then((result) => {
    if (result.value) {
      $.post("/transaction/deleteCheckout", {
        uuid
      }).done(function (data) {
        data = JSON.parse(data);
        if (data.msg == 200) {
          window.location = "/list-bisnis";
        } else {
          Swal.fire("Error!", data.msg, "error").then((result) => {
            location.reload();
          });
        }
      });
    }
  });
}

function confirmPaymentSukuk(
  uuid = null,
  jumlah = null,
  channel = null,
  bank = null
) {
  var dataTransaction = {
    uuid,
    jumlah,
    channel,
    bank
  };
  if (channel == "VA" && bank == "BCA") {
    $.ajax({
      type: "GET",
      url: "/user/virtual_account/check/",
      cache: false,
      success: function (data) {
        data = JSON.parse(data);
        if (data.check == null) {
          paymentSukukWithWallet(dataTransaction);
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
                  "swal2-cancel swal2-styled swal2-cancel btn btn-santara-white ml-3"
                ),
                $(element)
                .find("button.swal2-confirm.swal2-styled")
                .toggleClass(
                  "swal2-confirm swal2-styled swal2-confirm btn btn-santara-red"
                );
            },
          }).then(
            (result) => {
              if (result.value) {
                paymentSukukWithWallet(dataTransaction);
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
    paymentSukukWithWallet(dataTransaction);
  }
}

function paymentSukukWithWallet(dataTransaction) {
  $.ajax({
    url: `/sukuk/buySukukTrx/`,
    type: "POST",
    dataType: "json",
    data: dataTransaction,
    timeout: 20000,
    beforeSend: function () {
      $("#loader").show();
    },
    success: function (data) {
      $("#loader").hide();
      if (data.msg == 200) {
        Swal.fire(
          "Success!",
          "Pembelian sukuk berhasil dilakukan.",
          "success"
        ).then((result) => {
          window.location = "/user/";
        });
      } else {
        Swal.fire("Error!", data.msg, "error").then((result) => {
          location.reload();
        });
      }
    },
    error: function (data) {
      $("#loader").hide();
      Swal.fire("Error!", "Permintaan gagal diproses !", "error");
    },
  });
}