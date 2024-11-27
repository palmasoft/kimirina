

<div id="pre-page-content">
    <h1>
        <i class="fa-bullhorn themed-color"></i>Consejerias a PVVS<br>
        <small>Registros de consejerias a personas que viven con VIH y/o SIDA</small>
    </h1>
</div>


<div id="page-content">

    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Formularios</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Listado Consjerias PVVS</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <?php if (!$tieneRestricciones): ?>            
        <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos, 'gestion'); ?>
    <?php endif; ?>


    <div class="row-fluid botones_arriba "  >
        <div class=" span4 btn-group text-left ">
            <a href="javascript:abrir_nuevo_registro_consejeria_pvvs();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>						
        </div>
        <div class="span4 text-center"><i class="icon-bolt"></i><span id="registro-seleccionado">clic sobre un registro</span></div>
        <div class=" span4 btn-group  text-right  ">
            <a href="javascript:abrir_ver_datos_consejeria();" data-toggle="tooltip" title="Mostrar Formulario" class="btn btn-lg btn-info"><i class="icon-zoom-in"></i> ver </a>
            <a href="javascript:editar_formulario_consejeria_pvvs();" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i> Editar</a>
            <a href="javascript:confirmar_eliminar_formulario_consejeria_pvvs();" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i> Eliminar</a>
        </div>
    </div>

    <?php $this->mostrar('consejeria_pvvs/tablaListadoConsejeriasPvvs', $this->datos); ?>


</div>



<script>
    $(document).ready(function() {

        $('#form-control-subreceptor-periodo').submit(function(e) {
            if (estaVacio($('#subreceptor-form-control').val())) {
                alert('Seleccione un Subreceptor.');
                return false;
            }
            abrir_listado_consejerias_pvvs($(this).serialize());
        });

        $('#formularios-pvvs-datatables tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            var tabla = $('#formularios-pvvs-datatables').dataTable();
            $('#registro-seleccionado').html(
                    filaSeleccionada(tabla, 'data-num-consejeria')
                    );
            editar_formulario_consejeria_pvvs();
        });

    });


    function editar_formulario_consejeria_pvvs() {
        var tabla = $('#formularios-pvvs-datatables').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            mostrar_contenidos(
                    'monitores', 'ConsejeriaPVVS', 'editar_form_consejeria_pvvs', 'idConsejeria=' + idFila
                    );
        } else {
        }
    }

    function confirmar_eliminar_formulario_consejeria_pvvs() {
        var tabla = $('#formularios-pvvs-datatables').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            confirm(
                    "¿seguro que desea eliminar esta Consejeria?", "eliminar_formulario_consejeria_pvvs();"
                    );
        } else {
            alert('Seleccione un registro');
        }
    }


    function eliminar_formulario_consejeria_pvvs() {
        var tabla = $('#formularios-pvvs-datatables').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            ejecutarAccionJson(
                    'monitores', 'ConsejeriaPVVS', 'eliminar_consejeria_pvvs', 'idConsejeria=' + idFila,
                    ' mostrar_resultado_guardar( data, "abrir_listado_consejerias_pvvs();", "" );'
                    );
        } else {
            alert('Seleccione un registro');
        }
    }


    function abrir_ver_datos_consejeria() {
        var tabla = $('#formularios-pvvs-datatables').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            mostrar_datos_consejeria_pvvs(idFila);
        } else {
            alert('Debes seleccionar un registro.');
        }
    }



</script>


