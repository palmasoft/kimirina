
<div class="block-section">
    <table id="actividades-monitor-datatables" class="table table-bordered table-hover dataTables">
        <thead>
            <tr>
            <?php if ($SubReceptor->ID_SUBRECEPTOR === 0): ?>
            <th class="">SR</th>
            <?php endif; ?>
                <th>Fecha</th>
                <th title="Hora de Inicio de la Actividad." data-toggle="tooltip" class="enable-tooltip"  >Inicio</th>
                <th title="Hora en que Terminó la Actividad." data-toggle="tooltip" class="enable-tooltip" >Final</th>
                <th>Actividad</th>
                <th>Tema</th>
                <th>Canton</th>
                <th >Responsable</th>
                <th title="Asistentes" data-toggle="tooltip" class="enable-tooltip" >Asi</th>
            <th>Fecha Creacion</th>
            <th>Modifica - Fecha Modificacion</th>
            <th>Elimina - Fecha Eliminacion</th>
            </tr>
        </thead>
        <tbody>            
            <?php
            if (isset($ActividadesMonitor)) {
                if ($ActividadesMonitor != null) {
                    foreach ($ActividadesMonitor as $actividades) {
                        ?>
                        <tr fila-id="<?php echo $actividades->ID_ACTIVIDADREALIZADA ?>" data-titulo="<?php echo ($actividades->NOMBRE_ACTIVIDAD) ?>">
                            
                            <?php if ($SubReceptor->ID_SUBRECEPTOR === 0): ?>
                            <th class=""><?php echo ($actividades->SIGLAS_SUBRECEPTOR) ?></th>
                            <?php endif; ?>
                            
                            <td class="text-center"><?php echo ($actividades->FECHA_ACTIVIDAD_MONITOR) ?></td>
                            <td class=" "><?php echo ($actividades->HORA_INICIO_ACTIVIDAD_MONITOR) ?></td>
                            <td class=" "><?php echo ($actividades->HORA_FIN_ACTIVIDAD_MONITOR) ?></td>
                            <td><?php echo ($actividades->NOMBRE_ACTIVIDAD) ?></td>
                            <td class=" "><?php echo ($actividades->TITULO_TEMA) ?></td>
                            <td class="text-center"><?php echo ($actividades->NOMBRE_CANTON) ?></td>
                            <td class=" "><?php echo ($actividades->NOMBRE_REAL_PERSONA) ?></td>
                            <td class=" "><?php echo ($actividades->ASISTENTES) ?></td>
                            <td class=""><?php echo ($actividades->FECHA_CREACION_ACTIVIDAD_MONITOR ) ?></td>  
                            <td class=""><?php echo ($actividades->NOMBRE_MODIFICA ) ?> <?php echo ($actividades->FECHA_MODIFICACION_ACTIVIDAD_MONITOR ) ?></td> 
                            <td class=""><?php echo ($actividades->NOMBRE_ELIMINA) ?> <?php echo ($actividades->FECHA_ELIMINACION_ACTIVIDAD_MONITOR ) ?></td>
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
        
    });
</script>
