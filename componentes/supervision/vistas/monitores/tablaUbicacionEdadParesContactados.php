<?php // if(isset($informes)) print_r($informes); ?>
<form id="form-datos-contacto-alcanzados" onsubmit="return false;" >
    <table id="tabla-ubicaciones-edad-pares-contactados" class="table table-bordered table-hover dataTables">
        <thead>
            <tr>
                <th colspan="2"></th>
                <th colspan="8">Grupo Etareo</th>
            </tr>

            <tr>
                <th>Provincia</th>
                <th>Canton</th>
                <th>PMR</th>
                <th>10-14</th>
                <th>15-19</th>
                <th>20-24</th>
                <th>25-49</th>
                <th>50-59</th>
                <th> >60</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody> 
            <?php
            if (isset($informes)) {
                foreach ($informes as $informe) :
                    //print_r($informe);
                    ?>  
                    <?php
                    $nFilas = 0;
                    if ($informe->TS_TOTAL > 0 || $informe->HSH_TOTAL > 0 || $informe->TRANS_TOTAL > 0) {

                        $mostrarHSH = FALSE;
                        if ($informe->HSH_TOTAL > 0) {
                            $mostrarHSH = true;
                        }
                        $mostrarTRANS = FALSE;
                        if ($informe->TRANS_TOTAL > 0) {
                            $mostrarTRANS = true;
                        }
                        $mostrarTS = FALSE;
                        if ($informe->TS_TOTAL > 0) {
                            $mostrarTS = true;
                        }
                        ?>
                        <tr>
                            <td >
                                <?php echo ($informe->PROVINCIA) ?>
                            </td>
                            <td >
                                <?php echo ($informe->CANTON) ?>
                            </td>

                            <td>
                                <table>
                                    <?php if ($mostrarHSH) { ?>
                                        <tr>
                                            <td>
                                                HSH
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($mostrarTRANS) { ?>
                                        <tr>
                                            <td>
                                                TRANS
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($mostrarTS) { ?>
                                        <tr>
                                            <td>
                                                TS
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </td>
                            <td>
                                <table>
                                    <?php if ($mostrarHSH) { ?>
                                        <tr>
                                            <td>
                                                <?php echo ($informe->HSH_1014) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($mostrarTRANS) { ?>
                                        <tr>
                                            <td>
                                                <?php echo ($informe->TRANS_1014) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($mostrarTS) { ?>
                                        <tr>
                                            <td>
                                                <?php echo ($informe->TS_1014) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </td>
                            <td>
                                <table>
                                    <?php if ($mostrarHSH) { ?>
                                        <tr>
                                            <td>
                                                <?php echo ($informe->HSH_1519) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($mostrarTRANS) { ?>
                                        <tr>
                                            <td>
                                                <?php echo ($informe->TRANS_1519) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($mostrarTS) { ?>
                                        <tr>
                                            <td>
                                                <?php echo ($informe->TS_1519) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </td>
                            <td>

                                <table>
                                    <?php if ($mostrarHSH) { ?>
                                        <tr>
                                            <td>
                                                <?php echo ($informe->HSH_2024) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($mostrarTRANS) { ?>
                                        <tr>
                                            <td>
                                                <?php echo ($informe->TRANS_2024) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($mostrarTS) { ?>
                                        <tr>
                                            <td>
                                                <?php echo ($informe->TS_2024) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>

                            </td>
                            <td>

                                <table>
                                    <?php if ($mostrarHSH) { ?>
                                        <tr>

                                            <td>
                                                <?php echo ($informe->HSH_2549) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($mostrarTRANS) { ?>
                                        <tr>

                                            <td>
                                                <?php echo ($informe->TRANS_2549) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($mostrarTS) { ?>
                                        <tr>
                                            <td>
                                                <?php echo ($informe->TS_2549) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </td>
                            <td>

                                <table>
                                    <?php if ($mostrarHSH) { ?>
                                        <tr>

                                            <td>
                                                <?php echo ($informe->HSH_5059) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($mostrarTRANS) { ?>
                                        <tr>
                                            <td>
                                                <?php echo ($informe->TRANS_5059) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($mostrarTS) { ?>
                                        <tr>
                                            <td>
                                                <?php echo ($informe->TS_5059) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>

                            </td>
                            <td>

                                <table>
                                    <?php if ($mostrarHSH) { ?>
                                        <tr>
                                            <td>
                                                <?php echo ($informe->HSH_60) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($mostrarTRANS) { ?>
                                        <tr>
                                            <td>
                                                <?php echo ($informe->TRANS_60) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($mostrarTS) { ?>
                                        <tr>

                                            <td>
                                                <?php echo ($informe->TS_60) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </td>
                            <td>
                                <table>
                                    <?php if ($mostrarHSH) { ?>
                                        <tr>
                                            <td>
                                                <?php echo ($informe->HSH_TOTAL) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($mostrarTRANS) { ?>
                                        <tr>
                                            <td>
                                                <?php echo ($informe->TRANS_TOTAL) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($mostrarTS) { ?>
                                        <tr>
                                            <td>
                                                <?php echo ($informe->TS_TOTAL) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </td>
                        </tr>                            
                        <?php
                    }
                    ?>

                <?php endforeach;
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td rowspan="3" colspan="2" style="text-align: center; font-weight: bolder">TOTAL</td>
                    <td style="text-align: center; font-weight: bolder">HSH</td>
                    <td style="text-align: center; font-weight: bolder"><?php echo $informe_total[0]->HSH_TOTAL_1014 ?></td>
                    <td style="text-align: center; font-weight: bolder"><?php echo $informe_total[0]->HSH_TOTAL_1519 ?></td>
                    <td style="text-align: center; font-weight: bolder"><?php echo $informe_total[0]->HSH_TOTAL_2024 ?></td>
                    <td style="text-align: center; font-weight: bolder"><?php echo $informe_total[0]->HSH_TOTAL_2549 ?></td>
                    <td style="text-align: center; font-weight: bolder"><?php echo $informe_total[0]->HSH_TOTAL_5059 ?></td>
                    <td style="text-align: center; font-weight: bolder"><?php echo $informe_total[0]->HSH_TOTAL_60 ?></td>
                    <td style="text-align: center; font-weight: bolder"><?php echo $informe_total[0]->GRAN_TOTAL_HSH ?></td>
                </tr>
                <tr>
                    <td style="text-align: center; font-weight: bolder">TRANS</td>
                    <td style="text-align: center; font-weight: bolder"><?php echo $informe_total[0]->TRANS_TOTAL_1014 ?></td>
                    <td style="text-align: center; font-weight: bolder"><?php echo $informe_total[0]->TRANS_TOTAL_1519 ?></td>
                    <td style="text-align: center; font-weight: bolder"><?php echo $informe_total[0]->TRANS_TOTAL_2024 ?></td>
                    <td style="text-align: center; font-weight: bolder"><?php echo $informe_total[0]->TRANS_TOTAL_2549 ?></td>
                    <td style="text-align: center; font-weight: bolder"><?php echo $informe_total[0]->TRANS_TOTAL_5059 ?></td>
                    <td style="text-align: center; font-weight: bolder"><?php echo $informe_total[0]->TRANS_TOTAL_60 ?></td>
                    <td style="text-align: center; font-weight: bolder"><?php echo $informe_total[0]->GRAN_TOTAL_TRANS ?></td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bolder">TS</td>
                    <td style="text-align: center; font-weight: bolder"><?php echo $informe_total[0]->TS_TOTAL_1014 ?></td>
                    <td style="text-align: center; font-weight: bolder"><?php echo $informe_total[0]->TS_TOTAL_1519 ?></td>
                    <td style="text-align: center; font-weight: bolder"><?php echo $informe_total[0]->TS_TOTAL_2024 ?></td>
                    <td style="text-align: center; font-weight: bolder"><?php echo $informe_total[0]->TS_TOTAL_2549 ?></td>
                    <td style="text-align: center; font-weight: bolder"><?php echo $informe_total[0]->TS_TOTAL_5059 ?></td>
                    <td style="text-align: center; font-weight: bolder"><?php echo $informe_total[0]->TS_TOTAL_60 ?></td>
                    <td style="text-align: center; font-weight: bolder"><?php
                        echo $informe_total[0]->GRAN_TOTAL_TS;
                    }
                    ?></td>
            </tr>
        </tfoot>
    </table>
</form>
