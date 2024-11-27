
    
<!-- Dynamic Tables Section -->
<div class="block-section">
    <table id="tblRegistroAtencionSalud" class="table table-striped dataTables" >
        <thead>
            <tr>
            <?php if ($SubReceptor->ID_SUBRECEPTOR === 0): ?>
                <th class="">SR</th>
            <?php endif; ?>            
                <th>Fecha de Atención</th>
                <th>Unidad de Salud</th>
                <th>Tipo de Atención</th>
                <th>Pob</th>
                <th>Código Único</th>
                <th>Cédula</th>
                <th>Persona Atendida</th>
                <th>Fecha de Nacimiento</th>
            </tr>
        </thead>
        <tbody>    
            <?php foreach ($registrosAtencionSalud as $registroAtencionSalud) : ?>
                <tr fila-id="<?php echo ($registroAtencionSalud->ID_ATENCION_SALUD) ?>" 
                    data-nombre="<?php echo ($registroAtencionSalud->FECHA_ATENCION) ?>-<?php echo ($registroAtencionSalud->CODIGO_UNICO_PERSONA) ?>">                        
                    <?php if ($SubReceptor->ID_SUBRECEPTOR === 0): ?>
                        <th class=""><?php echo ($registroAtencionSalud->SIGLAS_SUBRECEPTOR) ?></th>
                    <?php endif; ?>
                    <td><?php echo ($registroAtencionSalud->FECHA_ATENCION) ?></td>
                    <td><?php echo ($registroAtencionSalud->NOMBRE_CENTROSERVICIO) ?></td>
                    <td><?php echo ($registroAtencionSalud->NOMBRE_SERVICIO) ?></td>
                    <td><?php echo ($registroAtencionSalud->TIPO_FORMATO_ATENCION) ?></td>
                    <td><?php echo ($registroAtencionSalud->CODIGO_UNICO_PERSONA) ?></td>
                    <td><?php echo ($registroAtencionSalud->CEDULA_PEMAR) ?></td>
                    <td><?php echo ($registroAtencionSalud->PRIMER_NOMBRE_PEMAR) ?> <?php echo ($registroAtencionSalud->SEGUNDO_NOMBRE_PEMAR) ?> <?php echo ($registroAtencionSalud->PRIMER_APELLIDO_PEMAR) ?> <?php echo ($registroAtencionSalud->SEGUNDO_APELLIDO_PEMAR) ?></td>
                    <td><?php echo ($registroAtencionSalud->MES_NACIMIENTO_POBLACION) ?>-<?php echo ($registroAtencionSalud->ANO_NACIMIENTO_POBLACION) ?></td>
                </tr>
            <?php endforeach; ?> 

        </tbody>
    </table>    
</div>
<!-- END Dynamic Tables Section -->