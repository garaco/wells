<?php

namespace App\Config;

use mysqli;

class DB {
	public static $db;
	public static $con;

	function __construct(){
		$this->user="comuni60_admin";
		$this->pass="Garaco.17";
		$this->host="162.241.61.208";
		$this->ddbb="comuni60_tienda";
	}

	function connect(){
		$con = new mysqli($this->host,$this->user,$this->pass,$this->ddbb) or die("Error en la conexión");
		return $con;
	}

    public static function getCon(){
        if(self::$con==null && self::$db==null){
            self::$db = new DB();
            self::$con = self::$db->connect();
			self::$con;
        }
        return self::$con;
    }
}
