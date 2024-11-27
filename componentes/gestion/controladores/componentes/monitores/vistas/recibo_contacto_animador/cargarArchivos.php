
<div class="block block-themed block-last">
    <div class="block-title">
        <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Carga de Archivos"><i class="icon-arrow-up"></i></a>  Carga de Archivos de Soporte <small>para cargar los archivos escaneados de los formularios debe hacer clic en <strong>seleccionar archivo</strong> Abajo!</small></h4>
    </div>

    <div class="block-content ">

        <form id="form-recibo-contacto-soportes" onsubmit="return false;"><div class="row-fluid">
                <?php
                if (!empty($datosContactoAnimador->SOPORTES)) {
                    foreach ($datosContactoAnimador->SOPORTES as $archivos) :
                        ?>
                        <div class="span3" id="soporte_<?php echo intval($archivos->ID_SOPORTE_RECIBOCONTACTO) ?>">
                            <div class="block block-themed themed-default">
                                <div class="block-title">
                                    <h4><a href="javascript:void(0);" class="btn btn-danger enable-tooltip" title="Eliminar Soporte" data-original-title="Eliminar" onclick="confirm('¿seguro que desea eliminar el archivo?', '$(\'#soporte_<?php echo intval($archivos->ID_SOPORTE_RECIBOCONTACTO) ?>\').remove();');" ><i class="icon-trash"></i></a> Archivo <?php echo intval($archivos->ID_SOPORTE_RECIBOCONTACTO) ?>: <?php echo $archivos->TIPO_SOPORTE_RECIBOCONTACTO ?></h4>
                                </div>
                                <div class="block-content full">
                                    <a href="javascript:void(0);" onclick="abrir_soportes('archivos/<?php echo $archivos->RUTA_SOPORTE_RECIBOCONTACTO ?>', 'Soporte del Recibo <?php echo ($datosContactoAnimador->NO_RECIBO_CONTACTOANIMADOR); ?>.');"  >
                                        <img src="imagenes/archivos/<?php echo $archivos->TIPO_SOPORTE_RECIBOCONTACTO; ?>.png" />
                                    </a>
                                </div>
                                <input type="hidden" name="archivo-asociado[]" value="<?php echo $archivos->ID_SOPORTE_RECIBOCONTACTO ?>" />
                            </div>
                        </div>
                        <?php
                    endforeach;
                }
                ?>
            </div>
        </form>

        <form class="dropzone form-inline"  >     
            <div id="pnl_cargar_archivos" >
                <em class="help-block">todos los formatos validos, excepto ejecutables (exe). El tamaño maximo permitido es de 8Mb</em>
                <div class="form-group">
                    <label for="soporte_promotor-1">Soporte 1: </label>
                    <input type="file" name="soporte_animador[]" id="soporte_animador-1" class="cargar_soporte"  /><button type="button" data-soporte="1" class="btn btn-danger btn_limpiar-archivo"><span class="glyphicon glyphicon-delete"></span></button>          
                </div>
            </div>
            <div class="form-group">
                <p class="help-block">para agregar mas archivo haga clic en el boton de abajo.</p>
            </div>
            <button id="btn_agergar_archivo" type="button" class="btn btn-success">        
                <span class="glyphicon glyphicon-plus"></span>Agregar Otro Archivo
            </button>
        </form>

    </div>
</div>

<script>
    var nArchivos = 1;
    $(document).ready(function() {

        $(".btn_limpiar-archivo").on("click", function() {
            var inpFile = $('#soporte_animador-' + $(this).attr('data-soporte') + '');
            inpFile.closest('div').remove();
        });

        $("#btn_agergar_archivo").on("click", function() {
            nArchivos += 1;
            var newInpFile = '<div class="form-group">\n\
            <label for="soporte_animador-' + nArchivos + '">Soporte ' + nArchivos + ': </label>\n\
            <input type="file" name="soporte_animador[]" id="soporte_animador-' + nArchivos + '" class="cargar_soporte" />\n\
            <button type="button" data-soporte="' + nArchivos + '" class="btn btn-danger btn_limpiar-archivo">\n\
                <span class="glyphicon glyphicon-delete"></span>\n\
            </button></div>';
            $('#pnl_cargar_archivos').append(newInpFile);
            $(".btn_limpiar-archivo").on("click", function() {
                var inpFile = $('#soporte_animador-' + $(this).attr('data-soporte') + '');
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
