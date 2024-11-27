<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Lugares Intenvencion<br>
        <small>Formulario de registro de datos para Lugares de intervencion</small>
    </h1>
</div>

<div id="page-content">
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:abrir_listado_lugar_intervencion();">Lugares de intervencion</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Formulario</a></li>
    </ul>


    <div class="block  block-themed" >
        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                Datos del Lugar de Intervencion
            </h4>
            <div class="block-options">            
            </div>  
        </div>
        <div class="block-content"> 
            <form id="form-lugares-intervencion" class="form-horizontal" onsubmit="return false;" >
                <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->ID_LUGAR) : ''; ?>" />

                <div class="row-fluid" >                    
                    <div class="span6" >
                        <!-- TIPO DE LUGAR -->
                        <div class="control-group">
                            <label class="control-label" for="tipoLugar">Tipo de lugar</label>
                            <div class="controls">
                                <select id="tipoLugar" name="tipoLugar" class="select-chosen span12" >
                                    <option value >Seleccione una</option>
                                    <?php
                                    foreach ($tipoLugares as $tipoLugar) {
                                        $selected = "";
                                        if (isset($lugarIntervencion))
                                            if ($lugarIntervencion->ID_TIPOLUGAR == $tipoLugar->ID_TIPOLUGAR)
                                                $selected = "selected";

                                        echo ('<option value="' . $tipoLugar->ID_TIPOLUGAR . '" ' . $selected . ' >' . ($tipoLugar->NOMBRE_TIPOLUGAR) . '</option>');
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- PROVICIA-CANTON -->
                        <div class="control-group">
                            <label class="control-label">Provincia</label>
                            <div id="lista-provincia" class="controls">
                                <select id="provincia-chosen" name="provincia-chosen" class="select-chosen" size="1">
                                    <option value >seleccione la provincia</option>
                                    <?php
                                    foreach ($provincias as $provincia) {
                                        $selected = "";
                                        if (isset($lugarIntervencion))
                                            if ($lugarIntervencion->ID_PROVINCIA == $provincia->ID_PROVINCIA)
                                                $selected = "selected";
                                        ?>
                                        <option value="<?php echo $provincia->ID_PROVINCIA ?>"  <?php echo $selected; ?> ><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                        <div class="control-group">
                            <label class="control-label">Cantón</label>
                            <div id="listado-cantones" class="controls">
                                <select id="cantones" name="cantones" class="select-chosen"  size="1">
                                    <option value >seleccione el canton</option>   
                                    <?php
                                    foreach ($cantones as $canton) {
                                        $selected = "";
                                        if (isset($lugarIntervencion))
                                            if ($lugarIntervencion->ID_CANTON == $canton->ID_CANTON)
                                                $selected = "selected";
                                        ?>
                                        <option value="<?php echo $canton->ID_CANTON ?>" <?php echo $selected; ?> ><?php echo ($canton->NOMBRE_CANTON) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> 
                        <!-- NOMBRE LUGAR -->
                        <div class="control-group">
                            <label class="control-label" for="nombreLugar">Nombre</label>
                            <div class="controls">
                                <input type="text" name="nombreLugar" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->NOMBRE_LUGAR) : ''; ?>" placeholder=""  class="required" required="required"/>
                            </div>
                        </div>
                        <!-- DIRECCION LUGAR -->
                        <div class="control-group">
                            <label class="control-label" for="direccionLugar">Direccion</label>
                            <div class="controls">
                                <input type="text" id="direccionLugar" name="direccionLugar" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->DIRECCION_LUGAR) : ''; ?>" placeholder=""  />
                            </div>
                        </div>
                        <!-- TELEFONO  LUGAR-->
                        <div class="control-group">
                            <label class="control-label" for="telefonoLugar">Telefono Lugar</label>
                            <div class="controls">
                                <input type="text" name="telefonoLugar" class="sinEspacios" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->TELEFONO_LUGAR) : ''; ?>" placeholder=""  />
                            </div>
                        </div>

                        <!-- WEB  --> 
                        <div class="control-group">
                            <label class="control-label" for="web">Web</label>
                            <div class="controls">
                                <input type="text" name="web" class="sinEspacios" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->WEB_LUGAR) : ''; ?>" placeholder=""  />
                            </div>
                        </div>
                    </div>
                    <div class="span6" >
                        <!-- CONTACTO  -->
                        <div class="control-group">
                            <label class="control-label" for="nombreContacto">Nombre Contacto</label>
                            <div class="controls">
                                <input type="text" name="nombreContacto" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->CONTACTO_LUGAR) : ''; ?>" placeholder=""  />
                            </div>
                        </div>
                        <!-- TELEFONO CONTACTO-->
                        <div class="control-group">
                            <label class="control-label" for="telefonoContacto">Telefono del Contacto</label>
                            <div class="controls">
                                <input type="text" name="telefonoContacto" class="sinEspacios" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->TELEFONO_CONTACTO_LUGAR) : ''; ?>" placeholder=""  />
                            </div>
                        </div>
                        <!-- CORREO CONTACTO -->
                        <div class="control-group">
                            <label class="control-label" for="correoContacto">Correo del Contacto</label>
                            <div class="controls">
                                <input type="text" name="correoContacto" class="sinEspacios" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->CORREO_CONTACTO_LUGAR) : ''; ?>" placeholder=""  />
                            </div>
                        </div>

                        <!-- REFERENCIA -->
                        <div class="control-group">
                            <label class="control-label" for="referencia">Referencia</label>
                            <div class="controls">
                                <input type="text" name="referencia" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->REFERENCIA_LUGAR) : ''; ?>" placeholder=""  />
                            </div>
                        </div>


                        <!-- OBSERVACIONES --> 
                        <div class="control-group">
                            <label class="control-label" for="observaciones">Observaciones</label>
                            <div class="controls">
                                <textarea id="observaciones" name="observaciones" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->OBSERVACIONES_LUGAR) : ''; ?>" rows="4"></textarea>
                            </div>
                        </div>
                    </div>                    
                </div>

                <?php $this->mostrar('mapas/formularios', $this->datos, 'sistema'); ?>

                <div class="form-actions">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
                    <button type="submit" class="btn btn-success"><i class="icon-save"></i> Guardar</button>
                </div>
            </form>
        </div>        
    </div>   

