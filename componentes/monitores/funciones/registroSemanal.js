

function abrir_nuevo_form_registro_semanal_contacto () {
    mostrar_contenidos( 
        'monitores', 'registroSemanal', 'nuevo_formulario_registro_semanal',''
    );	
}


function abrir_nuevo_form_registro_semanal_contacto_HSH () {
    mostrar_contenidos( 
        'monitores', 'registroSemanal', 'nuevo_formulario_registro_semanal','tipoPoblacion=HSH'
    );	
}


function abrir_nuevo_form_registro_semanal_contacto_TS () {
    mostrar_contenidos( 
        'monitores', 'registroSemanal', 'nuevo_formulario_registro_semanal','tipoPoblacion=TS'
    );	
}


function abrir_nuevo_form_registro_semanal_contacto_TRANS () {
    mostrar_contenidos( 
        'monitores', 'registroSemanal', 'nuevo_formulario_registro_semanal','tipoPoblacion=TRANS'
    );	
}

function guardar_nuevo_form_registro_semanal_contacto(datos){
    ejecutarAccion( 
     'monitores', 'registroSemanal', 'guardar_formulario_registro_semanal', datos,
     'alert( data ); '
    );
}

function mostrar_registros_semanales_contacto(datos){
    mostrar_contenidos( 
    'monitores', 'registroSemanal', 'mostrar_tabla_registros_semanales', datos
    );
}


function ver_datos_registro_semanal(idRegistro){    
    mostrar_contenidos( 
        'monitores', 'registroSemanal', 'ver_registro_semanal', 'idRegistroSemanal='+idRegistro 
    );
}


function editar_datos_registro_semanal(idRegistro){    
    mostrar_contenidos( 
        'monitores', 'registroSemanal', 'editar_formulario_registro_semanal', 'idRegistroSemanal='+idRegistro 
    );
}




/*

function abrir_formulario_nuevo_contacto_registro_semanal( idCanton ){    
    ejecutarAccion( 
     'monitores', 'formularios', 'formulario_nuevo_contacto','id_canton='+idCanton,
     'agregar_zona_modal(data); inciar_plugins_graficos (); abrir_modal_contacto (); '
    );
}

function abrir_nuevo_recibo_contacto_pemar(){
    mostrar_contenidos( 
        'monitores', 'formularios', 'mostrar_formulario_recibo_pemar',''
    );	
}*/