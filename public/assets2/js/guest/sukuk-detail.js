var swiper = new Swiper('.swiper-container', {
    // Enable lazy loading
    lazy: true,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        dynamicBullets: true
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

});


var pricePerUnit = $("input[name='pricePerUnit']").val();
let errorStatus = 1;
const max_invest = document.getElementById('max_invest');
const emitten_invest = document.getElementById('emitten_invest');
const ownership_remaining = document.getElementById('sisa_invest');
const is_unlimited_invest = document.getElementById('is_unlimited_invest');

function thousandFormat(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

$('input').keyup(function() {
    var unitCount   = $("input[name='unit-count']").val();
    var uuid        = $("input[name='uuidSukuk']").val();
    var amount      = unitCount*pricePerUnit;
    var minBuy      = $("input[name='min-buy']").val();
    var maxBuy      = $("input[name='max-buy']").val();
    var maxUnitBuy  = maxBuy/pricePerUnit;
    var minUnitBuy  = minBuy/pricePerUnit;

    if (Number(unitCount) < minUnitBuy) {
        $('#errorUnitRequired').html(`Minimal pembelian adalah ${minUnitBuy} unit!`);
        $("#errorUnitRequired").css({"display": "block"});
    }

    if (Number(unitCount) > maxUnitBuy) {
        $('#errorUnitRequired').html(`Maximal pembelian adalah ${maxUnitBuy} unit!`);
        $("#errorUnitRequired").css({"display": "block"});
    }

    document.getElementById('totalPrice').value = thousandFormat(Number(unitCount)*pricePerUnit);
    
    if (Number(unitCount) >= minUnitBuy && uuid && Number(unitCount) <= maxUnitBuy) {
        $("#errorUnitRequired").css({"display": "none"});
        errorStatus = 0;
        $.ajax({
            url: `/sukuk/getDividen`,
            type: 'POST',
            dataType: "json",
            data: { uuid, amount },
            timeout: 20000,
            success: function(data) {
                var parseResponse = JSON.parse(data);
                if (parseResponse) {
                    $('#predictionDividenResult').html('Rp' + '&nbsp;' + parseResponse.total_dividend);
                    $('#nilaiModal').html('Rp' + '&nbsp;' + parseResponse.nilai_modal);
                    $('#perkiraanImbalHasil').html('Rp' + '&nbsp;' + parseResponse.total_dividend);
                    $('#dividenPercentage').html(parseResponse.dividend_percentage + '%');
                    $('#dividenPercentageValue').html('Rp' + '&nbsp;' + parseResponse.dividend_by_month);
                    $('#dividenPercentageTax').html(parseResponse.dividend_tax_percentage + '%');
                    $('#dividenPercentageTaxValue').html('Rp' + '&nbsp;' + parseResponse.dividend_tax_price);
                    $('#dividenPerMonth').html('Rp' + '&nbsp;' + parseResponse.dividend_after_tax);
                    $('#periodTime').html(parseResponse.period_time);
                    $('#monthlyInfo').html(parseResponse.period_month + '&nbsp;' + 'Bulan');
                    $('#totalImbalHasil').html('Rp' + '&nbsp;' + parseResponse.total_dividend);
                }
            },
            error: function(data) {
                console.log('errr', data);
            }
        });
    }
});

$("#buySukukSubmit").click(function() {
  var dataBuy = {
    amount: $("input[name='unit-count']").val(),
    uuid: $("input[name='uuidSukuk']").val(),
    price: pricePerUnit
  };
  var totalPurchase = dataBuy.amount*dataBuy.price;
  var purchaseAdvantage = ownership_remaining.innerHTML - totalPurchase;

  if (dataBuy.amount) {
      if (errorStatus === 0) {
        if (totalPurchase > ownership_remaining.innerHTML && is_unlimited_invest === 0) {
            $('#purchaseTotal').html(`${formatRupiah(parseInt(totalPurchase))}`);
            $('#purchaseAdvantage').html(`${formatRupiah(parseInt(purchaseAdvantage))}`);
            $('#validateModal').modal('show');
        } else {
            $('#trxModal').modal('toggle');
            depositProcess(dataBuy);
        }
      } else {
          return;
      }
  } else {
    $('#errorUnitRequired').html('Silahkan masukkan besaran unit yang ingin kamu beli terlebih dahulu!');
  }
});

function depositProcess(dataBuy) {
  Swal.fire({
      html: ` <div><img src="/assets/images/content/account/password.png" width="35%" alt="security token"></div>
              <div class="mt-1"><b class="swal-popup-title">Masukan PIN Anda</b></div> 
              <div><p style="font-size: .9rem;">Masukan kode 6 angka security pin akun anda</p></div>
              <input type="password" class="form-control form-control-no-radius swal-popup-input" id="pin" onkeypress="return isNumberKey(event)" maxlength="6">`,
      inputAttributes: {
          autocapitalize: 'off'
      },
      customClass: 'swal-popup',
      showCancelButton: false,
      showConfirmButton: true,
      showLoaderOnConfirm: true,
      confirmButtonText: 'Verifikasi',
      footer: '<p class="swal-popup-footer">Lupa PIN ? <a href="/user/security/email">Reset PIN</a></p>',
      onBeforeOpen: function(element) {
          $(element).find('button.swal2-confirm.swal2-styled').toggleClass('swal2-confirm swal2-styled swal2-confirm btn btn-account btn-santara-red d-block')
      },
      preConfirm: function() {
          return new Promise((resolve, reject) => {
              resolve({
                  pin: $('#pin').val()
              });
              // maybe also reject() on some condition
          });
      }
  }).then((data) => {
    var pin = data.value.pin;
    $.ajax({
        url: `/sukuk/validatePin/${pin}`,
        type: 'POST',
        dataType: "json",
        data: dataBuy,
        timeout: 20000,
        beforeSend: function() {
            $("#loader").show();
        },
        success: function(data) {
            $("#loader").hide();
            if (data.msg == 200) {
                window.location = '/sukuk/checkout';
            } else {
                Swal.fire("Error!", data.msg, "error").then((result) => {
                    location.reload();
                });
            }
        },
        error: function(data) {
            $("#loader").hide();
            Swal.fire("Error!", 'Permintaan gagal diproses !', "error");
        }
    });
  });
}

// countdown
const hours = document.getElementById('hours');
const minutes = document.getElementById('minutes');
const seconds = document.getElementById('seconds');

if (hours) {
    function getTimeRemaining(endtime) {
        var t = Date.parse(endtime) - Date.parse(new Date());
        var days = Math.floor(t / (1000 * 60 * 60 * 24));
        var hours = 24 * days + Math.floor((t / (1000 * 60 * 60)) % 24);
        var minutes = Math.floor((t / 1000 / 60) % 60);
        var seconds = Math.floor((t / 1000) % 60);
        return {
            'total': t,
            'days': days,
            'hours': hours,
            'minutes': minutes,
            'seconds': seconds
        };
    }

    function initializeClock(id, endtime) {
        var clock = document.getElementById(id);
        //   var daysSpan = clock.querySelector('.days');
        var hoursSpan = clock.querySelector('.hours');
        var minutesSpan = clock.querySelector('.minutes');
        var secondsSpan = clock.querySelector('.seconds');

        function updateClock() {
            endtime = endtime.replace(/-/g, '/');
            var t = getTimeRemaining(endtime);

            console.log(t);

            // daysSpan.innerHTML = t.days;
            hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
            minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
            secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

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

    initializeClock('clockdiv', begin_period.innerHTML);
}