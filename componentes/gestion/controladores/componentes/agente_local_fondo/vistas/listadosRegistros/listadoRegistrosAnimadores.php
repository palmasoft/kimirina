<?php ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Recibo de Contacto Animador Aprobados<br>
        <small>Todos los formularios/recibos de Contacto Animador</small>
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
        <li class="active"><a href="#">Recibo de Contacto Animador</a></li>
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
            <a href="javascript:mostrar_formulario_completo_recibo_contacto();" data-toggle="tooltip" title="Mostrar Formulario" class="btn btn-lg btn-info"><i class="icon-eye-open"></i>Ver</a>
<!--            <a href="javascript:mostrar_formulario_editar_actividad_tecnica()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:eliminar_actividades_tecnicas()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>-->
        </div>
    </div>
<!--    <table class="botones_arriba" align="center" ><tr><td>
                <div class=" span1 btn-group">						
                </div>
                <span class="span3 text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span> </span>
                <div class="btn-group">
                    <a href="javascript:mostrar_formulario_completo_recibo_contacto();" data-toggle="tooltip" title="Mostrar Formulario" class="btn btn-lg btn-info"><i class="icon-eye-open"></i></a>
                </div>
            </td></tr></table>-->


    <div class="block-section">
     <?php $this->mostrar('recibo_contacto_animador/tablaListadoContactoAnimador', $this->datos, 'monitores'); ?>
    </div>   

</div>



<script>
    $(document).ready(function() {       
        $('#recibo-contacto-animador-datatables tbody tr').live('click', function (e) {           
            var tabla = $('#recibo-contacto-animador-datatables').dataTable();
            $('#registro-seleccionado').html( filaSeleccionada( tabla, 'data-titulo' ) );
        });
    });

    function mostrar_formulario_completo_recibo_contacto(){
        var tabla = $('#recibo-contacto-animador-datatables').dataTable();   
        var idFila = filaId( tabla );
        //alert(idFila);
        if(idFila != null){
            mostrar_contenidos( 
            'monitores', 'reciboContactoAnimador', 'mostrar_datos_contacto_animador','idContactoAnimador='+idFila        
        );
        }else{
            alert('Seleccione un registro');
        }
    }

    function editar_formulario_recibo_contacto_aprobado(){
        var tabla = $('#recibo-contacto-animador-datatables').dataTable();   
        var idFila = filaId( tabla );
        //alert(idFila);
         if(idFila != null){
         alert('Editando '+idFila);
        
        }else{
            alert('Seleccione un registro');
        }
    }

    function eliminar_formulario_recibo_contacto(){                   
        var tabla = $('#recibo-contacto-animador-datatables').dataTable();   
        var idFila = filaId( tabla );
        //alert(idFila);
        if(idFila != null){
        ejecutarAccionJson(
        'monitores', 'recibocontactoanimador', 'eliminar_recibo_contacto_animador', 'idContactoAnimador='+idFila, 
        ' mostrar_resultado_guardar( data, "abrir_tabla_recibo_contacto_animador();", "" );'
    );
        }else{
            alert('Seleccione un registro');
        }
    }

</script>
