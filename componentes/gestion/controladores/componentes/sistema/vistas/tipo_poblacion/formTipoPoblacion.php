<?php ?>


<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Formulario Tipos de PEMAR<br>
        <small>Formulario para llenar todos los tipos PEMAR</small>
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
            <a href="javascript:abrir_tipo_pemar();">PEMARS</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Tipo de PEMAR</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <div class="block  block-themed" >
        <div class="block-title">
            <h4>
                Datos PEMAR
            </h4>
            <div class="block-options">            
            </div>  
        </div>
        <div class="block-content">
            <form id="form-pemar" method="POST" onsubmit="return false;">
                <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset( $TipoPemar ) ? ($TipoPemar->ID_TIPOPOBLACION) : '' ; ?>" />
                
                <div class="control-group form-horizontal">
                    <label class="control-label" for="codigoTipoPemar">CODIGO TIPO PEMAR</label>
                    <div class="controls">
                        <input style="width: 100%" type="text" name="codigoTipoPemar" class="sinEspacios" value="<?php echo isset( $TipoPemar ) ? ($TipoPemar->CODIGO_TIPOPOBLACION) : '' ; ?>" required=""><br>
                    </div>
                </div>

                <div class="control-group form-horizontal">
                    <label class="control-label" for="nombreTipoPemar">NOMBRE TIPO PEMAR</label>
                    <div class="controls">
                        <input style="width: 100%" type="text" name="nombreTipoPemar" class="required" required="required" value="<?php echo isset( $TipoPemar ) ? ($TipoPemar->NOMBRE_TIPOPOBLACION) : '' ; ?>"><br>
                    </div>
                </div>

                <div class="control-group form-horizontal">
                    <label class="control-label" for="aliasTipoPemar">ALIAS PEMAR</label>
                    <div class="controls">
                        <input style="width: 100%" type="text" name="aliasTipoPemar" value="<?php echo isset( $TipoPemar ) ? ($TipoPemar->ALIAS_TIPOPOBLACION) : '' ; ?>"><br>
                    </div>
                </div>

                <div class="control-group form-horizontal">
                    <label class="control-label" for="observacionesTipoPemar">OBSERVACIONES</label>
                    <div class="controls">
                        <textarea style="width: 100%" name="observacionesTipoPemar" id="TextArea1" rows="5" cols="33"><?php echo isset( $TipoPemar ) ? ($TipoPemar->OBSERVACIONES_TIPOPOBLACION) : '' ; ?></textarea>
                    </div>
                </div>

                <div class="control-group form-horizontal">
                    <label class="control-label" for="general-themed-checkbox">Mostrar en la WEB ( ponteonce.org )</label>
                    <div class="controls">
                        <?php if(isset( $TipoPemar )&&($TipoPemar->MOSTRAR_WEB=='SI')){ $sw = 1; }?>
                        <label class="radio inline " for="horizontal-radio1">
                            <input type="radio" id="horizontal-radio1" name="mostrarTipoPemar" <?php if(isset($sw)){?>checked="checked"<?php }?> value="SI" class="input-themed" > SI
                        </label>
                        <label class="radio inline" for="horizontal-radio2">
                            <input type="radio" id="horizontal-radio2" name="mostrarTipoPemar" <?php if(!isset($sw)){?>checked="checked"<?php }?> value="NO" class="input-themed" > NO
                        </label>
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
        
       $("#form-pemar").submit( function (e){
            var datosPemar = $(this).serialize();
            if( estaVacio( $('#registro-id').val() )  ){
                ejecutarAccionJson(
                   'sistema', 'tipoPemar', 'agregar_tipo_pemar', 
                   datosPemar, 'mostrar_resultado_guardar( data, "abrir_tipo_pemar();", "" );'
               );   
            }else{
                ejecutarAccionJson(
                   'sistema', 'tipoPemar', 'editar_tipo_pemar', 
                   datosPemar, 'alert(data);mostrar_resultado_guardar( data, "abrir_tipo_pemar();", "" );'
               );
            }
    
        } );
        
    });	
</script>
