
<div class="block-section">
    <table id="actividades-monitor-datatables" class="table table-bordered table-hover dataTables">
        <thead>
            <tr>
                <th>Fecha</th>
                <th title="Hora de Inicio de la Actividad." data-toggle="tooltip" class="enable-tooltip"  >Inicio</th>
                <th title="Hora en que Terminó la Actividad." data-toggle="tooltip" class="enable-tooltip" >Final</th>
                <th>Actividad</th>
                <th>Tema</th>
                <th>Canton</th>
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
                            <td class="text-center"><?php echo ($actividades->FECHA_ACTIVIDAD_MONITOR) ?></td>
                            <td class=" "><?php echo ($actividades->HORA_INICIO_ACTIVIDAD_MONITOR) ?></td>
                            <td class=" "><?php echo ($actividades->HORA_FIN_ACTIVIDAD_MONITOR) ?></td>
                            <td><?php echo ($actividades->NOMBRE_ACTIVIDAD) ?></td>
                            <td class=" "><?php echo ($actividades->TITULO_TEMA) ?></td>
                            <td class="text-center"><?php echo ($actividades->NOMBRE_CANTON) ?></td>
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
        
    });
</script>
