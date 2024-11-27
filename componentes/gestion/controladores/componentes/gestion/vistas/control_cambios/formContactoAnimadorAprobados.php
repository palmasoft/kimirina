
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Recibo de Contacto PEMAR<br>
        <small>REGISTRO DE RECIBOS DE CONTACTO ENTREGADOS A LOS PEMAR.</small>
    </h1>
</div>


<style>
    label {
        font-size: 12px;
    }      
</style>

<!-- Page Content -->
<div id="page-content">

    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:mostrar_lista_aprobados_recibos_animadores()();">Formatos Aprobados de Animadores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="javascript:void();">Recibo de Contacto</a></li>
    </ul>


    <div class="block block-themed ">
        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                Supervision y Control
            </h4>
            <div class="block-options">                    
                <div class=" btn-group">         
                    <a href="javascript:no_aprobar_recibo_contacto_animador();" data-toggle="tooltip" title="Cambiar a estado NO APROBADO este registro" class="btn btn-danger"> No Aprobado <i class="glyphicon-thumbs_down"></i></a>
                </div>
            </div>
        </div>
        <div class="block-content">

            <div class="control-group inline" >
                <label class="control-label" >Razones de Modificacion</label>
                <div class="controls">
                    <textarea id="razones_contacto_animador" name="razones_contacto_animador" class="span12" rows="4" required=""></textarea>
                </div>     
            </div>
        </div>
    </div>

    <?php $this->mostrar("recibo_contacto_animador/formularioAnimador", $this->datos, 'monitores'); ?>

    <div class="block block-themed block-last">
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Carga de Archivos"><i class="icon-arrow-up"></i></a>  Carga de Archivos de Soporte <small>para cargar los archivos escaneados de los formularios debe hacer clic en <strong>seleccionar archivo</strong> Abajo!</small></h4>
        </div>
        <div class="block-content ">
            <?php $this->mostrar("recibo_contacto_animador/cargarArchivos", $this->datos, 'monitores'); ?>
        </div>
    </div>

    <div class="block block-themed block-last">
        <div class="form-actions" style="text-align: center;">
            <button id="btn_validar_datos" type="button" class="btn btn-info"><i class="icon-check"></i> Validar </button>
            <button id="btn_limpiar_recibo_animador" type="button" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
            <button id="btn_guardar_recibo_animador" type="submit" class="btn btn-success" disabled="" ><i class="icon-ok"></i> Guardar</button>
        </div>
    </div>





</div>



