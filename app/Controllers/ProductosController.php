<?php

namespace App\Controllers;

use App\Models\ProductosModel;

class ProductosController{
	public function index() {
      $proc = new ProductosModel();
      $procducto = $proc->getAll('id');

		 return view('Catalogos/productos.twig', ['productos' => $procducto, 'modelo' => 'productos','user'=>$_SESSION['Username'],'type'=>$_SESSION['type']]);
    }

    public function save(){
      $save = new ProductosModel();
			if($_POST['id'] != 0){
					$save = $save->getById($_POST['id'],'id');
			}

			$save->id=$_POST['id'];
			$save->codigo=$_POST['code'];
			$save->nombre=$_POST['nombre'];
			$save->id_categoria=$_POST['categoria'];
			$save->descripcion=$_POST['des'];
			$save->id_proveedor=$_POST['proveedor'];
			$save->precio=$_POST['precio'];
			$save->modelo=$_POST['modelo'];
			$save->stock=$_POST['stock'];
			

			if($_FILES['imagen']['name'] != null){
        $explode = explode("/", $_FILES['imagen']['type']);
        $save->imagen = resourceImg().$_POST['code'].'.'.$explode[1];
        $router = $_FILES['imagen']['tmp_name'];
        $destino=$save->imagen;
        copy($router, $destino);
      }


          if($_POST['id'] == 0){
              $save->add();
          } else{
              $save->update();
          }
  	}

    public function del(){
  	    $del = new ProductosModel();
          $del->delById($_POST['id'],'id');

  	}
}
