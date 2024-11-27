<?php ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-barcode themed-color"></i> Recibos de Contacto por Animadores<br>
        <small>Listado de recibos de contacto por animadores</small>
    </h1>
</div>
<!-- END Pre Page Content -->


<!-- Page Content -->
<div id="page-content">

    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Digitadores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Listados</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Recibos de Contacto por Animadores</a></li>
    </ul>

    
    

    <?php if (!$tieneRestricciones or Usuario::esDNI() ): ?>            
        <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos, 'gestion'); ?>
    <?php endif; ?>

    <div class="row-fluid botones_arriba "  >
        <div class=" span4 btn-group text-left ">
            <a href="javascript:abrir_formulario_recibo_contacto_animador();" data-toggle="tooltip" title="Agregar Nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>						
        </div>
        <div class="span4 text-center"><i class="icon-bolt"></i><span id="registro-seleccionado">clic sobre un registro</span></div>
        <div class=" span4 btn-group  text-right  ">
            <a href="javascript:mostrar_formulario_completo_recibo_contacto();" data-toggle="tooltip" title="Mostrar Formulario" class="btn btn-lg btn-info"><i class="icon-zoom-in"></i> Ver </a>
            <a href="javascript:editar_formulario_recibo_contacto();" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i> Editar</a>
            <a href="javascript:confirmar_eliminar_formulario_recibo_contacto();" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i> Eliminar</a>
        </div>
    </div>
    
    <div class="block-section">
        <?php $this->mostrar('recibo_contacto_animador/tablaListadoContactoAnimador', $this->datos); ?>
    </div>   

</div>



<script>
    $(document).ready(function() {                 
        $('#form-control-subreceptor-periodo').submit(function(e) {
            if (estaVacio($('#subreceptor-form-control').val())) {
                alert('Seleccione un Subreceptor.');
                return false;
            }
            abrir_tabla_recibo_contacto_animador( $(this).serialize() );
        });        
        $('#recibo-contacto-animador-datatables tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            var tabla = $('#recibo-contacto-animador-datatables').dataTable();
            $('#registro-seleccionado').html(filaSeleccionada(tabla, 'data-titulo'));
            editar_formulario_recibo_contacto();
        });
        $('#recibo-contacto-animador-datatables tbody tr').live('click', function(e) {
            var tabla = $('#recibo-contacto-animador-datatables').dataTable();
            $('#registro-seleccionado').html(
                    filaSeleccionada(tabla, 'data-titulo')
                    );
        });
    });

    function mostrar_formulario_completo_recibo_contacto() {
        var tabla = $('#recibo-contacto-animador-datatables').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            mostrar_contenidos(
                    'monitores', 'reciboContactoAnimador', 'mostrar_datos_contacto_animador', 'idReciboAnimador=' + idFila
                    );
        } else {
            alert('Seleccione un regitro');
        }
    }

    function editar_formulario_recibo_contacto() {
        var tabla = $('#recibo-contacto-animador-datatables').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            mostrar_contenidos(
                    'monitores', 'reciboContactoAnimador', 'editar_form_recibo_contacto_animador', 'idReciboAnimador=' + idFila
                    );
        } else {

        }
    }
    function confirmar_eliminar_formulario_recibo_contacto() {
        var tabla = $('#recibo-contacto-animador-datatables').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            confirm(
                    "¿Seguro que desea eliminar este <strong>Recibo de Contacto por Animador</strong> de SIMON?",
                    "eliminar_formulario_recibo_contacto();"
                    );
        } else {
            alert('Debe selecionar un registro');
        }
    }

    function eliminar_formulario_recibo_contacto() {
        var tabla = $('#recibo-contacto-animador-datatables').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            ejecutarAccionJson(
                    'monitores', 'reciboContactoAnimador', 'eliminar_recibo_contacto_animador', 'idContactoAnimador=' + idFila,
                    ' mostrar_resultado_guardar( data, "abrir_tabla_recibo_contacto_animador();", "" );'
                    );
        } else {
        }
    }

</script>
<script>
    agregar_boton_ayuda('LISTARECIBOSCONTACTO');
</script>