
function cargar_provincias(idContendorLista, idLista, idRegion) {
    ejecutarAccionSinBloqueo(
            "sistema", "ubicacion", "lista_seleccion_provincias", "id_region=" + idRegion + "&id_lista=" + idLista,
            "$('#" + idContendorLista + "').html(data);  $('#" + idLista + "').chosen({no_results_text: 'Oops, no se encontró!'}); "
            );
}

function cargar_cantones(idContendorLista, idLista, idProvincia) {
    ejecutarAccionSinBloqueo(
            "sistema", "ubicacion", "lista_seleccion_cantones", "id_provincia=" + idProvincia + "&id_lista=" + idLista,
            "$('#" + idContendorLista + "').html(data); $('#" + idLista + "').chosen({no_results_text: 'Oops, no se encontró!'});"
            );
}

function cargar_cantones_cServicio(idContendorLista, idLista, idProvincia) {
    ejecutarAccionSinBloqueo(
            "sistema", "ubicacion", "lista_seleccion_cantones", "id_provincia=" + idProvincia + "&id_lista=" + idLista,
            "$('#" + idContendorLista + "').html(data); $('#" + idLista + "').chosen({no_results_text: 'Oops, no se encontró!'}); " +
            "$('#" + idLista + "').on('change', function(evt, params) { cargar_centros_salud('listado-establecimiento', 'idEstablecimiento', $(this).val()); }); "
           );
    
}

function cargar_cantones_recibo_animador(idContendorLista, idLista, idProvincia) {
    ejecutarAccionSinBloqueo(
            "sistema", "ubicacion", "lista_seleccion_cantones", "id_provincia=" + idProvincia + "&id_lista=" + idLista,
            "$('#" + idContendorLista + "').html(data); $('#" + idLista + "').chosen({no_results_text: 'Oops, no se encontró!'}); " +
            "$('#" + idLista + "').on('change', function(evt, params) { \n\
                cargar_lugares_intervencion('lugar_intervencion_div', 'sel-lista-lugar_intervencion', $('#tipoLugar').val(), $('#provincia-chosen').val(), $('#sel-lista-cantones').val()    );\n\
             }); "
            );
}

















//function cargar_parroquias (idContendorLista, idLista, idCanton ) {
//    ejecutarAccionSinBloqueo( 
//        "sistema", "ubicacion", "lista_seleccion_parroquias", "id_canton="+idCanton+"&id_lista="+idLista, 
//        "$('#"+idContendorLista+"').html(data);  $('.select-chosen').chosen({no_results_text: 'Oops, no se encontró!'}); "
//    );
//}  

function cargar_promotores(idContendorLista, idLista, idMonitor) {
    ejecutarAccionSinBloqueo(
            "supervision", "consolidadopromotores", "lista_seleccion_promotores", "id_Monitor=" + idMonitor + "&id_lista=" + idLista,
            "$('#" + idContendorLista + "').html(data); $('#" + idLista + "').chosen({no_results_text: 'Oops, no se encontró!'});   "
            );
}

function cargar_animadores(idContendorLista, idLista, idAnimador) {
    ejecutarAccionSinBloqueo(
            "supervision", "animadoresActividad", "lista_seleccion_animadores", "id_Animador=" + idAnimador + "&id_lista=" + idLista,
            "$('#" + idContendorLista + "').html(data); $('#" + idLista + "').chosen({no_results_text: 'Oops, no se encontró!'});   "
            );
}

function cargar_monitores(idContendorLista, idLista, idCoordinador) {
    ejecutarAccionSinBloqueo(
            "supervision", "desempenoMonitores", "lista_seleccion_monitores", "id_Coordinador=" + idCoordinador + "&id_lista=" + idLista,
            "$('#" + idContendorLista + "').html(data); $('#" + idLista + "').chosen({no_results_text: 'Oops, no se encontró!'});   "
            );
}
function cargar_consejeros(idContendorLista, idLista, idMonitor) {
    ejecutarAccionSinBloqueo(
            "supervision", "informeConsejeriaPares", "lista_seleccion_consejeros", "id_Monitor=" + idMonitor + "&id_lista=" + idLista,
            "$('#" + idContendorLista + "').html(data); $('#" + idLista + "').chosen({no_results_text: 'Oops, no se encontró!'});   "
            );
}
function cargar_centros_salud(idContendorLista, idLista, idCanton) {

    ejecutarAccionSinBloqueo(
            "monitores", "consejeriaPVVS", "lista_seleccion_establecimiento", "id_canton=" + idCanton + "&id_lista=" + idLista,
            "$('#" + idContendorLista + "').html(data); $('#" + idLista + "').chosen({no_results_text: 'Oops, no se encontró!'});   "
            );
}

function cargar_centros_salud_semanal_contacto(idContendorLista, idLista, idCanton) {
    ejecutarAccionSinBloqueo(
            "monitores", "registroSemanal", "lista_seleccion_establecimiento",
            "id_canton=" + idCanton + "&id_lista=" + idLista,
            "$('#" + idContendorLista + "').html(data); $('#" + idLista + "').chosen({no_results_text: 'Oops, no se encontró!'});   "
            );
}