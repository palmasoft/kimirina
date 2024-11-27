



function abrir_control_periodo_subreceptor() {    
    ejecutarAccion(
            'sistema', 'controlSubreceptorPeriodo', 'mostrar_modal',
            '', ' $("#modal-sp").html( data );  $(".select-chosen").chosen({width: "98%"});  $(".input-themed").iCheck({ checkboxClass: "icheckbox_square-grey",radioClass: "iradio_square-grey"   }); $("#modal-controlsrperiodo").modal(); '
    );
}





function traer_ruta_navegacion(){
	ejecutarAccionSinBloqueo( 
		"sistema", "sesion", "breadcrumbs", "", 
		"actualizar_ruta_navegacion(data);" 
	);
}


function mostrar_informacion_sistema(){
	
	ejecutarAccionSinBloqueo(
		"sistema", "informacion","mostrar_informacion_sistema", 
		"", "informacion(data, 'Informacion Sobre el Sistema');"
	);
	
	return false;
    		
}



function actualizar_ruta_navegacion( breadcrumbs ){
	$('#ruta_navegacion').html( breadcrumbs );
}

function abrir_formulario_tipo_lugares(){
    mostrar_contenidos( 
        'sistema', 'formularios', 'mostrar_formulario_tipolugares',''
    );	
}

