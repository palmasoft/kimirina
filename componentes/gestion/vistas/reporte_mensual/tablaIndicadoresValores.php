<?php // print_r ($marcoDesempeno )  ?>                
<table class="table table-condensed table-borderless  table-hover dataTable " >
    <thead>
        <tr>
            <td colspan="3" ><h4>PERIODO/MES: <?php echo ($Periodo->CODIGO_PERIODO ) ?></h4></td>
            <th colspan="2">Actual</th>
            <th colspan="2">Reportado</th>
        </tr>
        <tr>
            <th></th>
            <th>Indicador</th>
            <th>META SEM</th>
            <th>ACUM</th>
            <th>VALOR</th>
            <th>ACUM</th>
            <th>VALOR</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($marcoDesempeno as $indicador) { ?>
            <tr>
                <td><?php echo ($indicador->ID_INDICADOR) ?></td>
                <td><h5><?php echo ($indicador->NOMBRE_INDICADOR) ?></h5></td>
                <td><h4><?php echo $indicador->META_INDICADOR ?></h4></td>
                <td><?php echo $indicador->ACUM_INDICADOR ?></td>
                <th style="font-size: 125%;text-align: center;" ><h4><?php echo $indicador->VALOR_INDICADOR ?></h4></th>
                <td><h4><?php echo $indicador->ACUM_REPORTADO ?></h4></td>
                <th style="font-size: 110%;text-align: center;"><?php echo $indicador->VALOR_REPORTADO ?></th>
            </tr>
        <?php } ?>                    
    </tbody>
</table>
