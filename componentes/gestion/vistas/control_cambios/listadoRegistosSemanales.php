
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-table themed-color"></i> Hojas de Registro Semanal de Alcances<br />
        <small>Todos los formularios de alcances del promotor</small>
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
        <li class="active"><a href="#">Registros Semanales</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <?php if (!$tieneRestricciones): ?>            
        <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos); ?>
    <?php endif; ?>

    <div class="row-fluid botones_arriba" style="text-align: center;" >
        <div class=" span4 btn-group text-left">
<!--            <a href="javascript:abrir_nuevo_form_registro_semanal_contacto_HSH ();" data-toggle="tooltip" title="Agregar nuevo Registro HSH" class="btn btn-lg btn-info"><i class="icon-plus"></i> HSH</a>						
            <a href="javascript:abrir_nuevo_form_registro_semanal_contacto_TS ();" data-toggle="tooltip" title="Agregar nuevo Registro TS" class="btn btn-lg btn-info"><i class="icon-plus"></i> TS</a>						
            <a href="javascript:abrir_nuevo_form_registro_semanal_contacto_TRANS ();" data-toggle="tooltip" title="Agregar nuevo Registro TRANS" class="btn btn-lg btn-info"><i class="icon-plus"></i> TRANS</a>-->
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class="span4 btn-group text-right">
            <a href="javascript:abrir_cambios_del_registro_aprobado();" data-toggle="tooltip" title="Correcciones para este registro" class="btn btn-info"><i class="glyphicon-notes"></i> Correcciones</a>
            <a href="javascript:abrir_ver_datos_registro_seleccionado();" data-toggle="tooltip" title="ver Documento en Linea " class="btn btn-lg btn-info"><i class="icon-eye-open"></i> Ver</a>						
            <!--<a href="javascript:abrir_editar_registro_aprobado();" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i> Editar</a>-->			
        </div>
    </div>

    <div class="block-section">
        <?php // $this->mostrar('registro_semanal_contactos/tablaListadoRegistros', $this->datos, 'monitores'); ?>
        <?php $this->mostrar('control_cambios/tablaListadoRegistrosSemanales', $this->datos); ?>
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


</div>
<!-- END Page Content -->

<script>
    $(document).ready(function() {
        $('#tbl-form-registros-semanales tbody tr').on('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-code'));
        });
        
        $('#form-control-subreceptor-periodo').submit(function(e) {
            if (estaVacio($('#subreceptor-form-control').val())) {
                alert('Seleccione un Subreceptor.');
                return false;
            }
            mostrar_lista_registro_semanal_gestion($(this).serialize());
        });

//        $('#tbl-form-registros-semanales tbody tr').dblclick(function(e) {
//            $(this).addClass('row_selected');
//            abrir_editar_registro_aprobado();
//        });


    });


    function abrir_ver_datos_registro_seleccionado() {
        var tabla = $('#tbl-form-registros-semanales').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            ver_datos_registro_semanal(idFila);
        } else {
            alert('Seleccione un registro');
        }

    }

    function abrir_editar_registro_aprobado() {
        var tabla = $('#tbl-form-registros-semanales').dataTable();
        var idFila = filaId(tabla);

        if (idFila != null) {
            mostrar_contenidos(
                    'supervision', 'formulariosAprobados', 'editar_formulario_registro_semanal_aprobado', 'idRegistroSemanal=' + idFila
                    );
        } else {
            alert('Seleccione un registro');
        }
    }


    function abrir_cambios_del_registro_aprobado() {
        var tabla = $('#tbl-form-registros-semanales').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {            
            ejecutarAccion( 
                'supervision', 'auditoriaFormularios', 'correcciones_registro_semanal_aprobado', 
                'idRegistroSemanal=' + idFila, '$("#modal-modificaciones .modal-body").html(data); $("#modal-modificaciones").modal("show"); '
            );
        } else {
            alert('Seleccione un registro');
        }
    }

</script>


