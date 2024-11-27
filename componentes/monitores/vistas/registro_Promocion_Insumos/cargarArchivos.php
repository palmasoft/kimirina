
<form id="form_promocion_insumos_soportes" onsubmit="return false;">
<div class="row-fluid">
    <?php
    if (!empty($promocionInsumos->SOPORTES)) {
        foreach ($promocionInsumos->SOPORTES as $archivos) :
            ?>
            <div class="span3" id="soporte_<?php echo intval($archivos->ID_SOPORTE_ACTIVIDAD_PROMOCION) ?>">
                <div class="block block-themed themed-default">
                    <div class="block-title">
                        <h4><a href="javascript:void(0);" class="btn btn-danger enable-tooltip" title="Eliminar Soporte" data-original-title="Eliminar" onclick="confirm('¿seguro que desea eliminar el archivo?', '$(\'#soporte_<?php echo intval($archivos->ID_SOPORTE_ACTIVIDAD_PROMOCION) ?>\').remove();');" ><i class="icon-trash"></i></a> Archivo <?php echo intval($archivos->ID_SOPORTE_ACTIVIDAD_PROMOCION) ?>: <?php echo $archivos->TIPO_SOPORTE_ACTIVIDAD_PROMOCION ?></h4>
                    </div>
                    <div class="block-content full">
                        <a href="javascript:void(0);" onclick="abrir_soportes('archivos/<?php echo $archivos->RUTA_SOPORTE_ACTIVIDAD_PROMOCION ?>', 'Soporte del Registro <?php echo ($promocionInsumos->ID_ACTIVIDAD_PROMOCION); ?>.');"  >
                            <img src="imagenes/archivos/<?php echo $archivos->TIPO_SOPORTE_ACTIVIDAD_PROMOCION; ?>.png" />
                        </a>
                    </div>
                    <input type="hidden" name="archivo-asociado[]" value="<?php echo $archivos->ID_SOPORTE_ACTIVIDAD_PROMOCION ?>" />
                </div>
            </div>
            <?php
        endforeach;
    }
    ?>
</div>
</form>

<form class="dropzone form-inline"  >    
    <div class="form-group">
        <p class="help-block">Para agregar más archivos haga clic en el botón de abajo.</p>
    </div>
    <button id="btn_agergar_archivo" type="button" class="btn btn-success">        
        <span class="glyphicon glyphicon-plus"></span>Agregar Otro Archivo
    </button>
    <div id="pnl_cargar_archivos" >
        <em class="help-block">Todos los formatos son validos, excepto ejecutables (exe). El tamaño máximo permitido es de 8Mb</em>
        <div class="form-group">
            <label for="soporte_promocion_insumos-1">Soporte : </label>
            <input type="file" name="soporte_promocion_insumos[]" id="soporte_promocion_insumos-1" class="cargar_soporte"  /><button type="button" data-soporte="1" class="btn btn-danger btn_limpiar-archivo"><span class="glyphicon glyphicon-delete"></span></button>          
        </div>
    </div>
</form>

<script>
    var nArchivos = 1;
    $(document).ready(function() {

        $(".btn_limpiar-archivo").on("click", function() {
            var inpFile = $('#soporte_promocion_insumos-' + $(this).attr('data-soporte') + '');
            inpFile.closest('div').remove();
        });

        $("#btn_agergar_archivo").on("click", function() {
            nArchivos += 1;
            var newInpFile = '<div class="form-group">\n\
            <label for="soporte_promocion_insumos-' + nArchivos + '">Soporte : </label>\n\
            <input type="file" name="soporte_promocion_insumos[]" id="soporte_promocion_insumos-' + nArchivos + '" class="cargar_soporte" />\n\
            <button type="button" data-soporte="' + nArchivos + '" class="btn btn-danger btn_limpiar-archivo">\n\
                <span class="glyphicon glyphicon-delete"></span>\n\
            </button></div>';
            $('#pnl_cargar_archivos').append(newInpFile);
            $(".btn_limpiar-archivo").on("click", function() {
                var inpFile = $('#soporte_promocion_insumos-' + $(this).attr('data-soporte') + '');
                inpFile.closest('div').remove();
            });

        });
// $(".dropzone").dropzone();
//    
//  var myDropzone = new Dropzone(".dropzone");
//
//  myDropzone.on("addedfile", function(file) {
//    /* Maybe display some more file information on your page */
//    alert('cargado'+file.name);
//    var nombreArchivo = $('#subreceptor').val() + "_" + $('#usuario').val() + "_" + $('#fecha').val()+"_" ;
//    $('#dir_archivo_soporte').attr('value', nombreArchivo + file.name);
//  });
    });




</script>
