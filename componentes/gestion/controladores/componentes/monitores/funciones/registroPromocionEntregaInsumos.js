function abrir_lista_registros_promocion_entrega_insumos(datos) {
    mostrar_contenidos(
            'monitores', 'registroPromocionEntregaInsumos', 'mostar_tabla_registro_promocion_insumos', datos
            );
}
function abrir_form_registros_promocion_entrega_insumos() {
    mostrar_contenidos(
            'monitores', 'registroPromocionEntregaInsumos', 'mostar_form_registro_promocion_insumos', ''
            );
}

function mostrar_formulario_registro_proporcion_insumos() {
    mostrar_contenidos(
            'monitores', 'registroPromocionEntregaInsumos', 'mostar_form_registro_promocion_insumos', ''
            );
}

function mostrar_datos_registro_proporcion_insumos(idRegistro) {
    mostrar_contenidos(
            'monitores', 'registroPromocionEntregaInsumos', 'mostar_datos_registro_promocion_insumos', 'id_registro='+idRegistro 
            );
}