
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-notes_2 themed-color"></i> Formularios de Contacto Aprobados<br><small>registra los formularios de contactos del promotor/animador!</small></h1>
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
            <a href="#">Gestion</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Registros Semanales</a></li>
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
            <a href="javascript:abrir_ver_datos_registro_seleccionado();" data-toggle="tooltip" title="ver Documento en Linea " class="btn btn-lg btn-info"><i class="icon-eye-open"></i>Ver</a>
<!--            <a href="javascript:mostrar_formulario_editar_actividad_tecnica()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:eliminar_actividades_tecnicas()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>-->
        </div>
    </div>

<!--    <table class="botones_arriba" align="center" ><tr><td>
		<div class=" span1 btn-group">
						
		</div>
                <span class="span3 text-center">
                    <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
                </span>
		<div class="btn-group">			
                    <a href="javascript:abrir_ver_datos_registro_seleccionado();" data-toggle="tooltip" title="ver Documento en Linea " class="btn btn-lg btn-info"><i class="icon-eye-open"></i></a>						
		</div>
    </td></tr></table>-->

    <!-- Dynamic Tables Section -->
    <div class="block-section">
     <?php $this->mostrar( 'registro_semanal_contactos/tablaListadoRegistros', $this->datos, 'monitores' ); ?>
    </div>
    <!-- END Dynamic Tables Section -->

    <!-- Dynamic Tables Section -->

    <!-- END Dynamic Tables Section -->
    
</div>
<!-- END Page Content -->

<script>
$(document).ready(function() {
	$('#tbl-form-registros-semanales tbody tr').on('click', function (e) {		
		$('#registro-seleccionado').html( $(this).attr('data-code') );
	});

});	


function abrir_ver_datos_registro_seleccionado(){
    var tabla = $('#tbl-form-registros-semanales').dataTable();   
    var idFila = filaId( tabla );
    if(idFila != null){
        ver_datos_registro_semanal( idFila );
    }else{
            alert('Seleccione un registro');
    }
    
}

function abrir_editar_registro_aprobado(){
    var tabla = $('#tbl-form-registros-semanales').dataTable();   
    var idFila = filaId( tabla );
    
    alert( "entrando al nuevo editar" + idFila );
}

</script>


