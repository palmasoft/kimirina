<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Registro de Atencion en Unidad de Salud<br>
        <small>Formato de registro de atencion en unidad de salud</small>
    </h1>
</div>
<!-- END Pre Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:abrir_listado_registro_atencion_salud();">Registros de Atencion en Salud</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Formato de Atencion en Salud</a></li>
    </ul>
    <!-- END Breadcrumb -->


    <?php $this->mostrar("registrosAprobados/formControlCambios", $this->datos); ?>    

    <?php $this->mostrar("registro_atencion_salud/formularioAtencionSalud", $this->datos, "monitores"); ?>

</div>



<script>

    var habilitarBoton = 'false';

    $(document).ready(function() {

        $('#btn_validar_datos').on('click', function(e) {
            generarCodigo();
            e.preventDefault();
        });
        $("#form-registro-atencion").submit(function(e) {
            var datosForm = $(this).serialize();            
            var razones_cambios_registro = $('#razones_cambios_registro').val();
            if(estaVacio(razones_cambios_registro)){
                alert('Es importante saber por que modificas este registro. Por favor, escribe la razones o motivos de la correccion.');
                return false;
            }
            datosForm += '&razones_cambios_registro=' + razones_cambios_registro;

            if (!validarDatosAtencionSalud()) {
                return false;
            }
            
            if (estaVacio($('#registro-id').val())) {
                ejecutarAccionJson(
                        'supervision', 'formulariosAprobados', 'guardar_nuevo_registro_atencion_salud',
                        datosForm, '  mostrar_resultado_guardar( data, "mostrar_lista_aprobados_atencion_salud()", "" );'
                        );
            } else {
                ejecutarAccionJson(
                        'supervision', 'formulariosAprobados', 'update_atencion_salud_aprobado',
                        datosForm, '   mostrar_resultado_guardar( data, "mostrar_lista_aprobados_atencion_salud()", "" );'
                        );
            }

        });

    });



    function no_aprobar_registro_aprobado() {
        var razones_cambios_registro = $('#razones_cambios_registro').val();
        if (estaVacio(razones_cambios_registro)) {
            alert('Debe escribir el motivo de la <strong>DESAPROBACION</strong> de este registro.');
            return false;
        }
        confirm(
                "¿Esta seguro de <strong>DESAPROBAR</strong> este registro de <strong>ATENCION EN UNIDAD DE SALUD</strong> para este periodo?.",
                "no_aprobar_registro_atencion_salud();"
                );
    }

    function no_aprobar_registro_atencion_salud() {
        var id_registro_semanal_contacto = $('#registro-id').val();
        var razones_cambios_registro = $('#razones_cambios_registro').val();
        ejecutarAccionJson(
                'supervision', 'formulariosAprobados', 'no_aprobar_atencion_salud_aprobado',
                'razones_cambios_registro=' + razones_cambios_registro + '&id_atencion_salud=' + id_registro_semanal_contacto,
                '    mostrar_resultado_guardar( data, "mostrar_lista_aprobados_atencion_salud();", "" );'
                );
    }

    function confirmar_eliminar_registro_aprobado() {
        var razones_registro_semanal_contacto = $('#razones_cambios_registro').val();
        if (estaVacio(razones_registro_semanal_contacto)) {
            alert('Debe escribir el motivo de la <strong>ELIMINACION</strong> de este registro.');
            return false;
        }
        confirm(
                "¿Esta seguro de eliminar este registro de <strong>ATENCION EN UNIDAD DE SALUD APROBADO</strong> para este periodo? Una vez eliminado no se podrá recuperar su contenido.",
                "eliminar_atencion_salud_aprobado();"
                );
    }

    function eliminar_atencion_salud_aprobado() {
        var id_registro_semanal_contacto = $('#registro-id').val();
        var razones_cambios_registro = $('#razones_cambios_registro').val();
        ejecutarAccionJson(
                'supervision', 'formulariosAprobados', 'eliminar_atencion_salud_aprobado',
                'razones_cambios_registro=' + razones_cambios_registro + '&id_atencion_salud=' + id_registro_semanal_contacto,
                '  mostrar_resultado_guardar( data, "mostrar_lista_aprobados_atencion_salud();", "" );'
                );
    }


</script>
