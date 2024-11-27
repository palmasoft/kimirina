
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Gestores de subreceptores<br>
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
            <a href="javascript:abrir_listado_subreceptores();">Subreceptores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Gestor de subreceptores</a></li>
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

            <form id="form-subreceptores" class="form-horizontal" onsubmit="return false;" >
                <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset( $subreceptor ) ? $subreceptor->ID_SUBRECEPTOR : '' ; ?>" />
                <div class="control-group">
                    <label class="control-label" for="codigo_subreceptor">Codigo Subreceptor</label>
                    <div class="controls">
                        <input type="text" name="codigo_subreceptor" value="<?php echo isset($subreceptor) ?($subreceptor->CODIGO_SUBRECEPTOR) : '' ; ?>" class="required" required="required"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="siglas_subreceptor">Siglas Subreceptor</label>
                    <div class="controls">
                        <input type="text" name="siglas_subreceptor" value="<?php echo isset($subreceptor) ?($subreceptor->SIGLAS_SUBRECEPTOR) : '' ; ?>" class="required" required="required"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="nombre_subreceptor">Nombre Subreceptor</label>
                    <div class="controls">
                        <input type="text" name="nombre_subreceptor" value="<?php echo isset($subreceptor) ?($subreceptor->NOMBRE_SUBRECEPTOR) : '' ; ?>" class="required" required="required"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="edad_min_subreceptor">Edada Minima</label>
                    <div class="controls">
                        <input type="number" name="edad_min_subreceptor" value="<?php echo isset($subreceptor) ?($subreceptor->EDAD_MINIMA) : '' ; ?>" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="edad_max_subreceptor">Edada Maxima</label>
                    <div class="controls">
                        <input type="number" name="edad_max_subreceptor" value="<?php echo isset($subreceptor) ?($subreceptor->EDAD_MAXIMA) : '' ; ?>" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="max_condones_subreceptor">Maximo Condondes Entrega</label>
                    <div class="controls">
                        <input type="number" name="max_condones_subreceptor" value="<?php echo isset($subreceptor) ?($subreceptor->MAX_CONDONES_ENTREGA) : '' ; ?>" class="required" required="required"/>
                    </div>
                </div>                    
                <div class="control-group">
                            <label class="control-label">Gestor</label>
                            <div id="gestorslc" class="controls">
                                <select id="gestor" name="gestor" class="select-chosen focused" >
                                    <option value >seleccione un gestor</option>
                                    <?php foreach ($gestores as $gestor) { 
                                        $selected = "";
                                        if(isset($subreceptor))
                                            if( $gestor->ID_PERSONA == $subreceptor->ID_GESTOR )
                                                $selected = " selected ";
                                        ?>
                                        <option value="<?php echo $gestor->ID_PERSONA ?>"   <?php echo $selected; ?> ><?php echo ($gestor->NOMBRE_REAL_PERSONA) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                 </div>
                <div class="row-fluid">
        <div class="span2">
            Tipos de Poblacion
        </div>
        <div class="span9">
            
        <?php
             echo ' <div class="block block-themed">
                    <div class="block-title"><h4></h4></div>
                    <div class="block-content ">';
            foreach ($tiposPoblacion as $poblacion) {               
                $checked = "";
                if (isset($subreceptor->TIPOS_POBLACION)) {     
                    if(!empty($subreceptor->TIPOS_POBLACION)){
                    foreach ($subreceptor->TIPOS_POBLACION as $key => $value) {
                        //echo ($value->ID_TIPOPOBLACION);
                        if ( $poblacion->ID_TIPOPOBLACION == $value->ID_TIPOPOBLACION ) {
                            $checked = " checked ";                        
                        }
                    }
                    }
                }
                echo '<label class="checkbox " for="poblacion' . $poblacion->ID_TIPOPOBLACION . '">  '
                  . '<input type="checkbox" id="poblacion-' . $poblacion->ID_TIPOPOBLACION . '" name="poblacion[]" class="input-themed" 
                              value="' . $poblacion->ID_TIPOPOBLACION . '" ' . $checked . ' >'
                  . ' ' . ($poblacion->NOMBRE_TIPOPOBLACION) . ' '
                  . '  </label>   ';
            }
        echo '</div>
                </div>';
        ?>
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
        
        $('#form-subreceptores').submit(function() {          
            var datosForm = $(this).serialize();
            if(estaVacio( $('#gestor').val())){
                alert('Debe seleccionar un gestor');
                return false;
            }
            
            if( estaVacio( $('#registro-id').val() )  ){
                ejecutarAccionJson( 'gestion', 'gestoresSubreceptores', 'guardar_nuevo_gestor_subreceptor',
                                     datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_subreceptores();", "" );' 
                 );
            }else{
                ejecutarAccionJson(
                   'sistema', 'subreceptores', 'editar_subreceptor', 
                   datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_subreceptores();", "" );' 
               );
            }
        });

    });
</script>

