
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-user themed-color"></i> Gestores de subreceptores<br>
        <small>Asignar un subreceptor a un Gestor</small>
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
            <a href="#">Gestion</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">Gestor de subreceptores</a></li>
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

            <form id="form-gestores-subreceptores" class="form-horizontal" onsubmit="return false;" >
                <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset( $datosGestoresSubreceptores ) ? $datosGestoresSubreceptores->ID_SUBRECEPTOR_GESTOR : '' ; ?>" />
              
                
                <div class="control-group">
                            <label class="control-label">Gestor</label>
                            <div id="gestorslc" class="controls">
                                <select id="gestor" name="gestor" class="select-chosen focused" >
                                    <option value >seleccione un gestor</option>
                                    <?php foreach ($gestores as $gestor) { 
                                        $selected = "";
                                        if(isset($datosGestoresSubreceptores))
                                            if( $gestor->ID_PERSONA == $datosGestoresSubreceptores->ID_GESTOR )
                                                $selected = " selected ";
                                        ?>
                                        <option value="<?php echo $gestor->ID_PERSONA ?>"   <?php echo $selected; ?> ><?php echo ($gestor->NOMBRE_REAL_PERSONA) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                
                <div class="control-group">
                            <label class="control-label">Subreceptor</label>
                            <div id="subreceptorslc" class="controls">
                                <select id="subreceptor" name="subreceptor" class="select-chosen focused" >
                                    <option value >seleccione un subreceptor</option>
                                    <?php foreach ($subreceptores as $subreceptor) { 
                                        $selected = "";
                                        if(isset($datosGestoresSubreceptores))
                                            if( $subreceptor->ID_SUBRECEPTOR == $datosGestoresSubreceptores->ID_SUBRECEPTOR )
                                                $selected = " selected ";
                                        ?>
                                        <option value="<?php echo $subreceptor->ID_SUBRECEPTOR ?>"   <?php echo $selected; ?> ><?php echo ($subreceptor->SIGLAS_SUBRECEPTOR) ?></option>
                                    <?php } ?>
                                </select>
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
        
        
        
        $('#form-gestores-subreceptores').submit(function() {
            
            if(estaVacio( $('#gestor').val())){
                alert('Debe seleccionar un gestor');
                return false;
            }
            if(estaVacio ($('#subreceptor').val())){
                alert('Debe seleccionar un Subreceptor');
                return false;
            }
            
            var datosForm = $(this).serialize();
            
            if( estaVacio( $('#registro-id').val() )  ){
                ejecutarAccionJson( 'gestion', 'gestoresSubreceptores', 'guardar_nuevo_gestor_subreceptor',
                                     datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_gestores_subreceptores();", "" );' 
                 );
            }else{
                ejecutarAccionJson(
                   'gestion', 'gestoresSubreceptores', 'editar_gestor_subreceptores', 
                   datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_gestores_subreceptores();", "" );' 
               );
            }
        });

    });
</script>

