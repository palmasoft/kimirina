
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Unidad de Salud<br>
        <small>Registro de la información de una unidad de salud</small>
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
            <a href="javascript:abrir_listado_centro_salud();">Unidades de Salud</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Formulario</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <div class="block  block-themed" >
        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                Datos de la unidad de Salud
            </h4>
            <div class="block-options">            
            </div>  
        </div>
        <div class="block-content"> 

            <form id="form-ubicaciones_centro" class="form-horizontal" onsubmit="return false;" >       
                <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($ubicaciones) ? ($ubicaciones->ID_CENTROSERVICIO) : ''; ?>" />             

                <div class="row-fluid" >
                    <div class="span6" >
                        <!-- SUBRECEPTOR -->
                        <div class="control-group form-horizontal">
                            <label class="control-label" for="subreceptor">Subreceptor</label>
                            <div class="controls">

                                <select id="subreceptor" name="subreceptor" class="select-chosen" size="1">
                                    <option value >Ninguno</option>
                                    <?php
                                    foreach ($subreceptores as $subreceptor) {
                                        $selected = "";
                                        if (isset($ubicaciones))
                                            if ($ubicaciones->ID_SUBRECEPTOR == $subreceptor->ID_SUBRECEPTOR)
                                                $selected = "selected";

                                        echo ('<option value="' . $subreceptor->ID_SUBRECEPTOR . '" ' . $selected . ' >' . $subreceptor->SIGLAS_SUBRECEPTOR . '</option>');
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Tipo de Centro</label>
                            <div id="listado-servicios" class="controls">
                                <select id="sel-lista-servicios" name="id_servicio" class="select-chosen"  size="1">
                                    <option value >seleccione el centro</option>
                                    <?php
                                    foreach ($tipocentros as $tipocentro) {
                                        $selected = "";
                                        if (isset($ubicaciones))
                                            if ($ubicaciones->ID_TIPO_CENTROSERVICIO == $tipocentro->ID_TIPO_CENTROSERVICIO)
                                                $selected = "selected";
                                        ?>
                                        <option value="<?php echo $tipocentro->ID_TIPO_CENTROSERVICIO ?>" <?php echo $selected; ?> ><?php echo ($tipocentro->NOMBRE_TIPO_CENTROSERVICIO) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> 

                        <div class="control-group">
                            <label class="control-label">Provincia</label>
                            <div id="lista-provincia" class="controls">
                                <select id="provincia-chosen" name="provincia-chosen" class="select-chosen" size="1">
                                    <option value >seleccione la provincia</option>
                                    <?php
                                    foreach ($provincias as $provincia) {
                                        $selected = "";
                                        if (isset($ubicaciones))
                                            if ($ubicaciones->ID_PROVINCIA == $provincia->ID_PROVINCIA)
                                                $selected = "selected";
                                        ?>
                                        <option value="<?php echo $provincia->ID_PROVINCIA ?>" <?php echo $selected; ?> ><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
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
                                        if (isset($ubicaciones))
                                            if ($ubicaciones->ID_CANTON == $canton->ID_CANTON)
                                                $selected = "selected";
                                        ?>
                                        <option value="<?php echo $canton->ID_CANTON ?>" <?php echo $selected; ?> ><?php echo ($canton->NOMBRE_CANTON) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> 



                        <div class="control-group">
                            <label class="control-label" for="direccion-ubicaicion">Direccion del Centro</label>
                            <div class="controls">
                                <input type="text" id="direccion-ubicaicion" name="direccion-ubicaicion" placeholder="Direccion" value="<?php echo isset($ubicaciones) ? ($ubicaciones->DIRECCION_CENTROSERVICIO) : ''; ?>" />
                            </div>
                        </div>

                        <div class="control-group" style="display:none;">
                            <label class="control-label" for="marcador-ubicaicion">Marcador del Centro</label>
                            <div class="controls">
                                <input type="text" name="marcador-ubicaicion" placeholder="marcador" value="<?php echo isset($ubicaciones) ? ($ubicaciones->MARCADOR_CENTROSERVICIO) : ''; ?>" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="cobertura-ubicaicion">Cobertura del Centro</label>
                            <div class="controls">
                                <input type="text" name="cobertura-ubicaicion" placeholder="cobertura" value="<?php echo isset($ubicaciones) ? ($ubicaciones->COBERTURA_CENTROSERVICIO) : ''; ?>" />
                            </div>
                        </div>


                    </div>
                    <div class="span6" >

                        <div class="control-group">
                            <label class="control-label" for="nombre-ubicacion">Nombre del Centro</label>
                            <div class="controls">
                                <input type="text" name="nombre-ubicacion" placeholder="nombre" value="<?php echo isset($ubicaciones) ? ($ubicaciones->NOMBRE_CENTROSERVICIO) : ''; ?>" class="required" required="required"/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="identificacion-ubicaicion">Identificacion del Centro</label>
                            <div class="controls">
                                <input type="text" name="identificacion-ubicaicion" class="sinEspacios" placeholder="identificaion" value="<?php echo isset($ubicaciones) ? ($ubicaciones->IDENTIFICACION_CENTROSERVICIO) : ''; ?>"  />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="telefono-ubicaicion">Telefono del Centro</label>
                            <div class="controls">
                                <input type="text" name="telefono-ubicaicion" class="sinEspacios" placeholder="telefono" value="<?php echo isset($ubicaciones) ? ($ubicaciones->TELEFONO_CENTROSERVICIO) : ''; ?>"/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="correo-ubicaicion">Correo del Centro</label>
                            <div class="controls">
                                <input type="email" name="correo-ubicaicion" class="sinEspacios" placeholder="correo" value="<?php echo isset($ubicaciones) ? ($ubicaciones->CORREO_CENTROSERVICIO) : ''; ?>" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="web-ubicaicion">Web del Centro</label>
                            <div class="controls">
                                <input type="text" name="web-ubicaicion" placeholder="web" class="sinEspacios" value="<?php echo isset($ubicaciones) ? ($ubicaciones->WEB_CENTROSERVICIO) : ''; ?>" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="contacto-ubicaicion">Contacto del Centro</label>
                            <div class="controls">
                                <input type="text" name="contacto-ubicaicion" placeholder="contacto" value="<?php echo isset($ubicaciones) ? ($ubicaciones->CONTACTO_CENTROSERVICIO) : ''; ?>" />
                            </div>
                        </div>

                    </div>
                </div>                

                <?php $this->mostrar('mapas/formularios', $this->datos, 'sistema'); ?>

                <!-- Form Buttons -->
                <div class="form-actions" align="center">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
                    <button type="submit" class="btn btn-success"><i class="icon-save"></i> Guardar</button>
                </div>
                <!-- END Form Buttons -->
            </form>

        </div>        
    </div>   

</div>



<script>
    $(document).ready(function() {

        $('#form-ubicaciones_centro').submit(function() {

            if (estaVacio($('#subreceptor').val())) {
                alert('Rellene el campo de subreceptor');
                return false;
            }
            if (estaVacio($('#sel-lista-servicios').val())) {
                alert('Rellene el campo de tipo de centro');
                return false;
            }
            if (estaVacio($('#cantones').val())) {
                alert('Rellene el campo de canton');
                return false;
            }

            var datosForm = $(this).serialize();

            if (estaVacio($('#registro-id').val())) {
                ejecutarAccionJson('sistema', 'directorio_centro_salud', 'guardar_nuevo_centro_salud',
                        datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_centro_salud();", "" );'
                        );
            } else {
                ejecutarAccionJson(
                        'sistema', 'directorio_centro_salud', 'editar_centro_salud',
                        datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_centro_salud();", "" );'
                        );
            }


        });

        $('#provincia-chosen').on('change', function(evt, params) {
            cargar_cantones('listado-cantones', 'cantones', $(this).val());
        });

        $('#direccion-ubicaicion').on('change', function(evt, params) {
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
            localizacion(posicion);
        } else {
            initialize();
        }
    });
</script>






<script>
<?php if (isset($ubicaciones)): ?>
    agregar_boton_ayuda('EDITARUNIDADSALUD');
<?php else: ?>
    agregar_boton_ayuda('NUEVAUNIDADSALUD');
<?php endif; ?>
</script>
