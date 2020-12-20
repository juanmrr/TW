create table if not exists Usuario (
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
);

INSERT INTO usuarios(user, pass, email, direccion, telefono, foto, estado, tipo) VALUES 
	("Pedro",
	 "1234",
	 "aa@example.es",
	 "aaa",
	 "666 666 666",
	 NULL,
	 "Activo",
	 "Administrador")