
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-notes_2 themed-color"></i>Hoja de Registro Semanal de Alcances <?php echo $tipoPoblacion; ?><br><small><?php echo $mensaje; ?></small></h1>
</div>
<!-- END Pre Page Content -->
<?php //print_r($this->datos) ?>
<!-- Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="250">
        <li>
            <a href="index.php"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:mostrar_registros_semanales_contacto();">Hojas de Registros Semanal</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Hoja de Registro Semanal de Alcances <?php echo $tipoPoblacion; ?></a></li>
    </ul>

    <?php $this->mostrar("registro_semanal_contactos/formCabecera", $this->datos); ?>    


    <div class="block block-themed ">
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Registro de Contactos"><i class="icon-arrow-up"></i></a>  Registros de PEMARs Alcanzados <small>aca se debe cliquear sobre el botón <code>Agregar</code> una vez confirme los datos a ingresar!</small></h4>
        </div>
        <div class="block-content text-center" style="padding: 0px;">    
            <?php $this->mostrar("registro_semanal_contactos/formNuevoContato", $this->datos); ?>            
        </div>
    </div>

    <?php $this->mostrar("registro_semanal_contactos/tablaContactos", $this->datos); ?>


    <div class="block block-themed ">
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Carga de Archivos"><i class="icon-arrow-up"></i></a>  Carga de Archivos de Soporte <small>para cargar los archivos escaneados de los formularios debe hacer clic en <strong>seleccionar archivo</strong> Abajo!</small></h4>
        </div>
        <div class="block-content ">
            <?php $this->mostrar("registro_semanal_contactos/cargarArchivos", $this->datos); ?>
        </div>
    </div>
    <div class="block block-themed block-last">
        <div class="form-actions" style="text-align: center;">
            <button id="btn_limpiar_registro_semanal_contactos" type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar </button>
            <button id="btn_guardar_registro_semanal_contactos" type="submit" class="btn btn-success"><i class="icon-ok"></i> Guardar Hoja / Formato </button>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {


        $('#form-registro-semanal-contactos').validate({
            submitHandler: function(form) {

                if (event.handled !== true) {

                    var nFilas = 0;

                    $("#form-datos-contacto-alcanzados tbody tr input[name='codigoAbordaje[]']").each(function() {
                        nFilas++;
                    });
                    if (estaVacio(nFilas)) {
                        alert('No exite ningun contacto agregado al Registro Semanal.');
                        return null;
                    }

                    if (estaVacio($('#sel-lista-cantones').val())) {
                        alert('Debes Seleccionar un cantón.');
                        return null;
                    }

                    if (estaVacio($('#promotor-formulario').val())) {
                        alert('Debes Seleccionar el PROMOTOR.');
                        return null;
                    }

                    var data = new FormData(document.getElementById('form-datos-contacto-alcanzados'));

                    var datosEnabezado = $('#form-registro-semanal-contactos').serializeArray();
                    $.each(datosEnabezado, function(i, field) {
                        data.append("" + field.name + "", "" + field.value + "");
                    });

                    var soportes = $('#form-registro-semanal-soportes').serializeArray();
                    $.each(soportes, function(i, field) {
                        data.append("" + field.name + "", "" + field.value + "");
                    });

                    var archivos = $(".cargar_soporte");
                    for (i = 0; i < archivos.length; i++) {
                        $.each($('.cargar_soporte')[i].files, function(k, file) {
                            data.append('soporte-' + (k + i), file);
                        });
                    }



                    if (estaVacio($('#registro-id').val())) {
                        ejecutarAccionJsonArchivos(
                                'monitores', 'registroSemanal', 'guardar_datos_nuevo_registro_semanal',
                                data, 'mostrar_resultado_guardar( data, "mostrar_registros_semanales_contacto();", "");'
                                );
                    } else {
                        ejecutarAccionJsonArchivos(
                                'monitores', 'registroSemanal', 'cambiar_formulario_registro_semanal',
                                data, 'mostrar_resultado_guardar( data, "mostrar_registros_semanales_contacto();", "");'
                                );
                    }



                    event.handled = true;
                }
                return false;
            }
        });

        $('#btn_guardar_registro_semanal_contactos').on('click', function(evt, params) {
            $('#form-registro-semanal-contactos').submit();
        });
        $('#btn_limpiar_registro_semanal_contactos').on('click', function(evt, params) {
            document.getElementById('form-registro-semanal-contactos').reset();
        });

    });


</script>
