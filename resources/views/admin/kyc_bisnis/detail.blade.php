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
                                    <h1 class="card-title-member">{{ $title }}</h1>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements"></div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <ul class="nav nav-justified mb-3" id="pills-tab" role="tablist">
                                            <?php foreach ($tab as $key => $value): 
                                                if($value->status == 'kustodian_verifying'){
                                                    $icon = 'la-check red';
                                                }else if($value->status == 'verifying'){
                                                    $icon = 'la-stopwatch red';
                                                }else if($value->status == 'verified'){
                                                    $icon = 'la-check-double red';
                                                }else{
                                                    $icon = 'la-times-circle red';
                                                }
                                                ?>
                                            <li class="nav-item member-nav">
                                                <a class="nav-link member-nav-link <?= $key == 1 ? 'active' : '' ?>"
                                                    id="pills-<?= $value->page ?>-tab" data-toggle="tab"
                                                    href="#pills-<?= $value->page ?>" role="tab"
                                                    aria-controls="pills-<?= $value->page ?>" aria-selected="true">
                                                    <span>
                                                        <i style="font-size: 1.2rem; margin-right: 0;"
                                                            class="las <?= $icon ?>"></i>
                                                        <?= $value->title ?>
                                                    </span>
                                                </a>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>

                                        <div class="tab-content" id="pills-tabContent">
                                            <?php foreach ($kyc as $key => $value): ?>
                                            <div class="tab-pane fade show <?= $key == 1 ? 'active' : '' ?>"
                                                id="pills-<?= $value->page ?>" role="tabpanel"
                                                aria-labelledby="pills-<?= $value->page ?>-tab">
                                                <input type="hidden" id="trader_uuid" value="<?= $value->uuid ?>" />
                                                <input type="hidden" id="kyc_url"
                                                    value="<?= $action == 'edit' ? $update_url : $confirm_url ?>" />
                                                <input type="hidden" id="last_kyc_submission_id"
                                                    value="<?= $value->data ? $value->data->last_kyc_submission_id : '' ?>" />
                                                <form
                                                    id="<?= $action == 'edit' ? 'formKycUpdate' . $key : 'formKycConfirm' . $key ?>">

                                                    @include('admin/kyc_bisnis/_detail/'.$value->page, [
                                                        'data' => $value->data,
                                                        'address' => $action == 'edit' ? $kyc['address'] : null,
                                                    ])

                                                    @include('admin/kyc_bisnis/footer_confirm', [
                                                        'is_empty' => $value->data ? false : true,
                                                        'data' => $value->data,
                                                        'key' => $key,
                                                        'status' => $tab->$key->status,
                                                    ])
                                                </form>
                                            </div>
                                            <?php endforeach; ?>
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

    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-body text-center">
                <img onClick='rotateMe()' name="popup_image" id="popup_image" class='rotateimg' style="max-height: 700px;max-width: 770px;" src="">
                <hr/>
                <small><b>* Klik pada gambar untuk memutar posisi gambar</b></small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-santara-white btn-block" data-dismiss="modal" >Tutup</button>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('public') }}/assets/js/jquery.steps.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            validateComfirm();
        });

        $(document).on("keyup", ".required-form-kyc", function() {
            validateComfirm();
        });

        $(".number-tab-steps").steps({
            headerTag: "h6",
            bodyTag: "fieldset",
            transitionEffect: "slideLeft",
            enableAllSteps: true,
            enablePagination: false,
            titleTemplate: '<span class="step">#index#</span> #title#'
        });

        $('.radioUtama').change(function() {
            let value = $(this).attr('value');
            let name = $(this).attr('name');
            document.getElementById("error_" + name).disabled = false;
            document.getElementById("error_" + name).classList.add("required-form-kyc");
            if (value == 1) {
                document.getElementById("error_" + name).value = '';
                document.getElementById("error_" + name).disabled = true;
                document.getElementById("error_" + name).classList.remove("required-form-kyc");
                document.getElementById(name+"_option_ditolak").classList.add("hidden");
            }
            if(value == 0){
                document.getElementById(name+"_option_ditolak").classList.remove("hidden");
            }
            validateComfirm();
        });

        $('.radio-tolak').change(function() {
            let value = $(this).attr('value');
            let id = $(this).attr('id');
            let radioTolakID = id.split("-");
            console.log(radioTolakID);
            document.getElementById("error_" + radioTolakID[0]).value = value;
            validateComfirm();
        });

        $(document).on("click", ".open-imageDialog", function() {
            var image = $(this).data('image');
            $('#popup_image').attr('src', image);
        })

        function btnVerify(title, text, url, uuid, phase) {
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
                    var data = {
                        uuid: uuid,
                        phase: phase
                    };

                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: "json",
                        data: data,
                        success: function(data) {
                            $("#loader").hide();
                            if (data.msg == 200) {
                                Swal.fire('Berhasil', title + ' berhasil dilakukan.', 'success').then((
                                    result) => {
                                    location.reload();
                                });
                            } else {
                                $("#loader").hide();
                                Swal.fire("Error!", title + ' gagal melakukan', "error");
                            }
                        },
                        error: function(msg) {
                            $("#loader").hide();
                            Swal.fire("Error!", title + ' gagal melakukan', "error");
                        }
                    });
                }
            })
        }

        function btnUnverify(title, text, url, uuid) {
            Swal.fire({
                title: "Batalkan KYC Bisnis",
                text: 'Masukan alasan pembatalan KYC',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Ok',
                showLoaderOnConfirm: true,
                preConfirm: (input) => {
                    if (input === '') {
                        Swal.showValidationMessage('alasan penolakan tidak boleh kosong')
                    } else {
                        $("#loader").show();
                        var data = {
                            uuid: uuid,
                            reason: input
                        };

                        $.ajax({
                            url: url,
                            type: 'POST',
                            dataType: "json",
                            data: data,
                            success: function(data) {
                                $("#loader").hide();
                                if (data.msg == 200) {
                                    Swal.fire("Success!", 'Penolakan data KYC berhasil dilakukan.',
                                        "success").then((result) => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire("Error!", title + ' gagal melakukan', "error");
                                }
                            },
                            error: function(msg) {
                                $("#loader").hide();
                                Swal.fire("Error!", title + ' gagal melakukan', "error");
                            }
                        });
                    }
                }
            })
        }

        function btnReject(url, uuid, phase) {
            Swal.fire({
                title: "Tolak KYC",
                text: 'Masukan alasan penolakan KYC',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Ok',
                showLoaderOnConfirm: true,
                preConfirm: (input) => {
                    if (input === '') {
                        Swal.showValidationMessage('alasan penolakan tidak boleh kosong')
                    } else {
                        $("#loader").show();
                        var data = {
                            uuid: uuid,
                            phase: phase,
                            reason: input
                        };

                        $.ajax({
                            url: url,
                            type: 'POST',
                            dataType: "json",
                            data: data,
                            success: function(data) {
                                $("#loader").hide();
                                if (data.msg == 200) {
                                    Swal.fire("Success!", 'Penolakan data KYC berhasil dilakukan.',
                                        "success").then((result) => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire("Error!", title + ' gagal melakukan', "error");
                                }
                            },
                            error: function(msg) {
                                $("#loader").hide();
                                Swal.fire("Error!", title + ' gagal melakukan', "error");
                            }
                        });
                    }
                }
            })
        }

        function detailPhoto(title, photo) {
            Swal.fire({
                title: "<strong> " + title + " </strong>",
                html: "<img onClick='rotateMe()' class='swal2-image rotateimg' src=" + photo +
                    "><br /><p>* Klik pada gambar untuk memutar posisi gambar</p>",
                customClass: 'swal-wide'
            });
        };

        var degrees = 0;

        function rotateMe() {
            degrees += 90;

            $('.rotateimg').css({
                'transform': 'rotate(' + degrees + 'deg)',
                '-ms-transform': 'rotate(' + degrees + 'deg)',
                '-moz-transform': 'rotate(' + degrees + 'deg)',
                '-webkit-transform': 'rotate(' + degrees + 'deg)',
                '-o-transform': 'rotate(' + degrees + 'deg)'
            });
        };

        function btnConfirm(key) {
            $("#loader").show();
            var actionurl = document.getElementById('kyc_url').value;
            var form = '#formKycConfirm' + key;
            var kyc = $(form).serializeArray();
            var user = {
                trader_uuid: document.getElementById('trader_uuid').value,
                step_id: key,
                last_kyc_submission_id: document.getElementById('last_kyc_submission_id').value
            };

            var dataKyc = {
                kyc,
                user
            };

            $.ajax({
                url: actionurl,
                type: 'POST',
                cache: false,
                data: dataKyc,
                success: function(data) {
                    $("#loader").hide();
                    data = JSON.parse(data);
                    if (data.msg == 200) {
                        Swal.fire(
                            'Berhasil',
                            'Konfirmasi KYC berhasil dilakukan',
                            'success'
                        ).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Error!", data.msg, "error");
                    }
                },
                error: function(data) {
                    $("#loader").hide();
                    Swal.fire("Error!", data.msg, "error");
                }
            });
        };

        function validateComfirm() {
            $(".submit-form-kyc").prop('disabled', true);
            var requiredAllCompleted = true;
            $('.required-form-kyc').each(function() {
                if ($(this).val() == "") requiredAllCompleted = false;
            });
            if (requiredAllCompleted) $(".submit-form-kyc").prop("disabled", false);
        }
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
        integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
