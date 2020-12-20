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

          ['url' => 'home',					    'ctrl' => 'homeController@index',	    				      'type' => 'admin'],
          ['url' => 'home/add',					    'ctrl' => 'homeController@add',	    				      'type' => 'guest'],
          ['url' => 'home/pendiente',					    'ctrl' => 'homeController@pendiente',	    				      'type' => 'guest'],
          ['url' => 'home/limpiar',					    'ctrl' => 'homeController@limpiar',	    				      'type' => 'guest'],

           ['url' => 'usuarios',					    'ctrl' => 'usuariosController@index',	    				'type' => 'admin'],
  			   ['url' => 'usuarios/save',				'ctrl' => 'usuariosController@save',	    					'type' => 'admin'],
           ['url' => 'usuarios/del',				    'ctrl' => 'usuariosController@del',  						'type' => 'admin'],

           ['url' => 'productos',					    'ctrl' => 'productosController@index',	    				'type' => 'admin'],
  			   ['url' => 'productos/save',				'ctrl' => 'productosController@save',	    					'type' => 'admin'],
           ['url' => 'productos/del',				    'ctrl' => 'productosController@del',  						'type' => 'admin'],

           ['url' => 'proveedores',					    'ctrl' => 'proveedoresController@index',	    				'type' => 'admin'],
  			   ['url' => 'proveedores/save',				'ctrl' => 'proveedoresController@save',	    					'type' => 'admin'],
           ['url' => 'proveedores/del',				    'ctrl' => 'proveedoresController@del',  						'type' => 'admin'],

           ['url' => 'envios',					    'ctrl' => 'enviosController@index',	    				'type' => 'admin'],
  			   ['url' => 'envios/save',				'ctrl' => 'enviosController@save',	    					'type' => 'admin'],
           ['url' => 'envios/del',				    'ctrl' => 'enviosController@del',  						'type' => 'admin'],

           ['url' => 'categorias',					    'ctrl' => 'categoriasController@index',	    				'type' => 'admin'],
  			   ['url' => 'categorias/save',				'ctrl' => 'categoriasController@save',	    					'type' => 'admin'],
           ['url' => 'categorias/del',				    'ctrl' => 'categoriasController@del',  						'type' => 'admin'],

           ['url' => 'descuentos',					    'ctrl' => 'descuentosController@index',	    				'type' => 'admin'],
           ['url' => 'descuentos/save',				'ctrl' => 'descuentosController@save',	    					'type' => 'admin'],
           ['url' => 'descuentos/del',				    'ctrl' => 'descuentosController@del',  						'type' => 'admin'],

           ['url' => 'logout', 					        'ctrl' => 'AuthController@logout', 					    	'type' => 'admin'],
    		   ['url' => 'auth', 						        'ctrl' => 'AuthController@login', 				    		'type' => 'admin'],


          ['url' => '404', 					        	'ctrl' => 'ErrorController@error404',		    			'type' => 'guest'],
			    ['url' => '403', 						        'ctrl' => 'ErrorController@error403', 	    				'type' => 'guest']
        );
        return $route;
    }
}
