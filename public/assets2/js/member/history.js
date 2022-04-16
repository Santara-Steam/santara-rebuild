$(document).ready(function () {
  $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
    return {
      iStart: oSettings._iDisplayStart,
      iEnd: oSettings.fnDisplayEnd(),
      iLength: oSettings._iDisplayLength,
      iTotal: oSettings.fnRecordsTotal(),
      iFilteredTotal: oSettings.fnRecordsDisplay(),
      iPage: Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
      iTotalPages: Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength),
    };
  };

  var table = $("#datatable").DataTable({
    buttons: ["print", "csv"],
    initComplete: function () {
      var api = this.api();
      $("#mytable_filter input")
        .off(".DT")
        .on("keyup.DT", function (e) {
          if (e.keyCode == 13) {
            api.search(this.value).draw();
          }
        });
    },
    search: {
      caseInsensitive: false,
    },
    scrollX: true,
    oLanguage: {
      sProcessing: '<div id="tableloading" class="tableloading"></div>',
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: "/user/history/get_histories",
      type: "POST",
      data: function (data) {
        data.filter = $("#filter").val();
      },
    },
    order: [[2, "desc"]],
    rowCallback: function (row, data, iDisplayIndex) {
      var info = this.fnPagingInfo();
      var page = info.iPage;
      var length = info.iLength;
      var index = page * length + (iDisplayIndex + 1);
      $("td:eq(0)", row).html(index);
    },
  });

  $("#filter").change(function () {
    table.draw();
  });
});

function detailHistory(uuid, activity, information1, information2, information3, information4, status) {
  var info2 = activity == "Withdraw" || activity == "Deposit" ? "Nama Bank" : "Nama Brand";
  var info3,
    info4 = "";

  if (activity == "Pembelian Saham Perdana") {
    info3 = "Nominal yang Harus Dibayar";
  } else if (activity == "Withdraw") {
    info3 = "Nomor Rekening";
    info4 = "Nominal yang diajukan";
  } else if (activity == "Deposit") {
    info4 = "Nominal";
  } else if (activity == "Dividen" || activity == "Pencairan Dividen") {
    info3 = "Nominal";
    if (activity == "Pencairan Dividen") {
      info4 = "Dicairkan ke";
    }
    if (activity == "Dividen") {
      info4 = "Nominal";
    }
  } else if (activity == "Pembelian Saham Sekunder" || activity == "Penjualan Saham Sekunder") {
    info3 = "Nominal";
  }

  information3 = info3 == "Nomor Rekening" ? information3 : formatRupiah(parseInt(information3));
  var template =
    `<table class="table table-borderless; history-detail">
            <tbody>
              <tr>
                <td>` +
    info2 +
    `</td>
                <td>:</td>
                <td>` +
    information2 +
    `</td>
              </tr>
              <tr>
                <td>` +
    info3 +
    `</td>
                <td>:</td>
                <td>` +
    information3 +
    `</td>
              </tr>
            </tbody>
          </table>`;

  if ((activity == "Deposit" || activity == "Dividen") && info4 == "Nominal") {
    information4 = formatRupiah(parseInt(information4));
    var template =
      `<table class="table table-borderless; history-detail">
        <tbody>
            <tr>
            <td>` +
      info2 +
      `</td>
            <td>:</td>
            <td>` +
      information2 +
      `</td>
            </tr>
            <tr>
            <td>` +
      info4 +
      `</td>
            <td>:</td>
            <td>` +
      information4 +
      `</td>
            </tr>
        </tbody>
        </table>`;
  }

  if (activity == "Withdraw" || activity == "Pencairan Dividen") {
    information4 = info4 == "Nominal yang diajukan" ? formatRupiah(parseInt(information4)) : information4;

    template =
      `<table class="table table-borderless; history-detail">
            <tbody>
              <tr>
                <td>` +
      info2 +
      `</td>
                <td>:</td>
                <td>` +
      information2 +
      `</td>
              </tr>
              <tr>
                <td>` +
      info3 +
      `</td>
                <td>:</td>
                <td>` +
      information3 +
      `</td>
              </tr>
              <tr>
                <td>` +
      info4 +
      `</td>
                <td>:</td>
                <td>` +
      information4 +
      `</td>
              </tr>
            </tbody>
          </table>`;
  }

  Swal.fire({
    title: "<strong> " + activity + "</strong>",
    html: template,
  });
}