<script>
    $(document).ready(function() {

        $('#form-contacto-animador').validate({
            submitHandler: function(form) {

                if (event.handled !== true) {

                    if (estaVacio($('#razones_contacto_animador').val())) {
                        alert('Debes escribir las razon de la modificacion de este registro.');
                        return false;
                    }
                    
                    if (estaVacio($('#tipo_pemar').val())) {
                        alert('Debes Seleccionar el tipo de poblacion abordada.');
                        return false;
                    }

                    if (estaVacio($('#dia-contacto').val())) {
                        alert('Debes Seleccionar el dia de Abordaje');
                        return false;
                    }

                    if (estaVacio($('#mes-contacto').val())) {
                        alert('Debes Seleccionar el mes de Abordoje');
                        return false;
                    }

                    if (estaVacio($('#ano-contacto').val())) {
                        alert('Debes Seleccionar el año de Abordaje');
                        return false;
                    }

                    if (estaVacio($('#sel-lista-cantones').val())) {
                        alert('Debes Seleccionar el canton donde se realizó el abordaje.');
                        return false;
                    }

                    if (estaVacio($('#tipoLugar').val())) {
                        alert('Debes Seleccionar el tipo de lugar de Abordaje');
                        return false;
                    }

                    if (estaVacio($('#sel-lista-lugar_intervencion').val())) {
                        alert('Debes Seleccionar el lugar de Abordaje');
                        return false;
                    }

                    if (estaVacio($('#ano-nacimiento').val())) {
                        alert('Debes seleccionar un a&ntilde;o de nacimiento');
                        return false;
                    }

                    if (estaVacio($('#mes-nacimiento').val())) {
                        alert('Debes seleccionar un mes de nacimiento');
                        return false;
                    }


                    var idTema = $("input[name='tema-recibo']:checked").val();
                    if (estaVacio(idTema)) {
                        alert('Debes seleccionar un tema');
                        return false;
                    }


                    if (estaVacio($('#noFolletos').val())) {
                        alert('Debes seleccionar un numero de Folletos');
                        return false;
                    }

                    if (estaVacio($('#promotor').val())) {
                        alert('Debes seleccionar un Animador');
                        return false;
                    }

                    var data = new FormData(document.getElementById('form-contacto-animador'));
                    data.append("razones_contacto_animador", "" + $('#razones_contacto_animador').val() + "");

                    var soportes = $('#form-recibo-contacto-soportes').serializeArray();
                    $.each(soportes, function(i, field) {
                        data.append("" + field.name + "", "" + field.value + "");
                    });

                    var archivos = $(".cargar_soporte");
                    for (i = 0; i < archivos.length; i++) {
                        $.each($('.cargar_soporte')[i].files, function(k, file) {
                            data.append('soporte-' + (k + i), file);
                        });
                    }
                    
                    //alert(datosForm)           
                    if (estaVacio($('#registro-id').val())) {
//                        ejecutarAccionJsonArchivos(
//                                'monitores', 'reciboContactoAnimador', 'agregar_recibo_contacto_animador',
//                                data, ' mostrar_resultado_guardar(data, "abrir_tabla_recibo_contacto_animador();", "" );'
//                                );
                    } else {
                        ejecutarAccionJsonArchivos(
                                'gestion', 'auditoriaFormularios', 'update_recibo_contacto_animador_aprobado',
                                data, 'mostrar_resultado_guardar(data, "mostrar_lista_aprobados_recibos_animadores_gestor();", "" );'
                                );
                    }


                    event.handled = true;
                }
                return false;
            }
        });

        $('.generadores-codigo').on('change', function(e) {
            activar_boton_formatos('btn_guardar_recibo_animador', 'false');
        });

        $(".validar_cedula_codigo").on('change', function(e) {
            activar_boton_formatos('btn_guardar_recibo_animador', 'false');
        });

        $("#tipo_pemar").on('change', function(e) {
            $('#cod_tipo_poblacion').html('[' + $('#tipo_pemar option:selected').attr('data-cod') + ']');
            $('#cantidad-condones-entregados-contacto').attr('value', 3);
            $('#cantidad-lubricantes-entregados-contacto').attr('value', 1);
        });

        $("#num_recibo").on('change', function(e) {
            var idConCeros = rellenarCeros($(this).val(), 9, "0");
            $('#num_recibo').val(idConCeros);
        });

        $('#tipoLugar').on('change', function(e) {
            cargar_lugares_intervencion(
                    "lugar_intervencion_div", "sel-lista-lugar_intervencion",
                    $(this).val(), $('#provincia-chosen').val(), $('#sel-lista-cantones').val()
                    );
        });

        $('#provincia-chosen').on('change', function(evt, params) {
            cargar_cantones('listado-cantones', 'sel-lista-cantones', $(this).val());
        });

        $('#btn_guardar_recibo_animador').on('click', function(evt, params) {
            $('#form-contacto-animador').submit();
        });

        $('#btn_limpiar_recibo_animador').on('click', function(evt, params) {
            resetear_formulario();
        });

        $('#btn_validar_datos').on('click', function(e) {
            e.preventDefault();
            generarCodigo();
        });

    });



    var habilitarBoton = 'false';

    function generarCodigo() {
        activar_boton_formatos('btn_guardar_recibo_animador', 'false');

        $('#resp_validar_cedula').slideUp();
        $('#datos_recurrencia').slideUp();

        var CUP = generarCodigoUnicoPemar(
                $('#primer_nombre').val(), $('#segundo_nombre').val(),
                $('#primer_apellido').val(), $('#segundo_apellido').val(),
                $('#mes-nacimiento').val(), $('#ano-nacimiento').val()
                );
        $('#codigo-pemar-generado').attr('value', CUP.toString());

        var cedPemar = $('#ced_identidad_contacto').val();
        var codPemar = $('#codigo-pemar-generado').val();

        if (estaVacio($('#ano-nacimiento').val()) || estaVacio($('#mes-nacimiento').val())) {
            codPemar = '';
            alert('la fecha de nacimiento es importante para generar el codigo.');
        } else if (estaVacio($('#ano-contacto').val()) || estaVacio($('#mes-contacto').val()) || estaVacio($('#dia-contacto').val())) {
            codPemar = '';
            alert('selecciona la fecha de contacto');
            $('#dia-contacto').focus();
        }

        if (!estaVacio(codPemar)) {
            avisos_valida_cedula_codigo(cedPemar, codPemar, 'resp_validar_cedula');
//            cantidad_de_abordajes(
//                    CUP, $('#ano-contacto').val() + "-" + $('#mes-contacto').val() + "-" + $('#dia-contacto').val(), $('#horaAbordaje').val(),
//                    'mostrar_recurrencia_promotores(data);'
//                    );
            activar_boton_formatos('btn_guardar_recibo_animador', 'true');

        }


    }

    function mostrar_recurrencia_promotores(jsonData) {
        /*
         * 
         * jsonData[0] = abordajes por subreceptor por año
         * jsonData[1] = abordajes por subreceptor por mes
         * jsonData[2] = abordajes por todos por año
         * jsonData[3] = abordajes por todos por mes
         * jsonData[4] = tipo de alcance por subreceptor 
         *                               por todos por mes
         *                               por todos por mes por subreceptor
         *                               
         */
        var rRc = '';
        var tipoRec = '';
        if (!$.isEmptyObject(jsonData))
        {
            if (jsonData[4].POR_ANIMADOR_POR_SUBRECEPTOR === 'NUEVO') {
                rRc = 'N-';
                //habilitarBoton = 'true';
            } else {
                rRc = 'R-';
                if (parseInt(jsonData[2].ABORDAJES_ANIMADOR) < 12) {
                    //habilitarBoton = 'true';
                } else if (parseInt(jsonData[2].ABORDAJES_ANIMADOR) >= 12) {
                    if (jsonData[4].POR_ANIMADOR_POR_SUBRECEPTOR_POR_PERIODO === 'NUEVO') {
                        //habilitarBoton = 'true';
                    } else {
                        //habilitarBoton = 'false';
                    }
                } else {
                    //habilitarBoton = 'false';
                }
            }

//            $('#datos_recurrencia').html('<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button>' +
//                    '<h4><strong><i class="icon-info-sign"></i></strong> Información de Abordajes de Animadores</h4>' +
//                    '<div>Por Todo el Proyecto => ' +
//                    'Es <b>' + jsonData[4].POR_ANIMADOR + '</b> este año: <b>' + jsonData[2].ABORDAJES_ANIMADOR + '</b>, este mes: ' + jsonData[3].ABORDAJES_ANIMADOR + '.<br />' +
//                    'Por <b>' + jsonData[0].SIGLAS_SUBRECEPTOR + '</b> => ' +
//                    'Es <b>' + jsonData[4].POR_ANIMADOR_POR_SUBRECEPTOR + '</b> este año: <b>' + jsonData[0].ABORDAJES_ANIMADOR + '</b>, este mes: <b>' + jsonData[1].ABORDAJES_ANIMADOR + '</b>.' +
//                    '</div>' +
//                    '<em>Esta información se computa teniendo como base la fecha y hora de contacto digitada. Esta información es temporal, y depende de los registros en el sistema.</em></div>'
//                    );
//            $('#datos_recurrencia').slideDown();

            rRc += '-' + jsonData[2].ABORDAJES_ANIMADOR + '';
            tipoRec = jsonData[4].POR_PROMOTOR_POR_SUBRECEPTOR;
        } else {
            rRc = 'N-0-0';
            tipoRec = 'NUEVO';
            //habilitarBoton = 'true';
        }
        $('#tipo-recurrencia-contacto').attr('value', rRc);
        $('#tipo-alcance-contacto').attr('value', tipoRec);
    }


    function resetear_formulario() {
        $('#chk-cedula-verificada').iCheck('uncheck');
        $("input[name='tema-recibo'][value='" + $('#tema-recibo').val() + "']").iCheck('uncheck');
        $('#codigo-pemar-generado').attr('value', '');
        document.getElementById('form-contacto-animador').reset();
    }
    
    function no_aprobar_recibo_contacto_animador(){
        if (estaVacio($('#razones_contacto_animador').val())) {
                            alert('Debe escribir el motivo de la desaprobacion.');
                            return false;
                        }
        var id_contacto_animador = $('#registro-id').val();
        var razones_contacto_animador = $('#razones_contacto_animador').val();
        ejecutarAccionJson(
                    'gestion', 'auditoriaFormularios', 'no_aprobar_recibo_contacto_animador', 'razones_contacto_animador='+razones_contacto_animador+'&registro-id-contacto-animador=' + id_contacto_animador,
                    'mostrar_resultado_guardar( data, "mostrar_lista_aprobados_recibos_animadores_gestor();", "" );'
                    );
    }

</script>


