const profit_min = document.getElementById('profit_min');
const profit = document.getElementById('profit');
const begin_period = document.getElementById('begin_period');
const price = document.getElementById('price');
const supply = document.getElementById('supply');
const total = document.getElementById('total');
const max_investors = document.getElementById('max_investors');
const share_amount = document.getElementById('share_amount');
const code_emiten = document.getElementById('code_emiten');
const minimum_invest = document.getElementById('minimum_invest');

$(document).ready(function () {
    const counter_profile = document.getElementById('counter');

    $("#begin_period").flatpickr({
        enableTime: true,
        altFormat: "Y-m-d H:i",
        dateFormat: "Y-m-d H:i",
        minDate: "today"
    });

    $("#end_period").flatpickr({
        enableTime: true,
        altFormat: "Y-m-d H:i",
        dateFormat: "Y-m-d H:i"
    });

    $("#profit_min").keyup(function () {
        if (Number($(this).val()) < Number(profit.value)) {
            $("#profit_error").css("display", "none");
            $(".submit-form").prop('disabled', false);
        } else {
            $("#profit_error").css("display", "block");
            $(".submit-form").prop('disabled', true);
        }
    });

    $("#profit").keyup(function () {
        if (Number($(this).val()) > Number(profit_min.value)) {
            $("#profit_error").css("display", "none");
            $(".submit-form").prop('disabled', false);
        } else {
            $("#profit_error").css("display", "block");
            $(".submit-form").prop('disabled', true);
        }
    });

    $("#pictures").fileinput({
        'allowedFileExtensions': ["jpg", "jpeg", "gif", "png"],
        'showUpload': false,
        'showPreview': false,
        'maxFileCount': 10,
        'maxFileSize': 10000,
        'elErrorContainer': "#errorBlockPictures"
    });

    $("#prospektus").fileinput({
        'allowedFileExtensions': ["pdf"],
        'showUpload': false,
        'showPreview': false,
        'maxFileCount': 1,
        'maxFileSize': 25000,
        'elErrorContainer': "#errorBlockProspektus"
    });

    $('#trader_id').select2({
        placeholder: "Contoh: nama@mail.com",
        minimumInputLength: 3,
        allowClear: true,
        delay: 250, // wait 250 milliseconds before triggering the request
        ajax: {
            url: '/user/emitens/get_owner',
            dataType: "json",
            data: function (params) {
                return {
                    trader: params.term
                };
            },
            processResults: function (data) {
                var results = [];
                $.each(data, function (index, item) {
                    results.push({
                        id: item.id,
                        text: item.owner,
                        value: item.id
                    })
                })
                return {
                    results: results
                };
            }
        },
        language: {
            inputTooShort: function () {
                return 'Masukan minimal 3 huruf';
            }
        }
    });

    $('#regency_id').select2({
        placeholder: "Contoh: Yogyakarta",
        minimumInputLength: 3,
        allowClear: true,
        delay: 250, // wait 250 milliseconds before triggering the request
        ajax: {
            url: '/user/emitens/get_regency',
            dataType: "json",
            data: function (params) {
                return {
                    regency: params.term
                };
            },
            processResults: function (data) {
                var results = [];
                $.each(data, function (index, item) {
                    results.push({
                        id: item.id,
                        text: item.name,
                        value: item.id
                    })
                })
                return {
                    results: results
                };
            }
        },
        language: {
            inputTooShort: function () {
                return 'Masukan minimal 3 huruf';
            }
        }
    });

    var counter = counter_profile.value;
    $("#addTeam").click(function () {
        var newProfileTeam = $(document.createElement('div')).attr({
            class: 'row',
            id: "profile_team_" + counter
        });
        newProfileTeam.className = 'row';

        newProfileTeam.html(
            '<div class="form-group col-md-6">' +
            '<label>Nama</label>' +
            '<input type="text" class="form-control" name="profile_team[' + counter + '][nama_team]" id="nama_team_' + counter + '" minlength="5" placeholder="Contoh: Nama Satu"/>' +
            '<span id="nama_team_error" class="text-danger"></span>' +
            '</div>' +
            '<div class="form-group col-md-6">' +
            '<label>Jabatan</label>' +
            '<input type="text" class="form-control" name="profile_team[' + counter + '][jabatan_team]" id="jabatan_team_' + counter + '" minlength="5" placeholder="Contoh: Jabatan Satu"/>' +
            '<span id="jabatan_team_error" class="text-danger"></span>' +
            '</div>');

        newProfileTeam.appendTo("#profile_team_box");
        counter++;
    });

    $("#removeTeam").click(function () {
        if (counter > 1) {
            counter--;
            $("#profile_team_" + counter).remove();
        }
    });
});


