<form id="form-encabezado-filtros" method="post" class="form-inline" onsubmit="return false;">  
    <!-- General Forms Block -->
    <div class="block block-themed block-last">
        <!-- General Forms Title -->
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>   Filtros de Busqueda</h4>    
        </div>

        <div class="block-content">        
            <div class="row-fluid">
                <div class="span6">
                    <div class="control-group">
                        <label class="control-label">Provincia</label>
                        <div id="lista-provincia" class="controls">
                            <select id="provincia-chosen" name="provincia-chosen" class="select-chosen focused span12" >
                                <option value >Todos</option>
                                <?php
                                foreach ($provincias as $provincia) {
                                    $selected = "";
                                    if (isset($datos)) {
                                        if ($provincia->ID_PROVINCIA == $datos->ID_PROVINCIA) {
                                            $selected = " selected ";
                                        }
                                    }
                                    ?>
                                    <option value="<?php echo $provincia->ID_PROVINCIA ?>" <?php echo $selected ?> ><?php echo htmlentities($provincia->NOMBRE_PROVINCIA) ?></option>
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
                                <option value >Todos</option>
                                <?php
                                foreach ($cantones as $canton) {
                                    $selected = "";
                                    if (isset($datos)) {
                                        if ($canton->ID_CANTON == $datos->ID_CANTON) {
                                            $selected = " selected ";
                                        }
                                    }
                                    ?>
                                    <option value="<?php echo $canton->ID_CANTON ?>"><?php echo htmlentities($canton->NOMBRE_CANTON) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row-fluid">
                <div class="span6">
                    <div class="control-group">
                        <label class="control-label">Tipo Lugar</label>
                        <div id="lista-provincia" class="controls">
                            <select id="tipo-lugar" name="tipo-lugar" class="select-chosen focused span12" >
                                <option value >Todos</option>
                                <?php
                                foreach ($Tipo as $tipo) {
                                    $selected = "";
                                    if (isset($datos)) {
                                        if ($tipo->ID_TIPOLUGAR == $datos->ID_TIPOLUGAR) {
                                            $selected = " selected ";
                                        }
                                    }
                                    ?>
                                    <option value="<?php echo $tipo->ID_TIPOLUGAR ?>"><?php echo htmlentities($tipo->CODIGO_TIPOLUGAR) ?></option>
                                    <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-actions" style="text-align: center;">
                <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> LIMPIAR </button>
                <button id="btn_busqueda" type="submit" class="btn btn-success"><i class="icon-ok"></i> BUSCAR</button>
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

