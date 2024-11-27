/**
 * @author Ing. Juan Pablo Llinas Ramirez
 */

function informacion(mensaje,  titulo ) {	
	$.msgbox( mensaje , 
		{
			type: "info",
			title: titulo			
		}, 
		function(result) { 
			//$("#result2").text(result); 
		}
	);
}




window.alert = function(mensaje) {

	$.msgbox( mensaje );
};



window.error = function(mensaje) {
	$.msgbox( mensaje , 
		{
			type: "error",
			title: "ERROR"			
		}, 
		function(result) { 
			//$("#result2").text(result); 
		}
	);
}


window.confirm = function(mensaje, accion) {
	$.msgbox( mensaje , 
		{
			type: "confirm",
			buttons : [
				{type: "submit", value: "Si"},	
				{type: "submit", value: "No"},
				{type: "cancel", value: "Cancelar"}
				]
		}, 
		function(result) {                     
			if(result === 'Si' ) 
                            eval(accion);
                        
			return false;
			//$("#result2").text(result); 
		}
	);
};


var _RECARGAR_SALIR = false;
window.onbeforeunload = function() {    
	//alert( "esta recargando o cambiando la pagina. se perderá todo lo que ha hecho hasta ahora!!!!!" );
	if( _RECARGAR_SALIR == false  ){
		return 'Estas recargando o saliendo del SIMON. Si está registrando o digitando, guarda antes de salir.';		
	}
};
