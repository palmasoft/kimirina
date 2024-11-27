   <table id="tbl-form-registros-semanales" class="table table-bordered table-hover dataTables">
            <thead>
                <tr>
                    <th class=" text-center">Pob</th>
                    <th class=" text-center">Desde</th>
                    <th class=" text-center">Hasta</th>
                    <th class=" text-center">Seguimiento</th>
                    <th class="">Promotor</th>
                    <th class="">Provincia</th>
                    <th class="">Canton</th>
                    <th class="">Abordajes</th>
                </tr>
            </thead>
            <tbody>
                <?php if( !empty($formularios) ){ foreach ($formularios as $formulario) { ?>
                <tr fila-id="<?php echo ($formulario->ID_REGISTROSEMANAL) ?>"  data-code="<?php echo ($formulario->NUM_REGISTROSEMANAL) ?>">
                    <td class="text-center "><?php echo ($formulario->TIPO_FORMATO_REGISTROSEMANAL) ?></td>
                    <td class="text-center "><?php echo ($formulario->SEMANA_DEL) ?></td>
                    <td class="text-center "><?php echo ($formulario->SEMANA_HASTA) ?></td>
                    <td class="text-center "><?php echo ($formulario->NUM_REGISTROSEMANAL) ?></td>
                    <td class=""><?php echo ($formulario->NOMBRE_REAL_PERSONA) ?></td>
                    <td class=""><?php echo ($formulario->NOMBRE_PROVINCIA ) ?> </td>
                    <td class=""><?php echo ($formulario->NOMBRE_CANTON ) ?></td>
                    <td class=""><?php echo ($formulario->CONTACTOS ) ?></td>                    
                </tr>
                <?php } }?>
            </tbody>
        </table>