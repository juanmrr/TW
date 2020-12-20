<?php  
	require_once 'php/modelos/BaseDeDatosIncidencias.inc.php';
	require_once 'php/modelos/validacion.inc.php';
	require_once 'php/modelos/usuarios/UsuarioVO.inc.php';

	/**
	 	private $id;
		private $user;
		private $pass;
		private $email;
		private $direccion;
		private $telefono;
		private $foto;
		private $estado;
		private $tipo;
	 */
	class UsuarioDAO
	{
		
		public static function add_user($user, $pass, $email, $direccion, $telefono, $foto, $estado, $tipo){

			/*** Validaciones ***/
			$user = test_string($user, 256);
			#$pass =
			$email = test_email($email, 1024); 
			$direccion = test_string($direccion, 1024);
			$telefono = test_string($telefono, 15);
			$foto = test_string($foto, 15);
			$estado = test_string($estado, 15);
			$tipo = test_string($tipo, 15);

			$sql = "INSERT INTO usuarios(user, pass, email, direccion, telefono, foto, estado, tipo) VALUES ($user, $pass, $email, $direccion, $telefono, $foto, $estado, $tipo)";

			if(BaseDeDatosIncidencias::getConexion() -> insertar($sql) === TRUE)
				echo "Se ha insertado un nuevo usuario con éxito\n";
			else
				echo "Ha ocurrido un error al insertar la el usuario\n";
		}

		public static function get_nombre_usuario($id){
			$sql = "SELECT user FROM Usuarios WHERE id=$id;";
			return BaseDeDatosIncidencias::consulta($sql); 
		}

		public static function check_user_pass($user, $pass){
			$sql = "SELECT id FROM Usuarios WHERE user='$user' AND pass=$pass";
			//var_dump($sql); 
			return BaseDeDatosIncidencias::consulta($sql); 
		}

		public static function get_usuario_tipo($id){
			$sql = "SELECT tipo FROM usuarios WHERE id=$id";
			$aux = BaseDeDatosIncidencias::consulta($sql); 
			if($aux)
				return $aux[0] -> tipo;
			else
				return FALSE; 
		}

		public static function get_usuario_basico($id){
			$sql = "SELECT `id`, `user`, `email`, `foto`, `estado`, `tipo` FROM `usuarios` WHERE id=$id";
			$aux = BaseDeDatosIncidencias::consulta($sql);
			//echo $sql . "\n";
			//var_dump($aux); 
			if($aux)
				return new UsuarioVO($aux[0]); 
			else
				return FALSE; 
		}

	}

?>