$("#glossaryForm").on('submit', function(e) {
  e.preventDefault();
  var desc = $('textarea#description').val();
  var data = {
    title: $("input[name='title']").val(),
    description: desc
  };

  $.ajax({
    url: '/user/glossary/save',
    type: 'POST',
    dataType: "json",
    data: data,
    timeout: 20000,
    beforeSend: function() {
      $("#loader").show();
    },
    success: function(data) {
      $("#loader").hide();
      if ($.isEmptyObject(data.error) && data.msg == 200) {
        Swal.fire({
          title: 'Berhasil',
          text: 'Berhasil menyimpan Glosarium.',
          type: 'success',
          showCancelButton: false,
          confirmButtonText: 'Ok'
        }).then((result) => {
          window.location = '/user/glossary';
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
    }
  });
});

function deleteGlossary(link, id) {
  var data = { id };
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
              data: data,
              cache: false,
              success: function (data) {
                  $("#loader").hide();
                  data = JSON.parse(data);
                  if(data.msg == 200){
                      Swal.fire("Success!", 'Data berhasil dihapus.', "success").then((result) => {
                          window.location = '/user/glossary';
                      });   
                  }else{
                      Swal.fire("Error!", "Data gagal dihapus!", "error");
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

$("#glossaryFormEdit").on('submit', function(e) {
  e.preventDefault();
  var desc = $('textarea#description').val();
  var id   = $("input[name='id']").val();
  var data = {
    title: $("input[name='title']").val(),
    description: desc
  };

  $.ajax({
    url: `/user/glossary/saveEdit/${id}`,
    type: 'POST',
    dataType: "json",
    data: data,
    timeout: 20000,
    beforeSend: function() {
      $("#loader").show();
    },
    success: function(data) {
      $("#loader").hide();
      if ($.isEmptyObject(data.error) && data.msg == 200) {
        Swal.fire({
          title: 'Berhasil',
          text: 'Berhasil mengubah Glosarium.',
          type: 'success',
          showCancelButton: false,
          confirmButtonText: 'Ok'
        }).then((result) => {
          window.location = '/user/glossary';
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
    }
  });
});