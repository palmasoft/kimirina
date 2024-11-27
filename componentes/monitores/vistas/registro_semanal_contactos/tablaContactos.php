<form id="form-datos-contacto-alcanzados" onsubmit="return false;" >
    <table id="tabla-contactos-registrados-semana" class="table table-bordered table-hover dataTable">
        <thead>
            <tr>
                <th >#</th>
                <th>Día</th>
                <th >Lugar</th>
                <th title="edad" >Ed</th>
                <th title="sexo" >Sx</th>
                <th>DNI</th>
                <th>Nombre Completo</th>
                <th>telefono</th>
                <th>TS</th>
                <th >N / R</th>
                <th >Código contacto abordado</th>
                <th >Tema tratado</th>   
                <th >Servicio  de Salud al que deriva</th>   
                <th  title="Folletos">Inf</th>   
                <th  title="Condones">Con</th>   
                <th  title="Lubricantes" >Lub</th>     
                <th class="span1 text-center " title="verificado" >Ver</th>                                
            </tr>
        </thead>
        <tbody> 
            <?php if (!empty($datosRegistroSemanal->CONTACTOS)) {
                foreach ($datosRegistroSemanal->CONTACTOS as $contacto) :
                    ?>                        
            <tr title="doble-click para modificar este alcance." alcance-id="<?php echo ($contacto->CODIGO_UNICO_PERSONA); ?>"  >
                        <td>
                            #
                        </td>
                        <td>
                            <?php echo ($contacto->FECHA_CONTACTO); ?>
        <?php echo ($contacto->HORA_CONTACTO); ?>
                        </td>
                        <td ><?php echo ($contacto->NOMBRE_TIPOLUGAR); ?> <?php echo ($contacto->NOMBRE_LUGAR); ?>
                        </td>
                        <td ><?php echo ($contacto->EDAD_CONTACTO); ?>                        
                        </td>
                        <td ><?php echo ( substr($contacto->SEXO_CONTACTO, 0, 1) ); ?>                        
                        </td>
                        <td><?php echo ($contacto->CEDULA_PEMAR); ?>                        
                        </td>
                        <td>
                            <?php echo ($contacto->PRIMER_NOMBRE_PEMAR); ?> <?php echo ($contacto->SEGUNDO_NOMBRE_PEMAR); ?> <?php echo ($contacto->PRIMER_APELLIDO_PEMAR); ?> <?php echo ($contacto->SEGUNDO_APELLIDO_PEMAR); ?>
        <?php echo ($contacto->OTRO_NOMBRE_PEMAR); ?>                        
                        </td>                    
                        <td>
        <?php echo ($contacto->TELEFONO_PEMAR); ?>                        
                        </td>
                        <td>
        <?php echo ($contacto->TRABAJO_SEXUAL_CONTACTO); ?>

                        </td>
                        <td >
        <?php echo ( substr($contacto->TIPO_ALCANCE_CONTACTO, 0, 1) ); ?>                        

                        </td>
                        <td >
        <?php echo ($contacto->CODIGO_UNICO_PERSONA); ?>

                        </td>
                        <td >
        <?php echo ($contacto->TITULO_TEMA); ?>

                        </td>   
                        <td >
        <?php echo ($contacto->NOMBRE_CENTROSERVICIO); ?>

                        </td>   
                        <td >
        <?php echo ($contacto->NUM_FOLLETOS); ?>

                        </td>   
                        <td >
        <?php echo ($contacto->NUM_CONDONES); ?>

                        </td>   
                        <td >
        <?php echo ($contacto->NUM_LUBRICANTES); ?>

                        </td>
                        <td >
        <?php echo ($contacto->VERIFICADO_PEMAR); ?>

                        </td>
                    </tr>
                <?php endforeach;
            }
            ?>
        </tbody>
    </table>

    <table id="tabla-contactos-registrados-semana-datos" class="" >    
        <tbody> 
