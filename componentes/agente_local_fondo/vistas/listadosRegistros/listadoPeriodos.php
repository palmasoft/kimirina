
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon glyphicon-calendar themed-color"></i> Gestion de Periodos<br>
        <small>Desde esta funcionalidad usted podrá habilitar en el sistema el periodo deseado</small>
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
        <li class="active"><a href="#">Gestion de Periodos</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
            <a href="javascript:alert('en construccion...');" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">          
            <a href="javascript:habilitar_periodo();" data-toggle="tooltip" title="Habilitar periodo" class="btn btn-success"><i class="icon-save"></i>Habilitar</a>
<!--            <a href="javascript:mostrar_formulario_editar_actividad_tecnica()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:eliminar_actividades_tecnicas()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>-->
        </div>
    </div>

    <!-- Dynamic Tables Section -->
    <div class="block-section">
        <?php $this->mostrar("formulariosGestion/tablaPeriodos", $this->datos); ?>
    </div>
    <!-- END Dynamic Tables Section -->

    <!-- Dynamic Tables in the Grid -->
    <!--<h4 class="page-header">Ultimos 100 <small>EN CONSTRUCION......</small></h4>-->

    
</div>



<script>
    $(document).ready(function() {

        $('#tblperiodos tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
            habilitar_periodo();
        });

        $('#tblperiodos tbody tr').live('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
        });
//    $('#frmPeriodos').submit(function(e) {
//            var tabla = $('#periodos-datatables').dataTable();
//            var idFila = filaId(tabla);
//            var periodo_activo =  $('#periodo-activo').val();
////            alert(idFila);
////            alert(periodo_activo);
//            if (idFila != null) {
//                ejecutarAccionJson(
//                        'gestion', 'gestionarPeriodos', 'habilitar_periodos', 'periodo-a-activar=' + idFila+'&periodo-activo='+periodo_activo,
//                        ' mostrar_resultado_guardar( data, "abrir_listado_periodos();", "" );'
//                        );
//            } else {
//                alert('Seleccione un registro');
//            }       
//        });
    });
    
    function habilitar_periodo(){
        var tabla = $('#tblperiodos').dataTable();
            var idFila = filaId(tabla);
            var periodo_activo =  $('#periodo-activo').val();
//            alert(idFila);
//            alert(periodo_activo);
            if (idFila != null) {
                ejecutarAccionJson(
                        'gestion', 'gestionarPeriodos', 'habilitar_periodos', 'periodo-a-activar=' + idFila+'&periodo-activo='+periodo_activo,
                        ' mostrar_resultado_guardar( data, "abrir_listado_periodos();", "" );'
                        );
            } else {
                alert('Seleccione un registro');
            }
    }
</script>