<table id="formularios-pvvs-datatables" class="table table-bordered table-hover dataTables"  >
    <thead>
        <tr>
            <?php if ($SubReceptor->ID_SUBRECEPTOR === 0): ?>
            <th class="">SR</th>
            <?php endif; ?>
            <th class=" text-center">Fecha</th>
            <th class=" text-center">Seguimiento</th>
            <th class=" text-center">Codigo</th>
            <!--<th class=" text-center">NOMBRE COMPLETO </th>-->
            <!--<th class=" text-center">CEDULA </th>-->
            <th class=" text-center">Sexo</th>
            <th class=" text-center">Residencia</th>
            <th data-toggle="tooltip" title="C: condones; L: lubricantes; P: pastilleros; M: material, folleteria;" >C/L/P/M</th>          
            <th>Consejero</th>
            <th>Revisado</th>
            <th>Aprobado</th>
            <th>Digitador - Fecha Creacion</th>
            <th>Modifica - Fecha Modificacion</th>
            <th>Elimina - Fecha Eliminacion</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($TodasConsejerias)) {
            foreach ($TodasConsejerias as $consejeria) {
                ?>
                <tr fila-id="<?php echo $consejeria->ID_CONSEJERIA_PVVS ?>" data-num-consejeria="<?php echo $consejeria->NUM_CONSEJERIA ?>"  >
                    <?php if ($SubReceptor->ID_SUBRECEPTOR === 0): ?>
                    <th class=""><?php echo ($consejeria->SIGLAS_SUBRECEPTOR) ?></th>
                    <?php endif; ?>
                    <td class=" text-center"><?php echo $consejeria->FECHA_CONSEJERIA ?></td>
                    <td class=" text-center"><?php echo $consejeria->NUM_CONSEJERIA ?></td>
                    <td class=" text-center"><?php echo $consejeria->CODIGO_UNICO_PERSONA ?></td>
                    <!--<td class=" text-center"><?php // echo $consejeria->PRIMER_NOMBRE_PEMAR . " " . $consejeria->SEGUNDO_NOMBRE_PEMAR . " " . $consejeria->PRIMER_APELLIDO_PEMAR . " " . $consejeria->SEGUNDO_APELLIDO_PEMAR ?></td>-->
                    <!--<td class=" text-center"><?php // echo $consejeria->CEDULA_PEMAR ?></td>-->
                    <td class=" text-center"><?php echo $consejeria->SEXO_PERSONA ?></td>
                    <td class=" text-center"><?php echo $consejeria->NOMBRE_CANTON ?></td>
                    <td class="hidden-xs hidden-sm"><?php echo ($consejeria->NUM_CONDONES . '/' . $consejeria->NUM_LUBRICANTES . '/' . $consejeria->NUM_PASTILLEROS . '/' . $consejeria->NUM_MATERIAL_IEC) ?></td> 
                    <td class=""><?php echo ($consejeria->NOMBRE_CONSEJERO) ?></td>
                    <td class=""><?php echo ($consejeria->NOMBRE_MONITOR ) ?></td>      
                    <td class=""><?php echo ($consejeria->NOMBRE_COORDINADOR ) ?></td>      
                    <td class=""><?php echo ($consejeria->NOMBRE_DIGITADOR ) ?> <?php echo ($consejeria->FECHA_CREACION_CONSEJERIA ) ?></td>  
                    <td class=""><?php echo ($consejeria->NOMBRE_MODIFICA ) ?> <?php echo ($consejeria->FECHA_MODIFICACION_CONSEJERIA ) ?></td> 
                    <td class=""><?php echo ($consejeria->NOMBRE_ELIMINA) ?> <?php echo ($consejeria->FECHA_ELIMINACION_CONSEJERIA ) ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>

</table>



<script>

    $(document).ready(function() {
        $('#formularios-pvvs-datatables tbody tr').live('click', function(e) {
            var tabla = $('#formularios-pvvs-datatables').dataTable();
            $('#registro-seleccionado').html(
                    filaSeleccionada(tabla, 'data-num-consejeria')
                    );
        });
    });

</script>




