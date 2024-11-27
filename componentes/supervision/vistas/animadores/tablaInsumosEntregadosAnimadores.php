<form id="form-datos-contacto-alcanzados" onsubmit="return false;" >
    <table id="tabla-contactos-registrados-semana" class="table table-bordered table-hover dataTables">
        <thead>
            <tr>
                <th class=" text-center ">Tipo de Poblacion Vulnerable</th>
                <th class=" text-center ">Cant de Impresos Entregados</th>
                <th class=" text-center ">Cant de Condones Entregados</th>
                <th class=" text-center ">Cant de Lubricantes Entregados</th>                
            </tr>
        </thead>
        <tbody> 
            <?php
            if (isset($Informe)) {
                foreach ($tiposPobSubreceptor as $key => $value) {
                    ?>    
                    <?php if ($value->CODIGO_TIPOPOBLACION == "TS") { ?>
                        <tr>
                            <td>TS</td>
                            <td><?php echo $Informe->TS_IMPRESOS ?></td>
                            <td><?php echo $Informe->TS_CONDONES ?></td>
                            <td><?php echo $Informe->TS_LUBRICANTES ?></td>
                        </tr>
                        <?php
                    }
                    if ($value->CODIGO_TIPOPOBLACION == "TRANS") {
                        ?>
                        <tr>
                            <td>TRANS</td>
                            <td><?php echo $Informe->TRANS_IMPRESOS ?></td>
                            <td><?php echo $Informe->TRANS_CONDONES ?></td>
                            <td><?php echo $Informe->TRANS_LUBRICANTES ?></td>
                        </tr> 
                        <?php
                    }
                    if ($value->CODIGO_TIPOPOBLACION == "HSH") {
                        ?>
                        <tr>
                            <td>HSH</td>
                            <td><?php echo $Informe->HSH_IMPRESOS ?></td>
                            <td><?php echo $Informe->HSH_CONDONES ?></td>
                            <td><?php echo $Informe->HSH_LUBRICANTES ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td style="font-weight: bolder; text-align: center">
                        TOTAL
                    </td>
                    <td style="text-align: center">
                        <?php echo $Informe->totalFolleteria ?>
                    </td>
                    <td style="text-align: center">
                        <?php echo $Informe->totalCondones ?>
                    </td>
                    <td style="text-align: center">
                        <?php echo $Informe->totalLubricantes ?>
                    </td>
                </tr>
            </tfoot>
        <?php } ?>
    </table>
</form>
