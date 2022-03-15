function Angka(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? rupiah : "";
}

function b64toBlob(b64Data, contentType, sliceSize) {
    contentType = contentType || '';
    sliceSize = sliceSize || 512;

    var byteCharacters = atob(b64Data);
    var byteArrays = [];

    for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
        var slice = byteCharacters.slice(offset, offset + sliceSize);

        var byteNumbers = new Array(slice.length);
        for (var i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }

        var byteArray = new Uint8Array(byteNumbers);

        byteArrays.push(byteArray);
    }

    var blob = new Blob(byteArrays, {
        type: contentType
    });
    return blob;
}

var logo_perusahaan = '';
var cover_perusahaan = '';
var foto_produk_perusahaan = [];
var logo_owner = '';

function hapusProduk(item) {
    foto_produk_perusahaan.splice(item, 1)
    $('#itemProduk' + item).remove()
}
$(document).ready(function () {
    $('input').keyup(function () {
        let name = $(this).attr('name')

        if ((name != 'nama_perusahaan') && (name != 'nama_owner') && (name != 'kategori') && (name != 'foto_owner') && (name != 'facebook') && (name != 'instagram') && (name != 'logo_perusahaan')) {
            $('#' + name).val(Angka($(this).val()))
        } else {
            if ((name != 'foto_owner') && (name != 'logo_perusahaan')) {
                $('#' + name).html($(this).val())
            }
        }
    })

    $('select[name=kategori]').change(function () {
        var option = $('option:selected', this).attr('logo');
        src = '/assets/new-santara/img/logo/category/' + option;
        $('#logo_kategori').attr('src', src)
    })

    $('.username').keyup(function () {
        this.value = this.value.trim();
    })

    var $modal_logo_perusahaan = $('#modal_crop_logo_perusahaan');
    var $modal_cover_perusahaan = $('#modal_crop_cover_perusahaan');
    var $modal_produk_perusahaan = $('#modal_crop_produk_perusahaan');
    var $modal_owner_perusahaan = $('#modal_crop_owner_perusahaan');

    var image_logo_perusahaan = document.getElementById('sample_image_logo_perusahaan');
    var image_cover_perusahaan = document.getElementById('sample_image_cover_perusahaan');
    var image_produk_perusahaan = document.getElementById('sample_image_produk_perusahaan');
    var image_owner_perusahaan = document.getElementById('sample_image_owner_perusahaan');

    var cropper;


    // START CROP LOGO PERUSAHAAN
    $('#input_logo_perusahaan').change(function (event) {
        var files = event.target.files;

        var done = function (url) {
            image_logo_perusahaan.src = url;
            $modal_logo_perusahaan.modal('show');
        };

        if (files && files.length > 0) {
            reader = new FileReader();
            reader.onload = function (event) {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
        }
    });
    $modal_logo_perusahaan.on('shown.bs.modal', function () {
        cropper = new Cropper(image_logo_perusahaan, {
            aspectRatio: 4 / 4,
            viewMode: 3,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });
    $('#crop_logo_perusahaan').click(function () {
        canvas = cropper.getCroppedCanvas({
            width: 400,
            height: 400
        });

        canvas.toBlob(function (blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                var ImageURL = reader.result;
                var form_data = new FormData();
                // Split the base64 string in data and contentType
                var block = ImageURL.split(";");
                // Get the content type
                var contentType = block[0].split(":")[1]; // In this case "image/gif"
                // get the real base64 content of the file
                var realData = block[1].split(",")[1]; // In this case "iVBORw0KGg...."
                // Convert to blob
                var blob = b64toBlob(realData, contentType);
                // Create a FormData and append the file
                form_data.append("file", blob);
                $.ajax({
                    url: "/pra-listing/upload",
                    method: 'POST',
                    data: form_data,
                    cache: false,
                    async: true,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('#crop_logo_perusahaan').attr('disabled', true)
                        $('#crop_logo_perusahaan').html('<i class="fa fa-spinner  fa-spin"></i>&ensp; loading...')
                    },
                    success: function (data) {
                        datas = JSON.parse(data)
                        if (datas.code == '200') {
                            $modal_logo_perusahaan.modal('hide');
                            uploaded_image = reader.result;
                            $('.logo_perusahaan').attr('src', uploaded_image)
                            logo_perusahaan = datas.data.filename;

                            $('#crop_logo_perusahaan').attr('disabled', false)
                            Swal.fire({
                                type: 'success',
                                text: datas.message,
                                showConfirmButton: true,
                            });
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: 'gagal',
                                text: datas.message,
                                showConfirmButton: true,
                            });
                            $('#crop_logo_perusahaan').attr('disabled', false)
                        }
                        $('#crop_logo_perusahaan').html('Crop')

                        // $('#uploaded_image').attr('src', data);
                    }
                });
            };
        });
    });
    // END CROP LOGO PERUSAHAAN

    // START CROP COVER PERUSAHAAN
    $('#input_cover_perusahaan').change(function (event) {
        var files = event.target.files;

        var done = function (url) {
            image_cover_perusahaan.src = url;
            $modal_cover_perusahaan.modal('show');
        };

        if (files && files.length > 0) {
            reader = new FileReader();
            reader.onload = function (event) {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
        }
    });
    $modal_cover_perusahaan.on('shown.bs.modal', function () {
        cropper = new Cropper(image_cover_perusahaan, {
            aspectRatio: 2,
            viewMode: 3,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });
    $('#crop_cover_perusahaan').click(function () {
        canvas = cropper.getCroppedCanvas({
            width: 1366,
            height: 497
        });

        canvas.toBlob(function (blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                var ImageURL = reader.result;
                var form_data = new FormData();
                // Split the base64 string in data and contentType
                var block = ImageURL.split(";");
                // Get the content type
                var contentType = block[0].split(":")[1]; // In this case "image/gif"
                // get the real base64 content of the file
                var realData = block[1].split(",")[1]; // In this case "iVBORw0KGg...."
                // Convert to blob
                var blob = b64toBlob(realData, contentType);
                // Create a FormData and append the file
                form_data.append("file", blob);
                $.ajax({
                    url: "/pra-listing/upload",
                    method: 'POST',
                    data: form_data,
                    cache: false,
                    async: true,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('#crop_cover_perusahaan').attr('disabled', true)
                        $('#crop_cover_perusahaan').html('<i class="fa fa-spinner  fa-spin"></i>&ensp; loading...')
                    },
                    success: function (data) {
                        datas = JSON.parse(data)

                        if (datas.code == 200) {
                            $modal_cover_perusahaan.modal('hide');
                            uploaded_image = reader.result;
                            $('.cover_perusahaan').attr('src', uploaded_image)
                            // $('#uploaded_image').attr('src', data);
                            cover_perusahaan = datas.data.filename;
                            $('#crop_cover_perusahaan').attr('disabled', false)
                            Swal.fire({
                                type: 'success',
                                text: datas.message,
                                showConfirmButton: true,
                            });
                        } else {
                            $('#crop_cover_perusahaan').attr('false', true)
                            Swal.fire({
                                type: 'error',
                                title: 'gagal',
                                text: data.message,
                                showConfirmButton: true,
                            });
                        }
                        $('#crop_cover_perusahaan').html('Crop')
                    }
                });
            };
        });
    });
    // END CROP COVER PERUSAHAAN

    // START CROP PRODUK PERUSAHAAN
    $('#input_produk_perusahaan').change(function (event) {
        var files = event.target.files;

        var done = function (url) {
            image_produk_perusahaan.src = url;
            $modal_produk_perusahaan.modal('show');
        };

        if (files && files.length > 0) {
            reader = new FileReader();
            reader.onload = function (event) {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
        }
    });
    $modal_produk_perusahaan.on('shown.bs.modal', function () {
        cropper = new Cropper(image_produk_perusahaan, {
            aspectRatio: 4 / 3,
            viewMode: 3,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });
    $('#crop_produk_perusahaan').click(function () {
        canvas = cropper.getCroppedCanvas({
            width: 400,
            height: 300
        });

        canvas.toBlob(function (blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                var ImageURL = reader.result;
                var form_data = new FormData();
                // Split the base64 string in data and contentType
                var block = ImageURL.split(";");
                // Get the content type
                var contentType = block[0].split(":")[1]; // In this case "image/gif"
                // get the real base64 content of the file
                var realData = block[1].split(",")[1]; // In this case "iVBORw0KGg...."
                // Convert to blob
                var blob = b64toBlob(realData, contentType);
                // Create a FormData and append the file
                form_data.append("file", blob);
                $.ajax({
                    url: "/pra-listing/upload",
                    method: 'POST',
                    data: form_data,
                    cache: false,
                    async: true,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('#crop_produk_perusahaan').attr('disabled', true)
                        $('#crop_produk_perusahaan').html('<i class="fa fa-spinner  fa-spin"></i>&ensp; loading...')
                    },
                    success: function (data) {
                        datas = JSON.parse(data)
                        if (datas.code == 200) {
                            $modal_produk_perusahaan.modal('hide');
                            uploaded_image = reader.result;

                            $('#list_produk').append(`<div class="col-6 p-1 container-foto" id="itemProduk${foto_produk_perusahaan.length}">
                            <img src="${uploaded_image}" width="150px" height="125px" class="rounded" />
                            <div class="middle" onclick="hapusProduk('${foto_produk_perusahaan.length}')" >
                                <div class="hapus-foto"> <i class="fa fa-trash-alt"></i></div >
                                </div></div>`);
                            $('.produk_perusahaan').remove();
                            // $('#uploaded_image').attr('src', data);
                            foto_produk_perusahaan.push(datas.data.filename)
                            $('#crop_produk_perusahaan').attr('disabled', false)

                            Swal.fire({
                                type: 'success',
                                text: datas.message,
                                showConfirmButton: true,
                            });
                        } else {
                            $('#crop_produk_perusahaan').attr('disabled', false)
                            Swal.fire({
                                type: 'error',
                                title: 'gagal',
                                text: datas.message,
                                showConfirmButton: true,
                            });
                        }
                        $('#crop_produk_perusahaan').html('Crop')

                    },

                });
            };
        });
        // END CROP PRODUK PERUSAHAAN
    })
    // END CROP PRODUK PERUSAHAAN

    // START CROP OWNER PERUSAHAAN
    $('#input_owner_perusahaan').change(function (event) {
        var files = event.target.files;

        var done = function (url) {
            image_owner_perusahaan.src = url;
            $modal_owner_perusahaan.modal('show');
        };
        if (files && files.length > 0) {
            reader = new FileReader();
            reader.onload = function (event) {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
        }
    });
    $modal_owner_perusahaan.on('shown.bs.modal', function () {
        cropper = new Cropper(image_owner_perusahaan, {
            aspectRatio: 4 / 4,
            viewMode: 3,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });
    $('#crop_owner_perusahaan').click(function () {
        canvas = cropper.getCroppedCanvas({
            width: 400,
            height: 400
        });

        canvas.toBlob(function (blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                var ImageURL = reader.result;
                var form_data = new FormData();
                // Split the base64 string in data and contentType
                var block = ImageURL.split(";");
                // Get the content type
                var contentType = block[0].split(":")[1]; // In this case "image/gif"
                // get the real base64 content of the file
                var realData = block[1].split(",")[1]; // In this case "iVBORw0KGg...."
                // Convert to blob
                var blob = b64toBlob(realData, contentType);
                console.log(realData)
                // Create a FormData and append the file
                form_data.append("file", blob);
                $.ajax({
                    url: "/pra-listing/upload",
                    method: 'POST',
                    data: form_data,
                    cache: false,
                    async: true,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('#crop_owner_perusahaan').attr('disabled', true)
                        $('#crop_owner_perusahaan').html('<i class="fa fa-spinner  fa-spin"></i>&ensp; loading...')
                    },
                    success: function (data) {
                        datas = JSON.parse(data)
                        if (datas.code == 200) {
                            $modal_owner_perusahaan.modal('hide');
                            uploaded_image = reader.result;
                            $('.owner_perusahaan').attr('src', uploaded_image)
                            // $('#uploaded_image').attr('src', data);
                            logo_owner = datas.data.filename;
                            $('#crop_owner_perusahaan').attr('disabled', false);
                            Swal.fire({
                                type: 'success',
                                text: datas.message,
                                showConfirmButton: true,
                            });

                        } else {
                            $('#crop_owner_perusahaan').attr('disabled', false);
                            Swal.fire({
                                type: 'error',
                                title: 'gagal',
                                text: datas.message,
                                showConfirmButton: true,
                            });
                        }
                        $('#crop_owner_perusahaan').html('Crop')
                    }
                });
            };
        });
    });
    // END CROP OWNER PERUSAHAAN


    $.validator.addMethod('maxPendanaan', function (value, el, param) {
        return this.optional(el) || parseInt(value.replace(/\./g, "")) < 10000000000;
    }, `maksimal pendanaan adalah Rp 10.000.000.000`);

    $.validator.addMethod('persen', function (value, el, param) {
        if (parseInt(value.replace(/\./g, "")) <= 100) {
            if (parseInt(value.replace(/\./g, "")) > 0) {
                return true
            }
        }
    }, `silahkan inputkan angka dari 1 sampai 100`);

    jQuery.validator.addMethod("youtube", function (value, element) {
        return this.optional(element) || value.match(/https:\/\/(?:www\.)?youtube.*watch\?v=([a-zA-Z0-9\-_]+)/) || value.match(/http:\/\/(?:www\.)?youtube.*watch\?v=([a-zA-Z0-9\-_]+)/);
    }, `Hanya menerima url youtube (https://www.youtube.com/)`);


    $('#formDatas').validate({
        rules: {
            nama_perusahaan: {
                required: true
            },
            nama_owner: {
                required: true
            },
            kategori: {
                required: true
            },
            omzet1: {
                required: true
            },
            omzet2: {
                required: true
            },
            dana_dibutuhkan: {
                required: true,
                maxPendanaan: true
            },
            lembar_saham: {
                persen: true,
                required: true,
            },
            omzet_penerbit: {
                required: true
            },
            youtube: {
                // required: true,
                url: true,
                youtube: true
            },
            website: {
                url: true
            },
            dividen_tahunan: {
                required: true,
                persen: true
            },
            biografi: {
                required: true
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            $(element).parent().addClass('has-danger')
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            $(element).parent().removeClass('has-danger')
            $(element).parent().addClass('has-success')
            $(element).addClass('is-valid');
        },
        submitHandler: function (form, e) {
            e.preventDefault();

            if (logo_perusahaan != '' && logo_owner != '' && foto_produk_perusahaan.length >= 3 && cover_perusahaan != '') {

                foto_produk_perusahaan.unshift(cover_perusahaan)
                foto_produk_perusahaan.unshift(logo_perusahaan)
                console.log(foto_produk_perusahaan)
                var dataDaftarBisnis = {
                    biografi: $('textarea[name=biografi]').val(),
                    dana_dibutuhkan: $('input[name=dana_dibutuhkan]').val().replace(/\./g, ""),
                    dividen_tahunan: $('input[name=dividen_tahunan]').val().replace(/\./g, ""),
                    facebook: $('input[name=facebook]').val(),
                    foto_owner: logo_owner,
                    instagram: $('input[name=instagram]').val(),
                    kategori: $('select[name=kategori]').val(),
                    lembar_saham: $('input[name=lembar_saham]').val().replace(/\./g, ""),
                    logo_perusahaan: foto_produk_perusahaan.join(","),
                    nama_owner: $('input[name=nama_owner]').val(),
                    nama_perusahaan: $('input[name=nama_perusahaan]').val(),
                    omzet1: $('input[name=omzet1]').val().replace(/\./g, ""),
                    omzet2: $('input[name=omzet2]').val().replace(/\./g, ""),
                    omzet_penerbit: $('input[name=omzet_penerbit]').val().replace(/\./g, ""),
                    website: $('input[name=website]').val(),
                    youtube: $('input[name=youtube]').val(),
                };

                $.ajax({
                    url: "/pra-listing/daftarBisnisInsert",
                    type: "POST",
                    dataType: "json",
                    data: dataDaftarBisnis,
                    timeout: 60000, // sets timeout to 20 seconds
                    beforeSend: function () {},
                    success: function (data) {
                        if (data.code === 200) {
                            $('#daftar-bisnis-berhasil').modal('show')
                            $('#daftar-bisnis-berhasil').modal({
                                backdrop: 'static',
                                keyboard: false,
                            })
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: 'gagal',
                                text: data.msg,
                                showConfirmButton: true,
                            });
                        }
                    },
                })
            } else {
                if (logo_perusahaan == '') {
                    $('#img-perusahaan').html('kolom ini diperlukan')
                    $('#img-perusahaan').removeClass('invalid-feedback')
                } else {
                    $('#img-perusahaan').hide()
                }

                if (logo_owner == '') {
                    $('#img-owner').html('kolom ini diperlukan')
                    $('#img-owner').removeClass('invalid-feedback')
                } else {
                    $('#img-owner').hide()
                }

                if (cover_perusahaan == '') {
                    $('#img-cover-perusahaan').html('kolom ini diperlukan')
                    $('#img-cover-perusahaan').removeClass('invalid-feedback')
                } else {
                    $('#img-cover-perusahaan').hide()
                }

                if (foto_produk_perusahaan.length == 0) {
                    $('#img-produk-perusahaan').html('kolom ini diperlukan')
                    $('#img-produk-perusahaan').removeClass('invalid-feedback')
                } else {
                    if (foto_produk_perusahaan.length < 4) {
                        $('#img-produk-perusahaan').html('Minimal tiga foto produk')
                        $('#img-produk-perusahaan').removeClass('invalid-feedback')
                    } else {
                        $('#img-produk-perusahaan').hide()
                    }
                }

                scrollTo(0, 500);

            }
        }
    })


})