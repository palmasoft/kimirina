<?php ?>


<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="icon-group themed-color"></i> Tipos de PEMAR (Poblacion En Más Alto Riesgo)<br>
        <small>Todos los tipos de PEMAR</small>
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
        <li class="active"><a href="#">Tipos de Población</a></li>
    </ul>
    <!-- END Breadcrumb -->
    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
            <a href="javascript:abrir_formulario_tipo_pemar();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
            <a href="javascript:mostrar_formulario_editar_tipo_poblacion()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:eliminar_tipoPoblacion()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>
        </div>
    </div>

    <div class="block-section">
        <table id="tipos_de_poblacion-datatables" class="table table-bordered table-hover dataTables">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Alias</th>
                    <th>Observaciones</th>
                    <th>Mostrar</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($TiposPemars as $tipoPemar) { ?>
                    <tr fila-id="<?php echo $tipoPemar->ID_TIPOPOBLACION ?>" data-titulo="<?php echo ($tipoPemar->NOMBRE_TIPOPOBLACION) ?>">
                        <td><?php echo ($tipoPemar->CODIGO_TIPOPOBLACION) ?></td>
                        <td class="text-center"><?php echo ($tipoPemar->NOMBRE_TIPOPOBLACION) ?></td>
                        <td class="text-center"><?php echo ($tipoPemar->ALIAS_TIPOPOBLACION) ?></td>
                        <td class="hidden-xs hidden-sm"><?php echo ($tipoPemar->OBSERVACIONES_TIPOPOBLACION) ?></td>
                        <td class="text-center"><?php echo ($tipoPemar->MOSTRAR_WEB) ?></td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>   
    </div>   

</div>



<script>
    $(document).ready(function() {
        $('#tipos_de_poblacion-datatables tbody tr').dblclick(function (e) { 
            $(this).addClass('row_selected');
            var tabla = $('#tipos_de_poblacion-datatables').dataTable();                    
            $('#registro-seleccionado').html( filaSeleccionada( tabla, 'data-titulo' ) );
            mostrar_formulario_editar_tipo_poblacion()
        });
        
        $('#tipos_de_poblacion-datatables tbody tr').live('click', function (e) {           
            var tabla = $('#tipos_de_poblacion-datatables').dataTable();                    
            $('#registro-seleccionado').html( filaSeleccionada( tabla, 'data-titulo' ) );
        });
    });

function mostrar_formulario_editar_tipo_poblacion(){
    var tabla = $('#tipos_de_poblacion-datatables').dataTable();   
    var idFila = filaId( tabla );
    //alert(idFila);
    if(idFila != null){
        mostrar_contenidos( 
        'sistema', 'tipoPemar', 'editar_form_tipo_pemar','id_tipopemar='+idFila        
        );
    }else{
            alert('Seleccione un registro');
        }
    	
}

function eliminar_tipoPoblacion(){
    var tabla = $('#tipos_de_poblacion-datatables').dataTable();   
    var idFila = filaId( tabla );
    //alert(idFila);
    if(idFila != null){
        ejecutarAccionJson(
            'sistema', 'tipopemar', 'eliminar_tipo_pemar', 'id_tipopemar='+idFila, 
            ' mostrar_resultado_guardar(data, "abrir_tipo_pemar();", "" );'
        );
    }else{
            alert('Seleccione un registro');
        }
   
}
</script>

