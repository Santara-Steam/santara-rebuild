$("#formForgotPassword").on('submit', function (e) {
    e.preventDefault();

    var data = new FormData(this);
    $.ajax({
        url: '/forgot_password/sendEmail',
        type: 'POST',
        dataType: "json",
        data: data,
        cache: false,
        async: true,
        processData: false,
        contentType: false,
        timeout: 60000, // sets timeout to 20 seconds
        beforeSend: function () {
            $('.alert-message').hide();
            $('#alert-message-text').html("");

            $('#buttonForgotPassword').attr('disabled', true);
            $('#buttonForgotPassword .loading').removeClass('visually-hidden');
            $('#buttonForgotPassword .btnLabel').addClass('visually-hidden');

            $("input[name='email']").attr("disabled", true);
            $("#btnForgot").attr("disabled", true);
        },
        success: function (data) {
            $('#email_error').html('');
            $('#email').removeClass('invalid');

            if (data.msg == 200) {
                window.location = data.redirect;
            }
            //   else {
            //       if (!$.isEmptyObject(data.error) && data.msg != 200) {
            //           if (data.error.email_error != '') {
            //               $('#email_error').html(data.error.email_error);
            //               $('#email').addClass('invalid');
            //           } else {
            //               $('#email_error').html('');
            //               $('#email').removeClass('invalid');
            //           }
            //       } else {
            //           var error_message = data.msg;
            //           $('.alert-message').show();
            //           $('#alert-message-text').html(error_message);
            //           $('#submit_forgot').removeClass('submit-loader');
            //           $('#submit_forgot').html("Kirim");
            //           $("#btnForgot").attr("disabled", false);
            //           $("input[name='email']").attr("disabled", false);
            //       }
            //   }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            if (textStatus === "timeout" || textStatus === "error") {
                $("#loader").hide();
                Swal.fire({
                    title: 'Ooops...',
                    text: "Mohon periksa koneksi internet anda",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Muat ulang',
                    cancelButtonText: 'Tutup'
                }).then((result) => {
                    if (result.value) {
                        location.reload();
                    }
                })
            }
        },
        complete: function () {
            $("#btnLogin").attr("disabled", false);
            $("input[name='email']").attr("disabled", false);
            $("input[name='password']").attr("disabled", false);
            $('#buttonForgotPassword').attr('disabled', false);
            $('#buttonForgotPassword .loading').addClass('visually-hidden');
            $('#buttonForgotPassword .btnLabel').removeClass('visually-hidden');

        }
    })

})