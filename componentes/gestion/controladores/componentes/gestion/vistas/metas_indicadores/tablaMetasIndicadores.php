
<!-- Dynamic Tables Section -->
<div class="block block-section">
    <table id="formularios-datatables" class="table table-bordered table-hover dataTables">
        <thead>
            <tr>
                <td colspan="3"></td>                    
                <?php
                foreach ($PeriodosIndicadores as $periodo) {
                    echo '<th class=" ">' . $periodo->CODIGO_PERIODO_INDICADOR . ' </th>';
                }
                ?>                    
            </tr>
            <tr>
                <th class=" text-center">#</th>
                <th class=" text-center">Indicador</th>
                <th class="span1"><i class="glyphicons-road"></i> Meta Proyecto </th>                    
                <?php
                foreach ($PeriodosIndicadores as $periodo) {
                    echo '<th class=" ">' . $periodo->TITULO_PERIODO_INDICADOR . ' </th>';
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($marcoDesempeno as $indicador) {
                ?>
                <tr>
                    <td class="text-center "><?php echo ($indicador->ID_INDICADOR) ?></td>
                    <td class="text-center "><h5><?php echo ($indicador->NOMBRE_INDICADOR) ?></h5></td>
                    <td class=""><strong><?php echo ($indicador->META_INDICADOR); ?></strong></td>
                    <?php
                    foreach ($indicador->VALORES_SEMESTRALES as $periodo) {
                        //print_r( $periodo );

                        $valor = 0;
                        if (isset($periodo->VALOR_SEMESTRE)) {
                            $valor = $periodo->VALOR_SEMESTRE;
                        }


                        $base = 1;
                        if (isset($periodo->META_SUBRECEPTOR)) {
                            $base = $periodo->META_SUBRECEPTOR;
                        }

                        $porc = 0;
                        if ($base != 0) {
                            $porc = (isset($periodo->META_SUBRECEPTOR) ? \number_format($valor / $base, 2) : 0 ) * 100;
                        }

                        if ($porc > 100) {
                            $semaforo = "indicador_superverde";
                        }
                        if ($porc <= 100) {
                            $semaforo = "indicador_verde";
                        }
                        if ($porc < 89) {
                            $semaforo = "indicador_amarillo";
                        }
                        if ($porc < 59) {
                            $semaforo = "indicador_naranja";
                        }
                        if ($porc < 30) {
                            $semaforo = "indicador_rojo";
                        }


                        echo '<td style="padding:0px;" >'
                        . '<table style="width:100%;" >'
                        . '<tr style="width:100%;" class="' . $semaforo . '"  ><td style="width:50%;  font-size: 130%; " >' . (isset($periodo->VALOR_SEMESTRE) ? $periodo->VALOR_SEMESTRE : 0) . '</td>'
                        . '<td rowspan="2" style="width:50% ; font-size: 115%; " >' . $porc . '%</td></tr>'
                        . '<tr style="width:100%"  ><td style="width:50%  font-size: 125%; "  >' . (isset($periodo->META_SUBRECEPTOR) ? $periodo->META_SUBRECEPTOR : 0) . '</td></tr>'
                        . '</table>'
                        . '</td>';
                    }
                    ?>

                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
