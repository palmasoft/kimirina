<table id="tabla-abordajes-mensual" class="table table-bordered table-hover dataTables">
        <thead>
            <tr>
                <th class=" text-center" style="width: 10px;">#</th>
                <th class=" text-center">Codigo</th>
                <th >Primer Nombre</th>
                <th >Segundo Nombre</th>
                <th >Primer Apellido</th>
                <th >Segundo Apellido</th>
                <th class=" text-center">Año Nacimiento</th>
                <th class=" text-center">Mes Nacimiento</th>
                <th class=" text-center">Fecha Abordaje</th>
                <th class=" text-center">Hora Abordaje</th>
                <th class=" text-center">Verificado</th>
                <th class=" text-center">Numero Recibo Contacto Animador</th>
                <th class=" text-center">Nuevo</th>
                <th class=" text-center">Recurrente</th>
                <th class=" text-center">Derivado Efectivo</th>
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
                    <?php echo ($informe->ANO_NACIMIENTO_POBLACION); ?>
                </td>
                <td>
                    <?php echo ($informe->MES_NACIMIENTO_POBLACION); ?>
                </td>
                <td>
                    <?php echo ($informe->ANO_CONTACTOANIMADOR.'-'.$informe->MES_CONTACTOANIMADOR.'-'.$informe->DIA_CONTACTOANIMADOR); ?>
                </td>
                <td>
                    <?php echo ($informe->HORA_CONTACTOANIMADOR); ?>
                </td>
                <td>
                    <?php echo ($informe->VERIFICADO_PEMAR); ?>
                </td>
                <td>
                    <?php echo ($informe->NO_RECIBO_CONTACTOANIMADOR); ?>
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
            </tr>   
            <?php endforeach; ?>             
        </tbody>
        
        <?php } ?>
    </table>
