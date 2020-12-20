function mainMenuFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav flex-container justify-content-space-around") {
    x.className = "topnav responsive";
  } else {
    x.className = "topnav flex-container justify-content-space-around";
  }
}

function logout(){
	formulario = document.createElement("form"); 
	formulario.setAttribute("method","post");
	formulario.setAttribute("hidden","");
	input = document.createElement("input"); 
	input.setAttribute("name","action");
	input.setAttribute("value","logout");
	formulario.appendChild(input);
	document.body.appendChild(formulario);
	formulario.submit();
}