create table if not exists Incidendias (
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

);

create table if not exists Incidendias_Comentarios (
	idComentario int AUTO_INCREMENT,
	idIncidencia int,
	idUsuario int,
	fecha date,
	hora time,
	comentario text CHARACTER SET utf8,
		PRIMARY KEY(idComentario, idIncidencia),
		FOREIGN KEY(idIncidencia) references Incidendias(id) on delete cascade,
		FOREIGN KEY(idUsuario) references Usuarios(id) on delete cascade

);

create table if not exists Incidendias_palabras_clave (
	idPalabra int AUTO_INCREMENT,
	idIncidencia int,
	palabra varchar(256) CHARACTER SET utf8,
		PRIMARY KEY(idPalabra, idIncidencia),
		FOREIGN KEY(idIncidencia) references Incidendias(id) on delete cascade

);

create table if not exists Incidendias_Imagenes (
	idImagen int AUTO_INCREMENT,
	idIncidencia int,
	rutaImagen varchar(256),
		PRIMARY KEY(idImagen, idIncidencia),
		FOREIGN KEY(idIncidencia) references Incidendias(id) on delete cascade
);

create table if not exists Incidendias_valoraciones (
	idValoracion int AUTO_INCREMENT,
	idIncidencia int,
	idUsuario int,
	valoracion BOOLEAN,
		PRIMARY KEY(idValoracion, idIncidencia),
		FOREIGN KEY(idIncidencia) references Incidendias(id) on delete cascade
		FOREIGN KEY(idUsuario) references Usuarios(id) on delete cascade
);




INSERT INTO incidendias( titulo, descripcion, lugar, fecha, hora, idUsuario, estado) VALUES 
	(1,
	 "Incidencia 1",
	 "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
	 "Pozoblanco",
	 date("1996-07-16"),
	 "12:30:00",
	 1, 
	 "Pendiente"
	)
