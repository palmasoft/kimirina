<form id="form-datos-contacto-alcanzados" onsubmit="return false;" >
    <table id="tabla-contactos-registrados-semana" class="table table-bordered table-hover dataTable">
        <thead>
            <tr>
                <th class="span1 text-center hidden-phone" style="width: 10px;">#</th>
                <th>Dia</th>
                <th class="span1 text-center hidden-phone">Lugar</th>
                <th class="span1 text-center hidden-phone">Edad</th>
                <th class="span1 text-center hidden-phone">Sexo</th>
                <th>C.C.</th>
                <th>Nombre(s) y Apellido(s)</th>
                <th>Teléfono (cel o fijo)</th>
                <th>TS</th>
                <th class="span1 text-center hidden-phone">N / R</th>
                <th >Código contacto abordado</th>
                <th class="span1 text-center hidden-phone">Tema tratado</th>   
                <th class="span1 text-center hidden-phone">Servicio  de Salud al que deriva</th>   
                <th class="span1 text-center hidden-phone" title="Folletos">Inf</th>   
                <th class="span1 text-center hidden-phone" title="Condones">Con</th>   
                <th class="span1 text-center hidden-phone" title="Lubricantes" >Lub</th>     
                <th class="span1 text-center " title="verificado" >Ver</th>                                
            </tr>
        </thead>
        <tbody> 
            <?php if( !empty($datosRegistroSemanal->CONTACTOS) ) {
                    foreach ($datosRegistroSemanal->CONTACTOS as $contacto) : ?>                        
                <tr>
                    <td class="span1 text-center hidden-phone" style="width: 10px;">
                        #<input type="hidden" name="obserAbordaje[]" value="<?php echo ($contacto->OBSERVACIONES_CONTACTO); ?>" />
                        <input type="hidden" name="position[]" value="" />
                    </td>
                    <td>
                        <?php echo ($contacto->FECHA_CONTACTO); ?><input type="hidden" name="fecha-contacto[]" value="<?php echo ($contacto->FECHA_CONTACTO); ?>" />
                        <?php echo ($contacto->HORA_CONTACTO); ?><input type="hidden" name="hora-contacto[]" value="<?php echo ($contacto->HORA_CONTACTO); ?>" />
                    </td>
                    <td class="span1 text-center hidden-phone"><?php echo ($contacto->NOMBRE_TIPOLUGAR); ?> <?php echo ($contacto->NOMBRE_LUGAR); ?>
                        <input type="hidden" name="tipolugar-abordaje[]" value="<?php echo ($contacto->ID_TIPOLUGAR); ?>" />
                        <input type="hidden" name="lugar-abordaje[]" value="<?php echo ($contacto->ID_LUGAR); ?>" />
                    </td>
                    <td class="span1 text-center hidden-phone"><?php echo ($contacto->EDAD_CONTACTO); ?>
                        <input type="hidden" name="edadAbordaje[]" value="<?php echo ($contacto->EDAD_CONTACTO); ?>" />
                        <input type="hidden" name="anoNaceAbordaje[]" value="<?php echo ($contacto->ANO_NACIMIENTO_POBLACION); ?>" />
                        <input type="hidden" name="mesNaceAbordaje[]" value="<?php echo ($contacto->MES_NACIMIENTO_POBLACION); ?>" />
                    </td>
                    <td class="span1 text-center hidden-phone"><?php echo ( substr( $contacto->SEXO_CONTACTO, 0, 1) ); ?>
                        <input type="hidden" name="sexoAbordaje[]" value="<?php echo ($contacto->SEXO); ?>" />
                    </td>
                    <td><?php echo ($contacto->CEDULA_PEMAR); ?>
                        <input type="hidden" name="cedulaAbordaje[]" value="<?php echo ($contacto->CEDULA_PEMAR); ?>" />
                    </td>
                    <td>
                        <?php echo ($contacto->PRIMER_NOMBRE_PEMAR); ?> <?php echo ($contacto->SEGUNDO_NOMBRE_PEMAR); ?> <?php echo ($contacto->PRIMER_APELLIDO_PEMAR); ?> <?php echo ($contacto->SEGUNDO_APELLIDO_PEMAR); ?>
                        <?php echo ($contacto->OTRO_NOMBRE_PEMAR); ?>
                        <input type="hidden" name="primerNombreAbordaje[]" value="<?php echo ($contacto->PRIMER_NOMBRE_PEMAR); ?>" />
                        <input type="hidden" name="segundoNombreAbordaje[]" value="<?php echo ($contacto->SEGUNDO_NOMBRE_PEMAR); ?>" />
                        <input type="hidden" name="primerApellidoAbordaje[]" value="<?php echo ($contacto->PRIMER_APELLIDO_PEMAR); ?>" />
                        <input type="hidden" name="segundoApellidoAbordaje[]" value="<?php echo ($contacto->SEGUNDO_APELLIDO_PEMAR); ?>" />
                        <input type="hidden" name="otroNombreAbordaje[]" value="<?php echo ($contacto->OTRO_NOMBRE_PEMAR); ?>" />
                    </td>                    
                    <td>
                        <?php echo ($contacto->TELEFONO_PEMAR); ?>
                        <input type="hidden" name="telefonoAbordaje[]" value="<?php echo ($contacto->TELEFONO_PEMAR); ?>" />
                    </td>
                    <td>
                        <?php echo ($contacto->TRABAJO_SEXUAL_CONTACTO); ?>
                        <input type="hidden" name="trabajoSexualAbordaje[]" value="<?php echo ($contacto->TRABAJO_SEXUAL_CONTACTO); ?>" />
                    </td>
                    <td class="span1 text-center hidden-phone">
                        <?php echo ( substr($contacto->TIPO_ALCANCE_CONTACTO, 0, 1) ); ?>                        
                        <input type="hidden" name="alcanceAbordaje[]" value="<?php echo ($contacto->TIPO_ALCANCE_CONTACTO); ?>" />
                        <input type="hidden" name="tipoAlcanceAbordaje[]" value="<?php echo ($contacto->TIPO_RECURRENCIA_CONTACTO); ?>" />
                    </td>
                    <td >
                        <?php echo ($contacto->CODIGO_UNICO_PERSONA); ?>
                        <input type="hidden" name="codigoAbordaje[]" value="<?php echo ($contacto->CODIGO_UNICO_PERSONA); ?>" />
                    </td>
                    <td class="span1 text-center hidden-phone">
                        <?php echo ($contacto->TITULO_TEMA); ?>
                        <input type="hidden" name="temaAbordaje[]" value="<?php echo ($contacto->ID_TEMA_CONTACTO); ?>" />
                    </td>   
                    <td class="span1 text-center hidden-phone">
                        <?php echo ($contacto->NOMBRE_CENTROSERVICIO); ?>
                        <input type="hidden" name="servicioSaludAbordaje[]" value="<?php echo ($contacto->ID_CENTROSERVICIO_DERIVA); ?>" />
                        <input type="hidden" name="fechaAtencionAbordaje[]" value="<?php echo ($contacto->FECHA_ATENCION_CENTROSERVICIO); ?>" />
                        <input type="hidden" name="horaAtencionAbordaje[]" value="<?php echo ($contacto->HORA_ATENCION_CENTROSERVICIO); ?>" />
                    </td>   
                    <td class="span1 text-center hidden-phone">
                        <?php echo ($contacto->NUM_FOLLETOS); ?>
                        <input type="hidden" name="cantInfoAbordaje[]" value="<?php echo ($contacto->NUM_FOLLETOS); ?>" />
                    </td>   
                    <td class="span1 text-center hidden-phone">
                        <?php echo ($contacto->NUM_CONDONES); ?>
                        <input type="hidden" name="cantCondonesAbordaje[]" value="<?php echo ($contacto->NUM_CONDONES); ?>" />                        
                    </td>   
                    <td class="span1 text-center hidden-phone">
                        <?php echo ($contacto->NUM_LUBRICANTES); ?>
                        <input type="hidden" name="cantLubricantesAbordaje[]" value="<?php echo ($contacto->NUM_LUBRICANTES); ?>" />
                    </td>
                    <td class="span1 text-center hidden-phone">
                        <?php echo ($contacto->VERIFICADO_PEMAR); ?>
                        <input type="hidden" name="cedulaVerificada[]" value="<?php echo ($contacto->VERIFICADO_PEMAR); ?>" />
                    </td>
                </tr>
            <?php endforeach;
            }?>
        </tbody>
    </table>
</form>
