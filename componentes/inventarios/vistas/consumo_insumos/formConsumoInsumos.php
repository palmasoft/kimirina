<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-user themed-color"></i> Formulario Consumo Insumos<br>
        <small>Consumos de todo insumo</small>
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
            <a href="javascript:abrir_tabla_recibo_insumos();">Control Insumos</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Formulario Consumo Insumos</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <div class="block block-themed" >
        <div class="block-title">
            <h4>
                Consumo Insumo
            </h4>
            <div class="block-options">            
            </div>  
        </div>

        <div class="block-content"> 
            <form id="consumo-insumos"  class="form-inline" onsubmit="return false;">
                <!-- div.row-fluid -->
                <div class="row-fluid">
                    <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($datosInsumos) ? ($datosInsumos->ID_CONSUMO_INSUMO) : ''; ?>"/> 
                    <input type="hidden" id="periodo" name="periodo" value="<?php echo isset($datosInsumos) ? ($datosInsumos->ID_PERIODO) : ($Periodo->ID_PERIODO); ?>"/> 
                    <!--<input type="hidden" id="cantidadAnterior" name="cantidadAnterior" value="<?php // echo isset($datosInsumos) ? ($datosInsumos->CANTIDAD_RECIBOINSUMO) : ''; ?>"/>--> 
                    <!-- 1st Column -->
                    <div class="span12">
                        <div class="control-group">
                            <label class="control-label  span2" for="insumo" >Insumo</label>
                            <div class="controls  span10">
                                <select id="listado-insumos" name="insumo" class="select-chosen">
                                    <option value >seleccione un insumo</option>                          
                                    <?php foreach ($Insumos as $insumo): ?>
                                        <?php
                                        $selected = "";
                                        if (isset($datosInsumos)) {
                                            if ($insumo->ID_INSUMO == $datosInsumos->ID_INSUMO) {
                                                $selected = " selected ";
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $insumo->ID_INSUMO ?>" <?php echo $selected ?> ><?php echo ($insumo->NOMBRE_INSUMO) ?></option>
                                    <?php endforeach; ?> 
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label  span2" for="subreceptores" >Subreceptor que consume</label>
                            <div class="controls  span10">
                                <select id="listado-subreceptores" name="subreceptores" class="select-chosen">
                                    <option value >seleccione un subreceptor</option>                          
                                    <?php foreach ($Subreceptores as $subreceptor): ?>
                                        <?php
                                        $selected = "";
                                        if (isset($datosInsumos)) {
                                            if ($subreceptor->ID_SUBRECEPTOR == $datosInsumos->ID_SUBRECEPTOR_CONSUMO) {
                                                $selected = " selected ";
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $subreceptor->ID_SUBRECEPTOR ?>" <?php echo $selected ?> ><?php echo ($subreceptor->SIGLAS_SUBRECEPTOR) ?></option>
                                    <?php endforeach; ?> 
                                </select>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label  span2 " for="cantidadInsumo">Cantidad del Insumo:</label>
                            <div class="controls span10">
                                    <input type="number" id="cantidadInsumo" value="<?php echo isset($datosInsumos) ? ('$datosInsumos->CANTIDAD_RECIBOINSUMO') : ''; ?>" 
                                           name="cantidadInsumo" class="input-small span1" placeholder="00">
                            </div>
                        </div> 
                    </div>
                </div>


                <div class="form-actions">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
                    <button type="submit" class="btn btn-success"><i class="icon-save"></i> Guardar</button>
                </div>
            </form>
        </div>


    </div>
</div>

<script>

    $(document).ready(function() {	
        $("#consumo-insumos").submit( function (e){
            var datosForm = $(this).serialize();
            //alert(datosForm);
            if( estaVacio( $('#registro-id').val() )  ){
                ejecutarAccionJson(
                'inventarios', 'consumoInsumos', 'agregar_consumo_insumos', 
                datosForm, 'mostrar_resultado_guardar( data, "abrir_tabla_consumo_insumos()", "" );'
            ); 
            }else{
                ejecutarAccionJson(
                'inventarios', 'consumoInsumos', 'update_consumo_insumos', 
                datosForm, 'mostrar_resultado_guardar( data, "abrir_tabla_consumo_insumos();", "" );'
            );	
            }
        });
    });

</script>