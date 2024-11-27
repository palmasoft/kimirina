
<!-- Dynamic Tables Section -->
<div class="block block-section">
    <table id="formularios-datatables" class="table table-bordered table-hover dataTables">
        <thead>
            <tr>
                <th class=" text-center">#</th>
                <th class=" text-center"  style="width: 40%;" >Indicador</th>
                <th class=" " style="width: 10%;" ><i class="glyphicon-circle_ok"></i> Meta Proyecto </th>                    
                <?php
                foreach ($PeriodosIndicadores as $periodo) {
                    echo '<th  >' . $periodo->CODIGO_PERIODO_INDICADOR . '<br/> ' . $periodo->TITULO_PERIODO_INDICADOR . ' </th>';
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
                    <td class="text-center "><h5 style="margin:0px;"><?php echo ($indicador->NOMBRE_INDICADOR) ?></h5></td>
                    <td class=""><strong><?php echo ($indicador->META_INDICADOR); ?></strong></td>
                    <?php
                    foreach ($indicador->VALORES_SEMESTRALES as $periodo) {
                        //print_r( $periodo );

                         
                            $valor = (isset($periodo->VALOR_SEMESTRE) ? $periodo->VALOR_SEMESTRE : 0);                            
                            $base = (isset($periodo->META_SUBRECEPTOR) ? $periodo->META_SUBRECEPTOR : 0 );
                            $porc = 0;
                            if( $base != 0 ){
                                $porc = number_format(100 * $valor / $base, 2) ;
                            }  else {
                                $porc = $valor;
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
                        . '<table style="width:100%;margin: 0px;" >'
                        . '<tr style="width:100%;" class="' . $semaforo . '"  ><td style="width:50%;  font-size: 130%; " >' . (isset($periodo->VALOR_SEMESTRE) ? $periodo->VALOR_SEMESTRE : 0) . '</td>'
                        . '<td rowspan="2" style="width:50% ; font-size: 100%; " >' . $porc . '%</td></tr>'
                        . '<tr style="width:100%"  ><td style="width:50%;  font-size: 105%; font-weight: bold; "  >' . (isset($periodo->META_SUBRECEPTOR) ? $periodo->META_SUBRECEPTOR : 0) . '</td></tr>'
                        . '</table>'
                        . '</td>';
                    }
                    ?>

                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>