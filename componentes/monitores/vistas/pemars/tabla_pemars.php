
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-user themed-color"></i>PEMAR (Población en Mayor Riesgo)<br>
        <small>Listado de Personas de Mayor Riesgo registrados en el sistema.</small>
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
            <a href="#">Receptor</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">PEMARS</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
            <a href="javascript:abrir_form_nuevo_pemar();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
            <a href="javascript:mostrar_formulario_editar_pemar()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:confirmar_eliminar_pemar()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>
        </div>
    </div>

    <!-- Dynamic Tables Section -->
    <div class="block-section">


        <table id="tblPemars" class="table table-bordered table-hover dataTables" >
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Nombre Completo</th>
                    <th>Nacimiento</th>
                    <th>Codigo</th>
<!--                    <th>Otro Nombre</th>-->
                    <th>Cedula</th>
                    <th>Provincia</th>
                    <th>Canton</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($pemarsDatos != null) {
                    foreach ($pemarsDatos as $pemars) :
                        ?>                
                        <tr fila-id="<?php echo ($pemars->ID_POBLACION) ?>" data-nombre="<?php echo ($pemars->CODIGO_UNICO_PERSONA) ?>">
                            <td><?php echo ($pemars->CODIGO_TIPOPOBLACION) ?></td>

                            <td><?php echo ($pemars->NOMBRE_UNO_POBLACION) ?> <?php echo ($pemars->NOMBRE_DOS_POBLACION) ?> <?php echo ($pemars->APELLIDO_UNO_POBLACION) ?> <?php echo ($pemars->APELLIDO_DOS_POBLACION) ?></td>

                            <td><?php echo ($pemars->MES_NACIMIENTO_POBLACION) . "-" . ($pemars->ANO_NACIMIENTO_POBLACION) ?></td>
                            <td><strong><?php echo ($pemars->CODIGO_UNICO_PERSONA) ?></strong></td>

        <!--                            <td><?php echo ($pemars->OTRO_NOMBRE_POBLACION) ?></td>-->
                            <td><?php echo ($pemars->CI_POBLACION) ?></td>
                            <td><?php echo ($pemars->NOMBRE_PROVINCIA) ?></td>
                            <td><?php echo ($pemars->NOMBRE_CANTON) ?></td>

                        </tr>
                    <?php endforeach;
                }
                ?>

            </tbody>
        </table>



    </div>
    <!-- END Dynamic Tables Section -->


</div>



<script>
    $(document).ready(function() {
        $('#tblPemars tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
            mostrar_formulario_editar_pemar();
        });

        $('#tblPemars tbody tr').on('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
        });
    });

    function mostrar_formulario_editar_pemar() {
        var tabla = $('#tblPemars').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            mostrar_contenidos(
                    'monitores', 'pemars', 'editar_form_pemar', 'id_pemar=' + idFila
                    );
        } else {
  alert('Seleccione un registro para editar');
        }

    }
    function confirmar_eliminar_pemar() {
        var tabla = $('#tblPemars').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            confirm(
                '¿Seguro que desea <strong>eliminar este codigo</strong> de la base de datos de SIMON?',
                'eliminar_pemar();'
                );
        } else {
            alert('Seleccione un registro para eliminar');
        }

    }
    function eliminar_pemar() {
        var tabla = $('#tblPemars').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            ejecutarAccionJson(
                    'monitores', 'pemars', 'eliminar_pemar', 'id_pemar=' + idFila,
                    ' mostrar_resultado_guardar( data, "abrir_listado_pemars();", "" );'
                    );
        } else {
            alert('Seleccione un registro para eliminar');
        }

    }
</script>
<script>
    agregar_boton_ayuda('LISTAPEMAR');
</script>