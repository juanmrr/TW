<?php  

	/**
	 * 
	 */
	class Sesion 
	{
		
		
		public static function acabarSesion(){
			// La sesión debe estar iniciada
			if (session_status()==PHP_SESSION_ACTIVE )
				// Borrar variables de sesión
				//$_SESSION = array();
				session_unset();
				// Obtener parámetros de cookie de sesión
				$param = session_get_cookie_params();
				// Borrar cookie de sesión
				setcookie(session_name(), $_COOKIE[session_name()], time()-2592000,
				$param['path'], $param['domain'], $param['secure'], $param['httponly']);
				// Destruir sesión
				session_destroy();
			}

	}



?>