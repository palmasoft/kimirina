
<form id="form-contacto-animador" class="form-inline" onsubmit="return false;" >  

    <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->ID_CONTACTOANIMADOR) : ''; ?>" />
    <input type="hidden" name="alcance" value="NUEVO" />
    <input type="hidden" id="dir_archivo_soporte"  name="dir_archivo_soporte" value="" />

    <div class="block block-themed">
        <div class="block-title"><h4>Formulario de Contacto por Animador</h4></div>
        <div class="block-content "> 
            <div class="row-fluid">
                <div class="span6">
                    <div class="control-group">                    
                        <label class="control-label" for="num_recibo" style="font-weight: bold;font-size: 150%;" >Recibo No.</label>
                        <div class="controls" >
                            <input type="number" id="num_recibo" required="" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->NO_RECIBO_CONTACTOANIMADOR) : ''; ?>" name="num_recibo" class="span8" placeholder="000000000" style="color: #ff0000;font-weight: bold;" />
                            -<input id="subreceptor" name="subreceptor" readonly="readonly" class="span2" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->CODIGO_SUBRECEPTOR_CONTACTOANIMADOR) : $_SESSION['SESION_USUARIO']->CODIGO_SUBRECEPTOR; ?>" style="font-weight: bold;font-size: 150%;"  />                                
                        </div>  
                    </div>
                </div>

                <div class="span6">
                    <div class="control-group">                    
                        <label class="control-label " for="tipo_pemar"  style="font-weight: bold;font-size: 100%;">Código de Población: <strong><span id="cod_tipo_poblacion" ></span></strong></label>                    
                        <div class="controls ">
                            <select id="tipo_pemar" name="tipo_pemar" class=" select-chosen span12 required"  >
                                <option value="" data-cod="" >Seleccione una opción</option>
                                <?php
                                foreach ($TiposPemars as $tipoPemar):
                                    $selected = "";
                                    if (isset($datosContactoAnimador)) {
                                        if ($tipoPemar->CODIGO_TIPOPOBLACION == $datosContactoAnimador->TIPO_FORMATO_CONTACTOANIMADOR) {
                                            $selected = " selected ";
                                        }
                                    }
                                    ?>
                                    <option value="<?php echo $tipoPemar->ID_TIPOPOBLACION ?>"  data-max-condones="3" data-max-lubricantes="1" <?php echo $selected ?> title="<?php echo ($tipoPemar->CODIGO_TIPOPOBLACION) ?>" data-cod="<?php echo ($tipoPemar->CODIGO_TIPOPOBLACION) ?>">[<?php echo ($tipoPemar->CODIGO_TIPOPOBLACION) ?>] <?php echo ($tipoPemar->NOMBRE_TIPOPOBLACION) ?></option>
                                <?php endforeach; ?>                                     
                            </select>                        
                        </div>         
                    </div>
                </div>
            </div>    


        </div>
    </div>

    <div class="row-fluid" >
        <div class="span6">

            <div class="block block-themed">
                <div class="block-title"><h4> Abordaje:</h4></div>
                <div class="block-content full"> 
                    <div class="row-fluid">

                        <div class="span4">
                            <label class="control-label fondo_recibo_azul" for="hora" >Hora:</label>
                            <div class="controls" >
                                <div class="input-prepend bootstrap-timepicker">
                                    <span class="add-on"><i class="icon-time"></i></span>
                                    <input type="text" id="horaAbordaje" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->HORA_CONTACTOANIMADOR) : ''; ?>" name="hora" class="input-timepicker span8">                                        
                                </div>
                            </div>   
                        </div>

                        <div class="span2">
                            <label class="control-label fondo_recibo_azul" for="dia-contacto"> Día:</label>                    
                            <div class="controls">
                                <?php $this->formularios->lista_dia('contacto', 'span12', isset($datosContactoAnimador) ? $datosContactoAnimador->DIA_CONTACTOANIMADOR : "" ); ?>
                            </div>  
                        </div>

                        <div class="span2">
                            <label class="control-label fondo_recibo_azul" for="mes-contacto"> Mes: </label>                    
                            <div class="controls">
                                <?php $this->formularios->lista_mes_contacto('contacto', 'span12', (isset($datosContactoAnimador) ? $datosContactoAnimador->MES_CONTACTOANIMADOR : "")); ?>

                            </div>  
                        </div>

                        <div class="span4">
                            <label class="control-label fondo_recibo_azul" for="ano-contacto"> Año:</label>                    
                            <div class="controls">   
                                <?php $this->formularios->lista_ano_contacto('contacto', 'span12', isset($datosContactoAnimador) ? $datosContactoAnimador->ANO_CONTACTOANIMADOR : "", 0); ?>
                            </div>  
                        </div>

                    </div>  

                    <div class="row-fluid">

                        <div class="span6">
                            <label class="control-label fondo_recibo_azul" for="provincia">Provincia:</label>                    
                            <div class="controls ">
                                <select id="provincia-chosen" name="provincia-chosen" class="select-chosen span12">
                                    <option value >Seleccione una provincia</option>                          
                                    <?php foreach ($provincias as $provincia): ?>
                                        <?php
                                        $selected = "";
                                        if (isset($datosContactoAnimador)) {
                                            if ($provincia->ID_PROVINCIA == $datosContactoAnimador->ID_PROVINCIA) {
                                                $selected = " selected ";
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $provincia->ID_PROVINCIA ?>" <?php echo $selected ?> ><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
                                    <?php endforeach; ?> 
                                </select>
                            </div>     
                        </div>


                        <div class="span6">
                            <label class="control-label fondo_recibo_azul" for="ciudad_canton" >Ciudad / Cantón:</label>
                            <div class="controls" id="listado-cantones" >
                                <select id="sel-lista-cantones" name="sel-lista-cantones" class="select-chosen span12">
                                    <option value >Seleccione un cantón</option>                          
                                    <?php foreach ($cantones as $canton): ?>
                                        <?php
                                        $selected = "";
                                        if (isset($datosContactoAnimador)) {
                                            if ($canton->ID_CANTON == $datosContactoAnimador->ID_CIUDAD) {
                                                $selected = " selected ";
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $canton->ID_CANTON ?>" <?php echo $selected ?> ><?php echo ($canton->NOMBRE_CANTON) ?></option>
                                    <?php endforeach; ?> 
                                </select>   
                            </div>
                        </div>
                    </div>  

                    <div class="row-fluid">
                        <div class="control-group" >
                            <label class="control-label fondo_recibo_azul" for="lugar_abordaje" >Tipo Lugar de Abordaje:</label>
                            <div class="controls" >
                                <select id="tipoLugar" name="TipolugarArbodaje" class="select-chosen span12"> 
                                    <option value >Seleccione un tipo de lugar</option>
                                    <?php foreach ($TiposLugares as $tipoLugar): ?>
                                        <?php
                                        $selected = "";
                                        if (isset($datosContactoAnimador)) {
                                            if ($tipoLugar->ID_TIPOLUGAR == $datosContactoAnimador->ID_TIPOLUGAR) {
                                                $selected = " selected ";
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $tipoLugar->ID_TIPOLUGAR ?>" data-codigo="<?php echo $tipoLugar->CODIGO_TIPOLUGAR ?>"  <?php echo $selected ?> ><?php echo ($tipoLugar->NOMBRE_TIPOLUGAR) ?></option>
                                    <?php endforeach; ?> 
                                </select>                                
                            </div>   

                            <label class="control-label fondo_recibo_azul" for="lugar" >Lugar:</label>
                            <div class="controls" >
                                <div id="lugar_intervencion_div" >
                                    <select id="sel-lista-lugar_intervencion" name="sel-lista-lugar_intervencion" class="select-chosen span12">
                                        <option value >Seleccione un lugar</option>
                                        <?php foreach ($Lugares as $lugar): ?>
                                            <?php
                                            $selected = "";
                                            if (isset($datosContactoAnimador)) {
                                                if ($lugar->ID_LUGAR == $datosContactoAnimador->ID_LUGAR) {
                                                    $selected = " selected ";
                                                }
                                            }
                                            ?>
                                            <option value="<?php echo $lugar->ID_LUGAR ?>" <?php echo $selected ?> ><?php echo ($lugar->NOMBRE_LUGAR) ?></option>
                                        <?php endforeach; ?> 
                                    </select>       
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="block block-themed">
                <div class="block-title"><h4> Contacto: </h4></div>
                <div id="resp_validar_cedula" style="display: none;">
                    <span></span>
                </div>
                <div id="datos_recurrencia"></div>                    
                <div class="block-content"> 
                    <input type="hidden" name="idPoblacion" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->ID_POBLACION) : ''; ?>"/>
                    <div class="row-fluid">
                        <div class="span9" >
                            <label class="control-label fondo_recibo_azul" for="nombre_contacto" >Nombre de Contacto:</label>
                            <div class="controls" >
                                <input type="text" id="primer_nombre" name="primer_nombre" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->PRIMER_NOMBRE_PEMAR) : ''; ?>" class="soloLetras validar_cedula_codigo generadores-codigo mayusculas  span3" placeholder="primer nombre" style="margin: 0px;" />
                                <input type="text" id="segundo_nombre" name="segundo_nombre" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->SEGUNDO_NOMBRE_PEMAR) : ''; ?>" class="soloLetras validar_cedula_codigo generadores-codigo mayusculas span3" placeholder="segundo nombre" style="margin: 0px;"  />
                                <input type="text" id="primer_apellido" name="primer_apellido" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->PRIMER_APELLIDO_PEMAR) : ''; ?>" class="soloLetras validar_cedula_codigo generadores-codigo mayusculas span3" placeholder="primer apellido"  style="margin: 0px;" />
                                <input type="text" id="segundo_apellido" name="segundo_apellido" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->SEGUNDO_APELLIDO_PEMAR) : ''; ?>" class="soloLetras validar_cedula_codigo generadores-codigo mayusculas span3" placeholder="segundo apellido"  style="margin: 0px;" />
                            </div>   
                        </div>
                        <div class="span3" >
                            <label class="control-label fondo_recibo_azul" for="otro_nombre_contacto" >Otro Nombre:</label>
                            <div class="controls" >
                                <input type="text" id="otro_nombre_contacto" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->OTRO_NOMBRE_PEMAR) : ''; ?>" name="otro_nombre_contacto"  class="span12 " placeholder="" />
                            </div>   
                        </div>
                    </div>

                    <div class="row-fluid">                     
                        <div class="span7" >
                            <label class="control-label fondo_recibo_azul" for="ced_identidad_contacto" >C.C. </label>
                            <div class="controls" >  
                                <input type="text" maxlength="10" id="ced_identidad_contacto" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->CEDULA_PEMAR) : ''; ?>" name="ced_identidad_contacto"  class="span12 validar_cedula_codigo sinEspacio" placeholder="" />                    
                            </div>   
                        </div>  

                        <div class="span5" >
                            <label class="control-label fondo_recibo_azul" for="" >Nacimiento:</label>
                            <div class="controls " >
                                <div class="span6" >
                                    <?php $this->formularios->lista_mes('nacimiento', 'generadores-codigo validar_cedula_codigo span10', isset($datosContactoAnimador) ? $datosContactoAnimador->MES_NACIMIENTO_POBLACION : "" ); ?>
                                </div>
                                <div class="span6" >
                                    <?php $this->formularios->lista_ano('nacimiento', 'generadores-codigo validar_cedula_codigo span10', isset($datosContactoAnimador) ? $datosContactoAnimador->ANO_NACIMIENTO_POBLACION : "", $_SESSION['SESION_USUARIO']->EDAD_MINIMA, $_SESSION['SESION_USUARIO']->EDAD_MAXIMA); ?>
                                </div>
                            </div>   
                        </div>                     
                    </div>

                    <div class="row-fluid">
                        <div class="span8" >
                            <label class="control-label fondo_recibo_azul" for="telefono_contacto" >No. Telef Fijo / Celular:</label>
                            <div class="controls" >
                                <input type="number" min="0" id="telefono_contacto" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->TELEFONO_PEMAR) : ''; ?>" name="telefono_contacto"  class="span12 sinEspacio" placeholder="" />
                            </div>   
                        </div>
                        <div class="span4" >
                            <label class="control-label fondo_recibo_azul" for="" style="text-align: center;" >Datos de Contacto:</label>
                            <div class="controls" >
                                <label for="general-themed-checkbox1">
                                    <input type="checkbox" id="chk-cedula-verificada" name="chk-cedula-verificada" class="input-themed" value="SI" <?php
                                    if (isset($datosContactoAnimador)) {
                                        if ($datosContactoAnimador->VERIFICADO_PEMAR == 'SI') {
                                            echo 'checked=""';
                                        }
                                    }
                                    ?> /> Verificados
                                </label>
                            </div>   
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span10">
                            <label class="control-label fondo_recibo_azul" for="inline-text">Código Único:</label>
                            <div class="controls"> 
                                <input type="text"  class="typeahead focused validar_cedula_codigo span12" id="codigo-pemar-generado" name="codigo-pemar" 
                                       style="text-transform: uppercase;font-size: 125%;text-align: center;" readonly required 
                                       value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->CODIGO_UNICO_PERSONA) : ''; ?>"/>
                            </div>
                        </div>

                        <div class="span2" style=" display: none;" >
                            <label class="control-label fondo_recibo_azul" for="inline-text">N/R</label>
                            <div class="controls">
                                <input type="text" id="tipo-recurrencia-contacto" name="tipo-recurrencia-contacto" value="N" class="span12"  readonly />
                                <input type="hidden" id="tipo-alcance-contacto" name="tipo-alcance-contacto" value="NUEVO"  />
                            </div>                                    
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="span6">

            <div class="block block-themed ">
                <div class="block-title">
                    <h4>Prevención</h4>
                </div>
                <div class="block-content">
                    <div class="row-fluid" >

                        <div class="control-group inline" >
                            <div class="span3" >Tema Abordaje:</div>
                            <div class="span9" >
                                <div class="controls" style="height: 80px; overflow: auto;" > 
                                    <?php
                                    foreach ($Temas as $tema) {
                                        $checked = "";
                                        if (isset($datosContactoAnimador))
                                            if ($tema->ID_TEMA == $datosContactoAnimador->ID_TEMA)
                                                $checked = " checked ";
                                        echo '<label class="radio inline" for="tema-recibo' . $tema->ID_TEMA . '">
                                                        <input type="radio" id="tema-' . $tema->ID_TEMA . '" name="tema-recibo" class="input-themed" value="' . $tema->ID_TEMA . '" ' . $checked . ' >' . ($tema->TITULO_TEMA) . ' 
                                                    </label>';
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>

                        <div class="control-group inline" >
                            <div class="span3" >Paquetes de Prevención:</div>
                            <div class="span9" >                            
                                <div class="control-group">
                                    <label class="control-label  span6" for="noCondones">Nro. Condones:</label>
                                    <div class="controls  span6 ">
                                        <input type="number" id="cantidad-condones-entregados-contacto" name="noCondones" min="0" max="<?php if (isset($datosContactoAnimador->NUM_CONDONES)) echo $datosContactoAnimador->NUM_CONDONES; ?>" 
                                               value="<?php if (isset($datosContactoAnimador->NUM_CONDONES)) echo $datosContactoAnimador->NUM_CONDONES; ?>" class="insumos-entregados span12"  readonly="" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label  span6" for="noLubricantes">Nro. Lubricantes:</label>
                                    <div class="controls  span6 ">
                                        <input type="number" id="cantidad-lubricantes-entregados-contacto" name="noLubricantes" min="0" max="<?php if (isset($datosContactoAnimador->NUM_LUBRICANTES)) echo $datosContactoAnimador->NUM_LUBRICANTES; ?>" 
                                               value="<?php if (isset($datosContactoAnimador->NUM_LUBRICANTES)) echo $datosContactoAnimador->NUM_LUBRICANTES; ?>"  class="insumos-entregados span12"  readonly=""  />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label  span6" for="noFolletos">Nro. Folletos:</label>
                                    <div class="controls  span6">
                                        <input type="number" id="noFolletos" name="noFolletos" min="0" required=""
                                               value="<?php if (isset($datosContactoAnimador->NUM_FOLLETOS)) echo $datosContactoAnimador->NUM_FOLLETOS; ?>"  class="insumos-entregados span12" />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="block block-themed ">
                <div class="block-title">
                    <h4>Observaciones / Adicional:</h4>
                </div>
                <div class="block-content">                        
                    <div class="controls"> 
                        <textarea name="observaciones_animador" rows="21" style="width:100%;" ><?php if (isset($datosContactoAnimador->OBSERVACIONES_CONTACTOANIMADOR)) echo $datosContactoAnimador->OBSERVACIONES_CONTACTOANIMADOR; ?></textarea>
                    </div>
                </div>
            </div>      

            <div class="block block-themed "  style="display: none;">
                <div class="block-title">
                    <h4>REFERENCIA SERVICIO DE SALUD</h4>
                </div>
                <div class="block-content">
                    <div class="control-group form-horizontal">
                        <label for="fechaAtencion" class="control-label  "  >Fecha Atención: </label>
                        <div class="controls"> 

                            <div class="input-append date input-datepicker" data-date="2014-01-01" data-date-format="yyyy-mm-dd">
                                <input type="text" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->FECHA_ATENCION_CONTACTOANIMADOR) : ''; ?>" id="fechaAtencion" name="fechaAtencion" class="input-small">
                                <span class="add-on"><i class="icon-calendar"></i></span>
                            </div>       
                            <div class="input-append bootstrap-timepicker">
                                <input type="text" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->HORA_ATENCION_CONTACTOANIMADOR) : ''; ?>" id="horaAtencion" name="horaAtencion" class="input-small input-timepicker">
                                <span class="add-on"><i class="icon-time"></i></span>                                                
                            </div>
                        </div>
                    </div>

                    <div class="control-group form-horizontal">
                        <label class="control-label" for="horizontal-select">Nombre del Servicio de Salud:</label>
                        <div class="controls">
                            <select id="servicioSalud" name="servicio_salud" style="width: 100%"  class="select-chosen" >
                                <option value >Seleccione el Servicio</option>
                                <?php foreach ($serviciosSalud as $servicio): ?>
                                    <?php
                                    $selected = "";
                                    if (isset($datosContactoAnimador)) {
                                        if ($serviciosSalud->ID_SERVICIO == $datosContactoAnimador->ID_SERVICIO) {
                                            $selected = " selected ";
                                        }
                                    }
                                    ?>
                                    <option value="<?php echo $servicio->ID_SERVICIO ?>" <?php echo $selected ?> >[<?php echo ($servicio->CODIGO_SERVICIO) ?>] <?php echo ($servicio->NOMBRE_SERVICIO) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group form-horizontal">
                        <label class="control-label" for="horizontal-select">Unidad de Salud:</label>
                        <div class="controls"> 
                            <select id="centroSalud" name="centro_salud"  style="width: 100%"  class="select-chosen" >
                                <option value >Seleccione la Unidad de Salud</option>
                                <?php foreach ($centrosSalud as $centro): ?>
                                    <?php
                                    $selected = "";
                                    if (isset($datosContactoAnimador)) {
                                        if ($centrosSalud->ID_CENTROSERVICIO == $datosContactoAnimador->ID_CENTROSERVICIO) {
                                            $selected = " selected ";
                                        }
                                    }
                                    ?>
                                    <option value="<?php echo $centro->ID_CENTROSERVICIO ?>" <?php echo $selected ?> ><?php echo ($centro->NOMBRE_CENTROSERVICIO) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="block block-themed ">
        <div class="block-title"><h4>NOMBRE DEL ANIMADOR</h4></div>
        <div class="block-content">

            <div class="control-group inline" >
                <div class="controls" >
                    <select id="promotor" name="promotor" style="width:100%;" class="select-chosen" >
                        <option value='' >Seleccione el animador(a)</option>
                        <?php foreach ($Animadores as $animador): ?>
                            <?php
                            $selected = "";
                            if (isset($datosContactoAnimador)) {
                                if ($animador->ID_PERSONA == $datosContactoAnimador->ID_PROMOTOR) {
                                    $selected = " selected ";
                                }
                            }
                            ?>
                            <option value="<?php echo $animador->ID_PERSONA ?>" <?php echo $selected ?> ><?php echo ($animador->NOMBRE_REAL_PERSONA) ?></option>
                        <?php endforeach; ?>
                    </select>                                      
                </div>   
            </div>
        </div>
    </div>

