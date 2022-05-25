@extends('admin.layout.master')
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h1 class="card-title-member">Member Trader</h1>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a href="{{ url('admin/member-trader/export-investor') }}"
                                                    class="btn btn-primary">Export Data</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table" id="tableMemberTrader">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="portofolio" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id='namaHeader'></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-content">
                        <div class="row justify-content-end">
                            <h3 class="mr-1"><i class="icon-wallet success"></i> <span id="totalSaldo"></span>
                            </h3>
                        </div>
                        <div class="row mb-1" id="totalPortofolio">
                        </div>
                        <div class="row" id="emitenPortofolio">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="detTrader" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id='titleDetHeader'></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-content">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Tempat, Tanggal Lahir</td>
                                    <td class="ttl"></td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td class="gender"></td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan</td>
                                    <td class="pekerjaan"></td>
                                </tr>
                                <tr>
                                    <td>Bank</td>
                                    <td class="bank"></td>
                                </tr>
                                <tr>
                                    <td>Account Number</td>
                                    <td class="accountNumber"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('public/admin') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('public/admin') }}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        loadData();

        function loadData() {
            var tableMemberTrader = $("#tableMemberTrader").DataTable({
                ajax: '{{ url('/admin/member-trader/fetch-data') }}',
                responsive: true,
                processing: true,
                serverSide: true,
                order: [
                    [0, "asc"]
                ],
                oLanguage: {
                    sProcessing: '<div id="tableloading" class="tableloading"></div>',
                    sZeroRecords: 'Data tidak tersedia'
                },
                columns: [{
                        data: "id",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: "name"
                    },
                    {
                        data: "email"
                    },
                    {
                        data: "phone"
                    },
                    {
                        data: "action",
                    },
                ]
            });
        }

        function formatRupiah(angka, prefix) {
            const currency = new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
            });
            return currency.format(angka);
        }

        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
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

        function detTrader(userid, name) {
            $.ajax({
                url: '{{ url('admin/member-trader') }}' + "/" + userid,
                type: "GET",
                beforeSend: function() {
                    $("#titleDetHeader").html(`Detail <b>${name}</b>`);
                },
                success: function(result) {
                    console.log(result);
                    if (result.data.birth_place != null && result.data.birth_date) {
                        $(".ttl").html(result.data.birth_place + ", " + tanggalIndo(result.data.birth_date));
                    } else {
                        $(".ttl").html("-");
                    }

                    if (result.data.gender != null) {
                        $(".gender").html(result.data.gender == "m" ? "Laki-Laki" : result.data.gender == "f" ?
                            "Perempuan" : "Tidak Diketahui");
                    } else {
                        $(".gender").html("-");
                    }

                    if (result.data.job != null) {
                        $(".pekerjaan").html(result.data.job);
                    } else {
                        $(".pekerjaan").html("-");
                    }

                    if (result.data.bank != null) {
                        $(".bank").html(result.data.bank);
                    } else {
                        $(".bank").html("-");
                    }

                    if (result.data.account_number1 != null) {
                        $(".accountNumber").html(result.data.account_number1);
                    } else {
                        $(".accountNumber").html("-");
                    }
                    $("#detTrader").modal("show");
                }
            })
        }

        function portofolio(userid, name) {
            $.ajax({
                url: '{{ url('admin/member-trader/fetch-portofolio') }}' + "/" + userid,
                type: "GET",
                dataType: "json",
                beforeSend: function() {
                    $("#namaHeader").html(`Portofolio <b>${name}</b>`);
                },
                success: function(result) {
                    const data = result.token;
                    console.log(data);
                    $("#totalSaldo").html(result.saldo);
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
                error: function(jqXHR, textStatus, errorThrown) {
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
        
    </script>
@endsection
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/admin') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
        integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .card-portofolio {
            border: 1px solid #eee;
        }

        .category-token {
            color: #292f8d;
            font-size: 1rem;
        }

        .title-token {
            font-weight: bold;
            color: black;
        }

        .company-token {
            font-size: 1rem;
            color: #858585;
        }

        .box-kinerja {
            border: 1px solid #eee;
            padding: 0;
            margin-bottom: 2rem;
        }

        .title-kinerja {
            padding: 0.7rem 0;
            background-color: #bf2d30 !important;
            color: #fff !important;
            border-color: #bf2d30;
            font-weight: bold;
            text-align: center;
            font-size: 1.2rem;
        }

        .value-kinerja {
            padding: 1rem 0;
            font-size: 1.5rem;
            text-align: center;
            font-weight: bold;
            color: black;
        }

        .empty-report {
            text-align: center;
        }

        .empty-report>img {
            max-width: 40%;
            margin-bottom: 3rem;
            margin-top: 3rem;
        }

        .card-home-title {
            padding: 1rem 4.5rem;
        }

        .card-home-title>.title-left>h2 {
            font-size: 2.3rem;
            font-weight: 600;
            color: #000;
            margin-right: 1em;
        }

        .card-home-title>.flex-div {
            display: flex;
        }

        .card-home-title>.flex-div>.button-group>label {
            border: 1px solid #bf2d30;
            padding: 6px 12px;
            cursor: pointer;
            color: #bf2d30;
            background-color: #fff;
            transition: all 0.2s;
            border-radius: 15px;
            font-size: 1.1em;
            margin-right: 0.5em;
        }

        .card-home-title>.flex-div>.button-group>input[name="market"] {
            display: none;
        }

        .card-home-title>.flex-div>.button-group>input[name="market"]:checked+label {
            background-color: #bf2d30;
            color: #fff;
        }

        .item-portofolio-sukuk {
            border: 1px solid #dadada;
            border-radius: 5px;
            padding: 0.8em;
        }

        .flex-head {
            display: flex;
        }

        .company-sukuks {
            width: 70%;
            margin: 0;
            font-size: 0.9em;
        }

        .label-item-portofolio-sukuk {
            background: #c7971e;
            color: #fff;
            font-weight: 600;
            width: 30%;
            text-align: center;
            height: 21px;
        }

        .title-sukuk-card {
            margin-top: 0.4em;
            font-weight: 400;
            font-size: 1.1em;
            margin-bottom: 0.2em;
        }

        .sukuk-id {
            color: #000;
            font-weight: 600;
            margin-bottom: 1.7em;
        }

        .sukuk-info>h4 {
            margin: 1.2em 0;
        }

        .title-sukuk-in-table {
            width: 60%;
        }

        .title-sukuk-in-table>p {
            margin-bottom: 0.4em;
            color: #000;
        }

        .value-sukuk-in-table {
            width: 40%;
        }

        .value-sukuk-in-table>p {
            margin-bottom: 0.4em;
            text-align: right;
            color: #000;
        }

        .item-portofolio {
            border: 1px solid #d4d4d4;
            border-radius: 5px;
        }

        .head-item-portofolio,
        .info-fund-portofolio {
            padding: 0.8em;
            border-bottom: 2px solid #f4f4f4;
        }

        .head-item-portofolio>.flex-head>p {
            margin: 0;
            color: #292f8d;
            font-size: 0.9em;
            width: 70%;
        }

        .label-item-portoflio-saham {
            background: #bf2d30;
            color: #fff;
            font-weight: 600;
            width: 30%;
            text-align: center;
            height: 21px;
        }

        .head-item-portofolio>h4 {
            font-size: 1.4em;
            font-weight: 600;
        }

        .head-item-portofolio>p {
            font-size: 0.9em;
            color: #858585;
            margin: 0;
        }

        .title-intable-saham {
            width: 70%;
            color: #000;
        }

        .value-intable-saham {
            width: 30%;
            color: #000;
            font-weight: 600;
        }

        .image-item-portofolio {
            padding: 0.8em;
        }

        .image-item-portofolio>img {
            width: 100%;
            height: 200px;
        }

        .card-content-sukuk {
            padding: 2em;
        }

        .sukuk-company {
            margin-top: 2em;
        }

        .trademark-sukuk {
            margin: 0;
            font-size: 1.1em;
            color: #000;
            font-weight: 400;
        }

        .code-sukuk {
            margin: 0;
            color: #000;
            font-size: 1.1em;
            font-weight: 600;
        }

        .info-split-sukuk {
            margin: 2em 0;
        }

        .item-info-sukuk>p {
            color: #000;
            margin: 0;
            font-size: 0.9em;
        }

        .item-info-sukuk>h3 {
            font-weight: 600;
            font-size: 2.1em;
        }

        .sukuk-company>h3 {
            font-weight: 600;
            margin: 0;
        }

        .sukuk-periode-title {
            margin: 0;
            color: #000;
            font-size: 0.8em;
        }

        .sukuk-periode-date {
            font-size: 10px;
            padding: 7px;
            border-radius: 4px;
        }

        .sukuk-table {
            margin-top: 2em;
        }

        .head-sukuk {
            background: #ededed;
            border-radius: 4px;
            color: #000;
        }

        @media screen and (max-width: 600px) {
            .mbv {
                visibility: hidden;
                clear: both;
                float: left;
                margin: 10px auto 5px 20px;
                width: 28%;
                display: none;
            }

            h4 {
                font-size: 1.2rem;
            }

            .title-intable-saham {
                width: 50%;
                color: #000;
            }

            .value-intable-saham {
                width: 50%;
                color: #000;
                font-weight: 600;
            }
        }

    </style>
@endsection
