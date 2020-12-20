<?php 
	require_once 'php/controladores/tools/ControladorConUsuarios.inc.php';
	require_once 'php/modelos/incidencias/IncidenciaDAO.inc.php';
	/**
	 * 
	 */
	class MisIncidencias extends ControladorConUsuarios
	{
		
		function __construct()
		{
			parent::__construct('misIncidencias.html');
			
		}

		public function renderizar(){
			if(self::permisos())
				$incidencias = IncidenciaDAO::get_incidencias_from_user($this->idUsuario);
			else
				return parent::permisoDenegado();

			$this->argumentos['incidencias'] = $incidencias;
			//var_dump($this->argumentos); 
			return parent::renderizar();
		}

		private function permisos($accion = FALSE){

			return $this->tipoUsuario === "Administrador" || $this->tipoUsuario === "Colaborador"; 

		}
	}

 ?>