
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-user themed-color"></i> Reporte Mensual Monitores<br>
        <small>Ventana de PRE-Aprobacion de Informe Mensual y Generacion de Reportes de Periodo.</small>
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
            <a href="#">Reporte</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Informe Mensual</a></li>
    </ul>
    <!-- END Breadcrumb -->


    <?php if (!$tieneRestricciones): ?>            
        <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos, 'gestion'); ?>
    <?php endif; ?>

    <!-- General Forms Block -->
    <div class="block block-themed ">
        <div class="block-title">
            <h4><small>SUBRECEPTOR :</small> <?php echo ($SubReceptor->SIGLAS_SUBRECEPTOR ) ?><br /><?php echo ($SubReceptor->NOMBRE_SUBRECEPTOR) ?></h4>
            <div class="block-options">
                <?php if (!$estaAprobadoPeriodo){ ?> 
                    <?php if ($estaPreAprobadoPeriodo) { ?>
                        <button id="btn_regenerar_informes_mensuales" type="submit" class="btn btn-success">PERIODO PRE-APROBADO <i class="glyphicon-roundabout "></i><br />re-enviar datos del reporte</button>
                        <button id="btn_descarga_ultimo_reporte" type="button" class="btn btn-inverse"><i class="icon-download-alt"></i> Ver Reporte Generado</button>
                    <?php } else { ?>
                        <button id="btn_repotar_informe_mensual" type="submit" class="btn btn-success"><i class="icon-ok"></i> PRE-APROBACION DE<br />REPORTE MENSUAL </button>
                    <?php } ?>
                <?php }  else { ?>
                        <button id="" type="button" class="btn btn-info"><i class="icon-thumbs-up-alt"></i> Aceptado</button>                        
                        <button id="btn_descarga_ultimo_reporte" type="button" class="btn btn-inverse"><i class="icon-download-alt"></i> Ver Reporte Generado</button>
                 <?php } ?>
            </div>
        </div>
        <div class="block-content"> 
            <?php $this->mostrar("reporte_mensual/tablaIndicadoresValores", $this->datos); ?>    
        </div>
    </div>               

</div>



<script>
    $(document).ready(function() {

        $('#btn_repotar_informe_mensual').click(function(e) {
            var datos = $('#form-cosulta-reporte_mensual').serialize();
            confirm('Seguro que desea PRE-APROBAR los datos de este Informe?', 'pre_aprobacion_periodo_subreceptor("' + datos + '")');
        });

        $('#btn_regenerar_informes_mensuales').click(function(e) {
            var datos = $('#form-cosulta-reporte_mensual').serialize();
            confirm('Seguro que desea PRE-APROBAR NUEVAMENTE los datos de este Informe?', 'pre_aprobacion_periodo_subreceptor("' + datos + '")');
        });

        $('#btn_descarga_ultimo_reporte').click(function(e) {
            mostrar_contenidos(
                    'gestion', 'reporteMensualSubreceptor', 'mostrar_ultimo_reporte_generado',
                    $('#form-cosulta-reporte_mensual').serialize()
                    );
        });

        $('#form-control-subreceptor-periodo').submit(function(e) {
            if (estaVacio($('#subreceptor-form-control').val())) {
                alert('Seleccione un Subreceptor.');
                return false;
            }

            abrir_informe_mensual_por_subreceptor_por_periodo($(this).serialize());
        });

    });
</script>


