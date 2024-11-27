<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Recibo Insumos<br>
        <small>Formulario para el registro de datos de los insumos recibidos.</small>
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
            <a href="javascript:abrir_tabla_recibo_insumos();">Insumos Recibidos</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Formulario</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <div class="block block-themed" >
        <div class="block-title">
            <h4>Recibo Insumo</h4><div class="block-options"></div>  
        </div>

        <div class="block-content"> 
            <form id="recibo-insumos"  class="form-inline" onsubmit="return false;">
                <!-- div.row-fluid -->
                <div class="row-fluid">
                    <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($datosInsumos) ? ($datosInsumos->ID_RECIBOINSUMO) : ''; ?>"/> 
                    <input type="hidden" id="cantidadAnterior" name="cantidadAnterior" value="<?php echo isset($datosInsumos) ? ($datosInsumos->CANTIDAD_RECIBOINSUMO) : ''; ?>"/> 
                    <input type="hidden" id="insumoAnterior" name="insumoAnterior" value="<?php echo isset($datosInsumos) ? ($datosInsumos->ID_INSUMO) : ''; ?>"/> 
                    <!-- 1st Column -->
                    <div class="span12">
                        <div class="control-group">
                            <label class="control-label  span2" for="insumo" >Insumo</label>
                            <div class="controls  span10">
                                <select id="listado-insumos" name="insumo" class="select-chosen">
                                    <option value="" >seleccione un insumo</option>                          
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
                        <?php // echo ($datosInsumos->ID_PERSONA); ?>
                        <?php // echo ($persona->ID_PERSONA); ?>
                        <div class="control-group">
                            <label class="control-label  span2" for="persona" >Persona que Recibe</label>
                            <div class="controls  span10">
                                <select id="listado-personas" name="persona" class="select-chosen">
                                    <option value >seleccione una persona</option>                          
                                    <?php foreach ($Persona as $persona): ?>
                                        <?php
                                        $selected = "";
                                        if (isset($datosInsumos)) {
                                            if ($persona->ID_PERSONA == $datosInsumos->ID_PERSONA) {
                                                $selected = " selected ";
                                                echo $selected;
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $persona->ID_PERSONA ?>" <?php echo $selected ?> ><?php echo ($persona->NOMBRE_REAL_PERSONA) ?></option>
                                    <?php endforeach; ?> 
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label  span2 " for="fechaRecibo">Fecha Recibo:</label>
                            <div class="controls span10">
                                <div class="input-append " >
                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                    <input type="text" id="fechaRecibo" value="<?php echo isset($datosInsumos) ? ($datosInsumos->FECHA_RECIBOINSUMO) : ''; ?>" 
                                           name="fechaRecibo" class="input-small input-datepicker" />                                    
                                </div>
                            </div>
                        </div>   

                        <div class="control-group">
                            <label class="control-label  span2 " for="cantidadInsumo">Cantidad del Insumo:</label>
                            <div class="controls span10">
                                <input type="number" id="cantidadInsumo" value="<?php echo isset($datosInsumos) ? ($datosInsumos->CANTIDAD_RECIBOINSUMO) : ''; ?>" 
                                       name="cantidadInsumo" class="input-small span1" placeholder="00">
                            </div>
                        </div> 

                        <div class="control-group">
                            <label class="control-label  span2 " for="loteReferencia">Lote de Referencia:</label>
                            <div class="controls span10">
                                <input type="text" id="loteReferencia" value="<?php echo isset($datosInsumos) ? ($datosInsumos->LOTE_REFERENCIA_RECIBOINSUMO) : ''; ?>" 
                                       name="loteReferencia" class="input-small span10">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-actions" align="center">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
                    <button type="submit" class="btn btn-success"><i class="icon-save"></i> Guardar</button>
                </div>
            </form>
        </div>


    </div>
</div>

<script>

    $(document).ready(function() {
              
        $("#recibo-insumos").submit(function(e) {
            var datosForm = $(this).serialize();
//            alert(datosForm);

            if (estaVacio($("#listado-insumos").val())) {
                alert('Debes seleccionar el insumo.');
                return false;
            }

            if (estaVacio($("#listado-personas").val())) {
                alert('Debes seleccionar la persona que recibe.');
                return false;
            }

            if (estaVacio($("#fechaRecibo").val())) {
                alert('Es necesario indicar la fecha del recibo.');
                return false;
            }

            if (estaVacio($("#cantidadInsumo").val()) || $("#cantidadInsumo").val() === '0') {
                alert('Debes indicar la cantidad recibida del insumo.');
                return false;
            }

            if (estaVacio($('#registro-id').val())) {
                ejecutarAccionJson(
                        'inventarios', 'reciboInsumos', 'agregar_recibo_insumos',
                        datosForm, 'mostrar_resultado_guardar( data, "abrir_tabla_recibo_insumos()", "" );'
                        );
            } else {
                ejecutarAccionJson(
                        'inventarios', 'reciboInsumos', 'update_recibo_insumos',
                        datosForm, 'mostrar_resultado_guardar( data, "abrir_tabla_recibo_insumos();", "" );'
                        );
            }
        });
    });

</script>



<script>
<?php if (isset($datosInsumos)): ?>
    agregar_boton_ayuda('EDITARINSUMOSRECIBIDO');
<?php else: ?>
    agregar_boton_ayuda('NUEVOINSUMORECIBIDO');
<?php endif; ?>
</script>

