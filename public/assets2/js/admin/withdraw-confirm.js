function confirmWithdraw(uuid,name,number,bank,total,saldo){

    Swal.fire({
        title: "<strong>" + total + "</strong>",
        html: `<table class="table table-borderless dividend-detail" style="text-align: left;font-size: 12px;font-weight: 500;">
            <tbody>
              <tr>
                <td>Nama </td>
                <td>:</td>
                <td>`+ name +`</td>
              </tr>
              <tr>
                <td>Bank</td>
                <td>:</td>
                <td>`+ bank +`</td>
              </tr>
              <tr>
                <td>Nomor Rekening</td>
                <td>:</td>
                <td>`+ number +`</td>
              </tr>
              <tr>
                <td><strong>Saldo Tersedia</strong></td>
                <td>:</td>
                <td><strong>`+ saldo +`</strong></td>
              </tr>             
            </tbody>
          </table>`,
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Ya, Verifikasi',
        cancelButtonText: 'Tidak',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $("#loader").show();
            $.ajax({            
                type: 'GET',
                url: "/withdraw/update/" + uuid +"/"+1,
                cache: false,
                success: function (data) {
                    $("#loader").hide();
                    data = JSON.parse(data);
                    if(data.msg == 200){
                         Swal.fire(
                            'Berhasil',
                            'Verifikasi withdraw sebesar '+ total +' berhasil dilakukan',
                            'success'
                        ).then((result) => {
                            location.reload();                    
                        });                            
                    }else{
                        if(data.msg){
                            Swal.fire("Error!", 'Gagal melakukan verifikasi, \n'+ data.msg, "error").then((result) => {
                                location.reload();                    
                            });
                        }else{
                            Swal.fire("Error!", 'Gagal melakukan verifikasi', "error").then((result) => {
                                location.reload();                    
                            });
                        }
                                                    
                    }

                },
                error: function (data) {
                    $("#loader").hide();
                    console.log(data);
                    Swal.fire("Error!", 'Gagal melakukan verifikasi', "error").then((result) => {
                        location.reload();                    
                    });    
                }
            });
      } 
    });    
};

function rejectWithdraw(uuid,name,number,total){

    Swal.fire({
        title: "<strong> Tolak Withdraw </strong>",
        text: 'Masukan alasan penolakan Withdraw',
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
                url: "/withdraw/update/" + uuid +"/"+2+"/"+input,
                cache: false,
                success: function (data) {
                    $("#loader").hide();
                    data = JSON.parse(data);                    
                    if(data.msg == 200){
                         Swal.fire(
                            'Berhasil',
                            'Pengajuan withdraw berhasil ditolak',
                            'success'
                        ).then((result) => {
                            location.reload();                    
                        });                            
                    }else{
                        Swal.fire("Error!", 'Gagal melakukan tolak withdraw', "error").then((result) => {
                            location.reload();                    
                        });                            
                    }

                },
                error: function (data) {
                    $("#loader").hide();
                    Swal.fire("Error!", 'Gagal melakukan tolak withdraw', "error").then((result) => {
                        location.reload();                    
                    });    
                }
            });
            }
        }

    });    
};
