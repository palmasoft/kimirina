<table id="tabla-abordajes-mensual" class="table table-bordered table-hover dataTables">
        <thead>
            <tr>
                <th class="" style="width: 10px;">#</th>
                <th class="">Codigo</th>
<!--                 <th >Primer Nombre</th>
                <th >Segundo Nombre</th>
                <th >Primer Apellido</th>
                <th >Segundo Apellido</th> -->
                <th class="">Año Nac</th>
                <th class="">Edad</th>

            <th class=" text-center">Sexo</th>
            <th class=" text-center">Residencia</th>
            <th class=" text-center">Establecimiento</th>
            <th class=" text-center"  data-toggle="tooltip" title="Tratamiento"  >Trat</th>
            <th class=" text-center">Consejero</th>

                <th class="">Fecha</th>
                <th class="">Hora</th>

            <th data-toggle="tooltip" title="Condones" >Con</th>
            <th data-toggle="tooltip" title="Lubricantes" >Lub</th>
            <th data-toggle="tooltip" title="Pastilleros" >Pas</th>

                <th class="">Seguimiento</th>
                <th class="">Ver</th>
                <th class="">N/R</th>
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
                    <?php echo ($informe->ANO_NACIMIENTO_POBLACION); ?>
                </td>
                <td>
                    <?php echo intval($informe->EDAD); ?>
                </td>
               
                    <td class=" text-center"><?php echo $informe->SEXO_PERSONA ?></td>
                    <td class=" text-center"><?php echo $informe->NOMBRE_CANTON ?></td>
                    <td class=" text-center"><?php echo $informe->NOMBRE_CENTROSERVICIO ?></td>
                    <td class=" text-center"><?php echo $informe->TRATAMIENTO_ARV ?></td>
                    <td class=" text-center"><?php echo $informe->NOMBRE_CONSEJERO ?></td>  
                <td>
                    <?php echo ($informe->FECHA_CONSEJERIA); ?>
                </td>
                <td>
                    <?php echo ($informe->HORA_INICIO); ?>
                </td>

                <td class="hidden-xs hidden-sm"><?php echo ($informe->NUM_CONDONES ) ?></td> 
                <td class="hidden-xs hidden-sm"><?php echo ($informe->NUM_LUBRICANTES ) ?></td> 
                <td class="hidden-xs hidden-sm"><?php echo ($informe->NUM_PASTILLEROS ) ?></td> 

                <td>
                    <?php echo ($informe->NUM_CONSEJERIA); ?>
                </td>
                <td>
                    <?php echo ($informe->VERIFICADO_PEMAR); ?>
                </td>
                <td>
                    <?php if($informe->NUEVO  == 'SI' )  echo  'NUEVO'; ?>
                    <?php if($informe->RECURRENTE == 'SI'  ) echo  'RECURRENTE'; ?>
                </td>
            </tr>   
            <?php endforeach; ?>             
        </tbody>
        
        <?php } ?>
    </table>
