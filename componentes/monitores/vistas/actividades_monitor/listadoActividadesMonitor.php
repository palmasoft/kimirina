<div id="pre-page-content">
    <h1>
        <i class="glyphicon-conversation themed-color"></i> Actividades del Monitor<br>
        <small>Listado de actividades realizadas por los monitores </small>
    </h1>
</div>

<div id="page-content">
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Monitores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Actividades del Monitor</a></li>
    </ul>
  
    <?php if (!$tieneRestricciones or Usuario::esDNI() ): ?>            
        <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos, 'gestion'); ?>
    <?php endif; ?>

    
    
    
    
    
    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
            <!--<a href="javascript:mostrar_datos_actividades_monitor();" data-toggle="tooltip" title="agregar una nueva ACTIVIDAD realizada" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>-->
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">     
            <a href="javascript:ver_actividad_monitor();" data-toggle="tooltip" title="Ver datos de la actividad del monitor seleccionada" class="btn btn-lg btn-info"><i class="icon-zoom-in"></i>Ver</a>
            <a href="javascript:editar_formulario_actividades_monitor()" data-toggle="tooltip" title="Editar datos de la actividad del monitor seleccionada" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:confirmar_eliminar_actividades_monitor()" data-toggle="tooltip" title="Eliminar el registro de la actividad del monitor seleccionada" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>
        </div>
    </div>
    
    
    
     <table id="actividades-monitor-datatables" class="table table-bordered table-hover dataTables">
        <thead>
            <tr> 
                <?php if ($SubReceptor->ID_SUBRECEPTOR === 0): ?>
                <th class="">SR</th>
                <?php endif; ?>
                <th>Fecha</th>
                <th class="" >Cantón</th>
                <th title="Hora de Inicio de la Actividad." data-toggle="tooltip" class="enable-tooltip"  >Inicio</th>
                <th title="Hora en que Terminá la Actividad." data-toggle="tooltip" class="enable-tooltip" >Final</th>
                <th>Actividad</th>
                <th>Tema</th>
                <th >Responsable</th>
                <th title="Asistentes" data-toggle="tooltip" class="enable-tooltip" >Asi</th>
            </tr>
        </thead>
        <tbody>            
            <?php
            if (isset($Actividades)) {
                if ($Actividades != null) {
                    foreach ($Actividades as $actividades) {
                        ?>
                        <tr fila-id="<?php echo $actividades->ID_ACTIVIDADREALIZADA ?>" data-titulo="<?php echo ($actividades->NOMBRE_ACTIVIDAD) ?>">
                            <?php if ($SubReceptor->ID_SUBRECEPTOR === 0): ?>
                            <th class=""><?php echo ($actividades->SIGLAS_SUBRECEPTOR) ?></th>
                            <?php endif; ?>
                            <td class="text-center"><?php echo ($actividades->NOMBRE_CANTON) ?></td>
                            <td class="text-center"><?php echo ($actividades->FECHA_ACTIVIDAD_MONITOR) ?></td>
                            <td class=" "><?php echo ($actividades->HORA_INICIO_ACTIVIDAD_MONITOR) ?></td>
                            <td class=" "><?php echo ($actividades->HORA_FIN_ACTIVIDAD_MONITOR) ?></td>
                            <td><?php echo ($actividades->NOMBRE_ACTIVIDAD) ?></td>
                            <td class=" "><?php echo ($actividades->TITULO_TEMA) ?></td>
                            <td class=" "><?php echo ($actividades->NOMBRE_REAL_PERSONA) ?></td>
                            <td class=" "><?php echo ($actividades->ASISTENTES) ?></td>
                        </tr>
                        <?php
                    }
                }
            }
            ?>
        </tbody>
    </table>   



</div>



<script>
    $(document).ready(function() {
        
        
        
        $('#form-control-subreceptor-periodo').submit(function(e) {
            if (estaVacio($('#subreceptor-form-control').val())) {
                alert('Seleccione un Subreceptor.');
                return false;
            }
            mostrar_tabla_actividades_monitor( $(this).serialize() );
        });
        
        
        $('#actividades-monitor-datatables tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');

            var tabla = $('#actividades-monitor-datatables').dataTable();
            $('#registro-seleccionado').html(filaSeleccionada(tabla, 'data-titulo'));
            editar_formulario_actividades_monitor();
        });

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
            alert('Debes seleccionar un registro para editar');
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
            alert('Debes seleccionar un registro para eliminar');
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
            alert('Debes seleccionar un registro para eliminar');
        }

    }
</script>

<script>
    agregar_boton_ayuda('LISTAACTIVIDADMONITOR');
</script>