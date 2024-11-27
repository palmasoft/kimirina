<form id="form-encabezado-filtros" method="post" class="form-inline" onsubmit="return false;">  
    <center> 
        <h4></h4>
    </center> 
    <div class="block block-themed ">
        <!-- General Forms Title -->
        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a> 
                Filtros de Busqueda
            </h4>    
            <div class="block-options">
                PERIODO / MES: <?php $this->formularios->lista_periodos_para_informes('informe', ' periodos  select-chosen ', $Periodo ); ?>
            </div>            
        </div>

        <div class="block-content">        
            <div class="row-fluid">
                <div class="span6">
                    <div class="control-group">
                        <label class="control-label">Provincia:</label>
                        <div id="lista-provincia" class="controls">
                            <select id="provincia-chosen" name="provincia-chosen" class="select-chosen span12" >
                                <option value="" >Todos</option>
                                <?php foreach ($provincias as $provincia) { ?>
                                    <?php if($provincia->ID_PROVINCIA==$Provincia) {?>  
                                    <option value="<?php echo $provincia->ID_PROVINCIA ?>" selected><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
                                    <?php }else{?>
                                    <option value="<?php echo $provincia->ID_PROVINCIA ?>"><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
                                    <?php }?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="control-group">
                        <label class="control-label">Cantón:</label>
                        <div id="listado-cantones" class="controls">
                            <select id="sel-lista-cantones" name="sel-lista-cantones" class="select-chosen span12"  >
                                <option value="" >Todos</option>
                                <?php foreach ($cantones as $canton) { ?>
                                    <?php if($canton->ID_CANTON==$Canton) {?>  
                                    <option value="<?php echo $canton->ID_CANTON ?>" selected><?php echo ($canton->NOMBRE_CANTON) ?></option>
                                    <?php }else{?>
                                    <option value="<?php echo $canton->ID_CANTON ?>"><?php echo ($canton->NOMBRE_CANTON) ?></option>
                                    <?php }?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span6">
                    <div class="control-group">
                        <label class="control-label">Nombre del Monitor:</label>
                        <div class="controls">
                            <select id="monitor-formulario" name="monitor-formulario" class="select-chosen span12">
                                <option value="" >Todos</option>
                                <?php foreach ($Monitores as $monitor) { ?>
                                    <?php if($monitor->ID_PERSONA==$Monitor) {?>  
                                    <option data-alias="<?php echo $monitor->NOMBRE_OTRO_PERSONA ?>"
                                            value="<?php echo $monitor->ID_PERSONA ?>" selected><?php echo ($monitor->NOMBRE_REAL_PERSONA) ?></option>
                                    <?php }else{?>
                                    <option data-alias="<?php echo $monitor->NOMBRE_OTRO_PERSONA ?>"
                                            value="<?php echo $monitor->ID_PERSONA ?>"><?php echo ($monitor->NOMBRE_REAL_PERSONA) ?></option>
                                    <?php }?>
                                        <?php } ?>
                            </select>
                        </div>
                    </div>                            
                </div>
                <div class="span6">
                    <div class="control-group">
                        <label class="control-label">Nombre del Promotor:</label>
                        <div id="lista-promotores" class="controls">
                            <select id="promotor-formulario" name="promotor-formulario" class="select-chosen span12">
                                <option value="" >Todos</option>
                                <?php foreach ($Promotores as $promotor) { ?>
                                    <?php if($promotor->ID_PERSONA==$Promotor) {?>  
                                    <option data-alias="<?php echo $promotor->NOMBRE_OTRO_PERSONA ?>"
                                            value="<?php echo $promotor->ID_PERSONA ?>" selected><?php echo ($promotor->NOMBRE_REAL_PERSONA) ?></option>
                                    <?php }else{?>
                                    <option data-alias="<?php echo $promotor->NOMBRE_OTRO_PERSONA ?>"
                                            value="<?php echo $promotor->ID_PERSONA ?>"><?php echo ($promotor->NOMBRE_REAL_PERSONA) ?></option>
                                    <?php }?>
                                        <?php } ?>
                            </select>
                        </div>
                    </div>                            
                </div>
            </div>

            <div class="form-actions" style="text-align: center;">
                <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> LIMPIAR </button>
                <button id="btn_busqueda" type="submit" class="btn btn-success"><i class="icon-ok"></i> BUSCAR</button>
                <a href="javascript:generarPDF();" data-toggle="tooltip" title="Generar PDF" class="btn btn-lg btn-success"><i class="fa-file-pdf-o"></i> GENERAR PDF</a>
                <a href="javascript:generarXLS();" data-toggle="tooltip" title="Generar XLS" class="btn btn-lg btn-success"><i class="fa-file-excel-o"></i> GENERAR XLS</a>
                <span id="progreso_pdf"></span>
                <div id="carga"> </div>
            </div>
        </div>
    </div>
    <div id="div-resultado" ></div>
</form>


<script >
$(document).ready(function() {

    $('#provincia-chosen').on('change', function(evt, params) {
        cargar_cantones('listado-cantones', 'sel-lista-cantones', $(this).val());
    });

    $('#monitor-formulario').on('change', function(evt, params) {
        cargar_promotores('lista-promotores', 'promotor-formulario', $(this).val());
    });

});
</script>

