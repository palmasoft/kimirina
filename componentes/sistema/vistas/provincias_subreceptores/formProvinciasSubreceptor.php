<div id="pre-page-content">
    <h1>
        <i class="glyphicon-user themed-color"></i> Provincias Asociadas al Subreceptor <?php echo $Subreceptor->NOMBRE_SUBRECEPTOR ?><br>
        <small>Seleccione las provincias que desee asociar al subreceptor.</small>
    </h1>
</div>

<div id="page-content">
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Listado Subreceptores en Provincias</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">Provincias Asociadas</a></li>
    </ul>

    <div class="block-section">
        <form id="form-provincias-subreceptor"  class="form-inline" onsubmit="return false;" >
            <input type="hidden" id="idSubreceptor" name="idSubreceptor" value="<?php echo isset($Subreceptor) ? ($Subreceptor->ID_SUBRECEPTOR) : ''; ?>"/> 
            <table id="formularios-datatables" class="table table-bordered table-hover ">
                <thead>
                    <tr>
                        <th class=" text-center">NOMBRE PROVINCIA</th>
                        <th class=" text-center"><input type="checkbox" id="provincias_subrecptor-todos" name="provincias_subrecptor-todos" class="input-themed" value="TODOS" /></th>                    
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($Provincias as $provincia) {
                        $checked = '';
                        foreach ($provinciasSubreceptor as $provAsociada) {
                            if ($provincia->ID_PROVINCIA == $provAsociada->ID_PROVINCIA) {
                                $checked = ' checked="" ';
                            }
                        }
                        ?>
                        <tr>
                            <td class="text-center "><?php echo ($provincia->NOMBRE_PROVINCIA) ?></td>
                            <td class="text-center "><input <?php echo $checked; ?> type="checkbox" id="provincias_subrecptor" name="provincias_subrecptor[]" class="input-themed check" value="<?php echo $provincia->ID_PROVINCIA ?>" /></td>                   
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="form-actions text-center">
                <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
                <button type="submit" class="btn btn-success"><i class="icon-save"></i> Guardar</button>
            </div>
        </form>
    </div>
</div>



<script>
    $(document).ready(function() {
        var checkAll = $('#provincias_subrecptor-todos');
        var checkboxes = $('input.check');
        checkAll.on('ifChecked ifUnchecked', function(event) {
            if (event.type == 'ifChecked') {
                checkboxes.iCheck('check');
            } else {
                checkboxes.iCheck('uncheck');
            }
        });
        checkboxes.on('ifChanged', function(event) {
            if (checkboxes.filter(':checked').length == checkboxes.length) {
                checkAll.prop('checked', 'checked');
            } else {
                checkAll.removeProp('checked');
            }
            checkAll.iCheck('update');
        });

        $('#form-provincias-subreceptor').submit(function(e) {
            var datos = $(this).serialize();
            cambiar_provincias_subreceptor(datos);
        });

    });

    function cambiar_provincias_subreceptor(datos) {

        ejecutarAccionJson(
                'sistema', 'subreceptoresProvincias', 'guardar_cambios_provincias_subreceptor', datos,
                ' mostrar_resultado_guardar( data, "tabla_subreceptor_provincia();") '
                );

    }
</script>
<script>
    agregar_boton_ayuda('CAMBIARPROVINCIASUBRE');
</script>
