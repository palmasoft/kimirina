
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="halflingicon-gift themed-color"></i> Actividades de Promoción con Entrega de Insumos<br>
        <small>Listado de registros de actividades de promoción con entrega de insumos.</small>
    </h1>
</div>
<!-- END Pre Page Content -->


<!-- Page Content -->
<div id="page-content">
     <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Digitadores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Listados</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Actividades de Promoción con entrega de Insumos</a></li>
    </ul>
  
    
    

    <?php if (!$tieneRestricciones or Usuario::esDNI() ): ?>            
        <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos, 'gestion'); ?>
    <?php endif; ?>

    


    <div class="row-fluid botones_arriba" align="center" >
        <div class=" span4 btn-group text-left">
            <a href="javascript:mostrar_formulario_registro_proporcion_insumos();" data-toggle="tooltip" title="Agregar nueva actividad con entrega de insumos" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a> 
        </div>
        <div class="span4 text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span> </div>
        <div class="span4 btn-group text-right">
            <a href="javascript:abrir_ver_datos_promocion_insumos();" data-toggle="tooltip" title="Mostrar detalles de la actividad con entrega de insumos " class="btn btn-lg btn-info"><i class="icon-zoom-in"></i> Ver</a> 
            <a href="javascript:mostrar_formulario_editar_promocion_insumos();" data-toggle="tooltip" title="Editar registro de la actividad con entrega de insumos" class="btn btn-lg btn-warning"><i class="icon-pencil"></i> Editar</a>
            <a href="javascript:confirmar_eliminar_registro_proporcion_insumos();" data-toggle="tooltip" title="Borrar registro de la actividad con entrega de insumos" class="btn btn-lg btn-danger"><i class="icon-remove"></i> Eliminar</a>
        </div>
    </div>
    
     <?php $this->mostrar("registro_Promocion_Insumos/tabla_promocion_insumos", $this->datos); ?>    
    
    
    
    
</div>



<script>
    $(document).ready(function() {
         $('#form-control-subreceptor-periodo').submit(function(e) {
            if (estaVacio($('#subreceptor-form-control').val())) {
                alert('Seleccione un Subreceptor.');
                return false;
            }
            abrir_lista_registros_promocion_entrega_insumos( $(this).serialize() );
        });        
        $('#tblPromocionInsumos tbody tr').on('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
        });
        $('#tblPromocionInsumos tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
            mostrar_formulario_editar_promocion_insumos();
        });
    });


    function confirmar_eliminar_registro_proporcion_insumos() {
        var tabla = $('#tblPromocionInsumos').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            confirm(
                    '¿seguro que desea eliminar esta <strong>Actividad de Promocion con entrega de Insumos</strong>?',
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
    agregar_boton_ayuda('LISTAACTIVIDADPROMOCI');
</script>