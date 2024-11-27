
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Registro de Eventos Masivos<br>
        <small>Detalle de Formulario de Registro de Eventos Masivos</small>
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
            <a href="javascript:abrir_lista_registro_eventos_masivos();">Registros</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Registro de Eventos Masivos</a></li>
    </ul>
    <!-- END Breadcrumb -->


    <div class="block  block-themed" >
        <div class="block-title">
            <h4>Datos </h4>
            <div class="block-options">  
                <a href="javascript:mostrar_contenidos('gestion', 'registroEventosMasivos', 'mostar_editar_form_registro_eventos_masivos', 'id_evento_masivo=<?php echo isset($ObjEvento) ? ($ObjEvento->ID_EVENTO_MASIVO) : ''; ?>');" data-toggle="tooltip" title="Editar Evento" class="btn btn-lg btn-success"><i class="icon-pencil"></i> Editar este evento</a>
            </div>  
        </div>
        <div class="block-content"> 

            <?php // print_r($ObjEvento); ?>


            <div class="control-group">
                <div class="controls"> 


                    <div class="" style="width: 33%;float: left;" >
                        <label class="control-label" for="fechaactividad">Fecha de actividad</label>
                        <div class="controls">
                            <div class="input-prepend date " >
                                <h4>  <span class="add-on"><i class="icon-calendar"></i></span> <?php echo isset($ObjEvento) ? ($ObjEvento->FECHA_EVENTO_MASIVO) : ''; ?></h4>
                            </div>  
                        </div>
                    </div>

                    <div class="" style="width: 33%;float: left;" >
                        <label class="">Provincia</label>
                        <div id="lista-provincia" class="">
                            <h4>  <?php echo isset($ObjEvento) ? ($ObjEvento->NOMBRE_PROVINCIA) : ''; ?></h4>
                        </div>
                    </div>

                    <div class="" style="width: 33%;float: left;" >
                        <label class="">Cantón</label>
                        <div id="listado-cantones" class="">
                            <h4><?php echo isset($ObjEvento) ? ($ObjEvento->NOMBRE_CANTON) : ''; ?></h4>
                        </div>
                    </div>

                </div>
            </div>

            <!-- -->

            <!-- lugar -->

            <div class="control-group">
                <div class="controls" >

                    <div class="" style="width: 33%;float: left;" >
                        <label class="" for="inline-text">Tipo lugar</label>
                        <div class="">
                           <h4> <?php echo isset($ObjEvento) ? ($ObjEvento->NOMBRE_TIPOLUGAR) : ''; ?></h4>
                        </div>
                    </div>
