<table id="tabla-consolidado-animadores" class="table table-bordered table-hover dataTables">
    <thead>
        <tr>
            <th colspan="2"></th>
            <th colspan="2">TS</th>
            <th colspan="2">HSH</th>
            <th colspan="2">TRANS</th>
            <th colspan="2">TOTAL</th>
            <th></th>
        </tr>
        <tr>
            <th class=" text-center " style="width: 10px;">#</th>
            <th>Nombre(s) y Apellido(s)</th>
            <th class=" text-center ">N</th>
            <th class=" text-center ">R</th>
            <th class=" text-center ">N</th>
            <th class=" text-center ">R</th>
            <th class=" text-center ">N</th>
            <th class=" text-center ">R</th>
            <th class=" text-center ">N</th>
            <th class=" text-center ">R</th>
            <th>No. Pares Contactos Referidos Efectivos </th>
        </tr>
    </thead>
    <tbody> 

        <?php
        $countRow = 0;
        if (isset($Informes)) {
            foreach ($Informes->filas as $informe) :
                ?>    
                <tr>
                    <td>
        <?php echo $countRow += 1 ?>
                    </td>
                    <td>
        <?php echo ($informe->NOMBRE_ANIMADOR); ?>
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
                    <td style="font-weight:bolder">
        <?php echo ($informe->TOTAL_EFECTIVOS); ?>
                    </td>
                </tr>   
    <?php endforeach; ?>             
        </tbody>
        <tfoot>

            <tr>
                <td class=" text-center " style="width: 10px;"></td>
                <td class=" text-center" style="font-weight: bolder">SUBTOTAL</td>
                <th class=" text-center "><?php echo $Informes->totalNuevosTS ?></th>
                <th class=" text-center "><?php echo $Informes->totalRecuTS ?></th>
                <th class=" text-center "><?php echo $Informes->totalNuevosHSH ?></th>
                <th class=" text-center "><?php echo $Informes->totalRecuHSH ?></th>
                <th class=" text-center "><?php echo $Informes->totalNuevosTRANS ?></th>
                <th class=" text-center "><?php echo $Informes->totalRecuTRANS ?></th>
                <th class=" text-center"><?php echo $Informes->totalNuevosTS + $Informes->totalNuevosHSH + $Informes->totalNuevosTRANS ?></th>
                <th class=" text-center"><?php echo $Informes->totalRecuTS + $Informes->totalRecuHSH + $Informes->totalRecuTRANS ?></th>
                <th rowspan="2"  style=" font-weight: bolder; font-size: 150%; text-align: center;"><?php echo $Informes->totalEFECTIVOS ?></th>
            </tr>            
            <tr>
                <td class=" text-center " style="width: 10px;"></td>
                <td class=" text-center" style="font-weight: bolder"><b>TOTAL</b></td>
                <th colspan="2" class=" text-center "><?php echo $Informes->totalNuevosTS + $Informes->totalRecuTS ?></th>
                <th colspan="2" class=" text-center "><?php echo $Informes->totalNuevosHSH + $Informes->totalRecuHSH ?></th>
                <th colspan="2"  class=" text-center "><?php echo $Informes->totalNuevosTRANS + $Informes->totalRecuTRANS ?></th>
                <th colspan="2" class=" text-center "><?php echo $Informes->totalNuevosTS + $Informes->totalNuevosHSH + $Informes->totalNuevosTRANS + $Informes->totalRecuTS + $Informes->totalRecuHSH + $Informes->totalRecuTRANS ?></th>
            </tr>
        </tfoot>
<?php } ?>
</table>
