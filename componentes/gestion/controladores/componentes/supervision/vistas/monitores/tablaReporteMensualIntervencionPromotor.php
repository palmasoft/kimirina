<form id="form-datos-contacto-alcanzados" onsubmit="return false;" >
    <table id="tabla-reporte-mensual-promotor" class="table table-bordered table-hover dataTables">
        <thead>
            <tr>
                <th rowspan="2">Espacios De Socializacion Y Trabajo Sexual</th>
                <th rowspan="2">Frecuencia(No.Deveces)De Espacios Visitados</th>
                <th colspan="4"></th>
            </tr>
            <tr>
                <th>TS</th>
                <th>TRANS</th>
                <th>HSH</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>             
            <?php 
            if(isset($Informe->filas)){
            foreach ($Informe->filas as $informe) : ?>    
            <tr>
                <td>
                    <?php echo ($informe->NOMBRE_TIPOLUGAR); ?>
                </td>
                <td>
                    <?php echo ($informe->FRECUENCIA); ?>
                </td>
                <td>
                    <?php echo ($informe->TS); ?>
                </td>
                <td>
                    <?php echo ($informe->TRANS); ?>
                    
                </td>
                <td>
                    <?php echo ($informe->HSH); ?>
                </td>
                <td>
                    <?php echo ($informe->TOTAL); ?>
                </td>
                </tr>   
            <?php endforeach;
            ?>
        </tbody>
        <tfoot>
            
             <tr>
                 <td colspan="2" style="">TOTAL</td>
                <th class="span1 text-center hidden-phone"><?php echo $Informe->totalTS ?></th>               
                <th class="span1 text-center hidden-phone"><?php echo $Informe->totalTRANS ?></th>
                 <th class="span1 text-center hidden-phone"><?php echo $Informe->totalHSH ?></th>
                <th class="span1 text-center hidden-phone"><?php echo $Informe->totalTS+$Informe->totalHSH+$Informe->totalTRANS ?></th>
            </tr>            
        </tfoot>
        <?php }
            ?>
    </table>
</form>