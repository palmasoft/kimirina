
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Registro de Actividad de promocion con Entrega de Insumos<br>
        <small>Formato de registro de Actividad de promocion con Entrega de Insumos</small>
    </h1>
</div>
<!-- END Pre Page Content -->


<!-- Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:abrir_lista_registros_promocion_entrega_insumos();">Listado Actividades de Promocion con Insumos</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Formulario de Actividades de Promocion</a></li>
    </ul>
    <!-- END Breadcrumb -->

    
    
     <?php $this->mostrar("registro_Promocion_Insumos/formulario_promocion_insumos", $this->datos); ?>    
        
    
</div>



<script>
    $(document).ready(function() {

     
        $('#btn_guardar_promocion_insumos').on('click', function(evt, params) {
            $('#form-promocion_insumos').submit();
        });


        $('#btn_limpiar_promocion_insumos').on('click', function(evt, params) {
            document.getElementById('form-promocion_insumos').reset();
        });


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
                            data, ' mostrar_resultado_guardar( data, "abrir_lista_registros_promocion_entrega_insumos();", "" );'
                            );
                } 


                event.handled = true;
                return false;
            }
        });


    });
</script>

