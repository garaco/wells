<?php

namespace App\Models;

use App\Config\Executor;

class DescuentosModel extends Model {
	public $id;
	public $id_producto;
	public $precio_descuento;
	public $dia_inicio;
	public $hora_inicio;
	public $dia_final;
	public $hora_final;
	public $producto;

	function __construct(){
		self::$tablename= 'descuento_produc';
		$this->id = 0;
		$this->id_producto=0;
		$this->precio_descuento=0;
		$this->dia_inicio='';
		$this->hora_inicio='';
		$this->dia_final='';
		$this->hora_final='';
		$this->producto='';

	}

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (id, id_producto, precio_descuento, dia_inicio, hora_inicio, dia_final, hora_final)
		VALUES (0, '{$this->id_producto}', '{$this->precio_descuento}', '{$this->dia_inicio}', '{$this->hora_inicio}', '{$this->dia_final}', '{$this->hora_final}');";
		$sql = Executor::doit($query);
		return $sql[1];
	}

	public function update(){
		$sql = "UPDATE ".self::$tablename." SET id_producto = '{$this->id_producto}', precio_descuento = '{$this->precio_descuento}', dia_inicio = '{$this->dia_inicio}', hora_inicio = '{$this->hora_inicio}',
		dia_final = '{$this->dia_final}', hora_final = '{$this->hora_final}' WHERE id = {$this->id};";
		Executor::doit($sql);
	}

	public function getAllDescuentos(){
		$sql="SELECT *, (SELECT nombre FROM producto WHERE id = id_producto) as producto FROM ".self::$tablename." ORDER BY Id";
		$query = Executor::doit($sql);
		return self::many($query[0]);
	}


}
