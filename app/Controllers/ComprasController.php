<?php

namespace App\Controllers;

use App\Models\ComprasModel;
use App\Models\UsuariosModel;

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

		$_SESSION['Total']=$sb+$costo->envio;
		return view('Catalogos/Comprar.twig', ['table' => $Compra, 'total'=>$sb, 'modelo' => 'compras','user'=>$_SESSION['Username'],'type'=>$_SESSION['type'], "costo"=>$costo->envio]);
    }

		public function compras(){
			$compra = new ComprasModel();
			$datos = $compra->getVenta('id_user',$_SESSION['IdUser']);
			$detalle = $compra->getVentaDet($_SESSION['IdUser']);

			return view('Catalogos/Compras.twig', ['compra' => $datos, 'detalle'=>$detalle, 'modelo' => 'compras','user'=>$_SESSION['Username'],'type'=>$_SESSION['type']]);
		}

    public function save(){
       $user = new UsuariosModel();
			 $result = $user->getUser($_SESSION['IdUser']);
			 $direccion = $result->direccion;

			 $save = new ComprasModel();
			 $save->id_user=$_SESSION['IdUser'];
			 $save->descuento=0;
			 $save->total_pagar=$_SESSION['Total'];
			 $save->estatus='En Proceso';
			 $save->direccion=$direccion;
			 $id = $save->add();

			 for($i = 0;$i< $_SESSION['contador'];$i++){
				 $save->id_venta=$id;
				 $save->cantidad=$_SESSION['cantidad'][$i];
				 $save->id_producto=$_SESSION['producto'][$i];
				 $save->precio=$_SESSION['precio'][$i];
				 $save->addDetalle();

			 }

			 $_SESSION['contador']=0;
			 unset($_SESSION['producto']);
			 unset($_SESSION['nombre']);
			 unset($_SESSION['cantidad']);
			 unset($_SESSION['precio']);
			 unset($_SESSION['Total']);

			$datos = $save->getVenta('id',$id);
 			$detalle = $save->getVentaDet($_SESSION['IdUser']);

 			return view('Catalogos/Compras.twig', ['compra' => $datos, 'detalle'=>$detalle, 'modelo' => 'compras','user'=>$_SESSION['Username'],'type'=>$_SESSION['type']]);
  	}

}
