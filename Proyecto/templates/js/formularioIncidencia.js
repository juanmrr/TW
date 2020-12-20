function verificarFormularioIncidencia() {

	var formulario =document.forms["form-formulario_incidencia"].elements;
	
	for (let i = 0; i < formulario.length; i++) {
		let campo = formulario[i];
		
		if(campo.getAttribute("type") != null && !campo.getAttribute("type").localeCompare("submit")){
			campo.setAttribute("value","Confirmar la inserción");
			campo.setAttribute("onclick","enviarFormularioIncidencia()");
		}else if(campo.getAttribute("type") == null || campo.getAttribute("type") == "file"){
			campo.setAttribute("disabled","");
		}else{
			campo.setAttribute("readonly","");
		}
	}

	document.forms["form-formulario_incidencia"].removeAttribute("onsubmit"); 
	document.forms["form-formulario_incidencia"].setAttribute("onsubmit","enviarFormularioIncidencia()");
	document.forms["form-formulario_incidencia"].removeAttribute("action"); 
	document.forms["form-formulario_incidencia"].setAttribute("action","./formularioIncidencia.php");

	return false; 
		
}

function enviarFormularioIncidencia() {
	document.forms["form-formulario_incidencia"].removeAttribute("onclick"); 
	document.forms["form-formulario_incidencia"].removeAttribute("action"); 
	document.forms["form-formulario_incidencia"].setAttribute("action","./formularioIncidencia.php");

	var formulario =document.forms["form-formulario_incidencia"].elements;
	
	for (let i = 0; i < formulario.length; i++) {
		let campo = formulario[i];
		if(campo.getAttribute("type") == null || campo.getAttribute("type") == "file"){
			campo.removeAttribute("disabled"); 
		}else{
			campo.removeAttribute("readonly"); 
		}
	}

}