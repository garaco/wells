<?php

namespace App;

class Route{
    public function run(){
        $route = array(
            //url
          ['url' => '/', 	        						'ctrl' => 'AuthController@index', 						'type' => 'guest'],

          ['url' => 'login', 						'ctrl' => 'AuthController@index', 						      'type' => 'guest'],
          ['url' => 'inicio', 						'ctrl' => 'Principal@index', 						      'type' => 'guest'],
          ['url' => 'registro', 						'ctrl' => 'AuthController@access', 						      'type' => 'guest'],
          ['url' => 'access', 						        'ctrl' => 'AuthController@registro', 				    		'type' => 'guest'],

          ['url' => 'home',					    'ctrl' => 'homeController@index',	    				      'type' => 'admin'],

           ['url' => 'usuarios',					    'ctrl' => 'usuariosController@index',	    				'type' => 'admin'],
  			   ['url' => 'usuarios/save',				'ctrl' => 'usuariosController@save',	    					'type' => 'admin'],
           ['url' => 'usuarios/del',				    'ctrl' => 'usuariosController@del',  						'type' => 'admin'],

           ['url' => 'productos',					    'ctrl' => 'productosController@index',	    				'type' => 'admin'],
  			   ['url' => 'productos/save',				'ctrl' => 'productosController@save',	    					'type' => 'admin'],
           ['url' => 'productos/del',				    'ctrl' => 'productosController@del',  						'type' => 'admin'],

           ['url' => 'categorias',					    'ctrl' => 'categoriasController@index',	    				'type' => 'admin'],
  			   ['url' => 'categorias/save',				'ctrl' => 'categoriasController@save',	    					'type' => 'admin'],
           ['url' => 'categorias/del',				    'ctrl' => 'categoriasController@del',  						'type' => 'admin'],

           ['url' => 'logout', 					        'ctrl' => 'AuthController@logout', 					    	'type' => 'admin'],
    		   ['url' => 'auth', 						        'ctrl' => 'AuthController@login', 				    		'type' => 'admin'],


          ['url' => '404', 					        	'ctrl' => 'ErrorController@error404',		    			'type' => 'guest'],
			    ['url' => '403', 						        'ctrl' => 'ErrorController@error403', 	    				'type' => 'guest']
        );
        return $route;
    }
}
