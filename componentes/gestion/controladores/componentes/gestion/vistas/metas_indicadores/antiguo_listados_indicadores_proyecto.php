
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-stats themed-color"></i> Metas e Indicadores<br>
        <small>Listado de Indicadores de Desempeño del Proyecto, y sus metas generales y por subreceptor.</small>
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
            <a href="#">Gestion</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Metas e Indicadores</a></li>
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
                    <td colspan="2"></td>                    
                    <?php       
                        foreach ($PeriodosIndicadores as $periodo) {
                            echo '<th class=" ">'. $periodo->CODIGO_PERIODO_INDICADOR .' </th>';
                            
                         }
                    ?>                    
                </tr>
                <tr>
                    <th class=" text-center">Indicador</th>
                    <th class="span1"><i class="glyphicons-road"></i> Meta </th>                    
                    <?php       
                        foreach ($PeriodosIndicadores as $periodo) {
                            echo '<th class=" ">'. $periodo->TITULO_PERIODO_INDICADOR .' </th>';
                            
                         }
                    ?>
                    
                </tr>
            </thead>
            <tbody>
                <?php                
                $labels[1] = "label-success";
                $labels[2] = "label-warning";
                $labels[3] = "label-important";
                $labels[4] = "label-info";
                $labels[5] = "label-inverse";
                
                foreach ($marcoDesempeno as $indicador) { 
                    
                ?>
                <tr>
                    <td class="text-center "><?php echo ($indicador->NOMBRE_INDICADOR) ?></td>
                    <td class=""><strong><?php echo ( $indicador->META_INDICADOR) ;  ?></strong></td>
                    <?php       
                        foreach ($indicador->VALORES_SEMESTRALES as $periodo) {
                            $porc = (isset($periodo->META_SEMESTRE) ? number_format($periodo->VALOR_SEMESTRE/$periodo->META_SEMESTRE, 2) : 0 );
                            
                            if( $porc > 100 ){
                                $semaforo = "indicador_superverde";                                
                            }
                            if( $porc <= 100 ){
                                $semaforo = "indicador_verde";                                
                            }
                            if( $porc < 89 ){
                                $semaforo = "indicador_amarillo";                                
                            }
                            if( $porc < 59 ){
                                $semaforo = "indicador_naranja";                                
                            }
                            if( $porc < 3 ){
                                $semaforo = "indicador_rojo";                                
                            }
                            
                            
                            echo '<td style="padding:0px;" >'
                                    . '<table style="width:100%" >'
                                    . '<tr style="width:100%" class="'.$semaforo.'"  ><td style="width:50%" >'.(isset($periodo->VALOR_SEMESTRE) ? $periodo->VALOR_SEMESTRE : 0).'</td>'
                                    . '<td rowspan="2">'.$porc.'%</td></tr>'
                                    . '<tr style="width:100%"  ><td style="width:50%"  >'.(isset($periodo->META_SEMESTRE) ? $periodo->META_SEMESTRE : 0).'</td></tr>'
                                    . '</table>'
                                . '</td>';
                         }
                    ?>
                    
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- END Dynamic Tables Section -->

    <!-- Dynamic Tables in the Grid -->
    <h4 class="page-header">Ultimos 100 <small>EN CONSTRUCION......</small></h4>

    
</div>



<script>
$(document).ready(function() {
   	$('#formularios-datatables tbody tr').on('click', function (e) {		
		$('#registro-seleccionado').html( $(this).attr('data-code') );
	});
});	
</script>


  