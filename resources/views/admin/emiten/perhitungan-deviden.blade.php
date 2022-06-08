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
                                    <h1 class="card-title-member">Perhitungan Dividen</h1>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table" id="tabel">
                                                <thead>
                                                    <tr>
                                                        {{-- <th>Owner</th> --}}
                                                        <th>#</th>
                                                        <th>Nama Perusahaan</th>
                                                        <th>Nama Brand</th>
                                                        <th>Kode</th>
                                                        <th>Kategori</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0; ?>
                                                    @for ($i = 0; $i < count($emiten); $i++)
                                                        <?php $no++; ?>
                                                        <tr>
                                                            {{-- <td>{{$item->trader_id}}</td> --}}
                                                            <td>{{ $no }}</td>
                                                            <td>{{ $emiten[$i]['company_name'] }}</td>
                                                            <td>{{ $emiten[$i]['trademark'] }}</td>
                                                            <td>{{ $emiten[$i]['code_emiten'] }}</td>
                                                            <td>{{ $emiten[$i]['ktg'] }}</td>
                                                            <td>
                                                                <button type="button" id="btnDetail"
                                                                    data-id="{{ $emiten[$i]['id'] }}"
                                                                    class="btn btn-primary">
                                                                    Detail
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endfor
                                                </tbody>
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

    <div class="modal fade" id="detailData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Perhitungan Dividen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-4">
                        <div class="form-group">
                            <label><strong>Periode</strong></label>
                            <select class="custom-select" onchange="pilihTahap()" id="tahap_dividen"></select>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th colspan="2">Periode</th>
                                <th>Laba/Rugi Setelah Pajak</th>
                            </tr>
                        </thead>
                        <tbody id="loadDataDividen"></tbody>
                        <tbody>
                            <tr>
                                <th colspan="2">Total Laba / Rugi</th>
                                <th>Rp</th>
                                <th id="totalNetProfit"></th>
                            </tr>
                            <tr>
                                <th colspan="2">Laba Ditahan</th>
                                <th></th>
                                <th>
                                    <input type="text" id="laba_ditahan" class="form-control ribuan" value="0" />
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2">Presentase Dividen</th>
                                <th><span id="presentaseDividen"></span> % </th>
                                <th id="habisPersen"></th>
                            </tr>
                            <tr>
                                <th colspan="4"></th>
                            </tr>
                            <tr>
                                <th colspan="2">Dividen untuk masyarakat</th>
                                <th>Rp</th>
                                <th id="dividenMasyarakat"></th>
                            </tr>
                            <tr>
                                <th colspan="2">Nilai Penawaran</th>
                                <th>Rp</th>
                                <th id="nilaiPenawaran"></th>
                            </tr>
                            <tr>
                                <th colspan="2">Pesan Saham Dilepas</th>
                                <th> % </th>
                                <th id="sahamDilepas"></th>
                            </tr>
                            <tr>
                                <th colspan="2">Yield Dividen</th>
                                <th> % </th>
                                <th id="yielDividen"></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="sendEmail()">Kirim Email</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('admin') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('admin') }}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"
        integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#tabel').DataTable({
                responsive: true,
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.5.3/dist/cleave.min.js"></script>
    <script>
        document.querySelectorAll('.ribuan2').forEach(inp => new Cleave(inp, {
            numeral: true,
            numeralDecimalMark: ',',
            delimiter: '.'
        }));
    </script>
    <script>
        var tahun = '';
        var totalNetProfit = 0;
        var emiten_id = '';
        let yielDividen = 0;
        var totalAfterLaba = 0;
        var totalPersen = 0;
        var penawaranSaham = 0;
        var dividen = 0;
        $('body').on('click', '#btnDetail', function() {
            var data_id = $(this).data('id');
            emiten_id = $(this).data('id');
            getTahapDividen(data_id);
            $("#detailData").modal('show');
        });

        function pilihTahap() {
            var tahap_dividen = $("#tahap_dividen").val();
            $("#laba_ditahan").val(0);
            getPeriode(emiten_id, tahap_dividen);
            sumDataNet(tahap_dividen, emiten_id);
        }

        function getTahapDividen(emiten_id){
            $.ajax({
                url: "{{ url('admin/perhitungan-dividen/list-tahap') }}"+'/'+emiten_id,
                type: 'GET',
                beforeSend: function() {
                    $("#loader").show();
                },
                success: function(res) {
                    $("#loader").hide();
                    var tahaps = "";
                    var no = 0;
                    res.data.forEach(e => {
                        no++;
                        tahaps += '<option value="'+e.devidend_date+'">Periode '+no+' '+ (e.devidend_date == '' ? 'on going' : '' )+'</option>';
                    });
                    $("#tahap_dividen").html(tahaps);
                }
            });
        }

        function getPeriode(emiten_id, tgl){
            $.ajax({
                url: "{{ url('admin/perhitungan-dividen/interval-periode') }}",
                data: {
                    devidend_date: tgl,
                    emiten_id: emiten_id,
                },
                type: 'GET',
                beforeSend: function() {
                    $("#loader").show();
                },
                success: function(result) {
                    $("#loader").hide();
                    let listData = "";
                    let no = 0;
                    result.data.forEach((e, index)  => {
                        if(index != 0){
                            var tahun = e.split("-");
                            bulanBaru = tahun[1];
                            if(tahun[1] != "10"){
                                bulanBaru = tahun[1].replace("0", "");
                            }
                            no++;
                            listData += '<tr><td>'+no+'</td>'+
                                '<td>'+getBulanName(e)+'</td>'+
                                '<td id="tahun'+bulanBaru+''+tahun[0]+'">'+tahun[0]+'</td>'+
                                '<td id="netProfit'+bulanBaru+''+tahun[0]+'">'+getDetail(emiten_id, bulanBaru, tahun[0], bulanBaru+''+tahun[0])+'</td></tr>';
                        }
                    });
                    $("#loadDataDividen").html(listData);
                }
            })
        }

        function getDetail(emiten_id, bulan, tahun, idLabel) {
            $.ajax({
                url: "{{ url('admin/penerbit/perhitungan-detail') }}",
                type: 'GET',
                data: {
                    bulan: bulan,
                    tahun: tahun,
                    emiten_id: emiten_id
                },
                success: function(res) {
                    let net_profit = "-";
                    if (res.data != null) {
                        net_profit = res.data.net_profit;
                        $("#netProfit" + idLabel).html(formatRupiah(net_profit));
                    } else {
                        $("#netProfit" + idLabel).html("-");
                    }
                }
            });
        }

        function sumDataNet(devidend_date, emiten_id) {
            $.ajax({
                url: "{{ url('admin/penerbit/sum-net-profit') }}",
                type: 'GET',
                data: {
                    devidend_date: devidend_date,
                    emiten_id: emiten_id
                },
                success: function(res) {
                    if(res.avg_general_share_amount != null){
                        dividen = parseInt(res.avg_general_share_amount);
                    }
                    if(res.avg_capital_needs != null){
                        penawaranSaham = parseInt(res.avg_capital_needs);
                    }

                    totalNetProfit = parseInt(res.totalNetProfit)
                    $("#totalNetProfit").html(formatRupiah(res.totalNetProfit));

                    hitungData(0, dividen, totalNetProfit, penawaranSaham, yielDividen);
                }
            });
        }

        function formatRupiah(angka) {
            const format = angka.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
            return format;
        }

        $("#laba_ditahan").keyup(function(){
            var getLaba = this.value;
            // getLaba.replaceAll('.', '');
            // console.log(getLaba);
            var labaDitahan = parseInt(getLaba);
            hitungData(labaDitahan, dividen, totalNetProfit, penawaranSaham, yielDividen);
        });

        function hitungData(labaDitahan, dividen, totalNetProfit, penawaranSaham, yielDividen) {
            totalAfterLaba = totalNetProfit - labaDitahan;
            totalPersen = dividen * totalAfterLaba / 100;
            console.log("laba "+labaDitahan);
            console.log("net "+totalNetProfit);
            console.log("persen "+dividen)
            console.log("dividen "+totalPersen);
            $("#presentaseDividen").html(dividen.toFixed(2));
            $("#habisPersen").html(formatRupiah(totalPersen));
            $("#dividenMasyarakat").html(formatRupiah(totalPersen));
            $("#nilaiPenawaran").html(formatRupiah(penawaranSaham));
            $("#sahamDilepas").html(dividen.toFixed(2));
            if(penawaranSaham == 0){
                yielDividen = 0;
            }else{
                yielDividen = totalPersen / penawaranSaham * 100;
            }
            $("#yielDividen").html(yielDividen.toFixed(2));
        }

        function getBulanName(bulanTanggal) {
            let listBulan = [
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
            let bt = bulanTanggal.split("-");

            let bulan = "";
            if(bt[1] == "01"){
                bulan = listBulan[0];
            }
            if(bt[1] == "02"){
                bulan = listBulan[1];
            }
            if(bt[1] == "03"){
                bulan = listBulan[2];
            }
            if(bt[1] == "04"){
                bulan = listBulan[3];
            }
            if(bt[1] == "05"){
                bulan = listBulan[4];
            }
            if(bt[1] == "06"){
                bulan = listBulan[5];
            }
            if(bt[1] == "07"){
                bulan = listBulan[6];
            }
            if(bt[1] == "08"){
                bulan = listBulan[7];
            }
            if(bt[1] == "09"){
                bulan = listBulan[8];
            }
            if(bt[1] == "10"){
                bulan = listBulan[9];
            }
            if(bt[1] == "11"){
                bulan = listBulan[10];
            }
            if(bt[1] == "12"){
                bulan = listBulan[11];
            }
            return bulan;
        }

        function sendEmail() {
            Swal.fire({
                title: "Konfirmasi ?",
                text: "Pastikan perhitungan dividend telah sesuai dan benar !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya Sudah Benar"
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: '{{ url("admin/perhitungan-dividen/send-email") }}',
                        type: 'POST',
                        data: {
                            emiten_id: emiten_id,
                            dividend: totalPersen
                        },
                        beforeSend: function() {
                            $("#loader").show();
                        },
                        success: function(result) {
                            $("#loader").hide();
                            Swal.fire(
                                'Berhasil!',
                                result.message,
                                'success'
                            );
                        }
                    });
                }
            });
        }

    </script>
@endsection
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
        integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public') }}/app-assets/yearpicker/yearpicker.css" />
@endsection
