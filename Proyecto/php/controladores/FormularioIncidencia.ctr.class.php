<?php 
	require_once 'php/controladores/tools/ControladorConUsuarios.inc.php';
	require_once 'php/modelos/incidencias/IncidenciaDAO.inc.php';

	/**
	 * 
	 */
	class FormularioIncidencia extends ControladorConUsuarios
	{
		
		function __construct(){
			parent::__construct('formularioIncidencia.html');
		}

		public function renderizar(){

			if(isset($_POST["action"])){
				if(self::permisos($_POST["action"])){
					switch ($_POST["action"]) {
						case 'insertar':
							self::insertar(); 
							break;
						case 'eliminar':
							return parent::renderizarJson(self::eliminar());
							break;
						default:
							$resultado = "	<section id='resultado' class='alert alert-danger' role='alert'>
			  									<p id='exito'>No se ha recibido una petición válida.<p>
											</section>";
							$this->argumentos['resultado'] = $resultado;
							break;
					}
				}else{
					return parent::permisoDenegado();
				}
			}else if(isset($_GET["action"])){
				if(self::permisos($_GET["action"])){
				switch ($_GET["action"]) {
					case 'insertar':
						$this->argumentos['titulo'] 		= "Nueva Incidencia";
						$this->argumentos['boton_enviar'] 	= "Enviar datos";
						$this->argumentos['required']		= "required";
						$this->argumentos['action'] 		= "insertar";
						break;
					case 'editar':
						//$comentario = Incidendias_comentariosDAO::set_comentario($datos->id,1,$datos->comentario;
						$this->argumentos['titulo'] 		= "Editar Incidencia";
						$this->argumentos['boton_enviar'] 	= "Enviar datos";
						$this->argumentos['required']		= "";
						$this->argumentos['action'] 		= "editar";
						break;
					case 'eliminar':
						return parent::renderizarJson(self::eliminar());
						break;
					default:
						break;
				}
				}else{
					return parent::permisoDenegado();
				}
			}
			return parent::renderizar();
			
		}

		private function insertar(){
			if(count($_POST) != 0){
				$titulo = $_POST["titulo"];
				$descripcion = $_POST["descripcion"];
				$lugar = $_POST["lugar"];
				$palabras_clave = $_POST["palabras_clave"];
				if($this->idUsuario)
					$resultado = IncidenciaDAO::add_incidencia($titulo, $descripcion, $lugar, $palabras_clave, $this->idUsuario);

				if($resultado)
					$resultado = "	<section id='resultado' class='alert alert-success' role='alert'>
		  								<p id='exito'>Se ha registrado la incidencia con éxito.<p>
									</section>";
				else
					$resultado = "	<section id='resultado' class='alert alert-danger' role='alert'>
		  								<p id='exito'>No se ha podido registrar la incidencia.<p>
									</section>";

				$this->argumentos['titulo'] 		= "Nueva Incidencia";
				$this->argumentos['boton_enviar'] 	= "Enviar datos";
				$this->argumentos['required']		= "required";
				$this->argumentos['action'] 		= "insertar";
				$this->argumentos['resultado'] = $resultado;

			}
		}
		private function eliminar(){
			if(isset($_GET["idIncidencia"])){
				$idIncidencia = $_GET["idIncidencia"];
				if(IncidenciaDAO::remove_incidencia($idIncidencia)){
					return TRUE;
				}else{
					return FALSE; 
				}
			}

			return "FALSE"; 
		}
		private function permisos($accion = FALSE){
			if($accion == "eliminar")
				return TRUE;

			if($this->tipoUsuario === "Administrador" || $this->tipoUsuario === "Colaborador"){
				if($accion == "insertar" || ($accion == "editar" && $this->tipoUsuario === "Administrador")){
					return TRUE;
				}
				else{
					return FALSE;
				}
			}else
				return FALSE; 

		}

	}

 ?>