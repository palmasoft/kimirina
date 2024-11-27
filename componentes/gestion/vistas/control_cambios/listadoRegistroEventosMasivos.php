
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-table themed-color"></i> Registro de Eventos Masivos con Referidos Efectivos<br>
        <small>Todos los registros de eventos masivos con referidos efectivos a un servicio de salud</small>
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
        <li class="active"><a href="#">Eventos Masivos con Referidos Efectivos</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <?php if (!$tieneRestricciones): ?>            
        <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos); ?>
    <?php endif; ?>
    
    <div class=" row-fluid botones_arriba" >
        <div class=" span2 btn-group text-left">	
            <!--<a href="javascript:mostrar_form_registro_eventos_masivos();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>-->
        </div>
        <div class="span6 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right"> 
            <a href="javascript:ver_evento_masivo();" data-toggle="tooltip" title="Mostrar Formulario" class="btn btn-lg btn-info"><i class="icon-eye-open"></i>Ver</a>
<!--            <a href="javascript:mostrar_formulario_evento_masivo()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:confirmar_eliminar_evento_masivo()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>-->
        </div>
    </div>    

    <!-- Dynamic Tables Section -->
    
    <?php $this->mostrar("control_cambios/tablaListadoRegistroEventosMasivos", $this->datos); ?>
    
    <!-- END Dynamic Tables Section -->


</div>



<script>
    $(document).ready(function() {

//        $('#tbleventosMasivos tbody tr').dblclick(function(e) {
//            $(this).addClass('row_selected');
//            $('#registro-seleccionado').html($(this).attr('data-code'));
//            mostrar_formulario_evento_masivo();
//        });

        $('#tbleventosMasivos tbody tr').on('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-code'));
        });

        $('#form-control-subreceptor-periodo').submit(function(e) {
            if (estaVacio($('#subreceptor-form-control').val())) {
                alert('Seleccione un Subreceptor.');
                return false;
            }
            mostrar_lista_registro_eventos_masivos_gestion($(this).serialize());
        });

    });


    function ver_evento_masivo() {
        var tabla = $('#tbleventosMasivos').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            mostrar_contenidos(
                    'gestion', 'registroEventosMasivos', 'ver_registro_evento_masivo', 'id_evento_masivo=' + idFila
                    );
        } else {
            alert('Debe seleccionar un evento para editar');
        }
    }

    function mostrar_formulario_evento_masivo() {
        var tabla = $('#tbleventosMasivos').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            mostrar_contenidos(
                    'gestion', 'registroEventosMasivos', 'mostar_editar_form_registro_eventos_masivos', 'id_evento_masivo=' + idFila
                    );
        } else {
            alert('Debe seleccionar un evento para editar');
        }

    }
    
    
    function confirmar_eliminar_evento_masivo() {
        var tabla = $('#tbleventosMasivos').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            confirm( 
                "¿Estas seguro de eliminar este evento con referidos efectivos?" ,
                "eliminar_evento_masivo();"
            );
        } else {
            alert('Debe seleccionar un evento para eliminar');
        }

    }
    
    
    
    function eliminar_evento_masivo() {
        var tabla = $('#tbleventosMasivos').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {            
            ejecutarAccionJson(
                    'gestion', 'registroEventosMasivos', 'eliminar_registro_eventos_masivos', 'id_evento_masivo=' + idFila,
                    ' mostrar_resultado_guardar( data, "abrir_lista_registro_eventos_masivos();", "" );'
            );
        } else {
            alert('Debe seleccionar un evento para editar');
        }

    }

</script>


