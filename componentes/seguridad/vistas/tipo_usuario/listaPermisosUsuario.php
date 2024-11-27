
<div class="">

    <div class="row-fluid">
        <div class="span8">
            <div class="control-group row-fluid">
                <label class="span6" for="permisosTipoUsuario"> Permisos Asignados al Tipo de Usuario</label>
                <div class="span6">
                    <select id="permisosTipoUsuario" name="permisosTipoUsuario" class="select-chosen" >
                        <option value="" >Seleccione una</option>
                        <?php
                        foreach ($tiposUsuarios as $tipo) {
                            $selected = "";
                            if (isset($tipoUsuarioPermisos)) {
                                if ($tipoUsuarioPermisos == $tipo->ID_ROL) {
                                    $selected = "selected";
                                }
                            }
                            echo '<option value="' . $tipo->ID_ROL . '" ' . $selected . ' >' . $tipo->NOMBRE_ROL . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="span4">
            <div class="control-group">
                <div class="controls">
                    <label  class="control-label checkbox" for="checkAll" >
                        <input type="checkbox" id="checkAll" name="checkAll" value="TODOS"  class="input-themed todos" > Seleccionar Todos / Ninguno
                    </label>
                </div>
            </div>
        </div>
    </div>


    <div class="row-fluid" style="" >

        <?php
        foreach ($Permisos as $modulo) {
            echo ' 
                <div class="span6" style="padding: 0px 10px;margin:0px;" >
                <div class="block block-themed " style="" >
                <div class="block-title">
                    <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir esta seccion" ><i class="fa fa-arrow-up"></i></a> ' . ( $modulo->TITULO_MODULO ) . '</h4>                    
                     <div class="block-options">
                    <label class="checkbox" for="checkAll' . ( $modulo->ID_MODULO ) . '" >
                        <input type="checkbox" id="checkAll" name="checkAll" value="TODOS"  data-modulo="' . ( $modulo->ID_MODULO ) . '" 
                            class="input-themed todos_modulos" /> Seleccionar Todos / Ninguno
                    </label>                    
                    </div>
                </div>
                <div class="block-content " style="height:240px;overflow-x:visible;overflow-y:scroll;" >';
            foreach ($modulo->FUNCIONES as $permisos) {
                $checked2 = "";
                if (isset($permisosSel)) {
                    foreach ($permisosSel as $key => $value) {
                        if ($permisos->ID_MENU == $value) {
                            $checked2 = " checked ";
                        }
                    }
                }
                echo '<div style="background-color: #FEFEFE; margin-bottom: 5px; " >'
                . '<label class="checkbox " for="permiso' . $permisos->ID_MENU . '">  '
                . '<input type="checkbox" id="permiso-' . $permisos->ID_MENU . '" name="permiso[]" class="input-themed check check_' . ( $modulo->ID_MODULO ) . '" 
                          value="' . $permisos->ID_MENU . '" ' . $checked2 . ' >'
                . ' ' . ($permisos->TITULO_MENU) . ' '
                . '  </label>   <br />';


                if (count($permisos->SUBMENU) > 0) {
                    echo '<div style="padding-left:30px;">';
                    foreach ($permisos->SUBMENU as $submenu) {
                        $checked3 = "";
                        if (isset($permisosSel)) {
                            foreach ($permisosSel as $key => $value) {
                                if ($submenu->ID_MENU == $value) {
                                    $checked3 = " checked ";
                                }
                            }
                        }
                        echo '<label class="checkbox " for="permiso' . $submenu->ID_MENU . '">  '
                        . '<input type="checkbox" id="permiso-' . $submenu->ID_MENU . '" name="permiso[]" class="input-themed check check_' . ( $modulo->ID_MODULO ) . '" 
                          value="' . $submenu->ID_MENU . '" ' . $checked3 . ' >'
                        . ' ' . ($submenu->TITULO_MENU) . ' '
                        . '  </label>  <br />  ';
                    }
                    echo '</div>';
                }
                echo '</div>';
            }
            echo '</div>
            </div>
        </div>

        ';
        }
        ?>
    </div>
</div>


<script>

    $(document).ready(function() {
        
        $(".select-chosen").chosen({width: "98%"});

        $("#permisosTipoUsuario").on('change', (function(e) {
            ejecutarAccion(
                    'seguridad', 'tipousuario', 'check_permisos_tipo_usuario',
                    'id_tipo_usuario=' + $(this).val(), ' $("#perm").html(data);  $(".input-themed").iCheck({ checkboxClass: "icheckbox_square-grey", radioClass: "iradio_square-grey"  }); ');
        }));


        var checkAll = $('input.todos');
        var checkMod = $('input.todos_modulos');
        var checkboxes = $('input.check');

        checkAll.on('ifChecked ifUnchecked', function(event) {
            if (event.type == 'ifChecked') {
                checkboxes.iCheck('check');
            } else {
                checkboxes.iCheck('uncheck');
            }
        });

        checkMod.on('ifChecked ifUnchecked', function(event) {
            var checkboxes_mod = $('input.check_' + $(this).attr('data-modulo'));
            if (event.type == 'ifChecked') {
                checkboxes_mod.iCheck('check');
            } else {
                checkboxes_mod.iCheck('uncheck');
            }
        });

        checkboxes.on('ifChanged', function(event) {
            if (checkboxes.filter(':checked').length == checkboxes.length) {
                checkAll.prop('checked', 'checked');
            } else {
                checkAll.removeProp('checked');
            }
            checkAll.iCheck('update');
        });




    });


</script>