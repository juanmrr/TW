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