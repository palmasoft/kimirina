
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-notes_2 themed-color"></i> Formulario de Alcance a Pares TS<br><small>Registro Diario de Trabajo de Alcance a pares Trabajadores Sexuales</small></h1>
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
            <a href="#">Formularios</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">Alcance a TS</a></li>
    </ul>
    <!-- END Breadcrumb -->




    <form id="form-trabajo-alcance-pares-ts" class="form-inline" >

        <div class="block block-themed block-last">
            <div class="block-title">
                <h4>HOJA DIARIA PARA EL TRABAJO DE ALCANCE A PARES</h4>
            </div>
            <div class="block-content">               
                <div class="row-fluid " >
                    <div class=" span6">
                        <div class=" control-group span12">
                            <label class="control-label span4" for="horizontal-select" >Promotor(a):</label>
                            <div class="controls span8">
                                <select name="promotora" onchange="crearlink(this.form)"  class="span12">
                                    <option value >seleccione el promotor(a)</option>
                                    <?php foreach ($Animadores as $animador): ?>
                                <?php
                                $selected = "";
                                if (isset($datosAlcanceTS)) {
                                    if ($animador->ID_PERSONA == $datosAlcanceTS->ID_PERSONA) {
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
                    <div class="span6">
                        <div class="control-group span12 ">
                            <label class="control-label span4" for="horizontal-select"> Fecha Alcance:</label>
                            <div class="controls span8">
                                <input name="fechaAlcance" value="" class="input-datepicker" class="span12" />                         
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row-fluid " >
                    <div class=" span6">

                        <div class=" control-group ">
                            <label class="control-label span4" for="horizontal-select" >Provincia</label>
                            <div class="controls span8">
                                <select   name="provincia" onchange="alert('cambiando');">
                                    <option value >Seleccione la Provincia</option>
                                    <?php foreach ($provincias as $provincia) { ?>
                                        <option value="<?php echo $provincia->ID_PROVINCIA ?>"><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
                                    <?php } ?> 
                                </select>                         
                            </div>
                        </div>


                        <div class=" control-group ">
                            <label class="control-label span4" for="horizontal-select" >Parroquia</label>
                            <div class="controls span8">
                                <select name="parroquia" onchange="crearlink(this.form)">
                                    <option value >Seleccione la Parroquia</option>
                                    <?php foreach ($parroquias as $parroquia) { ?>
                                        <option value="<?php echo $parroquia->ID_PARROQUIA ?>"><?php echo ($parroquia->NOMBRE_PARROQUIA) ?></option>
                                    <?php } ?>
                                </select> 
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="control-group ">
                            <label class="control-label span4" for="horizontal-select">Cantón</label>
                            <div class="controls span8">
                                <select   name="canton" onchange="crearlink(this.form)">
                                    <option value >Seleccione el Canton</option>
                                    <?php foreach ($cantones as $canton) { ?>
                                        <option value="<?php echo $canton->ID_CANTON ?>"><?php echo ($canton->NOMBRE_CANTON) ?></option>
                                    <?php } ?>
                                </select> 
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>

        <div class="block block-themed block-last">
            <div class="block-title">
                <h4>1.LUGAR DE ABORDAJE</h4>
            </div>
            <div class="block-content">
                <div class="control-group form-horizontal">
                    <label class="control-label" for="horizontal-select">Tipo de Lugar: </label>
                    <div class="controls">
                        <select name="TipolugarArbodaje" onchange="crearlink(this.form)" class="span6">
                            <option value >seleccione el tipo de lugar</option>
                            <?php foreach ($TiposLugares as $tipoLugar) { ?>
                                <option value="<?php echo $tipoLugar->ID_TIPOLUGAR ?>"><?php echo ($tipoLugar->NOMBRE_TIPOLUGAR) ?></option>
                            <?php } ?> 
                        </select>
                    </div>
                </div>
            </div>
        </div>





        <div class="block block-themed block-last">
            <div class="block-title">
                <h4>2. DATOS DE LA PERSONA ALCANZADA</h4>
            </div>
            <div class="block-content">


                <div class="control-group form-horizontal">
                    <label class="control-label" for="horizontal-select">Codigo </label>
                    <div class="controls">
                        <input type="text" name="nombrePersona" style="width:100%" required="required" />
                    </div>
                </div>

                <div class="control-group form-horizontal">
                    <label class="control-label" for="horizontal-select">Nombre/Apellido Legal</label>
                    <div class="controls">
                        <input type="text" name="nombrePersona" style="width:100%" />
                    </div>
                </div>

                <div class="control-group form-horizontal">
                    <label class="control-label" for="horizontal-select">Nombre/Apellido de Trabajo</label>
                    <div class="controls">
                        <input type="text" name="nombrePersona" style="width:100%" />
                    </div>
                </div>
                <div class="control-group form-horizontal">
                    <label class="control-label" for="horizontal-select">C.I.</label>
                    <div class="controls">
                        <input type="number" name="nombrePersona" style="width:100%" />
                    </div>
                </div>
                <div class="control-group form-horizontal">
                    <label class="control-label" for="horizontal-select">Celular</label>
                    <div class="controls">
                        <input type="number" name="celular" style="width:100%" />
                    </div>
                </div>
                <div class="control-group form-horizontal">
                    <label class="control-label" for="horizontal-select">Fecha Nacimiento</label>
                    <div class="controls">
                        <input type="date" name="fechaNacimiento" style="width: 100%"/>
                    </div>
                </div>
                <div class="control-group form-horizontal">
                    <label class="control-label" for="horizontal-select">Nivel de Eduacion</label>
                    <div class="controls"> 
                        <select name="nivel" onchange="crearlink(this.form)"  style="width: 100%">
                            <option value="ninguna">Ninguna</option>
                            <option value="basica">Básica</option>
                            <option value="bachillerato">Bachillerato</option>
                            <option value="superior">Superior</option>
                        </select>
                    </div>
                </div>


            </div>
        </div>


        <div class="block block-themed block-last">
            <div class="block-title">
                <h4>3. TEMAS CONVERSADOS</h4>
            </div>
            <div class="block-content">
                <div style=" text-align: center;">
                    <?php foreach ($Temas as $temas) { ?>
                        <label for="checkbox"> 
                            <input type="checkbox" id="<?php echo ($temas->ID_TEMA)?>" name="checkbox" 
                                   class="input-themed" value="<?php echo ($temas->TITULO_TEMA)?>">
                                       <?php echo ($temas->TITULO_TEMA)?>
                        </label>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>          


        <div class="block block-themed block-last">
            <div class="block-title">
                <h4>4. MATERIAL ENTREGADO</h4>
            </div>
            <div class="block-content">
                <div class="row-fluid" >
                    <?php
                    foreach ($Insumos as $insumo) {
                        echo '
                                <div class=" span3" >
                                <div class="control-group">
                                    <label class="control-label" for="columns-text">' . $insumo->NOMBRE_INSUMO . '</label>
                                    <div class="controls">
                                        <input type="number" id="columns-text" name="columns-text" placeholder="0" min="1" style="width:100%"  >                                        
                                    </div>
                                </div>
                                </div>';
                    }
                    ?>
                </div>
            </div>
        </div>


        <div class="block block-themed block-last">
            <div class="block-title">
                <h4>5. PREGUNTAS DE LA PERSONA ALCANZADA</h4>
            </div>
            <div class="block-content">                        
                <textarea style="width: 100%;"></textarea>
            </div>
        </div>



        <div class="block block-themed block-last">
            <div class="block-title">
                <h4>6. RESPUESTAS DE LA PROMOTORA</h4>
            </div>
            <div class="block-content">
                <textarea style="width: 100%;"></textarea>
            </div>
        </div>



        <div class="block block-themed block-last">
            <div class="block-title">
                <h4>7. SERVICIOS DE SALUD</h4>
            </div>
            <div class="block-content">

                <div class="control-group form-horizontal">
                    <label class="control-label" for="horizontal-select">Fue atendido en un Servicio de Salud?</label>
                    <div class="controls"> 
                        <label for="general-themed-radio1">
                            <input type="radio" id="general-themed-radio1" name="general-radios" class="input-themed" value="Si"> Si
                        </label>
                        <label for="general-themed-radio2">
                            <input type="radio" id="general-themed-radio2" name="general-radios" class="input-themed" value="No"> No
                        </label>
                    </div>
                </div>



                <div class="control-group form-horizontal">
                    <label for="fechaAtencion" class="control-label  "  >Fecha Atención: </label>
                    <div class="controls"> 
                        <input type="date" class="" name="fechaAtencion" />
                    </div>
                </div>




                <div class="control-group form-horizontal">
                    <label class="control-label" for="horizontal-select">Nombre del Servicio de Salud</label>
                    <div class="controls"> 
                        <select name="centro_salud" onchange="crearlink(this.form)"  style="width: 100%">
                            <option value >Seleccione el Centro de Salud</option>
                            <?php foreach ($serviciosSalud as $servicio) { ?>
                                <option value="<?php echo $servicio->ID_SERVICIO ?>"><?php echo ($servicio->NOMBRE_SERVICIO) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="control-group form-horizontal">
                    <label class="control-label" for="horizontal-select">Centro de Salud</label>
                    <div class="controls"> 
                        <select name="centro_salud" onchange="crearlink(this.form)"  style="width: 100%">
                            <option value >Seleccione el Centro de Salud</option>
                            <?php foreach ($centrosSalud as $centro) { ?>
                                <option value="<?php echo $centro->ID_CENTROSERVICIO ?>"><?php echo ($centro->NOMBRE_CENTROSERVICIO) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>



            </div>

        </div>










        <div class="form-actions">
            <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Reset</button>
            <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Submit</button>
        </div>                


    </form>





    <div class="block block-themed block-last">
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Carga de Archivos"><i class="icon-arrow-up"></i></a>  Carga de Archivos de Soporte <small>Solo debe <code>arrastrar y soltar</code> sobre el recuadro, los archivos escaneados de los formularios!</small></h4>
        </div>

        <div class="block-content ">
            <form action="archivos.php" class="dropzone">
                <div class="fallback">
                    <input type="file" id="file3" name="file3" multiple>
                </div>
            </form>
        </div>
    </div>


</div>



<script>
    $(document).ready(function() {
    
    
        $(".dropzone").dropzone();

    });	
</script>


