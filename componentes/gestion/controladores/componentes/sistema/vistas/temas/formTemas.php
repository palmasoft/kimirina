
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> formulario temas<br>
        <small>sub titulo de temas</small>
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
            <a href="javascript:abrir_tabla_temas();">Temas</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">formulario tema</a></li>
    </ul>
    <!-- END Breadcrumb -->
    
    <div class="block block-themed" >
    <div class="block-title">
            <h4>
               
                Nuevo tema
            </h4>
            <div class="block-options">            
            </div>  
        </div>

     <div class="block-content"> 
          <form id="form-temas"  class="form-inline" onsubmit="return false;">
              <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset( $tema) ?($tema->ID_TEMA) : '' ; ?>" />
                <!-- div.row-fluid -->
                <div class="row-fluid">
                    <!-- 1st Column -->
                    <div class="span12"> 
                        <div class="control-group">
                            <label class="control-label  span2" for="tituloTema">Titulo de tema:</label>
                            <div class="controls  span10">
                                <input type="text" id="tituloTema" name="tituloTema" value="<?php echo isset($tema) ?($tema->TITULO_TEMA) : '' ; ?>" class="required" required="required" >
                            </div>
                        </div>  
                        <div class="control-group">
                            <label class="control-label  span2 " for="descripcionTema">Descripcion</label>
                            <div class="controls span10">
                                <textarea id="descripcionTema" name="descripcionTema" class="span12" ><?php echo isset($tema) ?($tema->DESCRIPCION_TEMA) : '' ; ?></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label  span2 " for="instruccionesTema">Instrucciones</label>
                            <div class="controls span10">
                                <textarea id="instruccionesTema" name="instruccionesTema" class="span12" ><?php echo isset($tema) ?($tema->INSTRUCCIONES_TEMA) : '' ; ?></textarea>
                            </div>
                        </div>
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
</div>



<script>
$(document).ready(function() {
      
    $("#form-temas").submit( function (e){
            var datosTema = $(this).serialize();
            if( estaVacio( $('#registro-id').val() )  ){
                ejecutarAccionJson(
                   'sistema', 'temas', 'agregar_tema', 
                   datosTema, 'mostrar_resultado_guardar( data, "abrir_tabla_temas();", "" );'
               );   
            }else{
                ejecutarAccionJson(
                   'sistema', 'temas', 'editar_tema', 
                   datosTema, 'mostrar_resultado_guardar( data, "abrir_tabla_temas();", "" );'
               );
            }
    
        } );
});

</script>