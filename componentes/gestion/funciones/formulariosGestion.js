function cambiar_datos_subreceptor(subreceptor, periodo) {
    ejecutarAccionJsonSinBloqueo( 
        'gestion', 'formulariosGestion', 'datos_subreceptor_periodo', 
        ' subreceptor-form-control=' +subreceptor+'&periodo-form-control=' +periodo, 
        '  msn_cambio_subreceptor_periodo(data); '
    );	
}


function cambiar_datos_subreceptor_modal(subreceptor, periodo, seMuestra) {
    ejecutarAccionJsonSinBloqueo( 
        'sistema', 'controlSubreceptorPeriodo', 'cambiar_subreceptor_periodo', 
        ' subreceptor-form-control=' +subreceptor+'&periodo-form-control=' +periodo+'&semuestra-form-control=' +seMuestra, 
        '  msn_cambio_subreceptor_periodo(data); setTimeout(function(){  _RECARGAR_SALIR =  true; location.reload(); }, 1000); '
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


