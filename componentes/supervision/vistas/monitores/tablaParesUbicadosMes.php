<form id="form-pares-ubicados" onsubmit="return false;" >
    <table id="tabla-contactos-registrados-semana" class="table table-bordered table-hover dataTables">
        <thead>
            <tr>
                <th></th>
                <th colspan="3">Total Mensual</th>
                <th colspan="2">No.Que Realiza Trabajo Sexual</th>
            </tr>
            <tr>
                <th>Pares</th>
                <th>N</th>
                <th>R</th>
                <th>Total</th>
                <th>SI</th>
                <th>NO</th>
            </tr>
        </thead>
        <tbody> 
            <?php if(isset($Informe)){
                foreach ($tiposPobSubreceptor as $key => $value) {
            ?>

            <?php if($value->CODIGO_TIPOPOBLACION=="HSH"){ ?>
            <tr>
                <td>
                    Nº de pares contactados HSH
                </td>
                <td>
                   <?php echo $Informe->NUEVOS_HSH ?>
                </td>
                <td>
                   <?php echo $Informe->RECURRENTES_HSH ?>
                </td>
                <td>
                   <?php echo $Informe->TOTAL_HSH ?>
                </td>
                <td>
                    <?php echo $Informe->CANTIDAD_HSH_TS ?>
                </td>
                <td>
                    <?php echo $Informe->CANTIDAD_HSH_NOTS ?>
                </td>
            </tr>            
            <tr>
                <td>
                    Nº de pares contactados HSH REFERIDOS
                </td>
                <td>
                   <?php echo $Informe->NUEVOS_HSH_REFERIDOS ?>
                </td>
                <td>
                   <?php echo $Informe->RECURRENTES_HSH_REFERIDOS ?>
                </td>
                <td>
                   <?php echo $Informe->TOTAL_HSH_REFERIDOS ?>
                </td>
                <td>
                    <?php echo $Informe->CANTIDAD_HSH_TS_REFERIDOS ?>
                </td>
                <td>
                    <?php echo $Informe->CANTIDAD_HSH_NOTS_REFERIDOS ?>
                </td>
            </tr>
            <?php }?>
            
            
            <?php if($value->CODIGO_TIPOPOBLACION=="TS"){ ?>
            <tr>
                <td>
                    Nº de pares contactados TS
                </td>
                <td>
                   <?php echo $Informe->NUEVOS_TS ?>
                </td>
                <td>
                   <?php echo $Informe->RECURRENTES_TS ?>
                </td>
                <td>
                   <?php echo $Informe->TOTAL_TS ?>
                </td>
                <td>
                    <?php echo $Informe->CANTIDAD_TS_TS  ?>
                </td>
                <td>
                    <?php echo $Informe->CANTIDAD_TS_NOTS  ?>
                </td>
            </tr>            
            <tr>
                <td>
                    Nº de pares contactados TS REFERIDOS
                </td>
                <td>
                   <?php echo $Informe->NUEVOS_TS_REFERIDOS ?>
                </td>
                <td>
                   <?php echo $Informe->RECURRENTES_TS_REFERIDOS ?>
                </td>
                <td>
                   <?php echo $Informe->TOTAL_TS_REFERIDOS ?>
                </td>
                <td>
                    <?php echo $Informe->CANTIDAD_TS_TS_REFERIDOS  ?>
                </td>
                <td>
                    <?php echo $Informe->CANTIDAD_TS_NOTS_REFERIDOS  ?>
                </td>
            </tr>
            <?php }?>
            
            
            <?php if($value->CODIGO_TIPOPOBLACION=="TRANS"){ ?>
            <tr>
                <td>
                    Nº de pares contactados TRANS
                </td>
                <td>
                   <?php echo $Informe->NUEVOS_TRANS ?>
                </td>
                <td>
                   <?php echo $Informe->RECURRENTES_TRANS ?>
                </td>
                <td>
                   <?php echo $Informe->TOTAL_TRANS ?>
                </td>
                <td>
                    <?php echo $Informe->CANTIDAD_TRANS_TS ?>
                </td>
                <td>
                    <?php echo $Informe->CANTIDAD_TRANS_NOTS ?>
                </td>
                
            </tr>            
            <tr>
                <td>
                    Nº de pares contactados TRANS REFERIDOS
                </td>
                <td>
                   <?php echo $Informe->NUEVOS_TRANS_REFERIDOS ?>
                </td>
                <td>
                   <?php echo $Informe->RECURRENTES_TRANS_REFERIDOS ?>
                </td>
                <td>
                   <?php echo $Informe->TOTAL_TRANS_REFERIDOS ?>
                </td>
                <td>
                    <?php echo $Informe->CANTIDAD_TRANS_TS_REFERIDOS ?>
                </td>
                <td>
                    <?php echo $Informe->CANTIDAD_TRANS_NOTS_REFERIDOS ?>
                </td>
                
            </tr>
            <?php }?>
            
                <?php }
                } 
                ?>   
        </tbody>
    </table>
</form>
