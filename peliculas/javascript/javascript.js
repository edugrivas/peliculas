$(document).ready(function(){
    $('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
});

function registrarse(formularioRegistro){

    if(!(/[a-z]+/.test(formularioRegistro.login.value))){
                        // Informar al usuario
                        alert("Fallo en el login");
			// LLevamos al usuario al campo erroneo
			formularioRegistro.usuario.focus();
			// Devolvemos falso para parar el envío del formulario
                   	return false;
        
    }
    

    if(formularioRegistro.password.value.length < 8){
                        // Le decimos al usuario que la contraseña es muy corta
                        alert("La contraseña es demasiado corta");
                        // Devolvemos falso para parar el envío del formulario
			return false;
        
    }
    
    if(!/^(\s*[A-Z]{1}[a-z]+)+$/.test(formularioRegistro.nombre.value)){
		alert("Nombre introducido es incorrecto, debe empezar por mayúsculas.");
		return false;
	}
    if(!/^(\s*[A-Z]{1}[a-z]+)+$/.test(formularioRegistro.apellidos.value)){
		alert("Apellido introducido es incorrecto, debe empezar por mayúsculas.");
		return false;
            }
                
   
            
    if(!/[a-z]+@[a-z]+\.[a-z]+$/.test(formularioRegistro.email.value)){
       	alert("El Email no cumple con el patron. Ejemplo: 'edu@gmail.com'");
                return false;
    }
    
    return true;
}

function cambiarContrasena(contrasenas){
    
    if(!(contrasenas.password1.value == contrasenas.password2.value)){
                        // Informamos al usuario de que las contraseñas no coinciden
                        alert("Las contraseñas no coinciden");
                        // LLevamos al usuario al campo erroneo
			contrasenas.password1.focus();
                        // Devolvemos falso para parar el envío del formulario
			return false;
    
}

    if(contrasenas.password1.value.length < 8){
                        // Le decimos al usuario que la contraseña es muy corta
                        alert("La nueva contraseña es demasiado corta");
                        // Devolvemos falso para parar el envío del formulario
			return false;

}

  
return true;

}