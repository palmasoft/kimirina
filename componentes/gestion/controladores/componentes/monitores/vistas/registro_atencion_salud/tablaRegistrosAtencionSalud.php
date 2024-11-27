
    
<!-- Dynamic Tables Section -->
<div class="block-section">
    <table id="tblRegistroAtencionSalud" class="table table-striped dataTables" >
        <thead>
            <tr>
                <th>Fecha de Atencion</th>
                <th>Centro de salud</th>
                <th>Tipo de Atencion</th>
                <th>Pob</th>
                <th>Codigo unico</th>
                <th>Cedula</th>
                <th>Persona atendida</th>
                <th>Fecha de nacimiento</th>
            </tr>
        </thead>
        <tbody>    
            <?php foreach ($registrosAtencionSalud as $registroAtencionSalud) : ?>
                <tr fila-id="<?php echo ($registroAtencionSalud->ID_ATENCION_SALUD) ?>" 
                    data-nombre="<?php echo ($registroAtencionSalud->FECHA_ATENCION) ?>-<?php echo ($registroAtencionSalud->CODIGO_UNICO_PERSONA) ?>">                        
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