<?php if (!empty($datosRegistroSemanal->CONTACTOS)) {
    foreach ($datosRegistroSemanal->CONTACTOS as $contacto) :
        ?>                        
                    <tr id="<?php echo ($contacto->CODIGO_UNICO_PERSONA); ?>"  >
                        <td  style="width: 10px;">
                            <input type="hidden" name="obserAbordaje[]" value="<?php echo ($contacto->OBSERVACIONES_CONTACTO); ?>" />
                            <input type="hidden" name="position[]" value="" />
                        </td>
                        <td>
                            <input type="hidden" name="fecha-contacto[]" value="<?php echo ($contacto->FECHA_CONTACTO); ?>" />
                            <input type="hidden" name="hora-contacto[]" value="<?php echo ($contacto->HORA_CONTACTO); ?>" />
                        </td>
                        <td >
                            <input type="hidden" name="tipolugar-abordaje[]" value="<?php echo ($contacto->ID_TIPOLUGAR); ?>" />
                            <input type="hidden" name="lugar-abordaje[]" value="<?php echo ($contacto->ID_LUGAR); ?>" />
                        </td>
                        <td >
                            <input type="hidden" name="edadAbordaje[]" value="<?php echo ($contacto->EDAD_CONTACTO); ?>" />
                            <input type="hidden" name="anoNaceAbordaje[]" value="<?php echo ($contacto->ANO_NACIMIENTO_POBLACION); ?>" />
                            <input type="hidden" name="mesNaceAbordaje[]" value="<?php echo ($contacto->MES_NACIMIENTO_POBLACION); ?>" />
                        </td>
                        <td >
                            <input type="hidden" name="sexoAbordaje[]" value="<?php echo ($contacto->SEXO); ?>" />
                        </td>
                        <td>
                            <input type="hidden" name="cedulaAbordaje[]" value="<?php echo ($contacto->CEDULA_PEMAR); ?>" />
                        </td>
                        <td>
                            <input type="hidden" name="primerNombreAbordaje[]" value="<?php echo ($contacto->PRIMER_NOMBRE_PEMAR); ?>" />
                            <input type="hidden" name="segundoNombreAbordaje[]" value="<?php echo ($contacto->SEGUNDO_NOMBRE_PEMAR); ?>" />
                            <input type="hidden" name="primerApellidoAbordaje[]" value="<?php echo ($contacto->PRIMER_APELLIDO_PEMAR); ?>" />
                            <input type="hidden" name="segundoApellidoAbordaje[]" value="<?php echo ($contacto->SEGUNDO_APELLIDO_PEMAR); ?>" />
                            <input type="hidden" name="otroNombreAbordaje[]" value="<?php echo ($contacto->OTRO_NOMBRE_PEMAR); ?>" />
                        </td>                    
                        <td>

                            <input type="hidden" name="telefonoAbordaje[]" value="<?php echo ($contacto->TELEFONO_PEMAR); ?>" />
                        </td>
                        <td>

                            <input type="hidden" name="trabajoSexualAbordaje[]" value="<?php echo ($contacto->TRABAJO_SEXUAL_CONTACTO); ?>" />
                        </td>
                        <td >

                            <input type="hidden" name="alcanceAbordaje[]" value="<?php echo ($contacto->TIPO_ALCANCE_CONTACTO); ?>" />
                            <input type="hidden" name="tipoAlcanceAbordaje[]" value="<?php echo ($contacto->TIPO_RECURRENCIA_CONTACTO); ?>" />
                        </td>
                        <td >

                            <input type="hidden" name="codigoAbordaje[]" value="<?php echo ($contacto->CODIGO_UNICO_PERSONA); ?>" />
                        </td>
                        <td >

                            <input type="hidden" name="temaAbordaje[]" value="<?php echo ($contacto->ID_TEMA_CONTACTO); ?>" />
                        </td>   
                        <td >

                            <input type="hidden" name="servicioSaludAbordaje[]" value="<?php echo ($contacto->ID_CENTROSERVICIO_DERIVA); ?>" />
                            <input type="hidden" name="fechaAtencionAbordaje[]" value="<?php echo ($contacto->FECHA_ATENCION_CENTROSERVICIO); ?>" />
                            <input type="hidden" name="horaAtencionAbordaje[]" value="<?php echo ($contacto->HORA_ATENCION_CENTROSERVICIO); ?>" />
                        </td>   
                        <td >

                            <input type="hidden" name="cantInfoAbordaje[]" value="<?php echo ($contacto->NUM_FOLLETOS); ?>" />
                        </td>   
                        <td >

                            <input type="hidden" name="cantCondonesAbordaje[]" value="<?php echo ($contacto->NUM_CONDONES); ?>" />                        
                        </td>   
                        <td >

                            <input type="hidden" name="cantLubricantesAbordaje[]" value="<?php echo ($contacto->NUM_LUBRICANTES); ?>" />
                        </td>
                        <td >

                            <input type="hidden" name="cedulaVerificada[]" value="<?php echo ($contacto->VERIFICADO_PEMAR); ?>" />
                        </td>
                    </tr>
    <?php endforeach;
}
?>
        </tbody>
    </table>
</form>
