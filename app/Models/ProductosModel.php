<?php

namespace App\Models;

use App\Config\Executor;

class ProductosModel extends Model {
	public $id;
	public $codigo;
	public $nombre;
	public $id_categoria;
	public $precio;
	public $modelo;
	public $descripcion;
	public $stock;
	public $id_proveedor;
	public $imagen;


		function __construct(){
			self::$tablename = 'producto';
			$this->id=0;
			$this->codigo='';
			$this->nombre='';
			$this->id_categoria='';
			$this->precio=0;
			$this->modelo='';
			$this->descripcion='';
			$this->stock=0;
			$this->id_proveedor='';
			$this->imagen='';
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

		public function getAllProducto($empresa=0,$ord='id'){
			$sql = "SELECT l.*,(Select Nombre from lineas_productos where IdLinea = l.IdLinea ) as Linea,
			(Select Nombre from proveedores where IdProveedor = l.IdProveedor ) as Proveedor,
			IFNULL(((select IFNULL(sum(Cantidad),0) from ingresos where id_producto = l.IdProducto and id_empresa =  {$empresa})-
			(select IFNULL(sum(Cantidad),0) from venta_detalle where IdProducto = l.IdProducto  and id_empresa =  {$empresa}
		  and (select v.estado from venta as v where v.id = IdVenta limit 1) != 'cancelado' )),0) as existencias
			FROM ".self::$tablename." as l ORDER BY {$ord}";
			$query = Executor::doit($sql);

			return self::many($query[0]);
		}

		public function getCode($field){
			$sql = "SELECT * FROM ".self::$tablename." WHERE Codigo =  '{$field}'";
			$query = Executor::doit($sql);

			return self::one($query[0],new ProductosModel());
		}

		public function getProducto($field){
            $sql = "SELECT * FROM ".self::$tablename." WHERE IdProducto =  {$field}";
			$query = Executor::doit($sql);

      return self::one($query[0],new ProductosModel());
		}

}
