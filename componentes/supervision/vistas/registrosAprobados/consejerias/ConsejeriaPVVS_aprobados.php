
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Consejeria PVVS Aprobados<br>
        <small>REGISTRO DE CONSEJERÍA DE PARES CON PERSONAS QUE VIVEN CON VIH.</small>
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
            <a href="#">Supervision</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Consejeria PVVS</a></li>
    </ul>


    <?php $this->mostrar("registrosAprobados/formControlCambios", $this->datos); ?>    

    <?php $this->mostrar("consejeria_pvvs/formularioConsejeria", $this->datos, 'monitores'); ?>


    <!-- END div.row-fluid -->
    <div class="form-actions">
        <button id="btn_validar_datos" type="button" class="btn btn-info"><i class="icon-check"></i> Validar </button>
        <button type="button"  id="btn_limpiar_consejeria_pvvs" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
        <button type="button" id="btn_guardar_consejeria_pvvs" class="btn btn-success" disabled="" ><i class="icon-save"></i> Guardar</button>
    </div>


</div> 

<script>

    $(document).ready(function() {

        $('#form-consejeria-pvvs').validate({
            submitHandler: function(form) {
                if (event.handled !== true) {
                    if (validarDatos()) {
                        if (estaVacio($('#razones_cambios_registro').val())) {
                            alert('Debe escribir el motivo de la modificacion.');
                            return false;
                        }
                        var codP = generarCodigoUnicoPemar($('#dosPrimerNombre').val(), $('#dosSegundoNombre').val(), $('#dosPrimerApellido').val(), $('#dosSegundoApellido').val(), $('#mes-nacimiento').val(), $('#ano-nacimiento').val());

                        var data = new FormData(document.getElementById('form-consejeria-pvvs'));
                        data.append("razones_consejeria_pvvs", "" + $('#razones_cambios_registro').val() + "");
                        data.append("codigo-pemar", "" + codP + "");

                        var soportes = $('#form-consejeria-soportes').serializeArray();
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
                                    'supervision', 'formulariosAprobados', 'editar_consejeria_pvvs_aprobado',
                                    data, ' mostrar_resultado_guardar( data, "monstrar_lista_aprobados_consejerias_pvvs();", "");'
                                    );
                        }
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
            alert('Debe escribir el motivo de la <strong>DESAPROBACION</strong> de esta CONSEJERIA.');
            return false;
        }
        confirm(
                "¿Esta seguro de <strong>DESAPROBAR</strong> este registro de <strong>CONSEJERIA A PVVS</strong> para este periodo?.",
                "no_aprobar_registro_consejeria_pvvs();"
                );
    }

    function no_aprobar_registro_consejeria_pvvs() {
        var id_registro_semanal_contacto = $('#registro-id').val();
        var razones_cambios_registro = $('#razones_cambios_registro').val();
        ejecutarAccionJson(
                'supervision', 'formulariosAprobados', 'no_aprobar_consejeria_pvvs',
                'razones_consejeria_pvvs=' + razones_cambios_registro + '&registro-id-consejeria=' + id_registro_semanal_contacto,
                '    mostrar_resultado_guardar( data, "monstrar_lista_aprobados_consejerias_pvvs();", "" );'
                );
    }

    function confirmar_eliminar_registro_aprobado() {
        var razones_registro_semanal_contacto = $('#razones_cambios_registro').val();
        if (estaVacio(razones_registro_semanal_contacto)) {
            alert('Debe escribir el motivo de la <strong>ELIMINACION</strong> de esta CONSEJERIA.');
            return false;
        }
        confirm(
                "¿Esta seguro de eliminar este registro de <strong>CONSEJERIA A PVVS</strong> para este periodo? Una vez eliminado no se podrá recuperar su contenido.",
                "eliminar_consejeria_pvvs_aprobado();"
                );
    }

    function eliminar_consejeria_pvvs_aprobado() {
        var id_registro_semanal_contacto = $('#registro-id').val();
        var razones_cambios_registro = $('#razones_cambios_registro').val();
        ejecutarAccionJson(
                'supervision', 'formulariosAprobados', 'eliminar_consejerias_pvvs_aprobado',
                'razones_consejeria_pvvs=' + razones_cambios_registro + '&registro-id-consejeria=' + id_registro_semanal_contacto,
                '  mostrar_resultado_guardar( data, "monstrar_lista_aprobados_consejerias_pvvs();", "" );'
                );
    }



</script>



<script>
    $(document).ready(function() {

    agregar_boton_ayuda('BIENVENIDA');
    });
</script>