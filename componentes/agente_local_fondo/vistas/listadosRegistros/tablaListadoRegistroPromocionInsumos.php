<!-- Dynamic Tables Section -->
<div class="block-section">
    <table id="tblPromocionInsumos" class="table table-bordered table-hover dataTables" >
        <thead>
            <tr>
            <?php if ($SubReceptor->ID_SUBRECEPTOR === 0): ?>
            <th class="">SR</th>
            <?php endif; ?>
                <th class=" text-center ">Fecha Actividad</th>
                <th class=" text-center ">Sitio Actividad</th>
                <th class=" text-center ">Motivo/Actividad</th>
                
                <?php if ($mostrarHSH) : ?>
                    <th class=" text-center ">HSH</th>
                <?php endif; ?>

                <?php if ($mostrarTS) : ?>
                    <th class=" text-center ">TS</th>
                <?php endif; ?>

                <?php if ($mostrarTRANS) : ?>
                    <th class=" text-center ">TRANS</th>
                <?php endif; ?>

                <?php if ($mostrarPVVS) : ?>
                    <th class=" text-center ">PVVS</th>
                <?php endif; ?>

                <th class=" text-center ">Total</th>
                <th class=" text-center ">Cond</th>
                <th class=" text-center ">Lubr</th>
                <th class=" text-center ">Responsable de la Actividad</th>
            <th>Digitador - Fecha Creacion</th>
            <th>Modifica - Fecha Modificacion</th>
            <th>Elimina - Fecha Eliminacion</th>
            </tr>
        </thead>
        <tbody>    
            <?php
            if (!empty($EntregaInsumos)) :
                foreach ($EntregaInsumos as $registros) :
                    ?>
                    <tr fila-id="<?php echo ($registros->ID_ACTIVIDAD_PROMOCION) ?>" data-nombre="<?php echo ($registros->FECHA_ACTIVIDAD_PROMOCION . "-" . $registros->NOMBRE_TIPOLUGAR . "-" . $registros->NOMBRE_LUGAR) ?>">
                        <?php if ($SubReceptor->ID_SUBRECEPTOR === 0): ?>
                        <th class=""><?php echo ($registros->SIGLAS_SUBRECEPTOR) ?></th>
                        <?php endif; ?>
                    
                        
                        <td><?php echo ($registros->FECHA_ACTIVIDAD_PROMOCION) ?></td>
                        <td><?php echo ($registros->NOMBRE_TIPOLUGAR . ", " . $registros->NOMBRE_LUGAR) ?></td>
                        <td><?php echo ($registros->MOTIVO_ACTIVIDAD_PROMOCION) ?></td>
                        
                        <?php if ($mostrarHSH) : ?>
                            <td><?php echo ($registros->NUM_HSH_ACTIVIDAD_PROMOCION) ?></td>
                        <?php endif; ?>

                        <?php if ($mostrarTS) : ?>
                            <td><?php echo ($registros->NUM_TS_ACTIVIDAD_PROMOCION) ?></td>
                        <?php endif; ?>

                        <?php if ($mostrarTRANS) : ?>
                            <td><?php echo ($registros->NUM_TRANS_ACTIVIDAD_PROMOCION) ?></td>
                        <?php endif; ?>

                        <?php if ($mostrarPVVS) : ?>
                            <td><?php echo ($registros->NUM_PVVS_ACTIVIDAD_PROMOCION) ?></td>
                        <?php endif; ?>
                            
                        <td><?php echo ($registros->NUM_HSH_ACTIVIDAD_PROMOCION + $registros->NUM_TS_ACTIVIDAD_PROMOCION + $registros->NUM_TRANS_ACTIVIDAD_PROMOCION + $registros->NUM_PVVS_ACTIVIDAD_PROMOCION) ?></td>
                        <td><?php echo $registros->CANT_CONDONES ?></td>
                        <td><?php echo $registros->CANT_LUBRICANTES ?></td>
                        <td><?php echo ($registros->NOMBRE_REAL_PERSONA) ?></td>    
                        <td><?php echo ($registros->NOMBRE_DIGITADOR ) ?> <?php echo ($registros->FECHA_CREACION_ACTIVIDAD_PROMOCION ) ?></td>  
                        <td><?php echo ($registros->NOMBRE_MODIFICA ) ?> <?php echo ($registros->FECHA_MODIFICACION_ACTIVIDAD_PROMOCION ) ?></td> 
                        <td><?php echo ($registros->NOMBRE_ELIMINA) ?> <?php echo ($registros->FECHA_ELIMINACION_ACTIVIDAD_PROMOCION ) ?></td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?> 
        </tbody>
    </table>    
</div>
<!-- END Dynamic Tables Section -->