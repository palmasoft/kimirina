
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="fa-bullhorn themed-color"></i>Listado de Consejerías PVVS<br>
        <small>Registro de consejería de pares con personas que viven con VIH.</small>
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
        <li class="active"><a href="#">Recibo Consejerias</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <?php if (!$tieneRestricciones): ?>            
        <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos); ?>
    <?php endif; ?>

    <div class="row-fluid botones_arriba" style="text-align: center;" >
        <div class="span4 btn-group text-left">
            <!--<a href="javascript:abrir_nuevo_registro_consejeria_pvvs();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>-->						
        </div>
        <span class="span4 text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span> </span>
        <div class="span4 btn-group text-right">
            <a href="javascript:abrir_cambios_del_registro_aprobado();" data-toggle="tooltip" title="Correcciones para este registro" class="btn btn-info"><i class="glyphicon-notes"></i>Correcciones</a>
            <a href="javascript:abrir_ver_datos_consejeria();" data-toggle="tooltip" title="ver Contactos " class="btn btn-lg btn-info"><i class="icon-eye-open"></i>Ver</a>
            <!--<a href="javascript:editar_formulario_consejeria_pvvs();" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>-->						
        </div>
    </div>


    <div class="block-section">
        <?php // $this->mostrar('consejeria_pvvs/tablaListadoConsejeriasPvvs', $this->datos, 'monitores'); ?>
        <?php $this->mostrar('listadosRegistros/tablaListadoConsejeriasPvvs', $this->datos); ?>
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
        $('#formularios-pvvs-datatables tbody tr').live('click', function(e) {
            var tabla = $('#formularios-pvvs-datatables').dataTable();
            $('#registro-seleccionado').html(
                    filaSeleccionada(tabla, 'data-num-consejeria')
                    );
        });
        
        $('#form-control-subreceptor-periodo').submit(function(e) {
            if (estaVacio($('#subreceptor-form-control').val())) {
                alert('Seleccione un Subreceptor.');
                return false;
            }
            mostrar_lista_consejerias_pvvs_gestion($(this).serialize());
        });
    });

    function editar_formulario_consejeria_pvvs() {
        var tabla = $('#formularios-pvvs-datatables').dataTable();
        var idFila = filaId(tabla);
//        alert(idFila);
        if (idFila != null) {
            mostrar_contenidos(
                    'gestion', 'auditoriaFormularios', 'editar_form_consejeria_pvvs_aprobado', 'idConsejeria=' + idFila
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
            mostrar_datos_consejeria_pvvs(idFila)
        } else {
            alert('Seleccione un registro');
        }
    }


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

</script>
<script>
    agregar_boton_ayuda('BIENVENIDA');
</script>
