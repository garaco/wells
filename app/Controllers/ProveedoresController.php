<?php
namespace App\Controllers;
use App\Models\ProveedoresModel;

class ProveedoresController{
	public function index() {
      $proveedor = new ProveedoresModel();
      $proveedores = $proveedor->getAll('id');

			return view('Catalogos/proveedores.twig', ['proveedores' => $proveedores, 'modelo' => 'proveedores','user'=>$_SESSION['Username'],'type'=>$_SESSION['type']]);
    }

    public function save(){
          $save = new ProveedoresModel();
          if($_POST['id'] != 0){
              $save = $save->getById($_POST['id'],'id');
          }

					$save->id = $_POST['id'];
          $save->nombre = $_POST['nombre'];
          $save->telefono = $_POST['telefono'];
					$save->pagina_web = $_POST['pagina_web'];
					$save->direccion = $_POST['direccion'];

          if($_POST['id'] == 0){
          	$save->add();
          }else{
            $save->update();
          }
  	}

    public function del(){
  	    $del = new ProveedoresModel();
        $del->delById($_POST['id'],'id');
  	}


}
