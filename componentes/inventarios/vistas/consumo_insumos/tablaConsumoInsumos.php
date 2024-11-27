
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-shopping_cart themed-color"></i> Consumo de Insumos<br>
        <small>Listado de Insumos Consumidos</small>
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
        <li class="active"><a href="#">Consumo de Insumos</a></li>
    </ul>
    <!-- END Breadcrumb -->
    
    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
            <!--<a href="javascript:abrir_formulario_consumo_insumos();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>-->
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
<!--            <a href="javascript:mostrar_formulario_consumo_insumos()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:eliminar_consumo_insumos()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>-->
        </div>
    </div>            
             
            <!-- With Stripes Section -->
            <div class="block-section">
            
                <table id="consumo-insumos-tabla" class="table table-bordered table-hover dataTables">
                    <thead>
                        <tr>
                            <th class="text-center">Periodo Consumo</th>
                            <th class="text-center">Subreceptor</th>
                            <th class="text-center">Insumo</th>
                            <th class="text-center">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!empty($ConsumoInsumos)){
                        foreach ($ConsumoInsumos as $consumoInsumos){ 
                            echo '
                                <tr fila-id="'.$consumoInsumos->ID_CONSUMO_INSUMO.'" data-titulo="'.($consumoInsumos->CODIGO_PERIODO).'-'.($consumoInsumos->SIGLAS_SUBRECEPTOR).'-'.($consumoInsumos->NOMBRE_INSUMO).'">
                                    <td>'.($consumoInsumos->CODIGO_PERIODO).'</td>
                                    <td>'.($consumoInsumos->SIGLAS_SUBRECEPTOR).'</td>
                                    <td>'.($consumoInsumos->NOMBRE_INSUMO).'</td>
                                    <td>'.($consumoInsumos->CANTIDAD_CONSUMO_INSUMO).'</td>
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
    $('#consumo-insumos-tabla tbody tr').dblclick(function (e) {
        $(this).addClass('row_selected');
        var tabla = $('#consumo-insumos-tabla').dataTable(); 
        
        $('#registro-seleccionado').html( filaSeleccionada( tabla, 'data-titulo' ) );
        mostrar_formulario_consumo_insumos();
    });
    
    $('#consumo-insumos-tabla tbody tr').live('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-titulo'));
        });
});

function mostrar_formulario_consumo_insumos(){
    var tabla = $('#consumo-insumos-tabla').dataTable();   
    var idFila = filaId( tabla );
    //alert(idFila);
    if(idFila != null){
       mostrar_contenidos( 
        'inventarios', 'consumoInsumos', 'editar_form_consumo_insumos','id_consumo_insumos='+idFila        
        );  
    }else{
            alert('Seleccione un registro');
    }
   	
}

function eliminar_consumo_insumos(){
    var tabla = $('#consumo-insumos-tabla').dataTable();        
    var idFila = filaId( tabla );
    if(idFila != null){
      ejecutarAccionJson(
        'inventarios', 'consumoInsumos', 'eliminar_insumo', 'id_consumo_insumos='+idFila, 
        ' mostrar_resultado_guardar( data, "abrir_tabla_insumos();", "" );'
    );  
    }else{
            alert('Seleccione un registro');
    }
    
}

</script>
<script>
    agregar_boton_ayuda('USOINSUMOS');
</script>