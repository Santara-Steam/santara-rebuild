var swiper = new Swiper(".swiper-container", {
  // Enable lazy loading
  lazy: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    dynamicBullets: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

$(document).ready(function () {
  const url = $("#profileVideo").attr("src");
  $("#profileVideoModal").on("hide.bs.modal", function () {
    $("#profileVideo").attr("src", "");
  });

  $("#profileVideoModal").on("show.bs.modal", function () {
    $("#profileVideo").attr("src", url);
  });
});

const btnbeli = document.getElementById("btnbeli");
const invest = document.getElementById("invest");
const btnInfoEmitten = document.getElementById("btnInfoEmitten");
const alertmaks = document.getElementById("alertmaks");

const company_name = document.getElementById("company_name");
const code_emiten = document.getElementById("code_emiten");
const harga = document.getElementById("harga");
const total_price = document.getElementById("total-price");
const profit = document.getElementById("profit");
const maksimal_token = document.getElementById("maksimal_token");
const minimum_invest = document.getElementById("minimum_invest");
const detail_price = document.getElementById("detail-price");

const max_invest = document.getElementById("max_invest");
const emitten_invest = document.getElementById("emitten_invest");
const sisa_invest = document.getElementById("sisa_invest");

const start_emitens = document.getElementById("start_emitens");

if (btnbeli) {
  total_price.value = 0;
  btnbeli.disabled = true;

  invest.addEventListener("keyup", function (e) {
    this.value = this.value.replace(/^0+/, "");
    this.value = this.value.replace(/\./g, "");

    total_price.value = parseInt(invest.value) * parseInt(detail_price.value);
    if (!isNaN(total_price.value) && total_price.value > 0) {
      btnbeli.disabled = false;
      var invest_value = parseInt(this.value.replace(/\./g, ""));
      var maksimal_token_value = parseInt(
        maksimal_token.innerHTML.replace(/\./g, "")
      );
      var minimum_invest_value = parseInt(
        minimum_invest.innerHTML.replace(/\./g, "")
      );

      if (invest_value > maksimal_token_value) {
        alertmaks.innerHTML = `<i class="la la-exclamation-triangle"></i> Maksimal <strong>${maksimal_token.innerHTML} Lembar</strong>`;
        alertmaks.style.display = "block";
        total_price.value = 0;
        btnbeli.disabled = true;
      } else if (maksimal_token_value > minimum_invest_value) {
        if (invest_value >= minimum_invest_value) {
          alertmaks.style.display = "none";
          btnbeli.disabled = false;
        } else {
          alertmaks.innerHTML = `<i class="la la-exclamation-triangle"></i> Minimal <strong>${minimum_invest.innerHTML} Lembar</strong>`;
          alertmaks.style.display = "block";
          btnbeli.disabled = true;
          total_price.value = 0;
        }
      } else {
        alertmaks.style.display = "none";
      }

      invest.value = formatNumber(parseInt(invest.value.replace(/\./g, "")));
      total_price.value = formatNumber(
        parseInt(total_price.value.replace(/\./g, ""))
      );
    } else {
      total_price.value = 0;
    }
  });

  btnbeli.addEventListener("click", function (e) {
    $.ajax({
      url: "/transaction/checkUserPersonal",
      type: "get",
      dataType: "json",
      success: function (data) {
        if (data.msg == 200) {
          if (
            data.type == "personal" &&
            parseInt(sisa_invest.innerHTML.replace(/\./g, "")) <
              parseInt(total_price.value.replace(/\./g, ""))
          ) {
            Swal.fire({
              title: "<h3>Pembelian saham melebihi batas pembelian saham</h3>",
              html: `<table class="table table-borderless modal-emiten-detail">
                                <tbody>
                                <tr>
                                    <td>Batas pembelian saham </td>
                                    <td>:</td>
                                    <td>${formatRupiah(
                                      parseInt(max_invest.innerHTML)
                                    )} </td>
                                </tr>
                                <tr>
                                    <td>Total saham yang dibeli pada platform Santara</td>
                                    <td>:</td>
                                    <td>${formatRupiah(
                                      parseInt(emitten_invest.innerHTML)
                                    )}</td>
                                </tr>             
                                <tr> 
                                    <td>Sisa batas pembelian saham</td>
                                    <td>:</td>
                                    <td>${formatRupiah(
                                      parseInt(sisa_invest.innerHTML)
                                    )}</td>
                                </tr>             
                                <tr>
                                    <td>Total saham yang akan dibeli</td>
                                    <td>:</td>
                                    <td>${formatRupiah(
                                      parseInt(
                                        total_price.value.replace(/\./g, "")
                                      )
                                    )}</td>
                                </tr>             
                                <tr>
                                    <td>Kelebihan pembelian saham</td>
                                    <td>:</td>
                                    <td>${formatRupiah(
                                      parseInt(
                                        total_price.value.replace(/\./g, "")
                                      ) -
                                        parseInt(
                                          sisa_invest.innerHTML.replace(
                                            /\./g,
                                            ""
                                          )
                                        )
                                    )}</td>
                                </tr>             
                                </tbody>
                            </table>`,
              showCancelButton: false,
              confirmButtonText: "Ok",
              cancelButtonText: "Tutup",
              showLoaderOnConfirm: true,
              confirmButtonColor: "#28d094",
            });
          } else {
            Swal.fire({
              title:
                '<div class="swal-popup-title">Konfirmasi Pembelian Saham</div>',
              html: `<table class="table table-borderless modal-emiten-detail">
                                <tbody>
                                <tr>
                                    <td>Saham </td>
                                    <td>:</td>
                                    <td>${company_name.innerHTML}</td>
                                </tr>
                                <tr>
                                    <td>Kode Saham</td>
                                    <td>:</td>
                                    <td>${code_emiten.innerHTML}</td>
                                </tr>             
                                <tr>
                                    <td>Harga Saham</td>
                                    <td>:</td>
                                    <td>${harga.innerHTML}</td>
                                </tr>             
                                <tr>
                                    <td>Jumlah Saham</td>
                                    <td>:</td>
                                    <td>${invest.value} Lembar</td>
                                </tr>             
                                <tr>
                                    <td>Total</td>
                                    <td>:</td>
                                    <td>Rp ${total_price.value},00</td>
                                </tr>             
                                </tbody>
                            </table>`,
              customClass: "swal-popup",
              showCancelButton: false,
              confirmButtonText: "Lanjutkan",
              cancelButtonText: "Tutup",
              confirmButtonColor: "#28d094",
            }).then((result) => {
              if (result.value) {
                var dataTransaction = {
                  uuid: emiten_uuid.innerHTML,
                  jumlah: parseInt(invest.value.replace(/\./g, "")),
                };
                checkoutTransactionProcess(dataTransaction);
              }
            });
          }
        } else {
          if (data.msg == 400) {
            window.location = "/user/security/info";
          } else {
            if (data.role != "member") {
              Swal.fire({
                type: "error",
                title: "Oops...",
                text: "Anda tidak dapat melakukan transaksi !",
              });
            } else {
              Swal.fire({
                type: "error",
                title: "Gagal melakukan transaksi",
                showConfirmButton: false,
                timer: 2000,
              });
            }
          }
        }
      },
    });
  });
}

if (btnInfoEmitten) {
  btnInfoEmitten.addEventListener("click", function (e) {
    Swal.fire({
      title: "<h3>Syarat dan ketentuan pembelian saham</h3>",
      text: "Pembelian saham yang harus mengikuti ketentuan sebagain berikut",
      html: `<table class="table table-borderless modal-emiten-detail">
                <tbody>
                  <tr>
                    <td>Minimal pembelian saham </td>
                    <td>:</td>
                    <td>${minimum_invest.innerHTML} Lembar</td>
                  </tr>
                  <tr>
                    <td>Harga saham perlembar</td>
                    <td>:</td>
                    <td>${formatRupiah(parseInt(detail_price.value))}</td>
                  </tr>             
                  <tr> 
                    <td>Batas pembelian saham</td>
                    <td>:</td>
                    <td>${formatRupiah(parseInt(max_invest.innerHTML))}</td>
                  </tr>             
                  <tr>
                    <td>Total saham yang dibeli pada platform Santara</td>
                    <td>:</td>
                    <td>${formatRupiah(parseInt(emitten_invest.innerHTML))}</td>
                  </tr>             
                  <tr>
                    <td>Sisa batas pembelian saham</td>
                    <td>:</td>
                    <td>${formatRupiah(parseInt(sisa_invest.innerHTML))}</td>
                  </tr>             
                </tbody>
              </table>`,
      showCancelButton: false,
      confirmButtonText: "Ok",
      cancelButtonText: "Tutup",
      showLoaderOnConfirm: true,
      confirmButtonColor: "#28d094",
    });
  });
}

function checkoutTransactionProcess(dataTransaction) {
  $.ajax({
    url: `/transaction/checkoutCheck`,
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
        window.location = "/transaction/checkout";
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

// countdown
const hours = document.getElementById("hours");
const minutes = document.getElementById("minutes");
const seconds = document.getElementById("seconds");

if (hours) {
  function getTimeRemaining(endtime) {
    var t = Date.parse(endtime) - Date.parse(new Date());
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
    var hours = 24 * days + Math.floor((t / (1000 * 60 * 60)) % 24);
    var minutes = Math.floor((t / 1000 / 60) % 60);
    var seconds = Math.floor((t / 1000) % 60);
    return {
      total: t,
      days: days,
      hours: hours,
      minutes: minutes,
      seconds: seconds,
    };
  }

  function initializeClock(id, endtime) {
    var clock = document.getElementById(id);
    //   var daysSpan = clock.querySelector('.days');
    var hoursSpan = clock.querySelector(".hours");
    var minutesSpan = clock.querySelector(".minutes");
    var secondsSpan = clock.querySelector(".seconds");

    function updateClock() {
      endtime = endtime.replace(/-/g, "/");
      var t = getTimeRemaining(endtime);

      // daysSpan.innerHTML = t.days;
      hoursSpan.innerHTML = ("0" + t.hours).slice(-2);
      minutesSpan.innerHTML = ("0" + t.minutes).slice(-2);
      secondsSpan.innerHTML = ("0" + t.seconds).slice(-2);

      if (t.total == 0) {
        clearInterval(timeinterval);
        location.reload();
      }

      if (t.total <= 0) {
        clearInterval(timeinterval);
        $("#btn-otp").removeAttr("disabled");
        $("#count-start-emitens").remove();
      }
    }

    updateClock();
    var timeinterval = setInterval(updateClock, 1000);
  }

  initializeClock("clockdiv", start_emitens.innerHTML);
}
