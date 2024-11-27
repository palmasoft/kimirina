
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-user themed-color"></i> Tabla Usuario<br>
        <small>Todos los usuario del sistema</small>
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
            <a href="#">Gestion de Usuarios</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Listado</a></li>
    </ul>
    <!-- END Breadcrumb -->
    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
            <a href="javascript:abrir_formulario_usuario();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
            <a href="javascript:mostrar_formulario_usuario()" data-toggle="tooltip" title="Editar datos del inicio de sesion de usuario " class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:confirmar_cambiar_usuario()" data-toggle="tooltip" title="Activar o Desactivar el Usuario Seleccionado" class="btn btn-lg btn-danger"><i class="glyphicon-roundabout"></i> Activar / Desactivar</a>
        </div>
    </div>

    <div class="block-section">
        <table id="tabla-usuario" class="table table-bordered table-hover dataTables">
            <thead>
                <tr>
                    <th class="text-center">Nick</th>
                    <th class="text-center">Nombre Real</th>
                    <th class="text-center">Tipo</th>
                    <th class="text-center">Subreceptor</th>
                    <th class="text-center">Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $labels["ACTIVO"] = "label-success";
                $labels["EN REVISION"] = "label-warning";
                $labels["INACTIVO"] = "label-important";
                $labels["PENDIENTE"] = "label-info";
                $labels["REVISADO"] = "label-inverse";
                ?>
                <?php
                foreach ($Usuario as $usuario) {
                    echo '
                                <tr fila-id="' . $usuario->ID_USUARIO . '" data-titulo="' . ($usuario->NOMBRE_REAL_PERSONA) . '">
                                    <td>' . ($usuario->NICK) . '</td>
                                    <td>' . ($usuario->NOMBRE_REAL_PERSONA) . '</td>
                                    <td>' . ($usuario->NOMBRE_ROL) . '</td>
                                    <td>' . ($usuario->SIGLAS_SUBRECEPTOR) . ' | ' . ($usuario->NOMBRE_SUBRECEPTOR) . '</td>
                                    <td><span class="label';
                    echo ($labels[$usuario->ESTADO]) ? " " . $labels[$usuario->ESTADO] : "";
                    echo '">' . $usuario->ESTADO . '</td>
                                </tr>
                            ';
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

<script>
    $(document).ready(function() {
        $('#tabla-usuario tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            var tabla = $('#tabla-usuario').dataTable();
            $('#registro-seleccionado').html(filaSeleccionada(tabla, 'data-titulo'));
            mostrar_formulario_usuario();
        });

        $('#tabla-usuario tbody tr').live('click', function(e) {
            var tabla = $('#tabla-usuario').dataTable();
            $('#registro-seleccionado').html(filaSeleccionada(tabla, 'data-titulo'));
        });
    });

    function mostrar_formulario_usuario() {
        var tabla = $('#tabla-usuario').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            mostrar_contenidos(
                    'seguridad', 'usuario', 'editar_form_usuario', 'id_usuario=' + idFila
                    );
        } else {
            alert('Seleccione un registro');
        }

    }


    function confirmar_cambiar_usuario() {
        var tabla = $('#tabla-usuario').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            confirm(
                    '¿Seguro que desea cambiar el estado del usuario seleccionado?',
                    ' eliminar_usuario();'
                    );
        } else {
            alert('Seleccione un registro');
        }
    }

    function eliminar_usuario() {
        var tabla = $('#tabla-usuario').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            ejecutarAccionJson(
                    'seguridad', 'usuario', 'eliminar_usuario', 'id_usuario=' + idFila,
                    ' mostrar_resultado_guardar( data, "abrir_tabla_usuario();", "" );'
                    );
        } else {
            alert('Seleccione un registro');
        }

    }

</script>