begin_period.addEventListener('change', function () {
    if ($("#end_period").attr("disabled")) {
        $('#end_period').removeAttr("disabled");
    }

    var beginDate = new Date(begin_period.value);
    beginDate.setDate(beginDate.getDate());
    var endDate = new Date(beginDate);
    endDate.setDate(endDate.getDate() + 60);

    flatpickr('#end_period', {
        enableTime: true,
        minDate: beginDate,
        maxDate: endDate,
        altInput: true,
        altFormat: "Y-m-d H:i",
        dateFormat: "Y-m-d H:i"
    });
});


code_emiten.addEventListener('keyup', function (e) {
    code_emiten.value = code_emiten.value.toUpperCase();
});

price.addEventListener('keyup', function (e) {
    if ('abcdefghijklmnopqrstuvwxyz'.split('').includes(e.key)) {
        price.value = price.value.slice(0, -1);
    } else {
        price.value = formatRupiah(parseInt(price.value.replace(/\./g, ''))).slice(3).slice(0, -3);

        const supply_value = parseInt(supply.value.replace(/\./g, ''));

        if (!isNaN(parseInt(price.value.replace(/\./g, '')))) {
            supply.value = formatRupiah(supply_value).slice(3).slice(0, -3);
            total.value = supply_value * parseInt(price.value.replace(/\./g, ''));
            total.value = formatRupiah(parseInt(total.value.replace(/\./g, ''))).slice(3).slice(0, -3);
        }

        // if (supply.value != '') {
        //     if (!isNaN(supply_value)) {
        //         minimum_invest.value = (supply_value > 0) ? (supply_value > 300) ? Math.floor(supply_value / 300) : 1 : 0;
        //         minimum_invest.value = formatRupiah(parseInt(minimum_invest.value.replace(/\./g, ''))).slice(3).slice(0, -3);
        //     } else {
        //         minimum_invest.value = 0;
        //     }
        // } else {
        //     minimum_invest.value = 0;
        // }
    }
});

supply.addEventListener('keyup', function (e) {
    if ('abcdefghijklmnopqrstuvwxyz'.split('').includes(e.key)) {
        supply.value = supply.value.slice(0, -1);
    } else {
        const supply_value = parseInt(supply.value.replace(/\./g, ''));

        if (!isNaN(supply_value)) {
            supply.value = formatRupiah(supply_value).slice(3).slice(0, -3);
            total.value = supply_value * parseInt(price.value.replace(/\./g, ''));
            total.value = formatRupiah(parseInt(total.value.replace(/\./g, ''))).slice(3).slice(0, -3);
        }

        // if (supply.value != '') {
        //     if (!isNaN(supply_value)) {
        //         minimum_invest.value = (supply_value > 0) ? (supply_value > 300) ? Math.floor(supply_value / 300) : 1 : 0;
        //         minimum_invest.value = formatRupiah(parseInt(minimum_invest.value.replace(/\./g, ''))).slice(3).slice(0, -3);
        //     } else {
        //         minimum_invest.value = 0;
        //     }
        // } else {
        //     minimum_invest.value = 0;
        // }
    }
});

max_investors.addEventListener('keyup', function (e) {
    if ('abcdefghijklmnopqrstuvwxyz'.split('').includes(e.key)) {
        max_investors.value = max_investors.value.slice(0, -1);
    } else {
        max_investors.value = formatRupiah(parseInt(max_investors.value.replace(/\./g, ''))).slice(3).slice(0, -3);
    }
});

share_amount.addEventListener('keyup', function (e) {
    if ('abcdefghijklmnopqrstuvwxyz'.split('').includes(e.key)) {
        share_amount.value = share_amount.value.slice(0, -1);
    } else {
        share_amount.value = formatRupiah(parseInt(share_amount.value.replace(/\./g, ''))).slice(3).slice(0, -3);
    }
});
minimum_invest.addEventListener('keyup', function (e) {
    if ('abcdefghijklmnopqrstuvwxyz'.split('').includes(e.key)) {
        minimum_invest.value = minimum_invest.value.slice(0, -1);
    } else {
        minimum_invest.value = formatRupiah(parseInt(minimum_invest.value.replace(/\./g, ''))).slice(3).slice(0, -3);
    }
});


