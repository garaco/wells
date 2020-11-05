<?php
namespace App\Controllers;
use App\Models\EnviosModel;

class EnviosController{
	public function index() {
      $envio = new EnviosModel();
      $envios = $envio->getAll('id');

			return view('Catalogos/envios.twig', ['envios' => $envios, 'modelo' => 'envios','user'=>$_SESSION['Username'],'type'=>$_SESSION['type']]);
    }

    public function save(){
          $save = new EnviosModel();
          if($_POST['id'] != 0){
              $save = $save->getById($_POST['id'],'id');
          }

					$save->id = $_POST['id'];
          $save->cp = $_POST['cp'];
          $save->precio = $_POST['precio'];

          if($_POST['id'] == 0){
          	$save->add();
          }else{
            $save->update();
          }
  	}

    public function del(){
  	    $del = new EnviosModel();
        $del->delById($_POST['id'],'id');
  	}


}
