
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Insumos<br>
        <small>Formulario de registro de datos de insumos</small>
    </h1>
</div>

<div id="page-content">
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:abrir_tabla_insumos();">Insumos</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">formulario</a></li>
    </ul>

    <div class="block block-themed" >
        <div class="block-title">
            <h4>Datos del insumo</h4>
            <div class="block-options"></div>  
        </div>

        <div class="block-content"> 
            <form id="form-insumos"  class="form-inline" onsubmit="return false;">
                <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($insumo) ? ($insumo->ID_INSUMO) : ''; ?>" />
                <div class="row-fluid">
                    <div class="span12"> 
                        <div class="control-group">
                            <label class="control-label  span2" for="nombreInsumo">Nombre de Insumo:</label>
                            <div class="controls  span10">
                                <input type="text" id="nombreInsumo" name="nombreInsumo" value="<?php echo isset($insumo) ? ($insumo->NOMBRE_INSUMO) : ''; ?>" class="required" required="required" >
                            </div>
                        </div>  
                        <div class="control-group">
                            <label class="control-label  span2 " for="observacionesInsumo">Observaciones:</label>
                            <div class="controls span10">
                                <textarea id="observacionesInsumo" name="observacionesInsumo" class="span12" ><?php echo isset($insumo) ? ($insumo->OBSERVACIONES) : ''; ?></textarea>
                            </div>
                        </div>                       
                    </div>
                </div>

                <div class="form-actions" align="center">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
                    <button type="submit" class="btn btn-success"><i class="icon-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {
        $("#form-insumos").submit(function(e) {
            var datosTema = $(this).serialize();
            if (estaVacio($('#registro-id').val())) {
                ejecutarAccionJson(
                        'sistema', 'insumos', 'agregar_insumo',
                        datosTema, 'mostrar_resultado_guardar( data, "abrir_tabla_insumos();", "" );'
                        );
            } else {
                ejecutarAccionJson(
                        'sistema', 'insumos', 'editar_insumo',
                        datosTema, 'mostrar_resultado_guardar( data, "abrir_tabla_insumos();", "" );'
                        );
            }
        });
    });

</script>


<script>
<?php if (isset($insumo)): ?>
    agregar_boton_ayuda('EDITARINSUMOSISTEMA');
<?php else: ?>
    agregar_boton_ayuda('NUEVOINSIMOSISTEMA');
<?php endif; ?>
</script>