
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-user themed-color"></i> Integrantes de Proyecto<br>
        <small>Registro de persona asociada al proyecto</small>
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
            <a href="javascript:abrir_listado_personas_sistema();">Integrantes Proyecto</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Formulario Integrantes Proyecto</a></li>
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
            <?php // echo isset( $personaSistema ) ? ($personaSistema->NOMBRE_REAL_PERSONA) : '' ; ?>
            <form id="form-personas-sistema" class="form-horizontal" onsubmit="return false;" >
                <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($personaSistema) ? ($personaSistema->ID_PERSONA) : ''; ?>" />

                <div class="control-group">
                    <label class="control-label" for="subreceptor">Subreceptor</label>
                    <div class="controls">

                        <select id="subreceptor" name="subreceptor" class="select-chosen" size="1">
                            <option value="" >Kimirina</option>
                            <?php
                            foreach ($subreceptores as $subreceptor) {
                                $selected = "";
                                if (isset($personaSistema)) {
                                    if ($personaSistema->ID_SUBRECEPTOR == $subreceptor->ID_SUBRECEPTOR) {
                                        $selected = "selected";
                                    }
                                }
                                echo ('<option value="' . $subreceptor->ID_SUBRECEPTOR . '" ' . $selected . ' >' . $subreceptor->SIGLAS_SUBRECEPTOR . '</option>');
                            }
                            ?>
                        </select>
                    </div>
                </div>                
                <div class="control-group">
                    <label class="control-label" for="tipoUsuario">Funcion</label>
                    <div class="controls">
                        <select id="tipoUsuario" name="tipoUsuario" class="select-chosen" >
                            <option value>Seleccione una</option>
                            <?php
                            foreach ($tiposUsuarios as $tipo) {
                                $selected = "";
                                if (isset($personaSistema))
                                    if ($personaSistema->ID_ROL_TIPOUSUARIO == $tipo->ID_ROL)
                                        $selected = "selected";

                                echo ('<option value="' . $tipo->ID_ROL . '" ' . $selected . ' >' . $tipo->NOMBRE_ROL . '</option>');
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group" style="display: none;" >
                    <label class="control-label" for="tiposPoblacion">Tipo de poblacion</label>
                    <div class="controls">
                        <select id="tipoPoblacion" name="tiposPoblacion" class="select-chosen" size="1">
                            <option id="defaultTipoPoblacion" value>Seleccione una</option>
                            <?php
                            foreach ($tiposPoblacion as $tipo) {
                                $selected = "";
                                if (isset($personaSistema))
                                    if ($personaSistema->ID_TIPOPOBLACION == $tipo->ID_TIPOPOBLACION)
                                        $selected = "selected";

                                echo ('<option value="' . $tipo->ID_TIPOPOBLACION . '" ' . $selected . ' >' . $tipo->NOMBRE_TIPOPOBLACION . '</option>');
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group" style="display: none;">
                    <label class="control-label">Provincia</label>
                    <div id="lista-provincia" class="controls">
                        <select id="provincia-chosen" name="provincia-chosen" class="select-chosen" size="1">
                            <option value >seleccione la provincia</option>
                            <?php
                            foreach ($provincias as $provincia) {
                                $selected = "";
                                if (isset($personaSistema))
                                    if ($personaSistema->PROVINCIA_PERSONA == $provincia->ID_PROVINCIA)
                                        $selected = "selected";
                                ?>
                                <option value="<?php echo $provincia->ID_PROVINCIA ?>"  <?php echo $selected; ?> ><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
                            <?php } ?>
                        </select>
                    </div>

                </div>
                <div class="control-group" style="display: none;">
                    <label class="control-label">Cantón</label>
                    <div id="listado-cantones" class="controls">
                        <select id="cantones" name="cantones" class="select-chosen"  size="1">
                            <option id="defaultCanton" value >seleccione el canton</option>   
                            <?php
                            foreach ($cantones as $canton) {
                                $selected = "";
                                if (isset($personaSistema))
                                    if ($personaSistema->CANTON_PERSONA == $canton->ID_CANTON)
                                        $selected = "selected";
                                ?>
                                <option value="<?php echo $canton->ID_CANTON ?>" <?php echo $selected; ?> ><?php echo ($canton->NOMBRE_CANTON) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="nombreReal">Nombre real</label>
                    <div class="controls">
                        <input type="text" name="nombreReal" class="" value="<?php echo isset($personaSistema) ? ($personaSistema->NOMBRE_REAL_PERSONA) : ''; ?>" placeholder="" required />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="nombreOtro">Nombre otro</label>
                    <div class="controls">
                        <input type="text" name="nombreOtro" class="" value="<?php echo isset($personaSistema) ? ($personaSistema->NOMBRE_OTRO_PERSONA) : ''; ?>"placeholder=""  />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="identificacion">Identificacion</label>
                    <div class="controls">
                        <input type="text" name="identificacion" class="sinEspacio" value="<?php echo isset($personaSistema) ? ($personaSistema->IDENTIFICACION_PERSONA) : ''; ?>" placeholder="" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="telefono">Telefono</label>
                    <div class="controls">
                        <input type="tel" name="telefono" class="sinEspacio" value="<?php echo isset($personaSistema) ? ($personaSistema->TELEFONO_PERSONA) : ''; ?>" placeholder=""  />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="correo">Correo</label>
                    <div class="controls">
                        <input type="email" name="correo" class="sinEspacio" value="<?php echo isset($personaSistema) ? ($personaSistema->CORREO_PERSONA) : ''; ?>" placeholder=""  />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="direccion">Direccion</label>
                    <div class="controls">
                        <input type="text" name="direccion" class="" value="<?php echo isset($personaSistema) ? ($personaSistema->DIRECCION_PERSONA) : ''; ?>" placeholder=""  />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="fechaNacimiento">Fecha de nacimiento</label>
                    <div class="controls">
                        <input type="text" id="fechaNacimiento" name="fechaNacimiento"  value="<?php echo isset($personaSistema) ? ($personaSistema->FECHA_BIRTH_PERSONA) : ''; ?>" class="input-small ">

                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="observaciones">Observaciones</label>
                    <div class="controls">
                        <textarea id="observaciones" name="observaciones" value="<?php echo isset($personaSistema) ? ($personaSistema->OBSERVACIONES_PERSONA) : ''; ?>" rows="4"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="perteneceA">Jefe</label>
                    <div class="controls">
                        <select id="perteneceA" name="perteneceA" class="select-chosen" size="1">
                            <option value>Ninguno</option>
                            <?php
                            foreach ($perteneceA as $persona) {
                                $selected = "";
                                if (isset($personaSistema)) {
                                    if ($personaSistema->PERTENECE_A_ID == $persona->ID_PERSONA) {
                                        $selected = "selected";
                                    }
                                }
                                echo '<option value="' . $persona->ID_PERSONA . '" ' . $selected . ' >' . $persona->SIGLAS_SUBRECEPTOR . ' - ' . $persona->NOMBRE_ROL . ' - ' . $persona->NOMBRE_REAL_PERSONA . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-actions text-center">
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
        var iniDate = new Date('1960', '01', '01');
        $('#fechaNacimiento').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });

        $('#form-personas-sistema').submit(function() {

            if (estaVacio($('#tipoUsuario').val())) {
                alert("Debe seleccionar una funcion");
                return false;
            }

//            if (estaVacio($('#perteneceA').val())) {
//                alert("Debe seleccionar un Jefe Inmediato");
//                return false;
//            }
//            
//            if (estaVacio($('#subreceptor').val())) {
//                alert("Debe seleccionar un Subreceptor");
//                return false;
//            }
//            
//            if (estaVacio($('#tipoPoblacion').val())) {
//               $('#defaultTipoPoblacion').attr('value', 'NULL');                 
//            }

            if (estaVacio($('#cantones').val())) {
                $('#defaultCanton').attr('value', 'NULL');
            }

            var datosForm = $(this).serialize();
            if (estaVacio($('#registro-id').val())) {
                ejecutarAccionJson('monitores', 'personasSistema', 'guardar_nueva_persona_sistema', datosForm,
                        'mostrar_resultado_guardar( data, "abrir_listado_personas_sistema();", "" );');
            } else {
                ejecutarAccionJson(
                        'monitores', 'personasSistema', 'editar_persona_sistema',
                        datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_personas_sistema();", "" );'
                        );
            }
        });


        $('#provincia-chosen').on('change', function(evt, params) {
            cargar_cantones('listado-cantones', 'cantones', $(this).val());
        });

    });
</script>


<script>
<?php if (isset($personaSistema)): ?>
    agregar_boton_ayuda('EDITARINTEGRANTE');
<?php else: ?>
    agregar_boton_ayuda('NUEVOINTEGRANTE');
<?php endif; ?>
</script>