<div >
    <center> 
        <h2>HOJA DE REGISTRO SEMANAL DE ALCANCES <?php echo ( $tipoPoblacion); ?></h2>
        <h4>PERIODO / MES: <?php echo ( $datosRegistroSemanal->PERIODO_REGISTROSEMANAL ); ?></h4>
        <h5>Población <?php echo ( $datosRegistroSemanal->TIPO_FORMATO_REGISTROSEMANAL); ?></h5>
    </center>

    <?php //( print_r($datosRegistroSemanal)); ?>

    <!-- General Forms Block -->
    <div class="block block-themed ">
        <!-- General Forms Title -->
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  Datos Generales del Formulario</h4>
            <div class="block-options">
                <div class="input-prepend" style="float: right;margin: 5px 10px;" >
                    <a href="javascript:void(0)" data-toggle="tooltip" title="numero de seguimiento para el documento fisico" class="btn btn-lg btn-info"># <i class="glyphicon-magic"></i></a>           
                    <input type="text" id="codigo-formulario" name="codigo-formulario" placeholder="generado despues de guardar" readonly value="<?php echo ( $datosRegistroSemanal->NUM_REGISTROSEMANAL); ?>" >                     
                </div>
            </div>            
        </div>

        <div class="block-content">        
            <div class="row-fluid">
                <div class="span6">
                    <div class="control-group">
                        <label class="control-label">Provincia</label>
                        <div id="lista-provincia" class="controls">
                            <?php echo ( $datosRegistroSemanal->NOMBRE_PROVINCIA); ?>
                        </div>
                    </div>
                </div>

                <div class="span6">
                    <div class="control-group">
                        <label class="control-label">Cantón</label>
                        <div id="listado-cantones" class="controls">
                            <?php echo ( $datosRegistroSemanal->NOMBRE_CANTON); ?>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row-fluid">  
                <div class="span6">
                    <div class="control-group">
                        <label class="control-label">Nombre del Promotor</label>
                        <div class="controls">
                            <?php echo ( $datosRegistroSemanal->NOMBRE_REAL_PERSONA); ?>
                        </div>
                    </div>                            
                </div>
                <div class="span3" style="display: none;" >
                    <div class="control-group">
                        <label id="alias-nombre-pep" class="control-label">Segundo Nombre </label>
                        <div class="controls">
                            <?php echo ( $datosRegistroSemanal->NOMBRE_OTRO_PERSONA); ?>
                        </div>
                    </div>                            
                </div>

                <div class="span3">
                    <div class="control-group">
                        <label class="control-label">Semana del </label>
                        <div class="controls">
                            <span class="add-on"><i class="icon-calendar"></i></span>
                            <?php echo ( $datosRegistroSemanal->SEMANA_DEL ); ?>
                        </div>
                    </div>
                </div>
                <div class="span3" style="margin-left: 0px;">
                    <div class="control-group">
                        <label class="control-label">al </label>
                        <div class="controls">
                            <span class="add-on"><i class="icon-calendar"></i></span>
                            <?php echo ( $datosRegistroSemanal->SEMANA_HASTA); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="block block-themed block-last">
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Registro de Contactos"><i class="icon-arrow-up"></i></a>  Registros de PEMARs Alcanzados <small>aca se debe cliquear sobre el botón <code>Agregar Registro de Contacto</code>!</small></h4>
        </div>
        <div class="block-content text-center" style="padding: 0px;">
            <table id="tabla-contactos-registrados-semana" class="table table-bordered table-hover dataTables">
                <thead>
                    <tr>
                        <th class="span1 text-center hidden-phone" style="width: 10px;">#</th>
                        <th>Dia</th>
                        <th class="span1 text-center hidden-phone">Lugar</th>
                        <th class="span1 text-center hidden-phone">Edad</th>
                        <th class="span1 text-center hidden-phone">Sexo</th>
                        <th>C.C.</th>
                        <th title="pemar verificado" >Ver</th>
                        <th>Nombre(s) y Apellido(s)</th>
                        <th class="cell_otro_nombre" >Otro nombre</th>
                        <th>Teléfono (cel o fijo)</th>
                        <th>TS</th>
                        <th >Código contacto abordado</th>
                        <th class="span1 text-center hidden-phone">Tema tratado</th>   
                        <th class="span1 text-center hidden-phone">Servicio  de Salud al que deriva</th>   
                        <th class="span1 text-center hidden-phone">Inf</th>   
                        <th class="span1 text-center hidden-phone">Con</th>   
                        <th class="span1 text-center hidden-phone">Lub</th>                                
                    </tr>
                </thead>
                <tbody> 
                    <?php
                    if (!empty($datosRegistroSemanal->CONTACTOS)) {
                        foreach ($datosRegistroSemanal->CONTACTOS as $contacto) :
                            ?>                        
                            <tr>
                                <td class="span1 text-center hidden-phone" style="width: 10px;"><?php echo intval($contacto->ID_REGISTRO_CONTACTO); ?></td>
                                <td><?php echo ( $contacto->FECHA_CONTACTO); ?><?php echo ($contacto->HORA_CONTACTO); ?></td>
                                <td class="span1 text-center hidden-phone"><?php echo ( $contacto->NOMBRE_TIPOLUGAR ); ?> <?php echo ( $contacto->NOMBRE_LUGAR ); ?></td>
                                <td class="span1 text-center hidden-phone"><?php echo ( $contacto->EDAD_CONTACTO); ?></td>
                                <td class="span1 text-center hidden-phone"><?php echo ( $contacto->SEXO_CONTACTO); ?></td>
                                <td><?php echo ( $contacto->CEDULA_PEMAR); ?></td>
                                <td><?php if ($contacto->VERIFICADO_PEMAR == 'SI') { ?><span class="glyphicon glyphicon-check" title="verificado" ></span><?php } else { ?><span class="glyphicon glyphicon-unchecked"  title="no verificado" ></span><?php } ?></td>
                                <td><?php echo ( $contacto->PRIMER_NOMBRE_PEMAR); ?> <?php echo ( $contacto->SEGUNDO_NOMBRE_PEMAR); ?> <?php echo ( $contacto->PRIMER_APELLIDO_PEMAR); ?> <?php echo ( $contacto->SEGUNDO_APELLIDO_PEMAR); ?></td>
                                <td class="cell_otro_nombre" ><?php echo ( $contacto->OTRO_NOMBRE_PEMAR); ?></td>
                                <td><?php echo ( $contacto->TELEFONO_PEMAR); ?></td>
                                <td><?php echo ( $contacto->TRABAJO_SEXUAL_CONTACTO); ?></td>                            
                                <td><strong><?php echo ( $contacto->CODIGO_UNICO_PERSONA); ?></strong></td>
                                <td class="span1 text-center hidden-phone"><?php echo ( $contacto->TITULO_TEMA); ?></td>   
                                <td class="span1 text-center hidden-phone"><?php echo ( $contacto->NOMBRE_CENTROSERVICIO); ?></td>   
                                <td class="span1 text-center hidden-phone"><?php echo ( $contacto->NUM_FOLLETOS); ?></td>   
                                <td class="span1 text-center hidden-phone"><?php echo ( $contacto->NUM_CONDONES); ?></td>   
                                <td class="span1 text-center hidden-phone"><?php echo ( $contacto->NUM_LUBRICANTES); ?></td>                                
                            </tr>
                            <?php
                        endforeach;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>



    <div class="block block-themed block-last">
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Carga de Archivos">
                    <i class="icon-arrow-up"></i></a> los archivos escaneados de los formularios!
            </h4>
        </div>

        <div class="block-content">
            <div class="row-fluid">
                <?php
                if (!empty($datosRegistroSemanal->SOPORTES))
                    foreach ($datosRegistroSemanal->SOPORTES as $archivos) :
                        ?>
                        <div class="span2">
                            <div class="block block-themed themed-default">
                                <div class="block-title"><h4>Archivo: <?php echo $archivos->TIPO_SOPORTE_REGISTROSEMANAL ?></h4></div>
                                <div class="block-content full">
                                    <a href="javascript:void(0);" onclick="abrir_soportes('archivos/<?php echo $archivos->RUTA_SOPORTE_REGISTROSEMANAL ?>', 'Soporte del Registro <?php echo ($datosRegistroSemanal->NUM_REGISTROSEMANAL); ?>.');"  >
                                        <img src="imagenes/archivos/<?php echo $archivos->TIPO_SOPORTE_REGISTROSEMANAL; ?>.png" />
                                    </a>
                                </div>
                            </div>
                        </div>
    <?php endforeach; ?>
            </div>
        </div>
    </div>

</div>