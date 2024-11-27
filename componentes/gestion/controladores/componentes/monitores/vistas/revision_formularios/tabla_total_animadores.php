<table id="tbl-form-registros-animadores" class="table table-bordered">
    <thead>
        <?php
        $labels["APROBADO"] = "label-success";
        $labels["EN REVISION"] = "label-warning";
        $labels["CON ERRORES"] = "label-important";
        $labels["PENDIENTE"] = "label-info";
        $labels["REVISADO"] = "label-inverse";
        ?>
      
        <tr>
            <td class=" text-center <?php echo ($labels["PENDIENTE"]) ? " " . $labels["PENDIENTE"] : ""; ?>">
                <span class="label<?php echo ($labels["PENDIENTE"]) ? " " . $labels["PENDIENTE"] : ""; ?>">PENDIENTE</span>
            </td>

            <td class="text-center <?php echo ($labels["EN REVISION"]) ? " " . $labels["EN REVISION"] : ""; ?>">
                <span class="label<?php echo ($labels["EN REVISION"]) ? " " . $labels["EN REVISION"] : ""; ?>">EN REVISION</span>
            </td>

            <td class="text-center <?php echo ($labels["REVISADO"]) ? " " . $labels["REVISADO"] : ""; ?>">
                <span class="label<?php echo ($labels["REVISADO"]) ? " " . $labels["REVISADO"] : ""; ?>">REVISADO</span>
            </td>

            <td class="text-center <?php echo ($labels["APROBADO"]) ? " " . $labels["APROBADO"] : ""; ?>">
                <span class="label<?php echo ($labels["APROBADO"]) ? " " . $labels["APROBADO"] : ""; ?>">APROBADOS</span>
            </td>
        </tr>

    </thead>
    <tbody>
        <tr>
            <td class="text-center"><?php echo $totalAnimadores->TOTAL_PENDIENTES ?></td>
            <td class="text-center"><?php echo $totalAnimadores->TOTAL_ENREVISION ?></td>
            <td class="text-center"><?php echo $totalAnimadores->TOTAL_REVISADOS ?></td>
            <td class="text-center"><?php echo $totalAnimadores->TOTAL_APROBADOS ?></td>
        </tr>

    </tbody>
</table>



<script>
    $(document).ready(function() {

    });
    function revisar_todos_animadores() {
        confirm(
            'Desea cambiar a estado <strong>REVISADO</strong> todos los Recibos de Contacto por Animador para este periodo?', 
            'revisarReciboContactoAnimador()'
        );
    }

</script>
