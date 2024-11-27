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
            <a href="javascript:abrir_listado_numero_atencion_salud();">Monitores</a> <span class="divider"><i class="icon-angle-right"></i></span>
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
                        <?php echo ($registrosAtencion->ANO_ATENCIONES_SALUD); ?>
                    </div>
                    
                </div>  
                <div class="control-group form-horizontal">
                    <label class="control-label">Mes de reporte</label>
                        <div class="controls">                         
                            <?php echo ($registrosAtencion->MES_ATENCIONES_SALUD); ?>
                        </div>
                </div>
                
                <!-- CENTRO DE SALUD -->

                <div class="control-group form-horizontal">
                    <label class="control-label" for="horizontal-select">Centro de Salud</label>
                    <div class="controls"> 
                        <?php echo ($registrosAtencion->NOMBRE_CENTROSERVICIO); ?>
                    </div>
                </div>

                <!-- TIPO DE SERVICIO -->

                <div class="control-group form-horizontal">
                    <label class="control-label" for="horizontal-select">Tipo de atencion</label>
                    <div class="controls"> 
                        <?php echo ($registrosAtencion->NOMBRE_SERVICIO); ?>
                    </div>
                </div>
                <!-- NUMERO DE PERSONAS ATENDIDAS -->
                <div class="control-group form-horizontal">
                    <label class="control-label" for="textarea-default">Numero Personas Atendidas</label>
                    <div class="controls">
                        <?php echo isset($registrosAtencion) ? ($registrosAtencion->NUMERO_PEMAR) : ''; ?>
                    </div>
                </div>
                <!-- OBSERVACIONES -->
                <div class="control-group form-horizontal">
                    <label class="control-label" for="textarea-default">Observaciones</label>
                    <div class="controls">
                        <?php echo isset($registrosAtencion) ? ($registrosAtencion->OBSERVACIONES) : ''; ?>
                    </div>
                </div>


            </div>
        </div>



    </form>

    <div class="block block-themed block-last" style="display:none;">
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Carga de Archivos"><i class="icon-arrow-up"></i></a>  Carga de Archivos de Soporte <small>Solo debe <code>arrastrar y soltar</code> sobre el recuadro, los archivos escaneados de los formularios!</small></h4>
        </div>

        <div class="block-content ">
            <?php if($registrosAtencion->URL_DOC_ATENCION!=null){ ?>
                <img src="archivos/formularios/consejeriaPVVS/<?php echo $registrosAtencion->URL_DOC_ATENCION; ?>"/>
             <?php } ?>
            

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

        
    agregar_boton_ayuda('BIENVENIDA');


    });
</script>


