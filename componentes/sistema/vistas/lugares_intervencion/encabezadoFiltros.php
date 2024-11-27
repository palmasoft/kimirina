
<form id="form-encabezado-filtros" method="post" class="form-inline" onsubmit="return false;">  
    <div class="block block-themed">
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>   Filtros de Busqueda</h4>    
        </div>

        <div class="block-content">        
            <div class="row-fluid">
                <div class="span4">
                    <div class="control-group">
                        <label class="control-label">Provincia</label>
                        <div id="lista-provincia" class="controls">
                            <select id="provincia-chosen" name="provincia-chosen" class="select-chosen focused span12" >
                                <option value >Todos</option>
                                <?php
                                foreach ($provincias as $provincia) {
                                    $selected = "";
                                    if (isset($datos_filtro)) {
                                        if ($provincia->ID_PROVINCIA == $datos_filtro->ID_PROVINCIA) {
                                            $selected = " selected ";
                                        }
                                    }
                                    ?>
                                    <option value="<?php echo $provincia->ID_PROVINCIA ?>" <?php echo $selected ?> ><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="span4">
                    <div class="control-group">
                        <label class="control-label">Cantón</label>
                        <div id="listado-cantones" class="controls">
                            <select id="sel-lista-cantones" name="sel-lista-cantones" class="select-chosen "  style="width: 100%;" >
                                <option value >Todos</option>
                                <?php
                                foreach ($cantones as $canton) {
                                    $selected = "";
                                    if (isset($datos_filtro)) {
                                        if ($canton->ID_CANTON == $datos_filtro->ID_CANTON) {
                                            $selected = " selected ";
                                        }
                                    }
                                    ?>
                                    <option value="<?php echo $canton->ID_CANTON ?>" <?php echo $selected ?>  ><?php echo ($canton->NOMBRE_CANTON) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="span4">
                    <div class="control-group">
                        <label class="control-label">Tipo Lugar</label>
                        <div id="lista-provincia" class="controls">
                            <select id="tipo-lugar" name="tipo-lugar" class="select-chosen focused span12" >
                                <option value >Todos</option>
                                <?php
                                foreach ($tipoLugares as $tipo) {
                                    $selected = "";
                                    if (isset($datos_filtro)) {
                                        if ($tipo->ID_TIPOLUGAR == $datos_filtro->ID_TIPOLUGAR) {
                                            $selected = " selected ";
                                        }
                                    }
                                    ?>
                                    <option value="<?php echo $tipo->ID_TIPOLUGAR ?>" <?php echo $selected ?> ><?php echo ($tipo->NOMBRE_TIPOLUGAR) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions" style="text-align: center;">
                <button id="btn_busqueda" type="submit" class="btn btn-success"><i class="icon-search"></i> BUSCAR</button>
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

        $('#form-encabezado-filtros').submit(function(event) {
            if (event.handled !== true) {

                event.handled = true;
            }
            return false;
        });
    });
</script>

