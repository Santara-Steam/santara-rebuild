$(document).ready(function () {
  $("select").select2({
    maximumSelectionLength: 2,
    allowClear: true,
  });

  $("#submitBank").submit(function (e) {
    e.preventDefault();
    $.ajax({
      url: `/user/withdraw/insert_bank_wd`,
      type: "POST",
      dataType: "json",
      timeout: 20000, // sets timeout
      data: {
        norek: $("input[name='norek']").val(),
        nama: $("input[name='nama']").val(),
        bank: $("select[name='bank']").val(),
      },
      beforeSend: function () {
        $("#loader").show();
        $("#bsubmitBank").attr("disabled", true);
        $("input[name='nama']").attr("disabled", true);
        $("select[name='bank']").attr("disabled", true);
        $("input[name='norek']").attr("disabled", true);
      },
      success: function (data) {
        $("#loader").hide();
        console.log(data);
        if (data.status == true) {
          Swal.fire({
            title: "Berhasil",
            text: data.data.message,
            type: "success",
            showCancelButton: false,
            confirmButtonText: "Ok",
          }).then((result) => {
            location.reload();
          });
        } else if (data.status == false) {
          Swal.fire({
            title: "Gagal",
            text: data.error[0].message,
            type: "error",
          });
        } else {
          if (!$.isEmptyObject(data.error)) {
            if (data.error.nama_error != "") {
              $("#nama_error").html(data.error.nama_error);
              $("#nama").addClass("invalid");
            } else {
              $("#nama_error").html("");
              $("#nama").removeClass("invalid");
            }
            if (data.error.norek_error != "") {
              $("#norek_error").html(data.error.norek_error);
              $("#norek").addClass("invalid");
            } else {
              $("#norek_error").html("");
              $("#norek").removeClass("invalid");
            }
            if (data.error.bank_error != "") {
              $("#bank_error").html(data.error.bank_error);
              $("#bank").addClass("invalid");
            } else {
              $("#bank_error").html("");
              $("#bank").removeClass("invalid");
            }
          }
        }
      },
      complete: function () {
        $("#bsubmitBank").attr("disabled", false);
        $("input[name='nama']").attr("disabled", false);
        $("select[name='bank']").attr("disabled", false);
        $("input[name='norek']").attr("disabled", false);
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
    });
  });
});
