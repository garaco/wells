<?php

namespace App;

class Route{
    public function run(){
        $route = array(
            //url
          ['url' => '/', 	        						'ctrl' => 'AuthController@index', 						'type' => 'guest'],

          ['url' => 'index', 						'ctrl' => 'AuthController@index', 						      'type' => 'guest'],
          ['url' => 'login', 						'ctrl' => 'AuthController@logeo', 						      'type' => 'guest'],

          ['url' => 'inicio', 						'ctrl' => 'Principal@index', 						      'type' => 'guest'],
          ['url' => 'registro', 						'ctrl' => 'AuthController@access', 						      'type' => 'guest'],
          ['url' => 'access', 						        'ctrl' => 'AuthController@registro', 				    		'type' => 'guest'],
          ['url' => 'exist', 						        'ctrl' => 'usuariosController@exist', 				    		'type' => 'guest'],

          ['url' => 'home',					    'ctrl' => 'HomeController@index',	    				      'type' => 'admin'],
          ['url' => 'home/add',					    'ctrl' => 'HomeController@add',	    				      'type' => 'guest'],
          ['url' => 'home/pendiente',					    'ctrl' => 'HomeController@pendiente',	    				      'type' => 'guest'],
          ['url' => 'home/limpiar',					    'ctrl' => 'HomeController@limpiar',	    				      'type' => 'guest'],

          ['url' => 'ventas',					    'ctrl' => 'VentasController@index',	    				      'type' => 'admin'],
          ['url' => 'ventas/save',					    'ctrl' => 'VentasController@save',	    				      'type' => 'admin'],
          ['url' => 'pendientes',					    'ctrl' => 'VentasController@pendientes',	    				      'type' => 'admin'],

          ['url' => 'compra',					    'ctrl' => 'ComprasController@index',	    				      'type' => 'cliente'],
          ['url' => 'compra/save',					    'ctrl' => 'ComprasController@save',	    				      'type' => 'cliente'],
          ['url' => 'compra/user',					    'ctrl' => 'ComprasController@compras',	    				      'type' => 'cliente'],
          ['url' => 'compra/cargar',					    'ctrl' => 'ComprasController@cargar',	    				      'type' => 'cliente'],


          ['url' => 'usuarios',					    'ctrl' => 'UsuariosController@index',	    				'type' => 'admin'],
  			  ['url' => 'usuarios/save',				'ctrl' => 'UsuariosController@save',	    					'type' => 'admin'],
          ['url' => 'usuarios/del',				    'ctrl' => 'UsuariosController@del',  						'type' => 'admin'],

          ['url' => 'productos',					    'ctrl' => 'ProductosController@index',	    				'type' => 'admin'],
  			  ['url' => 'productos/save',				'ctrl' => 'ProductosController@save',	    					'type' => 'admin'],
          ['url' => 'productos/del',				    'ctrl' => 'ProductosController@del',  						'type' => 'admin'],

          ['url' => 'proveedores',					    'ctrl' => 'ProveedoresController@index',	    				'type' => 'admin'],
  			  ['url' => 'proveedores/save',				'ctrl' => 'ProveedoresController@save',	    					'type' => 'admin'],
          ['url' => 'proveedores/del',				    'ctrl' => 'ProveedoresController@del',  						'type' => 'admin'],

          ['url' => 'envios',					    'ctrl' => 'EnviosController@index',	    				'type' => 'admin'],
  			  ['url' => 'envios/save',				'ctrl' => 'EnviosController@save',	    					'type' => 'admin'],
          ['url' => 'envios/del',				    'ctrl' => 'EnviosController@del',  						'type' => 'admin'],

          ['url' => 'categorias',					    'ctrl' => 'CategoriasController@index',	    				'type' => 'admin'],
  			  ['url' => 'categorias/save',				'ctrl' => 'CategoriasController@save',	    					'type' => 'admin'],
          ['url' => 'categorias/del',				    'ctrl' => 'CategoriasController@del',  						'type' => 'admin'],

          ['url' => 'descuentos',					    'ctrl' => 'DescuentosController@index',	    				'type' => 'admin'],
          ['url' => 'descuentos/save',				'ctrl' => 'DescuentosController@save',	    					'type' => 'admin'],
          ['url' => 'descuentos/del',				    'ctrl' => 'DescuentosController@del',  						'type' => 'admin'],

          ['url' => 'logout', 					        'ctrl' => 'AuthController@logout', 					    	'type' => 'admin'],
    		  ['url' => 'auth', 						        'ctrl' => 'AuthController@login', 				    		'type' => 'admin'],

          ['url' => '404', 					        	'ctrl' => 'ErrorController@error404',		    			'type' => 'guest'],
			    ['url' => '403', 						        'ctrl' => 'ErrorController@error403', 	    				'type' => 'guest']
        );
        return $route;
    }
}
