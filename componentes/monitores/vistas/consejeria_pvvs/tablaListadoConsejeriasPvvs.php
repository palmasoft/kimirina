<table id="formularios-pvvs-datatables" class="table table-bordered table-hover dataTables"  >
    <thead>
        <tr>
            <?php if ($SubReceptor->ID_SUBRECEPTOR === 0): ?>
                <th class="">SR</th>
            <?php endif; ?>        
            <th class=" text-center">Fecha</th>
            <th class=" text-center">Seguimiento</th>
            <th class=" text-center">Código</th>
            <th class=" text-center">Nombre Completo</th>
            <th class=" text-center">Mes</th>
            <th class=" text-center">Año</th>
            <th class=" text-center">Cédula</th>
            <th class=" text-center">Sexo</th>
            <th class=" text-center">Residencia</th>
            <th class=" text-center">Establecimiento</th>
            <th class=" text-center">Tratamiento</th>
            <th class=" text-center">Consejero</th>
            <th data-toggle="tooltip" title="C: condones; L: lubricantes; P: pastilleros; M: material, folleteria;" >C/L/P/M</th>          
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
                    <td class=" text-center"><?php echo $consejeria->PRIMER_NOMBRE_PEMAR . " " . $consejeria->SEGUNDO_NOMBRE_PEMAR . " " . $consejeria->PRIMER_APELLIDO_PEMAR . " " . $consejeria->SEGUNDO_APELLIDO_PEMAR ?></td>
                    <td class=" text-center"><?php echo $consejeria->MES_NACIMIENTO_POBLACION ?></td>
                    <td class=" text-center"><?php echo $consejeria->ANO_NACIMIENTO_POBLACION ?></td>
                    <td class=" text-center"><?php echo $consejeria->CEDULA_PEMAR ?></td>
                    <td class=" text-center"><?php echo $consejeria->SEXO_PERSONA ?></td>
                    <td class=" text-center"><?php echo $consejeria->NOMBRE_CANTON ?></td>
                    <td class=" text-center"><?php echo $consejeria->NOMBRE_CENTROSERVICIO ?></td>
                    <td class=" text-center"><?php echo $consejeria->TRATAMIENTO_ARV ?></td>
                    <td class=" text-center"><?php echo $consejeria->NOMBRE_CONSEJERO ?></td>
                    <td class="hidden-xs hidden-sm"><?php echo ($consejeria->NUM_CONDONES . '/' . $consejeria->NUM_LUBRICANTES . '/' . $consejeria->NUM_PASTILLEROS . '/' . $consejeria->NUM_MATERIAL_IEC) ?></td> 
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




