<?php

namespace App\Models;

use App\Config\Executor;

class ComprasModel extends Model {
	public $id;
	public $fecha;
	public $id_user;
	public $descuento;
	public $total_pagar;
	public $estatus;
	public $descripcion;
	public $tiket;
	public $envio;

		function __construct(){
			self::$tablename = 'venta';
			$this->id=0;
			$this->fecha='';
			$this->id_user='';
			$this->descuento='';
			$this->total_pagar=0;
			$this->estatus='';
			$this->descripcion='';
			$this->tiket='';
			$this->envio=0;
		}

		public function add(){
			$query = "INSERT INTO ".self::$tablename." (id, codigo, nombre, id_categoria, precio, modelo, descripcion, stock, id_proveedor, imagen)
			VALUES (0, '{$this->codigo}', '{$this->nombre}', {$this->id_categoria}, {$this->precio}, '{$this->modelo}', '{$this->descripcion}', {$this->stock}, {$this->id_proveedor}, '$this->imagen')";
			$sql = Executor::doit($query);

			return $sql[1];
		}

		public function update(){
			$sql = "UPDATE ".self::$tablename." SET codigo = '{$this->codigo}', nombre = '{$this->nombre}', id_categoria = '{$this->id_categoria}', descripcion = '{$this->descripcion}',
			id_proveedor = {$this->id_proveedor}, precio = {$this->precio}, modelo = '{$this->modelo}', stock = {$this->stock},
			imagen = '{$this->imagen}' WHERE id = '{$this->id}';";

			Executor::doit($sql);
		}


		public function getCode($id){
			$sql = "select e.cp as envio from envios as e where e.cp = (select u.cp from usuarios as u where u.IdUser = $id)";
			$query = Executor::doit($sql);

			return self::one($query[0],new ProductosModel());
		}


}
