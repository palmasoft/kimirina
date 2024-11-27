<?php ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-barcode themed-color"></i> Recibos de Contactos por Animador Aprobados<br>
        <small>Todos los formularios/recibos de Contacto de Animadores aprobados.</small>
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
            <a href="#">Supervision</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Recibo de Contacto Animador</a></li>
    </ul>
    <!-- END Breadcrumb -->

 
    <?php if (!$tieneRestricciones): ?>            
        <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos, 'gestion'); ?>
    <?php endif; ?>
    
    

    <div class="row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">            
            <a href="javascript:abrir_cambios_del_registro_aprobado();" data-toggle="tooltip" title="ver las Correciones para este registro" class="btn btn-info"><i class="glyphicon-notes"></i> Correcciones</a>
        </div>
        <div class="span4 text-center" >
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">            
            <a href="javascript:mostrar_formulario_completo_recibo_contacto();" data-toggle="tooltip" title="ver datos registrados para esta hoja de registro semanal de contactos " class="btn btn-lg btn-info"><i class="glyphicon-zoom_in"></i> Ver</a>						
            <a href="javascript:editar_formulario_recibo_contacto_aprobado();" data-toggle="tooltip" title="corregir registro aprobado" class="btn btn-lg btn-success"><i class="glyphicon-spade"></i> Corregir</a>			            
        </div>
    </div>

    <div class="block-section">
        <?php $this->mostrar('recibo_contacto_animador/tablaListadoContactoAnimador', $this->datos, 'monitores'); ?>
    </div>   

</div>


<div id="modal-modificaciones" class="modal hide fade" style="width: 670px;" >
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4>Correcciones al Registro</h4>
    </div>
    <div class="modal-body" >            
    </div>
    <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal">Aceptar</button>
    </div>
</div>



<script>
    $(document).ready(function() {
        
        

        $('#form-control-subreceptor-periodo').submit(function(e) {
            if (estaVacio($('#subreceptor-form-control').val())) {
                alert('Seleccione un Subreceptor.');
                return false;
            }
            mostrar_lista_aprobados_recibos_animadores($(this).serialize());

        });
        
        
        $('#recibo-contacto-animador-datatables tbody tr').live('click', function(e) {
            var tabla = $('#recibo-contacto-animador-datatables').dataTable();
            $('#registro-seleccionado').html(filaSeleccionada(tabla, 'data-titulo'));
        });
                
        $('#recibo-contacto-animador-datatables tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            editar_formulario_recibo_contacto_aprobado();
        });
    });

    function mostrar_formulario_completo_recibo_contacto() {
        var tabla = $('#recibo-contacto-animador-datatables').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            mostrar_contenidos(
                    'supervision', 'formulariosAprobados', 'mostrar_datos_contacto_animador', 'idReciboAnimador=' + idFila
                    );
        } else {
            alert('Seleccione un registro');
        }
    }

    function editar_formulario_recibo_contacto_aprobado() {
        var tabla = $('#recibo-contacto-animador-datatables').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            mostrar_contenidos(
                    'supervision', 'formulariosAprobados', 'editar_form_recibo_contacto_animador_aprobado', 'idReciboAnimador=' + idFila
                    );
        } else {
            alert('Seleccione un registro');
        }
    }




    function abrir_cambios_del_registro_aprobado() {
        var tabla = $('#recibo-contacto-animador-datatables').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            ejecutarAccion(
                    'supervision', 'auditoriaFormularios', 'correcciones_recibo_animador_aprobado',
                    'idReciboAnimador=' + idFila, '$("#modal-modificaciones .modal-body").html(data); $("#modal-modificaciones").modal("show"); '
                    );
        } else {
            alert('Seleccione un registro');
        }
    }

</script>
