
function abrir_listado_indicadores_proyecto(){
    mostrar_contenidos( 
        'gestion', 'indicadores', 'listados_indicadores_proyecto',''
    );	
}

function abrir_listado_indicadores_proyecto_subreceptor(){
    mostrar_contenidos( 
        'gestion', 'indicadores', 'listados_indicadores_por_subreceptor',''
        
    );	
}

function cambiar_listado_indicadores_proyecto_subreceptor( datos ){
    mostrar_contenidos( 
        'gestion', 'indicadores', 'listados_indicadores_por_subreceptor', datos
        
    );	
}

function abrir_lista_metas_subreceptores(){
    mostrar_contenidos( 
        'gestion', 'metasSubreceptores', 'listado_metas_subreceptor',''        
    );	
}

function abrir_form_nueva_meta_subreceptor(){
    mostrar_contenidos( 
        'gestion', 'metasSubreceptores', 'mostrar_form_metas_subreceptor',''        
    );	
}


function agregar_nuevas_metas_por_subreceptor( idSubreceptor ){
    mostrar_contenidos( 
        'gestion', 'metasSubreceptores', 'mostrar_form_meta_por_subreceptor',
        'idSubreceptor='+idSubreceptor 
    );	
}

