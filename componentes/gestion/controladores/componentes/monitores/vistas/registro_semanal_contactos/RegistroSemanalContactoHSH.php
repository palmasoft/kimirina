
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-notes_2 themed-color"></i>Registro Semanal de Alcances HSH<br><small>Formulario de formatos de registro semanal de alcances con Hombres que tienes Sexo con Hombres!</small></h1>
</div>
<!-- END Pre Page Content -->

<!-- Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="250">
        <li>
            <a href="index.php"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Formularios</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">Registro Semanal de Alcances HSH</a></li>
    </ul>






    <!-- END Breadcrumb -->
    <form id="form-registro-semanal-contactos" method="post" class="form-inline" onsubmit="return false;">  

        <input type="hidden" name="tipo_poblacion" value="1" />


        <center> 
            <h2>HOJA DE REGISTRO SEMANAL DE ALCANCES HSH</h2>
            <h4>PERIODO / MES: <?php $this->formularios->lista_periodos('contactos', ' periodos '); ?></h4>
            <h5>Población HSH</h5>
        </center>



        <!-- General Forms Block -->
        <div class="block block-themed block-last">
            <!-- General Forms Title -->
            <div class="block-title">
                <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  Datos Generales del Formulario</h4>
                <div class="block-options">
                    <div class="input-prepend" style="float: right;margin: 5px 10px;" >
                        <a href="javascript:void(0)" data-toggle="tooltip" title="clic para generar el CODIGO" class="btn btn-lg btn-info"># SEGUIMIENTO <i class="glyphicon-magic"></i></a>           
                        <input type="text" id="codigo-formulario" name="codigo-formulario" placeholder="generado despues de guardar" readonly >                     
                    </div>
                </div>            
            </div>

            <div class="block-content">        
                <div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label">Provincia</label>
                            <div id="lista-provincia" class="controls">
                                <select id="provincia-chosen" name="provincia-chosen" class="select-chosen "  style="width: 100%;" >
                                    <option value >seleccione la provincia</option>
                                    <?php foreach ($provincias as $provincia) { ?>
                                        <option value="<?php echo $provincia->ID_PROVINCIA ?>"><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label">Cantón</label>
                            <div id="listado-cantones" class="controls">
                                <select id="sel-lista-cantones" name="sel-lista-cantones" class="select-chosen "  style="width: 100%;" >
                                    <option value >seleccione el canton</option>                                    
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="row-fluid">                        
                    <div class="span5">
                        <div class="control-group">
                            <label class="control-label">Nombre del Promotor</label>
                            <div class="controls">
                                <select id="promotor-formulario" name="promotor-formulario" class="select-chosen" style="width: 100%;" onchange="mostar_otro_nombre_pep();" >
                                    <option value >seleccione el promotor</option>
                                    <?php foreach ($Promotores as $animador) { ?>
                                        <option data-alias="<?php echo $animador->NOMBRE_OTRO_PERSONA ?>"  
                                                data-nombre-alias="<?php echo $animador->ALIAS_TIPOPOBLACION ?>" 
                                                data-codigo-tipo="<?php echo $animador->CODIGO_TIPOPOBLACION ?>" 
                                                value="<?php echo $animador->ID_PERSONA ?>"><?php echo ($animador->NOMBRE_REAL_PERSONA) ?></option>
                                            <?php } ?>
                                </select>
                            </div>
                        </div>                            
                    </div>
                    <div class="span3">
                        <div class="control-group">
                            <label id="alias-nombre-pep" class="control-label">Segundo Nombre </label>
                            <div class="controls">
                                <input type="text" id="alias-pep" name="alias-pep" class="soloLetras input-large "  style="width: 100%;"   placeholder="otro nombre" readonly>
                            </div>
                        </div>                            
                    </div>
                    <div class="span2">
                        <div class="control-group">
                            <label class="control-label">Semana del </label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                    <input type="text" id="fecha_contacto_inicio_semana" name="fecha_contacto_inicio_semana" class="input-datepicker-close span9" required=""   >                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="span2" style="margin-left: 0px;">
                        <div class="control-group">
                            <label class="control-label">al </label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                    <input type="text" id="fechas_contacto_fin_semana" name="fechas_contacto_fin_semana" class="input-datepicker-close span9" required=""  >                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
            <div class="form-actions" style="text-align: center;">
                <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar </button>
                <button id="btn_guardar_registro_semanal_contactos" type="submit" class="btn btn-success"><i class="icon-ok"></i> Guardar Hoja / Formato </button>
            </div>

        </div>
        
        

    </form>


        <div class="block block-themed block-last">
            <div class="block-title">
                <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Registro de Contactos"><i class="icon-arrow-up"></i></a>  Registros de PEMARs Alcanzados <small>aca se debe cliquear sobre el botón <code>Agregar Registro de Contacto</code>!</small></h4>
            </div>
            <div class="block-content text-center" style="padding: 0px;">

                


                <!-- 
                FORMULARIO DE NUEVO CONTACTO
                -->
                
                 <?php  $this->mostrar("registro_semanal_contactos/formNuevoContato", $this->datos ); ?>
                
                <form id="form-datos-contacto-alcanzados" onsubmit="return false;" >
                    <table id="tabla-contactos-registrados-semana" class="table table-bordered table-hover dataTables">
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
                                <th class="span1 text-center hidden-phone">Inf</th>   
                                <th class="span1 text-center hidden-phone">Con</th>   
                                <th class="span1 text-center hidden-phone">Lub</th>                                
                            </tr>
                        </thead>
                        <tbody>                    
                        </tbody>
                    </table>
                </form>
            
                
            
            </div>

            <!-- END div.row-fluid -->

        </div>



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

    <?php //$this->mostrar( "formularios/modal", array() ); ?>
</div>

<script>
    $(document).ready(function() {

        $(".dropzone").dropzone();

        $('#promotor-formulario').on('change', function(evt, params) {
            var miValue = $(this).val();
            if (miValue > 0) {
                $('#alias-pep').attr('value', $("#promotor-formulario option[value=" + miValue + "]").attr('data-alias'));
                $('#alias-nombre-pep').html($("#promotor-formulario option[value=" + miValue + "]").attr('data-nombre-alias'));
                $('#tipo-poblacion-pep').html($("#promotor-formulario option[value=" + miValue + "]").attr('data-codigo-tipo'));
            }
        });

        $('#form-registro-semanal-contactos').submit( function(evt, params) {
            if ($('#sel-lista-cantones').val() == '') {
                alert('Debes Selecciones un cantón.');
                return null;
            }
            
            var datosGenerales =  $(this).serialize();
            var datosContactos =  $('#form-datos-contacto-alcanzados').serialize();
            
            guardar_nuevo_form_registro_semanal_contacto(datosGenerales+"&"+datosContactos);
            
        });


        $('#provincia-chosen').on('change', function(evt, params) {
            cargar_cantones('listado-cantones', 'sel-lista-cantones', $(this).val());
        });


    });

</script>

