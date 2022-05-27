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
                                    <h2><strong>Tambah Broadcast Notification</strong></h2>
                                </div>
                                <div class="card-body">
                                    <form id="formBroadcasting" enctype="multipart/form-data" class="wizard-circle">
                                        <input type="hidden" name="type" id="type"
                                            value="<?= isset($type) ? $type : '' ?>" />
                                        <input type="hidden" name="broadcast_id" id="broadcast_id"
                                            value="<?= isset($broadcast['id']) ? $broadcast['id'] : '' ?>" />
                                        <input type="hidden" id="storage" value="{{ config('global.STORAGE_BUCKET') }}" />
                                        <input type="hidden" id="token" value="{{ '?token=' . Session::get('token') }}" />

                                        <h6>Target User</h6>
                                        @include(
                                            'admin.crm._broadcasting._target-user'
                                        )

                                        <h6>Konten</h6>
                                        @include('admin.crm._broadcasting._konten')

                                        <h6>Preview</h6>
                                        @include(
                                            'admin.crm._broadcasting._preview'
                                        )
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
        $(document).ready(function() {
            $("#input_select_5").select2({
                placeholder: "Contoh: Sleman",
                closeOnSelect: false,
                allowClear: true,
                delay: 250, // wait 250 milliseconds before triggering the request
                ajax: {
                    url: "{{ url('admin/get-regency') }}",
                    dataType: "json",
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(data) {
                        var results = [];
                        $.each(data, function(index, item) {
                            results.push({
                                id: item.name,
                                text: item.name,
                                value: item.name
                            })
                        })
                        return {
                            results: results
                        };
                    }
                }
            });

            $("#input_select_6").select2({
                placeholder: "Contoh: Yogyakarta",
                closeOnSelect: false,
                allowClear: true,
                delay: 250, // wait 250 milliseconds before triggering the request
                ajax: {
                    url: "{{ url('admin/get-provinsi') }}",
                    dataType: "json",
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(data) {
                        var results = [];
                        $.each(data, function(index, item) {
                            results.push({
                                id: item.name,
                                text: item.name,
                                value: item.name
                            })
                        })
                        return {
                            results: results
                        };
                    }
                }
            });

            $("#input_select_7").select2({
                placeholder: "Contoh: PT. Jogja",
                closeOnSelect: false,
                allowClear: true,
                delay: 250, // wait 250 milliseconds before triggering the request
                ajax: {
                    url: "{{ url('emiten/fetch-emiten') }}",
                    dataType: "json",
                    data: function(params) {
                        return {
                            emiten: params.term
                        };
                    },
                    processResults: function(data) {
                        console.log(data);
                        var results = [];
                        $.each(data, function(index, item) {
                            results.push({
                                id: item.id,
                                text: item.company_name,
                                value: item.company_name
                            })
                        })
                        return {
                            results: results
                        };
                    }
                }
            });

            $("#input_select_14").select2({
                placeholder: "Contoh: 3.4.5",
                closeOnSelect: false,
                allowClear: true,
                delay: 250, // wait 250 milliseconds before triggering the request
                ajax: {
                    type: 'POST',
                    url: "{{ url('admin/crm/get-version') }}",
                    dataType: "json",
                    data: {
                        type: 'android'
                    },
                    processResults: function(data) {
                        var results = [];
                        $.each(data, function(index, item) {
                            results.push({
                                id: item.code,
                                text: item.code,
                                value: item.code
                            })
                        })
                        return {
                            results: results
                        };
                    }
                }
            });

            $("#input_select_15").select2({
                placeholder: "Contoh: 3.4.5",
                closeOnSelect: false,
                allowClear: true,
                delay: 250, // wait 250 milliseconds before triggering the request
                ajax: {
                    type: 'POST',
                    url: "{{ url('admin/crm/get-version') }}",
                    dataType: "json",
                    data: {
                        type: 'ios'
                    },
                    processResults: function(data) {
                        var results = [];
                        $.each(data, function(index, item) {
                            results.push({
                                id: item.code,
                                text: item.code,
                                value: item.code
                            })
                        })
                        return {
                            results: results
                        };
                    }
                }
            });

            $("#input_select_16").select2({
                placeholder: "Contoh: user@gmail.com",
                closeOnSelect: false,
                allowClear: true,
                delay: 250, // wait 250 milliseconds before triggering the request
                ajax: {
                    url: "{{ url('admin/crm/fetch-user-email') }}",
                    dataType: "json",
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(data) {
                        var results = [];
                        $.each(data, function(index, item) {
                            results.push({
                                id: item.email,
                                text: item.email,
                                value: item.email
                            })
                        })
                        return {
                            results: results
                        };
                    }
                }
            });

            $("#btnSubmitTarget").click(function(event) {
                //stop submit the form, we will post it manually.
                event.preventDefault();

                var url = "{{ url('admin/crm/store-target') }}";

                var type = $('#type').val();
                console.log(type);

                if (type == 'update') {
                    url = "{{ url('admin/crm/update-target') }}";
                }
                var form = $("#formTargetUser")[0];
                var data = new FormData(form);

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: "json",
                    data: data,
                    cache: false,
                    async: true,
                    processData: false,
                    contentType: false,
                    timeout: 60000, // sets timeout to 20 seconds
                    beforeSend: function() {
                        $("#loader").show();
                    },
                    success: function(data) {
                        $("#loader").hide();
                        if (data.msg == 200) {
                            window.location = "{{ url('admin/crm/target-user') }}";
                        } else {
                            Swal.fire({
                                title: 'Gagal',
                                text: data.message,
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'Ok'
                            });
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
            });

        });

        $("#select_perusahaan").click(function() {
            $("#input_select_7 > option").prop("selected", "selected");
            $("#input_select_7").trigger("change");
        });

        $('.input_7 input[type="radio"]').click(function() {
            const select = document.getElementById('input_7_select');
            const radio = document.getElementById('input_7_radio');
            const radio_delete = document.getElementById('input_7_radio_delete');

            if ($(this).val() == 1) {
                select.classList.remove('hidden');
                radio.classList.add('hidden');
                radio_delete.classList.add('hidden');
            } else {
                select.classList.add('hidden');
                radio.classList.remove('hidden');
                radio_delete.classList.remove('hidden');
            }
        });

        $('.input_10 input[type="radio"]').click(function() {
            const select = document.getElementById('input_10_range');
            const radio = document.getElementById('input_10_radio');

            if ($(this).val() == 'Range') {
                select.classList.remove('hidden');
                radio.classList.add('hidden');
            } else {
                select.classList.add('hidden');
                radio.classList.remove('hidden');
            }
        });

        function changeKondisi() {
            const kondisiSelect = document.getElementById('kondisi');
            const kondisi = document.getElementById('kondisi_' + kondisiSelect.value);
            const input = document.getElementById('input_' + kondisiSelect.value);
            const result = document.getElementById('result_' + kondisiSelect.value);
            console.log(kondisiSelect.value);
            kondisi.classList.remove('hidden');
            input.classList.remove('hidden');

            if (kondisiSelect.value != 10 && kondisiSelect.value != 7) {
                input.classList.add('content-center', 'justify-content-between');
            }

            result.classList.add('hidden');
        }

        function removeKondisi(no) {
            const p = document.getElementById('kondisi_' + no);
            p.classList.add('hidden');
            $("#target_" + no).val('');
            $("#kondisi").val("").change();
        };

        function editKondisi(no) {
            const result = document.getElementById('result_' + no);
            const input = document.getElementById('input_' + no);
            result.classList.add('hidden');
            input.classList.remove('hidden');
            if (no != 10 && no != 7) {
                input.classList.add('content-center', 'justify-content-between');
            }

            $("#kondisi").val("").change();
        };

        function submitKondisi(no, type) {
            const result = document.getElementById('result_' + no);
            const input = document.getElementById('input_' + no);
            result.classList.remove('hidden');
            input.classList.add('hidden');
            input.classList.remove('content-center', 'justify-content-between');

            var el = 'input_' + no;

            if (type == 'radio') {
                $("#target_" + no).val($('[class="' + el + '"]:checked').val());
                text = $('[class="' + el + '"]:checked').next('label').html();
                $("#el_" + no).html(text);
            }

            if (type == 'range') {
                const start = $('#input_' + no + '_start').val();
                const end = $('#input_' + no + '_end').val();
                text = start + ' - ' + end;

                $("#target_" + no).val(text);
                $("#el_" + no).html(text);
            }

            if (type == 'select') {
                var text = $('#input_' + no + ' option:selected').toArray().map(item => item.text).join();
                var value = $('#input_' + no + ' option:selected').toArray().map(item => item.value).join();

                $("#target_" + no).val(value);
                $("#el_" + no).html(text);
            }

            $("#kondisi").val("").change();
        };

        var form = $("#formBroadcasting").show();
        form.steps({
            headerTag: "h6",
            bodyTag: "fieldset",
            transitionEffect: "fade",
            enableAllSteps: false,
            enablePagination: true,
            autoFocus: true,
            titleTemplate: '<span class="step">#index#</span> #title#',
            onStepChanging: function(event, currentIndex, newIndex) {

                if (currentIndex == 0 && newIndex == 1) {
                    var data = new FormData(this);

                    $.ajax({
                        url: "{{ url('admin/crm/store-target') }}",
                        type: 'POST',
                        dataType: "json",
                        data: data,
                        cache: false,
                        async: true,
                        processData: false,
                        contentType: false,
                        timeout: 60000, // sets timeout to 20 seconds
                        beforeSend: function() {
                            $("#loader").show();
                        },
                        success: function(data) {
                            $("#loader").hide();
                            if (data.msg == 200) {
                                $(".broadcast_target_group_id").val(data.id);
                                return true;
                            } else {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: data.msg.message,
                                    type: 'warning',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok'
                                });
                                return false;
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
                                return false;
                            }
                        },
                        complete: function() {
                            $("#loader").hide();
                        }
                    });
                }

                if (currentIndex == 1 && newIndex == 2) {

                    var data = new FormData(this);

                    console.log(data);

                    $.ajax({
                        url: "{{ url('admin/crm/save-konten') }}",
                        type: 'POST',
                        dataType: "json",
                        data: data,
                        cache: false,
                        async: true,
                        processData: false,
                        contentType: false,
                        timeout: 60000, // sets timeout to 20 seconds
                        beforeSend: function() {
                            $("#loader").show();
                        },
                        success: function(data) {
                            if (data.msg == 200) {
                                $("#broadcast_id").val(data.broadcast_id);
                                $("#type").val('update');

                                $.each(data.list, function(index, value) {
                                    if (index == '0') {
                                        $("#id").val(value.broadcast_target_group_id);
                                    }

                                    $('#preview_title_' + index).html(value.title);
                                    $('#preview_content_' + index).html(value.content
                                        .substring(0, 200));
                                    $('#preview_image_' + index).attr("src", value.image);
                                    $('#filename_' + index).val(value.file_name);
                                });

                                $("#target_list_preview").html('');
                                $.each(data.target, function(index, value) {
                                    $("#target_list_preview").append(`
                            <div class="col-md-3">
                                <div class="card border border-light rounded">
                                    <div class="card-body">
                                        <h4 class="card-title">${value.name}</h4>
                                        <p class="card-text">${value.params}</p>
                                    </div>
                                </div>
                            </div>
                            `);
                                });

                                $("#target_user_preview").html('');
                                $.each(data.users, function(index, value) {
                                    $("#target_user_preview").append(
                                        `<li class="list-group-item">${value}</li>`);
                                });

                                return true;
                            } else {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: data.msg.message,
                                    type: 'warning',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok'
                                });
                                return false;
                            }
                            $("#loader").hide();
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
                                return false;
                            }
                        },
                        complete: function() {
                            $("#loader").hide();
                        }
                    });
                }

                // Allways allow previous action even if the current form is not valid!
                // if (currentIndex > newIndex) {
                //     return true;
                // }
                // Needed in some cases if the user went back (clean up)
                if (currentIndex < newIndex) {
                    // To remove error styles
                    form.find(".body:eq(" + newIndex + ") label.error").remove();
                    form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                }
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinishing: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                Swal.fire({
                    title: 'Publish Broadcast Notification',
                    text: 'Notification akan dikirim sesuai target user dan tanggal / jam yang telah di set. ',
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.value) {
                        var data = new FormData(this);

                        $.ajax({
                            url: "{{ url('admin/crm/save-publish') }}",
                            type: 'POST',
                            dataType: "json",
                            data: data,
                            cache: false,
                            async: true,
                            processData: false,
                            contentType: false,
                            timeout: 60000, // sets timeout to 20 seconds
                            beforeSend: function() {
                                $("#loader").show();
                            },
                            success: function(data) {
                                $("#loader").hide();
                                window.location = '{{ url("admin/crm/broadcasting") }}';

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
            },
            labels: {
                finish: "Publish",
                next: "Selanjutnya",
                previous: "Sebelumnya",
                loading: "Loading ..."
            }
        })
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