$("#formSubmitEmitten").on('submit', function (e) {
    e.preventDefault();

    if ($("#end_period").attr("disabled")) {
        $('#end_period').removeAttr("disabled");
    }

    var data = new FormData(this);

    dataPicture = [];
    dataPicture.unshift(cover[0]);
    dataPicture.unshift(logo[0]);
    
    for(const data in produk){
        dataPicture.push(produk[data])
    }

    for (let index = 0; index < dataPicture.length; index++) {
        const element = dataPicture[index];
        data.append('pictures[]', element);
    }

    if (Object.keys(produk).length >= 3 && cover.length == 1 &&  logo.length == 1 ) {
        $.ajax({
            url: '/user/emitens/create',
            type: 'POST',
            dataType: "json",
            data: data,
            cache: false,
            async: true,
            processData: false,
            contentType: false,
            timeout: 60000, // sets timeout to 20 seconds
            beforeSend: function () {
                $("#loader").show();
                $("#submitEmitten").attr("disabled", true);
            },
            success: function (data) {
                if (data.msg == 200) {
                    $("#loader").hide();
                    if ($.isEmptyObject(data.error)) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Berhasil menambahkan emiten.',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            window.location = '/user/emitens';
                        })
                    } else {
                        if (data.error.company_name_error != '') {
                            $('#company_name_error').html(data.error.company_name_error);
                            $('#company_name').addClass('invalid');
                        } else {
                            $('#company_name_error').html('');
                            $('#company_name').removeClass('invalid');
                        }

                        if (data.error.business_description_error != '') {
                            $('#business_description_error').html(data.error.business_description_error);
                            $('#business_description').addClass('invalid');
                        } else {
                            $('#business_description_error').html('');
                            $('#business_description').removeClass('invalid');
                        }

                        if (data.error.trademark_error != '') {
                            $('#trademark_error').html(data.error.trademark_error);
                            $('#trademark').addClass('invalid');
                        } else {
                            $('#trademark_error').html('');
                            $('#trademark').removeClass('invalid');
                        }

                        if (data.error.code_emiten_error != '') {
                            $('#code_emiten_error').html(data.error.code_emiten_error);
                            $('#code_emiten').addClass('invalid');
                        } else {
                            $('#code_emiten_error').html('');
                            $('#code_emiten').removeClass('invalid');
                        }

                        if (data.error.address_error != '') {
                            $('#address_error').html(data.error.address_error);
                            $('#address').addClass('invalid');
                        } else {
                            $('#address_error').html('');
                            $('#address').removeClass('invalid');
                        }

                        if (data.error.latitude_error != '') {
                            $('#latitude_error').html(data.error.latitude_error);
                            $('#latitude').addClass('invalid');
                        } else {
                            $('#latitude_error').html('');
                            $('#latitude').removeClass('invalid');
                        }

                        if (data.error.latitude_error != '') {
                            $('#longitude_error').html(data.error.longitude_error);
                            $('#longitude').addClass('invalid');
                        } else {
                            $('#longitude_error').html('');
                            $('#longitude').removeClass('invalid');
                        }

                        if (data.error.price_error != '') {
                            $('#price_error').html(data.error.price_error);
                            $('#price').addClass('invalid');
                        } else {
                            $('#price_error').html('');
                            $('#price').removeClass('invalid');
                        }

                        if (data.error.supply_error != '') {
                            $('#supply_error').html(data.error.supply_error);
                            $('#supply').addClass('invalid');
                        } else {
                            $('#supply_error').html('');
                            $('#supply').removeClass('invalid');
                        }

                        if (data.error.total_error != '') {
                            $('#total_error').html(data.error.total_error);
                            $('#total').addClass('invalid');
                        } else {
                            $('#total_error').html('');
                            $('#total').removeClass('invalid');
                        }

                        if (data.error.minimum_invest_error != '') {
                            $('#minimum_invest_error').html(data.error.minimum_invest_error);
                            $('#minimum_invest').addClass('invalid');
                        } else {
                            $('#minimum_invest_error').html('');
                            $('#minimum_invest').removeClass('invalid');
                        }

                        if (data.error.begin_period_error != '') {
                            $('#begin_period_error').html(data.error.begin_period_error);
                            $('#begin_period').addClass('invalid');
                        } else {
                            $('#begin_period_error').html('');
                            $('#begin_period').removeClass('invalid');
                        }

                        if (data.error.end_period_error != '') {
                            $('#end_period_error').html(data.error.end_period_error);
                            $('#end_period').addClass('invalid');
                        } else {
                            $('#end_period_error').html('');
                            $('#end_period').removeClass('invalid');
                        }

                        if (data.error.period_error != '') {
                            $('#period_error').html(data.error.period_error);
                            $('#period').addClass('invalid');
                        } else {
                            $('#period_error').html('');
                            $('#period').removeClass('invalid');
                        }

                        if (data.error.share_amount_error != '') {
                            $('#share_amount_error').html(data.error.share_amount_error);
                            $('#share_amount').addClass('invalid');
                        } else {
                            $('#share_amount_error').html('');
                            $('#share_amount').removeClass('invalid');
                        }

                        if (data.error.dividend_percentage_error != '') {
                            $('#dividend_percentage_error').html(data.error.dividend_percentage_error);
                            $('#dividend_percentage').addClass('invalid');
                        } else {
                            $('#dividend_percentage_error').html('');
                            $('#dividend_percentage').removeClass('invalid');
                        }
                    }
                } else {
                    $("#loader").hide();
                    Swal.fire({
                        title: 'Gagal',
                        text: data.msg,
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        location.reload();
                    })
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
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
            complete: function () {
                $("#submitEmitten").attr("disabled", false);
                $("#loader").hide();
            }
        });
    } else {
        if (logo.length == 0 ) {
            $('#img-perusahaan').html('kolom ini diperlukan')
            $('#img-perusahaan').removeClass('invalid-feedback')
        } else {
            $('#img-perusahaan').hide()
        }

        if (cover.length == 0 ) {
            $('#img-cover-perusahaan').html('kolom ini diperlukan')
            $('#img-cover-perusahaan').removeClass('invalid-feedback')
        } else {
            $('#img-cover-perusahaan').hide()
        }

        if (Object.keys(produk).length == 0) {
            $('#img-produk-perusahaan').html('kolom ini diperlukan')
            $('#img-produk-perusahaan').removeClass('invalid-feedback')
        } else {
            if (Object.keys(produk).length < 3) {
                $('#img-produk-perusahaan').html('Minimal tiga foto produk')
                $('#img-produk-perusahaan').removeClass('invalid-feedback')
            } else {
                $('#img-produk-perusahaan').hide()
            }
        }
        scrollTo(0, 500);
    }
});

