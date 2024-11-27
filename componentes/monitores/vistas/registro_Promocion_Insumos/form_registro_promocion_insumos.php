

<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i>Registro de Actividad de Promoción con<br> Entrega de Insumos<br>
        <small>Formato de registro de actividad de promoción con entrega de insumos</small>
    </h1>
</div>



<div id="page-content">
      <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:abrir_lista_registros_promocion_entrega_insumos();">Listado Actividades de Promoción con Insumos</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Formulario de Actividades de Promoción</a></li>
    </ul>
    

    <?php $this->mostrar("registro_Promocion_Insumos/formulario_promocion_insumos", $this->datos); ?>         

</div>



<script>
    $(document).ready(function() {



        $('#form-promocion_insumos').validate({
            submitHandler: function(form) {

                if (estaVacio($('#idPersona').val())) {
                    alert('Debe seleccionar un Responsable');
                    return false;
                }
                if (estaVacio($('#lugar_intervencion_contacto').val())) {
                    alert('Debe seleccionar un Lugar');
                    return false;
                }

                var data = new FormData(document.getElementById('form-promocion_insumos'));

//            var datosEnabezado = $('#form-registro-semanal-contactos').serializeArray();
//            $.each(datosEnabezado, function(i, field) {
//                data.append("" + field.name + "", "" + field.value + "");
//            });

                var soportes = $('#form_promocion_insumos_soportes').serializeArray();
                $.each(soportes, function(i, field) {
                    data.append("" + field.name + "", "" + field.value + "");
                });

                var archivos = $(".cargar_soporte");
                for (i = 0; i < archivos.length; i++) {
                    $.each($('.cargar_soporte')[i].files, function(k, file) {
                        data.append('soporte-' + (k + i), file);
                    });
                }



                if (estaVacio($('#registro-id').val())) {
                    ejecutarAccionJsonArchivos('monitores', 'registroPromocionEntregaInsumos', 'guardar_registro_entrega_insumos',
                            data, 'mostrar_resultado_guardar( data, "abrir_lista_registros_promocion_entrega_insumos();", "" );'
                            );
                } else {
                    ejecutarAccionJsonArchivos(
                            'monitores', 'registroPromocionEntregaInsumos', 'update_registro_entrega_insumos',
                            data, 'mostrar_resultado_guardar( data, "abrir_lista_registros_promocion_entrega_insumos();", "" );'
                            );
                }


                _puede_salir_formulario = true;
                event.handled = true;
                return false;
            }
        });


    });
</script>

<script>
<?php if (isset($promocionInsumos)): ?>
    agregar_boton_ayuda('EDITARACTIVIDADPROMOC');
<?php else: ?>
    agregar_boton_ayuda('NUEVAACTIVIDADPROMOCI');
<?php endif; ?>
</script>