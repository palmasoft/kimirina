
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="fa-cubes themed-color"></i> Stock/Existencias de Insumos<br>
        <small>Listado de Insumos en el stock</small>
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
            <a href="#">Insumos</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Stock/Existencias</a></li>
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
<!--            <a href="javascript:mostrar_formulario_editar_actividad_tecnica()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:eliminar_actividades_tecnicas()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>-->
        </div>
    </div>
             
             
            <!-- With Stripes Section -->
            <div class="block-section">
            
                <table id="recibo-insumos-tabla" class="table table-bordered table-hover dataTables">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre Insumo</th>
                            <th class="text-center">Stock Actual</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!empty($Insumos)){
                        foreach ($Insumos as $insumos){ 
                            echo '
                                <tr fila-id="'.$insumos->ID_INSUMO.'" data-titulo="'.($insumos->NOMBRE_INSUMO).'">
                                    <td>'.($insumos->NOMBRE_INSUMO).'</td>
                                    <td>'.($insumos->STOCK_ACTUAL).'</td>
                                    <td>'.($insumos->FECHA_MODIFICACION).'</td>
                                    <td>'.($insumos->OBSERVACIONES).'</td>
                                </tr>
                            ';
                        }
                        }
                        ?>
                        
                    </tbody>
                </table>
            
            </div>
        </div>              

<script>
$(document).ready(function() {   
    $('#recibo-insumos-tabla tbody tr').on('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-titulo'));
        });
});

function mostrar_formulario_recibo_insumos(){
    var tabla = $('#recibo-insumos-tabla').dataTable();   
    var idFila = filaId( tabla );
    //alert(idFila);
    if(idFila != null){
       mostrar_contenidos( 
        'inventarios', 'reciboInsumos', 'editar_form_recibo_insumos','id_recibo_insumos='+idFila        
        );	 
    }else{
            alert('Seleccione un registro');
    }
    
}

function eliminar_recibo_insumos(){
    var tabla = $('#recibo-insumos-tabla').dataTable();        
    var idFila = filaId( tabla );
    if(idFila != null){
       ejecutarAccionJson(
        'inventarios', 'reciboInsumos', 'eliminar_insumo', 'id_recibo_insumos='+idFila, 
        ' mostrar_resultado_guardar( data, "abrir_tabla_insumos();", "" );'
        ); 
    }else{
            alert('Seleccione un registro');
    }
    
}

</script>
<script>
    agregar_boton_ayuda('STOCKINVENTARIO');
</script>