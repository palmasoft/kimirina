
    
<!-- Dynamic Tables Section -->
<div class="block-section">
    <table id="tblRegistroAtencionSalud" class="table table-striped dataTables" >
        <thead>
            <tr>
                <?php if ($SubReceptor->ID_SUBRECEPTOR === 0): ?>
            <th class="">SR</th>
            <?php endif; ?>
                <th>Fecha de Atencion</th>
                <th>Centro de salud</th>
                <th>Tipo de Atencion</th>
                <th>Pob</th>
                <th>Codigo unico</th>
                <th>Cedula</th>
                <th>Persona atendida</th>
                <th>Fecha de nacimiento</th>
            <th>Revisado</th>
            <th>Aprobado</th>
            <th>Digitador - Fecha Creacion</th>
            <th>Modifica - Fecha Modificacion</th>
            <th>Elimina - Fecha Eliminacion</th>
            </tr>
        </thead>
        <tbody>    
            <?php foreach ($AtencionSalud as $registroAtencionSalud) : ?>
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
                    <td><?php echo ($registroAtencionSalud->NOMBRE_MONITOR ) ?></td>      
                    <td><?php echo ($registroAtencionSalud->NOMBRE_COORDINADOR ) ?></td>      
                    <td><?php echo ($registroAtencionSalud->NOMBRE_DIGITADOR ) ?> <?php echo ($registroAtencionSalud->FECHA_CREACION_ATENCION_SALUD ) ?></td>  
                    <td><?php echo ($registroAtencionSalud->NOMBRE_MODIFICA ) ?> <?php echo ($registroAtencionSalud->FECHA_MODIFICACION_ATENCION_SALUD ) ?></td> 
                    <td><?php echo ($registroAtencionSalud->NOMBRE_ELIMINA) ?> <?php echo ($registroAtencionSalud->FECHA_ELIMINACION_ATENCION_SALUD ) ?></td>
                </tr>
            <?php endforeach; ?> 

        </tbody>
    </table>    
</div>
<!-- END Dynamic Tables Section -->