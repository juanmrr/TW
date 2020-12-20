<?php 
	require_once 'php/controladores/Index.ctr.class.php';
	require_once 'php/controladores/FormularioIncidencia.ctr.class.php';
	require_once 'php/controladores/MisIncidencias.ctr.class.php';
	require_once 'php/controladores/Incidencia.ctr.class.php';
	
/**
 * 
 */
class ConroladorFactory
{
	
	private function __construct()
	{
		# code...
	}
	
	public static function createController($ruta)
	{
		switch ($ruta) {
			case 'index.php':
				return new Index(); 
				break;
			case 'formularioIncidencia.php':
				return new FormularioIncidencia(); 
				break;
			case 'misIncidencias.php':
				return new MisIncidencias(); 
				break;
			case 'incidencia.php':
				return new Incidencia(); 
				break;
			default:
				# code...
				break;
		}
	}
}


 ?>