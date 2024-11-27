<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Servicios de Salud<br>
        <small>FORMULARIO DE SERVICIOS DE SALUD.</small>
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
            <a href="javascript:abrir_tabla_servicios_de_salud();">Servicios de Salud</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Formulario</a></li>
    </ul>
    <!-- END Breadcrumb -->

     <div class="block  block-themed" >
        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                Datos Servicios de Salud
            </h4>
            <div class="block-options">            
            </div>  
        </div>
        <div class="block-content">  
            
            <form id="form-ServicioDeSalud" class="form-horizontal" onsubmit="return false;" >       
                <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($servicioSalud) ? ($servicioSalud->ID_SERVICIO) : '' ; ?>" />         
                
                <div class="control-group">
                    <label class="control-label" for="nombreServicioDeSalud">Nombre Servicio</label>
                    <div class="controls">
                        <input type="text" name="nombreServicioDeSalud" placeholder="Nombre" value="<?php echo isset($servicioSalud) ?($servicioSalud->NOMBRE_SERVICIO) : '' ; ?>" class="required" required="required"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="codigoServicioDeSalud">Codigo Servicio</label>
                    <div class="controls">
                        <input type="text" name="codigoServicioDeSalud" placeholder="Codigo" value="<?php echo isset($servicioSalud) ?($servicioSalud->CODIGO_SERVICIO) : '' ; ?>" class="required sinEspacios" required="required"/>
                        
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="nivelServicioDeSalud">Nivel Servicio</label>
                    <div class="controls">
                        <input type="text" name="nivelServicioDeSalud" placeholder="nivel" value="<?php echo isset($servicioSalud) ?($servicioSalud->NIVEL_SERVICIO) : '' ; ?>" />
                        
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="observacionesServicioDeSalud">Observaciones</label>
                    <div class="controls">
                        <textarea id="observacionesServicioDeSalud" name="observacionesServicioDeSalud" rows="4"><?php echo isset($servicioSalud) ?($servicioSalud->OBSERVACIONES_SERVICIO) : '' ; ?></textarea>
                    </div>
                </div>


        
                <!-- Form Buttons -->
                <div class="form-actions">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
                    <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Enviar</button>
                </div>
                <!-- END Form Buttons -->
        </form>
        </div>        
    </div>   
    
</div>



<script>
$(document).ready(function() {
    
    $("#form-ServicioDeSalud").submit( function (e){
            
            var datosServiciosSalud = $(this).serialize();

            if( estaVacio( $('#registro-id').val() )  ){
                ejecutarAccionJson(
                'sistema', 'servicios_de_salud', 'agregar_servicio_de_salud', 
                datosServiciosSalud, 'mostrar_resultado_guardar( data, "abrir_tabla_servicios_de_salud();", "" );');
            }else{
                ejecutarAccionJson(
                'sistema', 'servicios_de_salud', 'editar_servicio_de_salud', 
                datosServiciosSalud, 'mostrar_resultado_guardar( data, "abrir_tabla_servicios_de_salud();", "" );');    
            }
            
    
        } );
});	
</script>