
function abrir_form_nuevo_lugar_intervencion(){

	mostrar_contenidos( 
        'sistema', 'lugaresIntervencion', 'cargar_vista_formulario_lugares_intervencion', ''
    );
}
function abrir_listado_lugar_intervencion(){
	mostrar_contenidos( 
       'sistema', 'lugaresIntervencion', 'cargar_vista_lugares_intervencion', ''
    );
}
function cargar_lugares_intervencion ( idContendorLista, idLista, idTipoLugar, idProvincia, idCanton){
     ejecutarAccion( 
        "sistema", "lugaresIntervencion", "lista_seleccion_lugares_por_tipo", "id_tipolugar="+idTipoLugar+"&id_Provincia="+idProvincia+"&id_Canton="+idCanton+"&idLista="+idLista, 
                "$('#"+idContendorLista+"').html(data); $('.select-chosen').chosen({no_results_text: 'Oops, no se encontró!'}); $('#"+idLista+"').on('change', function(evt, params) {  });  "
    );
}



function cargar_lugares_intervencion_normal ( idContendorLista, idLista, idTipoLugar, idProvincia, idCanton ){
     ejecutarAccion( 
        "sistema", "lugaresIntervencion", "lista_seleccion_lugares_por_tipo", 
        "id_tipolugar="+idTipoLugar+"&id_Provincia="+idProvincia+"&id_Canton="+idCanton+"&idLista="+idLista, 
        " $('#"+idContendorLista+"').html(data);  $('#"+idLista+"').chosen({no_results_text: 'Oops, no se encontró!'});  "
    );
}
function cargar_lugares_intervencion_normal_seleccionar ( idContendorLista, idLista, idTipoLugar, idProvincia, idCanton, idLugar ){
     ejecutarAccion( 
        "sistema", "lugaresIntervencion", "lista_seleccion_lugares_por_tipo", 
        "id_tipolugar="+idTipoLugar+"&id_Provincia="+idProvincia+"&id_Canton="+idCanton+"&idLista="+idLista, 
        " $('#"+idContendorLista+"').html(data); $('#"+idLista+" option[value=\""+idLugar+"\"]').attr('selected', 'selected');    $('#"+idLista+"').chosen({no_results_text: 'Oops, no se encontró!'});  "
    );
}

function cargar_lugares_atencion ( idContendorLista, idLista, idTipoLugar, idProvincia, idCanton ){
     ejecutarAccionSinBloqueo( 
        "sistema", "lugaresIntervencion", "lista_seleccion_lugares_por_tipo", "id_tipolugar="+idTipoLugar+"&id_Provincia="+idProvincia+"&id_Canton="+idCanton+"&idLista="+idLista, 
                "$('#"+idContendorLista+"').html(data); $('.select-chosen').chosen({no_results_text: 'Oops, no se encontró!'});   $('#"+idLista+"').on('change', function(e) { traer_nombre_responsable( $(this).val() ); } ); "
    );
}

function busquedaTodos( datos ){    
    mostrar_contenidos( "sistema", "lugaresIntervencion", 
                        "busqueda_lugares_intervencion", datos
    );	
}