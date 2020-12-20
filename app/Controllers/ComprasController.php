<?php

namespace App\Controllers;

use App\Models\ComprasModel;

class ComprasController{
	public function index() {

		$table='';
		$suma=0;
		$sb=0;
		$alerta="";
		$Compra = array();
		for($i = 0;$i< $_SESSION['contador'];$i++){

			$table.= "<tr><td>".$_SESSION['nombre'][$i]."</td><td>".$_SESSION['cantidad'][$i]."</td><td> $".$_SESSION['precio'][$i]."</td><td> $".($_SESSION['cantidad'][$i]*$_SESSION['precio'][$i])."</td></tr>";

			$sb = $sb+($_SESSION['cantidad'][$i]*$_SESSION['precio'][$i]);
			$Compra[$i] = array("nombre"=>$_SESSION['nombre'][$i] , "cantidad"=>$_SESSION['cantidad'][$i], "precio"=>$_SESSION['precio'][$i], "total"=>($_SESSION['cantidad'][$i]*$_SESSION['precio'][$i]) );
		}

		$cp = new ComprasModel();

		$costo = $cp->getCode($_SESSION['IdUser']);
			return view('Catalogos/Comprar.twig', ['table' => $Compra, 'total'=>$sb, 'modelo' => 'compras','user'=>$_SESSION['Username'],'type'=>$_SESSION['type'], "costo"=>$costo->envio]);
    }

    public function save(){
      // $save = new ProductosModel();
			if($_POST['id'] != 0){
					$save = $save->getById($_POST['id'],'id');
			}




          if($_POST['id'] == 0){
              $save->add();
          } else{
              $save->update();
          }
  	}

}
