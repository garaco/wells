<?php

namespace App\Models;

use App\Config\Executor;

class ProveedoresModel extends Model {
	public $id;
	public $nombre;
	public $direccion;
	public $telefono;
	public $pagina_web;

	function __construct(){
		self::$tablename= 'proveedor';
		$this->id = 0;
		$this->nombre = '';
		$this->direccion = '';
		$this->telefono = '';
		$this->pagina_web = '';

	}

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (id, nombre, direccion, telefono, pagina_web) VALUES (0, '{$this->nombre}', '{$this->direccion}', '{$this->telefono}', '{$this->pagina_web}');";
		$sql = Executor::doit($query);
		return $sql[1];
	}

	public function update(){
		$sql = "UPDATE ".self::$tablename." SET nombre = '{$this->nombre}', direccion = '{$this->direccion}', telefono = '{$this->telefono}', pagina_web = '{$this->pagina_web}' WHERE id = {$this->id};";
		Executor::doit($sql);
	}


}
