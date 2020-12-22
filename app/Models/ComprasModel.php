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
	public $direccion;
	public $envio;
	public $tipo;
	public $id_venta;
	public $cantidad;
	public $id_producto;
	public $precio;
	public $producto;

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
			$this->direccion='';
			$this->tipo='';
			$this->envio=0;
			$this->id_venta=0;
			$this->cantidad=0;
			$this->id_producto=0;
			$this->precio=0;
			$this->producto='';
		}

		public function add(){
			$query = "INSERT INTO ".self::$tablename." (id, id_user, descuento, total_pagar, estatus, descripcion, tiket, direccion, tipo)
			VALUES (0, {$this->id_user}, {$this->descuento}, {$this->total_pagar}, '{$this->estatus}', '', '', '{$this->direccion}', '{$this->tipo}')";
			$sql = Executor::doit($query);

			return $sql[1];
		}

		public function addDetalle(){
			$query = "INSERT INTO venta_detalle(id, id_venta, cantidad, id_producto, precio)
			VALUES (0, {$this->id_venta}, {$this->cantidad}, {$this->id_producto}, {$this->precio})";
			$sql = Executor::doit($query);

			return $sql[1];
		}

		public function update(){
			$sql="UPDATE ".self::$tablename." SET tiket = '{$this->tiket}' WHERE id = {$this->id}";
			Executor::doit($sql);
		}

		public function updateStatus(){
			$sql="UPDATE ".self::$tablename." SET estatus = '{$this->estatus}', descripcion = '{$this->direccion}' WHERE id = {$this->id}";
			Executor::doit($sql);
		}


		public function getCode($id){
			$sql = "select e.precio as envio from envios as e where e.cp = (select u.cp from usuarios as u where u.IdUser = $id)";
			$query = Executor::doit($sql);

			return self::one($query[0],new ComprasModel());
		}

		public function getVenta($campo,$id){
			$sql = "select * from venta where $campo = $id order by id desc";
			$query = Executor::doit($sql);

			return self::many($query[0],new ComprasModel());
		}

		public function getVentaDet($id){
			$sql = "select *,(select nombre from producto where id = id_producto) as producto
							from venta_detalle
							inner join venta as v on v.id = id_venta
							where v.id_user = $id";
			$query = Executor::doit($sql);
		 }

			public function getAllVenta($status){
				$sql = "select * from venta where estatus = '$status' order by id desc";
				$query = Executor::doit($sql);

				return self::many($query[0],new ComprasModel());
			}

			public function getAllVentaDet($status){
				$sql = "select *,(select nombre from producto where id = id_producto) as producto
								from venta_detalle
								inner join venta as v on v.id = id_venta
								where v.estatus = '$status'";
				$query = Executor::doit($sql);

			return self::many($query[0],new ComprasModel());
		}

}
