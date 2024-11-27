
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="icon-check themed-color"></i> Aceptación de Reporte Mensual de Subreceptores<br>
        <small>Ventana de Aceptación de Informe Mensual y Generación de Reportes de Periodo.</small>
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
        <li class="active"><a href="#">Aceptación de Reporte Mensual de Subreceptores</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- General Forms Block -->
    <div class="block block-themed ">

        <?php if (!$tieneRestricciones or Usuario::esDNI() ): ?>            
            <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos, 'gestion'); ?>
        <?php endif; ?>

        <div class="block block-themed ">
            <div class="block-title">
                <h4><small>SUBRECEPTOR :</small><?php echo ($SubReceptor->SIGLAS_SUBRECEPTOR) ?><br /><?php echo ($SubReceptor->NOMBRE_SUBRECEPTOR) ?></h4>  
                <div class="block-options">
                    <?php if (!$estaAceptadoPeriodo) { ?> 
                        <?php if ($estaAprobadoPeriodo) { ?>
                            <button id="btn_regenerar_informes_mensuales" type="submit" class="btn btn-success"><i class="icon-ok"></i>Aceptar Reporte Mensual</button> 
                            <button id="btn_descarga_ultimo_reporte" type="button" class="btn btn-success"><i class="icon-download-alt"></i> Ver Reporte Generado</button>
                        <?php } else { ?>
                            <?php if ($estaPreAprobadoPeriodo) { ?>
                                <button id="" type="button" class="btn btn-danger"><i class="icon-cancel"></i> NO ESTÁ APROBADO </button> 
                                <button id="btn_descarga_ultimo_reporte" type="button" class="btn btn-success"><i class="icon-download-alt"></i> Ver Reporte Generado</button>
                            <?php } else { ?>
                                <button id="" type="button" class="btn btn-danger"><i class="icon-cancel"></i> NO ESTÁ PRE-APROBADO </button>
                            <?php } ?>
                        <?php } ?>        
                    <?php } else { ?>
                        <button id="" type="button" class="btn btn-info"><i class="icon-thumbs-up-alt"></i> Aceptado</button>                        
                        <button id="btn_descarga_ultimo_reporte" type="button" class="btn btn-inverse"><i class="icon-download-alt"></i> Ver Reporte Generado</button>
                    <?php } ?>
                </div>
            </div>
            <!--<button id="botonprobar" type="button" class="btn btn-info"><i class="icon-thumbs-up-alt"></i> Probar Insumos</button>-->
            <div class="block-content">             
                <?php $this->mostrar("reporte_mensual/tablaIndicadoresValores", $this->datos); ?>    
            </div>        
        </div>  
    </div>  
</div>

<script>
    $(document).ready(function() {
        $('#btn_regenerar_informes_mensuales').click(function(e) {
            var datos = $('#form-cosulta-reporte_mensual').serialize();
            confirm('Seguro que desea ACEPTAR los datos de este Informe?', 'aceptacion_periodo_subreceptor("' + datos + '")');
        });

        $('#btn_descarga_ultimo_reporte').click(function(e) {
            mostrar_contenidos(
                    'gestion', 'reporteMensualSubreceptor', 'mostrar_ultimo_reporte_generado',
                    $('#form-cosulta-reporte_mensual').serialize()
                    );
        });
        
//        $('#botonprobar').click(function(e) {
//            var datos = $('#form-cosulta-reporte_mensual').serialize();
//            confirm('Probamos los insumos?', 'aceptacion_periodo_subreceptor("' + datos + '")');
//        });
        
        $('#form-control-subreceptor-periodo').submit(function(e) {
            if (estaVacio($('#subreceptor-form-control').val())) {
                alert('Seleccione un Subreceptor.');
                return false;
            }
            abrir_informe_mensual_subreceptor_gestor_por_subreceptor($(this).serialize());
        });
        
    });
</script>
<script>
    agregar_boton_ayuda('BIENVENIDA');
</script>

