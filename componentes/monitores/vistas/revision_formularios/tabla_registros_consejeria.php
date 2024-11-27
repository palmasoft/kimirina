
<table id="formularios-pvvs-datatables" class="table table-bordered table-hover "  >
    <thead>
        <tr>
            <?php if ($SubReceptor->ID_SUBRECEPTOR === 0): ?>
                <th class="">SR</th>
            <?php endif; ?>
            <th class=" ">FECHA</th>
            <th class=" ">SEGUIMIENTO</th>
            <th class=" ">CÓDIGO</th>
            <th class=" ">NOMBRE COMPLETO </th>
            <th class=" ">CÉDULA </th>
            <th class=" ">ATENCION MEDICA</th>

            <th class=" text-center">Tratamiento</th>
            <th class=" text-center">Consejero</th>

            <th class="">REVISIÓN</th>

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
        if (!empty($TodasConsejerias)) {
            foreach ($TodasConsejerias as $consejeria) {
                ?>
                <tr fila-id="<?php echo $consejeria->ID_CONSEJERIA_PVVS ?>" data-num-consejeria="<?php echo $consejeria->NUM_CONSEJERIA ?>">
                    <?php if ($SubReceptor->ID_SUBRECEPTOR === 0): ?>
                        <th class=""><?php echo ($consejeria->SIGLAS_SUBRECEPTOR) ?></th>
                    <?php endif; ?>
                    <td class=" "><?php echo $consejeria->FECHA_CONSEJERIA ?></td>
                    <td class=" "><?php echo $consejeria->NUM_CONSEJERIA ?></td>
                    <td class=" "><?php echo $consejeria->CODIGO_UNICO_PERSONA ?></td>
                    <td class=" "><?php echo $consejeria->PRIMER_NOMBRE_PEMAR ?> <?php echo $consejeria->SEGUNDO_NOMBRE_PEMAR ?> <?php echo $consejeria->PRIMER_APELLIDO_PEMAR ?> <?php echo $consejeria->SEGUNDO_APELLIDO_PEMAR ?></td>
                    <td class=" "><?php echo $consejeria->CEDULA_PEMAR ?></td>
                    <td class=" "><?php echo $consejeria->NOMBRE_CENTROSERVICIO ?></td>

                    <td class=" text-center"><?php echo $consejeria->TRATAMIENTO_ARV ?></td>
                    <td class=" text-center"><?php echo $consejeria->NOMBRE_CONSEJERO ?></td>
                    <td class="span2 hidden-phone">
                        <span class="label<?php echo ($labels[$consejeria->ESTADO_REVISION]) ? " " . $labels[$consejeria->ESTADO_REVISION] : ""; ?>"><?php echo $consejeria->ESTADO_REVISION ?></span>
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

        $('#formularios-pvvs-datatables tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            $('#registro-seleccionado-consejeria').html($(this).attr('data-num-consejeria'));
            abrir_modal_registro_consejerias();
        });

        $('#formularios-pvvs-datatables tbody tr').on('click', function(e) {
            $('#registro-seleccionado-consejeria').html($(this).attr('data-num-consejeria'));
        });

        $("#formularios-pvvs-datatables tbody tr").click(function(e) {
            if ($(this).hasClass('row_selected')) {
                $(this).removeClass('row_selected');
            }
            else {
                $('#formularios-pvvs-datatables tbody tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
            }
        });

        $('#formularios-pvvs-datatables').dataTable({
            "iDisplayLength": 5
        });
    });

    function generar_reporte_revision_consejerias() {
        mostrar_contenidos(
                'monitores', 'revisionFormularios', 'generar_reporte_estado_de_la_revision_consejerias', ''
                );
    }

    function revisar_registro_consejeria() {
        var tabla = $('#formularios-pvvs-datatables').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            ejecutarAccionJson(
                    'monitores', 'revisionFormularios', 'revisar_formulario_consejeria', 'registro-id-consejeria=' + idFila,
                    'mostrar_resultado_guardar( data, "mostrar_listado_revision_formularios();", "" );'
                    );
        } else {
            alert('Seleccione un Registro');
        }
    }


    function aprobar_registro_consejeria() {
        var tabla = $('#formularios-pvvs-datatables').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            ejecutarAccionJson(
                    'monitores', 'aprobacionFormularios', 'aprobar_formulario_consejeria', 'registro-id-consejeria=' + idFila,
                    'mostrar_resultado_guardar( data, "mostrar_listado_aprobacion_formularios();", "" );'
                    );
        } else {
            alert('Seleccione un Registro');
        }

    }


    function abrir_modal_registro_consejerias() {
        var tabla = $('#formularios-pvvs-datatables').dataTable();
        var idRegistro = filaId(tabla);
        if (idRegistro != null) {
            ejecutarAccion('monitores', 'consejeriaPVVS', 'mostrar_datos_consejeria_PVVS', 'idConsejeria=' + idRegistro,
                    ' $("#body_modal").html(data); $("#modal-vista-formulario").modal("show");  ');
        } else {
            alert('Debes seleccionar un registro.');
        }
    }
</script>
