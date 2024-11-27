
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-stats themed-color"></i> Marco de Desempeño<br>
        <small>Listado de Indicadores de Desempeño del Proyecto, sus metas generales y sus valores reportados.</small>
    </h1>
</div>
<!-- END Pre Page Content -->


<!-- Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Gestores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Marco de Desempeño</a></li>
    </ul>
    <!-- END Breadcrumb -->

    
        <?php $this->mostrar("metas_indicadores/tablaMetasIndicadores", $this->datos); ?>  

    
<!--  
     Dynamic Tables Section 
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
                        <td class="text-center "><?php echo ($indicador->NOMBRE_INDICADOR) ?></td>
                        <td class=""><h4><strong><?php echo ($indicador->META_INDICADOR); ?></strong></h4></td>
                        <?php
                        foreach ($indicador->VALORES_SEMESTRALES as $periodo) {
                            //print_r( $periodo );
                            
                            $valor = (isset($periodo->VALOR_SEMESTRE) ? $periodo->VALOR_SEMESTRE : 0);                            
                            $base = (isset($periodo->META_SEMESTRE) ? $periodo->META_SEMESTRE : 0 );
                            $porc = 0;
                            if( $base != 0 ){
                                $porc = number_format(100 * $valor / $base, 0) ;
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
                            . '<table style="width:100%;" >'
                            . '<tr style="width:100%;" class="' . $semaforo . '"  ><td style="width:50%;  font-size: 150%; " >' . (isset($periodo->VALOR_SEMESTRE) ? $periodo->VALOR_SEMESTRE : 0) . '</td>'
                            . '<td rowspan="2" style="width:50% ; font-size: 125%; " >' . $porc . '%</td></tr>'
                            . '<tr style="width:100%"  ><td style="width:50%  font-size: 125%; "  ><h5>' . (isset($periodo->META_SEMESTRE) ? $periodo->META_SEMESTRE : 0) . '</h5></td></tr>'
                            . '</table>'
                            . '</td>';
                        }
                        ?>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>-->


</div>



<script>
    $(document).ready(function() {


        $('#form_cosultar_indicadores_subreceptor').submit(function(e) {
            cambiar_listado_indicadores_proyecto_subreceptor($(this).serialize());
        });


    });
</script>


<script>
    agregar_boton_ayuda('MARCODESEMPENO');
</script>