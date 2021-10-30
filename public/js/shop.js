var url_request = window.location.protocol + "//" + window.location.host + "/wells/";

var flap = 0;
$(document).ready(function() {
  $.ajax({
    url: url_request+"home/pendiente",
    type: 'POST',
    success: function (data) {
      var datos = data.split("|");
      $('#table-body').html(datos[0]);
      $("#notifica").html(datos[1]);
      if(datos[0] != ""){
        flap = 1;
      }
      
    },
    error: function () {
        $('#table-body').html(ajaxError);
    }
  });
});


function info(nombre,desc){
  $("#section-table").css("display","none")
  $("#titulo").html(nombre);
  $("#cuerpo").html(desc);
}

function carrito(){
  $("#titulo").html('');
  $("#cuerpo").html('');
  $("#section-table").css("display","block");
  if(flap === 0){
    $("#comp").css("display","none");
  }else{
    $("#comp").css("display","block");
  }
  
}

function vaciar(){
  $.ajax({
    url: url_request+"home/limpiar",
    type: 'POST',
    success: function (data) {
      $('#table-body').html(data);
      $("#notifica").html("");
      flap = 0;
      $("#comp").css("display","none");
    },
    error: function () {
        $('#table-body').html(ajaxError);
    }
  });
}
