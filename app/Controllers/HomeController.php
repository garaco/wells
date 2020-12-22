<?php

namespace App\Controllers;
use App\Models\PagoModel;

class HomeController{

	public function index() {
			 return view('Catalogos/inicio.twig', ['modelo' => 'home','type'=>$_SESSION['type'],'user'=>$_SESSION['Username']]);
    }

		public function add(){
			// guarda en variables de session mientras no procede la compra
			$row=$_SESSION['contador'];
			if(isset($_POST['cantidad'])){

			    for($i = 0;$i<$row;$i++){

						if($_POST['id']==$_SESSION['producto'][$i]){

							$_SESSION['cantidad'][$i] = $_SESSION['cantidad'][$i]+ $_POST['cantidad'];

						}else if(!in_array($_POST['id'], $_SESSION['producto'])){

								$_SESSION['producto'][$_SESSION['contador']] = $_POST['id'];
								$_SESSION['nombre'][$_SESSION['contador']] = $_POST['nombre'];
								$_SESSION['cantidad'][$_SESSION['contador']] = $_POST['cantidad'];
								$_SESSION['precio'][$_SESSION['contador']] = $_POST['precio'];
								$_SESSION['contador']++;

						}

			  }
			  if($_SESSION['contador']==0){
			    $_SESSION['producto'][$_SESSION['contador']] = $_POST['id'];
					$_SESSION['nombre'][$_SESSION['contador']] = $_POST['nombre'];
			    $_SESSION['cantidad'][$_SESSION['contador']] = $_POST['cantidad'];
					$_SESSION['precio'][$_SESSION['contador']] = $_POST['precio'];
			    $_SESSION['contador']++;
			  }

			}
			// retorno de carrito

			$table='';
			$suma=0;
			$sb=0;
			$alerta="";
			for($i = 0;$i< $_SESSION['contador'];$i++){

			  $table.= "<tr><td>".$_SESSION['nombre'][$i]."</td><td>".$_SESSION['cantidad'][$i]."</td><td> $".$_SESSION['precio'][$i]."</td><td> $".($_SESSION['cantidad'][$i]*$_SESSION['precio'][$i])."</td></tr>";

			  $sb = $sb+($_SESSION['cantidad'][$i]*$_SESSION['precio'][$i]);

			}
			$table.="<tr><td></td><td></td><td> Total </td><td> $".$sb."</td></tr>";
			$alerta=" <small class='badge badge-danger text-wrap'> ".$_SESSION['contador']." </small>";

			return $table."|".$alerta;
		}

		public function pendiente(){
			$table='';
			$suma=0;
			$sb=0;
			$alerta="";
			for($i = 0;$i< $_SESSION['contador'];$i++){

				$table.= "<tr><td>".$_SESSION['nombre'][$i]."</td><td>".$_SESSION['cantidad'][$i]."</td><td> $".$_SESSION['precio'][$i]."</td><td> $".($_SESSION['cantidad'][$i]*$_SESSION['precio'][$i])."</td></tr>";

				$sb = $sb+($_SESSION['cantidad'][$i]*$_SESSION['precio'][$i]);

			}
			if($_SESSION['contador']!=0){
				$table.="<tr><td></td><td></td><td> Total </td><td> $".$sb."</td></tr>";
				$alerta="<small class='badge badge-danger text-wrap'> ".$_SESSION['contador']." </small>";

			}

			return $table."|".$alerta;
		}

		public function limpiar(){

			$_SESSION['contador']=0;
			unset($_SESSION['producto']);
			unset($_SESSION['nombre']);
			unset($_SESSION['cantidad']);
			unset($_SESSION['precio']);
			unset($_SESSION['Total']);

			$table="<tr><td></td><td></td><td> Total </td><td></td></tr>";

			return $table;

		}

}
