<?php

namespace App\Auth;

use App\Models\UsuariosModel;

class Auth{
    public function isAuth() {
      return (user() != null);
    }

    public function auth($user, $pass){
        $user = UsuariosModel::getByUser($user, $pass);

		return $user;
    }

    public function register($user, $pass, $name, $surname, $email, $tel, $cp, $direccion){
        $users = new UsuariosModel();
        $users->NombreUser=$user;
        $users->Nombres = $name;
        $users->Apellidos=$surname;
        $users->tipo = 'cliente';
        $users->email = $email;
        $users->password=$pass;
        $users->direccion=$direccion;
        $users->telefono=$tel;
        $users->cp = $cp;
        $id = $users->add();
    return $id;
    }

    public function logout() {
        session_unset();
        session_destroy();
        redirect('index');
    }

}
