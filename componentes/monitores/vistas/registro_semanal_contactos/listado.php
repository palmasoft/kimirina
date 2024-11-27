

<div id="pre-page-content">   
    <h1>
        <i class="glyphicon-table themed-color"></i>Hojas de Registro Semanal de Alcances<br>
        <small>Listado de las hojas o formularios de alcances que reporta el promotor <br>
            de los abordajes realizados!</small>
    </h1>   
    
    
</div>

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
            <a href="#">Digitadores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Listados</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Hojas de Registro Semanal de Alcances</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <?php if (!$tieneRestricciones or Usuario::esDNI() ): ?>            
        <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos, 'gestion'); ?>
    <?php endif; ?>

    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
            <?php if( $mostrarHSH ): ?>
            <a href="javascript:abrir_nuevo_form_registro_semanal_contacto_HSH();" data-toggle="tooltip" title="Agregar nueva Hoja de Registro Semanal de Alcances para HSH" class="btn btn-lg btn-info"><i class="icon-plus"></i> HSH</a>						
            <?php endif; ?>
            <?php if( $mostrarTS ): ?>
            <a href="javascript:abrir_nuevo_form_registro_semanal_contacto_TS();" data-toggle="tooltip" title="Agregar nueva Hoja de Registro Semanal de Alcances para  TS" class="btn btn-lg btn-info"><i class="icon-plus"></i> TS</a>						
            <?php endif; ?>
            <?php if( $mostrarTRANS ): ?>
            <a href="javascript:abrir_nuevo_form_registro_semanal_contacto_TRANS();" data-toggle="tooltip" title="Agregar nueva Hoja de Registro Semanal de Alcances para TRANS" class="btn btn-lg btn-info"><i class="icon-plus"></i> TRANS</a>						
            <?php endif; ?>
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
            <a href="javascript:abrir_ver_datos_registro_seleccionado();" data-toggle="tooltip" title="Ver los datos ingresados de la hoja de registro de contactos" class="btn btn-lg btn-info"><i class="icon-zoom-in"></i> Ver </a>			            
            <a href="javascript:abrir_editar_registro_seleccionado();" data-toggle="tooltip" title="Cambiar o editar los datos registrados de la hoja de contactos" class="btn btn-lg btn-warning"><i class="icon-pencil"></i> Editar</a>
            <a href="javascript:confirmar_eliminar_regstro_semanal();" data-toggle="tooltip" title="Eliminar un formulario del registro de abordajes" class="btn btn-lg btn-danger"><i class="icon-remove"></i> Eliminar</a>
        </div>
    </div>

   
    <div class="block-section">
        <?php $this->mostrar('registro_semanal_contactos/tablaListadoRegistros', $this->datos); ?>
    </div>


</div>
<!-- END Page Content -->

<script>
        agregar_boton_ayuda('LISTAHOJASALCANCES');     
        
    $(document).ready(function() {
        
           
        
        
        $('#form-control-subreceptor-periodo').submit(function(e) {
            if (estaVacio($('#subreceptor-form-control').val())) {
                alert('Seleccione un Subreceptor.');
                return false;
            }
            mostrar_registros_semanales_contacto($(this).serialize());
        });
        $('#tbl-form-registros-semanales tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            $('#registro-seleccionado').html($(this).attr('data-code'));
            abrir_editar_registro_seleccionado();
        });
        $('#tbl-form-registros-semanales tbody tr').on('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-code'));
        });
    });
    function abrir_ver_datos_registro_seleccionado() {
        var tabla = $('#tbl-form-registros-semanales').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            ver_datos_registro_semanal(idFila);
        } else {
            alert('Seleccione un registro');
        }

    }

    function abrir_editar_registro_seleccionado() {
        var tabla = $('#tbl-form-registros-semanales').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            editar_datos_registro_semanal(idFila);
        } else {
            alert('Seleccione un registro para editar');
        }

    }
    function abrir_ver_contactos_registrados() {
        alert('Aquí mostraremos el listado de contactos del formulario con toda su información de PEMARS');
    }

    function confirmar_eliminar_regstro_semanal() {
        var tabla = $('#tbl-form-registros-semanales').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            confirm(
                    "¿Está seguro de eliminar esta <strong>Hoja de Registro Semanal de Alcances</strong> ?",
                    "eliminar_registro_semanal();"
                    );
        } else {
            alert('Seleccione un registro para eliminar');
        }
    }

    function eliminar_registro_semanal() {
        var tabla = $('#tbl-form-registros-semanales').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            ejecutarAccionJson(
                    'monitores', 'registroSemanal', 'eliminar_formulario_registro_semanal', 'idRegistroSemanal=' + idFila,
                    ' mostrar_resultado_guardar( data, "mostrar_registros_semanales_contacto();", "" );'
                    );
        } else {
            alert('Debe seleccionar un registro para eliminar.');
        }
    }


</script>


