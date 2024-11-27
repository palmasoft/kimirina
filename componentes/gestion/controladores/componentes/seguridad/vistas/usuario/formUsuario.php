<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-user themed-color"></i> Formulario de Usuario<br>
        <small>Registra o Edita un Usuario</small>
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
            <a href="javascript:abrir_tabla_usuario();">Listado Usuarios</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Formulario Usuario</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <form id="form-tipo-usuario"  class="form-inline" onsubmit="return false;" >
        <!-- div.row-fluid -->


        <div class="block block-themed" >
            <div class="block-title">
                <h4>
                    Usuario
                </h4>
                <div class="block-options">            
                </div>  
            </div>

            <div class="block-content"> 

                <div class="row-fluid">
                    <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($datosUsuario) ? ($datosUsuario->ID_USUARIO) : ''; ?>"/> 
                    <div class="span12">

                        <div class="control-group">
                            <label class="control-label span2" for="tipoUsuario">Persona Asociada</label>
                            <div class="controls">

                                <div  class=" span5" >
                                    <label class="label " for="tipoUsuario">Funcion en el Proyecto</label>
                                    <div class=" span10">
                                        <select id="tipoUsuario" name="tipoUsuario" class="select-chosen" >
                                            <option value="" >Seleccione una</option>
                                            <?php
                                            foreach ($tiposUsuarios as $tipo) {
                                                $selected = "";
                                                if (isset($datosUsuario)) {
                                                    if ($datosUsuario->ID_ROL_TIPOUSUARIO == $tipo->ID_ROL) {
                                                        $selected = "selected";
                                                    }
                                                }
                                                echo ('<option value="' . $tipo->ID_ROL . '" ' . $selected . ' >' . $tipo->NOMBRE_ROL . '</option>');
                                            }
                                            ?>
                                        </select>
                                    </div></div>

                                <div  class=" span5" >
                                    <label class="label  " for="nombreReal" >Nombre Real</label>
                                    <div id="listado-personas" class=" span10">
                                        <select name="idPersona" id="idPersona" class="select-chosen">
                                            <option value="" >seleccione uno</option>
                                            <?php
                                            if (isset($datosUsuario))
                                                foreach ($personas as $per) {
                                                    $selected = "";
                                                    if ($datosUsuario->ID_PERSONA == $per->ID_PERSONA)
                                                        $selected = "selected";

                                                    echo ('<option value="' . $per->ID_PERSONA . '" ' . $selected . ' >' . $per->NOMBRE_REAL_PERSONA . '</option>');
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="control-group">
                            <label class="control-label  span2" for="nick" >Nickname</label>
                            <div class="controls  span10">
                                <input type="text" id="nick" name="nick" class="sinEspacio" value="<?php echo isset($datosUsuario) ? ($datosUsuario->NICK) : ''; ?>" required="">
                            </div>
                        </div>






                        <div class="control-group">
                            <label class="control-label  span2" for="password" >Password</label>
                            <div class="controls  span10">
                                <input type="text" id="nombreRol" name="password" value="<?php echo isset($datosUsuario) ? ($datosUsuario->CLAVE_DECODIFICADA) : ''; ?>" required="" >    
                            </div>
                        </div>

                        <div class="control-group"  style="display: none;"  >
                            <label class="control-label  span2 " for="email">Email:</label>
                            <div class="controls span10">
                                <div class="controls  span10">
                                    <input type="text" id="email" name="email" class="sinEspacio" value="<?php echo isset($datosUsuario) ? ($datosUsuario->EMAIL) : ''; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="control-group"  style="display: none;" >
                            <label class="control-label span2" for="perteneceA">Jefe</label>
                            <div class="controls span10">

                                <select id="perteneceA" name="perteneceA" class="select-chosen" size="1">
                                    <option value>Ninguno</option>
                                    <?php
                                    foreach ($perteneceA as $persona) {
                                        $selected = "";
                                        if (isset($datosUsuario))
                                            if ($datosUsuario->PERTENECE_A_ID == $persona->ID_PERSONA)
                                                $selected = "selected";

                                        echo ('<option value="' . $persona->ID_PERSONA . '" ' . $selected . ' >' . $persona->NOMBRE_REAL_PERSONA . '</option>');
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="control-group" style="display: none;" >
                            <label class="control-label span2" for="subreceptor">Subreceptor</label>
                            <div class="controls span10">
                                <select id="subreceptor" name="subreceptor" class="select-chosen" size="1">
                                    <option value>Ninguno</option>
                                    <?php
                                    foreach ($subreceptores as $subreceptor) {
                                        $selected = "";
                                        if (isset($datosUsuario))
                                            if ($datosUsuario->ID_SUBRECEPTOR == $subreceptor->ID_SUBRECEPTOR)
                                                $selected = "selected";

                                        echo ('<option value="' . $subreceptor->ID_SUBRECEPTOR . '" ' . $selected . ' >' . $subreceptor->SIGLAS_SUBRECEPTOR . '</option>');
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>














                    </div>
                </div>
            </div>
        </div>

        <div id="perm" class="control-group">
            <?php $this->mostrar("tipo_usuario/listaPermisosUsuario", $this->datos); ?>
        </div>


        <div class="form-actions">
            <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
            <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Guardar</button>
        </div>
    </form>
</div>
</div>

<script>
    $(document).ready(function() {
        $("#form-tipo-usuario").submit(function(e) {
            var datosForm = $(this).serialize();

            if (estaVacio($("#tipoUsuario").val())) {
                alert('Debes Seleccionar un Rol o Funcion dentro del Sistema');
                return false;
            }

            if (estaVacio($('#registro-id').val())) {
                ejecutarAccionJson(
                        'seguridad', 'usuario', 'agregar_nuevo_usuario',
                        datosForm, ' mostrar_resultado_guardar( data, "abrir_tabla_usuario()", "" );'
                        );
            } else {
                ejecutarAccionJson(
                        'seguridad', 'usuario', 'editar_datos_usuario',
                        datosForm, ' mostrar_resultado_guardar( data, "abrir_tabla_usuario();", "" );'
                        );
            }
        });

        $('#tipoUsuario').on('change', function(evt, params) {
            cargar_personas('listado-personas', 'idPersona', $(this).val());
        });
    });

</script>