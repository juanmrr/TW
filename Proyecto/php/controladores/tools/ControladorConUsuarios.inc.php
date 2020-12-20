<?php 

	require_once 'php/controladores/tools/Controlador.inc.php';
	require_once 'php/modelos/usuarios/UsuarioDAO.inc.php';
		
	abstract class ControladorConUsuarios{
		protected $tipoUsuario;
		protected $idUsuario; 
		protected $usuario; 
		protected $ruta;
		protected $argumentos; 
		function __construct($ruta)
		{	
			$this->ruta = $ruta; 
			//abrimos la sesión
			session_start();
			//Gestinamos el login
			if(isset($_POST["action"])){
				switch ($_POST["action"]) {
					case 'login':
						self::login($_POST["user"], $_POST["pass"]);
						break;
					case 'logout':
						self::logout();
						break;
					default:
						//Si es por otro formulario no se hace nada
						break;
				}
			}

			if (isset($_SESSION["usuarioId"])) {//El usuario está registrado
				$this->idUsuario = $_SESSION["usuarioId"];
				$this->usuario = UsuarioDAO::get_usuario_basico($_SESSION["usuarioId"]);
				if($this->usuario)
					$this->tipoUsuario = $this->usuario->get_tipo();
			}else{
				$this->tipoUsuario = "Visitante";
			}
			//controlUsuario($pagina); 
				//var_dump($this->tipoUsuario);

		}

		private function login($user, $pass)
		{
			$aux = UsuarioDAO::check_user_pass($user, $pass);
			if($aux){
				$_SESSION["usuarioId"] = $aux[0] -> id;
			}

		}

		private function logout()
		{
			if (session_status()==PHP_SESSION_NONE)
			session_start();
			// Borrar variables de sesión
			session_unset(); 
			// Obtener parámetros de cookie de sesión
			$param = session_get_cookie_params();
			// Borrar cookie de sesión
			setcookie(session_name(), $_COOKIE[session_name()], time()-2592000,
			$param['path'], $param['domain'], $param['secure'], $param['httponly']);
			// Destruir sesión
			session_destroy();
		}

		private function controlUsuario($pagina){

		}

		public function get_tipo(){
			return $this->tipoUsuario;
		}

		public function get_id()
		{
			return $this->idUsuario;
		}

		protected function renderizar(){
			$this->argumentos["tipoUsuario"] =  $this->tipoUsuario;
			$this->argumentos["idUsuario"] = $this->idUsuario;
			if($this->tipoUsuario != "Visitante")
				$this->argumentos["usuario"] = $this->usuario;
			//var_dump($this->argumentos["usuario"]); 
			//var_dump($this->argumentos);
			return Controlador::renderizar($this->ruta, $this->argumentos);
		}

		protected function permisoDenegado(){
			$this->argumentos = []; 
			$this->ruta = "permisoDenegado.html";
			return self::renderizar(); 
		}
		protected function renderizarJson($json){
			return json_encode($json); 
		}

	}

 ?>