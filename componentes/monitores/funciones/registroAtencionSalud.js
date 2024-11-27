function mostrar_datos_registro_atencion( idRegistro ){
    mostrar_contenidos( 
        'monitores', 'registroAtencionSalud', 'mostrar_datos_registro_atencion', 'id_atencion_salud='+idRegistro 
    );	
}


function abrir_listado_registro_atencion_salud(datos){
    mostrar_contenidos(
            'monitores','registroAtencionSalud', 'cargar_vista_listado', datos
    );
}


function abrir_form_nuevo_registro_atencion_salud(){
    mostrar_contenidos( 
            'monitores', 'registroAtencionSalud', 'cargar_vista_formulario_nuevo', ''
    );
}