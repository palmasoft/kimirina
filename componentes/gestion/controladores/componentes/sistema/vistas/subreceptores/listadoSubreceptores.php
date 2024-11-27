
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Subreceptores<br>
        <small>Listado de Subreceptores registrados en el sistema.</small>
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
            <a href="#">Sistema</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Subreceptores</a></li>
    </ul>
    <!-- END Breadcrumb -->
    
    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
            <!--<a href="javascript:abrir_formulario_subreceptor_provincia();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>-->
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
            <a href="javascript:mostrar_editar_subreceptor()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <!--<a href="javascript:eliminar_actividades_tecnicas()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>-->
        </div>
    </div>


    <!-- Dynamic Tables Section -->
    <div class="block-section">


        <table id="tblSubreceptores" class="table table-striped dataTables" >
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Siglas</th>
                    <th>Nombre</th>
                    <th>Tipo Poblacion</th>
                    <th>Gestor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subreceptores as $subreceptor) : ?>  
                    <tr fila-id="<?php echo ($subreceptor->ID_SUBRECEPTOR) ?>"  data-nombre="<?php echo ($subreceptor->SIGLAS_SUBRECEPTOR) ?>">                
                        <td><?php echo ($subreceptor->CODIGO_SUBRECEPTOR) ?></td>
                        <td><?php echo ($subreceptor->SIGLAS_SUBRECEPTOR) ?></td>
                        <td><?php echo ($subreceptor->NOMBRE_SUBRECEPTOR) ?></td> 
                        <td>
                            <?php 
                            if(!empty($subreceptor->TIPOS_POBLACION)){
                            foreach ($subreceptor->TIPOS_POBLACION as $tipo_poblacion) :
                                echo ($tipo_poblacion->NOMBRE_TIPOPOBLACION)."  " ;
                            endforeach;
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo ($subreceptor->NOMBRE_GESTOR); ?>
                        </td>
                <?php endforeach; ?>
            </tbody>
        </table>



    </div>
    <!-- END Dynamic Tables Section -->



</div>



<script>
    $(document).ready(function() {
        
        $('#tblSubreceptores tbody tr').dblclick(function (e) {
        $(this).addClass('row_selected');
        var tabla = $('#tblSubreceptores').dataTable(); 
        
        $('#registro-seleccionado').html( filaSeleccionada( tabla, 'data-nombre' ) );
        mostrar_editar_subreceptor();
    });
    
        $('#tblSubreceptores tbody tr').on('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
        });
    });
    function mostrar_editar_subreceptor() {
        var tabla = $('#tblSubreceptores').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            mostrar_contenidos(
                'sistema', 'subreceptores', 'editar_form_subreceptores', 'id_subreceptor=' + idFila
                );
        } else {
            alert('Seleccione un registro');
        }

    }
    
</script>


