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
                                    <h1 class="card-title-member">Daftar Bisnis</h1>
                                </div>
                                <div class="card-body">
                                    <form method="POST" id="formSubmitBisnis" enctype="multipart/form-data"
                                        class="wizard-circle" action="#">
                                        <h6>Identitas Calon Penerbit</h6>
                                        @include(
                                            'admin/pralisting/konfirmasi/identitas_calon_penerbit'
                                        )

                                        <h6>Informasi Finansial</h6>
                                        @include(
                                            'admin/pralisting/konfirmasi/informasi_finansial'
                                        )

                                        <h6>Informasi Non Finansial</h6>
                                        @include(
                                            'admin/pralisting/konfirmasi/informasi_non_finansial'
                                        )

                                        <h6>Lampiran Dokumen</h6>
                                        @include(
                                            'admin/pralisting/konfirmasi/lampiran_dokumen'
                                        )

                                        <h6>Media</h6>
                                        @include(
                                            'admin/pralisting/konfirmasi/media'
                                        )

                                        <h6>Syarat dan Ketentuan</h6>
                                        @include(
                                            'admin/pralisting/konfirmasi/syarat_dan_ketentuan'
                                        )

                                        <div class="col-md-12 row mt-2 mb-2 m-0">
                                            <div class="col-md-4 col-12">
                                                <a class="btn btn-block btn-info-ghost"
                                                    href="{{ url()->previous() }}">Kembali</a>
                                            </div>

                                            <?php if( $emiten->is_verified == 1 ) : ?>
                                            <div class="col-md-4 col-12">
                                                <a class="btn btn-block btn-danger font-link-white"
                                                    onclick="acceptPraListing('<?= $emiten->uuid ?>','0', 'Batalkan') ">Batalkan</a>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <a class="btn btn-block btn-info font-link-white"
                                                    onclick="acceptOfficial('<?= $emiten->uuid ?>','1') ">Jadikan
                                                    Penerbit Official</a>
                                            </div>
                                            <?php else: ?>
                                            <div class="col-md-4 col-12">
                                                <a class="btn btn-block btn-danger-ghost <?= $emiten->is_verified == 2 || $emiten->is_verified == 1 ? 'disabled' : '' ?>"
                                                    onclick="rejectPralisting('<?= $emiten->uuid ?>','2') ">Tolak</a>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <a class="btn btn-block btn-info font-link-white"
                                                    onclick="acceptPraListing('<?= $emiten->uuid ?>','1', 'Verifikasi') ">Konfirmasi
                                                    Pengajuan</a>
                                            </div>
                                            <?php endif; ?>

                                        </div>
                                    </form>
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
    <script src="{{ asset('public') }}/assets/js/jquery.steps.min.js"></script>
    <script src="{{ asset('public') }}/assets/js/jquery.validate.min.js"></script>
    <script src="{{ asset('public') }}/assets/js/flatpickr.min.js"></script>
    <script src="{{ asset('public') }}/assets/js/bootstrap.file-input.js"></script>
    <script src="{{ asset('public') }}/assets/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var form = $("#formSubmitBisnis").show();
        form.steps({
            headerTag: "h6",
            bodyTag: "fieldset",
            transitionEffect: "fade",
            enableAllSteps: true,
            enablePagination: false,
            titleTemplate: '<span class="step">#index#</span> #title#'
        });

        function acceptPraListing(uuid, status, status_title) {
            Swal.fire({
                text: status_title + ' bisnis ini ? ',
                type: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    var data = {
                        uuid,
                        status
                    };
                    $.ajax({
                        url: '{{ url('admin/pralisting/accept-pralisting') }}',
                        type: 'POST',
                        dataType: "json",
                        data: data,
                        timeout: 20000,
                        beforeSend: function() {
                            $("#loader").show();
                        },
                        success: function(data) {
                            $("#loader").hide();

                            if (data.msg == 200) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Berhasil ' + status_title + ' bisnis',
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    window.location = '{{ url('admin/pralisting') }}';
                                })
                            } else {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: 'Gagal ' + status_title + ' bisnis',
                                    type: 'warning',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    window.location = '{{ url('admin/pralisting') }}';
                                })
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if (textStatus === "timeout" || textStatus === "error") {
                                $("#loader").hide();
                                Swal.fire({
                                    title: 'Ooops...',
                                    text: "Mohon periksa koneksi internet anda",
                                    type: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Muat ulang',
                                    cancelButtonText: 'Tutup'
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
                                })
                            }
                        },
                        complete: function() {
                            $("#loader").hide();
                        }
                    });
                }
            })
        }

        function acceptOfficial(uuid, status) {
            Swal.fire({
                text: 'Jadikan Penerbit Official ? ',
                type: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    var data = {
                        uuid,
                        status
                    };
                    $.ajax({
                        url: '{{ url('admin/pralisting/accept-official') }}',
                        type: 'POST',
                        dataType: "json",
                        data: data,
                        timeout: 20000,
                        beforeSend: function() {
                            $("#loader").show();
                        },
                        success: function(data) {
                            $("#loader").hide();

                            if (data.msg == 200) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Berhasil verifikasi bisnis',
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    window.location = '{{ url('admin/pralisting') }}';
                                })
                            } else {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: 'Gagal verifikasi bisnis',
                                    type: 'warning',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    window.location = '{{ url('admin/pralisting') }}';
                                })
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if (textStatus === "timeout" || textStatus === "error") {
                                $("#loader").hide();
                                Swal.fire({
                                    title: 'Ooops...',
                                    text: "Mohon periksa koneksi internet anda",
                                    type: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Muat ulang',
                                    cancelButtonText: 'Tutup'
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
                                })
                            }
                        },
                        complete: function() {
                            $("#loader").hide();
                        }
                    });
                }
            })
        }

        function rejectPralisting(uuid, status) {
            Swal.fire({
                title: "Tolak Bisnis",
                text: 'Masukan alasan penolakan bisnis',
                input: 'text',
                showCancelButton: true,
                confirmButtonText: 'Ya, Tolak',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                preConfirm: (input) => {
                    if (input === '') {
                        Swal.showValidationMessage('alasan penolakan tidak boleh kosong')
                    } else {
                        var data = {
                            uuid,
                            status,
                            input
                        };

                        $.ajax({
                            url: '{{ url('admin/pralisting/accept-pralisting') }}',
                            type: 'POST',
                            dataType: "json",
                            data: data,
                            timeout: 20000,
                            success: function(data) {
                                $("#loader").hide();

                                if (data.msg == 200) {
                                    Swal.fire({
                                        title: 'Berhasil',
                                        text: 'Penolakan bisnis berhasil dilakukan',
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Ok'
                                    }).then((result) => {
                                        window.location = '{{ url('admin/pralisting') }}';
                                    })
                                } else {
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: 'Penolakan bisnis gagal dilakukan',
                                        type: 'warning',
                                        showCancelButton: false,
                                        confirmButtonText: 'Ok'
                                    })
                                }
                            },
                            error: function(data) {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: 'Penolakan bisnis gagal dilakukan',
                                    type: 'warning',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok'
                                })
                            }
                        });
                    }
                }

            });
        }
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('public') }}/assets/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
        integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
