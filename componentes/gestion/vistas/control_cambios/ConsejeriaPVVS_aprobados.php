
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Consejeria PVVS Aprobados<br>
        <small>REGISTRO DE CONSEJERÍA DE PARES CON PERSONAS QUE VIVEN CON VIH.</small>
    </h1>
</div>
<!-- END Pre Page Content -->


<!-- Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Supervision</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Consejeria PVVS</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <div class="block block-themed ">
        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                Supervision y Control
            </h4> 
            <div class="block-options">                    
                <div class=" btn-group">         
                    <a href="javascript:no_aprobar_registro_consejeria();" data-toggle="tooltip" title="Cambiar a estado NO APROBADO este registro" class="btn btn-danger"> No Aprobado <i class="glyphicon-thumbs_down"></i></a>
                </div>
            </div>
        </div>
        <div class="block-content">
            <div class="control-group inline" >
                <label class="control-label" >Razones de Modificacion</label>
                <div class="controls">
                    <textarea id="observaciones_consejeria_pvvs" name="razones_consejeria_pvvs" rows="4" required="" style="width: 100%;" ></textarea>
                </div>  
            </div>
        </div>
    </div>

    <?php $this->mostrar("consejeria_pvvs/formularioConsejeria", $this->datos, 'monitores'); ?>

    <div class="block block-themed block-last">
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Carga de Archivos"><i class="icon-arrow-up"></i></a>  Carga de Archivos de Soporte <small>Solo debe <code>arrastrar y soltar</code> sobre el recuadro, los archivos escaneados de los formularios!</small></h4>
        </div>
        <div class="block-content ">
            <?php $this->mostrar("consejeria_pvvs/cargarArchivos", $this->datos, 'monitores'); ?>
        </div>
    </div>
    
    <!-- END div.row-fluid -->
    <div class="form-actions">
        <button id="btn_validar_datos" type="button" class="btn btn-info"><i class="icon-check"></i> Validar </button>
        <button type="button"  id="btn_limpiar_consejeria_pvvs" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
        <button type="button" id="btn_guardar_consejeria_pvvs" class="btn btn-success" disabled="" ><i class="icon-save"></i> Guardar</button>
    </div>


</div> 
</div>



