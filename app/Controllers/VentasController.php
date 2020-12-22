<?php

namespace App\Controllers;

use App\Models\ComprasModel;
use App\Models\UsuariosModel;

class VentasController{

	public function index() {

		$compra = new ComprasModel();
		$datos = $compra->getAllVenta('Enviado');
		$detalle = $compra->getAllVentaDet('Enviado');

		return view('Catalogos/Ventas.twig', ['compra' => $datos, 'detalle'=>$detalle, 'modelo' => 'compras','user'=>$_SESSION['Username'],'type'=>$_SESSION['type']]);

    }

		public function pendientes() {

			$compra = new ComprasModel();
			$datos = $compra->getAllVenta('En Proceso');
			$detalle = $compra->getAllVentaDet('En Proceso');

			return view('Catalogos/Ventas.twig', ['compra' => $datos, 'detalle'=>$detalle, 'modelo' => 'compras','user'=>$_SESSION['Username'],'type'=>$_SESSION['type']]);

	    }

		public function save(){
			$save = new ComprasModel();
			$save->estatus=input('estatus');
			$save->direccion=input('codigo');
			$save->id=input('id');
			$save->updateStatus();

			 redirect('pendientes');
		}

}
