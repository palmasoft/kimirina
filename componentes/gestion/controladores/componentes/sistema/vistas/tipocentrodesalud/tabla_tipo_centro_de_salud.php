
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-hospital_h themed-color"></i> Tipo de centro de salud<br>
        <small>REGISTRO DE CENTROS DE SERVICIOS.</small>
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
        <li class="active"><a href="#">tipo_centro_de_salud</a></li>
    </ul>
    <!-- END Breadcrumb -->
    
    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
            <a href="javascript:abrir_formulario_tipo_centro_de_salud();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
            <a href="javascript:mostrar_formulario_editar_tipo_centros_salud()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:eliminar_tipo_centros_salud()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>
        </div>
    </div>
        
            <div class="block-section">
                <table id="tipos_centro_de_salud-datatables" class="table table-bordered table-hover dataTables">
                    <thead>
                        <tr>
                           
                            <th class="text-center">Codigo de centro de salud</th>
                            <th class="text-center">Nombre de centro de salud</th>
                            <th class="text-center">Observaciones de centro de salud</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($TiposCentrosSalud as $tipoCentroDeSalud) { ?>
                            <tr fila-id="<?php echo $tipoCentroDeSalud->ID_TIPO_CENTROSERVICIO ?>" data-titulo="<?php echo ($tipoCentroDeSalud->NOMBRE_TIPO_CENTROSERVICIO) ?>" >
                                 <td><?php echo ($tipoCentroDeSalud->CODIGO_TIPO_CENTROSERVICIO) ?></td>
                                 <td class="text-center"><?php echo ($tipoCentroDeSalud->NOMBRE_TIPO_CENTROSERVICIO) ?></td>
                                 <td class="text-center"><?php echo ($tipoCentroDeSalud->OBSERVACIONES_TIPO_CENTROSERVICIO) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
           
        </div>
    
</div>




<script>
$(document).ready(function() {       
    $('#tipos_centro_de_salud-datatables tbody tr').dblclick(function (e) { 
        $(this).addClass('row_selected');
        var tabla = $('#tipos_centro_de_salud-datatables').dataTable();                    
        $('#registro-seleccionado').html( filaSeleccionada( tabla, 'data-titulo' ) );
        mostrar_formulario_editar_tipo_centros_salud();
    });
    
    $('#tipos_centro_de_salud-datatables tbody tr').live('click', function (e) {           
        var tabla = $('#tipos_centro_de_salud-datatables').dataTable();                    
        $('#registro-seleccionado').html( filaSeleccionada( tabla, 'data-titulo' ) );
    });
});



function mostrar_formulario_editar_tipo_centros_salud(){
    var tabla = $('#tipos_centro_de_salud-datatables').dataTable();   
    var idFila = filaId( tabla );
    //alert(idFila);
    if(idFila != null){
         mostrar_contenidos( 
        'sistema', 'tipo_centro_de_salud', 'mostrar_editar_tipo_centro_de_salud','id_tipocentrosalud='+idFila        
        );	   
    }else{
            alert('Seleccione un registro');
    }
    
}


function eliminar_tipo_centros_salud(){                   
    var tabla = $('#tipos_centro_de_salud-datatables').dataTable();   
    var idFila = filaId( tabla );
    //alert(idFila);
    if(idFila != null){
        ejecutarAccionJson(
            'sistema', 'tipo_centro_de_salud', 'eliminar_tipo_centros_salud', 'id_tipocentrosalud='+idFila, 
            ' mostrar_resultado_guardar( data, "abrir_tabla_tipo_centro_de_salud();", "" );'
        );
    }else{
            alert('Seleccione un registro');
    }
   
}





</script>