
function password(){
  let pass = $('#pass').val();
  let pass2 = $('#pass2').val();

  if(pass != pass2){
      $('#error').html('<div class="alert alert-danger" role="alert"> Las contraseñas no coinciden </div>');
      $("#btn").attr('disabled',true);
  }else{
    $('#error').html(' ');
    $("#btn").attr('disabled',false);
  }
}


function exist(){
  let user = $('#user').val();

  $.ajax({
      url: 'exist',
      type: 'POST',
      data: {
          user: user,
      },
      success: function (data) {

        if(data=='existe'){
            $('#exist').html('<p class="text-danger"> usuario ya existe </p>');
            $("#btn").attr('disabled',true);
        }else {
          $('#exist').html('');
          $("#btn").attr('disabled',false);
        }

      }
  });
}
