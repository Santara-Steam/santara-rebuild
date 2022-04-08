@extends('admin.layout.master')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">Dividend</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-tambah-tab" data-toggle="pill" href="#pills-tambah" role="tab" aria-controls="pills-tambah" aria-selected="true">
                                                <span class="d-none d-lg-block">Tambah Dividend</span>
                                                <span class="d-lg-none">Tambah</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-data-tab" data-toggle="pill" href="#pills-data" role="tab" aria-controls="pills-data" aria-selected="false">
                                                <span class="d-none d-lg-block">Data Riwayat Dividend</span>
                                                <span class="d-lg-none">Riwayat</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade" id="pills-tambah" role="tabpanel" aria-labelledby="pills-tambah-tab">
                                            <form id="formAddDividend">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="code_emiten"><b>ID Saham</b></label>
                                                            <select name="code_emiten" id="code_emiten" style="width: 100%">
                                                                <option value="">Pilih...</option>
                                                                @foreach($emitens as $v)
                                                                    <option data-id="{{ $v->uuid }}" value="{{ $v->code_emiten }}">{{ $v->code_emiten }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span id="code_emiten_error" class="text-danger"></span>
                                                        </div>
                                                        <input type="hidden" name="emiten_uuid" id="emiten_uuid" class="form-control">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="trademark"><b>Nama PT</b></label>
                                                                    <input type="text" name="company_name" id="company_name" class="form-control" readonly>
                                                                    <span id="company_name_error" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="company_name"><b>Nama Brand</b></label>
                                                                    <input type="text" name="trademark" id="trademark" class="form-control" readonly>
                                                                    <span id="trademark_error" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="phase"><b>Tahap Dividend</b></label>
                                                                    <select name="phase" id="phase" class="form-control">
                                                                        @foreach (range(1, 1000) as $i)
                                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span id="phase_error" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="date"><b>Tanggal Dividend</b></label>
                                                                    <select name="date" id="date" class="form-control">
                                                                        @foreach (range(1, 31) as $i)
                                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span id="date_error" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="month"><b>Bulan Dividend</b></label>
                                                                    <select name="month" id="month" class="form-control">
                                                                        @foreach ($bulans as $k => $v)
                                                                            <option value="{{ $k }}">{{ $v }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span id="month_error" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="year"><b>Tahun Dividend</b></label>
                                                                    <select name="year" id="year" class="form-control">
                                                                        @foreach (range(2019, 2100) as $i)
                                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span id="year_error" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="amount"><b>Total Dividend</b></label>
                                                                    <input type="text" name="amount" id="amount" class="form-control" onkeypress="return isNumberKey(event)">
                                                                    <span id="amount_error" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                
                                                            <div class="col-md-6" style="margin-top: 2rem">
                                                                <div class="form-group">
                                                                    <button type="button" id="generateDividend" class="btn btn-block btn-primary" onclick="confirmGenerateDividend()">
                                                                        Generate Pembagian Dividend
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div id="dividend-container" style="display:none; border-top:1px dashed #ddd" class="mt-1">
                                                            <table class="table table-borderless mb-2" style="font-size:12px; border:0">
                                                                <tr>
                                                                    <td colspan="3" style="font-size:13px"><b>Pembagian Dividen<b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b><span id="dividend_detail_code_emiten"></span></b></td>
                                                                    <td><b>Pembagian Tahap <span id="dividend_detail_phase"></span></b></td>
                                                                    <td><b>Nilai Dividen</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b><span id="dividend_detail_trademark"></span></b></td>
                                                                    <td><b><span id="dividend_detail_date"></span></b></td>
                                                                    <td><b style="color:red">Rp <span id="dividend_detail_amount"></span></b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3"><b><span id="dividend_detail_code_emiten"></span></b></td>
                                                                </tr>
                                                            </table>
                                                            <table class="table table-hover dataTable-table" id="datatableDividend" class="display" cellspacing="0">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="border-top-0">Nama</th>
                                                                        <th class="border-top-0">Lembar Saham</th>
                                                                        <th class="border-top-0">Persentase Saham</th>
                                                                        <th class="border-top-0">Dividen Diterima</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                            
                                                            <button type="button" id="saveDividend" class="btn btn-block btn-primary mt-3" onclick="confirmSaveDividend()">
                                                                Simpan
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        {{-- History Dividen --}}
                                        <div class="tab-pane active show fade" id="pills-data" role="tabpanel" aria-labelledby="pills-data-tab">
                                            <div class="table-responsive">
                                                <table class="table" id="tableHistoryDividen"> 
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Tanggal</th>
                                                            <th>ID Saham</th>
                                                            <th>Nama PT</th>
                                                            <th>Nama Brand</th>
                                                            <th>Tahap</th>
                                                            <th>Aksi</th>
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
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="{{asset('public/admin')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{asset('public/admin')}}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    var tableHistoryDividen = $("#tableHistoryDividen").DataTable({
        ajax: '{{ url("/admin/get_history_dividend") }}',
        responsive: true,
        order: [[0, "asc"]],
        columns: [
            {
                data: "id",
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: "updated_at"
            },
            {
                data: "code_emiten"
            },
            {
                data: "company_name"
            },
            {
                data: "trademark"
            },
            {
                data: "phase"
            },
            {
                data: "aksi"
            },
        ]
    });

    $(document).ready(function() {
        $('#code_emiten').select2();

        const amount = document.getElementById("amount");
        if (amount) {
            amount.addEventListener("keyup", function (e) {
            this.value = formatRupiah(parseInt(this.value.replace(/\./g, "")))
                .slice(3)
                .slice(0, -3);
            });
        }

        $("#code_emiten").change(function (e) {
            $("#datatableDividend").DataTable().clear().draw();
            $("#dividend-container").css("display", "none");

            var emiten_uuid = $(this).find(":selected").attr("data-id");
            if (emiten_uuid != "" && emiten_uuid != undefined) {
                $.ajax({
                url: "{{ url('admin/get_dividen_by_uuid') }}",
                method: "GET",
                data: {
                    emiten_uuid: emiten_uuid
                },
                timeout: 20000, // sets timeout to 20 seconds
                beforeSend: function () {
                    $("#loader").show();
                },
                success: function (data) {
                    data = data.data;
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
            }).change();
    });
</script>
@endsection

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="{{asset('public/admin')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection