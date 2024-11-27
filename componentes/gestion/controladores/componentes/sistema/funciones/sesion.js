/**
 * @author Juan Pablo Llinás Ramírez
 */


function validar_usuario(){
 	
	ejecutarAccionSinBloqueo(
		"sistema", "sesion","validar_usuario",
		$("#login-form").serialize() , 
		"repuesta_validar(data);"
	);	
	return false;    		
}


function recargar_sesion_usuario(){ 	
	ejecutarAccionSinBloqueo(
		"sistema", "sesion","reinciar_usuario", '', 
		"repuesta_validar(data);"
	);	
	return false;    		
}

function repuesta_validar(resp){

	switch( resp ){
		case 'CORRECTO':
			ejecutarAccionSinBloqueo(
				"sistema", "sesion", "iniciar_sesion",
				$("#login-form").serialize() , 
				"setTimeout( 'window.location.reload();' , 100); "
			);	
			informacion('Estamos entrando al sistema');
		break;
		case 'RECARGADO':
			setTimeout( 'window.location.reload();' , 10); 
		break;		
		default:	
			ejecutarAccionSinBloqueo(
				"sistema", "sesion", "error_sesion",
				$("#login-form").serialize() + '&login-error='+resp , 
				"error(data);"
			);	
		break;
	}	
}


function cerrar_sesion() {
  
  ejecutarAccionSinBloqueo(
	"sistema", "sesion","cerrar_sesion",
	"", "setTimeout( 'window.location.reload();' , 1000); "
  );
  
}
