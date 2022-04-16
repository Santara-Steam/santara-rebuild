const btnVerifikasi = document.getElementById('btnVerifikasi');
const email = document.getElementById('email');

btnVerifikasi.disabled = true;
$('#email').on('keyup blur input change paste', function (e){
    if ( (!is_empty(email.value)) ) {
        btnVerifikasi.disabled = false;    
    }else{
        btnVerifikasi.disabled = true;
    }
})
