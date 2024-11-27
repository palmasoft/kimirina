
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> formulario actividades tecnicas<br>
        <small>sub titulo de actividades tecnicas</small>
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
            <a href="javascript:abrir_tabla_actividades_tecnicas();">Actividades tecnicas</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">formulario actividad tecnica</a></li>
    </ul>
    <!-- END Breadcrumb -->
    
    <div class="block block-themed" >
    <div class="block-title">
            <h4>
               
                Nueva actividad tecnica
            </h4>
            <div class="block-options">            
            </div>  
        </div>

     <div class="block-content"> 
          <form id="form-actividades-tecnicas"  class="form-inline" onsubmit="return false;">
              <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($actividadTecnica) ?($actividadTecnica->ID_ACTIVIDAD) : '' ; ?>" />
                <!-- div.row-fluid -->
                <div class="row-fluid">
                    <!-- 1st Column -->
                    <div class="span12"> 
                        <div class="control-group">
                            <label class="control-label  span2" for="nombreActividad">Nombre de Actividad:</label>
                            <div class="controls  span10">
                                <input type="text" id="nombreActividad" name="nombreActividad" value="<?php echo isset($actividadTecnica) ?($actividadTecnica->NOMBRE_ACTIVIDAD) : '' ; ?>" class="required" required="required" >
                            </div>
                        </div>  
                        <div class="control-group">
                            <label class="control-label  span2 " for="instruccionesActividad">Instrucciones Actividad</label>
                            <div class="controls span10">
                                <textarea id="instruccionesActividad" name="instruccionesActividad" class="span12" ><?php echo isset($actividadTecnica) ?($actividadTecnica->INSTRUCCIONES_ACTIVIDAD) : '' ; ?></textarea>
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


<script>
$(document).ready(function() {
    $("#form-actividades-tecnicas").submit( function (e){
        var datosTema = $(this).serialize(); 
		if( estaVacio( $('#registro-id').val() )  ){    
			ejecutarAccionJson(
					'sistema', 'actividadesTecnicas', 'agregar_actividad_tecnica', 
					datosTema, 'mostrar_resultado_guardar( data, "abrir_tabla_actividades_tecnicas();", "" );'
					);
		}else{
			ejecutarAccionJson(
                   'sistema', 'actividadesTecnicas', 'editar_actividad_tecnica', 
                   datosTema, 'mostrar_resultado_guardar( data, "abrir_tabla_actividades_tecnicas();", "" );'
               );
		}
                
    });
});

</script>