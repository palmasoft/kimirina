
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="fa-user-md themed-color"></i> Registros de Atención en Unidad de Salud Aprobados<br>
        <small>Todos los registros de atencion en salud que ha sido aprobados durante el periodo activo.</small>
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
            <a href="#">Coordinadores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Registros Aprobados</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="javascript:void(0);">Registros de atencion en unidades de salud</a></li>
    </ul>
    <!-- END Breadcrumb -->


    <?php if (!$tieneRestricciones or Usuario::esDNI() ): ?>            
        <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos, 'gestion'); ?>
    <?php endif; ?>




    <div class="row-fluid botones_arriba " >
        <div class=" span4 btn-group text-left">
            <a href="javascript:abrir_cambios_del_registro_aprobado();" data-toggle="tooltip" title="ver las Correciones para este registro" class="btn btn-info"><i class="glyphicon-notes"></i> Correcciones</a>
        </div>
        <span class="span4 text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span> </span>
        <div class=" span4 btn-group text-right">
            <a href="javascript:abrir_ver_datos_registro_atencion_aprobado();" data-toggle="tooltip" title="ver los datos registrados de la Atencion en Unidad de Salud seleccinada " class="btn btn-lg btn-info"><i class="glyphicon-zoom_in"></i> Ver</a>
            <a href="javascript:mostrar_formulario_editar_atencion_salud_aprobado()" data-toggle="tooltip" title="editar Registro de Atencion en Salud seleccionado" class="btn btn-lg btn-success"><i class="glyphicon-spade"></i> Corregir</a>            
        </div>
    </div>

    <?php $this->mostrar("registro_atencion_salud/tablaRegistrosAtencionSalud", $this->datos, "monitores"); ?>


</div>




<div id="modal-modificaciones" class="modal hide fade" style="width: 670px;" >
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4>Correcciones al Registro</h4>
    </div>
    <div class="modal-body" >            
    </div>
    <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal">Aceptar</button>
    </div>
</div>




<script>
    $(document).ready(function() {
        $('#tblRegistroAtencionSalud tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
            mostrar_formulario_editar_atencion_salud_aprobado();
        });

        $('#tblRegistroAtencionSalud tbody tr').on('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
        });



        $('#form-control-subreceptor-periodo').submit(function(e) {
            if (estaVacio($('#subreceptor-form-control').val())) {
                alert('Seleccione un Subreceptor.');
                return false;
            }
            mostrar_lista_aprobados_atencion_salud($(this).serialize());


        });




    });

    function abrir_cambios_del_registro_aprobado() {
        var tabla = $('#tblRegistroAtencionSalud').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            ejecutarAccion(
                    'supervision', 'auditoriaFormularios', 'correcciones_atencion_salud_aprobado',
                    'id_atencion_salud=' + idFila, '$("#modal-modificaciones .modal-body").html(data); $("#modal-modificaciones").modal("show"); '
                    );
        } else {
            alert('Seleccione un registro');
        }
    }

    function abrir_ver_datos_registro_atencion_aprobado() {
        var tabla = $('#tblRegistroAtencionSalud').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            mostrar_contenidos(
                    'supervision', 'formulariosAprobados', 'mostrar_datos_atencion_salud_aprobado', 'id_atencion_salud=' + idFila
                    );
        } else {
            alert('Seleccione un registro');
        }
    }
    function mostrar_formulario_editar_atencion_salud_aprobado() {
        var tabla = $('#tblRegistroAtencionSalud').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            mostrar_contenidos(
                    'supervision', 'formulariosAprobados', 'editar_form_atencion_salud_aprobado', 'id_atencion_salud=' + idFila
                    );
        } else {
            alert('Seleccione un registro');
        }

    }
</script>


<script>
    agregar_boton_ayuda('ATENCIONSALUDAPROBADO');
</script>