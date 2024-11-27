<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="icon-gear themed-color"></i> Parametros<br>
        <small>Listado de Parametros en el sistema.</small>
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
        <li class="active"><a href="#">Lista Parametros</a></li>
    </ul>
    <!-- END Breadcrumb -->
<!--    <table class="botones_arriba" align="center" ><tr><td>
		<div class=" span1 btn-group">
                        	<a href="javascript:agregar_nuevo_esquema_arv();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a> 						
		</div>
		<span class="span3 text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span> </span>
		<div class="btn-group">
		<a href="javascript:mostrar_formulario_editar_gestor_subreceptores();" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-success"><i class="icon-pencil"></i></a>
                	<a href="javascript:void(0)" data-toggle="tooltip" title="Descargar el Archivo asociado" class="btn btn-lg btn-info"><i class="glyphicon-cloud-download"></i></a>			
			<a href="javascript:void(0)" data-toggle="tooltip" title="ver Documento en Linea " class="btn btn-lg btn-info"><i class="glyphicon-search"></i></a>			
			<a href="javascript:void(0)" data-toggle="tooltip" title="ver Contactos " class="btn btn-lg btn-info"><i class="glyphicon-parents"></i></a> 
			<a href="javascript:eliminar_esquema_arv();" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i></a>			
		</div>
	</td></tr></table>-->
    
    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
        </div>
    </div>


    <!-- Dynamic Tables Section -->
    <div class="block-section">


        <table id="tblParametros" class="table table-bordered table-hover dataTables" >
            <thead>
                <tr>
                    <th></th>
                    <th>Parametro</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($parametros as $parametro) : ?>  
                <tr fila-id="<?php echo ($parametro->ID_PARAMETRO) ?>"  data-nombre="<?php echo ($parametro->NOMBRE_PARAMETRO) ?>" title="<?php echo ($parametro->DESCRIPCION) ?>" >                
                        <td><?php echo ($parametro->MODULO) ?></td>
                        <td><?php echo ($parametro->NOMBRE_PARAMETRO) ?></td> 
                        <td><h5><?php echo ($parametro->VALOR) ?></h5></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>



    </div>
    <!-- END Dynamic Tables Section -->



</div>



<script>
    $(document).ready(function() {
        $('#tblParametros tbody tr').on('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
        });
    });
    function mostrar_formulario_editar_gestor_subreceptores() {
        var tabla = $('#tblSubreceptores').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            mostrar_contenidos(
                    'sistema', 'subreceptores', 'editar_form_gestor_subreceptores', 'id_gestor_subreceptor=' + idFila
                    );
        } else {
            alert('Seleccione un registro');
        }

    }
    
</script>


