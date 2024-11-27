<?php ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-conversation themed-color"></i> Actividades del Monitor<br>
        <small>Todas las Actividades realizadas por los monitores </small>
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
        <li class="active"><a href="#">Actividades del Monitor</a></li>
    </ul>
    <!-- END Breadcrumb -->  
    

    <?php if (!$tieneRestricciones): ?>            
        <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos); ?>
    <?php endif; ?>
    
    
    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
            <!--<a href="javascript:mostrar_datos_actividades_monitor();" data-toggle="tooltip" title="agregar una nueva ACTIVIDAD realizada" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>-->
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">     
            <a href="javascript:ver_actividad_monitor();" data-toggle="tooltip" title="ver datos de la ACTIVIDAD DEL MONITOR seleccionada" class="btn btn-lg btn-info"><i class="icon-eye-open"></i>Ver</a>
<!--            <a href="javascript:editar_formulario_actividades_monitor()" data-toggle="tooltip" title="editar datos de la ACTIVIDAD DEL MONITOR seleccionada" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:confirmar_eliminar_actividades_monitor()" data-toggle="tooltip" title="Borrar el registro de la ACTIVIDAD DEL MONITOR seleccionada" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>-->
        </div>
    </div>
    
    
    
    
    
    <?php $this->mostrar("listadosRegistros/tablaListadoActividadesMonitor", $this->datos); ?>


</div>



<script>
    $(document).ready(function() {
        
        
        
        $('#form-control-subreceptor-periodo').submit(function(e) {
            if (estaVacio($('#subreceptor-form-control').val())) {
                alert('Seleccione un Subreceptor.');
                return false;
            }
            mostrar_lista_actividades_monitor_gestion( $(this).serialize() );
        });
        
        
//        $('#actividades-monitor-datatables tbody tr').dblclick(function(e) {
//            $(this).addClass('row_selected');
//
//            var tabla = $('#actividades-monitor-datatables').dataTable();
//            $('#registro-seleccionado').html(filaSeleccionada(tabla, 'data-titulo'));
//            editar_formulario_actividades_monitor();
//        });

        $('#actividades-monitor-datatables tbody tr').live('click', function(e) {
            var tabla = $('#actividades-monitor-datatables').dataTable();
            $('#registro-seleccionado').html(filaSeleccionada(tabla, 'data-titulo'));
        });

    });



    function editar_formulario_actividades_monitor() {
        var tabla = $('#actividades-monitor-datatables').dataTable();
        var idFila = filaId(tabla);        
        if (idFila != null) {
           editar_datos_actividad_monitor(idFila);
        } else {
            alert('Debes seleccionar un registro');
        }

    }
    
    function ver_actividad_monitor() {
        var tabla = $('#actividades-monitor-datatables').dataTable();
        var idFila = filaId(tabla);        
        if (idFila != null) {
            mostrar_datos_actividad_monitor(idFila);
        } else {
            alert('Debes seleccionar un registro');
        }

    }

    function confirmar_eliminar_actividades_monitor() {
        var tabla = $('#actividades-monitor-datatables').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            confirm(
                "¿Seguro que desea eliminar la <strong>Actividad del Monitor<strong> seleccionada.?",
                "eliminar_actividades_monitor();"
            );
        } else {
            alert('Debes seleccionar un registro');
        }

    }

    function eliminar_actividades_monitor() {
        var tabla = $('#actividades-monitor-datatables').dataTable();
        var idFila = filaId(tabla);        
        if (idFila != null) {
           ejecutarAccionJson(
                    'monitores', 'ActividadesMonitor', 'eliminar_actividad_monitor', 'idActividad=' + idFila ,
                    ' mostrar_resultado_guardar( data, "mostrar_tabla_actividades_monitor();", "" ); '
                    );
        } else {
            alert('Debes seleccionar un registro');
        }

    }



</script>
<script>
    agregar_boton_ayuda('BIENVENIDA');
</script>
