<form id="form-datos-actividades-monitores" onsubmit="return false;" >
    <table id="tabla-actividades-monitores" class="table table-bordered table-hover dataTables">
        <thead>
            <tr>
                <th>Nombre Monitor</th>
                <th>Tipo de actividad </th>
                <th>Total de Actividades</th>                
            </tr>
        </thead>
        <tbody> 
            <?php
            if (isset($informes)) {
                $countRow = 0;
                foreach ($informes as $informe) :
                    ?>   
                    <tr>
        <!--                        <td>
                        <?php //echo $countRow += 1 ?>
                        </td>-->

                        <td rowspan="<?php echo count($informe->detalle) + 1 ?>">
                            <?php echo ($informe->NOMBRE_MONITOR) ?>
                        </td>
                        <?php foreach ($informe->detalle as $informeMonitor) { ?>
                        <tr>
                            <td>
                                <?php echo $informeMonitor->NOMBRE ?>
                            </td>
                            <td>
                                <?php echo $informeMonitor->NUMERO_ACTIVIDADES ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tr>
                    <?php
                endforeach;
            }
            ?>          
        </tbody>
    </table>
</form>
