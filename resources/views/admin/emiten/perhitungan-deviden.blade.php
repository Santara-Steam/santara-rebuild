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
                                        <div>
                                            <input type="text" placeholder="Pilih Tahun..." id="yearpicker"
                                                class="form-control col-4 mb-2" />
                                        </div>
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
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th colspan="2">Periode</th>
                                <th>Laba/Rugi Setelah Pajak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Januari</td>
                                <td id="tahun1"></td>
                                <td id="netProfit1"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Februari</td>
                                <td id="tahun2"></td>
                                <td id="netProfit2"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Maret</td>
                                <td id="tahun3"></td>
                                <td id="netProfit3"></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>April</td>
                                <td id="tahun4"></td>
                                <td id="netProfit4"></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Mei</td>
                                <td id="tahun5"></td>
                                <td id="netProfit5"></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Juni</td>
                                <td id="tahun6"></td>
                                <td id="netProfit6"></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Juli</td>
                                <td id="tahun7"></td>
                                <td id="netProfit7"></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Agustus</td>
                                <td id="tahun8"></td>
                                <td id="netProfit8"></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>September</td>
                                <td id="tahun9"></td>
                                <td id="netProfit9"></td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Oktober</td>
                                <td id="tahun10"></td>
                                <td id="netProfit10"></td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>November</td>
                                <td id="tahun11"></td>
                                <td id="netProfit11"></td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>Desember</td>
                                <td id="tahun12"></td>
                                <td id="netProfit12"></td>
                            </tr>
                            <tr>
                                <th colspan="2">Total Laba / Rugi</th>
                                <th>Rp</th>
                                <th id="totalNetProfit"></th>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('public/admin') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('public/admin') }}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
    <script src="{{ asset('public') }}/app-assets/yearpicker/yearpicker.js"></script>
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
    <script>
        var tahun = '';
        var totalNetProfit = 0;
        $('body').on('click', '#btnDetail', function() {
            var data_id = $(this).data('id');
            console.log(tahun);
            if(tahun == null){
                alert("Tahun harap dipilih");
            }else{
                $("#detailData").modal('show');
                for (var i = 1; i <= 12; i++) {
                    getDetail(data_id, i, tahun);
                }
                sumDataNet(tahun, data_id);
            }
        });

        function getDetail(emiten_id, bulan, tahun) {
            $.ajax({
                url: "{{ url('admin/penerbit/perhitungan-detail') }}",
                type: 'GET',
                data: {
                    bulan: bulan,
                    tahun: tahun,
                    emiten_id: emiten_id
                },
                success: function(res) {
                    $("#tahun" + bulan).html(tahun);
                    let net_profit = "-";
                    if (res.data != null) {
                        net_profit = res.data.net_profit;
                        totalNetProfit = totalNetProfit + parseInt(res.data.net_profit);
                        $("#netProfit" + bulan).html(formatRupiah(net_profit));
                    } else {
                        $("#netProfit" + bulan).html("-");
                    }
                }
            });
        }

        function sumDataNet(tahun, emiten_id) {
            $.ajax({
                url: "{{ url('admin/penerbit/sum-net-profit') }}",
                type: 'GET',
                data: {
                    tahun: tahun,
                    emiten_id: emiten_id
                },
                success: function(res) {
                    let dividen = 0;
                    let penawaranSaham = 0;
                    let yielDividen = 0;
                    if(res.data.avg_general_share_amount != null){
                        dividen = parseInt(res.data.avg_general_share_amount);
                    }
                    if(res.data.avg_capital_needs != null){
                        penawaranSaham = parseInt(res.data.avg_capital_needs);
                    }
                    $("#totalNetProfit").html(formatRupiah(res.data.total));
                    
                    var totalPersen = dividen * parseInt(res.data.total) / 100;
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
            });
        }

        $('#yearpicker').yearpicker({
            onShow: null,
            onHide: null,
            onChange: function(value) {
                tahun = value;
            }
        });

        function formatRupiah(angka) {
            const format = angka.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
            return format;
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
        href="{{ asset('public/admin') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public') }}/app-assets/yearpicker/yearpicker.css" />
@endsection
