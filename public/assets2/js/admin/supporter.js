$(document).ready(function () {
    $("#logo").fileinput({
        'allowedFileExtensions': ["jpg", "jpeg", "gif", "png"],
        'showUpload': false, 
        'maxFileCount': 1,
        'maxFileSize': 10000,
        'showPreview': false,
        'elErrorContainer': "#errorBlockLogos"  
    });
});


function hapus(link, id) {
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
                data: 'id=' + id,
                cache: false,
                success: function (data) {
                    $("#loader").hide();
                    data = JSON.parse(data);
                    if(data.msg == 200) {
                        Swal.fire("Success!", 'Data supporter berhasil dihapus', "success").then((result) => {
                            location.reload();    
                        });                    
                    }else{
                        Swal.fire("Error!", 'Data supporter gagal dihapus', "error");                                           
                    }
                },
                error: function (msg) {
                    $("#loader").hide();
                    Swal.fire("Error!", "Data gagal dihapus!", "error");
                    }
                });
            }
    })
}
