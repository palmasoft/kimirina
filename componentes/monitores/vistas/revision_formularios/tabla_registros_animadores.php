
<table id="recibo-contacto-animador-datatables" class="table table-bordered table-hover">
    <thead>
        <tr>
            <?php if ($SubReceptor->ID_SUBRECEPTOR === 0): ?>
                <th class="">SR</th>
            <?php endif; ?>
            <th>NO. RECIBO</th>
            <th>FECHA y HORA</th>
            <th>POB</th>
            <th>UBICACIÓN</th>
            <th>CODIGO</th>
            <th>CEDULA</th>
            <th>NOMBRE COMPLETO</th>
            <th>TEMA</th>
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
        if (!empty($ContactoAnimador)) {
            foreach ($ContactoAnimador as $contactoAnimador) {
                ?>
                <tr fila-id="<?php echo $contactoAnimador->ID_CONTACTOANIMADOR ?>" data-titulo="<?php echo ($contactoAnimador->NO_RECIBO_CONTACTOANIMADOR) ?>">
                    <?php if ($SubReceptor->ID_SUBRECEPTOR === 0): ?>
                        <th class=""><?php echo ($contactoAnimador->SIGLAS_SUBRECEPTOR) ?></th>
                    <?php endif; ?>
                    <td><?php echo ($contactoAnimador->NO_RECIBO_CONTACTOANIMADOR) ?></td>
                    <td class=""><?php echo $contactoAnimador->ANO_CONTACTOANIMADOR . '-' . $contactoAnimador->MES_CONTACTOANIMADOR . '-' . $contactoAnimador->DIA_CONTACTOANIMADOR . ' ' . $contactoAnimador->HORA_CONTACTOANIMADOR ?></td>
                    <td class=""><?php echo ($contactoAnimador->TIPO_FORMATO_CONTACTOANIMADOR) ?></td>
                    <td class=""><?php echo ($contactoAnimador->NOMBRE_PROVINCIA) ?> - <?php echo ($contactoAnimador->NOMBRE_CANTON) ?></td>
                    <td class=""><?php echo ($contactoAnimador->CODIGO_UNICO_PERSONA) ?></td>
                    <td class=""><?php echo ($contactoAnimador->CEDULA_PEMAR) ?></td>
                    <td class=""><?php echo ($contactoAnimador->PRIMER_NOMBRE_PEMAR . ' ' . $contactoAnimador->SEGUNDO_NOMBRE_PEMAR . ' ' . $contactoAnimador->PRIMER_APELLIDO_PEMAR . ' ' . $contactoAnimador->SEGUNDO_APELLIDO_PEMAR) ?></td>
                    <td class=""><?php echo ($contactoAnimador->TITULO_TEMA) ?></td>
                    <td class=" ">
                        <span class="label<?php echo ($labels[$contactoAnimador->ESTADO_REVISION]) ? " " . $labels[$contactoAnimador->ESTADO_REVISION] : ""; ?>"><?php echo $contactoAnimador->ESTADO_REVISION ?></span>
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
        $('#recibo-contacto-animador-datatables tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            $('#registro-seleccionado-animadores').html($(this).attr('data-titulo'));
            abrir_modal_registro_animadores();
        });

        $('#recibo-contacto-animador-datatables tbody tr').on('click', function(e) {
            $('#registro-seleccionado-animadores').html($(this).attr('data-titulo'));
        });

        $("#recibo-contacto-animador-datatables tbody tr").click(function(e) {
            if ($(this).hasClass('row_selected')) {
                $(this).removeClass('row_selected');
            }
            else {
                $('#recibo-contacto-animador-datatables tbody tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
            }
        });

        $('#recibo-contacto-animador-datatables').dataTable({
            'iDisplayLength': 5
        });

    });


    function generar_reporte_revision_recibos_animadores() {
        mostrar_contenidos(
            'monitores', 'revisionFormularios', 'generar_reporte_estado_de_la_revision_recibos_animadores',''
        );
    }


    function revisar_registro_animadores() {
        var tabla = $('#recibo-contacto-animador-datatables').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            ejecutarAccionJson(
                    'monitores', 'revisionFormularios', 'revisar_formulario_animador', 'registro-id-animador=' + idFila,
                    'mostrar_resultado_guardar( data, "mostrar_listado_revision_formularios();", "" );'
                    );
        } else {
            alert('Seleccione un Registro');
        }
    }

    function aprobar_registro_animadores() {

        var tabla = $('#recibo-contacto-animador-datatables').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            ejecutarAccionJson(
                    'monitores', 'aprobacionFormularios', 'aprobar_formulario_animador', 'registro-id-animador=' + idFila,
                    'mostrar_resultado_guardar( data, "mostrar_listado_aprobacion_formularios();", "" );'
                    );
        } else {
            alert('Seleccione un Registro');
        }

    }


    function abrir_modal_registro_animadores() {
        var tabla = $('#recibo-contacto-animador-datatables').dataTable();
        var idRegistro = filaId(tabla);
        if (idRegistro != null) {
            ejecutarAccion('monitores', 'reciboContactoAnimador', 'mostrar_datos_contacto_animador_modal', 'idReciboAnimador=' + idRegistro,
                    ' $("#body_modal").html(data); $("#modal-vista-formulario").modal("show");  ');
        } else {
            alert('Debes seleccionar un registro.');
        }
    }

</script>
