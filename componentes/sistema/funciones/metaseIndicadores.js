function abrir_tabla_mestas_indicadores(){
    mostrar_contenidos( 
        'sistema', 'metaseIndicadores', 'mostar_tabla_metas_indicadores',''
    );	
}



function agregar_nuevas_metas_por_subreceptor( idSubreceptor ){
    mostrar_contenidos( 
        'gestion', 'metasSubreceptores', 'mostrar_form_meta_por_subreceptor_sistema',
        'subreceptor_indicadores='+idSubreceptor 
    );  
}