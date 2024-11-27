

<div class="block  block-themed" >
    <div class="block-title">
        <h4>
            <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
            Actividad de Promoción y Entrega de Insumos 
        </h4>
        <div class="block-options">            
        </div>  
    </div>
    <div class="block-content"> 

        <form id="form-promocion_insumos" class="form-horizontal" onsubmit="return false;" >
            <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($promocionInsumos) ? ($promocionInsumos->ID_ACTIVIDAD_PROMOCION) : ''; ?>" />
            <input type="hidden" id="dir_archivo_soporte"  name="dir_archivo_soporte" value="" />

            <div class="control-group">
                <label class="control-label" for="fechaactividad">Fecha de Actividad:</label>
                <div class="controls">
                    <div class="input-prepend date " >
                        <span class="add-on"><i class="icon-calendar"></i></span>
                        <input type="text"  id="fechaactividad" name="fechaactividad"  class="input-small input-datepicker "
                               value="<?php if (isset($promocionInsumos)) echo $promocionInsumos->FECHA_ACTIVIDAD_PROMOCION ?>" required="">
                    </div>  
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Ubicación:</label>
                <div id="" class="controls">

                    <!-- -->
                    <div class="" style="width: 50%;margin: 0px;float: left;" >
                        <label class="" >Provincia:</label>
                        <div id="lista-provincia" class="" >
                            <select id="provincia-chosen" name="provincia-chosen" class="select-chosen cambiar_lugar_intervencion_contacto "  style="width: 100%;" >
                                <option value >Seleccione la provincia</option>
                                <?php
                                foreach ($provincias as $provincia) {
                                    $selected = "";
                                    if (isset($promocionInsumos)) {
                                        if ($promocionInsumos->ID_PROVINCIA == $provincia->ID_PROVINCIA) {
                                            $selected = "selected";
                                        }
                                    }
                                    ?>
                                    <option value="<?php echo $provincia->ID_PROVINCIA ?>"  <?php echo $selected; ?> ><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="" style="width: 50%;margin: 0px;float: left;">
                        <label class=""  >Cantón:</label>
                        <div id="listado-cantones" class="">
                            <select id="sel-lista-cantones" name="sel-lista-cantones" class="select-chosen cambiar_lugar_intervencion_contacto" style="width: 100%;" >
                                <option value >Seleccione el canton</option>
                                <?php
                                foreach ($cantones as $canton) {
                                    $selected = "";
                                    if (isset($promocionInsumos)) {
                                        if ($canton->ID_CANTON == $promocionInsumos->ID_CANTON) {
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

            <!-- -->

            <!-- lugar -->

            <div class="control-group">
                <label class="control-label" for="inline-text">Sitio de la Actividad:</label>
                <div class="controls">



                    <div class="" style="width: 50%;margin: 0px;float: left;">
                        <label class="" for="tipo_lugar_intervencion_contacto">Tipo de Establecimiento:</label>
                        <div class="">
                            <select id="tipo_lugar_intervencion_contacto" name="tipo_lugar_intervencion_contacto" class="select-chosen cambiar_lugar_intervencion_contacto"  style="width: 100%;" >
                                <option value="" data-codigo="" >Selecciones el tipo</option>
                                <?php
                                foreach ($TipoLugares as $tipolugar) {
                                    $selected = "";
                                    if (isset($promocionInsumos)) {
                                        if ($tipolugar->ID_TIPOLUGAR == $promocionInsumos->ID_TIPOLUGAR) {
                                            $selected = " selected ";
                                        }
                                    }
                                    ?>
                                    <option value=" <?php echo $tipolugar->ID_TIPOLUGAR; ?>"  <?php echo $selected; ?> data-codigo="<?php echo $tipolugar->CODIGO_TIPOLUGAR; ?>" >
                                        <?php echo ($tipolugar->NOMBRE_TIPOLUGAR); ?>
                                    </option>                                         
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="" style="width: 50%;margin: 0px;float: left;">                                       
                        <label class="" for="sitioActividad"> Lugar:</label>
                        <div class="">
                            <div id="lugar_intervencion_div" >
                                <select id="lugar_intervencion_contacto" name="lugar_intervencion_contacto" class="select-chosen "  style="width: 100%;" >
                                    <option value="" data-nombre="" >Seleccione el lugar de la actividad:</option>   
                                    <?php
                                    foreach ($lugares as $lugar) {
                                        $selected = "";
                                        if (isset($promocionInsumos)) {
                                            if ($lugar->ID_LUGAR == $promocionInsumos->ID_LUGAR) {
                                                $selected = " selected ";
                                            }
                                        }
                                        ?>
                                        <option value=" <?php echo $lugar->ID_LUGAR; ?>"  <?php echo $selected; ?> data-codigo="<?php echo $lugar->NOMBRE_LUGAR; ?>" >
                                            <?php echo ($lugar->NOMBRE_LUGAR); ?>
                                        </option>                                         
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
            <!-- lugar -->

            <div class="control-group">
                <label class="control-label" for="responsableSitio"> Responsable del Sitio:</label>
                <div class="controls">
                    <input type="text" id="responsableSitio"  name="responsableSitio" value="<?php echo isset($promocionInsumos) ? ($promocionInsumos->CONTACTO_LUGAR) : ''; ?>" readonly="" />
                </div>
            </div>         

            <div class="control-group">
                <label class="control-label" for="">Número de PEMaRs Asistentes:</label>
                <div class="controls">
                    <?php
                    if ($mostrarHSH) {
                        ?>
                        <div style="width: 25%;float: left;text-align: center;">
                            <label class="" for="totalhsh">HSH:</label>
                            <div class="">
                                <input type="number" id="totalhsh" name="totalhsh" min="0" style="width: 50%;" required=""
                                       value="<?php echo isset($promocionInsumos) ? ($promocionInsumos->NUM_HSH_ACTIVIDAD_PROMOCION) : '0'; ?>" >
                            </div>
                        </div>
                        <?php
                    }

                    if ($mostrarTS) {
                        ?>
                        <div style="width: 25%;float: left;text-align: center;">
                            <label class="" for="totalts">TS:</label>
                            <div class="">
                                <input type="number" id="totalts" name="totalts" min="0" style="width: 50%;" required=""
                                       value="<?php echo isset($promocionInsumos) ? ($promocionInsumos->NUM_TS_ACTIVIDAD_PROMOCION) : '0'; ?>" >
                            </div>
                        </div>
                        <?php
                    }

                    if ($mostrarTRANS) {
                        ?>
                        <div style="width: 25%;float: left;text-align: center;" >  
                            <label class="" for="totaltrans">TRANS:</label>
                            <div class=""> 
                                <input type="number" id="totaltrans" name="totaltrans" min="0" style="width: 50%;" required=""
                                       value="<?php echo isset($promocionInsumos) ? ($promocionInsumos->NUM_TRANS_ACTIVIDAD_PROMOCION) : '0'; ?>" >
                            </div>
                        </div>
                        <?php
                    }

                    if ($mostrarPVVS) {
                        ?>
                        <div style="width: 25%;float: left;text-align: center;" >  
                            <label class="" for="totaltrans">PVVS:</label>
                            <div class=""> 
                                <input type="number" id="totaltrans" name="totalpvvs" min="0" style="width: 50%;" required=""
                                       value="<?php echo isset($promocionInsumos) ? ($promocionInsumos->NUM_PVVS_ACTIVIDAD_PROMOCION) : '0'; ?>" >
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>




            <!--                Insumos-->
            <div class="control-group">
                <label class="control-label" >Insumos Entregados:</label>
                <div class="controls">




                    <div style="width: 30%;float: left;text-align: center;">
                        <label class="" for="condones">Condones Entregados:</label>
                        <div class="">
                            <input type="number" id="condones" name="condones" min="0"  style="width: 50%;" required="" 
                                   value="<?php echo isset($promocionInsumos) ? ($promocionInsumos->CANT_CONDONES) : '0'; ?>" >
                        </div>
                    </div>
                    <div style="width: 30%;float: left;text-align: center;">
                        <label class="" for="lubricantes">Lubricantes Entregados:</label>
                        <div class="">
                            <input type="number" id="lubricantes" name="lubricantes" min="0"  style="width: 50%;" required="" 
                                   value="<?php echo isset($promocionInsumos) ? ($promocionInsumos->CANT_LUBRICANTES) : '0'; ?>" >
                        </div>
                    </div>


                    <div style="width: 40%;float: left;text-align: center;">
                        <label class="" for="piezascomunicativas">Piezas Comunicativas Entregadas:</label>
                        <div class="">
                            <input type="number" id="piezascomunicativas" name="piezascomunicativas" min="0"  style="width: 50%;" required="" 
                                   value="<?php echo isset($promocionInsumos) ? ($promocionInsumos->CANT_FOLLETOS) : '0'; ?>" >
                        </div>
                    </div>

                </div>
            </div>


            <div class="control-group"> 
                <label class="control-label " for="idResponsableActividad">Responsable de la Actividad:</label>
                <div class="controls " >
                    <div id="listado-tipo-persona" > 
                        <select name="idResponsableActividad" id="idTipoPersona" class="select-chosen">
                            <option value="">Seleccione uno</option>               
                            <?php
                            foreach ($idTipoUsuario as $idTipoUsu) {
                                $selected = "";
                                if (isset($promocionInsumos))
                                    if ($idTipoUsu->ID_ROL == $promocionInsumos->ID_ROL_TIPOUSUARIO)
                                        $selected = " selected ";
                                ?>
                                <option value="<?php echo $idTipoUsu->ID_ROL; ?>" <?php echo $selected; ?> data-nombre="<?php echo ($idTipoUsu->NOMBRE_ROL); ?>" >
                                    <?php echo ($idTipoUsu->NOMBRE_ROL); ?>
                                </option>                                        
                            <?php } ?>                                     
                        </select>
                    </div>
                </div>
                <div class="controls " >
                    <div id="listado-personas"   >  
                        <select name="idPersona" id="idPersona" class="select-chosen">
                            <option value="">Seleccione uno</option>
                            <?php
                            if (isset($promocionInsumos)) {
                                foreach ($usuarios as $usuario) {
                                    $selected = "";
                                    if ($usuario->ID_PERSONA == $promocionInsumos->ID_PERSONA)
                                        $selected = " selected ";
                                    ?>
                                    <option value="<?php echo $usuario->ID_PERSONA; ?>" <?php echo $selected; ?> data-nombre="<?php echo ($usuario->NOMBRE_REAL_PERSONA); ?>" >
                                        <?php echo ($usuario->NOMBRE_REAL_PERSONA . " - " . $usuario->IDENTIFICACION_PERSONA); ?>
                                    </option>                                        
                                    <?php
                                }
                            }
                            ?> 

                        </select>
                    </div>
                </div>
            </div> 


            <div class="control-group">
                <label class="control-label" for="motivoActividad">Motivo de la Actividad:</label>
                <div class="controls">
                    <textarea id="motivoActividad" name="motivoActividad"  style="width:100%" required=""
                              ><?php if (isset($promocionInsumos)) echo $promocionInsumos->MOTIVO_ACTIVIDAD_PROMOCION ?></textarea>
                </div>
            </div>               
        </form>

    </div>       
</div>   


<div class="block block-themed ">
    <div class="block-title">
        <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Carga de Archivos"><i class="icon-arrow-up"></i></a>  Carga de Archivos de Soporte <small>Solo debe dar <code>clic</code> sobre seleccionar archivo!</small></h4>
    </div>

    <div class="block-content ">
        <?php $this->mostrar("registro_Promocion_Insumos/cargarArchivos", $this->datos); ?>
    </div>
</div>


<!-- Form Buttons -->
<div class="form-actions text-center">
    <button id="btn_limpiar_promocion_insumos" type="button" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
    <button id="btn_guardar_promocion_insumos" type="button" class="btn btn-success"><i class="icon-save"></i> Guardar</button>
</div>
<!-- END Form Buttons -->

<script>
    $(document).ready(function() {
        
        
        _puede_salir_formulario = false;


        var t = "<?php echo $periodoActual->FECHA_MIN_PERIODO ?> 00:00:00".split(/[- :]/);
        var iniDate = new Date(t[0], t[1] - 1, t[2]);
        iniDate.setDate(iniDate.getDate());

        t = "<?php echo $periodoActual->FECHA_MAX_PERIODO ?> 23:59:59".split(/[- :]/);
        var finDate = new Date(t[0], t[1] - 1, t[2]);
        finDate.setDate(finDate.getDate());

        $('#fechaactividad').datepicker({
            minDate: iniDate,
            maxDate: finDate,
            onClose: function(selectedDate) {

            }
        });

        $('#idTipoPersona').on('change', function(evt, params) {
            cargar_personas('listado-personas', 'idPersona', $(this).val());
        });
        $('#provincia-chosen').on('change', function(evt, params) {
            cargar_cantones_actividad_promocion_insumos('listado-cantones', 'sel-lista-cantones', $(this).val());
        });
        $('.cambiar_lugar_intervencion_contacto').on('change', function(e) {
            cargar_lugar_de_actividad();
        });
        
        
        $('#btn_guardar_promocion_insumos').on('click', function(evt, params) {
            $('#form-promocion_insumos').submit();
        });


        $('#btn_limpiar_promocion_insumos').on('click', function(evt, params) {
            confirm(
                '¿Seguro que desea limpiar el formulario o <strong>borrar los datos digitados</strong> de la actividad con entrega de insumos?'
                , 'resetear_formulario();'
            );
            
        });



    });


    function resetear_formulario(){
        
        $('#provincia-chosen option[value=""]').attr("selected", "selected");  
        $('#provincia-chosen').change();
        $('#provincia-chosen').trigger("liszt:updated");
                        
        $('#tipo_lugar_intervencion_contacto option[value=""]').attr("selected", "selected");  
        $('#tipo_lugar_intervencion_contacto').change();
        $('#tipo_lugar_intervencion_contacto').trigger("liszt:updated");

        $('#idTipoPersona option[value=""]').attr("selected", "selected");            
        $('#idTipoPersona').change();              
        $('#idTipoPersona').trigger("liszt:updated");      

        document.getElementById('form-promocion_insumos').reset();
    }

    function cargar_cantones_actividad_promocion_insumos(idContendorLista, idLista, idProvincia) {
        ejecutarAccionSinBloqueo(
                "sistema", "ubicacion", "lista_seleccion_cantones", "id_provincia=" + idProvincia + "&id_lista=" + idLista,
                "$('#" + idContendorLista + "').html(data); $('#" + idLista + "').chosen({no_results_text: 'Oops, no se encontró!'}); " +
                "$('#" + idLista + "').on('change', function(evt, params) { " +
                "cargar_lugar_de_actividad(); " +
                "}); "
                );
    }

    function cargar_lugar_de_actividad() {
        cargar_lugares_atencion(
                "lugar_intervencion_div", "lugar_intervencion_contacto", $('#tipo_lugar_intervencion_contacto').val(),
                $('#provincia-chosen').val(), $('#sel-lista-cantones').val()
                );
    }

    function traer_nombre_responsable(idLugar) {
        ejecutarAccion('sistema', 'lugaresIntervencion', 'nombre_responsable', 'idLugar=' + idLugar, '$("#responsableSitio").val(data)');
    }
</script>