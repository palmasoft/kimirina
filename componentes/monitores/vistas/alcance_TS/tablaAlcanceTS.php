<?php ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-table themed-color"></i> Alcance a Pares TS<br>
        <small>Todos los formularios de Alcance a Pares TS</small>
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
        <li class="active"><a href="">Alcance a Pares TS</a></li>
    </ul>
    <!-- END Breadcrumb -->
    <table class="botones_arriba" align="center" ><tr><td>
                <div class=" span1 btn-group">
                    <a href="javascript:abrir_formulario_alcance_TS();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>						
                </div>
                <span class="span3 text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span> </span>
                <div class="btn-group">                            
                    <a href="javascript:mostrar_formulario_editar_alcance_TS(();" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-success"><i class="icon-pencil"></i></a>
                    <a href="javascript:eliminar_formulario_alcance_TS();" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i></a>
                </div>
            </td></tr></table>


    <div class="block-section">
        <table id="alcance-TS-datatables" class="table table-bordered table-hover dataTables">
            <thead>
            <th>Codigo</th>
            <th>Nombre</th>
            <th class="hidden-xs hidden-sm">Observaciones</th>
            </tr>
            </thead>
            <tbody>            
                <?php 
                if(isset($AlcanceTS)){
                foreach ($AlcanceTS as $alcanceTS) { ?>
                    <tr fila-id="<?php echo $alcanceTS->ID_TIPOLUGAR ?>" data-titulo="<?php  echo ($alcanceTS->NOMBRE_TIPOLUGAR) ?>">
                        <td><?php echo ($alcanceTS->CODIGO_TIPOLUGAR) ?></td>
                        <td class="text-center"><?php echo ($alcanceTS->NOMBRE_TIPOLUGAR) ?></td>
                        <td class="hidden-xs hidden-sm"><?php echo ($alcanceTS->OBSERVACIONES_TIPOLUGAR) ?></td>
                    </tr>
                <?php }}else{
                    
                }
                ?>
            </tbody>
        </table>   
    </div>   

</div>



<script>
$(document).ready(function() {       
      $('#"alcance-TS-datatables tbody tr').live('double click', function (e) {           
        var tabla = $('#"alcance-TS-datatables').dataTable();                    
        $('#registro-seleccionado').html( filaSeleccionada( tabla, 'data-titulo' ) );
        mostrar_formulario_editar_alcance_TS();
    });
});



function mostrar_formulario_editar_alcance_TS(){
    var tabla = $('#"alcance-TS-datatabless').dataTable();   
    var idFila = filaId( tabla );
    //alert(idFila);
    mostrar_contenidos( 
    'monitores', 'alcanceTS', 'editar_form_alcance_TS','id_alcanceTS='+idFila        
    );	
}


//function eliminar_formulario_alcance_TS(){                   
//    var tabla = $('#tipos_de_lugares-datatables').dataTable();   
//    var idFila = filaId( tabla );
//    //alert(idFila);
//   ejecutarAccionJson(
//        'sistema', 'tipolugares', 'eliminar_tipo_lugar', 'id_tipolugar='+idFila, 
//        ' mostrar_resultado_guardar( data, "abrir_tipo_lugares();", "" );'
//    );
//}

</script>
