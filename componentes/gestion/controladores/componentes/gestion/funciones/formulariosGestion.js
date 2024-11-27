function mostrar_lista_registro_semanal_gestion(){
    mostrar_contenidos( 
        'gestion', 'formulariosGestion', 'ver_lista_registro_semanal_gestion', ''
    );	
}
function mostrar_lista_recibo_animadores_gestion(){
    
    mostrar_contenidos( 
        'gestion', 'formulariosGestion', 'ver_lista_registro_animadores_gestion', ''
    );	
}
function mostrar_lista_consejerias_pvvs_gestion(){
    mostrar_contenidos( 
        'gestion', 'formulariosGestion', 'ver_lista_consejerias_pvvs_gestion', ''
    );	
}



function cambiar_datos_subreceptor(subreceptor, periodo) {
    ejecutarAccionJsonSinBloqueo( 
        'gestion', 'formulariosGestion', 'datos_subreceptor_periodo', 
        ' subreceptor=' +subreceptor+'&periodo=' +periodo, 
        '  msn_cambio_subreceptor_periodo(data); '
    );	
}
function msn_cambio_subreceptor_periodo( jsonData ){        
        informacion(
            ' Se ha cambiado el SUBRECEPTOR del Usuario a <strong> '+jsonData.subreceptor.NOMBRE_SUBRECEPTOR+'</strong>  y el periodo ACTIVO a <strong>' +jsonData.periodo.CODIGO_PERIODO +'</strong>. \n\
               <em>Este cambio solo se mantendrá durante la sesion actual de trabajo</em>. ', 
            ' Control de Subreceptor y Periodo Activo para el Usuario Actual. '
       );
       
       $('.sigla_subreceptor_usuario').html( jsonData.subreceptor.SIGLAS_SUBRECEPTOR );
       $('.nombre_subreceptor_usuario').html( jsonData.subreceptor.NOMBRE_SUBRECEPTOR );
       $('.periodo_activo_usuario').html( jsonData.periodo.CODIGO_PERIODO  );       
       
}


