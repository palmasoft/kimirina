
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Recibo de Contacto por Animador APROBADO<br>
        <small>REGISTRO DE RECIBOS DE CONTACTO ENTREGADOS A LOS PEMAR.</small>
    </h1>
</div>


<!-- Page Content -->
<div id="page-content">

    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:mostrar_lista_aprobados_recibos_animadores()();">Recibos de Contactos Aprobados</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="javascript:void();">Recibo de Contacto</a></li>
    </ul>


    <?php $this->mostrar("registrosAprobados/formControlCambios", $this->datos); ?>    

    <?php $this->mostrar("recibo_contacto_animador/formularioAnimador", $this->datos, "monitores"); ?>
    <?php $this->mostrar("recibo_contacto_animador/cargarArchivos", $this->datos, "monitores"); ?>


    <div class="block block-themed block-last">
        <div class="form-actions" style="text-align: center;">
            <button id="btn_validar_datos" type="button" class="btn btn-info"><i class="icon-check"></i> Validar </button>
            <button id="btn_limpiar_recibo_animador" type="button" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
            <button id="btn_guardar_recibo_animador" type="submit" class="btn btn-success" disabled="" ><i class="icon-save"></i> Guardar</button>
        </div>
    </div>





</div>



<script>
    $(document).ready(function() {

        $('#form-contacto-animador').validate({
            submitHandler: function(form) {
                if (event.handled !== true) {
                    if (estaVacio($('#razones_cambios_registro').val())) {
                        alert('Debes escribir las razon de la modificacion de este registro.');
                        return false;
                    }
                    if (!validar_datos_recibo_contacto()) {
                        return false;
                    }

                    var data = new FormData(document.getElementById('form-contacto-animador'));
                    data.append("razones_cambios_registro", "" + $('#razones_cambios_registro').val() + "");
                    var soportes = $('#form-recibo-contacto-soportes').serializeArray();
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

                    } else {
                        ejecutarAccionJsonArchivos(
                                'supervision', 'formulariosAprobados', 'update_recibo_contacto_animador_aprobado',
                                data, ' mostrar_resultado_guardar(data, "mostrar_lista_aprobados_recibos_animadores();", "" );'
                                );
                    }


                    _puede_salir_formulario = true;
                    event.handled = true;
                }
                return false;
            }
        });


    });



    function no_aprobar_registro_aprobado() {
        var razones_cambios_registro = $('#razones_cambios_registro').val();
        if (estaVacio(razones_cambios_registro)) {
            alert('Debe escribir el motivo de la <strong>DESAPROBACION</strong> de este <strong>RECIBO DE CONTACTO</strong>.');
            return false;
        }
        confirm(
                "¿Esta seguro de <strong>DESAPROBAR</strong> este registro de <strong>RECIBO DE CONTACTO</strong> para este periodo?.",
                "no_aprobar_recibo_contacto();"
                );
    }

    function no_aprobar_recibo_contacto() {
        var id_registro_semanal_contacto = $('#registro-id').val();
        var razones_cambios_registro = $('#razones_cambios_registro').val();
        ejecutarAccionJson(
                'supervision', 'formulariosAprobados', 'no_aprobar_recibo_contacto_animador_aprobado',
                'razones_cambios_registro=' + razones_cambios_registro + '&idContactoAnimador=' + id_registro_semanal_contacto,
                '  mostrar_resultado_guardar( data, "mostrar_lista_aprobados_recibos_animadores();", "" );'
                );
    }



    function confirmar_eliminar_registro_aprobado() {
        var razones_cambios_registro = $('#razones_cambios_registro').val();
        if (estaVacio(razones_cambios_registro)) {
            alert('Debe escribir el motivo de la <strong>ELIMINACION</strong> de este <strong>RECIBO DE CONTACTO</strong>.');
            return false;
        }
        confirm(
                "¿Esta seguro de eliminar este <strong>RECIBO DE CONTACTO APROBADO</strong> para este periodo? Una vez eliminado no se podra recuperar su contenido.",
                " eliminar_recibo_contacto_aprobado();  "
                );
    }

    function eliminar_recibo_contacto_aprobado() {
        var id_registro_semanal_contacto = $('#registro-id').val();
        var razones_cambios_registro = $('#razones_cambios_registro').val();
        if (!estaVacio(razones_cambios_registro)) {
            ejecutarAccionJson(
                    'supervision', 'formulariosAprobados', 'eliminar_recibo_contacto_aprobado',
                    'razones_cambios_registro=' + razones_cambios_registro + '&idContactoAnimador=' + id_registro_semanal_contacto,
                    ' mostrar_resultado_guardar( data, "mostrar_lista_aprobados_recibos_animadores();", "" );'
                    );
        } else {

        }
    }

</script>
<script>
    agregar_boton_ayuda('BIENVENIDA');
</script>


