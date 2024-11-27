<?php
/**
 * footer.php
 *
 * Author: pixelcave
 *
 * The footer of the page
 * Jquery library as well as all other scripts are included here
 *
 */
?>

<footer>
    <div class="pull-right">
        Creado con <i class="icon-heart"></i> by <strong><a href="http://www.palmasoftltda.com" target="_blank">puro ingenio samario</a></strong>
    </div>
    <div class="pull-left">
        <span id="year-copy"></span> &copy; <strong><a href="http://www.palmasoftltda.com" target="_blank"><?php echo $template['name'] . ' ' . $template['version']; ?></a></strong>
    </div>
</footer>
</div>

<a href="#" id="to-top"><i class="icon-chevron-up"></i></a>
<div id="zona-modal"></div>

<div id="modal-pemar-datos-cedula" class="modal hide fade"  >
    <div class="modal-body remove-padding" style="max-height: 480px;">
        <div class="block-tabs">
            <div class="block-options">
                <a href="javascript:void(0)" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i></a>
            </div>
            <ul class="nav nav-tabs" data-toggle="tabs">
                <li class="active"><a href="#"><i class="icon-search"></i> Consulta de Cédula </a></li>
            </ul>
            <div class="tab-content">
                <iframe src="tools/hack-registraduria/" width="99%" height="340px" ></iframe>
            </div>
        </div>
    </div>
</div>


<div id="modal-user-account" class="modal hide fade">
    <!-- Modal Body -->
    <div class="modal-body remove-padding">
        <!-- Modal Tabs -->
        <div class="block-tabs">
            <div class="block-options">
                <a href="javascript:void(0)" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i></a>
            </div>

            <ul class="nav nav-tabs" data-toggle="tabs">
                <li class="active"><a href="#modal-user-account-account"><i class="icon-cog"></i> Cuenta</a></li>
                <li><a href="#modal-user-account-profile"><i class="icon-user"></i> Perfil</a></li>
            </ul>

            <div class="tab-content">
                <!-- Account Tab Content -->
                <div class="tab-pane active" id="modal-user-account-account">
                    <form id="dts_usuario" method="post" class="form-horizontal" onsubmit="return false;">
                        <div class="control-group">
                            <label class="control-label" for="modal-account-username">Nombre de usuario</label>
                            <div class="controls">
                                <input type="text" id="modal-account-username" name="modal-account-username" value="<?php echo $_SESSION["SESION_USUARIO"]->NICK ?>" class="disabled" readonly="" >
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="modal-account-email">Correo</label>
                            <div class="controls">
                                <input type="text" id="modal-account-email" name="modal-account-email" value="<?php echo $_SESSION["SESION_USUARIO"]->CORREO_PERSONA ?>">
                            </div>
                        </div>
                        <h4 class="sub-header">Cambiar Clave</h4>
                        <div class="control-group">
                            <label class="control-label" for="modal-account-pass">Clave Actual</label>
                            <div class="controls">
                                <input type="password" id="modal-account-pass" name="modal-account-pass">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="modal-account-newpass">Nueva Clave</label>
                            <div class="controls">
                                <input type="password" id="modal-account-newpass" name="modal-account-newpass">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="modal-account-newrepass">Confirmar Clave</label>
                            <div class="controls">
                                <input type="password" id="modal-account-newrepass" name="modal-account-newrepass">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END Account Tab Content -->

                <!-- Profile Tab Content -->
                <div class="tab-pane" id="modal-user-account-profile">
                    <form  id="dts_perfil" method="post" class="form-horizontal" onsubmit="return false;">
                        <div class="control-group">
                            <label class="control-label" for="modal-profile-name">Nombre Legal</label>
                            <div class="controls">
                                <input type="text" id="modal-profile-name" name="modal-profile-name" value="<?php echo $_SESSION["SESION_USUARIO"]->NOMBRE_REAL_PERSONA ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="modal-profile-name">Nombre <?php echo $_SESSION["SESION_USUARIO"]->ALIAS_TIPOPOBLACION ?>[<?php echo $_SESSION["SESION_USUARIO"]->CODIGO_TIPOPOBLACION ?>]</label>
                            <div class="controls">
                                <input type="text" id="modal-profile-name" name="modal-profile-name-otro" value="<?php echo $_SESSION["SESION_USUARIO"]->NOMBRE_OTRO_PERSONA ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="modal-profile-birthdate">Fecha de Nacimiento</label>
                            <div class="controls">
                                <div class="input-append">
                                    <input type="text" id="modal-profile-birthdate" name="modal-profile-birthdate" class="input-small input-datepicker" value="<?php echo $_SESSION["SESION_USUARIO"]->FECHA_BIRTH_PERSONA ?>" >
                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="identificacion">Identificacion</label>
                            <div class="controls">
                                <input type="text" name="identificacion" class="sinEspacio" value="<?php echo $_SESSION["SESION_USUARIO"]->IDENTIFICACION_PERSONA ?>" placeholder="" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="telefono">Telefono</label>
                            <div class="controls">
                                <input type="tel" name="telefono" class="sinEspacio" value="<?php echo $_SESSION["SESION_USUARIO"]->TELEFONO_PERSONA ?>" placeholder=""  />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="correo">Correo</label>
                            <div class="controls">
                                <input type="email" name="correo" class="sinEspacio" value="<?php echo $_SESSION["SESION_USUARIO"]->CORREO_PERSONA ?>" placeholder=""  />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="direccion">Direccion</label>
                            <div class="controls">
                                <input type="text" name="direccion" class="" value="<?php echo $_SESSION["SESION_USUARIO"]->DIRECCION_PERSONA ?>" placeholder=""  />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="modal-profile-bio">Informacion Adicional</label>
                            <div class="controls">
                                <textarea id="modal-profile-bio" name="modal-profile-bio" class="textarea-elastic" rows="3"><?php echo $_SESSION["SESION_USUARIO"]->OBSERVACIONES_PERSONA ?></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END Profile Tab Content -->
            </div>
        </div>
        <!-- END Modal Tabs -->
    </div>
    <!-- END Modal Body -->

    <!-- Modal footer -->
    <div class="modal-footer">
        <button id="btn_conf_usuario" class="btn btn-success" data-dismiss="modal"><i class="icon-save"></i> Guardar</button>
    </div>
    <!-- END Modal footer -->
</div>
<!-- END User Modal Settings -->
<?php $plantilla->estilos_scripts_modulos(); ?>
<?php $plantilla->min_js(); ?>

<script src="plantillas/flatapp/js/main.js"></script>

<script>
                        $(document).ready(function() {
                            $('#btn_conf_usuario').on('click', function(e) {

                                if (!estaVacio($('#modal-account-pass').val())) {
                                    if (estaVacio($('#modal-account-newpass').val())) {
                                        return false;
                                    }
                                    if (estaVacio($('#modal-account-newrepass').val())) {
                                        return false;
                                    }
                                    if ($('#modal-account-newpass').val() !== $('#modal-account-newrepass').val()) {
                                        alert('LAS NUEVAS CONTRASEÑAS NO COINCIDEN.');
                                        return false;
                                    }
                                }

                                var user = $('#dts_usuario').serialize();
                                var datos_usuario = $('#dts_perfil').serialize();

                                ejecutarAccionJson(
                                        'sistema', 'sesion', 'actualizar_usuario',
                                        user + "&" + datos_usuario, ' mostrar_resultado_guardar( data, "window.setTimeout(function(){ location.reload(); }, 1200);", "") '
                                        );
                            });

         

                        });

                        setTimeout(function() {
                            $('html, body').animate({scrollTop: 0}, 150);
                        }, 300);

</script>

