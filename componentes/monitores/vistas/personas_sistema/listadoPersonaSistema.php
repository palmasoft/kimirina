
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-nameplate themed-color"></i> Integrantes del Proyecto<br>
        <small>Listado de TODAS las personas asociadas y/o vinculadas al proyecto.</small>
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
            <a href="#">Usuarios</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Integrantes del Proyecto</a></li>
    </ul>
    <!-- END Breadcrumb -->
    
    <div class=" row-fluid botones_arriba" >
        <div class=" span1 btn-group text-left">	
            <a href="javascript:abrir_form_nueva_persona_sistema();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>
        </div>
        <div class="span7 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
            <a href="javascript:mostrar_formulario_editar_personas_sistema()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:confirmar_eliminar_personas_sistema()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>
        </div>
    </div>

    <!-- Dynamic Tables Section -->
    <div class="block-section">
        
        <table id="tblPersonasSistema" class="table table-bordered table-hover dataTables" >
            <thead>
                <tr>
                    <th>Funcion</th>
                    <th>Nombre real</th>
                    <th>Cedula</th>
                    <th>correo</th>
                    <th>Telefono</th>
                    <th>Jefe</th>
                    <th>Subreceptor</th>
                </tr>
            </thead>
            <tbody>                
                <?php foreach ($PersonasSistema as $persona) : ?>                
                    <tr fila-id="<?php echo ($persona->ID_PERSONA) ?>" data-nombre="<?php echo ($persona->NOMBRE_ROL) ?> - <?php echo ($persona->NOMBRE_REAL_PERSONA) ?> - <?php echo ($persona->SIGLAS_SUBRECEPTOR) ?>">
                        <td><?php echo ($persona->NOMBRE_ROL) ?></td>                
                        <td><?php echo ($persona->NOMBRE_REAL_PERSONA) ?></td>
                        <td><?php echo ($persona->IDENTIFICACION_PERSONA) ?></td>
                        <td><?php echo ($persona->CORREO_PERSONA) ?></td>
                        <td><?php echo ($persona->TELEFONO_PERSONA) ?></td>
                        <td><?php echo ($persona->NOMBRE_JEFE) ?></td>
                        <td><?php echo ($persona->SIGLAS_SUBRECEPTOR) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>    
    
    </div>
    <!-- END Dynamic Tables Section -->


</div>



<script>
    $(document).ready(function() {
        $('#tblPersonasSistema tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');

            $('#registro-seleccionado').html($(this).attr('data-nombre'));
            mostrar_formulario_editar_personas_sistema();
        });

        $('#tblPersonasSistema tbody tr').on('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
        });
    });
    function mostrar_formulario_editar_personas_sistema() {
        var tabla = $('#tblPersonasSistema').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            mostrar_contenidos(
                    'monitores', 'personasSistema', 'editar_form_persona_sistema', 'id_persona_sistema=' + idFila
                    );
        } else {
 alert('Seleccione un registro para editar');
        }

    }
    function confirmar_eliminar_personas_sistema() {
        var tabla = $('#tblPersonasSistema').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {            
            var nombre = $('#tblPersonasSistema tbody tr.row_selected').attr('data-nombre');
            confirm('¿Seguro que deseas eliminar el integrante del proyecto <strong>'+nombre+'</strong> ?','eliminar_personas_sistema();');
        } else {
            alert('Seleccione un registro para eliminar');
        }

    }

    function eliminar_personas_sistema() {
        var tabla = $('#tblPersonasSistema').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            ejecutarAccionJson(
                    'monitores', 'personasSistema', 'eliminar_personas_sistema', 'id_persona_sistema=' + idFila,
                    '(data); mostrar_resultado_guardar( data, "abrir_listado_personas_sistema();", "" );'
                    );
        } else {
            alert('Seleccione un registro para eliminar');
        }

    }
</script>

<script>
    agregar_boton_ayuda('LISTAINTEGRANTES');
</script>