<br>

                    <div class="" style="width: 33%;float: left;" >
                        <label class="" for="sitioActividad"> Lugar</label>
                        <div class="">
                            <div id="lugar_intervencion_div"  >
                              <h4>  <?php echo isset($ObjEvento) ? ($ObjEvento->NOMBRE_LUGAR) : ''; ?></h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="" style="width: 33%;float: left;" >
                        <label class="" for="responsableSitio"> Responsable Sitio</label>
                        <div class="">
                          <h4>  <?php echo isset($ObjEvento) ? ($ObjEvento->CONTACTO_LUGAR) : ''; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
                        
            <div class="control-group">
                <label class="control-label" for="referidos">Referidos efectivos a un servicio de salud</label>
                <div class="controls">
                    <h3><?php echo isset($ObjEvento) ? ($ObjEvento->NUM_EFECTIVOS_EVENTO_MASIVO) : '0'; ?></h3>
                </div>
            </div>





            <!--                Insumos-->
            <div class="control-group">
                <label class="control-label" >Insumos Entregados</label>
                <div class="controls">

                    <div style="width: 30%;float: left;text-align: center;">
                        <label class="" for="condones">Condones</label>
                        <div class="">
                            <h4><?php echo isset($ObjEvento) ? ($ObjEvento->NUM_CONDONES) : '0'; ?></h4>
                        </div>
                    </div>
                    <div style="width: 30%;float: left;text-align: center;">
                        <label class="" for="lubricantes">Lubricantes</label>
                        <div class="">
                            <h4><?php echo isset($ObjEvento) ? ($ObjEvento->NUM_LUBRICANTES) : '0'; ?></h4>
                        </div>
                    </div>
                    <div style="width: 40%;float: left;text-align: center;">
                        <label class="" for="piezascomunicativas">Piezas comunicativas</label>
                        <div class="">
                            <h4><?php echo isset($ObjEvento) ? ($ObjEvento->NUM_FOLLETOS) : '0'; ?></h4>
                        </div>
                    </div>

                </div>
            </div>


            <div class="control-group"> 
                <label class="control-label" for="empresaOrganizaActividad"> Empresa que organiza la actividad</label>
                <div class="controls">
                    <h3><?php if (isset($ObjEvento)) echo $ObjEvento->EMPRESA_ORGANIZA_ACTIVIDAD ?></h3>
                </div>
                <label class="control-label " for="idResponsableActividad">Responsable de la Actividad</label>
                <div class="controls " >
                    <div id="listado-tipo-persona" > 
                     <h3>   <?php echo isset($ObjEvento) ? ($ObjEvento->NOMBRE_ROL) : ''; ?></h3>
                    </div>
                </div>
                <div class="controls " >
                    <div id="listado-personas"   >  
                        <?php echo isset($ObjEvento) ? ("<h3>" . $ObjEvento->NOMBRE_REAL_PERSONA . " - <small>" . $ObjEvento->IDENTIFICACION_PERSONA . "</small></h3>" ) : ''; ?>
                    </div>
                </div>
            </div> 



            <div class="control-group">
                <label class="control-label" for="motivoActividad"> Motivo de la Actividad</label>
                <div class="controls">
                    <h3><?php if (isset($ObjEvento)) echo $ObjEvento->MOTIVO_EVENTO_MASIVO ?></h3>
                </div>
            </div>

        </div>        
    </div>   



    <div class="block block-themed block-last" style="" >
        <div class="block-title">
            <!--<h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Carga de Archivos"><i class="icon-arrow-up"></i></a>  Carga de Archivos de Soporte <small>Solo debe <code>arrastrar y soltar</code> sobre el recuadro, los archivos escaneados de los formularios!</small></h4>-->
            <h4>Archivos de Soporte de la Actividad <small>clic sobre la imagen para ver el archivo</small></h4>
        </div>

        <div class="block-content ">

            <?php // $this->mostrar("registroEventosMasivos/cargarArchivos", $this->datos); ?>
            
            <div class="row-fluid">
                    <?php
                    if (!empty($ObjEvento->SOPORTES)) {
                        foreach ($ObjEvento->SOPORTES as $archivos) :
                            ?>
                            <div class="span3" id="soporte_<?php echo intval($archivos->ID_SOPORTE_EVENTO_MASIVO) ?>">
                                <div class="block block-themed themed-default">
                                    <div class="block-title">
                                        <h4><?php echo basename( $archivos->RUTA_SOPORTE_EVENTO_MASIVO ) ?></h4>
                                    </div>
                                    <div class="block-content full">
                                        <a href="javascript:void(0);" onclick="abrir_soportes('archivos/<?php echo $archivos->RUTA_SOPORTE_EVENTO_MASIVO ?>', 'Soporte del Registro <?php echo ($ObjEvento->ID_EVENTO_MASIVO); ?>.');"  >
                                            <img src="imagenes/archivos/<?php echo $archivos->TIPO_SOPORTE_EVENTO_MASIVO; ?>.png" />
                                        </a>
                                    </div>
                                    <input type="hidden" name="archivo-asociado[]" value="<?php echo $archivos->ID_SOPORTE_EVENTO_MASIVO ?>" />
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



<script>
    $(document).ready(function() {
    });
</script>

<script>
    agregar_boton_ayuda('VEREVENTOSMASIVOS');
</script>