/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function mostrar_datos_evento_personas_efectivas( idRegistro){
    mostrar_contenidos( 
        'monitores', 'registroNumeroAtencionSalud', 'mostrar_datos_registro_numero_atencion', 'id_atencion_salud='+idRegistro 
    );	
}



function abrir_listado_eventos_personas_efectivas(){
    mostrar_contenidos(
            'monitores','registroNumeroAtencionSalud', 'cargar_vista_listado', ''
    );
}

function abrir_form_evento_personas_efectivas(){
    mostrar_contenidos( 
            'monitores', 'registroNumeroAtencionSalud', 'cargar_vista_formulario_nuevo', ''
    );
    
}
