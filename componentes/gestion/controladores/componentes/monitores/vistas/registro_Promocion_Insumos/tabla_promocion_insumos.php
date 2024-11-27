<!-- Dynamic Tables Section -->
<div class="block-section">
    <table id="tblPromocionInsumos" class="table table-bordered table-hover dataTables" >
        <thead>
            <tr>
                <th class=" text-center ">Fecha actividad</th>
                <th class=" text-center ">Sitio Actividad</th>
                <th class=" text-center ">Motivo/Actividad</th>
                <th class=" text-center ">HSH</th>
                <th class=" text-center ">TS</th>
                <th class=" text-center ">TRANS</th>
                <th class=" text-center ">Total</th>
                <th class=" text-center ">Condones Entregados</th>
                <th class=" text-center ">Lubricantes Entregados</th>
                <th class=" text-center ">Responsable de la Actividad</th>
            </tr>
        </thead>
        <tbody>    
            <?php
            if (!empty($registroActividad)) :
                foreach ($registroActividad as $registros) :
                    ?>
                    <tr fila-id="<?php echo ($registros->ID_ACTIVIDAD_PROMOCION) ?>" data-nombre="<?php echo ($registros->FECHA_ACTIVIDAD_PROMOCION."-".$registros->NOMBRE_TIPOLUGAR . "-" . $registros->NOMBRE_LUGAR) ?>">
                        <td><?php echo ($registros->FECHA_ACTIVIDAD_PROMOCION) ?></td>
                        <td><?php echo ($registros->NOMBRE_TIPOLUGAR . ", " . $registros->NOMBRE_LUGAR) ?></td>
                        <td><?php echo ($registros->MOTIVO_ACTIVIDAD_PROMOCION) ?></td>
                        <td><?php echo ($registros->NUM_HSH_ACTIVIDAD_PROMOCION) ?></td>
                        <td><?php echo ($registros->NUM_TS_ACTIVIDAD_PROMOCION) ?></td>
                        <td><?php echo ($registros->NUM_TRANS_ACTIVIDAD_PROMOCION) ?></td>
                        <td><?php echo ($registros->NUM_HSH_ACTIVIDAD_PROMOCION + $registros->NUM_TS_ACTIVIDAD_PROMOCION + $registros->NUM_TRANS_ACTIVIDAD_PROMOCION) ?></td>
                        <td><?php echo $registros->CANT_CONDONES ?></td>
                        <td><?php echo $registros->CANT_LUBRICANTES ?></td>
                        <td><?php echo ($registros->NOMBRE_REAL_PERSONA) ?></td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?> 
        </tbody>
    </table>    
</div>
<!-- END Dynamic Tables Section -->