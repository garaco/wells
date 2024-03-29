
var input=  document.getElementById('number');
input.addEventListener('input',function(){
  if (this.value.length > 12) 
     this.value = this.value.slice(0,12); 
});


var mes=  document.getElementById('mes');
mes.addEventListener('input',function(){
  if (this.value.length > 2) 
     this.value = this.value.slice(0,2); 
});


var year=  document.getElementById('year');
year.addEventListener('input',function(){
  if (this.value.length > 4) 
     this.value = this.value.slice(0,4); 
})

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

function tipo(){
  let valor = $("#metodo").val();

  if(valor=='Tarjeta'){
    $("#deposito").css("display","none");
    $("#tarjeta").css("display","block");
  }else{
    $("#tarjeta").css("display","none");
    $("#deposito").css("display","block");
  }
}

function valideKey(evt){
  
  console.log(evt)
  //if (evt.value.length > 12) 
   // evt.value = evt.value.slice(0,12); 
     
  // code is the decimal ASCII representation of the pressed key.
  var code = (evt.which) ? evt.which : evt.keyCode;
  
  if(code==8) { // backspace.
    return true;
  } else if(code>=48 && code<=57) { // is a number.
    return true;
  } else{ // other keys.
    return false;
  }


}

function pagar(){
  let valor = $("#metodo").val();

  if(valor=='Tarjeta'){
    let name = $("#name").val();
    let number = $("#number").val();
    let mes = $("#mes").val();
    let year = $("#year").val();
    let cv = $("#cv").val();

    if(name=="" || number=="" || mes=="" || year=="" || cv==""){
      Swal.fire('Por favor llene todos los campos.');
    }else{
      save(valor);
    }
  }else{
    save(valor);
  }


}

function save(tipo){
  var url_request = window.location.protocol + "//" + window.location.host + "/wells/";
  $.ajax({
    url: url_request+"compra/save",
    type: 'POST',
    data: {
        tipo: tipo
    },
    success: function (data) {
      window.location=url_request+"compra/user";
    }
  });
}

$(document).ready(function() {
    $('#table').DataTable(
      {
        "pagingType": "full_numbers",
        "ordering": false,
        "searching": true,
        language: {
          "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrar _MENU_ registros",
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "Ningún dato disponible en esta tabla",
          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix":    "",
          "sSearch":         "Buscar:",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
              "sFirst":    "Primero",
              "sLast":     "Último",
              "sNext":     ">",
              "sPrevious": "<"
          },
          "oAria": {
              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          },
            "buttons": {
                "copyTitle": 'Informacion copiada',
                "copyKeys": 'Use your keyboard or menu to select the copy command',
                "copySuccess": {
                    "_": '%d filas copiadas al portapapeles',
                    "1": '1 fila copiada al portapapeles'
                },

                "pageLength": {
                    "_": "Mostrar %d filas",
                    "-1": "Mostrar Todo"
                }
            }
        },
        responsive:'true',
        "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "Mostrar Todo"]],
        dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>> <'row'<'col-sm-12'tr>> <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: {
          dom: {
            container: {
                tag: 'div',
                className: 'flexcontent'
            },
            buttonLiner: {
                tag: null
            }
          },
          buttons:[
      			{
      				extend:    'excelHtml5',
      				text:      '<i class="fa fa-file-excel-o"></i> ',
      				titleAttr: 'Exportar a Excel',
      				className: 'btn btn-success scale'
      			},
      			{
      				extend:    'pdfHtml5',
      				text:      '<i class="fa fa-file-pdf-o"></i> ',
      				titleAttr: 'Exportar a PDF',
      				className: 'btn btn-danger scale',
              customize:function(doc) {
                doc.styles.title = {
                    color: '#004fff',
                    fontSize: '15',
                    alignment: 'center'
                },
                doc.styles['td:nth-child(2)'] = {
                    width: '100px',
                    'max-width': '100px'
                },
                doc.styles.tableHeader = {
                    fillColor:'#0094ff',
                    color:'white',
                    alignment:'center'
                },
                doc.content[1].margin = [ 2, 0, 2, 0 ]
              }
      			},
            {
              extend: 'pageLength',
              titleAttr: 'Registros a mostrar',
              className: 'selectTable'
            }
    		]
      }
    });
});
