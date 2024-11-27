<table id="tabla-consolidado-mensual" class="table table-bordered table-hover dataTables">
        <thead>
            <tr>
                <th colspan="2"></th>
                <th colspan="2">TS</th>
                <th colspan="2">HSH</th>
                <th colspan="2">TRANS</th>
                <th colspan="2">TOTAL</th>
            </tr>
            <tr>
                <th class="span1 text-center hidden-phone" style="width: 10px;">#</th>
                <th >Nombre(s) y Apellido(s)</th>
                <th class="span1 text-center hidden-phone">N</th>
                <th class="span1 text-center hidden-phone">R</th>
                <th class="span1 text-center hidden-phone">N</th>
                <th class="span1 text-center hidden-phone">R</th>
                <th class="span1 text-center hidden-phone">N</th>
                <th class="span1 text-center hidden-phone">R</th>
                <th class="span1 text-center hidden-phone">N</th>
                <th class="span1 text-center hidden-phone">R</th>
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
                    <?php echo ($informe->NOMBRE_PROMOTOR); ?>
                </td>
                <td>
                    <?php echo ($informe->NUEVOS_TS); ?>
                </td>
                <td>
                    <?php echo ($informe->RECURRENTES_TS); ?>
                </td>
                <td>
                    <?php echo ($informe->NUEVOS_HSH); ?>
                </td>
                <td>
                    <?php echo ($informe->RECURRENTES_HSH); ?>
                </td>
                <td>
                    <?php echo ($informe->NUEVOS_TRANS); ?>
                </td>
                <td>
                    <?php echo ($informe->RECURRENTES_TRANS); ?>
                </td>
                <td style="font-weight:bolder">
                    <?php echo ($informe->TOTAL_NUEVOS); ?>
                </td>
                <td style="font-weight:bolder">
                    <?php echo ($informe->TOTAL_RECURRENTES); ?>
                </td>
                </tr>   
            <?php endforeach; ?>             
        </tbody>
        <tfoot>
             <tr>
                <td class="span1 text-center hidden-phone" style="width: 10px;"></td>
                <td class="span1 text-center" style="font-weight: bolder">SUBTOTAL</td>
                <th class="span1 text-center hidden-phone"><?php echo $Informe->totalNuevosTS ?></th>
                <th class="span1 text-center hidden-phone"><?php echo $Informe->totalRecuTS ?></th>
                <th class="span1 text-center hidden-phone"><?php echo $Informe->totalNuevosHSH ?></th>
                <th class="span1 text-center hidden-phone"><?php echo $Informe->totalRecuHSH ?></th>
                <th class="span1 text-center hidden-phone"><?php echo $Informe->totalNuevosTRANS ?></th>
                <th class="span1 text-center hidden-phone"><?php echo $Informe->totalRecuTRANS ?></th>
                <th class="span1 text-center"><?php echo $Informe->totalNuevosTS + $Informe->totalNuevosHSH + $Informe->totalNuevosTRANS ?></th>
                <th class="span1 text-center"><?php echo $Informe->totalRecuTS + $Informe->totalRecuHSH + $Informe->totalRecuTRANS ?></th>
            </tr>            
             <tr>
                <td class="span1 text-center hidden-phone" style="width: 10px; text-align: center"></td>
                <td class="span1 text-center" style="font-weight: bolder"><b>TOTAL</b></td>
                <th colspan="2" class="span1 text-center hidden-phone"><?php echo $Informe->totalNuevosTS + $Informe->totalRecuTS ?></th>
                <th colspan="2" class="span1 text-center hidden-phone"><?php echo $Informe->totalNuevosHSH  + $Informe->totalRecuHSH ?></th>
                <th colspan="2"  class="span1 text-center hidden-phone"><?php echo $Informe->totalNuevosTRANS + $Informe->totalRecuTRANS ?></th>
                <th colspan="2" class="span1 text-center hidden-phone"><?php echo $Informe->totalNuevosTS + $Informe->totalNuevosHSH + $Informe->totalNuevosTRANS 
                                                                            + $Informe->totalRecuTS + $Informe->totalRecuHSH + $Informe->totalRecuTRANS ?></th>
            </tr>
        </tfoot>
        <?php } ?>
    </table>
