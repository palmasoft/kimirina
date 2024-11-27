function mostrar_datos_registro_numero_atencion( idRegistro){
    mostrar_contenidos( 
        'monitores', 'registroNumeroAtencionSalud', 'mostrar_datos_registro_numero_atencion', 'id_atencion_salud='+idRegistro 
    );	
}



function abrir_listado_numero_atencion_salud(){
    mostrar_contenidos(
            'monitores','registroNumeroAtencionSalud', 'cargar_vista_listado', ''
    );
}

function abrir_form_nuevo_numero_atencion_salud(){
    mostrar_contenidos( 
            'monitores', 'registroNumeroAtencionSalud', 'cargar_vista_formulario_nuevo', ''
    );
    
}