$("#formUpdateEmitten").on('submit', function (e) {
    e.preventDefault();

    if ($("#end_period").attr("disabled")) {
        $('#end_period').removeAttr("disabled");
    }

    var data = new FormData(this);

    if (logo.length == 1) {
        data.append('logoF', logo[0])
    }
    if (cover.length == 1) {
        data.append('coverF', cover[0])
    }
    for (let index = 0; index < produk.length; index++) {
        const element = produk[index];
        data.append('pictures[]', element);
    }
    for (let index = 0; index < list_produk.length; index++) {
        const element = list_produk[index];
        data.append('list_produk[]', element);
    }

    if (produk.length + list_produk.length >= 3 && (logo.length == 1 || $('input[name=textLogo]').val() != '') && (cover.length == 1 || $('input[name=textCover]').val() != '')) {
        $.ajax({
            url: '/user/emitens/update',
            type: 'POST',
            dataType: "json",
            data: data,
            cache: false,
            async: true,
            processData: false,
            contentType: false,
            timeout: 60000, // sets timeout to 20 seconds
            beforeSend: function () {
                $("#loader").show();
                $("#submitEmitten").attr("disabled", true);
            },
            success: function (data) {

                if (data.msg == 404 || data.msg == 400 || data.msg == 401) {
                    $("#loader").hide();

                    Swal.fire({
                        title: 'Gagal',
                        text: 'Gagal mengubah emiten.',
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        location.reload();
                    })
                }

                if ($.isEmptyObject(data.error) && data.msg == 200) {
                    $("#loader").hide();
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Berhasil mengubah emiten.',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        location.reload();
                    })
                } else {
                    if (data.error.company_name_error != '') {
                        $('#company_name_error').html(data.error.company_name_error);
                        $('#company_name').addClass('invalid');
                    } else {
                        $('#company_name_error').html('');
                        $('#company_name').removeClass('invalid');
                    }

                    if (data.error.business_description_error != '') {
                        $('#business_description_error').html(data.error.business_description_error);
                        $('#business_description').addClass('invalid');
                    } else {
                        $('#business_description_error').html('');
                        $('#business_description').removeClass('invalid');
                    }

                    if (data.error.trademark_error != '') {
                        $('#trademark_error').html(data.error.trademark_error);
                        $('#trademark').addClass('invalid');
                    } else {
                        $('#trademark_error').html('');
                        $('#trademark').removeClass('invalid');
                    }

                    if (data.error.code_emiten_error != '') {
                        $('#code_emiten_error').html(data.error.code_emiten_error);
                        $('#code_emiten').addClass('invalid');
                    } else {
                        $('#code_emiten_error').html('');
                        $('#code_emiten').removeClass('invalid');
                    }

                    if (data.error.address_error != '') {
                        $('#address_error').html(data.error.address_error);
                        $('#address').addClass('invalid');
                    } else {
                        $('#address_error').html('');
                        $('#address').removeClass('invalid');
                    }

                    if (data.error.latitude_error != '') {
                        $('#latitude_error').html(data.error.latitude_error);
                        $('#latitude').addClass('invalid');
                    } else {
                        $('#latitude_error').html('');
                        $('#latitude').removeClass('invalid');
                    }

                    if (data.error.latitude_error != '') {
                        $('#longitude_error').html(data.error.longitude_error);
                        $('#longitude').addClass('invalid');
                    } else {
                        $('#longitude_error').html('');
                        $('#longitude').removeClass('invalid');
                    }

                    if (data.error.price_error != '') {
                        $('#price_error').html(data.error.price_error);
                        $('#price').addClass('invalid');
                    } else {
                        $('#price_error').html('');
                        $('#price').removeClass('invalid');
                    }

                    if (data.error.supply_error != '') {
                        $('#supply_error').html(data.error.supply_error);
                        $('#supply').addClass('invalid');
                    } else {
                        $('#supply_error').html('');
                        $('#supply').removeClass('invalid');
                    }

                    if (data.error.total_error != '') {
                        $('#total_error').html(data.error.total_error);
                        $('#total').addClass('invalid');
                    } else {
                        $('#total_error').html('');
                        $('#total').removeClass('invalid');
                    }

                    if (data.error.minimum_invest_error != '') {
                        $('#minimum_invest_error').html(data.error.minimum_invest_error);
                        $('#minimum_invest').addClass('invalid');
                    } else {
                        $('#minimum_invest_error').html('');
                        $('#minimum_invest').removeClass('invalid');
                    }

                    if (data.error.begin_period_error != '') {
                        $('#begin_period_error').html(data.error.begin_period_error);
                        $('#begin_period').addClass('invalid');
                    } else {
                        $('#begin_period_error').html('');
                        $('#begin_period').removeClass('invalid');
                    }

                    if (data.error.end_period_error != '') {
                        $('#end_period_error').html(data.error.end_period_error);
                        $('#end_period').addClass('invalid');
                    } else {
                        $('#end_period_error').html('');
                        $('#end_period').removeClass('invalid');
                    }

                    if (data.error.period_error != '') {
                        $('#period_error').html(data.error.period_error);
                        $('#period').addClass('invalid');
                    } else {
                        $('#period_error').html('');
                        $('#period').removeClass('invalid');
                    }

                    if (data.error.share_amount_error != '') {
                        $('#share_amount_error').html(data.error.share_amount_error);
                        $('#share_amount').addClass('invalid');
                    } else {
                        $('#share_amount_error').html('');
                        $('#share_amount').removeClass('invalid');
                    }

                    if (data.error.dividend_percentage_error != '') {
                        $('#dividend_percentage_error').html(data.error.dividend_percentage_error);
                        $('#dividend_percentage').addClass('invalid');
                    } else {
                        $('#dividend_percentage_error').html('');
                        $('#dividend_percentage').removeClass('invalid');
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
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
            complete: function () {
                $("#submitEmitten").attr("disabled", false);
                $("#loader").hide();
            }
        });
    } else {
        if (logo.length == 0 || $('input[name=textLogo]').val() == '') {
            $('#img-perusahaan').html('kolom ini diperlukan')
            $('#img-perusahaan').removeClass('invalid-feedback')
        } else {
            $('#img-perusahaan').hide()
        }

        if (cover.length == 0 || $('input[name=textCover]').val() == '') {
            $('#img-cover-perusahaan').html('kolom ini diperlukan')
            $('#img-cover-perusahaan').removeClass('invalid-feedback')
        } else {
            $('#img-cover-perusahaan').hide()
        }

        if (produk.length + list_produk.length == 0) {
            $('#img-produk-perusahaan').html('kolom ini diperlukan')
            $('#img-produk-perusahaan').removeClass('invalid-feedback')
        } else {
            if (produk.length + list_produk.length < 3) {
                $('#img-produk-perusahaan').html('Minimal tiga foto produk')
                $('#img-produk-perusahaan').removeClass('invalid-feedback')
            } else {
                $('#img-produk-perusahaan').hide()
            }
        }
        scrollTo(0, 500);

    }

});