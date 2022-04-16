$(document).ready(function() {
    $("#confirmation_photo").fileinput({
        'allowedFileExtensions': ["jpg", "jpeg", "gif", "png"],
        'showUpload': false,
        'showRemove': false,
        'maxFileCount': 1,
        'maxFileSize': 10000,
        'showPreview': false,
        'elErrorContainer': "#errorBlockConfirmationPhoto"
    });
});

$("#formSubmitConfirm").on('submit', function(e) {
    e.preventDefault();

    var data = new FormData(this);

    $.ajax({
        url: '/user/deposit/submitconfirm',
        type: 'POST',
        dataType: "json",
        data: data,
        cache: false,
        async: true,
        processData: false,
        contentType: false,
        beforeSend: function() {
            $("#loader").show();
            $("#submitConfirm").attr("disabled", true);
            $("select[name='bank_id']").attr("disabled", true);
            $("input[name='confirmation_photo']").attr("disabled", true);
        },
        success: function(data) {
            if (data.msg == 200) {
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Konfirmasi deposit anda sedang kami proses.',
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    window.location = '/user/deposit';
                })
            } else {
                if (!$.isEmptyObject(data.error)) {
                    if (data.error.bank_id_error != '') {
                        $('#bank_id_error').html(data.error.bank_id_error);
                        $('#bank_id').addClass('invalid');
                    } else {
                        $('#bank_id_error').html('');
                        $('#bank_id').removeClass('invalid');
                    }

                    if (data.error.confirmation_photo_error != '') {
                        $('#confirmation_photo_error').html(data.error.confirmation_photo_error);
                        $('#confirmation_photo').addClass('invalid');
                    } else {
                        $('#confirmation_photo_error').html('');
                        $('#confirmation_photo').removeClass('invalid');
                    }
                } else {
                    Swal.fire({
                        title: 'Oooops !',
                        text: data.msg,
                        type: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Ok'
                    })
                }
            }
        },
        complete: function() {
            $("#submitConfirm").attr("disabled", false);
            $("select[name='bank_id']").attr("disabled", false);
            $("input[name='confirmation_photo']").attr("disabled", false);
            $("#loader").hide();
        }
    });

});

var btn_va_copy = document.getElementById("btn_va_copy");
var btn_price_copy = document.getElementById("btn_price_copy");

if ((btn_va_copy) && (btn_price_copy)) {
    btn_va_copy.addEventListener("click", copy_virtual_account);
    btn_price_copy.addEventListener("click", copy_price);
}

function copy_virtual_account() {
    var copyTextVa = document.getElementById("text_virtual_account");
    var textArea = document.createElement("textarea");
    textArea.value = copyTextVa.textContent;
    document.body.appendChild(textArea);
    textArea.select();
    document.execCommand("Copy");
    textArea.remove();
    var tooltip_copy_va = document.getElementById("myTooltipVa");
    tooltip_copy_va.innerHTML = "Virtual Account berhasil disalin ";
}

function copy_price() {
    var copyTextPrice = document.getElementById("text_price");
    var textArea = document.createElement("textarea");
    textArea.value = copyTextPrice.textContent;
    textArea.value = textArea.value.replace(/\./g, '');
    document.body.appendChild(textArea);
    textArea.select();
    document.execCommand("Copy");
    textArea.remove();
    var tooltip_copy_price = document.getElementById("myTooltipPrice");
    tooltip_copy_price.innerHTML = "Jumlah Deposit berhasil disalin ";
}

function outFuncVa() {
    var tooltip_copy_va = document.getElementById("myTooltipVa");
    tooltip_copy_va.innerHTML = "Salin Virtual Account";
}

function outFuncPrice() {
    var tooltip_copy_price = document.getElementById("myTooltipPrice");
    tooltip_copy_price.innerHTML = "Salin Jumlah Deposit";
}