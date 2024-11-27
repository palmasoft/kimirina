<form id="form-datos-contacto-alcanzados" onsubmit="return false;" >
    <table id="tabla-contactos-registrados-semana" class="table table-bordered table-hover dataTables">
        <thead>
            <tr>
                <th rowspan="2">#</th>
                <th rowspan="2">Nombre(s) y Apellido(s)</th>
                <th colspan="5">Participacion en actividades de capacitacion</th>
                <th colspan="5">Participación en reuniones técnicas</th>
                <th colspan="5">Supervisiones realizadas</th> 
                <th rowspan="2">Reuniones con Equipo Tecnico</th>
            </tr>
            <tr>

                <th class=" text-center ">1 sem</th>
                <th class=" text-center ">2 sem</th>
                <th class=" text-center ">3 sem</th>
                <th class=" text-center ">4 sem</th>
                <th class=" text-center ">Total</th>
                <th class=" text-center ">1 sem</th>
                <th class=" text-center ">2 sem</th>
                <th class=" text-center ">3 sem</th>
                <th class=" text-center ">4 sem</th>
                <th class=" text-center ">Total</th>
                <th class=" text-center ">1 sem</th>
                <th class=" text-center ">2 sem</th>
                <th class=" text-center ">3 sem</th>
                <th class=" text-center ">4 sem</th>
                <th class=" text-center ">Total</th>

            </tr>
        </thead>
        <tbody> 
            <?php
            if (isset($informes)) {
                $countRow = 0;
                foreach ($informes->filas as $informe) :
                    ?>                        
                    <tr>
                        <td>
                            <?php echo $countRow += 1 ?>
                        </td>
                        <td>
                            <?php echo ($informe->NOMBRE_MONITOR); ?>
                        </td>
                        <td>
                            <?php echo ($informe->SEM_1_CAPACITACION); ?>
                        </td>
                        <td>
                            <?php echo ($informe->SEM_2_CAPACITACION); ?>
                        </td>
                        <td>
                            <?php echo ($informe->SEM_3_CAPACITACION); ?>
                        </td>
                        <td>
                            <?php echo ($informe->SEM_4_CAPACITACION); ?>
                        </td>
                        <td>
                            <?php echo ($informe->TOTAL_CAPACITACION); ?>
                        </td>
                        <td>
                            <?php echo ($informe->SEM_1_REUNIONES); ?>
                        </td>
                        <td>
                            <?php echo ($informe->SEM_2_REUNIONES); ?>
                        </td>
                        <td>
                            <?php echo ($informe->SEM_3_REUNIONES); ?>
                        </td>
                        <td>
                            <?php echo ($informe->SEM_4_REUNIONES); ?>
                        </td>
                        <td>
                            <?php echo ($informe->TOTAL_REUNIONES); ?>
                        </td>

                        <td>
                            <?php echo ($informe->SEM_1_SUPERVISIONES); ?>
                        </td>
                        <td>
                            <?php echo ($informe->SEM_2_SUPERVISIONES); ?>
                        </td>
                        <td>
                            <?php echo ($informe->SEM_3_SUPERVISIONES); ?>
                        </td>
                        <td>
                            <?php echo ($informe->SEM_4_SUPERVISIONES); ?>
                        </td>
                        <td>
                            <?php echo ($informe->TOTAL_SUPERVISIONES); ?>
                        </td>
                        <td>
                            <?php echo ($informe->REUNIONES_EQUIPO_TECNICO); ?>
                        </td>
                    </tr>
                    <?php
                endforeach;
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th class=" text-center "></th>
                <th class=" text-center "></th>
                <th class=" text-center "></th>
                <th class=" text-center "></th>
                <th class=" text-center "></th>
                <th class=" text-center "></th>
                <th class=" text-center "><?php
                    if (isset($informes)) {
                        echo $informes->ttlActividades;
                    }
                    ?></th>
                <th class=" text-center "></th>
                <th class=" text-center "></th>
                <th class=" text-center "></th>
                <th class=" text-center "></th>
                <th class=" text-center "><?php
                    if (isset($informes)) {
                        echo $informes->ttlReuniones;
                    }
                    ?></th>
                <th class=" text-center "></th>
                <th class=" text-center "></th>
                <th class=" text-center "></th>
                <th class=" text-center "></th>
                <th class=" text-center "><?php
                    if (isset($informes)) {
                        echo $informes->ttlSupervisiones;
                    }
                    ?></th>
                <th class=" text-center "></th>
            </tr>
        </tfoot>
    </table>
</form>
