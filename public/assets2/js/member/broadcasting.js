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
                url: '/user/crm/saveTarget',
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
                            text: data.msg,
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

            $.ajax({
                url: '/user/crm/saveKonten',
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
                            if(index == '0'){
                                $("#id").val(value.broadcast_target_group_id);
                            }
                            
                            $('#preview_title_'+index).html(value.title);
                            $('#preview_content_'+index).html(value.content.substring(0, 200));
                            $('#preview_image_'+index).attr("src", value.image );
                            $('#filename_'+index).val( value.file_name );
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
                            $("#target_user_preview").append(`<li class="list-group-item">${value}</li>`);
                        });

                        return true; 
                    } else {
                        Swal.fire({
                            title: 'Gagal',
                            text: data.msg,
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
                    url: '/user/crm/savePublish',
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
                        window.location = '/user/crm/broadcasting';
    
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
