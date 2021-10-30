<?php

namespace App\Controllers;

use App\Auth\Auth;
use App\Models\ProductosModel;

class AuthController {
    protected $auth;

    public function __construct() {
        $this->auth = new Auth();
    }

    public function index() {
      $proc = new ProductosModel();
      $procducto = $proc->getAllProducto();
      if(isset($_SESSION['Username'])){
          return view('index.twig',['productos' => $procducto, 'user'=>$_SESSION['Username'],'type'=>$_SESSION['type']]);
      }else{
        return view('index.twig',['productos' => $procducto]);
      }

    }

    public function logeo() {
  		if(isset($_GET['msg'])) {
  			return view('login.twig', ['msg' => $_GET['msg']]);
  		}elseif(!isset($_SESSION['Username'])) {
  			return view('login.twig');
  		}else {
  			redirect('index');
  		}
    }

    public function access() {
      return view('access.twig');
    }

    public function login() {

        $user = input('user');
        $pass = input('pass');
        $auth = $this->auth->auth($user, $pass);

        if($auth != null) {
            session_start();
            $_SESSION['Username'] = $user;
    	      $_SESSION['Nombre']  = $auth->Nombres;
    		    $_SESSION['IdUser']    = $auth->IdUser;
            $_SESSION['type']  = $auth->Tipo;
            $_SESSION['contador']=0;
			 redirect('index');
        } else {
            redirect('login?msg=error402');
        }
    }

    public function registro() {

      $user = input('user');
      $pass = input('pass');
      $name = input('name');
      $surname = input('surname');
      $email = input('email');
      $tel = input('tel');
      $cp = input('cp');
      $direccion = input('direccion');
       $auth = $this->auth->register($user, $pass, $name, $surname, $email, $tel, $cp, $direccion);


        session_start();
        $_SESSION['Username'] = $user;
        $_SESSION['Nombre']  = $name;
        $_SESSION['IdUser']    = $auth;
        $_SESSION['type']  = 'cliente';
       redirect('index');

    }

    public function logout() {
        $this->auth->logout();
    }
}
