<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="icon-flag themed-color"></i> Metas e Indicadores<br>
        <small>Listado Metas e Indicadores.</small>
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
            <a href="#">Sistema</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">metas</a></li>
    </ul>
    <!-- END Breadcrumb -->
    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
        </div>
    </div>
    <!-- Dynamic Tables Section -->
    <div class="block-section">


        <table id="tblaMetasIndicadores" class="table table-bordered table-hover dataTables" >
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre del Indicador</th>
                    <th>Observaciones </th>
                    <th>Meta Indicador</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (!empty($indicadores)) {
                    foreach ($indicadores as $indicador) :
                        ?>  
                        <tr fila-id="<?php echo ($indicador->ID_INDICADOR) ?>"  data-nombre="<?php echo ($indicador->NOMBRE_INDICADOR) ?>">   
                            <td><?php echo intval($indicador->ID_INDICADOR) ?></td>
                            <td style=""><h4><?php echo ($indicador->NOMBRE_INDICADOR) ?></h4></td>
                            <td style=" font-size: 70%"><?php echo ($indicador->OBSERVACIONES_INDICADOR) ?></td>
                            <td>
                                <h4>
                                    <strong><?php echo ($indicador->META_INDICADOR) ?></strong>
                                </h4>
                            </td>
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
        $('#tblaMetasIndicadores tbody tr').on('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
        });
    });


</script>
