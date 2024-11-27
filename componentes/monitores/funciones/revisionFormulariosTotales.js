function mostrar_listado_revision_formularios_totales(datos){
    mostrar_contenidos( 
        'monitores', 'revisionFormulariosTotales', 'ver_revision_formularios_totales', datos
    );	
}

function revisarConsejeriaPVVS(){
    ejecutarAccionJson(
                'monitores', 'revisionFormulariosTotales', 'revisar_todos_formularios_consejerias', '', 
                'mostrar_resultado_guardar( data, "mostrar_listado_revision_formularios_totales();", "" );'
            ); 
}

function revisarReciboContactoAnimador(){
    ejecutarAccionJson(
                'monitores', 'revisionFormulariosTotales', 'revisar_todos_formularios_animadores', '', 
                'mostrar_resultado_guardar( data, "mostrar_listado_revision_formularios_totales();", "" );'
            );  
}

function revisarReciboSemanalContacto(){
     ejecutarAccionJson(
                'monitores', 'revisionFormulariosTotales', 'revisar_todos_formularios_semanales_contactos', '', 
                'mostrar_resultado_guardar( data, "mostrar_listado_revision_formularios_totales();", "" );'
            );
}

function revisarRegistroAtencionSalud(){
     ejecutarAccionJson(
                'monitores', 'revisionFormulariosTotales', 'revisar_todos_registros_atencion_salud', '', 
                'mostrar_resultado_guardar( data, "mostrar_listado_revision_formularios_totales();", "" );'
            );
}