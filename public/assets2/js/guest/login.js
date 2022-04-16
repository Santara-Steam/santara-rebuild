const inputTokenName = $("input[name='tknName']").val();
const inputCookieName = $("input[name='ckName']").val();

$(document).ready(function () {
  $("#formSubmitLogin").on("submit", function (e) {
    e.preventDefault();
    const cookieToken = getCookie(inputCookieName);
    $(`input[name=${inputTokenName}]`).val(cookieToken);

    var data = new FormData(this);

    $.ajax({
      url: "/login/dologin",
      type: "POST",
      dataType: "json",
      data: data,
      cache: false,
      async: true,
      processData: false,
      contentType: false,
      timeout: 60000, // sets timeout to 20 seconds
      beforeSend: function () {
        $(".alert-message").hide();
        $("#alert-message-text").html("");
        $("#submit_text").html("");
        $("#submit_text").addClass("submit-loader");
        $("input[name='email']").attr("disabled", true);
        $("input[name='password']").attr("disabled", true);
        $("#btnLogin").attr("disabled", true);
        $("#loader").show();

      },
      success: function (data) {
        $("#email_error").html("");
        $("#email").removeClass("invalid");
        $("#password_error").html("");
        $("#password").removeClass("invalid");
        $("#loader").hide();

        if (data.msg == 200) {
          if (data.user === undefined) {
            window.location = data.redirect;
          } else {
            $("#loader").show();
            const userData = data.user;
            const key = data.key;
            const parseData = JSON.parse(userData);
            const cookieName = "__AU2nQs04ys_";
            const cookiePhoto = "_LOpSM4cK97";
            const hostName = window.location.hostname;
            const hostNameArray = hostName.split(".");

            let cookieCrossDomain = "";

            if (
              hostName === "dev.santara.id" ||
              hostName === "https://dev.santara.id"
            ) {
              cookieCrossDomain =
                hostNameArray.length > 1 ?
                `.${hostNameArray
                    .filter((val, index) => index >= hostNameArray.length - 2)
                    .join(".")}` // get last 2 words from hostname if array length > 1 (e.g. santara.id) and append them with '.' (ASCII 46)
                :
                hostName; // get hostName if array length = 1, e.g. localhost
            } else if (hostNameArray.length >= 3) {
              cookieCrossDomain =
                hostNameArray.length > 1 ?
                `.${hostNameArray
                    .filter((val, index) => index >= hostNameArray.length - 3)
                    .join(".")}` // get last 2 words from hostname if array length > 1 (e.g. santara.co.id) and append them with '.' (ASCII 46)
                :
                hostName; // get hostName if array length = 1, e.g. localhost
            } else {
              cookieCrossDomain =
                hostNameArray.length > 1 ?
                `.${hostNameArray
                    .filter((val, index) => index >= hostNameArray.length - 2)
                    .join(".")}` // get last 2 words from hostname if array length > 1 (e.g. santara.id) and append them with '.' (ASCII 46)
                :
                hostName; // get hostName if array length = 1, e.g. localhost
            }

            const ciphertext = CryptoJS.AES.encrypt(
              JSON.stringify(parseData.token),
              key
            );

            const ciphertextPhoto = CryptoJS.AES.encrypt(
              JSON.stringify(parseData.photos),
              key
            );

            function saveCookies(cookiesName, data) {
              document.cookie =
                cookiesName +
                "=" +
                data +
                ";domain=" +
                cookieCrossDomain +
                ";path=/";
            }

            setTimeout(() => {
              window.location = data.redirect;
            }, 1000);
            const url = `${data.url}/apis/post/session`;
            fetch(url, {
                method: "POST",
                body: JSON.stringify({
                  token: ciphertext.toString(),
                }),
              })
              .then((response) => response.json())
              .then((result) => {
                if (result.token) {
                  saveCookies(cookieName, result.token);
                  saveCookies(cookiePhoto, ciphertextPhoto.toString());

                }
              });
          }
        } else {
          if (!$.isEmptyObject(data.error) && data.msg != 200) {
            if (data.error.email_error != "") {
              $("#email_error").html(data.error.email_error);
              $("#email").addClass("invalid");
            } else {
              $("#email_error").html("");
              $("#email").removeClass("invalid");
            }

            // TODO: Hotfix
            // const url = `${data.url}/api/post/session`;
            // fetch(url, {
            //   method: "POST",
            //   body: JSON.stringify({
            //     token: ciphertext.toString(),
            //   }),
            // })
            //   .then((response) => response.json())
            //   .then((result) => {
            //     if (result.token) {
            //
            //     }
            //   });
          } else {
            if (!$.isEmptyObject(data.error) && data.msg != 200) {
              if (data.error.email_error != "") {
                $("#email_error").html(data.error.email_error);
                $("#email").addClass("invalid");
              } else {
                $("#email_error").html("");
                $("#email").removeClass("invalid");
              }

              if (data.error.password_error != "") {
                $("#password_error").html(data.error.password_error);
                $("#password").addClass("invalid");
              } else {
                $("#password_error").html("");
                $("#password").removeClass("invalid");
              }
            } else {
              var error_message = data.msg;
              $(".alert-message").show();
              $("#alert-message-text").html(error_message);
              $("#submit_text").removeClass("submit-loader");
              $("#submit_text").html("Masuk");
              $("#btnLogin").attr("disabled", false);
              $("input[name='email']").attr("disabled", false);
              $("input[name='password']").attr("disabled", false);
            }
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
        $("#btnLogin").attr("disabled", false);
        $("input[name='email']").attr("disabled", false);
        $("input[name='password']").attr("disabled", false);
        $("#submit_text").removeClass("submit-loader");
        $("#submit_text").html("Masuk");
      },
    });
  });
})