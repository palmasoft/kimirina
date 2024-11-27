<table id="formularios-pvvs-datatables" class="table table-bordered table-hover dataTables"  >
    <thead>
        <tr>
            <th class=" text-center">FECHA</th>
            <th class=" text-center">SEGUIMIENTO</th>
            <th class=" text-center">CODIGO</th>
            <th class=" text-center">NOMBRE COMPLETO </th>
            <th class=" text-center">CEDULA </th>
            <th class=" text-center">SEXO</th>
            <th class=" text-center">RESIDENCIA</th>
            <th data-toggle="tooltip" title="C: condones; L: lubricantes; P: pastilleros; M: material, folleteria;" >C/L/P/M</th>          
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($TodasConsejerias)) {
            foreach ($TodasConsejerias as $consejeria) {
                ?>
                <tr fila-id="<?php echo $consejeria->ID_CONSEJERIA_PVVS ?>" data-num-consejeria="<?php echo $consejeria->NUM_CONSEJERIA ?>"  >
                    <td class=" text-center"><?php echo $consejeria->FECHA_CONSEJERIA ?></td>
                    <td class=" text-center"><?php echo $consejeria->NUM_CONSEJERIA ?></td>
                    <td class=" text-center"><?php echo $consejeria->CODIGO_UNICO_PERSONA ?></td>
                    <td class=" text-center"><?php echo $consejeria->PRIMER_NOMBRE_PEMAR . " " . $consejeria->SEGUNDO_NOMBRE_PEMAR . " " . $consejeria->PRIMER_APELLIDO_PEMAR . " " . $consejeria->SEGUNDO_APELLIDO_PEMAR ?></td>
                    <td class=" text-center"><?php echo $consejeria->CEDULA_PEMAR ?></td>
                    <td class=" text-center"><?php echo $consejeria->SEXO_PERSONA ?></td>
                    <td class=" text-center"><?php echo $consejeria->NOMBRE_CANTON ?></td>
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




