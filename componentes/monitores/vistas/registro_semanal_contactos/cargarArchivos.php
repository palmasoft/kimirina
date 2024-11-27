
<form id="form-registro-semanal-soportes" onsubmit="return false;">
    <div class="row-fluid">
        <?php
        if (!empty($datosRegistroSemanal->SOPORTES)) {
            foreach ($datosRegistroSemanal->SOPORTES as $archivos):
                ?>
                <div class="span3" id="soporte_<?php echo intval($archivos->ID_SOPORTE_REGISTROSEMANAL) ?>">
                    <div class="block block-themed themed-default">
                        <div class="block-title">
                            <h4><a href="javascript:void(0);" class="btn btn-danger enable-tooltip" title="Eliminar Soporte" data-original-title="Eliminar" 
                                   onclick="confirm('¿seguro que desea <strong>eliminar</strong> el archivo cargado para esta Hoja?', '$(\'#soporte_<?php echo intval($archivos->ID_SOPORTE_REGISTROSEMANAL) ?>\').remove();');" ><i class="icon-trash"></i></a> <?php echo basename( $archivos->RUTA_SOPORTE_REGISTROSEMANAL ) ?></h4>
                        </div>
                        <div class="block-content full">
                            <a href="javascript:void(0);" onclick="abrir_soportes('archivos/<?php echo $archivos->RUTA_SOPORTE_REGISTROSEMANAL ?>', 'Soporte del Registro <?php echo ($datosRegistroSemanal->NUM_REGISTROSEMANAL); ?>.');"  >
                                <img src="imagenes/archivos/<?php echo $archivos->TIPO_SOPORTE_REGISTROSEMANAL; ?>.png" />
                            </a>
                        </div>
                        <input type="hidden" name="archivo-asociado[]" value="<?php echo $archivos->ID_SOPORTE_REGISTROSEMANAL ?>" />
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
            <label for="soporte_promotor-1">Soporte 1: </label>
            <input type="file" name="soporte_promotor[]" id="soporte_promotor-1" class="cargar_soporte"  /><button type="button" data-soporte="1" class="btn btn-danger btn_limpiar-archivo"><span class="glyphicon glyphicon-delete"></span></button>          
        </div>
    </div>
</form>


<script>
    var nArchivos = 1;
    $(document).ready(function() {

        $(".btn_limpiar-archivo").on("click", function() {
            var inpFile = $('#soporte_promotor-' + $(this).attr('data-soporte') + '');
            inpFile.closest('div').remove();
        });

        $("#btn_agergar_archivo").on("click", function() {
            nArchivos += 1;
            var newInpFile = '<div class="form-group">\n\
            <label for="soporte_promotor-' + nArchivos + '">Soporte ' + nArchivos + ': </label>\n\
            <input type="file" name="soporte_promotor[]" id="soporte_promotor-' + nArchivos + '" class="cargar_soporte" />\n\
            <button type="button" data-soporte="' + nArchivos + '" class="btn btn-danger btn_limpiar-archivo">\n\
                <span class="glyphicon glyphicon-delete"></span>\n\
            </button></div>';
            $('#pnl_cargar_archivos').append(newInpFile);
            $(".btn_limpiar-archivo").on("click", function() {
                var inpFile = $('#soporte_promotor-' + $(this).attr('data-soporte') + '');
                inpFile.closest('div').remove();
            });

        });

    });




</script>
