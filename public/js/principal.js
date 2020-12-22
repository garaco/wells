var url_request = window.location.protocol + "//" + window.location.host + "/wells/";
$("#menu-toggle").click(function (e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
    $('.user').toggleClass("user-show");

});

$(function () {
    var Accordion = function (el, multiple) {
        this.el = el || {};
        this.multiple || false;
        var link = this.el.find('.link');
        link.on('click', { el: this.el, multiple: this.multiple }, this.dropdown);

    }
    Accordion.prototype.dropdown = function (e) {
        var $el = e.data.el,
            $this = $(this),
            $next = $this.next();
        $next.slideToggle();
        $this.parent().toggleClass('open');
        if (!this.multiple) {
            $el.find('.sidebar-submenu').not($next).slideUp().parent().removeClass('open');
        };
    }
    var accordion = new Accordion($('.sidebar-nav'));
});

$(document).ready(function() {
  $.ajax({
    url: url_request+"home/pendiente",
    type: 'POST',
    success: function (data) {
      var datos = data.split("|");
      $('#table-body').html(datos[0]);
      $("#notifica").html(datos[1]);
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
  $("#section-table").css("display","block")
}


function addProduct(id){
  let cantidad = $("#cantiad"+id).val();
  let precio = $("#precio"+id).val();
  let nombre = $("#nombre"+id).val();

  $.ajax({
    url: url_request+"home/add",
    type: 'POST',
    data: {
        id: id,
        cantidad: cantidad,
        precio: precio,
        nombre: nombre
    },
    success: function (data) {
      var datos = data.split("|");
      $('#table-body').html(datos[0]);
      $("#notifica").html(datos[1]);
      Swal.fire({
        width:'30%',
        padding:'0',
        position: 'center',
        icon: 'success',
        title: 'Se ha agregó el producto al carrito de compras.',
        showConfirmButton: false,
        timer: 1500
      });
    },
    error: function () {
        $('#table-body').html(ajaxError);
    }
  });
}

function vaciar(){
  $.ajax({
    url: url_request+"home/limpiar",
    type: 'POST',
    success: function (data) {
      $('#table-body').html(data);
      $("#notifica").html("");
    },
    error: function () {
        $('#table-body').html(ajaxError);
    }
  });
}

function compra(id){

  if(id==null){
    Swal.fire('Por favor inicie sesion para poder realizar la compra');
  }else{
      window.location=url_request+"compra";
  }
}
