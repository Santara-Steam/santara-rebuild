var open = 'la-eye-slash';
var close = 'la-eye';
var toggleResetPassword = document.getElementById('toggleResetPassword');
var newPassword = document.getElementById('newpassword');
var newPasswordConfirmation = document.getElementById('newpasswordconfirmation');

if(toggleResetPassword){
    toggleResetPassword.onclick = function() {
        if( this.classList.contains(open) ) {
            newpassword.type="text";
            newpasswordconfirmation.type="text";
            this.classList.remove(open);
            this.className += ' '+close;
        } else {
            newpassword.type="password";
            newpasswordconfirmation.type="password";
            this.classList.remove(close);
            this.className += ' '+open;
        }
    }
}

var check = 'la-check';
var times = 'la-times red';

$(".submit-form-reset").prop('disabled', true);
var requiredAllCompleted = true;
$('.required-form-reset').each(function(){
    if( $(this).val() == "" ) requiredAllCompleted = false;
});
if ( requiredAllCompleted) $(".submit-form-reset").prop("disabled", false); 

$('.required-form-reset').on('keyup change blur input', function (e){
  $(".submit-form-reset").prop('disabled', true);

  var requiredAllCompleted = true;
  $('#password_error').html("");

  $('.required-form-reset').each(function(){
      if ($(this).val() == "")  {
        requiredAllCompleted = false;
      }
  });

  if ( requiredAllCompleted) $(".submit-form-reset").prop("disabled", false); 
});

$('#newpassword').on('keyup change blur input', function (e){
  newPasswordConfirmation.value = '';
  $('#password_error').html("");
    
  if ( newPassword.value.length < 8 )  {
    $('#password_error').html("Minimal 8 karakter");
    $(".submit-form-reset").prop("disabled", true); 
  }

  if( ( newPasswordConfirmation.value.length > 8 ) && ( newPasswordConfirmation.value != newPassword.value ) ){
    $('#password_error').html("Konfirmasi password salah");
    $('#checkResetPasswordConfirmation').removeClass(check);
    $('#checkResetPasswordConfirmation').addClass(times);
    $(".submit-form-reset").prop("disabled", true);
  }  
});

$('#newpasswordconfirmation').on('keyup change blur input', function (e){
  if ( newPasswordConfirmation.value.length < 8 )  {
    $('#password_error').html("Minimal 8 karakter");
    $(".submit-form-reset").prop("disabled", true); 
  }else{
    if(newPasswordConfirmation.value.length >= newPassword.value.length ){
      if( newPasswordConfirmation.value != newPassword.value ) {
        $('#password_error').html("Konfirmasi password salah");
        $('#checkResetPasswordConfirmation').removeClass(check);
        $('#checkResetPasswordConfirmation').addClass(times);
        $(".submit-form-reset").prop("disabled", true);
      }else{
        $('#checkResetPasswordConfirmation').removeClass(times);
        $('#checkResetPasswordConfirmation').addClass(check);
      }
    }else{
      $('#checkResetPasswordConfirmation').removeClass(check);
      $('#checkResetPasswordConfirmation').removeClass(times);
      $(".submit-form-reset").prop("disabled", true);
    }
  }
});
