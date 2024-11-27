<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 icon-compass themed-color"></i>Lugares de Consejería<br>
        <small>Formulario para el registro de datos de Lugares donde se realizan las Consejerías a PVVS</small>
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
            <a href="javascript:abrir_listado_lugares_consejeria();">Lugares de Consejeria</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Formulario</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <div class="block  block-themed" >
        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                Datos  del Lugar de Consjeria
            </h4>
            <div class="block-options">            
            </div>  
        </div>
        <div class="block-content"> 

            <form id="form-consejeria" class="form-horizontal" onsubmit="return false;" >       
                <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($consejeria) ? ($consejeria->ID_LUGAR_CONSEJERIA) : ''; ?>" />         
                <div class="control-group">
                    <label class="control-label" for="codigo_lugar_consejeria">Código de lugar de Consejería</label>
                    <div class="controls">
                        <input type="text" name="codigo_lugar_consejeria" placeholder="Codigo Sin Espacio" 
                               value="<?php echo isset($consejeria) ? ($consejeria->CODIGO_LUGAR_CONSEJERIA) : ''; ?>" class="required sinEspacio mayusculas" required="required"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="nombre_lugar_consejeria">Nombre del Lugar de Consejería</label>
                    <div class="controls">
                        <input type="text" name="nombre_lugar_consejeria" placeholder="Nombre" value="<?php echo isset($consejeria) ? ($consejeria->NOMBRE_LUGAR_CONSEJERIA) : ''; ?>" class="required" required="required"/>

                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="observaciones_lugar_consejeria">Observaciones</label>
                    <div class="controls">
                        <textarea id="observaciones_lugar_consejeria" name="observaciones_lugar_consejeria" rows="4"><?php echo isset($consejeria) ? ($consejeria->OBSERVACIONES_LUGAR_CONSEJERIA) : ''; ?></textarea>
                    </div>
                </div>
                <!-- Form Buttons -->
                <div class="form-actions">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
                    <button type="submit" class="btn btn-success"><i class="icon-save"></i> Guardar</button>
                </div>
                <!-- END Form Buttons -->
            </form>

        </div>        
    </div>   

</div>



<script>
    $(document).ready(function() {
        //informacion('lo que sea');
        $('#form-consejeria').submit(function() {
            var datosForm = $(this).serialize();

            if (estaVacio($('#registro-id').val())) {
                ejecutarAccionJson(
                        'sistema', 'lugaresConsejerias', 'guardar_nuevo_lugar_consejeria',
                        datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_lugares_consejeria();", "" );'
                        );
            } else {
                ejecutarAccionJson(
                        'sistema', 'lugaresConsejerias', 'editar_consejeria',
                        datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_lugares_consejeria();", "" );'
                        );
            }
        });

    });

</script>




<script>
<?php if (isset($consejeria)): ?>
    agregar_boton_ayuda('EDITARLUGARCONSEJERIA');
<?php else: ?>
    agregar_boton_ayuda('NUEVOLUGARCONSEJERIA');
<?php endif; ?>
</script>
