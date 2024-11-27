<table id="tbl-form-registros-semanal-contatos" class="table table-bordered table-striped">
    <thead>
        <?php
        $labels["APROBADO"] = "label-success";
        $labels["EN REVISION"] = "label-warning";
        $labels["CON ERRORES"] = "label-important";
        $labels["PENDIENTE"] = "label-info";
        $labels["REVISADO"] = "label-inverse";
        ?>
               <tr>
            <td class="text-center <?php echo ($labels["PENDIENTE"]) ? " " . $labels["PENDIENTE"] : ""; ?> ">
                <span class="label <?php echo ($labels["PENDIENTE"]) ? " " . $labels["PENDIENTE"] : ""; ?> ">PENDIENTE</span>
            </td>
            <td class="  text-center <?php echo ($labels["EN REVISION"]) ? " " . $labels["EN REVISION"] : ""; ?>">
                <span class="label <?php echo ($labels["EN REVISION"]) ? " " . $labels["EN REVISION"] : ""; ?>">EN REVISIÓN</span>
            </td>
            <td class=" text-center <?php echo ($labels["REVISADO"]) ? " " . $labels["REVISADO"] : ""; ?>">
                <span class="label <?php echo ($labels["REVISADO"]) ? " " . $labels["REVISADO"] : ""; ?>">REVISADO</span>
            </td>
            <td class="  text-center <?php echo ($labels["APROBADO"]) ? " " . $labels["APROBADO"] : ""; ?>">
                <span class="label <?php echo ($labels["APROBADO"]) ? " " . $labels["APROBADO"] : ""; ?> ">APROBADOS</span>
            </td> 
        </tr>

    </thead>
    <tbody>
        <tr>
            <td class="text-center"><?php echo $totalContactos->TOTAL_PENDIENTES ?></td>
            <td class="text-center"><?php echo $totalContactos->TOTAL_ENREVISION ?></td>
            <td class="text-center"><?php echo $totalContactos->TOTAL_REVISADOS ?></td>
            <td class="text-center"><?php echo $totalContactos->TOTAL_APROBADOS ?></td>
        </tr>
    </tbody>
</table>


<script>
    $(document).ready(function() {

    });
    function revisar_todos_semanal_contactos() {
        confirm(
            'Desea cambiar a estado <strong>REVISADO</strong> de todas las hojas de Registro Semanal de Alcances para este periodo?',
            'revisarReciboSemanalContacto()'
            );
    }
</script>
