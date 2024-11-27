
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Esquemas ARV<br>
        <small>Registro de nuevo esquema ARV</small>
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
            <a href="javascript:abrir_listado_esquemas_arv();">Listado Esquemas</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Formulario esquemas</a></li>
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
                <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset( $esquemasArv ) ? ($esquemasArv->ID_ESQUEMA_ARV) : '' ; ?>" />

                <div class="control-group">
                    <label class="control-label" for="codigoEsquema">Codigo</label>
                    <div class="controls">
                        <input type="text" name="codigoEsquema" placeholder="Codigo sin puntos ni espacios" required="" value="<?php echo isset( $esquemasArv ) ? ($esquemasArv->CODIGO_ESQUEMA_ARV) : '' ; ?>"/>

                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="general-text">Nombre</label>
                    <div class="controls">
                        <input type="text" name="nombreEsquema" placeholder="Nombre" required="" value="<?php echo isset( $esquemasArv ) ? ($esquemasArv->NOMBRE_ESQUEMA_ARV) : '' ; ?>" />
                    </div>
                </div>



                <div class="control-group">
                    <label class="control-label" for="textarea-default">Observaciones</label>
                    <div class="controls">
                        <textarea id="observacionesEsquema" name="observacionesEsquema" rows="4"><?php echo isset( $esquemasArv ) ? ($esquemasArv->OBSERVACIONES_ESQUEMA_ARV) : '' ; ?></textarea>
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
                ejecutarAccionJson( 'sistema', 'esquemaArv', 'guardar_nuevo_esquema_arv',
                                     datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_esquemas_arv();", "" );' 
                 );
            }else{
                ejecutarAccionJson(
                   'sistema', 'esquemaArv', 'editar_esquema_arv', 
                   datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_esquemas_arv();", "" );' 
               );
            }
        });

    });
</script>

