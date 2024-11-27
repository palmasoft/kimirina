
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="icon-suitcase themed-color"></i> Listado Temas<br>
        <small>Todos los Temas a tratar</small>
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
        <li class="active"><a href="#">Listado</a></li>
    </ul>
    <!-- END Breadcrumb -->
    <div class="block block-themed" >  
        <div class="block-title" >
            <h4></h4>
        </div>
        <div class="block-content"> 



            <table class="botones_arriba" align="center" ><tr><td>
                    <div class=" span1 btn-group">
                            <a href="javascript:abrir_formulario_temas();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>						
                    </div>
                    <span class="span3 text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span> </span>
                    <div class="btn-group">                            
                            <a href="javascript:mostrar_formulario_editar_temas();" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:eliminar_tema()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i></a>
                    </div>
            </td></tr></table>
             
            <!-- With Stripes Section -->
            <div class="block-section">
                
                
                
                <table id="temas-salud-tabla" class="table table-striped dataTables" >
                    <thead>
                        <tr>
                            <th class="text-center">Titulo</th>
                            <th class="text-center">Descripcion</th>
                            <th class="text-center">Instrucciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                         <?php                        
                         foreach ($Temas as $tema){ 
                            echo '
                                <tr fila-id="'.$tema->ID_TEMA.'" data-titulo="'.($tema->TITULO_TEMA).'" >
                                    <td>'.($tema->TITULO_TEMA).'</td>
                                    <td class="hidden-phone">'.($tema->DESCRIPCION_TEMA).'</td>
                                    <td class="hidden-phone">'.($tema->INSTRUCCIONES_TEMA).'</td>
                                </tr>
                            ';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>    
        
</div>
</div>



<script>
$(document).ready(function() {
    $('#temas-salud-tabla tbody tr').dblclick(function (e) {
        $(this).addClass('row_selected');
        var tabla = $('#temas-salud-tabla').dataTable(); 
        $('#registro-seleccionado').html( filaSeleccionada( tabla, 'data-titulo' ) );
        mostrar_formulario_editar_temas();
    });
    
    $('#temas-salud-tabla tbody tr').live('click', function (e) {
        var tabla = $('#temas-salud-tabla').dataTable(); 
        $('#registro-seleccionado').html( filaSeleccionada( tabla, 'data-titulo' ) );
    });
});

function mostrar_formulario_editar_temas(){
    var tabla = $('#temas-salud-tabla').dataTable();   
    var idFila = filaId( tabla );
    //alert(idFila);
    if(idFila != null){
        mostrar_contenidos( 
        'sistema', 'temas', 'editar_form_tema','id_tema='+idFila        
        );
    }else{
            alert('Seleccione un registro');
        }
    	
}


function eliminar_tema(){
    var tabla = $('#temas-salud-tabla ').dataTable();        
    var idFila = filaId( tabla );
    if(idFila != null){
         ejecutarAccionJson(
            'sistema', 'temas', 'eliminar_tema', 'id_tema='+idFila, 
            ' mostrar_resultado_guardar( data, "abrir_tabla_temas();", "" );'
        )
    }else{
            alert('Seleccione un registro');
        }
   ;
}

</script>
