<?php

namespace App\Controllers;

use App\Auth\Auth;

class AuthController {
    protected $auth;

    public function __construct() {
        $this->auth = new Auth();
    }

    public function index() {
  		if(isset($_GET['msg'])) {
  			return view('index.twig', ['msg' => $_GET['msg']]);
  		}elseif(!isset($_SESSION['Username'])) {
  			return view('index.twig');
  		}else {
  			redirect('home');
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
			 redirect('home');
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
        $_SESSION['type']  = 'admin';
       redirect('home');

    }

    public function logout() {
        $this->auth->logout();
    }
}
