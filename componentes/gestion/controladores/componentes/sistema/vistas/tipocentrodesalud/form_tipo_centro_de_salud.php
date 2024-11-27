<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Formulario Tipo de centro de salud<br>
        <small>FORMULARIO DE TIPOS DE CENTRO DE SALUD.</small>
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
            <a href="javascript:abrir_tabla_tipo_centro_de_salud();">Listado</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Tipo de centro de salud</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <div class="block  block-themed" >
        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                Datos Centro de Salud
            </h4>
            <div class="block-options">            
            </div>  
        </div>
        <div class="block-content">  
            
            <form id="form-tipoCentroDeSalud" method="POST" onsubmit="return false;" class="form-horizontal">
                <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset( $TipoCentroSalud) ? ($TipoCentroSalud->ID_TIPO_CENTROSERVICIO) : '' ; ?>" />
          
	        <div class="control-group ">
                    <label class="control-label" for="codigoTipoCentroDeSalud">Codigo de Centro de Salud</label>
                    <div class="controls">
                        <input type="text" name="codigoTipoCentroDeSalud" id="codigoTipoCentroDeSalud" value="<?php echo isset( $TipoCentroSalud) ? ($TipoCentroSalud->CODIGO_TIPO_CENTROSERVICIO) : '' ; ?>" class="required" required />
                    </div>
                </div>

               
                <div class="control-group ">
                    <label class="control-label" for="nombreTipoCentroDeSalud">Nombre de Centro de Salud</label>
                    <div class="controls">
                        <input type="text" name="nombreTipoCentroDeSalud" id="nombreTipoCentroDeSalud" value="<?php echo isset( $TipoCentroSalud) ? ($TipoCentroSalud->NOMBRE_TIPO_CENTROSERVICIO) : '' ; ?>" class="required " required />
                    </div>
               </div>

                <div class="control-group ">                    
                    <label class="control-label" for="observacionesTipoCentroDeSalud">Observaciones de Centro de Salud</label>
                    <div class="controls">
                        <textarea name="observacionesTipoCentroDeSalud" id="observacionesTipoCentroDeSalud"><?php echo isset( $TipoCentroSalud) ? ($TipoCentroSalud->OBSERVACIONES_TIPO_CENTROSERVICIO) : '' ; ?></textarea>
                    </div>
                </div>
            
                <div class="form-actions" >
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
                    <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Guardar</button>
                </div>

            </form>
            
        </div>        
    </div>   
    
</div>



<script>
$(document).ready(function() {
        
        $("#form-tipoCentroDeSalud").submit( function (e){
            
            var datosTipoCentroDeSalud = $(this).serialize();
            if( estaVacio( $('#registro-id').val() )  ){
                ejecutarAccionJson(
                    'sistema', 'tipo_centro_de_salud', 'agregar_tipo_centro_de_salud', 
                    datosTipoCentroDeSalud, 'mostrar_resultado_guardar( data, "abrir_tabla_tipo_centro_de_salud();", "" );'
                );  
            }else{
                ejecutarAccionJson(
                    'sistema', 'tipo_centro_de_salud', 'editar_tipo_centro_de_salud', 
                    datosTipoCentroDeSalud, 'mostrar_resultado_guardar( data, "abrir_tabla_tipo_centro_de_salud();", "" );'
               );
            }
    
        } );        
        
});	
</script>