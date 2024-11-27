<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Subreceptores en Provincias<br>
        <small>Subreceptores en Provincias</small>
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
            <a href="javascript:tabla_subreceptor_provincia();">Relaciones Subreceptores - Provincias</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Formulario</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <div class="block block-themed" >
        <div class="block-title">
            <h4>
                Subreceptores en Provincias
            </h4>
            <div class="block-options">            
            </div>  
        </div>

        <div class="block-content"> 
            <form id="form-subreceptor-provincia"  class="form-inline" onsubmit="return false;" >
                <!-- div.row-fluid -->

                <div class="row-fluid">
                    <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($datosSubreceptor) ? ($datosSubreceptor->ID_SUBRECEPTOR) : ''; ?>"/> 

                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label">Provincia</label>
                            <div id="lista-provincia" class="controls">
                                <select id="provincia-chosen" name="provincia-chosen" class="select-chosen span11">
                                    <option value >seleccione una provincia</option>                          
                                    <?php foreach ($provincias as $provincia): ?>
                                        <?php
                                        $selected = "";
                                        if (isset($datosSubreceptor)) {
                                            if ($provincia->ID_PROVINCIA == $datosSubreceptor->ID_PROVINCIA) {
                                                $selected = " selected ";
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $provincia->ID_PROVINCIA ?>" <?php echo $selected ?> ><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
                                    <?php endforeach; ?> 
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label">Subreceptores</label>
                            <div id="lista-subreceptores" class="controls">
                                <select id="subreceptor" name="subreceptor" class="select-chosen span11">
                                    <option value >seleccione un subreceptor</option>                          
                                    <?php foreach ($subreceptores as $subreceptor): ?>
                                        <?php
                                        $selected = "";
                                        if (isset($datosSubreceptor)) {
                                            if ($subreceptor->ID_SUBRECEPTOR == $datosSubreceptor->ID_SUBRECEPTOR) {
                                                $selected = " selected ";
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $subreceptor->ID_SUBRECEPTOR ?>" <?php echo $selected ?> ><?php echo ($subreceptor->NOMBRE_SUBRECEPTOR) ?></option>
                                    <?php endforeach; ?> 
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
                        <button type="submit" class="btn btn-success"><i class="icon-save"></i> Guardar</button>
                    </div>
                </div>
        </div>
        </form>
    </div>



</div>


</div>
</div>

<script>

    $(document).ready(function() {
        $("#form-subreceptor-provincia").submit(function(e) {
            var datosForm = $(this).serialize();

            if (estaVacio($("#provincia-chosen").val())) {
                alert('Debes Seleccionar una provincia');
                return false;
            }

            if (estaVacio($("#subreceptor").val())) {
                alert('Debes Seleccionar un Subreceptor');
                return false;
            }


            if (estaVacio($('#registro-id').val())) {
                ejecutarAccionJson(
                        'seguridad', 'subreceptoresProvincias', 'agregar_nuevo_subreceptores_provincias',
                        datosForm, 'mostrar_resultado_guardar( data, "tabla_subreceptor_provincia()", "" );'
                        );
            } else {
                ejecutarAccionJson(
                        'seguridad', 'subreceptoresProvincias', 'editar_subreceptores_provincias',
                        datosForm, ' mostrar_resultado_guardar( data, "tabla_subreceptor_provincia();", "" );'
                        );
            }
        });
    });

</script>
<script>
    agregar_boton_ayuda('BIENVENIDA');
</script>