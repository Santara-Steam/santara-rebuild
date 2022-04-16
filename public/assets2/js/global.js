$(document).ready(function () {
  const anchor = window.location.hash;
  $(`a[href="${anchor}"]`).tab("show");

  $('a[data-toggle="tab"]').on("click", function () {
    let url = location.href.replace(/\/$/, "");

    let newUrl;
    const hash = $(this).attr("href");
    if (!hash.includes("tab")) {
      newUrl = url.split("#")[0] + hash;
      history.replaceState(null, null, newUrl);
    }
  });
});

function formatRupiah(angka, prefix) {
  const currency = new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
  });
  return currency.format(angka);
}

function isNumberKey(evt) {
  var charCode = evt.which ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    return false;
  }
  return true;
}

function phoneNumber(e) {
  var code = e.which ? e.which : e.keyCode; //ternery
  if (code > 31 && (code < 48 || code > 57) && code != 43) {
    e.preventDefault();
  }
}

function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
}

function numberOnly(event) {
  var key = window.event ? event.keyCode : event.which;
  if (event.keyCode === 8 || event.keyCode === 46) {
    return true;
  } else if (key < 48 || key > 57) {
    return false;
  } else {
    return true;
  }
}

function numberOnlyOtp(event) {
  var key = window.event ? event.keyCode : event.which;
  if (key < 48 || key > 57) {
    return false;
  } else {
    return true;
  }
}

function numberOnlyMinus(event) {
  var key = window.event ? event.keyCode : event.which;
  if (event.keyCode === 8 || event.keyCode === 46 || event.keyCode === 45) {
    return true;
  } else if (key < 48 || key > 57) {
    return false;
  } else {
    return true;
  }
}

function alphaSpaceOnly(evt) {
  var charCode = evt.which ? evt.which : window.event.keyCode;

  if (charCode <= 13) {
    return true;
  } else {
    var keyChar = String.fromCharCode(charCode);
    var re = /^[a-zA-Z ]+$/;
    return re.test(keyChar);
  }
}

function is_empty(e) {
  switch (e) {
    case "":
    case 0:
    case "0":
    case null:
    case false:
    case typeof this == "undefined":
      return true;
    default:
      return false;
  }
}

function redirectUrl($url) {
  window.location = $url;
}

function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

var opens = "la-eye-slash";
var close = "la-eye";
var togglePassword = document.getElementById("togglePassword");

if (togglePassword) {
  togglePassword.onclick = function () {
    if (this.classList.contains(opens)) {
      password.type = "text";
      this.classList.remove(opens);
      this.className += " " + close;
    } else {
      password.type = "password";
      this.classList.remove(close);
      this.className += " " + opens;
    }
  };
}

$(".alpha-space-only").on("keyup keypress blur", function (evt) {
  $(this).val(
    $(this)
    .val()
    .replace(/[^a-z\s]/gi, "")
  );

  var charCode = evt.which ? evt.which : window.event.keyCode;
  if (charCode != undefined) {
    if (charCode <= 13) {
      return true;
    } else {
      var keyChar = String.fromCharCode(charCode);
      var re = /^[a-zA-Z ]+$/;
      return re.test(keyChar);
    }
  } else {
    return false;
  }
});

$(".number-only").on("keyup keypress blur", function (evt) {
  $(this).val(
    $(this)
    .val()
    .replace(/[^0-9\.]/g, "")
  );

  var charCode = evt.which ? evt.which : window.event.keyCode;
  if (charCode != undefined) {
    if (charCode === 8 || charCode === 46) {
      return true;
    } else if (charCode < 48 || charCode > 57) {
      return false;
    } else {
      return true;
    }
  } else {
    return false;
  }
});

$(".number-only-phone").on("keyup keypress blur", function (evt) {
  $(this).val(
    $(this)
    .val()
    .replace(/[^0-9]/g, "")
  );

  var charCode = evt.which ? evt.which : window.event.keyCode;
  if (charCode != undefined) {
    if (charCode === 8 || charCode === 46) {
      return true;
    } else if (charCode < 48 || charCode > 57) {
      return false;
    } else {
      return true;
    }
  } else {
    return false;
  }
});

$(".format-number").on("keyup keypress blur", function (e) {
  this.value = parseInt(this.value.replace(/\./g, ""));
  if (this.value != "" && !isNaN(this.value)) {
    this.value = formatNumber(this.value);
  } else {
    this.value = 0;
  }
});

$(".no-escape").on("keyup keypress blur", function (e) {
  $(this).val($(this).val().replace(/\s/g, ""));
  var key = e.keyCode;
  return key !== 32;
});

