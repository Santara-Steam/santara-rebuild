$(document).ready(function () {
  datatableMemberTrader();
});

function datatableMemberTrader() {
  $("#datatable").DataTable({
    processing: true,
    serverSide: true,
    order: [
      [0, "asc"]
    ],
    destroy: true,
    ajax: {
      url: "/member-trader/data",
      type: "POST",
    },
    scrollX: true,
    oLanguage: {
      sProcessing: '<div id="tableloading" class="tableloading"></div>',
      sZeroRecords: "Data tidak tersedia",
    },
    searchDelay: 1500,
    columnDefs: [{
      targets: [4],
      orderable: false,
    }, ],
  });
}

function resetSaldo(traderid, name) {

  Swal.fire({
    html: `<h3 class="mt-2"> Reset saldo ${ name}</h3>`,
    showCancelButton: true,
    showCloseButton: true,
    showConfirmButton: true,
    confirmButtonText: "Ya",
    cancelButtonText: "Tidak",
  }).then((result) => {
    if (result.value === true) {
      $.ajax({
        url: `/member-trader/resetSaldo/${traderid}`,
        type: 'get',
        beforeSend: () => {
          $("#loader").show();
        },
        success: function (data) {
          data = JSON.parse(data);
          if (data.status) {
            $("#loader").hide();
            Swal.fire({
              title: "Berhasil",
              text: data.data.message,
              type: "success",
              showCancelButton: false,
              confirmButtonText: "Ok",
            }).then((result) => {
              if (result.value) {
                datatableMemberTrader();
              }
            });
          } else {
            $("#loader").hide();
            Swal.fire({
              title: "Gagal",
              text: data.error[0].message,
              type: "error",
              showCancelButton: false,
              confirmButtonText: "Ok",
            }).then((result) => {
              if (result.value) {
                datatableMemberTrader();
              }
            });
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
              })
              .then((result) => {
                if (result.value) {
                  location.reload();
                }
              });
          }
        },
      })
    }
  });
}

function portofolio(userid, name) {
  $.ajax({
    url: `/member-trader/portofolio/${userid}`,
    type: "GET",
    dataType: "json",
    beforeSend: function () {
      $("#namaHeader").html(`Portofolio <b>${name}</b>`);
    },
    success: function (data) {
      let total = "";
      let emiten = "";

      if (data.status != undefined) {
        if (data.status == false) {
          Swal.fire("Error!", data.error[0].message, "error");
        }
      } else {
        if (data.data.length != 0) {
          total += `<div class="col-xl-4 col-lg-4 col-12 text-center">
                        <div class="shadow mb-1" style="background-color: #BF2D30; border-radius:5px; border: 1px solid">
                                <div class="p-1 ">
                                    <div class="inner">
                                        <p style="color: white;">TOTAL SAHAM</p>
                                        <h3 style="color: white;">${formatRupiah(
            data.total_saham,
            "Rp"
          )}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-12 text-center">
                            <div class="shadow mb-1" style="background-color: #C7971E; border-radius:5px; border: 1px solid">
                                <div class="p-1 ">
                                    <div class="inner">
                                        <p style="color: white;">TOTAL SUKUK</p>
                                        <h3 style="color: white;">${formatRupiah(
            data.total_sukuk,
            "Rp"
          )}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-12 text-center">
                            <div class="shadow mb-1" style="background-color: #28d094; border-radius:5px; border: 1px solid">
                                <div class="p-1 ">
                                    <div class="inner">
                                        <p style="color: white;">TOTAL</p>
                                        <h3 style="color: white;">${formatRupiah(
            data.total,
            "Rp"
          )}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>`;

          for (let i = 0; i < data.data.length; i++) {
            if (data.data[i].type == "saham") {
              emiten += `<div class="col-xl-6 col-lg-6 col-12" style="margin-bottom: 1em;">
                            <div class="item-portofolio">
                                <div class="head-item-portofolio">
                                    <div class="flex-head">
                                        <p>${data.data[i].category}</p>
                                        <div class="label-item-portoflio-saham">SAHAM</div>
                                    </div>
                                    <h4>${data.data[i].trademark}</h4>
                                    <p class="company-portofolio">${data.data[i].company_name
                }</p>
                                </div>
                                <div class="info-fund-portofolio">
                                    <table style="width: 100%;">
                                         <tr>
                                            <td class="title-intable-saham">Tanggal Pembelian</td>
                                            <td class="value-intable-saham">${tanggalIndo(
                  data.data[i].trx_date
                )}</td>
                                        </tr>
                                        <tr>
                                            <td class="title-intable-saham">
                                                <p>Total Saham</p>
                                            </td>
                                            <td class="value-intable-saham">
                                                <p><b>${formatNumber(
                  data.data[i].jumlah_saham
                )} Lembar</b></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="title-intable-saham">Total Saham Dalam Rupiah</td>
                                            <td class="value-intable-saham"><b>${formatRupiah(
                  data.data[i].total_saham,
                  "Rp"
                )}</b></td>
                                        </tr>
                                       
                                       
                                    </table>
                                </div>
                            </div>
                        </div>`;
            } else {
              emiten = `<div class="col-xl-6 col-lg-6 col-12" style="margin-bottom: 1em;">
                            <div class="item-portofolio-sukuk">
                                <div class="head-item-portofolio" style="padding: 0;">
                                    <div class="flex-head">
                                        <p class="company-sukuks"><b>${data.data[i].company_name
                }</b></p>
                                        <div class="label-item-portofolio-sukuk">SUKUK</div>
                                    </div>
                                    <h4 class="title-sukuk-card">${data.data[i].trademark
                }</h4>
                                    <p class="sukuk-id">${data.data[i].code}</p>
                                </div>
                                <div class="sukuk-info">
                                    <h4><b>Informasi Sukuk</b></h4>
                                    <hr style="border-top: 2px solid rgba(0, 0, 0, .1);" />
                                    <table style="width: 100%;">
                                        <tr>
                                            <td class="title-sukuk-in-table">
                                                <p>Sukuk ID</p>
                                            </td>
                                            <td class="value-sukuk-in-table">
                                                <p><b>${data.data[i].code
                }</b></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="title-sukuk-in-table">
                                                <p>Total Unit Dalam Rupiah</p>
                                            </td>
                                            <td class="value-sukuk-in-table">
                                                <p><b>${formatRupiah(
                  data.data[i].total_sukuk,
                  "Rp"
                )}</b></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="title-sukuk-in-table">
                                                <p>Total Unit</p>
                                            </td>
                                            <td class="value-sukuk-in-table">
                                                <p><b>${formatNumber(
                  data.data[i].jumlah_sukuk
                )} Kupon</b></p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>`;
            }
          }

          $("#totalPortofolio").html(total);
          $("#emitenPortofolio").html(emiten);
        } else {
          $("#totalPortofolio").html(
            '<div class="col-12 text-center"><b>Data portofolio kosong</b></div>'
          );
          $("#emitenPortofolio").html("");
        }
        $("#portofolio").modal("show");
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
  });
}