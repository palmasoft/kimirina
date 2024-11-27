
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="halflingicon-gift themed-color"></i> Actividades de promoción con Entrega de Insumos<br>
        <small>Todos los registros de actividades de promoción con entrega de insumos.</small>
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
        <li class="active"><a href="#">Actividades de promoción con Entrega de Insumos</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <?php if (!$tieneRestricciones): ?>            
        <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos); ?>
    <?php endif; ?>
    
    <div class="row-fluid botones_arriba" align="center" >
        <div class=" span4 btn-group text-left">
            <!--<a href="javascript:mostrar_formulario_registro_proporcion_insumos();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>--> 
        </div>
        <div class="span4 text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span> </div>
        <div class="span4 btn-group text-right">
            <a href="javascript:abrir_ver_datos_promocion_insumos();" data-toggle="tooltip" title="Mostrar Formulario" class="btn btn-lg btn-info"><i class="icon-eye-open"></i> Ver</a> 
<!--            <a href="javascript:mostrar_formulario_editar_promocion_insumos();" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i> Editar</a>
            <a href="javascript:confirmar_eliminar_registro_proporcion_insumos();" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i> Eliminar</a>-->
        </div>
    </div>
    
     <?php $this->mostrar("listadosRegistros/tablaListadoRegistroPromocionInsumos", $this->datos); ?>    
    
</div>



<script>
    $(document).ready(function() {
         $('#form-control-subreceptor-periodo').submit(function(e) {
            if (estaVacio($('#subreceptor-form-control').val())) {
                alert('Seleccione un Subreceptor.');
                return false;
            }
            mostrar_lista_registros_promocion_entrega_insumos_gestion( $(this).serialize() );
        });        
        $('#tblPromocionInsumos tbody tr').on('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
        });
//        $('#tblPromocionInsumos tbody tr').dblclick(function(e) {
//            $(this).addClass('row_selected');
//            $('#registro-seleccionado').html($(this).attr('data-nombre'));
//            mostrar_lista_registros_promocion_entrega_insumos_gestion();
//        });
    });


    function confirmar_eliminar_registro_proporcion_insumos() {
        var tabla = $('#tblPromocionInsumos').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            confirm(
                    '¿seguro que desea eliminar esta Actividad de Promocion con entrega de Insumos?',
                    'eliminar_registro_proporcion_insumos();'
                    );
        } else {
            alert('Seleccione un registro');
        }

    }

    function eliminar_registro_proporcion_insumos() {
        var tabla = $('#tblPromocionInsumos').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            ejecutarAccionJson('monitores', 'registroPromocionEntregaInsumos', 'eliminar_registro_promocion_insumos',
                    'registro-id=' + idFila, 'mostrar_resultado_guardar( data, "abrir_lista_registros_promocion_entrega_insumos();", "" );'
                    );
        }
    }

    function mostrar_formulario_editar_promocion_insumos() {
        var tabla = $('#tblPromocionInsumos').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            mostrar_contenidos(
                    'monitores', 'registroPromocionEntregaInsumos', 'mostar_form_editar_registro_promocion_insumos', 'id_registro=' + idFila
                    );
        } else {
            alert('Seleccione un registro');
        }
    }

    function abrir_ver_datos_promocion_insumos() {
        var tabla = $('#tblPromocionInsumos').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            mostrar_datos_registro_proporcion_insumos(idFila);
        } else {
            alert('Seleccione un registro');
        }
    }

</script>
<script>
    agregar_boton_ayuda('BIENVENIDA');
</script>