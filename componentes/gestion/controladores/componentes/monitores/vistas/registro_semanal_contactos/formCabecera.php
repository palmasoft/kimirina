<form id="form-registro-semanal-contactos" method="post" class="form-inline" onsubmit="return false;">  
    <input type="hidden" name="tipo_poblacion" value="<?php echo $idTipoPoblacion; ?>" />
    <input type="hidden" name="cod_poblacion" value="<?php echo $tipoPoblacion; ?>" />
    <input type="hidden" name="registro-id" id="registro-id" value="<?php echo isset($datosRegistroSemanal) ? $datosRegistroSemanal->ID_REGISTROSEMANAL : "" ?>" />
    <input type="hidden" id="dir_archivo_soporte"  name="dir_archivo_soporte" value="" />
    <div style="text-align: center;"> 
        <h4>PERIODO / MES: <?php $this->formularios->lista_periodos('contactos', ' periodos '); ?></h4>
    </div>

    <!-- General Forms Block -->
    <div class="block block-themed">
        <!-- General Forms Title -->
        <div class="block-title">
            <h4><a href="javascript:void(0);" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  Datos Generales del Formulario</h4>
            <div class="block-options">
                <div class="input-prepend" style="float: right;margin: 5px 10px;" >
                    <a href="javascript:void(0);" data-toggle="tooltip" title="clic para generar el CODIGO" class="btn btn-lg btn-info"># <i class="glyphicon-magic"></i></a>           
                    <input type="text" id="codigo-formulario" name="codigo-formulario" 
                           placeholder="generado despues de guardar" value="<?php echo isset($datosRegistroSemanal) ? $datosRegistroSemanal->NUM_REGISTROSEMANAL : "" ?>" readonly="" />                     
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
                                <option value="" >seleccione la provincia</option>
                                <?php
                                foreach ($provincias as $provincia) {
                                    $selected = "";
                                    if (isset($datosRegistroSemanal)) {
                                        if ($provincia->ID_PROVINCIA == $datosRegistroSemanal->ID_PROVINCIA) {
                                            $selected = " selected ";
                                        }
                                    }
                                    ?>
                                    <option value="<?php echo $provincia->ID_PROVINCIA ?>" <?php echo $selected; ?> ><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
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
                                <option value="" >seleccione el canton</option>
                                <?php
                                foreach ($cantones as $canton) {
                                    $selected = "";
                                    if (isset($datosRegistroSemanal)) {
                                        if ($canton->ID_CANTON == $datosRegistroSemanal->ID_CANTON) {
                                            $selected = " selected ";
                                        }
                                    }
                                    ?>
                                    <option value="<?php echo $canton->ID_CANTON ?>"   <?php echo $selected; ?> ><?php echo ($canton->NOMBRE_CANTON) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row-fluid">  

                <div class="span4">
                    <div class="control-group">
                        <label class="control-label">Semana del </label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-calendar"></i></span>
                                <input type="text" id="fecha_contacto_inicio_semana" name="fecha_contacto_inicio_semana" class="input-datepicker span10"
                                       value="<?php echo isset($datosRegistroSemanal) ? $datosRegistroSemanal->SEMANA_DEL : $periodoActual->FECHA_MIN_PERIODO ?>" required=""   >                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span4" style="margin-left: 0px;">
                    <div class="control-group">
                        <label class="control-label">al </label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-calendar"></i></span>
                                <input type="text" id="fecha_contacto_fin_semana" name="fecha_contacto_fin_semana" class="input-datepicker span10" 
                                       value="<?php echo isset($datosRegistroSemanal) ? $datosRegistroSemanal->SEMANA_HASTA : $periodoActual->FECHA_MAX_PERIODO ?>" required=""  >                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div class="control-group">
                        <label class="control-label">Nombre del Promotor</label>
                        <div class="controls">
                            <select id="promotor-formulario" name="promotor-formulario" class="select-chosen span12" style="width: 100%;" >
                                <option value >seleccione el promotor</option>
                                <?php
                                foreach ($Promotores as $promotor) {
                                    $selected = "";
                                    if (isset($datosRegistroSemanal)) {
                                        if ($promotor->ID_PERSONA == $datosRegistroSemanal->ID_PROMOTOR) {
                                            $selected = " selected ";
                                        }
                                    }
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
                <div class="span3" style="display: none;">
                    <div class="control-group">
                        <label id="alias-nombre-pep" class="control-label"><?php echo isset($datosRegistroSemanal) ? $datosRegistroSemanal->ALIAS_POB_LLENA : "Segundo Nombre " ?></label>
                        <div class="controls">
                            <input type="text" id="alias-pep" name="alias-pep soloLetras" class="input-large "  style="width: 100%;" 
                                   value="<?php echo isset($datosRegistroSemanal) ? $datosRegistroSemanal->NOMBRE_OTRO_PERSONA : "Segundo Nombre " ?>" placeholder="otro nombre" readonly>
                        </div>
                    </div>                            
                </div>
            </div>
        </div>


    </div>

    <div id="div-resultado" ></div>
</form>


<script >

    $(document).ready(function() {
        var t = "<?php echo isset($datosRegistroSemanal) ? $datosRegistroSemanal->SEMANA_DEL : $periodoActual->FECHA_MIN_PERIODO ?> 00:00:00".split(/[- :]/);
        var iniDate = new Date(t[0], t[1] - 1, t[2]);
        iniDate.setDate(iniDate.getDate());

        t = "<?php echo isset($datosRegistroSemanal) ? $datosRegistroSemanal->SEMANA_HASTA : $periodoActual->FECHA_MAX_PERIODO ?> 23:59:59".split(/[- :]/);
        var finDate = new Date(t[0], t[1] - 1, t[2]);
        finDate.setDate(finDate.getDate());

        $('#fecha_contacto_inicio_semana').datepicker({
            minDate: iniDate,
            maxDate: finDate,
            onClose: function(selectedDate) {
                $("#fecha_contacto_fin_semana").datepicker("option", "minDate", selectedDate);
                $("#fecha-abordaje-contacto").datepicker("option", "minDate", selectedDate);
            }
        });

        $('#fecha_contacto_fin_semana').datepicker({
            minDate: iniDate,
            maxDate: finDate,
            onClose: function(selectedDate) {
                $("#fecha-abordaje-contacto").datepicker("option", "maxDate", selectedDate);
            }
        });

        $('#fecha-abordaje-contacto').datepicker({
            minDate: iniDate,
            maxDate: finDate
        });


        $('#promotor-formulario').on('change', function(evt, params) {
            var miValue = $(this).val();
            if (miValue > 0) {
                $('#alias-pep').attr('value', $("#promotor-formulario option[value=" + miValue + "]").attr('data-alias'));
                $('#alias-nombre-pep').html($("#promotor-formulario option[value=" + miValue + "]").attr('data-nombre-alias'));
                $('#tipo-poblacion-pep').html($("#promotor-formulario option[value=" + miValue + "]").attr('data-codigo-tipo'));
            }
        });


        $('#provincia-chosen').on('change', function(evt, params) {
            cargar_cantones_cServicio_semanal_contacto('listado-cantones', 'sel-lista-cantones', $(this).val());
            cargar_lugar_de_intervencion();
            cargar_centros_de_salud();
        });


    });
    function cargar_cantones_cServicio_semanal_contacto(idContendorLista, idLista, idProvincia) {
        ejecutarAccionSinBloqueo(
                "sistema", "ubicacion", "lista_seleccion_cantones", "id_provincia=" + idProvincia + "&id_lista=" + idLista,
                "$('#" + idContendorLista + "').html(data); $('#" + idLista + "').chosen({no_results_text: 'Oops, no se encontró!'}); " +
                "$('#" + idLista + "').on('change', function(evt, params) { " +
                "cargar_centros_de_salud(); " + "cargar_lugar_de_intervencion(); " +
                "}); "
                );

    }

</script>

