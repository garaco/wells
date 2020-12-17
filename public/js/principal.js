function info(nombre,desc){
  $("#section-table").css("display","none")
  $("#titulo").html(nombre);
  $("#cuerpo").html(desc);
}

function carrito(){
  $("#titulo").html('');
  $("#cuerpo").html('');
  $("#section-table").css("display","block")
}
