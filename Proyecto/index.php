<?php 
	//echo get_include_path() . PATH_SEPARATOR; 
	//set_include_path("/home/alumnos/1819/plfuertes1819/public_html/proyecto"); 
	require_once 'php/controladores/tools/ControladorFactory.inc.php';
	echo ConroladorFactory::createController('index.php')->renderizar(); 

 ?>