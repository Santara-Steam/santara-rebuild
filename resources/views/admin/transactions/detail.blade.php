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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Detail Transaksi</h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table class="table table-hover">
                                        <tr>
                                            <td>Nama</td>
                                            <td>: {{ $transaction->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>: {{ $transaction->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>: {{ $transaction->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td>Token</td>
                                            <td>: {{ $transaction->code_emiten }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Token</td>
                                            <td>: {{ decimalFormat($stock) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Harga Token</td>
                                            <td>: {{ rupiah($stock_price) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Fee</td>
                                            <td>: {{ rupiah($transaction->fee) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Total Bayar</td>
                                            <td>: {{ $transaction->amount + $transaction->fee }}</td>
                                        </tr>
                                        <tr>
                                            <td>Waktu</td>
                                            <td>:
                                                {{ tgl_indo(date('Y-m-d', strtotime($transaction->created_at))).'
                                                '.formatJam($transaction->created_at) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pembayaran</td>
                                            <td>: {{ $channel }}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>:
                                                @if($status_transaction == 1)
                                                <div class="badge badge-secondary badge-md">Belum Konfirmasi</div>
                                                @elseif($status_transaction == 2)
                                                <div class="badge badge-warning badge-md">Menunggu Konfirmasi</div>
                                                @elseif ($status_transaction == 3)
                                                <div class="badge badge-success badge-md">Lunas</div>
                                                @elseif ($status_transaction == 4)
                                                <div class="badge badge-danger badge-md">Kadaluarsa</div>
                                                @else
                                                <div class="badge badge-secondary badge-md">Belum Konfirmasi</div>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="mb-2 p-1"
                                        style="background: #eee; border: 1px solid #bbb; color: black; border-radius: 5px">
                                        <b>Catatan</b>: <br />
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            @if($transaction->is_verified == 0)
                                            <button
                                                onclick="confirm('Konfirmasi Transaksi', 'Konfirmasi transaksi pembayaran ?', '{{ url('admin/transaction/confirm/'.$transaction->uuid) }}')"
                                                class="btn btn-primary btn-block mt-0" {{ $channel=='BANKTRANSFER' ||
                                                $channel=='VA' ? 'disabled' : '' }}>Konfirmasi
                                            </button>
                                            @else
                                            <button
                                                onclick="confirm('Pembatalan Transaksi', 'Pembatalan konfirmasi pembayaran ?', '{{ url('admin/transaction/cancel_confirm/'.$transaction->uuid) }}')"
                                                class="btn btn-primary btn-block">Batal
                                            </button>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <button
                                                onclick="remove('{{ url('admin/transaction/delete_transaction') }}', '{{ $transaction->id }}')"
                                                class="btn btn-danger btn-block">Hapus
                                            </button>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ url()->previous() }}"
                                                class="btn btn-warning btn-block">Kembali</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xl-6 col-md-12 text-center">
                        @if($transaction->channel == 'BANKTRANSFER')
                        @if($transaction->verification_photo)
                        <p>{{ $verification_photo_jwt }}</p>
                        @else
                        <div class='alert alert-warning'>
                            <span>Belum upload bukti pembayaran.</span>
                            <br />
                        </div>

                        <form id="formSubmitPhoto" enctype="multipart/form-data">
                            <input type="hidden" name="transaction_uuid" value="{{ $transaction->uuid }}">
                            <div class="form-group" style="margin-bottom: 1rem;margin-top: 1rem;">
                                <input type="file" name="verification_photo" id="verification_photo"
                                    class="form-control-file" accept="image/*">
                                <div id="errorBlockVerificationPhoto" class="help-block"
                                    style="padding:10px; margin: 10px 0"></div>
                            </div>
                            <div class="row">
                                <div class="text-left col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block">Upload</button>
                                </div>
                            </div>
                        </form>
                        @endif
                        @endif
                    </div> --}}
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('public/admin')}}/app-assets/file-input/bootstrap.file-input.js"></script>
<script>
    $(document).ready(function() {
    $("input[type='file']").fileinput({
        'showUpload': false,
        'previewFileType': 'image'
    });
});

function detailVerificationPhoto(photo) {

    Swal.fire({
        title: "<strong> Bukti Transaksi</strong>",
        imageUrl: photo,
        imageAlt: 'screenshot'
    });
};

$(document).ready(function() {
    $("#verification_photo").fileinput({
        'allowedFileExtensions': ["jpg", "jpeg", "gif", "png"],
        'showUpload': false,
        'maxFileCount': 1,
        'maxFileSize': 10000,
        'showPreview': true,
        'elErrorContainer': "#errorBlockVerificationPhoto"
    });
})

function confirm(title, text, link) {
    Swal.fire({
        title: title,
        text: text,
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $("#loader").show();
            $.ajax({
                type: 'GET',
                url: link,
                cache: false,
                success: function(data) {
                    $("#loader").hide();
                    data = JSON.parse(data);
                    if (data.msg == 200) {
                        Swal.fire("Success!", capitalizeFirstLetter(title) + ' berhasil dilakukan.',
                            "success").then((result) => {
                            window.location = '/user/transactions';
                        });
                    } else {
                        Swal.fire("Error!", capitalizeFirstLetter(title) + ' gagal dilakukan.',
                            "error").then((result) => {
                            location.reload();
                        });
                    }
                },
                error: function(data) {
                    $("#loader").hide();
                    Swal.fire("Error!", 'Permintaan gagal diproses !', "error");
                }
            });
        }
    })
}

function remove(link, trId) {
    Swal.fire({
        title: 'Apakan anda yakin ?',
        text: 'Data yang sudah dihapus tidak dapat dikembalikan!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $("#loader").show();
            $.ajax({
                type: 'POST',
                url: link,
                data: {id: trId},
                cache: false,
                success: function(data) {
                    $("#loader").hide();
                    data = JSON.parse(data);
                    if (data.msg == 200) {
                        Swal.fire("Success!", 'Data berhasil dihapus.', "success").then((
                            result) => {
                            window.location = '/admin/transactions';
                        });
                    } else {
                        Swal.fire("Error!", "Data gagal dihapus!", "error");
                    }
                },
                error: function() {
                    $("#loader").hide();
                    Swal.fire("Error!", "Data gagal dihapus!", "error");
                }
            });
        }
    })
}

$("#formSubmitPhoto").on('submit', function(e) {
    e.preventDefault();
    var data = new FormData(this);
    $("#loader").show();
    $.ajax({
        url: '/user/uploadadminkonfirmasi',
        type: 'POST',
        dataType: 'json',
        data: data,
        contentType: false,
        processData: false,
        success: function(data) {
            $("#loader").hide();
            if (data.msg == 401) {
                window.location = '/login/logout';
            }

            if (data.msg == 200) {
                Swal.fire("Success!", 'Upload bukti pembayaran berhasil dilakukan.', "success")
                    .then((result) => {
                        location.reload();
                    });
            } else {
                Swal.fire("Error!", 'Permintaan gagal diproses !', "error").then((result) => {
                    location.reload();
                });
            }
        },
        error: function(data) {
            $("#loader").hide();
            Swal.fire("Error!", 'Permintaan gagal diproses !', "error");
        }
    });
})
</script>
@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('public/admin')}}/app-assets/file-input/fileinput.css" />
@endsection