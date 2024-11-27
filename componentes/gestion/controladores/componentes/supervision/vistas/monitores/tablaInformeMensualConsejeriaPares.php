<form id="form-datos-contacto-alcanzados" onsubmit="return false;" >
     <table id="tabla-contactos-registrados-semana" class="table table-bordered table-hover dataTables">
        <thead>
            <tr>
                <th class="span1 text-center hidden-phone"></th>
                <th colspan="2" class="span1 text-center hidden-phone">Nro. Personas Alcanzadas</th>
                <th colspan="3" class="span1 text-center hidden-phone"></th>
                
            </tr>
            <tr>
                <th class="span1 text-center hidden-phone">Nombre  del/a consejero/a</th>
                <th class="span1 text-center hidden-phone">N</th>
                <th class="span1 text-center hidden-phone">R</th>
                <th class="span1 text-center hidden-phone">Cantidad Preservativos</th>
                <th class="span1 text-center hidden-phone">Cantidad Lubricantes</th>
                <th class="span1 text-center hidden-phone">Cantidad Pastilleros</th>
            </tr>
        </thead>
        
        <tbody> 
        <?php if( isset($Informe) ) {
            
            
                    foreach ($Informe as $informe) : ?>                        
                <tr>
                    <td><?php echo ($informe->NOMBRE_CONSEJERO); ?> </td>
                    <td><?php echo ($informe->NUEVOS); ?> </td>
                    <td><?php echo ($informe->RECURRENTES); ?> </td>
                    <td><?php echo ($informe->CONDONES); ?> </td>
                    <td><?php echo ($informe->LUBRICANTES); ?> </td>
                    <td><?php echo ($informe->PASTILLEROS); ?> </td>
                    
                </tr>
        <?php endforeach;
        }?>
        </tbody>
    </table>
</form>
