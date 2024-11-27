
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Recibo de Contacto PEMAR<br>
        <small>REGISTRO DE RECIBOS DE CONTACTO ENTREGADOS A LOS PEMAR.</small>
    </h1>
</div>


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
            <a href="#">Supervision</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Recibo Animador</a></li>
    </ul>
    <!-- END Breadcrumb -->
    <style>
        label {
            font-size: 12px;
        }      
    </style>

    <form id="form-contacto-animador" class="form-inline" onsubmit="return false;" >  

        <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->ID_CONTACTOANIMADOR) : ''; ?>" />
        <input type="hidden" name="alcance" value="NUEVO" />
        <input type="hidden" id="dir_archivo_soporte"  name="dir_archivo_soporte" value="" />
       
        <div class="block block-themed ">
            <div class="block-title"><h4>
                    <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                    Supervision y Control
                </h4> </div>
            <div class="block-content">

                <div class="control-group inline" >
                    <label class="control-label" >Razones de Modificacion</label>
                    <div class="controls">
                        <textarea id="razones_contacto_animador" name="razones_contacto_animador" class="span12" rows="4" required=""></textarea>
                    </div>     
                </div>
            </div>
        </div>
        <div class="block block-themed">
            <div class="block-title"><h4>Formulario de Contacto por Animador</h4></div>
            <div class="block-content "> 
                <div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">                    
                            <label class="control-label" for="num_recibo" style="font-weight: bold;font-size: 150%;" >Recibo No.</label>
                            <div class="controls" >
                                <input type="number" id="num_recibo" required="required" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->NO_RECIBO_CONTACTOANIMADOR) : str_pad($NoRecibo + 1, 9, '0', STR_PAD_LEFT); ?>" name="num_recibo" class="span8" placeholder="000000000" style="color: #ff0000;font-weight: bold;" />
                                -<input id="subreceptor" name="subreceptor" readonly="readonly" class="span2" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->CODIGO_SUBRECEPTOR_CONTACTOANIMADOR) : $_SESSION['SESION_USUARIO']->CODIGO_SUBRECEPTOR; ?>" style="font-weight: bold;font-size: 150%;"  />                                
                            </div>  
                        </div>
                    </div>

                    <div class="span6">
                        <div class="control-group">                    
                            <label class="control-label " for="tipo_pemar"  style="font-weight: bold;font-size: 100%;">Población Codigo : <strong><span id="cod_tipo_poblacion" ></span></strong></label>                    
                            <div class="controls ">
                                <select id="tipo_pemar" name="tipo_pemar" class=" select-chosen span12 required"  >
                                    <option value="" data-cod="" >Seleccione una opcion</option>
                                    <?php
                                    foreach ($TiposPemars as $tipoPemar):
                                        $selected = "";
                                        if (isset($datosContactoAnimador)) {
                                            if ($tipoPemar->ID_TIPOPOBLACION == $datosContactoAnimador->ID_TIPOPOBLACION) {
                                                $selected = " selected ";
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $tipoPemar->ID_TIPOPOBLACION ?>"  data-max-condones="<?php echo $tipoPemar->MAXIMO_CONDONES ?>" <?php echo $selected ?> title="<?php echo ($tipoPemar->CODIGO_TIPOPOBLACION) ?>" data-cod="<?php echo ($tipoPemar->CODIGO_TIPOPOBLACION) ?>">[<?php echo ($tipoPemar->CODIGO_TIPOPOBLACION) ?>] <?php echo ($tipoPemar->NOMBRE_TIPOPOBLACION) ?></option>
                                    <?php endforeach; ?>                                     
                                </select>                        
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
                                    <div class="input-prepend bootstrap-timepicker">
                                        <span class="add-on"><i class="icon-time"></i></span>
                                        <input type="text" id="horaAbordaje" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->HORA_CONTACTOANIMADOR) : ''; ?>" name="hora" class="input-timepicker span10">                                        
                                    </div>
                                </div>   
                            </div>

                            <div class="span2">
                                <label class="control-label fondo_recibo_azul" for="dia-contacto"> Dia</label>                    
                                <div class="controls">
                                    <?php $this->formularios->lista_dia('contacto', 'span10', isset($datosContactoAnimador) ? $datosContactoAnimador->DIA_CONTACTOANIMADOR : "" ); ?>
                                </div>  
                            </div>

                            <div class="span2">
                                <label class="control-label fondo_recibo_azul" for="mes-contacto"> Mes </label>                    
                                <div class="controls">
                                    <?php $this->formularios->lista_mes_contacto('contacto', 'span10', (isset($datosContactoAnimador) ? $datosContactoAnimador->MES_CONTACTOANIMADOR : "")); ?>

                                </div>  
                            </div>

                            <div class="span2">
                                <label class="control-label fondo_recibo_azul" for="ano-contacto"> Año</label>                    
                                <div class="controls">   
                                    <?php $this->formularios->lista_ano_contacto('contacto', 'span12', isset($datosContactoAnimador) ? $datosContactoAnimador->ANO_CONTACTOANIMADOR : "", 0); ?>
                                </div>  
                            </div>

                        </div>  


                        <div class="row-fluid">

                            <div class="span6">
                                <label class="control-label fondo_recibo_azul" for="provincia">Provincia</label>                    
                                <div class="controls ">
                                    <select id="provincia-chosen" name="provincia-chosen" class="select-chosen span11">
                                        <option value >seleccione una provincia</option>                          
                                        <?php foreach ($provincias as $provincia): ?>
                                            <?php
                                            $selected = "";
                                            if (isset($datosContactoAnimador)) {
                                                if ($provincia->ID_PROVINCIA == $datosContactoAnimador->ID_PROVINCIA) {
                                                    $selected = " selected ";
                                                }
                                            }
                                            ?>
                                            <option value="<?php echo $provincia->ID_PROVINCIA ?>" <?php echo $selected ?> ><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
                                        <?php endforeach; ?> 
                                    </select>
                                </div>     
                            </div>


                            <div class="span6">
                                <label class="control-label fondo_recibo_azul" for="ciudad_canton" >Ciudad / Canton</label>
                                <div class="controls" id="listado-cantones" >
                                    <select id="sel-lista-cantones" name="sel-lista-cantones" class="select-chosen span11">
                                        <option value >seleccione un cantón</option>                          
                                        <?php foreach ($cantones as $canton): ?>
                                            <?php
                                            $selected = "";
                                            if (isset($datosContactoAnimador)) {
                                                if ($canton->ID_CANTON == $datosContactoAnimador->ID_CIUDAD) {
                                                    $selected = " selected ";
                                                }
                                            }
                                            ?>
                                            <option value="<?php echo $canton->ID_CANTON ?>" <?php echo $selected ?> ><?php echo ($canton->NOMBRE_CANTON) ?></option>
                                        <?php endforeach; ?> 
                                    </select>   
                                </div>
                            </div>
                        </div>  

                        <div class="row-fluid">
                            <div class="control-group" >
                                <label class="control-label fondo_recibo_azul" for="lugar_abordaje" >Tipo Lugar de Abordaje</label>
                                <div class="controls" >
                                    <select id="tipoLugar" name="TipolugarArbodaje" class="select-chosen span12"> 
                                        <option value >seleccione un tipo de lugar</option>
                                        <?php foreach ($TiposLugares as $tipoLugar): ?>
                                            <?php
                                            $selected = "";
                                            if (isset($datosContactoAnimador)) {
                                                if ($tipoLugar->ID_TIPOLUGAR == $datosContactoAnimador->ID_TIPOLUGAR) {
                                                    $selected = " selected ";
                                                }
                                            }
                                            ?>
                                            <option value="<?php echo $tipoLugar->ID_TIPOLUGAR ?>" <?php echo $selected ?> ><?php echo ($tipoLugar->NOMBRE_TIPOLUGAR) ?></option>
                                        <?php endforeach; ?> 
                                    </select>                                
                                </div>   

                                <label class="control-label fondo_recibo_azul" for="lugar" >Lugar</label>
                                <div class="controls" >
                                    <div id="lugar_intervencion_div" >
                                        <select id="sel-lista-lugar_intervencion" name="sel-lista-lugar_intervencion" class="select-chosen span12">
                                            <option value >seleccione lugar</option>
                                            <?php foreach ($Lugares as $lugar): ?>
                                                <?php
                                                $selected = "";
                                                if (isset($datosContactoAnimador)) {
                                                    if ($lugar->ID_LUGAR == $datosContactoAnimador->ID_LUGAR) {
                                                        $selected = " selected ";
                                                    }
                                                }
                                                ?>
                                                <option value="<?php echo $lugar->ID_LUGAR ?>" <?php echo $selected ?> ><?php echo ($lugar->NOMBRE_LUGAR) ?></option>
                                            <?php endforeach; ?> 
                                        </select>       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="block block-themed">
                    <div class="block-title"><h4> Contacto </h4></div>                    
                    <div class="block-content"> 
                        <div id="resp_validar_cedula" style="display: none;">
                            <span></span>
                        </div>
                        <input type="hidden" name="idPoblacion" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->ID_POBLACION) : ''; ?>"/>
                        <div class="row-fluid">
                            <div class="control-group" >
                                <label class="control-label fondo_recibo_azul" for="nombre_contacto" >Nombre de Contacto</label>
                                <div class="controls" >
                                    <input type="text" id="primer_nombre" name="primer_nombre" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->NOMBRE_UNO_POBLACION) : ''; ?>" class="validar_cedula_codigo generadores-codigo  span2" placeholder="primer nombre" />
                                    <input type="text" id="segundo_nombre" name="segundo_nombre" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->NOMBRE_DOS_POBLACION) : ''; ?>" class="validar_cedula_codigo generadores-codigo span4" placeholder="segundo nombre"  />
                                    <input type="text" id="primer_apellido" name="primer_apellido" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->APELLIDO_UNO_POBLACION) : ''; ?>" class="validar_cedula_codigo generadores-codigo span2" placeholder="primer apellido"  />
                                    <input type="text" id="segundo_apellido" name="segundo_apellido" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->APELLIDO_DOS_POBLACION) : ''; ?>" class="validar_cedula_codigo generadores-codigo span4" placeholder="segundo apellido"  />
                                </div>   
                            </div>
                        </div>

                        <div class="row-fluid">                     
                            <div class="span7" >
                                <label class="control-label fondo_recibo_azul" for="ced_identidad_contacto" >C.I. </label>
                                <div class="controls" >  
                                    <input type="number" maxlength="11" id="ced_identidad_contacto" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->CI_POBLACION) : ''; ?>" name="ced_identidad_contacto"  class="span12 validar_cedula_codigo" placeholder="000000000000" />                    
                                </div>   
                            </div>  

                            <div class="span5" >
                                <label class="control-label fondo_recibo_azul" for="" >NACIMIENTO </label>
                                <div class="controls " >
                                    <div class="span6" >
                                        <?php $this->formularios->lista_ano('nacimiento', 'generadores-codigo validar_cedula_codigo span10', isset($datosContactoAnimador) ? $datosContactoAnimador->ANO_NACIMIENTO_POBLACION : "", $_SESSION['SESION_USUARIO']->EDAD_MINIMA); ?>
                                    </div>
                                    <div class="span6" >
                                        <?php $this->formularios->lista_mes('nacimiento', 'generadores-codigo validar_cedula_codigo span10', isset($datosContactoAnimador) ? $datosContactoAnimador->MES_NACIMIENTO_POBLACION : "" ); ?>
                                    </div>
                                </div>   
                            </div>                     
                        </div>

                        <div class="row-fluid">
                            <div class="control-group" >
                                <label class="control-label fondo_recibo_azul" for="telefono_contacto" >No. Telef Fijo / Celular</label>
                                <div class="controls" >
                                    <input type="text" id="telefono_contacto" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->NUMERO_TELEFONO_POBLACION) : ''; ?>" name="telefono_contacto"  class="span12" placeholder="" />
                                </div>   
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span10">
                                <label class="control-label fondo_recibo_azul" for="inline-text">Código único</label>
                                <div class="controls"> 
                                    <input type="text"  class="typeahead focused validar_cedula_codigo span12" id="codigo-pemar-generado" name="codigo-pemar" 
                                           style="text-transform: uppercase;font-size: 125%;text-align: center;" readonly required 
                                           value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->CODIGO_UNICO_PERSONA) : ''; ?>"/>
                                </div>
                            </div>

                            <div class="span2" >
                                <label class="control-label fondo_recibo_azul" for="inline-text">N/R</label>
                                <div class="controls">
                                    <input type="text" id="tipo-recurrencia-contacto" name="tipo-recurrencia-contacto" value="N" class="span12"  readonly />
                                    <input type="hidden" id="tipo-alcance-contacto" name="tipo-alcance-contacto" value="NUEVO"  />
                                </div>                                    
                            </div>
                        </div>
                    </div>
                </div>


                <div class="block block-themed ">
                    <div class="block-title">
                        <h4></h4>
                    </div>
                    <div class="block-content">
                        <div class="row-fluid" >

                            <div class="control-group inline" >
                                <div class="span3" >Tema Abordaje</div>
                                <div class="span9" >
                                    <div class="controls" style="height: 80px; overflow: auto;" > 
                                        <?php
                                        foreach ($Temas as $tema) {
                                            $checked = "";
                                            if (isset($datosContactoAnimador))
                                                if ($tema->ID_TEMA == $datosContactoAnimador->ID_TEMA)
                                                    $checked = " checked ";
                                            echo '
                                                    <label class="radio inline" for="tema-recibo' . $tema->ID_TEMA . '">
                                                        <input type="radio" id="tema-' . $tema->ID_TEMA . '" name="tema-recibo" class="input-themed" value="' . $tema->ID_TEMA . '" ' . $checked . ' >' . ($tema->TITULO_TEMA) . ' 
                                                    </label>';
                                        }
                                        ?>
                                    </div>

                                </div>
                            </div>

                            <div class="control-group inline" >
                                <div class="span3" >Paquetes Prevencion</div>
                                <div class="span9" >                            
                                    <div class="control-group">
                                        <label class="control-label  span6" for="noCondones">Nro. Condones</label>
                                        <div class="controls  span6 ">
                                            <input type="number" id="cantidad-condones-entregados-contacto" name="noCondones" min="0"  max="15" 
                                                   value="<?php if (isset($datosContactoAnimador->NUM_CONDONES)) echo $datosContactoAnimador->NUM_CONDONES; ?>" class="insumos-entregados span12" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label  span6" for="noLubricantes">Nro. Lubricantes</label>
                                        <div class="controls  span6 ">
                                            <input type="number" id="cantidad-lubricantes-entregados-contacto" name="noLubricantes" min="0"
                                                   value="<?php if (isset($datosContactoAnimador->NUM_LUBRICANTES)) echo $datosContactoAnimador->NUM_LUBRICANTES; ?>"  class="insumos-entregados span12" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label  span6" for="noFolletos">Nro. Folletos</label>
                                        <div class="controls  span6">
                                            <input type="number" id="noFolletos" name="noFolletos" min="0"
                                                   value="<?php if (isset($datosContactoAnimador->NUM_FOLLETOS)) echo $datosContactoAnimador->NUM_FOLLETOS; ?>"  class="insumos-entregados span12" />
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>





            <div class="span6">


                <div class="block block-themed ">
                    <div class="block-title">
                        <h4>Observaciones / Adicional</h4>
                    </div>
                    <div class="block-content">                        
                        <div class="controls"> 
                            <textarea name="observaciones_animador" rows="21" style="width:100%;" ><?php if (isset($datosContactoAnimador->OBSERVACIONES_CONTACTOANIMADOR)) echo $datosContactoAnimador->OBSERVACIONES_CONTACTOANIMADOR; ?></textarea>
                        </div>
                    </div>
                </div>      

                <div class="block block-themed ">
                    <div class="block-title">
                        <h4>REFERENCIA SERVICIO DE SALUD</h4>
                    </div>
                    <div class="block-content">


                        <div class="control-group form-horizontal">
                            <label for="fechaAtencion" class="control-label  "  >Fecha Atención: </label>
                            <div class="controls"> 

                                <div class="input-append date input-datepicker" data-date="2014-01-01" data-date-format="yyyy-mm-dd">
                                    <input type="text" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->FECHA_ATENCION_CONTACTOANIMADOR) : ''; ?>" id="fechaAtencion" name="fechaAtencion" class="input-small">
                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                </div>       
                                <div class="input-append bootstrap-timepicker">
                                    <input type="text" value="<?php echo isset($datosContactoAnimador) ? ($datosContactoAnimador->HORA_ATENCION_CONTACTOANIMADOR) : ''; ?>" id="horaAtencion" name="horaAtencion" class="input-small input-timepicker">
                                    <span class="add-on"><i class="icon-time"></i></span>                                                
                                </div>


                            </div>
                        </div>




                        <div class="control-group form-horizontal">
                            <label class="control-label" for="horizontal-select">Nombre del Servicio de Salud</label>
                            <div class="controls">
                                <select id="servicioSalud" name="servicio_salud" style="width: 100%"  class="select-chosen" >
                                    <option value >Seleccione el Centro de Salud</option>
                                    <?php foreach ($serviciosSalud as $servicio): ?>
                                        <?php
                                        $selected = "";
                                        if (isset($datosContactoAnimador)) {
                                            if ($serviciosSalud->ID_SERVICIO == $datosContactoAnimador->ID_SERVICIO) {
                                                $selected = " selected ";
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $servicio->ID_SERVICIO ?>" <?php echo $selected ?> >[<?php echo ($servicio->CODIGO_SERVICIO) ?>] <?php echo ($servicio->NOMBRE_SERVICIO) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="control-group form-horizontal">
                            <label class="control-label" for="horizontal-select">Centro de Salud</label>
                            <div class="controls"> 
                                <select id="centroSalud" name="centro_salud"  style="width: 100%"  class="select-chosen" >
                                    <option value >Seleccione el Centro de Salud</option>
                                    <?php foreach ($centrosSalud as $centro): ?>
                                        <?php
                                        $selected = "";
                                        if (isset($datosContactoAnimador)) {
                                            if ($centrosSalud->ID_CENTROSERVICIO == $datosContactoAnimador->ID_CENTROSERVICIO) {
                                                $selected = " selected ";
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $centro->ID_CENTROSERVICIO ?>" <?php echo $selected ?> ><?php echo ($centro->NOMBRE_CENTROSERVICIO) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

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
                        <select id="promotor" name="promotor" style="width:100%;" class="select-chosen" >
                            <option value >seleccione el animador(a)</option>
                            <?php foreach ($Animadores as $animador): ?>
                                <?php
                                $selected = "";
                                if (isset($datosContactoAnimador)) {
                                    if ($animador->ID_PERSONA == $datosContactoAnimador->ID_PERSONA) {
                                        $selected = " selected ";
                                    }
                                }
                                ?>
                                <option value="<?php echo $animador->ID_PERSONA ?>" <?php echo $selected ?> ><?php echo ($animador->NOMBRE_REAL_PERSONA) ?></option>
                            <?php endforeach; ?>
                        </select>                                      
                    </div>   

                </div>
            </div>
        </div>


        <div class="form-actions">
            <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Reset</button>
            <button type="submit" id="btn_guardar_recibo_animador" class="btn btn-success" disabled="" ><i class="icon-ok"></i> Guardar</button>
        </div>


    </form>


    <div class="block block-themed block-last">
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Carga de Archivos"><i class="icon-arrow-up"></i></a>  Carga de Archivos de Soporte <small>Solo debe <code>arrastrar y soltar</code> sobre el recuadro, los archivos escaneados de los formularios!</small></h4>
        </div>

        <div class="block-content ">
            
            <?php $this->mostrar("recibo_contacto_animador/cargarArchivos", $this->datos, 'monitores'); ?>
            
        </div>
    </div>

</div>



<script>
    
    $(document).ready(function() {




        $("#form-contacto-animador").submit(function(e) {

            if ($('#tipo_pemar').val() == "") {
                alert('Debes Seleccionar el dia tipo de poblacion');
                return false;
            }

            if ($('#dia-contacto').val() == "") {
                alert('Debes Seleccionar el dia de Abordaje');
                return false;
            }

            if ($('#mes-contacto').val() == "") {
                alert('Debes Seleccionar el mes de Abordoje');
                return false;
            }

            if ($('#ano-contacto').val() == "") {
                alert('Debes Seleccionar el año de Abordaje');
                return false;
            }


            if ($('#sel-lista-cantones').val() == "") {
                alert('Debes Seleccionar el año de Abordaje');
                return false;
            }


            if ($('#tipoLugar').val() == "") {
                alert('Debes Seleccionar el tipo de lugar de Abordaje');
                return false;
            }
            
            if ($('#sel-lista-lugar_intervencion').val() == "") {
                alert('Debes Seleccionar el lugar de Abordaje');
                return false;
            }

            if ($('#primer-nombre').val() == "") {
                alert('Debes digitar un nombre');
                return false;
            }

            if ($('#primer-apellido').val() == "") {
                alert('Debes digitar un apellido');
                return false;
            }

            if ($('#segundo-apellido').val() == "") {
                alert('Debes digitar un segundo apellido');
                return false;
            }

//            if( $('#ced_identidad_contacto').val() == ""){
//                alert( 'Debes digitar una cedula' );
//                return false;
//            }

            if ($('#ano-nacimiento').val() == "") {
                alert('Debes seleccionar un año de nacimiento');
                return false;
            }

            if ($('#mes-nacimiento').val() == "") {
                alert('Debes seleccionar un mes de nacimiento');
                return false;
            }

            if ($('#tema-recibo').val() == "") {
                alert('Debes seleccionar un tema');
                return false;
            }

            if ($('#noCondones').val() == "") {
                alert('Debes seleccionar un numero de Condones');
                return false;
            }

            if ($('#noLubricantes').val() == "") {
                alert('Debes seleccionar un numero de Lubricantes');
                return false;
            }

            if ($('#noFolletos').val() == "") {
                alert('Debes seleccionar un numero de Folletos');
                return false;
            }

            if ($('#promotor').val() == "") {
                alert('Debes seleccionar un Animador');
                return false;
            }

            var datosForm = $(this).serialize();
            //alert(datosForm)           
            if (estaVacio($('#registro-id').val())) {
                ejecutarAccionJson(
                        'monitores', 'reciboContactoAnimador', 'agregar_recibo_contacto_animador',
                        datosForm, 'data, mostrar_resultado_guardar(data, "abrir_tabla_recibo_contacto_animador();", "" );'
                        );
            } else {

                ejecutarAccionJson(
                        'supervision', 'auditoriaFormularios', 'update_recibo_contacto_animador_aprobado',
                        datosForm, ' mostrar_resultado_guardar(data, "mostrar_lista_aprobados_recibos_animadores();", "" );'
                        );
            }

        });


        $('.generadores-codigo').on('change', function(e) {
            generarCodigo();
        });


        $('.insumos-entregados').on('keyup', function(e) {

            var item3 = $('#cantidad-condones-entregados-contacto').val();
            if (estaVacio(item3))
                return false;
            var item1 = $('#cantidad-lubricantes-entregados-contacto').val();
            if (estaVacio(item1))
                return false;
            if (!comprobar_relacion_3_1(item3, item1)) {
                $('#cantidad-lubricantes-entregados-contacto').val(0);
                $('#cantidad-lubricantes-entregados-contacto').focus();
                alert('la cantidad de lubricantes entregados, según los condones digitados, no es valida.');
            }
        });

        $('.insumos-entregados').on('change', function(e) {

            var item3 = $('#cantidad-condones-entregados-contacto').val();
            if (estaVacio(item3))
                return false;
            var item1 = $('#cantidad-lubricantes-entregados-contacto').val();
            if (estaVacio(item1))
                return false;
            if (!comprobar_relacion_3_1(item3, item1)) {
                $('#cantidad-lubricantes-entregados-contacto').val(0);
                $('#cantidad-lubricantes-entregados-contacto').focus();
                alert('la cantidad de lubricantes entregados, según los condones digitados, no es valida.');
            }
        });
        
        $("#tipo_pemar").on('change', function(e) {
            $('#cod_tipo_poblacion').html('[' + $('#tipo_pemar option:selected').attr('data-cod') + ']');
            $('#cantidad-condones-entregados-contacto').attr('value', $('#tipo_pemar option:selected').attr('data-max-condones') );  
            $('#cantidad-condones-entregados-contacto').attr('max', $('#tipo_pemar option:selected').attr('data-max-condones') );            
        });


        $("#num_recibo").on('change', function(e) {
            var idConCeros = rellenarCeros($(this).val(), 9, "0");
            $('#num_recibo').val(idConCeros);
        });

        $('#tipoLugar').on('change', function(e) {
            cargar_lugares_intervencion("lugar_intervencion_div", "sel-lista-lugar_intervencion", $(this).val(),$('#provincia-chosen').val(),$('#sel-lista-cantones').val())
        });

        $('#provincia-chosen').on('change', function(evt, params) {
            cargar_cantones('listado-cantones', 'sel-lista-cantones', $(this).val());
        });

        $(".validar_cedula_codigo").on('change', function(e) {

            generarCodigo();

            var cedPemar = $('#ced_identidad_contacto').val();
            var codPemar = $('#codigo-pemar-generado').val();

            if (estaVacio($('#primer_nombre').val()) && estaVacio($('#segundo_nombre').val()) && estaVacio($('#primer_apellido').val()) && estaVacio($('#segundo_apellido').val())) {
                if (estaVacio(cedPemar)) {
                    codPemar = '';
                } else {
                    if (estaVacio($('#ano-nacimiento').val()) && estaVacio($('#mes-nacimiento').val())) {
                        codPemar = '';
                    }
                }
            } else if (estaVacio($('#ano-nacimiento').val()) || estaVacio($('#mes-nacimiento').val())) {
                if (!estaVacio($('#primer_nombre').val()) || !estaVacio($('#segundo_nombre').val()) || !estaVacio($('#primer_apellido').val()) || !estaVacio($('#segundo_apellido').val())) {
                    codPemar = '';
                }
            }
            avisos_valida_cedula_codigo(cedPemar, codPemar, 'resp_validar_cedula');
            esValidaCedulaCodigo(cedPemar, codPemar, 'btn_guardar_recibo_animador');


        });


    });

    function generarCodigo() {
        var CUP = generarCodigoUnicoPemar(
                $('#primer_nombre').val(), $('#segundo_nombre').val(),
                $('#primer_apellido').val(), $('#segundo_apellido').val(),
                $('#mes-nacimiento').val(), $('#ano-nacimiento').val()
                );
        $('#codigo-pemar-generado').attr('value', CUP.toString());
        validar_tipo_alcance(CUP.toString(), 'tipo-alcance-contacto');
        cantidad_de_abordajes(CUP.toString(), 'mostrar_recurrencia_promotores');
    }



    function mostrar_recurrencia_promotores(jsonData) {

        var rRc = '';
        if (!$.isEmptyObject(jsonData)) {
            if (jsonData.ABORDAJES_ANIMADOR === 0) {
                rRc = 'N--' + jsonData.ABORDAJES_ANIMADOR + '';
            } else {
                rRc = 'R--' + jsonData.ABORDAJES_ANIMADOR + '';
            }
        } else {
            rRc = 'N--0';
        }
        $('#tipo-recurrencia-contacto').attr('value', rRc);
    }


</script>


