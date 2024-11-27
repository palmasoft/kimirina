<table id="tbl-form-registros-semanales" class="table table-bordered table-hover dataTables">
    <thead>
        <tr>
            <?php if ($SubReceptor->ID_SUBRECEPTOR === 0): ?>
                <th class="">SR</th>
            <?php endif; ?>
            <th class=" text-center">Pob</th>
            <th class=" text-center">De / A</th>
            <th class=" text-center">Seguimiento</th>
            <th class="">Promotor</th>
            <th class="">Provincia - Canton</th>
            <th class="" title="Personas Alcanzadas" >Alc</th>
            <th class="">Revisado</th>
            <th class="">Aprobado</th>
            <th class="">Digitador - Fecha Creacion</th>
            <th class="">Modifica - Fecha Modificacion</th>
            <th class="">Elimina - Fecha Eliminacion</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($formularios)) {
            foreach ($formularios as $formulario) {
                ?>
                <tr fila-id="<?php echo ($formulario->ID_REGISTROSEMANAL) ?>"  data-code="<?php echo ($formulario->NUM_REGISTROSEMANAL) ?>">
                    <?php if ($SubReceptor->ID_SUBRECEPTOR === 0): ?>
                        <th class=""><?php echo ($formulario->SIGLAS_SUBRECEPTOR) ?></th>
                    <?php endif; ?>
                    <td class="text-center "><?php echo ($formulario->TIPO_FORMATO_REGISTROSEMANAL) ?></td>
                    <td class="text-center "><?php echo ($formulario->SEMANA_DEL) ?> / <?php echo ($formulario->SEMANA_HASTA) ?></td>
                    <td class="text-center "><?php echo ($formulario->NUM_REGISTROSEMANAL) ?></td>
                    <td class=""><?php echo ($formulario->NOMBRE_REAL_PERSONA) ?></td>
                    <td class=""><?php echo ($formulario->NOMBRE_PROVINCIA ) ?> - <?php echo ($formulario->NOMBRE_CANTON ) ?></td>
                    <td class=""><?php echo ($formulario->CONTACTOS ) ?></td>                    
                    <td class=""><?php echo ($formulario->NOMBRE_MONITOR ) ?></td>             
                    <td class=""><?php echo ($formulario->NOMBRE_COORDINADOR ) ?></td>      
                    <td class=""><?php echo ($formulario->NOMBRE_DIGITADOR ) ?> <?php echo ($formulario->FECHA_CREACION_REGISTRO_SEMANAL ) ?></td>  
                    <td class=""><?php echo ($formulario->NOMBRE_MODIFICA ) ?> <?php echo ($formulario->FECHA_MODIFICACION_REGISTRO_SEMANAL ) ?></td> 
                    <td class=""><?php echo ($formulario->NOMBRE_ELIMINA) ?> <?php echo ($formulario->FECHA_ELIMINACION_REGISTRO_SEMANAL ) ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>