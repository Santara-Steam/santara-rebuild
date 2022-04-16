$(document).ready(function () {
  const amount = document.getElementById("amount");
  if (amount) {
    amount.addEventListener("keyup", function (e) {
      this.value = formatRupiah(parseInt(this.value.replace(/\./g, "")))
        .slice(3)
        .slice(0, -3);
    });
  }

  $("select").select2({
    maximumSelectionLength: 2,
    allowClear: true,
  });

  $("#code_emiten")
    .change(function (e) {
      $("#datatableDividend").DataTable().clear().draw();
      $("#dividend-container").css("display", "none");

      var emiten_uuid = $(this).find(":selected").attr("data-id");
      if (emiten_uuid != "" && emiten_uuid != undefined) {
        $.ajax({
          url: "/user/dividend/get_emiten_by_uuid",
          method: "POST",
          data: {
            emiten_uuid
          },
          timeout: 20000, // sets timeout to 20 seconds
          beforeSend: function () {
            $("#loader").show();
          },
          success: function (data) {
            data = JSON.parse(data);
            $("#trademark").val(data.trademark);
            $("#company_name").val(data.company_name);
            $("#emiten_uuid").val(data.emiten_uuid);
            $("#loader").hide();
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
      }
    })
    .change();
});

function confirmGenerateDividend() {
  $("#loader").show();
  var data_dividend = {
    code_emiten: $("select[name='code_emiten']").val(),
    trademark: $("input[name='trademark']").val(),
    company_name: $("input[name='company_name']").val(),
    phase: $("select[name='phase']").val(),
    date: $("select[name='date']").val(),
    month: $("select[name='month']").val(),
    year: $("select[name='year']").val(),
    amount: $("input[name='amount']").val(),
    emiten_uuid: $("input[name='emiten_uuid']").val(),
  };

  $.ajax({
    url: "/user/dividend/generate_dividend/",
    type: "POST",
    timeout: 120000, // sets timeout to 1 menit
    cache: false,
    data: data_dividend,
    success: function (data) {
      $("#loader").hide();
      data = JSON.parse(data);

      $("#company_name_error").html("");
      $("#company_name").removeClass("invalid");
      $("#trademark_error").html("");
      $("#trademark").removeClass("invalid");
      $("#code_emiten_error").html("");
      $("#code_emiten").removeClass("invalid");
      $("#phase_error").html("");
      $("#phase").removeClass("invalid");
      $("#date_error").html("");
      $("#date").removeClass("invalid");
      $("#month_error").html("");
      $("#month").removeClass("invalid");
      $("#year_error").html("");
      $("#year").removeClass("invalid");
      $("#amount_error").html("");
      $("#amount").removeClass("invalid");

      if ($.isEmptyObject(data.error) && data.msg == 200) {
        $("#dividend-container").css("display", "");

        $("#dividend_detail_code_emiten").html(
          data.dividend.dividend_detail.code_emiten
        );
        $("#dividend_detail_phase").html(data.dividend.dividend_detail.phase);
        $("#dividend_detail_trademark").html(
          data.dividend.dividend_detail.trademark
        );
        $("#dividend_detail_date").html(data.dividend.dividend_detail.date);
        $("#dividend_detail_company_name").html(
          data.dividend.dividend_detail.company_name
        );
        $("#dividend_detail_amount").html(data.dividend.dividend_detail.amount);

        $("#datatableDividend").DataTable({
          destroy: true,
          data: JSON.parse(data.dividend.dividends),
          columns: [{
              data: "name"
            },
            {
              data: "token"
            },
            {
              data: "percentage"
            },
            {
              data: "dividen"
            },
          ],
        });
      } else {
        if (!$.isEmptyObject(data.error)) {
          if (data.error.company_name_error != "") {
            $("#company_name_error").html(data.error.company_name_error);
            $("#company_name").addClass("invalid");
          } else {
            $("#company_name_error").html("");
            $("#company_name").removeClass("invalid");
          }

          if (data.error.trademark_error != "") {
            $("#trademark_error").html(data.error.trademark_error);
            $("#trademark").addClass("invalid");
          } else {
            $("#trademark_error").html("");
            $("#trademark").removeClass("invalid");
          }

          if (data.error.code_emiten_error != "") {
            $("#code_emiten_error").html(data.error.code_emiten_error);
            $("#code_emiten").addClass("invalid");
          } else {
            $("#code_emiten_error").html("");
            $("#code_emiten").removeClass("invalid");
          }

          if (data.error.phase_error != "") {
            $("#phase_error").html(data.error.phase_error);
            $("#phase").addClass("invalid");
          } else {
            $("#phase_error").html("");
            $("#phase").removeClass("invalid");
          }

          if (data.error.date_error != "") {
            $("#date_error").html(data.error.date_error);
            $("#date").addClass("invalid");
          } else {
            $("#date_error").html("");
            $("#date").removeClass("invalid");
          }

          if (data.error.month_error != "") {
            $("#month_error").html(data.error.month_error);
            $("#month").addClass("invalid");
          } else {
            $("#month_error").html("");
            $("#month").removeClass("invalid");
          }

          if (data.error.year_error != "") {
            $("#year_error").html(data.error.year_error);
            $("#year").addClass("invalid");
          } else {
            $("#year_error").html("");
            $("#year").removeClass("invalid");
          }

          if (data.error.amount_error != "") {
            $("#amount_error").html(data.error.amount_error);
            $("#amount").addClass("invalid");
          } else {
            $("#amount_error").html("");
            $("#amount").removeClass("invalid");
          }
        } else {
          if (data.msg == 203) {
            Swal.fire("Maintenance", "fitur dalam proses perbaikan", "info");
          } else {
            Swal.fire("Gagal", "Generate dividend gagal dijalankan", "info");
          }
        }
      }
    },
    error: function (msg) {
      $("#loader").hide();

      Swal.fire(
        "Error!",
        "Generate pembagian dividen gagal dilakukan",
        "error"
      );
    },
  });
}

function confirmSaveDividend() {
  var data = {
    uuid: $("input[name='emiten_uuid']").val()
  };
  Swal.fire({
    title: "Konfirmasi menyimpan data dividen ?",
    html: "Daftar data bagi hasil akan disimpan ?",
    type: "info",
    showCancelButton: true,
    confirmButtonText: "Ya",
    cancelButtonText: "Tidak",
  }).then((result) => {
    if (result.value) {
      $("#loader").show();
      $.ajax({
        url: "/user/dividend/save_generate_dividend",
        type: "POST",
        data: data,
        success: function (data) {
          $("#loader").hide();

          data = JSON.parse(data);
          if (data.msg == 404) {
            Swal.fire("Gagal", "Koneksi bermasalah", "info").then((result) => {
              location.reload();
            });
          } else if (data.msg == 500) {
            Swal.fire("Gagal", "Gagal menambahkan dividen", "info").then(
              (result) => {
                location.reload();
              }
            );
          } else if (data.msg == 200) {
            Swal.fire({
              title: "Berhasil",
              text: "Berhasil menambahkan data dividend.",
              type: "success",
              showCancelButton: false,
              confirmButtonText: "Ok",
            }).then((result) => {
              window.location = "/user/dividend";
            });
          } else {
            Swal.fire("Maintenance", data.msg, "info");
          }
        },
        error: function (msg) {
          console.log(msg)
          $("#loader").hide();
          Swal.fire(
            "Error!",
            "Generate pembagian dividen gagal dilakukan",
            "error"
          );
        },
      });
    }
  });
}