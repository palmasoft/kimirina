<form id="form-registro-semanal-contactos" method="post" class="form-inline" onsubmit="return false;">  
    <input type="hidden" name="tipo_poblacion" value="<?php echo $idTipoPoblacion; ?>" />
    <input type="hidden" name="cod_poblacion" value="<?php echo $tipoPoblacion; ?>" />
    <input type="hidden" name="registro-id" id="registro-id" value="<?php echo isset($datosRegistroSemanal) ? $datosRegistroSemanal->ID_REGISTROSEMANAL : "" ?>" />
    <input type="hidden" id="dir_archivo_soporte"  name="dir_archivo_soporte" value="" />
    <center> 
        <h2>HOJA DE REGISTRO SEMANAL DE ALCANCES <?php echo $tipoPoblacion; ?></h2>
        <h4>PERIODO / MES: <?php $this->formularios->lista_periodos('contactos', ' periodos '); ?></h4>
        <h5>Población <?php echo $tipoPoblacion; ?></h5>
    </center>

    <div class="block block-themed block-last"> 
        <div class="block block-themed ">
            <div class="block-title">
                <h4>
                    <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                    Supervision y Control
                </h4>
            </div>
            <div class="block-content">
                <div class="control-group inline" >
                    <label class="control-label" >Razones de Modificacion</label>
                    <div class="controls">
                        <textarea id="razones_registro_semanal_contacto" name="razones_registro_semanal_contacto" class="span12"  rows="4" required=""></textarea>
                    </div>     
                </div>
            </div>
        </div>
    </div>
    <!-- General Forms Block -->
    <div class="block block-themed block-last">
        <!-- General Forms Title -->
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  Datos Generales del Formulario</h4>
            <div class="block-options">
                <div class="input-prepend" style="float: right;margin: 5px 10px;" >
                    <a href="javascript:void(0)" data-toggle="tooltip" title="clic para generar el CODIGO" class="btn btn-lg btn-info"># SEGUIMIENTO <i class="glyphicon-magic"></i></a>           
                    <input type="text" id="codigo-formulario" name="codigo-formulario" 
                           placeholder="generado despues de guardar" value="<?php echo isset($datosRegistroSemanal) ? $datosRegistroSemanal->NUM_REGISTROSEMANAL : "" ?>" readonly >                     
                </div>
            </div>            
        </div>

        <div class="block-content">        
            <div class="row-fluid">
                <div class="span6">
                    <div class="control-group">
                        <label class="control-label">Provincia</label>
                        <div id="lista-provincia" class="controls">
                            <select id="provincia-chosen" name="provincia-chosen" class="select-chosen focused span12" >
                                <option value >seleccione la provincia</option>
                                <?php
                                foreach ($provincias as $provincia) {
                                    $selected = "";
                                    if (isset($datosRegistroSemanal))
                                        if ($provincia->ID_PROVINCIA == $datosRegistroSemanal->ID_PROVINCIA)
                                            $selected = " selected ";
                                    ?>
                                    <option value="<?php echo $provincia->ID_PROVINCIA ?>"   <?php echo $selected; ?> ><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="span6">
                    <div class="control-group">
                        <label class="control-label">Cantón</label>
                        <div id="listado-cantones" class="controls">
                            <select id="sel-lista-cantones" name="sel-lista-cantones" class="select-chosen "  style="width: 100%;" >
                                <option value >seleccione el canton</option>
                                <?php
                                foreach ($cantones as $canton) {
                                    $selected = "";
                                    if (isset($datosRegistroSemanal))
                                        if ($canton->ID_CANTON == $datosRegistroSemanal->ID_CANTON)
                                            $selected = " selected ";
                                    ?>
                                    <option value="<?php echo $canton->ID_CANTON ?>"   <?php echo $selected; ?> ><?php echo ($canton->NOMBRE_CANTON) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row-fluid">  

                <div class="span3">
                    <div class="control-group">
                        <label class="control-label">Semana del </label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-calendar"></i></span>
                                <input type="text" id="fecha_contacto_inicio_semana" name="fecha_contacto_inicio_semana" class="input-datepicker span9"
                                       value="<?php echo isset($datosRegistroSemanal) ? $datosRegistroSemanal->SEMANA_DEL : $periodoActual->FECHA_MIN_PERIODO ?>" required=""   >                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span3" style="margin-left: 0px;">
                    <div class="control-group">
                        <label class="control-label">al </label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-calendar"></i></span>
                                <input type="text" id="fecha_contacto_fin_semana" name="fecha_contacto_fin_semana" class="input-datepicker span9" 
                                       value="<?php echo isset($datosRegistroSemanal) ? $datosRegistroSemanal->SEMANA_HASTA : $periodoActual->FECHA_MAX_PERIODO ?>" required=""  >                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span3">
                    <div class="control-group">
                        <label class="control-label">Nombre del Promotor</label>
                        <div class="controls">
                            <select id="promotor-formulario" name="promotor-formulario" class="select-chosen" style="width: 100%;" >
                                <option value >seleccione el promotor</option>
                                <?php
                                foreach ($Promotores as $promotor) {
                                    $selected = "";
                                    if (isset($datosRegistroSemanal))
                                        if ($promotor->ID_PERSONA == $datosRegistroSemanal->ID_PROMOTOR)
                                            $selected = " selected ";
                                    ?>
                                    <option data-alias="<?php echo $promotor->NOMBRE_OTRO_PERSONA ?>"  <?php echo $selected; ?>
                                            data-nombre-alias="<?php echo $promotor->ALIAS_TIPOPOBLACION ?>" 
                                            data-codigo-tipo="<?php echo $promotor->CODIGO_TIPOPOBLACION ?>" 
                                            value="<?php echo $promotor->ID_PERSONA ?>"><?php echo ($promotor->NOMBRE_REAL_PERSONA) ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                    </div>                            
                </div>
                <div class="span3">
                    <div class="control-group">
                        <label id="alias-nombre-pep" class="control-label"><?php echo isset($datosRegistroSemanal) ? $datosRegistroSemanal->ALIAS_POB_LLENA : "Segundo Nombre " ?></label>
                        <div class="controls">
                            <input type="text" id="alias-pep" name="alias-pep" class="input-large "  style="width: 100%;" 
                                   value="<?php echo isset($datosRegistroSemanal) ? $datosRegistroSemanal->NOMBRE_OTRO_PERSONA : "Segundo Nombre " ?>" placeholder="otro nombre" readonly>
                        </div>
                    </div>                            
                </div>
            </div>
        </div>

        <div class="form-actions" style="text-align: center;">
            <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar </button>
            <button id="btn_guardar_registro_semanal_contactos" type="submit" class="btn btn-success"><i class="icon-ok"></i> Guardar Hoja / Formato </button>
        </div>

    </div>

    <div id="div-resultado" ></div>
</form>


<script >

    $(document).ready(function() {


        var t = "<?php echo $periodoActual->FECHA_MIN_PERIODO ?> 23:59:59".split(/[- :]/);
        var iniDate = new Date(t[0], t[1] - 1, t[2]);
        iniDate.setDate(iniDate.getDate() + 1);

        t = "<?php echo $periodoActual->FECHA_MAX_PERIODO ?> 23:59:59".split(/[- :]/);
        var finDate = new Date(t[0], t[1] - 1, t[2]);
        finDate.setDate(finDate.getDate() + 1);


        var fechaInicioSemana = $('#fecha_contacto_inicio_semana').datepicker({
            format: 'yyyy-mm-dd',
            onRender: function(date) {
                if (date.valueOf() < iniDate.valueOf())
                    return 'disabled';
                if (date.valueOf() > finDate.valueOf())
                    return 'disabled';
                return '';
            }
        }).on('changeDate', function(ev) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate());
            fechaAbordajeSemana.setValue(newDate);


            fechaInicioSemana.hide();
            $('#fecha-abordaje-contacto').datepicker();
            $('#fecha_contacto_fin_semana')[0].focus();
        }).data('datepicker');

        var fechaFinSemana = $('#fecha_contacto_fin_semana').datepicker({
            format: 'yyyy-mm-dd',
            onRender: function(date) {
                if (date.valueOf() < iniDate.valueOf())
                    return 'disabled';
                if (date.valueOf() > finDate.valueOf())
                    return 'disabled';
                return '';
            }
        }).on('changeDate', function(ev) {
            var newDate = new Date(ev.date);


            $('#fecha_contacto_fin_semana').data('datepicker').hide();
        }).data('datepicker');

        var fechaAbordajeSemana = $('#fecha-abordaje-contacto').datepicker({
            format: 'yyyy-mm-dd',
            onRender: function(date) {
                if (date.valueOf() < iniDate.valueOf())
                    return 'disabled';
                if (date.valueOf() > finDate.valueOf())
                    return 'disabled';
                return '';
            }
        }).on('changeDate', function(ev) {
            $('#fecha-abordaje-contacto').data('datepicker').hide();
        }).data('datepicker');



        //$('#provincia-chosen').on('change', function(evt, params) {
        //  cargar_cantones('listado-cantones', 'sel-lista-cantones', $(this).val());
        ///});


        $('#promotor-formulario').on('change', function(evt, params) {
            var miValue = $(this).val();
            if (miValue > 0) {
                $('#alias-pep').attr('value', $("#promotor-formulario option[value=" + miValue + "]").attr('data-alias'));
                $('#alias-nombre-pep').html($("#promotor-formulario option[value=" + miValue + "]").attr('data-nombre-alias'));
                $('#tipo-poblacion-pep').html($("#promotor-formulario option[value=" + miValue + "]").attr('data-codigo-tipo'));
            }
        });






        $('#form-registro-semanal-contactos').submit(function(event) {

            if (event.handled !== true) {

                var nFilas = 0;

                $("#form-datos-contacto-alcanzados tbody tr input[name='codigoAbordaje[]']").each(function() {
                    nFilas++;
                });
                if (estaVacio(nFilas)) {
                    alert('No exite ningun contacto agregado al Registro Semanal.');
                    return null;
                }

                if ($('#sel-lista-cantones').val() == '') {
                    alert('Debes Seleccionar un cantón.');
                    return null;
                }

                if ($('#promotor-formulario').val() == '') {
                    alert('Debes Seleccionar el PROMOTOR.');
                    return null;
                }

                var datosGenerales = $(this).serialize();
                var datosContactos = $('#form-datos-contacto-alcanzados').serialize();
                var datosTema = datosGenerales + "&" + datosContactos;

                if (estaVacio($('#registro-id').val())) {
//                    ejecutarAccionJson(
//                       'monitores', 'registroSemanal', 'guardar_formulario_registro_semanal',  
//                       datosTema, ' mostrar_resultado_guardar( data, "mostrar_registros_semanales_contacto();", "");'
//                   );   
                } else {
                    ejecutarAccionJson(
                            'supervision', 'auditoriaFormularios', 'cambiar_formulario_registro_semanal_aprobado',
                            datosTema, ' mostrar_resultado_guardar( data, "mostrar_lista_aprobados_registro_semanal();", "");'
                            );
                }



                event.handled = true;
            }
            return false;


        });
    });
</script>

