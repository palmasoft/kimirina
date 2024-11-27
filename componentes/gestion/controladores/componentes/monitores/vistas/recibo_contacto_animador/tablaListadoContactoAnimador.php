<table id="recibo-contacto-animador-datatables" class="table table-bordered table-hover dataTables">
    <thead>
    <th>recibo</th>
    <th>fecha</th>
    <th>Pob</th>
    <th>Ubicacion</th>
    <th>Codigo</th>
    <th>Cedula</th>
    <th>Nombre Completo</th>
    <th>Tema</th>
    <th>animador</th>
    <th data-toggle="tooltip" title="C: Condones; L: Lubricantes; F: Folleteria;" >C/L/F</th>
</tr>
</thead>
<tbody>  
    <?php
    if (!empty($ContactoAnimador)) {
        foreach ($ContactoAnimador as $contactoAnimador) {
            ?>
            <tr fila-id="<?php echo $contactoAnimador->ID_CONTACTOANIMADOR ?>" data-titulo="<?php echo ($contactoAnimador->NO_RECIBO_CONTACTOANIMADOR) ?>">
                <td><?php echo ($contactoAnimador->NO_RECIBO_CONTACTOANIMADOR) ?></td>
                <td class="text-center"><?php echo ($contactoAnimador->ANO_CONTACTOANIMADOR . '-' . $contactoAnimador->MES_CONTACTOANIMADOR . '-' . $contactoAnimador->DIA_CONTACTOANIMADOR . ' ' . $contactoAnimador->HORA_CONTACTOANIMADOR) ?></td>
                <td class=""><?php echo ($contactoAnimador->TIPO_FORMATO_CONTACTOANIMADOR) ?></td>
                <td class=""><?php echo ($contactoAnimador->NOMBRE_PROVINCIA) ?> - <?php echo ($contactoAnimador->NOMBRE_CANTON) ?></td>
                <td class=""><?php echo ($contactoAnimador->CODIGO_UNICO_PERSONA) ?></td>
                <td class=""><?php echo ($contactoAnimador->CEDULA_PEMAR) ?></td>
                <td class=""><?php echo ($contactoAnimador->PRIMER_NOMBRE_PEMAR . ' ' . $contactoAnimador->SEGUNDO_NOMBRE_PEMAR . ' ' . $contactoAnimador->PRIMER_APELLIDO_PEMAR . ' ' . $contactoAnimador->SEGUNDO_APELLIDO_PEMAR) ?></td>
                <td class=""><?php echo ($contactoAnimador->TITULO_TEMA) ?></td>
                <td class=""><?php echo ($contactoAnimador->NOMBRE_REAL_PERSONA) ?></td>
                <td class=""><?php echo ($contactoAnimador->NUM_CONDONES . '/' . $contactoAnimador->NUM_LUBRICANTES . '/' . $contactoAnimador->NUM_FOLLETOS) ?></td>
            </tr>
            <?php
        }
    }
    ?>
</tbody>
</table>   