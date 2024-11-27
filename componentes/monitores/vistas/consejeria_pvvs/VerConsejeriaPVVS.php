
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="fa-bullhorn themed-color"></i>Consejeria PVVS<br>
        <small>REGISTRO DE CONSEJERÍA DE PARES CON PERSONAS QUE VIVEN CON VIH.</small>
    </h1>
</div>
<!-- END Pre Page Content -->


<!-- Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:abrir_listado_consejerias_pvvs();">Formatos</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Consejeria PVVS</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <div class="block  block-themed" >
        <?php //print_r($datosConsejeria); ?>

        <div class="block-title" style="text-align: center;">
            <h5>COALICIÓN ECUATORIANA DE PERSONAS QUE VIVEN CON VIH (CEPVVS) </h5>
            <h6>PROYECTO “MEJORAMIENTO DE LA CALIDAD DE VIDA DE LAS PERSONAS CON VIH EN EL ECUADOR” <br /> PROYECTO ECUADOR VIH RONDA 9 FONDO MUNDIAL – FASE 2</pre></h6>
            <h4>REGISTRO DE CONSEJERÍA DE PARES CON PERSONAS QUE VIVEN CON VIH #<?php echo $datosConsejeria->NUM_CONSEJERIA; ?> </h4>
        </div>
        <div class="block-content"> 
            <!-- div.row-fluid -->
            <div class="row-fluid">
                <!-- 1st Column -->
                <div class="span6">                        
                    <div class="control-group">
                        <label class="control-label  span4" for="codigoUsuario">Codigo Usuario-A:</label>
                        <div class="controls span8">
                            <h3><?php echo $datosConsejeria->CODIGO_UNICO_PERSONA; ?> </h3>                              
                        </div>
                    </div> 

                    <div class="control-group">
                        <label class="control-label  span4" for="cedulaUsuario">Cedula o DNI:</label>
                        <div class="controls  span8">
                            <h4><?php echo $datosConsejeria->CEDULA_PEMAR; ?></h4>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" for="edadUsuario">Edad:</label>
                        <div class="controls  span8">
                            <?php echo intval($datosConsejeria->EDAD); ?> 
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" for="columns-text">Sexo:</label>
                        <div class="controls  span8">
                            <?php echo $datosConsejeria->SEXO_PERSONA; ?> 
                        </div>      
                    </div> 

                    <div class="control-group">
                        <label class="control-label  span4" >Lugar de Residencia</label>
                        <div class="controls  span8">
                            <?php echo $datosConsejeria->NOMBRE_PROVINCIA; ?> - <?php echo $datosConsejeria->NOMBRE_CANTON; ?> 
                        </div>
                    </div>
<!--
                    <div class="control-group">
                        <label class="control-label  span4" for="tiempo">Tiempo que sabe su diagnostico</label>
                        <div class="controls  span8">
                            
                        </div>
                    </div>-->

                    <div class="control-group"  style="display: none"  >
                        <label class="control-label  span4" for="telefono">Telefono (opcional)</label>
                        <div class="controls  span8">
                            <?php echo $datosConsejeria->TELEFONO_PEMAR; ?>
                        </div>
                    </div>

