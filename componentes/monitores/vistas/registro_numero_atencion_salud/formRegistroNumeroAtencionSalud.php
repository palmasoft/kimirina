
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Registro de Numero de Atenciones en el Servicio de Salud<br>
        <small>Todos los registros de atencion en salud</small>
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
            <a href="javascript:abrir_listado_numero_atencion_salud();">Formularios</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Registro Numero Atencion Salud</a></li>
    </ul>
    <!-- END Breadcrumb -->
    <style>
        label {
            font-size: 12px;
        }      
    </style>

    <form id="form-registro-atencion" class="form-inline" onsubmit="return false;" >  

        <input type="hidden" id="registro-id" name="id_atencion_salud" value="<?php echo isset($registrosAtencion) ? ($registrosAtencion->ID_ATENCION_SALUD) : ''; ?>" />
        <input type="hidden" id="dir_archivo_soporte" name="dir_archivo_soporte" value="<?php echo isset($registrosAtencion) ? ($registrosAtencion->URL_DOC_ATENCION) : ''; ?>" />
        
        <div class="block block-themed ">
            <div class="block-title">
                <h4>REGISTRO DE ATENCION EN SALUD</h4>
            </div>
            <div class="block-content">

                <!-- MES Y AÑO -->
                <div class="control-group form-horizontal">
                    <label class="control-label">Año de reporte</label>
                    <div class="controls" id="listado-meses">                         
                        <?php
                        $valor = 0;
                        if (isset($registrosAtencion))
                            $valor = $registrosAtencion->ANO_ATENCIONES_SALUD;
                        $this->formularios->lista_ano_contacto('reporte', 'generadores-codigo span2 ', $valor);
                        ?>
                    </div>
                    <label class="control-label">Mes de reporte</label>
                    <div class="controls">                         
                        <?php
                        $valor = 0;
                        if (isset($registrosAtencion))
                            $valor = $registrosAtencion->MES_ATENCIONES_SALUD;
                        $this->formularios->lista_mes_contacto('reporte', 'generadores-codigo span2 ',$valor);
                        ?>
                    </div>
                </div>    
                <!-- CENTRO DE SALUD -->

                <div class="control-group form-horizontal">
                    <label class="control-label" for="horizontal-select">Centro de Salud</label>
                    <div class="controls"> 
                        <select id="centroSalud" name="centroSalud"  class="select-chosen" >
                            <option value >Seleccione el Centro de Salud</option>
                            <?php foreach ($centrosSalud as $centro): ?>
                                <?php
                                $selected = "";
                                if (isset($registrosAtencion)) {
                                    if ($centro->ID_CENTROSERVICIO == $registrosAtencion->ID_CENTROSERVICIO) {
                                        $selected = " selected ";
                                    }
                                }
                                ?>
                                <option value="<?php echo $centro->ID_CENTROSERVICIO ?>" <?php echo $selected ?> ><?php echo ($centro->NOMBRE_CENTROSERVICIO) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- TIPO DE SERVICIO -->

                <div class="control-group form-horizontal">
                    <label class="control-label" for="horizontal-select">Tipo de atencion</label>
                    <div class="controls"> 
                        <select id="tipoServicio" name="tipoServicio"  style="width: 100%"  class="select-chosen" >
                            <option value >Seleccione el tipo de servicio</option>
                            <?php foreach ($tiposServicio as $servicio): ?>
                                <?php
                                $selected = "";
                                if (isset($registrosAtencion)) {
                                    if ($servicio->ID_SERVICIO == $registrosAtencion->ID_SERVICIO) {
                                        $selected = " selected ";
                                    }
                                }
                                ?>
                                <option value="<?php echo $servicio->ID_SERVICIO ?>" <?php echo $selected ?> ><?php echo ($servicio->NOMBRE_SERVICIO) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <!-- NUMERO DE PERSONAS ATENDIDAS -->
                  <div class="control-group form-horizontal">
                    <label class="control-label" for="textarea-default">Numero Personas Atendidas</label>
                    <div class="controls">
                        <input type="number" id="numPEMAR" name="numPEMAR" value="<?php echo isset($registrosAtencion) ? ($registrosAtencion->NUMERO_PEMAR) : ''; ?>">
                    </div>
                </div>
                <!-- OBSERVACIONES -->
                <div class="control-group form-horizontal">
                    <label class="control-label" for="textarea-default">Observaciones</label>
                    <div class="controls">
                        <textarea id="observaciones" name="observaciones" value="<?php echo isset($registrosAtencion) ? ($registrosAtencion->OBSERVACIONES) : ''; ?>" rows="4"><?php echo isset($registrosAtencion) ? ($registrosAtencion->OBSERVACIONES) : ''; ?></textarea>
                    </div>
                </div>


            </div>
        </div>
       
        <div class="form-actions ">
            <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
            <button type="submit" class="btn btn-success"><i class="icon-save"></i> Guardar</button>
        </div>






    </form>

    <div class="block block-themed block-last" style="display: none;">
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Carga de Archivos"><i class="icon-arrow-up"></i></a>  Carga de Archivos de Soporte <small>Solo debe <code>arrastrar y soltar</code> sobre el recuadro, los archivos escaneados de los formularios!</small></h4>
        </div>
        <div class="block-content ">
            <?php $this->mostrar("registro_numero_atencion_salud/cargarArchivos", $this->datos); ?>
        </div>
    </div>  




</div>



<script>
    $(document).ready(function() {
        $("#form-registro-atencion").submit(function(e) {
            var datosForm = $(this).serialize();

            if (estaVacio($('#registro-id').val())) {
                ejecutarAccionJson(
                        'monitores', 'registroNumeroAtencionSalud', 'guardar_nuevo_numero_atencion_salud',
                        datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_numero_atencion_salud()", "" );'
                        );
            } else {
                ejecutarAccionJson(
                        'monitores', 'registroNumeroAtencionSalud', 'editar_numero_atencion_salud',
                        datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_numero_atencion_salud()", "" );'
                        );
            }

        });
        

    });
</script>


