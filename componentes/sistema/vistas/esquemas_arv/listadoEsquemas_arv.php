
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-user themed-color"></i> Esquemas ARV<br>
        <small>Listado de Esquemas ARV registrados en el sistema.</small>
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
        <li class="active"><a href="#">Esquemas ARV</a></li>
    </ul>
    <!-- END Breadcrumb -->

    

    <table class="botones_arriba" align="center" ><tr><td>
		<div class=" span1 btn-group">
			<a href="javascript:agregar_nuevo_esquema_arv();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>						
		</div>
		<span class="span3 text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span> </span>
		<div class="btn-group">
		<!--	<a href="javascript:void(0)" data-toggle="tooltip" title="Descargar el Archivo asociado" class="btn btn-lg btn-info"><i class="glyphicon-cloud-download"></i></a>			
			<a href="javascript:void(0)" data-toggle="tooltip" title="ver Documento en Linea " class="btn btn-lg btn-info"><i class="glyphicon-search"></i></a>			
			<a href="javascript:void(0)" data-toggle="tooltip" title="ver Contactos " class="btn btn-lg btn-info"><i class="glyphicon-parents"></i></a> -->			
			<a href="javascript:mostrar_formulario_editar_esquema_arv();" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-success"><i class="icon-pencil"></i></a>
			<a href="javascript:eliminar_esquema_arv();" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i></a>
		</div>
	</td></tr></table>

    <!-- Dynamic Tables Section -->
    <div class="block-section">
       
        
        <table id="tblEsquemasArv" class="table table-striped dataTables" >
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                 <?php foreach ($esquemaArv as $esquema) : ?>  
                <tr fila-id="<?php echo ($esquema->ID_ESQUEMA_ARV) ?>"  data-nombre="<?php echo ($esquema->NOMBRE_ESQUEMA_ARV) ?>">                
                    <td><?php echo ($esquema->CODIGO_ESQUEMA_ARV) ?></td>
                    <td><?php echo ($esquema->NOMBRE_ESQUEMA_ARV) ?></td>
                    <td><?php echo ($esquema->OBSERVACIONES_ESQUEMA_ARV) ?></td>                
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        
        
    </div>
    <!-- END Dynamic Tables Section -->

 
    
</div>



<script>
$(document).ready(function() {
    $('#tblEsquemasArv tbody tr').dblclick(function (e) {	
        $(this).addClass('row_selected');	
            $('#registro-seleccionado').html( $(this).attr('data-nombre') );
             mostrar_formulario_editar_esquema_arv();
    });
    
    $('#tblEsquemasArv tbody tr').live('click', function (e) {		
            $('#registro-seleccionado').html( $(this).attr('data-nombre') );
    });
});	

function mostrar_formulario_editar_esquema_arv(){
    var tabla = $('#tblEsquemasArv').dataTable();   
    var idFila = filaId( tabla );
    //alert(idFila);
    if(idFila != null){
        mostrar_contenidos( 
        'sistema', 'esquemaArv', 'editar_form_esquema_arv','id_esquemasArv='+idFila        
        );
    }else{
            alert('Seleccione un registro');
        }
      
}
function eliminar_esquema_arv(){
    var tabla = $('#tblEsquemasArv').dataTable();   
    var idFila = filaId( tabla );
    //alert(idFila);
    if(idFila != null){
        ejecutarAccionJson(
            'sistema', 'esquemaArv', 'eliminar_esquema_arv', 'id_esquemasArv='+idFila, 
            ' mostrar_resultado_guardar( data, "abrir_listado_esquemas_arv();", "" );'
        );
    }else{
            alert('Seleccione un registro');
        }
   
}
</script>


  