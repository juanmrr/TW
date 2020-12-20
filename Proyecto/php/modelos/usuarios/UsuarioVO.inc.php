<?php 
	
	/**
		id int AUTO_INCREMENT,
		user varchar(256),
		pass varchar(256),
		email varchar(1024),
		direccion varchar(1024),
		telefono varchar(15),
		foto varchar(256),
		estado enum('Activo', 'Sin_verificar'),
		tipo enum('Visitante', 'Colaborador', 'Administrador'),
			PRIMARY KEY(id)
	 */
	class UsuarioVO 
	{

		private $id;
		private $user;
		private $pass;
		private $email;
		private $direccion;
		private $telefono;
		private $foto;
		private $estado;
		private $tipo;
		
		function __construct($usuario)
		{	
			if(isset($usuario -> id))
				$this->id = $usuario -> id;
			if(isset($usuario -> user))
				$this->user = $usuario -> user;
			if(isset($usuario -> pass))
				$this->pass = $usuario -> pass;
			if(isset($usuario -> email))
				$this->email = $usuario -> email;
			if(isset($usuario -> direccion))
				$this->direccion = $usuario -> direccion;
			if(isset($usuario -> telefono))
				$this->telefono = $usuario -> telefono;
			if(isset($usuario -> foto))
				$this->foto = $usuario -> foto;
			if(isset($usuario -> estado))
				$this->estado = $usuario -> estado;
			if(isset($usuario -> tipo))
				$this->tipo = $usuario -> tipo;
		}

		public function get_id(){
			return $this->id; 
		}
		public function get_user(){
			return $this->user; 
		}
		public function get_pass(){
			return $this->pass; 
		}
		public function get_email(){
			return $this->email; 
		}
		public function get_direccion(){
			return $this->direccion; 
		}
		public function get_telefono(){
			return $this->telefono; 
		}
		public function get_foto(){
			return $this->foto; 
		}
		public function get_estado(){
			return $this->estado; 
		}
		public function get_tipo(){
			return $this->tipo; 
		}


	}


 ?>