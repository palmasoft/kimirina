

<div id="pre-page-content">
    <h1>
        <i class="halflingicon-map-marker  themed-color"></i>Mapa de Unidades de Salud<br>
        <small>Mapa de todas las unidades de salud</small>
    </h1>
</div>



<div id="page-content">

    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="250">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Consultas</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Mapa de Unidades de Salud</a></li>
    </ul>


    <form id="form-encabezado-filtros" method="post" class="form-inline" onsubmit="return false;">  

        <div class="block block-themed block-last">
            <!-- General Forms Title -->
            <div class="block-title">
                <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>   Filtros de Busqueda</h4>    
                <div class="block-options" >
                    <button id="btn_busqueda" type="submit" class="btn btn-success"><i class="icon-search"></i> Consultar<span id="carga"></span></button>
                </div>
            </div>

            <div class="block-content">        
                <div class="row-fluid">
                    <div class="span4">
                        <div class="control-group">
                            <label class="control-label">Provincia</label>
                            <div id="lista-provincia" class="controls">
                                <select id="provincia-chosen" name="provincia-chosen" class="select-chosen focused span12" >
                                    <option value="" >Todos</option>
                                    <?php
                                    foreach ($provincias as $provincia) {
                                        $selected = '';
                                        if ($provincia->ID_PROVINCIA == $idProvincia) {
                                            $selected = 'selected';
                                        }
                                        ?>
                                        <option value="<?php echo $provincia->ID_PROVINCIA ?>"  <?php echo $selected ?> ><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
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
                                    <option value="" >Todos</option>
                                    <?php
                                    foreach ($cantones as $canton) {
                                        $selected = '';
                                        if ($canton->ID_CANTON == $idCanton) {
                                            $selected = 'selected';
                                        }
                                        ?>
                                        <option value="<?php echo $canton->ID_CANTON ?>"  <?php echo $selected ?> ><?php echo ($canton->NOMBRE_CANTON) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="control-group">
                            <label class="control-label">Tipos de Población</label>
                            <div id="tipo-poblaciones" class="controls">
                                <select id="sel-lista-tiposPoblacion" name="sel-lista-tiposPoblacion" class="select-chosen "  style="width: 100%;" >
                                    <option value="" >Todos</option>
                                    <?php
                                    foreach ($tiposPoblacion as $tipoPoblacion) {
                                        $selected = '';
                                        if ($tipoPoblacion->CODIGO_TIPOPOBLACION == $idTipoPob) {
                                            $selected = 'selected';
                                        }
                                        ?>
                                        <option value="<?php echo $tipoPoblacion->CODIGO_TIPOPOBLACION ?>"  <?php echo $selected ?> ><?php echo ($tipoPoblacion->CODIGO_TIPOPOBLACION . "-" . $tipoPoblacion->NOMBRE_TIPOPOBLACION) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <?php $this->mostrar("mapas/basico_centros_salud", $this->datos, "sistema"); ?>    




</div>

<script>
    $(document).ready(function() {

        $('#provincia-chosen').on('change', function(evt, params) {
            cargar_cantones('listado-cantones', 'sel-lista-cantones', $(this).val());
        });

        $('#form-encabezado-filtros').submit(function(event) {
            $('#carga').html('<img src="http://www.funcion13.com/wp-content/uploads/2012/04/loader.gif" />');

            mostrar_contenidos("agentes_campo", "mapaCentrosSalud",
                    "busqueda_mapa_centros_salud", $(this).serialize()
                    );
        });


    });
</script>



<script>
    agregar_boton_ayuda('CONSULTAMAPASALUD');
</script>