</form>


<script>
    var habilitarBoton = 'false';
    $(document).ready(function() {

        _puede_salir_formulario = false;


        $('#btn_validar_datos').on('click', function(e) {
            generarCodigo();
            e.preventDefault();
        });
        $('#btn_guardar_recibo_animador').on('click', function(evt, params) {
            $('#form-contacto-animador').submit();
        });
        $('#btn_limpiar_recibo_animador').on('click', function(evt, params) {
            confirm(
                    '¿Seguro que desea limpiar el formulario o <strong>borrar los datos digitados</strong> del contacto?'
            , 'resetear_formulario();'
            );
        });

        $('.generadores-codigo').on('change', function(e) {
            activar_boton_formatos('btn_guardar_recibo_animador', 'false');
        });
        $(".validar_cedula_codigo").on('change', function(e) {
            activar_boton_formatos('btn_guardar_recibo_animador', 'false');
        });
        $("#tipo_pemar").on('change', function(e) {
            $('#cod_tipo_poblacion').html('[' + $('#tipo_pemar option:selected').attr('data-cod') + ']');
            $('#cantidad-condones-entregados-contacto').attr('value', $('#tipo_pemar option:selected').attr('data-max-condones'));
            $('#cantidad-lubricantes-entregados-contacto').attr('value', $('#tipo_pemar option:selected').attr('data-max-lubricantes'));
            $('#cantidad-condones-entregados-contacto').attr('max', $('#tipo_pemar option:selected').attr('data-max-condones'));
            $('#cantidad-lubricantes-entregados-contacto').attr('max', $('#tipo_pemar option:selected').attr('data-max-lubricantes'));
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

<?php if (!$tieneRestricciones or Usuario::esDNI()): ?>
                habilitarPaquetePrevencion();
<?php endif; ?>
        });
        $('#provincia-chosen').on('change', function(evt, params) {
            cargar_cantones_recibo_animador('listado-cantones', 'sel-lista-cantones', $(this).val());
        });

    });



    function habilitarPaquetePrevencion() {
        var tipoLug = $('#tipoLugar option:selected').attr('data-codigo');

        $('#cantidad-condones-entregados-contacto').attr('readonly', 'true');
        $('#cantidad-condones-entregados-contacto').val('3');
        $('#cantidad-lubricantes-entregados-contacto').attr('readonly', 'true');
        $('#cantidad-lubricantes-entregados-contacto').val('1');
        if (tipoLug === 'CAIACL') {
            $('#cantidad-condones-entregados-contacto').removeAttr('readonly');
            $('#cantidad-condones-entregados-contacto').val('0');
            $('#cantidad-lubricantes-entregados-contacto').removeAttr('readonly');
            $('#cantidad-lubricantes-entregados-contacto').val('0');
        }
    }

    function generarCodigo() {
        activar_boton_formatos('btn_guardar_recibo_animador', 'false');

        $('#resp_validar_cedula').slideUp();
        $('#datos_recurrencia').slideUp();
        var CUP = '';
<?php if (Usuario::esDNI()): ?>
            CUP = generarCodigoUnicoPemarDNI(
                    $('#primer_nombre').val(), $('#segundo_nombre').val(),
                    $('#primer_apellido').val(), $('#segundo_apellido').val(),
                    $('#mes-nacimiento').val(), $('#ano-nacimiento').val()
                    );

            if ($('#mes-nacimiento').val() == "") {
                var mes = generarMesPrimerNmbre($('#mes-nacimiento').val(), $('#primer_nombre').val());
                $('#mes-nacimiento').val(mes);
            }
            if ($('#ano-nacimiento').val() == "") {
                var agnio = generarAgnioPrimerApellido($('#ano-nacimiento').val(), $('#primer_apellido').val());
                $('#ano-nacimiento').val(agnio);
            }

<?php else: ?>
            CUP = generarCodigoUnicoPemar(
                    $('#primer_nombre').val(), $('#segundo_nombre').val(),
                    $('#primer_apellido').val(), $('#segundo_apellido').val(),
                    $('#mes-nacimiento').val(), $('#ano-nacimiento').val()
                    );
<?php endif; ?>
        $('#codigo-pemar-generado').attr('value', CUP.toString());

        var cedPemar = $('#ced_identidad_contacto').val();
        var codPemar = $('#codigo-pemar-generado').val();

        if (estaVacio($('#ano-nacimiento').val()) || estaVacio($('#mes-nacimiento').val())) {
            codPemar = '';
            alert('La fecha de nacimiento es importante para generar el c&oacute;digo.');
        } else if (estaVacio($('#ano-contacto').val()) || estaVacio($('#mes-contacto').val()) || estaVacio($('#dia-contacto').val())) {
            codPemar = '';
            alert('Selecciona la fecha de contacto');
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
        
        
        $('#provincia-chosen option[value=""]').attr("selected", "selected");  
        $('#provincia-chosen').change();
        $('#provincia-chosen').trigger("liszt:updated");
                
        $('#tipo_pemar option[value=""]').attr("selected", "selected");            
        $('#tipo_pemar').trigger("liszt:updated");
        
        $('#tipoLugar option[value=""]').attr("selected", "selected");  
        $('#tipoLugar').change();
        $('#tipoLugar').trigger("liszt:updated");
        
        $('#promotor option[value=""]').attr("selected", "selected");        
        $('#promotor').trigger("liszt:updated");
        
        document.getElementById('form-contacto-animador').reset();
    }
    function validar_datos_recibo_contacto() {

        if (!esFechaValida($('#ano-contacto').val(), $('#mes-contacto').val(), $('#dia-contacto').val())) {
            alert('La fecha de abordaje no es valida.');
            return false;
        }

        if (estaVacio($('#tipo_pemar').val())) {
            alert('Debes Seleccionar el tipo de poblaci&oacute;n abordada.');
            return false;
        }

        if (estaVacio($('#dia-contacto').val())) {
            alert('Debes Seleccionar el d&iacute;a de Abordaje');
            return false;
        }

        if (estaVacio($('#mes-contacto').val())) {
            alert('Debes Seleccionar el mes de Abordoje');
            return false;
        }

        if (estaVacio($('#ano-contacto').val())) {
            alert('Debes Seleccionar el a&ntilde;o de Abordaje');
            return false;
        }

        if (estaVacio($('#sel-lista-cantones').val())) {
            alert('Debes Seleccionar el cant&oacute;n donde se realiz&oacute; el abordaje.');
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
        return true;
    }

</script>