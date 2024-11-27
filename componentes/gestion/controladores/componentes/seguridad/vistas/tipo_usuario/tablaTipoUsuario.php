
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-user themed-color"></i> Tabla Tipos de Usuario<br>
        <small>Todos los tipo de usuario del sistema</small>
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
            <a href="#">Gestion de Usuarios</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Listado</a></li>
    </ul>
    <!-- END Breadcrumb -->
    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
            <!--<a href="javascript:abrir_formulario_actividades_tecnicas();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>-->
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
            <a href="javascript:mostrar_formulario_tipo_usuario()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <!--<a href="javascript:eliminar_actividades_tecnicas()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>-->
        </div>
    </div>
<!--	<div class="block block-themed" >  
        <div class="block-title" >
            <h4></h4>
        </div>-->
        
        <!--<div class="block-content">--> 
<!--             
             <table class="botones_arriba" align="center" ><tr><td>
                    <div class=" span1 btn-group">
                            <a href="javascript:abrir_formulario_tipo_usuario();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>						
                    </div>
                    <span class="span3 text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span> </span>
                    <div class="btn-group">                            
                            <a href="javascript:mostrar_formulario_tipo_usuario();" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-success"><i class="icon-pencil"></i></a>                            
                    </div>
            </td></tr></table>-->
             
             
            <!-- With Stripes Section -->
            <div class="block-section">
            
                <table id="tabla-tipo-usuario" class="table table-bordered table-hover dataTables">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Codigo ROL</th>
                            <th class="text-center">Nombre ROL</th>
                            <th class="text-center">OBSERVACIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($TipoUsuario as $tipoUsuario){ 
                            echo '
                                <tr fila-id="'.$tipoUsuario->ID_ROL.'" data-titulo="'.($tipoUsuario->NOMBRE_ROL).'">
                                    <td>'.  intval($tipoUsuario->ID_ROL).'</td>
                                    <td>'.($tipoUsuario->CODIGO_ROL).'</td>
                                    <td>'.($tipoUsuario->NOMBRE_ROL).'</td>
                                    <td>'.($tipoUsuario->OBSERVACIONES_ROL).'</td>
                                </tr>
                            ';
                        }
                        ?>
                        
                    </tbody>
                </table>
            
            <!--</div>-->
        </div>                   
	</div>     

<script>
$(document).ready(function() {
    
    $('#tabla-tipo-usuario tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
             mostrar_formulario_tipo_usuario();
        });
        
    $('#tabla-tipo-usuario tbody tr').live('click', function (e) {
        var tabla = $('#tabla-tipo-usuario').dataTable(); 
        $('#registro-seleccionado').html( filaSeleccionada( tabla, 'data-titulo' ) );
    });
});

function mostrar_formulario_tipo_usuario(){
    var tabla = $('#tabla-tipo-usuario').dataTable();   
    var idFila = filaId( tabla );
    //alert(idFila);
    if(idFila != null){
       mostrar_contenidos( 
        'seguridad', 'tipousuario', 'editar_form_tipo_usuario','id_tipo_usuario='+idFila        
        ); 
    }else{
            alert('Seleccione un registro');
    }
    	
}

function eliminar_tipo_usuario(){
    var tabla = $('#tabla-tipo-usuario').dataTable();        
    var idFila = filaId( tabla );
    if(idFila != null){
      ejecutarAccionJson(
        'seguridad', 'tipousuario', 'eliminar_tipo_usuario', 'id_tipo_usuario='+idFila, 
        ' mostrar_resultado_guardar( data, "abrir_tabla_tipo_usuario();", "" );'
        );  
    }else{
            alert('Seleccione un registro');
        }
    
}

</script>