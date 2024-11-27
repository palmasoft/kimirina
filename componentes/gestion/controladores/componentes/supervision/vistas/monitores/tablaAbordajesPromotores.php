<table id="tabla-abordajes-mensual" class="table table-bordered table-hover dataTables">
        <thead>
            <tr>
                <th class="span1 text-center hidden-phone" style="width: 10px;">#</th>
                <th class="span1 text-center hidden-phone">Codigo</th>
                <th >Primer Nombre</th>
                <th >Segundo Nombre</th>
                <th >Primer Apellido</th>
                <th >Segundo Apellido</th>
                <th class="span1 text-center hidden-phone">Año Nacimiento</th>
                <th class="span1 text-center hidden-phone">Mes Nacimiento</th>
                <th class="span1 text-center hidden-phone">Fecha Abordaje</th>
                <th class="span1 text-center hidden-phone">Hora Abordaje</th>
                <th class="span1 text-center hidden-phone">Verificado</th>
                <th class="span1 text-center hidden-phone">Seguimiento</th>
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
                    <?php echo ($informe->FECHA_CONTACTO); ?>
                </td>
                <td>
                    <?php echo ($informe->HORA_CONTACTO); ?>
                </td>
                <td>
                    <?php echo ($informe->VERIFICADO_PEMAR); ?>
                </td>
                <td>
                    <?php echo ($informe->NUM_REGISTROSEMANAL); ?>
                </td>
            </tr>   
            <?php endforeach; ?>             
        </tbody>
        
        <?php } ?>
    </table>
