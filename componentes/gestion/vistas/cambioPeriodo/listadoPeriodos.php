<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-history themed-color"></i> Re-Activar Periodo<br>
        <small>Desde esta funcionalidad usted podrá habilitar en el sistema el periodo deseado</small>
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
  <li ><a href="#">Receptor</a><span class="divider"><i class="icon-angle-right"></i></span>
  </li>
        <li class="active"><a href="#">Re-Activar Periodo</a></li>
    </ul>
    <!-- END Breadcrumb -->
    <div class="botones_arriba" align="center" >
        <div class=" span1 btn-group">
        </div>
        <span class="span3 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </span>
        <div class="btn-group">			
                <!--<button type="submit" id="btn_habilitar_periodo" class="btn btn-success"><i class="icon-save"></i> Habilitar</button>-->
            <a href="javascript:$('#frmPeriodos').submit();" data-toggle="tooltip" title="Habilitar periodo" class="btn btn-success"><i class="icon-reorder"></i> Cambiar Periodo Activo </a>						
        </div>
    </div>

    <form id="frmPeriodos" method="post" action="" enctype="multipart/form-data" onsubmit="return false;" >

<!--            <button type="submit" id="btn_habilitar_periodo" class="btn btn-success"><i class="icon-save"></i> Habilitar</button>-->
        <table id="periodos-datatables" class="table table-bordered table-hover "  style="font-size: 70%"  >
            <thead>
                <tr>
                    <th class=" text-center">#</th>
                    <th class="text-center">para Indicadores</th>
                    <th class=" text-center">Periodo / Mes</th>
                    <th class=" text-center">desde</th>
                    <th class=" text-center">hasta</th>
                    <th class=" text-center">ESTADO</th>
            </thead>
            <tbody>
                <?php
                if (!empty($Periodos)) {
                    foreach ($Periodos as $Periodo) {
                        ?>

                        <?php if ($Periodo->ACTUAL == "SI") { ?>
                            <tr fila-id="<?php echo $Periodo->ID_PERIODO ?>" data-num-periodo="<?php echo $Periodo->CODIGO_PERIODO ?>" style="background-color: burlywood" >
                            <?php } else { ?>
                            <tr fila-id="<?php echo $Periodo->ID_PERIODO ?>" data-num-periodo="<?php echo $Periodo->CODIGO_PERIODO ?>" >
                            <?php } ?>
                            <td class=" text-center"><?php echo intval($Periodo->ID_PERIODO) ?></td>
                            <td class=" text-center" title="<?php echo $Periodo->TITULO_PERIODO_INDICADOR ?>" ><?php echo $Periodo->CODIGO_PERIODO_INDICADOR ?>-<?php echo $Periodo->TITULO_PERIODO_INDICADOR ?></td>
                            <td class=" text-center"><h5><?php echo $Periodo->CODIGO_PERIODO ?></h5></td>
                            <td class=" text-center"><?php echo $Periodo->FECHA_MIN_PERIODO ?></td>
                            <td class=" text-center"><?php echo $Periodo->FECHA_MAX_PERIODO ?></td>
                            <?php if ($Periodo->ACTUAL == 'SI') { ?>
                                <td class=" text-center"><span style="font-size: 150%; font-weight: bold;">ACTIVO</span></td>
                            <?php } else { ?>
                                <td class=" text-center">
                                    <input type="radio" class="check-periodos input-themed" id="periodo-a-activar-<?php echo $Periodo->CODIGO_PERIODO ?>" name="periodo-a-activar" title="click para seleccionar este periodo para activar"  value="<?php echo $Periodo->ID_PERIODO ?>">
                                </td>
                            <?php } ?>                    
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>

        </table>
        <input type="hidden" id="periodo-activo" value="<?php echo $Periodo->ID_PERIODO ?>">
    <!--<input type="submit" name="enviar" id="enviar" value="Habilitar"  />-->
    </form>
</div>



<script>
    $(document).ready(function() {


        $('#periodos-datatables tbody tr').on('click', function(e) {
            var codPer = $(this).attr("data-num-periodo");
            $('#registro-seleccionado').html(codPer);
           $("#periodo-a-activar-" + codPer).click();
        });
        
        $('#periodos-datatables tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            $('#registro-seleccionado').html($(this).attr('data-num-periodo'));
            var datos = $('#frmPeriodos').serialize();
            habilitar_periodo_seleccionado(datos);
        });

        $('.check-periodos').on('click', function(event) {
            $(this).iCheck('check');
        });

        $('#frmPeriodos').submit(function(e) {
            var datos = $(this).serialize();
            habilitar_periodo_seleccionado(datos);
        });

    });

    function habilitar_periodo_seleccionado(datos) {
        if ($('input:radio:checked').length > 0) {
            ejecutarAccionJson(
                    'gestion', 'gestionarPeriodos', 'habilitar_periodos', datos,
                    '  mostrar_resultado_guardar( data, "mostrar_lista_periodos();") '
                    );
        } else {
            alert('Debe seleccionar un periodo para activar');
        }

    }
</script>

<script>
    agregar_boton_ayuda('REACTIVARPERIODO');
</script>