<div id="pre-page-content">
    <h1>
        <i class="glyphicon-table themed-color"></i> Servicios de salud<br>
        <small>REGISTRO DE SERVICIOS DE SALUD.</small>
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
            <a href="#">Servicios de salud</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">listado de salud</a></li>
    </ul>
    <!-- END Breadcrumb -->
    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
            <a href="javascript:abrir_formulario_servicios_de_salud();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
            <a href="javascript:mostrar_formulario_editar_servicios_salud()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:eliminar_servicios_salud()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>
        </div>
    </div>
<!--    
    <div class="block block-themed" >  
        <div class="block-title" >
            <h4></h4>
        </div>-->
        <!--<div class="block-content">--> 
            
            
            <div class="block-section">
                <table id="tblServiciosSalud" class="table table-bordered table-hover dataTables">
                    <thead>
                        <tr>
                            <th class="text-center">Codigo</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Observaciones</th>
                            <th class="text-center">Nivel de servicio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($serviciosSalud as $serviSalud) : ?>
                            <tr fila-id="<?php echo $serviSalud->ID_SERVICIO ?>" data-nombre="<?php echo ($serviSalud->NOMBRE_SERVICIO) ?>" >
                                 <td><?php echo ($serviSalud->CODIGO_SERVICIO) ?></td>
                                 <td class="text-center"><?php echo ($serviSalud->NOMBRE_SERVICIO) ?></td>
                                 <td class="text-center"><?php echo ($serviSalud->OBSERVACIONES_SERVICIO) ?></td>
                                 <td class="text-center"><?php echo ($serviSalud->NIVEL_SERVICIO) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>  

        <!--</div>-->

    </div>
    
</div>



<script>
$(document).ready(function() {
    $('#tblServiciosSalud tbody tr').dblclick( function (e) {      
        $(this).addClass('row_selected');
        $('#registro-seleccionado').html( $(this).attr('data-nombre') );
        mostrar_formulario_editar_servicios_salud();
    });
    
    $('#tblServiciosSalud tbody tr').on('click', function (e) {        
        $('#registro-seleccionado').html( $(this).attr('data-nombre') );
    });
});	
function mostrar_formulario_editar_servicios_salud(){
    var tabla = $('#tblServiciosSalud').dataTable();   
    var idFila = filaId( tabla );
    //alert(idFila);
    if(idFila != null){
      mostrar_contenidos( 
    'sistema', 'servicios_de_salud', 'editar_form_servicios_salud','id_servicio_salud='+idFila        
    );   
    }else{
            alert('Seleccione un registro');
    }
     
}
function eliminar_servicios_salud(){
    var tabla = $('#tblServiciosSalud').dataTable();   
    var idFila = filaId( tabla );
    //alert(idFila);
    if(idFila != null){
      ejecutarAccionJson(
        'sistema', 'servicios_de_salud', 'eliminar_servicios_salud', 'id_servicio_salud='+idFila, 
        ' mostrar_resultado_guardar( data, "abrir_tabla_servicios_de_salud();", "" );'
    );  
    }else{
            alert('Seleccione un registro');
    }
   
}


</script>