$(".alpha-numeric").on("keyup keypress blur", function (e) {
  var value = e.target.value;
  if (e.key != undefined) {
    if (
      !e.key.match(/[a-zA-Z0-9-]/) ||
      (e.key == "-" && value[value.length - 1] == "-")
    ) {
      e.preventDefault();
      return false;
    }
  }
});

function daftarBisnisLink() {
  Swal.fire({
    html: '<b style="font-size: 1.7rem;font-weight: bold;">Fitur pralisting kini hanya dapat diakses melalui aplikasi <span class="red">Santara</span></b>, ' +
      '<p style="font-size: .9rem; padding: 2rem 1rem 0;">Download aplikasinya sekarang di Google Play dan App Store</p> ' +
      '<div class="mt-1 logo-mobile">' +
      '<a href="https://santara.co.id/ios" target="_blank" class="mr-3"><img src="https://santara.co.id/assets/images/mobile/appstore.png" width="27%" alt="santara playstore"></a>' +
      '<a href="https://santara.co.id/android" target="_blank"><img src="https://santara.co.id/assets/images/mobile/playstore.png" width="27%" alt="santara appstore"></a>' +
      "</div>",
    showCloseButton: false,
    showCancelButton: false,
    showConfirmButton: false,
  });
}

// load CSS
/*! Turn any rel=preload link into rel=stylesheet */
function e() {
  var e = Array.prototype.slice.call(
    document.querySelectorAll("link[rel=preload]"),
    0
  );
  e.length > 0 &&
    e.forEach(function (e) {
      e.rel = "stylesheet";
    });
}
/*! loadCSS. [c]2017 Filament Group, Inc. MIT License */
!(function (e) {
  var t = function (t, r, n) {
    function a(e) {
      return o.body ?
        e() :
        void setTimeout(function () {
          a(e);
        });
    }

    function i() {
      c.addEventListener && c.removeEventListener("load", i),
        (c.media = n || "all");
    }
    var s,
      o = e.document,
      c = o.createElement("link");
    if (r) s = r;
    else {
      var l = (o.body || o.getElementsByTagName("head")[0]).childNodes;
      s = l[l.length - 1];
    }
    var d = o.styleSheets;
    (c.rel = "stylesheet"),
    (c.href = t),
    (c.media = "only x"),
    a(function () {
      s.parentNode.insertBefore(c, r ? s : s.nextSibling);
    });
    var u = function (e) {
      for (var t = c.href, r = d.length; r--;)
        if (d[r].href === t) return e();
      setTimeout(function () {
        u(e);
      });
    };
    return (
      c.addEventListener && c.addEventListener("load", i),
      (c.onloadcssdefined = u),
      u(i),
      c
    );
  };
  "undefined" != typeof exports ? (exports.loadCSS = t) : (e.loadCSS = t);
})("undefined" != typeof global ? global : this),
/*! loadCSS rel=preload polyfill. [c]2017 Filament Group, Inc. MIT License */
!(function (e) {
  if (e.loadCSS) {
    var t = (loadCSS.relpreload = {});
    if (
      ((t.support = function () {
          try {
            return e.document.createElement("link").relList.supports("preload");
          } catch (t) {
            return !1;
          }
        }),
        (t.poly = function () {
          for (
            var t = e.document.getElementsByTagName("link"), r = 0; r < t.length; r++
          ) {
            var n = t[r];
            "preload" === n.rel &&
              "style" === n.getAttribute("as") &&
              (e.loadCSS(n.href, n, n.getAttribute("media")), (n.rel = null));
          }
        }),
        !t.support())
    ) {
      t.poly();
      var r = e.setInterval(t.poly, 300);
      e.addEventListener &&
        e.addEventListener("load", function () {
          t.poly(), e.clearInterval(r);
        }),
        e.attachEvent &&
        e.attachEvent("onload", function () {
          e.clearInterval(r);
        });
    }
  }
})(this),
window.addEventListener("load", e, !1);

function getCookie(cname) {
  const cookies = Object.fromEntries(
    document.cookie.split(/; /).map((c) => {
      const [key, v] = c.split("=", 2);
      return [key, decodeURIComponent(v)];
    })
  );
  return cookies[cname] || "";
}

function tanggalIndo(tgl) {
  let date = new Date(tgl);
  let tahun = date.getFullYear();
  let bulan = date.getMonth();
  let tanggal = date.getDate();
  let hari = date.getDay();
  let listHari = [
    "Minggu",
    "Senin",
    "Selasa",
    "Rabu",
    "Kamis",
    "Jum'at",
    "sabtu",
  ];
  listBulan = [
    "Januari",
    "Februari",
    "Maret",
    "April",
    "Mei",
    "Juni",
    "Juli",
    "Agustus",
    "September",
    "Oktober",
    "November",
    "Desember",
  ];
  return tanggal + " " + listBulan[bulan] + " " + tahun;
}