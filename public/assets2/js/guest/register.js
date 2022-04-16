const btnRegister = document.getElementById("btnRegister");
const phone = document.getElementById("phone");
const name = document.getElementById("name");
const email = document.getElementById("email");
const password = document.getElementById("password");
const confirmpassword = document.getElementById("confirmpassword");
const code_dial = document.getElementById("code_dial");
const inputTokenName = $("input[name='tknName']").val();
const inputCookieName = $("input[name='ckName']").val();

var iti = window.intlTelInput(phone, {
  formatOnDisplay: true,
  preferredCountries: ["id"],
  placeholderNumberType: "MOBILE",
  separateDialCode: true,
});

if (toggleRegisterPassword) {
  toggleRegisterPassword.onclick = function () {
    if (this.classList.contains(opens)) {
      password.type = "text";
      confirmpassword.type = "text";
      this.classList.remove(opens);
      this.className += " " + close;
    } else {
      password.type = "password";
      confirmpassword.type = "password";
      this.classList.remove(close);
      this.className += " " + opens;
    }
  };
}

// listen to the telephone input for changes
code_dial.value = iti.getSelectedCountryData().dialCode;
phone.addEventListener("countrychange", function (e) {
  code_dial.value = iti.getSelectedCountryData().dialCode;
});

$("#phone").on("keyup blur input change paste", function (e) {
  this.value = this.value.replace(/^0+/, "");
});

$("#formSubmitRegister").on("submit", function (e) {
  e.preventDefault();
  const cookieToken = getCookie(inputCookieName);
  $(`input[name=${inputTokenName}]`).val(cookieToken);

  var data = new FormData(this);

  // Swal.fire({
  //   title: "Data pengguna baru",
  //   html:
  //     `
  //       Apakah data yang anda masukan sudah benar ? <br /><br />
  //       <table id="table" class="confirm-register" border=0>
  //           <tbody>
  //           <tr>
  //               <td>Nama</td>
  //               <td style="padding-left: 10px; padding-right: 20px;">:</td>
  //               <td>` +
  //     data.get("name") +
  //     `</td>
  //           </tr>
  //           <tr>
  //               <td>No Telepon</td>
  //               <td style="padding-left: 10px; padding-right: 20px;">:</td>
  //               <td>` +
  //     data.get("phone") +
  //     `</td>
  //           </tr>
  //           <tr>
  //               <td>Email</td>
  //               <td style="padding-left: 10px; padding-right: 20px;">:</td>
  //               <td>` +
  //     data.get("email") +
  //     `</td>
  //           </tr>
  //           </tbody>
  //       </table>
  //       `,
  //   type: "info",
  //   showCancelButton: true,
  //   confirmButtonText: "Ya",
  //   cancelButtonText: "Tidak",
  // }).then((result) => {
  //   if (result.value) {
  $.ajax({
    url: "/register/doregister",
    type: "POST",
    dataType: "json",
    data: data,
    cache: false,
    async: true,
    processData: false,
    contentType: false,
    timeout: 20000, // sets timeout to 20 seconds
    beforeSend: function () {
      $("#submit_text").html("");
      $("#submit_text").addClass("submit-loader");
      $("input[name='name']").attr("disabled", true);
      $("input[name='phone']").attr("disabled", true);
      $("input[name='email']").attr("disabled", true);
      $("input[name='password']").attr("disabled", true);
      $("#btnRegister").attr("disabled", true);
    },
    success: function (data) {
      $("#email_error").html("");
      $("#email").removeClass("invalid");
      $("#password_error").html("");
      $("#password").removeClass("invalid");
      $("#password_error").html("");
      $("#password").removeClass("invalid");
      $("#phone_error").html("");
      $("#phone").removeClass("invalid");

      if (data.msg == 200) {
        Swal.fire("Berhasil", "Silahkan verifikasi email anda", "success").then(
          (result) => {
            window.location = "/";
          }
        );
      } else {
        if (!$.isEmptyObject(data.error)) {
          if (data.error.name_error != "") {
            $("#name_error").html(data.error.name_error);
            $("#name").addClass("invalid");
          } else {
            $("#name_error").html("");
            $("#name").removeClass("invalid");
          }

          if (data.error.phone_error != "") {
            $("#phone_error").html(data.error.phone_error);
            $("#phone").addClass("invalid");
          } else {
            $("#phone_error").html("");
            $("#phone").removeClass("invalid");
          }

          if (data.error.password_error != "") {
            $("#password_error").html(data.error.password_error);
            $("#password").addClass("invalid");
          } else {
            $("#password_error").html("");
            $("#password").removeClass("invalid");
          }

          if (data.error.email_error != "") {
            $("#email_error").html(data.error.email_error);
            $("#email").addClass("invalid");
          } else {
            $("#email_error").html("");
            $("#email").removeClass("invalid");
          }
        } else {
          Swal.fire("Gagal", data.msg, "info");
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
        }).then((result) => {
          if (result.value) {
            location.reload();
          }
        });
      }
    },
    complete: function () {
      $("#btnRegister").attr("disabled", false);
      $("input[name='name']").attr("disabled", false);
      $("input[name='phone']").attr("disabled", false);
      $("input[name='email']").attr("disabled", false);
      $("input[name='password']").attr("disabled", false);
      $("#submit_text").removeClass("submit-loader");
      $("#submit_text").html("Masuk");
    },
  });
  //   }
  // });
});

var check = "la-check";
var times = "la-times red";

$("#password").on("keyup change blur input", function (e) {
  confirmpassword.value = "";

  if (password.value.length < 8) {
    $("#password_error").html("Minimal 8 karakter");
    $(".submit-form").prop("disabled", true);
  } else {
    $("#password_error").html("");
  }

  if (
    confirmpassword.value.length > 8 &&
    confirmpassword.value != password.value
  ) {
    $("#password_error").html("Konfirmasi password salah");
    $("#checkResetPasswordConfirmation").removeClass(check);
    $("#checkResetPasswordConfirmation").addClass(times);
    $(".submit-form").prop("disabled", true);
  }
});

$("#confirmpassword").on("keyup change blur input", function (e) {
  if (confirmpassword.value.length < 8) {
    $("#confirmpassword_error").html("Minimal 8 karakter");
    $(".submit-form").prop("disabled", true);
  } else {
    $("#confirmpassword_error").html("");
    if (confirmpassword.value.length >= password.value.length) {
      if (confirmpassword.value != password.value) {
        $("#confirmpassword_error").html("Konfirmasi password salah");
        $("#checkResetPasswordConfirmation").removeClass(check);
        $("#checkResetPasswordConfirmation").addClass(times);
        $(".submit-form").prop("disabled", true);
      } else {
        $("#checkResetPasswordConfirmation").removeClass(times);
        $("#checkResetPasswordConfirmation").addClass(check);
      }
    } else {
      $("#checkResetPasswordConfirmation").removeClass(check);
      $("#checkResetPasswordConfirmation").removeClass(times);
      $(".submit-form").prop("disabled", true);
    }
  }
});