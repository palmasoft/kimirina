<table id="recibo-contacto-animador-datatables" class="table table-bordered table-hover dataTables">
    <thead>
            <?php if ($SubReceptor->ID_SUBRECEPTOR === 0): ?>
                <th class="">SR</th>
            <?php endif; ?>
    <th>Recibo</th>
    <th>Fecha</th>
    <th>Pob</th>
    <th>Ubicación</th>
    <th>Código</th>
    <th>Cédula</th>
    <th>Nombre Completo</th>
    <th>Tema</th>
    <th>Animador</th>
    <th data-toggle="tooltip" title="C: Condones; L: Lubricantes; F: Folleteria;" >C/L/F</th>
</tr>
</thead>
<tbody>  
    <?php
    if (!empty($ContactoAnimador)) {
        foreach ($ContactoAnimador as $contactoAnimador) {
            ?>
            <tr fila-id="<?php echo $contactoAnimador->ID_CONTACTOANIMADOR ?>" data-titulo="<?php echo ($contactoAnimador->NO_RECIBO_CONTACTOANIMADOR) ?>">
                <?php if ($SubReceptor->ID_SUBRECEPTOR === 0): ?>
                        <th class=""><?php echo ($contactoAnimador->SIGLAS_SUBRECEPTOR) ?></th>
                    <?php endif; ?>
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