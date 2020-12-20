<?php 
	
	require_once get_include_path() . PATH_SEPARATOR . '/php/modelos/incidencias/IncidenciaDAO.inc.php';

	//Incidendias_valoracionesDAO::set_valoracion($_POST["id"],$_POST["valoracion"]); 
	echo (Incidendias_valoracionesDAO::set_valoracion($_POST["id"],$_POST["valoracion"]));
	
 ?>