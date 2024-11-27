
<table id="tbl-form-registros-semanales" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="span1 text-center">TIPO</th>
            <th class="span1 text-center">DESDE</th>
            <th class="span1 text-center">HASTA</th>
            <th class="span1 text-center">SEGUIMIENTO</th>
            <th class="hidden-phone hidden-tablet">PROMOTOR </th>
            <th class="hidden-phone hidden-tablet">UBICACION</th>
            <th class="span1 hidden-phone">Revision</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $labels["APROBADO"] = "label-success";
        $labels["EN REVISION"] = "label-warning";
        $labels["CON ERRORES"] = "label-important";
        $labels["PENDIENTE"] = "label-info";
        $labels["REVISADO"] = "label-inverse";
        ?>
        <?php
        if (!empty($RegistrosSemanales)) {
            foreach ($RegistrosSemanales as $formulario) {
                ?>
                <tr fila-id="<?php echo ($formulario->ID_REGISTROSEMANAL) ?>"  data-code="<?php echo ($formulario->NUM_REGISTROSEMANAL) ?>">
                    <td class="text-center "><?php echo ($formulario->TIPO_FORMATO_REGISTROSEMANAL) ?></td>
                    <td class="text-center "><?php echo ($formulario->SEMANA_DEL) ?></td>
                    <td class="text-center "><?php echo ($formulario->SEMANA_HASTA) ?></td>
                    <td class="text-center "><?php echo ($formulario->NUM_REGISTROSEMANAL) ?></td>
                    <td class="hidden-phone hidden-tablet"><?php echo ($formulario->NOMBRE_REAL_PERSONA) ?></td>
                    <td class="hidden-phone hidden-tablet"><?php echo ($formulario->NOMBRE_PROVINCIA); ?> - <?php echo ($formulario->NOMBRE_CANTON); ?></td>                                                
                    <td class="span2 hidden-phone">
                        <span class="label<?php echo ($labels[$formulario->ESTADO_REVISION]) ? " " . $labels[$formulario->ESTADO_REVISION] : ""; ?>"><?php echo $formulario->ESTADO_REVISION ?></span>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<script>


    $(document).ready(function() {

        $('#tbl-form-registros-semanales tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            $('#registro-seleccionado-registro-semanal').html($(this).attr('data-code'));
            abrir_modal_registro_semanal();
        });

        $('#tbl-form-registros-semanales tbody tr').on('click', function(e) {
            $('#registro-seleccionado-registro-semanal').html($(this).attr('data-code'));
        });

        $("#tbl-form-registros-semanales tbody tr").click(function(e) {
            if ($(this).hasClass('row_selected')) {
                $(this).removeClass('row_selected');
            }
            else {
                $('#tbl-form-registros-semanales tbody tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
            }
        });

        $('#tbl-form-registros-semanales').dataTable({
            "iDisplayLength": 5
        });




    });
    function generar_reporte_revision_registro_semanal() {
        mostrar_contenidos(
                'monitores', 'revisionFormularios', 'generar_reporte_estado_de_la_revision_registros_semanales',
                ''
                );
    }

    function revisar_registro_registro_semanal() {

        var tabla = $('#tbl-form-registros-semanales').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            ejecutarAccionJson(
                    'monitores', 'revisionFormularios', 'revisar_formulario_semanal_contacto', 'registro-id-contacto=' + idFila,
                    'mostrar_resultado_guardar( data, "mostrar_listado_revision_formularios();", "" );'
                    );
        } else {
            alert('Seleccione un Registro');
        }
    }


    function aprobar_registro_registro_semanal() {

        var tabla = $('#tbl-form-registros-semanales').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            ejecutarAccionJson(
                    'monitores', 'aprobacionFormularios', 'aprobar_formulario_semanal_contacto', 'registro-id-contacto=' + idFila,
                    'mostrar_resultado_guardar( data, "mostrar_listado_aprobacion_formularios();", "" );'
                    );
        } else {
            alert('Seleccione un Registro');
        }

    }


    function abrir_modal_registro_semanal() {
        var tabla = $('#tbl-form-registros-semanales').dataTable();
        var idRegistro = filaId(tabla);
        if (idRegistro != null) {
            ejecutarAccion('monitores', 'registroSemanal', 'ver_registro_semanal_modal', 'idRegistroSemanal=' + idRegistro,
                    ' $("#body_modal").html(data); $("#modal-vista-formulario").modal("show");  ');
        } else {
            alert('Debes seleccionar un registro.');
        }
    }
</script>