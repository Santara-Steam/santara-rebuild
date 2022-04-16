function confirmDividend(
  id,
  name,
  trader_id,
  company_name,
  dividend_idr,
  fee,
  total,
  bank,
  account_number,
  account_name,
  bank_kota,
  bank_cabang,
  uuid,
  dividend,
  updated_at
) {
  Swal.fire({
    title: "<strong>" + total + "</strong>",
    html:
      `<table class="table table-borderless dividend-detail" style="text-align: left;font-size: 12px;font-weight: 500;">
            <tbody>
              <tr>
                <td>Nama </td>
                <td>:</td>
                <td>` +
      name +
      `</td>
              </tr>
              <tr>
                <td>Bank</td>
                <td>:</td>
                <td>` +
      bank +
      `</td>
              </tr>
              <tr>
                <td>No. Rekening</td>
                <td>:</td>
                <td>` +
      account_number +
      `</td>
              </tr>
              <tr>
                <td>Nama Rekening</td>
                <td>:</td>
                <td>` +
      account_name +
      `</td>
              </tr>
            </tbody>
          </table>`,
    type: "info",
    showCancelButton: true,
    confirmButtonText: "Ya, Verifikasi",
    cancelButtonText: "Tidak",
    reverseButtons: true,
  }).then((result) => {
    if (result.value) {
      var data = {
        id: id,
        uuid: uuid,
        information1: company_name,
        information2: company_name,
        information4: dividend,
        trader_id: trader_id,
        updated_at: updated_at,
      };
      $.ajax({
        url: "/user/dividend/verifikasi/",
        type: "POST",
        dataType: "json",
        data: data,
        beforeSend: function () {
          $("#loader").show();
        },
        success: function (data) {
          $("#loader").hide();
          if (!data.error) {
            Swal.fire(
              "Berhasil",
              "Verifikasi bagi hasil sebesar Rp. " +
                formatRupiah(dividend).slice(3).slice(0, -3) +
                " berhasil dilakukan",
              "success"
            ).then((result) => {
              location.reload();
            });
          } else {
            if (data.msg) {
              Swal.fire(
                "Error!",
                "Gagal melakukan verifikasi, " + data.msg,
                "error"
              ).then((result) => {
                location.reload();
              });
            } else {
              Swal.fire("Error!", "Gagal melakukan verifikasi", "error").then(
                (result) => {
                  location.reload();
                }
              );
            }
          }
        },
        error: function (msg) {
          $("#loader").hide();
          Swal.fire("Error!", "Gagal melakukan verifikasi", "error").then(
            (result) => {
              location.reload();
            }
          );
        },
      });
    }
  });
}

function rejectDividend(
  id,
  uuid,
  company_name,
  dividend,
  trader_id,
  updated_at
) {
  Swal.fire({
    title: "<strong> Tolak pengajuan bagi hasil </strong>",
    text: "Masukan alasan penolakan bagi hasil",
    input: "text",
    showCancelButton: true,
    confirmButtonText: "Ya, Tolak",
    cancelButtonText: "Tidak",
    reverseButtons: true,
    preConfirm: (input) => {
      if (input === "") {
        Swal.showValidationMessage("alasan penolakan tidak boleh kosong");
      } else {
        $("#loader").show();
        var data = {
          id: id,
          uuid: uuid,
          keterangan: input,
          information1: company_name,
          information2: company_name,
          information4: dividend,
          trader_id: trader_id,
          updated_at: updated_at,
        };

        $.ajax({
          type: "POST",
          url: "/dividend/reject/",
          dataType: "json",
          data: data,
          success: function (data) {
            $("#loader").hide();
            if (data.msg) {
              Swal.fire(
                "Berhasil",
                "Penolakan pengajuan bagi hasil berhasil dilakukan",
                "success"
              ).then((result) => {
                location.reload();
              });
            } else {
              Swal.fire("Error!", "Permintaan gagal dilakukan", "error").then(
                (result) => {
                  location.reload();
                }
              );
            }
          },
          error: function (data) {
            $("#loader").hide();
            Swal.fire("Error!", "Permintaan gagal dilakukan", "error").then(
              (result) => {
                location.reload();
              }
            );
          },
        });
      }
    },
  });
}

function getEmitenDetailConfirm(trader_id, status, updated_at) {
  var data = { trader_id, status, updated_at };
  var emitenDetailModal = $("#emitenDetailModal");

  $.ajax({
    type: "POST",
    url: "/user/dividend/get_emiten_detail_confirm/",
    cache: false,
    data: data,
    success: function (data) {
      emitenDetailModal.find(".modal-body").html(data);
      emitenDetailModal.modal("show");
    },
  });
}
