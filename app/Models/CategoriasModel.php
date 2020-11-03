<?php

namespace App\Models;

use App\Config\Executor;

class CategoriasModel extends Model {
	public $id;
	public $codigo;
	public $nombre;
	public $descripcion;

	function __construct(){
		self::$tablename= 'categoria';
		$this->id = 0;
		$this->codigo = '';
		$this->nombre = '';
		$this->descripcion = '';

	}

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (id, codigo, nombre, descripcion) VALUES (0, '{$this->codigo}', '{$this->categoria}', '{$this->descripcion}');";
		$sql = Executor::doit($query);
		return $sql[1];
	}

	public function update(){
		$sql = "UPDATE ".self::$tablename." SET codigo = '{$this->codigo}', nombre = '{$this->categoria}', descripcion = '{$this->descripcion}' WHERE id = {$this->id};";
		Executor::doit($sql);
	}


}
