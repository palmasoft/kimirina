<style>
    #from-nuevo-contacto-semanal .row-fluid [class*="span"] {
        margin: 0px;
        margin-left: 3px;
        margin-right: 3px;
    }

</style>
<form id="from-nuevo-contacto-semanal" class="form-inline bordered" onsubmit="return false;">
    <div>
        <div id="resp_validar_cedula" style="display: none;">
            <span></span>
        </div>
        <div id="datos_recurrencia" >

        </div>

        <!--/*primera fila*/-->
        <div class="row-fluid" >

            <!-- dia -->
            <div class="span1" style="width:12%;" >
                <div class="control-group">
                    <label class="control-label" for="inline-text">Día:</label>
                    <div class="controls">                                        
                        <div class="input-prepend ">
                            <span class="add-on"><i class="icon-calendar"></i></span>
                            <input type="text" id="fecha-abordaje-contacto" name="fecha-abordaje-contacto" class=" input-small input-datepicker-close span9 generadores-codigo" style="text-align: right; direction: rtl!important;" required=""  value=""  />                            
                        </div>           
                        <div class="input-prepend ">
                            <span class="add-on"><i class="icon-time"></i></span>                                              
                            <input type="text" id="hora-abordaje-contacto" name="hora-abordaje-contacto" class=" input-small input-timepicker span9 generadores-codigo">                              
                        </div>
                    </div>
                </div>
            </div>

            <!-- lugar -->
            <div class="span1" style="width:18%;" >
                <div class="control-group">
                    <label class="control-label" for="inline-text">Lugar de Abordaje:</label>
                    <div class="controls">
                        <div class="span12" >
                            <select id="tipo_lugar_intervencion_contacto" name="tipo_lugar_intervencion_contacto" class="select-chosen span12  "  required="" >
                                <option value="" data-codigo="" >TIPO DE LUGAR</option>
                                <?php foreach ($TipoLugares as $tipolugar) { ?>
                                    <option value="<?php echo $tipolugar->ID_TIPOLUGAR; ?>" data-codigo="<?php echo $tipolugar->CODIGO_TIPOLUGAR; ?>" >
                                        <?php echo ($tipolugar->NOMBRE_TIPOLUGAR); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id="lugar_intervencion_div" class=" span12 " >
                            <select id="lugar_intervencion_contacto" name="lugar_intervencion_contacto" class="select-chosen  span12 "  required=""  >
                                <option value="" data-nombre="" >LUGAR DE INTERVENCIÓN</option>   
                                <?php foreach ($Lugares as $lugar) { ?>
                                    <option value="<?php echo $lugar->ID_LUGAR; ?>" data-nombre="<?php echo ($lugar->NOMBRE_LUGAR); ?>" >
                                        <?php echo ($lugar->NOMBRE_LUGAR); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- edad -->
            <div class="span1" style="width:8%;" >
                <div class="control-group">
                    <label class="control-label" for="inline-text">Edad:</label>
                    <div class="controls"> 
                        <?php $this->formularios->lista_mes('nacimiento', 'generadores-codigo validar_cedula_codigo span12'); ?>
                        <?php $this->formularios->lista_ano('nacimiento', 'generadores-codigo validar_cedula_codigo span12', NULL, $_SESSION['SESION_USUARIO']->EDAD_MINIMA, $_SESSION['SESION_USUARIO']->EDAD_MAXIMA); ?>
                        <input type="text" id="edad-contacto" name="edad-contacto" class="span12 validar_cedula_codigo" readonly="" />
                    </div>
                </div>
            </div>

            <!-- sexo -->
            <div class="span1" style="display: none;" >
                <div class="control-group">
                    <label class="control-label" for="inline-text">Sexo:</label>
                    <div class="controls"> 
                        <label for="sexo-contacto-1">
                            <input type="radio" id="sexo-contacto-1" name="sexo-contacto" class="input-themed"  value="HOMBRE" <?php if ($tipoPoblacion == 'HSH') echo ' checked="true" '; ?>  > H                                            
                        </label>
                        <label for="sexo-contacto-2">
                            <input type="radio" id="sexo-contacto-2" name="sexo-contacto" class="input-themed" value="MUJER" <?php if ($tipoPoblacion == 'TS') echo ' checked="true" '; ?>  > M
                        </label>                                               
                        <label for="sexo-contacto-3">
                            <input type="radio" id="sexo-contacto-3" name="sexo-contacto" class="input-themed" value="TRANS" <?php if ($tipoPoblacion == 'TRANS') echo ' checked="true" '; ?> > T
                        </label>                           
                    </div>
                </div>
            </div>

            <!-- cc -->            
            <div class="span2" style="width:15%;"  >
                <div class="control-group">
                    <label class="control-label" for="inline-text">C.C.</label>
                    <div class="controls"> 
                        <input type="text" maxlength="10" size="10" id="cedula-contacto" name="cedula-contacto" class=" generadores-codigo  span12 sinEspacio"  min="0" placeholder="" />                        
                        <label for="chk-cedula-verificada">
                            <input type="checkbox" id="chk-cedula-verificada" name="chk-cedula-verificada" class="input-themed" value="VERFICADA" > Verificada
                        </label>
                    </div>
                </div>
            </div>

            <!-- nomres y apellidos -->            
            <div class="span2" style="width:10%;"  >
                <div class="control-group">
                    <label class="control-label" for="inline-text">Nombres y Apellidos:</label>
                    <div class="controls">   
                        <input type="text" id="primer-nombre" name="primer-nombre" class="soloLetras generadores-codigo validar_cedula_codigo mayusculas span12" placeholder="primer nombre" />
                        <input type="text" id="segundo-nombre" name="segundo-nombre" class="soloLetras generadores-codigo validar_cedula_codigo mayusculas span12" placeholder="segundo nombre"   />
                        <input type="text" id="primer-apellido" name="primer-apellido" class="soloLetras generadores-codigo validar_cedula_codigo mayusculas span12" placeholder="primer apellido"   />
                        <input type="text" id="segundo-apellido" name="segundo-apellido"  class="soloLetras generadores-codigo validar_cedula_codigo mayusculas span12" placeholder="segundo apellido"   />
                        <input type="text" id="otro-nombre" name="otro-nombre" class="soloLetras generadores-codigo mayusculas span12" placeholder="Otro nombre" />
                    </div>
                </div>
            </div>

            <!-- telefono -->  
            <div class="span1" style="width:12%;"  >
                <div class="control-group">
                    <label class="control-label" for="inline-text">Teléfono (cel o fijo):</label>
                    <div class="controls">
                        <input type="number" id="telefono-contacto" name="telefono-contacto"  class=" span12 sinEspacio"  min="0" placeholder="" />
                    </div>
                </div>
            </div>

            <!-- trabajo sexual -->  
            <div class="span1" style="width:6%;"  >
                <div class="control-group">
                    <label class="control-label" for="inline-text">TS:</label>
                    <div class="controls"> 
                        <label for="trabajo-sexual-contacto-1">
                            <input type="radio" id="trabajo-sexual-contacto-1" name="trabajo-sexual-contacto" class="input-themed" style="width: 100%;" 
                                   value="SI" <?php if ($tipoPoblacion == 'TS') echo 'checked="" '; ?> > SI                                            
                        </label>
                        <label for="trabajo-sexual-contacto-2">
                            <input type="radio" id="trabajo-sexual-contacto-2" name="trabajo-sexual-contacto" class="input-themed" style="width: 100%;" 
                                   value="NO" <?php if ($tipoPoblacion != 'TS') echo 'checked="" '; ?> > NO
                        </label>                           
                    </div>
                </div>
            </div>

            <!-- tipo de alcance -->  
            <div class="span1" style="width:10%; display: none; " >
                <div class="control-group">
                    <label class="control-label" for="inline-text">N/R:</label>
                    <div class="controls">
                        <input type="text" id="tipo-recurrencia-contacto" name="tipo-recurrencia-contacto" value="N" class=" span12 "  readonly />
                        <input type="hidden" id="tipo-alcance-contacto" name="tipo-alcance-contacto" value="NUEVO"  />                        
                    </div>
                </div>
            </div>

        </div>

        <!--/*segunda fila*/-->
        <div class="row-fluid" >

            <div class="span4" >
                <div class="control-group">
                    <label class="control-label" for="temas_tratados_contacto">Tema Tratado:</label>
                    <div class="controls">
                        <select id="temas_tratados_contacto" name="temas_tratados_contacto" class="select- span12 select-chosen " required="" >                                    
                            <option value=""  data-nombre=""  >Seleccione el tema tratado</option>
                            <?php foreach ($Temas as $tema) { ?>
                                <option value="<?php echo $tema->ID_TEMA; ?>" data-nombre="<?php echo ($tema->TITULO_TEMA); ?>" >
                                    <?php echo ($tema->TITULO_TEMA); ?>                                        
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="span4" >
                <div class="control-group">
                    <label class="control-label" for="servicio_salud_derivado">Servicio de Salud al que deriva:</label>
                    <div id="listado-establecimiento" class="controls">
                        <select id="centro_servicio_salud_derivado" name="centro_servicio_salud_derivado" class="select-chosen span12"  >
                            <option value="" data-nombre=""  selected="true" >No fue atendido</option>
                            <optgroup label="ECUADOR" >
                            <?php foreach ($CentrosSalud as $centro) { ?>
                                <option value="<?php echo $centro->ID_CENTROSERVICIO; ?>"  data-nombre="<?php echo ($centro->NOMBRE_CENTROSERVICIO); ?>"  >                                    
                                    <?php echo ($centro->NOMBRE_CENTROSERVICIO . " [" . $centro->NOMBRE_TIPO_CENTROSERVICIO . "]"); ?>                                        
                                </option>
                            <?php } ?>
                            </optgroup>
                        </select>
                    </div>
                </div>
            </div>

            <div class="span2" style="display:none;" >
                <div class="control-group">
                    <label class="control-label" for="input-datepicker-comp" data-toggle="tooltip" title="fecha y hora ultima atencion" >Fecha y Hora de Atención:</label>
                    <div class="controls">
                        <div class="input-prepend ">
                            <span class="add-on"><i class="icon-calendar"></i></span>
                            <input type="text" id="fecha-atencion-contacto" name="fecha-atencion-contacto" class="input-small input-datepicker-close">                            
                        </div>           
                        <div class="input-prepend ">
                            <span class="add-on"><i class="icon-time"></i></span>                                              
                            <input type="text" id="hora-atencion-contacto" name="hora-atencion-contacto" class="input-small input-timepicker">                              
                        </div>
                    </div>
                </div>
            </div>


            <div class="span4" style="border: thin black double;" >

                <label class="control-label" for="general-append11"  style="margin:0px;padding: 0px;" >Paquetes de Prevención:</label>
                <div class="controls"  style="margin:0px;padding: 0px;" >

                    <div class="span4 " style="margin:0px;padding: 0px;" >
                        <label class="control-label" for="cantidad-folletos-entregados-contacto" style="margin:0px;padding: 0px;">Información:</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">#</span>
                                <input type="number" min="0" id="cantidad-folletos-entregados-contacto" placeholder="0"  value=""
                                       name="cantidad-folletos-entregados-contacto" class="input-mini" required="" >

                            </div>
                        </div>                        
                    </div>

                    <div class="span4 " style="margin:0px;padding: 0px;" >
                        <label class="control-label" for="cantidad-condones-entregados-contacto" style="margin:0px;padding: 0px;">Condones:</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">#</span>
                                <input type="number" min="0"  value="<?php echo $maximoCondones; ?>"  id="cantidad-condones-entregados-contacto"  placeholder="0"  value=""
                                       name="cantidad-condones-entregados-contacto" class="input-mini insumos-entregados" required="" readonly="">

                            </div>
                        </div>
                    </div>

                    <div class="span4 " style="margin:0px;padding: 0px;" >
                        <label class="control-label" for="cantidad-lubricantes-entregados-contacto" style="margin:0px;padding: 0px;">Lubicantes:</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">#</span>
                                <input type="number" min="0" id="cantidad-lubricantes-entregados-contacto" placeholder="0"  value="<?php echo $maximoLubricantes; ?>"
                                       name="cantidad-lubricantes-entregados-contacto" class="input-mini insumos-entregados" required="" readonly="">
                            </div>
                        </div>                  
                    </div>
                </div>
            </div>


        </div>

        <div class="row-fluid" >
            <div class="span6" >   
                <div class="control-group">
                    <label class="control-label" for="observacion-contacto">Observaciones:</label>
                    <div class="controls">
                        <textarea id="observacion-contacto" name="observacion-contacto" class=" " style="width: 100%;"></textarea>                    
                    </div>
                </div>                        
            </div>        

            <div class="span3" >
                <div class="control-group">
                    <label class="control-label" for="inline-text">Código contacto abordado:</label>
                    <div class="controls"> 
                        <input type="text" class=" validar_cedula_codigo span12" id="codigo-pemar-generado" name="codigo-pemar" 
                               style="text-transform: uppercase;font-size: 125%;text-align: center;" readonly required />
                    </div>
                </div>
            </div>

            <div class="span3">
                <!-- Form Buttons -->
                <div class="form-actions">
                    <button id="btn_validar_datos" type="button" class="btn btn-info"><i class="icon-check"></i> Validar </button>
                    <button id="btn_agregar_contacto_tabla" type="submit" class="btn btn-success" disabled ><i class="icon-save"></i> Agregar</button>                   
                    <button id="btn_limpiar_contacto_tabla" type="button" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button> 
                </div>
                <!-- END Form Buttons -->
            </div>

        </div>

    </div>
</form>


<script>
    var oTable = null;
    var codActualEditando = '';
    $(document).ready(function() {
        $('#tipo_lugar_intervencion_contacto').on('change', function(e) {
            cargar_lugar_de_intervencion();
            <?php if (!$tieneRestricciones or Usuario::esDNI()): ?>
                habilitarPaquetePrevencion();
            <?php endif; ?>
        });

        $('#ano-nacimiento').on('change', function(e) {
            calculaEdad();
        });
        $('#mes-nacimiento').on('change', function(e) {
            calculaEdad();
        });

        $('#btn_validar_datos').on('click', function(e) {
            generarCodigo();
            e.preventDefault();
        });

        $('#btn_limpiar_contacto_tabla').on('click', function(e) {
            if (!estaVacio(codActualEditando)) {
                confirm('¿Seguro que desea eliminar este <strong>Alcance de la Hoja</strongs> de registro?', 'eliminar_abordaje_hoja();');
            } else {
                confirm('¿Seguro que desea limpiar el formulario o borrar <strong>los datos digitados del Alcance</strongs> ?', 'resetear_formulario_abordaje();');                
            }
            e.preventDefault();
            return false;
        });


        $('.generadores-codigo').on('change', function(e) {
            activar_boton_formatos('btn_agregar_contacto_tabla', 'false');
            e.preventDefault();
        });
        $(".validar_cedula_codigo").on('change', function(e) {
            activar_boton_formatos('btn_agregar_contacto_tabla', 'false');
            e.preventDefault();
        });

        $('#from-nuevo-contacto-semanal').submit(function(event) {
            if (event.handled !== true) {
                agregar_alcance_a_tabla();
                event.handled = true;
            }
            return false;

        });

        $('.insumos-entregados').on('change', function(e) {

            var item3 = $('#cantidad-condones-entregados-contacto').val();
            if (estaVacio(item3))
                return false;
            var item1 = $('#cantidad-lubricantes-entregados-contacto').val();
            if (estaVacio(item1))
                return false;
            if (!comprobar_relacion_3_1(item3, item1)) {
                $('#cantidad-lubricantes-entregados-contacto').val(0);
                $('#cantidad-lubricantes-entregados-contacto').focus();
                alert('la cantidad de lubricantes entregados, según los condones digitados, no es valida.');
            }
        });

        agregar_eventos_click();
        $('#tabla-contactos-registrados-semana').dataTable();
    });

    function habilitarPaquetePrevencion() {
        var tipoLug = $('#tipo_lugar_intervencion_contacto option:selected').attr('data-codigo');

        $('#cantidad-condones-entregados-contacto').attr('readonly', 'true');
        $('#cantidad-condones-entregados-contacto').val('<?php echo $maximoCondones; ?>');
        $('#cantidad-lubricantes-entregados-contacto').attr('readonly', 'true');
        $('#cantidad-lubricantes-entregados-contacto').val('<?php echo $maximoLubricantes; ?>');
        if (tipoLug === 'CAIACL') {
            $('#cantidad-condones-entregados-contacto').removeAttr('readonly');
            $('#cantidad-condones-entregados-contacto').val('0');
            $('#cantidad-lubricantes-entregados-contacto').removeAttr('readonly');
            $('#cantidad-lubricantes-entregados-contacto').val('0');
        }
    }

    function cargar_lugar_de_intervencion() {
        cargar_lugares_intervencion_normal(
                "lugar_intervencion_div", "lugar_intervencion_contacto",
                $('#tipo_lugar_intervencion_contacto').val(), $('#provincia-chosen').val(), $('#sel-lista-cantones').val()
                );
    }
    function cargar_centros_de_salud() {
        cargar_centros_salud_semanal_contacto(
                "listado-establecimiento", 'centro_servicio_salud_derivado',
                $("#sel-lista-cantones").val()
                );
    }


    function eliminar_abordaje_hoja() {
        if (!estaVacio(codActualEditando)) {
            informacion('<h4>Se ha eliminado el <strong>Alcance de la Hoja</strong>.</h4> Debe guardar para que los cambios tengan efecto.', 'Eliminado Abordaje');
        }
        resetear_formulario_abordaje();
    }

    function resetear_formulario_abordaje() {
        activar_boton_formatos('btn_agregar_contacto_tabla', 'false');

        $('#chk-cedula-verificada').iCheck('uncheck');
        $('#edad-contacto').attr('value', '');
        $('#codigo-pemar-generado').attr('value', '');

        <?php if ($tipoPoblacion == 'TS'): ?>
            $trabajoSexual = 'SI'
        <?php else: ?>
            $trabajoSexual = 'NO'
        <?php endif; ?>
        $("input[name='trabajo-sexual-contacto'][value='" + $trabajoSexual + "']").iCheck('check');

        $('#tipo_lugar_intervencion_contacto option[value=""]').attr("selected", "selected");        
        $('#tipo_lugar_intervencion_contacto').trigger("liszt:updated");
        cargar_lugar_de_intervencion();
        
        $('#temas_tratados_contacto option[value=""]').attr("selected", "selected");        
        $('#temas_tratados_contacto').trigger("liszt:updated");
        cargar_centros_de_salud();
        
        $('#codigo-pemar-generado').attr('value','');

        document.getElementById("from-nuevo-contacto-semanal").reset();

        codActualEditando = '';
        $('#btn_limpiar_contacto_tabla').html('<i class="icon-repeat"></i> Limpiar');


        $('#resp_validar_cedula').slideUp();
        $('#datos_recurrencia').slideUp();
        
        setTimeout(function(e){
            $('#fecha-abordaje-contacto').focus();
        }, 3200);        
        return false;
    }


    var numRegistros = 0;
    var habilitarBoton = 'false';

    function generarCodigo() {
        activar_boton_formatos('btn_agregar_contacto_tabla', 'false');

        $('#resp_validar_cedula').slideUp();
        $('#datos_recurrencia').slideUp();

        var CUP = '';
        <?php if (Usuario::esDNI()): ?>
            CUP = generarCodigoUnicoPemarDNI(
                    $('#primer-nombre').val(), $('#segundo-nombre').val(),
                    $('#primer-apellido').val(), $('#segundo-apellido').val(),
                    $('#mes-nacimiento').val(), $('#ano-nacimiento').val()
                    );
            if ($('#mes-nacimiento').val() == "") {
                var mes = generarMesPrimerNmbre($('#mes-nacimiento').val(), $('#primer-nombre').val());
                $('#mes-nacimiento').val(mes);
            }
            if ($('#ano-nacimiento').val() == "") {
                var agnio = generarAgnioPrimerApellido($('#ano-nacimiento').val(), $('#primer-apellido').val());
                $('#ano-nacimiento').val(agnio);
            }
            <?php else: ?>
            CUP = generarCodigoUnicoPemar(
                    $('#primer-nombre').val(), $('#segundo-nombre').val(),
                    $('#primer-apellido').val(), $('#segundo-apellido').val(),
                    $('#mes-nacimiento').val(), $('#ano-nacimiento').val()
                    );
            <?php endif; ?>
        $('#codigo-pemar-generado').attr('value', CUP.toString());

        var cedPemar = $('#cedula-contacto').val();
        var codPemar = $('#codigo-pemar-generado').val();
        if (estaVacio($('#ano-nacimiento').val()) || estaVacio($('#mes-nacimiento').val())) {
            codPemar = '';
        } else if (estaVacio($('#primer-nombre').val()) && estaVacio($('#segundo-nombre').val()) && estaVacio($('#primer-apellido').val()) && estaVacio($('#segundo-apellido').val())) {
            if (estaVacio(cedPemar)) {
                codPemar = '';
            }
        } else if (estaVacio($('#fecha-abordaje-contacto').val())) {
            codPemar = '';
        }

        if (!estaVacio(codPemar)) {
            
            avisos_valida_cedula_codigo(cedPemar, codPemar, 'resp_validar_cedula');
            if (codActualEditando != CUP) {
            
                cantidad_de_abordajes(
                        CUP, $('#fecha-abordaje-contacto').val(), $('#hora-abordaje-contacto').val(),
                        'mostrar_recurrencia_promotores(data);'
                        );
               
            }
            activar_boton_formatos('btn_agregar_contacto_tabla', 'true');
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
        if (!$.isEmptyObject(jsonData)){
            if (jsonData[4].POR_PROMOTOR_POR_SUBRECEPTOR === 'NUEVO') {
                rRc = 'N-';
                //habilitarBoton = 'true';
            } else {
                rRc = 'R-';
                if ((parseInt(jsonData[1].ABORDAJES_PROMOTOR) < 1) && (parseInt(jsonData[0].ABORDAJES_PROMOTOR < 12))) {
                    //habilitarBoton = 'true';
                } else if ((parseInt(jsonData[1].ABORDAJES_PROMOTOR) >= 1) || (parseInt(jsonData[0].ABORDAJES_PROMOTOR >= 12))) {
                    if (jsonData[4].POR_PROMOTOR_POR_SUBRECEPTOR_POR_PERIODO === 'NUEVO') {
                        //habilitarBoton = 'true';
                    } else {
                        // habilitarBoton = 'false';
                    }
                } else {
                    //habilitarBoton = 'false';
                }
            }
//            $('#datos_recurrencia').html('<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button>' +
//                    '<h4><strong><i class="icon-info-sign"></i></strong> Información de Abordajes de Promotores</h4>' +
//                    '<div>Por Todo el Proyecto => ' +
//                    'Es <b>' + jsonData[4].POR_PROMOTOR + '</b> este año: <b>' + jsonData[2].ABORDAJES_PROMOTOR + '</b>, este mes: ' + jsonData[3].ABORDAJES_PROMOTOR + '.<br />' +
//                    'Por <b>' + jsonData[0].SIGLAS_SUBRECEPTOR + '</b> => ' +
//                    'Es <b>' + jsonData[4].POR_PROMOTOR_POR_SUBRECEPTOR + '</b> este año: <b>' + jsonData[0].ABORDAJES_PROMOTOR + '</b>, este mes: <b>' + jsonData[1].ABORDAJES_PROMOTOR + '</b>.' +
//                    '</div>' +
//                    '<em>Esta información se computa teniendo como base la fecha y hora de contacto digitada. Esta información es temporal, y depende de los registros en el sistema.</em></div>'
//                    );
//            $('#datos_recurrencia').slideDown();
            rRc += jsonData[2].ABORDAJES_PROMOTOR + '-' + jsonData[2].ABORDAJES_ANIMADOR + '';
            tipoRec = jsonData[4].POR_PROMOTOR_POR_SUBRECEPTOR;
        } else {
            rRc = 'N-0-0';
            tipoRec = 'NUEVO';
            //habilitarBoton = 'true';
        }
        $('#tipo-recurrencia-contacto').attr('value', rRc);
        $('#tipo-alcance-contacto').attr('value', tipoRec);
    }

    function calculaEdad() {

        if (estaVacio($('#ano-nacimiento').val()))
            return false;
        if (estaVacio($('#mes-nacimiento').val()))
            return false;

        var CalEdad = calcularEdad_AnoMes('ano-nacimiento', 'mes-nacimiento', '01');
        $('#edad-contacto').attr('value', parseInt(CalEdad));
    }


    function agregar_alcance_a_tabla() {

        var fechaMinima = $('#fecha_contacto_inicio_semana').val();
        var fechaMaxima = $('#fecha_contacto_fin_semana').val();

        var fecha = $('#fecha-abordaje-contacto').val();

        if (!(fecha >= fechaMinima && fecha <= fechaMaxima)) {
            alert('El dia de intervencion es invalido');
            return null;
        }

        if ($('#tipo_lugar_intervencion_contacto').val() == '') {
            alert('Debes Seleccionar el TIPO DE LUGAR del abordaje.');
            return null;
        }

        if ($('#lugar_intervencion_contacto').val() == '') {
            alert('Debes Seleccionar el LUGAR de abordaje.');
            $('#lugar_intervencion_contacto').focus();
            return null;
        }

        if ($('#mes-nacimiento').val() == '') {
            alert('Debes Seleccionar el MES de nacimiento del contacto .');
            return null;
        }

        if ($('#ano-nacimiento').val() == '') {
            alert('Debes Seleccionar el AÑO de nacimiento del contacto.');
            return null;
        }

        if ($('#temas_tratados_contacto').val() == '') {
            alert('Debes Seleccionar el TEMA TRATADO durante el abordaje.');
            return null;
        }

        var yaExiste = false;
        $("#tabla-contactos-registrados-semana-datos tbody tr input[name='codigoAbordaje[]']").each(function(i, value) {
            if ($(this).val() == $('#codigo-pemar-generado').val()) {
                yaExiste = true;
                return false;
            }
        });
        if (yaExiste) {
            alert("El Codigo " + $('#codigo-pemar-generado').val() + " ya se encuentra registrado en esta Hoja de Contactos.");
            return false;
        }

        $('#resp_validar_cedula').slideUp();
        $('#datos_recurrencia').slideUp();

        numRegistros++;
        var fechaAbordaje = $('#fecha-abordaje-contacto').val();
        var horaAbordaje = $('#hora-abordaje-contacto').val();
        var tipoLugarAbordaje = $("#tipo_lugar_intervencion_contacto option[value=" + $("#tipo_lugar_intervencion_contacto").val() + "]").text();
        var idTipoLugarAbordaje = $("#tipo_lugar_intervencion_contacto").val();
        var lugarAbordaje = $('#lugar_intervencion_contacto').val();
        var nombreLugarAbordaje = $("#lugar_intervencion_contacto option[value=" + $('#lugar_intervencion_contacto').val() + "]").text();
        var edadAbordaje = parseInt($('#edad-contacto').val());
        var anoNace = $('#ano-nacimiento').val();
        var mesNace = $('#mes-nacimiento').val();

        var sexo = $("input[name='sexo-contacto']:checked").val();

        var CC = $('#cedula-contacto').val();
        var CCVerficada = $('#chk-cedula-verificada').attr('checked') ? 'SI' : 'NO';
        var otroNombre = $('#otro-nombre').val();
        var priNombre = $('#primer-nombre').val();
        var segNombre = $('#segundo-nombre').val();
        var priApellido = $('#primer-apellido').val();
        var segApellido = $('#segundo-apellido').val();
        var telefono = $('#telefono-contacto').val();

        var TS = $("input[name='trabajo-sexual-contacto']:checked").val();
        var tipoAlcance = $('#tipo-recurrencia-contacto').val();
        var alcance = $('#tipo-alcance-contacto').val();
        var codigoPEMAR = $('#codigo-pemar-generado').val();

        var nombreTema = $("#temas_tratados_contacto option[value=" + $("#temas_tratados_contacto").val() + "]").attr('data-nombre');
        var temaTratado = $("#temas_tratados_contacto").val();

        var nombreCentroSalud = $("#centro_servicio_salud_derivado option[value=" + $("#centro_servicio_salud_derivado").val() + "]").attr('data-nombre');
        var centroSalud = $("#centro_servicio_salud_derivado").val();
        var fechaSalud = $("#fecha-atencion-contacto").val();
        var horaSalud = $("#hora-atencion-contacto").val();

        var cantCondones = $('#cantidad-condones-entregados-contacto').val();
        var cantLubricantes = $('#cantidad-lubricantes-entregados-contacto').val();
        var cantInformacion = $('#cantidad-folletos-entregados-contacto').val();

        var observaciones = $('#observacion-contacto').val();

        $('#tabla-contactos-registrados-semana').dataTable().fnDestroy();
        $('#tabla-contactos-registrados-semana tbody').prepend(
                '<tr title="doble-click para modificar este alcance." alcance-id="' + codigoPEMAR + '" class="" >' +
                '<td class="">#</td>' +
                '<td class="">' + fechaAbordaje + '<br/>' + horaAbordaje + '</td>' +
                '<td class="">' + tipoLugarAbordaje + '<br/>' + nombreLugarAbordaje + '</td>' +
                '<td class="">' + edadAbordaje + '</td>' +
                '<td class="">' + sexo.substr(0, 1) + '</td>' +
                '<td class="">' + CC + '</td>' +
                '<td class="">' + priNombre + " " + segNombre + " " + priApellido + " " + segApellido + "<br/>" + otroNombre + '</td>' +
                '<td class="">' + telefono + '</td>' +
                '<td class="">' + TS + '</td>' +
                '<td class="">' + alcance.substr(0, 1) + '</td>' +
                '<td class="">' + codigoPEMAR + '</td>' +
                '<td class="">' + nombreTema + '</td>' +
                '<td class="">' + nombreCentroSalud + '</td>' +
                '<td class="">' + cantInformacion + '</td>' +
                '<td class="">' + cantCondones + '</td>' +
                '<td class="">' + cantLubricantes + '</td>' +
                '<td class="">' + CCVerficada + '</td>' +
                '</tr>'
                );
        $('#tabla-contactos-registrados-semana-datos tbody').prepend(
                '<tr id="' + codigoPEMAR + '" >' +
                '<td class=""><input type="hidden" name="obserAbordaje[]" value="' + observaciones + '" /></td>' +
                '<td class=""><input type="hidden" id="fecha-contacto-' + numRegistros + '"  name="fecha-contacto[]" value="' + fechaAbordaje + '" />' +
                '<input type="hidden" id="hora-contacto-' + numRegistros + '"  name="hora-contacto[]" value="' + horaAbordaje + '" /></td>' +
                '<td class=""><input type="hidden" id="tipolugar-abordaje-' + numRegistros + '"  name="tipolugar-abordaje[]" value="' + idTipoLugarAbordaje + '" />' +
                '<input type="hidden" id="lugar-abordaje-' + numRegistros + '"  name="lugar-abordaje[]" value="' + lugarAbordaje + '" /></td>' +
                '<td class=""><input type="hidden" id="edadAbordaje-' + numRegistros + '" name="edadAbordaje[]" value="' + edadAbordaje + '" />' +
                '<input type="hidden" name="anoNaceAbordaje[]" value="' + anoNace + '" />' +
                '<input type="hidden" name="mesNaceAbordaje[]" value="' + mesNace + '" /></td>' +
                '<td class=""><input type="hidden" name="sexoAbordaje[]" value="' + sexo + '" /></td>' +
                '<td class=""><input type="hidden" name="cedulaAbordaje[]" value="' + CC + '" /></td>' +
                '<td class=""><input type="hidden" name="primerNombreAbordaje[]" value="' + priNombre + '" />' +
                '<input type="hidden" name="segundoNombreAbordaje[]" value="' + segNombre + '" />' +
                '<input type="hidden" name="primerApellidoAbordaje[]" value="' + priApellido + '" />' +
                '<input type="hidden" name="segundoApellidoAbordaje[]" value="' + segApellido + '" />' +
                '<input type="hidden" name="otroNombreAbordaje[]" value="' + otroNombre + '" /></td>' +
                '<td class=""><input type="hidden" name="telefonoAbordaje[]" value="' + telefono + '" /></td>' +
                '<td class=""><input type="hidden" name="trabajoSexualAbordaje[]" value="' + TS + '" /></td>' +
                '<td class=""><input type="hidden" name="alcanceAbordaje[]" value="' + alcance + '" />' +
                '<input type="hidden" name="tipoAlcanceAbordaje[]" value="' + tipoAlcance + '" /></td>' +
                '<td class=""><input type="hidden" name="codigoAbordaje[]" value="' + codigoPEMAR + '" /></td>' +
                '<td class=""><input type="hidden" name="temaAbordaje[]" value="' + temaTratado + '" /></td>' +
                '<td class=""><input type="hidden" name="servicioSaludAbordaje[]" value="' + centroSalud + '" />' +
                '<input type="hidden" name="fechaAtencionAbordaje[]" value="' + fechaSalud + '" />' +
                '<input type="hidden" name="horaAtencionAbordaje[]" value="' + horaSalud + '" /></td>' +
                '<td class=""><input type="hidden" name="cantInfoAbordaje[]" value="' + cantInformacion + '" /></td>' +
                '<td class=""><input type="hidden" name="cantCondonesAbordaje[]" value="' + cantCondones + '" /></td>' +
                '<td class=""><input type="hidden" name="cantLubricantesAbordaje[]" value="' + cantLubricantes + '" /></td>' +
                '<td class=""><input type="hidden" name="cedulaVerificada[]" value="' + CCVerficada + '" /></td>' +
                '</tr>'
                );

        agregar_eventos_click();
        $('#tabla-contactos-registrados-semana').dataTable();

        resetear_formulario_abordaje();
        informacion('Se agregó el <strong>Alcance a la Hoja</strong> de Registro.', 'Abordajes de Promotor');
    }
    function verificar_integridad_datos() {
        generarCodigo();
    }

    function agregar_eventos_click() {


        $('#tabla-contactos-registrados-semana tbody tr').dblclick(function(e) {
            if (event.handled !== true) {
                $(this).addClass('row_selected');
                var cargado = cargar_datos_alcance_tabla_contacto($(this).attr('alcance-id'));
                if (cargado) {
                    var aPos = $('#tabla-contactos-registrados-semana').dataTable().fnGetPosition(this);
                    $('#tabla-contactos-registrados-semana').dataTable().fnDeleteRow(aPos);
                    $(this).hide('slow');
                }
                
                //alert( codActualEditando );

                event.handled = true;
            }
            return false;
        });

        $('#tabla-contactos-registrados-semana tbody tr').click(function(e) {
            if (event.handled !== true) {
                if ($(this).hasClass('row_selected')) {
                    $(this).removeClass('row_selected');
                }
                else {
                    $('#tabla-contactos-registrados-semana tbody tr.row_selected').removeClass('row_selected');
                    $(this).addClass('row_selected');
                }
                event.handled = true;
            }
            return false;
        });

    }



    function cargar_datos_alcance_tabla_contacto(idFila) {

        var fila = "#tabla-contactos-registrados-semana-datos tbody tr#" + idFila;

        if (!estaVacio(codActualEditando)) {
            alert('Actualmente estas editando un abordaje para <strong>' + codActualEditando + '</strong>');
            return false;
        }

//            var oTable = $('#tabla-contactos-registrados-semana-datos').dataTable();
//            var data = oTable.fnGetData(fila);
        var obsAbordaje = $(fila + " input[name='obserAbordaje[]']").val();
        var fchAbordaje = $(fila + " input[name='fecha-contacto[]']").val();
        var horaAbordaje = $(fila + " input[name='hora-contacto[]']").val();
        var tipoLugarAbordaje = $(fila + " input[name='tipolugar-abordaje[]']").val();
        var lugarAbordaje = $(fila + " input[name='lugar-abordaje[]']").val();
        var edadAbordaje = $(fila + " input[name='edadAbordaje[]']").val();
        var mesEdadAbordaje = $(fila + " input[name='mesNaceAbordaje[]']").val();
        var anoEdadAbordaje = $(fila + " input[name='anoNaceAbordaje[]']").val();
        var sexoAbordaje = $(fila + " input[name='sexoAbordaje[]']").val();
        var ccAbordaje = $(fila + " input[name='cedulaAbordaje[]']").val();
        var priNombreAbordaje = $(fila + " input[name='primerNombreAbordaje[]']").val();
        var segNombreAbordaje = $(fila + " input[name='segundoNombreAbordaje[]']").val();
        var priApellAbordaje = $(fila + " input[name='primerApellidoAbordaje[]']").val();
        var segApellAbordaje = $(fila + " input[name='segundoApellidoAbordaje[]']").val();
        var otroNombreAbordaje = $(fila + " input[name='otroNombreAbordaje[]']").val();
        var telfAbordaje = $(fila + " input[name='telefonoAbordaje[]']").val();
        var tsAbordaje = $(fila + " input[name='trabajoSexualAbordaje[]']").val();
        var alcanceAbordaje = $(fila + " input[name='alcanceAbordaje[]']").val();
        var tipoAlcanceAbordaje = $(fila + " input[name='tipoAlcanceAbordaje[]']").val();
        var codAbordaje = $(fila + " input[name='codigoAbordaje[]']").val();
        var temaAbordaje = $(fila + " input[name='temaAbordaje[]']").val();
        var servicioAbordaje = $(fila + " input[name='servicioSaludAbordaje[]']").val();
        var fechaServicioAbordaje = $(fila + " input[name='fechaAtencionAbordaje[]']").val();
        var horaServicioAbordaje = $(fila + " input[name='horaAtencionAbordaje[]']").val();
        var infoAbordaje = $(fila + " input[name='cantInfoAbordaje[]']").val();
        var condAbordaje = $(fila + " input[name='cantCondonesAbordaje[]']").val();
        var lubrAbordaje = $(fila + " input[name='cantLubricantesAbordaje[]']").val();
        var cedVerificada = $(fila + " input[name='cedulaVerificada[]']").val();

        $('#codigo-pemar-generado').val(codAbordaje);

        $("#tipo_lugar_intervencion_contacto option[value='" + tipoLugarAbordaje + "'] ").attr('selected', "selected");        
        $('#tipo_lugar_intervencion_contacto').trigger("liszt:updated");
                
        cargar_lugares_intervencion_normal_seleccionar (
                "lugar_intervencion_div", "lugar_intervencion_contacto",
                tipoLugarAbordaje, $('#provincia-chosen').val(), $('#sel-lista-cantones').val(), lugarAbordaje
                );

        $('#observacion-contacto').val(obsAbordaje);
        $('#fecha-abordaje-contacto').val(fchAbordaje);
        $('#hora-abordaje-contacto').val(horaAbordaje);
        $('#edad-contacto').val(edadAbordaje);
        $('#ano-nacimiento').val(anoEdadAbordaje);
        $('#mes-nacimiento').val(mesEdadAbordaje);
//
        $("input[name='sexo-contacto'][value='" + sexoAbordaje + "']").iCheck('check');
//
//
        $('#cedula-contacto').val(ccAbordaje);
        $('#primer-nombre').val(priNombreAbordaje);
        $('#segundo-nombre').val(segNombreAbordaje);
        $('#primer-apellido').val(priApellAbordaje);
        $('#segundo-apellido').val(segApellAbordaje);
        $('#otro-nombre').val(otroNombreAbordaje);
        $('#telefono-contacto').val(telfAbordaje);
//
//
//
        $('#tipo-alcance-contacto').val(tipoAlcanceAbordaje);
        $('#tipo-recurrencia-contacto').val(alcanceAbordaje);

        $("input[name='trabajo-sexual-contacto'][value='" + tsAbordaje + "']").iCheck('check');
        
        $('#temas_tratados_contacto option[value="'+temaAbordaje+'"]').attr("selected", "selected");        
        $('#temas_tratados_contacto').trigger("liszt:updated");
        
        $('#centro_servicio_salud_derivado option[value="' +servicioAbordaje+'" ]').attr("selected", "selected");        
        $('#centro_servicio_salud_derivado').trigger("liszt:updated");
        
        $("#fecha-atencion-contacto").val(fechaServicioAbordaje);
        $("#hora-atencion-contacto").val(horaServicioAbordaje);

        $('#cantidad-folletos-entregados-contacto').val(infoAbordaje);
        $('#cantidad-condones-entregados-contacto').val(condAbordaje);
        $('#cantidad-lubricantes-entregados-contacto').val(lubrAbordaje);

        if (cedVerificada == 'SI') {
            $('#chk-cedula-verificada').iCheck('check');
        } else {
            $('#chk-cedula-verificada').iCheck('uncheck');
        }

        informacion('Se esta editando el abordaje para el codigo <strong>' + codAbordaje + '</strong>.', 'Abordaje por Promotores.');

        codActualEditando = codAbordaje;
        $('#btn_limpiar_contacto_tabla').html('<i class="icon-trash"></i> Eliminar');

        var lugar = lugarAbordaje;
        $("#lugar_intervencion_contacto option[value='" + lugar + "']").attr('selected', true);

        if (estaVacio($('#registro-id').val())) {
            validar_tipo_alcance(codAbordaje, 'tipo-alcance-contacto');
            cantidad_de_abordajes(codAbordaje, 'mostrar_recurrencia_promotores');
        }
        verificar_integridad_datos();

        $(fila).remove();
        numRegistros--;

        return true;

    }
</script>

