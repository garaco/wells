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

		public function getAllProducto(){
			$sql = "Select 
			IFNULL((SELECT p.precio_descuento from descuento_produc as p 
			WHERE NOW() BETWEEN TIMESTAMP(p.dia_inicio,p.hora_inicio) AND TIMESTAMP(p.dia_final,p.hora_final)
			and producto.id = p.id_producto limit 1),0) as descuento,
			id,
			codigo,
			nombre,
			id_categoria,
			if( (select descuento) = 0, precio, (select descuento) ) as precio,
			modelo,
			descripcion,
			stock,
			id_proveedor,
			imagen
			from producto";
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
