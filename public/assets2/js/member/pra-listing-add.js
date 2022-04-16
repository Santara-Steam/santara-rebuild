var form = $("#formSubmitBisnis").show();
form.steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    enableAllSteps: true,
    enablePagination: true,
    titleTemplate: '<span class="step">#index#</span> #title#',
    onStepChanging: function(event, currentIndex, newIndex) {
        $('#document_business_entity_error').css("display", "none");

        if (currentIndex == 0 && newIndex == 1) {
            if (!$('#no_business_entity').is(':checked') && $('#document_business_entity').val() == "") {
                $('#document_business_entity_error').css("display", "");
                return false;
            }
        }

        if (currentIndex == 1 && newIndex == 2) {

            if ($('#business_entity').val() == 1) {
                if ($('#total_paid_capital').val() == '' || $('#total_paid_capital').val() == 0 || $('#total_paid_capital').val() == undefined) {
                    $('#total_paid_capital_error_value').css("display", "");
                    return false;
                } else {
                    $('#total_paid_capital_error_value').css("display", "none");
                }

                if ($('#price').val() == '' || $('#price').val() == 0 || $('#price').val() == undefined) {
                    $('#price_error_value').css("display", "");
                    return false;
                } else {
                    $('#price_error_value').css("display", "none");
                }
            }
        }

        if (currentIndex == 3 && newIndex == 4) {
            if ($('#prospektus').val() == "") {
                $('#prospektus_error').css("display", "");
                return false;
            }
        }

        if (currentIndex == 4 && newIndex == 5) {
            if ($('#pictures').val() == "") {
                $('#pictures_error').css("display", "");
                return false;
            }

            if ($('#video_url').val() != "") {
                var url = $('#video_url').val();
                var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
                var match = url.match(regExp);
                if (match && match[2].length == 11) {
                    return true;
                } else {
                    $('#video_link_url_error').css("display", "");
                    return false;
                }
            }

        }

        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex) {
            return true;
        }
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
            title: 'Daftar Bisnis',
            text: 'Daftarkan bisnis anda sekarang ? ',
            type: 'info',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.value) {

                var data = new FormData(this);
                data.set('monthly_turnover', data.get('monthly_turnover').replace(/\./g, ''));
                data.set('monthly_profit', data.get('monthly_profit').replace(/\./g, ''));
                data.set('capital_needs', data.get('capital_needs').replace(/\./g, ''));
                data.set('monthly_turnover_previous_year', data.get('monthly_turnover_previous_year').replace(/\./g, ''));
                data.set('monthly_profit_previous_year', data.get('monthly_profit_previous_year').replace(/\./g, ''));
                data.set('total_bank_debt', data.get('total_bank_debt').replace(/\./g, ''));
                data.set('total_paid_capital', data.get('total_paid_capital').replace(/\./g, ''));
                data.set('price', data.get('price').replace(/\./g, ''));

                $.ajax({
                    url: '/user/pralisting/insert',
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
                        $("#submitBisnis").attr("disabled", true);
                    },
                    success: function(data) {
                        $("#loader").hide();

                        if (data.msg == 200) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'Berhasil menambahkan bisnis',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                window.location = '/user/pralisting/list';
                            })
                        } else {
                            if (!$.isEmptyObject(data.error)) {
                                if (data.error.company_name_error != '') {
                                    $('#company_name_error').html(data.error.company_name_error);
                                    $('#company_name').addClass('invalid');
                                } else {
                                    $('#company_name_error').html('');
                                    $('#company_name').removeClass('invalid');
                                }

                                if (data.error.category_error != '') {
                                    $('#category_error').html(data.error.category_error);
                                    $('#category').addClass('invalid');
                                } else {
                                    $('#category_error').html('');
                                    $('#category').removeClass('invalid');
                                }

                                if (data.error.regency_error != '') {
                                    $('#regency_error').html(data.error.regency_error);
                                    $('#regency').addClass('invalid');
                                } else {
                                    $('#regency_error').html('');
                                    $('#regency').removeClass('invalid');
                                }

                                if (data.error.address_error != '') {
                                    $('#address_error').html(data.error.address_error);
                                    $('#address').addClass('invalid');
                                } else {
                                    $('#address_error').html('');
                                    $('#address').removeClass('invalid');
                                }

                                if (data.error.employment_contract_error != '') {
                                    $('#employment_contract_error').html(data.error.employment_contract_error);
                                    $('#employment_contract').addClass('invalid');
                                } else {
                                    $('#employment_contract_error').html('');
                                    $('#employment_contract').removeClass('invalid');
                                }

                                if (data.error.business_entity_error != '') {
                                    $('#business_entity_error').html(data.error.business_entity_error);
                                    $('#business_entity').addClass('invalid');
                                } else {
                                    $('#business_entity_error').html('');
                                    $('#business_entity').removeClass('invalid');
                                }

                                if (data.error.license_error != '') {
                                    $('#license_error').html(data.error.license_error);
                                    $('#license').addClass('invalid');
                                } else {
                                    $('#license_error').html('');
                                    $('#license').removeClass('invalid');
                                }

                                if (data.error.trademark_error != '') {
                                    $('#trademark_error').html(data.error.trademark_error);
                                    $('#trademark').addClass('invalid');
                                } else {
                                    $('#trademark_error').html('');
                                    $('#trademark').removeClass('invalid');
                                }

                                if (data.error.business_description_error != '') {
                                    $('#business_description_error').html(data.error.business_description_error);
                                    $('#business_description').addClass('invalid');
                                } else {
                                    $('#business_description_error').html('');
                                    $('#business_description').removeClass('invalid');
                                }

                                if (data.error.market_potential_error != '') {
                                    $('#market_potential_error').html(data.error.market_potential_error);
                                    $('#market_potential').addClass('invalid');
                                } else {
                                    $('#market_potential_error').html('');
                                    $('#market_potential').removeClass('invalid');
                                }

                                if (data.error.marketing_area_error != '') {
                                    $('#marketing_area_error').html(data.error.marketing_area_error);
                                    $('#marketing_area').addClass('invalid');
                                } else {
                                    $('#marketing_area_error').html('');
                                    $('#marketing_area').removeClass('invalid');
                                }

                                if (data.error.business_lifespan_error != '') {
                                    $('#business_lifespan_error').html(data.error.business_lifespan_error);
                                    $('#business_lifespan').addClass('invalid');
                                } else {
                                    $('#business_lifespan_error').html('');
                                    $('#business_lifespan').removeClass('invalid');
                                }

                                if (data.error.branch_company_error != '') {
                                    $('#branch_company_error').html(data.error.branch_company_error);
                                    $('#branch_company').addClass('invalid');
                                } else {
                                    $('#branch_company_error').html('');
                                    $('#branch_company').removeClass('invalid');
                                }

                                if (data.error.employee_error != '') {
                                    $('#employee_error').html(data.error.employee_error);
                                    $('#employee').addClass('invalid');
                                } else {
                                    $('#employee_error').html('');
                                    $('#employee').removeClass('invalid');
                                }

                                if (data.error.monthly_turnover_error != '') {
                                    $('#monthly_turnover_error').html(data.error.monthly_turnover_error);
                                    $('#monthly_turnover').addClass('invalid');
                                } else {
                                    $('#monthly_turnover_error').html('');
                                    $('#monthly_turnover').removeClass('invalid');
                                }

                                if (data.error.monthly_profit_error != '') {
                                    $('#monthly_profit_error').html(data.error.monthly_profit_error);
                                    $('#monthly_profit').addClass('invalid');
                                } else {
                                    $('#monthly_profit_error').html('');
                                    $('#monthly_profit').removeClass('invalid');
                                }

                                if (data.error.monthly_turnover_previous_year_error != '') {
                                    $('#monthly_turnover_previous_year_error').html(data.error.monthly_turnover_previous_year_error);
                                    $('#monthly_turnover_previous_year').addClass('invalid');
                                } else {
                                    $('#monthly_turnover_previous_year_error').html('');
                                    $('#monthly_turnover_previous_year').removeClass('invalid');
                                }

                                if (data.error.monthly_turnover_previous_year_error != '') {
                                    $('#monthly_turnover_previous_year_error').html(data.error.monthly_turnover_previous_year_error);
                                    $('#monthly_turnover_previous_year').addClass('invalid');
                                } else {
                                    $('#monthly_turnover_previous_year_error').html('');
                                    $('#monthly_turnover_previous_year').removeClass('invalid');
                                }

                                if (data.error.monthly_profit_previous_year_error != '') {
                                    $('#monthly_profit_previous_year_error').html(data.error.monthly_profit_previous_year_error);
                                    $('#monthly_profit_previous_year').addClass('invalid');
                                } else {
                                    $('#monthly_profit_previous_year_error').html('');
                                    $('#monthly_profit_previous_year').removeClass('invalid');
                                }

                                if (data.error.capital_needs_error != '') {
                                    $('#capital_needs_error').html(data.error.capital_needs_error);
                                    $('#capital_needs').addClass('invalid');
                                } else {
                                    $('#capital_needs_error').html('');
                                    $('#capital_needs').removeClass('invalid');
                                }

                                if (data.error.financial_recording_system != '') {
                                    $('#financial_recording_system_error').html(data.error.financial_recording_system);
                                    $('#financial_recording_system').addClass('invalid');
                                } else {
                                    $('#financial_recording_system_error').html('');
                                    $('#financial_recording_system').removeClass('invalid');
                                }

                                if (data.error.bank_loan_reputation != '') {
                                    $('#bank_loan_reputation_error').html(data.error.bank_loan_reputation);
                                    $('#bank_loan_reputation').addClass('invalid');
                                } else {
                                    $('#bank_loan_reputation_error').html('');
                                    $('#bank_loan_reputation').removeClass('invalid');
                                }

                                if (data.error.market_position_for_the_product != '') {
                                    $('#market_position_for_the_product_error').html(data.error.market_position_for_the_product);
                                    $('#market_position_for_the_product').addClass('invalid');
                                } else {
                                    $('#market_position_for_the_product_error').html('');
                                    $('#market_position_for_the_product').removeClass('invalid');
                                }

                                if (data.error.strategy_emiten != '') {
                                    $('#strategy_emiten_error').html(data.error.strategy_emiten);
                                    $('#strategy_emiten').addClass('invalid');
                                } else {
                                    $('#strategy_emiten_error').html('');
                                    $('#strategy_emiten').removeClass('invalid');
                                }

                                if (data.error.office_status != '') {
                                    $('#office_status_error').html(data.error.office_status);
                                    $('#office_status').addClass('invalid');
                                } else {
                                    $('#office_status_error').html('');
                                    $('#office_status').removeClass('invalid');
                                }

                                if (data.error.level_of_business_competition != '') {
                                    $('#level_of_business_competition_error').html(data.error.level_of_business_competition);
                                    $('#level_of_business_competition').addClass('invalid');
                                } else {
                                    $('#level_of_business_competition_error').html('');
                                    $('#level_of_business_competition').removeClass('invalid');
                                }

                                if (data.error.managerial_ability != '') {
                                    $('#managerial_ability_error').html(data.error.managerial_ability);
                                    $('#managerial_ability').addClass('invalid');
                                } else {
                                    $('#managerial_ability_error').html('');
                                    $('#managerial_ability').removeClass('invalid');
                                }

                                if (data.error.technical_ability != '') {
                                    $('#technical_ability_error').html(data.error.technical_ability);
                                    $('#technical_ability').addClass('invalid');
                                } else {
                                    $('#technical_ability_error').html('');
                                    $('#technical_ability').removeClass('invalid');
                                }

                                if (data.error.tnc != '') {
                                    $('#tnc_error').html(data.error.tnc);
                                    $('#tnc').addClass('invalid');
                                } else {
                                    $('#tnc_error').html('');
                                    $('#tnc').removeClass('invalid');
                                }
                            } else {
                                Swal.fire('Gagal', data.msg, 'info').then((result) => {
                                    location.reload();
                                });
                            }
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
                        $("#submitBisnis").attr("disabled", false);
                        $("#loader").hide();
                    }
                });
            }
        })
    },
    labels: {
        finish: "Selesai",
        next: "Selanjutnya",
        previous: "Sebelumnya",
        loading: "Loading ..."
    }
}).validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        "company_name": {
            required: true,
            minlength: 3,
        },
        category: "required",
        regency: "required",
        "address": {
            required: true,
            minlength: 3,
        },
        "trademark": {
            required: true,
            minlength: 3,
        },
        "business_description": {
            required: true,
            minlength: 20,
            maxlength: 500,
        },
        business_lifespan: "required",
        branch_company: "required",
        employee: "required",
        monthly_turnover: "required",
        monthly_profit: "required",
        capital_needs: "required",
        monthly_turnover_previous_year: "required",
        monthly_profit_previous_year: "required",
        financial_recording_system: "required",
        bank_loan_reputation: "required",
        market_position_for_the_product: "required",
        strategy_emiten: "required",
        office_status: "required",
        level_of_business_competition: "required",
        managerial_ability: "required",
        technical_ability: "required",
        tnc: "required"
    },
    messages: {
        "company_name": {
            required: "Tidak boleh kosong",
            minlength: "Nama perusahaan minimal 3 karakter"
        },
        category: {
            required: "Tidak boleh kosong"
        },
        regency: {
            required: "Tidak boleh kosong"
        },
        "address": {
            required: "Tidak boleh kosong",
            minlength: "Alamat lengkap minimal 3 karakter"
        },
        "trademark": {
            required: "Tidak boleh kosong",
            minlength: "Merk dagang minimal 3 karakter"
        },
        "business_description": {
            required: "Tidak boleh kosong",
            minlength: "Diskripsi minimal 20 karakter",
            maxlength: "Maksimal input 500 karakter"
        },
        business_lifespan: {
            required: "Tidak boleh kosong"
        },
        branch_company: {
            required: "Tidak boleh kosong"
        },
        employee: {
            required: "Tidak boleh kosong"
        },
        monthly_turnover: {
            required: "Tidak boleh kosong"
        },
        monthly_profit: {
            required: "Tidak boleh kosong"
        },
        capital_needs: {
            required: "Tidak boleh kosong"
        },
        monthly_turnover_previous_year: {
            required: "Tidak boleh kosong"
        },
        monthly_profit_previous_year: {
            required: "Tidak boleh kosong"
        },
        financial_recording_system: {
            required: "Tidak boleh kosong"
        },
        bank_loan_reputation: {
            required: "Tidak boleh kosong"
        },
        market_position_for_the_product: {
            required: "Tidak boleh kosong"
        },
        strategy_emiten: {
            required: "Tidak boleh kosong"
        },
        office_status: {
            required: "Tidak boleh kosong"
        },
        level_of_business_competition: {
            required: "Tidak boleh kosong"
        },
        managerial_ability: {
            required: "Tidak boleh kosong"
        },
        technical_ability: {
            required: "Tidak boleh kosong"
        },
        tnc: {
            required: "Tidak boleh kosong"
        }
    },
    errorPlacement: function(error, element) {
        if (element.is(company_name)) {
            error.appendTo($('#company_name_error'));
        } else if (element.is(category)) {
            error.appendTo($('#category_error'));
        } else if (element.is(regency)) {
            error.appendTo($('#regency_error'));
        } else if (element.is(address)) {
            error.appendTo($('#address_error'));
        } else if (element.is(trademark)) {
            error.appendTo($('#trademark_error'));
        } else if (element.is(business_description)) {
            error.appendTo($('#business_description_error'));
        } else if (element.is(business_lifespan)) {
            error.appendTo($('#business_lifespan_error'));
        } else if (element.is(branch_company)) {
            error.appendTo($('#branch_company_error'));
        } else if (element.is(employee)) {
            error.appendTo($('#employee_error'));
        } else if (element.is(monthly_turnover)) {
            error.appendTo($('#monthly_turnover_error'));
        } else if (element.is(monthly_profit)) {
            error.appendTo($('#monthly_profit_error'));
        } else if (element.is(capital_needs)) {
            error.appendTo($('#capital_needs_error'));
        } else if (element.is(monthly_turnover_previous_year)) {
            error.appendTo($('#monthly_turnover_previous_year_error'));
        } else if (element.is(monthly_profit_previous_year)) {
            error.appendTo($('#monthly_profit_previous_year_error'));
        } else if (element.is(financial_recording_system)) {
            error.appendTo($('#financial_recording_system_error'));
        } else if (element.is(bank_loan_reputation)) {
            error.appendTo($('#bank_loan_reputation_error'));
        } else if (element.is(market_position_for_the_product)) {
            error.appendTo($('#market_position_for_the_product_error'));
        } else if (element.is(strategy_emiten)) {
            error.appendTo($('#strategy_emiten_error'));
        } else if (element.is(office_status)) {
            error.appendTo($('#office_status_error'));
        } else if (element.is(level_of_business_competition)) {
            error.appendTo($('#level_of_business_competition_error'));
        } else if (element.is(managerial_ability)) {
            error.appendTo($('#managerial_ability_error'));
        } else if (element.is(technical_ability)) {
            error.appendTo($('#technical_ability_error'));
        } else if (element.is(tnc)) {
            error.appendTo($('#tnc_error'));
        }
    }
});