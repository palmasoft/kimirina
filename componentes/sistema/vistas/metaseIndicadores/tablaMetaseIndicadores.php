<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="icon-flag themed-color"></i> Metas e Indicadores<br>
        <small>Listado Metas e Indicadores del Proyecto.</small>
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
            <a href="#">Configuración</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Metas e Indicadores</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Dynamic Tables Section -->
    <div class="block-section">


        <table id="tblaMetasIndicadores" class="table table-bordered table-hover dataTables" >
            <thead>
                <tr>
                    <th>#</th>
                    <th style="width: 40%" >Nombre del Indicador</th>
                    <th>Meta Indicador</th>
                    <?php
                    foreach ($PeriodosIndicadores as $periodo) {
                        echo '<th class=" ">' . $periodo->TITULO_PERIODO_INDICADOR . ' </th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($indicadores)) {
                    foreach ($indicadores as $indicador) :
                        ?>  
                        <tr fila-id="<?php echo ($indicador->ID_INDICADOR) ?>"  data-nombre="<?php echo ($indicador->NOMBRE_INDICADOR) ?>">   
                            <td><?php echo intval($indicador->ID_INDICADOR) ?></td>
                            <td style="font-size: 110%;"  ><?php echo ($indicador->NOMBRE_INDICADOR) ?></td>
                            <td><h5><?php echo ($indicador->META_INDICADOR) ?></h5></td>

                            <?php foreach ($indicador->METAS_PERIODOS as $valorPeriodo): ?>
                            <td><h4><?php echo ($valorPeriodo->VALOR_META_INDICADOR) ?></h4></td>
                            <?php endforeach; ?>

                        </tr>
                        <?php
                    endforeach;
                }
                ?>
            </tbody>
        </table>



    </div>
    <!-- END Dynamic Tables Section -->



</div>



<script>
    $(document).ready(function() {

    });
</script>
<script>
    agregar_boton_ayuda('METASPROYECTO');
</script>