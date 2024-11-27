<style>
    label {
        font-size: 12px;
    }      
</style>


<div class="block block-themed">
    <div class="block-title"><h4>Formulario de Contacto por Animador</h4></div>
    <div class="block-content "> 
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">                    
                    <div class="control-label" for="num_recibo" style="font-size: 150%;" ><strong>Recibo No.</strong>
                        <?php echo ($datosContactoAnimador->NO_RECIBO_CONTACTOANIMADOR); ?>-
                        <?php echo ($datosContactoAnimador->CODIGO_SUBRECEPTOR_CONTACTOANIMADOR); ?>                   
                    </div>  
                </div>
            </div>

            <div class="span6">
                <div class="control-group">                    
                    <div class="control" for="tipo_pemar"  style="font-size: 150%;"><strong>Población Codigo : <span id="cod_tipo_poblacion" > [<?php echo $datosContactoAnimador->TIPO_FORMATO_CONTACTOANIMADOR; ?>]</span></strong></div>
                        <div><?php echo ($datosContactoAnimador->NOMBRE_TIPOPOBLACION); ?>                     
                    </div>         
                </div>
            </div>
        </div>    
    </div>
</div>

<div class="row-fluid" >
    <div class="span6">



        <div class="block block-themed">
            <div class="block-title"><h4> Abordaje</h4></div>
            <div class="block-content full"> 
                <div class="row-fluid">

                    <div class="span6">
                        <label class="control-label fondo_recibo_azul" for="hora" >Hora</label>
                        <div class="controls" >
                            <div>
                                <?php echo $datosContactoAnimador->HORA_CONTACTOANIMADOR; ?>
                                <span class="add-on"><i class="icon-time"></i></span>
                            </div>
                        </div>   
                    </div>

                    <div class="span2">
                        <label class="control-label fondo_recibo_azul" for="dia-contacto"> Dia</label>                    
                        <div class="controls">                                
                            <?php echo $datosContactoAnimador->DIA_CONTACTOANIMADOR; ?>
                        </div>  
                    </div>

                    <div class="span2">
                        <label class="control-label fondo_recibo_azul" for="mes-contacto"> Mes </label>                    
                        <div class="controls">
                            <?php echo $datosContactoAnimador->MES_CONTACTOANIMADOR; ?>
                        </div>  
                    </div>

                    <div class="span2">
                        <label class="control-label fondo_recibo_azul" for="ano-contacto"> Año</label>                    
                        <div class="controls">      
                            <?php echo $datosContactoAnimador->ANO_CONTACTOANIMADOR; ?>
                        </div>  
                    </div>

                </div>  


                <div class="row-fluid">

                    <div class="span6">
                        <label class="control-label fondo_recibo_azul" for="provincia">Provincia</label>                    
                        <div class="controls ">
                            <?php echo ($datosContactoAnimador->NOMBRE_PROVINCIA); ?>
                        </div>     
                    </div>


                    <div class="span6">
                        <label class="control-label fondo_recibo_azul" for="ciudad_canton" >Ciudad / Canton</label>
                        <div class="controls" >
                            <?php echo ($datosContactoAnimador->NOMBRE_CANTON); ?>
                        </div>
                    </div>
                </div>  

                <div class="row-fluid">
                    <div class="control-group" >
                        <label class="control-label fondo_recibo_azul" for="lugar_abordaje" >Tipo Lugar de Abordaje</label>
                        <div class="controls" >
                            <?php echo ($datosContactoAnimador->NOMBRE_TIPOLUGAR); ?>                        
                        </div>   

                        <label class="control-label fondo_recibo_azul" for="lugar" >Lugar</label>
                        <div class="controls" >
                            <?php echo ($datosContactoAnimador->NOMBRE_LUGAR); ?>                         
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="block block-themed">
            <div class="block-title"><h4> Contacto   <?php if ($datosContactoAnimador->VERIFICADO_PEMAR == 'SI') { ?><span class="glyphicon glyphicon-check" title="verificado" ></span>VERIFICADO<?php } else { ?><span class="glyphicon glyphicon-unchecked"  title="no verificado" ></span>NO VERIFICADO<?php } ?></h4></div>
            <div class="block-content"> 

                <div class="row-fluid">
                    <div class="control-group" >
                        <label class="control-label fondo_recibo_azul" for="nombre_contacto" >Nombre de Contacto</label>
                        <div class="controls" >
                            <?php
                            echo ($datosContactoAnimador->PRIMER_NOMBRE_PEMAR . ' ' . $datosContactoAnimador->SEGUNDO_NOMBRE_PEMAR . ' ' .
                            $datosContactoAnimador->PRIMER_APELLIDO_PEMAR . ' ' . $datosContactoAnimador->SEGUNDO_APELLIDO_PEMAR);
                            ?>     
                        </div>   
                    </div>
                </div>


                <div class="row-fluid">
                    <div class="control-group" >
                        <label class="control-label fondo_recibo_azul" for="codigo_contacto" >Codigo</label>
                        <div class="controls" >
                            <?php echo $datosContactoAnimador->CODIGO_UNICO_PERSONA; ?>                                    
                        </div>   
                    </div>
                </div>


                <div class="row-fluid">                     
                    <div class="span7" >
                        <label class="control-label fondo_recibo_azul" for="ced_identidad_contacto" >C.I. </label>
                        <div class="controls" >  
                            <?php echo $datosContactoAnimador->CEDULA_PEMAR; ?>                                    
                        </div>   
                    </div>                     
                    <div class="span5" >
                        <label class="control-label fondo_recibo_azul" for="" >NACIMIENTO </label>
                        <div class="controls " >
                            <?php echo $datosContactoAnimador->MES_NACIMIENTO_POBLACION; ?>/
                            <?php echo $datosContactoAnimador->ANO_NACIMIENTO_POBLACION; ?>
                        </div>   
                    </div>                     
                </div>

                <div class="row-fluid">
                    <div class="control-group" >
                        <label class="control-label fondo_recibo_azul" for="telefono_contacto" >No. Telef Fijo / Celular</label>
                        <div class="controls" >
                            <?php echo $datosContactoAnimador->TELEFONO_PEMAR; ?>
                        </div>   
                    </div>
                </div>





            </div>
        </div>



    </div>





    <div class="span6">

        <div class="block block-themed ">
            <div class="block-title">
                <h4></h4>
            </div>
            <div class="block-content">
                <div class="row-fluid" >

                    <div class="control-group inline" >
                        <div class="span4" >Tema Abordaje</div>
                        <div class="span8" >
                            <div class="controls" style=";" >                            
                                <label class="radio inline" for="tema">
                                    <?php echo $datosContactoAnimador->TITULO_TEMA; ?>
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="control-group inline" >
                        <div class="span4" >Paquetes Prevencion</div>
                        <div class="span8" >                            
                            <div class="span12">
                                <label class="control-label" for="">
                                    Condones: <?php echo $datosContactoAnimador->INSUMOS->CONDONES->CANTIDAD; ?> 
                                </label>
                            </div>
                            <div class="span12">
                                <label class="control-label" for="">
                                    Lubricantes: <?php echo $datosContactoAnimador->INSUMOS->LUBRICANTES->CANTIDAD; ?>
                                </label>
                            </div>
                            <div class="span12">
                                <label class="control-label" for="">
                                    Folletos: <?php echo $datosContactoAnimador->INSUMOS->FOLLETOS->CANTIDAD; ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="block block-themed ">
            <div class="block-title">
                <h4>Observaciones / Adicional</h4>
            </div>
            <div class="block-content">                        
                <div class="controls"> 
                    <?php echo ($datosContactoAnimador->OBSERVACIONES_CONTACTOANIMADOR); ?>
                </div>
            </div>
        </div>      

        <div class="block block-themed " style="display:none;" >
            <div class="block-title">
                <h4>REFENCIA SERVICIO DE SALUD</h4>
            </div>
            <div class="block-content">
                <div class="control-group form-horizontal">
                    <label for="fechaAtencion" class="control-label  "  >Fecha Atención: </label>
                    <div class="controls"> 

                        <div>
                            <?php echo $datosContactoAnimador->FECHA_ATENCION_CONTACTOANIMADOR; ?>
                            <span class="add-on"><i class="icon-calendar"></i></span>
                        </div>       
                        <div>
                            <?php echo $datosContactoAnimador->HORA_ATENCION_CONTACTOANIMADOR; ?>
                            <span class="add-on"><i class="icon-time"></i></span>                                                
                        </div>


                    </div>
                </div>
                <div class="control-group form-horizontal">
                    <label class="control-label" for="horizontal-select">Nombre del Servicio de Salud</label>
                    <div class="controls"> 
                        [<?php echo $datosContactoAnimador->CODIGO_SERVICIO; ?>]<?php echo ($datosContactoAnimador->NOMBRE_SERVICIO); ?>
                    </div>
                </div>

                <div class="control-group form-horizontal">
                    <label class="control-label" for="horizontal-select">Centro de Salud</label>
                    <div class="controls"> 
                        <?php echo ($datosContactoAnimador->NOMBRE_CENTROSERVICIO); ?>
                    </div>
                </div>

            </div>
        </div>



        <div class="block block-themed ">
            <div class="block-title"><h4></h4></div>
            <div class="block-content">

                <div class="control-group inline" >
                    <label class="control-label" >NOMBRE DEL ANIMADOR</label>
                    <div class="controls" >
                        <?php echo $datosContactoAnimador->NOMBRE_REAL_PERSONA; ?>                                  
                    </div>   

                </div>
            </div>
        </div>




    </div>
</div>






<div class="block block-themed block-last" >
    <div class="block-title"><h4>Soportes</h4></div>
    <div class="block-content">
        <div class="row-fluid">
            <?php
            if (!empty($datosContactoAnimador->SOPORTES))
                foreach ($datosContactoAnimador->SOPORTES as $archivos) :
                    ?>
                    <div class="span2">
                        <div class="block block-themed themed-default">
                            <div class="block-title"><h4>Archivo: <?php echo $archivos->TIPO_SOPORTE_RECIBOCONTACTO ?></h4></div>
                            <div class="block-content full">
                                <a href="javascript:void(0);" onclick="abrir_soportes('archivos/<?php echo $archivos->RUTA_SOPORTE_RECIBOCONTACTO ?>', 'Soporte del Recibo de Contacto <?php echo ($datosContactoAnimador->NO_RECIBO_CONTACTOANIMADOR); ?>.');"  >
                                    <img src="imagenes/archivos/<?php echo $archivos->TIPO_SOPORTE_RECIBOCONTACTO; ?>.png" />
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
        </div>
    </div>
</div>