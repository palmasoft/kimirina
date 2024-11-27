<?php // print_r($Informes->filas); ?>
<form id="form-datos-contacto-alcanzados" onsubmit="return false;" >
    <table id="tabla-contactos-registrados-semana" class="table table-bordered table-hover dataTables">
        <thead>
            <tr>
                <th class="span1 text-center hidden-phone" rowspan="2" style="width: 10px;">#</th>
                <th rowspan="2">Nombre(s) y Apellido(s)</th>
                <th rowspan="2" class="span1 text-center hidden-phone">Tipo de PEP</th>
                <th colspan="5">Participacion en actividades de capacitacion</th>
                <th colspan="5">Participación en reuniones técnicas</th>
                <th colspan="5">Referidos efectivos</th>
            </tr>
            <tr>
                <th class="span1 text-center hidden-phone">1 sem</th>
                <th class="span1 text-center hidden-phone">2 sem</th>
                <th class="span1 text-center hidden-phone">3 sem</th>
                <th class="span1 text-center hidden-phone">4 sem</th>
                <th class="span1 text-center hidden-phone">Total</th>
                <th class="span1 text-center hidden-phone">1 sem</th>
                <th class="span1 text-center hidden-phone">2 sem</th>
                <th class="span1 text-center hidden-phone">3 sem</th>
                <th class="span1 text-center hidden-phone">4 sem</th>
                <th class="span1 text-center hidden-phone">Total</th>
                <th class="span1 text-center hidden-phone">1 sem</th>
                <th class="span1 text-center hidden-phone">2 sem</th>
                <th class="span1 text-center hidden-phone">3 sem</th>
                <th class="span1 text-center hidden-phone">4 sem</th>
                <th class="span1 text-center hidden-phone">Total</th>
                
            </tr>
        </thead>
        <tbody> 
            <?php
            if (isset($Informes->filas)) {
                $countRow = 0;
                foreach ($Informes->filas as $informe) :
                    ?>                        
                    <tr>
                        <td>
                            <?php echo $countRow += 1 ?>
                        </td>
                        <td>
                            <?php echo ($informe->NOMBRE_PROMOTOR); ?>
                        </td>
                        <td>
                            <?php echo ($informe->TIPO_PEP); ?>
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
                            <?php echo ($informe->SEM_1_REFERIDOS); ?>
                        </td>
                        <td>
                            <?php echo ($informe->SEM_2_REFERIDOS); ?>
                        </td>
                        <td>
                            <?php echo ($informe->SEM_3_REFERIDOS); ?>
                        </td>
                        <td>
                            <?php echo ($informe->SEM_4_REFERIDOS); ?>
                        </td>
                         <td>
                            <?php echo ($informe->TOTAL_REFERIDOS); ?>
                        </td>
                    </tr>
                <?php
                endforeach;
            
            ?>
        </tbody>
        <tfoot>
              <tr>
                <th class="span1 text-center hidden-phone"></th>
                <th class="span1 text-center hidden-phone"></th>
                <th class="span1 text-center hidden-phone">TOTAL</th>
                <th class="span1 text-center hidden-phone"></th>
                <th class="span1 text-center hidden-phone"></th>
                <th class="span1 text-center hidden-phone"></th>
                <th class="span1 text-center hidden-phone"></th>
                <th class="span1 text-center hidden-phone"><?php echo $Informes->ttlActividades; ?></th>
                <th class="span1 text-center hidden-phone"></th>
                <th class="span1 text-center hidden-phone"></th>
                <th class="span1 text-center hidden-phone"></th>
                <th class="span1 text-center hidden-phone"></th>
                <th class="span1 text-center hidden-phone"><?php echo $Informes->ttlReuniones; ?></th>
                <th class="span1 text-center hidden-phone"></th>
                <th class="span1 text-center hidden-phone"></th>
                <th class="span1 text-center hidden-phone"></th>
                <th class="span1 text-center hidden-phone"></th>
                <th class="span1 text-center hidden-phone"><?php echo $Informes->ttlReferidos; ?></th>
            </tr>
        </tfoot>
        <?php } ?>
    </table>
</form>
