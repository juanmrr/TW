function verificarFormulario() {

	let pass1 = document.getElementById("form-pass1").value;
	let pass2 = document.getElementById("form-pass2").value;

	if(pass1.localeCompare(pass2) != 0){
		let msgError = document.getElementById("msgErrorPass").innerHTML = "La contraseña no coincide.";
		document.getElementById("msgErrorPass").removeAttribute("hidden");
	}else{
		var formulario =document.forms["form-datosUsuario"].elements;

		//console.log(formulario); 

		/*
		Array​.prototype​.forEach(function callback(campo, index, array){
			if(campo.setAttribute("type").localeCompare("submit"))
				campo.setAttribute(readonly,"");
			else
			campo.setAttribute("Confirmar la modificación del usuario.");
		}[formulario]);

				formulario.foreach(campo => {
			if(campo.setAttribute("type").localeCompare("submit"))
				campo.setAttribute(readonly,"");
			else
			campo.setAttribute("Confirmar la modificación del usuario.");
		});

		*/
		
		for (let i = 0; i < formulario.length; i++) {
			let campo = formulario[i];
			
			console.log(campo.getAttribute("type"));

			if(campo.getAttribute("type") != null && !campo.getAttribute("type").localeCompare("submit")){
				campo.setAttribute("value","Confirmar la modificación del usuario.");
				campo.setAttribute("onclick","enviarDatosUsuario()");
			}else if(campo.getAttribute("type") == null || campo.getAttribute("type") == "file"){
				campo.setAttribute("disabled","");
			}else{
				campo.setAttribute("readonly","");

			}

		}
		
	}
}

function verificarFormulario() {
	
	
	
}