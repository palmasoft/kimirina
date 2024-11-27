
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="icon-medkit themed-color"></i> tabla insumos<br>
        <small>sub titulo de insumos</small>
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
                            <a href="javascript:abrir_formulario_insumos();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>						
                    </div>
                    <span class="span3 text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span> </span>
                    <div class="btn-group">                            
                            <a href="javascript:mostrar_formulario_editar_insumo();" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:eliminar_insumo();" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i></a>
                    </div>
            </td></tr></table>
             
             
            <!-- With Stripes Section -->
            <div class="block-section">
   <table id="tblServiciosSalud" class="table table-striped dataTables">
                    <thead>
                        <tr>
                            <th class="text-center">Codigo de servicio</th>
                            <th class="text-center">Nombre de servicio</th>
                            <th class="text-center">Observaciones de servicio</th>
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
        </div>                   
	</div>     
</div>
