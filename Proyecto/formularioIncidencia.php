<?php  

	require_once get_include_path() . PATH_SEPARATOR . '/php/controladores/tools/ControladorFactory.inc.php';
	echo ConroladorFactory::createController('formularioIncidencia.php')->renderizar();


?>