</div>

<script>

    $(document).ready(function() {
        //informacion('lo que sea');
        $('#form-lugares-intervencion').submit(function() {

            if (estaVacio($('#tipoLugar').val())) {
                alert('Seleccione el tipo de lugar');
                return false;
            }

            if (estaVacio($('#cantones').val())) {
                alert('Seleccione el canton');
                return false;
            }



            var datosForm = $(this).serialize();

            if (estaVacio($('#registro-id').val())) {
                ejecutarAccionJson('sistema', 'lugaresIntervencion', 'guardar_nuevo_lugar_intervencion',
                        datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_lugar_intervencion();", "" );'
                        );
            } else {
                ejecutarAccionJson(
                        'sistema', 'lugaresIntervencion', 'editar_lugar_intervencion',
                        datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_lugar_intervencion();", "" );'
                        );
            }
        });

        $('#provincia-chosen').on('change', function(evt, params) {
            cargar_cantones('listado-cantones', 'cantones', $(this).val());
        });

        $('#direccionLugar').on('change', function(evt, params) {
            var dir = $(this).val();
            if (!estaVacio($('#cantones').val())) {
                dir = $('#provincia-chosen option:selected').text() + ', ' + $('#cantones option:selected').text() + ', ' + $(this).val();
            }
            resolverDireccion(dir);
        });

        if (!estaVacio($('#registro-id').val())) {
            var posicion = {
                coords: {
                    latitude: $("#gps_lat_marcador").val(),
                    longitude: $("#gps_lon_marcador").val()
                }
            }
            //alert(posicion.coords.latitude);
            localizacion(posicion);
        } else {
            initialize();
        }

    });
</script>





<script>
<?php if (isset($lugarIntervencion)): ?>
    agregar_boton_ayuda('EDITARLUGARINTERVENCI');
<?php else: ?>
    agregar_boton_ayuda('NUEVOLUGARINTERVENCIO');
<?php endif; ?>
</script>
