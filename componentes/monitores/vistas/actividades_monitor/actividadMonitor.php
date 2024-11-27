


<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Actividad del Monitor<br>
        <small>Detalle de la actividad del monitor</small>
    </h1>
</div>

<div id="page-content">
   <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:mostrar_tabla_actividades_monitor();">Listado Actividades</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Actividad del Monitor</a></li>
    </ul>
    <div class="block block-themed" >        

        <form id="form-actividades-monitor"  class="form-inline" onsubmit="return false;" >
            <input type="hidden" id="registro-id" name="registro-id" value="<?php if (isset($datosActividad)) echo $datosActividad->ID_ACTIVIDADREALIZADA ?>" />
            <input type="hidden" id="dir_archivo_soporte"  name="dir_archivo_soporte" value="" />
            <div class="block  block-themed" >

                <div class="block-title">
                    <h4>                        
                        <?php echo $datosActividad->NOMBRE_ACTIVIDAD ?> #<?php echo $datosActividad->ID_ACTIVIDADREALIZADA ?>
                    </h4>
                    <div class="block-options"> 
                        <a href="javascript:editar_datos_actividad_monitor('<?php echo $datosActividad->ID_ACTIVIDADREALIZADA ?>');" data-toggle="" title="Editar ACTIVIDAD" class="btn btn-lg btn-success"><i class="icon-pencil"></i> Editar esta ACTIVIDAD</a>
                    </div>  
                </div>

                <div class="block-content"> 
                    <div class="row-fluid">
                        <div>
                            <div class="span6">
                                <label class="control-label  span4" for="fechaRealizacion">Fecha:</label>
                                <div class="controls  span8">
                                    <div class=" " >
                                        <h3>
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                            <?php if (isset($datosActividad)) echo $datosActividad->FECHA_ACTIVIDAD_MONITOR ?>
                                        </h3>
                                    </div>   
                                </div>
                            </div>

                            <div class="span3">
                                <label class="control-label  span4" for="horaInicio">Hora Inicio:</label>
                                <div class="controls  span8">
                                    <div class="">
                                        <h4>
                                            <span class="add-on"><i class="icon-time"></i></span>
                                            <?php if (isset($datosActividad)) echo $datosActividad->HORA_INICIO_ACTIVIDAD_MONITOR ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>

                            <div class="span3">
                                <label class="control-label  span4" for="horaFinal">Hora Fin:&nbsp;&nbsp;&nbsp; </label>
                                <div class="controls  span8">
                                    <div class="">
                                        <h4>
                                            <span class="add-on"><i class="icon-time"></i></span>
                                            <?php if (isset($datosActividad)) echo $datosActividad->HORA_FIN_ACTIVIDAD_MONITOR ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>                                            

                        </div>
                        <div style="clear: both;" >                        
                            <div class="span6">
                                <label class="control-label  span4" >Provincia:</label>
                                <div class="controls  span8">
                                    <div id="listado-provincias" class=" span5" >                                
                                        <?php echo $datosActividad->NOMBRE_PROVINCIA ?>                        
                                    </div>
                                </div>
                            </div>

                            <div class="span6">
                                <label class="control-label  span4" >Cantón:</label>
                                <div class="controls  span8">                            
                                    <?php echo $datosActividad->NOMBRE_CANTON ?>
                                </div>
                            </div>

                        </div>


                    </div> 

                    <div class="control-group">
                        <label class="control-label  span4" for="idTema">Tema:</label>
                        <div class="controls  span8">
                            <h3><?php echo ($datosActividad->TITULO_TEMA) ?></h3>
                        </div>      
                    </div>


                    <div class="control-group">
                        <label class="control-label" for="observaciones">Observaciones:</label>
                        <div class="controls">
                            <?php if (isset($datosActividad)) echo $datosActividad->CONCLUSIONES_ACTIVIDAD_MONITOR ?>
                        </div>
                    </div>

                </div>
            </div> 
        </form>


        <div class="block block-themed ">
            <div class="block-title">
                <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Carga de Archivos"><i class="icon-arrow-up"></i></a>  Asistente o participantes a la actividad</h4>
            </div>

            <div class="block-content ">

                <!-- With Stripes Section -->
                <div class="block-section">
                    <table id="personas-tabla" class="table table-striped " >
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
                                              <td class="text-center">' . $asistente->NOMBRE_ROL . '</td>'
                                            . '<td class="text-center">' . $asistente->IDENTIFICACION_PERSONA . '<input type="hidden" name="id_persona[]" value="' . $asistente->ID_PERSONA . '" /></td>
                                              <td class="text-center">' . $asistente->NOMBRE_REAL_PERSONA . '</td>
                                              <td class="text-center">' . $asistente->CORREO_PERSONA . '</td>
                                          </tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>


        <div class="block block-themed block-last">

            <?php
            if (!empty($datosActividad->SOPORTES)) {
                foreach ($datosActividad->SOPORTES as $archivos) :
                    ?>
                    <div class="span3" id="soporte_<?php echo intval($archivos->ID_SOPORTE_ACTIVIDAD_MONITOR) ?>">
                        <div class="block block-themed themed-default">
                            <div class="block-title">
                                <h4>  <?php echo basename( $archivos->RUTA_SOPORTE_ACTIVIDAD_MONITOR ) ?></h4>
                            </div>
                            <div class="block-content full">
                                <a href="javascript:void(0);" onclick="abrir_soportes('archivos/<?php echo $archivos->RUTA_SOPORTE_ACTIVIDAD_MONITOR ?>', 'Soporte del Registro <?php echo ($datosActividad->ID_ACTIVIDADREALIZADA); ?>.');"  >
                                    <img src="imagenes/archivos/<?php echo $archivos->TIPO_SOPORTE_ACTIVIDAD_MONITOR; ?>.png" />
                                </a>
                            </div>                                
                        </div>
                    </div>
                    <?php
                endforeach;
            }
            ?>
            <div style="clear: both;"></div>
        </div>


    </div>

