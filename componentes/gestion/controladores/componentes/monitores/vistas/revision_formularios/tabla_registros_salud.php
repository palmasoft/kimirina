
<table id="atencion_salud-datatables" class="table table-bordered table-hover "  >
    <thead>
        <tr>
            <th class=" text-center">CENTRO DE SALUD</th>
            <th class=" text-center">SERVICIO</th>
            <th class=" text-center">POB</th>
            <th class=" text-center">FECHA</th>
            <th class=" text-center">CODIGO</th>
            <th class=" text-center">CEDULA</th>
            <th class=" text-center">NOMBRE REGISTRADO</th>            
            <th class=" hidden-phone">Revision</th>
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
        if (!empty($AtencionesSalud)) {
            foreach ($AtencionesSalud as $atencion_salud) {
                ?>
                <tr fila-id="<?php echo $atencion_salud->ID_ATENCION_SALUD ?>" data-num-atencion_salud="<?php echo $atencion_salud->FECHA_ATENCION ?>-<?php echo $atencion_salud->CODIGO_UNICO_PERSONA ?>"  >
                    <td class=" text-center"><?php echo $atencion_salud->NOMBRE_CENTROSERVICIO ?></td>
                    <td class=" text-center"><?php echo $atencion_salud->NOMBRE_SERVICIO ?></td>
                    <td class=" text-center"><?php echo $atencion_salud->TIPO_FORMATO_ATENCION ?></td>
                    <td class=" text-center"><?php echo $atencion_salud->FECHA_ATENCION ?></td>
                    <td class=" text-center"><?php echo $atencion_salud->CODIGO_UNICO_PERSONA ?></td>
                    <td class=" text-center"><?php echo $atencion_salud->CEDULA_PEMAR ?></td>
                    <td class=" text-center"><?php echo $atencion_salud->PRIMER_NOMBRE_PEMAR; ?> <?php echo $atencion_salud->SEGUNDO_NOMBRE_PEMAR; ?> <?php echo $atencion_salud->PRIMER_APELLIDO_PEMAR; ?> <?php echo $atencion_salud->SEGUNDO_APELLIDO_PEMAR; ?></td> 
                    <td class=" hidden-phone">
                        <span class="label<?php echo ($labels[$atencion_salud->ESTADO_REVISION]) ? " " . $labels[$atencion_salud->ESTADO_REVISION] : ""; ?>"><?php echo $atencion_salud->ESTADO_REVISION ?></span>
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

        $('#atencion_salud-datatables tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            $('#registro-seleccionado-atencion_salud').html($(this).attr('data-num-atencion_salud'));
            abrir_modal_registro_atencion_salud();
        });
        $('#atencion_salud-datatables tbody tr').on('click', function(e) {
            if ($(this).hasClass('row_selected')) {
                $(this).removeClass('row_selected');
            } else {
                $('#atencion_salud-datatables tbody tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
            }
            $('#registro-seleccionado-atencion_salud').html($(this).attr('data-num-atencion_salud'));
        });
        
         $('#atencion_salud-datatables').dataTable({
            "iDisplayLength": 5
        });

    });


    function generar_reporte_revision_atencion_salud() {
        mostrar_contenidos(
            'monitores', 'revisionFormularios', 'generar_reporte_estado_de_la_revision_atencion_salud',''
        );
    }


    function revisar_registro_atencion_salud() {
        var tabla = $('#atencion_salud-datatables').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            ejecutarAccionJson(
                    'monitores', 'revisionFormularios', 'revisar_formulario_atencion_salud', 'registro-id-atencion_salud=' + idFila,
                    'mostrar_resultado_guardar( data, "mostrar_listado_revision_formularios();", "" );'
                    );
        } else {
            alert('Seleccione un Registro');
        }
    }


    function aprobar_registro_atencion_salud() {
        var tabla = $('#atencion_salud-datatables').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            ejecutarAccionJson(
                    'monitores', 'aprobacionFormularios', 'aprobar_formulario_atencion_salud', 'registro-id-atencion_salud=' + idFila,
                    'mostrar_resultado_guardar( data, "mostrar_listado_aprobacion_formularios();", "" );'
                    );
        } else {
            alert('Seleccione un Registro');
        }

    }


    function abrir_modal_registro_atencion_salud() {
        var tabla = $('#atencion_salud-datatables').dataTable();
        var idRegistro = filaId(tabla);
        if (idRegistro != null) {
            ejecutarAccion('monitores', 'registroAtencionSalud', 'mostrar_datos_registro_atencion', 'id_atencion_salud=' + idRegistro,
                    ' $("#body_modal").html(data); $("#modal-vista-formulario").modal("show");  ');
        } else {
            alert('Debes seleccionar un registro.');
        }
    }

</script>