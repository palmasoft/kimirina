
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-stats themed-color"></i> Metas Subreceptores<br>
        <small>Registro de Meta del Subreceptores</small>
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
  

    <div class="block  block-themed" >
        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                Datos 
            </h4>
            <div class="block-options">            
            </div>  
        </div>
        <div class="block-content"> 

            <form id="form-esquema-arv" class="form-horizontal" onsubmit="return false;" >
                <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset( $datosSubreceptores ) ? ($datosSubreceptores->ID_SUBRECEPTOR_META) : '' ; ?>" />
                

                 <div class="control-group">
                            <label class="control-label">Subreceptor</label>
                            <div id="subreceptorslc" class="controls">
                                <select id="subreceptor" name="subreceptor" class="select-chosen focused" >
                                    <option value >seleccione un subreceptor</option>
                                    <?php foreach ($subreceptores as $subreceptor) { 
                                        $selected = "";
                                        if(isset($datosSubreceptores))
                                            if( $subreceptor->ID_SUBRECEPTOR == $datosSubreceptores->ID_SUBRECEPTOR )
                                                $selected = " selected ";
                                        ?>
                                        <option value="<?php echo $subreceptor->ID_SUBRECEPTOR ?>"   <?php echo $selected; ?> ><?php echo ($subreceptor->SIGLAS_SUBRECEPTOR) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                
                
                <div class="control-group form-horizontal">
                    <label class="control-label" for="periodos">Periodos</label>
                    <div class="controls">

                        <select id="periodos" name="periodos" class="select-chosen" size="1">
                            <option value > Ninguno</option>
                            <?php
                            
                            foreach ($periodos as $periodo) {
                                $selected = "";
                                if (isset($datosSubreceptores))
                                    if ($datosSubreceptores->ID_PERIODO_INDICADOR == $periodo->ID_PERIODO_INDICADOR)
                                        $selected = "selected";

                                echo ('<option value="' . $periodo->ID_PERIODO_INDICADOR . '" ' . $selected . ' >' . $periodo->TITULO_PERIODO_INDICADOR . '</option>');
                            }
                            ?>
                        </select>

                    </div>
                </div>
                
                <div class="control-group form-horizontal">
                    <label class="control-label" for="indicador">Indicador</label>
                    <div class="controls">

                        <select id="indicador" name="indicador" class="select-chosen" size="1">
                            <option value > Ninguno</option>
                            <?php
                            
                            foreach ($indicadores as $indicador) {
                                $selected = "";
                                if (isset($datosSubreceptores))
                                    if ($datosSubreceptores->ID_INDICADOR == $indicador->ID_INDICADOR)
                                        $selected = "selected";

                                echo ('<option value="' . $indicador->ID_INDICADOR . '" ' . $selected . ' >' . ($indicador->NOMBRE_INDICADOR) . '</option>');
                            }
                            ?>
                        </select>

                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="Meta Subreceptor"> Meta del Subreceptor</label>
                    <div class="controls">
                        <input type="text" name="Meta_subreceptor" value="<?php echo isset( $datosSubreceptores ) ? ($datosSubreceptores->META_SUBRECEPTOR) : '' ; ?>"/>
                        

                    </div>
                </div>

                <!-- Form Buttons -->
                <div class="form-actions">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
                    <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Guardar</button>
                </div>
                <!-- END Form Buttons -->
            </form>

        </div>        
    </div>   

</div>



<script>
    $(document).ready(function() {
        //informacion('lo que sea');
        $('#form-esquema-arv').submit(function() {
            var datosForm = $(this).serialize();
            if( estaVacio( $('#registro-id').val() )  ){
                ejecutarAccionJson(  'gestion', 'metasSubreceptores', 'guardar_nueva_meta_subreceptor',
                                     datosForm, 'mostrar_resultado_guardar( data, "abrir_lista_metas_subreceptores();", "" );' 
                 );
            }else{
                ejecutarAccionJson(
                   'gestion', 'metasSubreceptores', 'update_meta_subreceptor', 
                   datosForm, 'mostrar_resultado_guardar( data, "abrir_lista_metas_subreceptores();", "" );' 
               );
            }    
                
        });

    });
</script>

