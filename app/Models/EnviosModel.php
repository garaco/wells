<?php

namespace App\Models;

use App\Config\Executor;

class EnviosModel extends Model {
	public $id;
	public $cp;
	public $precio;

	function __construct(){
		self::$tablename= 'envios';
		$this->id = 0;
		$this->cp = '';
		$this->precio = '';

	}

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (id, cp, precio) VALUES (0, '{$this->cp}', '{$this->precio}');";
		$sql = Executor::doit($query);
		return $sql[1];
	}

	public function update(){
		$sql = "UPDATE ".self::$tablename." SET cp = '{$this->cp}', precio = '{$this->precio}' WHERE id = {$this->id};";
		Executor::doit($sql);
	}


}
