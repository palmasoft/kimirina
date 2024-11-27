<table id="tbleventosMasivos" class="table table-bordered table-hover dataTables" >
    <thead>
        <tr>
            <th class=" text-center ">Fecha actividad</th>
            <th class=" text-center ">Ubicacion</th>
            <th class=" text-center ">Sitio Actividad</th>
            <th class=" text-center ">Empresa</th>
            <th class=" text-center ">Motivo</th>
            <th class=" text-center ">Referidos efectivos</th>
            <th class=" text-center ">Condones Entregados</th>
            <th class=" text-center ">Lubricantes Entregados</th>
            <th class=" text-center ">Digitador - Fecha Creacion</th>
            <th class=" text-center ">Modifica - Fecha Modificacion</th>
            <th class=" text-center ">Elimina - Fecha Eliminacion</th>
        </tr>
    </thead>
    <tbody>  
        <?php
        if (!empty($EventosMasivos)):
            foreach ($EventosMasivos as $eventos) :
                ?>
                <tr fila-id="<?php echo ($eventos->ID_EVENTO_MASIVO) ?>"  data-code="<?php echo ($eventos->FECHA_EVENTO_MASIVO) ?> | <?php echo ($eventos->NOMBRE_TIPOLUGAR) ?> | <?php echo ($eventos->NOMBRE_REAL_PERSONA) ?>" >
                    <td class=" text-center "><?php echo $eventos->FECHA_EVENTO_MASIVO ?></td>
                    <td class=" text-center "><?php echo $eventos->NOMBRE_PROVINCIA ?> / <?php echo $eventos->NOMBRE_CANTON ?></td>
                    <td class=" text-center "><?php echo $eventos->NOMBRE_TIPOLUGAR ?> / <?php echo $eventos->NOMBRE_LUGAR ?></td>
                    <td class=" text-center "><?php echo $eventos->EMPRESA_ORGANIZA_ACTIVIDAD ?></td>
                    <td class=" text-center "><?php echo $eventos->MOTIVO_EVENTO_MASIVO ?></td>
                    <td class=" text-center "><?php echo $eventos->NUM_EFECTIVOS_EVENTO_MASIVO ?></td>
                    <td class=" text-center "><?php echo $eventos->NUM_CONDONES ?></td>
                    <td class=" text-center "><?php echo $eventos->NUM_LUBRICANTES ?></td>
                    <td class=" text-center "><?php echo $eventos->NOMBRE_DIGITADOR ?> <?php echo $eventos->FECHA_CREACION_EVENTO_MASIVO ?></td>  
                    <td class=" text-center "><?php echo $eventos->NOMBRE_MODIFICA ?> <?php echo $eventos->FECHA_MODIFICACION_EVENTO_MASIVO ?></td> 
                    <td class=" text-center "><?php echo $eventos->NOMBRE_ELIMINA ?> <?php echo $eventos->FECHA_ELIMINACION_EVENTO_MASIVO ?></td>
                </tr>                    
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>  