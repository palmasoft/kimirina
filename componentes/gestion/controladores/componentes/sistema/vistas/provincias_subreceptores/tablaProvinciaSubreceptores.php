
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Listado Subreceptores en Provincias<br>
        <small>Subreceptores en Provincias</small>
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
        <li class="active"><a href="#">Listado Subreceptores en Provincias</a></li>
    </ul>
    <!-- END Breadcrumb -->
    
    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
            <a href="javascript:abrir_formulario_subreceptor_provincia();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
            <a href="javascript:editar_subreceptor_provincia()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <!--<a href="javascript:eliminar_actividades_tecnicas()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>-->
        </div>
    </div>
             
             
            <!-- With Stripes Section -->
            <div class="block-section">
            
                <table id="subreceptor-provincia-tabla" class="table table-bordered table-hover dataTables">
                    <thead>
                        <tr>
                            
                            <th class="text-center">CODIGO</th>
                            <th class="text-center">SIGLAS</th>
                            <th class="text-center">NOMBRE</th>
                            <th class="text-center">PROVINCIA</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($SubreceptorProvincia as $subprovincia){ 
                            echo '
                                <tr fila-id="'.$subprovincia->ID_PROVINCIA_SUBRECEPTOR.'" data-titulo="'.($subprovincia->NOMBRE_SUBRECEPTOR).'">
                                    <td>'.($subprovincia->CODIGO_SUBRECEPTOR).'</td>
                                    <td>'.($subprovincia->SIGLAS_SUBRECEPTOR).'</td>
                                        <td>'.($subprovincia->NOMBRE_SUBRECEPTOR).'</td>
                                    <td class="hidden-phone">'.($subprovincia->NOMBRE_PROVINCIA).'</td>                            
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
    $('#subreceptor-provincia-tabla tbody tr').dblclick( function (e) {
        $(this).addClass('row_selected');
        
        var tabla = $('#subreceptor-provincia-tabla').dataTable();         
        $('#registro-seleccionado').html( filaSeleccionada( tabla, 'data-titulo' ) );
        editar_subreceptor_provincia();
    });
    
    $('#subreceptor-provincia-tabla tbody tr').live('click', function (e) {        
        var tabla = $('#subreceptor-provincia-tabla').dataTable();         
        $('#registro-seleccionado').html( filaSeleccionada( tabla, 'data-titulo' ) );
    });
});

function editar_subreceptor_provincia(){
    var tabla = $('#subreceptor-provincia-tabla').dataTable();   
    var idFila = filaId( tabla );
    //alert(idFila);
    if(idFila != null){
        mostrar_contenidos( 
        'sistema', 'subreceptoresProvincias', 'editar_form_subreceptores_provincias','registro_id='+idFila      
        );
    }else{
        }
    	
}

</script>