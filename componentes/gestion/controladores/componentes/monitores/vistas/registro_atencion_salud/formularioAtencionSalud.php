<form id="form-registro-atencion" class="form-inline" onsubmit="return false;" >  

    <input type="hidden" id="registro-id" name="id_atencion_salud" value="<?php echo isset($registrosAtencion) ? ($registrosAtencion->ID_ATENCION_SALUD) : ''; ?>" />
    <input type="hidden" id="dir_archivo_soporte" name="dir_archivo_soporte" value="<?php echo isset($registrosAtencion) ? ($registrosAtencion->URL_DOC_ATENCION) : ''; ?>" />

    <div class="block block-themed ">
        <div class="block-title"><h4></h4></div>
        <div class="block-content">
            <div id="resp_validar_cedula" style="display: none;">
                <span></span>
            </div>

            <div class="control-group form-horizontal">
                <label for="fechaAtencion" class="control-label  "  >Fecha Atención: </label>
                <div class="controls"> 

                    <div class="input-prepend date " >
                        <span class="add-on"><i class="icon-calendar"></i></span>
                        <input type="text" value="<?php echo isset($registrosAtencion) ? ($registrosAtencion->FECHA_ATENCION) : ''; ?>" id="fechaAtencion" name="fechaAtencion" class="input-small input-datepicker-close">

                    </div>       
                    <div class="input-prepend bootstrap-timepicker" style="display: none;">
                        <span class="add-on"><i class="icon-time"></i></span>   
                        <input type="text" value="<?php echo isset($registrosAtencion) ? ($registrosAtencion->HORA_ATENCION) : ''; ?>" id="horaAtencion" name="horaAtencion" class="input-small input-timepicker">                                                                         
                    </div>


                </div>
            </div>

            <div class="control-group form-horizontal">
                <label class="control-label" for="horizontal-select">Centro de Salud</label>
                <div class="controls"> 
                    <select id="centroSalud" name="centroSalud"  class="select-chosen" >
                        <option value >Seleccione el Centro de Salud</option>
                        <?php foreach ($centrosSalud as $centro): ?>
                            <?php
                            $selected = "";
                            if (isset($registrosAtencion)) {
                                if ($centro->ID_CENTROSERVICIO == $registrosAtencion->ID_CENTROSERVICIO) {
                                    $selected = " selected ";
                                }
                            }
                            ?>
                            <option value="<?php echo $centro->ID_CENTROSERVICIO ?>" <?php echo $selected ?> ><?php echo ($centro->NOMBRE_CENTROSERVICIO) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- TIPO DE SERVICIO -->
            <div class="control-group form-horizontal">
                <label class="control-label" for="horizontal-select">Tipo de atencion</label>
                <div class="controls"> 
                    <select id="tipoServicio" name="tipoServicio"  class="select-chosen" >
                        <option value >Seleccione el tipo de servicio</option>
                        <?php foreach ($tiposServicio as $servicio): ?>
                            <?php
                            $selected = "";
                            if (isset($registrosAtencion)) {
                                if ($servicio->ID_SERVICIO == $registrosAtencion->ID_SERVICIO) {
                                    $selected = " selected ";
                                }
                            }
                            ?>
                            <option value="<?php echo $servicio->ID_SERVICIO ?>" <?php echo $selected ?> ><?php echo ($servicio->NOMBRE_SERVICIO) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="control-group form-horizontal">
                <label class="control-label" for="cedula">Cedula</label>
                <div class="controls">
                    <input type="text" id="cedula-atendido" name="cedula" value="<?php echo isset($registrosAtencion) ? ($registrosAtencion->CEDULA_PEMAR) : ''; ?>" 
                           maxlength="10"   placeholder="" class=" validar_cedula_codigo validar_cedula_sistema sinEspacio generadores-codigo" />
                    <label for="chk-cedula-verificada">                        
                        <input type="checkbox" id="chk-cedula-verificada" name="chk-cedula-verificada" class="input-themed" value="SI" > Verificada
                    </label>
                    <span class="help-block" id="img_consulta_registraduria" style="display: none;" >                        
                        <img src="imagenes/cargando_horizontal.gif" style="height: 32px;" /> estamos consultando el sitio web de la registraduria por usted. por favor, espere...
                    </span>

                </div>


            </div>

            <div class="control-group form-horizontal">
                <label class="control-label" for="codigoUnico">Codigo unico</label>
                <div class="controls">
                    <input type="text" id="codigo-pemar-generado" name="codigo-pemar" size="12" maxlength="12"  value="<?php echo isset($registrosAtencion) ? ($registrosAtencion->CODIGO_UNICO_PERSONA) : ''; ?>" required="" class="consulta_codigo" />
                </div>
            </div>

            <!-- NOMBRES y APELLIDOS -->
            <div class="control-group form-horizontal">
                <label class="control-label" for="nombreUno">Nombre(s) y Apellido(s) </label>
                <div class="controls">
                    <input type="text" id="primer-nombre" name="nombreUno" class="soloLetras generadores-codigo validar_cedula_codigo span3  mayusculas " 
                           value="<?php echo isset($registrosAtencion) ? ($registrosAtencion->PRIMER_NOMBRE_PEMAR) : ''; ?>" placeholder="Primer nombre"  />
                    <input type="text" id="segundo-nombre" name="nombreDos" class="soloLetras generadores-codigo validar_cedula_codigo span3 mayusculas " 
                           value="<?php echo isset($registrosAtencion) ? ($registrosAtencion->SEGUNDO_NOMBRE_PEMAR) : ''; ?>" placeholder="Segundo nombre"  />
                    <input type="text" id="primer-apellido" name="apellidoUno" class="soloLetras generadores-codigo validar_cedula_codigo span3  mayusculas" 
                           value="<?php echo isset($registrosAtencion) ? ($registrosAtencion->PRIMER_APELLIDO_PEMAR) : ''; ?>" placeholder="Primer Apellido"  />
                    <input type="text" id="segundo-apellido" name="apellidoDos" class="soloLetras generadores-codigo validar_cedula_codigo span3  mayusculas" 
                           value="<?php echo isset($registrosAtencion) ? ($registrosAtencion->SEGUNDO_APELLIDO_PEMAR) : ''; ?>" placeholder="Segundo Apellido"  />
                </div>

            </div>

            <div class="control-group form-horizontal">
                <label class="control-label">Fecha Nacimiento</label>
                <div class="controls "> 

                    <style>
                        .cambiar_tamaño1{
                            width: 15%!important;
                        }
                        .cambiar_tamaño2{
                            width: 10%!important;
                        }

                    </style>
                    <?php
                    $valor = 0;
                    if (isset($registrosAtencion)) {
                        $valor = $registrosAtencion->MES_NACIMIENTO_POBLACION;
                    }
                    $this->formularios->lista_mes('nacimiento', 'generadores-codigo cambiar_tamaño1 validar_cedula_codigo ', $valor);
                    ?>

                    <?php
                    $valor = 0;
                    if (isset($registrosAtencion)) {
                        $valor = $registrosAtencion->ANO_NACIMIENTO_POBLACION;
                    }
                    $this->formularios->lista_ano('nacimiento', 'generadores-codigo cambiar_tamaño1 validar_cedula_codigo ', $valor);
                    ?>
                </div>
            </div>

            <!-- SUBRECEPTOR -->
            <div class="control-group form-horizontal">
                <label class="control-label" for="subreceptor">Subreceptor</label>
                <div class="controls">
                    <select id="subreceptores" name="subreceptor" class="select-chosen " >
                        <option value >Seleccione un subreceptor</option>
                        <?php
                        foreach ($SubReceptores as $subreceptor) {
                            $selected = "";
                            if (isset($subreceptor)) {
                                if ($subreceptor->ID_SUBRECEPTOR == $SubReceptor->ID_SUBRECEPTOR) {
                                    $selected = " selected ";
                                }
                            }
                            ?>
                            <option value="<?php echo $subreceptor->ID_SUBRECEPTOR ?>"   <?php echo $selected; ?> ><?php echo ($subreceptor->SIGLAS_SUBRECEPTOR) ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <!-- TIPO PEMAR -->
            <div class="control-group form-horizontal">
                <label class="control-label" for="tiposPemars">Tipo Pemar</label>
                <div class="controls" id="lista_tipos_pob_subreceptor" >

                    <select id="tiposPemars" name="tiposPemars" class="select-chosen" size="1">
                        <option value="" >seleccione</option>
                        <?php
                        foreach ($tiposPemars as $tipoPemar) {
                            $selected = "";
                            if (isset($registrosAtencion)) {
                                if ($registrosAtencion->TIPO_FORMATO_ATENCION == $tipoPemar->CODIGO_TIPOPOBLACION) {
                                    $selected = "selected";
                                }
                            }
                            echo ('<option value="' . $tipoPemar->ID_TIPOPOBLACION . '" ' . $selected . ' >' . $tipoPemar->CODIGO_TIPOPOBLACION . '</option>');
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div id="consola"></div>
        </div>
    </div>

    <div class="block block-themed block-last">
        <div class="form-actions" style="text-align: center;">
            <button id="btn_validar_datos" type="button" class="btn btn-info"><i class="icon-check"></i> Validar </button>
            <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
            <button type="submit" id="btn_guardar_atencion_salud" class="btn btn-success" disabled="" ><i class="icon-ok"></i> Aceptar</button>
        </div>
    </div>

</form>

<div id="noEstaCodigoSimon" style="display: none" >
    <?php echo AlertasHTML5::informacion('EL CODIGO NO SE ENCUENTRA EN SIMON.') ?>
</div>
<div id="noEstaCedulaRegistraduria" style="display: none" >
    <?php echo AlertasHTML5::informacion('La cedula no se encuentra en la registraduria o el sitio web esta caido. Verifica que el sitio <a href="http://www.corporacionregistrocivil.gov.ec/" target="_blank" >http://www.corporacionregistrocivil.gov.ec/</a> este habilitado.'); ?>
</div>

<script>
    $(document).ready(function() {
//        var t = "<?php echo $periodoActual->FECHA_MIN_PERIODO ?> 00:00:00".split(/[- :]/);
//        var iniDate = new Date(t[0], t[1] - 1, t[2]);
//        iniDate.setDate(iniDate.getDate());

        t = "<?php echo $periodoActual->FECHA_MAX_PERIODO ?> 23:59:59".split(/[- :]/);
        var finDate = new Date(t[0], t[1] - 1, t[2]);
        finDate.setDate(finDate.getDate());
        var fechaAtencion = $('#fechaAtencion').datepicker({
//            minDate: iniDate,
            maxDate: finDate
        });
        $('.generadores-codigo').on('keyup', function(e) {
            activar_boton_formatos('btn_guardar_atencion_salud', 'false');
            codigoConsultaAtencionSaludSIMON();
        });
        $('.generadores-codigo').on('change', function(e) {
            activar_boton_formatos('btn_guardar_atencion_salud', 'false');
            codigoConsultaAtencionSaludSIMON();
        });
        $(".validar_cedula_codigo").on('change', function(e) {
            activar_boton_formatos('btn_agregar_contacto_tabla', 'false');
            e.preventDefault();
        });
        $('.validar_cedula_sistema').on('change', function(e) {
            activar_boton_formatos('btn_guardar_atencion_salud', 'false');
            buscar_pemar_cedula();
        });
        $('.consulta_codigo').on('change', function(e) {
            activar_boton_formatos('btn_guardar_atencion_salud', 'false');
            buscar_pemar_codigo();
        });
        $('#subreceptores').on('change', function(e) {
            ejecutarAccion(
                    'sistema', 'subreceptores', 'lista_tipos_poblacion',
                    'id_subreceptor=' + $(this).val() + '&id_lista=tiposPemars', '$("#lista_tipos_pob_subreceptor").html(data);'
                    );
        });
    });

    function codigoConsultaAtencionSaludSIMON() {

        var codAntes = $('#codigo-pemar-generado').val();
        var codP = generarCodigoUnicoPemar(
                $('#primer-nombre').val(), $('#segundo-nombre').val(),
                $('#primer-apellido').val(), $('#segundo-apellido').val(),
                $('#mes-nacimiento').val(), $('#ano-nacimiento').val()
                );

        if (!estaVacio(codAntes)) {
            if (codAntes == codP) {
                $('#codigo-pemar-generado').attr('value', codP.toString());
            } else {
                $('#codigo-pemar-generado').attr('value', codAntes.toString());
            }
        } else {
            $('#codigo-pemar-generado').attr('value', codP.toString());
        }
    }
    function generarCodigo() {

        activar_boton_formatos('btn_guardar_atencion_salud', 'false');
        var cedPemar = $('#cedula-atendido').val();
        var codP = generarCodigoUnicoPemar(
                $('#primer-nombre').val(), $('#segundo-nombre').val(),
                $('#primer-apellido').val(), $('#segundo-apellido').val(),
                $('#mes-nacimiento').val(), $('#ano-nacimiento').val()
                );
        $('#codigo-pemar-generado').attr('value', codP.toString());
        var codPemar = codP;
        if (estaVacio($('#primer-nombre').val()) && estaVacio($('#segundo-nombre').val()) && estaVacio($('#primer-apellido').val()) && estaVacio($('#segundo-apellido').val())) {
            if (estaVacio(cedPemar)) {
                codPemar = '';
            } else {
                if (estaVacio($('#ano-nacimiento').val()) && estaVacio($('#mes-nacimiento').val())) {
                    codPemar = '';
                }
            }
        } else if (estaVacio($('#ano-nacimiento').val()) || estaVacio($('#mes-nacimiento').val())) {
            if (!estaVacio($('#primer-nombre').val()) || !estaVacio($('#segundo-nombre').val()) || !estaVacio($('#primer-apellido').val()) || !estaVacio($('#segundo-apellido').val())) {
                codPemar = '';
            }
        }

        if (!estaVacio(codPemar)) {
            avisos_valida_cedula_codigo(cedPemar, codPemar, 'resp_validar_cedula');
            activar_boton_formatos('btn_guardar_atencion_salud', 'true');
        }
        //esValidaCedulaCodigo(cedPemar, codPemar, "activar_boton_formatos( 'btn_guardar_atencion_salud', data);");
    }
    function buscar_pemar_codigo() {
        var cod_pemars = $('#codigo-pemar-generado').val();
        ejecutarAccionJson(
                'sistema', 'pemars', 'datos_pemar_codigo_json', 'codido_pemar=' + cod_pemars,
                'mostrar_datos_sistema_pemar( data );'
                );
    }
    function buscar_pemar_cedula() {
        var ced_pemars = $('#cedula-atendido').val();
        $('#consola').html('');
        if (!estaVacio(ced_pemars)) {
            ejecutarAccionJson(
                    'sistema', 'pemars', 'datos_pemar_cedula_json', 'cedula_pemar=' + ced_pemars,
                    'mostrar_consulta_cedula_pemar( data );'
                    );
        }
    }

    function mostrar_consulta_cedula_pemar(data) {
        if (!$.isEmptyObject(data)) {
            if (data === 0) {
                construir_codigo_desde_registraduria();
            } else {
                mostrar_datos_sistema_pemar(data);
            }
        } else {
            construir_codigo_desde_registraduria();
        }
    }
    function mostrar_datos_sistema_pemar(data) {
        if (!$.isEmptyObject(data) && !estaVacio(data.ANO_NACIMIENTO_POBLACION)) {

            $('#primer-nombre').val(data.NOMBRE_UNO_POBLACION);
            $('#segundo-nombre').val(data.NOMBRE_DOS_POBLACION);
            $('#primer-apellido').val(data.APELLIDO_UNO_POBLACION);
            $('#segundo-apellido').val(data.APELLIDO_DOS_POBLACION);
            $('#cedula-atendido').val(data.CI_POBLACION);
            $('#ano-nacimiento').val(data.ANO_NACIMIENTO_POBLACION);
            $('#mes-nacimiento').val(data.MES_NACIMIENTO_POBLACION);
            generarCodigo();
        } else {
            $('#resp_validar_cedula span').html($('#noEstaCodigoSimon').html());
            $('#resp_validar_cedula').slideDown();
        }

    }
    function construir_codigo_desde_registraduria() {
        $('#img_consulta_registraduria').show();
        $.ajax({
            async: true,
            cache: false,
            url: "tools/hack-registraduria/consultar_sitio.php",
            dataType: "html",
            data: {
            },
            success: function(response) {
                var cedula = $('#cedula-atendido').val();
                var valCodigoAcceso = $(response).find('input');
                var codAcceso = $(valCodigoAcceso[1]).val();
                $('#consola').html('');
                //$('#consola').html( '<p>Codigo de Acceso Obtenido: => ' + codAcceso + '</p>' );
                $.ajax({
                    url: "tools/hack-registraduria/consultar_datos.php",
                    dataType: "html",
                    data: {
                        codAcceso: codAcceso,
                        cedula: cedula
                    },
                    success: function(response) {
                        var tblDatos = $(response).find('#container table');
                        var filasTbl = $(tblDatos[1]).find('tr');
                        if (filasTbl.length > 1) {
                            var datosTbl = $(filasTbl[1]).find('td');
                            //$('#consola').append('<hr />');
                            var cedulaResultado = $(datosTbl[0]).text();
                            var nombreResultado = $(datosTbl[1]).html();
                            var parte_nombres = $(nombreResultado).text().split(" ");
                            var nacimientoResultado = $(datosTbl[2]).text();
                            var fecha = $(datosTbl[2]).text().split('/');
                            var condicionResultado = $(datosTbl[3]).text();
                            var estadoResultado = $(datosTbl[4]).text();
                            var conyugeResultado = $(datosTbl[5]).text();
                            $('#primer-nombre').val(parte_nombres[2]);
                            $('#segundo-nombre').val(parte_nombres[3]);
                            $('#primer-apellido').val(parte_nombres[0]);
                            $('#segundo-apellido').val(parte_nombres[1]);
                            $('#ano-nacimiento').val(fecha[0]);
                            $('#mes-nacimiento').val(fecha[1]);
                            generarCodigo();
                        } else {
                            $('#resp_validar_cedula span').html($('#noEstaCedulaRegistraduria').html());
                            $('#resp_validar_cedula').slideDown();
                        }
                        $('#img_consulta_registraduria').fadeOut();
                        $('#loaderImage').fadeOut();
                        $('#consola').slideDown('2000');
                    }
                });
            }
        });
    }

    function validarDatosAtencionSalud() {
        if (estaVacio($('#fechaAtencion').val())) {
            alert('Digite la fecha de Atención');
            return false;
        }

        if (estaVacio($('#centroSalud').val())) {
            alert('Seleccione el Centro donde recibe la Atencion.');
            return false;
        }

        if (estaVacio($('#tiposPemars').val())) {
            alert('Seleccion el Tipo de Poblacion del Atendido');
            return false;
        }

        if (estaVacio($('#tipoServicio').val())) {
            alert('Seleccione le Servicio de Salud prestado.');
            return false;
        }

        if (estaVacio($('#subreceptores').val())) {
            alert('Seleccione el Subreceptor relacionado a la Atencion.');
            return false;
        }

        if (estaVacio($('#tiposPemars').val())) {
            alert('Seleccione el Subreceptor relacionado a la Atencion.');
            return false;
        }

        return true;
    }


</script>