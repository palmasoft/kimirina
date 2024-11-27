
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-stats themed-color"></i> Metas Subreceptores<br>
        <small>Metas del Subreceptor <strong><?php echo $Subreceptor->NOMBRE_SUBRECEPTOR . ' - ' . $Subreceptor->SIGLAS_SUBRECEPTOR ?></strong></small>
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
            <a href="javascript:abrir_lista_metas_subreceptores();">Listado Metas</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Recibo Subreceptor</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <form id="form-esquema-arv" class="form-horizontal" onsubmit="return false;" >
        <input type="hidden" id="subreceptor-id" name="subreceptor-id" value="<?php echo isset($Subreceptor) ? ($Subreceptor->ID_SUBRECEPTOR) : ''; ?>" />
        <?php //print_r($MetasSubreceptor); ?>
        <table id="formularios-datatables" class="table table-bordered table-hover dataTables">
            <thead>
                <tr>
                    <td colspan="3"></td>                    
                    <?php
                    foreach ($PeriodosIndicadores as $periodo) {
                        echo '<th class=" ">' . $periodo->CODIGO_PERIODO_INDICADOR . ' </th>';
                    }
                    ?>                      
                    <td ></td>  
                </tr>
                <tr>
                    <th class=" text-center">#</th>
                    <th class=" text-center">Indicador</th>
                    <th class="span1"><i class="glyphicons-road"></i> Meta Proyecto </th>                    
                    <?php
                    foreach ($PeriodosIndicadores as $periodo) {
                        echo '<th class=" " >' . $periodo->TITULO_PERIODO_INDICADOR . ' </th>';
                    }
                    ?>
                    <th class=" text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($marcoDesempeno as $indicador) {
                    ?>
                    <tr>
                        <td class="text-center "><?php echo ($indicador->ID_INDICADOR) ?></td>
                        <td class="text-center "><?php echo ($indicador->NOMBRE_INDICADOR) ?></td>
                        <td class=""><h4><?php echo ($indicador->META_INDICADOR); ?></h4></td>
                        <?php
                        $total = 0;
                        foreach ($indicador->VALORES_SEMESTRALES as $periodo) {
                            //print_r( $periodo );
                            $base = 0;
                            if (isset($periodo->META_SUBRECEPTOR)) {
                                $base = $periodo->META_SUBRECEPTOR;
                                $total += $periodo->META_SUBRECEPTOR;
                            }

                            echo '<td style="padding:0px;" >'
                            . '<input type="number" min="0" data-ind="' . ($indicador->ID_INDICADOR) . '" '
                                    . 'class="valor_indicador indicador_' . ($indicador->ID_INDICADOR) . '" '
                                    . 'name="valor_meta_subreceptor[' . ($indicador->ID_INDICADOR) . '][' . ($periodo->ID_PERIODO_INDICADOR) . ']"  '
                                    . 'value="' . $base . '" style="width:70px"   />'
                            . '</td>';
                        }
                        ?>                        
                        <td class="text-center "><h3 id="total_<?php echo ($indicador->ID_INDICADOR) ?>" ><?php echo ($total) ?></h3></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>



        <div id="respuesta" ></div>







        <!-- Form Buttons -->
        <div class="form-actions">
            <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
            <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Guardar</button>
        </div>
        <!-- END Form Buttons -->
    </form>  

</div>



<script>
    $(document).ready(function() {
        //informacion('lo que sea');
        $('#form-esquema-arv').submit(function() {
            var datosForm = $(this).serialize();
            if (estaVacio($('#registro-id').val())) {
                ejecutarAccionJson('gestion', 'metasSubreceptores', 'guardar_metas_subreceptor',
                        datosForm, '  mostrar_resultado_guardar( data, "abrir_listado_indicadores_proyecto_subreceptor();", "" );'
                        );
            } else {
                ejecutarAccionJson(
                        'gestion', 'metasSubreceptores', 'update_meta_subreceptor',
                        datosForm, 'mostrar_resultado_guardar( data, "abrir_lista_metas_subreceptores();", "" );'
                        );
            }

        });


        $('.valor_indicador').on('change', function(e) {
            var indica = $(this).attr('data-ind');
            var ttl = 0;
            $(".indicador_"+indica).each(function(index) {
                ttl += parseInt( $(this).val() );
            });
            $("#total_"+indica).html( ttl );
        });



    });
</script>

