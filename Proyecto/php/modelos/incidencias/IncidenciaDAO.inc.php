<?php  
	require_once 'php/modelos/BaseDeDatosIncidencias.inc.php';
	require_once 'php/modelos/validacion.inc.php';
	require_once 'php/modelos/incidencias/IncidenciaVO.inc.php';

	class IncidenciaDAO
	{
		/*
			Hay que validar los parámetros de entrada. 
		*/
		public static function add_incidencia($titulo, $descripcion, $lugar, $palabras_clave, $usuario){

			$tiempo = getdate();
			$hora = $tiempo["hours"] . ":" . $tiempo["minutes"] . ":" . $tiempo["seconds"];
			$fecha = $tiempo["year"] . "-" . $tiempo["mon"] . "-". $tiempo["mday"];

			$sql = "INSERT INTO incidendias( titulo, descripcion, lugar, fecha, hora, idUsuario, estado) VALUES (\"$titulo\",\"$descripcion\",\"$lugar\",\"$fecha\",\"$hora\",$usuario,\"Pendiente\");";

			return BaseDeDatosIncidencias::insertar($sql);

			/*
			if(BaseDeDatosIncidencias::consulta($sql) === TRUE){
				//echo "Se ha insertado una nueva incidencia con exito con éxito\n";
				return TRUE;
			}else{
				//echo "Ha ocurrido un error al insertar la el usuario\n";
				return FALSE;

			}*/

		}


		/*
			- Si sólo se envía un parámetro se cogen las X últimas.
			- Si se envían los dos parámetros se cogen las que estén entre los parámetros indicados. 
			- Si no se envían parámetros, se envían todas. 
		*/
		public static function get_incidencias($inicio = FALSE, $fin = FALSE){

			if($fin){

			}else if($inicio){

			}else{

				/*
				SELECT * FROM incidendias 
				LEFT JOIN incidendias_palabras_clave
				ON incidendias.id = incidendias_palabras_clave.idIncidencia
				GROUP BY incidendias.id
				
				$sql = "SELECT * FROM incidendias_comentarios"; 
				$comentarios = BaseDeDatosIncidencias::consulta($sql);
				$sql = "SELECT * FROM incidendias_palabras_clave";
				$palabras_clave = BaseDeDatosIncidencias::consulta($sql);
				$sql = "SELECT * FROM incidendias_imagenes";
				$imagenes = BaseDeDatosIncidencias::consulta($sql);
				*/

				$sql = "SELECT * FROM incidendias ORDER BY id DESC;";

			}
			$salida = [];
			$resultado = BaseDeDatosIncidencias::consulta($sql);
			for($i = 0; $i<count($resultado); $i++){
				$salida[$i] = new IncicenciaVO($resultado[$i], TRUE);
			}
			return $salida;
		}

		public static function get_incidencias_from_user($idUsuario, $inicio = FALSE, $fin = FALSE){
			if($fin){

			}else if($inicio){

			}else{

				/*
				SELECT * FROM incidendias 
				LEFT JOIN incidendias_palabras_clave
				ON incidendias.id = incidendias_palabras_clave.idIncidencia
				GROUP BY incidendias.id
				
				$sql = "SELECT * FROM incidendias_comentarios"; 
				$comentarios = BaseDeDatosIncidencias::consulta($sql);
				$sql = "SELECT * FROM incidendias_palabras_clave";
				$palabras_clave = BaseDeDatosIncidencias::consulta($sql);
				$sql = "SELECT * FROM incidendias_imagenes";
				$imagenes = BaseDeDatosIncidencias::consulta($sql);
				*/

				$sql = "SELECT * FROM incidendias WHERE idUsuario=$idUsuario ORDER BY id DESC;";

			}
			$salida = [];
			$resultado = BaseDeDatosIncidencias::consulta($sql);
			for($i = 0; $i<count($resultado); $i++){
				$salida[$i] = new IncicenciaVO($resultado[$i], TRUE);
			}
			return $salida;
		}

		public static function remove_incidencia($id){

			$sql = "DELETE FROM `incidendias` WHERE id=$id";
			//echo $sql;
			return BaseDeDatosIncidencias::insertar($sql);
		}

	}

	class Incidendias_palabras_claveDAO{
		public static function get_palabras_clave($id, $inicio = FALSE, $fin = FALSE){
			if($fin){

			}else if($inicio){

			}else{
				$sql = "SELECT * FROM Incidendias_palabras_clave WHERE idIncidencia=$id";
			}
			$salida = [];
			$resultado = BaseDeDatosIncidencias::consulta($sql);
			for($i = 0; $i<count($resultado); $i++){
				$salida[$i] = new Incidendias_palabra_claveVO($resultado[$i]);
			}
			return $salida; 
		}
	}

	class Incidendias_ImagenesDAO{
		public static function get_imagenes($id, $inicio = FALSE, $fin = FALSE){
			if($fin){

			}else if($inicio){

			}else{
				$sql = "SELECT * FROM Incidendias_Imagenes WHERE idIncidencia=$id";
			}
			$salida = [];
			$resultado = BaseDeDatosIncidencias::consulta($sql);
			for($i = 0; $i<count($resultado); $i++){
					$salida[$i] = new Incidendias_ImageneVO($resultado[$i]);
				}
			return $salida; 
		}
	}

	class Incidendias_valoracionesDAO{
		public static function get_valoraciones($id, $inicio = FALSE, $fin = FALSE){
			if($fin){

			}else if($inicio){

			}else{
				$sql = "SELECT * Incidendias_valoracion FROM WHERE idIncidencia=$id";
			}
			$salida = [];
			$resultado = BaseDeDatosIncidencias::consulta($sql);
			for($i = 0; $i<count($resultado); $i++){
					$salida[$i] = new Incidendias_valoracionesVO($resultado[$i]);
				}
			return $salida; 
		}
		public static function get_valoracion($id){
			$salida = 0; 
			$sql = $sql = "SELECT SUM(valoracion)  AS valoracion FROM incidendias_valoraciones WHERE idIncidencia = $id";
			$resultado = BaseDeDatosIncidencias::consulta($sql);
			if(count($resultado) > 0)
				$salida = $resultado[0] -> valoracion;
			return $salida; 
		}
		public static function set_valoracion($id, $valoracion){
			$salida = 0;
			$valoracion = test_int($valoracion, -1, 1)[1];
			$id = test_int_with_min($id, 0)[1]; 

			$sql =  "INSERT INTO incidendias_valoraciones(idIncidencia, valoracion) VALUES ($id,$valoracion)";
			return BaseDeDatosIncidencias::insertar($sql);
		}
	}

	class Incidendias_comentariosDAO{
		public static function get_comentarios($id, $inicio = FALSE, $fin = FALSE){
			if($fin){

			}else if($inicio){
				$sql = "SELECT * FROM Incidendias_comentarios WHERE idIncidencia=$id ORDER BY idComentario limit $inicio;";
			}else{
				$sql = "SELECT * FROM Incidendias_comentarios WHERE idIncidencia=$id ORDER BY idComentario ";
			}

			$salida = [];
			$resultado = BaseDeDatosIncidencias::consulta($sql);
			for($i = 0; $i<count($resultado); $i++){
					$salida[$i] = new Incidendias_comentarioVO($resultado[$i]);
				}
			return $salida; 
		}

		public static function get_ultimoComentario($id){
			$sql = "SELECT * FROM Incidendias_comentarios WHERE idIncidencia=$id ORDER BY idComentario DESC limit 1;";

			$salida = [];
			$resultado = BaseDeDatosIncidencias::consulta($sql);
			$salida[0] = new Incidendias_comentarioVO($resultado[0]);
			return $salida[0]; 
		}

		public static function set_comentario($idIncidencia, $idUsuario, $comentario, $devolverUltimoComentario = FALSE){

			$idIncidencia = test_int_with_min($idIncidencia, 0)[1];
			$idUsuario = test_int_with_min($idUsuario, 0)[1]; 
			$comentario = test_string($comentario);
			$tiempo = getdate();
			$hora = $tiempo["hours"] . ":" . $tiempo["minutes"] . ":" . $tiempo["seconds"];
			$fecha = $tiempo["year"] . "-" . $tiempo["mon"] . "-". $tiempo["mday"];

			$sql = "INSERT INTO incidendias_comentarios(idIncidencia, idUsuario, fecha, hora, comentario) VALUES ($idIncidencia, $idUsuario, \"$fecha\", \"$hora\", \"$comentario\");";
			$inserccionCorrecta = BaseDeDatosIncidencias::insertar($sql);
			//var_dump($inserccionCorrecta); 
			if($devolverUltimoComentario && $inserccionCorrecta){
				return self::get_ultimoComentario($idIncidencia); 
			}else
				return $inserccionCorrecta;

		}
	}

?>