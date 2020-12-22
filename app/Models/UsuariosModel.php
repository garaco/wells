<?php

namespace App\Models;

use App\Config\Executor;

class UsuariosModel extends Model {
	public $IdUser;
	public $NombreUser;
	public $password;
	public $Nombres;
	public $Apellidos;
	public $tipo;
	public $email;
	public $direccion;
	public $telefono;
	public $cp;
	public $existen;

	function __construct(){
		self::$tablename = 'usuarios';
		$this->Iduser = '';
		$this->NombreUser='';
		$this->Nombres = '';
		$this->Apellidos='';
		$this->tipo = '';
		$this->email = '';
		$this->password='';
		$this->direccion='';
		$this->telefono='';
		$this->cp = '';
		$this->existen = '';
	}
	public function add(){
		$query = "INSERT INTO ".self::$tablename." (IdUser, NombreUser, password, Nombres, Apellidos, email , Tipo, direccion, telefono, cp)
		VALUES ('0', '{$this->NombreUser}', AES_ENCRYPT('{$this->password}','Quetzalcoatl'), '{$this->Nombres}', '{$this->Apellidos}', '{$this->email}', '{$this->tipo}', '{$this->direccion}', '{$this->telefono}', '{$this->cp}')";

		$sql = Executor::doit($query);
		return $sql[1];
	}

	public function update(){
		$sql = "UPDATE ".self::$tablename." SET NombreUser='{$this->NombreUser}',
		password=AES_ENCRYPT('{$this->password}','Quetzalcoatl'), Nombres='{$this->Nombres}',
		Apellidos='{$this->Apellidos}', email='{$this->email}', Tipo='{$this->tipo}', direccion='{$this->direccion}', telefono='{$this->telefono}'
		, cp='{$this->cp}' WHERE IdUser = {$this->IdUser}";
		Executor::doit($sql);
	}

	public static function getRanges($ord = 'id'){
        $sql = "SELECT u.*, concat(u.Nombres,' ', u.Apellidos) as NombreCompleto, tu.descripcion as Perfil
				FROM ".self::$tablename." as u left JOIN tipo_usuario tu on tu.id_tipo_usuario=u.id_tipo_usuario ORDER BY u.{$ord} ";
        $query = Executor::doit($sql);
        return self::many($query[0]);
    }

    public static function getSearchs($field, $key, $ord = 'id'){
        $sql = "SELECT u.*, concat(u.Nombres,' ', u.Apellidos) as NombreCompleto, tu.descripcion as Perfil
        			FROM ".self::$tablename." as u left JOIN tipo_usuario tu on tu.id_tipo_usuario=u.id_tipo_usuario  WHERE {$field} LIKE '%{$key}%' ORDER BY {$ord} LIMIT 0, 25";
        $query = Executor::doit($sql);

        return self::many($query[0]);
    }

    public static function getAlls($ord = 'id'){
        $sql = "SELECT u.*, concat(u.Nombres,' ', u.Apellidos) as NombreCompleto FROM ".self::$tablename." as u ORDER BY {$ord}";
        $query = Executor::doit($sql);

        return self::many($query[0]);
    }

		public static function getByUser($name,$pass){
			$sql = "SELECT * FROM usuarios WHERE NombreUser = '{$name}' and aes_decrypt(password,'Quetzalcoatl') = '{$pass}'";
			$query = Executor::doit($sql);

			return Model::one($query[0], new UsuariosModel());
		}

		public static function getUser($id){
			$sql = "SELECT IdUser,NombreUser,Nombres,Apellidos,Tipo as tipo,email,direccion,
			aes_decrypt(password,'Quetzalcoatl') as password FROM ".self::$tablename." WHERE IdUser = '{$id}' ";
			$query = Executor::doit($sql);

			return Model::one($query[0],new UsuariosModel());
		}

		public static function existe($user){
			$sql = "SELECT count(*) as existen from ".self::$tablename." where NombreUser = '{$user}'";
			$query = Executor::doit($sql);

			return Model::one($query[0],new UsuariosModel());
		}
}
