$(".submit-form").prop('disabled', true);
var requiredAllCompleted = true;
$('.required-form').each(function(){
    if( $(this).val() == "" ) requiredAllCompleted = false;
});
if ( requiredAllCompleted) $(".submit-form").prop("disabled", false); 

$('.required-form').on('keyup change blur input', function (){
  // Each time a check is performed, consider the button disabled as a start.
  $(".submit-form").prop('disabled', true);

  // Set a var to use as a "flag".
  var requiredAllCompleted = true;

  // Cycle through them all.  
  $('.required-form').each(function(){
      if( $(this).val() == "" ) requiredAllCompleted = false;
  });

  // If all required fields not empty
  // Unlock the submit button.
  if ( requiredAllCompleted) $(".submit-form").prop("disabled", false); 
});



