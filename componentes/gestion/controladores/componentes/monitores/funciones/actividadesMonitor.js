function mostrar_datos_actividades_monitor() {
    mostrar_contenidos(
            'monitores', 'ActividadesMonitor', 'crear_datos_actividad', ''
            );
}
/*
 function retorna_nombre_persona(){
 mostrar_contenidos( 
 'monitores', 'ActividadesMonitor', 'retorna_nombre_persona', 'idPersona='+idPersona 
 );	
 }*/

function mostrar_tabla_actividades_monitor(datos) {
    mostrar_contenidos(
            'monitores', 'ActividadesMonitor', 'mostrar_tabla_datos_actividades', datos
            );
}





function editar_datos_actividad_monitor(idFila) {
    mostrar_contenidos(
            'monitores', 'ActividadesMonitor', 'editar_datos_actividad',
            'idActividad=' + idFila
            );
}



function mostrar_datos_actividad_monitor(idFila) {
    mostrar_contenidos(
            'monitores', 'ActividadesMonitor', 'ver_datos_actividad',
            'idActividad=' + idFila
            );
}


