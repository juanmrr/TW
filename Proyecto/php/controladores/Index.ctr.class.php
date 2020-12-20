<?php 
	
	require_once 'php/controladores/tools/ControladorConUsuarios.inc.php';
	require_once 'php/modelos/incidencias/IncidenciaDAO.inc.php';

	/**
	 * 
	 */
	class Index extends ControladorConUsuarios
	{	
		
		function __construct(){
			parent::__construct('index.html');
		}

		public function renderizar(){
			$incidencias = IncidenciaDAO::get_incidencias();
			$this->argumentos['incidencias'] = $incidencias;
			//var_dump($this->argumentos); 
			return parent::renderizar();
		}

	}

 ?>