<style>
    .cambiar_tamaño1{
        width: 25%!important;
    }
    .cambiar_tamaño2{
        width: 20%!important;
    }
</style>
<form id="form-consejeria-pvvs" method="post" class="form-inline" onsubmit="return false;" >
    <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($datosConsejeria) ? ($datosConsejeria->ID_CONSEJERIA_PVVS) : ''; ?>" />
    <input type="hidden" id="dir_archivo_soporte"  name="dir_archivo_soporte" value="" />

    <div class="block  block-themed" >
        <div class="block-title" style="text-align: center; ">
            <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Carga de Archivos"><i class="icon-arrow-up"></i></a>
            <h5>COALICIÓN ECUATORIANA DE PERSONAS QUE VIVEN CON VIH (CEPVVS) </h5>
            <h6>PROYECTO MEJORAMIENTO DE LA CALIDAD DE VIDA DE LAS PERSONAS CON VIH EN EL ECUADOR / PROYECTO ECUADOR VIH RONDA 9 FONDO MUNDIAL – FASE 2</pre></h6>
            <h4>REGISTRO DE CONSEJERÍA DE PARES CON PERSONAS QUE VIVEN CON VIH</h4>
        </div>
        <div class="block-content"> 

            <div id="resp_validar_cedula" style="display: none;">
                <span></span>
            </div>
            <div id="datos_recurrencia" ></div>

            <div class="row-fluid">
                <!-- 1st Column -->
                <div class="span6">                        
                    <div class="control-group">
                        <label class="control-label  span4" for="codigoUsuario">Código Usuario-A:</label>
                        <div class="controls span8">
                            <input type="text" title="Dos primeras letras del primer apellido" id="dosPrimerApellido" name="dosPrimerApellido" 
                                   class=" span1 soloLetras validar_cedula_codigo mayusculas " style="width: 30px;"  
                                   value="<?php if (isset($datosConsejeria)) echo substr($datosConsejeria->PRIMER_APELLIDO_PEMAR, 0, 2) ?>">      
                            <input type="text" title="Dos primeras letras del segundo apellido" id="dosSegundoApellido" name="dosSegundoApellido" 
                                   class=" span1 soloLetras validar_cedula_codigo mayusculas " style="width: 30px;"  
                                   value="<?php if (isset($datosConsejeria)) echo substr($datosConsejeria->SEGUNDO_APELLIDO_PEMAR, 0, 2) ?>" >

                            <input type="text"  title="Dos primeras letras del primer nombre" id="dosPrimerNombre" name="dosPrimerNombre" 
                                   class=" span1 soloLetras validar_cedula_codigo mayusculas " style="width: 30px;"  
                                   value="<?php if (isset($datosConsejeria)) echo substr($datosConsejeria->PRIMER_NOMBRE_PEMAR, 0, 2) ?>" >
                            <input type="text" title="Dos primeras letras del segundo nombre" id="dosSegundoNombre" name="dosSegundoNombre" 
                                   class=" span1 soloLetras validar_cedula_codigo mayusculas " style="width: 30px;"  
                                   value="<?php if (isset($datosConsejeria)) echo substr($datosConsejeria->SEGUNDO_NOMBRE_PEMAR, 0, 2) ?>" >                             
                                   <?php $this->formularios->lista_mes('nacimiento', ' validar_cedula_codigo span2 cambiar_tamaño2 lista-nacimiento', isset($datosConsejeria) ? $datosConsejeria->MES_NACIMIENTO_POBLACION : "" ); ?>
                                   <?php $this->formularios->lista_ano('nacimiento', ' validar_cedula_codigo span3 cambiar_tamaño1 lista-nacimiento', isset($datosConsejeria) ? $datosConsejeria->ANO_NACIMIENTO_POBLACION : "", $_SESSION['SESION_USUARIO']->EDAD_MINIMA); ?>
                        </div>
                    </div> 

                    <div class="control-group">
                        <label class="control-label  span4" for="cedulaUsuario">Cédula o DNI:</label>
                        <div class="controls  span8">
                            <input type="text" maxlength="10" id="cedulaUsuario" name="cedulaUsuario" class="validar_cedula_codigo sinEspacio"  
                                   value="<?php if (isset($datosConsejeria)) echo $datosConsejeria->CEDULA_PEMAR; ?>"  />
                            <label for="chk-cedula-verificada">
                                <input type="checkbox" id="chk-cedula-verificada" name="chk-cedula-verificada" class="input-themed" value="SI" <?php
                                if (isset($datosConsejeria)) {
                                    if ($datosConsejeria->CEDULA_PEMAR == 'SI'):
                                        ?> checked="" <?php
                                           endif;
                                       }
                                       ?> > Verificada
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" for="edadUsuario">Edad:</label>
                        <div class="controls  span8">
                            <input type="text" id="edadUsuario" name="edadUsuario"  readonly=""
                                   value="<?php if (isset($datosConsejeria)) echo $datosConsejeria->EDAD; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" for="columns-text">Sexo:</label>
                        <div class="controls  span8">
                            <label for="masculino" class="radio inline">
                                <input type="radio" id="sexo_hombre" name="sexo" class="input-themed" value="HOMBRE" <?php if (isset($datosConsejeria) && $datosConsejeria->SEXO_PERSONA == "HOMBRE") { ?> checked=""<?php } ?> > HOMBRE
                            </label>
                            <label for="femenino" class="radio inline">
                                <input type="radio" id="sexo_mujer" name="sexo" class="input-themed" value="MUJER" <?php if (isset($datosConsejeria) && $datosConsejeria->SEXO_PERSONA == "MUJER") { ?> checked=""<?php } ?>> MUJER
                            </label>
                            <label for="transexual" class="radio inline">
                                <input type="radio" id="sexo_trans" name="sexo" class="input-themed" value="TRANS" <?php if (isset($datosConsejeria) && $datosConsejeria->SEXO_PERSONA == "TRANS") { ?> checked=""<?php } ?>>TRANS
                            </label>
                        </div>      
                    </div> 

                    <div class="control-group">
                        <label class="control-label  span4" >Lugar de Residencia:</label>
                        <div class="controls  span8">

                            <div id="listado-provincias" class=" span5" >                                
                                <select id="provincia-residencia" name="provincia-residencia" class="select-chosen span12">
                                    <option value >Seleccione la provincia</option>
                                    <?php
                                    foreach ($provincias as $provincia) {
                                        if ($provincia->ID_PROVINCIA == $datosConsejeria->ID_PROVINCIA) {
                                            ?>
                                            <option value="<?php echo $provincia->ID_PROVINCIA ?>" selected=""><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
                                            <?php
                                        } else
                                            
                                            ?> <option value="<?php echo $provincia->ID_PROVINCIA ?>"><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>

                                        <?php
                                        ;
                                    }
                                    ?>
                                </select>
                            </div>
                            <div id="listado-cantones" class=" span5" >                                
                                <select id="lugarResidencia" name="lugarResidencia" class="select-chosen span12">
                                    <?php
                                    if (isset($datosConsejeria)) {
                                        foreach ($cantones as $canton) {
                                            if ($canton->ID_CANTON == $datosConsejeria->ID_CANTON) {
                                                echo '<option value="' . $canton->ID_CANTON . '" selected>' . ($canton->NOMBRE_CANTON) . '</option>';
                                            } else {
                                                echo '<option value="' . $canton->ID_CANTON . '">' . ($canton->NOMBRE_CANTON) . '</option>';
                                            }
                                        }
                                    } else {
                                        echo '<option value="" >Seleccione el canton</option>';
                                    }
                                    ?>                                   
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="control-group" style="display: none">
                        <label class="control-label  span4" for="tiempoAno">Tiempo que sabe de su diagnóstico:</label>
                        <div class="controls  span8">
                            <input type="number" id="tiempoAno" name="tiempoAnio" class="span4" placeholder="Años"
                                   value="<?php if (isset($datosConsejeria)) echo intval($datosConsejeria->TIEMPO_SABE_DIAGNOSTICO) ?>">
                            <input type="number" id="tiempoMes" name="tiempoMes" class="span4" placeholder="Meses"
                                   value="<?php
                                   if (isset($datosConsejeria)) {
                                       $mes = ($datosConsejeria->TIEMPO_SABE_DIAGNOSTICO - intval($datosConsejeria->TIEMPO_SABE_DIAGNOSTICO)) * 10;
                                       if ($mes != 0) {
                                           echo 12 / $mes;
                                       }
                                   }
                                   ?>">


                        </div>
                    </div>

                    <div class="control-group"  style="display: none" >
                        <label class="control-label  span4" for="telefono">Teléfono (opcional:)</label>
                        <div class="controls  span8">
                            <input type="tel" id="telefono" name="telefono" class="sinEspacio"
                                   value="<?php if (isset($datosConsejeria)) echo $datosConsejeria->TELEFONO_PEMAR ?>">
                        </div>
                    </div>

                    <div class="control-group" style="display: none">
                        <label class="control-label  span4" for="correo">Correo (opcional):</label>
                        <div class="controls  span8">
                            <input type="email" id="correo" name="correo" class="sinEspacio"
                                   value="<?php if (isset($datosConsejeria)) echo $datosConsejeria->CORREO_POBLACION ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" for="idEstablecimiento">Establecimiento donde recibe atención:</label>
                        <div id="listado-establecimiento" class="controls  span8">                                
                            <select id="idEstablecimiento" name="idEstablecimiento" class="select-chosen" >  
                                <option value="">Seleccione un establecimiento</option>
                                <optgroup label="TODO EL ECUADOR" >
                                <?php
                                foreach ($CentrosSalud as $centro) {
                                    $selected = "";
                                    if (isset($datosConsejeria) && $centro->ID_CENTROSERVICIO == $datosConsejeria->ID_CENTRO_SERVICIO) {
                                        $selected = ' selected="" ';
                                    }
                                    echo '<option value="' . $centro->ID_CENTROSERVICIO . '" ' . $selected . ' >' . ($centro->NOMBRE_CENTROSERVICIO) . '</option>';
                                }
                                ?>
                                </optgroup>
                            </select>
                        </div>      
                    </div>                         

                    <div class="control-group" >
                        <label class="control-label  span4" >Tratamiento ARV:</label>
                        <div class="controls  span8">
                            <label for="tratamientoAVR1" class="radio inline">
                                <input type="radio" id="arv_si" name="arv" class="input-themed" value="SI" <?php if (isset($datosConsejeria) && $datosConsejeria->TRATAMIENTO_ARV == "SI") { ?> checked=""<?php } ?>>SI
                            </label>
                            <label for="tratamientoAVR2" class="radio inline">
                                <input type="radio" id="arv_no" name="arv" class="input-themed" value="NO" <?php
                                if (isset($datosConsejeria)) {
                                    if ($datosConsejeria->TRATAMIENTO_ARV == "NO") {
                                        ?> checked=""<?php
                                           }
                                       } else {
                                           ?>  checked=""  <?php } ?>>NO
                            </label>
                        </div>  
                    </div> 

                </div>
                <!-- END 1st Column -->

                <!-- 2nd Column -->
                <div class="span6">                       
                    <div class="control-group">
                        <label class="control-label  span4" for="fechaRealizacion">Fecha de Consejería:</label>
                        <div class="controls  span8">

                            <div class="input-prepend date " >
                                <span class="add-on"><i class="icon-calendar"></i></span>
                                <input type="text"  id="fechaRealizacion" name="fechaRealizacion"  class="input-small input-datepicker-close validar_cedula_codigo"
                                       value="<?php if (isset($datosConsejeria)) echo $datosConsejeria->FECHA_CONSEJERIA ?>" required="" >
                            </div>       

                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" for="horaInicio">Hora Inicio:</label>
                        <div class="controls  span8">
                            <div class="input-prepend bootstrap-timepicker">
                                <span class="add-on"><i class="icon-time"></i></span>
                                <input type="text" id="horaInicio" name="horaInicio" class="input-timepicker validar_cedula_codigo"
                                       value="<?php if (isset($datosConsejeria)) echo $datosConsejeria->HORA_INICIO ?>" required="" >       
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" for="horaFinal">Hora Fin:</label>
                        <div class="controls  span8">
                            <div class="input-prepend bootstrap-timepicker">
                                <span class="add-on"><i class="icon-time"></i></span>
                                <input type="text" id="horaFinal" name="horaFinal" class="input-timepicker "
                                       value="<?php if (isset($datosConsejeria)) echo $datosConsejeria->HORA_FIN ?>" required="" >        
                            </div>
                        </div>
                    </div>

                    <div class="control-group" align="center">
                        <label class="control-label  span12" for="nroCondones">INSUMOS ENTREGADOS</label>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" for="nroCondones">Nro. Condones:</label>
                        <div class="controls  span8">
                            <input type="number" id="nroCondones" name="nroCondones" class="insumos-entregados" min="0" required="" 
                                   value="<?php echo (isset($datosConsejeria->INSUMOS->CONDONES->CANTIDAD)) ? $datosConsejeria->INSUMOS->CONDONES->CANTIDAD : '30' ?>" >
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" for="nroLubricantes">Nro. Lubricantes:</label>
                        <div class="controls  span8">
                            <input type="number" id="nroLubricantes" name="nroLubricantes" class="insumos-entregados" min="0" required=""    
                                   value="<?php echo (isset($datosConsejeria->INSUMOS->LUBRICANTES->CANTIDAD)) ? $datosConsejeria->INSUMOS->LUBRICANTES->CANTIDAD : '10' ?>" >
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" for="pastilleros">Pastilleros:</label>
                        <div class="controls  span8">
                            <input type="number" id="pastilleros" name="pastilleros" min="0" required=""
                                   value="<?php echo (isset($datosConsejeria->INSUMOS->PASTILLEROS->CANTIDAD)) ? $datosConsejeria->INSUMOS->PASTILLEROS->CANTIDAD : '0' ?>" >
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" for="materialIEC">Material de IEC:</label>
                        <div class="controls  span8">
                            <input type="number" id="materialIEC" name="materialIEC" min="0" required="" 
                                   value="<?php echo isset($datosConsejeria->INSUMOS->MATERIAL_IEC->CANTIDAD) ? $datosConsejeria->INSUMOS->MATERIAL_IEC->CANTIDAD : '0'; ?>" />
                        </div>
                    </div>

                    <div class="control-group">    
                        <label class="control-label  span4" for="idLugar">Lugar de la Consejería:</label>
                        <div class="controls  span8">
                            <select name="idLugar" id="idLugar" class="select-chosen">
                                <option value="">Seleccione un lugar</option>
                                <?php
                                foreach ($lugaresConsejeria as $lugar) {
                                    $selected = '';
                                    if (isset($datosConsejeria)) {
                                        if ($lugar->ID_LUGAR_CONSEJERIA == $datosConsejeria->ID_LUGAR_CONSEJERIA) {
                                            $selected = ' selected="" ';
                                        }
                                    }
                                    echo '<option value="' . $lugar->ID_LUGAR_CONSEJERIA . '"  ' . $selected . ' >' . ($lugar->NOMBRE_LUGAR_CONSEJERIA) . '</option>';
                                }
                                ?>
                            </select>	
                        </div>
                    </div>   

                    <div class="control-group" style="display: none"> 
                        <label class="control-label  span4" for="esquema_arv">Si, ¿Cúal esquema?</label>
                        <div class="controls span8" >
                            <select name="idEsquema" id="idEsquema" class="select-chosen">
                                <option value="">Seleccione uno</option>
                                <?php
                                foreach ($esquemasArv as $esquema) {
                                    $selected = '';
                                    if (isset($datosConsejeria)) {
                                        if ($esquema->ID_ESQUEMA_ARV == $datosConsejeria->ID_ESQUEMA_ARV) {
                                            $selected = ' selected="" ';
                                        }
                                    }
                                    echo '<option value="' . $esquema->ID_ESQUEMA_ARV . '"  ' . $selected . ' >' . ($esquema->NOMBRE_ESQUEMA_ARV) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>


                </div>
                <!-- END 2nd Column -->
            </div>

            <div class="row-fluid form-horizontal">
                <div class="span12" > 
                    <div class="control-group" style="display: none">
                        <label class="control-label   " for="referencia">Referencia / Contrareferencia</label>
                        <div class="controls ">
                            <input type="text" id="referencia" name="referencia" style="width:100%" 
                                   value="<?php if (isset($datosConsejeria)) echo $datosConsejeria->REFERENCIA ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="observaciones">Observaciones</label>
                        <div class="controls">
                            <textarea id="observaciones" name="observaciones"  style="width:100%"  ><?php if (isset($datosConsejeria)) echo $datosConsejeria->OBSERVACIONES ?></textarea>
                        </div>
                    </div>

                </div>   

            </div>

            <div class="row-fluid">
                <div class="span6"> 
                    <div class="control-group" style="margin-left: 10%">
                        <label class="control-label  span4" for="idConsejero">Nombre del consejero</label>
                        <select name="idConsejero" id="idConsejero" class="select-chosen">
                            <option value="">Seleccione el consejero</option>
                            <?php
                            foreach ($Promotores as $consejero) {
                                if ($consejero->ID_PERSONA == $datosConsejeria->ID_CONSEJERO) {
                                    echo '<option value="' . $consejero->ID_PERSONA . '" selected>' . $consejero->NOMBRE_REAL_PERSONA . '</option>';
                                } else
                                    echo '<option value="' . $consejero->ID_PERSONA . '">' . $consejero->NOMBRE_REAL_PERSONA . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!-- 2st Column -->
                <div class="span6"> 
                    <div class="control-group" style="display:none;" >
                        <label class="control-label  span4" for="tipoAlcance">Tipo de alcance</label>
                        <div class="controls  span8">                                
                            <input type="text" id="tipo-recurrencia-contacto" name="tipo-recurrencia-contacto" value="N" class=" span12 "  readonly />
                            <input type="hidden" id="tipoAlcance" name="tipo-alcance-contacto" value="<?php echo isset($datosConsejeria) ? $datosConsejeria->TIPO_ALCANCE_CONSEJERIA_PVVS : 'NUEVO'; ?>"  />
                        </div>
                    </div>
                </div>
            </div>

        </div>        
    </div>

</form>

<div class="block block-themed block-last">
    <div class="block-title">
        <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Carga de Archivos"><i class="icon-arrow-up"></i></a>  Carga de Archivos de Soporte <small>Solo debe <code>arrastrar y soltar</code> sobre el recuadro, los archivos escaneados de los formularios!</small></h4>
    </div>

    <div class="block-content ">
        <?php $this->mostrar("consejeria_pvvs/cargarArchivos", $this->datos, 'monitores'); ?>
    </div>

</div>


    <div class="form-actions text-center ">
        <button id="btn_validar_datos" type="button" class="btn btn-info"><i class="icon-check"></i> Validar </button>
        <button type="button"  id="btn_limpiar_consejeria_pvvs" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
        <button type="button" id="btn_guardar_consejeria_pvvs" class="btn btn-success" disabled="" ><i class="icon-save"></i> Guardar</button>
    </div>




<script>

    var habilitarBoton = 'false';
    $(document).ready(function() {


        _puede_salir_formulario = false;


        $('#btn_guardar_consejeria_pvvs').on('click', function(evt) {
            $('#form-consejeria-pvvs').submit();
        });

        $('#btn_limpiar_consejeria_pvvs').on('click', function(evt) {
            confirm(
                '¿Seguro que desea limpiar el formulario o <strong>borrar los datos digitados</strong> de la consejeria a PVV?'
                , 'resetear_formulario();'
            );

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


        $('.insumos-entregados').on('keyup', function(e) {
            var item3 = $('#nroCondones').val();
            if (estaVacio(item3))
                return false;
            var item1 = $('#nroLubricantes').val();
            if (estaVacio(item1))
                return false;

            if (!comprobar_relacion_3_1(item3, item1)) {
                $('#nroLubricantes').val(0);
                $('#nroCondones').focus();
                alert('La cantidad de lubricantes entregados, según los condones digitados, no es válida.');
            }

        }
        );

        $('.insumos-entregados').on('change', function(e) {

            var item3 = $('#nroCondones').val();
            if (estaVacio(item3))
                return false;
            var item1 = $('#nroLubricantes').val();
            if (estaVacio(item1))
                return false;

            if (!comprobar_relacion_3_1(item3, item1)) {
                $('#nroLubricantes').val(0);
                $('#nroCondones').focus();
                alert('La cantidad de lubricantes entregados, según los condones digitados, no es válida.');
            }
        });

        $('#provincia-residencia').on('change', function(evt, params) {
            cargar_cantones_cServicio('listado-cantones', 'lugarResidencia', $(this).val());
        });

        $('#lugarResidencia').on('change', function(evt, params) {
            cargar_centros_salud('listado-establecimiento', 'idEstablecimiento', $(this).val());
        });

    });


    function resetear_formulario(){

        $('#chk-cedula-verificada').iCheck('uncheck');
        $('#mes-nacimiento').change();
        $('#ano-nacimiento').change();

        $("input[name='arv'][value='NO']").iCheck('check');
                        
        $('#lugarResidencia option[value=""]').attr("selected", "selected");  
        $('#lugarResidencia').change();
        $('#lugarResidencia').trigger("liszt:updated");

        $('#provincia-residencia option[value=""]').attr("selected", "selected");  
        $('#provincia-residencia').change();
        $('#provincia-residencia').trigger("liszt:updated");
                        
        $('#idEstablecimiento option[value=""]').attr("selected", "selected");  
        $('#idEstablecimiento').change();
        $('#idEstablecimiento').trigger("liszt:updated");

        $('#idLugar option[value=""]').attr("selected", "selected");            
        $('#idLugar').change();              
        $('#idLugar').trigger("liszt:updated");      

        $('#idConsejero option[value=""]').attr("selected", "selected");            
        $('#idConsejero').change();              
        $('#idConsejero').trigger("liszt:updated");      

        document.getElementById('form-consejeria-pvvs').reset();
    }






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

        var fechaArranca = new Date( $('#fechaRealizacion').val()+" "+$('#horaInicio').val() );
        var fechaTermina = new Date( $('#fechaRealizacion').val()+" "+$('#horaFinal').val() );        
        if( validar_fechaMayorQue( fechaArranca, fechaTermina )) {
            alert('La Hora de Inicio es Mayor a la De Fin de la Consejeria. Por favor, corrijelo.');
            return false;
        }

        var codP = generarCodigoUnicoPemar($('#dosPrimerNombre').val(), $('#dosSegundoNombre').val(), $('#dosPrimerApellido').val(), $('#dosSegundoApellido').val(), $('#mes-nacimiento').val(), $('#ano-nacimiento').val());
        if (parseInt(codP) === 0) {
            alert('Es Importante el Código');
            setTimeout(function() {
                $('#dosPrimerNombre').focus();
            }, 2000);
            return false;
        }

        if (estaVacio($('#fechaRealizacion').val())) {
            alert('Debe digitar la fecha de Consejería');
            $('#fechaRealizacion').focus();
            return false;
        }

        if ($('#sexo_hombre').is(':checked') || $('#sexo_mujer').is(':checked') || $('#sexo_trans').is(':checked')) {
        } else {
            alert('Debe elegir un sexo para el contacto');
            return false;
        }

        if (estaVacio($('#lugarResidencia').val())) {
            alert('Debe seleccionar un canton de residencia');
            return false;
        }

        /*if ($('#tiempoAno').val() == "" && $('#tiempoMes').val() == "") {
         alert('Debe digitar un tiempo aproximado de diagnostico.');
         $('#tiempoMes').focus();
         return false;
         }*/

        if ($('#idEstablecimiento').val() == "") {
            alert('Debe seleccionar la Unidad o Centro de Servicios de Salud donde recibe atención.');
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

</script>
