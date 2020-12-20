<?php 

	require_once 'php/modelos/usuarios/UsuarioVO.inc.php';

	/**
	 * 
	 */
	class GestionUsuarios
	{
			
		function __construct()
		{

		}
		public static function login(){

		}
		public static function logout(){

		}
		
		public static function getUsuario(){
			// Iniciamos la sesión 
			session_start();
			//$usuarioAux = new stdClass(); 
			$usuarioAux = [

				"id" => NULL,
				"user" => NULL,
				"pass" => NULL,
				"email" => NULL,
				"direccion" => NULL,
				"telefono" => NULL,
				"foto" => NULL,
				"estado" => NULL,
				"tipo" => NULL,

			];

			$usuarioAux = (object) $usuarioAux; 

			// No se está intentando logear
			$usuarioTipo = $_SESSION["usuario-tipo"];

			if($usuarioTipo = "Visitante"){
				$usuarioAux -> tipo = "Visitante";  
			}

			return new UsuarioVO(usuarioAux); 

		}

	}


 ?>