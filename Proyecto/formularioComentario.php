<?php 
	
	require_once get_include_path() . PATH_SEPARATOR . '/php/modelos/incidencias/IncidenciaDAO.inc.php';
	
	//$datos = json_decode($_POST["json"]);
	//Recibimos el JSON del post de JavaScript
	$datos = json_decode(file_get_contents("php://input")); 
	//var_dump($datos); 
	//Incidendias_valoracionesDAO::set_valoracion($_POST["id"],$_POST["valoracion"]); 
	switch ($datos -> action) {
		case 'insertar':
			//$comentario = Incidendias_comentariosDAO::set_comentario($datos->id,1,$datos->comentario; 
			$respuesta = json_encode(Incidendias_comentariosDAO::set_comentario($datos->id,1,$datos->comentario, TRUE));
			//var_dump($respuesta);
			echo $respuesta;
			break;
		
		default:
			echo 0;
			break;
	}

	
 ?>