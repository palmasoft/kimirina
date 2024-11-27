<!--<form id="frmPeriodos" method="post" action="" enctype="multipart/form-data" onsubmit="return false;" >-->
            <table id="tblperiodos" class="table table-bordered table-hover dataTables"  style="font-size: 70%"  >
            <thead>
                <tr>
                    <th class=" text-center">NUMERO</th>
                    <th class=" text-center">PERIODO</th>
                    <th class=" text-center">ESTADO</th>
            </thead>
             <tbody>
                <?php 
                if(!empty($Periodos)){
                foreach ($Periodos as $Periodo) { 
                    if($Periodo->ACTUAL=="SI"){?>
                        <tr fila-id="<?php echo $Periodo->ID_PERIODO ?>" data-nombre="<?php echo $Periodo->CODIGO_PERIODO ?>" style="font-size: 90%; background-color: burlywood" >
                    <?php }else{ ?>
                        <tr fila-id="<?php echo $Periodo->ID_PERIODO ?>" data-nombre="<?php echo $Periodo->CODIGO_PERIODO ?>" style="font-size: 90%" >
                    <?php } ?>
                           <td class=" text-center"><?php echo $Periodo->ID_PERIODO ?></td>
                           <td class=" text-center"><?php echo $Periodo->ANO_PERIODO.'-'.$Periodo->MES_PERIODO ?></td>
                           <?php if($Periodo->ACTUAL=='SI'){?>
                           <td class=" text-center"><span style="font-size: 18px; margin: 5px;">ACTIVO</span></td>
                           <input type="hidden" id="periodo-activo" value="<?php echo $Periodo->ID_PERIODO ?>">
                           <?php }else{?>
                           <!--<td class=" text-center"><input type="checkbox" class="check-periodos" id="periodo-a-activar" name="periodo-a-activar[]" value="<?php //echo $Periodo->ID_PERIODO ?>"></td>-->
                           <td class=" text-center"><span style="font-size: 18px; margin: 5px;">----</span></td>
                           <?php }?>                    
                        </tr>
                    <?php } }?>
            </tbody>
            
        </table>
    <!--<input type="submit" name="enviar" id="enviar" value="Habilitar"  />-->
    <!--</form>-->