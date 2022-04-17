function confirmDeposit(uuid,photo,name,total){

    Swal.fire({
        title: "<strong> Verifikasi Deposit</strong>",
        imageUrl: photo,
        imageAlt: 'screenshot',    
        html: `<table class="table table-borderless dividend-detail" style="text-align: left;font-size: 12px;font-weight: 500;">
            <tbody>
              <tr>
                <td>Nama </td>
                <td>:</td>
                <td>`+ name +`</td>
              </tr>
              <tr>
                <td>Total</td>
                <td>:</td>
                <td>`+ total +`</td>
              </tr>             
            </tbody>
          </table>`,
        showCancelButton: true,
        confirmButtonText: 'Ya, Verifikasi',
        cancelButtonText: 'Tidak',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $("#loader").show();
            $.ajax({            
                type: 'GET',
                url: "/deposit/update/" + uuid +"/"+1,
                cache: false,
                success: function (data) {
                    $("#loader").hide();
                    if(data){
                         Swal.fire(
                            'Berhasil',
                            'Verifikasi deposit sebesar '+ total +' berhasil dilakukan',
                            'success'
                        ).then((result) => {
                            location.reload();                    
                        });                            
                    }else{
                        Swal.fire("Error!", 'Gagal melakukan verifikasi', "error").then((result) => {
                            location.reload();                    
                        });                            
                    }

                },
                error: function (data) {
                    $("#loader").hide();
                    Swal.fire("Error!", 'Gagal melakukan verifikasi', "error").then((result) => {
                        location.reload();                    
                    });    
                }
            });

      }
    });    
};

function detailDeposit(photo){

    Swal.fire({
        title: "<strong> Bukti Verifikasi Deposit</strong>",
        imageUrl: photo,
        imageAlt: 'screenshot'
    });
};

function rejectDeposit(uuid){

    Swal.fire({
        title: "<strong> Tolak Deposit </strong>",
        text: 'Masukan alasan penolakan Deposit',
        input: 'text',
        showCancelButton: true,
        confirmButtonText: 'Ya, Tolak',
        cancelButtonText: 'Tidak',
        reverseButtons: true,
        preConfirm: (input) => {
            if(input === ''){
                Swal.showValidationMessage('alasan penolakan tidak boleh kosong')                
            }else{
            $("#loader").show();
            $.ajax({            
                type: 'GET',
                url: "/deposit/update/" + uuid + "/"+2+"/"+input,
                cache: false,
                success: function (data) {
                    $("#loader").hide();
                    if(data){
                         Swal.fire(
                            'Berhasil',
                            'Tolak deposit berhasil dilakukan',
                            'success'
                        ).then((result) => {
                            location.reload();                    
                        });                            
                    }else{
                        Swal.fire("Error!", 'Gagal melakukan tolak deposit', "error").then((result) => {
                            location.reload();                    
                        });                            
                    }

                },
                error: function (msg) {
                    $("#loader").hide();
                    Swal.fire("Error!", 'Gagal melakukan tolak deposit', "error").then((result) => {
                        location.reload();                    
                    });    
                }
            });
            }
        }

    });    
};
