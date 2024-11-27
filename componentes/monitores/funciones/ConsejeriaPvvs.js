function mostrar_datos_consejeria_pvvs( idConsejeria ){    
    mostrar_contenidos( 
        'monitores', 'consejeriaPVVS', 'mostrar_datos_consejeria_PVVS', 'idConsejeria='+idConsejeria 
    );	
}


function abrir_listado_consejerias_pvvs(datos){
    mostrar_contenidos( 
        'monitores', 'consejeriaPVVS', 'mostrar_todas_consejeria_PVVS',datos
    );	
}
 function abrir_nuevo_registro_consejeria_pvvs(){
    mostrar_contenidos( 
        'monitores', 'consejeriaPVVS', 'mostrar_formulario_consejeria_PVVS',''
    );	
}