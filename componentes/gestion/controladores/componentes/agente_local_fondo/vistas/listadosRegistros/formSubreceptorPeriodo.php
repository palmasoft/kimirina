
<form id="form-cosulta-reporte_mensual" class="form-inline" onsubmit="return false;" >

    <div class="row-fluid ">


        <div class="span3">
            <label class="control-label">Subreceptor</label>
            <div id="subreceptorslc" class="controls" >
                <select id="subreceptor" name="subreceptor" class="select-chosen span12 " >
                    <option value >Seleccione un subreceptor</option>
                    <?php
                    foreach ($subreceptores as $subreceptor) {
                        $selected = "";
                        if (isset($idSubreceptor))
                            if ($subreceptor->ID_SUBRECEPTOR == $idSubreceptor)
                                $selected = " selected ";
                        ?>
                        <option value="<?php echo $subreceptor->ID_SUBRECEPTOR ?>"   <?php echo $selected; ?> ><?php echo ($subreceptor->SIGLAS_SUBRECEPTOR) ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>


        <div class="span3">
            <label class="control-label" for="periodos">Periodos</label>
            <div class="controls">
                <?php $this->formularios->lista_periodos('informe', ' periodos select-chosen span12 '); ?>
            </div>
        </div>

        <div class="span6">                    
            <button id="btn_guardar_registro_semanal_contactos" type="submit" class="btn btn-success"><i class="icon-ok"></i> BUSCAR</button>
        </div>

    </div>

</form>