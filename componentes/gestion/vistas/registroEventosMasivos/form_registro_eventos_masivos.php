<?php //print_r($cantones);     ?>
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i>Registros de Eventos Masivos<br>
        <small>Registros de Eventos Masivos al sistema</small>
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
            <a href="javascript:abrir_lista_registro_eventos_masivos();">Registros</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Registros de Eventos Masivos</a></li>
    </ul>
    <!-- END Breadcrumb -->


    <div class="block  block-themed" >
        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                Datos 
            </h4>
            <div class="block-options">            
            </div>  
        </div>
        <div class="block-content"> 
            <?php // print_r($ObjEvento) ?>
            <form id="form-eventos_masivos" class="form-horizontal" onsubmit="return false;" >
                <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($ObjEvento) ? ($ObjEvento->ID_EVENTO_MASIVO) : ''; ?>" />
                <input type="hidden" id="dir_archivo_soporte"  name="dir_archivo_soporte" value="" />

                <div class="control-group">
                    <label class="control-label" for="fechaactividad">Fecha de actividad</label>
                    <div class="controls">
                        <div class="input-prepend date " >
                            <span class="add-on"><i class="icon-calendar"></i></span>
                            <input type="text"  id="fechaactividad" name="fechaactividad"  class="input-small input-datepicker " required=""
                                   value="<?php if (isset($ObjEvento)) echo $ObjEvento->FECHA_EVENTO_MASIVO ?>" >
                        </div>  
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Ubicación</label>
                    <div class="controls">  

                        <div class="" style="width: 50%;float: left;" >
                            <label class="">Provincia</label>
                            <div id="lista-provincia" class="">
                                <select id="provincia-chosen" name="provincia-chosen" class="select-chosen actualizar_lugar "  style="width: 100%;"  >
                                    <option value="" >Seleccione la provincia</option>
                                    <?php
                                    foreach ($provincias as $provincia) {
                                        $selected = "";
                                        if (isset($ObjEvento)) {
                                            if ($provincia->ID_PROVINCIA == $ObjEvento->ID_PROVINCIA) {
                                                $selected = " selected ";
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $provincia->ID_PROVINCIA ?>"   <?php echo $selected; ?> ><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="" style="width: 50%;float: left;" >
                            <label class="">Cantón</label>
                            <div id="listado-cantones" class="">
                                <select id="sel-lista-cantones" name="sel-lista-cantones" class="select-chosen actualizar_lugar"  style="width: 100%;" >
                                    <option value="" >Seleccione el cantón</option>
                                    <?php
                                    foreach ($cantones as $canton) {
                                        $selected = "";
                                        if (isset($ObjEvento)) {
                                            if ($canton->ID_CANTON == $ObjEvento->ID_CANTON) {
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
                    <label class="control-label" for="responsableSitio">Sitio de la Actividad</label>
                    <div class="controls">
                        <div class="" style="width: 50%;float: left;" >
                            <label class="" for="inline-text">Tipo lugar</label>
                            <div class="">
                                <select id="tipo_lugar_intervencion_contacto" name="tipo_lugar_intervencion_contacto" class="select-chosen "  style="width: 100%;"  >
                                    <option value="" data-codigo="" >Seleccione tipo Lugar</option>
                                    <?php
                                    foreach ($TipoLugares as $tipolugar) {
                                        $selected = "";
                                        if (isset($ObjEvento)) {
                                            if ($tipolugar->ID_TIPOLUGAR == $ObjEvento->ID_TIPOLUGAR) {
                                                $selected = " selected ";
                                            }
                                        }
                                        ?>
                                        <option <?php echo $selected; ?>  value="<?php echo $tipolugar->ID_TIPOLUGAR; ?>" data-codigo="<?php echo $tipolugar->CODIGO_TIPOLUGAR; ?>" >
                                            <?php echo ($tipolugar->NOMBRE_TIPOLUGAR); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="" style="width: 50%;float: left;" >
                            <label class="" for="sitioActividad"> Lugar</label>
                            <div class="">
                                <div id="lugar_intervencion_div"  >
                                    <select id="lugar_intervencion_contacto" name="lugar_intervencion_contacto" class="select-chosen "  style="width: 100%;"   >
                                        <option value="" data-nombre="" >Seleccione lugar Actividad</option>   
                                        <?php
                                        foreach ($Lugares as $lugar) {
                                            $selected = "";
                                            if (isset($ObjEvento)) {
                                                if ($lugar->ID_LUGAR == $ObjEvento->ID_LUGAR_EVENTO_MASIVO) {
                                                    $selected = " selected ";
                                                }
                                            }
                                            ?>
                                            <option <?php echo $selected; ?> value="<?php echo $lugar->ID_LUGAR; ?>" data-nombre="<?php echo ($lugar->NOMBRE_LUGAR); ?>" >
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
                    <label class="control-label" for="responsableSitio"> Responsable del Sitio</label>
                    <div class="controls">
                        <input type="text" id="responsableSitio"  name="responsableSitio" value="<?php echo isset($ObjEvento) ? ($ObjEvento->CONTACTO_LUGAR) : ''; ?>" readonly="" />


                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="referidos">Referidos efectivos a un servicio de salud</label>
                    <div class="controls">
                        <input type="number" id="referidos" name="referidos" min="1" value="<?php echo isset($ObjEvento) ? ($ObjEvento->NUM_EFECTIVOS_EVENTO_MASIVO) : '0'; ?>" required="" >
                    </div>
                </div>





                <!--                Insumos-->
                <div class="control-group">
                    <label class="control-label" >Insumos Entregados</label>
                    <div class="controls">

                        <div style="width: 30%;float: left;text-align: center;">
                            <label class="" for="condones">Condones</label>
                            <div class="">
                                <input type="number" id="condones" name="condones" min="0" value="<?php echo isset($ObjEvento) ? ($ObjEvento->NUM_CONDONES) : '0'; ?>" required=""  style="width: 50%;" >
                            </div>
                        </div>
                        <div style="width: 30%;float: left;text-align: center;">
                            <label class="" for="lubricantes">Lubricantes</label>
                            <div class="">
                                <input type="number" id="lubricantes" name="lubricantes" min="0" value="<?php echo isset($ObjEvento) ? ($ObjEvento->NUM_LUBRICANTES) : '0'; ?>" required=""  style="width: 50%;" >
                            </div>
                        </div>
                        <div style="width: 40%;float: left;text-align: center;">
                            <label class="" for="piezascomunicativas">Piezas comunicativas</label>
                            <div class="">
                                <input type="number" id="piezascomunicativas" name="piezascomunicativas" min="0" value="<?php echo isset($ObjEvento) ? ($ObjEvento->NUM_FOLLETOS) : '0'; ?>" required=""  style="width: 50%;" >
                            </div>
                        </div>

                    </div>
                </div>


                <div class="control-group"> 
                    <label class="control-label" for="empresaOrganizaActividad"> Empresa que organiza la actividad</label>
                    <div class="controls">
                        <textarea id="empresaOrganizaActividad" name="empresaOrganizaActividad" required=""
                                  style="width:100%"><?php if (isset($ObjEvento)) echo $ObjEvento->EMPRESA_ORGANIZA_ACTIVIDAD ?></textarea>
                    </div>
                    <label class="control-label " for="idResponsableActividad">Responsable de la Actividad</label>
                    <div class="controls " >
                        <div id="listado-tipo-persona" > 
                            <select name="tipoPersona" id="idTipoPersona" class="select-chosen">
                                <option value="">seleccione uno</option>    
                                <?php
                                foreach ($TiposUsuario as $idTipoUsu) {
                                    $selected = "";
                                    if (isset($ObjEvento))
                                        if ($idTipoUsu->ID_ROL == $ObjEvento->ID_ROL_TIPOUSUARIO)
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
                                <option value="">seleccione uno</option>
                                <?php
                                if (isset($ObjEvento)) {

                                    foreach ($usuarios as $usuario) {
                                        $selected = "";
                                        if ($usuario->ID_PERSONA == $ObjEvento->ID_RESPONSABLE_EVENTO_MASIVO)
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
                    <label class="control-label" for="motivoActividad"> Motivo de la Actividad</label>
                    <div class="controls">
                        <textarea id="observaciones" name="motivoActividad" required=""
                                  style="width:100%"><?php if (isset($ObjEvento)) echo $ObjEvento->MOTIVO_EVENTO_MASIVO ?></textarea>
                    </div>
                </div>
            </form>
        </div>        
    </div>   

    <div class="block block-themed block-last" style="" >
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Carga de Archivos"><i class="icon-arrow-up"></i></a>  Carga de Archivos de Soporte <small>Solo debe dar <code>clic</code> sobre seleccionar archivo!</small></h4>
        </div>
        <div class="block-content ">
            <?php $this->mostrar("registroEventosMasivos/cargarArchivos", $this->datos); ?>
        </div>
    </div>

    <div class="form-actions text-center">
        <button id="btn_limpiar_eventos_masivos" type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
        <button id="btn_guardar_eventos_masivos" type="submit" class="btn btn-success"><i class="icon-save"></i> Guardar</button>
    </div>

</div>



<script>
    $(document).ready(function() {

        var t = "<?php echo $periodoActual->FECHA_MIN_PERIODO ?> 00:00:00".split(/[- :]/);
        var iniDate = new Date(t[0], t[1] - 1, t[2]);
        iniDate.setDate(iniDate.getDate());

        t = "<?php echo $periodoActual->FECHA_MAX_PERIODO ?> 23:59:59".split(/[- :]/);
        var finDate = new Date(t[0], t[1] - 1, t[2]);
        finDate.setDate(finDate.getDate());

        $('#fechaactividad').datepicker({
            //minDate: iniDate,
            maxDate: finDate,
            onClose: function(selectedDate) {
            }
        });

        $('#btn_guardar_eventos_masivos').on('click', function(evt, params) {
            $('#form-eventos_masivos').submit();
        });

        $('#btn_limpiar_eventos_masivos').on('click', function(evt, params) {
             confirm(
                '¿Seguro que desea limpiar el formulario o <strong>borrar los datos digitados</strong> del Evento Masivo?'
                , 'resetear_formulario();'
            );

        });

        $('#provincia-chosen').on('change', function(evt, params) {
            cargar_cantones('listado-cantones', 'sel-lista-cantones', $(this).val());            
        });

        $('.actualizar_lugar').on('change', function(evt, params) {
            cargar_lugares_atencion(
                    "lugar_intervencion_div", "lugar_intervencion_contacto",
                    $('#tipo_lugar_intervencion_contacto').val(), $('#provincia-chosen').val(), $('#sel-lista-cantones').val()
                    );
        });

        $('#tipo_lugar_intervencion_contacto').on('change', function(e) {
            cargar_lugares_atencion("lugar_intervencion_div", "lugar_intervencion_contacto", $(this).val(), $('#provincia-chosen').val(), $('#sel-lista-cantones').val());
        });

        $('#idTipoPersona').on('change', function(evt, params) {
            cargar_personas('listado-personas', 'idPersona', $(this).val());
        });


        //informacion('lo que sea');

        $('#form-eventos_masivos').validate({
            submitHandler: function(form) {
//            var data = $(this).serialize();

                if (estaVacio($('#lugar_intervencion_contacto').val())) {
                    alert('Debe seleccionar el Lugar donde se realizó la actividad.');
                    return false;
                }


                if (estaVacio($('#idPersona').val())) {
                    alert('Debe seleccionar un persona que sea parte del proyecto que sea Responsable por la actividad..');
                    return false;
                }

                var data = new FormData(document.getElementById('form-eventos_masivos'));

//            alert(data['fechaactividad']);

                var soportes = $('#form_evento_masivo_soportes').serializeArray();
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
                    ejecutarAccionJsonArchivos(
                            'gestion', 'registroEventosMasivos', 'guardar_evento_masivo_referidos_efectivos',
                            data, 'mostrar_resultado_guardar( data, "abrir_lista_registro_eventos_masivos();", "" );'
                            );
                } else {
                    ejecutarAccionJsonArchivos(
                            'gestion', 'registroEventosMasivos', 'editar_evento_masivo_referidos_efectivos',
                            data, 'mostrar_resultado_guardar( data, "abrir_lista_registro_eventos_masivos();", "" );'
                            );
                }


                event.handled = true;
                return false;
            }
        });

//        $('#form-eventos_masivos').submit(function() {
////            var datosForm = $(this).serialize();
//
//            if (estaVacio($('#lugar_intervencion_contacto').val())) {
//                alert('Debe seleccionar el Lugar donde se realizó la actividad.');
//                return false;
//            }
//            
//            var data = new FormData(document.getElementById('form-eventos_masivos'));
//            
//            var soportes = $('#form_evento_masivo_soportes').serializeArray();
//            $.each(soportes, function(i, field) {
//                data.append("" + field.name + "", "" + field.value + "");
//            });
//
//            var archivos = $(".cargar_soporte");
//            for (i = 0; i < archivos.length; i++) {
//                $.each($('.cargar_soporte')[i].files, function(k, file) {
//                    data.append('soporte-' + (k + i), file);
//                });
//            }
//            
//
//            if (estaVacio($('#registro-id').val())) {
//                ejecutarAccion(
//                        'gestion', 'registroEventosMasivos', 'guardar_evento_masivo_referidos_efectivos',
//                        data, 'alert("dadsadas"); mostrar_resultado_guardar( data, "abrir_lista_registro_eventos_masivos();", "" );'
//                        );
//            } else {
//                ejecutarAccion(
//                        'gestion', 'registroEventosMasivos', 'editar_evento_masivo_referidos_efectivos',
//                        data, 'alert("dadsadas"); mostrar_resultado_guardar( data, "abrir_lista_registro_eventos_masivos();", "" );'
//                        );
//            }
//
//        });

    });


function resetear_formulario(){
   


    document.getElementById('form-eventos_masivos').reset();
}

    function traer_nombre_responsable(idLugar) {
        ejecutarAccion('sistema', 'lugaresIntervencion', 'nombre_responsable', 'idLugar=' + idLugar, '$("#responsableSitio").val(data)');
    }



</script>



<script>
<?php if (isset($ObjEvento)): ?>
    agregar_boton_ayuda('EDITAREVENTOSMASIVOS');
<?php else: ?>
    agregar_boton_ayuda('NUEVOEVENTOSMASIVOS');
<?php endif; ?>
</script>