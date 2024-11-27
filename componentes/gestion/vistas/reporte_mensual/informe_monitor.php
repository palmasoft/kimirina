

<div id="pre-page-content">
    <h1>
        <i class="icon-check themed-color"></i> Pre/Aprobación de Reporte Mensual<br>
        <small>Ventana de pre-aprobación de informe mensual monitores y generación de reportes de Periodo.</small>
    </h1>
</div>

<div id="page-content">
     <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Monitores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Pre/Aprobación de Reporte Mensual</a></li>
    </ul>
    
    <?php if (!$tieneRestricciones or Usuario::esDNI() ): ?>            
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
                        <button id="" type="button" class="btn btn-info"><i class="icon-thumbs-up-alt"></i> Aprobado</button>                        
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


<script>
    agregar_boton_ayuda('BIENVENIDA');
</script>