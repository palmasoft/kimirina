    
<!--EL ENCABEZADO-->
<div class="block  block-themed" >
    <div class="block-title">
        <h4>
            <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
            Datos Generales del Formulario
        </h4>
        <div class="block-options">            
        </div>  
    </div>
    <div class="block-content">         
        <div class="row-fluid" >

            <div class="span12" >

                <form id="form-actividades-monitor"  class="form-inline" onsubmit="return false;" >
                    <input type="hidden" id="registro-id" name="registro-id" value="<?php if (isset($datosActividad)) echo $datosActividad->ID_ACTIVIDADREALIZADA ?>" />
                    <input type="hidden" id="dir_archivo_soporte"  name="dir_archivo_soporte" value="" />

                    <div class="control-group">
                        <label class="control-label  span4" for="idActividad">Tipo de actividad:</label>
                        <div class="controls  span8">
                            <select id="idActividad" name="idActividad" class="select-chosen" >  
                                <option value="">Seleccione uno</option>
                                <?php
                                foreach ($actividades as $actividad) {
                                    $seleted = '';
                                    if (isset($datosActividad))
                                        if ($datosActividad->ID_ACTIVIDAD == $actividad->ID_ACTIVIDAD)
                                            $seleted = ' selected="" ';
                                    echo '<option value="' . $actividad->ID_ACTIVIDAD . '" ' . $seleted . ' >' . ($actividad->NOMBRE_ACTIVIDAD) . '</option>';
                                }
                                ?>
                            </select>
                        </div>      
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" >Provincia:</label>
                        <div class="controls  span8">

                            <div id="listado-provincias" class=" " >                                
                                <select id="provincia-residencia" name="provincia-residencia" class="select-chosen span12">
                                    <option value >Seleccione la provincia</option>
                                    <?php
                                    foreach ($provincias as $provincia) {
                                        $seleted = '';
                                        if (isset($datosActividad))
                                            if ($datosActividad->ID_PROVINCIA == $provincia->ID_PROVINCIA)
                                                $seleted = ' selected="" ';
                                        ?>
                                        <option value="<?php echo $provincia->ID_PROVINCIA ?>" <?php echo $seleted; ?> ><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>                                            
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" >Cantón:</label>
                        <div class="controls  span8">
                            <div id="listado-cantones" class=" " >                                
                                <select id="lugarResidencia" name="lugarResidencia" class="select-chosen span12">
                                    <option value="" >Seleccione el cantón</option>
                                    <?php
                                    if (isset($datosActividad))
                                        foreach ($cantones as $canton) {
                                            $seleted = '';
                                            if (isset($datosActividad))
                                                if ($datosActividad->ID_CANTON == $canton->ID_CANTON)
                                                    $seleted = ' selected="" ';
                                            echo '<option value="' . $canton->ID_CANTON . '" ' . $seleted . ' >' . ($canton->NOMBRE_CANTON) . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" for="fechaRealizacion">Fecha:</label>
                        <div class="controls  span8">

                            <div class="input-prepend date " >
                                <span class="add-on"><i class="icon-calendar"></i></span>
                                <input type="text"  id="fechaRealizacion" name="fechaRealizacion"  class="input-small input-datepicker span12"
                                       value="<?php if (isset($datosActividad)) echo $datosActividad->FECHA_ACTIVIDAD_MONITOR ?>">
                            </div>       

                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" for="horaInicio">Hora Inicio:</label>
                        <div class="controls  span8">
                            <div class="input-prepend bootstrap-timepicker">
                                <span class="add-on"><i class="icon-time"></i></span>
                                <input type="text" id="horaInicio" name="horaInicio" class="input-timepicker span12"
                                       value="<?php if (isset($datosActividad)) echo $datosActividad->HORA_INICIO_ACTIVIDAD_MONITOR ?>">       
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" for="horaFinal">Hora Fin:</label>
                        <div class="controls  span8">
                            <div class="input-prepend bootstrap-timepicker">
                                <span class="add-on"><i class="icon-time"></i></span>
                                <input type="text" id="horaFinal" name="horaFinal" class="input-timepicker span12"
                                       value="<?php if (isset($datosActividad)) echo $datosActividad->HORA_FIN_ACTIVIDAD_MONITOR ?>">        
                            </div>
                        </div>
                    </div>                                            

                    <div class="control-group">
                        <label class="control-label  span4" for="idTema">Tema:</label>
                        <div class="controls  span8">
                            <select id="idTema" name="idTema" class="select-chosen" >  
                                <option value="">Seleccione uno</option>
                                <?php
                                foreach ($temas as $tema) {
                                    $seleted = '';
                                    if (isset($datosActividad))
                                        if ($datosActividad->ID_TEMA == $tema->ID_TEMA)
                                            $seleted = ' selected="" ';
                                    echo '<option value="' . $tema->ID_TEMA . '" ' . $seleted . ' >' . ($tema->TITULO_TEMA) . '</option>';
                                }
                                ?>
                            </select>
                        </div>      
                    </div>


                    <div class="control-group">
                        <label class="control-label" for="observaciones">Observaciones:</label>
                        <div class="controls">
                            <textarea id="observaciones" name="observaciones"  style="width:100%"><?php if (isset($datosActividad)) echo $datosActividad->CONCLUSIONES_ACTIVIDAD_MONITOR ?></textarea>
                        </div>
                    </div>


                </form>

            </div>

        </div>            
    </div>
</div> 

<!--LOS ASISTENTES-->
<div class="block block-themed ">
    <div class="block-title">
        <h4><a href="javascript:void(0);" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="Cerrar / Abrir listado de asistentes a la Actividad." ><i class="icon-arrow-up"></i></a>  Asistente o participantes a la actividad</h4>
    </div>
    <div class="block-content ">
        <form id="form-actividades-monitor-boton"  method="post" class="form-inline" onsubmit="return false;" >
            <div class="block  block-themed" >
                <div class="row-fluid ">
                    <div class="control-group"> 
                        <label class="control-label " for="idTipoPersona">Seleccione los asistentes:</label>
                        <div class="controls " >
                            <div id="listado-tipo-persona" class="span4"  > 
                                <select name="idTipoPersona" id="idTipoPersona" class="select-chosen span12">
                                    <option value="">Seleccione uno</option>
                                    <?php
                                    foreach ($idTipoUsuario as $idTipoUsu) {
                                        if ($idTipoUsu->ID_ROL != 1) {
                                            echo '<option value="' . $idTipoUsu->ID_ROL . '" data-nombre="' . ($idTipoUsu->NOMBRE_ROL) . '">' . ($idTipoUsu->NOMBRE_ROL) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div id="listado-personas" class="span4"  >  
                                <select name="idPersona" id="idPersona" class="select-chosen span12">
                                    <option value="">Seleccione uno</option>
                                </select>
                            </div>
                            <div class="btn-group span4">
                                <a href="javascript:agregar_persona();" data-toggle="tooltip" title="Agregar Persona" class="btn btn-lg btn-info"><i class="icon-ok"></i> Agregar</a>
                                <a href="javascript:eliminar_persona();" title="Eliminar Persona"><button type="button" class="btn btn-danger eliminar_registro" ><i class="icon-close"></i> Eliminar</button></a>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>    
        </form>  

        <form id="form-actividades-monitor-tabla" method="post"  onsubmit="return false;" >
            <!-- With Stripes Section -->
            <div class="block-section">
                <table id="personas-tabla" class="table table-striped " 
                       data-tipo="<?php echo ($idTipoUsu->NOMBRE_ROL) ?>"
                       data-nombre="<?php echo ($idTipoUsu->NOMBRE_ROL) ?>">
                    <thead>
                        <tr>
                            <th class="text-center">Función</th>
                            <th class="text-center">Identificación</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Correo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($datosActividad->ASISTENTES)) {
                            foreach ($datosActividad->ASISTENTES as $asistente) {
                                echo '
                                            <tr >
                                              <td class="text-center">' . $asistente->NOMBRE_ROL . '</td>
                                              <td class="text-center">' . $asistente->IDENTIFICACION_PERSONA . '<input type="hidden" name="id_persona[]" value="' . $asistente->ID_PERSONA . '" /></td>
                                              <td class="text-center">' . $asistente->NOMBRE_REAL_PERSONA . '</td>
                                              <td class="text-center">' . $asistente->CORREO_PERSONA . '</td>
                                          </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </form>

    </div>
</div>

<!--LOS ARCHIVOS-->
<div class="block block-themed ">
    <div class="block-title">
        <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Carga de Archivos"><i class="icon-arrow-up"></i></a>  Carga de Archivos de Soporte <small>Solo debe <code>arrastrar y soltar</code> sobre el recuadro, los archivos escaneados de los formularios!</small></h4>
    </div>
    <div class="block-content ">
        <?php $this->mostrar("actividades_monitor/cargarArchivos", $this->datos); ?>
    </div>
</div>

<div class="block block-themed block-last">
    <div class="form-actions text-center">
        <button id="btn_eliminar_actividad" type="button" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
        <button id="btn_guardar_actividad" type="button" class="btn btn-success"><i class="icon-save"></i> Guardar</button>
    </div>
</div>

<script>

    var giCount = 0;
    var tablaAsistentes;
    $(document).ready(function() {


        _puede_salir_formulario = false;
        var t = "<?php echo $periodoActual->FECHA_MIN_PERIODO ?> 00:00:00".split(/[- :]/);
        var iniDate = new Date(t[0], t[1] - 1, t[2]);
        iniDate.setDate(iniDate.getDate());
        t = "<?php echo $periodoActual->FECHA_MAX_PERIODO ?> 23:59:59".split(/[- :]/);
        var finDate = new Date(t[0], t[1] - 1, t[2]);
        finDate.setDate(finDate.getDate());
        $('#fechaRealizacion').datepicker({
            minDate: iniDate,
            maxDate: finDate,
            onClose: function(selectedDate) {
            }
        });
        $('#provincia-residencia').on('change', function(evt, params) {
            cargar_cantones('listado-cantones', 'lugarResidencia', $(this).val());
        });
        $('#idTipoPersona').on('change', function(evt, params) {
            cargar_personas('listado-personas', 'idPersona', $(this).val());
        });

        tablaAsistentes = $('#personas-tabla').dataTable();        
        agregar_evento_click();
        $('.eliminar_registro').on('click', function(evt, params) {
            var anSelected = tablaAsistentes.$('tr.row_selected');
            if (anSelected.length !== 0) {
                tablaAsistentes.fnDeleteRow(anSelected[0]);
            }
        });


        $('#btn_guardar_actividad').on('click', function(evt, params) {
            $('#form-actividades-monitor').submit();
        });

        $('#btn_eliminar_actividad').on('click', function(evt, params) {
            confirm(
                '¿Seguro que desea limpiar el formulario o <strong>borrar los datos digitados</strong> de la Actividad de Monitor?'
                , 'resetear_formulario();'
            );
        });




    });


    function resetear_formulario(){

        $('#idActividad option[value=""]').attr("selected", "selected");  
        $('#idActividad').change();
        $('#idActividad').trigger("liszt:updated");

        $('#provincia-residencia option[value=""]').attr("selected", "selected");  
        $('#provincia-residencia').change();
        $('#provincia-residencia').trigger("liszt:updated");

        $('#idTema option[value=""]').attr("selected", "selected");  
        $('#idTema').change();
        $('#idTema').trigger("liszt:updated");

        document.getElementById('form-actividades-monitor').reset();
    }




    function agregar_evento_click(){

        tablaAsistentes = $('#personas-tabla').dataTable();
         $("#personas-tabla tbody tr").each(function(index, value) {
            if ($(this).hasClass('row_selected')) {
                $(this).removeClass('row_selected');
            }
        });
        $("#personas-tabla tbody tr").off('click').click(function(e) {
            if ($(this).hasClass('row_selected')) {
                $(this).removeClass('row_selected');
            }
            else {
                tablaAsistentes.$('tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
            }
        });
    }

    function validar_datos_actividad_monitor() {
        if (estaVacio($("#idActividad").val())) {
            alert("Debe seleccionar el Tipo de Actividad realizada.");
            return false;
        }
        if (estaVacio($("#provincia-residencia").val())) {
            alert("Debe seleccionar el Canton donde se realizó la actividad.");
            return false;
        }
        if (estaVacio($("#lugarResidencia").val())) {
            alert("Debe seleccionar el Canton donde se realizó la actividad.");
            return false;
        }

        if (estaVacio($("#fechaRealizacion").val())) {
            alert("Debe seleccionar la FECHA o dia en que se realizó la actividad.");
            return false;
        }

        if (estaVacio($("#horaInicio").val())) {
            alert("Debe definir la HORA DE INCIO de la actividad.");
            return false;
        }
        if (estaVacio($("#horaFinal").val())) {
            alert("Debe definir un HORA DE FIN de la actividad.");
            return false;
        }

        if (estaVacio($("#idTema").val())) {
            alert("Debe seleccionar un TEMA. Es importante saber de que se trató la actividad.");
            return false;
        }


        var noAsistentes = true;
        $("#personas-tabla tbody tr input[name='id_persona[]']").each(function(index, value) {
                noAsistentes = false;
        });

        if (noAsistentes) {
            alert("Parece que <strong>NO HAY ASISTENTES</strong> registrados para esta actividad. Es importante registrar al menos un asistente.");
            return false;
        }


        return true;
    }

    function agregar_persona() {
        var idPersona = $('#idPersona').val();
        ejecutarAccionJson(
                'monitores', 'ActividadesMonitor', 'retorna_datos_persona',
                'idPersona=' + idPersona, 'mostrar_datos_tabla(data);'
                );
    }

    function eliminar_persona() {
        var idPersona = $('#idPersona').val();
        ejecutarAccionJson(
                'monitores', 'ActividadesMonitor', 'retorna_datos_persona',
                'idPersona=' + idPersona, 'mostrar_datos_tabla_eliminado(data);'
                );
    }

    function mostrar_datos_tabla_eliminado(dataJson) {
        if (estaVacio($('#idPersona').val()) || $('#idPersona').val() == '00') {
            //alert("Seleccione a persona");
        } else {
            var sw = 0;
            $("#personas-tabla tbody tr input[name='id_persona[]']").each(function(index, value) {
                if (dataJson.ID_PERSONA == $(value).val()) {
                    sw = 1;
                    tablaAsistentes.fnDeleteRow(index);
                }
            });
            if (sw == 0) {
                //alert("Usuario no existe en la tabla");
            } else {
                informacion("<strong>Asistente eliminado</strong> de la lista CORRECTAMENTE.");
            }
        }
    }

    function mostrar_datos_tabla(dataJson) {

        if (estaVacio($('#idPersona').val()) || $('#idPersona').val() == '00') {
            alert("Seleccione a persona");
        } else {

            tablaAsistentes = $('#personas-tabla').dataTable();
            var sw = 0;
            $("#personas-tabla tbody tr input[name='id_persona[]']").each(function(index, value) {
                if (dataJson.ID_PERSONA == $(value).val()) {
                    sw = 1;
                }
            });
            if (sw == 0) {

                tablaAsistentes.fnAddData([
                    dataJson.NOMBRE_ROL,
                    dataJson.IDENTIFICACION_PERSONA + '<input type="hidden" name="id_persona[]" value="' + dataJson.ID_PERSONA + '" />',
                    dataJson.NOMBRE_REAL_PERSONA,
                    dataJson.CORREO_PERSONA
                ]);
                agregar_evento_click();

            } else {
                alert("Usuario ya existe en la tabla");
            }
        }
    }

</script>