</div>


<script>


    var giCount = 0;

    var tablaAsistentes;

    $(document).ready(function() {

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


        $('#btn_guardar_actividad').on('click', function(evt, params) {
            $('#form-actividades-monitor').submit();
        });
        $('#btn_eliminar_actividad').on('click', function(evt, params) {
            document.getElementById('form-actividades-monitor').reset();
        });




        tablaAsistentes = $('#personas-tabla').dataTable();

        $("#personas-tabla tbody tr").click(function(e) {
            if ($(this).hasClass('row_selected')) {
                $(this).removeClass('row_selected');
            }
            else {
                tablaAsistentes.$('tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
            }
        });

        $('.eliminar_registro').on('click', function(evt, params) {
            var anSelected = tablaAsistentes.$('tr.row_selected');
            if (anSelected.length !== 0) {
                tablaAsistentes.fnDeleteRow(anSelected[0]);
            }
        });

        $('#provincia-residencia').on('change', function(evt, params) {
            cargar_cantones('listado-cantones', 'lugarResidencia', $(this).val());
        });


        $('#idTipoPersona').on('change', function(evt, params) {
            cargar_personas('listado-personas', 'idPersona', $(this).val());
        });


        $("#form-actividades-monitor").submit(function(e) {

            var datos = $(this).serialize();

            var datos = new FormData(document.getElementById('form-actividades-monitor-tabla'));

            var datosEnabezado = $('#form-actividades-monitor').serializeArray();
            $.each(datosEnabezado, function(i, field) {
                datos.append("" + field.name + "", "" + field.value + "");
            });

            var soportes = $('#form_actividades_monitor_soportes').serializeArray();
            $.each(soportes, function(i, field) {
                datos.append("" + field.name + "", "" + field.value + "");
            });

            var archivos = $(".cargar_soporte");
            for (i = 0; i < archivos.length; i++) {
                $.each($('.cargar_soporte')[i].files, function(k, file) {
                    datos.append('soporte-' + (k + i), file);
                });
            }



            if (estaVacio($('#registro-id').val())) {

                ejecutarAccionJsonArchivos(
                        'monitores', 'ActividadesMonitor', 'agregar_actividad_monitor',
                        datos, '  mostrar_resultado_guardar( data, "", "" );'
                        );
            } else {
                ejecutarAccionJsonArchivos(
                        'monitores', 'ActividadesMonitor', 'editar_actividad_monitor',
                        datos, ' mostrar_resultado_guardar( data, "", "" );'
                        );
            }


        });





    });

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
                alert("Usuario no existe en la tabla");
            } else {
                alert("Usuario eliminado de la tabla");
            }
        }
    }

    function mostrar_datos_tabla(dataJson) {

        if (estaVacio($('#idPersona').val()) || $('#idPersona').val() == '00') {
            alert("Seleccione a persona");
        } else {
            var sw = 0;
            $("#personas-tabla tbody tr input[name='id_persona[]']").each(function(index, value) {
                if (dataJson.ID_PERSONA == $(value).val()) {
                    sw = 1;
                }
            });

            if (sw == 0) {
                tablaAsistentes.fnAddData([
                    dataJson.IDENTIFICACION_PERSONA + '<input type="hidden" name="id_persona[]" value="' + dataJson.ID_PERSONA + '" />',
                    dataJson.NOMBRE_REAL_PERSONA,
                    dataJson.NOMBRE_ROL,
                    dataJson.CORREO_PERSONA
                ]);
                //tablaAsistentes.fnDestroy();
                $("#personas-tabla tbody tr").click(function(e) {
                    if ($(this).hasClass('row_selected')) {
                        $(this).removeClass('row_selected');
                    }
                    else {
                        tablaAsistentes.$('tr.row_selected').removeClass('row_selected');
                        $(this).addClass('row_selected');
                    }
                });
                tablaAsistentes = $('#personas-tabla').dataTable();

            } else {
                alert("Usuario ya existe en la tabla");
            }
        }
    }



    agregar_boton_ayuda('VERACTIVIDADMONITOR');

</script>
