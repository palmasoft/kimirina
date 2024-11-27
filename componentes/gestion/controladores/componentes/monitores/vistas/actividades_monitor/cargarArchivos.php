
<form id="form_actividades_monitor_soportes" onsubmit="return false;"><div class="row-fluid">
        <?php
        if (!empty($datosActividad->SOPORTES)) {
            foreach ($datosActividad->SOPORTES as $archivos) :
                ?>
                <div class="span3" id="soporte_<?php echo intval($archivos->ID_SOPORTE_ACTIVIDAD_MONITOR) ?>">
                    <div class="block block-themed themed-default">
                        <div class="block-title">
                            <h4><a href="javascript:void(0);" class="btn btn-danger enable-tooltip" title="Eliminar Soporte" data-original-title="Eliminar" onclick="confirm('¿seguro que desea eliminar el archivo?', '$(\'#soporte_<?php echo intval($archivos->ID_SOPORTE_ACTIVIDAD_MONITOR) ?>\').remove();');" ><i class="icon-trash"></i></a> Archivo <?php echo intval($archivos->ID_SOPORTE_ACTIVIDAD_MONITOR) ?>: <?php echo $archivos->TIPO_SOPORTE_ACTIVIDAD_MONITOR ?></h4>
                        </div>
                        <div class="block-content full">
                            <a href="javascript:void(0);" onclick="abrir_soportes('archivos/<?php echo $archivos->RUTA_SOPORTE_ACTIVIDAD_MONITOR ?>', 'Soporte del Registro <?php echo ($datosActividad->ID_ACTIVIDADREALIZADA); ?>.');"  >
                                <img src="imagenes/archivos/<?php echo $archivos->TIPO_SOPORTE_ACTIVIDAD_MONITOR; ?>.png" />
                            </a>
                        </div>
                        <input type="hidden" name="archivo-asociado[]" value="<?php echo $archivos->ID_SOPORTE_ACTIVIDAD_MONITOR ?>" />
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
        <p class="help-block">para agregar mas archivo haga clic en el boton de abajo.</p>
        <button id="btn_agergar_archivo" type="button" class="btn btn-success">        
            <span class="glyphicon glyphicon-plus"></span>Agregar Otro Archivo
        </button>
    </div>

    <div id="pnl_cargar_archivos" >
        <em class="help-block">todos los formatos validos, excepto ejecutables (exe). El tamaño maximo permitido es de 8Mb</em>
        <div class="form-group">
            <label for="soporte_actividad_monitor-1">Soporte 1: </label>
            <input type="file" name="soporte_actividad_monitor[]" id="soporte_actividad_monitor-1" class="cargar_soporte"  /><button type="button" data-soporte="1" class="btn btn-danger btn_limpiar-archivo"><span class="glyphicon glyphicon-delete"></span></button>          
        </div>
    </div>
</form>


<script>
    var nArchivos = 1;
    $(document).ready(function() {

        $(".btn_limpiar-archivo").on("click", function() {
            var inpFile = $('#soporte_actividad_monitor-' + $(this).attr('data-soporte') + '');
            inpFile.closest('div').remove();
        });

        $("#btn_agergar_archivo").on("click", function() {
            nArchivos += 1;
            var newInpFile = '<div class="form-group">\n\
            <label for="soporte_actividad_monitor-' + nArchivos + '">Soporte ' + nArchivos + ': </label>\n\
            <input type="file" name="soporte_actividad_monitor[]" id="soporte_actividad_monitor-' + nArchivos + '" class="cargar_soporte" />\n\
            <button type="button" data-soporte="' + nArchivos + '" class="btn btn-danger btn_limpiar-archivo">\n\
                <span class="glyphicon glyphicon-delete"></span>\n\
            </button></div>';
            $('#pnl_cargar_archivos').append(newInpFile);
            $(".btn_limpiar-archivo").on("click", function() {
                var inpFile = $('#soporte_actividad_monitor-' + $(this).attr('data-soporte') + '');
                inpFile.closest('div').remove();
            });

        });

    });
</script>
