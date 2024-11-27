<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-user themed-color"></i> Formulario de Roles <br>
        <small>Registro de roles, funciones o tipos de usuarios.</small>
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
            <a href="javascript:abrir_tabla_tipo_usuario();">Listado Usuarios</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Roles / Funciones</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <form id="form-tipo-usuario"  class="form-inline" onsubmit="return false;" >
        <div class="block block-themed" >
            <div class="block-title">
                <h4>
                    Roles / Tipos Usuario
                </h4>
                <div class="block-options">            
                </div>  
            </div>

            <div class="block-content"> 
                <!-- div.row-fluid -->

                <div class="row-fluid">
                    <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($datosTipoUsuario) ? ($datosTipoUsuario->ID_ROL) : ''; ?>"/> 
                    <!-- 1st Column -->
                    <div class="span12">
                        <div class="control-group">
                            <label class="control-label  span2" for="codRol" >Codigo Rol</label>
                            <div class="controls  span10">
                                <input type="text" id="codRol" name="codRol" value="<?php echo isset($datosTipoUsuario) ? ($datosTipoUsuario->CODIGO_ROL) : ''; ?>" required="" readonly="" >
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label  span2" for="nombreRol" >Nombre Rol</label>
                            <div class="controls  span10">
                                <input type="text" id="nombreRol" name="nombreRol" value="<?php echo isset($datosTipoUsuario) ? ($datosTipoUsuario->NOMBRE_ROL) : ''; ?>" required="" >    
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label  span2 " for="observaciones">Observaciones:</label>
                            <div class="controls span10">
                                <div class="controls  span10">
                                    <textarea id="observaciones" name="observaciones" class="span10"><?php echo isset($datosTipoUsuario) ? ($datosTipoUsuario->NOMBRE_ROL) : ''; ?></textarea>
                                </div>
                            </div>
                        </div>   

                    </div>
                </div>
            </div>
        </div>

        <?php $this->mostrar("tipo_usuario/listaPermisosUsuario", $this->datos); ?>

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
            if (estaVacio($('#registro-id').val())) {
                ejecutarAccionJson(
                        'seguridad', 'tipousuario', 'agregar_tipo_usuario',
                        datosForm, 'mostrar_resultado_guardar( data, "abrir_tabla_tipo_usuario()", "" );'
                        );
            } else {
                ejecutarAccionJson(
                        'seguridad', 'tipousuario', 'update_tipo_usuario',
                        datosForm, 'mostrar_resultado_guardar( data, "abrir_tabla_tipo_usuario();", "" );'
                        );
            }
        });
    });

</script>