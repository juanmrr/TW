<?php 
	require_once 'php/modelos/incidencias/IncidenciaDAO.inc.php';
	require_once 'php/modelos/usuarios/UsuarioDAO.inc.php';

	/**
		id int AUTO_INCREMENT,
		titulo varchar(256) CHARACTER SET utf8,
		descripcion text CHARACTER SET utf8,
		lugar varchar(1024) CHARACTER SET utf8,
		fecha date,
		hora time,
		idUsuario int,
		estado enum('Pendiente', 'Comprobada', 'Tramitada', 'Irresolubre', 'Resuelta'),
			PRIMARY KEY(id),
			FOREIGN KEY(idUsuario) references Usuarios(id) on delete cascade

	 */
	class IncicenciaVO
	{

		private $id;
		private $titulo;
		private $descripcion;
		private $lugar;
		private $fecha;
		private $hora;
		private $idUsuario;
		private $estado;
		private $palabras_clave;
		private $valoraciones; 
		private $valoracion; 
		private $comentarios;
		private $imagenes; 
		
		function __construct($incidencia, $completar = FALSE, $inicio = FALSE, $fin = FALSE)
		{
			$this->id = $incidencia -> id;
			$this->titulo = $incidencia -> titulo;
			$this->descripcion = $incidencia -> descripcion;
			$this->lugar = $incidencia -> lugar;
			$this->fecha = $incidencia -> fecha;
			$this->hora = $incidencia -> hora;
			$this->idUsuario = $incidencia -> idUsuario;
			if(isset($incidencia -> nombreUsuario))
				$this->nombreUsuario = $incidencia -> nombreUsuario;
			else{
				$this->nombreUsuario = UsuarioDAO::get_nombre_usuario($this->idUsuario)[0] -> user;
			}
			$this->estado = $incidencia -> estado;
			
			if(isset($incidencia -> palabras_clave))
				$this->palabras_clave = $incidencia -> palabras_clave;
			else if($completar)
				$this->palabras_clave = Incidendias_palabras_claveDAO::get_palabras_clave($this->id,$inicio,$fin);
			if(isset($incidencia -> valoraciones))
				$this->valoracion = $incidencia -> valoraciones;
			else if($completar)
				$this->valoraciones = Incidendias_valoracionesDAO::get_valoraciones($this->id,$inicio,$fin);
			if(isset($incidencia -> valoracion))
				$this->valoracion = $incidencia -> valoracion;
			else if($completar)
				$this->valoracion = Incidendias_valoracionesDAO::get_valoracion($this->id,$inicio,$fin);
			else
				$this->valoracion = 0;
			if(isset($incidencia -> comentarios))
				$this->comentarios = $incidencia -> comentarios;
			else if($completar)
				$this->comentarios = Incidendias_comentariosDAO::get_comentarios($this->id,$inicio,$fin, 5);
			if(isset($incidencia -> imagenes))
				$this->imagenes = $incidencia -> imagenes;
			else if($completar)
				$this->imagenes = Incidendias_ImagenesDAO::get_imagenes($this->id,$inicio,$fin);
				
		}

		public function get_id(){
			return $this->id;
		}
		public function get_titulo(){
			return $this->titulo;
		}
		public function get_descripcion(){
			return $this->descripcion;
		}
		public function get_lugar(){
			return $this->lugar;
		}
		public function get_fecha(){
			return $this->fecha;
		}
		public function get_hora(){
			return $this->hora;
		}
		public function get_idUsuario(){
			return $this->idUsuario;
		}
		public function get_nombreUsuario(){
			return $this->nombreUsuario;
		}
		public function get_estado(){
			return $this->estado;
		}
		public function get_palabras_clave(){
			return $this->palabras_clave;
		}
		public function get_valoracion(){
			return $this->valoracion;
		}
		public function get_comentarios(){
			return $this->comentarios;
		}
		public function get_imagenes(){
			return $this->imagenes;
		}

	}


	/*
		create table if not exists Incidendias_palabras_clave (
		idIncidencia int,
		idPalabra int,
		palabra varchar(256) CHARACTER SET utf8,
			PRIMARY KEY(idIncidencia, idPalabra),
			FOREIGN KEY(idIncidencia) references Incidendias(id) on delete cascade

	);

	*/
	class Incidendias_palabra_claveVO 
	{
		private $idIncidencia;
		private $idPalabra; 
		private $palabra;

		function __construct($incidencia)
		{

			$this->idIncidencia = $incidencia -> idIncidencia;
			$this->idPalabra = $incidencia -> idPalabra;
			$this->palabra = $incidencia -> palabra;

		}

		public function get_idIncidencia(){
			return $this->idIncidencia;
		}
		public function get_idPalabra(){
			return $this->idPalabra;
		}
		public function get_palabra(){
			return $this->palabra;
		}

	}

	/*
	create table if not exists Incidendias_Imagenes (
		idIncidencia int,
		idImagen int,
		rutaImagen varchar(256) CHARACTER SET utf8,
			PRIMARY KEY(idIncidencia, idImagen),
			FOREIGN KEY(idIncidencia) references Incidendias(id) on delete cascade
	);
	*/
	class Incidendias_ImagenVO 
	{
		private $idIncidencia;
		private $idImagen;
		private $rutaImagen;

		function __construct($incidencia)
		{

			$this->idIncidencia = $incidencia -> idIncidencia;
			$this->idImagen = $incidencia -> idImagen;
			$this->rutaImagen = $incidencia -> rutaImagen;

		}

		public function get_idIncidencia(){
			return $this->idIncidencia;
		}
		public function get_idImagen(){
			return $this->idImagen;
		}
		public function get_rutaImagen(){
			return $this->rutaImagen;
		}

	}


	/*
	create table if not exists Incidendias_valoraciones (
		idIncidencia int,
		idValoracion int,
		valoracion BOOLEAN,
			PRIMARY KEY(idIncidencia, idValoracion),
			FOREIGN KEY(idIncidencia) references Incidendias(id) on delete cascade
	);
	*/
	class Incidendias_valoracionVO
	{
		private $idIncidencia;
		private $idValoracion;
		private $valoracion; 

		function __construct($incidencia)
		{

			$this->idIncidencia = $incidencia -> idIncidencia;
			$this->idValoracion = $incidencia -> idValoracion;
			$this->valoracion = $incidencia -> valoracion;

		}

		public function get_idIncidencia(){
			return $this->idIncidencia;
		}
		public function get_idValoracion(){
			return $this->idValoracion;
		}
		public function get_valoracion(){
			return $this->valoracion;
		}

	}

	/**
	 create table if not exists Incidendias_Comentarios (
	idComentario int AUTO_INCREMENT,,
	idIncidencia int,
	idUsuario int,
	fecha date,
	hora time,
	comentario text CHARACTER SET utf8,
		PRIMARY KEY(idComentario, idIncidencia),
		FOREIGN KEY(idIncidencia) references Incidendias(id) on delete cascade,
		FOREIGN KEY(idUsuario) references Usuarios(id) on delete cascade

);
	 */
	class Incidendias_comentarioVO implements JsonSerializable
	{
		
	private $idComentario;
	private $idIncidencia;
	private $idUsuario;
	private $nombreUsuario; 
	private $fecha;
	private $hora;
	private $comentario;

		function __construct($incidencia)
		{
			$this->idComentario = $incidencia -> idComentario;
			$this->idIncidencia = $incidencia -> idIncidencia;
			$this->idUsuario = $incidencia -> idUsuario;
			if(isset($incidencia -> nombreUsuario))
				$this->nombreUsuario = $incidencia -> nombreUsuario;
			else{
				$this->nombreUsuario = UsuarioDAO::get_nombre_usuario($this->idUsuario)[0] -> user;
			}
			$this->fecha = $incidencia -> fecha;
			$this->hora = $incidencia -> hora;
			$this->comentario = $incidencia -> comentario;
		}

		public function get_idComentario(){
			return $this->idComentario;
		}
		public function get_idIncidencia(){
			return $this->idIncidencia;
		}
		public function get_idUsuario(){
			return $this->idUsuario;
		}
		public function get_nombreUsuario(){
			return $this->nombreUsuario;
		}
		public function get_fecha(){
			return $this->fecha;
		}
		public function get_hora(){
			return $this->hora;
		}
		public function get_comentario(){
			return $this->comentario;
		}

		public function jsonSerialize()
    	{
        	return get_object_vars($this);
    	}

	}


 ?>