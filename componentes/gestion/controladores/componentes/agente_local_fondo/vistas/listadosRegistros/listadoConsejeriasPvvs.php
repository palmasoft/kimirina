
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i>Listado de consejeria PVVS<br>
        <small>REGISTRO DE CONSEJERIA DE PARES CON PERSONAS QUE VIVEN CON VIH.</small>
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
        <li class="active"><a href="#">Consejerias Pvvs</a></li>
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
            <a href="javascript:abrir_ver_datos_consejeria();" data-toggle="tooltip" title="ver Contactos " class="btn btn-lg btn-info"><i class="icon-eye-open"></i>Ver</a>
<!--            <a href="javascript:mostrar_formulario_editar_actividad_tecnica()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:eliminar_actividades_tecnicas()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>-->
        </div>
    </div>

<!--    <table class="botones_arriba" align="center" ><tr><td>
		<div class=" span1 btn-group">						
		</div>
		<span class="span3 text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span> </span>
		<div class="btn-group">
			<a href="javascript:abrir_ver_datos_consejeria();" data-toggle="tooltip" title="ver Contactos " class="btn btn-lg btn-info"><i class="icon-eye-open"></i></a>								
		</div>
	</td></tr></table>-->


    <div class="block-section">
    <?php $this->mostrar('consejeria_pvvs/tablaListadoConsejeriasPvvs', $this->datos, 'monitores'); ?>
    </div>

    <!-- Dynamic Tables in the Grid -->
    <h4 class="page-header">Ultimos 100 <small>EN CONSTRUCION......</small></h4>

    
</div>



<script>

$(document).ready(function() {
    $('#formularios-pvvs-datatables tbody tr').live('click', function (e) {
        var tabla = $('#formularios-pvvs-datatables').dataTable(); 
        $('#registro-seleccionado').html( 
            filaSeleccionada( tabla, 'data-num-consejeria' )
        );
    });
});

function editar_formulario_consejeria_pvvs(){
    var tabla = $('#formularios-pvvs-datatables').dataTable();   
    var idFila = filaId( tabla );
    //alert(idFila);
    if(idFila != null){
    mostrar_contenidos( 
    'monitores', 'ConsejeriaPVVS', 'editar_form_consejeria_pvvs','idConsejeria='+idFila        
    );  
    }else{
            alert('Seleccione un registro');
        }
}
    function eliminar_formulario_consejeria_pvvs(){                   
        var tabla = $('#formularios-pvvs-datatables').dataTable();   
        var idFila = filaId( tabla );
        //alert(idFila);
        if(idFila != null){
        ejecutarAccionJson(
        'monitores', 'ConsejeriaPVVS', 'eliminar_consejeria_pvvs', 'idConsejeria='+idFila, 
        ' mostrar_resultado_guardar( data, "abrir_listado_consejerias_pvvs();", "" );'
    );
        }else{
            alert('Seleccione un registro');
        }
    }


function abrir_ver_datos_consejeria(){
    var tabla = $('#formularios-pvvs-datatables').dataTable();   
    var idFila = filaId( tabla );
    if(idFila != null){
    mostrar_datos_consejeria_pvvs( idFila )
    }else{
            alert('Seleccione un registro');
        }
}



</script>


  