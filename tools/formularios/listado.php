
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-magnet themed-color"></i> Formularios de Contacto<br><small>registra los formularios de contactos del promotor/animador!</small></h1>
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
            <a href="#">Tables</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">Dynamic</a></li>
    </ul>
    <!-- END Breadcrumb -->



    <table class="botones_arriba" align="center" ><tr><td>
		<div class=" span1 btn-group">
			<a href="javascript:agregar_nuevo_formulario_contacto();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>						
		</div>
		<span class="span3 text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span> </span>
		<div class="btn-group">
			<a href="javascript:void(0)" data-toggle="tooltip" title="Descargar el Archivo asociado" class="btn btn-lg btn-info"><i class="glyphicon-cloud-download"></i></a>			
			<a href="javascript:void(0)" data-toggle="tooltip" title="ver Documento en Linea " class="btn btn-lg btn-info"><i class="glyphicon-search"></i></a>			
			<a href="javascript:void(0)" data-toggle="tooltip" title="ver Contactos " class="btn btn-lg btn-info"><i class="glyphicon-parents"></i></a>			
			<a href="javascript:void(0)" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-success"><i class="icon-pencil"></i></a>
			<a href="javascript:void(0)" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i></a>
		</div>
	</td></tr></table>

    <!-- Dynamic Tables Section -->
    <div class="block-section">
        <table id="formularios-datatables" class="table table-bordered table-hover dataTables">
            <thead>
                <tr>
                    <th class="span1 text-center">FECHA</th>
                    <th class="span1 text-center">CODIGO</th>
                    <th class="hidden-phone hidden-tablet"><i class="icon-user"></i> PROMOTOR / ANIMADOR</th>
                    <th class="hidden-phone hidden-tablet">UBICACION</th>
                    <th class="span1 hidden-phone">Revision</th>
                </tr>
            </thead>
            <tbody>
                <?php                
                $labels["APROBADO"] = "label-success";
                $labels["EN REVISION"] = "label-warning";
                $labels["CON ERRORES"] = "label-important";
                $labels["PENDIENTE"] = "label-info";
                $labels["REVISADO"] = "label-inverse";
                ?>
                <?php foreach ($formularios as $formulario) { ?>
                <tr fila-id="<?php echo ($formulario->ID_FORMULARIO) ?>"  data-code="<?php echo ($formulario->CODIGO_FORMULARIO) ?>">
                    <td class="text-center "><?php echo ($formulario->FECHA_REGISTRO) ?></td>
                    <td class="text-center "><?php echo ($formulario->CODIGO_FORMULARIO) ?></td>
                    <td class="hidden-phone hidden-tablet"><a href="javascript:void(0)"><?php echo ($formulario->NOMBRE_LLENA."(".$formulario->ALIAS_LLENA.")") ?></a></td>
                    <td class="hidden-phone hidden-tablet">
                    	<?php echo ($formulario->NOMBRE_PARROQUIA ); ?>
                    	<a href="javascript:void(0)" data-toggle="tooltip" title="Ver en el Mapa" class="btn btn-mini btn-warning"><i class="icon-map-marker"></i></a>
                    </td>                    
                    <td class="span2 hidden-phone">
                    	<span class="label<?php echo ($labels[$formulario->ESTADO_REVISION]) ? " " . $labels[$formulario->ESTADO_REVISION] : ""; ?>"><?php echo $formulario->ESTADO_REVISION ?></span>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- END Dynamic Tables Section -->

    <!-- Dynamic Tables in the Grid -->
    <h4 class="page-header">Ultimos 100 <small>EN CONSTRUCION......</small></h4>


</div>
<!-- END Page Content -->

<script>
$(document).ready(function() {
	$('#formularios-datatables tbody tr').on('click', function (e) {		
		$('#registro-seleccionado').html( $(this).attr('data-code') );
	});

});	
  
	
</script>
