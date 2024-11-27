

<div id="pre-page-content">
    <h1>
        <i class="fa-bullhorn themed-color"></i>Listado de consejeria PVVS Aprobados<br>
        <small>REGISTRO DE CONSEJERIA DE PARES CON PERSONAS QUE VIVEN CON VIH.</small>
    </h1>
</div>


<div id="page-content">

    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Coordinadores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Consejerias Aprobadas</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Recibo Consejerias</a></li>
    </ul>

    <?php if (!$tieneRestricciones or Usuario::esDNI() ): ?>            
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
            <a href="javascript:abrir_ver_datos_consejeria_aprobada();" data-toggle="tooltip" title="ver datos registrados para esta consejeria a pvvs " class="btn btn-lg btn-info"><i class="glyphicon-zoom_in"></i> Ver</a>						
            <a href="javascript:mostrar_formulario_editar_consejeria_aprobada();" data-toggle="tooltip" title="corregir registro de consejeria aprobada" class="btn btn-lg btn-success"><i class="glyphicon-spade"></i> Corregir</a>			            
        </div>
    </div>

    <div class="block-section">
        <?php $this->mostrar('consejeria_pvvs/tablaListadoConsejeriasPvvs', $this->datos, 'monitores'); ?>
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

</div>


<script>
    $(document).ready(function() {
        $('#form-control-subreceptor-periodo').submit(function(e) {
            if (estaVacio($('#subreceptor-form-control').val())) {
                alert('Seleccione un Subreceptor.');
                return false;
            }
            monstrar_lista_aprobados_consejerias_pvvs($(this).serialize());
        });


        $('#formularios-pvvs-datatables tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            var tabla = $('#formularios-pvvs-datatables').dataTable();
            $('#registro-seleccionado').html(
                    filaSeleccionada(tabla, 'data-num-consejeria')
                    );
            mostrar_formulario_editar_consejeria_aprobada();
        });

    });

    function abrir_cambios_del_registro_aprobado() {
        var tabla = $('#formularios-pvvs-datatables').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            ejecutarAccion(
                    'supervision', 'auditoriaFormularios', 'correcciones_consejeria_aprobado',
                    'idConsejeria=' + idFila, '$("#modal-modificaciones .modal-body").html(data); $("#modal-modificaciones").modal("show"); '
                    );
        } else {
            alert('Seleccione un registro');
        }
    }

    function abrir_ver_datos_consejeria_aprobada() {
        var tabla = $('#formularios-pvvs-datatables').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            mostrar_datos_consejeria_pvvs(idFila)
        } else {
            alert('Seleccione un registro');
        }
    }
    function mostrar_formulario_editar_consejeria_aprobada() {
        var tabla = $('#formularios-pvvs-datatables').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            mostrar_contenidos(
                    'supervision', 'formulariosAprobados', 'editar_form_consejeria_pvvs_aprobado', 'idConsejeria=' + idFila
                    );
        } else {
            alert('Seleccione un registro');
        }
    }

</script>
<script>
    agregar_boton_ayuda('BIENVENIDA');
</script>


