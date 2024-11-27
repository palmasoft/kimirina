function cargar_personas(idContendorLista, idLista, idTipoPersona){
    ejecutarAccionSinBloqueo( 
        "sistema", "personasSistema", "lista_seleccion_personas", "id_tipoPersona="+idTipoPersona+"&id_lista="+idLista, 
        "$('#"+idContendorLista+"').html(data); $('.select-chosen').chosen({no_results_text: 'Oops, no se encontró!'});   "
    );  
}