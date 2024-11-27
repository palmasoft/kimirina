<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon glyphicon-cloud-upload themed-color"></i> Gestion de Periodos<br>
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

        <li class="active"><a href="#">Gestion de Periodos</a></li>
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
        <table id="periodos-datatables" class="table table-bordered table-hover dataTables"  style="font-size: 70%"  >
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
                            <td class=" text-center"><?php echo $Periodo->ID_PERIODO ?></td>
                            <td class=" text-center" title="<?php echo $Periodo->TITULO_PERIODO_INDICADOR ?>" ><?php echo $Periodo->CODIGO_PERIODO_INDICADOR ?>-<?php echo $Periodo->TITULO_PERIODO_INDICADOR ?></td>
                            <td class=" text-center"><h5><?php echo $Periodo->CODIGO_PERIODO ?></h5></td>
                            <td class=" text-center"><?php echo $Periodo->FECHA_MIN_PERIODO ?></td>
                            <td class=" text-center"><?php echo $Periodo->FECHA_MAX_PERIODO ?></td>
                            <?php if ($Periodo->ACTUAL == 'SI') { ?>
                                <td class=" text-center"><span style="font-size: 18px; margin: 5px;">ACTIVO</span></td>
                            <?php } else { ?>
                                <td class=" text-center">
                                    <input type="checkbox" class="check-periodos" id="periodo-a-activar" name="periodo-a-activar[]"  value="<?php echo $Periodo->ID_PERIODO ?>">
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
    <div id="respúesta_validacion" ></div>

</div>



<script>
    $(document).ready(function() {

        $('#frmPeriodos').submit(function(e) {

            $(this).slideUp();

            var datos = new FormData();
            datos.append('modulo', 'gestion');
            datos.append('controlador', 'gestionarPeriodos');
            datos.append('accion', 'habilitar_periodos');
            datos.append('periodo-activo', $('#periodo-activo').val());


            var checked = $('#periodo-a-activar:checked').val();
            datos.append('periodo-a-activar', checked);

            $.ajax({
                type: "post",
                dataType: "html",
                url: "controlador.php",
                contentType: false,
                data: datos,
                processData: false,
            }).done(function(respuesta) {

                alert(respuesta);
                ejecutarAccionJson(
                        'gestion', 'gestionPeriodos', '', '', 'mostrar_lista_periodos();'
                        );
//                 $('#respúesta_validacion').html( respuesta );
//                 $('#respúesta_validacion').slideDown();
            });

        });
    });

    $('.check-periodos').click(function() {

        $('.check-periodos').attr('checked', false);
        $(this).attr('checked', true);

    });


</script>