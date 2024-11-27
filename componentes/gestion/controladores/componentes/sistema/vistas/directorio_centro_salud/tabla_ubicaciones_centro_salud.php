<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="icon-hospital themed-color"></i>Centro de Salud<br>
        <small>Listado de Centros de Salud Registrados en el Sistema.</small>
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
        <li class="active"><a href="#">Centros de salud</a></li>
    </ul>
    <!-- END Breadcrumb -->
    
    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
            <a href="javascript:agregar_nuevo_centro_salud();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
            <a href="javascript:mostrar_formulario_editar_centro_servicio()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:eliminar_centro_servicio()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>
        </div>
    </div>

    <!-- Dynamic Tables Section -->
    <div class="block-section">
       
        
        <table id="tblcentroservicios" class="table table-bordered table-hover dataTables" >
            <thead>
                <tr>
                    <th>Tipo </th>
                    <th>Provincia</th>
                    <th>Canton</th>
                    <th>Subreceptor</th>
                    <th>Nombre</th>
                    <th>Identificaion</th>
                    <th>Contacto</th>
                    <th>Direccion</th>
                    <th>Cobertura</th>
                </tr>
            </thead>
            <tbody>
                
                                        
                
                <?php foreach ($centros as $centro) : ?>                
                <tr fila-id="<?php echo ($centro->ID_CENTROSERVICIO) ?>" data-nombre="<?php echo ($centro->NOMBRE_CENTROSERVICIO) ?>">
                    
                    
                    <td><?php echo ($centro->NOMBRE_TIPO_CENTROSERVICIO) ?></td>
                    <td><?php echo ($centro->NOMBRE_PROVINCIA) ?></td>
                    <td><?php echo ($centro->NOMBRE_CANTON) ?></td>
                    <td><?php echo ($centro->SIGLAS_SUBRECEPTOR) ?></td>
                    <td><?php echo ($centro->NOMBRE_CENTROSERVICIO) ?></td>
                    <td><?php echo ($centro->IDENTIFICACION_CENTROSERVICIO) ?></td>
                    <td><?php echo ($centro->CONTACTO_CENTROSERVICIO) ?></td>
                    <td><?php echo ($centro->DIRECCION_CENTROSERVICIO) ?></td>
                    <td><?php echo ($centro->COBERTURA_CENTROSERVICIO) ?></td>
                   
                 </tr>
                 <?php endforeach; ?>
             
            </tbody>
        </table>
        
        
        
    </div>
    <!-- END Dynamic Tables Section -->

 
    
</div>
<script>

$(document).ready(function() {
    $('#tblcentroservicios tbody tr').dblclick(function (e) {     
         $(this).addClass('row_selected');
            $('#registro-seleccionado').html($(this).attr('data-nombre') );
            mostrar_formulario_editar_centro_servicio();
    });
    
    $('#tblcentroservicios tbody tr').live('click', function (e) {     
            $('#registro-seleccionado').html($(this).attr('data-nombre') );
    });
}); 


function mostrar_formulario_editar_centro_servicio(){
    var tabla = $('#tblcentroservicios').dataTable();   
    var idFila = filaId( tabla );
    //alert(idFila);
    if(idFila != null){
        mostrar_contenidos( 
            'sistema', 'directorio_centro_salud', 'editar_form_centro_servicio','id_centroservicio='+idFila        
        );  
    }else{
            alert('Seleccione un registro');
    }
    
}
function eliminar_centro_servicio(){
    
    var tabla = $('#tblcentroservicios').dataTable();   
    var idFila = filaId( tabla );
    //alert(idFila);
    if(idFila != null){
        ejecutarAccionJson(
            'sistema', 'directorio_centro_salud', 'eliminar_centro_servicio', 'id_centroservicio='+idFila, 
            ' mostrar_resultado_guardar( data, "abrir_listado_centro_salud();", "" );'
        );
    }else{
            alert('Seleccione un registro');
    }
   

}

</script>