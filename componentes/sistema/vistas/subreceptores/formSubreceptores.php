
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Gestores de subreceptores<br>
        <small>Asignar un subreceptor a un Gestor</small>
    </h1>
</div>


<div id="page-content">
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:abrir_listado_subreceptores();">Subreceptores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Gestor de subreceptores</a></li>
    </ul>

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

            <form id="form-subreceptores" class="form-horizontal" onsubmit="return false;" >                
                <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($subreceptor) ? $subreceptor->ID_SUBRECEPTOR : ''; ?>" />

                <div class="row-fluid" >
                    <div class="span6" >

                        <div class="control-group">
                            <label class="control-label" for="codigo_subreceptor">Codigo Subreceptor</label>
                            <div class="controls">
                                <input type="text" name="codigo_subreceptor" value="<?php echo isset($subreceptor) ? ($subreceptor->CODIGO_SUBRECEPTOR) : ''; ?>" class="required" required="required" readonly="" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="siglas_subreceptor">Siglas Subreceptor</label>
                            <div class="controls">
                                <input type="text" name="siglas_subreceptor" value="<?php echo isset($subreceptor) ? ($subreceptor->SIGLAS_SUBRECEPTOR) : ''; ?>" class="required" required="required"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="nombre_subreceptor">Nombre Subreceptor</label>
                            <div class="controls">
                                <input type="text" name="nombre_subreceptor" value="<?php echo isset($subreceptor) ? ($subreceptor->NOMBRE_SUBRECEPTOR) : ''; ?>" class="required" required="required"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="edad_min_subreceptor">Edad Mínima</label>
                            <div class="controls">
                                <input type="number" name="edad_min_subreceptor" value="<?php echo isset($subreceptor) ? ($subreceptor->EDAD_MINIMA) : ''; ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="edad_max_subreceptor">Edad Máxima</label>
                            <div class="controls">
                                <input type="number" name="edad_max_subreceptor" value="<?php echo isset($subreceptor) ? ($subreceptor->EDAD_MAXIMA) : ''; ?>" />
                            </div>
                        </div>
                        <div class="control-group" style="display:none;" >
                            <label class="control-label" for="max_condones_subreceptor">Maximo Condondes Entrega</label>
                            <div class="controls">
                                <input type="number" name="max_condones_subreceptor" value="<?php echo isset($subreceptor) ? ($subreceptor->MAX_CONDONES_ENTREGA) : ''; ?>" class="required" required="required"/>
                            </div>
                        </div>                    
                        <div class="control-group">
                            <label class="control-label">Gestor</label>
                            <div id="gestorslc" class="controls">
                                <select id="gestor" name="gestor" class="select-chosen focused" >
                                    <option value >seleccione un gestor</option>
                                    <?php
                                    foreach ($gestores as $gestor) {
                                        $selected = "";
                                        if (isset($subreceptor)) {
                                            if ($gestor->ID_PERSONA == $subreceptor->ID_GESTOR) {
                                                $selected = " selected ";
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $gestor->ID_PERSONA ?>"   <?php echo $selected; ?> ><?php echo ($gestor->NOMBRE_REAL_PERSONA) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="span6" >      


                        <div class="control-group">
                            <label class="control-label"   >Provincia:</label>
                            <div class="controls ">

                                <div id="listado-provincias">                                
                                    <select id="provincia_subreceptor" name="provincia_subreceptor" class="select-chosen span12">
                                        <option value >Seleccione la provincia</option>
                                        <?php
                                        foreach ($provincias as $provincia) :
                                            if ($provincia->ID_PROVINCIA == $subreceptor->PROVINCIA_SUBRECEPTOR) :
                                                ?>
                                                <option value="<?php echo $provincia->ID_PROVINCIA ?>" selected=""><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
                                            <?php else : ?>
                                                <option value="<?php echo $provincia->ID_PROVINCIA ?>"><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
                                            <?php
                                            endif;
                                        endforeach;
                                        ?>
                                    </select>
                                </div>

                            </div>
                        </div>



                        <div class="control-group">
                            <label class="control-label"   >Canton:</label>
                            <div class="controls ">
                                <div id="listado-cantones" class=" " >                                
                                    <select id="canton_subreceptor" name="canton_subreceptor" class="select-chosen span12">
                                        <?php
                                        if (isset($subreceptor)) {
                                            foreach ($cantones as $canton) {
                                                if ($canton->ID_CANTON == $subreceptor->CANTON_SUBRECEPTOR) {
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

                        <div class="control-group">
                            <label class="control-label" for="direccion_subreceptor">Direccion</label>
                            <div class="controls">
                                <input type="text" id="direccion_subreceptor" name="direccion_subreceptor" value="<?php echo isset($subreceptor) ? ($subreceptor->DIRECCION_SUBRECEPTOR) : ''; ?>" class="required" required="" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="telefono_subreceptor">Telefono:</label>
                            <div class="controls">
                                <input type="text" name="telefono_subreceptor" value="<?php echo isset($subreceptor) ? ($subreceptor->TELEFONO_SUBRECEPTOR) : ''; ?>" class="required" required="" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="contacto_subreceptor">Nombre del Contacto</label>
                            <div class="controls">
                                <input type="text" name="contacto_subreceptor" value="<?php echo isset($subreceptor) ? ($subreceptor->CONTACTO_SUBRECEPTOR) : ''; ?>" class="required" required="" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="web_subreceptor">Sitio Web(URL):</label>
                            <div class="controls">
                                <input type="text" name="web_subreceptor" value="<?php echo isset($subreceptor) ? ($subreceptor->SITIOWEB_SUBRECEPTOR) : ''; ?>" class="required" required="" />
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row-fluid">                    
                    <div class="span6">
                        <?php
                        echo ' <div class="block block-themed">
                    <div class="block-title"><h4>Tipos de Poblacion</h4></div>
                    <div class="block-content ">';
                        foreach ($tiposPoblacion as $poblacion) {
                            $checked = "";
                            if (isset($subreceptor->TIPOS_POBLACION)) {
                                if (!empty($subreceptor->TIPOS_POBLACION)) {
                                    foreach ($subreceptor->TIPOS_POBLACION as $key => $value) {
                                        //echo ($value->ID_TIPOPOBLACION);
                                        if ($poblacion->ID_TIPOPOBLACION == $value->ID_TIPOPOBLACION) {
                                            $checked = " checked ";
                                        }
                                    }
                                }
                            }
                            echo '<label class="checkbox " for="poblacion' . $poblacion->ID_TIPOPOBLACION . '">  '
                            . '<input type="checkbox" id="poblacion-' . $poblacion->ID_TIPOPOBLACION . '" name="poblacion[]" class="input-themed" 
                              value="' . $poblacion->ID_TIPOPOBLACION . '" ' . $checked . ' >'
                            . ' ' . ($poblacion->NOMBRE_TIPOPOBLACION) . ' '
                            . '  </label>   ';
                        }
                        echo '</div>
                </div>';
                        ?>
                    </div>
                    <div class="span6" >
                        <div class="control-group">
                            <label class="control-label" for="codigo_subreceptor">Logo o Imagen :</label>
                            <div class="controls">                                
                                <select id="logo_subreceptor" name="logo_subreceptor" class="select-chosen span12">
                                    <?php foreach ($logos as $logo) : ?>                                            
                                        <?php $selected = '';
                                        if ("archivos/logos/subreceptores/" . $logo == $subreceptor->LOGO_SUBRECEPTOR)
                                            $selected = ' selected="" ';
                                        ?>
                                        <option value="archivos/logos/subreceptores/<?php echo $logo ?>" <?php echo $selected ?> ><?php echo $logo ?></option>
<?php endforeach; ?>
                                </select>                                
                                <img id="img_logo_subreceptor" src="<?php echo isset($subreceptor) ? $subreceptor->LOGO_SUBRECEPTOR : SubreceptoresModel::subreceptor_todos()->LOGO_SUBRECEPTOR; ?>" />
                            </div>
                        </div>
                    </div>
                </div>


                    
                <?php $this->mostrar('mapas/formularios', $this->datos, 'sistema'); ?>

                <!-- Form Buttons -->
                <div class="form-actions text-center">
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

        $('#provincia_subreceptor').on('change', function(evt, params) {
            cargar_cantones_cServicio('listado-cantones', 'canton_subreceptor', $(this).val());
        });

        $("#logo_subreceptor").on('change', function() {
            $('#img_logo_subreceptor').attr('src', $(this).val());
        });
        $('#direccion_subreceptor').on('change', function(evt, params) {
            var dir = $(this).val();
            //if (!estaVacio($('#canton_subreceptor').val())) {
                dir = $('#canton_subreceptor option:selected').text() + ', ' + $('#canton_subreceptor option:selected').text() + ', ' + $(this).val();
            //}
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
            map.setZoom(16);
        } else {
            initialize();
        }

        $('#form-subreceptores').submit(function() {
            var datosForm = $(this).serialize();
            if (estaVacio($('#gestor').val())) {
                alert('Debe seleccionar un gestor');
                return false;
            }
            if (estaVacio($('#registro-id').val())) {
                ejecutarAccion('gestion', 'gestoresSubreceptores', 'guardar_nuevo_gestor_subreceptor',
                        datosForm, ' alert(data); mostrar_resultado_guardar( data, "abrir_listado_subreceptores();", "" );'
                        );
            } else {
                ejecutarAccionJson(
                        'sistema', 'subreceptores', 'editar_subreceptor',
                        datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_subreceptores();", "" );'
                        );
            }
        });

    });
</script>
<script>
    agregar_boton_ayuda('EDITARSUBRECEPTOR');
</script>