<?php ?>


<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Formulario Tipos de Lugares<br>
        <small>Formulario para llenar todos los tipos de lugares</small>
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
            <a href="javascript:abrir_tipo_lugares();">Listado</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Tipo de Lugares</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <div class="block  block-themed" >
        <div class="block-title">
            <h4>
                Nuevo Tipo de Lugar
            </h4>
            <div class="block-options">            
            </div>  
        </div>
        <div class="block-content">
            <form id="form-tipoLugar" method="POST" onsubmit="return false;">
                <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset( $TipoLugar ) ? ($TipoLugar->ID_TIPOLUGAR) : '' ; ?>" />

                <div class="control-group form-horizontal">
                    <label class="control-label" for="codigoTipoLugar">CODIGO TIPO LUGAR</label>
                    <div class="controls">
                        <input style="width: 100%" type="text" name="codigoTipoLugar" id="codigoTipoLugar" value="<?php echo isset( $TipoLugar) ? ($TipoLugar->CODIGO_TIPOLUGAR) : '' ; ?>" class="required sinEspacios"required=""><br>
                    </div>
                </div>

                <div class="control-group form-horizontal">
                    <label class="control-label" for="nombreTipoLugar">NOMBRE TIPO LUGAR</label>
                    <div class="controls">
                        <input style="width: 100%" type="text" name="nombreTipoLugar" value="<?php echo isset( $TipoLugar) ? ($TipoLugar->NOMBRE_TIPOLUGAR) : '' ; ?>" class="required "required=""><br>
                    </div>
                </div>

                <div class="control-group form-horizontal">
                    <label class="control-label" for="observacionesTipoLugar">OBSERVACIONES</label>
                    <div class="controls">
                        <textarea style="width: 100%" name="observacionesTipoLugar" id="TextArea1" rows="5" cols="33"><?php echo isset( $TipoLugar) ? ($TipoLugar->OBSERVACIONES_TIPOLUGAR) : '' ; ?></textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
                    <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Guardar</button>
                </div> 

            </form>
        </div>        
    </div>   

</div>



<script>
    $(document).ready(function() {
        
        $("#form-tipoLugar").submit( function (e){
            var datosLugar = $(this).serialize();
            if( estaVacio( $('#registro-id').val() )  ){
                ejecutarAccionJson(
                   'sistema', 'tipoLugares', 'agregar_tipo_lugar', 
                   datosLugar, 'mostrar_resultado_guardar( data, "abrir_tipo_lugares();", "" );'
               );   
            }else{
                ejecutarAccionJson(
                   'sistema', 'tipoLugares', 'editar_tipo_lugar', 
                   datosLugar, 'mostrar_resultado_guardar( data, "abrir_tipo_lugares();", "" );'
               );
            }
    
        } );
        
    });	
    
</script>