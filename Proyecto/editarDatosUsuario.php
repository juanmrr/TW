<?php 
	
	require_once './vendor/autoload.php';
	require_once './php/modelos/incidencias/IncidenciaDAO.inc.php';
	
	$loader = new \Twig\Loader\FilesystemLoader('.');

	$twig = new \Twig\Environment($loader);
	
	$argumentos = ['titulo' 		=> "Edición de Usuario", 
				   'boton_enviar' 	=> "Modificar Usuario"];

	$template = $twig -> load('./templates/html/formularioUsuario.html');
	
	echo $template -> render($argumentos);
	
 ?>