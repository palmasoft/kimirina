
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-table themed-color"></i> Tabla Formularios Registrados<br>
        <small>Todos los formularios registrados en el sistema</small>
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
            <a href="#">Formularios</a> <span class="divider"><i class="icon-angle-right"></i></span>
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
                        <select id="formulario-chosen" name="formulario-chosen" class="select-chosen span11">
                                        <option value >Seleccione un formulario</option>                          
                                        <option value="1" >Registro Semanal de Alcances HSH</option>  
                                        <option value="2" >Registro Semanal de Alcances TS</option> 
                                        <option value="3" >Recibo Contacto Animador</option> 
                                        <option value="4" >Registro Concejeria PVVS</option> 
                                    </select>
                            <a href="javascript:abrir_formulario_recibo_insumos();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>						
                    </div>
                    <span class="span3 text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span> </span>
                    <div class="btn-group">                            
                            <a href="javascript:mostrar_formulario_recibo_insumos();" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:eliminar_recibo_insumos();" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i></a>
                    </div>
            </td></tr></table>
             
             
            <!-- With Stripes Section -->
            <div class="block-section">
            
                <table id="recibo-insumos-tabla" class="table table-striped dataTables">
                    <thead>
                        <tr>
                            <th class="text-center">Fecha Recibo</th>
                            <th class="text-center">Insumo</th>
                            <th class="text-center">Cantidad Recibida</th>
                            <th class="text-center">Lote de Referencia</th>
                            <th class="text-center">Persona</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($ReciboInsumos!=null){
                        foreach ($ReciboInsumos as $reciboInsumos){ 
                            echo '
                                <tr fila-id="'.$reciboInsumos->ID_RECIBOINSUMO.'" data-titulo="'.($reciboInsumos->NOMBRE_INSUMO).'">
                                    <td>'.($reciboInsumos->FECHA_RECIBOINSUMO).'</td>
                                    <td>'.($reciboInsumos->NOMBRE_INSUMO).'</td>
                                    <td>'.($reciboInsumos->CANTIDAD_RECIBOINSUMO).'</td>
                                    <td>'.($reciboInsumos->LOTE_REFERENCIA_RECIBOINSUMO).'</td>
                                    <td>'.($reciboInsumos->NOMBRE_REAL_PERSONA).'</td>
                                </tr>
                            ';
                        }
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
    $('#recibo-insumos-tabla tbody tr').dblclick(function (e) {
        $(this).addClass('row_selected');
        
        var tabla = $('#recibo-insumos-tabla').dataTable(); 
        $('#registro-seleccionado').html( filaSeleccionada( tabla, 'data-titulo' ) );
        mostrar_formulario_recibo_insumos();
    });
    
    $('#recibo-insumos-tabla tbody tr').live('click', function (e) {
        var tabla = $('#recibo-insumos-tabla').dataTable(); 
        $('#registro-seleccionado').html( filaSeleccionada( tabla, 'data-titulo' ) );
    });
});

function mostrar_formulario_recibo_insumos(){
    var tabla = $('#recibo-insumos-tabla').dataTable();   
    var idFila = filaId( tabla );
    //alert(idFila);
    mostrar_contenidos( 
    'inventarios', 'reciboinsumos', 'editar_form_recibo_insumos','id_recibo_insumos='+idFila        
    );	
}

function eliminar_recibo_insumos(){
    var tabla = $('#recibo-insumos-tabla').dataTable();        
    var idFila = filaId( tabla );
    
    ejecutarAccionJson(
        'inventarios', 'reciboinsumos', 'eliminar_insumo', 'id_recibo_insumos='+idFila, 
        ' mostrar_resultado_guardar( data, "abrir_tabla_insumos();", "" );'
    );
}

</script>