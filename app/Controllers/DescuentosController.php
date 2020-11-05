<?php
namespace App\Controllers;
use App\Models\DescuentosModel;

class DescuentosController{
	public function index() {
      $descuento = new DescuentosModel();
      $descuentos = $descuento->getAllDescuentos();

			return view('Catalogos/descuentos.twig', ['descuentos' => $descuentos, 'modelo' => 'descuentos','user'=>$_SESSION['Username'],'type'=>$_SESSION['type']]);
    }

    public function save(){
          $save = new DescuentosModel();
          if($_POST['id'] != 0){
              $save = $save->getById($_POST['id'],'id');
          }

					$save->id = $_POST['id'];
					$save->id_producto=$_POST['id_producto'];
					$save->precio_descuento=$_POST['precio_descuento'];
					$save->dia_inicio=$_POST['dia_inicio'];
					$save->hora_inicio=$_POST['hora_inicio'];
					$save->dia_final=$_POST['dia_final'];
					$save->hora_final=$_POST['hora_final'];

          if($_POST['id'] == 0){
          	$save->add();
          }else{
            $save->update();
          }
  	}

    public function del(){
  	    $del = new DescuentosModel();
        $del->delById($_POST['id'],'id');
  	}


}
