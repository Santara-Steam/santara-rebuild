$(document).ready(function() {
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

    $("#sales_result_date").flatpickr({
        altFormat: "Y-m-d",
        dateFormat: "Y-m-d"
    });

    $("#settlement_date").flatpickr({
        altFormat: "Y-m-d",
        dateFormat: "Y-m-d"
    });

    $("#due_date").flatpickr({
        altFormat: "Y-m-d",
        dateFormat: "Y-m-d"
    });

    $("#first_dividend_date").flatpickr({
        altFormat: "Y-m-d",
        dateFormat: "Y-m-d"
    });

    $("#images").fileinput({
        'allowedFileExtensions': ["jpg", "jpeg", "gif", "png"],
        'showUpload': false,
        'showPreview': false,
        'maxFileCount': 10,
        'maxFileSize': 10000,
        'elErrorContainer': "#errorBlockImages"
    });

    $("#prospektus").fileinput({
        'allowedFileExtensions': ["pdf"],
        'showUpload': false,
        'showPreview': false,
        'maxFileCount': 1,
        'maxFileSize': 25000,
        'elErrorContainer': "#errorBlockProspektus"
    });

    $('#email').select2({
        placeholder: "Contoh: nama@mail.com",
        minimumInputLength: 5,
        allowClear: true,
        delay: 250, // wait 250 milliseconds before triggering the request
        ajax: {
            url: '/user/trader/get_email',
            dataType: "json",
            data: function(params) {
                return {
                    email: params.term
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
        },
        language: {
            inputTooShort: function() {
                return 'Masukan minimal 5 huruf';
            }
        }
    });

    $("#emiten_name").keyup(function(){
        var company = $(this).val();

        if(company != "" && company.length > 3){

            $.ajax({
                url: '/user/emitens/get_company/' + company,
                type: 'GET',
                dataType: 'json',
                success:function(response){
                    if(response != null){
                        var len = response.length;
                        $("#companyResult").empty();
                        for( var i = 0; i<len; i++){
                            var id = response[i]['id'];
                            var name = response[i]['company_name'];
                            $("#companyResult").append("<li value='"+id+"'>"+name+"</li>");
                        }
    
                        // binding click event to li
                        $("#companyResult li").bind("click",function(){
                            var value = $(this).text();
    
                            $("#emiten_name").val(value);
                            $("#companyResult").empty();
                        });
                    }

                }
            });
        }

    });

    // $('#emiten_name').select2({
    //     placeholder: "Contoh: Nama Perusahaan",
    //     minimumInputLength: 3,
    //     allowClear: true,
    //     delay: 250, // wait 250 milliseconds before triggering the request
    //     ajax: {
    //         url: '/user/emitens/get_company',
    //         dataType: "json",
    //         data: function(params) {
    //             return {
    //                 company: params.term
    //             };
    //         },
    //         processResults: function(data) {
    //             var results = [];
    //             $.each(data, function(index, item) {
    //                 results.push({
    //                     id: item.company_name,
    //                     text: item.company_name,
    //                     value: item.company_name
    //                 })
    //             })
    //             return {
    //                 results: results
    //             };
    //         }
    //     },
    //     language: {
    //         inputTooShort: function() {
    //             return 'Masukan minimal 3 huruf';
    //         }
    //     }
    // });

    checkUnderlying();
});

$(document).on('click','body *',function(){
    $("#companyResult").empty();
});

const begin_period = document.getElementById('begin_period');
begin_period.addEventListener('change', function() {
    if ($("#end_period").attr("disabled")) {
        $('#end_period').removeAttr("disabled");
    }

    var beginDate = new Date(begin_period.value);
    beginDate.setDate(beginDate.getDate());
    var endDate = new Date(beginDate);
    endDate.setDate(endDate.getDate() + 45);

    flatpickr('#end_period', {
        enableTime: true,
        minDate: beginDate,
        maxDate: endDate,
        altInput: true,
        altFormat: "Y-m-d H:i",
        dateFormat: "Y-m-d H:i"
    });
}); 

const price = document.getElementById('price');
const supply = document.getElementById('supply');
let total_price = document.getElementById('total_price');
let underlying_asset_nominal = document.getElementById('underlying_asset_nominal');

price.addEventListener('keyup', function(e) {
    if ('abcdefghijklmnopqrstuvwxyz'.split('').includes(e.key)) {
        price.value = price.value.slice(0, -1);
    } else {
        let total = parseInt(price.value.replace(/\./g, '')) * parseInt(supply.value.replace(/\./g, ''));
        total_price.value = formatRupiah(total).slice(3).slice(0, -3);
    }
});

supply.addEventListener('keyup', function(e) {
    if ('abcdefghijklmnopqrstuvwxyz'.split('').includes(e.key)) {
        supply.value = supply.value.slice(0, -1);
    } else {
        let total = parseInt(price.value.replace(/\./g, '')) * parseInt(supply.value.replace(/\./g, ''));
        total_price.value = formatRupiah(total).slice(3).slice(0, -3);
    }
});

function checkUnderlying() {
    $('.underlying_asset_nominal_limit').addClass('hidden');
    var underlying = parseInt(underlying_asset_nominal.value.replace(/\./g, ''));
    var total_percentage = (125 / 100) * parseInt(total_price.value.replace(/\./g, ''));

    if( underlying < total_percentage ){
        $('.underlying_asset_nominal_limit').removeClass('hidden');
    }else{
        $('.underlying_asset_nominal_limit').addClass('hidden');    
    }
}

$("#formSubmitSukuk").on('submit', function(e) {
    e.preventDefault();

    if ($("#end_period").attr("disabled")) {
        $('#end_period').removeAttr("disabled");
    }

    var data = new FormData(this);

    $.ajax({
        url: '/user/sukuk/saveProyek',
        type: 'POST',
        dataType: "json",
        data: data,
        cache: false,
        async: true,
        processData: false,
        contentType: false,
        beforeSend: function() {
            $("#loader").show();
            $("#submitSukuk").attr("disabled", true);
        },
        success: function(data) {
            $("#loader").hide();
            if ($.isEmptyObject(data.error) && data.msg == 200) {
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Berhasil menyimpan sukuk.',
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    window.location = '/user/sukuk/proyek';
                })
            } else {
                Object.keys(data.error).forEach(function(key) {
                    if(key != 'error'){
                        if (data.error[key] != '') {
                            $('#'+key).html(data.error[key]);
                            $('#'+key.replace('_error','')).addClass('invalid');
                        } else {
                            $('#'+key).html('');
                            $('#'+key.replace('_error','')).removeClass('invalid');
                        }
                    }
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
            $("#submitSukuk").attr("disabled", false);
            $("#loader").hide();
        }
    });

});

$('.delete-foto-proyek').on("click", function(){

    var id = $(this).val();

    Swal.fire({
        title: 'Konfirmasi hapus Foto',
        html: 'Apakah anda yakin akan menghapus foto proyek ini ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $("#loader").show();
            $.ajax({
                url: '/sukuk/deleteFotoProyek/' + id,
                type: 'GET',
                timeout: 20000, // sets timeout to 20 seconds
                cache: false,
                success: function(data) {
                    $("#loader").hide();
                    data = JSON.parse(data);
                    if (data.msg == 200) {
                        Swal.fire(
                            'Berhasil',
                            'Foto proyek sukuk berhasil dihapus',
                            'success'
                        ).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Error!", data.msg, "error");
                    }
        
                },
                error: function(msg) {
                    $("#loader").hide();
                    Swal.fire("Error!", "Data gagal diambil", "error").then((result) => {
                        location.reload();
                    });
                }
            });            
        }
    })

});