<script>
    $(document).ready(function() {

        $('#btn_guardar_consejeria_pvvs').on('click', function(evt) {
            $('#form-consejeria-pvvs').submit();
        });

        $('#btn_limpiar_consejeria_pvvs').on('click', function(evt, params) {
            document.getElementById('form-consejeria-pvvs').reset();
        });

        $('#btn_validar_datos').on('click', function(e) {
            generarCodigo();
            e.preventDefault();
        });


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

        $(".validar_cedula_codigo").on('change', function(e) {
            activar_boton_formatos('btn_guardar_consejeria_pvvs', 'false');
        });
        
        $(".validar_cedula_codigo").on('keyup', function(e) {
            activar_boton_formatos('btn_guardar_consejeria_pvvs', 'false');
        });

        $('.lista-nacimiento').on('change', function(e) {
            calculaEdad();
        });

        $('#provincia-residencia').on('change', function(evt, params) {
            cargar_cantones_cServicio('listado-cantones', 'lugarResidencia', $(this).val());
        });

        $('#lugarResidencia').on('change', function(evt, params) {
            cargar_centros_salud('listado-establecimiento', 'idEstablecimiento', $(this).val());
        });
        
        $('#form-consejeria-pvvs').validate({
            submitHandler: function(form) {
                if (event.handled !== true) {
                    if (validarDatos()) {

                        if (estaVacio($('#observaciones_consejeria_pvvs').val())) {
                            alert('Debe escribir el motivo de la modificacion.');
                            return false;
                        }

                        var codP = generarCodigoUnicoPemar($('#dosPrimerNombre').val(), $('#dosSegundoNombre').val(), $('#dosPrimerApellido').val(), $('#dosSegundoApellido').val(), $('#mes-nacimiento').val(), $('#ano-nacimiento').val());

                        var data = new FormData(document.getElementById('form-consejeria-pvvs'));
                        data.append("razones_consejeria_pvvs", "" + $('#observaciones_consejeria_pvvs').val() + "");
                        data.append("codigo-pemar", "" + codP + "");

                        var soportes = $('#form-consejeria-soportes').serializeArray();
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
//                            ejecutarAccionArchivos(
//                                    'monitores', 'ConsejeriaPVVS', 'agregar_consejeria_pvvs',
//                                    data, 'alert(data); mostrar_resultado_guardar( data, "abrir_listado_consejerias_pvvs();", "");'
//                                    );
                        } else {
                            ejecutarAccionJsonArchivos(
                                    'gestion', 'auditoriaFormularios', 'editar_consejeria_pvvs_aprobado',
                                    data, ' mostrar_resultado_guardar( data, "mostrar_lista_aprobados_consejerias_pvvs_gestor();", "");'
                                    );
                        }
                    }
                    event.handled = true;
                }
                return false;
            }
        });

    });


    var habilitarBoton = 'false';

    function generarCodigo() {
        activar_boton_formatos('btn_guardar_consejeria_pvvs', 'false');

        $('#resp_validar_cedula').slideUp();
        $('#datos_recurrencia').slideUp();

        var CUP = generarCodigoUnicoPemar(
                $('#dosPrimerNombre').val(), $('#dosSegundoNombre').val(),
                $('#dosPrimerApellido').val(), $('#dosSegundoApellido').val(),
                $('#mes-nacimiento').val(), $('#ano-nacimiento').val()
                );

        //$('#codigo-pemar-generado').attr('value', CUP.toString());
        var cedPemar = $('#cedulaUsuario').val();
        var codPemar = CUP;

        if (estaVacio($('#ano-nacimiento').val()) || estaVacio($('#mes-nacimiento').val())) {
            codPemar = '';
        } else if (estaVacio($('#dosPrimerNombre').val()) && estaVacio($('#dosSegundoNombre').val()) && estaVacio($('#dosPrimerApellido').val()) && estaVacio($('#dosSegundoApellido').val())) {
            if (estaVacio(cedPemar)) {
                codPemar = '';
            }
        } else if (estaVacio($('#fechaRealizacion').val())) {
            codPemar = '';
        }

        if (!estaVacio(codPemar)) {
            avisos_valida_cedula_codigo(cedPemar, codPemar, 'resp_validar_cedula');
            //esValidaCedulaCodigo(cedPemar, codPemar, ' activar_boton_formatos(\'btn_guardar_consejeria_pvvs\', data); ');
            //            cantidad_de_abordajes(
            //                    CUP, $('#fechaRealizacion').val(), $('#horaInicio').val(),
            //                    'mostrar_recurrencia_promotores(data); '
            //                    );
            activar_boton_formatos('btn_guardar_consejeria_pvvs', 'true');
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
            if (jsonData[4].POR_CONSEJERO_POR_SUBRECEPTOR === 'NUEVO') {
                rRc = 'N-';
                // habilitarBoton = 'true';
            } else {
                rRc = 'R-';
                if ((parseInt(jsonData[1].ABORDAJES_CONSEJEROS) < 1) && (parseInt(jsonData[0].ABORDAJES_CONSEJEROS < 12))) {
                    // habilitarBoton = 'true';
                } else if ((parseInt(jsonData[1].ABORDAJES_CONSEJEROS) >= 1) || (parseInt(jsonData[0].ABORDAJES_CONSEJEROS >= 12))) {
                    if (jsonData[4].POR_PCONSEJERO_POR_SUBRECEPTOR_POR_PERIODO === 'NUEVO') {
                        // habilitarBoton = 'true';
                    } else {
                        // habilitarBoton = 'false';
                    }
                } else {
                    //habilitarBoton = 'false';
                }
            }

            //            $('#datos_recurrencia').html('<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button>' +
            //                    '<h4><strong><i class="icon-info-sign"></i></strong> Información de Abordajes de Consejeria</h4>' +
            //                    '<div>Por Todo el Proyecto => ' +
            //                    'Es <b>' + jsonData[4].POR_CONSEJERO + '</b> este año: <b>' + jsonData[2].ABORDAJES_CONSEJEROS + '</b>, este mes: ' + jsonData[3].ABORDAJES_CONSEJEROS + '.<br />' +
            //                    'Por <b>' + jsonData[0].SIGLAS_SUBRECEPTOR + '</b> => ' +
            //                    'Es <b>' + jsonData[4].POR_CONSEJERO_POR_SUBRECEPTOR + '</b> este año: <b>' + jsonData[0].ABORDAJES_CONSEJEROS + '</b>, este mes: <b>' + jsonData[1].ABORDAJES_CONSEJEROS + '</b>.' +
            //                    '</div>' +
            //                    '<em>Esta información se computa teniendo como base la fecha y hora de contacto digitada. Esta información es temporal, y depende de los registros en el sistema.</em></div>'
            //                    );
            //
            //            $('#datos_recurrencia').slideDown();

            rRc += '-' + jsonData[2].ABORDAJES_CONSEJEROS + '';
            tipoRec = jsonData[4].POR_CONSEJERO_POR_SUBRECEPTOR;
        } else {
            rRc = 'N--0';
            tipoRec = 'NUEVO';
            //habilitarBoton = 'true';
        }
        $('#tipo-recurrencia-contacto').attr('value', rRc);
        $('#tipo-alcance-contacto').attr('value', tipoRec);
    }




    function validarDatos() {
        var hora = $('#horaInicio').val();
        var horaInicio = hora[0] + hora[1] + hora[3] + hora[4];
        hora = $('#horaFinal').val();
        var horaFin = hora[0] + hora[1] + hora[3] + hora[4];


        var codP = generarCodigoUnicoPemar($('#dosPrimerNombre').val(), $('#dosSegundoNombre').val(), $('#dosPrimerApellido').val(), $('#dosSegundoApellido').val(), $('#mes-nacimiento').val(), $('#ano-nacimiento').val());
        
        if ( estaVacio(codP) ) {
            alert('Es Importante el Codigo');
            setTimeout(function() {
                $('#dosPrimerNombre').focus();
            }, 2000);
            return false;
        }

        if ($('#fechaRealizacion').val() == "") {
            alert('Debe digitar la fecha de Consejeria');
            $('#fechaRealizacion').focus();
            return false;
        }

        if ($('#cedulaUsuario').val() == "") {
            alert('Debe digitar la CEDULA de Consejeria');
            $('#cedulaUsuario').focus();
            return false;
        }

        if (horaFin < horaInicio) {
            alert('La Hora de Inicio es Mayor a la De Fin de la Consejeria. Porfavor, corrijelo.');
            return false;
        }

        if ($('#sexo_hombre').is(':checked') || $('#sexo_mujer').is(':checked') || $('#sexo_trans').is(':checked')) {
        } else {
            alert('Debe elejir un sexo para el contacto');
            return false;
        }

        if ($('#lugarResidencia').val() == "") {
            alert('Debe seleccionar un canton de residencia');
            return false;
        }

        /*if ($('#tiempoAno').val() == "" && $('#tiempoMes').val() == "") {
         alert('Debe digitar un tiempo aproximado de diagnostico.');
         $('#tiempoMes').focus();
         return false;
         }*/

        if ($('#idEstablecimiento').val() == "") {
            alert('Debe seleccionar el Centro de Servicios de Salud donde recibe atención.');
            return false;
        }

        if ($('#idLugar').val() == "") {
            alert('Debe seleccionar el Tipo de Lugar donde se realizó la consejeria');
            return false;
        }

        /*if (($('#arv_si').is(':checked') && $('#idEsquema').val() != "") || $('#arv_no').is(':checked')) {
         } else {
         alert('Debe seleccionar un Esquema de ARV. ');
         return false;
         }*/

        if ($('#idConsejero').val() == "") {
            alert('Debes seleccionar el Consejero');
            return false;
        }

        return true;
    }


    function calculaEdad() {
        if (estaVacio($('#ano-nacimiento').val()))
            return false;
        if (estaVacio($('#mes-nacimiento').val()))
            return false;

        var CalEdad = calcularEdad_AnoMes('ano-nacimiento', 'mes-nacimiento', '01');

        //$('#edad-contacto').attr('readonly', false);
        $('#edadUsuario').attr('value', parseInt(CalEdad));
        //$('#edad-contacto').attr('readonly', true);
    }
    
    function no_aprobar_registro_consejeria(){
        if (estaVacio($('#observaciones_consejeria_pvvs').val())) {
                            alert('Debe escribir el motivo de la desaprobacion.');
                            return false;
                        }
        var id_consejeria = $('#registro-id').val();
        var razones_consejeria = $('#observaciones_consejeria_pvvs').val();
        ejecutarAccionJson(
                    'gestion', 'auditoriaFormularios', 'no_aprobar_consejeria_pvvs', 'razones_consejeria_pvvs='+razones_consejeria+'&registro-id-consejeria=' + id_consejeria,
                    'mostrar_resultado_guardar( data, "mostrar_lista_aprobados_consejerias_pvvs_gestor();", "" );'
                    );
    }

</script>