<!--                    <div class="control-group">
                        <label class="control-label  span4" for="correo">Correo (opcional)</label>
                        <div class="controls  span8">
                            <?php echo $datosConsejeria->CORREO_POBLACION; ?>
                        </div>
                    </div>-->

                    <div class="control-group">
                        <label class="control-label  span4" for="idEstablecimiento">Establecimiento donde recibe atención:</label>
                        <div class="controls  span8">
                            <?php echo $datosConsejeria->NOMBRE_CENTROSERVICIO; ?>
                        </div>      
                    </div>                         

                    <div class="control-group">
                        <label class="control-label  span4" >Tratamiento ARV:</label>
                        <div class="controls  span8">
                            <?php echo $datosConsejeria->TRATAMIENTO_ARV; ?>
                        </div>  
                    </div>  

                </div>
                <!-- END 1st Column -->

                <!-- 2nd Column -->
                <div class="span6">                       
                    <div class="control-group">
                        <label class="control-label  span4" for="fechaRealizacion">Fecha de Consejeria:</label>
                        <div class="controls  span8">
                            <h3><?php echo $datosConsejeria->FECHA_CONSEJERIA; ?> </h3> 
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" for="horaInicio">Hora Inicio:</label>
                        <div class="controls  span8">
                            <?php echo $datosConsejeria->HORA_INICIO; ?> 
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" for="horaFinal">Hora Fin:</label>
                        <div class="controls  span8">
                            <?php echo $datosConsejeria->HORA_FIN; ?> 
                        </div>
                    </div>

                    <div class="control-group" align="center">
                        <label class="control-label  span12" for="nroCondones">INSUMOS ENTREGADOS:</label>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" for="nroCondones">Nro. Condones</label>
                        <div class="controls  span8">
                            <h4><?php echo $datosConsejeria->INSUMOS->CONDONES->CANTIDAD; ?> </h4>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" for="nroLubricantes">Nro. Lubricantes</label>
                        <div class="controls  span8">
                            <h4><?php echo $datosConsejeria->INSUMOS->LUBRICANTES->CANTIDAD; ?> </h4>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" for="pastilleros">Pastilleros</label>
                        <div class="controls  span8">
                            <h4><?php echo $datosConsejeria->INSUMOS->PASTILLEROS->CANTIDAD; ?> </h4>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label  span4" for="materialIEC">Material de IEC</label>
                        <div class="controls  span8">
                            <h4> <?php echo $datosConsejeria->INSUMOS->MATERIAL_IEC->CANTIDAD; ?></h4>
                        </div>
                    </div>

                    <div class="control-group">    
                        <label class="control-label  span4" for="Lugar">Lugar de la consejeria:</label>
                        <div class="controls  span8">
                             <h4><?php echo $datosConsejeria->NOMBRE_LUGAR_CONSEJERIA; ?></h4> 
                        </div>
                    </div>   
                    
                    
<!--                    <div class="control-group"> 
                        <label class="control-label  span4" for="esquema_arv">Si, ¿Cúal esquema?</label>
                        <div class="controls span8" >
                            
                        </div>
                    </div>   -->


                </div>
                <!-- END 2nd Column -->
            </div>


            <div class="row-fluid form-horizontal">
                <div class="span12"> 
<!--                    <div class="control-group">
                        <label class="control-label   " for="referencia">Referencia / Contrareferencia</label>
                        <div class="controls ">
                            
                        </div>
                    </div>-->

                    <div class="control-group">
                        <label class="control-label" for="observaciones">Observaciones</label>
                        <div class="controls">
                            <?php echo $datosConsejeria->OBSERVACIONES; ?> 
                        </div>
                    </div>

                </div>   
            </div>

            <div class="row-fluid">
                <!-- 1st Column -->
                <div class="span6"> 
                    <div class="control-group">
                        <label class="control-label  span4" for="idConsejero">Nombre del consejero</label>
                        <h4><?php echo $datosConsejeria->NOMBRE_REAL_PERSONA; ?> - <small><?php echo $datosConsejeria->IDENTIFICACION_PERSONA; ?> </small></h4>
                    </div>
                </div>
                <!-- 2st Column -->
                <div class="span6"> 
<!--                    <div class="control-group">
                        <label class="control-label  span4" for="tipoAlcance">Tipo de alcance</label>
                        <div class="controls  span8">
                            
                        </div>
                    </div>-->
                </div>
            </div>

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
                if (!empty($datosConsejeria->SOPORTES))
                    foreach ($datosConsejeria->SOPORTES as $archivos) :
                        ?>
                        <div class="span2">
                            <div class="block block-themed themed-default">
                                <div class="block-title"><h4> <?php echo basename( $archivos->RUTA_SOPORTE_CONSEJERIA ) ?></h4></div>
                                <div class="block-content full">
                                    <a href="javascript:void(0);" onclick="abrir_soportes('archivos/<?php echo $archivos->RUTA_SOPORTE_CONSEJERIA ?>', 'Soporte del Registro <?php echo ($datosConsejeria->NUM_CONSEJERIA); ?>.');"  >
                                        <img src="imagenes/archivos/<?php echo $archivos->TIPO_SOPORTE_CONSEJERIA; ?>.png" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
            </div>
        </div>
    </div>

</div>



<script>
    $(document).ready(function() {

    agregar_boton_ayuda('VERCONSEJERIAS');
    });
</script>




