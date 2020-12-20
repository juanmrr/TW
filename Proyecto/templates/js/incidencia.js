function mostrarComentarios(posicion) {
  var x = document.getElementsByClassName("incidencia-cuerpo-anadir_comentario")[posicion];
  if(x.getAttribute("hidden") != null)
  	x.removeAttribute("hidden");
  else
  	x.setAttribute("hidden","");
}

function set_valoracion(id, valoracion, posicion) {

	let ajax = new XMLHttpRequest();

	let params = "id=" + id + "&valoracion=" + valoracion; 
	ajax.open("POST", "./set_valoracion.php", true);
	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajax.send(params);

	// Vemos lo que nos devuelve el servidor
	ajax.onreadystatechange = function () {
		if(this.readyState == 4 && this.status == 200) {
			console.log(this.responseText);
		}
	};

	// Incrementamos el valor de la valoración mediante JavaScript
  	let x = document.getElementsByClassName("incidencia-cuerpo-datos-valoracion")[posicion];
  	let valor = parseInt(x.innerText, 10);

  	if(isNaN(valor))
  		valor = 0; 
  	x.innerText = valor + valoracion; 

}

function set_comentario(id, posicion) {

  	let comentario = document.getElementsByClassName("incidencia-cuerpo-anadir_comentario-cometario-textarea")[posicion].value;

  	let ajax = new XMLHttpRequest();
	let params = JSON.stringify({	id:id,
								  	comentario: comentario,
								  	action:"insertar"}); 

	//console.log(params); 
	ajax.open("POST", "./formularioComentario.php");
	ajax.setRequestHeader("Content-type", "application/json;charset=UTF-8");
	ajax.send(params);

	// Vemos lo que nos devuelve el servidor
	ajax.onreadystatechange = function () {
		if(this.readyState == 4 && this.status == 200) {
			let mensaje = document.getElementsByClassName("incidencia-cuerpo-anadir_comentario-result")[posicion];
			mensaje.setAttribute("role","alert");
			console.log(this.responseText);
			//Si la respuesta es correcta, añadimos el comentario
			if(this.responseText != false){
				//Se elimina el texto del textarea
				document.getElementsByClassName("incidencia-cuerpo-anadir_comentario-cometario-textarea")[posicion].value = "";
				// Añadimos un mensaje de éxito
				mensaje.className = "incidencia-cuerpo-anadir_comentario-cometario alert alert-success";
				mensaje.getElementsByTagName("p")[0].innerText = "Se ha añadido el cometario con éxito.";


				actualizar_cometarios(posicion, JSON.parse(this.responseText)); 
			}else{
				mensaje.getElementsByTagName("p")[0].innerText = "No se ha podido registrar su comentario."; 
				mensaje.className = "incidencia-cuerpo-anadir_comentario-cometario alert alert-danger";

			}



		}
	};
}

function actualizar_cometarios(posicion, comentario) {

	//console.log(document.getElementsByClassName("incidencia-cuerpo-comentarios")[posicion]); 
	let comentarios = document.getElementsByClassName("incidencia-cuerpo-comentarios")[posicion];
	
	console.log(comentario);

	let comentario_nuevo = `<article class="incidencia-cuerpo-comentarios-comentario bg-light">
						<div class="row">
							<div class="card col-sm-12">
								<div class="row card-body">
									<section class="incidencia-cuerpo-comentarios-comentario-datos col-sm-2">
										<section class="incidencia-cuerpo-comentarios-comentario-datos-autor">
											<p>` + comentario.nombreUsuario + `</p>
										</section>
										<section class="incidencia-cuerpo-comentarios-comentario-datos-fecha">
											<time>` + comentario.fecha + ` ` + comentario.hora + `</time>
										</section>
									</section>
									<section class="incidencia-cuerpo-comentarios-comentario-texto col-sm-9">
										<p>
											` + comentario.comentario + `
										</p>
									</section>
								</div>
							</div>
						</div>
					</article>`
	comentarios.insertAdjacentHTML("beforeend", comentario_nuevo); 
	
	//comentarios.appendChild(nuevoComentario);

}

function eliminarIncidencia(idIncidencia, posicion) {	
	
	fetch("./formularioIncidencia.php?action=eliminar&idIncidencia=" + idIncidencia)
	//fetch("./formularioIncidencia.php?action=eliminar&idIncidencia=")
		.then(function(respuesta) {
			return respuesta.text();
		}).then(function(texto) {
			console.log(texto);
			if(texto == "true"){
				console.log("Se ha recibido una respuesta correcta por parte del servidor");
				let aux = document.getElementsByClassName("incidencia")[posicion];
				aux.parentNode.removeChild(aux); 
				console.log("")
			}else{
				console.log("No se ha podido eliminar la incidencia.");
				let aux = document.getElementsByClassName("incidencia")[posicion];
				aux.insertAdjacentHTML("beforeend", `
													<div class="alert alert-danger mx-3" role="alert">
													  <strong style="font-size: larger;">No se ha podido borrar la incidencia</strong>
													</div>
													`); 
			}
		});
}