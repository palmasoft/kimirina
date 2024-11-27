
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="halflingicon-map-marker  themed-color"></i>Mapa Lugares de Intervencion<br>
        <small>Mapa de todos los lugares de intenvencion</small>
    </h1>
</div>
<!-- END Pre Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="250">
        <li>
            <a href="index.php"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Consultas</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Mapa Lugares Intervencion</a></li>
    </ul>

    <form id="form-encabezado-filtros" method="post" class="form-inline" onsubmit="return false;">  
        <div class="block block-themed block-last">
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
                                        <option value="<?php echo $provincia->ID_PROVINCIA ?>"  <?php echo $selected ?>  ><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
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
                                        <option value="<?php echo $canton->ID_CANTON ?>"  <?php echo $selected ?>  ><?php echo ($canton->NOMBRE_CANTON) ?></option>
<?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="span4">
                        <div class="control-group">
                            <label class="control-label">Tipo</label>
                            <div id="tipo-lugares" class="controls">
                                <select id="sel-lista-tipoLugares" name="tipoLugar" class="select-chosen "  style="width: 100%;" >
                                    <option value="" >Todos</option>
                                    <?php
                                    foreach ($tipoLugares as $tipoLugar) {
                                        $selected = '';
                                        if ($tipoLugar->ID_TIPOLUGAR == $idTipoLugar) {
                                            $selected = 'selected';
                                        }
                                        ?>
                                        <option value="<?php echo $tipoLugar->ID_TIPOLUGAR ?>" <?php echo $selected ?> ><?php echo ($tipoLugar->CODIGO_TIPOLUGAR) ?></option>
<?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>

    </form>


<?php $this->mostrar("mapas/basico_lugares_intervencion", $this->datos, "sistema"); ?>    




</div>
<script>
    $(document).ready(function() {



        $('#provincia-chosen').on('change', function(evt, params) {

            cargar_cantones('listado-cantones', 'sel-lista-cantones', $(this).val());

        });

        $('#form-encabezado-filtros').submit(function(event) {

            $('#carga').html('<img src="http://www.funcion13.com/wp-content/uploads/2012/04/loader.gif" />');

            mostrar_contenidos("agentes_campo", "mapaLugaresInvervencion",
                    "busqueda_mapa_lugares_intervencion", $(this).serialize()
                    );
        });


    });
</script>


