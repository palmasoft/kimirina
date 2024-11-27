

<div class="block  block-themed" >
    <div class="block-title">
        <h4>                
            <small>Actividad de Promocion y Entrega de Insumos: </small> <?php if (isset($promocionInsumos)) echo $promocionInsumos->MOTIVO_ACTIVIDAD_PROMOCION ?>
        </h4>

    </div>
    <div class="block-content">      

        <div class="row-items">
            <div class="" style="width:33%;margin: 0px;float: left;" >
                <label class="control-label" for="fechaactividad">Fecha de actividad</label>
                <div class="controls">
                    <div class="" >
                        <h4><span class="add-on"><i class="icon-calendar"></i></span> <?php if (isset($promocionInsumos)) echo $promocionInsumos->FECHA_ACTIVIDAD_PROMOCION ?></h4>
                    </div>  
                </div>
            </div>
            <!-- -->
            <div class="" style="width: 33%;margin: 0px;float: left;" >
                <label class="" >Provincia</label>
                <div id="lista-provincia" class="" >
                    <h4><?php echo $promocionInsumos->NOMBRE_PROVINCIA ?></h4>
                </div>
            </div>

            <div class="" style="width: 33%;margin: 0px;float: left;">
                <label class=""  >Cantón</label>
                <div id="listado-cantones" class="">
                    <h4><?php echo $promocionInsumos->NOMBRE_CANTON ?></h4>
                </div>
            </div>
        </div>
        <div style="clear: both;"></div>


        <!-- -->

        <!-- lugar -->

        <div class="row-items" >
            <div class="" style="width: 33%;margin: 0px;float: left;">
                <label class="" for="tipo_lugar_intervencion_contacto">Tipo de Establecimiento</label>
                <div class="">
                    <h4><?php echo ($promocionInsumos->NOMBRE_TIPOLUGAR); ?></h4>
                </div>
            </div>

            <div class="" style="width: 33%;margin: 0px;float: left;">                                       
                <label class="" for="sitioActividad"> Lugar </label>
                <div class="">
                    <div id="lugar_intervencion_div" >
                        <h4><?php echo ($promocionInsumos->NOMBRE_LUGAR); ?></h4>
                    </div>
                </div>
            </div>

            <div class=""  style="width: 33%;margin: 0px;float: left;" >
                <label class="control-label" for="responsableSitio"> Responsable Sitio</label>
                <div class="controls">
                    <?php echo isset($promocionInsumos) ? ($promocionInsumos->CONTACTO_LUGAR) : ''; ?>
                </div>
            </div> 
        </div>   
        <div style="clear: both;"></div>



        <div style="width: 45%;float: left;text-align: center;padding: 1%;border: inherit; border-top: thin solid; margin: 1%; ">
            <label class="control-label" >Número de PEMaRs Asistentes</label>
            <div class="controls">

                <div style="width: 33%;float: left;text-align: center;">
                    <label class="" for="totalhsh">HSH</label>
                    <div class="">
                        <h3> <?php echo isset($promocionInsumos) ? ($promocionInsumos->NUM_HSH_ACTIVIDAD_PROMOCION) : ''; ?></h3>
                    </div>
                </div>

                <div style="width: 33%;float: left;text-align: center;">
                    <label class="" for="totalts">TS</label>
                    <div class="">
                        <h3><?php echo isset($promocionInsumos) ? ($promocionInsumos->NUM_TS_ACTIVIDAD_PROMOCION) : ''; ?></h3>
                    </div>
                </div>

                <div style="width: 33%;float: left;text-align: center;" >  
                    <label class="" for="totaltrans">TRANS</label>
                    <div class="">
                        <h3><?php echo isset($promocionInsumos) ? ($promocionInsumos->NUM_TRANS_ACTIVIDAD_PROMOCION) : ''; ?></h3>
                    </div>
                </div>
            </div>
        </div>



        <!--                Insumos-->
        <div style="width: 45%;float: left;text-align: center;padding: 1%;border: inherit; border-top: thin solid; margin: 1%; " >
            <label class="control-label" >Insumos Entregados</label>
            <div class="controls">
                <div style="width: 33%;float: left;text-align: center;">
                    <label class="" for="condones">CONDONES</label>
                    <div class="">
                        <h3><?php echo isset($promocionInsumos) ? ($promocionInsumos->CANT_CONDONES) : ''; ?></h3>
                    </div>
                </div>
                <div style="width: 33%;float: left;text-align: center;">
                    <label class="" for="lubricantes">LUBRICANTES</label>
                    <div class="">
                        <h3><?php echo isset($promocionInsumos) ? ($promocionInsumos->CANT_LUBRICANTES) : ''; ?></h3>
                    </div>
                </div>


                <div style="width: 33%;float: left;text-align: center;">
                    <label class="" for="piezascomunicativas" style="">PIESAS COMUNICATIVAS</label>
                    <div class="">
                        <h4><?php echo isset($promocionInsumos) ? ($promocionInsumos->CANT_FOLLETOS) : ''; ?></h4>
                    </div>
                </div>

            </div>
        </div>
        <div style="clear: both;"></div>

        <div class="control-group"> 
            <h3 class="control-label " for="idResponsableActividad">Responsable de la Actividad</h3>
            <div class="controls " >                    

                <h4> <small><?php echo ($promocionInsumos->NOMBRE_ROL); ?></small> <?php echo ($promocionInsumos->NOMBRE_REAL_PERSONA); ?> <small><?php echo ($promocionInsumos->IDENTIFICACION_PERSONA); ?> </small> </h4>

            </div>
        </div> 
        <div style="clear: both;"></div>

    </div>        


    <div class="block block-themed block-last">
        <div class="block-title">
            <h4>Archivos de Soporte de la Actividad <small>clic sobre la imagen para ver el archivo</small></h4>
        </div>

        <div class="block-content ">
            <div class="row-fluid">
                <?php
                if (!empty($promocionInsumos->SOPORTES)) {
                    foreach ($promocionInsumos->SOPORTES as $archivos) :
                        ?>
                        <div id="soporte_<?php echo intval($archivos->ID_SOPORTE_ACTIVIDAD_PROMOCION) ?>" class="span3" >
                            <div class="block block-themed themed-default">
                                <div class="block-title">
                                    <h4>Archivo <?php echo intval($archivos->ID_SOPORTE_ACTIVIDAD_PROMOCION) ?>: <?php echo $archivos->TIPO_SOPORTE_ACTIVIDAD_PROMOCION ?></h4>
                                </div>
                                <div class="block-content full">
                                    <a href="javascript:void(0);" onclick="abrir_soportes('archivos/<?php echo $archivos->RUTA_SOPORTE_ACTIVIDAD_PROMOCION ?>', 'Soporte del Registro <?php echo ($promocionInsumos->ID_ACTIVIDAD_PROMOCION); ?>.');"  >
                                        <img src="imagenes/archivos/<?php echo $archivos->TIPO_SOPORTE_ACTIVIDAD_PROMOCION; ?>.png" />
                                    </a>
                                </div>
                                <input type="hidden" name="archivo-asociado[]" value="<?php echo $archivos->ID_SOPORTE_ACTIVIDAD_PROMOCION ?>" />
                            </div>
                        </div>
                        <?php
                    endforeach;
                }
                ?>
            </div>
        </div>
    </div>
</div>   
