<table id="tabla-abordajes-mensual" class="table table-bordered table-hover dataTables">
        <thead>
            <tr>
                <th class="" style="width: 10px;">#</th>
                <th class="">Codigo</th>
                <th >Primer Nombre</th>
                <th >Segundo Nombre</th>
                <th >Primer Apellido</th>
                <th >Segundo Apellido</th>
                <th class=""> Nacimiento</th>
                <th class="">Fecha y Hora Abordaje</th>
                <th class="">Verificado</th>
                <th class="">Seguimiento</th>
                <th class="">Nuevo</th>
                <th class="">Recurrente</th>
                <th class="">Derivado Efectivo</th>
                <th class="">Promotor</th>
            </tr>
        </thead>
        <tbody> 
            
            <?php 
            $countRow = 0;
            if(isset($Informe->filas)){
                foreach ($Informe->filas as $informe) : ?>    
            <tr>
                <td>
                    <?php echo $countRow += 1?>
                </td>
                <td>
                    <?php echo ($informe->CODIGO_UNICO_PERSONA); ?>
                </td>
                <td>
                    <?php echo ($informe->NOMBRE_UNO_POBLACION); ?>
                </td>
                <td>
                    <?php echo ($informe->NOMBRE_DOS_POBLACION); ?>
                </td>
                <td>
                    <?php echo ($informe->APELLIDO_UNO_POBLACION); ?>
                </td>
                <td>
                    <?php echo ($informe->APELLIDO_DOS_POBLACION); ?>
                </td>
                <td>
                    <?php echo ($informe->ANO_NACIMIENTO_POBLACION); ?>-<?php echo ($informe->MES_NACIMIENTO_POBLACION); ?>
                </td>
                <td>
                    <?php echo ($informe->FECHA_CONTACTO); ?> &nbsp; <?php echo ($informe->HORA_CONTACTO); ?>
                </td>
                <td>
                    <?php echo ($informe->VERIFICADO_PEMAR); ?>
                </td>
                <td>
                    <?php echo ($informe->NUM_REGISTROSEMANAL); ?>
                </td>
                <td>
                    <?php echo ($informe->NUEVO); ?>
                </td>
                <td>
                    <?php echo ($informe->RECURRENTE); ?>
                </td>
                <td>
                    <?php echo ($informe->REFERIDOS_EFECTIVO); ?>
                </td>
                <td>
                    <?php echo ($informe->NOMBRE_PROMOTOR); ?>
                </td>
            </tr>   
            <?php endforeach; ?>             
        </tbody>
        
        <?php } ?>
    </table>
