<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="icon-compass themed-color"></i> Lugares de Consejería<br>
        <small>Listado de Lugares Consejería registrados en el sistema.</small>
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
        <li class="active"><a href="#">consejería</a></li>
    </ul>
    <!-- END Breadcrumb -->

    

    <table class="botones_arriba" align="center" ><tr><td>
		<div class=" span1 btn-group">
			<a href="javascript:abrir_form_nuevo_lugar_consejeria();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>						
		</div>
		<span class="span3 text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span> </span>
		<div class="btn-group">
			<a href="javascript:mostrar_formulario_editar_consejeria();" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-success"><i class="icon-pencil"></i></a>
			<a href="javascript:eliminar_esquema_consejeria()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i></a>
		</div>
	</td></tr></table>

    <!-- Dynamic Tables Section -->
    <div class="block-section">
       
        
        <table id="tblConsejeria" class="table table-striped dataTables" >
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                
                    

                <?php foreach ($lugaresConsejeria as $consejeria) : ?>                
                <tr fila-id="<?php echo ($consejeria->ID_LUGAR_CONSEJERIA) ?>" data-nombre="<?php echo ($consejeria->NOMBRE_LUGAR_CONSEJERIA) ?>">
                    <td><?php echo ($consejeria->CODIGO_LUGAR_CONSEJERIA) ?></td>
                    <td><?php echo ($consejeria->NOMBRE_LUGAR_CONSEJERIA) ?></td>
                    <td><?php echo ($consejeria->OBSERVACIONES_LUGAR_CONSEJERIA) ?></td>
                    
                 </tr>
                 <?php endforeach; ?>
            </tbody>
        </table>
        
        
        
    </div>
    <!-- END Dynamic Tables Section -->

 
    
</div>



<script>
$(document).ready(function() {
    $('#tblConsejeria tbody tr').dblclick(function (e) {
        $(this).addClass('row_selected');
            $('#registro-seleccionado').html($(this).attr('data-nombre') );
            mostrar_formulario_editar_consejeria();
    });
    
    $('#tblConsejeria tbody tr').live('click', function (e) {		
            $('#registro-seleccionado').html($(this).attr('data-nombre') );
    });
});	

function mostrar_formulario_editar_consejeria(){
    var tabla = $('#tblConsejeria').dataTable();   
    var idFila = filaId( tabla );
    //alert(idFila);
    if(idFila != null){
        mostrar_contenidos( 
        'sistema', 'lugaresConsejerias', 'editar_form_lugares_consejeria','id_consejeria='+idFila        
        );
    }else{
            alert('Seleccione un registro');
        }
      
}
function eliminar_esquema_consejeria(){
    var tabla = $('#tblConsejeria').dataTable();   
    var idFila = filaId( tabla );
    //alert(idFila);
    if(idFila != null){
        ejecutarAccionJson(
            'sistema', 'lugaresConsejerias', 'eliminar_lugar_consejeria', 'id_consejeria='+idFila, 
            ' mostrar_resultado_guardar( data, "abrir_listado_lugares_consejeria();", "" );'
        );
    }else{
            alert('Seleccione un registro');
        }  
   
}

</script>
