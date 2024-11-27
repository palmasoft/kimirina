
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-cart_in themed-color"></i> Recibo de Insumos<br>
        <small>Lista de registros de de Insumos recibidos</small>
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
        <li class="active"><a href="#">Recibo de Insumos</a></li>
    </ul>
    <!-- END Breadcrumb -->
    
    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
            <a href="javascript:abrir_formulario_recibo_insumos();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
            <a href="javascript:mostrar_formulario_recibo_insumos()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:confirmar_eliminar_recibo_insumos()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>
        </div>
    </div>            
             
            <!-- With Stripes Section -->
            <div class="block-section">
            
                <table id="recibo-insumos-tabla" class="table table-bordered table-hover dataTables">
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
                        if(!empty($ReciboInsumos)){
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

<script>
$(document).ready(function() {
    $('#recibo-insumos-tabla tbody tr').dblclick(function (e) {
        $(this).addClass('row_selected');
        var tabla = $('#recibo-insumos-tabla').dataTable(); 
        
        $('#registro-seleccionado').html( filaSeleccionada( tabla, 'data-titulo' ) );
        mostrar_formulario_recibo_insumos();
    });
    
    $('#recibo-insumos-tabla tbody tr').live('click', function(e) {
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

function confirmar_eliminar_recibo_insumos(){
    var tabla = $('#recibo-insumos-tabla').dataTable();        
    var idFila = filaId( tabla );
    if(idFila != null){
      confirm(
            '¿Seguro que deseas eliminar este registro de insumo recibido? \n\
                Recuerda que esto afectará el valor de la disponibilidad actual.',
            'eliminar_recibo_insumos();'
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
        'inventarios', 'reciboInsumos', 'eliminar_recibo_insumo', 'id_recibo_insumos='+idFila, 
        'mostrar_resultado_guardar( data, "abrir_tabla_recibo_insumos();", "" );'
    );  
    }else{
            alert('Seleccione un registro');
    }
    
}
</script>
<script>
    agregar_boton_ayuda('LISTAINSUMOSRECIBIDOS');
</script>