<form id="form-datos-contacto-alcanzados" onsubmit="return false;" >
    <table id="tabla-contactos-registrados-semana" class="table table-bordered table-hover dataTables">
        <thead>
            <tr>
                <th class=" text-center " style="width: 10px;">#</th>
                <th>Tema</th>
                <th class=" text-center " style="width: 100px;">TS</th>
                <th class=" text-center " style="width: 100px;">TRANS</th>
                <th class=" text-center " style="width: 100px;">HSH</th>
                <th class=" text-center " style="width: 100px;">TOTAL</th>
            </tr>
        </thead>
        <tbody> 
            <?php
            if (isset($Informe)) {
                $countRow = 0;
                foreach ($Informe->filas as $informe) :
                    ?>   
                    <tr>
                        <td>
                            <?php echo $countRow += 1 ?>
                        </td>
                        <td>
                            <?php echo ($informe->TITULO_TEMA) ?>
                        </td>
                        <td>
                            <?php echo $informe->TS ?>
                        </td>
                        <td>
                            <?php echo $informe->TRANS ?>
                        </td>
                        <td>
                            <?php echo $informe->HSH ?>
                        </td>
                        <td>
                            <?php echo $informe->TOTAL ?>
                        </td>
                    </tr>
                    <?php
                endforeach;
            }
            ?>
        </tbody>
    </table>
</form>
