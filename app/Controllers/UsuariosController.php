<?php
namespace App\Controllers;
use App\Models\UsuariosModel;

class UsuariosController{
	public function index() {
      $usuario = new UsuariosModel();
      $usuarios = $usuario->getAll('NombreUser');
		 return view('Catalogos/usuario.twig', ['usuarios' => $usuarios, 'modelo' => 'Usuarios','user'=>$_SESSION['Username'],'type'=>$_SESSION['type']]);
    }

    public function save(){
          $save = new UsuariosModel();
          if($_POST['id'] != 0){
              $save = $save->getById($_POST['id'],'IdUser');
          }

          $save->NombreUser = $_POST['Usuario'];
          $save->Nombres = $_POST['Nombre'];
          $save->IdUser = $_POST['id'];
          $save->password = $_POST['password'];
          $save->Apellidos=$_POST['Apellidos'];
          $save->email = $_POST['email'];
          $save->tipo = 'admin';

          if($_POST['id'] == 0){
          	$save->add();
          }else{
            $save->update();
          }
  	}

    public function del(){
  	    $usuario = new UsuariosModel();
        $usuario->delById($_POST['id'],'IdUser');

        redirect('cpanel/usuarios');
  	}

		public function exist(){
			$usuario = new UsuariosModel();
			$datos = $usuario->existe($_POST['user']);

			if($datos->existen>0){
				return 'existe';
			}else{
				return 'no existe';
			}

		}

}
